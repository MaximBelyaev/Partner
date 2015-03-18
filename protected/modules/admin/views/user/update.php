<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
    'Update',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>