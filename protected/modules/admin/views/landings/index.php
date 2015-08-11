<?php

$this->breadcrumbs=array( 'Партнёры' );
$this->setPageTitle("Список лендингов");
?>

<div class='block full-page-block'>

<div class="head">
	<h5>
		Лендинги
		<?= CHtml::link('Добавить',array('/admin/landings/create'), array('class'=>'btn btn-primary land-btn',)); ?>
	</h5>
</div>
	
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'landings-grid',
	'dataProvider' => $dataProvider,
	'summaryText' => '',
	'htmlOptions' => array('class'=>'grid-view orange'),
	'columns' => array(
    array(
        'name' => 'land_id',
        'htmlOptions' => array('class' => 'width60'),
        'headerHtmlOptions' => array('class' => 'width60'),
        'filterHtmlOptions' => array('class' => 'width60'),
    ),
    array(
        'name' => 'link',
        'htmlOptions' => array('class' => 'width595'),
        'headerHtmlOptions' => array('class' => 'width595'),
        'filterHtmlOptions' => array('class' => 'width595'),
    ),
    array(
        'name' => 'name',
        'htmlOptions' => array('class' => 'width595'),
        'headerHtmlOptions' => array('class' => 'width595'),
        'filterHtmlOptions' => array('class' => 'width595'),
    ),
		/*array(
			'name' => 'icon',
			'value' => '$data->icon ? CHtml::image("/uploads/" . $data->icon, $data->name, array("class"=>"land_icon")) : ""',
			'type' => 'html',
		),*/
		array(
			'header'=>'Ред',
			'class'=>'CButtonColumn',
	        'htmlOptions' => array('class' => 'width120 actionColumn'),
	        'headerHtmlOptions' => array('class' => 'width120 actionColumn'),
	        'filterHtmlOptions' => array('class' => 'width120 actionColumn'),
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
));
?>

</div>