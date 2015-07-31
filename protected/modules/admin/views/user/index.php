<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Партнёры',
);
$this->setPageTitle("Список партнеров | Партнерская программа Павлуцкого Александра");
?>

<div class="block full-page-block">
    
<div class="head">
    <h5>
        Управление партнерами
        <?php echo CHtml::link('Добавить', array("/admin/user/create"), array('class'=>'btn btn-success', 'data-target'=> "#createModal")); ?>
    </h5>
</div>
<?php

$columns = array(
    'username',
    'id',
    'site',
    array(
        'name' => 'use_click_pay',
        'type' => 'raw',
        'value' => '$data->getFormatIcon()',
        'htmlOptions' => array('class' => 'width100'),
        'headerHtmlOptions' => array('class' => 'width100'),
        'filterHtmlOptions' => array('class' => 'width100'),
        'filter' => CHtml::activeDropDownList(
            $model,
            'use_click_pay',
            array(
                '0' => '% от заказа',
                '1' => 'За переход'
            ),
            array(
                'empty'=>'Все',
                'class' => 'dropdown'
            )
        ),
    ),
    array(
        'name' => 'status',
        'type' => 'raw',
        'value' => '"<span class=\"center_icon\">" . $data->getStatusIcon() . "</span>"',
        'htmlOptions' => array('class' => 'width120'),
        'headerHtmlOptions' => array('class' => 'width120'),
        'filterHtmlOptions' => array('class' => 'width120'),
        'filter' => CHtml::activeDropDownList(
            $model,
            'status',
            array(
                'VIP' => 'VIP',
                'Стандартный' => 'Стандартный',
                'Расширенный' => 'Расширенный'
            ),
            array(
                'empty' => 'Все',
                'class' => 'dropdown'
            )
        ),
    ),
    'reg_date',
    array(
        'name' => 'money',
        'type' => 'text',
        'value' => '(int)$data->getProfit()',
        'htmlOptions' => array('class' => 'width40'),
        'headerHtmlOptions' => array('class' => 'width40'),
        'filterHtmlOptions' => array('class' => 'width40'),
    ),
    array(
        'name' => 'fullProfit',
        'type' => 'text',
        'value' => '(int)$data->getFullProfit()',
        'filter' => CHtml::activeTextField(
            $model,
            'fullProfit',
            array('value' => '')
        ),
    ),

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
        'header'=>'Действие',
        'class'=>'CButtonColumn',
        'htmlOptions' => array('class' => 'actionColumn'),
        'headerHtmlOptions' => array('class' => 'actionColumn'),
        'filterHtmlOptions' => array('class' => 'actionColumn'),
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

// if (!Yii::app()->session['landing'])
// {
//     $landing_column = array(
//         'name' => 'land_id',
//         'type' => 'html',
//         'htmlOptions' => array('class' => 'width125'),
//         'headerHtmlOptions' => array('class' => 'width125'),
//         'filterHtmlOptions' => array('class' => 'width125'),
//         'value' => '$data->getLandingIcon()',
//     );
//     array_splice($columns, -1, 0, array($landing_column));
// }


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(9),
    'summaryText'   => '',
    //'dataProvider' => $dataProvider,
    'filter' => $model,
    'htmlOptions'   => array('class'=>'grid-view has-filter'),
    'columns' => $columns,
    'pager'=> array(  
        'header'        => '',
        'prevPageLabel' => 'Назад',
        'nextPageLabel' => 'Далее',    
    ),
));
?>

</div>
