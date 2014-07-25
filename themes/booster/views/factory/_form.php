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
    echo $form->textFieldGroup($model, 'name',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'address',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'phone',array(
        'wrapperHtmlOptions' => array(
            'class' => 'col-sm-7'
        )));
    echo $form->textFieldGroup($model, 'tell',array(
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