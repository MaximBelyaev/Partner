<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 09.11.14
 * Time: 13:22
 */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo $this->module->assetsUrl ?>/css/Admin.css" rel="stylesheet" type="text/css" />
    
</head>
<body class="skin-blue">
<header class="header">
    <?= CHtml::link('Панель управления', array('/user/user/index'), array('class'=>'logo')); ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Войти', 'url'=>array('/user/user/login'), 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'btn btn-success')),
                array('label'=>'Регистрация', 'url'=>array('/user/user/registration'), 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'btn btn-success')),
                array('label'=>'Выйти', 'url'=>array('/user/user/logout'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'btn btn-success'))
            ),
        )); ?>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">

<?php $this->widget('user.components.widgets.CabinetMenuWidget'); ?>


    <aside class="right-side">
        <section class="content-header">
            <h1>
                Ваш партнерский аккаунт
            </h1>
        </section>
        <section class="content">

            <div class="row">
                <?php if(!Yii::app()->user->isGuest): ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                Ваша личная партнерская ссылка:
                            </h3>
                            <textarea class="linkText" onclick="this.select();">http://alexpavlutskiy.com/seo/semanticheskoe-yadro?refer_id=<?=Yii::app()->user->id; ?></textarea>
                            <h3>
                                Ваш промокод:
                            </h3>
                            <textarea class="linkText" onclick="this.select();">PROMO_<?=Yii::app()->user->id; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-lg-3 col-xs-6">
                    <?= $content; ?>
                </div>
        </section>
    </aside>

</div>
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
