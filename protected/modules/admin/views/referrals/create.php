<?php
/* @var $this ReferralsController */
/* @var $model Referrals */

$this->breadcrumbs=array(
	'Клиенты'=>array('index'),
	'Добавление',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>