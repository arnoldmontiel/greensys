<?php

/**
 * This is the model class for table "product_requirement".
 *
 * The followings are the available columns in table 'product_requirement':
 * @property integer $Id
 * @property integer $internal
 * @property string $description_short
 * @property integer $Id_guild
 *
 * The followings are the available model relations:
 * @property Guild $IdGuild
 * @property Product[] $products
 * @property ProductItem[] $productItems
 */
class ProductRequirement extends CActiveRecord
{
	public $guild_description;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductRequirement the static model class
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
		return 'product_requirement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_guild, description_short', 'required'),
			array('internal, Id_guild', 'numerical', 'integerOnly'=>true),
			array('description_short', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, internal, description_short, Id_guild, guild_description', 'safe', 'on'=>'search'),
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
			'guild' => array(self::BELONGS_TO, 'Guild', 'Id_guild'),
			'products' => array(self::MANY_MANY, 'Product', 'product_requirement_product(Id_product_requirement, Id_product)'),
			'productItems' => array(self::MANY_MANY, 'ProductItem', 'product_requirement_product_item(Id_product_requirement, Id_product_item)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'internal' => 'Internal',
			'description_short' => 'Short Description',
			'Id_guild' => 'Guild',
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
		$criteria->compare('internal',$this->internal);
		$criteria->compare('description_short',$this->description_short,true);
		$criteria->compare('Id_guild',$this->Id_guild);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchProductReq()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('Id',$this->Id);
		$criteria->compare('internal',$this->internal);
		$criteria->compare('description_short',$this->description_short,true);
		$criteria->compare('Id_guild',$this->Id_guild);
	
		$criteria->with[]='guild';
		$criteria->addSearchCondition("guild.description",$this->guild_description);
		
	
		// Create a custom sort
		$sort=new CSort;
		$sort->attributes=array(
		// For each relational attribute, create a 'virtual attribute' using the public variable name
		'internal',
		'description_short',
				'guild_description' => array(
										        'asc' => 'guild.description',
										        'desc' => 'guild.description DESC',
		),
				'*',
		);
	
		return new CActiveDataProvider($this, array(
						'criteria'=>$criteria,
						'sort'=>$sort,
		));
	}
	
}