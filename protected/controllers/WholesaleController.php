<?php

class WholesaleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/main';

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
		$model=new TblWholesale;
        $productData = Yii::app()->db->createCommand()
            ->select('product_id,name')
            ->from('tbl_product')
            ->queryAll();
        $product = array();
        foreach($productData as $row){
            $product[$row['product_id']] = $row['name'];
        }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblWholesale']))
		{
			$model->attributes=$_POST['TblWholesale'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
            'product'=>$product,
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

		if(isset($_POST['TblWholesale']))
		{
			$model->attributes=$_POST['TblWholesale'];
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
		$dataProvider=new CActiveDataProvider('TblWholesale');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblWholesale('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblWholesale']))
			$model->attributes=$_GET['TblWholesale'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblWholesale the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblWholesale::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


    public function actionTypeahead()
    {
        echo json_encode(
            array(
                '动漫美女(dongmanmeinv)|1',
                '百度谷歌(baidugoogle)|1',
                '聚美优品(jumeiyoupin)|2',
                '京东商城(jingdongshangcheng)|2',
                '唯品会vip(weipinhuivip)|1',
                '苏宁云商(suningyunshang)|2',
                '阿里巴巴(alibaba)|1'
            ),JSON_UNESCAPED_UNICODE);
    }

    public function actionItem($id)
    {
        $itemData = Yii::app()->db->createCommand()
            ->select('item_id,color')
            ->from('tbl_product_item')
            ->where('product_id=:product_id and number>0 and enable="Y"',array(':product_id'=>$id))
            ->group('color')
            ->queryAll();
        $item = array('0'=>'选择颜色');
        foreach($itemData as $row){
            $item[$row['item_id']] = $row['color'];
        }
        echo json_encode($item,JSON_UNESCAPED_UNICODE);
    }

	/**
	 * Performs the AJAX validation.
	 * @param TblWholesale $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-wholesale-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
