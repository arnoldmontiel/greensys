<?php $this->beginContent('//layouts/tmain'); ?>
	<div id="content-center">
		<?php echo $content; ?>
	</div><!-- content -->
	<div id="sidebar" class="well">
	<?php
// 		$this->beginWidget('zii.widgets.CPortlet', array(
// 			'title'=>'Operations',
// 		));
// 		$this->widget('zii.widgets.CMenu', array(
// 			'items'=>$this->menu,
// 			'htmlOptions'=>array('class'=>'operations'),
// 		));
// 		$this->endWidget();

		$menu[] = array('label'=>'Operaciones', 'itemOptions'=>array('class'=>'nav-header'));
		$menu[]='';
		foreach ($this->menu as $item)
		{
			if(CController::getAction()->id==$item['url'][0])
			{
				$item['itemOptions']=array('class'=>'active');
			}
			elseif(CController::getAction()->id=='index'&&$item['url'][0]=='admin')
			{
				$item['itemOptions']=array('class'=>'active');
			}
			$menu[] = $item;			
		}
		
		$this->widget('bootstrap.widgets.TbMenu', array(
				'type'=>'list',
				'items' => $menu,
				
		));
	?>
	</div><!-- sidebar -->
<?php $this->endContent(); ?>