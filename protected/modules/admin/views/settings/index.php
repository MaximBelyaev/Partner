<?php
$this->breadcrumbs=array(
	'Настройки',
);
$this->setPageTitle("Настройки | Партнерская программа Павлуцкого Александра");
?>

<div class="block full-page-block">
	
	<div class="head">
		<h5>Настройки</h5>
	</div>

	<!-- Flash message -->
	<?php $this->beginWidget('FlashWidget',array(
		'params'=>array(
			'model' => $model,
		)));
	$this->endWidget(); ?>
	<!-- End Flash message -->

	<div class="form">
		
		<?php echo CHtml::beginForm('', 'post', array(
			'class' => 'row-fluid setting-form'
		)); ?>
		<div class='row-fluid'>
			
		<div class="settings-col">
			
			<h4 class="form-block-header">
				Оплата			
			</h4>	

			<div class="col form-row">
				<label class="header-row">
					Название сайта
				</label>
				<?php echo CHtml::activetextField(
						$model['landing_link'],
						"[landing_link]value",
						array('value' => $model['landing_link']->value)
				) ?>
			</div>

			<div class="col form-row checkbox-row header-row">
				<?php echo CHtml::activeCheckBox(
						$model['click_pay'],
						"[click_pay]status", 
						array('id' => 'clickpay-checker')
				) ?>
				<label for="clickpay-checker"></label>
				<label class="inline-block" for="clickpay-checker">
					<?php echo "Разрешить оплату за переход" ?>
				</label>
			</div>
			
			<div class="col form-row">
				<?php echo CHtml::activeTextField(
						$model['click_pay'],"[click_pay]value",
						array('value' => $model['click_pay']->value ? $model['click_pay']->value : 2)
				) ?>
			</div>
		
			<div class="col form-row checkbox-row header-row">
				<?php echo CHtml::activeCheckBox(
						$model['fixed_pay'],
						"[fixed_pay]status", 
						array('id' => 'fixedpay-checker'
				)) ?>
				<label for="fixedpay-checker"></label>
				<label class="inline-block" for="fixedpay-checker">
					Сделать фиксированную оплату
				</label>
			</div>
		
			<div class="col form-row">
				<?php echo CHtml::activeTextField(
						$model['fixed_pay'],"[fixed_pay]value",
						array('value' => $model['fixed_pay']->value ? $model['fixed_pay']->value : 500)
				) ?>
			</div>
		</div>
		
	
		<div class="charges settings-col">
			
			<h4 class="form-block-header">
				Начисления для ролей
			</h4>		

			<div class="col form-row">
				<label for="Setting_standard_value" class="for-standart header-row">
					Cтандартный
				</label>
				<?php # echo CHtml::activeTextField($model['standard'],"[standard]header",
					#array('value' => $model['standard']->header ? $model['standard']->header : 'Cтандартный')) ?>
				<?php echo CHtml::activeTextField($model['standard'],"[standard]value",
					array('value' => $model['standard']->value ? $model['standard']->value : '15%')) ?>
			</div>

			<div class="col form-row">
				<label for="Setting_extended_value" class="for-extended header-row">
					Расширенный
				</label>
				<?php #echo CHtml::activeTextField($model['extended'],"[extended]header",
					#array('value' => $model['extended']->header ? $model['extended']->header : 'Расширенный')) ?>
				<?php echo CHtml::activeTextField($model['extended'],"[extended]value",
					array('value' => $model['extended']->value ? $model['extended']->value : '17%')) ?>
			</div>
	
			<div class="col form-row">
				<label for="Setting_vip_value" class="for-vip header-row">
					VIP
				</label>
				<?php #echo CHtml::activeTextField($model['vip'],"[vip]header",
					#array('value' => $model['vip']->header ? $model['vip']->header : 'VIP')) ?>
				<?php echo CHtml::activeTextField($model['vip'],"[vip]value",
					array('value' => $model['vip']->value ? $model['vip']->value : '20%')) ?>
			</div>

		</div>


		<div class="connection settings-col">
				
			<h4 class="form-block-header">
				Связь с администрацией
			</h4>
			 	
			<div class="col form-row checkbox-row header-row">
				<?php echo CHtml::activeCheckBox(
						$model['vk'],"[vk]status", 
						array('id' => 'vk-checker')
				) ?>
				<label for="vk-checker"></label>
				<label class="inline-block" for="vk-checker">
					Вконтакте
				</label>
			</div>

			<div class="col form-row" id="hidden-vk">
				<?php echo CHtml::activeTextField($model['vk'],"[vk]value") ?>
			</div>

			<div class="col form-row checkbox-row header-row">
				<?php echo CHtml::activeCheckBox(
						$model['email'],"[email]status",
						array('id' => 'email-checker')
				) ?>
				<label for="email-checker"></label>
				<label class="inline-block" for="email-checker">
					E-mail
				</label>
			</div>

			<div class="row-fluid" id="hidden-email">
				<div class="col form-row">
					<?php echo CHtml::activeTextField($model['email'],"[email]value") ?>
				</div>
			</div>

			<div class="col form-row checkbox-row header-row">
				<?php echo CHtml::activeCheckBox(
						$model['skype'],
						"[skype]status", 
						array('id' => 'skype-checker')
				) ?>
				<label for="skype-checker"></label>
				<label class="inline-block" for="skype-checker">
					Skype
				</label>
			</div>

			<div class="row-fluid" id="hidden-skype">
				<div class="col form-row">
					<?php echo CHtml::activeTextField($model['skype'],"[skype]value") ?>
				</div>
			</div>

		</div>
		<!--Конец блока связи-->

		<div class="settings-col update-block">
				<h4 class="form-block-header">
					Обновление	
				</h4>

				<div>
					<p>Версия вашей прошивки - 1.0</p>
					<a class="btn" id="has-update-check">Проверить актуальность версии</a>
					<a class="btn btn-primary" id="update">Обновить</a>
				</div>
			</div>


		<!-- 
		<div class="pay_systems settings-col">
		
			<h4 class="form-block-header">
				Платёжные системы			
			</h4>	
		
			<div class="col form-row">
				<?php echo CHtml::activeCheckBox($model['qiwi'],"[qiwi]status") ?>
				<label for="Setting_qiwi_status"></label>
				<label class="inline-block" for="Setting_qiwi_status">
					<?php echo $model['qiwi']->header ?>
				</label>
			</div>
			
			<div class="col form-row">
				<?php echo CHtml::activeCheckBox($model['webmoney'],"[webmoney]status") ?>
				<label for="Setting_webmoney_status"></label>
				<label class="inline-block" for="Setting_webmoney_status">
					<?php echo $model['webmoney']->header ?>
				</label>
			</div>
		
			<div class="col form-row">
				<?php echo CHtml::activeCheckBox($model['yandex_money'],"[yandex_money]status") ?>
				<label for="Setting_yandex_money_status"></label>
				<label class="inline-block" for="Setting_yandex_money_status">
					<?php echo $model['yandex_money']->header ?>
				</label>
			</div>
		
			<div class="col form-row">
				<?php echo CHtml::activeCheckBox($model['paypal'],"[paypal]status") ?>
				<label for="Setting_paypal_status"></label>
				<label class="inline-block" for="Setting_paypal_status">
					<?php echo $model['paypal']->header ?>
				</label>
			</div>
				
		</div> -->

		</div>

		<div class="row-fluid">
			<div class="span8">
				<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>


		<?php echo CHtml::endForm(); ?>
		
	</div>


</div>
