<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Ошибка';
$this->breadcrumbs=array(
	'Error',
);
?>

<div class="errorBlock">
	
	<h2>Ошибка <?php echo $code; ?></h2>

	<div class="errorMsg">
		<?php echo CHtml::encode($message); ?>
	</div>
	
</div>