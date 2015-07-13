<?php
/* @var $this AdvertisingController */
/* @var $model Advertising */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertising-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<div class="head">
		<h5><?php echo $model->isNewRecord ? 'Добавление рекламных материалов' : 'Редактирование рекламных материалов: '.$model->banner_name; ?></h5>
		<div class="button_save">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
		</div>
		<div class="button_save">
			<?php echo CHtml::link('<i class="icon-step-backward"></i> Вернуться',array('/admin/advertising/index'), array('class'=>'btn btn-success',)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<!---- Flash message ---->
	<?php $this->beginWidget('FlashWidget',array(
		'params'=>array(
			'model' => $model,
			'form' => $form,
		)));
	$this->endWidget(); ?>
	<!---- End Flash message ---->

	<div class="clear"></div>

	<div class="row">
		<?php echo $form->labelEx($model,'banner_name'); ?>
		<?php echo $form->textField($model,'banner_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'banner_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'banner_code'); ?>
		<?php echo $form->textArea($model,'banner_code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'banner_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->