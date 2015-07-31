<?php

class StatisticsController extends AdminController
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($this->module->assetsUrl.'/js/statistic.js');


		# подготовим информацию для кнопок с последними отрезками
        $times = array(
        	"now" => strtotime("now"),
            "last_week" => strtotime("-1 week"),
            "last_month" => strtotime("-1 month"),
            "last_quater" => strtotime("-3 month"),
            "last_year" => strtotime("-1 year"),
        );

		$this->render('index',array(
			'times' => $times,
		));
	}

	public function actionRange($start, $end, $type, $output_type = 'both')
	{
		$chart = new Chart();
		if ($output_type == 'chart' || $output_type == 'both') {
			$charts = array();
		}
		if ($output_type == 'table' || $output_type == 'both') {
			$stats = array();
		}

		if ($type == 'user') {

			if ($output_type == 'chart' || $output_type == 'both') {
				$charts['user'] = $chart->getRangeUsersData($start, $end);
			}
			if ($output_type == 'table' || $output_type == 'both') {
				// $stats['user'] = $chart->getRangeUsersData($start, $end);
			}

		} elseif ($type == 'referrals') {
			// количество клиентов (клиенты БЕЗ учета повторений)
			if ($output_type == 'chart' || $output_type == 'both') {
				$charts['referrals'] = $chart->getRangeReferralsData($start, $end, false, 'distinct');
			}
			if ($output_type == 'table' || $output_type == 'both') {
				$stats['referrals'] = $chart->getRangeReferralsData($start, $end, false, 'distinct');	
			}

		} elseif ($type == 'requests') {
			// переходы
			if ($output_type == 'chart' || $output_type == 'both') {
				$charts['requests'] = $chart->getRangeRequestsData($start, $end);			
			}
			if ($output_type == 'table' || $output_type == 'both') {
				// $stats['requests'] = $chart->getRangeRequestsData($start, $end);
			}

		} elseif ($type == 'referrals_z') {
			// количество заявок 
			$charts['referrals_z'] = $chart->getRangeReferralsData($start, $end);			
		} elseif ($type == 'payed') {
			$charts['payed'] = $chart->getRangeReferralsData($start, $end, 'payed');
		}

		$stats = $chart->getRangeAllStat($start, $end);
		$return = array(
			'chart' => $chart,
		);
		if (isset($charts)) { $return['charts'] = $charts; }
		if (isset($stats)) { $return['stats'] = $stats; }
		echo json_encode($return);
		Yii::app()->end();
	}
}
