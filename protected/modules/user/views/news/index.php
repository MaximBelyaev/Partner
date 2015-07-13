<?php 
$this->setPageTitle("Новости | Партнерская программа Павлуцкого Александра"); 
?>

<div class="block">
	
	<div class="">
		<h5>Новости</h5>
	</div>
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->userSearch(),
	'summaryText' => '',
	'columns' => array(
		'date',
		'header',
		array(
			'header'=>'Статус',
			'value' => '$data->getIsViewed()'
		),
		array(
			'header'=>'',
			'type' => 'html',
			'value' => 'CHtml::link("Посмотреть", array("/user/news/view", "id"=>$data->news_id)) '
		),
	))); ?>

</div>