<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users',
);
$this->setPageTitle("Список партнеров | Партнерская программа Павлуцкого Александра");
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
	//'dataProvider' => $dataProvider,
    'filter' => $model,
	'columns' => array(
        'username',
        'id',
        'site',
        array(
            'name' => 'status',
            'type' => 'text',
            'value' => '$data->status',
            'filter' => CHtml::activeDropDownList($model, 'status',array('VIP'=>'VIP','Стандартный'=>'Стандартный','Расширенный'=>'Расширенный'), array('empty'=>'Все')),
        ),
        'reg_date',
        'money.profit',
        'money.full_profit',
        /*
        array(
            'name'=>'profit',
            'type' => 'raw',
            'value' => '$data->profit ? $data->profit : \'be\'',
        ),
        array(
            'header'=>'Всего заработано',
            'type' => 'raw',
            'value' => '$data->fullProfit ? $data->fullProfit : \'be\'',
        ),
        */
        'requests_count',
        'referrals_count',
        'referrals_payed_count',
        /*array(
            'header' => "Оплата",
            'name' => 'use_click_pay',
            'value'  => '$data->renderClickPay()'
        ),
//        'use_click_pay',
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
