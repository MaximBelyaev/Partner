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
</div>

<?php 

$columns = array(
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
    array(
        'name' => 'status',
        'type' => 'html',
        'value' => '$data->status',
        'filter' => CHtml::activeDropDownList($model, 'status',array('Заявка'=>'Заявка','Оплачено'=>'Оплачено'), array('empty'=>'Все')),
    ),
    array(
        'name' => 'landing',
        'type' => 'raw',
        'value' => '$data->getLandingIcon()',
    ),
    /*
    'region',
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
);
if (Yii::app()->session['landing']) {
	$landing_column = array(
		'name'=>'land_id',
		'type'=>'html',
		'value'=>'$data->getLandingIcon()',
	);
	array_splice($columns, -1, 0, array($landing_column));
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'			=> 'referals-grid',
	'dataProvider'	=> $model->search(),
	'filter'		=> $model,
	'columns'		=> $columns
));
?>