<?php
/* CJuiSortable class file.
*
* @author Arnold Montiel <arnaldomontiel@gmail.com>
* @copyright Copyright &copy; 2011- Grupo Smartliving
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
	public $itemTemplate='<li id="dlitems_{id}" class="dlist ui-state-highlight">{content} <img id="saveok" src="images/save_ok.png" alt="" 
	  style="position: relative;float:rigth;width:15px; height:15px; display:none;" /></li>';

	/**
	* @var string the name of the Draggable element. Defaults to 'div'.
	*/
	public $tagName='ul';
	
	public function init()
	{
		$assetsDir = dirname(__FILE__).'/assets';
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript("jquery");
		
		$var = Yii::app()->assetManager->publish($assetsDir,false,1,YII_DEBUG);
		
 		$cs->registerCssFile($var.'/draglist.css');
		
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

		if (isset($this->style))
			$this->htmlOptions['class'] = $this->style;
		else
			$this->htmlOptions['class'] = 'dlist';
		
		
		$tagId=$this->htmlOptions['id'];					

		if(!empty($this->items))
		{
			echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
			foreach($this->items as $id=>$content)
			{
				$options=empty($this->options) ? '' : CJavaScript::encode($this->options);
				$jqDraggableObjId="dlitems_".$id;				
				Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$jqDraggableObjId,"jQuery('#{$jqDraggableObjId}').draggable($options);");
				$this->htmlOptions['id']=$jqDraggableObjId;
				
				echo strtr($this->itemTemplate,array('{id}'=>$id,'{content}'=>$content))."\n";
			}			
			echo CHtml::closeTag($this->tagName);
		}
	}
}


