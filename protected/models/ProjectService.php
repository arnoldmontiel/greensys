<?php

/**
 * This is the model class for table "project_service".
 *
 * The followings are the available columns in table 'project_service':
 * @property integer $Id_project
 * @property integer $Id_service
 * @property string $long_description
 * @property string $note
 * @property integer $order
 * @property integer $Id_budget
 * @property integer $version_number
 */
class ProjectService extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id_project, Id_service, Id_budget, version_number', 'required'),
			array('Id_project, Id_service, order, Id_budget, version_number', 'numerical', 'integerOnly'=>true),
			array('long_description, note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_project, Id_service, long_description, note, order, Id_budget, version_number', 'safe', 'on'=>'search'),
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
				'service' => array(self::BELONGS_TO, 'Service', 'Id_service'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id_project' => 'Id Project',
			'Id_service' => 'Id Service',
			'long_description' => 'Long Description',
			'note' => 'Note',
			'order' => 'Order',
			'Id_budget' => 'Id Budget',
			'version_number' => 'Version Number',
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

		$criteria->compare('Id_project',$this->Id_project);
		$criteria->compare('Id_service',$this->Id_service);
		$criteria->compare('Id_budget',$this->Id_budget);
		$criteria->compare('version_number',$this->version_number);
		
		$sort=new CSort;
		$sort->defaultOrder = "t.order";
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
