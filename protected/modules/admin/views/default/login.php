<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div class="login_fields">
	<div class="field">
		<?php echo $form->textField($model,'username',array('placeholder'=>'Имя пользователя')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="field">
		<?php echo $form->passwordField($model,'password',array('placeholder'=>'Пароль')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
</div>
    <div class="login_actions">
        <?php echo CHtml::submitButton('Войти',array('class'=>'btn btn-inverse login-btn')); ?>
    </div>
	<div class="remember-me">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'Запомнить'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
