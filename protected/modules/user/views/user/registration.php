<?php
/* @var $this SiteController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<div class="form-box" id="login-box">
    <div class="header">Зарегистрироваться</div>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'registration-form',
            'enableClientValidation'=>true,
            'enableAjaxValidation' => true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

        <div class="body bg-gray">
            <div class="form-group">
                <?php echo $form->textField($model,'username', array('placeholder'=>'Email', 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->passwordField($model,'password', array('placeholder'=>'Придумайте пароль', 'class'=>'form-control')); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>
        </div>
        <div class="footer">

            <button type="submit" class="btn bg-olive btn-block">Зарегистрироваться</button>

            <?= CHtml::link('Я уже зарегистрирован. Войти', array('/user/user/login'), array('class'=>'text-center')) ?>
        </div>
    <?php $this->endWidget(); ?>

</div>