<?php

/**
 * This is the model class for table "view_product_item".
 *
 * The followings are the available columns in table 'view_product_item':
 * @property string $item_id
 * @property string $name
 * @property double $price
 * @property double $sell
 * @property integer $number
 * @property string $color
 * @property string $size
 * @property integer $add_time
 * @property string $create_time
 */
class ViewProductItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_product_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, color, size, create_time', 'required'),
			array('number, add_time', 'numerical', 'integerOnly'=>true),
			array('price, sell', 'numerical'),
			array('item_id, create_time', 'length', 'max'=>10),
			array('name', 'length', 'max'=>80),
			array('color', 'length', 'max'=>6),
			array('size', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('item_id, name, price, sell, number, color, size, add_time, create_time', 'safe', 'on'=>'search'),
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
			'item_id' => '产品id',
			'name' => '产品名称',
			'price' => '进货价',
			'sell' => '销售价格',
			'number' => '数量',
			'color' => '单品颜色',
			'size' => '码数',
			'add_time' => '补货次数',
			'create_time' => '创建时间',
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

		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('sell',$this->sell);
		$criteria->compare('number',$this->number);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewProductItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
