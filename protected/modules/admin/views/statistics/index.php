<?php  

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($this->module->assetsUrl.'/js/statistic.js');



?>
<div class="stats_block">
	<div class="top_buttons">
		<button id="date_icon">Отрезок времени</button>
		<div class="input-daterange" data-enddate="<?= date('d-m-Y', $times['now']) ?>" data-startdate="01-01-2014">
			<input type="text" class="range range_start input-small" value="<?= date('d-m-Y', $times['last_quater']) ?>" />
			<input type="text" class="range range_end input-small" value="<?= date('d-m-Y', $times['now']) ?>" />
			<button id="show_range">Показать</button>
		</div>
		<button class="last_week" data-start="<?= $times['last_week'] ?>" data-end="<?= $times['now'] ?>">За неделю</button>
		<button class="last_month" data-start="<?= $times['last_month'] ?>" data-end="<?= $times['now'] ?>">За месяц</button>
		<button class="last_quater current_range" data-start="<?= $times['last_quater'] ?>" data-end="<?= $times['now'] ?>">За квартал</button>
		<button class="last_year" data-start="<?= $times['last_year'] ?>" data-end="<?= $times['now'] ?>">За год</button>
	</div>
</div>

<div class="chart_wrap">
	<div class="preloader"></div>
	<div class="preloader_wrap"></div>
	<div id="chart"></div>
	<div class="chart_buttons">
		<!-- 
			data-start и data-end - это промежуток времени для которого выбирается статистика.
			формат - количество СЕКУНД и эпохи UNIX
		-->
		<button class="current_type" data-type="user">Партнеры</button>
		<button class="" data-type="referrals">Клиенты</button>
		<button class="" data-type="requests">Переходы</button>
		<button class="" data-type="referrals_z">Заявки</button>
		<button class="" data-type="payed">Заказы</button>
	</div>
</div>

<div class="table_wrap">
	<div class="table_top_buttons">
		<button id="date_table">Отрезок времени</button>
		<div class="input-daterange" data-enddate="<?= date('d-m-Y', $times['now']) ?>" data-startdate="01-01-2014">
			<input type="text" class="range range_start input-small" value="<?= date('d-m-Y', $times['last_quater']) ?>" />
			<input type="text" class="range range_end input-small" value="<?= date('d-m-Y', $times['now']) ?>" />
			<button id="table_show_range">Показать</button>
		</div>
		<button class="last_week" data-start="<?= $times['last_week'] ?>" data-end="<?= $times['now'] ?>">За неделю</button>
		<button class="last_month" data-start="<?= $times['last_month'] ?>" data-end="<?= $times['now'] ?>">За месяц</button>
		<button class="last_quater current_range" data-start="<?= $times['last_quater'] ?>" data-end="<?= $times['now'] ?>">За квартал</button>
		<button class="last_year" data-start="<?= $times['last_year'] ?>" data-end="<?= $times['now'] ?>">За год</button>
	</div>
	<div class="preloader"></div>
	<div class="preloader_wrap"></div>
	<div id="stats">
		<div class="stats_header stats_row">
			<p>Новые партнеры</p>
			<p>Клиенты</p>
			<p>Переходы</p>
			<p>Заказы</p>
			<p>Прибыль</p>
		</div>
		<div class="stats_content"></div>
	</div>
	<div class="table_buttons">
		<!-- 
			data-start и data-end - это промежуток времени для которого выбирается статистика.
			формат - количество СЕКУНД и эпохи UNIX
		<button class="current_type" data-type="user">Партнеры</button>
		<button class="" data-type="referrals">Клиенты</button>
		<button class="" data-type="requests">Переходы</button>
		-->
	</div>
	
</div>