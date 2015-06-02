<?php
/* @var $this PromovideoController */
/* @var $model Promovideo */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'promovideo-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
		),
	)); ?>

	<div class="head">
		<h5><?php echo 'Добавление рекламного видео' ?></h5>
		<div class="button_save">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
		</div>
		<div class="button_save">
			<?php echo CHtml::link('<i class="icon-step-backward"></i> Вернуться',array('/admin/promobanns/index'), array('class'=>'btn btn-success',)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<!---- Flash message ---->
	<?php $this->beginWidget('FlashWidget',array(
		'params'=>array(
			'form' => $form,
			'model'=>$model
		)));
	$this->endWidget(); ?>
	<!---- End Flash message ---->

	<div class="clear"></div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model, 'link'); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->
