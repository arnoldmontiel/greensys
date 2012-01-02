<?php
/* VideoJS
*
* @author Arnold Montiel <arnaldomontiel@gmail.com>
* @copyright Copyright &copy; 2011- SmartLiving
*/
Yii::import('zii.widgets.jui.CJuiWidget');

/**
 * @author Arnold Montiel <arnaldomontiel@gmail.com>
 * @version $Id:
 * @package
 * @since 1.0
 */
class VideoJS extends CJuiWidget
{
	public $model = null;
	public $assetsDir = '';
	public $assets = '';
	public function init()
	{
		$this->assetsDir = dirname(__FILE__).'/assets';
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript("jquery");
		// Publishing and registering JavaScript file
		$this->assets = Yii::app()->assetManager->publish(
		$this->assetsDir);
		
		$cs->registerScriptFile($this->assets.'/video.js',
		CClientScript::POS_HEAD
		);
		// Publishing and registering CSS file
		$cs->registerCssFile($this->assets.'/video-js.css'
		);
		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"VideoJS.setupAllWhenReady();",CClientScript::POS_LOAD);
		
		parent::init();
	}
	
	/**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
	public function run()
	{
		$id=$this->getId();
		if (isset($this->htmlOptions['id']))
			$id = $this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		
		if($this->model!=null && $this->model->type=="application/octet-stream")
		{
			$extension = strstr($this->model->name,'.');
			$outFile = $this->assets.'/tmpFile_'.md5($this->model->Id).$extension;
			if(file_put_contents( '../..'.$outFile, $this->model->content ))
			{
				$this->render("body", array('file'=>$outFile));				
			}
		}
		
	}
}


