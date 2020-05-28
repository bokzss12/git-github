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
$purchase_report_summary = new purchase_report_summary();

// Run the page
$purchase_report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$purchase_report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$purchase_report_summary->isExport() && !$purchase_report_summary->DrillDown && !$DashboardReport) { ?>
<script>
var fsummary, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fsummary = currentForm = new ew.Form("fsummary", "summary");
	currentPageID = ew.PAGE_ID = "summary";

	// Validate function for search
	fsummary.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fsummary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsummary.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	fsummary.filterList = <?php echo $purchase_report_summary->getFilterList() ?>;
	loadjs.done("fsummary");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$purchase_report_summary->isExport() || $purchase_report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($purchase_report_summary->ShowCurrentFilter) { ?>
<?php $purchase_report_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$purchase_report_summary->DrillDownInPanel) {
	$purchase_report_summary->ExportOptions->render("body");
	$purchase_report_summary->SearchOptions->render("body");
	$purchase_report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $purchase_report_summary->showPageHeader(); ?>
<?php
$purchase_report_summary->showMessage();
?>
<?php if ((!$purchase_report_summary->isExport() || $purchase_report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$purchase_report_summary->isExport() || $purchase_report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $purchase_report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$purchase_report_summary->isExport() && !$purchase_report_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$purchase_report_summary->isExport() && !$purchase_report->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $purchase_report_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="purchase_report">
	<div class="ew-extended-search">
<?php

// Render search row
$purchase_report->RowType = ROWTYPE_SEARCH;
$purchase_report->resetAttributes();
$purchase_report_summary->renderRow();
?>
<?php if ($purchase_report_summary->pr_number->Visible) { // pr_number ?>
	<?php
		$purchase_report_summary->SearchColumnCount++;
		if (($purchase_report_summary->SearchColumnCount - 1) % $purchase_report_summary->SearchFieldsPerRow == 0) {
			$purchase_report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $purchase_report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pr_number" class="ew-cell form-group">
		<label for="x_pr_number" class="ew-search-caption ew-label"><?php echo $purchase_report_summary->pr_number->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_pr_number" id="z_pr_number" value="=">
</span>
		<span id="el_purchase_report_pr_number" class="ew-search-field">
<input type="text" data-table="purchase_report" data-field="x_pr_number" name="x_pr_number" id="x_pr_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($purchase_report_summary->pr_number->getPlaceHolder()) ?>" value="<?php echo $purchase_report_summary->pr_number->EditValue ?>"<?php echo $purchase_report_summary->pr_number->editAttributes() ?>>
</span>
	</div>
	<?php if ($purchase_report_summary->SearchColumnCount % $purchase_report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($purchase_report_summary->SearchColumnCount % $purchase_report_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $purchase_report_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($purchase_report_summary->GroupCount <= count($purchase_report_summary->GroupRecords) && $purchase_report_summary->GroupCount <= $purchase_report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($purchase_report_summary->ShowHeader) {
?>
<?php if ($purchase_report_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<script id="tpb<?php echo $purchase_report_summary->GroupCount - 1 ?>_purchase_report" type="text/html"><?php echo $purchase_report_summary->PageBreakContent ?></script>
<?php } ?>
<div class="<?php if (!$purchase_report_summary->isExport("word") && !$purchase_report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $purchase_report_summary->ReportTableStyle ?>>
<!-- Report grid (begin) -->
<div id="gmp_purchase_report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $purchase_report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($purchase_report_summary->pr_number->Visible) { ?>
	<?php if ($purchase_report_summary->pr_number->ShowGroupHeaderAsRow) { ?>
	<th data-name="pr_number">&nbsp;</th>
	<?php } else { ?>
		<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->pr_number) == "") { ?>
	<th data-name="pr_number" class="<?php echo $purchase_report_summary->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_pr_number" type="text/html"><div class="purchase_report_pr_number"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->pr_number->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="pr_number" class="<?php echo $purchase_report_summary->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_pr_number" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->pr_number) ?>', 1);"><div class="purchase_report_pr_number">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->pr_number->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->pr_number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->pr_number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->date_prep->Visible) { ?>
	<?php if ($purchase_report_summary->date_prep->ShowGroupHeaderAsRow) { ?>
	<th data-name="date_prep">&nbsp;</th>
	<?php } else { ?>
		<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->date_prep) == "") { ?>
	<th data-name="date_prep" class="<?php echo $purchase_report_summary->date_prep->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_date_prep" type="text/html"><div class="purchase_report_date_prep"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->date_prep->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="date_prep" class="<?php echo $purchase_report_summary->date_prep->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_date_prep" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->date_prep) ?>', 1);"><div class="purchase_report_date_prep">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->date_prep->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->date_prep->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->date_prep->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->spec_unit->Visible) { ?>
	<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->spec_unit) == "") { ?>
	<th data-name="spec_unit" class="<?php echo $purchase_report_summary->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_unit" type="text/html"><div class="purchase_report_spec_unit"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_unit->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="spec_unit" class="<?php echo $purchase_report_summary->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_unit" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->spec_unit) ?>', 1);"><div class="purchase_report_spec_unit">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_unit->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->spec_unit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->spec_unit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->spec_dsc->Visible) { ?>
	<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->spec_dsc) == "") { ?>
	<th data-name="spec_dsc" class="<?php echo $purchase_report_summary->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_dsc" type="text/html"><div class="purchase_report_spec_dsc"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="spec_dsc" class="<?php echo $purchase_report_summary->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->spec_dsc) ?>', 1);"><div class="purchase_report_spec_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->spec_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->spec_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->spec_qty->Visible) { ?>
	<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->spec_qty) == "") { ?>
	<th data-name="spec_qty" class="<?php echo $purchase_report_summary->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_qty" type="text/html"><div class="purchase_report_spec_qty"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_qty->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="spec_qty" class="<?php echo $purchase_report_summary->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_qty" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->spec_qty) ?>', 1);"><div class="purchase_report_spec_qty">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->spec_qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->spec_qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->spec_unitprice->Visible) { ?>
	<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->spec_unitprice) == "") { ?>
	<th data-name="spec_unitprice" class="<?php echo $purchase_report_summary->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_unitprice" type="text/html"><div class="purchase_report_spec_unitprice"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_unitprice->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="spec_unitprice" class="<?php echo $purchase_report_summary->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_unitprice" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->spec_unitprice) ?>', 1);"><div class="purchase_report_spec_unitprice">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_unitprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->spec_unitprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->spec_unitprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->spec_totalprice->Visible) { ?>
	<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->spec_totalprice) == "") { ?>
	<th data-name="spec_totalprice" class="<?php echo $purchase_report_summary->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_totalprice" type="text/html"><div class="purchase_report_spec_totalprice"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_totalprice->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="spec_totalprice" class="<?php echo $purchase_report_summary->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_spec_totalprice" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->spec_totalprice) ?>', 1);"><div class="purchase_report_spec_totalprice">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->spec_totalprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->spec_totalprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->spec_totalprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->Name_dsc->Visible) { ?>
	<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->Name_dsc) == "") { ?>
	<th data-name="Name_dsc" class="<?php echo $purchase_report_summary->Name_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_Name_dsc" type="text/html"><div class="purchase_report_Name_dsc"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->Name_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Name_dsc" class="<?php echo $purchase_report_summary->Name_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_Name_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->Name_dsc) ?>', 1);"><div class="purchase_report_Name_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->Name_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->purpose->Visible) { ?>
	<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->purpose) == "") { ?>
	<th data-name="purpose" class="<?php echo $purchase_report_summary->purpose->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_purpose" type="text/html"><div class="purchase_report_purpose"><div class="ew-table-header-caption"><?php echo $purchase_report_summary->purpose->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="purpose" class="<?php echo $purchase_report_summary->purpose->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_purchase_report_purpose" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->purpose) ?>', 1);"><div class="purchase_report_purpose">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->purpose->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchase_report_summary->purpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->purpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($purchase_report_summary->TotalGroups == 0)
			break; // Show header only
		$purchase_report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($purchase_report_summary->pr_number, $purchase_report_summary->getSqlFirstGroupField(), $purchase_report_summary->pr_number->groupValue(), $purchase_report_summary->Dbid);
	if ($purchase_report_summary->PageFirstGroupFilter != "") $purchase_report_summary->PageFirstGroupFilter .= " OR ";
	$purchase_report_summary->PageFirstGroupFilter .= $where;
	if ($purchase_report_summary->Filter != "")
		$where = "($purchase_report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($purchase_report_summary->getSqlSelect(), $purchase_report_summary->getSqlWhere(), $purchase_report_summary->getSqlGroupBy(), $purchase_report_summary->getSqlHaving(), $purchase_report_summary->getSqlOrderBy(), $where, $purchase_report_summary->Sort);
	$rs = $purchase_report_summary->getRecordset($sql);
	$purchase_report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$purchase_report_summary->DetailRecordCount = count($purchase_report_summary->DetailRecords);

	// Load detail records
	$purchase_report_summary->pr_number->Records = &$purchase_report_summary->DetailRecords;
	$purchase_report_summary->pr_number->LevelBreak = TRUE; // Set field level break
		$purchase_report_summary->GroupCounter[1] = $purchase_report_summary->GroupCount;
		$purchase_report_summary->pr_number->getCnt($purchase_report_summary->pr_number->Records); // Get record count
