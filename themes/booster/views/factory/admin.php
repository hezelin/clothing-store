<div class="container">
    <?php
    $gridColumns = array(
        'id',
        'name',
        'address',
        'phone',
        'tell',
        array(
            'name'=>'create_time',
            'value'=>'substr($data->create_time,0,16)'
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'header'=>'操作',
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
            'updateButtonUrl'=>'Yii::app()->createUrl("factory/update",array("id"=>$data->id))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("factory/delete",array("id"=>$data->id))',
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