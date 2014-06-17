<?php

/**
 * This is the model class for table "service".
 *
 * The followings are the available columns in table 'service':
 * @property integer $Id
 * @property string $description
 * @property string $long_description
 * @property string $note
 * @property integer $default_order
 *
 * The followings are the available model relations:
 * @property Area[] $areas
 * @property Category[] $categories
 */
class Service extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Service the static model class
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
		return 'service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('default_order', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>100),
			array('long_description, note', 'safe'),
				// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, long_description, note, default_order', 'safe', 'on'=>'search'),
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
			'areas' => array(self::MANY_MANY, 'Area', 'service_area(Id_service, Id_area)'),
			'categories' => array(self::MANY_MANY, 'Category', 'service_category(Id_service, Id_category)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'Servicio',
			'long_description' => 'Descripción',
			'note' => 'Nota',
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
		$criteria->compare('long_description',$this->long_description,true);
		$criteria->compare('note',$this->note,true);
		
		$sort=new CSort;
		$sort->defaultOrder="description";
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
			}
}