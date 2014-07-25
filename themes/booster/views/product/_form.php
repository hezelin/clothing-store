<div class="form">
    <p class="note">星号 <span class="required">*</span> 是必填选项.</p>
<?php

    $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
            'id' => 'verticalForm',
            'type' => 'horizontal',
            'htmlOptions' => array('class' => 'well'), // for inset effect
        )
    );

    echo $form->dropDownListGroup($model,'factory_id', array(
            'wrapperHtmlOptions' => array(
                'class' => 'col-sm-5',
            ),
            'widgetOptions' => array(
                'data' => $factory,
            )
    ));

    echo $form->textFieldGroup($model, 'name',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'price',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'sell',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));

    echo $form->radioButtonListGroup($model,'mode',array(
        'widgetOptions' => array(
            'class' => 'col-sm-7',
            'data' => array(
                '按手添加',
                '按件添加',
            )
        ),
        'inline' => true
    ));

    echo $form->checkboxListGroup(
        $model,
        'color_select',
        array(
            'widgetOptions' => array(
                'class' => 'col-sm-7',
                'data' => $colorList
            ),
            'inline'=>true
        )
    );

    echo $form->checkboxListGroup(
        $model,
        'size_select',
        array(
            'widgetOptions' => array(
                'class' => 'col-sm-7',
                'data' => $sizeList
            ),
            'inline'=>true
        )
    );
?>
 <div id="item-color-size">

 </div>

    <div class="row">
        <?php
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'label' => '添加',
                'htmlOptions'=>array('class'=>'col-md-offset-3 col-md-1')
            )
        );

        $this->endWidget();
        unset($form);
        ?>
    </div>

</div><!-- form -->
<script>
    /*
     * 产品颜色码数对应数量填写
     */
    var colorList = colorList || {};
    var sizeList = sizeList || {};
    $(function(){
        $('#TblProduct_color_select').on('click','input:checkbox',function(){
            if( $(this).attr('checked') == 'checked' )
                colorList[ $(this).val() ] = $(this).parent().text();
            else
                delete colorList[ $(this).val() ];
            addItem();
        });

        $('#TblProduct_size_select').on('click','input:checkbox',function(){
            if( $(this).attr('checked') == 'checked' )
                sizeList[ $(this).val() ] = $(this).parent().text();
            else
                delete sizeList[ $(this).val() ];
            addItem();
        });

        $('#TblProduct_mode').on('click','input:radio',function(){
            addItem();
        })
    })

   function tpl(value,name){
    return '<div class="form-group" id="item-rm-'+ value +'">' +
           '<label class="col-sm-3 control-label required" for="TblProduct_item_'+value+'">'+name+' <span class="required">*</span></label>' +
           '<div class="col-sm-2">' +

           '<div class="input-group">' +
           '<input class="form-control" placeholder="数量" name="TblProduct[item]['+value+']" type="text" />' +
           '<span class="input-group-addon">手</span>' +
           '</div>' +

           '</div>' +
           '</div>';
   }
    function tplSize(value,name){
        var html;
        html = '<div class="form-group" id="item-rm-'+ value +'">';
        html +='<label class="col-sm-3 control-label required" for="TblProduct_item_'+value+'">'+name+' <span class="required">*</span></label>';
        html +='<div class="col-sm-2">';
        for(var k in sizeList){
            html +='<div class="input-group">';
            html +='<span class="input-group-addon">'+k+' 码</span>';
            html +='<input class="form-control" placeholder="数量" name="TblProduct[item]['+value+']['+k+']"  type="text" />';
            html +='<span class="input-group-addon">件</span>';
            html +='</div>';
        }
        html +='</div>';
        html +='</div>';
        return html;
    }

    function addItem(){
        var html ='';
        if( $('#TblProduct_mode input:radio:checked').val() == 0){              // 按手添加
            for(var k in colorList){
                html += tpl(k,colorList[k]);
            }
            $('#item-color-size').html( html );
        }else{
            for(var k in colorList){
                html += tplSize(k,colorList[k]);
            }
            $('#item-color-size').html( html );
        }
    }
</script>