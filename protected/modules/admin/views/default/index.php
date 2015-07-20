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
			<h5>Новые клиенты</h5>
		</div>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
		    'dataProvider' => $referralModel,
		    'enablePagination' => false,
			'summaryText' => '',
			'htmlOptions' => array('class'=>'index-table grid-view red'),
			'columns' => array(
				array(
					'name' => 'date',
					'header' => 'Дата',
					'value' => 'date("d.m.Y", strtotime($data->date));',
		            'htmlOptions' => array('class' => 'width110'),
		            'headerHtmlOptions' => array('class' => 'width110'),
		            'filterHtmlOptions' => array('class' => 'width110'),
				),
				array(
					'name' => 'email',
					'type' => 'email',
				),
		        array(
		            'name' => 'user',
		            'type' => 'email',
		            'header'=> 'Партнер', 
		            'value' => '((isset($data->user->username))?$data->user->username:"");',
		        ),
		        array(
		            'name' => 'status',
		            'value' => '$data->status',
            'htmlOptions' => array('class' => 'width110'),
            'headerHtmlOptions' => array('class' => 'width110'),
            'filterHtmlOptions' => array('class' => 'width110'),
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
		            'htmlOptions' => array('class' => 'width110'),
		            'headerHtmlOptions' => array('class' => 'width110'),
		            'filterHtmlOptions' => array('class' => 'width110'),
				),
		        'username',
				array(
					'name' => 'requests_count',
		            'htmlOptions' => array('class' => 'width110'),
		            'headerHtmlOptions' => array('class' => 'width110'),
		            'filterHtmlOptions' => array('class' => 'width110'),
				),
				array(
					'name' => 'referrals_payed_count',
		            'htmlOptions' => array('class' => 'width110'),
		            'headerHtmlOptions' => array('class' => 'width110'),
		            'filterHtmlOptions' => array('class' => 'width110'),
				),
		    ))); ?>
	</div>

</div>


<div class="row-fluid table-row">

	<div class="span6 block">
	
		<div class="head">
			<h5>Последние заявки</h5>
		</div>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider' => $statedsModel,
			'enablePagination' => false,
			'summaryText' => '',
			'htmlOptions' => array('class'=>'index-table grid-view orange'),
			'columns' => array(
				array(
					'name' => 'date',
					'header' => 'Дата',
					'value' => 'date("d.m.Y", strtotime($data->date));',
		            'htmlOptions' => array('class' => 'width110'),
		            'headerHtmlOptions' => array('class' => 'width110'),
		            'filterHtmlOptions' => array('class' => 'width110'),
				),
				array(
					'name' => 'user',
					'type' => 'email',
					'value' => '$data->user->username',
				),
				array(
					'name' => 'money',
		            'htmlOptions' => array('class' => 'width110'),
		            'headerHtmlOptions' => array('class' => 'width110'),
		            'filterHtmlOptions' => array('class' => 'width110'),
				),
				array(
					'name' => 'status',
					
					'htmlOptions' => array('class' => 'width155'),
					'headerHtmlOptions' => array('class' => 'width155'),
					'filterHtmlOptions' => array('class' => 'width155'),
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
			'htmlOptions' => array('class'=>'index-table grid-view green'),
		    'columns' => array(
				'username',
				array(
					'name' => 'referrals_count',
					'htmlOptions' => array('class' => 'width110'),
					'headerHtmlOptions' => array('class' => 'width110'),
					'filterHtmlOptions' => array('class' => 'width110'),
				),
				array(
					'name' => 'requests_count',
					'htmlOptions' => array('class' => 'width110'),
					'headerHtmlOptions' => array('class' => 'width110'),
					'filterHtmlOptions' => array('class' => 'width110'),
				),
				array(
					'name' => 'month_profit',
					'htmlOptions' => array('class' => 'width110'),
					'headerHtmlOptions' => array('class' => 'width110'),
					'filterHtmlOptions' => array('class' => 'width110'),
				),
			))); ?>

	</div>

</div>