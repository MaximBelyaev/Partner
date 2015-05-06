<?php
/* @var $this StatedsController */
/* @var $model Stateds */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stateds-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <div class="head">
        <h5><?php echo $model->isNewRecord ? 'Добавление заявки' : 'Редактирование заявки: '.$model->id; ?></h5>
        <div class="button_save">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> Вернуться',array('/admin/stateds/index'), array('class'=>'btn btn-default',)); ?>
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
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->textField($model,'user_id'); ?>
        <?php echo $form->error($model,'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'money'); ?>
        <?php echo $form->textField($model,'money',array('size'=>8,'maxlength'=>8)); ?>
        <?php echo $form->error($model,'money'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pay_type'); ?>
        <?php echo $form->dropDownList($model,'pay_type',array('WebMoney'=>'WebMoney','Яndex деньги'=>'Яndex деньги')); ?>
        <?php echo $form->error($model,'pay_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'requisites'); ?>
        <?php echo $form->textField($model,'requisites',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'requisites'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', array('Ожидает оплату'=>'Ожидает оплату', 'Оплачено'=>'Оплачено', 'Отказано в оплате'=>'Отказано в оплате')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'recreate_interval'); ?>
        <?php echo CHtml::activeCheckBox($model,'recreate_interval'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->