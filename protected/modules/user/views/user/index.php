<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="small-box bg-green">
    <div class="inner">
		<h3>
			Ваша статистика:
		</h3>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'user-grid',
        'dataProvider'=>$dataProvider,
        'columns' => array(
			'date',
			array(
				'name'  => 'Переходы',
				'value' => 'count($data->user->getDayRequests($data->date))',
			),
			array(
				'name'  => 'Заявка',
				'value' => 'count($data->getThisDayRefferals())',
	        ),
	        array(
	        	'name' => "Оплачено",
	        	"value" => 'count($data->getPayedReferrals())',
	        ),
	        array(
	        	'name' => "Сайт",
	        	"value" => 'array_reduce(
	        		$data->getPayedReferrals(), 
	        		function($c,$v){ return ($c ." ". $v->site); }
	        	)', 
	        ),
	        array(
	        	'name' => "Прибыль",
	        	"value" => '$data->getDailyProfit()',
	        )
        ),
        'pager'=>array(
            'class'=>'CLinkPager',
        ),
    )); ?>
    <?php 
    if ($show_all_button) {
    	echo CHtml::link('Все месяцы', array('user/index', 'all' => true ), array('id' => 'month_button'));
    } else {
		echo CHtml::link('Последний месяц', array('user/index'), array('id' => 'month_button'));
    } 
    ?>

        <div class="tableClients">
        <div class="head">
            <div class="date">Дата</div>
            <div class="referrers_count">Кол-во переходов</div>
            <div class="check_count">Заявка</div>
            <div class="check_users">Оплачено</div>
            <div class="referrers_site">Сайт оплатившего</div>
            <div class="percent">Прибыль</div>
        </div>

        <?php foreach($statistic as $data): ?>
            <?php $this->renderPartial('_referrals', array('data'=>$data)); ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>


