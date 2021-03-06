<?php
/* @var $this SiteController */
/* @var $model User */
/* @var $form CActiveForm */
$this->setPageTitle("Восстановление пароля | Партнерская программа Павлуцкого Александра");
?>
<div class="form-box" id="login-box">
    <div class="header">Восстановить пароль</div>
    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="info successMessage">' . $message . "</div>\n";
    }
    ?>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'forget-form',
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
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Отправить пароль на e-mail</button>
        </div>
    <?php $this->endWidget(); ?>

</div>