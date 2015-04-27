<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->news_id), array('view', 'id'=>$data->news_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('header')); ?>:</b>
	<?php echo CHtml::encode($data->header); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />


</div>