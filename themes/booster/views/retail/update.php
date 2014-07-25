<?php
/* @var $this RetailController */
/* @var $model TblRetail */

$this->breadcrumbs=array(
	'Tbl Retails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblRetail', 'url'=>array('index')),
	array('label'=>'Create TblRetail', 'url'=>array('create')),
	array('label'=>'View TblRetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblRetail', 'url'=>array('admin')),
);
?>

<h1>Update TblRetail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>