<?php

/**
 * This is the model class for table "tbl_product_item".
 *
 * The followings are the available columns in table 'tbl_product_item':
 * @property string $item_id
 * @property string $product_id
 * @property integer $number
 * @property string $color
 * @property string $size
 * @property integer $add_time
 * @property string $enable
 * @property string $create_time
 *
 * The followings are the available model relations:
 * @property TblProductAdd[] $tblProductAdds
 * @property TblProduct $product
 */
class TblProductItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_product_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, number, color, size, create_time', 'required'),
			array('number, add_time', 'numerical', 'integerOnly'=>true),
			array('product_id, create_time', 'length', 'max'=>10),
			array('color', 'length', 'max'=>6),
			array('size', 'length', 'max'=>4),
			array('enable', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('item_id, product_id, number, color, size, add_time, enable, create_time', 'safe', 'on'=>'search'),
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
			'tblProductAdds' => array(self::HAS_MANY, 'TblProductAdd', 'item_id'),
			'product' => array(self::BELONGS_TO, 'TblProduct', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_id' => '产品id',
			'product_id' => '产品id',
			'number' => '数量',
			'color' => '单品颜色',
			'size' => '码数',
			'add_time' => '补货次数',
			'enable' => '是否生效',
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
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('enable',$this->enable,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblProductItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
