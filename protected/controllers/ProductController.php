<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}*/

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model = new TblProduct;
//        $item = new TblProductItem;
        $factoryData = Yii::app()->db->createCommand()
                ->select('id,name')
                ->from('tbl_factory')
                ->queryAll();
        $factory = array('0'=>'选择厂家');
        foreach($factoryData as $row){
            $factory[$row['id']] = $row['name'];
        }

		if(isset($_POST['TblProduct']))
		{
            if( isset($_POST['TblProduct']['size_select']) && $_POST['TblProduct']['size_select'] ){
                $model->size_list = json_encode($_POST['TblProduct']['size_select'],true);
                $model->size_num = count( $_POST['TblProduct']['size_select'] );
            }
            if( isset($_POST['TblProduct']['color_select']) && $_POST['TblProduct']['color_select'] ){
                $model->color_list = json_encode($_POST['TblProduct']['color_select'],true);
                $model->color_num = count( $_POST['TblProduct']['color_select'] );
            }

			$model->attributes=$_POST['TblProduct'];

//            事务 插入2个表
            $transaction=Yii::app()->db->beginTransaction();
            try{
//                插入 产品
                if (!$model->save()) throw new Exception('产品入库失败');

//                添加 item , 手动拼 sql 效率高些
                $sql = "insert into tbl_product_item (`product_id`,`number`,`color`,`size`,`create_time`) values ";
                $time = time();
                $itemCount = 0;
                if( $model->mode == 0 ){                     //按手添加
                    foreach( $_POST['TblProduct']['color_select'] as $color)
                        foreach( $_POST['TblProduct']['size_select'] as $size){
                            $sql .= "({$model->product_id},{$_POST['TblProduct']['item'][$color]},'{$color}','{$size}',{$time}),";
                            $itemCount += $_POST['TblProduct']['item'][$color];
                        }
                    $sql = substr($sql,0,-1).';';
                }else{                                      //按件添加
                    foreach( $_POST['TblProduct']['color_select'] as $color)
                        foreach( $_POST['TblProduct']['size_select'] as $size){
                            $sql .= "({$model->product_id},{$_POST['TblProduct']['item'][$color][$size]},'{$color}','{$size}',{$time}),";
                            $itemCount += $_POST['TblProduct']['item'][$color][$size];
                        }
                }
                $sql = substr($sql,0,-1).';';
//                拼装 sql 文件结束

                if( ! $row = Yii::app()->db->createCommand($sql)->execute() ) throw new Exception('单品入库失败');
                $transaction->commit();

                $this->userLog(Yii::app()->user->id,'进货录入 '.$itemCount.' '.( $model->mode? '件':'手') );

            }catch(Exception $e){
                $transaction->rollBack();
            }

            $this->redirect(array('view','id'=>$model->product_id));
		}

		$this->render('create',array(
			'model'=>$model,
            'factory'=>$factory,
            'colorList'=>$this->colorList(),
            'sizeList'=>$this->sizeList()
		));
	}

    public function actionSelect()
    {
        $model=new TblProduct('search');
        $model->unsetAttributes();
        if(isset($_GET['TblProduct'])){
            $model->attributes=$_GET['TblProduct'];
        }
        $this->render('select',array('model'=>$model));
    }

    public function actionAdd($id)
    {
        if(isset($_POST['TblSell']))
        {   //入库操作
            $sell_type = $_POST['TblSell']['sell_type'] == 'wholesale'? 'wholesale':'retail';
            $sql = "insert into tbl_product_add (`item_id`,`add_count`,`price`,`create_time`) values ";
            $time=time();
            $data = '';

            $sql2 = "update tbl_product_item set number = case item_id  ";
            $data2 = '';
            $ids = array();
            $itemCount = 0;
            foreach($_POST['TblSell']['item'] as $id=>$row){
                if( $row['number'] && $row['sell'] ){
                    $data .= "('{$id}','{$row['number']}','{$row['sell']}','{$time}'),";
                    $data2 .= "when {$id} then number+{$row['number']} ";
                    $ids[] = $id;
                    $itemCount += $row['number'];
                }
            }

            if( empty($data) ) throw new CHttpException(600,'请填写数据');
//            拼接销售表 sql
            $sql .= substr($data,0,-1).';';
//            拼接 单品表更新数量 sql 与 补货次数
            $sql2 .= $data2.'end , add_time=add_time+1 where item_id in ('.implode(',',$ids).');';

            $transaction=Yii::app()->db->beginTransaction();
            try{
                if( ! Yii::app()->db->createCommand($sql)->execute() ) throw new Exception('tbl_product_add 错误');
                if( ! Yii::app()->db->createCommand($sql2)->execute() ) throw new Exception('tbl_product_item 错误');
                $transaction->commit();

                $this->userLog(Yii::app()->user->id,'补货录入 '.$itemCount.' 件');
            }catch (Exception $e){
                $transaction->rollBack();
                throw new CHttpException(600,$e->getMessage());
//                $this->debugArray($e);
//                Yii::app()->end();
            }

            // 插入数据成功，待 跳转
            print_r($_POST['TblSell']);
        }

        $model = new TblSell;
        $product = Yii::app()->db->createCommand()
            ->select('name')
            ->from('tbl_product')
            ->where('enable="Y" and product_id=:product_id',array(':product_id'=>$id))
            ->queryScalar();

        $itemData = Yii::app()->db->createCommand()
            ->select('item_id,color,size,number')
            ->from('tbl_product_item')
            ->where('number>0 and enable="Y" and product_id=:product_id',array(':product_id'=>$id))
            ->queryAll();
        $item = array();
        foreach($itemData as $r){
            $item[$r['color']]['name'] = $this->colorList()[$r['color']];
            $item[$r['color']]['data'][] = array(
                'item_id'=>$r['item_id'],
                'size'=>$r['size'],
                'number'=>$r['number'],
            );
        }

        $this->render('add',array('item'=>$item,'model'=>$model,'product'=>$product));
    }

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblProduct']))
		{
			$model->attributes=$_POST['TblProduct'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->product_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TblProduct');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new TblProduct('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblProduct']))
			$model->attributes=$_GET['TblProduct'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=TblProduct::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function userLog($uid,$msg)
    {
        $model = new TblUserLog;
        $model->uid = $uid;
        $model->log = $msg;
        $model->save();
    }

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    private function colorList()
    {
        return array(
            'red'=>'红色','yellow'=>'黄色','black'=>'黑色','white'=>'白色','blue'=>'蓝色','orange'=>'橙色',
            'green'=>'绿色','purple'=>'紫色','gray'=>'灰色','pink'=>'粉色','brown'=>'咖啡色','cyan'=>'青色',
            'silver'=>'银色','aqua'=>'浅绿色','maroon'=>'米色','navy'=>'深蓝色'
        );
    }

    private function sizeList()
    {
        return array(
            'XXS'=>'XXS','XS'=>'XS','S'=>'S','M'=>'M','L'=>'L','XL'=>'XL','XXL'=>'XXL','XXXL'=>'XXXL',
            '2'=>'2','4'=>'4','6'=>'6','8'=>'8','10'=>'10','12'=>'12','14'=>'14','16'=>'16',
            '3'=>'3','5'=>'5','7'=>'7','9'=>'9','11'=>'11','13'=>'13','15'=>'15','17'=>'17',
            '55'=>'55','60'=>'60','65'=>'65','70'=>'70','75'=>'75','80'=>'80','85'=>'85',
            '90'=>'90','100'=>'100','110'=>'110','120'=>'120','130'=>'130','140'=>'140','150'=>'150','160'=>'160',
        );
    }
}
