<?php

$this->setPageTitle("Список лендингов");
?>

<div class='block full-page-block'>

    <div class="head">
        <h5>
            Доступные офферы
        </h5>
    </div>
    
    <div class="grid-view">
		
		<section class="offers-items pseudo-table">
			<div class="pseudo-table-head">
				<span class="off-land">Оффер</span><!-- 
				 --><span class="off-st">Процент с продаж</span><!-- 
				 --><span class="off-click">Стоимость перехода</span><!-- 
				 --><span class="off-click">Фиксированная оплата</span><!--
				 --><span class="off-action">Действие</span>
			</div>

			<div class="pseudo-table-body">
				<?php foreach ($offersList as $landing) { ?>
				<div>
					<span class="off-land"><?= $landing->name ?></span><!--  
					 --><span class="off-st">
					 		<?php 
					 			$ls = $landing->standard; 
					 			echo $ls;
					 			if ($ls) { echo " %"; }
					 		?>
					 	</span><!-- 
					 --><span class="off-click">
							<?php 
								$lcp = $landing->click_pay && $landing->use_click_pay? $landing->click_pay : '';
								echo $lcp;
							?> 
						</span><!--
					--><span class="off-click">
							<?php
                            $lfp = $landing->fixed_pay && $landing->use_fixed_pay ? $landing->fixed_pay : '';
                            echo $lfp;
                            ?>
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