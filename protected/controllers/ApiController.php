<?php 
class ApiController extends Controller
{
	public function actionIndex()
	{

	} 
	public function actionClick()
	{
		$site = isset($_GET['ref']) ? $_GET['ref'] : '';
		$ip = isset($_GET['ip']) ? $_GET['ip'] : '';
		$refer_id = isset($_GET['refer_id']) ? (int)$_GET['refer_id'] : '';;

		if (is_int($refer_id)) {
			$user_id = $refer_id;
			$user = User::model()->findByPk($user_id);
		} else {
			$q = new CDbCriteria( array(
				'condition' => "site LIKE '%$site%'",
			));
			$user = User::model()->find($q);
			if ($user) {
				$user_id = $user->id;
			} else {
				$user_id = 0;
			}
		}

		$r = new Requests();
		$r->ip = $ip;
		$r->date = date('Y-m-d');
		if ($user && $user->use_click_pay) {
			$r->click_pay = $user->use_click_pay;
		} else {
			$r->click_pay = 0;
		}
		$r->partner_id = $user_id;
		if($r->save()) {
			if($user) {
				if($user->use_click_pay) {
					if ($user->click_pay > 0) {
						$click_pay = $user->click_pay;
					} else {
						$click_pay = Setting::model()->find('name = "click_pay"');
						$click_pay = $click_pay->value;
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
		$referral->requests  = isset($_GET['requests']) ? trim($_GET['requests']) : '';
		$referral->user_from = isset($_GET['user_from']) ? trim($_GET['user_from']) : '';
		$referral->promo = isset($_GET['promo_code']) ? trim($_GET['promo_code']) : '';
		
		$partner_site = isset($_GET['ref']) ? $_GET['ref'] : '';
		$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

		# тут мы проверим, был ли уже заказ с таким email
		$back = Referrals::model()->find('email LIKE "%' . $referral->email . '%" AND user_id != 0');

		# если человек с таким email уже был, 
		# то новому заказу мы присваиваем имеющегося партнера
		if ($back && (int)$back->user_id) {
			$referral->user_id = (int)$back->user_id;
		} elseif($partner_site) {
			$q = new CDbCriteria( array(
				'condition' => "site LIKE '%$partner_site%'",
			));
			$user = User::model()->find($q);
			if ($user) {
				$referral->user_id = $user->user_id;
			} elseif ($user_id) {
				$referral->user_id = $user_id;
			}
		} elseif ($user_id) {
			$referral->user_id = $user_id;
		}
		
		
		$referral->save();
		echo "<pre>";
		var_dump($referral);
		echo "</pre>";
	} 
}

?>
