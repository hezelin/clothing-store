<?php
/* @var $this RetailController */
/* @var $model TblRetail */

$this->breadcrumbs=array(
	'Tbl Retails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblRetail', 'url'=>array('index')),
	array('label'=>'Create TblRetail', 'url'=>array('create')),
	array('label'=>'Update TblRetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblRetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblRetail', 'url'=>array('admin')),
);
?>

<h1>View TblRetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'number',
		'sell',
		'create_time',
		'enable',
	),
)); ?>
