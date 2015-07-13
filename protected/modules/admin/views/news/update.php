<?php
/* @var $this NewsController */
/* @var $model News */
$this->setPageTitle("Редактировать новость {$model->header} | Партнерская программа Павлуцкого Александра");

?>

		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
