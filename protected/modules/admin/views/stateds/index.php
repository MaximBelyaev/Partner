<?php
/* @var $this StatedsController */
/* @var $model Stateds */

$this->breadcrumbs=array(
	'Заявки на вывод средств',
);
$this->setPageTitle("Заявки на вывод средств | Партнерская программа Павлуцкого Александра");
?>

<div class="block full-page-block">

	<div class="head">
		<h5>Управление заявками</h5>
	</div>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'stateds-grid',
		'dataProvider'=>$model->search(),
		'summaryText' => '',
		'filter'=>$model,
		'htmlOptions' => array('class'=>'grid-view purple has-filter'),
    	'columns'=>array(
            array(
                'name' => 'user',
                'type' => 'email',
                'value' => '$data->user->username',
            ),
            'date',
            'pay_type',
            'requisites',
    		'money',
    		'status',
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
    	),
    )); ?>

</div>