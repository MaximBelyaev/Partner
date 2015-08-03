<?php
/* @var $this NotificationsController */

$this->breadcrumbs=array(
	'Уведомления',
);
$this->setPageTitle("Уведомления | Партнерская программа Павлуцкого Александра");
?>
<div class="block full-page-block">

<div class="head">
	<h5>Уведомления</h5>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->search(9),
	//'dataProvider' => $dataProvider,
	'summaryText' => '',
	'htmlOptions' => array( 'class' => 'grid-view has-filter'),
	'filter' => $model,
    'pager'=> array(  
        'header'        => '',
        'prevPageLabel' => 'Назад',
        'nextPageLabel' => 'Далее',    
    ),
	'columns' => array(
		array(
            'header' => 'ID',
			'name' => 'notification_id',
			'htmlOptions' => array('class' => 'notification-id-col'),
		),
		'user.username',
		array(
			'name' => 'theme',
			'value' => 'Notifications::$themes_aliases[$data->theme]',
		),
		array(
			'name' => 'date',
			'header' => 'Дата',
			'value' => 'date("d.m.Y", strtotime($data->date));',
		),
		array(
			'name' => 'is_new',
			'value' => '($data->is_new)?"Новое":"Просмотрено"',
		),
		array(
            'header'=>'Ред',
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

</div>
