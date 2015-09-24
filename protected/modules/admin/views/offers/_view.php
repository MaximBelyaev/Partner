<?php
/* @var $this OffersController */
/* @var $data Offers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percent')); ?>:</b>
	<?php echo CHtml::encode($data->percent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fixed_pay')); ?>:</b>
	<?php echo CHtml::encode($data->fixed_pay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('click_pay')); ?>:</b>
	<?php echo CHtml::encode($data->click_pay); ?>
	<br />


</div>