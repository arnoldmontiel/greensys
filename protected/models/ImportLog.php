<?php

/**
 * This is the model class for table "import_log".
 *
 * The followings are the available columns in table 'import_log':
 * @property integer $Id
 * @property string $file_name
 * @property string $already_exist_rows
 * @property string $error_rows
 * @property integer $total_rows
 * @property string $error_msg
 * @property string $insert_rows
 * @property string $date
 * @property string $import_code
 */
class ImportLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'import_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total_rows', 'numerical', 'integerOnly'=>true),
			array('file_name, error_msg, import_code', 'length', 'max'=>255),
			array('already_exist_rows, error_rows, insert_rows, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, file_name, already_exist_rows, error_rows, total_rows, error_msg, insert_rows, date, import_code', 'safe', 'on'=>'search'),
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
			'file_name' => 'File Name',
			'already_exist_rows' => 'Already Exist Rows',
			'error_rows' => 'Error Rows',
			'total_rows' => 'Total Rows',
			'error_msg' => 'Error Msg',
			'insert_rows' => 'Insert Rows',
			'date' => 'Date',
			'import_code' => 'Import Code',
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
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('already_exist_rows',$this->already_exist_rows,true);
		$criteria->compare('error_rows',$this->error_rows,true);
		$criteria->compare('total_rows',$this->total_rows);
		$criteria->compare('error_msg',$this->error_msg,true);
		$criteria->compare('insert_rows',$this->insert_rows,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('import_code',$this->import_code,true);

		$criteria->order = 't.date DESC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImportLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
