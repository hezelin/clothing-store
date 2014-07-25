<?php
/* @var $this ProductController */
/* @var $data TblProduct */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_id), array('view', 'id'=>$data->product_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('factory_id')); ?>:</b>
	<?php echo CHtml::encode($data->factory_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sell')); ?>:</b>
	<?php echo CHtml::encode($data->sell); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size_num')); ?>:</b>
	<?php echo CHtml::encode($data->size_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('color_num')); ?>:</b>
	<?php echo CHtml::encode($data->color_num); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('size_list')); ?>:</b>
	<?php echo CHtml::encode($data->size_list); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('color_list')); ?>:</b>
	<?php echo CHtml::encode($data->color_list); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enable')); ?>:</b>
	<?php echo CHtml::encode($data->enable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

</div>