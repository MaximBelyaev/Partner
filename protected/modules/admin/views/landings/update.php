<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
    'Update',
);
$this->setPageTitle("Редактирование лендинга | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>