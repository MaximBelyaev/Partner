<?php
/* @var $this BannersController */
/* @var $model Banners */

$this->breadcrumbs=array(
	'Баннеры'=>array('index'),
	'Добавить',
);

$this->setPageTitle("Добавление баннера | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>