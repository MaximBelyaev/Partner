<?php
/* @var $this OffersController */
/* @var $model Offers */

$this->breadcrumbs=array(
    'Офферы'=>array('index'),
    'Редактировать',
);
$this->setPageTitle("Редактирование оффера | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>