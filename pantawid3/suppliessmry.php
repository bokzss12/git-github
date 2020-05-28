<?php
namespace PHPMaker2020\pantawid2020;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$supplies_summary = new supplies_summary();

// Run the page
$supplies_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$supplies_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$supplies_summary->isExport() && !$supplies_summary->DrillDown && !$DashboardReport) { ?>
<script>
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$supplies_summary->isExport() || $supplies_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$supplies_summary->DrillDownInPanel) {
	$supplies_summary->ExportOptions->render("body");
	$supplies_summary->SearchOptions->render("body");
	$supplies_summary->FilterOptions->render("body");
}
?>
</div>
<?php $supplies_summary->showPageHeader(); ?>
<?php
$supplies_summary->showMessage();
?>
<?php if ((!$supplies_summary->isExport() || $supplies_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$supplies_summary->isExport() || $supplies_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $supplies_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$supplies_summary->isExport() && !$supplies_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($supplies_summary->RecordCount < count($supplies_summary->DetailRecords) && $supplies_summary->RecordCount < $supplies_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($supplies_summary->ShowHeader) {
?>
<div class="<?php if (!$supplies_summary->isExport("word") && !$supplies_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $supplies_summary->ReportTableStyle ?>>
<!-- Report grid (begin) -->
<div id="gmp_supplies" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $supplies_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($supplies_summary->id->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->id) == "") { ?>
	<th data-name="id" class="<?php echo $supplies_summary->id->headerCellClass() ?>"><div class="supplies_id"><div class="ew-table-header-caption"><?php echo $supplies_summary->id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="id" class="<?php echo $supplies_summary->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->id) ?>', 1);"><div class="supplies_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->model->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->model) == "") { ?>
	<th data-name="model" class="<?php echo $supplies_summary->model->headerCellClass() ?>"><div class="supplies_model"><div class="ew-table-header-caption"><?php echo $supplies_summary->model->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="model" class="<?php echo $supplies_summary->model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->model) ?>', 1);"><div class="supplies_model">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->model->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->serial->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->serial) == "") { ?>
	<th data-name="serial" class="<?php echo $supplies_summary->serial->headerCellClass() ?>"><div class="supplies_serial"><div class="ew-table-header-caption"><?php echo $supplies_summary->serial->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="serial" class="<?php echo $supplies_summary->serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->serial) ?>', 1);"><div class="supplies_serial">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->status->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->status) == "") { ?>
	<th data-name="status" class="<?php echo $supplies_summary->status->headerCellClass() ?>"><div class="supplies_status"><div class="ew-table-header-caption"><?php echo $supplies_summary->status->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="status" class="<?php echo $supplies_summary->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->status) ?>', 1);"><div class="supplies_status">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->date_received->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->date_received) == "") { ?>
	<th data-name="date_received" class="<?php echo $supplies_summary->date_received->headerCellClass() ?>"><div class="supplies_date_received"><div class="ew-table-header-caption"><?php echo $supplies_summary->date_received->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="date_received" class="<?php echo $supplies_summary->date_received->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->date_received) ?>', 1);"><div class="supplies_date_received">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->date_received->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->date_received->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->date_received->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->date_consumed->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->date_consumed) == "") { ?>
	<th data-name="date_consumed" class="<?php echo $supplies_summary->date_consumed->headerCellClass() ?>"><div class="supplies_date_consumed"><div class="ew-table-header-caption"><?php echo $supplies_summary->date_consumed->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="date_consumed" class="<?php echo $supplies_summary->date_consumed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->date_consumed) ?>', 1);"><div class="supplies_date_consumed">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->date_consumed->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->date_consumed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->date_consumed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->employeeid->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->employeeid) == "") { ?>
	<th data-name="employeeid" class="<?php echo $supplies_summary->employeeid->headerCellClass() ?>"><div class="supplies_employeeid"><div class="ew-table-header-caption"><?php echo $supplies_summary->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="employeeid" class="<?php echo $supplies_summary->employeeid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->employeeid) ?>', 1);"><div class="supplies_employeeid">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->user_last_modify->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->user_last_modify) == "") { ?>
	<th data-name="user_last_modify" class="<?php echo $supplies_summary->user_last_modify->headerCellClass() ?>"><div class="supplies_user_last_modify"><div class="ew-table-header-caption"><?php echo $supplies_summary->user_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="user_last_modify" class="<?php echo $supplies_summary->user_last_modify->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->user_last_modify) ?>', 1);"><div class="supplies_user_last_modify">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->user_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_summary->user_date_modify->Visible) { ?>
	<?php if ($supplies_summary->sortUrl($supplies_summary->user_date_modify) == "") { ?>
	<th data-name="user_date_modify" class="<?php echo $supplies_summary->user_date_modify->headerCellClass() ?>"><div class="supplies_user_date_modify"><div class="ew-table-header-caption"><?php echo $supplies_summary->user_date_modify->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="user_date_modify" class="<?php echo $supplies_summary->user_date_modify->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_summary->sortUrl($supplies_summary->user_date_modify) ?>', 1);"><div class="supplies_user_date_modify">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_summary->user_date_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_summary->user_date_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_summary->user_date_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($supplies_summary->TotalGroups == 0)
			break; // Show header only
		$supplies_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php
	$supplies_summary->loadRowValues($supplies_summary->DetailRecords[$supplies_summary->RecordCount]);
	$supplies_summary->RecordCount++;
	$supplies_summary->RecordIndex++;
?>
<?php

		// Render detail row
		$supplies_summary->resetAttributes();
		$supplies_summary->RowType = ROWTYPE_DETAIL;
		$supplies_summary->renderRow();
?>
	<tr<?php echo $supplies_summary->rowAttributes(); ?>>
<?php if ($supplies_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $supplies_summary->id->cellAttributes() ?>>
<span<?php echo $supplies_summary->id->viewAttributes() ?>><?php echo $supplies_summary->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->model->Visible) { ?>
		<td data-field="model"<?php echo $supplies_summary->model->cellAttributes() ?>>
<span<?php echo $supplies_summary->model->viewAttributes() ?>><?php echo $supplies_summary->model->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->serial->Visible) { ?>
		<td data-field="serial"<?php echo $supplies_summary->serial->cellAttributes() ?>>
<span<?php echo $supplies_summary->serial->viewAttributes() ?>><?php echo $supplies_summary->serial->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->status->Visible) { ?>
		<td data-field="status"<?php echo $supplies_summary->status->cellAttributes() ?>>
<span<?php echo $supplies_summary->status->viewAttributes() ?>><?php echo $supplies_summary->status->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->date_received->Visible) { ?>
		<td data-field="date_received"<?php echo $supplies_summary->date_received->cellAttributes() ?>>
<span<?php echo $supplies_summary->date_received->viewAttributes() ?>><?php echo $supplies_summary->date_received->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->date_consumed->Visible) { ?>
		<td data-field="date_consumed"<?php echo $supplies_summary->date_consumed->cellAttributes() ?>>
<span<?php echo $supplies_summary->date_consumed->viewAttributes() ?>><?php echo $supplies_summary->date_consumed->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->employeeid->Visible) { ?>
		<td data-field="employeeid"<?php echo $supplies_summary->employeeid->cellAttributes() ?>>
<span<?php echo $supplies_summary->employeeid->viewAttributes() ?>><?php echo $supplies_summary->employeeid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->user_last_modify->Visible) { ?>
		<td data-field="user_last_modify"<?php echo $supplies_summary->user_last_modify->cellAttributes() ?>>
<span<?php echo $supplies_summary->user_last_modify->viewAttributes() ?>><?php echo $supplies_summary->user_last_modify->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($supplies_summary->user_date_modify->Visible) { ?>
		<td data-field="user_date_modify"<?php echo $supplies_summary->user_date_modify->cellAttributes() ?>>
<span<?php echo $supplies_summary->user_date_modify->viewAttributes() ?>><?php echo $supplies_summary->user_date_modify->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
} // End while
?>
<?php if ($supplies_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$supplies_summary->resetAttributes();
	$supplies_summary->RowType = ROWTYPE_TOTAL;
	$supplies_summary->RowTotalType = ROWTOTAL_GRAND;
	$supplies_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$supplies_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$supplies_summary->renderRow();
?>
<?php if ($supplies_summary->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $supplies_summary->rowAttributes() ?>><td colspan="<?php echo ($supplies_summary->GroupColumnCount + $supplies_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($supplies_summary->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $supplies_summary->rowAttributes() ?>><td colspan="<?php echo ($supplies_summary->GroupColumnCount + $supplies_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($supplies_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$supplies_summary->isExport() || $supplies_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$supplies_summary->isExport() || $supplies_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$supplies_summary->isExport() || $supplies_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$supplies_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$supplies_summary->isExport() && !$supplies_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$supplies_summary->terminate();
?>