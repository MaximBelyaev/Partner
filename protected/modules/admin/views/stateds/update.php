<?php

$this->setPageTitle("Заявка от {$model->user->username} | Партнерская программа Павлуцкого Александра");
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>