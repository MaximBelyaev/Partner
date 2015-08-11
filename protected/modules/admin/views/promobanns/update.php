<?php
/* @var $this BannersController */
/* @var $model Banners */

$this->breadcrumbs=array(
	'Баннеры'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Обновить',
);

$this->setPageTitle("Редактирование баннера | Партнерская программа Павлуцкого Александра");
?>

<div class="block full-page-block">
	<?php $this->renderPartial('_form', array('model'=>$model, 'typesList'=>$typesList)); ?>
	<?php $this->renderPartial('/promovideo/_form', array('videoModel'=>$videoModel)); ?>
</div>