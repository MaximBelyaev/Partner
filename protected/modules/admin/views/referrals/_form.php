
<?php
/* @var $this ReferralsController */
/* @var $model Referrals */
/* @var $form CActiveForm */
?>

<div class="block full-page-block">
	

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'referrals-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="head">
		<h5>
			<?php echo $model->isNewRecord ? 'Добавление клиента' : 'Редактирование клиента: ' . $model->email; ?>
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

	
	<div class="row-fluid">
		<div class="span4">
				
			<div class="form-row">
				<?php //echo $form->labelEx($model,'user_id'); ?>
				<label for="Referrals_user_id">Привязать к партнеру</label>
				<?php
					$users  = CHtml::listData(User::model()->findAll(array('order'=>'username')), 'id','username');
					$result = array_merge(array('promo'=>'Промо код'), $users);
					echo $form->dropDownList(
						$model,
						'user_id', 
						$users, 
						array(
							'prompt' => '- - - без партнера - - -',
							'class'  => 'dropdown')
					); ?>
				<?php echo $form->error($model,'user_id'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'promo'); ?>
				<?php echo $form->textField($model,'promo', array('placeholder'=>'Если нет - оставить пустым')); ?>
				<?php echo $form->error($model,'promo'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'email'); ?>
				<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
				<?php echo $form->error($model,'email'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'money'); ?>
				<?php echo $form->textField($model,'money',array('size'=>8,'maxlength'=>8)); ?>
				<?php echo $form->error($model,'money'); ?>
			</div>

		</div>
		
		<div class="span4 offset1">
			
			<div class="form-row">
				<?php echo $form->labelEx($model,'site'); ?>
				<?php echo $form->textField($model,'site'); ?>
				<?php echo $form->error($model,'site'); ?>
			</div>

			<div class="form-row">
				<?php echo $form->labelEx($model,'status'); ?>
				<?php echo $form->dropDownList(
					$model,
					'status',
					array( 'Заявка' => 'Заявка', 'Оплачено' => 'Оплачено' ),
					array( 'class'  => 'dropdown')
				); ?>
				<?php echo $form->error($model,'status'); ?>
			</div>

			<?php if(Yii::app()->controller->landings){ ?>
			<div class="form-row">
				<?php echo $form->labelEx( $model, 'land_id' ); ?>
				<?php echo $form->dropDownList( 
					$model, 
					'land_id', 
					Yii::app()->controller->landings,
					array('class' => 'dropdown') 
				); ?>
				<?php echo $form->error( $model, 'land_id' ); ?>
			</div>
			<?php } ?>

			<div class="form-row">
				<?php echo CHtml::activeCheckBox($model,'recreate_interval'); ?>
				<label for="Referrals_recreate_interval"></label>
				<label class="inline-block" for="Referrals_recreate_interval">
					Постоянная оплата
				</label>
			</div>
		
		</div>
	
	</div>

	<div class="underlist-button">
		<div class="span9">
			<?php echo CHtml::submitButton(
				$model->isNewRecord ? 'Добавить' : 'Сохранить', 
				array('class'=>'btn btn-primary pull-right')); ?>
		</div>
	</div>
	<div class="clear"></div>

	<?php $this->endWidget(); ?>

</div>

</div><!-- form -->