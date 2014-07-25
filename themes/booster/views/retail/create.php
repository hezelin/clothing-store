<?php
/* @var $this RetailController */
/* @var $model TblRetail */

$this->breadcrumbs=array(
	'Tbl Retails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblRetail', 'url'=>array('index')),
	array('label'=>'Manage TblRetail', 'url'=>array('admin')),
);
?>

<h1>Create TblRetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>