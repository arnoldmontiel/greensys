<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);

?>
<h1><?php echo Yii::app()->lc->t('About'); 
		echo Yii::app()->lc->getSelectedLanguage();
?>
</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <tt><?php echo __FILE__; ?></tt>.</p>