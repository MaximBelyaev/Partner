<?php 

/**
* Если создаем объект с переменной $user, 
* то данные для графиков будут получаться для этого пользователя
*
*
**/

class Chart
{
	public $user = null;

	public function __construct($user = null) {
		if ($user instanceof User ) {
			$this->user = $user;
		} else if ((int)($user) > 0) {
			$user = User::model()->findByPk($user);
			if (!is_null($user)) {
				$this->user = $user;
			} else {
				throw new CException("Указанный пользователь не найден");
			}
		} else {
			throw new CException("Неверно указан пользователь");
		}
	}

	protected function formatDate($date) {
		if( preg_match('/[0-9]+(-|\/)[0-9]+(-|\/)[0-9]+/', $date) ){ $date = strtotime($date); }
		else if ( (int)$date > 0 ){ $date = (int)($date); }
		return $date;
	}

	public function getRangeRequestsData($start, $end, $use_click_pay = null) {
		
		$start = $this->formatDate($start);
		$end   = $this->formatDate($end);
		
		$dotsCount = Yii::app()->params['chartTimePoints'];
		$delta = ($end-$start)/$dotsCount;


		if(is_null($this->user)) {
			$data = $this->getAllRangeRequests($start, $end, $use_click_pay);
		} else {
			$data = $this->getUserRangeRequests($start, $end, $this->user->use_click_pay);
		}

		$d = array();
		for($i = 0; $i < $dotsCount; $i++) {

			$intervalStart = $start + $delta*$i;
			$intervalEnd   = $start + $delta*($i+1);
			# var_dump('is - ' . $intervalStart);
			# var_dump('ie - ' . $intervalEnd);
			$d[$i][0]  = $intervalStart*1000;
			$d[$i][1] = 0;
			foreach ($data as $dt) {
				if ( strtotime($dt['date'])>$intervalStart && strtotime($dt['date'])<=$intervalEnd ) {
					$d[$i][1]++;
				}
			}

		}

		return $d;
	}

	public function getAllRangeRequests($start, $end, $use_click_pay) {
		$params    = array( 
			':start' => $start, 
			':end' => $end 
		);
		if (!is_null($use_click_pay)) {
			$condition = 'UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		} else {
			$condition = 'click_pay = :click_pay and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
			$params[':click_pay'] = $use_click_pay;
		}
		return $this->getRangeRequests($condition, $params);
	}

	public function getUserRangeRequests($start, $end, $use_click_pay) {
		$condition = 'partner_id = :user and click_pay = :click_pay and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		$params    = array( 
			':user' => $this->user->id, 
			':click_pay' => $use_click_pay, 
			':start' => $start, 
			':end' => $end 
		);
		return $this->getRangeRequests($condition, $params);
	}

	protected function getRangeRequests($condition, $params) {
		$requests = Requests::model()->findAll(array(
			'select' => '*',
			'condition' => $condition,
			'params' => $params,
		));
		return $requests;
	}


	public function getRangeReferralsData($start, $end, $payed = false) {
		$start = $this->formatDate($start);
		$end   = $this->formatDate($end);
		
		$dotsCount = Yii::app()->params['chartTimePoints'];
		$delta = ($end-$start)/$dotsCount;

		if(is_null($this->user)) {
			$data = $this->getAllRangeReferrals($start, $end);
		} else {
			if ($payed) {
				$data = $this->getUserRangePayedReferrals($start, $end);
			} else {
				$data = $this->getUserRangeReferrals($start, $end);
			}
		}

		$d = array();
		for($i = 0; $i < $dotsCount; $i++) {

			$intervalStart = $start + $delta*$i;
			$intervalEnd   = $start + $delta*($i+1);
			# var_dump('is - ' . $intervalStart);
			# var_dump('ie - ' . $intervalEnd);
			$d[$i][0]  = $intervalStart*1000;
			$d[$i][1] = 0;
			foreach ($data as $dt) {
				if ( strtotime($dt['date'])>$intervalStart && strtotime($dt['date'])<=$intervalEnd ) {
					$d[$i][1]++;
				}
			}

		}

		return $d;
	}

	public function getAllRangeReferrals($start, $end) {
		$condition = 'UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		$params    = array( 
			':start' => $start, 
			':end' => $end 
		);
		return $this->getRangeReferrals($condition, $params);
	}

	public function getUserRangeReferrals($start, $end) {
		$condition = 'user_id = :user and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		$params    = array( 
			':user' => $this->user->id, 
			':start' => $start, 
			':end' => $end 
		);
		return $this->getRangeReferrals($condition, $params);
	}

	public function getUserRangePayedReferrals($start, $end) {
		$condition = 'user_id = :user and status = :status and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		$params    = array( 
			':user' => $this->user->id,
			':status' => Referrals::$STATUS_APPLIED, 
			':start' => $start, 
			':end' => $end 
		);
		return $this->getRangeReferrals($condition, $params);
	}

	protected function getRangeReferrals($condition, $params) {
		$requests = Referrals::model()->findAll(array(
			'select' => '*',
			'condition' => $condition,
			'params' => $params,
		));
		return $requests;
	}

}

?>