<?php
/* @var $this ReferalsController */
/* @var $model Referals */

$this->breadcrumbs=array(
	'Клиенты',
);
$this->setPageTitle("Список клиентов | Партнерская программа Павлуцкого Александра");
?>

<div class='block full-page-block'>

<div class="head">
    <h5>
        Управление клиентами
    </h5>
</div>

<?php 

$columns = array(
	array(
		'name' => 'date',
		'header' => 'Дата',
        'htmlOptions' => array('class' => ''),
        'headerHtmlOptions' => array('class' => ''),
        'filterHtmlOptions' => array('class' => ''),
		'value' => 'date("d.m.Y", strtotime($data->date));',
	),
    array(
        'name' => 'email',
        'htmlOptions' => array('class' => ''),
        'headerHtmlOptions' => array('class' => ''),
        'filterHtmlOptions' => array('class' => ''),
    ),
    array(
        'name' => 'site',
        'htmlOptions' => array('class' => ''),
        'headerHtmlOptions' => array('class' => ''),
        'filterHtmlOptions' => array('class' => ''),
    ),
    array(
        'name' => 'user',
        'type' => 'email',
        'htmlOptions' => array('class' => ''),
        'headerHtmlOptions' => array('class' => ''),
        'filterHtmlOptions' => array('class' => ''),
        'value' => '((isset($data->user->username))?$data->user->username:"");',
    ),
    array(
        'name' => 'money',
        'htmlOptions' => array('class' => ''),
        'headerHtmlOptions' => array('class' => ''),
        'filterHtmlOptions' => array('class' => ''),
        'value' => '(int)($data->money)',
    ),
    array(
        'name' => 'status',
        'type' => 'html',
        'htmlOptions' => array('class' => 'width90'),
        'headerHtmlOptions' => array('class' => 'width90'),
        'filterHtmlOptions' => array('class' => 'width90'),
        'value' => '$data->status',
        'filter' => CHtml::activeDropDownList($model, 'status',array('Заявка'=>'Заявка','Оплачено'=>'Оплачено'), array('empty'=>'Все', 'class'=>'dropdown')),
    ),
    /*
    'region',
    'requests',
    'user_from',
    */
    array(
        'header'=>'Ред',
        'class'=>'CButtonColumn',
        'htmlOptions' => array('class' => 'actionColumn'),
        'headerHtmlOptions' => array('class' => 'actionColumn'),
        'filterHtmlOptions' => array('class' => 'actionColumn'),
        'template'=>'<span class="icons_wrap"><span class="not_btn not_upd">{update}</span><span class="not_btn not_del">{delete}</span></span>',
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
        'htmlOptions' => array('class' => 'width60'),
        'headerHtmlOptions' => array('class' => 'width60'),
        'filterHtmlOptions' => array('class' => 'width60'),
        'value' => '(isset($data->landing)?$data->landing->name:"")',
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