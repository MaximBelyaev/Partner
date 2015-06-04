<?php
/* @var $this PromovideoController */
/* @var $model Promovideo */

$this->breadcrumbs=array(
	'Promovideos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Promovideo', 'url'=>array('index')),
	array('label'=>'Create Promovideo', 'url'=>array('create')),
	array('label'=>'View Promovideo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Promovideo', 'url'=>array('admin')),
);
?>

<h1>Update Promovideo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>