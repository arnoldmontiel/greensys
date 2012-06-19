<?php

class StockSummaryController extends Controller
{
	public function actionIndex()
	{
		
		$model = new StockSummary('search');
		$model->unsetAttributes();
		
		$modelStockItem = new StockItem('search');
		$modelStockItem->unsetAttributes();

		if(isset($_GET['StockSummary']))
			$model->attributes=$_GET['StockSummary'];		
		
		if(isset($_GET['StockItem']))
			$modelStockItem->attributes=$_GET['StockItem'];
		
		if(isset($_GET['StockSummary']['Id'])){
			$modelStockItem->Id_product=$_GET['StockSummary']['Id'];
		}
		
		$this->render('index',array(
				'model'=>$model,
				'modelStockItem'=>$modelStockItem,		
		));
	}

}