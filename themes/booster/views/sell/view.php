<?php
/* @var $this SellController */
/* @var $model TblSell */

$this->breadcrumbs=array(
	'Tbl Sells'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblSell', 'url'=>array('index')),
	array('label'=>'Create TblSell', 'url'=>array('create')),
	array('label'=>'Update TblSell', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblSell', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblSell', 'url'=>array('admin')),
);
?>

<h1>View TblSell #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'number',
		'sell',
		'create_time',
		'enable',
		'sell_type',
	),
)); ?>
