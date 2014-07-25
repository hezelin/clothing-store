<?php
/* @var $this ProductController */
/* @var $model TblProduct */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'factory_id'); ?>
		<?php echo $form->textField($model,'factory_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sell'); ?>
		<?php echo $form->textField($model,'sell'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size_num'); ?>
		<?php echo $form->textField($model,'size_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'color_num'); ?>
		<?php echo $form->textField($model,'color_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size_list'); ?>
		<?php echo $form->textField($model,'size_list',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'color_list'); ?>
		<?php echo $form->textField($model,'color_list',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enable'); ?>
		<?php echo $form->textField($model,'enable',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->