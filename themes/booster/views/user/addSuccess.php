
<div class="container">
    <h1>创建用户成功 - <?php echo $model->uid; ?></h1>

    <?php $this->widget('booster.widgets.TbDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'uid',
            'name',
            'roles',
            'create_time',
        ),
    )); ?>

</div>