<?php

class Highcharts extends CApplicationComponent
{
    /**
    * @var boolean indicates whether assets should be republished on every request.
    */
    public $forceCopyAssets = false;

    /**
    * @var assets handle
    */
    protected $_assetsUrl;

    /**
    * Register the Highcharts lib
    */
    public function init()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $jsFilename = YII_DEBUG ? '/highcharts.src.js' : '/highcharts.js';
        $jsFilenameMore = YII_DEBUG ? '/highcharts-more.src.js' : '/highcharts-more.js';
        //$jsFilenameTheme = '/themes/dark-skies.js';
        

        $cs->registerScriptFile($this->getAssetsUrl().$jsFilename, CClientScript::POS_HEAD);
        $cs->registerScriptFile($this->getAssetsUrl().$jsFilenameMore, CClientScript::POS_HEAD);
        $cs->registerScriptFile($this->getAssetsUrl().$jsFilenameTheme, CClientScript::POS_HEAD);
        
    }

    /**
    * Returns the URL to the published assets folder.
    * @return string the URL
    */
    protected function getAssetsUrl()
    {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else
        {
            $assetsPath = Yii::getPathOfAlias('highcharts.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, true, -1, $this->forceCopyAssets);
            return $this->_assetsUrl = $assetsUrl;
        }
    }

    /**
    * Returns the extension version number.
    * @return string the version
    */
    public function getVersion()
    {
        return '0.0.1';
    }
}