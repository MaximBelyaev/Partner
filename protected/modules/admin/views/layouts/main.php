<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $this->pageTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/main.css">
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
    <script type="text/javascript" src="<?php echo $this->module->assetsUrl ?>/js/bootstrap.js"></script>
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/preloader.css" rel="stylesheet" type="text/css" />  
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/js/easydropdown-master/themes/easydropdown.partner.css" rel="stylesheet" type="text/css" />   

    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" ></script>
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.standalone.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/flot/jquery.flot.js" ></script>
    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/flot/jquery.flot.time.js" ></script>
    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/easydropdown-master/src/jquery.easydropdown.js" ></script>
    <script type="text/javascript" src="<?php echo $this->module->assetsUrl ?>/js/main.js"></script>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner top-nav">
        <div class="container-fluid">
			<img 
				src="/img/Burger.svg"
				alt="menu Open"
				id="mob-menu-trigger" data-for="sidebar">
            
			<div class="nav pull-left for-logo">
					<?= CHtml::link('<img src="/img/Logo.svg">', array('/admin/default/index'), array('class'=>'logo')); ?>
				</div>
            <div class="nav pull-left landing_select select-wrap">

				<?php if (Yii::app()->controller->landings) {
					echo CHtml::dropDownList(
							'landing_select', Yii::app()->session['landing'],
							Yii::app()->controller->landings,
                            array('id' => 'landing_select', 'class' => 'dropdown')
                    ); ?>
                    <label for="landing_select"></label>
                <?php } ?>
            </div>

	<?php $this->widget('zii.widgets.CMenu',array(
		'id' => 'head-menu',
		'items'=>array(
			array(
				'label' => $this->notifications_count ? "<strong class='nots'>{$this->notifications_count}</strong>Уведомления" : "Уведомления",
				'url'   => array('/admin/notifications/index'),
			),
			array(
				'label' => 'Настройки',
				'url'   => array('/admin/settings/index'),
			),
			array(
				'label' => 'Статистика',
				'url'   => array('/admin/statistics/index'),
			),
			array(
				'label' => 'Партнёрка',
				'url'   => array('/user/user/index'),
                'linkOptions' => array('target'=>'_blank'),
			),
			array(
				'label' => 'Выйти',
				'url'   => array('/admin/default/logout'),
			),
		),
		'htmlOptions'=>array(
			'class'=>'nav pull-right',
		),
		'encodeLabel'=>false,
	)); ?> 

        <div class="nav pull-left top_menu_mobile">
			<select id="top_menu_mobile" class="dropdown">
				<option value="<?= $this->createUrl('/admin/notifications/index'); ?>">
					Уведомления <?= ($this->notifications_count)?"({$this->notifications_count})":''?>
				</option>
				<option value="<?= $this->createUrl('/admin/settings/index'); ?>">
					Настройки
				</option>
				<option value="<?= $this->createUrl('/admin/statistics/index'); ?>">
					Статистика
				</option>
				<option value="<?= $this->createUrl('/user/user/index'); ?>">
					Партнёрка
				</option>
				<option value="<?= $this->createUrl('/admin/default/logout'); ?>">
					Выйти
				</option>
			</select>
		</div>

        </div>
    </div>
</div>
<div id="sidebar">
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
			array(
                'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Landings.svg') . 'Лендинги',
                'url'=>array('/admin/landings/index'),
			),
			array(
				'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Plus.svg') . 'Добавить лендинг',
				'itemOptions' => array('class'=>'submenu'),
				'url'=>array('/admin/landings/create'),
			),
			array(
                'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Clients.svg') . 'Клиенты',
                'url'=>array('/admin/referrals/index'),
			),
			array(
                'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Plus.svg') . 'Добавить клиента',
                'url'=>'#createRefModal',
                'itemOptions' => array('class'=>'submenu'),
                'linkOptions' => array('data-toggle'=>'modal',
                'data-target' => '#createRefModal'),
			),
			array(
                'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Partners.svg') . 'Партнеры',
                'url'=>array('/admin/user/index'),
            ),
            array(
                'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Plus.svg') . 'Добавить партнёра',
                'url'=>'#createModal',
                'itemOptions' => array('class'=>'submenu'),
                'linkOptions' => array('data-toggle'=>'modal',
                'data-target' => '#createModal'),
            ),
            array(
                'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Reklama.svg') . 'Рекламные материалы',
                'url'=>array('/admin/promobanns/index'),
			),
			array(
				'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Plus.svg') . 'Добавить',
				'itemOptions' => array('class'=>'submenu'),
				'url'=>array('/admin/promobanns/create'),
			),
			array(
				'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/News.svg') . 'Новости',
				'itemOptions' => array('class'=>'news-menu-point'),
				'url'=>array('/admin/news/index'),
			),
			array(
				'label'=>@file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Plus.svg') . 'Добавить новость',
				'itemOptions' => array('class'=>'submenu'),
				'url'=>array('/admin/news/create'),
			),
			array(
				'label'=>@file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/images/icons/Money.svg') . 'Вывод средств',
				'url'=>array('/admin/stateds/index'),
			),
		),
		'htmlOptions'=>array(
			'class'=>'side-nav accordion_mnu collapsible',
			'id'=>'menu',
		),
		'encodeLabel'=>false,
	)); ?>
	<?php #echo $this->widget('admin.components.Widgets.MessagesWidget'); ?>
