<?php

class StatisticsController extends AdminController
{
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
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

	public function actionRange($start, $end, $type)
	{
		$chart = new Chart();
		$charts = array();
		if ($type == 'user') {
			$charts['user'] = $chart->getRangeUsersData($start, $end);
		} elseif ($type == 'referrals') {
			$charts['referrals'] = $chart->getRangeReferralsData($start, $end, false, 'distinct');
		} elseif ($type == 'requests') {
			$charts['requests'] = $chart->getRangeRequestsData($start, $end);			
		} elseif ($type == 'referrals_z') {
			$charts['referrals_z'] = $chart->getRangeReferralsData($start, $end);			
		} elseif ($type == 'payed') {
			$charts['payed'] = $chart->getRangeReferralsData($start, $end, 'payed');
		}

		echo json_encode(array(
			'charts' => $charts,
			'chart' => $chart
		));
		Yii::app()->end();
	}
}
