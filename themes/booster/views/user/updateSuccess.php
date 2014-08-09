
<div class="container">
    <h1>用户资料修改成功 - <?php echo $model->uid; ?></h1>

    <?php $this->widget('booster.widgets.TbDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'uid',
            'name',
            'password',
            'roles',
            'create_time',
        ),
    )); ?>

</div>