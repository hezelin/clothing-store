<?php
/* @var $this FactoryController */
/* @var $model TblFactory */
/* @var $form CActiveForm */
?>

<div class="form">
    <p class="note">星号 <span class="required">*</span> 是必填选项.</p>
<?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
            'id' => 'verticalForm',
            'type' => 'horizontal',
            'htmlOptions' => array('class' => 'well'), // for inset effect
        )
    );

/*'name' => '产品名称',
			'color' => '单品颜色',
			'size' => '码数',
			'number' => '数量',
			'price' => '进货价',
			'return_price' => '退货价格',
			'create_time' => '创建时间',*/


    echo $form->textFieldGroup($model, 'name',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'color',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'price',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'return_price',array(
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