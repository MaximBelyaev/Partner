<?php
/* @var $this AdvertisingController */
/* @var $model Advertising */

$this->breadcrumbs=array(
	'Рекламные материалы'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Редактирование',
);
$this->setPageTitle("Редактирование рекламных материалов | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>