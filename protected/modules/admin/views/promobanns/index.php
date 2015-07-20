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
			<?= CHtml::link('Добавить', "/admin/promobanns/create", array('class' => 'btn btn-success')) ?>		 
		</h5>
	</div>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
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
		'columns' => array(
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
		),
	));

	?>

</div>