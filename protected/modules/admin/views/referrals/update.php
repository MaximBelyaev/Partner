<?php
/* @var $this ReferralsController */
/* @var $model Referrals */

$this->breadcrumbs=array(
	'Клиенты'=>array('index'),
	'Редактирование клиента: '.$model->email,
);
$this->setPageTitle("Редактирование клиента | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>