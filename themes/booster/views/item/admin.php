<div class="container">
    <?php

    function getColor($key){
        $colorList = array(
            'red'=>'红色','yellow'=>'黄色','black'=>'黑色','white'=>'白色','blue'=>'蓝色','orange'=>'橙色',
            'green'=>'绿色','purple'=>'紫色','gray'=>'灰色','pink'=>'粉色','brown'=>'咖啡色','cyan'=>'青色',
            'silver'=>'银色','aqua'=>'浅绿色','maroon'=>'米色','navy'=>'深蓝色'
        );
        return $colorList[$key];
    }


    $gridColumns = array(
        'item_id',
        'name',
        'price',
        'sell',
        'number',
        array(
            'name'=>'color',
            'value'=>'getColor($data->color)',
            'filter'=>array(
                'red'=>'红色','yellow'=>'黄色','black'=>'黑色','white'=>'白色','blue'=>'蓝色','orange'=>'橙色',
                'green'=>'绿色','purple'=>'紫色','gray'=>'灰色','pink'=>'粉色','brown'=>'咖啡色','cyan'=>'青色',
                'silver'=>'银色','aqua'=>'浅绿色','maroon'=>'米色','navy'=>'深蓝色'
            ),
            'htmlOptions'=>array('style'=>'width: 60px')
        ),
        'size',
        'add_time',
        array(
            'name'=>'create_time',
            'value'=>'date("Y-m-d H:i",$data->create_time)'
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'header'=>'操作',
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
            'updateButtonUrl'=>'Yii::app()->createUrl("item/update",array("id"=>$data->item_id))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("item/delete",array("id"=>$data->item_id))',
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