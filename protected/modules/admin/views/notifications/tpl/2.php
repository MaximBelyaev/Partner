<?php $usr = (isset($model->user)) ? $model->user->username : '(пользователь не найден в базе)';
      $site =   (isset($model->user)) ? $model->user->username : '(сайт не найден в базе)';
?>
<p>
	Пользователь <strong><?= $usr ?></strong> установил название своего сайта
	<a href="<?= $site ?>" target="_blank"><strong><?= $site ?></strong></a>
</p>
<?php if (isset($model->user)) { ?>
<p>
	<?= CHtml::link(
			'Редактировать пользователя',
			array('/admin/user/update', 'id' => $model->user_id ),
			array('target' => '_blank')
	); ?>
</p>
<?php } ?>