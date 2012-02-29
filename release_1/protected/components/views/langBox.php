<?php echo CHtml::form('','post',array('accept-charset'=>'ISO-8859-1')); ?>
    <div id="langdrop">
        <?php 
        echo CHtml::dropDownList('_lang'
        	,$this->selectedLanguage
        	,CHtml::listData($this->languages, 'id', 'text')
        	,array('submit'=>'','encode'=>false));
        ?>
    </div>
<?php echo CHtml::endForm(); ?>