<?php
/* @var $this ReferalsController */
/* @var $model Referals */

$this->breadcrumbs=array(
	'Клиенты',
);
$this->setPageTitle("Список клиентов | Партнерская программа Павлуцкого Александра");
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
        'email',
        'site',
        array(
            'name' => 'user',
            'type' => 'email',
            'value' => '((isset($data->user->username))?$data->user->username:"");',
        ),
        'money',
        'date',
        array(
            'name' => 'recreate_interval',
            'type' => 'raw',
            'value' => '$data->getFormatIcons()',
        ),
		/*'id',*/
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
            'header'=>'Редактировать',
            'class'=>'CButtonColumn',
            'template'=>'<span class="not_btn not_upd">{update}</span><span class="not_btn not_del">{delete}</span>',
            'buttons'=>array
            (
                'update' => array
                (
                    'label'=>'',
                    'options' => array(
                        'class' => "icon-pencil icon-white"
                    ),
                    'imageUrl'=>'',
                ),
                'delete' => array
                (
                    'label'=>'',
                    'options' => array(
                        'class' => "icon-trash icon-white"
                    ),
                    'imageUrl'=>'',
                ),
            ),
        ),
	),
));
?>