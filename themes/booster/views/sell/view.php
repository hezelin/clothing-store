<div class="container">

<h1>View TblSell #<?php echo $model->id; ?></h1>

<?php /*$this->widget('zii.widgets.CDetailView', array(
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
)); */?>


    <?php
    $this->widget(
        'booster.widgets.TbDetailView',
        array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'item_id',
                'number',
                'sell',
                'create_time',
                'enable',
//                'sell_type',
            ),
        )
    );
    ?>
</div>