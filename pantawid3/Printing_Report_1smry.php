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
$Printing_Report_1_summary = new Printing_Report_1_summary();

// Run the page
$Printing_Report_1_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Printing_Report_1_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Printing_Report_1_summary->isExport() && !$Printing_Report_1_summary->DrillDown && !$DashboardReport) { ?>
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
		elm = this.getElements("x" + infix + "_printing_date");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Printing_Report_1_summary->printing_date->errorMessage()) ?>");

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
	fsummary.lists["x_Name_dsc"] = <?php echo $Printing_Report_1_summary->Name_dsc->Lookup->toClientList($Printing_Report_1_summary) ?>;
	fsummary.lists["x_Name_dsc"].options = <?php echo JsonEncode($Printing_Report_1_summary->Name_dsc->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Printing_Report_1_summary->getFilterList() ?>;
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
<?php if ((!$Printing_Report_1_summary->isExport() || $Printing_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Printing_Report_1_summary->ShowCurrentFilter) { ?>
<?php $Printing_Report_1_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Printing_Report_1_summary->DrillDownInPanel) {
	$Printing_Report_1_summary->ExportOptions->render("body");
	$Printing_Report_1_summary->SearchOptions->render("body");
	$Printing_Report_1_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Printing_Report_1_summary->showPageHeader(); ?>
<?php
$Printing_Report_1_summary->showMessage();
?>
<?php if ((!$Printing_Report_1_summary->isExport() || $Printing_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Printing_Report_1_summary->isExport() || $Printing_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Printing_Report_1_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Printing_Report_1_summary->isExport() && !$Printing_Report_1_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Printing_Report_1_summary->isExport() && !$Printing_Report_1->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Printing_Report_1_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Printing_Report_1">
	<div class="ew-extended-search">
<?php

// Render search row
$Printing_Report_1->RowType = ROWTYPE_SEARCH;
$Printing_Report_1->resetAttributes();
$Printing_Report_1_summary->renderRow();
?>
<?php if ($Printing_Report_1_summary->printing_date->Visible) { // printing_date ?>
	<?php
		$Printing_Report_1_summary->SearchColumnCount++;
		if (($Printing_Report_1_summary->SearchColumnCount - 1) % $Printing_Report_1_summary->SearchFieldsPerRow == 0) {
			$Printing_Report_1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Printing_Report_1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_printing_date" class="ew-cell form-group">
		<label for="x_printing_date" class="ew-search-caption ew-label"><?php echo $Printing_Report_1_summary->printing_date->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_printing_date" id="z_printing_date" value="BETWEEN">
</span>
		<span id="el_Printing_Report_1_printing_date" class="ew-search-field">
<input type="text" data-table="Printing_Report_1" data-field="x_printing_date" name="x_printing_date" id="x_printing_date" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($Printing_Report_1_summary->printing_date->getPlaceHolder()) ?>" value="<?php echo $Printing_Report_1_summary->printing_date->EditValue ?>"<?php echo $Printing_Report_1_summary->printing_date->editAttributes() ?>>
<?php if (!$Printing_Report_1_summary->printing_date->ReadOnly && !$Printing_Report_1_summary->printing_date->Disabled && !isset($Printing_Report_1_summary->printing_date->EditAttrs["readonly"]) && !isset($Printing_Report_1_summary->printing_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span><script type="text/html" class="Printing_Report_1summary_js">
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "x_printing_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_Printing_Report_1_printing_date" class="ew-search-field2">
<input type="text" data-table="Printing_Report_1" data-field="x_printing_date" name="y_printing_date" id="y_printing_date" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($Printing_Report_1_summary->printing_date->getPlaceHolder()) ?>" value="<?php echo $Printing_Report_1_summary->printing_date->EditValue2 ?>"<?php echo $Printing_Report_1_summary->printing_date->editAttributes() ?>>
<?php if (!$Printing_Report_1_summary->printing_date->ReadOnly && !$Printing_Report_1_summary->printing_date->Disabled && !isset($Printing_Report_1_summary->printing_date->EditAttrs["readonly"]) && !isset($Printing_Report_1_summary->printing_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span><script type="text/html" class="Printing_Report_1summary_js">
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "y_printing_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
	</div>
	<?php if ($Printing_Report_1_summary->SearchColumnCount % $Printing_Report_1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Printing_Report_1_summary->Name_dsc->Visible) { // Name_dsc ?>
	<?php
		$Printing_Report_1_summary->SearchColumnCount++;
		if (($Printing_Report_1_summary->SearchColumnCount - 1) % $Printing_Report_1_summary->SearchFieldsPerRow == 0) {
			$Printing_Report_1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Printing_Report_1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Name_dsc" class="ew-cell form-group">
		<label for="x_Name_dsc" class="ew-search-caption ew-label"><?php echo $Printing_Report_1_summary->Name_dsc->caption() ?></label>
		<span id="el_Printing_Report_1_Name_dsc" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Printing_Report_1" data-field="x_Name_dsc" data-value-separator="<?php echo $Printing_Report_1_summary->Name_dsc->displayValueSeparatorAttribute() ?>" id="x_Name_dsc" name="x_Name_dsc"<?php echo $Printing_Report_1_summary->Name_dsc->editAttributes() ?>>
			<?php echo $Printing_Report_1_summary->Name_dsc->selectOptionListHtml("x_Name_dsc") ?>
		</select>
</div>
<?php echo $Printing_Report_1_summary->Name_dsc->Lookup->getParamTag($Printing_Report_1_summary, "p_x_Name_dsc") ?>
</span>
	</div>
	<?php if ($Printing_Report_1_summary->SearchColumnCount % $Printing_Report_1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Printing_Report_1_summary->SearchColumnCount % $Printing_Report_1_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Printing_Report_1_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Printing_Report_1_summary->GroupCount <= count($Printing_Report_1_summary->GroupRecords) && $Printing_Report_1_summary->GroupCount <= $Printing_Report_1_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Printing_Report_1_summary->ShowHeader) {
?>
<?php if ($Printing_Report_1_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Printing_Report_1_summary->TotalGroups > 0) { ?>
<?php if (!$Printing_Report_1_summary->isExport() && !($Printing_Report_1_summary->DrillDown && $Printing_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Printing_Report_1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<script id="tpb<?php echo $Printing_Report_1_summary->GroupCount - 1 ?>_Printing_Report_1" type="text/html"><?php echo $Printing_Report_1_summary->PageBreakContent ?></script>
<?php } ?>
<div class="<?php if (!$Printing_Report_1_summary->isExport("word") && !$Printing_Report_1_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Printing_Report_1_summary->ReportTableStyle ?>>
<?php if (!$Printing_Report_1_summary->isExport() && !($Printing_Report_1_summary->DrillDown && $Printing_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Printing_Report_1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Printing_Report_1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Printing_Report_1_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Printing_Report_1_summary->typeofprinting->Visible) { ?>
	<?php if ($Printing_Report_1_summary->typeofprinting->ShowGroupHeaderAsRow) { ?>
	<th data-name="typeofprinting">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->typeofprinting) == "") { ?>
	<th data-name="typeofprinting" class="<?php echo $Printing_Report_1_summary->typeofprinting->headerCellClass() ?>"><script id="tpc_Printing_Report_1_typeofprinting" type="text/html"><div class="Printing_Report_1_typeofprinting"><div class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->typeofprinting->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="typeofprinting" class="<?php echo $Printing_Report_1_summary->typeofprinting->headerCellClass() ?>"><script id="tpc_Printing_Report_1_typeofprinting" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->typeofprinting) ?>', 1);"><div class="Printing_Report_1_typeofprinting">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->typeofprinting->caption() ?></span><span class="ew-table-header-sort"><?php if ($Printing_Report_1_summary->typeofprinting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Printing_Report_1_summary->typeofprinting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Printing_Report_1_summary->printing_date->Visible) { ?>
	<?php if ($Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->printing_date) == "") { ?>
	<th data-name="printing_date" class="<?php echo $Printing_Report_1_summary->printing_date->headerCellClass() ?>"><script id="tpc_Printing_Report_1_printing_date" type="text/html"><div class="Printing_Report_1_printing_date"><div class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->printing_date->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="printing_date" class="<?php echo $Printing_Report_1_summary->printing_date->headerCellClass() ?>"><script id="tpc_Printing_Report_1_printing_date" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->printing_date) ?>', 1);"><div class="Printing_Report_1_printing_date">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->printing_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($Printing_Report_1_summary->printing_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Printing_Report_1_summary->printing_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Printing_Report_1_summary->printed_forms->Visible) { ?>
	<?php if ($Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->printed_forms) == "") { ?>
	<th data-name="printed_forms" class="<?php echo $Printing_Report_1_summary->printed_forms->headerCellClass() ?>"><script id="tpc_Printing_Report_1_printed_forms" type="text/html"><div class="Printing_Report_1_printed_forms"><div class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->printed_forms->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="printed_forms" class="<?php echo $Printing_Report_1_summary->printed_forms->headerCellClass() ?>"><script id="tpc_Printing_Report_1_printed_forms" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->printed_forms) ?>', 1);"><div class="Printing_Report_1_printed_forms">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->printed_forms->caption() ?></span><span class="ew-table-header-sort"><?php if ($Printing_Report_1_summary->printed_forms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Printing_Report_1_summary->printed_forms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Printing_Report_1_summary->total_forms->Visible) { ?>
	<?php if ($Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->total_forms) == "") { ?>
	<th data-name="total_forms" class="<?php echo $Printing_Report_1_summary->total_forms->headerCellClass() ?>"><script id="tpc_Printing_Report_1_total_forms" type="text/html"><div class="Printing_Report_1_total_forms"><div class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->total_forms->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="total_forms" class="<?php echo $Printing_Report_1_summary->total_forms->headerCellClass() ?>"><script id="tpc_Printing_Report_1_total_forms" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->total_forms) ?>', 1);"><div class="Printing_Report_1_total_forms">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->total_forms->caption() ?></span><span class="ew-table-header-sort"><?php if ($Printing_Report_1_summary->total_forms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Printing_Report_1_summary->total_forms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Printing_Report_1_summary->statusPrinting->Visible) { ?>
	<?php if ($Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->statusPrinting) == "") { ?>
	<th data-name="statusPrinting" class="<?php echo $Printing_Report_1_summary->statusPrinting->headerCellClass() ?>"><script id="tpc_Printing_Report_1_statusPrinting" type="text/html"><div class="Printing_Report_1_statusPrinting"><div class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->statusPrinting->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="statusPrinting" class="<?php echo $Printing_Report_1_summary->statusPrinting->headerCellClass() ?>"><script id="tpc_Printing_Report_1_statusPrinting" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->statusPrinting) ?>', 1);"><div class="Printing_Report_1_statusPrinting">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->statusPrinting->caption() ?></span><span class="ew-table-header-sort"><?php if ($Printing_Report_1_summary->statusPrinting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Printing_Report_1_summary->statusPrinting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Printing_Report_1_summary->Name_dsc->Visible) { ?>
	<?php if ($Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->Name_dsc) == "") { ?>
	<th data-name="Name_dsc" class="<?php echo $Printing_Report_1_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_Printing_Report_1_Name_dsc" type="text/html"><div class="Printing_Report_1_Name_dsc"><div class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->Name_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Name_dsc" class="<?php echo $Printing_Report_1_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_Printing_Report_1_Name_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->Name_dsc) ?>', 1);"><div class="Printing_Report_1_Name_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->Name_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Printing_Report_1_summary->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Printing_Report_1_summary->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Printing_Report_1_summary->TotalGroups == 0)
			break; // Show header only
		$Printing_Report_1_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Printing_Report_1_summary->typeofprinting, $Printing_Report_1_summary->getSqlFirstGroupField(), $Printing_Report_1_summary->typeofprinting->groupValue(), $Printing_Report_1_summary->Dbid);
	if ($Printing_Report_1_summary->PageFirstGroupFilter != "") $Printing_Report_1_summary->PageFirstGroupFilter .= " OR ";
	$Printing_Report_1_summary->PageFirstGroupFilter .= $where;
	if ($Printing_Report_1_summary->Filter != "")
		$where = "($Printing_Report_1_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Printing_Report_1_summary->getSqlSelect(), $Printing_Report_1_summary->getSqlWhere(), $Printing_Report_1_summary->getSqlGroupBy(), $Printing_Report_1_summary->getSqlHaving(), $Printing_Report_1_summary->getSqlOrderBy(), $where, $Printing_Report_1_summary->Sort);
	$rs = $Printing_Report_1_summary->getRecordset($sql);
	$Printing_Report_1_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Printing_Report_1_summary->DetailRecordCount = count($Printing_Report_1_summary->DetailRecords);
	$Printing_Report_1_summary->setGroupCount($Printing_Report_1_summary->DetailRecordCount, $Printing_Report_1_summary->GroupCount);

	// Load detail records
	$Printing_Report_1_summary->typeofprinting->Records = &$Printing_Report_1_summary->DetailRecords;
	$Printing_Report_1_summary->typeofprinting->LevelBreak = TRUE; // Set field level break
		$Printing_Report_1_summary->GroupCounter[1] = $Printing_Report_1_summary->GroupCount;
		$Printing_Report_1_summary->typeofprinting->getCnt($Printing_Report_1_summary->typeofprinting->Records); // Get record count
		$Printing_Report_1_summary->setGroupCount($Printing_Report_1_summary->typeofprinting->Count, $Printing_Report_1_summary->GroupCounter[1]);
?>
<?php if ($Printing_Report_1_summary->typeofprinting->Visible && $Printing_Report_1_summary->typeofprinting->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Printing_Report_1_summary->resetAttributes();
		$Printing_Report_1_summary->RowType = ROWTYPE_TOTAL;
		$Printing_Report_1_summary->RowTotalType = ROWTOTAL_GROUP;
		$Printing_Report_1_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Printing_Report_1_summary->RowGroupLevel = 1;
		$Printing_Report_1_summary->renderRow();
?>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes(); ?>>
<?php if ($Printing_Report_1_summary->typeofprinting->Visible) { ?>
		<td data-field="typeofprinting"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="typeofprinting" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>>
<?php if ($Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->typeofprinting) == "") { ?>
		<span class="ew-summary-caption Printing_Report_1_typeofprinting"><span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->typeofprinting->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Printing_Report_1_typeofprinting" onclick="ew.sort(event, '<?php echo $Printing_Report_1_summary->sortUrl($Printing_Report_1_summary->typeofprinting) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Printing_Report_1_summary->typeofprinting->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Printing_Report_1_summary->typeofprinting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Printing_Report_1_summary->typeofprinting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_Printing_Report_1_typeofprinting" type="text/html"><span<?php echo $Printing_Report_1_summary->typeofprinting->viewAttributes() ?>><?php echo $Printing_Report_1_summary->typeofprinting->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Printing_Report_1_summary->typeofprinting->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Printing_Report_1_summary->RecordCount = 0; // Reset record count
	foreach ($Printing_Report_1_summary->typeofprinting->Records as $record) {
		$Printing_Report_1_summary->RecordCount++;
		$Printing_Report_1_summary->RecordIndex++;
		$Printing_Report_1_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Printing_Report_1_summary->resetAttributes();
		$Printing_Report_1_summary->RowType = ROWTYPE_DETAIL;
		$Printing_Report_1_summary->renderRow();
?>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes(); ?>>
<?php if ($Printing_Report_1_summary->typeofprinting->Visible) { ?>
	<?php if ($Printing_Report_1_summary->typeofprinting->ShowGroupHeaderAsRow) { ?>
		<td data-field="typeofprinting"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="typeofprinting"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_Printing_Report_1_typeofprinting" type="text/html"><span<?php echo $Printing_Report_1_summary->typeofprinting->viewAttributes() ?>><?php echo $Printing_Report_1_summary->typeofprinting->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($Printing_Report_1_summary->printing_date->Visible) { ?>
		<td data-field="printing_date"<?php echo $Printing_Report_1_summary->printing_date->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Printing_Report_1_printing_date" type="text/html">
<span<?php echo $Printing_Report_1_summary->printing_date->viewAttributes() ?>><?php echo $Printing_Report_1_summary->printing_date->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printed_forms->Visible) { ?>
		<td data-field="printed_forms"<?php echo $Printing_Report_1_summary->printed_forms->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Printing_Report_1_printed_forms" type="text/html">
<span<?php echo $Printing_Report_1_summary->printed_forms->viewAttributes() ?>><?php echo $Printing_Report_1_summary->printed_forms->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->total_forms->Visible) { ?>
		<td data-field="total_forms"<?php echo $Printing_Report_1_summary->total_forms->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Printing_Report_1_total_forms" type="text/html">
<span<?php echo $Printing_Report_1_summary->total_forms->viewAttributes() ?>><?php echo $Printing_Report_1_summary->total_forms->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->statusPrinting->Visible) { ?>
		<td data-field="statusPrinting"<?php echo $Printing_Report_1_summary->statusPrinting->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Printing_Report_1_statusPrinting" type="text/html">
<span<?php echo $Printing_Report_1_summary->statusPrinting->viewAttributes() ?>><?php echo $Printing_Report_1_summary->statusPrinting->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Printing_Report_1_summary->Name_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Printing_Report_1_Name_dsc" type="text/html">
<span<?php echo $Printing_Report_1_summary->Name_dsc->viewAttributes() ?>><?php echo $Printing_Report_1_summary->Name_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Printing_Report_1_summary->TotalGroups > 0) { ?>
<?php
	$Printing_Report_1_summary->total_forms->getSum($Printing_Report_1_summary->typeofprinting->Records); // Get Sum
	$Printing_Report_1_summary->resetAttributes();
	$Printing_Report_1_summary->RowType = ROWTYPE_TOTAL;
	$Printing_Report_1_summary->RowTotalType = ROWTOTAL_GROUP;
	$Printing_Report_1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Printing_Report_1_summary->RowGroupLevel = 1;
	$Printing_Report_1_summary->renderRow();
?>
<?php if ($Printing_Report_1_summary->typeofprinting->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes(); ?>>
<?php if ($Printing_Report_1_summary->typeofprinting->Visible) { ?>
		<td data-field="typeofprinting"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>>
	<?php if ($Printing_Report_1_summary->typeofprinting->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Printing_Report_1_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Printing_Report_1_summary->typeofprinting->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printing_date->Visible) { ?>
		<td data-field="printing_date"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printed_forms->Visible) { ?>
		<td data-field="printed_forms"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->total_forms->Visible) { ?>
		<td data-field="total_forms"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgs<?php echo $Page->GroupCount ?>_Printing_Report_1_total_forms" type="text/html"><span<?php echo $Printing_Report_1_summary->total_forms->viewAttributes() ?>><?php echo $Printing_Report_1_summary->total_forms->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->statusPrinting->Visible) { ?>
		<td data-field="statusPrinting"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes(); ?>>
<?php if ($Printing_Report_1_summary->GroupColumnCount + $Printing_Report_1_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Printing_Report_1_summary->GroupColumnCount + $Printing_Report_1_summary->DetailColumnCount) ?>"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Printing_Report_1_summary->typeofprinting->GroupViewValue, $Printing_Report_1_summary->typeofprinting->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Printing_Report_1_summary->typeofprinting->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes(); ?>>
<?php if ($Printing_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Printing_Report_1_summary->GroupColumnCount - 0) ?>"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printing_date->Visible) { ?>
		<td data-field="printing_date"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printed_forms->Visible) { ?>
		<td data-field="printed_forms"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->total_forms->Visible) { ?>
		<td data-field="total_forms"<?php echo $Printing_Report_1_summary->total_forms->cellAttributes() ?>>
<script id="tpgs<?php echo $Page->GroupCount ?>_Printing_Report_1_total_forms" type="text/html">
<span<?php echo $Printing_Report_1_summary->total_forms->viewAttributes() ?>><?php echo $Printing_Report_1_summary->total_forms->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->statusPrinting->Visible) { ?>
		<td data-field="statusPrinting"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Printing_Report_1_summary->typeofprinting->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Printing_Report_1_summary->loadGroupRowValues();

	// Show header if page break
	if ($Printing_Report_1_summary->isExport())
		$Printing_Report_1_summary->ShowHeader = ($Printing_Report_1_summary->ExportPageBreakCount == 0) ? FALSE : ($Printing_Report_1_summary->GroupCount % $Printing_Report_1_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Printing_Report_1_summary->ShowHeader)
		$Printing_Report_1_summary->Page_Breaking($Printing_Report_1_summary->ShowHeader, $Printing_Report_1_summary->PageBreakContent);
	$Printing_Report_1_summary->GroupCount++;
} // End while
?>
<?php if ($Printing_Report_1_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Printing_Report_1_summary->resetAttributes();
	$Printing_Report_1_summary->RowType = ROWTYPE_TOTAL;
	$Printing_Report_1_summary->RowTotalType = ROWTOTAL_GRAND;
	$Printing_Report_1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Printing_Report_1_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Printing_Report_1_summary->renderRow();
?>
<?php if ($Printing_Report_1_summary->typeofprinting->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes() ?>><td colspan="<?php echo ($Printing_Report_1_summary->GroupColumnCount + $Printing_Report_1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Printing_Report_1_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes() ?>>
<?php if ($Printing_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Printing_Report_1_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printing_date->Visible) { ?>
		<td data-field="printing_date"<?php echo $Printing_Report_1_summary->printing_date->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printed_forms->Visible) { ?>
		<td data-field="printed_forms"<?php echo $Printing_Report_1_summary->printed_forms->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->total_forms->Visible) { ?>
		<td data-field="total_forms"<?php echo $Printing_Report_1_summary->total_forms->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpts_Printing_Report_1_total_forms" type="text/html"><span<?php echo $Printing_Report_1_summary->total_forms->viewAttributes() ?>><?php echo $Printing_Report_1_summary->total_forms->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->statusPrinting->Visible) { ?>
		<td data-field="statusPrinting"<?php echo $Printing_Report_1_summary->statusPrinting->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Printing_Report_1_summary->Name_dsc->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes() ?>><td colspan="<?php echo ($Printing_Report_1_summary->GroupColumnCount + $Printing_Report_1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Printing_Report_1_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Printing_Report_1_summary->rowAttributes() ?>>
<?php if ($Printing_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Printing_Report_1_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printing_date->Visible) { ?>
		<td data-field="printing_date"<?php echo $Printing_Report_1_summary->printing_date->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->printed_forms->Visible) { ?>
		<td data-field="printed_forms"<?php echo $Printing_Report_1_summary->printed_forms->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->total_forms->Visible) { ?>
		<td data-field="total_forms"<?php echo $Printing_Report_1_summary->total_forms->cellAttributes() ?>>
<script id="tpts_Printing_Report_1_total_forms" type="text/html">
<span<?php echo $Printing_Report_1_summary->total_forms->viewAttributes() ?>><?php echo $Printing_Report_1_summary->total_forms->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->statusPrinting->Visible) { ?>
		<td data-field="statusPrinting"<?php echo $Printing_Report_1_summary->statusPrinting->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Printing_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Printing_Report_1_summary->Name_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Printing_Report_1_summary->TotalGroups > 0) { ?>
<?php if (!$Printing_Report_1_summary->isExport() && !($Printing_Report_1_summary->DrillDown && $Printing_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Printing_Report_1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<?php if ($Printing_Report_1_summary->isExport() || $Printing_Report_1_summary->UseCustomTemplate) { ?>
<div id="tpd_Printing_Report_1summary"></div>
<script id="tpm_Printing_Report_1summary" type="text/html">
<div id="ct_Printing_Report_1_summary"><p><font size="4"><?php echo date("F j, Y"); ?><p>
<center><font size="4">Department of Social Welfare and Development</center>
<center><font size="4">Field Office VI</center>
<center><font size="4">Pantawid Pamilyang Pilipino Program</center>
<center><b><font size="4">Printing Report</font></b></center>
<br>
<table cellspacing="0" cellpadding="0" width="100%" height="100%" border= "1px" >
	<tr>
	<th width="10%"><font size="4"><p align="center">Date</p></th>
	<th width="15%"><font size="4"><p align="center">Type of Forms</p></th>
	<th width="45%"><font size="4"><p align="center">Printed Forms</p></th> 
	<th width="10%"><font size="4"><p align="center">Status</p></th>
	<th width="10%"><font size="4"><p align="center">Printed</p></th>
  </tr>
<?php
$cnt = $Page->GroupCount - 1;
for ($i = 1; $i <= $cnt; $i++) {
?>

<?php
for ($j = 1; $j <= $Page->getGroupCount($i); $j++) {
?>
 <!--<tr>
	<td><font size="3">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_printing_date")/}}</td>
  	<td><font size="3">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_Printing_Report_1_typeofprinting")/}}</td>
	<td><font size="3">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_printed_forms")/}}</td>
	<td><font size="3">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_statusPrinting")/}}</td>
	<td><div style="text-align: right;"><font size="3">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_total_forms")/}}</dv></td>
  </tr>-->
<!--	
<style>
	div.c100{ width:100px; overflow:hidden; }
	div.c150{ width:200px; overflow:hidden; }
	div.c700{ width:700px; overflow:hidden; }
	div.c100{ width:200px; overflow:hidden; }
	div.c100{ width:200px; overflow:hidden; }
</style> 
<tr>
	<td style="word-wrap:break-word"><div class="c100"><div style="text-align: center;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_printing_date")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c200"><div style="text-align: center;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_Printing_Report_1_typeofprinting")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c700"><div style="text-align: left;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_printed_forms")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c200"><div style="text-align: center;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_statusPrinting")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c200"><div style="text-align: center;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_total_forms")/}}</div></td>
</tr>
-->
<tr>
	<td <div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_printing_date")/}}</div></td>
	<td <div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_Printing_Report_1_typeofprinting")/}}</div></td>
	<td <div style="text-align: left;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_printed_forms")/}}</div></td>
	<td <div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_statusPrinting")/}}</div></td>
	<td <div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Printing_Report_1_total_forms")/}}</div></td>
</tr>
<?php
}
?>
	<tr>
 			<td colspan="4"><div style="text-align: right;"><font size="4"><b>TOTAL</b></div> 
 			<td><div style="text-align: right;"><b><font size="4">{{include tmpl=~getTemplate("#tpgs<?php echo $i ?>_Printing_Report_1_total_forms")/}}</b></div>
 	</tr>
<?php
if ($Page->ExportPageBreakCount > 0 && $Page->isExport()) {
if ($i % $Page->ExportPageBreakCount == 0 && $i < $cnt) {
?>
{{include tmpl=~getTemplate("#tpb<?php echo $i ?>_Printing_Report_1")/}}
<?php
}
}
}
?>
<tr>
<td style="width: 183.717px; text-align: right;" colspan="4"><strong><span style="font-size: large;">TOTAL PRINTED</span></strong></td>
<td style="width: 183.717px; text-align: right;"><strong><span style="font-size: large;">{{include tmpl=~getTemplate("#tpts_Printing_Report_1_total_forms")/}}</span></strong></td>
</tr>
 <div style="margin-left:0px">
		<table width="100%" cellpadding="0" border="0" border-collapse="0" height="100%">
	<tr>
			  <td width="20%" align="left"><font size="4"><p>Prepared by:</p></br>
			  	 	<font size="4"><p align="left"><b><u>{{:Name_dsc.toUpperCase()}}</u></b></br>
			  	    <font size="4">Encoder</p></td>
			  <td width="40%" align="left"><font size="4"><p>Reviewed by:</p></br>
			  	 	<font size="4"><p align="left"><b><u>RANDY B. MARQUEZ</u></b></br>
			  	    <font size="4">CMT II-Pantawid</p></td>
	</tr>
	   </table>
</div>
<div style="margin-left:0px">
		<table width="100%" cellpadding="0" border="0" border-collapse="0" height="100%">
	<tr>
			  <td width="20%" align="left"><font size="4"><p>Approved by:</p></br>
			  	 	<font size="4"><p align="left"><b><u>RICHARD A. SEVILLA</u></b></br>
			  	    <font size="4">RITO I-Pantawid</p></td>
			  <td width="40%" align="left"><font size="4"><p>Reviewed by:</p></br>
			  	 	<font size="4"><p align="left"><b><u>MICHAEL STEPHEN C. LOPEZ</u></b></br>
			  	   <font size="4">CMT II-Pantawid</p></td>
	</tr>
	</table>
</div>
</div>
</script>

<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Printing_Report_1_summary->isExport() || $Printing_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Printing_Report_1_summary->isExport() || $Printing_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Printing_Report_1_summary->isExport() || $Printing_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($Printing_Report_1->Rows) ?> };
	ew.applyTemplate("tpd_Printing_Report_1summary", "tpm_Printing_Report_1summary", "Printing_Report_1summary", "<?php echo $Printing_Report_1->CustomExport ?>", ew.templateData.rows[0]);
	$("script.Printing_Report_1summary_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$Printing_Report_1_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Printing_Report_1_summary->isExport() && !$Printing_Report_1_summary->DrillDown && !$DashboardReport) { ?>
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
$Printing_Report_1_summary->terminate();
?>