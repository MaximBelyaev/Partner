<?php
/* @var $this StatedsController */
/* @var $model Stateds */

$this->breadcrumbs=array(
	'Заявки на вывод средств'=>array('index'),
	'Добавление',
);
$this->setPageTitle("Добавление заявки | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>