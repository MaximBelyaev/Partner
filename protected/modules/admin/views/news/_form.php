<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
Yii::import('ext.tinymce.TinyMceFileManager')
?>

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

	<div class="news_row">
		<?php echo $form->labelEx($model,'header'); ?>
		<?php echo $form->textField($model,'header',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'header'); ?>
	</div>

	<div class="news_row">
	<?php 


	$this->widget('ext.yii-redactor.ERedactorWidget', array(
		'model' => $model, 
		'attribute' => 'text',
		'options'=>array(
        'fileUpload'=>Yii::app()->createUrl('admin/news/fileUpload',array(
            'attr'=>'text'
        )),
        'fileUploadErrorCallback'=>new CJavaScriptExpression(
            'function(obj,json) { alert(json.error); }'
        ),
        'imageUpload'=>Yii::app()->createUrl('admin/news/imageUpload',array(
            'attr'=>'text'
        )),
        'imageGetJson'=>Yii::app()->createUrl('admin/news/imageList',array(
            'attr'=>'text'
        )),
        'imageUploadErrorCallback'=>new CJavaScriptExpression(
            'function(obj,json) { console.log(json); }'
        ),
    ),
	));

	/*
	$this->widget('ext.redactor-widget.ImperaviRedactorWidget', array(
		'model' => $model, 
		'attribute' => 'text',
	));
	*/
	/*
	$this->widget('ext.tinymce.TinyMce', array(
		'model' => $model,
		'attribute' => 'text',
		// Optional config
		 'fileManager' => array(
			'class' => 'ext.elfinder.TinyMceElFinder',
			'connectorRoute'=>'admin/news/connector',
		), 
		'settings' => array(
	        'plugins' => "autolink,lists,style,
	        			table,save,advhr,advimage,
	        			advlink,inlinepopups,insertdatetime,
	        			preview,paste,fullscreen,
	        			nonbreaking,xhtmlxtras",
		),
		'htmlOptions' => array(
			'rows' => 6,
			'cols' => 60,
		),
	));
	*/

	?>

	</div>

	<div class="news_row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->