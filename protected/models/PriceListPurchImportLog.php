<?php

/**
 * This is the model class for table "price_list_purch_import_log".
 *
 * The followings are the available columns in table 'price_list_purch_import_log':
 * @property integer $Id
 * @property string $creation_date
 * @property string $file_name
 * @property string $original_file_name
 * @property string $not_found_model
 * @property integer $Id_supplier
 * @property integer $Id_price_list
 *
 * The followings are the available model relations:
 * @property Supplier $idSupplier
 * @property PriceList $idPriceList
 */
class PriceListPurchImportLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'price_list_purch_import_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_supplier, Id_price_list', 'required'),
			array('Id_supplier, Id_price_list', 'numerical', 'integerOnly'=>true),
			array('file_name, original_file_name', 'length', 'max'=>100),
			array('creation_date, not_found_model', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, creation_date, file_name, original_file_name, not_found_model, Id_supplier, Id_price_list', 'safe', 'on'=>'search'),
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
			'idSupplier' => array(self::BELONGS_TO, 'Supplier', 'Id_supplier'),
			'idPriceList' => array(self::BELONGS_TO, 'PriceList', 'Id_price_list'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'creation_date' => 'Creation Date',
			'file_name' => 'File Name',
			'original_file_name' => 'Original File Name',
			'not_found_model' => 'Not Found Model',
			'Id_supplier' => 'Id Supplier',
			'Id_price_list' => 'Id Price List',
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
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('original_file_name',$this->original_file_name,true);
		$criteria->compare('not_found_model',$this->not_found_model,true);
		$criteria->compare('Id_supplier',$this->Id_supplier);
		$criteria->compare('Id_price_list',$this->Id_price_list);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PriceListPurchImportLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
