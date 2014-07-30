<?php
/* @var $this SellController */
/* @var $model TblSell */

$this->breadcrumbs=array(
	'Tbl Sells'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblSell', 'url'=>array('index')),
	array('label'=>'Create TblSell', 'url'=>array('create')),
	array('label'=>'View TblSell', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblSell', 'url'=>array('admin')),
);
?>

<h1>Update TblSell <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>