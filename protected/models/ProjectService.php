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
			array('Id_project, Id_service', 'required'),
			array('Id_project, Id_service, order', 'numerical', 'integerOnly'=>true),
			array('long_description, note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_project, Id_service, long_description, note, order', 'safe', 'on'=>'search'),
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
			'Id_project' => 'Project',
			'Id_service' => 'Service',
			'long_description' => 'Descripción',
			'note' => 'Nota',
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
		$criteria->compare('long_description',$this->long_description,true);
		$criteria->compare('note',$this->note,true);
		
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
