<?php
/* @var $this SellController */
/* @var $model TblSell */

$this->breadcrumbs=array(
	'Tbl Sells'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblSell', 'url'=>array('index')),
	array('label'=>'Manage TblSell', 'url'=>array('admin')),
);
?>

<h1>Create TblSell</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>