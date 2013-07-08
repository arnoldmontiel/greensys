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
	echo CHtml::image($item->iconLink).'<br>';
	if($item->isImage)
		echo CHtml::link($item->title,$item->thumbnailLink,array('target'=>'_blank')).'<br>';
	else
		echo CHtml::link($item->title,'',array('id'=>$item->Id,'class'=>'folder-gdrive')).'<br>';
}

echo CHtml::hiddenField('hidden-path', json_encode($path) ,array('id'=>'hidden-path'));
?>