<?php


class TblProduct extends CActiveRecord
{

    public $mode;          //上传模式，按手 or 按件
    public $color_select;
    public $size_select;
	public function tableName()
	{
		return 'tbl_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, price, sell, size_num, color_num, size_list, color_list, mode,color_select,size_select', 'required'),
			array('size_num, color_num', 'numerical', 'integerOnly'=>true),
			array('price, sell', 'numerical'),
			array('factory_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>80),
			array('size_list', 'length', 'max'=>50),
			array('color_list', 'length', 'max'=>100),
			array('enable', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, factory_id, name, price, sell, size_num, color_num, size_list, color_list, enable, update_time', 'safe', 'on'=>'search'),
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
			'product_id' => '产品id',
			'factory_id' => '选择厂家',
			'name' => '产品名称',
			'price' => '进货价',
			'sell' => '销售价格',
			'size_num' => '码数数量',
			'color_num' => '颜色数量',
			'size_list' => '码数列表',
			'color_list' => '颜色列表',
			'enable' => '是否显示',
			'update_time' => '更新时间',
            'mode' => '添加方式',
            'size_select' => '码数列表',
            'color_select' => '颜色列表',
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

		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('factory_id',$this->factory_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('sell',$this->sell);
		$criteria->compare('size_num',$this->size_num);
		$criteria->compare('color_num',$this->color_num);
		$criteria->compare('size_list',$this->size_list,true);
		$criteria->compare('color_list',$this->color_list,true);
		$criteria->compare('enable',$this->enable,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'update_time DESC',
            ),
		));
	}

	public function init(){
        $this->mode = 0;
    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
