<?php
$this->breadcrumbs=array(
	'Настройки',
);
$this->setPageTitle("Настройки | Партнерская программа Павлуцкого Александра");
?>

<div class="block full-page-block">
	
	<div class="head">
		<h5>
			Настройки
			<?php #echo CHtml::link('Настройка лендинга',array('/admin/settings/land'), array('class'=>'btn btn-primary',)); ?>
		</h5>
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
				Процент для партнёров
			</h4>

            <div class="col form-row">
                <label for="Setting_standard_value" class="for-standart header-row">
                    Cтандартный (C)
                </label>
                <?php # echo CHtml::activeTextField($model['standard'],"[standard]header",
                #array('value' => $model['standard']->header ? $model['standard']->header : 'Cтандартный')) ?>
                <?php echo CHtml::activeTextField($model['standard'],"[standard]value",
                    array('value' => $model['standard']->value ? $model['standard']->value : '15%')) ?>
            </div>

            <div class="col form-row">
                <label for="Setting_extended_value" class="for-extended header-row">
                    Расширенный (Р)
                </label>
                <?php #echo CHtml::activeTextField($model['extended'],"[extended]header",
                #array('value' => $model['extended']->header ? $model['extended']->header : 'Расширенный')) ?>
                <?php echo CHtml::activeTextField($model['extended'],"[extended]value",
                    array('value' => $model['extended']->value ? $model['extended']->value : '17%')) ?>
            </div>

            <div class="col form-row">
                <label for="Setting_vip_value" class="for-vip header-row">
                    VIP (V)
                </label>
                <?php #echo CHtml::activeTextField($model['vip'],"[vip]header",
                #array('value' => $model['vip']->header ? $model['vip']->header : 'VIP')) ?>
                <?php echo CHtml::activeTextField($model['vip'],"[vip]value",
                    array('value' => $model['vip']->value ? $model['vip']->value : '20%')) ?>
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
		</div>

        <div class="connection settings-col">

            <h4 class="form-block-header">
                Контакты
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

            <div class="col form-row checkbox-row header-row">
                <?php echo CHtml::activeCheckBox(
                    $model['phone'],
                    "[phone]status",
                    array('id' => 'phone-checker')
                ) ?>
                <label for="phone-checker"></label>
                <label class="inline-block" for="phone-checker">
                    Телефон
                </label>
            </div>

            <div class="row-fluid" id="hidden-phone">
                <div class="col form-row">
                    <?php echo CHtml::activeTextField($model['phone'],"[phone]value") ?>
                </div>
            </div>

        </div>
        <!--Конец блока связи-->
	
		<div class="charges settings-col">
          <div id="payments_list">
			<h4 class="form-block-header">
				Способы вывода средств
			</h4>		

                <?php foreach ($paymentMethods as $pay)
                { ?>
            <div class="col form-row">
                <label class="inline-block" data-var="<?= $pay->setting_id ?>">
					<?= $model[$pay->name]->header ?>
                    <?php echo Chtml::link('', '', array('class'=>'icon-trash icon-white', 'id' => 'delete_payment', 'data-var' => $pay->setting_id)); ?>
                </label>
            </div>

                <?php } ?>
          </div>
            <div class="col form-row">
                <input type="text" id="payment_name"  />
            </div>
            <div class="col form-row">
            <?php echo Chtml::link('Добавить способ оплаты', '', array('class'=>'btn btn-primary', 'id' => 'add_payment')); ?>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <?php echo CHtml::submitButton(
                        'Сохранить',
                        array('class' => 'btn btn-primary '
                        )); ?>
                </div>
            </div>

		</div>

		<div class="settings-col update-block">
			<h4 class="form-block-header">
				Обновление	
			</h4>

			<div>
				<p class="your_version">Версия вашей прошивки - <?= $l['version'] ?></p>
				<p class="upd_msg"></p>	
				<a 
					class="btn" 
					id="update-check" 
					data-mode="check" 
					data-checkUrl='/admin/default/checkUpdate'
					data-updateUrl='/admin/default/downloadAndUpdate'
				>Проверить актуальность версии</a>
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

		<?php echo CHtml::endForm(); ?>
		
	</div>
</div>


<div class="col form-row">
    <label class="inline-block">
    </label>
</div>
<script>
    jQuery(document).ready(function($) {
        console.log($('#add_payment'));
        $('#add_payment').on('click', function(event) {
            event.preventDefault();
            var name = $('#payment_name').val();
            console.log ('значение = ' + name);
            $.ajax({
                url: '/admin/settings/AddPayment',
                type: 'POST',
                dataType: 'json',
                data: {name: name},
            })
                .done(function(xhr) {
                    console.log(xhr);
                    //console.log($('[data-var]'));
                    var html = '<div class="col form-row"> <label class="inline-block" data-var="' + xhr.obj_id  +'">' + xhr.obj_header + ' <a class="icon-trash icon-white" id="delete_payment" data-var="' + xhr.obj_id  +'"></a></label> </div>';
                    $('#payments_list').append(html);
                })
                .fail(function(xhr) {
                    console.log(xhr.responseText);
                    console.log("error");
                })
                .always(function(xhr) {
                    console.log("complete");
                });
        });
    });
</script>
<script>
    jQuery(document).on('click','#delete_payment',function() {
        var set = $('[data-var = ' + jQuery(this).attr('data-var') + ']');
        if(!confirm('Вы уверены, что хотите удалить данный метод оплаты?')) return false;
        $.ajax({
            url: '/admin/settings/delete/id/' + jQuery(this).attr('data-var'),
            type: 'POST',
        })
            .done(function(xhr) {
                set.remove();
            })
            .fail(function(xhr) {
                console.log(xhr.responseText);
                console.log("error");
            })
            .always(function(xhr) {
                console.log("complete");
            });
    });
</script>
