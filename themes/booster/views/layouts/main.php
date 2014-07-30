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
        'brand' => 'Title',
        'fixed' => 'top',
        'fluid' => false,
        'items' => array(
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'items' => array(
                    /*array(
                        'label' => 'Dropdown',
                        'items' => array(
                            array('label' => 'Item1', 'url' => '#')
                        )
                    ),*/
                    array('label'=>'Home', 'url'=>array('/site/index')),
                    array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                    array('label'=>'Contact', 'url'=>array('/site/contact')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                )
            )
        )
    )
);
?>
<div style="height: 50px"></div>

<div  id="page">

	<?php echo $content; ?>

	<div class="clear"></div>

	<div class="container" id="footer">
        <br/>
        <p></p>
		Copyright &copy; <?php echo date('Y'); ?> by Harry.<br/>
		联系：QQ 730107711
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
