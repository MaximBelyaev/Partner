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
	protected $l;
	public $landings;

	public function __construct($user = null) {
		$this->landings = Yii::app()->controller->landings;
		unset($this->landings[0]);
		
		if (!count($this->landings))
		{
			$this->landings[-1] = 1;
		}
		
		$this->l = (isset(Yii::app()->session['landing']))?(int)Yii::app()->session['landing']:false; 
		
		if ($user instanceof User ) {
			$this->user = $user;
		} else if ((int)($user) > 0) {
			$user = User::model()->findByPk($user);
			if (!is_null($user)) {
				$this->user = $user;
			} else {
				throw new CException("Указанный пользователь не найден");
			}
		}
	}

	protected function formatDate($date) {
		if( preg_match('/[0-9]+(-|\/)[0-9]+(-|\/)[0-9]+/', $date) ){ $date = strtotime($date); }
		else if ( (int)$date > 0 ){ $date = (int)($date); }
		return $date;
	}

	public function getRangeUsersData($start, $end)
	{
		$start = $this->formatDate($start);
		$end   = $this->formatDate($end);
		$dotsCount = Yii::app()->params['chartTimePoints'];
		$delta = ($end-$start)/$dotsCount;


		$users = User::model()->findAll(array(
			'select'    => '*',
			'condition' => 'UNIX_TIMESTAMP(reg_date) > :start and UNIX_TIMESTAMP(reg_date) < :end ',
			'params'    => array( 
				':start'  => $start, 
				':end'    => $end 
			),
		));


        $d = array();
        for($i = 0; $i < $dotsCount; $i++) {

            $intervalStart = $start + $delta * $i;
            $intervalEnd = $start + $delta * ($i + 1);
            # var_dump('is - ' . $intervalStart);each
            # var_dump('ie - ' . $intervalEnd);
            $d[$i][0] = $intervalStart * 1000;
            $d[$i][1] = 0;
            $d[$i]['land'] = [];
			foreach ($this->landings as $key => $value) {
				$d[$i]['land'][$key] = array('name' => $value, 'value' => 0);
			}

			foreach ($users as $usr) {
				if ( strtotime($usr->reg_date)>$intervalStart && strtotime($usr->reg_date)<=$intervalEnd ) {
					$d[$i][1]++;
				}
			}
		}

		return $d;
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
			# var_dump('is - ' . $intervalStart);each
			# var_dump('ie - ' . $intervalEnd);
			$d[$i][0]  = $intervalStart*1000;
			$d[$i][1] = 0;
			$d[$i]['land'] = [];
			foreach ($this->landings as $key=>$value)
			{
				$d[$i]['land'][$key] = array('name' => $value, 'value' => 0);
			}

			foreach ($data as $dt)
            {
				if ( strtotime($dt['date'])>$intervalStart && strtotime($dt['date'])<=$intervalEnd ) {
					$d[$i][1]++;
					if (isset($d[$i]['land'][$dt['land_id']]))
					{
						$d[$i]['land'][$dt['land_id']]['value']++;
					}
				}
			}
		}
		return $d;
	}

	public function getAllRangeRequests($start, $end, $use_click_pay) {
		$params    = array( 
			':start' => $start, 
			':end' 	 => $end
		);
		$date_line = ' UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end ';
		if (is_null($use_click_pay)) {
			$condition = $date_line;
		} else {
			$condition = 'click_pay = :click_pay and ' . $date_line; 
			$params[':click_pay'] = $use_click_pay;
		}
		if ($this->l) {
			$condition .= ' and land_id = :land_id';
			$params[':land_id'] = $this->l;
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
		if ($this->l)
		{
			$condition .= ' AND land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		else
		{
			$condition .= ' AND land_id IN(' . implode(',', array_keys($this->landings)) . ')';
		}
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


	public function getRangeReferralsData($start, $end, $payed = false, $distinct = false) {
		$start = $this->formatDate($start);
		$end   = $this->formatDate($end);
		
		$dotsCount = Yii::app()->params['chartTimePoints'];
		$delta = ($end-$start)/$dotsCount;

		if(is_null($this->user)) {
			$data = $this->getAllRangeReferrals($start, $end);
			if ( $payed ) {
				$data = $this->getAllRangePayedReferrals($start, $end);
			} elseif( $distinct ) {
				$data = $this->getAllRangeDistinctReferrals($start, $end);
			} else {
				$data = $this->getAllRangeReferrals($start, $end);
			}
		} else {
			if ( $payed ) {
				$data = $this->getUserRangePayedReferrals($start, $end);
			} elseif( $distinct ) {
				$data = $this->getUserRangeDistinctReferrals($start, $end);
			} else {
				$data = $this->getUserRangeReferrals($start, $end);
			}
		}


        $d = array();
        for($i = 0; $i < $dotsCount; $i++) {

            $intervalStart = $start + $delta * $i;
            $intervalEnd = $start + $delta * ($i + 1);
            # var_dump('is - ' . $intervalStart);each
            # var_dump('ie - ' . $intervalEnd);
            $d[$i][0] = $intervalStart * 1000;
            $d[$i][1] = 0;
            $d[$i]['land'] = [];
            foreach ($this->landings as $key => $value) {
                $d[$i]['land'][$key] = array('name' => $value, 'value' => 0);
            }

            foreach ($data as $dt) {
                if (strtotime($dt['date']) > $intervalStart && strtotime($dt['date']) <= $intervalEnd) {
                    $d[$i][1]++;
                    if (isset($d[$i]['land'][$dt['land_id']])) {
                        $d[$i]['land'][$dt['land_id']]['value']++;
                    }
                }
            }
        }

		return $d;
	}

	public function getAllRangeReferrals( $start, $end ) {
		$condition = 'UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		$params    = array( 
			':start' => $start, 
			':end' => $end 
		);
		if ( $this->l ) {
			$condition .= ' and land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		return $this->getRangeReferrals($condition, $params);
	}

	public function getAllRangePayedReferrals( $start, $end ) {
		$condition = 'status = :status and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		$params    = array( 
			':status' => Referrals::$STATUS_APPLIED, 
			':start' => $start, 
			':end' => $end 
		);
		if ( $this->l ) {
			$condition .= ' and land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		return $this->getRangeReferrals($condition, $params);

	}
	public function getAllRangeDistinctReferrals( $start, $end ) {
		$condition = 'UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end '; 
		$params    = array( 
			':start' => $start, 
			':end' => $end 
		);
		if ( $this->l ) {
			$condition .= ' and land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		$requests = Referrals::model()->findAll(array(
			'select' => 'email, date',
			'distinct' => true,
			'condition' => $condition,
			'params' => $params,
		));
		return $requests;
	}

	public function getUserRangeReferrals($start, $end) {
		$condition = 'user_id = :user and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end ';
		$params    = array( 
			':user' => $this->user->id, 
			':start' => $start, 
			':end' => $end 
		);
		if ($this->l)
		{
			$condition .= ' AND land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		else
		{
			$condition .= ' AND land_id IN(' . implode(',', array_keys($this->landings)) . ')';
		}
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
		if ($this->l)
		{
			$condition .= ' AND land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		else
		{
			$condition .= ' AND land_id IN(' . implode(',', array_keys($this->landings)) . ')';
		}
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

	public function getRangeAllStat($start, $end) {

		$stats = array();
		$start = $this->formatDate($start);
		$end   = $this->formatDate($end);
		$condition = 'UNIX_TIMESTAMP(reg_date) > :start and UNIX_TIMESTAMP(reg_date) < :end';
		# все новые партнеры
		$stats['new_partners'] = count(User::model()->findAll(
			array(
				'select'	=> 'reg_date',
				'condition'	=> $condition, 
				'params'	=> array(
					':start' => $start, 
					':end'   => $end,
				),
			)
		));

		# все переходы
		$condition = 'UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end';
		$params = array(
			':start' => $start, 
			':end'   => $end,
		);
		if ($this->l) {
			$condition .= ' and land_id = :land_id';
			$params[':land_id'] = $this->l;
		}

		$stats['requests'] = count(Requests::model()->findAll(
			array(
				'select'	=> 'date',
				'condition'	=> $condition, 
				'params'	=> $params,
			)
		));

		# все клиенты
		$condition = 'UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end';
		$params = array(
			':start' => $start, 
			':end'   => $end,
		);
		if ($this->l) {
			$condition .= ' and land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		$stats['referrals'] = count(Referrals::model()->findAll(
			array(
				'select'	=> 'date',
				'condition'	=> $condition, 
				'params'	=> $params,
			)
		));

		# все заказы 

		$condition = 'UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end';
		$params = array(
			':start'  => $start, 
			':end'    => $end,
			':status' => Referrals::$STATUS_APPLIED,
		);
		if ($this->l) {
			$condition .= ' and land_id = :land_id';
			$params[':land_id'] = $this->l;
		}
		$payed = Referrals::model()->findAll(
			array(
				'select'	=> 'date, money',
				'condition'	=> 'status = :status and ' . $condition, 
				'params'	=> $params
			)
		);
		$stats['payed'] = count($payed);
		$profit = 0;
		foreach ($payed as $p) {
			$profit = $profit + $p->money;
		}
		$stats['profit'] = $profit;
		
		return $stats;
	}

	public function getRangeStat($start, $end) {

		$start = $this->formatDate($start);
		$end   = $this->formatDate($end);

		$click_pay = Setting::model()->find(array(
			'select' 	=> 'value',
			'condition'	=> 'name="click_pay"'
		));
		$click_pay = $click_pay->value;

		if (!is_null($this->user)) {
			$condition = 'partner_id = :user and click_pay = :ucp and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end';
			if( $this->l ) {
				$condition .= ' and land_id=' . $this->l ;
			}
			else
			{
				$condition .= ' AND land_id IN(' . implode(',', array_keys($this->landings)) . ')';
			}
			$rqs = Requests::model()->findAll(
				array(
					'select'	=> 'date',
					'condition'	=> $condition,
					'params'	=> array(
						':user'  => $this->user->id, 
						':ucp'   => $this->user->use_click_pay, 
						':start' => $start, 
						':end'   => $end,
					),
					'distinct'	=> true, 
					'order'		=> 'date DESC'
				)
			);
			
			$condition = 'partner_id = :user and click_pay = :ucp and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end';
			if( $this->l ) {
				$condition .= ' and land_id=' . $this->l ;
			}
			else
			{
				$condition .= ' AND land_id IN(' . implode(',', array_keys($this->landings)) . ')';
			}
			$all_rqs = Requests::model()->findAll(
				array(
					'select'	=> '*',
					'condition'	=> $condition, 
					'params'	=> array(
						':user'  => $this->user->id, 
						':ucp'   => $this->user->use_click_pay, 
						':start' => $start, 
						':end'   => $end,
					),
					'order'		=> 'date DESC'
				)
			);

			// if (!$this->user->use_click_pay) {
				$condition = 'user_id = :user and UNIX_TIMESTAMP(date) > :start and UNIX_TIMESTAMP(date) < :end';
				if( $this->l ) {
					$condition .= ' and land_id=' . $this->l;
				}
				else
				{
					$condition .= ' AND land_id IN(' . implode(',', array_keys($this->landings)) . ')';
				}
				$refs = Referrals::model()->findAll(
					array(
						'select' => '*',
						'condition' => $condition,
						'params' => array(
							':user'  => $this->user->id, 
							':start' => $start, 
							':end'   => $end,
						),
					)

				);

			// } else { $refs = array(); }

			$requests = array();
			$all_time_total = array(
				'requests'	=> 0,
				'referrals'	=> 0,
				'payed'		=> 0,
				'profit'	=> 0,					
			);

			foreach ($rqs as $key => $rq) {

				$rq_date = $rq->date;
				$month_date = date('Y-m', strtotime($rq_date));

				$rus_date = Yii::app()->locale->getMonthName(
					(int)date("m",strtotime($rq_date)), "wide", true
				) . " " . date("Y",strtotime($rq_date));
				
				if (!isset($requests[$month_date]['total'])) {
					$requests[$month_date]['total'] = array(
						'requests'	=> 0,
						'referrals'	=> 0,
						'payed'		=> 0,
						'profit'	=> 0,					
					);
				}

				$rq_stat = array(
					'date'		=> $rq_date,
					'requests'	=> 0,
					'referrals'	=> 0,
					'payed'		=> 0,
					'profit'	=> 0,
				);


				foreach ( $all_rqs as $allrqkey => $allrq ) {
					if ($rq_date == $allrq->date) {
						$requests[ $month_date ][ 'total' ][ 'requests' ]++;
						$all_time_total[ 'requests' ]++;
						$rq_stat[ 'requests' ]++;

						if ($this->user->use_click_pay) {
							$rq_stat[ 'profit' ] = $rq_stat[ 'profit' ] + (($this->user->use_click_pay&&$this->user->click_pay)?$this->user->click_pay:$click_pay);
							$requests[ $month_date ][ 'total' ][ 'profit' ] = $requests[$month_date][ 'total' ][ 'profit' ] + (($this->user->use_click_pay&&$this->user->click_pay)?$this->user->click_pay:$click_pay);
							$all_time_total[ 'profit' ] = $all_time_total[ 'profit' ] + (($this->user->use_click_pay&&$this->user->click_pay)?$this->user->click_pay:$click_pay);
						}
					}
				}

				foreach ($refs as $rkey => $ref) {

					$ref_date = date('Y-m-d',strtotime($ref->date));

					if ($ref_date == $rq_date) {
					
						$requests[ $month_date ][ 'total' ][ 'referrals' ]++;
						$all_time_total[ 'referrals' ]++;
						$rq_stat[ 'referrals' ]++;

						if ($ref->status == Referrals::$STATUS_APPLIED) {
						
							$rq_stat[ 'payed' ]++;
							$all_time_total[ 'payed' ]++;
							$requests[ $month_date ][ 'total' ][ 'payed' ]++;
							
							$rq_stat[ 'profit' ] = $rq_stat[ 'profit' ]+($ref->money*(Yii::app()->params['profit_percent']/100));
							$requests[ $month_date ][ 'total' ][ 'profit' ] = $requests[$month_date][ 'total' ][ 'profit' ]+($ref->money*(Yii::app()->params['profit_percent']/100));
							$all_time_total[ 'profit' ] = $all_time_total[ 'profit' ]+($ref->money*(Yii::app()->params['profit_percent']/100));
						
						}
					}

				}

				$requests[$month_date]['rus_date'] = $rus_date;
				$requests[$month_date]['stat'][]   = $rq_stat;
			
			}

			return array(
				'stats' => $requests, 
				'all_time_total' => $all_time_total, 
				'use_click_pay' => (int)$this->user->use_click_pay
			);
		}
	}

}

?>