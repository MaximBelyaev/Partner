<?php
/* @var $this AdvertisingController */
/* @var $model Advertising */

$this->breadcrumbs=array(
	'Рекламные материалы',
);

$this->setPageTitle("Рекламные материалы | Партнерская программа Павлуцкого Александра");
?>

<div>

	<div class="head">
		<h5>Рекламные материалы</h5>

		<div class="button_save">
			<?php /*CHtml::link('<i class="icon-plus"></i> Добавить', "/admin/advertising/create", array('class' => 'btn btn-default')) */?>
		</div>
	</div>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'user-grid',
		//'dataProvider' => $model->search(),
		'dataProvider' => $dataProvider,
		//'filter' => $model,
		'columns' => array(
			array(
				'name'  => 'banner_name',
				'value' => 'CHtml::link($data->banner_name, Yii::app()
 				->createUrl("admin/advertising/view",array("id"=>$data->primaryKey)))',
				'type'  => 'raw',
			),
			'type',
			'banner_code',
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
</div>