</div>
<div id="main-content">
	<div class="container-fluid">
		<?php if(isset($this->breadcrumbs) && false):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'homeLink'=>CHtml::link('Partner',array('/admin/default/index')),
				'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
		<?php endif?>
		<div class="main-content">
			<?php echo $content; ?>
		</div>
			
	</div>
</div>



<!-- Modal for referrals-->
<div 
    class="modal fade" 
    id="createRefModal" 
    tabindex="-1" 
    role="dialog" 
    href="#createRefModal" 
    aria-labelledby="myModalLabel" 
    aria-hidden="true" 
>
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $newReferral=Yii::app()->controller->newReferral ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>array('referrals/create'),
				'id'=>'create-referral-form',
				'enableAjaxValidation' => true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>
			<button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
				&times;
			</button>
			<h4 class="modal-title">Добавить клиента</h4>
			<div class="errorMessage" id="formResult"></div>
			<div class="form-group">
				<label for="Referrals_user_id">Привязать к партнеру</label>
				<?php
					$users  = CHtml::listData(User::model()->findAll(array('order'=>'username')), 'id','username');
					$result = array_merge(array('promo'=>'Промо код'), $users);
				?>
				
				<?php echo $form->dropDownList(
					$newReferral,
					'user_id',
					$users, 
					array(
						'prompt' => '- - - без партнера - - -',
						'class'  => 'dropdown' )
					); ?>
				<?php echo $form->error($newReferral,'user_id'); ?>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($newReferral,'money'); ?>
				<?php echo $form->textField($newReferral,'money',array('size'=>8,'maxlength'=>8)); ?>
				<?php echo $form->error($newReferral,'money'); ?>
			</div>
			<?php if (Yii::app()->controller->landings) { ?>
			<div class="form-group">
				<?php echo $form->labelEx( $newReferral, 'land_id' ); ?>
				<?php echo $form->dropDownList( 
					$newReferral, 
					'land_id',
                    (Yii::app()->session['landing'] == 0) ?
					$this->landingsList : array(Yii::app()->session['landing'] => Landings::model()->find(array(
                        'condition' => 'land_id = ' .Yii::app()->session['landing']))->name),
					array(
						'class' => 'dropdown',
					))
				    ; ?>
				<?php echo $form->error( $newReferral, 'land_id' ); ?>
			</div>
			<?php } ?>
			
			<div class="form-group">
				<?php echo $form->labelEx($newReferral,'promo'); ?>
				<?php echo $form->textField($newReferral,'promo', array('placeholder'=>'Если нет - оставить пустым', 'data-placeholder'=>'Если нет - оставить пустым')); ?>
				<?php echo $form->error($newReferral,'promo'); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($newReferral,'site'); ?>
				<?php echo $form->textField($newReferral,'site'); ?>
				<?php echo $form->error($newReferral,'site'); ?>
			</div>

			<div class="form-group">
				<div class="checkbox-wrap">
				<?php echo CHtml::activeCheckBox($newReferral,'recreate_interval'); ?>
				<label for="Referrals_recreate_interval" class="checkbox-label"></label>
				<label class="required inline-block" for="Referrals_recreate_interval">
					Ежемесячная оплата
				</label>
				</div>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($newReferral,'email'); ?>
				<?php echo $form->textField($newReferral,'email',array('size'=>60,'maxlength'=>150)); ?>
				<?php echo $form->error($newReferral,'email'); ?>
			</div>


			<div class="form-group">
				<?php echo $form->labelEx($newReferral,'status'); ?>
				<?php echo $form->dropDownList(
					$newReferral,
                    'status',
					array(
						'Заявка' => 'Заявка', 
						'Оплачено' => 'Оплачено' 
					),
					array(
						'class' => 'dropdown',
					)
				); ?>
				<?php echo $form->error($newReferral,'status'); ?>
			</div>

			<div class="form-group">
			<?php echo CHtml::ajaxSubmitButton("Добавить клиента", $this->createUrl('referrals/create'),
				array(
					'dataType'=>'json',
					'type'=>'post',
					'success'=>'function(data) {
						if(data.status=="success") {
							$("#formResult").html("Клиент добавлен успешно.");
							$("#create-referral-form")[0].reset();
							window.setTimeout(function(){
								//$(".close-modal").trigger("click");
								console.log($("#createRefModal").modal("hide"));
							}, 1500);
						}
						else {
							$.each(data, function(key, val) {
								$("#create-referral #"+key+"_em_").text(val);
								$("#create-referral #"+key+"_em_").show();
							});
						}
					}',
				),
				array('class' => 'btn btn-success')); ?>
			</div>
			
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>

