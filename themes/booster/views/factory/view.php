
<div class="container">
<h1>厂家详情信息 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'address',
		'phone',
		'tell',
		'create_time',
	),
)); ?>

</div>