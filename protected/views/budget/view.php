<script type="text/javascript">

function downloadPDF(id, version)
{
	var params = "&id="+id+"&version="+version;
	window.location = "<?php echo BudgetController::createUrl('DownloadPDF'); ?>" + params;
	return false;	
}

</script>
<div class="align-right">
	<a onclick="downloadPDF(<?php echo $modelBudget->Id.', '.$modelBudget->version_number?>);" class="btn btn-primary" style="margin-bottom:15px;margin-right:15px;">Generar PDF</a>
</div>
<?php echo GreenHelper::generateBudgetPDF($modelBudget);?>