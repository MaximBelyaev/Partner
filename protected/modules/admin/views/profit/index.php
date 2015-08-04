<?php
/* @var $this ProfitController */
/* @var $model Profit */

$this->breadcrumbs=array(
	'Profits'=>array('index'),
	'Manage',
);
?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'profit',
        array(
            'header'=>'Действия',
            'class'=>'CButtonColumn',
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
	),
)); ?>
