<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 09.11.14
 * Time: 13:44
 */
/* @var $this CabinetMenuWidget */
/* @var $model User */
?>
<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <?php if(!$model): ?>
            <h3>Войдите, либо зарегистрируйтесть!</h3>
        <?php else: ?>
        <div class="user-panel">
            <div class="pull-left info">
                <p><?= $model->username; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
            	<?= CHtml::link('<span class="iconNewCredit"></span> <span>На счету:&nbsp;'.$model->profit.'&nbsp; руб</span>', array('/user/user/payRequest')); ?>
            </li>
            <li class="active">
                <?= CHtml::link('<span class="iconNewMoney"></span> <span>Вывести деньги</span>', array('/user/user/payRequest')); ?>
            </li>
            <li class="active">
                <?= CHtml::link('<span class="iconAds"></span> <span>Рекламные материалы</span>', array('/user/user/commercial')); ?>
            </li>
            <li class="active">
                <?= CHtml::link('<span class="iconNews"></span> <span>Новости ' . 
                    (
                        (Yii::app()->controller->news_to_watch)
                        ?
                        "<strong class='nots'>+" . Yii::app()->controller->news_to_watch . "</strong>"
                        :
                        ""
                    ) . '</span>', array('/user/news/index')); ?>
            </li>
            <li class="active">
                <?= CHtml::link('<span class="iconComments"></span> <span>Связь с админом</span>', 'http://vk.com/im?sel=18424819', array('target'=>'blank')); ?>
            </li>
        </ul>
        <?php endif; ?>
    </section>
</aside>