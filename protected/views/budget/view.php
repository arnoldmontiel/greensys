<script type="text/javascript">

function downloadPDF(id, version)
{
	var params = "&id="+id+"&version="+version;
	window.open("<?php echo BudgetController::createUrl('DownloadPDF'); ?>" + params, "_blank");
	return false;	
}

</script>
<div class="align-right">
	<a onclick="downloadPDF(<?php echo $modelBudget->Id.', '.$modelBudget->version_number?>);" class="btn btn-primary" style="margin-bottom:15px;margin-right:15px;">Generar PDF</a>
</div>
<div id="screenViewOnline">
<?php echo GreenHelper::generateBudgetPDF($modelBudget);?>

</div>