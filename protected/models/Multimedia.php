<?php

/**
 * This is the model class for table "multimedia".
 *
 * The followings are the available columns in table 'multimedia':
 * @property integer $Id
 * @property string $file_name
 * @property integer $size
 * @property string $description
 * @property string $file_name_small
 * @property integer $size_small
 * @property integer $height
 * @property integer $width
 * @property integer $height_small
 * @property integer $width_small
 * @property integer $Id_multimedia_type
 *
 * The followings are the available model relations:
 * @property MultimediaType $idMultimediaType
 * @property ProductRequirement[] $productRequirements
 */
class Multimedia extends CActiveRecord
{
	
	public $uploadedFile;
	
	
	public function beforeSave()
	{

		if(isset($this->uploadedFile))
		{
			$name = $this->uploadedFile["name"];
			$exploded = explode(".", $name);
			$ext = end($exploded);
			$ext = strtolower($ext);
			if($ext=="jpg"||$ext=="png"||$ext=="bmp"||$ext=="gif")
			{
				//save original
				$folder = "images/";
				$filePath = $folder .'original_'. $name;
				move_uploaded_file($this->uploadedFile["tmp_name"], $filePath);

				$fileNameWoExt = str_replace('.'.$ext,'',$name);
				
				//generate medium file version
				$newFile = $this->resizeFile(800,800,$filePath);
				$content = $newFile['content'];
				if ($content !== false) {
					$fileName = $fileNameWoExt.'.jpg';
					$file = fopen($folder.$fileName, 'w');
					fwrite($file,$content);
					fclose($file);
					$this->file_name = $fileName;
					$this->size = $newFile['size'];
					$this->width= $newFile['width'];
					$this->height= $newFile['height'];
				}
	
				//generate small file version
				//$newFile = $this->resizeFile(320,320,$filePath);
				$newFile = $this->resizeFile(320,null,$filePath);
				$content = $newFile['content'];
				if ($content !== false) {
					$fileName = $fileNameWoExt.'_small.jpg';
					$file = fopen($folder.$fileName, 'w');
					fwrite($file,$content);
					fclose($file);
					$this->file_name_small = $fileName;
					$this->size_small = $newFile['size'];
					$this->width_small = $newFile['width'];
					$this->height_small = $newFile['height'];
				}
				unlink($filePath);
				$this->Id_multimedia_type = 1; //image
	
			}
			else
			{
				switch ( $ext) {
					case "pdf":
						$this->Id_multimedia_type = 3; //pdf
						break;
					case "dwg":
						$this->Id_multimedia_type = 4; //autocad
						break;
					case "avi":
						$this->Id_multimedia_type = 2; //video
						break;
					case "doc":
						$this->Id_multimedia_type = 5; //word
						break;
					case "docx":
						$this->Id_multimedia_type = 5; //word
						break;
					case "xls":
						$this->Id_multimedia_type = 6; //excel
						break;
					case "xlsx":
						$this->Id_multimedia_type = 6; //excel
						break;
				}
	
				$uniqueId = uniqid();
	
	
				$folder = "docs/";
				$fileName = $uniqueId.'.'.$ext;
				$filePath = $folder . $fileName;
	
				//save doc
				move_uploaded_file($this->uploadedFile["tmp_name"],$filePath);
	
				$this->file_name = $fileName;
				$this->size =$this->uploadedFile["size"];
	
			}
		}
	
		return parent::beforeSave();
	}
	
	private function resizeFile($w=null,$h=null,$filePath)
	{
		$im = imagecreatefromstring(file_get_contents($filePath));
	
		$size[0] = imagesx($im);
		$size[1] = imagesy($im);
		$newwidth = $size[0];
		$newheight = $size[1];
	
		//calculate the new dimensions respecting the original sizes
		if( isset($w) && $newwidth > $w ){
			$newheight = ($w / $newwidth) * $newheight;
			$newwidth = $w;
		}
		if( isset($h) &&  $newheight > $h ){
			$newwidth = ($h / $newheight) * $newwidth;
			$newheight = $h;
		}
		// create the new image
		$new = imagecreatetruecolor($newwidth, $newheight);
		// copy the image with new sizes
		imagecopyresampled($new, $im, 0, 0, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
		ob_start();
		ob_implicit_flush(false);
	
		if(isset($new))
			imagejpeg($new, null, 100);
	
		return array('size'=>$newwidth*$newheight, 'content'=> ob_get_clean(),'width'=>$newwidth,'height'=>$newheight);
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
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
			array('size, size_small, height, width, height_small, width_small, Id_multimedia_type', 'numerical', 'integerOnly'=>true),
			array('file_name, file_name_small', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, file_name, size, description, file_name_small, size_small, height, width, height_small, width_small, Id_multimedia_type', 'safe', 'on'=>'search'),
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
			'idMultimediaType' => array(self::BELONGS_TO, 'MultimediaType', 'Id_multimedia_type'),
			'productRequirements' => array(self::MANY_MANY, 'ProductRequirement', 'product_requirement_multimedia(Id_multimedia, Id_product_requirement)'),
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
			'size' => 'Size',
			'description' => 'Description',
			'file_name_small' => 'File Name Small',
			'size_small' => 'Size Small',
			'height' => 'Height',
			'width' => 'Width',
			'height_small' => 'Height Small',
			'width_small' => 'Width Small',
			'Id_multimedia_type' => 'Id Multimedia Type',
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
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('file_name_small',$this->file_name_small,true);
		$criteria->compare('size_small',$this->size_small);
		$criteria->compare('height',$this->height);
		$criteria->compare('width',$this->width);
		$criteria->compare('height_small',$this->height_small);
		$criteria->compare('width_small',$this->width_small);
		$criteria->compare('Id_multimedia_type',$this->Id_multimedia_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}