<?php
/* @var $this PromovideoController */
/* @var $model Promovideo */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'promovideo-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
		),
	)); ?>

	<div class="head">
		<h5><?php echo $model->isNewRecord ? 'Добавление рекламного видео' : 'Редактирование рекламного видео: '.$model->name; ?></h5>
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
			'model' => $videoModel,
			'form' => $form,
		)));
	$this->endWidget(); ?>
	<!---- End Flash message ---->

	<div class="clear"></div>

	<div class="row">
		<?php echo $form->labelEx($videoModel,'link'); ?>
		<?php echo $form->textField($videoModel, 'link'); ?>
		<?php echo $form->error($videoModel,'link'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->
