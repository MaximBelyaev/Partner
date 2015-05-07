<?php
$this->breadcrumbs=array(
	'Настройки',
);
$this->setPageTitle("Настройки | Партнерская программа Павлуцкого Александра");
?>

<div class="head">
	<h5>Настройки</h5>
</div>

<div class="form">
		<?php echo CHtml::beginForm(); ?>

	<div class="row">
		<?php echo "Разрешить оплату за переход" ?>
		<?php echo CHtml::activeCheckBox($model[0],"[0]status", array('id' => 'clickpay-checker')) ?>
	</div>

	<div class="row" id="hidden-clickpay" style="display:none">
		<?php echo "Размер оплаты" ?>
		<?php echo CHtml::activeTextField($model[0],"[0]value", array('value' => $model[0]->value ?
			$model[0]->value : 2)) ?>
	</div>

	<div class="row">
		<?php echo "Сделать фиксированную оплату" ?>
		<?php echo CHtml::activeCheckBox($model[6],"[6]status", array('id' => 'fixedpay-checker')) ?>
	</div>

	<div class="row" id="hidden-fixedpay" style="display:none">
		<?php echo "Размер оплаты" ?>
		<?php echo CHtml::activeTextField($model[6],"[6]value", array('value' => $model[6]->value ?
			$model[6]->value : 500)) ?>
	</div>

	<div class="form-group">
		<?php echo "Начисления для ролей" ?>
	<div class="row">
		<?php echo $model[9]->header ?>
		<?php echo CHtml::activeTextField($model[9],"[9]value", array('value' => $model[9]->value ?
			$model[9]->value : '15%')) ?>
	</div>

	<div class="row">
		<?php echo $model[8]->header ?>
		<?php echo CHtml::activeTextField($model[8],"[8]value", array('value' => $model[8]->value ?
			$model[8]->value : '17%')) ?>
	</div>

	<div class="row">
		<?php echo $model[7]->header ?>
		<?php echo CHtml::activeTextField($model[7],"[7]value", array('value' => $model[7]->value ?
			$model[7]->value : '20%')) ?>
	</div>
	</div>

	<!--Связь-->
	<div class="row">
		<?php echo $model[10]->header ?>
		<?php echo CHtml::activeCheckBox($model[10],"[10]status", array('id' => 'vk-checker')) ?>
	</div>

	<div class="row" id="hidden-vk" style="display:none">
		<?php echo CHtml::activeTextField($model[10],"[10]value") ?>
	</div>

		<div class="row">
			<?php echo $model[11]->header ?>
		<?php echo CHtml::activeCheckBox($model[11],"[11]status", array('id' => 'email-checker')) ?>
	</div>

	<div class="row" id="hidden-email" style="display:none">
		<?php echo CHtml::activeTextField($model[11],"[11]value") ?>
	</div>

		<div class="row">
			<?php echo $model[12]->header ?>
		<?php echo CHtml::activeCheckBox($model[12],"[12]status", array('id' => 'skype-checker')) ?>
	</div>

	<div class="row" id="hidden-skype" style="display:none">
		<?php echo CHtml::activeTextField($model[12],"[12]value") ?>
	</div>
	<!--Конец блока связи-->

	<div class="form-group">
		<?php echo "Платёжные системы" ?>
	<div class="row">
		<?php echo $model[2]->header ?>
		<?php echo CHtml::activeCheckBox($model[2],"[2]status") ?>
	</div>

	<div class="row">
		<?php echo $model[3]->header ?>
		<?php echo CHtml::activeCheckBox($model[3],"[3]status") ?>
	</div>

	<div class="row">
		<?php echo $model[4]->header ?>
		<?php echo CHtml::activeCheckBox($model[4],"[4]status") ?>
	</div>

	<div class="row">
		<?php echo $model[5]->header ?>
		<?php echo CHtml::activeCheckBox($model[5],"[5]status") ?>
	</div>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Сохранить'); ?>
		<?php echo CHtml::endForm(); ?>
	</div>
</div><!-- form -->