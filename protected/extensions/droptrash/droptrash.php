<?php
/* CJuiDroppable class file.
*
* @author Pablo Pedraza <wensel84@gmail.com>
* @copyright Copyright &copy; 2011- SmartLiving
*/

Yii::import('zii.widgets.jui.CJuiWidget');

/**
 * @author Pablo Pedraza <wensel84@gmail.com>
 * @version $Id:
 * @package
 * @since 1.0
 */
class droptrash extends CJuiWidget
{
        /**
         * @var string the HTML tag name of the Droppable element. Defaults to 'div'.
         */
        public $tagName='div';

        /**
        * @var represents draggable id
        */
        public $draggableId;
        
        
        /**
        * @var represents new style applied to div
        */
        public $style;
        
        /**
         * Renders the open tag of the droppable element.
         * This method also registers the necessary javascript code.
         */
        public function init()
        {           
                $assetsDir = dirname(__FILE__).'/assets';
                $cs = Yii::app()->getClientScript();
                $cs->registerCoreScript("jquery");
                
                
                // Publishing and registering CSS file
                $var = Yii::app()->assetManager->publish($assetsDir);
                //$cs->registerCssFile(Yii::app()->assetManager->publish($var.'/droptrash.css'));
                $cs->registerCssFile($var.'/droptrash.css');
                parent::init();
                
        }

        /**
         * Renders the close tag of the droppable element.
         */
        public function run(){
        	
        	$id=$this->getId();
        	if (isset($this->htmlOptions['id']))
        		$id = $this->htmlOptions['id'];
        	else
        		$this->htmlOptions['id']=$id;
        	
        	if (isset($this->style))
        		$this->htmlOptions['class'] = $this->style;
        	else
        		$this->htmlOptions['class'] = 'trash';
        	
        	if (isset($this->draggableId)){
        		$condition = 'ui.draggable.parent().attr("id")=="'.$this->draggableId.'"';
        	}
        	else{
        		$condition = "true";
        	}
        	
        	echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
        	
        	
        	$fun = array('drop'=>'js:function( event, ui ){if('.$condition.'){ui.draggable.remove();}}');
        	
        	$options = CJavaScript::encode($fun);
        	
        	
        	Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"jQuery('#{$id}').droppable({$options});");
        	
            echo CHtml::closeTag($this->tagName);
        }

}


