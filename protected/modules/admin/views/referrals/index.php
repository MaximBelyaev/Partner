<?php
/* @var $this ReferalsController */
/* @var $model Referals */

$this->breadcrumbs=array(
	'Клиенты',
);
$this->setPageTitle("Список клиентов | Партнерская программа Павлуцкого Александра");
?>

<div class='block'>

<div class="head">
    <h5>Управление клиентами</h5>
</div>

<?php 

$columns = array(
    array(
        'name' => 'email',
        'htmlOptions' => array('class' => 'width270'),
        'headerHtmlOptions' => array('class' => 'width270'),
        'filterHtmlOptions' => array('class' => 'width270'),
    ),
    array(
        'name' => 'site',
        'htmlOptions' => array('class' => 'width270'),
        'headerHtmlOptions' => array('class' => 'width270'),
        'filterHtmlOptions' => array('class' => 'width270'),
    ),
    array(
        'name' => 'user',
        'type' => 'email',
        'htmlOptions' => array('class' => 'width270'),
        'headerHtmlOptions' => array('class' => 'width270'),
        'filterHtmlOptions' => array('class' => 'width270'),
        'value' => '((isset($data->user->username))?$data->user->username:"");',
    ),
    array(
        'name' => 'money',
        'htmlOptions' => array('class' => 'width100'),
        'headerHtmlOptions' => array('class' => 'width100'),
        'filterHtmlOptions' => array('class' => 'width100'),
        'value' => '(int)($data->money)',
    ),
	array(
		'name' => 'date',
		'header' => 'Дата',
        'htmlOptions' => array('class' => 'width115'),
        'headerHtmlOptions' => array('class' => 'width115'),
        'filterHtmlOptions' => array('class' => 'width115'),
		'value' => 'date("d.m.Y", strtotime($data->date));',
	),
    array(
        'name' => 'recreate_interval',
        'type' => 'raw',
        'htmlOptions' => array('class' => 'width95'),
        'headerHtmlOptions' => array('class' => 'width95'),
        'filterHtmlOptions' => array('class' => 'width95'),
        'value' => '$data->getFormatIcons()',
    ),
    array(
        'name' => 'status',
        'type' => 'html',
        'htmlOptions' => array('class' => 'width125'),
        'headerHtmlOptions' => array('class' => 'width125'),
        'filterHtmlOptions' => array('class' => 'width125'),
        'value' => '$data->status',
        'filter' => CHtml::activeDropDownList($model, 'status',array('Заявка'=>'Заявка','Оплачено'=>'Оплачено'), array('empty'=>'Все', 'class'=>'dropdown')),
    ),
    /*
    'region',
    'requests',
    'user_from',
    */
    array(
        'header'=>'Действие',
        'class'=>'CButtonColumn',
        'htmlOptions' => array('class' => 'width120 actionColumn'),
        'headerHtmlOptions' => array('class' => 'width120 actionColumn'),
        'filterHtmlOptions' => array('class' => 'width120 actionColumn'),
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

if (!Yii::app()->session['landing']) {
	$landing_column = array(
        'name' => 'land_id',
        'type' => 'html',
        'htmlOptions' => array('class' => 'width125'),
        'headerHtmlOptions' => array('class' => 'width125'),
        'filterHtmlOptions' => array('class' => 'width125'),
        'value' => '$data->getLandingIcon()',
	);
	array_splice($columns, -1, 0, array($landing_column));
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'			=> 'referals-grid',
	'dataProvider'	=> $model->search(9),
	'summaryText'   => '',
	'filter'		=> $model,
	'htmlOptions' 	=> array('class'=>'grid-view green has-filter'),
	'columns'		=> $columns,
	'pager'=> array(  
		'header' 		=> '',
		'prevPageLabel' => 'Назад',
		'nextPageLabel' => 'Далее',    
	),
));
?>

</div>