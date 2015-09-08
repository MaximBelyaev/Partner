<?php $usr = (isset($model->user)) ? $model->user->username : '(пользователь не найден в базе)'; ?>
<p>
	Пользователь <strong><?= $usr ?></strong> подал заявку на вывод средств
</p>
<?php if (isset($model->user)) { ?>
<p>
	<?= CHtml::link(
			'Редактировать заявку',
			array('/admin/stateds/update/', 'id' => $model->stated_id ),
			array('target' => '_blank')
	); ?>
</p>
<?php } ?>