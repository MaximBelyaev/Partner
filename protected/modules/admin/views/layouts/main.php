<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/main.css">
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
    <script type="text/javascript" src="<?php echo $this->module->assetsUrl ?>/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $this->module->assetsUrl ?>/js/main.js"></script>

</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner top-nav">
        <div class="container-fluid">
            <ul class="nav pull-right">
                <li><?php echo CHtml::link('<i class="icon-off icon-white"></i>Выйти ('.Yii::app()->user->name.')',array('default/logout')); ?></li>
            </ul>
        </div>
    </div>
</div>
<div id="sidebar">
    <div class="for-logo">
        <?= CHtml::link('Панель администратора', array('/admin/referrals/index'), array('class'=>'logo')); ?>
    </div>
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(

            array(
                'label'=>'<i class="icon-home"></i>Клиенты',
                'url'=>array('/admin/referrals/index'),
            ),
            array(
                'label'=>'<i class="icon-list"></i>Партнеры',
                'url'=>array('/admin/user/index'),
            ),
             array(
                'label'=>'<i class="icon-book"></i>Заявки на вывод средств',
                'url'=>array('/admin/stateds/index'),
            ),
            array(
                'label'=>'<i class="icon-user"></i>Перейти в партнерку',
                'url'=>array('/user/user/index'),
                'linkOptions'=>array('target'=>'=_blank'),
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
        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'homeLink'=>CHtml::link('Главная',array('/admin/default/index')),
			    'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
        <?php endif?>
        <div class="main-content">
            <?php echo $content; ?>
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

</html>