<?php
/* linkcontainer class file.
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
 * The result of this widget is an array of values under Links[] array. You can check it on $_POST.
 */
class linkcontainer extends CJuiWidget
{       
        /**
        * @var items is an array buid of (id, value), which will load all links already saved
        */
        public $items;
        
        /**
        * @var mode can be "show" or "edit". By default mode = "edit"
        */
        public $mode;
        
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
                $cs->registerCssFile($var.'/linkcontainer.css');
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

        	
        	if (isset($this->mode))
        		$mode = $this->mode;
        	else
        		$mode = "edit";
        	
        	
			$this->render($mode, array(
							'items'=>$this->items,
			));
        	
        }

}


