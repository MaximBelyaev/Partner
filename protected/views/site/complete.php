<?php
/* @var $this ReferralsController */
/* @var $model Referrals */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'referrals-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150, 'placeholder'=>'vasja@gmail.com')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'site'); ?>
        <?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>150, 'placeholder'=>'mysite.com')); ?>
        <?php echo $form->error($model,'site'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'region'); ?>
        <?php echo $form->textField($model,'region',array('size'=>60,'maxlength'=>150, 'placeholder'=>'СНГ либо другой нужный город')); ?>
        <?php echo $form->error($model,'region'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'tz'); ?>
        <?php echo $form->dropDownList($model,'tz', array(1=>'Да', 2=>'Нет'), array('empty'=>'Выберите нужное')); ?>
        <?php echo $form->error($model,'tz'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'request_type'); ?>
        <?php echo $form->dropDownList($model,'request_type', array('Коммерческие'=>'Коммерческие', 'Информационные'=>'Информационные', 'Оба'=>'Оба'),array('placeholder'=>'')); ?>
        <?php echo $form->error($model,'request_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'requests'); ?>
        <?php echo $form->textField($model,'requests',array('size'=>60,'maxlength'=>255, 'placeholder'=>'Купить фотоапарат в москве')); ?>
        <?php echo $form->error($model,'requests'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'user_from'); ?>
        <?php echo $form->textField($model,'user_from',array('size'=>60,'maxlength'=>255, 'placeholder'=>'Яndex Директ, рекомендации')); ?>
        <?php echo $form->error($model,'user_from'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Вывести' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->