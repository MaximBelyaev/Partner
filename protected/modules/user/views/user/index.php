<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="small-box bg-green">
    <div class="inner">
    	<h3>
            Ваша статистика:
        </h3>
        <div class="tableClients">
        <div class="head">
            <div class="date">Дата</div>
            <div class="referrers_count">Кол-во переходов</div>
            <div class="check_count">Заявка</div>
            <div class="check_users">Оплачено</div>
            <div class="referrers_site">Сайт оплатившего</div>
            <div class="percent">Прибыль</div>
        </div>

        <?php foreach($statistic as $data): ?>
            <?php $this->renderPartial('_referrals', array('data'=>$data)); ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>


