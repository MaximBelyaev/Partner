<?php 
$this->setPageTitle("Новости | Партнерская программа Павлуцкого Александра"); 
?>

<div class="block full-page-block">
		

    <div class="head">
		<h5>Новости</h5>
    </div>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'user-grid',
		'htmlOptions' => array('class' => 'darkblue'),
		'dataProvider' => $model->userSearch(),
		'summaryText' => '',
		'columns' => array(
			array(
				'name' => 'date',
				'value' => 'date("d.m.y", strtotime($data->date));',
			),
		            
			'header',
			array(
				'header'=>'Статус',
				'value' => '$data->getIsViewed()'
			),
			array(
				'header'=>'Действие',
				'type' => 'html',
				'value' => 'CHtml::link("Посмотреть", array("/user/news/view", "id"=>$data->news_id)) '
			),
		),
		'pager'=> array(  
			'header'        => '',
			'prevPageLabel' => 'Назад',
			'nextPageLabel' => 'Далее',    
		)
	)); ?>

</div>