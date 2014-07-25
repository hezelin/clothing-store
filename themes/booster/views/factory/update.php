<?php
/* @var $this FactoryController */
/* @var $model TblFactory */

$this->breadcrumbs=array(
	'Tbl Factories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblFactory', 'url'=>array('index')),
	array('label'=>'Create TblFactory', 'url'=>array('create')),
	array('label'=>'View TblFactory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblFactory', 'url'=>array('admin')),
);
?>

<h1>Update TblFactory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>