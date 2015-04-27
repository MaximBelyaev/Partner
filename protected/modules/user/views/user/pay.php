<?php
/* @var $this StatedsController */
/* @var $model Stateds */
/* @var $form CActiveForm */
$this->setPageTitle("Вывод средств | Партнерская программа Павлуцкого Александра");
?>

<div class="small-box bg-green">
    <div class="inner">
        <h3>
            Вывод средств:
        </h3>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'stateds-form',
            'htmlOptions'=>array('class'=>'pay'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
        )); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'money'); ?>
            <?php echo $form->textField($model,'money',array('class'=>'form-control','maxlength'=>8)); ?>
            <?php echo $form->error($model,'money'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'pay_type'); ?>
            <?php echo $form->dropDownList($model,'pay_type',array('WebMoney'=>'WebMoney (рубли)','Яndex деньги'=>'Яndex деньги'), array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'pay_type'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'requisites'); ?>
            <?php echo $form->textField($model,'requisites',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'requisites'); ?>
        </div>

        <div class="row textAreaClass">
            <?php echo $form->labelEx($model,'description'); ?>
            <?php echo $form->textArea($model,'description',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'description'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Вывести' : 'Save', array('class'=>'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->