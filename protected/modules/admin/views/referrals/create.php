<?php
/* @var $this ReferralsController */
/* @var $model Referrals */

$this->breadcrumbs = array(
	'Клиенты' => array('index'),
	'Добавление',
);
$this->setPageTitle("Добавление клиента | Партнерская программа Павлуцкого Александра");
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>