<?php $this->beginContent('//layouts/tmain'); 
//jQuery('#filter-panel').toggle('blind',{ direction: "left" },100)
//crear un nuevo tmain.php y un nuevo colum..php y segun el que sea, cambiar el ancho del content. a 100% 85% y centrarlo en las paginas mas comunes
?>

<div class="filter-panel" id="filter-panel">
	<?php if($this->modelTag):?>			
		<div class="search-box">
			<div class="search-box-title">
			Etapa
			</div>
			<div class="search-box-list">
			<?php
				$modelUser = User::getCurrentUser();
					
				echo CHtml::openTag('div',array('class'=>'review-tag-containier')); 
				foreach($this->modelTag->tags as $tag)
				{
					$options = array('class'=>'index-review-single-tag','id'=>'single-tag');
					if($tag->Id==1)
					$options['style']='background-color: #CC3300;color: white';//rojo
					else if($tag->Id==2)
					$options['style']='background-color: #66FF66';//verde
					else if($tag->Id==3)
					$options['style']='background-color: #FFFF99';//amarillo
					else if($tag->Id==4)
					$options['style']='background-color: #FFCC66';//amarillo
											
					echo CHtml::openTag('div',$options); 
					echo CHtml::encode($tag->description);
					echo CHtml::closeTag('div');
				}
				echo CHtml::closeTag('div');
				
			?>
			</div>
		</div>
	<?php endif?>
	<?php if($this->showFilter):?>
		<div class="search-box">
			<div class="search-box-title">
			Etapas
			</div>
			<div class="search-box-list">
			<?php
				$modelTags = Tag::model()->findAll();
				$checkTags = CHtml::listData($modelTags, 'Id', 'description');	
				$selectd = array(1=>true);
				echo CHtml::checkBoxList('chklist-tag', $selectd, $checkTags);
				echo "<br>";
				echo CHtml::openTag('span',array('id'=>'chkclose-span'));
				echo CHtml::checkBox('chkClose','',array('id'=>'chkClose'));
				echo "<label> Cerrado</label>";
				echo CHtml::closeTag('span');
				
				 $radio = $this->beginWidget('zii.widgets.jui.CJuiButton', array(
						'name'=>'btnradio',
						'buttonType'=>'buttonset'
				)); 
echo CHtml::checkBoxList('chklist-tags', $selectd, $checkTags);

				
				$this->endWidget();
			?>
			</div>
		</div>
		
		<div class="search-box">
			<div class="search-box-title">
			Documentos
			</div>
			<div class="search-box-list">
			<?php
				$modelType = MultimediaType::model()->findAll();
				$checkType = CHtml::listData($modelType, 'Id', 'description');		
				echo CHtml::checkBoxList('chklist-type', '', $checkType);
			?>
			</div>
		</div>
		
		<div class="search-box">
			<div class="search-box-title">
			Tipo de agrupador
			</div>
			<div class="search-box-list">
			<?php
				$modelReviewType = ReviewType::model()->findAll();
				$checkReviewType = CHtml::listData($modelReviewType, 'Id', 'description');		
				echo CHtml::checkBoxList('chklist-reviewType', '', $checkReviewType);
			?>
			</div>
		</div>
		
		<div class="search-box">
			<div class="search-box-title">
				Fecha de creacion
			</div>
			<div class="search-box-list">
				Desde
				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					    'name'=>'dateFrom',
					    // additional javascript options for the date picker plugin
					    'options'=>array(
					        'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd',
							'changeYear'=>true,
							'yearRange'=>'1999:2020',
							'beforeShow'=>"js:function() {
				                    $('.ui-datepicker').css('font-size', '0.8em');
				                    $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
				                }",
					    ),
					    'htmlOptions'=>array(
					        'style'=>'height:20px;width:100px;'
					    ),
					));
				?>
				Hasta
				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					    'name'=>'dateTo',
						
					    // additional javascript options for the date picker plugin
					    'options'=>array(
					        'showAnim'=>'fold',
							'dateFormat'=>'yy-mm-dd',
							'changeYear'=>true,
							'yearRange'=>'1999:2020',
							'beforeShow'=>"js:function() {
					                    $('.ui-datepicker').css('font-size', '0.8em');
					                    $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
					                }",
					    ),
					    'htmlOptions'=>array(
					        'style'=>'height:20px;width:100px;'
					    ),
					));
				?>
			</div>
		</div>
		
		<div class="search-box">
			<?php
				echo CHtml::openTag('div',array('class'=>'wall-action-box-btn','id'=>'filter-btn-box'));	
				echo CHtml::link('Filtrar','',array('id'=>'btn-filter','class'=>'submit-btn'));
				echo CHtml::closeTag('div');	
				echo '<br>';
				echo CHtml::openTag('div',array('class'=>'wall-action-box-btn','id'=>'clear-filter-btn-box'));
				echo CHtml::link('Limpiar filtros','',array('id'=>'btn-clear-filter','class'=>'submit-btn'));
				echo CHtml::closeTag('div');
			?>
		</div>		
	<?php endif?>
</div>

	<div id="content">
	<?php echo $content; ?>
	</div><!-- content -->



<?php $this->endContent(); ?>