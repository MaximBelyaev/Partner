<?php
/* @var $this BannersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Рекламные материалы',
);

$this->menu=array(
	array('label'=>'Create Banners', 'url'=>array('create')),
	array('label'=>'Manage Banners', 'url'=>array('admin')),
);
?>
<div class="head">
	<h5>Рекламные материалы</h5>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'name',
		'type',
		array(
			'name' => 'image',
			'value' => '$data->image ? CHtml::image("/uploads/" . $data->image, $data->name, array("style"=>"width: 100px; height: 100px;")) : ""',
			'type' => 'html',
		),
		'height',
		'width',
		'video_link'
	),
));