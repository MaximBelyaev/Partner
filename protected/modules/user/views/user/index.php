<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
$this->setPageTitle("Главная | Партнерская программа Павлуцкого Александра");
?>


<div class="chart_wrap">
	<div id="chart"></div>
	<div class="chart_buttons">
		<!-- 
			data-start и data-end - это промежуток времени для которого выбирается статистика.
			формат - количество СЕКУНД и эпохи UNIX
		-->
		<button class="last_week" data-start="<?= $times['last_week'] ?>" data-end="<?= $times['now'] ?>">За неделю</button>
		<button class="last_month" data-start="<?= $times['last_month'] ?>" data-end="<?= $times['now'] ?>">За месяц</button>
		<button class="last_quater" data-start="<?= $times['last_quater'] ?>" data-end="<?= $times['now'] ?>">За квартал</button>
		<button class="last_year" data-start="<?= $times['last_year'] ?>" data-end="<?= $times['now'] ?>">За год</button>
	</div>
</div>


<div class="small-box bg-green">
    <div class="inner">
    	<h3>
    		Обновлено!
    	</h3>
		<?php if (count($statistic) ) { ?>
		<h3 class="stat_header">
			Ваша статистика:
		</h3>
		<div class="main_month_stat">
			<div class="stat_row stat_header">
				<div class="datecol">
					Дата 
					<div id="date_icon" title="Выберите временной промежуток"></div>
					<div class="input-daterange" data-enddate="<?= date('d-m-Y', $times['now']) ?>" data-startdate="01-01-2014">
						<input type="text" class="range range_start input-small" value="<?= date('d-m-Y', $times['last_quater']) ?>" />
						<input type="text" class="range range_end input-small" value="<?= date('d-m-Y', $times['now']) ?>" />
						<button id="show_range">
							Показать
						</button>
					</div>
				</div>
				<div>Переходы</div>
				<?php if (!$user->use_click_pay) { ?>
				<div>Заявки</div>
				<div>Заказы</div>
				<?php } ?>
				<div>Прибыль</div>
			</div>
		</div>
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
	
	<section id="stats">
		
	</section>	
	<!--
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
	-->

    </div>
</div>

<script type="text/javascript">
	
	$(".month_header").click(function(){
		$(this).toggleClass("open");
	});


</script>
