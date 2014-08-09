<div class="container">
    <?php
    function format_date($time){
        $t=time()-$time;
        $f=array(
            '31536000'=>'年',
            '2592000'=>'个月',
            '604800'=>'星期',
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
            '1'=>'秒'
        );
        foreach ($f as $k=>$v)    {
            if (0 !=$c=floor($t/(int)$k)) {
                return $c.$v.'前';
            }
        }
    }

    $gridColumns = array(
        'id',
        'name',
        'log',
        array(
            'name'=>'create_time',
//            'value'=>'date("Y-m-d H:i:s",$data->create_time)'
            'value'=>'format_date($data->create_time)',
        ),
        /*array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'header'=>'操作',
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
            'updateButtonUrl'=>'Yii::app()->createUrl("user/update",array("id"=>$data->uid))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("user/delete",array("id"=>$data->uid))',
        )*/
    );

    $this->widget('booster.widgets.TbGridView',array(
            'type' => 'striped',
            'dataProvider' => $dataProvider,
            'template' => "{summary}\n{items}\n{pager}",
//            'filter' => $model,
            'columns' => $gridColumns,
        )
    );

    /*$this->widget('booster.widgets.TbGridView',array(
            'type' => 'striped',
            'dataProvider' => $model->search(),
            'template' => "{summary}\n{items}\n{pager}",
            'filter' => $model,
            'columns' => $gridColumns,
        )
    );*/

    ?>
</div>