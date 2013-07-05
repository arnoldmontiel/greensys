
<?php 

foreach($response as $item)
{
	echo $item->Id.'<br>';	
	echo CHtml::image($item->iconLink).'<br>';
	if($item->isImage)
		echo CHtml::link($item->title,$item->thumbnailLink,array('target'=>'_blank')).'<br>';
	else
		echo CHtml::link($item->title,'',array('id'=>$item->Id,'class'=>'folder-gdrive')).'<br>';
}

?>
