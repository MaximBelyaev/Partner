<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
$this->setPageTitle("Главная | Партнерская программа Павлуцкого Александра");
?>
<div class="small-box bg-green">
    <div class="inner">
		<?php if (count($statistic) ) { ?>
		<h3 class="stat_header">
			Ваша статистика:
		</h3>
		<?php } else { ?>
		<h3 class="stat_header">
			Здесь будет ваша статистика!
		</h3>
		<p>
			Используйте вашу партнерскую ссылку, 
			промокод и рекламные материалы для привлечения клиентов
		</p>
		<p>
			Высокой вам конверсии! 
		</p>		
		<?php } ?>


    <?php if ($user->use_click_pay) { ?>

			<?php foreach ($statistic as $i => $month){ ?>

			<h3 class="month_header <?= (!$i)?'open':''?> "><?= $month['month']?></h3>
			<div class="month_stat">

				<div class="stat_row stat_header day">
					<div class="">Дата</div>
					<div class="">Переходы</div>
					<div class="">Прибыль</div>
				</div>

				<?php foreach ($month['data'] as $day){ ?>
					
					<div class="stat_row day">
						<div class=""><?= $day['date'] ?></div>
						<div class=""><?= $day['followers'] ?></div>
						<div class=""><?= $day['profit'] ?></div>
					</div>
				
				<?php } ?>
				<div class="stat_row month_total">
					<div class="">Всего</div>
					<div class=""><?= $month['total']['requests'] ?></div>
					<div class=""><?= $month['total']['total_profit'] ?></div>
				</div>
			</div>
			<?php } ?>

    <?php } else { ?>

    	<?php foreach ($statistic as $i => $month){ ?>
			<h3 class="month_header <?= (!$i)?'open':''?>"><?= $month['month']?></h3>
			<div class="month_stat">

				<div class="stat_row stat_header day">
					<div class="">Дата</div>
					<div class="">Переходы</div>
					<div class="">Заявки</div>
					<div class="">Заказы</div>
					<div class="">Сайты</div>
					<div class="">Прибыль</div>
				</div>

				<?php foreach ($month['data'] as $day){ ?>

					<div class="stat_row day">
						<div class=""><?= $day['date'] ?></div>
						<div class=""><?= $day['followers'] ?></div>
						<div class=""><?= $day['referrals'] ?></div>
						<div class=""><?= $day['payed'] ?></div>
						<div class=""><?= $day['sites'] ?></div>
						<div class=""><?= $day['profit'] ?></div>
					</div>
				
				<?php } ?>
				<div class="stat_row month_total">
					<div class="">Всего</div>
					<div class=""><?= $month['total']['followers'] ?></div>
					<div class=""><?= $month['total']['referrals'] ?></div>
					<div class=""><?= $month['total']['payed_referrals'] ?></div>
					<div class=""></div>
					<div class=""><?= $month['total']['total_profit'] ?></div>
				</div>
			</div>
			<?php } ?>

    <?php } ?>


    </div>
</div>

<script type="text/javascript">
	
	$(".month_header").click(function(){
		$(this).toggleClass("open");
	});


</script>
