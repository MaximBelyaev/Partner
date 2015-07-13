<?php
/* @var $this PromovideoController */
/* @var $model Promovideo */

$this->breadcrumbs=array(
	'Promovideos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Promovideo', 'url'=>array('index')),
	array('label'=>'Create Promovideo', 'url'=>array('create')),
	array('label'=>'Update Promovideo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Promovideo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Promovideo', 'url'=>array('admin')),
);
?>

<h1>View Promovideo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'link',
	),
)); ?>
