<?php
/* @var $this StatedsController */
/* @var $model Stateds */

$this->breadcrumbs=array(
	'Заявки на вывод средств',
	'Редактирование заявки '.$model->id,
);
$this->setPageTitle("Заявка от {$model->user->username} | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>