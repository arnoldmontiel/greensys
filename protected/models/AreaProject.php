<?php

/**
 * This is the model class for table "area_project".
 *
 * The followings are the available columns in table 'area_project':
 * @property integer $Id_area
 * @property integer $Id_project
 * @property integer $centralized
 */
class AreaProject extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AreaProject the static model class
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
		return 'area_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_area, Id_project', 'required'),
			array('Id_area, Id_project, centralized', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id_area, Id_project, centralized', 'safe', 'on'=>'search'),
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
				'project' => array(self::BELONGS_TO, 'Project', 'Id_project'),
				'area' => array(self::BELONGS_TO, 'Area', 'Id_area'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_area' => 'Id Area',
			'Id_project' => 'Id Project',
			'centralized' => 'Centralized',
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

		$criteria->compare('Id_area',$this->Id_area);
		$criteria->compare('Id_project',$this->Id_project);
		$criteria->compare('centralized',$this->centralized);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}