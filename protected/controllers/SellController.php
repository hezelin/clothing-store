<?php

class SellController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/main';

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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TblSell;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblSell']))
		{
			$model->attributes=$_POST['TblSell'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblSell']))
		{
			$model->attributes=$_POST['TblSell'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TblSell');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblSell('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblSell']))
			$model->attributes=$_GET['TblSell'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblSell the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblSell::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


    public function actionSelect()
    {
        /*$dataProvider=new CActiveDataProvider('TblProduct');
        $model = new TblProduct;
        $this->render('select',array('dataProvider'=>$dataProvider,'model'=>$model));*/

        $model=new TblProduct('search');
        $model->unsetAttributes();
        if(isset($_GET['TblProduct'])){
            $model->attributes=$_GET['TblProduct'];
        }
        $this->render('select',array('model'=>$model));

    }

    public function actionWholesale($id)
    {
        if(isset($_POST['TblSell']))
        {   //入库操作
            $sell_type = $_POST['TblSell']['sell_type'] == 'wholesale'? 'wholesale':'retail';
            $sql = "insert into tbl_sell (`item_id`,`number`,`sell`,`create_time`,`sell_type`) values ";
            $time=time();
            $data = '';

            $sql2 = "update tbl_product_item set number = case item_id  ";
            $data2 = '';
            $ids = array();
            foreach($_POST['TblSell']['item'] as $id=>$row){
                if( $row['number'] && $row['sell'] ){
                    $data .= "('{$id}','{$row['number']}','{$row['sell']}','{$time}','{$sell_type}'),";
                    $data2 .= "when {$id} then number-{$row['number']} ";
                    $ids[] = $id;
                }
            }

            if( empty($data) ) throw new CHttpException(600,'请填写数据');
//            拼接销售表 sql
            $sql .= substr($data,0,-1).';';
//            拼接 单品表更新数量 sql
            $sql2 .= $data2.'end where item_id in ('.implode(',',$ids).');';

            $transaction=Yii::app()->db->beginTransaction();
            try{
                if( ! Yii::app()->db->createCommand($sql)->execute() ) throw new Exception('tbl_sell 错误');
                if( ! Yii::app()->db->createCommand($sql2)->execute() ) throw new Exception('tbl_product_item 错误');
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                throw new CHttpException(600,$e->getMessage());
//                $this->debugArray($e);
//                Yii::app()->end();
            }

            // 插入数据成功，待 跳转
            $this->debugArray($_POST['TblSell']);
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

        $this->render('wholesale',array('item'=>$item,'model'=>$model,'product'=>$product));
    }

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-sell-form')
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

    private function debugArray($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    private function debugJson($arr)
    {
        echo '<pre>';
        echo json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        echo '</pre>';
    }
}
