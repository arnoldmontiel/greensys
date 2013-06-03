<?php

/**
 * This is the model class for table "setting".
 *
 * The followings are the available columns in table 'setting':
 * @property integer $Id
 * @property integer $due_days
 * @property string $g_drive_client_id
 * @property string $g_drive_client_secret
 * @property string $g_drive_scope
 * @property integer $change_tag_state_days
 */
class TSetting extends TapiaActiveRecord
{
	private static $setting;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Setting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getInstance()
	{
		if(!isset(self::$instancia))
		{
			$setings = TSetting::model()->findAll();
			if($setings!=null)
				TSetting::$setting= $setings[0];
		}
		return self::$setting;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setting';
	}

	public static function getDueDays()
	{
		$model = TSetting::model()->findByPk('1');
		return $model->due_days;
	}
	
	public static function getChangeTagStateDays()
	{
		$model = TSetting::model()->findByPk('1');
		return $model->change_tag_state_days;
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('due_days, change_tag_state_days', 'numerical', 'integerOnly'=>true),
			array('g_drive_client_id, g_drive_client_secret, g_drive_scope', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, due_days, change_tag_state_days', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'due_days' => 'Due Days',
			'g_drive_client_id' => 'G Drive Client',
			'g_drive_client_secret' => 'G Drive Client Secret',
			'g_drive_scope' => 'G Drive Scope',
			'change_tag_state_days' => 'Change Tag State Days',
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
		$criteria->compare('due_days',$this->due_days);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}