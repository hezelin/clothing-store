<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" href="/css/site.css" />
</head>

<body>

<?php
$this->widget(
    'booster.widgets.TbNavbar',
    array(
        'brand' => Yii::app()->name,
        'fixed' => 'top',
        'fluid' => false,
        'items' => array(
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'items' => array(
                    array('label'=>'Home', 'url'=>array('/site/index')),
                    /*array(
                        'label' => '厂家',
                        'items' => array(
                            array('label' => '厂家列表','url'=>array('/factory/list')),
                            array('label' => '添加厂家','url'=>array('/factory/create')),
                        )
                    ),*/
                    array(
                        'label' => '产品录入',
                        'items' => array(
                            array('label' => '销售录入','url'=>array('/sell/select/type/wholesale')),
                            array('label' => '进货录入','url'=>array('/product/create')),
                            array('label' => '次品录入','url'=>array('/sell/select/type/return')),
                            array('label' => '补货录入','url'=>array('/product/select')),
                            array('label' => '厂家录入','url'=>array('/factory/create')),
                        )
                    ),
                    array(
                        'label' => '管理',
                        'items' => array(
                            array('label' => '产品管理','url'=>array('/product/admin')),
                            array('label' => '厂家管理','url'=>array('/factory/admin')),
                            array('label' => '次品管理','url'=>array('/return/admin')),
                        )
                    ),
                    array(
                        'label' => '用户管理',
                        'items' => array(
                            array('label' => '用户列表','url'=>array('/user/list') ),
                            array('label' => '添加用户','url'=>array('/user/add') ),
                            array('label' => '用户日志','url'=>array('/user/log') ),
                        ),
//                        'visible'=>Yii::app()->user->checkAccess('admin')
                    ),
                    array('label' => '报表','url'=>'report/index'),
                )
            ),
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                    array('label'=>'登录', 'url'=>Yii::app()->user->loginUrl, 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'欢迎您,'.Yii::app()->user->name, 'url'=>array('/user/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'退出', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
                )
            )
        )
    )
);
?>
<div style="height: 80px"></div>



	<?php echo $content; ?>

	<div class="container" id="footer">
        <br/>
        <p></p>
		Copyright &copy; <?php echo date('Y'); ?> by Harry.<br/>
		联系：QQ 730107711
	</div><!-- footer -->


</body>
</html>
