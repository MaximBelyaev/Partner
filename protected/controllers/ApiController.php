<?php 
class ApiController extends Controller
{
	public function actionIndex()
	{

	} 
	public function actionClick()
	{
		$site = isset($_GET['ref']) ? $_GET['ref'] : '';
		$cookie_refer_id = isset($_COOKIE['refer_id']) ? $_COOKIE['refer_id'] : '';
		$ip = isset($_GET['ip']) ? $_GET['ip'] : '';
		$refer_id = isset($_GET['refer_id']) ? (int)$_GET['refer_id'] : '';
		$land_id = isset($_GET['land_id']) ? (int)$_GET['land_id'] : '';
		$user_id = '';
		$user = '';

		if ($refer_id)
		{
			$user_id = $refer_id;
		}
		elseif (!$refer_id)
		{
			$q = new CDbCriteria( array( 'condition' => "site LIKE '%$site%'" ) );
			$user = User::model()->find($q);
			if ($user)
			{
				$user_id = $user->id;
			}
			elseif ($cookie_refer_id)
			{
				$user_id = $cookie_refer_id;
			}
		}

		if ($user_id)
		{
			$user = User::model()->findByPk($user_id);
		}

		$settingsClickpay = Setting::model()->find(array('condition' => "name = 'click_pay'"));
		$land = Landings::model()->findByPk($land_id);
		$r = new Requests();
		$r->ip = $ip;
		$r->land_id = $land_id;
		$r->date = date('Y-m-d');

		if ($user && $user->use_click_pay && $settingsClickpay->status == '1') {
			$r->click_pay = 1;
		} else {
			$r->click_pay = 0;
		}
		$r->partner_id = $user_id;
		if($r->save() && $r->click_pay == 1)
		{
			if ($land)
			{
				if ($land->click_pay > 0)
				{
					$click_pay = $land->click_pay;
					$user->money->profit += $click_pay;
					$user->money->full_profit += $click_pay;
					$user->money->save();
				}
			}
			elseif ($user)
			{
				if ($user->use_click_pay)
				{
					if ($user->click_pay > 0)
					{
						$click_pay = $user->click_pay;
					}
					else
					{
						$click_pay = $settingsClickpay->value;
					}
					$user->money->profit += $click_pay;
					$user->money->full_profit += $click_pay;
					$user->money->save();
				}
			}
		}
	}

	public function actionReferral()
	{
		if (isset($_GET['secret']))
		{
			$referral = new Referrals();
			$referral->email  = isset($_GET['email']) ? trim($_GET['email']) : '';
			$referral->site   = isset($_GET['site']) ? trim($_GET['site']) : '';
			$referral->tz     = isset($_GET['tz']) ? trim($_GET['tz']) : '';
			$referral->region = isset($_GET['region']) ? trim($_GET['region']) : '';
			$referral->request_type = isset($_GET['request_type']) ? trim($_GET['request_type']) : '';
			$referral->requests  = isset($_GET['requests']) ? trim($_GET['requests']) : '';
			$referral->user_from = isset($_GET['user_from']) ? trim($_GET['user_from']) : '';
			$referral->promo = isset($_GET['promo_code']) ? trim($_GET['promo_code']) : '';
			$referral->land_id = isset($_GET['land_id']) ? (int)$_GET['land_id'] : '';
			
			$partner_site = isset($_GET['ref']) ? $_GET['ref'] : '';
			//$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
			$cookie_refer_id = isset($_COOKIE['refer_id']) ? $_COOKIE['refer_id'] : '';
			$refer_id = isset($_GET['refer_id']) ? (int)$_GET['refer_id'] : '';

			# тут мы проверим, был ли уже заказ с таким email
			$back = Referrals::model()->find('email ="' . trim($referral->email) . '" AND user_id != 0');

			# если человек с таким email уже был, 
			# то новому заказу мы присваиваем имеющегося партнера
			if ($back && (int)$back->user_id)
			{
				$referral->user_id = (int)$back->user_id;
			}
			elseif ($refer_id)
			{
				$referral->user_id = $refer_id;
			}
			elseif ($partner_site)
			{
				$q = new CDbCriteria( array( 'condition' => "site='$partner_site'" ) );
				$user = User::model()->find($q);
				if ($user)
				{
					$referral->user_id = $user->user_id;
				}
			}
            elseif ($cookie_refer_id)
            {
                $referral->user_id = $cookie_refer_id;
            }

            /*
			# получаем нужные настройки
			$settingsFixedpay = Setting::model()->find(array('condition' => "name = 'fixed_pay'"));
			$settingsVip = Setting::model()->find(array('condition' => "name = 'vip'"));
			$settingsExtended = Setting::model()->find(array('condition' => "name = 'extended'"));
			$settingsStandard = Setting::model()->find(array('condition' => "name = 'standard'"));

			# получаем лендинг
			$land = Landings::model()->findByPk($referral->land_id);

			# если есть id юзера, ищем его
			if ($referral->save() && $referral->user_id && $referral->money) {
				$user = User::model()->findByPk($referral->user_id);
				if ($user)
				{
					$land_percent = 0;
					if ($settingsFixedpay->status == '1')
					{
						$payment = $settingsFixedpay->value;
						$user->money->profit += $payment;
						$user->money->full_profit += $payment;
						$user->money->save();
					}
					elseif ($land)
					{
						if ($user->status === "VIP")
						{
							$land_percent = $land->vip;
						}
						elseif ($user->status === "Расширенный")
						{
							$land_percent = $land->extended;
						}
						elseif ($user->status === "Стандартный")
						{
							$land_percent = $land->standard;
						}
						if ($land_percent > 0)
						{
							$payment = ($land_percent*$referral->money)/100;
							$user->money->profit += $payment;
							$user->money->full_profit += $payment;
							$user->money->save();
						}
					}
					elseif (!$land || $land_percent = 0)
					{
						$payment = 0;
						if ($user->status === "VIP")
						{
							$payment = ($settingsVip->value*$referral->money)/100;
						}
						elseif ($user->status === "Расширенный")
						{
							$payment = ($settingsExtended->value*$referral->money)/100;
						}
						elseif ($user->status === "Стандартный")
						{
							$payment = ($settingsStandard->value*$referral->money)/100;
						}
						$user->money->profit += $payment;
						$user->money->full_profit += $payment;
						$user->money->save();
					}
				}
			};**/
			echo "<pre>";
			#var_dump($referral);
			echo "</pre>";
		}
		else
		{
			echo "no code";
		}
	} 
}
?>
