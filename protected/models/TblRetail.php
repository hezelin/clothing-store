<?php

/**
 * This is the model class for table "tbl_retail".
 *
 * The followings are the available columns in table 'tbl_retail':
 * @property string $id
 * @property string $item_id
 * @property integer $number
 * @property double $sell
 * @property string $create_time
 * @property string $enable
 */
class TblRetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_retail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, number, sell, create_time', 'required'),
			array('number', 'numerical', 'integerOnly'=>true),
			array('sell', 'numerical'),
			array('item_id, create_time', 'length', 'max'=>10),
			array('enable', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_id, number, sell, create_time, enable', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '自增id',
			'item_id' => '产品id',
			'number' => '零售数量',
			'sell' => '零售价格',
			'create_time' => '创建时间',
			'enable' => '是否显示',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('sell',$this->sell);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('enable',$this->enable,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblRetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
