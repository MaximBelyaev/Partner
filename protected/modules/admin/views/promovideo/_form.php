<?php
/* @var $this PromovideoController */
/* @var $model Promovideo */
/* @var $form CActiveForm */
?>

<div class="block">
	

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
		<div class="underlist-button underlist-button-inline">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="row-fluid">
	<!---- Flash message ---->
	<?php $this->beginWidget('FlashWidget',array(
		'params'=>array(
			'form' => $form,
			'model'=>$model
		)));
	$this->endWidget(); ?>
	<!---- End Flash message ---->
	</div>

	<div class="clear"></div>
	

	<div class="row-fluid">
		<div class="span6">
			<div class="form-row">
				<?php echo $form->labelEx($model,'link'); ?>
				<?php echo $form->textField($model, 'link'); ?>
				<?php echo $form->error($model,'link'); ?>
			</div>
		</div>
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
