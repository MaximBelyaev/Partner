<?php 
class ApiController extends Controller
{
	public function actionIndex()
	{

	} 
	public function actionClick()
	{
		$site 		= isset($_GET['partner_site']) ? $_GET['partner_site'] : '';
		$cookie_refer_id = isset($_COOKIE['refer_id']) ? $_COOKIE['refer_id'] : '';
		$ip 		= isset($_GET['ip']) ? $_GET['ip'] : '';
		$refer_id 	= isset($_GET['refer_id']) ? (int)$_GET['refer_id'] : '';
		$land_url	= isset($_GET['land_url']) ? $_GET['land_url'] : '';
		$land_id 	= isset($_GET['land_id']) ? (int)$_GET['land_id'] : '';
		$user_id 	= '';
		$user 		= '';

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
		
		$land = Landings::model()->find("link LIKE '%$land_url%'");
		if ( !$land && $land_id > 0 ) {
			$land = Landings::model()->findByPk($land_id);	
		} else if ( !$land && $user && isset($user->users_landings[0]) ) {
			$land = Landings::model()->findByPk($user->users_landings[0]->land_id);
		} else {
			$lands = Landings::model()->findAll();
			if (!empty($lands)) {
				$land  = $lands[0];
			}
		}

		if ($land) {
			$land_id = $land->land_id;
		}
		# если land_id не указан, то 
		$r = new Requests();
		$r->ip 		= $ip;
		$r->land_id = $land_id;
		$r->date 	= date('Y-m-d');

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
			$referral = new Referrals();
			$referral->email  = isset($_GET['email']) ? trim($_GET['email']) : '';
			$referral->site   = isset($_GET['site']) ? trim($_GET['site']) : '';
			$referral->tz     = isset($_GET['tz']) ? trim($_GET['tz']) : '';
			$referral->region = isset($_GET['region']) ? trim($_GET['region']) : '';
			$referral->request_type = isset($_GET['request_type']) ? trim($_GET['request_type']) : '';
			$referral->requests  	= isset($_GET['requests']) ? trim($_GET['requests']) : '';
			$referral->user_from 	= isset($_GET['user_from']) ? trim($_GET['user_from']) : '';
			$referral->promo 		= isset($_GET['promo_code']) ? trim($_GET['promo_code']) : '';
			$referral->land_id 		= isset($_GET['land_id']) ? (int)$_GET['land_id'] : '';
			$referral->status 		= Referrals::$STATUS_REQUEST;


			$partner_site    = isset($_GET['partner_site']) ? $_GET['partner_site'] : '';
			$cookie_refer_id = isset($_GET['cookie_refer_id']) ? $_GET['cookie_refer_id'] : '';
			$refer_id 		 = isset($_GET['refer_id']) ? (int)$_GET['refer_id'] : '';
			$land_url		 = isset($_GET['land_url']) ? $_GET['land_url'] : '';




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
				$q = new CDbCriteria( array( 'condition' => "site LIKE '%$partner_site%'" ) );
				$user = User::model()->find($q);
				if ($user)
				{
					$referral->user_id = $user->id;
				} 
				elseif ($cookie_refer_id) 
				{
	                $referral->user_id = $cookie_refer_id;
	            } 
	            else 
	            {
	            	$referral->user_id = 0;
	            }
			}
            elseif ($cookie_refer_id)
            {
                $referral->user_id = $cookie_refer_id;
            } 
            else 
            {
            	$referral->user_id = 0;
            }

			if (!$referral->land_id) {
				if ($land_url) {
					$land = Landings::model()->find("link LIKE '%$land_url%'");
				} else {
					$land = false;
				}

				if ( $land ) {
					$referral->land_id = $land->land_id;	
				} else if ( !$land && ( $referral->user_id > 0 ) ) {
					$user = User::model()->findByPk($referral->user_id);
					if ( isset( $user->users_landings[0] ) ) {
						$referral->land_id = $user->users_landings[0]->land_id;
					} else {
						$lands = Landings::model()->findAll();
						if ( isset( $lands[0] ) ) {
							$referral->land_id = $lands[0]->land_id;
						}
					}
				} else {
					$lands = Landings::model()->findAll();
					if ( isset( $lands[0] ) ) {
						$referral->land_id = $lands[0]->land_id;
					}
				}

				if ($land) {
					$referral->land_id = $land->land_id;
				}
			}

            $referral->save();
			// var_dump($referral);


	} 
}
?>
