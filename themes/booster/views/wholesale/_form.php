<?php
    Yii::app()->clientScript->registerScriptFile("/js/typehead/bootstrap3-typeahead.min.js");
?>

<div class="form">


<!--<input class="typeahead ct-form-control" id="th0" type="text" name="TblWholesale[item_id]" data-provide="typeahead" />-->

<script>
    function getItem(id){
        $.getJSON('/wholesale/item',{'id':id},function(res){
//            alert(res);
            console.log(res);
        })
    }
    $(function(){
        $('#th0').typeahead({
            source: function(query, process) {
                var resq;
                $.ajax({
                    type:"post",
                    url:"/wholesale/typeahead",
                    async:false,                    //同步
                    dataType:"json",
                    success:function(respData){
                        resq = respData;
                    }
                })
                return resq;
            },
            highlighter: function (item) {
                var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&');
                var point = item.lastIndexOf('|');
                var id = item.substr(point+1);
                item = item.substr(0,point);
                var aa = item.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                    return '<strong style="color: #ffa108">' + match + '</strong>';
                });
                return '<span data="'+id+'">'+aa+'</span>';
            },
            select: function () {
                var val = this.$menu.find('.active').data('value');
                if(this.autoSelect || val) {
                    this.$element
                        .val(this.updater(val.substr(0,val.lastIndexOf('|'))))
                        .change();
                }
                getItem(this.$menu.find('.active span').attr('data'));
//                console.log(this.$menu.find('.active span').attr('data'));
                return this.hide();
            }
        });
    })
</script>


<?php

    $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
            'id' => 'verticalForm',
            'type' => 'horizontal',
            'htmlOptions' => array('class' => 'well'), // for inset effect
        )
    );
?>

    <div class="form-group">
        <label class="col-sm-3 control-label required" for="TblWholesale_product">产品id <span class="required">*</span></label>
        <div class="col-sm-4"><input class="form-control" id="th0" placeholder="输入产品" name="TblWholesale[product]"  type="text" /></div>
        <div class="col-sm-3"><input class="form-control" id="th0" placeholder="选择颜色" name="TblWholesale[color]"  type="text" /></div>
    </div>
<?php
    echo $form->textFieldGroup($model, 'number',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'sell',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
 ?>
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