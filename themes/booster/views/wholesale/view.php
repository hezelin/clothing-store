<?php
/* @var $this WholesaleController */
/* @var $model TblWholesale */

$this->breadcrumbs=array(
	'Tbl Wholesales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblWholesale', 'url'=>array('index')),
	array('label'=>'Create TblWholesale', 'url'=>array('create')),
	array('label'=>'Update TblWholesale', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblWholesale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblWholesale', 'url'=>array('admin')),
);
?>

<h1>View TblWholesale #<?php echo $model->id; ?></h1>

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
