<?php
/* @var $this PromovideoController */
/* @var $model Promovideo */

$this->breadcrumbs=array(
	'Promovideos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Promovideo', 'url'=>array('index')),
	array('label'=>'Manage Promovideo', 'url'=>array('admin')),
);
?>

<h1>Create Promovideo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>