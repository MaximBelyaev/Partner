<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <div class="head">
        <h5><?php echo $model->isNewRecord ? 'Добавление партнера' : 'Редактирование партнера: '.$model->username; ?></h5>
        <div class="button_save">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> Вернуться',array('/admin/user/index'), array('class'=>'btn btn-success',)); ?>
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
		<?php echo $form->labelEx($model,'role'); ?>
        <?php echo $form->dropDownList($model,'role', array('user'=>'user', 'admin'=>'admin')); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array('VIP'=>'VIP', 'Стандартный'=>'Стандартный', 'Расширенный'=>'Расширенный')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'use_click_pay'); ?>
		<?php echo $form->dropDownList($model,'use_click_pay', array('0'=>'Процент за заказ','1'=>'Оплата за переход')); ?>
		<?php echo $form->error($model,'use_click_pay'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'money[profit]'); ?>
		<?php echo $form->textField($model,'money[profit]',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'money[profit]'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>50,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row" id="hidden" style="display:none">
		<?php echo $form->labelEx($model,'click_pay'); ?>
		<?php echo $form->textField($model,'click_pay', array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'click_pay'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	$(function() {
		$('#User_use_click_pay').change(function(){
			if ($(this).val() == "1") {
				$("#hidden").show();
			} else {
				$("#hidden").hide();
			}
		});
	});
</script>