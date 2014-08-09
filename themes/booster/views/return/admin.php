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
        'id',
        'name',
        'number',
        array(
            'name'=>'color',
            'header'=>'颜色',
            'value'=>'getColor($data->color)',
            'filter'=>array(
                'red'=>'红色','yellow'=>'黄色','black'=>'黑色','white'=>'白色','blue'=>'蓝色','orange'=>'橙色',
                'green'=>'绿色','purple'=>'紫色','gray'=>'灰色','pink'=>'粉色','brown'=>'咖啡色','cyan'=>'青色',
                'silver'=>'银色','aqua'=>'浅绿色','maroon'=>'米色','navy'=>'深蓝色'
            ),
            'htmlOptions'=>array('style'=>'width: 60px')
        ),
        'size',
        'price',
        'return_price',
        array(
            'name'=>'create_time',
            'value'=>'date("Y-m-d H:i",$data->create_time)'
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'header'=>'操作',
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{refresh} {delete}',
            //'updateButtonUrl'=>'Yii::app()->createUrl("return/sell",array("id"=>$data->id))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("return/delete",array("id"=>$data->id))',
            'buttons'=>array
            (
                'refresh' => array
                (
                    'label'=>'转换次品',
                    'icon'=>'refresh',
                    'url'=>'Yii::app()->createUrl("return/sell", array("id"=>$data->id))',
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