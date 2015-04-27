<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Create',
);
$this->setPageTitle("Добавить новость | Партнерская программа Павлуцкого Александра");
?>


<div class="row-fluid">
	<div class="head">
		<h5>Создать новость</h5>
	</div>	

	<div class="form">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>