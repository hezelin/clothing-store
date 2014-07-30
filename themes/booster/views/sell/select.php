<div class="container">
<?php


/*$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'product_id',
        'name',
        array(
            'name'=>'name',
            'header'=>'战斗值'
        ),
        array(
            'name'=>'update_time',
            'header'=>'发布时间'
        ),
    )
));*/
$gridColumns = array(
    array('name'=>'product_id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
    array('name'=>'name', 'header'=>'名称'),
    array('name'=>'sell', 'header'=>'战斗值'),
    array(
        'name'=>'update_time',
        'header'=>'发布时间',
        'value'=>'substr($data->update_time,0,16)'
    ),
    array(
        'htmlOptions' => array('nowrap'=>'nowrap'),
        'class'=>'booster.widgets.TbButtonColumn',
        'template'=>'{add}',
        'buttons'=>array
        (
            'add' => array
            (
                'label'=>'选择这个宝贝',
                'icon'=>'plus',
                'url'=>'Yii::app()->createUrl("sell/wholesale", array("id"=>$data->product_id))',
                'options'=>array(
                    'class'=>'btn btn-small',
                ),
            ),
        )
    )
);


$this->widget('booster.widgets.TbGridView',array(
        'type' => 'striped',
        'dataProvider' => $model->search(),
        'template' => "{summary}\n{items}\n{pager}",
        'filter' => $model,
        'columns' => $gridColumns,
    )
);

?>
</div>