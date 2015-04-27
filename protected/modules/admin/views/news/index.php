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


<div>
	
	<div class="head">
		<h5>Новости</h5>
		
		<div class="button_save">
			<?= CHtml::link('<i class="icon-plus"></i> Добавить', "/admin/news/create", array('class' => 'btn btn-default')) ?>		
		</div>
	</div>	

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	//'dataProvider' => $model->search(),
	'dataProvider' => $dataProvider,
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
