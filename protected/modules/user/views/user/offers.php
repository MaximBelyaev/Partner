<?php

$this->setPageTitle("Список лендингов");
?>

<div class='block'>

    <div class="head">
        <h5>
            Список лендингов
        </h5>
    </div>
    
    <div class="grid-view">
		
		<section class="offers-items pseudo-table">
			<div class="pseudo-table-head">
				<span class="off-land">Лендинг</span><!-- 
				 --><span class="off-vip">VIP</span><!-- 
				 --><span class="off-ext">Расширенный</span><!-- 
				 --><span class="off-st">Стандартный</span><!-- 
				 --><span class="off-click">Переход</span><!-- 
				 --><span class="off-action">Действие</span>
			</div>

			<div class="pseudo-table-body">
				<?php foreach ($offersList as $landing) { ?>
				<div>
					<span class="off-land"><?= $landing->name ?></span><!-- 
					 --><span class="off-vip"><?= $landing->vip ?></span><!-- 
					 --><span class="off-ext"><?= $landing->extended ?></span><!-- 
					 --><span class="off-st"><?= $landing->standard ?></span><!-- 
					 --><span class="off-click">
							<?= $landing->click_pay ? $landing->click_pay : $this->settingsList['click_pay']['value'] ?>
						</span><!--
					--><span class="off-action">
						<?php if ($landing->isOffer) { ?>
							<?= CHtml::link('Отказаться', array('/user/user/offOffer/id/' . $landing->land_id), array('class'=>'btn btn-danger btn-offer')); ?>
						<?php } else { ?>
							<?= CHtml::link('Подключить', array('/user/user/onOffer/id/' . $landing->land_id), array('class'=>'btn btn-success btn-offer')); ?>
						</span>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</section>
    </div>
</div>