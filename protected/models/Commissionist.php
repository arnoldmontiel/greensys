<?php

/**
 * This is the model class for table "commissionist".
 *
 * The followings are the available columns in table 'commissionist':
 * @property integer $Id_budget
 * @property integer $version_number
 * @property integer $Id_person
 * @property string $percent_commission
 *
 * The followings are the available model relations:
 * @property Budget $idBudget
 * @property Budget $versionNumber
 * @property Person $idPerson
 */
class Commissionist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'commissionist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_budget, version_number, Id_person', 'required'),
			array('Id_budget, version_number, Id_person', 'numerical', 'integerOnly'=>true),
			array('percent_commission', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_budget, version_number, Id_person, percent_commission', 'safe', 'on'=>'search'),
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
			'budget' => array(self::BELONGS_TO, 'Budget', 'Id_budget'),
			'versionNumber' => array(self::BELONGS_TO, 'Budget', 'version_number'),
			'person' => array(self::BELONGS_TO, 'Person', 'Id_person'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_budget' => 'Id Budget',
			'version_number' => 'Version Number',
			'Id_person' => 'Id Person',
			'percent_commission' => 'Percent Commission',
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

		$criteria->compare('Id_budget',$this->Id_budget);
		$criteria->compare('version_number',$this->version_number);
		$criteria->compare('Id_person',$this->Id_person);
		$criteria->compare('percent_commission',$this->percent_commission,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Commissionist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
