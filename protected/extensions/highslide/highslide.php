<?php
class Highslide extends CWidget
{
	public $id;
	protected $graphics;
	public function init()
	{
		$assetsDir = dirname(__FILE__).'/assets';
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript("jquery");
		// Publishing and registering JavaScript file
		$cs->registerScriptFile(
		Yii::app()->assetManager->publish(
		$assetsDir.'/highslide-with-gallery.js'
		),
		CClientScript::POS_HEAD
		);
		// Publishing and registering CSS file
		$cs->registerCssFile(
		Yii::app()->assetManager->publish(
		$assetsDir.'/highslide.css'
		)
		);
		$this->graphics = Yii::app()->assetManager->publish(
				$assetsDir.'/graphics');
	}
	public function run()
	{
		$this->render("body", array(
			'id' => $this->id,			
		));
	}
}