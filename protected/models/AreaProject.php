<?php

/**
 * This is the model class for table "area_project".
 *
 * The followings are the available columns in table 'area_project':
 * @property integer $Id
 * @property integer $Id_area
 * @property integer $Id_project
 * @property integer $centralized
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Area $idArea
 * @property Project $idProject
 */
class AreaProject extends CActiveRecord
{
	public $descripionArea;
	
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
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, Id_area, Id_project, centralized, description, descripionArea', 'safe', 'on'=>'search'),
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
			'area' => array(self::BELONGS_TO, 'Area', 'Id_area'),
			'project' => array(self::BELONGS_TO, 'Project', 'Id_project'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Id_area' => 'Id Area',
			'Id_project' => 'Id Project',
			'centralized' => 'Centralized',
			'description' => 'Description',
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
		$criteria->compare('Id_area',$this->Id_area);
		$criteria->compare('Id_project',$this->Id_project);
		$criteria->compare('centralized',$this->centralized);
		$criteria->compare('description',$this->description,true);

		$criteria->with[]='area';
		$criteria->addSearchCondition("area.description",$this->descripionArea);		
		
		$sort=new CSort;
		$sort->attributes=array(
						    'centralized',
							'description',
							'descripionArea' => array(
								        'asc' => 'area.description',
								        'desc' => 'area.description DESC',
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
	 * @return AreaProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
