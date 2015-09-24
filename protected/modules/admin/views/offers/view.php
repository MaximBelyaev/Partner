<?php
/* @var $this OffersController */
/* @var $model Offers */

$this->breadcrumbs=array(
	'Offers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Offers', 'url'=>array('index')),
	array('label'=>'Create Offers', 'url'=>array('create')),
	array('label'=>'Update Offers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Offers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Offers', 'url'=>array('admin')),
);
?>

<h1>View Offers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'percent',
		'fixed_pay',
		'click_pay',
	),
)); ?>
