<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>


<div class="block full-page-block">
	
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
			<?php echo $model->isNewRecord ? 'Добавление лендинга' : 'Редактирование лендинга: '. $model->name; ?>
		</h5>
	</div>

	
	<div class="form-block">

		<div class="row-fluid form-row">
			<div class="span6">
				<label for="Landings_name">Название (кратко)</label>
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
            <div class="checkbox-wrap">
                <?php echo $form->checkBox($model,'use_click_pay', array('id' => 'clickpay_checker')); ?>
                <label for="clickpay_checker" class="checkbox-label"></label>
                <label class="required inline-block" for="clickpay_checker">
                    Использовать оплату за клик
                </label>
            </div>
        </div>

        <div class="row-fluid form-row" style="display: none;" id="hidden_clickpay">
            <div class="span6">
                <?php echo $form->labelEx($model,'click_pay'); ?>
                <?php echo $form->textField( $model,'click_pay',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                <?php echo $form->error( $model,'click_pay' ); ?>
            </div>
        </div>

        <div class="row-fluid form-row">
            <div class="checkbox-wrap">
                <?php echo CHtml::activeCheckBox($model,'use_fixed_pay', array('id' => 'fixedpay_checker')); ?>
                <label for="fixedpay_checker" class="checkbox-label"></label>
                <label class="required inline-block" for="fixedpay_checker">
                    Использовать фиксированную оплату
                </label>
            </div>
        </div>

        <div class="row-fluid form-row" style="display: none;" id="hidden_fixedpay">
            <div class="span6">
                <?php echo $form->labelEx($model,'fixed_pay'); ?>
                <?php echo $form->textField( $model,'fixed_pay',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                <?php echo $form->error( $model,'fixed_pay' ); ?>
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
                <?php echo $form->labelEx($model,'extended'); ?>
                <?php echo $form->textField( $model,'extended',array( 'size' => 70, 'maxlength' => 255 ) ); ?>
                <?php echo $form->error( $model,'extended' ); ?>
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
                <?php echo $form->labelEx($model,'sort_order'); ?>
                <?php echo $form->textField( $model,'sort_order',array( 'size' => 70, 'maxlength' => 2 ) ); ?>
                <?php echo $form->error( $model,'sort_order' ); ?>
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
<script>
    $(document).ready(function() {
        $('#clickpay_checker').prop('checked') ? $("#hidden_clickpay").show() : $("#hidden_clickpay").hide();
        $('#clickpay_checker').change(function(){
            if ($(this).prop('checked')) {
                $("#hidden_clickpay").show();
            } else {
                $("#hidden_clickpay").hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#fixedpay_checker').prop('checked') ? $("#hidden_fixedpay").show() : $("#hidden_fixedpay").hide();
        $('#fixedpay_checker').change(function(){
            if ($(this).prop('checked')) {
                $("#hidden_fixedpay").show();
            } else {
                $("#hidden_fixedpay").hide();
            }
        });
    });
</script>