<?php

/**
 * This is the model class for table "tbl_circle_activity".
 *
 * The followings are the available columns in table 'tbl_circle_activity':
 * @property string $id
 * @property string $circle_id
 * @property string $uid
 * @property string $name
 * @property string $content
 * @property string $cover
 * @property integer $area
 * @property string $place
 * @property string $is_finish
 * @property integer $apply_count
 * @property integer $limit_people
 * @property string $activity_time
 * @property string $create_time
 * @property string $enable
 */
class TblCircleActivity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_circle_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('circle_id, uid, name, content, cover, area, place, limit_people, activity_time, create_time', 'required'),
			array('area, apply_count, limit_people', 'numerical', 'integerOnly'=>true),
			array('circle_id, uid, create_time', 'length', 'max'=>10),
			array('name', 'length', 'max'=>80),
			array('cover', 'length', 'max'=>50),
			array('place', 'length', 'max'=>255),
			array('is_finish, enable', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, circle_id, uid, name, content, cover, area, place, is_finish, apply_count, limit_people, activity_time, create_time, enable', 'safe', 'on'=>'search'),
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
			'circle_id' => '圈子名称',
			'uid' => '创建者',
			'name' => '交流主题',
			'content' => '交流活动内容',
			'cover' => '活动封面',
			'area' => '地址id',
			'place' => '活动地址',
			'is_finish' => '是否结束',
			'apply_count' => '报名人数',
			'limit_people' => '限制人数',
			'activity_time' => '活动时间',
			'create_time' => '创建时间',
			'enable' => '显示状态',
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
		$criteria->compare('circle_id',$this->circle_id,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('area',$this->area);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('is_finish',$this->is_finish,true);
		$criteria->compare('apply_count',$this->apply_count);
		$criteria->compare('limit_people',$this->limit_people);
		$criteria->compare('activity_time',$this->activity_time,true);
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
	 * @return TblCircleActivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
