<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users',
);
?>

<div class="head">
    <h5>Управление партнерами</h5>
    <div class="button_save">
        <?php /*echo CHtml::link('<i class="icon-plus"></i> Добавить',array('/admin/user/create'), array('class'=>'btn btn-success',)); */?>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
        'reg_date',
        array(
            'header' => 'ref id',
            'name' => 'id',
        ),
		'username',
		'password',
        array(
            'name'=>'money',
            'type' => 'raw',
            'value' => '$data->profit ? $data->profit : \'be\'',
        ),
        array(
            'header'=>'Всего заработано',
            'type' => 'raw',
            'value' => '$data->fullProfit ? $data->fullProfit : \'be\'',
        ),
        array(
            'header'=>'Всего переходов',
            'type' => 'raw',
            'value' => '$data->Request ? $data->Request : \'0\'',
        ),
        array(
            'header'=>'Всего заказов',
            'type' => 'raw',
            'value' => '$data->Refer ? $data->Refer : \'0\'',
        ),
		/*
		'birth_date',
		'sex',
		'country',
		'region',
		'city',
		'avatar',
		'verification',
		'active',
		'telephone',
		*/

        array(
            'header'=>'Действия',
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
	),
))); ?>
