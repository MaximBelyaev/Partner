<?php
/* @var $this BannersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Рекламные материалы',
);
?>

<div class="block full-page-block">
	
	<div class="head">
		<h5>
			Рекламные материалы
		</h5>
	</div>

	<?php

	$columns = array(
		'name',
		'type',
		'height',
		'width',
		array(
			'header'=>'Ред',
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
			'htmlOptions' => array('class' => 'width125'),
			'headerHtmlOptions' => array('class' => 'width125'),
			'filterHtmlOptions' => array('class' => 'width125'),
			'value' => 'isset($data->landing)?$data->landing->header:""',
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