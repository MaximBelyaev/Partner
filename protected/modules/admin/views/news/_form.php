<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
Yii::import('ext.tinymce.TinyMceFileManager')
?>

<div class="block full-page-block">

<div class="head">
	<h5>
		<?php echo $model->isNewRecord ? 'Создать новость' : 'Редактировать новость: '. $model->header; ?>
	</h5>
</div>	



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid form-row news-row">
		<div class="span6">
		<?php echo $form->labelEx($model,'header'); ?>
		<?php echo $form->textField($model,'header',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'header'); ?>
		</div>
	</div>

	<div class="row-fluid form-row news-row">
		
		<label for="News_text" class="required">
			Текст
		</label>
		<?php $this->widget('ext.yii-redactor.ERedactorWidget', array(
			'model' 	 => $model, 
			'attribute'  => 'text',
			'options'	 => array(
				'fileUpload' =>Yii::app()->createUrl('admin/news/fileUpload',array(
					'attr'	=>'text'
				)),
				'fileUploadErrorCallback' => new CJavaScriptExpression(
					'function(obj,json) { alert(json.error); }'
				),
				'imageUpload' => Yii::app()->createUrl('admin/news/imageUpload',array(
					'attr' => 'text'
				)),
				'imageGetJson' => Yii::app()->createUrl('admin/news/imageList',array(
					'attr' => 'text'
				)),
				'imageUploadErrorCallback' => new CJavaScriptExpression(
					'function(obj,json) { console.log(json); }'
				),
			),
		)); ?>

	</div>

	<?php if(Yii::app()->controller->landings){ ?>
		<div class="row-fluid form-row news-row">
			<div class="span6">
			<?php echo $form->labelEx( $model, 'land_id' ); ?>
			<?php echo $form->dropDownList(
				$model,
				'land_id',
				(Yii::app()->session['landing'] == 0) ?
					Yii::app()->controller->landings : array(Yii::app()->session['landing'] => Yii::app()->session['landing']['land_id']),
				array(
					'class' => 'dropdown',
				)
			); ?>
			<?php echo $form->error( $model, 'land_id' ); ?>
			</div>
		</div>
	<?php } ?>

	<div class="row-fluid form-row news-row">
		<div class="span12">
		<?php echo CHtml::submitButton(
			$model->isNewRecord ? 'Добавить' : 'Редактировать', 
			array('class'=>'btn btn-primary pull-right')
		); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>