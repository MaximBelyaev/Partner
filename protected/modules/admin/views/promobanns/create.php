<?php

$this->breadcrumbs = array(
	'Баннеры' => array('index'),
	'Добавить',
);

$this->setPageTitle("Добавление баннера | Партнерская программа Павлуцкого Александра");
?>


<div class="block full-page-block">
	<?php $this->renderPartial('_form', array('model'=>$model, 'typesList'=>$typesList)); ?>
	<?php $this->renderPartial('/promovideo/_form', array('videoModel'=>$videoModel)); ?>
</div>