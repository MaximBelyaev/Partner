<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?= $this->pageTitle ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="<?php echo $this->module->assetsUrl ?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->module->assetsUrl ?>/css/main.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->module->assetsUrl ?>/css/news.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/preloader.css" rel="stylesheet" type="text/css" />


	<link href="<?php echo Yii::app()->getBaseUrl(true); ?>/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.standalone.css" rel="stylesheet" type="text/css" />	
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/js/easydropdown-master/themes/easydropdown.partner.css" rel="stylesheet" type="text/css" />   

    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery.js" ></script>
    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/flot/jquery.flot.js" ></script>
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/flot/jquery.flot.time.js" ></script>
    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/easydropdown-master/jquery.easydropdown.min.js" ></script>

	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" ></script>
    
	<?php //Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
	<script src="<?php echo $this->module->assetsUrl ?>/js/script.js"></script>
</head>
<body class="skin-blue">

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner top-nav">
			<div class="container-fluid">
			<img 
				src="/img/Burger.svg"
				alt="menu Open"
				id="mob-menu-trigger" data-for="sidebar">

				<div class="nav pull-left for-logo">
					<?= CHtml::link('<img src="/img/Logo.svg">', array('/user/user/index'), array('class'=>'logo')); ?>
				</div>
				<div class="nav pull-left landing_select select-wrap ">
					<?php if (!is_null(Yii::app()->controller->offers)) {
						echo CHtml::dropDownList(
							'landing_select', Yii::app()->session['landing'],
							Yii::app()->controller->landings,
							array('id' => 'landing_select', 'class' => 'dropdown')
						); ?>
					<?php } ?>
				</div>
                <div class="nav pull-left">
                    <span class="menu-profit"><?= Yii::app()->controller->user->profit ?>&nbsp;₽</span>
                </div>
				<ul class="nav pull-right" id="yw0">
					<li>
						<span>
							<?= @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/User.svg') ?>
							<?= Yii::app()->controller->user->username ?>
						</span>
					</li>
					<li>
						<a href="/user/user/logout">
							<?= @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/Exit.svg') ?>
							Выйти
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

    <div id="sidebar">
        <?php 
            $menu_array = array(
                'items'=>array(
                    array(
                        'label' => @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/Landings.svg') 
                        . 'Вывод средств',
                        'url'   => array('/user/user/payRequest'),
                        'itemOptions' => array('class'=>'item-profit'),
                    ),
                    array(
                        'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/Reklama.svg') 
                        . 'Рекламные материалы',
                        'url'=>array('/user/user/commercial'),
                        'itemOptions' => array('class'=>'item-adv'),
                    ),
                    array(
                        'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/News.svg')
                        . 'Новости ' . 
                        ((Yii::app()->controller->news_to_watch)
                            ?  
                            "<strong class='nots'>+" . Yii::app()->controller->news_to_watch . "</strong>"
                            : ''
                        ),
                        'url'=>array('/user/news/index'),
                        'itemOptions' => array('class'=>'item-news'),
                    ),
                    array(
                        'label' => @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/Offers.svg') 
                        		. 'Офферы',
                        'url'   => array('/user/user/offers'),
                        'itemOptions' => array('class'=>'item-offers'),
                    ),
                    array(
                        'label'=> @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/Settings.svg') 
                        . 'Настройки',
                        'url'=>array('/user/user/data'),
                        'itemOptions' => array('class'=>'item-settings'),
                    ),
                    array(
                    	'label' => @file_get_contents(Yii::app()->getBaseUrl(true) . $this->module->assetsUrl . '/img/Contacts.svg')
                    	. 'Контакты',
                    	'url' => '#settingsModal', 
                        'itemOptions' => array(
                        	'data-toggle' => 'modal',
                        	'data-target' => "#settingsModal"
                        ),
                    )
                ),
                'htmlOptions'=>array(
                    'class'=>'side-nav accordion_mnu collapsible',
                    'id'=>'menu',
                ),
                'encodeLabel'=>false,
            );

            $this->widget('zii.widgets.CMenu', $menu_array); 
        ?>
    </div>
	<div id="sidebar-overlay"></div>
	<div id="main-content">
	    <div class="container-fluid">
	        <div class="main-content">
	            <?php echo $content; ?>
				
				<footer class="block">
					© Работает на технологии
					<a href="http://getpartner.pro/" target="_blank">
						GetPartner	
					</a>
				</footer>
	        </div>
	    </div>
	</div>

	

<div id="settingsModal" class="modal hide fade settings-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
				×
			</button>
			<h4 class="modal-title">Обратная связь</h4>

			<?php if ( Yii::app()->controller->settingsList['vk']->status == 1 ) { ?>
				<p>
					<img src="<?php echo $this->module->assetsUrl ?>/img/c-vk.png">
					<a 
						href="<?= Yii::app()->controller->settingsList['vk']->value; ?>" 
						target="_blank">
						<?= Yii::app()->controller->settingsList['vk']->value; ?>
					</a>
				</p>	
			<?php } ?>

			<?php if ( Yii::app()->controller->settingsList['skype']->status == 1 ) { ?>
				<p>
					<img src="<?php echo $this->module->assetsUrl ?>/img/c-skype.png">
					<a href="skype:<?= Yii::app()->controller->settingsList['skype']->value; ?>">
						<?= Yii::app()->controller->settingsList['skype']->value; ?>
					</a>
				</p>
			<?php } ?>

			<?php if ( Yii::app()->controller->settingsList['email']->status == 1 ) { ?>
				<p>
					<img src="<?php echo $this->module->assetsUrl ?>/img/c-mail.png">
					<a href="mailto:<?= Yii::app()->controller->settingsList['email']->value; ?>">
						<?= Yii::app()->controller->settingsList['email']->value; ?>	
					</a>
				</p>
			<?php } ?>

			<?php if ( Yii::app()->controller->settingsList['phone']->status == 1 ) { ?>
				<p>
					<img src="<?php echo $this->module->assetsUrl ?>/img/c-phone.png">
					<a href="tel:<?= Yii::app()->controller->settingsList['phone']->value; ?>">
						<?= Yii::app()->controller->settingsList['phone']->value; ?>					
					</a>
				</p>	
			<?php } ?>
			

			<div class="clear"></div>
		</div>
	</div>
</div>


</body>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl ?>/js/bootstrap.js"></script>
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

</html>
