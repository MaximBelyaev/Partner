<?php
/* @var $this PromovideoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Promovideos',
);

$this->menu=array(
	array('label'=>'Create Promovideo', 'url'=>array('create')),
	array('label'=>'Manage Promovideo', 'url'=>array('admin')),
);
?>

<h1>Promovideos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
