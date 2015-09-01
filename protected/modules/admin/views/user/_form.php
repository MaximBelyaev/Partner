<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="block full-page-block">
	
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <div class="head">
        <h5>
        	<?php echo $model->isNewRecord ? 'Добавление партнера' : 'Редактирование партнера: '.$model->username; ?>
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
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150)); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>
		</div>
		
		<div class="span4 offset1">

			<div class="form-row">
				<?php echo $form->labelEx($model,'status'); ?>
				<?php echo $form->dropDownList($model,'status', 
					array(
						'Стандартный' => 'Стандартный', 
						'Расширенный' => 'Расширенный', 
						'VIP' => 'VIP'
					),
					array(
						'class' => 'dropdown'
					)
				);?>
				<?php echo $form->error($model,'status'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'site'); ?>
				<?php echo $form->textField($model,'site',array('size'=>50,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'site'); ?>
			</div>

		</div>
	</div>

	<div class="row-fluid">
		<div class="span9">
			<?php echo CHtml::submitButton(
				$model->isNewRecord ? 'Добавить' : 'Сохранить', 
				array('class'=>'btn btn-primary ')); ?>
		</div>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	$(document).ready(function() {
		var e = document.getElementById("User_use_click_pay");

		$(e).change(function(){
			if ($(this).val() == "1") {
				$("#click_pay_row").show();
			} else {
				$("#click_pay_row").hide();
			}
		});
	});
</script>

<script>
    $(document).ready(function() {
        var f = document.getElementById("User_use_click_pay");

        $(f).change(function(){
            if ($(this).val() == "4") {
                $("#fixed_pay_row").show();
            } else {
                $("#fixed_pay_row").hide();
            }
        });
    });
</script>
</div>	