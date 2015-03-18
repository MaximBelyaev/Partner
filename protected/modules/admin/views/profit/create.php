<?php
/* @var $this ProfitController */
/* @var $model Profit */

$this->breadcrumbs=array(
	'Profits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Profit', 'url'=>array('index')),
	array('label'=>'Manage Profit', 'url'=>array('admin')),
);
?>

<h1>Create Profit</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>