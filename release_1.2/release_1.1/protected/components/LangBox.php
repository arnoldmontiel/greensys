<?php
class LangBox extends CWidget
{
	public $languages = array();
	public $selectedLanguage ='';
	public function run()
	{
		$languages = $this->languages;
		$currentLang = Yii::app()->language;
		$this->render('langBox', array('currentLang' => $currentLang));
	}
}
