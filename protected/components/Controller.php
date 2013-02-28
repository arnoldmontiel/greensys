<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class Controller extends SBaseController
{
	/**
	 * 
	 * From tapia
	 */
	public $modelTag = null;
	
	/**
	 * 
	 * From tapia
	 */
	public $showFilter = false;
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * @var string that define which items could be trashed.
	 */
	public $trashDraggableId='';
	
	/**
	* @var string that print html on the screen.
	*/
	public $container='';
	/**
	* @var string that print html on the screen.
	*/
	public $showSideBar = false;
	
	function init()
	{
		parent::init();
		$app = Yii::app();
		if (isset($_POST['_lang']))
		{
			$app->lc->setLanguage($_POST['_lang']);
		}
		else if (isset($app->session['sel_lang']))
		{
			$app->lc->setLanguage($app->session['sel_lang']);
		}
	}
	public function getSetting()
	{
		return Setting::model()->findByPk('1');
	}
}