<?php echo CHtml::form('','post'); ?>
    <div id="langdrop">
        <?php 
        echo CHtml::dropDownList('_lang'
        	,$this->selectedLanguage
        	,CHtml::listData($this->languages, 'id', 'text')
        	,array('submit'=>''));
        ?>
    </div>
<?php echo CHtml::endForm(); ?>