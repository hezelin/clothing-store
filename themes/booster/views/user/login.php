
<div class="container">
    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm',array(
            'id' => 'verticalForm',
            'type' => 'horizontal',
            'htmlOptions' => array('class' => 'well'), // for inset effect
        )
    );

    echo $form->textFieldGroup($model, 'username');
    echo $form->passwordFieldGroup($model, 'password');
    echo $form->checkboxGroup($model, 'rememberMe');


    ?>
    <div class="row">
        <?php
        $this->widget('booster.widgets.TbButton',array(
            'buttonType' => 'submit',
            'label' => '登录',
            'htmlOptions'=>array('class'=>'col-md-offset-3 col-md-1')
        ));
        ?>
    </div>

    <?php
    $this->endWidget();
    unset($form);
    ?>
</div>