<!-- Modal for users-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" href="#createModal" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $newUser=Yii::app()->controller->newUser ?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>array('user/create'),
                'id'=>'create-user-form',
                'enableAjaxValidation' => true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
            <h4 class="modal-title">Добавить партнёра</h4>
            <div class="errorMessage" id="formResultUser"></div>
            <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">&times;</button>
            <div class="form-group">
                <?php echo $form->labelEx($newUser,'username'); ?>
                <?php echo $form->textField($newUser,'username',array('size'=>60,'maxlength'=>150,)); ?>
                <?php echo $form->error($newUser,'username'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($newUser,'status'); ?>
                <?php echo $form->dropDownList(
                        $newUser,
                        'status', 
                        array(
                            'Стандартный' => 'Стандартный', 
                            'Расширенный' => 'Расширенный',
                            'VIP' => 'VIP', 
                        ),
                        array('class' => 'dropdown')
                ); ?>
                <?php echo $form->error($newUser,'status'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($newUser,'use_click_pay'); ?>
                <?php echo $form->dropDownList(
                        $newUser,
                        'use_click_pay', 
                        User::$work_modes, 
                        array(
                            'id' => 'list_click_pay',
                            'class' => 'dropdown'
                        )
                    ); ?>
                <?php echo $form->error($newUser,'use_click_pay'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($newUser,'password'); ?>
                <?php echo $form->textField($newUser,'password',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($newUser,'password'); ?>
            </div>


            <div class="form-group">
                <?php echo $form->labelEx($newUser,'site'); ?>
                <?php echo $form->textField($newUser,'site',array('size'=>50,'maxlength'=>255)); ?>
                <?php echo $form->error($newUser,'site'); ?>
            </div>

			<div class="form-group">
            
	            <div class="form-group" id="hidden" style="display:none">
	                <?php echo $form->labelEx($newUser,'click_pay'); ?>
	                <?php echo $form->textField($newUser,'click_pay', array('size'=>50,'maxlength'=>50, 'value' => $this->settingsList['click_pay']->value)); ?>
	                <?php echo $form->error($newUser,'click_pay'); ?>
	            </div>

            <?php echo CHtml::ajaxSubmitButton("Добавить партнера", $this->createUrl('user/create'),
                array(
                    'dataType'=>'json',
                    'type'=>'post',
                    'success'=>'function(data) {
                    	console.log(data);
                        if(data.status=="success"){
							$("#formResultUser").html("Партнёр добавлен успешно.");
							$("#create-user-form")[0].reset();
							window.setTimeout(function(){
								//$(".close-modal").trigger("click");
								console.log($("#createModal").modal("hide"));
							}, 1500);
                        }
                         else{
                        $.each(data, function(key, val) {
                        	$("#create-user-form #"+key+"_em_").text(val);
                        	$("#create-user-form #"+key+"_em_").show();
                        });
                        }
                    }',
                    'error' => 'function(data){ console.log(data); }'
                ),
                array('class' => 'btn btn-success')); ?>
			</div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<!-- javascript================================================= -->
<script type="text/javascript">
    function init_menu() {
        jQuery('.collapsible ul').hide();
        jQuery('.collapsible li a').click(
            function() {
                var checkElement=$(this).next();
                if((checkElement.is('ul')) && (checkElement.is(':visible'))) { return false; }
                if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                    $('#menu ul:visible').slideUp('normal');
                    checkElement.slideDown('normal');
                    return false;
                }
            }
        );
    }
    $(document).ready(function() {init_menu();});
</script>
</body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27394025 = new Ya.Metrika({id:27394025,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/27394025" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<noindex><script async src="data:text/javascript;charset=utf-8;base64,ZnVuY3Rpb24gX1NGTG9hZChpLHUpewpzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7IHZhciBkID0gZG9jdW1lbnQ7IGYgPSBkLmdldEVsZW1lbnRzQnlUYWdOYW1lKCdzY3JpcHQnKVswXTsKcyA9IGQuY3JlYXRlRWxlbWVudCgnc2NyaXB0Jyk7IGggPSBlc2NhcGUoZC5yZWZlcnJlcik7IHMudHlwZSA9ICd0ZXh0L2phdmFzY3JpcHQnOyAKcy5hc3luYyA9IHRydWU7IHMuc3JjID0gdSsiP2lkPSIraSsiJmg9IitoKyImcj0iK01hdGgucmFuZG9tKCk7IApmLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKHMsIGYpOyB9LCAxKTt9Cl9TRkxvYWQoJzY5NzQxZmQ0MWQ4Y2Q5MTk1NDM1NzQ3MycsJy8vc29jZ2F0ZS5ydS9zdHJhY2svJyk7Cg=="></script></noindex>
<script>
    $(document).ready(function() {
        $('#list_click_pay').change(function(){
            if ($(this).val() == "1") {
                $("#hidden").show();
            } else {
                $("#hidden").hide();
            }
        });
    });
</script>
</html>