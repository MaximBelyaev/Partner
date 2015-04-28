<?php
/* @var $this AdvertisingController */
/* @var $model Advertising */

$this->breadcrumbs=array(
	'Рекламные материалы'=>array('index'),
	$model->id,
);
$this->setPageTitle("Рекламные материалы | Партнерская программа Павлуцкого Александра");
?>

<div class="head">
	<h5>Информация о рекламном материале "<?php echo $model->banner_name; ?>"</h5>

	<div class="button_save">
		<?php /*CHtml::link('<i class="icon-plus"></i> Добавить', "/admin/advertising/create", array('class' => 'btn btn-default')) */?>
	</div>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'video_link',
		'banner_name',
		'banner_code',
		'type',
		'height',
		'width',
		'image',
	),
)); ?>
