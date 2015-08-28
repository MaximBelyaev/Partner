<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */

$this->setPageTitle("Редактирование информации | Партнерская программа Павлуцкого Александра");
?>

<div class="block data-block full-page-block">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
	)); ?>

	<h5>Редактирование информации</h5>

	<div class="row">

		<div class="span4_5">
			<div class="setting_block">
				<label class="required" for="User_username">
					Ваш Email <span class="required">*</span>
				</label>
				<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150)); ?>
				<?php echo $form->error($model,'username'); ?>				
			</div>

			<div class="setting_block">
				<label class="required" for="User_password">
					Ваш пароль <span class="required">*</span>
				</label>
				<?php echo $form->textField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>

			<div class="setting_block">	
				<label class="required" for="User_skype">
					Ваш скайп
				</label>
				<?php echo $form->textField($model,'skype',array('size'=>50,'maxlength'=>128)); ?>
				<?php echo $form->error($model,'skype'); ?>
			</div>
	
			<div class="button_save"> 
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class'=>'btn btn-primary')); ?>
			</div>

		</div>


		<div class="span4_5">
		
			<div class="setting_block">	
				<label class="required" for="User_site">
					Ваш промокод
				</label>
				<?php echo $form->textField($model,'promo_code',array('size'=>50,'maxlength'=>128)); ?>
				<?php echo $form->error($model,'promo_code'); ?>
			</div>

            <div class="setting_block">
                <label class="required" for="User_use_click_pay">
                    Выберите источник дохода (лендинг <?= Landings::model()->findByPk(Yii::app()->session['landing'])->name; ?>)
                </label>
                <div class="select-wrap">
                    <?php
                    echo CHtml::dropDownList('state', $model,
                        array(
                            '1' => 'Процент от заказа',
                            '2' => 'Оплата за переходы',
                            '3' => 'Фиксированная оплата'
                        ),
                        array('options' => array(
                            $default => array('selected'=>'selected'),
                            $disabled_click => array('disabled'=>true),
                            $disabled_fixed => array('disabled'=>true)))); ?>
                </div>
                <?php echo $form->error($model,'state'); ?>
            </div>

			<div class="setting_block">	
				<label class="required" for="User_site">
					Закрепить сайт
				</label>
				<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'site'); ?>
				<?php if (isset($model->warnings['site'])) { ?>
					<div class="warn"><?= $model->warnings['site'] ?></div>
				<?php } ?>
			</div>

		</div>		

	<?php $this->endWidget(); ?>

	</div>
</div>	