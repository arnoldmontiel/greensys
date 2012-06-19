<?php

class StockSummaryController extends Controller
{
	public function actionIndex()
	{
		
		$model = new StockSummary('search');
		
		$model->unsetAttributes();
		
		if(isset($_GET['StockSummary']))
			$model->attributes=$_GET['StockSummary'];		
		
		$this->render('index',
			array('model'=>$model,)
		);
	}

}