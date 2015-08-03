<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Новости',
);
$this->menu=array(
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
$this->setPageTitle("Новости | Партнерская программа Павлуцкого Александра");
?>


<div class="block full-page-block">
	
	<div class="head">
		<h5>
            Новости
        </h5>
	</div>	

<?php
$columns = array(
    'date',
    'header',
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
);

if (!Yii::app()->session['landing'])
{
    $landing_column = array(
        'name' => 'land_id',
        'type' => 'html',
        'htmlOptions' => array('class' => 'width125'),
        'headerHtmlOptions' => array('class' => 'width125'),
        'filterHtmlOptions' => array('class' => 'width125'),
        'value' => 'isset($data->landing)?$data->landing->name:""',
    );
    array_splice($columns, -1, 0, array($landing_column));
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $dataProvider,
	'htmlOptions' => array('class'=>'grid-view red'),
	'summaryText'   => '',
	'columns' => $columns,
	'pager'=> array(  
		'header'		=> '',
		'prevPageLabel' => 'Назад',
		'nextPageLabel' => 'Далее',
	),
    //'filter' => $model,
)); ?>

</div>
