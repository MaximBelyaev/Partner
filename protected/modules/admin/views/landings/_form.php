<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>


<div class="block">
	
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'landings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<div class="head">
		<h5>
			<?php echo $model->isNewRecord ? 'Добавление лендинга' : 'Редактирование лендинга: '. $model->link; ?>
		</h5>
		<div class="underlist-button underlist-button-inline">
			<?php echo CHtml::link('Вернуться',array('/admin/default/index'), array('class'=>'btn',)); ?>
		</div>
		<div class="underlist-button underlist-button-inline">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-success')); ?>
		</div>
	</div>

	
	<div class="form-block">

		<div class="row-fluid form-row">
			<div class="span6">
				<?php echo $form->labelEx( $model,'name' ); ?>
				<?php echo $form->textField( $model,'name',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
		</div>

		<div class="row-fluid form-row">
			<div class="span6">
				<?php echo $form->labelEx($model,'link'); ?>
				<?php echo $form->textField( $model,'link',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
				<?php echo $form->error( $model,'link' ); ?>
			</div>
		</div>

        <div class="row-fluid form-row">
            <div class="span6">
                <?php echo $form->labelEx($model,'click_pay'); ?>
                <?php echo $form->textField( $model,'click_pay',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                <?php echo $form->error( $model,'click_pay' ); ?>
            </div>
        </div>

        <div class="row-fluid form-row">
            <div class="span6">
                <?php echo $form->labelEx($model,'vip'); ?>
                <?php echo $form->textField( $model,'vip',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                <?php echo $form->error( $model,'vip' ); ?>
            </div>
        </div>

        <div class="row-fluid form-row">
            <div class="span6">
                <?php echo $form->labelEx($model,'extended'); ?>
                <?php echo $form->textField( $model,'extended',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                <?php echo $form->error( $model,'extended' ); ?>
            </div>
        </div>

        <div class="row-fluid form-row">
            <div class="span6">
                <?php echo $form->labelEx($model,'standard'); ?>
                <?php echo $form->textField( $model,'standard',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                <?php echo $form->error( $model,'standard' ); ?>
            </div>
        </div>

		<div class="row-fluid form-row">
			<div class="span6">
				<?php echo $form->labelEx($model,'icon'); ?>
				<?php echo $form->fileField($model,'icon', array('data-header'=>'Выберите файл')); ?>
				<?php echo $form->error($model,'icon'); ?>
				<?php if($model->icon) { 
					echo CHtml::image("/uploads/" . $model->icon, $model->name, array("class"=>"land_icon"));
				} ?>
			</div>	
		</div>

	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->


</div>