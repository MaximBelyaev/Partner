<?php
/**
 * @var $this defaultController
 */

$this->breadcrumbs=array(
    'Общая информация',
);
$this->setPageTitle("Главное меню | Партнерская программа Павлуцкого Александра");
?>

<div class="row-fluid table-row">

	<div class="span6 block">

		<div class="head">
			<h5>Новые заявки</h5>
		</div>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
		    'dataProvider' => $referralModel,
		    'enablePagination' => false,
			'summaryText' => '',
			'htmlOptions' => array('class'=>'index-table grid-view green'),
			'columns' => array(
				array(
					'name' => 'date',
					'header' => 'Дата',
					'value' => 'date("d.m.y", strtotime($data->date));',
		            'htmlOptions' => array('class' => 'width105'),
		            'headerHtmlOptions' => array('class' => 'width105'),
		            'filterHtmlOptions' => array('class' => 'width105'),
				),
				'email',
				array(
		            'name' => 'user',
		            'header'=> 'Партнер', 
		            'value' => '((isset($data->user->username))?$data->user->username:"");',
		        )
		    ))); ?>

	</div>

	<div class="span6 block">
		
		<div class="head">
			<h5>Новые партнёры</h5>
		</div>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
		    'dataProvider' => $userModel,
		    'enablePagination' => false,
			'summaryText' => '',
			'htmlOptions' => array('class'=>'index-table grid-view'),
		    'columns' => array(
				array(
					'name' => 'reg_date',
					'header' => 'Дата',
					'value' => 'date("d.m.y", strtotime($data->reg_date));',
					'htmlOptions' => array('class' => 'width105'),
					'headerHtmlOptions' => array('class' => 'width105'),
					'filterHtmlOptions' => array('class' => 'width105'),
				),
		        'username',
				array(
					'name' => 'requests_count',
					'htmlOptions' => array('class' => 'width100'),
					'headerHtmlOptions' => array('class' => 'width100'),
					'filterHtmlOptions' => array('class' => 'width100'),
				),
				array(
					'name' => 'referrals_payed_count',
					'htmlOptions' => array('class' => 'width80'),
					'headerHtmlOptions' => array('class' => 'width80'),
					'filterHtmlOptions' => array('class' => 'width80'),
				),
		    ))); ?>
	</div>

</div>


<div class="row-fluid table-row">

	<div class="span6 block">
	
		<div class="head">
			<h5>Заявки на вывод</h5>
		</div>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider' => $statedsModel,
			'enablePagination' => false,
			'summaryText' => '',
			'htmlOptions' => array('class'=>'index-table grid-view red'),
			'columns' => array(
				array(
					'name' => 'date',
					'header' => 'Дата',
					'value' => 'date("d.m.y", strtotime($data->date));',
					'htmlOptions' => array('class' => 'width105'),
					'headerHtmlOptions' => array('class' => 'width105'),
					'filterHtmlOptions' => array('class' => 'width105'),
				),
				array(
					'name' => 'user',
					'value' => '$data->user->username',
				),
				array(
					'header' => 'Счет',
					'name' => 'money',
					'htmlOptions' => array('class' => 'width65'),
					'headerHtmlOptions' => array('class' => 'width65'),
					'filterHtmlOptions' => array('class' => 'width65'),
				),
				array(
					'name' => 'status',
					'htmlOptions' => array('class' => 'width160'),
					'headerHtmlOptions' => array('class' => 'width160'),
					'filterHtmlOptions' => array('class' => 'width160'),
				),

			))); ?>
	
	</div>

	<div class="span6 block">
		
		<div class="head">
			<h5>Лучшие партнёры за 30 дней</h5>
		</div>
		
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider' => $bestPartnersModel,
			'enablePagination' => false,
			'summaryText' => '',
			'htmlOptions' => array('class'=>'index-table grid-view orange'),
		    'columns' => array(
				'username',
				array(
					'name' => 'referrals_count',
					'htmlOptions' => array('class' => 'width80'),
					'headerHtmlOptions' => array('class' => 'width80'),
					'filterHtmlOptions' => array('class' => 'width80'),
				),
				array(
					'name' => 'requests_count',
					'htmlOptions' => array('class' => 'width100'),
					'headerHtmlOptions' => array('class' => 'width100'),
					'filterHtmlOptions' => array('class' => 'width100'),
				),
				array(
					'name' => 'month_profit',
					'htmlOptions' => array('class' => 'width100'),
					'headerHtmlOptions' => array('class' => 'width100'),
					'filterHtmlOptions' => array('class' => 'width100'),
				),
			))); ?>

	</div>

</div>