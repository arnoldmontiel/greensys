  <?php 
  $area = new Area;
  $provider =$area->search();
  $provider->pagination =array(
        'pageSize'=>100,
    );
  $areas= $provider->data;
  ?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Agregar Area</h4>
      </div>
      <div class="modal-body">

<form role="form">
  <div class="form-group">
  <?php echo CHtml::hiddenField('Id_project',$Id_project,array('id'=>'Id_project'));  ?>
	<label for="area">Area</label>    	
<select id="areaSelector" class="form-control"name="area">
<?php foreach ($areas as $item){?>
<option value="<?php echo $item->Id;?>"><?php echo $item->description;?></option>
<?php }?>
</select>  </div>
</form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
        <button id="addArea" type="button" id="btn-save-field"  class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Agregar</button>
      </div>
    </div><!-- /.modal-content -->
    </div>
<script type="text/javascript">

$('#addArea').unbind('click');
$('#addArea').click(function()
		{
		$('#addArea').attr('disabled','disabled');
		jQuery.post('<?php echo Yii::app()->createUrl("project/ajaxAddProjectAreaFromBudget"); ?>',{ Id_area:$('#areaSelector').val(),Id_project:$('#Id_project').val()},
			function(data) {
			location.reload();
			},'json'
		);
		});

</script>

