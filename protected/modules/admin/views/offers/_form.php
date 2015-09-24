<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>


<div class="block full-page-block">

    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'offers-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>true,
            'htmlOptions'=>array('enctype'=>'multipart/form-data')
        )); ?>

        <div class="head">
            <h5>
                <?php echo $model->isNewRecord ? 'Добавление оффера' : 'Редактирование оффера: '. $model->name; ?>
            </h5>
        </div>


        <div class="form-block">

            <div class="row-fluid form-row">
                <div class="span6">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField( $model,'name',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                    <?php echo $form->error( $model,'name' ); ?>
                </div>
            </div>

            <div class="row-fluid form-row">
                <div class="span6">
                    <?php echo $form->labelEx($model,'percent'); ?>
                    <?php echo $form->textField( $model,'percent',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                    <?php echo $form->error( $model,'percent' ); ?>
                </div>
            </div>

            <div class="row-fluid form-row">
                <div class="span6">
                    <?php echo $form->labelEx($model,'fixed_pay'); ?>
                    <?php echo $form->textField( $model,'fixed_pay',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                    <?php echo $form->error( $model,'fixed_pay' ); ?>
                </div>
            </div>

            <div class="row-fluid form-row">
                <div class="span6">
                    <?php echo $form->labelEx($model,'click_pay'); ?>
                    <?php echo $form->textField( $model,'click_pay',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                    <?php echo $form->error( $model,'click_pay' ); ?>
                </div>
            </div>

            <div class="underlist-button">
                <div class="span6">
                    <?php echo CHtml::submitButton(
                        $model->isNewRecord ? 'Добавить' : 'Сохранить',
                        array('class'=>'btn btn-success'
                        )); ?>
                </div>
                <div class="clear"></div>
            </div>

        </div>


        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>