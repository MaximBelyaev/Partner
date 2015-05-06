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
		<?php echo CHtml::activeCheckBox($model[6],"[6]status", array('id' => 'clickpay-checker')) ?>
	</div>

	<div class="row" id="hidden-clickpay" style="display:none">
		<?php echo "Размер оплаты" ?>
		<?php echo CHtml::activeTextField($model[6],"[6]value", array('value' => $model[6]->value ?
			$model[6]->value : 500)) ?>
	</div>

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