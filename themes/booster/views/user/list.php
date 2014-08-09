<div class="container">
    <?php
    $gridColumns = array(
        'uid',
        'name',
        array(
            'name' => 'roles',
            'filter' => array('staff'=>'职员','admin'=>'管理员','manager'=>'经理'),
            'value' => '$data->roles=="admin"? "管理员":($data->roles=="staff"? "职员":"经理")',
        ),
        array(
            'name'=>'create_time',
            'value'=>'substr($data->create_time,0,16)'
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'header'=>'操作',
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
            'updateButtonUrl'=>'Yii::app()->createUrl("user/update",array("id"=>$data->uid))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("user/delete",array("id"=>$data->uid))',
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