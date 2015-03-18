<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <?php //Yii::app()->clientScript->registerPackage('bootstrap');?>
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/all.css" media="screen, projection" />
    <script type="text/javascript" src="asset/js/accordion.jquery.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
<div id="wrapper">

<div id="header">
    <h1><a href="dashboard.html"><?php echo 'kyky'; ?></a></h1>

    <a href="javascript:;" id="reveal-nav">
        <span class="reveal-bar"></span>
        <span class="reveal-bar"></span>
        <span class="reveal-bar"></span>
    </a>
</div> <!-- #header -->

<div id="sidebar">

        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array(
                    'label'=>'<span class="icon-home"></span>Главная',
                    'url'=>array('/admin/default/index'),
                    'itemOptions'=>array('class'=>'nav'),
                ),
                array(
                    'label'=>'<span class="icon-article"></span>Новости',
                    'url'=>array('#'),
                    'itemOptions'=>array('class'=>'nav'),
                    'submenuOptions'=>array('class'=>'subNav'),
                    'items'=>array(
                        array(
                            'label'=>'Редактировать новости',
                            'url'=>array('/admin/news/admin'),
                        ),
                        array(
                            'label'=>'Добавить новость',
                            'url'=>array('/admin/news/create'),
                        ),
                    ),
                ),
                array(
                    'label'=>'Contact',
                    'url'=>array('/site/contact'),
                    'itemOptions'=>array('class'=>'nav')
                ),
                array(
                    'label'=>'<span class="icon-trash-stroke"></span>Товары',
                    'url'=>array('#'),
                    'itemOptions'=>array('class'=>'nav'),
                    'submenuOptions'=>array('class'=>'subNav'),
                    'items'=>array(
                        array(
                            'label'=>'Редактировать товары',
                            'url'=>array('/admin/product/admin'),
                        ),
                        array(
                            'label'=>'Добавить товар',
                            'url'=>array('/admin/product/create'),
                        ),
                    ),
                ),
                array(
                    'label'=>'<span class="icon-list"></span>Категории товаров',
                    'url'=>array('#'),
                    'itemOptions'=>array('class'=>'nav'),
                    'submenuOptions'=>array('class'=>'subNav'),
                    'items'=>array(
                        array(
                            'label'=>'Редактировать категории',
                            'url'=>array('/admin/category/admin'),
                        ),
                        array(
                            'label'=>'Добавить категорию',
                            'url'=>array('/admin/category/create'),
                        ),
                    ),
                ),
            ),
            'htmlOptions'=>array(
                'id'=>'mainNav',
            ),
            'encodeLabel'=>false,
        )); ?>

</div> <!-- #sidebar -->

    <?php echo $content; ?>


<div id="topNav">
    <ul>
        <li><?php echo CHtml::link('Выйти ('.Yii::app()->user->name.')',array('default/logout')); ?></li>
    </ul>
</div> <!-- #topNav -->

</div> <!-- #wrapper -->

<div id="footer">
    Copyright &copy; 2013, Все права защищены.
</div>



</div><!-- page -->

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
