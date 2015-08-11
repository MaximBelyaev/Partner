<p>
	Пользователь <strong><?= $model->user->username ?></strong> подал заявку на вывод средств 
</p>
<p>
	<?= CHtml::link(
			'Редактировать заявку',
			array('/admin/stateds/update/', 'id' => $model->stated_id ),
			array('target' => '_blank')
	); ?>
</p>