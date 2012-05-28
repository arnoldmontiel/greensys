<?php

/**
 * This is the model class for table "category_sub_category".
 *
 * The followings are the available columns in table 'category_sub_category':
 * @property integer $Id_category
 * @property integer $Id_sub_category
 */
class CategorySubCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategorySubCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category_sub_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_category, Id_sub_category', 'required'),
			array('Id_category, Id_sub_category', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_category, Id_sub_category', 'safe', 'on'=>'search'),
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
			'subCategory' => array(self::BELONGS_TO, 'SubCategory', 'Id_sub_category'),
			'category' => array(self::BELONGS_TO, 'Category', 'Id_category'),	
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_category' => 'Id Category',
			'Id_sub_category' => 'Id Sub Category',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id_category',$this->Id_category);
		$criteria->compare('Id_sub_category',$this->Id_sub_category);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}