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
    </h5>
</div>
<?php

$columns = array(
    'id',
    array(
        'name' => 'reg_date',
        'header' => 'Рег',
    ),
    'username',
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
    'requests_count',
    'referrals_count',
    'referrals_payed_count',
    array(
        'header'=>'Ред',
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
