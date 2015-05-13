<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
$this->setPageTitle("Рекламные материалы | Партнерская программа Павлуцкого Александра");
?>
    <text>Рекламная ссылка:</text>
    <textarea rows="1"><?= $this->settingsList['landing_link']->value ?></textarea><br>
<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::errorSummary($this->user); ?>
    <div class="row">
        <?php echo CHtml::activeLabel($this->user,'promo_code'); ?>
        <?php echo CHtml::activeTextField($this->user,'promo_code', array('default' => $this->user->promo_code)) ?>
    </div>
    <div class="row submit">
        <?php echo CHtml::submitButton('Изменить'); ?>
    </div>
<?php echo CHtml::endForm(); ?>

    <text>Рекламное видео:</text>
<ul>
<?php   foreach ($bannersList as $banner)
        {
            if ($banner->type == 'promovideo')
            {?>
                <li><textarea><?= $banner->video_link; ?></textarea></li>
<?php       } ?>
</ul>
<?php
        } ?>
<ul>
<?php   foreach ($bannersList as $banner)
        {
            if ($banner->type == 'gif')
            {?>
              <li>  <?php $this->renderPartial('_gifcode', array('settingsList' => $this->settingsList, 'user' => $this->user,
                'banner'=>$banner));
?>
        <text>Код:</text>
        <textarea><?= $banner->code; ?></textarea> </li>
<?php
            }
        }
?>