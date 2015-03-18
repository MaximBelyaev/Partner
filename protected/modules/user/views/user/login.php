<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>
<div class="form-box" id="login-box">
    <div class="header">Вход</div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="body bg-gray">
        <div class="form-group">
            <?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=>'Email')); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'Пароль')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>

        <!--<div class="form-group">
            <?php /*echo $form->checkBox($model,'rememberMe'); */?>
            <?php /*/*echo $form->label($model,'rememberMe'); */?>
            <?php /*/*echo $form->error($model,'rememberMe'); */?>
        </div>-->

        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Войти</button>

            <?= CHtml::link('Зарегистрироваться как партнер', array('/user/user/registration'), array('class'=>'text-center')) ?>
            <?= CHtml::link('Забыли пароль?', array('/user/user/foget'), array('class'=>'text-center')) ?>

        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>