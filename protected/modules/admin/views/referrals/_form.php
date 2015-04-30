
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
	'enableAjaxValidation'=>true,
)); ?>

    <div class="head">
        <h5><?php echo $model->isNewRecord ? 'Добавление лиента' : 'Редактирование клиента: '.$model->email; ?></h5>
        <div class="button_save">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
        </div>
        <div class="button_save">
            <?php echo CHtml::link('<i class="icon-step-backward"></i> Вернуться',array('/admin/referrals/index'), array('class'=>'btn btn-default',)); ?>
        </div>
        <div class="clear"></div>
    </div>

	<div class="row">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<label for="Referrals_user_id">Привязать к партнеру</label>
        <?php
            $users  = CHtml::listData(User::model()->findAll(array('order'=>'username')), 'id','username');
            $result = array_merge(array('promo'=>'Промо код'), $users);
            echo $form->dropDownList($model,'user_id', $users, array('prompt'=>'- - - без партнера - - -')); ?>
		<?php echo $form->error($model,'user_id'); ?>

        <?php echo $form->labelEx($model,'promo'); ?>
        <?php echo $form->textField($model,'promo', array('placeholder'=>'Если нет - оставить пустым')); ?>
        <?php echo $form->error($model,'promo'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'money'); ?>
		<?php echo $form->textField($model,'money',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'money'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'site'); ?>
        <?php echo $form->textField($model,'site'); ?>
        <?php echo $form->error($model,'site'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array( 'Заявка' => 'Заявка', 'Оплачено' => 'Оплачено' )); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->