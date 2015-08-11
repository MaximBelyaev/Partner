<?php

$this->breadcrumbs=array(
	$this->module->id,
);
$this->setPageTitle("Главная | Партнерская программа Павлуцкого Александра");
?>
<div class="block">
	
	<div class="statistics-head">
		<h5>График</h5>
	</div>

	<div class="stats_block">
		<div class="top_buttons">
			<!-- 
				data-start и data-end - это промежуток времени для которого выбирается статистика.
				формат - количество СЕКУНД и эпохи UNIX
			-->		
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
		<div class="preloader"></div>
		<div class="preloader_wrap"></div>
		<div id="chart"></div>
		<div id="tooltip"></div>
	</div>
</div>

<div class="block next-block">
	
	<div class="statistics-head">
		<h5>Статистика</h5>
	</div>

	<div id="stats">
		<div class="preloader"></div>
		<div class="preloader_wrap"></div>
		<div class="stats_header stats_row">
			<p>Дата</p>
			<p>Переходы</p>
			<p>Клиенты</p>
			<p>Заказы</p>
			<p>Прибыль</p>
		</div>
		<div class="stats_content"></div>
	</div>

</div>
