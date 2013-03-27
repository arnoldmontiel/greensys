<?php
class GreenHelper
{
	static public function saveLinks($links, $id,$idEntityType,$idKey)
	{
		if(isset($links))
		{
			foreach ($links as $link){
				$hyperlink = new Hyperlink;
				$hyperlink->attributes = array(
												'description'=>$link,
												'Id_entity_type'=>$idEntityType,
												$idKey=>$id);
		
				$hyperlink->save();
			}
		}
	}	
}
