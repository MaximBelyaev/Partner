<?php
/* @var $this BannersController */
/* @var $model Banners */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promobanns-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
)); ?>

	<div class="head">
		<h5><?php echo $model->isNewRecord ? 'Добавление баннера' : 'Редактирование баннера: '.$model->name; ?></h5>
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
			'model' => $model,
			'form' => $form,
		)));
	$this->endWidget(); ?>
	<!---- End Flash message ---->

	<div class="clear"></div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', $typesList); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model, 'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'video_link'); ?>
		<?php echo $form->textField($model, 'video_link'); ?>
		<?php echo $form->error($model,'video_link'); ?>
	</div>

	<?php if($model->isNewRecord!='1'){ ?>
	<div class="row">
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image,"image",array("width"=>200)); }?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

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

