<?php


class TblWholesale extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_wholesale';
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
			'id' => '自增',
			'item_id' => '产品id',
			'number' => '数量',
			'sell' => '销售价格',
			'create_time' => '创建时间',
			'enable' => 'Enable',
		);
	}

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

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
