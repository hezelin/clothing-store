<?php

/**
 * This is the model class for table "view_item_return".
 *
 * The followings are the available columns in table 'view_item_return':
 * @property string $id
 * @property string $name
 * @property string $color
 * @property string $size
 * @property integer $number
 * @property double $price
 * @property double $return_price
 * @property string $create_time
 */
class ViewItemReturn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_item_return';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, return_price, create_time', 'required'),
			array('number', 'numerical', 'integerOnly'=>true),
			array('price, return_price', 'numerical'),
			array('id, create_time', 'length', 'max'=>10),
			array('name', 'length', 'max'=>80),
			array('color', 'length', 'max'=>6),
			array('size', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, color, size, number, price, return_price, create_time', 'safe', 'on'=>'search'),
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
			'id' => '次品id',
			'name' => '产品名称',
			'color' => '单品颜色',
			'size' => '码数',
			'number' => '数量',
			'price' => '进货价',
			'return_price' => '退货价格',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('price',$this->price);
		$criteria->compare('return_price',$this->return_price);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'create_time DESC',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewItemReturn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
