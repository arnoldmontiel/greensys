  
   <div class="row contenedorPresu">
    <div class="col-sm-12">
      <div class="tituloFinalPresu">Productos</div>
    
      <ul class="nav nav-tabs">
        <?php 
        $first = true; 
        foreach($areaProjects as $item)	{ ?>
        <li class="<?php echo $first?'active':'';?>"><a href="#itemArea_<?php echo $item->Id.'_'.$item->Id_area;?>" data-toggle="tab"><?php echo $item->area->description?> </a><a class="tabEdit"><i class="fa fa-pencil"></i></a></li>
		<?php $first= false;}?>
      
        <li class="pull-right">
          <div class="btn-group btnAlternateView">
  <button type="button" class="btn btn-default active">Áreas</button>
  <button type="button" class="btn btn-default">Servicios</button>
</div>
        </li>
                <li class="pull-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAgregarProductos">Agregar Productos</button></li>
      </ul>
      <div class="tab-content">
        <?php
        $first = true; 
        foreach($areaProjects as $item)	{ ?>
        <div class="tab-pane <?php echo $first?'active':'';?>" id="itemArea_<?php echo $item->Id.'_'.$item->Id_area;?>">
        <?php $first= false;?>
        <?php
        $modelBudgetItem->Id_area = $item->Id_area;
        $modelBudgetItem->Id_area_project = $item->Id;
        
        echo $this->renderPartial('_tabEditBudgetByArea',array(
					'model'=>$model,
					'modelProduct'=>$modelProduct,
					'modelBudgetItem'=>$modelBudgetItem,
					'priceListItemSale'=>$priceListItemSale,
					'areaProjects'=>$areaProjects,
					'modelBudgetItemGeneric'=>$modelBudgetItemGeneric,
		));?>

   </div>
  		<?php }?>   
   </div>
    </div>
    </div>
    <div class="row contenedorPresu">
  <div class="col-sm-6">
  </div>
  <div class="col-sm-6">
  <div class="tituloFinalPresu">Total</div>
<table class="table tablePresuTotal">
        <tbody>
          <tr>
            <td width="20%" valign="middle"  width="20%">Subtotal</td>
            <td width="30%">&nbsp;</td>
            <td valign="middle"  align="right" class="bold"><div class="usd">USD</div> 2000</td>
          </tr>
          <tr>
            <td valign="middle" >Discount</td>
            <td><input type="model" id="campoPrecio" class="form-control" value="0"> %</td>
            <td align="right" valign="middle" class="bold"> <div class="usd">USD</div> 2000</td>
          </tr>
          <tr class="superTotal">
            <td valign="middle" >Total</td>
            <td>&nbsp;</td>
            <td valign="middle"  align="right" class="bold">USD 2000</td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>
    
  <div class="row navbar-fixed-bottom">
    <div class="col-sm-12">
      <div class="buttonsFloatBottom">
        <button type="button" class="btn btn-default"> Cancelar</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
    <!-- /.col-sm-12 --> 
  </div>
  <!-- /.row --> 