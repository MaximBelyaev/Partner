<?php
/* @var $this BannersController */
/* @var $model Banners */
/* @var $form CActiveForm */
?>

<div class="form promoban-block">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promobanns-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
)); ?>

	<div class="head">
		<h5>
			<?php echo $model->isNewRecord ? 'Добавление баннера' : 'Редактирование баннера: '.$model->name; ?>
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
		<div class="span12">
			<div class="form-row">
				<?php echo $form->labelEx($model,'type'); ?>
				<?php echo $form->dropDownList(
					$model,
					'type', 
					$typesList,
					array('class' => 'dropdown')
				); ?>
				<?php echo $form->error($model,'type'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'name'); ?>
				<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'width'); ?>
				<?php echo $form->textField($model,'width'); ?>
				<?php echo $form->error($model,'width'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'height'); ?>
				<?php echo $form->textField($model,'height'); ?>
				<?php echo $form->error($model,'height'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx( $model, 'land_id' ); ?>
				
				<?php 
				# выбираем пункт по-умолчанию для списка
				# если у модели уже выбран пункт, то используем его
				if(!is_null($model->land_id) && ((int)$model->land_id > 0)) {
					$options = array(
						(int)$model->land_id => array('selected'=>true)
					);
				# если выбран лендинг с которым работаем, используем его
				} else if(!is_null(Yii::app()->session['landing']) && ((int)Yii::app()->session['landing'] > 0)) {
					$options = array(
						(int)Yii::app()->session['landing'] => array('selected'=>true)
					);
				} else {
					$options = array();
				}
				?>


				<?php echo $form->dropDownList(
					$model,
					'land_id',
					$this->landingsList,
					array(
						'class' => 'dropdown',
						'options' => $options
					)
				); ?>
				<?php echo $form->error( $model, 'land_id' ); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'image'); ?>
				<?php echo $form->fileField($model, 'image', array('data-header'=>'Выберите файл')); ?>
				<?php echo $form->error($model,'image'); ?>
			</div>
		</div>
	</div>

	<?php if( $model->isNewRecord != '1' ){ ?>
	<div class="form-row">
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/bans/'.$model->image,"image",array("width"=>200)); ?>
	</div>
	<?php } ?>


	
	<div class="row-fluid">
		<div class="span12">
			<?php echo CHtml::submitButton(
				$model->isNewRecord ? 'Добавить' : 'Сохранить', 
				array('class'=>'btn btn-primary ')
			); ?>
		</div>
	</div>	


<?php $this->endWidget(); ?>

</div><!-- form -->

