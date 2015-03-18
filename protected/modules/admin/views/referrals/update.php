<?php
/* @var $this ReferralsController */
/* @var $model Referrals */

$this->breadcrumbs=array(
	'Клиенты'=>array('index'),
	'Редактирование клиента: '.$model->email,
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>