<?php  
$this->breadcrumbs=array(
	'Настройки',
);
$this->setPageTitle("Настройки | Партнерская программа Павлуцкого Александра");
?>

<div class="head">
	<h5>Настройки</h5>
	<div class="button_save">
		<?php /*echo CHtml::link('<i class="icon-plus"></i> Добавить',array('/admin/user/create'), array('class'=>'btn btn-success',)); */?>
	</div>
</div>


<div class="form">


	<?php echo CHtml::beginForm(); ?>

	<!---- Flash message ---->
	<?php $this->beginWidget('FlashWidget',array(
		'params'=>array(
			'model' => $model,
		)));
	$this->endWidget(); ?>
	<!---- End Flash message ---->

	<div class="clear"></div>

	<?php foreach ($model as $key => $value) { ?>
	<div class="setting">
		<p><?= $value->header ?></p>
		<?php echo CHtml::activeTextArea($value,"[$key]value", array('rows'=>2)); ?>
	</div>

	<?php } ?>

	<div class="button_save_settings">
		<?php echo CHtml::submitButton('Сохранить', array('class'=>'btn btn-success')); ?>
	</div>
	<?php echo CHtml::endForm(); ?>

</div><!-- form -->