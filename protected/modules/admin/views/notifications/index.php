<?php
/* @var $this NotificationsController */

$this->breadcrumbs=array(
	'Уведомления',
);
$this->setPageTitle("Уведомления | Партнерская программа Павлуцкого Александра");
?>
<div class="head">
	<h5>Уведомления</h5>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->search(),
	//'dataProvider' => $dataProvider,
    'filter' => $model,
	'columns' => array(
        'notification_id',
        'user.username:',
        array(
        	'name' => 'theme',
        	'value' => 'Notifications::$themes_aliases[$data->theme]',
        ),
        'date',
        array(
        	'name' => 'is_new',
        	'value' => '($data->is_new)?"Новое":"Просмотрено"',
        ),
        array(
            'header'=>'Действия',
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
	)
)) ?>
