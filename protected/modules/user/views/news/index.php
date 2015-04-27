<?php 
$this->setPageTitle("Новости | Партнерская программа Павлуцкого Александра"); 
?>
<div class="commercial  small-box bg-aqua">
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->userSearch(),
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