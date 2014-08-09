<div class="container">
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

        echo $form->textFieldGroup($model, 'password',array(
            'wrapperHtmlOptions' => array(
                'class' => 'col-sm-7'
            )));

        echo $form->dropDownListGroup(
            $model,
            'roles',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-7',
                ),
                'widgetOptions' => array(
                    'data' => array('admin'=>'管理员','staff'=>'职员','manager'=>'经理'),
                    'htmlOptions' => array(),
                )
            )
        );
        ?>
        <div class="row">
            <?php
            $this->widget(
                'booster.widgets.TbButton',
                array(
                    'buttonType' => 'submit',
                    'label' => '保存修改',
                    'htmlOptions'=>array('class'=>'col-md-offset-3 col-md-1')
                )
            );

            $this->endWidget();
            unset($form);
            ?>
        </div>

    </div><!-- form -->
</div>