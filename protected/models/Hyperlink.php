<?php

/**
 * This is the model class for table "hyperlink".
 *
 * The followings are the available columns in table 'hyperlink':
 * @property integer $Id
 * @property string $description
 * @property integer $Id_entity_type
 * @property integer $Id_product
 *
 * The followings are the available model relations:
 * @property EntityType $idEntityType
 * @property Product $idProduct
 */
class Hyperlink extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Hyperlink the static model class
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
		return 'hyperlink';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_entity_type', 'required','message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			array('Id_entity_type, Id_product, Id_contact', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, description, Id_entity_type, Id_product', 'safe', 'on'=>'search'),
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
			'entityType' => array(self::BELONGS_TO, 'EntityType', 'Id_entity_type'),
			'product' => array(self::BELONGS_TO, 'Product', 'Id_product'),
			'contact' => array(self::BELONGS_TO, 'Contact', 'Id_contact'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'description' => 'URL',
			'Id_entity_type' => 'Id Entity Type',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('Id_entity_type',$this->Id_entity_type);
		$criteria->compare('Id_product',$this->Id_product);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}