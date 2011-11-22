<?php echo CHtml::form('','post',array('accept-charset'=>'utf-8')); ?>
    <div id="langdrop">
        <?php 
        echo CHtml::dropDownList('_lang'
        	,$this->selectedLanguage
        	,CHtml::listData($this->languages, 'id', 'text')
        	,array('submit'=>''));
        ?>
    </div>
<?php echo CHtml::endForm(); ?>