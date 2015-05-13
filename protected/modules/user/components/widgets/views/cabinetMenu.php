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
                <?= CHtml::link('<span class="iconNewMoney"></span> <span>Вывод средств:&nbsp;'.$model->profit.'&nbsp; р.</span>', array('/user/user/payRequest')); ?>
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
                <?= CHtml::link('<span class="iconSettings"></span> <span>Настройки</span>', array('/user/user/data')); ?>
            </li>
            <li class="active">
                <?= CHtml::link('<span class="iconComments"></span> <span>Связь с админом</span>'); ?>
            </li>
            <li class="active">
                <?= (Yii::app()->controller->settingsList['vk']->status == 1) ?
                    CHtml::link('<span>Вконтакте</span>',
                    Yii::app()->controller->settingsList['vk']->value, array('target'=>'blank')) : ""; ?>
            </li>
            <li class="active">
                <?= (Yii::app()->controller->settingsList['email']->status == 1) ?
                    CHtml::link('<span>Почта</span>',
                        "mailto:" . Yii::app()->controller->settingsList['email']->value) : ""; ?>
            </li>
            <li class="active">
                <?= (Yii::app()->controller->settingsList['skype']->status == 1) ?
                    CHtml::link('<span>Скайп</span>',
                    "skype:" . Yii::app()->controller->settingsList['skype']->value) : ""; ?>
            </li>
            <li class="active">
                <?= (!Yii::app()->user->isGuest) ?
                    CHtml::link('<span class="iconLogout"></span><span>Выйти</span>',
                        '/user/user/logout') : ""; ?>
            </li>


        </ul>
        <?php endif; ?>
    </section>
</aside>