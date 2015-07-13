<?php
/* @var $this AdvertisingController */
/* @var $model Advertising */

$this->breadcrumbs=array(
	'Рекламные материалы'=>array('index'),
	'Создать',
);

$this->setPageTitle("Добавление рекламного материала | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>