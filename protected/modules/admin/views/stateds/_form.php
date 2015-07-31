<?php
/* @var $this StatedsController */
/* @var $model Stateds */
/* @var $form CActiveForm */
?>

<div class="block full-page-block">
    
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
        <h5>
            <?php echo $model->isNewRecord ? 'Добавление заявки' : 'Редактирование заявки от: ' . $model->user->username; ?>
            <?php echo CHtml::link('Вернуться',array('/admin/stateds/index'), array('class'=>'btn btn-primary',)); ?>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
        </h5>
        <div class="clear"></div>
    </div>

    <div class="row-fluid">
    <!---- Flash message ---->
    <?php $this->beginWidget('FlashWidget',array(
        'params'=>array(
            'model' => $model,
            'form' => $form,
        )));
    $this->endWidget(); ?>
    <!---- End Flash message ---->
    </div>

    <div class="clear"></div>

    <div class="row-fluid">
        <div class="span4">

	        <div class="form-row">
	            <?php echo $form->labelEx($model,'money'); ?>
	            <?php echo $form->textField($model,'money',array('size'=>8,'maxlength'=>8)); ?>
	            <?php echo $form->error($model,'money'); ?>
	        </div>

	        <div class="form-row">
	            <?php echo $form->labelEx($model,'pay_type'); ?>
	            <?php echo $form->dropDownList($model,'pay_type',array('WebMoney'=>'WebMoney','Яndex деньги'=>'Яndex деньги')); ?>
	            <?php echo $form->error($model,'pay_type'); ?>
	        </div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'requisites'); ?>
				<?php echo $form->textField($model,'requisites',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'requisites'); ?>
			</div>
		
		</div>
        
        <div class="span4 offset1">

            <div class="form-row">
                <?php echo $form->labelEx($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'description'); ?>
            </div>

            <div class="form-row">
                <?php echo $form->labelEx($model,'status'); ?>
                <?php echo $form->dropDownList($model,'status', array('Ожидает оплату'=>'Ожидает оплату', 'Оплачено'=>'Оплачено', 'Отказано в оплате'=>'Отказано в оплате')); ?>
                <?php echo $form->error($model,'status'); ?>
            </div>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>