<?php
/* @var $this ProductController */
/* @var $model TblProduct */

$this->breadcrumbs=array(
	'Tbl Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TblProduct', 'url'=>array('index')),
	array('label'=>'Create TblProduct', 'url'=>array('create')),
	array('label'=>'Update TblProduct', 'url'=>array('update', 'id'=>$model->product_id)),
	array('label'=>'Delete TblProduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblProduct', 'url'=>array('admin')),
);
?>

<h1>View TblProduct #<?php echo $model->product_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'product_id',
		'factory_id',
		'name',
		'price',
		'sell',
		'size_num',
		'color_num',
		'size_list',
		'color_list',
		'enable',
		'update_time',
	),
)); ?>
