<?php
/* @var $this ProfitController */
/* @var $model Profit */

$this->breadcrumbs=array(
	'Profits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Profit', 'url'=>array('index')),
	array('label'=>'Create Profit', 'url'=>array('create')),
	array('label'=>'View Profit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Profit', 'url'=>array('admin')),
);
?>

<h1>Update Profit <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>