
<p>
	Пользователь <strong><?= $model->user->username ?></strong> установил название своего сайта 
	<a href="<?= $model->user->site ?>" target="_blank"><strong><?= $model->user->site ?></strong></a>
</p>
<p>
	<?= CHtml::link(
			'Редактировать пользователя',
			array('/admin/user/update', 'id' => $model->user_id ),
			array('target' => '_blank')
	); ?>
</p>