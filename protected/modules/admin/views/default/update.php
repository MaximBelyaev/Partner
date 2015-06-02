<div class="head">
	<h2>Обновление</h2>
</div>

<div class="grid-view">
	
	<?php #if($hasUpdate) { ?>
	<p>Есть новое обновление</p>
	
	<p>
		<button id="sys_update">Обновить систему</button>		
		<span class='preloader upd'></span>
		
		<div class="upd_msg"></div>
	</p>

	<?php #} ?>

	<p>Текущая версия: <strong> <?= $meta->current_version ?> </strong> </p>

	<p>Последняя доступная версия: <strong> <?= $meta->latest_version ?> </strong> </p>
	
	<p>Ваш статус: <strong> <?= $meta->current_status ?> </strong> </p>
	

</div>
