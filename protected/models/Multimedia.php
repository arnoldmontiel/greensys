<?php

/**
 * This is the model class for table "multimedia".
 *
 * The followings are the available columns in table 'multimedia':
 * @property integer $id
 * @property string $data
 * @property string $name
 * @property string $type
 * @property string $size
 * @property string $description
 */
class Multimedia extends CActiveRecord
{
	public $uploadedFile;
	
	public function beforeSave()
	{
		//$model->attributes=$_POST['Multimedia'];
		
		if($file=CUploadedFile::getInstance($this,'uploadedFile'))
		{
			$this->name=$file->name;			
			$this->type=$file->type;			
			// maximum dimension
			$w=640;
			$h=640;
			$im = imagecreatefromstring(file_get_contents($file->tempName));
			
			$size[0] = imagesx($im);
			$size[1] = imagesy($im);
			$newwidth = $size[0];
			$newheight = $size[1];
			//calculate the new dimensions respecting the original sizes
			if( $newwidth > $w ){
				$newheight = ($w / $newwidth) * $newheight;
				$newwidth = $w;
			}
			if( $newheight > $h ){
				$newwidth = ($h / $newheight) * $newwidth;
				$newheight = $h;
			}
			// create the new image
			$new = imagecreatetruecolor($newwidth, $newheight);
			// copy the image with new sizes
			imagecopyresampled($new, $im, 0, 0, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
			ob_start();
			ob_implicit_flush(false);
			
			if( $this->type == 'image/jpeg' ) imagejpeg($new, '', 100);
			elseif ( $this->type == 'image/gif' ) imagegif($new);
			elseif (  $this->type == 'image/png' ) imagepng($new);
			$this->data = ob_get_clean();
			$this->size = $newwidth*$newheight;
		}
	
		return parent::beforeSave();
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @return Multimedia the static model class
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
		return 'multimedia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type', 'length', 'max'=>45),
			array('size', 'length', 'max'=>10),
			array('uploadedFile', 'file', 'types'=>'jpg, gif, png, pdf'),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, data, name, type, size, description', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'data' => 'Data',
			'name' => 'Name',
			'type' => 'Type',
			'size' => 'Size',
			'description' => 'Description',
			'uploadedFile' => 'Uploaded File'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}