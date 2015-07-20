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
			<?= CHtml::link('Добавить', "/admin/news/create", array('class' => 'btn btn-success')) ?>		
        </h5>
	</div>	

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	//'dataProvider' => $model->search(),
	'dataProvider' => $dataProvider,
    'summaryText'   => '',
	'pager'=> array(  
		'header'        => '',
		'prevPageLabel' => 'Назад',
		'nextPageLabel' => 'Далее',    
	),
    //'filter' => $model,
	'columns' => array(
        'date',
        'header',
        
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
))); ?>

</div>
