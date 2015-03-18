<?php
/* @var $this StatedsController */
/* @var $model Stateds */

$this->breadcrumbs=array(
	'Заявки на вывод средств',
	'Редактирование заявки'.$model->id,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>