<?php
$this->breadcrumbs=array(
	'Настройки',
);
$this->setPageTitle("Настройки | Партнерская программа Павлуцкого Александра");
?>

<div class="head">
	<h5>Настройки</h5>
</div>

<!---- Flash message ---->
<?php $this->beginWidget('FlashWidget',array(
	'params'=>array(
		'model' => $model,
	)));
$this->endWidget(); ?>
<!---- End Flash message ---->

<div class="form">
		<?php echo CHtml::beginForm(); ?>

	<div class="row">
		<?php echo "Название сайта" ?>
		<?php echo CHtml::activetextField($model['landing_link'],"[landing_link]value",
			array('value' => $model['landing_link']->value)) ?>
	</div>

	<div class="row">
		<?php echo "Разрешить оплату за переход" ?>
		<?php echo CHtml::activeCheckBox($model['click_pay'],"[click_pay]status", array('id' => 'clickpay-checker')) ?>
	</div>

	<div class="row" id="hidden-clickpay" style="display:none">
		<?php echo "Размер оплаты" ?>
		<?php echo CHtml::activeTextField($model['click_pay'],"[click_pay]value",
			array('value' => $model['click_pay']->value ? $model['click_pay']->value : 2)) ?>
	</div>

	<div class="row">
		<?php echo "Сделать фиксированную оплату" ?>
		<?php echo CHtml::activeCheckBox($model['fixed_pay'],"[fixed_pay]status", array('id' => 'fixedpay-checker')) ?>
	</div>

	<div class="row" id="hidden-fixedpay" style="display:none">
		<?php echo "Размер оплаты" ?>
		<?php echo CHtml::activeTextField($model['fixed_pay'],"[fixed_pay]value",
			array('value' => $model['fixed_pay']->value ? $model['fixed_pay']->value : 500)) ?>
	</div>

		<?php echo "Начисления для ролей" ?>
	<div class="row">
		<?php echo CHtml::activeTextField($model['standard'],"[standard]header",
			array('value' => $model['standard']->header ? $model['standard']->header : 'Cтандартный')) ?>
		<?php echo CHtml::activeTextField($model['standard'],"[standard]value",
			array('value' => $model['standard']->value ? $model['standard']->value : '15%')) ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeTextField($model['extended'],"[extended]header",
			array('value' => $model['extended']->header ? $model['extended']->header : 'Расширенный')) ?>
		<?php echo CHtml::activeTextField($model['extended'],"[extended]value",
			array('value' => $model['extended']->value ? $model['extended']->value : '17%')) ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeTextField($model['vip'],"[vip]header",
			array('value' => $model['vip']->header ? $model['vip']->header : 'VIP')) ?>
		<?php echo CHtml::activeTextField($model['vip'],"[vip]value",
			array('value' => $model['vip']->value ? $model['vip']->value : '20%')) ?>
	</div>

	<!--Связь-->
	<div class="row">
		<?php echo $model['vk']->header ?>
		<?php echo CHtml::activeCheckBox($model['vk'],"[vk]status", array('id' => 'vk-checker')) ?>
	</div>

	<div class="row" id="hidden-vk" style="display:none">
		<?php echo CHtml::activeTextField($model['vk'],"[vk]value") ?>
	</div>

		<div class="row">
			<?php echo $model['email']->header ?>
		<?php echo CHtml::activeCheckBox($model['email'],"[email]status", array('id' => 'email-checker')) ?>
	</div>

	<div class="row" id="hidden-email" style="display:none">
		<?php echo CHtml::activeTextField($model['email'],"[email]value") ?>
	</div>

		<div class="row">
			<?php echo $model['skype']->header ?>
		<?php echo CHtml::activeCheckBox($model['skype'],"[skype]status", array('id' => 'skype-checker')) ?>
	</div>

	<div class="row" id="hidden-skype" style="display:none">
		<?php echo CHtml::activeTextField($model['skype'],"[skype]value") ?>
	</div>
	<!--Конец блока связи-->

		<?php echo "Платёжные системы" ?>
	<div class="row">
		<?php echo $model['qiwi']->header ?>
		<?php echo CHtml::activeCheckBox($model['qiwi'],"[qiwi]status") ?>
	</div>

	<div class="row">
		<?php echo $model['webmoney']->header ?>
		<?php echo CHtml::activeCheckBox($model['webmoney'],"[webmoney]status") ?>
	</div>

	<div class="row">
		<?php echo $model['yandex_money']->header ?>
		<?php echo CHtml::activeCheckBox($model['yandex_money'],"[yandex_money]status") ?>
	</div>

	<div class="row">
		<?php echo $model['paypal']->header ?>
		<?php echo CHtml::activeCheckBox($model['paypal'],"[paypal]status") ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Сохранить'); ?>
		<?php echo CHtml::endForm(); ?>
	</div>
</div>