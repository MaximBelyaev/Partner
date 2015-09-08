<?php
/* @var $this NotificationsController */

$this->breadcrumbs=array(
	'Notifications'=>array('/admin/notifications'),
	'Просмотр',
);
$usr = (isset($model->user)) ? $model->user->username : '(пользователь не найден в базе)';
$this->setPageTitle('Уведомление от' . $usr . '| Партнерская программа Павлуцкого Александра');
?>

<div class="block full-page-block">
	
	<div class="head">
		<h5>Уведомление <?= $model->notification_id ?> за <?= $model->date ?></h5>
	</div>

	<div class="text-block not-block">
	<?php $this->renderPartial( 'tpl/' . $model->theme ,array(
		'model'=>$model,
	)); ?>
	</div>

</div>
