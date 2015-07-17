<?php
/* @var $this BannersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Рекламные материалы',
);
?>

<div class="block">
	
	<div class="head">
		<h5>
			Рекламные материалы
			<?= CHtml::link('Добавить', "/admin/promobanns/create", array('class' => 'btn btn-primary')) ?>		 
		</h5>
	</div>

	<?php

	$columns = array(
		'name',
		'type',
		array(
			'name' => 'image',
			'value' => '$data->image ? CHtml::image("/uploads/" . $data->image, $data->name, array("style"=>"width: 100px; height: 100px;")) : ""',
			'type' => 'html',
		),
		'height',
		'width',
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
					'imageUrl' => '',
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

	if (!Yii::app()->session['landing'])
	{
		$landing_column = array(
			'name' => 'land_id',
			'type' => 'html',
			'htmlOptions' => array('class' => 'width125'),
			'headerHtmlOptions' => array('class' => 'width125'),
			'filterHtmlOptions' => array('class' => 'width125'),
			'value' => '$data->getLandingIcon()',
		);
		array_splice($columns, -1, 0, array($landing_column));
	}

	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'user-grid',
		'dataProvider' => $model->search(),
		//'dataProvider' => $dataProvider,
		'summaryText'   => '',
		'htmlOptions' => array('class'=>'grid-view darkblue has-filter'),
		'pager'=> array(  
			'header'        => '',
			'prevPageLabel' => 'Назад',
			'nextPageLabel' => 'Далее',    
		),
		'filter' => $model,
		'columns' => $columns,
	));

	?>

</div>