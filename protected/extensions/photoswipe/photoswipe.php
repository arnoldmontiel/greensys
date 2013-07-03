<?php
class photoswipe extends CWidget
{
	public $images = array();
	public $Id;
	public $smallImage;
	public function init()
	{
		$assetsDir = dirname(__FILE__).'/assets';
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript("jquery");
						
		// Publishing and registering CSS file
		$var = Yii::app()->assetManager->publish($assetsDir);
		$cs->registerScriptFile($var.'/lib/klass.min.js',CClientScript::POS_HEAD);
		$cs->registerScriptFile($var.'/code.photoswipe.jquery-3.0.5.min.js',CClientScript::POS_HEAD);
		$cs->registerCssFile($var.'/photoswipe.css');
		$cs->registerCssFile($var.'/styles.css');
		
	}
	public function run()
	{
		if($this->id != null){
			$this->render("body", array(
						'images'=>$this->images,
						'Id'=>$this->Id,
			));
		}
		
	}
}