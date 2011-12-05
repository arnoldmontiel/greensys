<?php
/* CJuiSortable class file.
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
class draglist extends CJuiWidget
{
	
	public $qItems;
	public $qItemsDef=100;
	/**
	 * @var array list of sortable items (id=>item content).
	 * Note that the item contents will not be HTML-encoded.
	 */
	public $items=array();
	/**
	 * @var string the template that is used to generated every sortable item.
	 * The token "{content}" in the template will be replaced with the item content,
	 * while "{id}" be replaced with the item ID.
	 */
	//public $itemTemplate='<li>{content}</li>';
	public $itemTemplate='<li id="dlitems_{id}">{content}</li>';
	//public $itemTemplate='<div id="{id}">{content}</div>';

	public function init()
	{
		$assetsDir = dirname(__FILE__).'/assets';
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript("jquery");
		// Publishing and registering JavaScript file
// 		$cs->registerScriptFile(
// 		Yii::app()->assetManager->publish(
// 		$assetsDir.'/draglist.js'
// 		),
// 		CClientScript::POS_HEAD
// 		);
// 		// Publishing and registering CSS file
// 		$cs->registerCssFile(
// 		Yii::app()->assetManager->publish(
// 		$assetsDir.'/draglist.css'
// 		)
// 		);
// 		Yii::app()->assetManager->publish(
// 		$assetsDir.'/graphics');
		
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

		if(!empty($this->items)&&!isset($this->qItems))
		{
			foreach($this->items as $id=>$content)
			{
				$this->beginWidget('zii.widgets.jui.CJuiDraggable', array(
					// additional javascript options for the draggable plugin
					'id'=>$this->id."_".$id,
					//'tagName'=>'dlist',
					'options'=>$this->options,
				));
				echo strtr($this->itemTemplate,array('{id}'=>$id,'{content}'=>$content))."\n";
				$this->endWidget();
			}			
		}
		elseif (isset($this->qItems))
		{
			for($i=0;$i<$this->qItems;$i++)
			{
				$this->beginWidget('zii.widgets.jui.CJuiDraggable', array(
					// additional javascript options for the draggable plugin
					'id'=>$this->id."_".$i,
					//'tagName'=>'dlist',
					'options'=>$this->options,
				));
				$this->endWidget();
			}			
			
		}
	}
}


