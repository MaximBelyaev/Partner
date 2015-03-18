<?php
/* @var $this ProfitController */
/* @var $model Profit */

$this->breadcrumbs=array(
	'Profits'=>array('index'),
	'Manage',
);
?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'profit',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
