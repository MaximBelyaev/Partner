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
    <div >
        <div class="commercial-left">
        	<div id="tooltip">Текст скопирован</div>
            <div class="commercial-block">
                <label for="link">Рекламная ссылка:</label>
                <input 
                    id="link" 
                    type="text"
                    disabled 
                    onclick="this.select()" 
                    value="<?= $this->settingsList['landing_link']->value ?>"
                >
                <button 
                	class="btn btn-primary copy_button" 
                	data-clipboard-target="link"
                >Скопировать</button>
            </div>
            <div class="commercial-block">
                <label for="User_promo_code">
                    Промокод
                    <a href="#" id="change_promo_code">Изменить</a>
                </label>
                <?php echo CHtml::activeTextField(
                    $this->user,
                    'promo_code', 
                    array(
                        'default' => $this->user->promo_code,
                    )
                ) ?>                
                <button 
                	class="btn btn-primary copy_button"
                	data-clipboard-target="User_promo_code"
                >Скопировать</button>
            </div>
        </div>


		<div class="commercial-right">

		<?php if (count($promovideosList)) { ?>
		<div class="commercial-videos-block">
			<label for="User_promo_code">
				Видео ссылка
			</label>
			<?php foreach ($promovideosList as $v_key => $video) { ?>
			<div class="commercial-block commercial-video-block">
				<input 
					type="text" 
					disabled 
					id="video_<?= $v_key ?>"
					value="<?= $video->link; ?>"
				>
				<button 
					class="btn btn-primary copy_button"
					data-clipboard-target="video_<?= $v_key ?>"
				>Скопировать</button>
			</div>
			<?php } ?>
		</div> 
		<?php } ?>

		<?php if (count($bannersList)) { ?>
		<div class="commercial-banners-block">
			<?php foreach ($bannersList as $b_key => $banner) { ?>
			<div class="commercial-block banner-block">
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
						<textarea onclick="this.select()" id="txtr_<?= $b_key ?>">
<?= $banner->code; ?>
						</textarea>
						<button 
							class="btn btn-primary copy_button"
							data-clipboard-target="txtr_<?= $b_key ?>"
						>Скопировать</button>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>