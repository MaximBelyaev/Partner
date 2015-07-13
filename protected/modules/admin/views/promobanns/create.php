<?php
/* @var $this BannersController */
/* @var $model Banners */

$this->breadcrumbs=array(
	'Баннеры'=>array('index'),
	'Добавить',
);

$this->setPageTitle("Добавление баннера | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'typesList'=>$typesList)); ?>
<?php $this->renderPartial('/promovideo/_form', array('model'=>$videoModel)); ?>