<h1>Confirmaron: <b>20</b> de 10</h1>
<table width="800" cellpadding="5" cellspacing="0" border="1">
<thead>
<tr>
<td style="background-color:#ccc; font-weight:bold;">Nombre</td>
<td style="background-color:#ccc; font-weight:bold;">E-Mail</td>
<td style="background-color:#ccc; font-weight:bold;">Viene?</td>
<tbody>
<?php foreach ($dataProvider->data as $item){?>
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

