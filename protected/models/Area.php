<?php

/**
 * This is the model class for table "area".
 *
 * The followings are the available columns in table 'area':
 * @property integer $Id
 * @property string $description
 * @property integer $main
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 * @property Category[] $categories
 * @property Product[] $products
 * @property Service[] $services
 */
class Area extends ModelAudit
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Area the static model class
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
		return 'area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('main', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, main', 'safe', 'on'=>'search'),
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
			'projects' => array(self::MANY_MANY, 'Project', 'area_project(Id_area, Id_project)'),
			'categories' => array(self::MANY_MANY, 'Category', 'category_area(Id_area, Id_category)'),
			'products' => array(self::MANY_MANY, 'Product', 'product_area(Id_area, Id_product)'),
			'services' => array(self::MANY_MANY, 'Service', 'service_area(Id_area, Id_service)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'Descripción',
			'main' => 'Main',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('main',$this->main);
		
		$sort=new CSort;
		$sort->defaultOrder ="description";
				
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}
}