?>
<?php if ($purchase_report_summary->pr_number->Visible && $purchase_report_summary->pr_number->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$purchase_report_summary->resetAttributes();
		$purchase_report_summary->RowType = ROWTYPE_TOTAL;
		$purchase_report_summary->RowTotalType = ROWTOTAL_GROUP;
		$purchase_report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$purchase_report_summary->RowGroupLevel = 1;
		$purchase_report_summary->renderRow();
?>
	<tr<?php echo $purchase_report_summary->rowAttributes(); ?>>
<?php if ($purchase_report_summary->pr_number->Visible) { ?>
		<td data-field="pr_number"<?php echo $purchase_report_summary->pr_number->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="pr_number" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>
<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->pr_number) == "") { ?>
		<span class="ew-summary-caption purchase_report_pr_number"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->pr_number->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption purchase_report_pr_number" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->pr_number) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $purchase_report_summary->pr_number->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($purchase_report_summary->pr_number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->pr_number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_purchase_report_pr_number" type="text/html"><span<?php echo $purchase_report_summary->pr_number->viewAttributes() ?>><?php echo $purchase_report_summary->pr_number->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($purchase_report_summary->pr_number->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$purchase_report_summary->date_prep->getDistinctValues($purchase_report_summary->pr_number->Records);
	$purchase_report_summary->setGroupCount(count($purchase_report_summary->date_prep->DistinctValues), $purchase_report_summary->GroupCounter[1]);
	$purchase_report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($purchase_report_summary->date_prep->DistinctValues as $date_prep) { // Load records for this distinct value
		$purchase_report_summary->date_prep->setGroupValue($date_prep); // Set group value
		$purchase_report_summary->date_prep->getDistinctRecords($purchase_report_summary->pr_number->Records, $purchase_report_summary->date_prep->groupValue());
		$purchase_report_summary->date_prep->LevelBreak = TRUE; // Set field level break
		$purchase_report_summary->GroupCounter[2]++;
		$purchase_report_summary->date_prep->getCnt($purchase_report_summary->date_prep->Records); // Get record count
		$purchase_report_summary->setGroupCount($purchase_report_summary->date_prep->Count, $purchase_report_summary->GroupCounter[1], $purchase_report_summary->GroupCounter[2]);
?>
<?php if ($purchase_report_summary->date_prep->Visible && $purchase_report_summary->date_prep->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$purchase_report_summary->date_prep->setDbValue($date_prep); // Set current value for date_prep
		$purchase_report_summary->resetAttributes();
		$purchase_report_summary->RowType = ROWTYPE_TOTAL;
		$purchase_report_summary->RowTotalType = ROWTOTAL_GROUP;
		$purchase_report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$purchase_report_summary->RowGroupLevel = 2;
		$purchase_report_summary->renderRow();
?>
	<tr<?php echo $purchase_report_summary->rowAttributes(); ?>>
<?php if ($purchase_report_summary->pr_number->Visible) { ?>
		<td data-field="pr_number"<?php echo $purchase_report_summary->pr_number->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->date_prep->Visible) { ?>
		<td data-field="date_prep"<?php echo $purchase_report_summary->date_prep->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="date_prep" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $purchase_report_summary->date_prep->cellAttributes() ?>>
<?php if ($purchase_report_summary->sortUrl($purchase_report_summary->date_prep) == "") { ?>
		<span class="ew-summary-caption purchase_report_date_prep"><span class="ew-table-header-caption"><?php echo $purchase_report_summary->date_prep->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption purchase_report_date_prep" onclick="ew.sort(event, '<?php echo $purchase_report_summary->sortUrl($purchase_report_summary->date_prep) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $purchase_report_summary->date_prep->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($purchase_report_summary->date_prep->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchase_report_summary->date_prep->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_purchase_report_date_prep" type="text/html"><span<?php echo $purchase_report_summary->date_prep->viewAttributes() ?>><?php echo $purchase_report_summary->date_prep->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($purchase_report_summary->date_prep->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$purchase_report_summary->RecordCount = 0; // Reset record count
	foreach ($purchase_report_summary->date_prep->Records as $record) {
		$purchase_report_summary->RecordCount++;
		$purchase_report_summary->RecordIndex++;
		$purchase_report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$purchase_report_summary->resetAttributes();
		$purchase_report_summary->RowType = ROWTYPE_DETAIL;
		$purchase_report_summary->renderRow();
?>
	<tr<?php echo $purchase_report_summary->rowAttributes(); ?>>
<?php if ($purchase_report_summary->pr_number->Visible) { ?>
	<?php if ($purchase_report_summary->pr_number->ShowGroupHeaderAsRow) { ?>
		<td data-field="pr_number"<?php echo $purchase_report_summary->pr_number->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="pr_number"<?php echo $purchase_report_summary->pr_number->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_purchase_report_pr_number" type="text/html"><span<?php echo $purchase_report_summary->pr_number->viewAttributes() ?>><?php echo $purchase_report_summary->pr_number->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->date_prep->Visible) { ?>
	<?php if ($purchase_report_summary->date_prep->ShowGroupHeaderAsRow) { ?>
		<td data-field="date_prep"<?php echo $purchase_report_summary->date_prep->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="date_prep"<?php echo $purchase_report_summary->date_prep->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_purchase_report_date_prep" type="text/html"><span<?php echo $purchase_report_summary->date_prep->viewAttributes() ?>><?php echo $purchase_report_summary->date_prep->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($purchase_report_summary->spec_unit->Visible) { ?>
		<td data-field="spec_unit"<?php echo $purchase_report_summary->spec_unit->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_purchase_report_spec_unit" type="text/html">
<span<?php echo $purchase_report_summary->spec_unit->viewAttributes() ?>><?php echo $purchase_report_summary->spec_unit->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_dsc->Visible) { ?>
		<td data-field="spec_dsc"<?php echo $purchase_report_summary->spec_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_purchase_report_spec_dsc" type="text/html">
<span<?php echo $purchase_report_summary->spec_dsc->viewAttributes() ?>><?php echo $purchase_report_summary->spec_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_qty->Visible) { ?>
		<td data-field="spec_qty"<?php echo $purchase_report_summary->spec_qty->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_purchase_report_spec_qty" type="text/html">
<span<?php echo $purchase_report_summary->spec_qty->viewAttributes() ?>><?php echo $purchase_report_summary->spec_qty->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unitprice->Visible) { ?>
		<td data-field="spec_unitprice"<?php echo $purchase_report_summary->spec_unitprice->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_purchase_report_spec_unitprice" type="text/html">
<span<?php echo $purchase_report_summary->spec_unitprice->viewAttributes() ?>><?php echo $purchase_report_summary->spec_unitprice->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_totalprice->Visible) { ?>
		<td data-field="spec_totalprice"<?php echo $purchase_report_summary->spec_totalprice->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_purchase_report_spec_totalprice" type="text/html">
<span<?php echo $purchase_report_summary->spec_totalprice->viewAttributes() ?>><?php echo $purchase_report_summary->spec_totalprice->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $purchase_report_summary->Name_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_purchase_report_Name_dsc" type="text/html">
<span<?php echo $purchase_report_summary->Name_dsc->viewAttributes() ?>><?php echo $purchase_report_summary->Name_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->purpose->Visible) { ?>
		<td data-field="purpose"<?php echo $purchase_report_summary->purpose->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_purchase_report_purpose" type="text/html">
<span<?php echo $purchase_report_summary->purpose->viewAttributes() ?>><?php echo $purchase_report_summary->purpose->getViewValue() ?></span>
</script>
</td>
<?php } ?>
	</tr>
<?php
	}
	} // End group level 1
?>
<?php if ($purchase_report_summary->TotalGroups > 0) { ?>
<?php
	$purchase_report_summary->spec_totalprice->getSum($purchase_report_summary->pr_number->Records); // Get Sum
	$purchase_report_summary->resetAttributes();
	$purchase_report_summary->RowType = ROWTYPE_TOTAL;
	$purchase_report_summary->RowTotalType = ROWTOTAL_GROUP;
	$purchase_report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$purchase_report_summary->RowGroupLevel = 1;
	$purchase_report_summary->renderRow();
?>
<?php if ($purchase_report_summary->pr_number->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $purchase_report_summary->rowAttributes(); ?>>
<?php if ($purchase_report_summary->pr_number->Visible) { ?>
		<td data-field="pr_number"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>
	<?php if ($purchase_report_summary->pr_number->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($purchase_report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($purchase_report_summary->pr_number->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($purchase_report_summary->date_prep->Visible) { ?>
		<td data-field="date_prep"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>
	<?php if ($purchase_report_summary->date_prep->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($purchase_report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($purchase_report_summary->date_prep->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unit->Visible) { ?>
		<td data-field="spec_unit"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_dsc->Visible) { ?>
		<td data-field="spec_dsc"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_qty->Visible) { ?>
		<td data-field="spec_qty"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unitprice->Visible) { ?>
		<td data-field="spec_unitprice"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_totalprice->Visible) { ?>
		<td data-field="spec_totalprice"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgs<?php echo $Page->GroupCount ?>_purchase_report_spec_totalprice" type="text/html"><span<?php echo $purchase_report_summary->spec_totalprice->viewAttributes() ?>><?php echo $purchase_report_summary->spec_totalprice->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($purchase_report_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->purpose->Visible) { ?>
		<td data-field="purpose"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $purchase_report_summary->rowAttributes(); ?>>
<?php if ($purchase_report_summary->GroupColumnCount + $purchase_report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($purchase_report_summary->GroupColumnCount + $purchase_report_summary->DetailColumnCount) ?>"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$purchase_report_summary->pr_number->GroupViewValue, $purchase_report_summary->pr_number->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($purchase_report_summary->pr_number->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $purchase_report_summary->rowAttributes(); ?>>
<?php if ($purchase_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($purchase_report_summary->GroupColumnCount - 0) ?>"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unit->Visible) { ?>
		<td data-field="spec_unit"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_dsc->Visible) { ?>
		<td data-field="spec_dsc"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_qty->Visible) { ?>
		<td data-field="spec_qty"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unitprice->Visible) { ?>
		<td data-field="spec_unitprice"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_totalprice->Visible) { ?>
		<td data-field="spec_totalprice"<?php echo $purchase_report_summary->spec_totalprice->cellAttributes() ?>>
<script id="tpgs<?php echo $Page->GroupCount ?>_purchase_report_spec_totalprice" type="text/html">
<span<?php echo $purchase_report_summary->spec_totalprice->viewAttributes() ?>><?php echo $purchase_report_summary->spec_totalprice->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->purpose->Visible) { ?>
		<td data-field="purpose"<?php echo $purchase_report_summary->pr_number->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$purchase_report_summary->loadGroupRowValues();

	// Show header if page break
	if ($purchase_report_summary->isExport())
		$purchase_report_summary->ShowHeader = ($purchase_report_summary->ExportPageBreakCount == 0) ? FALSE : ($purchase_report_summary->GroupCount % $purchase_report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($purchase_report_summary->ShowHeader)
		$purchase_report_summary->Page_Breaking($purchase_report_summary->ShowHeader, $purchase_report_summary->PageBreakContent);
	$purchase_report_summary->GroupCount++;
} // End while
?>
<?php if ($purchase_report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$purchase_report_summary->resetAttributes();
	$purchase_report_summary->RowType = ROWTYPE_TOTAL;
	$purchase_report_summary->RowTotalType = ROWTOTAL_GRAND;
	$purchase_report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$purchase_report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$purchase_report_summary->renderRow();
?>
<?php if ($purchase_report_summary->pr_number->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $purchase_report_summary->rowAttributes() ?>><td colspan="<?php echo ($purchase_report_summary->GroupColumnCount + $purchase_report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($purchase_report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $purchase_report_summary->rowAttributes() ?>>
<?php if ($purchase_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $purchase_report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unit->Visible) { ?>
		<td data-field="spec_unit"<?php echo $purchase_report_summary->spec_unit->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_dsc->Visible) { ?>
		<td data-field="spec_dsc"<?php echo $purchase_report_summary->spec_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_qty->Visible) { ?>
		<td data-field="spec_qty"<?php echo $purchase_report_summary->spec_qty->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unitprice->Visible) { ?>
		<td data-field="spec_unitprice"<?php echo $purchase_report_summary->spec_unitprice->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_totalprice->Visible) { ?>
		<td data-field="spec_totalprice"<?php echo $purchase_report_summary->spec_totalprice->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpts_purchase_report_spec_totalprice" type="text/html"><span<?php echo $purchase_report_summary->spec_totalprice->viewAttributes() ?>><?php echo $purchase_report_summary->spec_totalprice->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($purchase_report_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $purchase_report_summary->Name_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($purchase_report_summary->purpose->Visible) { ?>
		<td data-field="purpose"<?php echo $purchase_report_summary->purpose->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $purchase_report_summary->rowAttributes() ?>><td colspan="<?php echo ($purchase_report_summary->GroupColumnCount + $purchase_report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($purchase_report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $purchase_report_summary->rowAttributes() ?>>
<?php if ($purchase_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $purchase_report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unit->Visible) { ?>
		<td data-field="spec_unit"<?php echo $purchase_report_summary->spec_unit->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_dsc->Visible) { ?>
		<td data-field="spec_dsc"<?php echo $purchase_report_summary->spec_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_qty->Visible) { ?>
		<td data-field="spec_qty"<?php echo $purchase_report_summary->spec_qty->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_unitprice->Visible) { ?>
		<td data-field="spec_unitprice"<?php echo $purchase_report_summary->spec_unitprice->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->spec_totalprice->Visible) { ?>
		<td data-field="spec_totalprice"<?php echo $purchase_report_summary->spec_totalprice->cellAttributes() ?>>
<script id="tpts_purchase_report_spec_totalprice" type="text/html">
<span<?php echo $purchase_report_summary->spec_totalprice->viewAttributes() ?>><?php echo $purchase_report_summary->spec_totalprice->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($purchase_report_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $purchase_report_summary->Name_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($purchase_report_summary->purpose->Visible) { ?>
		<td data-field="purpose"<?php echo $purchase_report_summary->purpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
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
<?php if ($purchase_report_summary->isExport() || $purchase_report_summary->UseCustomTemplate) { ?>
<div id="tpd_purchase_reportsummary"></div>
<script id="tpm_purchase_reportsummary" type="text/html">
<div id="ct_purchase_report_summary"><table style="height: 212px; width: 1100px;" border="0">
<tbody>
<tr style="height: 14px;">
<td style="width: 102.65px; height: 14px;">&nbsp;</td>
<td style="width: 165.6px; height: 14px;">&nbsp;</td>
<td style="width: 347px; height: 14px; text-align: center; vertical-align: middle;" colspan="2">&nbsp;</td>
<td style="width: 120.467px; height: 14px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="width: 282.283px; height: 14px;">&nbsp;</td>
</tr>
<tr style="height: 14px;">
<td style="width: 102.65px; height: 14px;">&nbsp;</td>
<td style="width: 165.6px; height: 14px;">&nbsp;</td>
<td style="width: 347px; height: 14px; text-align: center; vertical-align: middle;" colspan="2">&nbsp;</td>
<td style="width: 120.467px; height: 14px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="width: 282.283px; height: 14px;">&nbsp;</td>
</tr>
<tr style="height: 14px;">
<td style="width: 102.65px; height: 14px;">&nbsp;</td>
<td style="width: 165.6px; height: 14px;">&nbsp;</td>
<td style="width: 347px; height: 14px; text-align: center; vertical-align: middle;" colspan="2">&nbsp;</td>
<td style="width: 120.467px; height: 14px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="width: 282.283px; height: 14px;">&nbsp;</td>
</tr>
<tr style="height: 14px;">
<td style="width: 102.65px; height: 14px;">&nbsp;</td>
<td style="width: 165.6px; height: 14px;">&nbsp;</td>
<td style="width: 347px; height: 14px; text-align: center; vertical-align: middle;" colspan="2">&nbsp;</td>
<td style="width: 120.467px; height: 14px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="width: 282.283px; height: 14px;">&nbsp;</td>
</tr>
<tr style="height: 14.3333px;">
<td style="width: 102.65px; height: 14.3333px;">&nbsp;</td>
<td style="width: 165.6px; height: 14.3333px;">&nbsp;</td>
<td style="width: 347px; height: 14.3333px; text-align: center; vertical-align: middle;" colspan="2" scope="row"><span style="font-size: large;">&nbsp;</span>&nbsp;</td>
<td style="width: 120.467px; height: 14.3333px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="width: 282.283px; height: 14.3333px;">&nbsp;</td>
</tr>
<tr style="height: 16px;">
<td style="width: 102.65px; height: 16px;">&nbsp;</td>
<td style="width: 165.6px; height: 16px;">&nbsp;</td>
<td style="width: 347px; height: 16px; text-align: center; vertical-align: middle;" colspan="2">&nbsp;</td>
<td style="width: 120.467px; height: 16px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="width: 282.283px; height: 16px;">&nbsp;</td>
</tr>
<tr style="height: 8px;">
<td style="width: 102.65px; height: 8px;">&nbsp;</td>
<td style="width: 165.6px; height: 8px; text-align: left; vertical-align: middle;"><span style="font-size: large;">&nbsp;</span></td>
<td style="width: 347px; height: 8px; text-align: center; vertical-align: middle;" colspan="2" scope="row">&nbsp;&nbsp;<strong><span style="font-size: large;">{{:pr_number.toUpperCase()}}</span></strong></td>
<td style="width: 120.467px; height: 8px;">&nbsp;</td>
<td style="width: 282.283px; height: 8px; text-align: left;">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="width: 102.65px; height: 13px;">&nbsp;</td>
<td style="width: 165.6px; height: 13px;">&nbsp;<span style="font-size: large;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DSWD</span></td>
<td style="width: 347px; height: 13px; text-align: center; vertical-align: middle;" colspan="2"><span style="font-size: large;">&nbsp;</span></td>
<td style="width: 120.467px; height: 13px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="width: 282.283px; height: 13px;">&nbsp;<span style="font-size: large;">{{:date_prep.toUpperCase()}}</span></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</br>
</br>
<table cellspacing="0" cellpadding="0" width="1100px" height="1" border= "0px" >
<tr>
	<th width="10%"><font size="4"><p align="center"></p></th>
	<th width="10%"><font size="4"><p align="center"></p></th>
	<th width="10%"><font size="4"><p align="center"></p></th> 
	<th width="10%"><font size="4"><p align="center"></p></th>
	<th width="10%"><font size="4"><p align="center"></p></th>
	<th width="10%"><font size="4"><p align="center"></p></th>
 <!--	<th width="10%"><font size="3"><p align="center">Total Price</p></th>-->
  </tr>
<?php
$cnt = $Page->GroupCount - 1;
for ($i = 1; $i <= $cnt; $i++) {
?>

<?php
$cnt1 = $Page->getGroupCount($i);
for ($i1 = 1; $i1 <= $cnt1; $i1++) {
?>

<?php
for ($j = 1; $j <= $Page->getGroupCount($i, $i1); $j++) {
?>

<style>
	div.c100{ width:100px; overflow:hidden; }
	div.c90{ width:90px; overflow:hidden; }
	div.c350{ width:350px; overflow:hidden; }
	div.c90{ width:90px; overflow:hidden; }
	div.c110{ width:110px; overflow:hidden; }
	div.c120{ width:120px; overflow:hidden; }
</style> 
<tr>
	<td style="word-wrap:break-word"><div class="c100"><div style="text-align: center;"><font size="4"></div></td>
	<td style="word-wrap:break-word"><div class="c90"><div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_purchase_report_spec_unit")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c350"><div style="text-align: left;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_purchase_report_spec_dsc")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c90"><div style="text-align: right;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_purchase_report_spec_qty")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c110"><div style="text-align: right;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_purchase_report_spec_unitprice")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c120"><div style="text-align: right;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_purchase_report_spec_totalprice")/}}</div></td>
</tr>
<?php
}
?>

<?php
}
?>

<?php
if ($Page->ExportPageBreakCount > 0 && $Page->isExport()) {
if ($i % $Page->ExportPageBreakCount == 0 && $i < $cnt) {
?>
{{include tmpl=~getTemplate("#tpb<?php echo $i ?>_purchase_report")/}}
<?php
}
}
}
?>
<table id="footer2" style="height: 500px; width: 1100px;"border="0">
<tbody>
<tr style="height: 13px;">
<td class="col1" style="width: 148px; height: 13px;">&nbsp;</td>
<td class="col1" style="width: 262px; height: 13px;">
</td>
<td class="col1" style="width: 241.717px; height: 13px;">&nbsp;</td>
<td class="col1" style="width: 199.283px; height: 13px;">&nbsp;</td>
<td class="col1" style="width: 139px; height: 13px;"><strong><strong>&nbsp;</strong></strong>
<p style="font-size: 20px;">{{include tmpl=~getTemplate("#tpts_purchase_report_spec_totalprice")/}}</p>
</td>
</tr>
<tr style="height: 33.8167px;">
<td class="col1" style="width: 148px; height: 33.8167px;">&nbsp;</td>
<td class="col1" style="width: 842px; height: 63.8167px;" colspan="4" rowspan="2">
<p style="font-size: 18px;">{{:purpose}}</p>
</td>
</tr>
<tr style="height: 30px;">
<td class="col1" style="width: 148px; height: 30px;">&nbsp;</td>
</tr>
<tr style="height: 15px;">
<td class="col1" style="width: 148px; height: 15px;">&nbsp;</td>
<td class="col1" style="width: 262px; height: 15px;">&nbsp;</td>
<td class="col1" style="width: 241.717px; height: 15px;">&nbsp;</td>
<td class="col1" style="width: 199.283px; height: 15px;">&nbsp;</td>
<td class="col1" style="width: 139px; height: 15px;">&nbsp;</td>
</tr>
<tr style="height: 17px;">
<td class="col1" style="width: 148px; height: 17px; text-align: left; vertical-align: bottom;">&nbsp;</td>
<td class="col1" style="width: 503.717px; height: 17px; text-align: left; vertical-align: bottom;" colspan="2">
<p style="font-size: 20px;">ASUNCION M. SANTIAGO</p>
</td>
<td class="col1" style="width: 338.283px; height: 17px; text-align: left; vertical-align: bottom;" colspan="2">&nbsp;
<p style="font-size: 20px;">MA. EVELYN B. MACAPOBRE</p>
</td>
</tr>
<tr style="height: 17px;">
<td class="col1" style="width: 148px; height: 17px; text-align: left; vertical-align: top;">&nbsp;</td>
<td class="col1" style="width: 503.717px; height: 17px; text-align: left; vertical-align: top;" colspan="2">
<p style="font-size: 20px;">OIC-Chie Promotive Division</p>
</td>
<td class="col1" style="width: 338.283px; height: 17px; text-align: left; vertical-align: top;" colspan="2">
<p style="font-size: 20px;">Regional Director</p>
</td>
</tr>
<tr style="height: 17px;">
<td class="col1" style="width: 148px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 262px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 241.717px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 199.283px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 139px; height: 17px;">&nbsp;</td>
</tr>
<tr style="height: 17px;">
<td class="col1" style="width: 148px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 262px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 241.717px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 199.283px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 139px; height: 17px;">&nbsp;</td>
</tr>
<tr style="height: 17px;">
<td class="col1" style="width: 148px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 262px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 241.717px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 199.283px; height: 17px;">&nbsp;</td>
<td class="col1" style="width: 139px; height: 17px;">&nbsp;</td>
</tr>
</tbody>
</table>
</div>
</script>

<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$purchase_report_summary->isExport() || $purchase_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$purchase_report_summary->isExport() || $purchase_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$purchase_report_summary->isExport() || $purchase_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($purchase_report->Rows) ?> };
	ew.applyTemplate("tpd_purchase_reportsummary", "tpm_purchase_reportsummary", "purchase_reportsummary", "<?php echo $purchase_report->CustomExport ?>", ew.templateData.rows[0]);
	$("script.purchase_reportsummary_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$purchase_report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$purchase_report_summary->isExport() && !$purchase_report_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#xsr_2").remove();
});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$purchase_report_summary->terminate();
?>