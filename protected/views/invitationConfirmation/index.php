<?php
	$data = $dataProvider->data;
	$total = count($data);
	$totalConfirmed = 0;
	foreach ($data as $item)
	{
		if($item->confirmed)
			$totalConfirmed+=1;		
	} 
?>
<h1>Confirmaron: <b><?php echo $totalConfirmed?></b> de <?php echo $total;?></h1>
<table width="800" cellpadding="5" cellspacing="0" border="1">
<thead>
<tr>
<td style="background-color:#ccc; font-weight:bold;">Nombre</td>
<td style="background-color:#ccc; font-weight:bold;">E-Mail</td>
<td style="background-color:#ccc; font-weight:bold;">Viene?</td>
<tbody>
<?php foreach ($data as $item){?>
<tr>
<td><?php echo $item->name;?></td>
<td><?php echo $item->email;?></td>
<td><?php if($item->confirmed)
		 	echo "SI";
		else
			 echo"NO";?></td>
</tr>
<?php }?>
</tbody>
</table>

