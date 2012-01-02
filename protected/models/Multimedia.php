<?php

/**
 * This is the model class for table "multimedia".
 *
 * The followings are the available columns in table 'multimedia':
 * @property integer $id
 * @property string $content
 * @property string $name
 * @property string $type
 * @property integer $size
 * @property string $description
 * @property string $content_small
 * @property integer $size_small
 * @property integer $Id_entity_type
 * @property integer $Id_product
 *
 * The followings are the available model relations:
 * @property EntityType $idEntityType
 * @property Product $idProduct
 */
class Multimedia extends CActiveRecord
{
	public $uploadedFile;
	
	public function beforeSave()
	{
	
		if($file=CUploadedFile::getInstance($this,'uploadedFile'))
		{
			$this->name=$file->name;
			$this->type=$file->type;
			if(strstr($file->type,'image'))
			{
				// set the new size
				// maximum dimension
				$newFile = $this->resizeFile(640,640,$file);
				$this->content = $newFile['content'];				
				$this->size = $newFile['size'];
				
				//set the new small size
				$newFile = $this->resizeFile(150,150,$file);
				$this->content_small = $newFile['content'];
				$this->size_small = $newFile['size'];
				
				if($this->Id_entity_type == null){
					// by default id = 1 is type "NONE"
					$this->Id_entity_type = 1;
				}	
			}
			elseif(strstr($file->type,'video')||$file->type=="application/octet-stream")//flash
			{
				$this->content = file_get_contents($file->tempName);				
				$this->size = $file->size;
								
				if($this->Id_entity_type == null){
					// by default id = 1 is type "NONE"
					$this->Id_entity_type = 1;
				}	
			}			
		}
	
		return parent::beforeSave();
	}
	
	/**
	* Returns an array with the new content and new size
	* @param integer $w new width of file
	* @param integer $d new width of file
	* @param file $file the file to be modified
	*/
	private function resizeFile($w,$h,$file)
	{
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
		
		if( $file->type == 'image/jpeg' || $file->type == 'image/pjpeg' ) imagejpeg($new, '', 100);
		elseif ( $file->type == 'image/gif' ) imagegif($new);
		elseif (  $file->type == 'image/png' ) imagepng($new);
		
		return array('size'=>$newwidth*$newheight, 'content'=> ob_get_clean());
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
			array('size, size_small, Id_entity_type, Id_product', 'numerical', 'integerOnly'=>true),
			array('uploadedFile', 'file', 'types'=>'jpg, gif, png, pdf, mp4, flv'),
			array('name, type', 'length', 'max'=>45),
			array('content, description, content_small', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, name, type, size, description, content_small, size_small, Id_entity_type, Id_product', 'safe', 'on'=>'search'),
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
			'idEntityType' => array(self::BELONGS_TO, 'EntityType', 'Id_entity_type'),
			'idProduct' => array(self::BELONGS_TO, 'Product', 'Id_product'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Content',
			'name' => 'Name',
			'type' => 'Type',
			'size' => 'Size',
			'description' => 'Description',
			'uploadedFile' => 'Uploaded File',
			'content_small' => 'Content Small',
			'size_small' => 'Size Small',
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

		$criteria->compare('id',$this->Id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content_small',$this->content_small,true);
		$criteria->compare('size_small',$this->size_small);
		$criteria->compare('Id_entity_type',$this->Id_entity_type);
		$criteria->compare('Id_product',$this->Id_product);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}