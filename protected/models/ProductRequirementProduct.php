<?php

/**
 * This is the model class for table "product_requirement_product".
 *
 * The followings are the available columns in table 'product_requirement_product':
 * @property integer $Id_product_requirement
 * @property integer $Id_product
 */
class ProductRequirementProduct extends CActiveRecord
{
	public $description_short;
	public $internal;
	public $code;
	public $description_supplier;
	public $description_customer;
	public $guild;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductRequirementProduct the static model class
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
		return 'product_requirement_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_product_requirement, Id_product', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_product_requirement, Id_product', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_product_requirement, Id_product, description_short, internal, code, description_supplier, description_customer, guild', 'safe', 'on'=>'search'),
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
				'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
				'productRequirement' => array(self::BELONGS_TO, 'ProductRequirement', 'Id_product_requirement'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_product_requirement' => 'Id Product Requirement',
			'Id_product' => 'Id Product',
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

		$criteria->compare('Id_product_requirement',$this->Id_product_requirement);
		$criteria->compare('Id_product',$this->Id_product);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchProductReqProd()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id_product_requirement',$this->Id_product_requirement);
		$criteria->compare('Id_product',$this->Id_product);
	
		$criteria->with[]='productRequirement';
		$criteria->addSearchCondition("productRequirement.description_short",$this->description_short);
		$criteria->addSearchCondition("productRequirement.internal",$this->internal);
		
		$criteria->with[]='product';
		$criteria->addSearchCondition("product.code",$this->code);
		$criteria->addSearchCondition("product.description_supplier",$this->description_supplier);
		$criteria->addSearchCondition("product.description_customer",$this->description_customer);
		 
		$criteria->join =	"LEFT OUTER JOIN product_requirement pr ON pr.Id=t.Id_product_requirement
										 LEFT OUTER JOIN guild g ON pr.Id_guild=g.Id";
		$criteria->addSearchCondition("g.description",$this->guild);
		
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
			'description_short' => array(
			        'asc' => 'productRequirement.description_short',
			        'desc' => 'productRequirement.description_short DESC',
				),
			'internal' => array(
			        'asc' => 'productRequirement.internal',
			        'desc' => 'productRequirement.internal DESC',
			),
			'code' => array(
			        'asc' => 'product.code',
			        'desc' => 'product.code DESC',
			),
			'description_supplier' => array(
			        'asc' => 'product.description_supplier',
			        'desc' => 'product.description_supplier DESC',
			),
			'description_customer' => array(
			        'asc' => 'product.description_customer',
			        'desc' => 'product.description_customer DESC',
			),
			'guild' => array(
			        'asc' => 'g.description',
			        'desc' => 'g.description DESC',
			),
				'*',
		);
	
		return new CActiveDataProvider($this, array(
							'criteria'=>$criteria,
							'sort'=>$sort,
		));
	}
}