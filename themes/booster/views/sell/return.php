<div class="container">
    <p></p>
    <div class="well"><?php echo $product;?></div>
    <div class="form">
        <p class="note">星号 <span class="required">*</span> 是必填选项.</p>

        <?php
        $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
                'id' => 'verticalForm',
                'type' => 'horizontal',
                'htmlOptions' => array('class' => 'well'),
            )
        );

        echo $form->radioButtonListGroup($model,'sell_type',array(
            'widgetOptions' => array(
                'class' => 'col-sm-7',
                'data' => array(
                    'wholesale'=>'按手',
                    'retail'=>'按件',
                )
            ),
            'inline' => true
        ));
        ?>
        <div class="row" id="sell-row-input">
            <?php foreach($item as $color=>$row){ ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $row['name'];?></label>
                    <div class="col-sm-3">
                        <!-- 按手 -->
                        <div class="input-group whole-sale">
                            <input class="form-control" placeholder="数量" name="TblSell[whole][<?php echo $color;?>][num]" type="text" />
                            <span class="input-group-addon">手</span>
                        </div>
                        <!-- 按件 -->
                        <?php foreach($row['data'] as $r){ ?>
                            <div class="input-group one-sale">
                                <span class="input-group-addon"><?php echo $r['size'];?> 码</span>
                                <input class="form-control" placeholder="数量" name="TblSell[item][<?php echo $r['item_id'];?>][number]" type="text" />
                                <span class="input-group-addon">件 (<?php echo $r['number'];?>)</span>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-sm-3">
                        <!-- 按手 -->
                        <div class="input-group whole-sale">
                            <input class="form-control" placeholder="退货价格" name="TblSell[whole][<?php echo $color;?>][sell]"  type="text" />
                            <span class="input-group-addon">元</span>
                        </div>
                        <!-- 按件 -->
                        <?php foreach($row['data'] as $r){ ?>
                            <div class="input-group one-sale">
                                <input class="form-control" placeholder="退货价格" name="TblSell[item][<?php echo $r['item_id'];?>][sell]"  type="text" />
                                <span class="input-group-addon">元</span>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php }?>
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
    </div>
</div>

<script>
    var sell_type = '<?php echo $model->sell_type;?>';
    $(function(){
        if(sell_type === 'wholesale')
            $('#sell-row-input .one-sale').hide();
        else
            $('#sell-row-input .whole-sale').hide();

        $('#TblSell_sell_type').on('click','input:radio',function(){
            if($(this).val() === 'wholesale')
            {
                $('#sell-row-input .whole-sale').show();
                $('#sell-row-input .one-sale').hide();
            }else{
                $('#sell-row-input .whole-sale').hide();
                $('#sell-row-input .one-sale').show();
            }
        });

        $('#sell-row-input .whole-sale').on('change','input',function(){
            var data = $(this).val();
            $(this).closest('.col-sm-3').find('.one-sale').children('input').val(data);
        })
    });
</script>