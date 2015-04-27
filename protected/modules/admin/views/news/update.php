<?php
/* @var $this NewsController */
/* @var $model News */
$this->setPageTitle("Редактировать новость {$model->header} | Партнерская программа Павлуцкого Александра");

?>

<div class="row-fluid">
	<div class="head">
		<h5>Редактировать новость <?php echo $model->news_id; ?></h5>
	</div>	

	<div class="form">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>