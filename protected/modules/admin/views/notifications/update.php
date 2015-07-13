<?php
/* @var $this NotificationsController */

$this->breadcrumbs=array(
	'Notifications'=>array('/admin/notifications'),
	'Просмотр',
);
$this->setPageTitle("Уведомление от {$model->user->username} | Партнерская программа Павлуцкого Александра");
?>

<div class="block">
	
	<div class="head">
		<h5>Уведомление <?= $model->notification_id ?> за <?= $model->date ?></h5>
	</div>

	<div class="text-block">
	<?php $this->renderPartial( 'tpl/' . $model->theme ,array(
		'model'=>$model,
	)); ?>
	</div>

</div>
