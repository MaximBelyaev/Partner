<?php ob_start(); ?>
<a title="" target="_blank" href="<?= !is_null($banner->landing) ? $banner->landing->link : "" ?>?refer_id=<?= $user->id?>">
   <img src="<?= Yii::app()->getBaseUrl(true) . "/uploads/" . $banner->image?>" alt="рекламный баннер"
        width="<?= $banner->width ?>" height="<?= $banner->height ?>"/>
</a>
<?php $banner->code = ob_get_contents(); ob_end_flush();?>