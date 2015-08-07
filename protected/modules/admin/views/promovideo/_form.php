<?php
/* @var $this PromovideoController */
/* @var $videoModel Promovideo */
/* @var $form CActiveForm */
?>

<div class="block promovideo-block">
	

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'promovideo-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
		),
	)); ?>

	<div class="head">
		<h5>Добавление рекламного видео</h5>
	</div>

	<div class="row-fluid">
	<!---- Flash message ---->
	<?php $this->beginWidget('FlashWidget',array(
		'params'=>array(
			'form' => $form,
			'model'=>$videoModel
		)));
	$this->endWidget(); ?>
	<!---- End Flash message ---->
	</div>

	<div class="clear"></div>
	

	<div class="row-fluid">
		<div class="span12">
			<div class="form-row">
				<?php echo $form->labelEx($videoModel,'link'); ?>
				<?php echo $form->textField($videoModel, 'link'); ?>
				<?php echo $form->error($videoModel,'link'); ?>
			</div>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<?php echo CHtml::submitButton(
				$videoModel->isNewRecord ? 'Добавить' : 'Сохранить', 
				array('class'=>'btn btn-primary ')
			); ?>
		</div>
	</div>	

	<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
