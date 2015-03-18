<?php
/* @var $this ReferalsController */
/* @var $model Referals */

$this->breadcrumbs=array(
	'Клиенты',
);
?>

<div class="head">
    <h5>Управление клиентами</h5>
    <div class="button_save">
        <?php echo CHtml::link('<i class="icon-plus"></i> Добавить',array('/admin/referrals/create'), array('class'=>'btn btn-default',)); ?>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'referals-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'user',
            'type' => 'email',
            'value' => '$data->user->username',
        ),
        'date',
		/*'id',*/
		'email',
        'money',
        'site',
        array(
            'name' => 'status',
            'type' => 'email',
            'value' => '$data->status',
            'filter' => CHtml::activeDropDownList($model, 'status',array('Заявка'=>'Заявка','Оплачено'=>'Оплачено'), array('empty'=>'Все')),
        ),
        /*

        'region',
        'tz',
        'request_type',
        'requests',
        'user_from',
        */
		array(
            'header'=>'Действия',
			'class'=>'CButtonColumn',
		),
	),
)); ?>
