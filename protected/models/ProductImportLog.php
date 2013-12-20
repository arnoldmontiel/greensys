<?php

/**
 * This is the model class for table "product_import_log".
 *
 * The followings are the available columns in table 'product_import_log':
 * @property integer $Id
 * @property string $last_import_date
 * @property integer $Id_brand
 * @property integer $Id_measurement_unit_linear
 * @property integer $Id_measurement_unit_weight
 *
 * The followings are the available model relations:
 * @property Brand $idBrand
 * @property MeasurementUnit $idMeasurementUnitLinear
 * @property MeasurementUnit $idMeasurementUnitWeight
 */
class ProductImportLog extends CActiveRecord
{
	public $brand_description;
	
	protected function afterFind(){

		$this->last_import_date = isset($this->last_import_date)?Yii::app()->dateFormatter->formatDateTime($this->last_import_date,'small',null):null;
	
		return true;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_import_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_brand, Id_measurement_unit_linear, Id_measurement_unit_weight', 'required'),
			array('Id_brand, Id_measurement_unit_linear, Id_measurement_unit_weight', 'numerical', 'integerOnly'=>true),
			array('last_import_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, last_import_date, Id_brand, Id_measurement_unit_linear, Id_measurement_unit_weight, brand_description', 'safe', 'on'=>'search'),
		);
	}

	public function getUncompleteProducts()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("t.Id_brand = ".$this->Id_brand);
		$criteria->addCondition("(t.width = 0 OR
								t.height = 0 OR
								t.weight = 0 OR
								t.length = 0 OR
								t.msrp = 0 OR
				 				t.dealer_cost = 0)");
	
		return Product::model()->count($criteria);
	}
	
	public function getCompleteProducts()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("t.Id_brand = ".$this->Id_brand);
		$criteria->addCondition("(t.width > 0 AND
								t.height > 0 AND
								t.weight > 0 AND
								t.length > 0 AND
								t.msrp > 0 AND
				 				t.dealer_cost > 0)");
	
		return Product::model()->count($criteria);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'brand' => array(self::BELONGS_TO, 'Brand', 'Id_brand'),
			'measurementUnitLinear' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_unit_linear'),
			'measurementUnitWeight' => array(self::BELONGS_TO, 'MeasurementUnit', 'Id_measurement_unit_weight'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'last_import_date' => 'Ultima Actualizacion',
			'Id_brand' => 'Id Brand',
			'brand_description'=>'Marca',
			'Id_measurement_unit_linear' => 'Id Measurement Unit Linear',
			'Id_measurement_unit_weight' => 'Id Measurement Unit Weight',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('last_import_date',$this->last_import_date,true);
		$criteria->compare('Id_brand',$this->Id_brand);
		$criteria->compare('Id_measurement_unit_linear',$this->Id_measurement_unit_linear);
		$criteria->compare('Id_measurement_unit_weight',$this->Id_measurement_unit_weight);
		//$criteria->order = 't.last_import_date DESC';
		
		$criteria->with[]='brand';
		$criteria->addSearchCondition("brand.description",$this->brand_description);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->defaultOrder = 't.last_import_date DESC';
		$sort->attributes=array(
				'last_import_date',
				'brand_description' => array(
						'asc' => 'brand.description',
						'desc' => 'brand.description DESC',
				),
				'*',
		);
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductImportLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
