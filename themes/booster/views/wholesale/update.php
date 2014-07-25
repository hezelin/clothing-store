<?php
/* @var $this WholesaleController */
/* @var $model TblWholesale */

$this->breadcrumbs=array(
	'Tbl Wholesales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblWholesale', 'url'=>array('index')),
	array('label'=>'Create TblWholesale', 'url'=>array('create')),
	array('label'=>'View TblWholesale', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblWholesale', 'url'=>array('admin')),
);
?>

<h1>Update TblWholesale <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>