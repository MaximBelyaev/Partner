<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'landings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<div class="head">
		<h5>
			<?php echo $model->isNewRecord ? 'Добавление лендинга' : 'Редактирование лендинга: '. $model->link; ?>
		</h5>
		<div class="button_save">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
		</div>
		<div class="button_save">
			<?php echo CHtml::link('<i class="icon-step-backward"></i> Вернуться',array('/admin/user/index'), array('class'=>'btn btn-success',)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="clear"></div>

	<div class="row">
		<?php echo $form->labelEx( $model,'name' ); ?>
		<?php echo $form->textField( $model,'name',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField( $model,'link',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
		<?php echo $form->error( $model,'link' ); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon'); ?>
		<?php echo $form->fileField($model,'icon'); ?>
		<?php echo $form->error($model,'icon'); ?>
		<?php if($model->icon) { 
			echo CHtml::image("/uploads/" . $model->icon, $model->name, array("class"=>"land_icon"));
		} ?>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->