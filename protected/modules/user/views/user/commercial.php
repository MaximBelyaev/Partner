<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
$this->setPageTitle("Рекламные материалы | Партнерская программа Павлуцкого Александра");
?>


<div class="block">
    
    <div class="statistics-head">
        <h5>Рекламные материалы</h5>
    </div>


    <div class="row-fluid">
        <div class="span12">
    <label for="link">Рекламная ссылка:</label>
    <input id="link" type="text" disabled onclick="this.select()" value="<?= $this->settingsList['landing_link']->value ?>">
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($this->user); ?>
		</div>
	</div>	
    <div class="row-fluid">
        <div class="span12">
            <?php echo CHtml::activeLabel($this->user,'promo_code'); ?>
            <?php echo CHtml::activeTextField($this->user,'promo_code', array('default' => $this->user->promo_code)) ?>
        </div>  
    </div>
    <div class="row-fluid submit">
        <div class="span12">
            <?php echo CHtml::submitButton('Изменить'); ?>
        </div>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>


<div class="block next-block ">

    <?php if (count($promovideosList)) { ?>
		<div class="statistics-head">
			<h5>Рекламное видео:</h5>
		</div>
        
        <?php foreach ($promovideosList as $video) { ?>
            <div class="banner-block">
            	<textarea id="video"><?= $video->link; ?></textarea>
            </div>
        <?php } } ?>
        
        <?php if (count($bannersList)) { ?>
            <div class="statistics-head">
                <h5>Баннеры</h5>
            </div>
        	<?php foreach ($bannersList as $banner) { ?>
				<div class="banner-block">
					<div class="row-fluid">
						<div class="span12">
							<?php $this->renderPartial('_gifcode', array(
								'settingsList' => $this->settingsList, 
								'user' => $this->user,
								'banner' => $banner
							)); ?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label for="code">Код:</label>
<textarea onclick="this.select()">
<?= $banner->code; ?>
</textarea>
						</div>
					</div>	
				</div>
			<?php } ?>
		<?php } ?>

</div>