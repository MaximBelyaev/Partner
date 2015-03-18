<?php
/* @var $this StatedsController */
/* @var $model Stateds */

$this->breadcrumbs=array(
	'Заявки на вывод средств',
);
?>

<div class="head">
    <h5>Управление заявками</h5>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stateds-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
			'class'=>'CButtonColumn',
		),
	),
)); ?>
