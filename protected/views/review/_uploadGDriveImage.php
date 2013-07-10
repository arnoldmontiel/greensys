<?php 
$size = count($path);
$count = 1;
foreach ($path as $key => $text)
{	
	if($size == $count)
		echo $text.'<br>';
	else 
		echo CHtml::link($text,'',array('id'=>$key,'class'=>'path-gdrive')) . '->';
	
	$count++;
}

foreach($files as $item)
{	
	if($item->isImage)
	{
		echo CHtml::checkBox('chk-img',false,array('id'=>$item->Id, 'class'=>'chk-img', 'url'=>$item->downloadUrl));
		echo CHtml::image($item->thumbnailLink);
		echo CHtml::link($item->title,$item->thumbnailLink,array('target'=>'_blank')).'<br>';
	}
	else
	{
		echo CHtml::image($item->iconLink);
		echo CHtml::link($item->title,'',array('id'=>$item->Id,'class'=>'folder-gdrive')).'<br>';
	}
}

echo CHtml::hiddenField('hidden-path', json_encode($path) ,array('id'=>'hidden-path'));
?>