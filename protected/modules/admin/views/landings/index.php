<?php

$this->breadcrumbs=array( 'Партнёры' );
$this->setPageTitle("Список лендингов");
?>

<div class="head">
	<h5>Лэндинги</h5>
	<div class="button_save">
		<?php echo CHtml::link('<i class="icon-plus"></i> Добавить',array('/admin/landings/create'), array('class'=>'btn btn-success',)); ?>
	</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'land_id',
		'link',
		'name',
		array(
			'name' => 'icon',
			'value' => '$data->icon ? CHtml::image("/uploads/" . $data->icon, $data->name, array("class"=>"land_icon")) : ""',
			'type' => 'html',
		),
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
));