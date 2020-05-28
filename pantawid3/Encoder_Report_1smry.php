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
$Encoder_Report_1_summary = new Encoder_Report_1_summary();

// Run the page
$Encoder_Report_1_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Encoder_Report_1_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Encoder_Report_1_summary->isExport() && !$Encoder_Report_1_summary->DrillDown && !$DashboardReport) { ?>
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
		elm = this.getElements("x" + infix + "_date");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Encoder_Report_1_summary->date->errorMessage()) ?>");

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
	fsummary.lists["x_Name_dsc"] = <?php echo $Encoder_Report_1_summary->Name_dsc->Lookup->toClientList($Encoder_Report_1_summary) ?>;
	fsummary.lists["x_Name_dsc"].options = <?php echo JsonEncode($Encoder_Report_1_summary->Name_dsc->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Encoder_Report_1_summary->getFilterList() ?>;
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
<?php if ((!$Encoder_Report_1_summary->isExport() || $Encoder_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Encoder_Report_1_summary->ShowCurrentFilter) { ?>
<?php $Encoder_Report_1_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Encoder_Report_1_summary->DrillDownInPanel) {
	$Encoder_Report_1_summary->ExportOptions->render("body");
	$Encoder_Report_1_summary->SearchOptions->render("body");
	$Encoder_Report_1_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Encoder_Report_1_summary->showPageHeader(); ?>
<?php
$Encoder_Report_1_summary->showMessage();
?>
<?php if ((!$Encoder_Report_1_summary->isExport() || $Encoder_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Encoder_Report_1_summary->isExport() || $Encoder_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Encoder_Report_1_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Encoder_Report_1_summary->isExport() && !$Encoder_Report_1_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Encoder_Report_1_summary->isExport() && !$Encoder_Report_1->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Encoder_Report_1_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Encoder_Report_1">
	<div class="ew-extended-search">
<?php

// Render search row
$Encoder_Report_1->RowType = ROWTYPE_SEARCH;
$Encoder_Report_1->resetAttributes();
$Encoder_Report_1_summary->renderRow();
?>
<?php if ($Encoder_Report_1_summary->date->Visible) { // date ?>
	<?php
		$Encoder_Report_1_summary->SearchColumnCount++;
		if (($Encoder_Report_1_summary->SearchColumnCount - 1) % $Encoder_Report_1_summary->SearchFieldsPerRow == 0) {
			$Encoder_Report_1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Encoder_Report_1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_date" class="ew-cell form-group">
		<label for="x_date" class="ew-search-caption ew-label"><?php echo $Encoder_Report_1_summary->date->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date" id="z_date" value="BETWEEN">
</span>
		<span id="el_Encoder_Report_1_date" class="ew-search-field">
<input type="text" data-table="Encoder_Report_1" data-field="x_date" data-format="2" name="x_date" id="x_date" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($Encoder_Report_1_summary->date->getPlaceHolder()) ?>" value="<?php echo $Encoder_Report_1_summary->date->EditValue ?>"<?php echo $Encoder_Report_1_summary->date->editAttributes() ?>>
<?php if (!$Encoder_Report_1_summary->date->ReadOnly && !$Encoder_Report_1_summary->date->Disabled && !isset($Encoder_Report_1_summary->date->EditAttrs["readonly"]) && !isset($Encoder_Report_1_summary->date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span><script type="text/html" class="Encoder_Report_1summary_js">
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_Encoder_Report_1_date" class="ew-search-field2">
<input type="text" data-table="Encoder_Report_1" data-field="x_date" data-format="2" name="y_date" id="y_date" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($Encoder_Report_1_summary->date->getPlaceHolder()) ?>" value="<?php echo $Encoder_Report_1_summary->date->EditValue2 ?>"<?php echo $Encoder_Report_1_summary->date->editAttributes() ?>>
<?php if (!$Encoder_Report_1_summary->date->ReadOnly && !$Encoder_Report_1_summary->date->Disabled && !isset($Encoder_Report_1_summary->date->EditAttrs["readonly"]) && !isset($Encoder_Report_1_summary->date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span><script type="text/html" class="Encoder_Report_1summary_js">
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "y_date", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
	</div>
	<?php if ($Encoder_Report_1_summary->SearchColumnCount % $Encoder_Report_1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->Name_dsc->Visible) { // Name_dsc ?>
	<?php
		$Encoder_Report_1_summary->SearchColumnCount++;
		if (($Encoder_Report_1_summary->SearchColumnCount - 1) % $Encoder_Report_1_summary->SearchFieldsPerRow == 0) {
			$Encoder_Report_1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Encoder_Report_1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Name_dsc" class="ew-cell form-group">
		<label for="x_Name_dsc" class="ew-search-caption ew-label"><?php echo $Encoder_Report_1_summary->Name_dsc->caption() ?></label>
		<span id="el_Encoder_Report_1_Name_dsc" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Encoder_Report_1" data-field="x_Name_dsc" data-value-separator="<?php echo $Encoder_Report_1_summary->Name_dsc->displayValueSeparatorAttribute() ?>" id="x_Name_dsc" name="x_Name_dsc"<?php echo $Encoder_Report_1_summary->Name_dsc->editAttributes() ?>>
			<?php echo $Encoder_Report_1_summary->Name_dsc->selectOptionListHtml("x_Name_dsc") ?>
		</select>
</div>
<?php echo $Encoder_Report_1_summary->Name_dsc->Lookup->getParamTag($Encoder_Report_1_summary, "p_x_Name_dsc") ?>
</span>
	</div>
	<?php if ($Encoder_Report_1_summary->SearchColumnCount % $Encoder_Report_1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Encoder_Report_1_summary->SearchColumnCount % $Encoder_Report_1_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Encoder_Report_1_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Encoder_Report_1_summary->GroupCount <= count($Encoder_Report_1_summary->GroupRecords) && $Encoder_Report_1_summary->GroupCount <= $Encoder_Report_1_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Encoder_Report_1_summary->ShowHeader) {
?>
<?php if ($Encoder_Report_1_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Encoder_Report_1_summary->TotalGroups > 0) { ?>
<?php if (!$Encoder_Report_1_summary->isExport() && !($Encoder_Report_1_summary->DrillDown && $Encoder_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Encoder_Report_1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<script id="tpb<?php echo $Encoder_Report_1_summary->GroupCount - 1 ?>_Encoder_Report_1" type="text/html"><?php echo $Encoder_Report_1_summary->PageBreakContent ?></script>
<?php } ?>
<div class="<?php if (!$Encoder_Report_1_summary->isExport("word") && !$Encoder_Report_1_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Encoder_Report_1_summary->ReportTableStyle ?>>
<?php if (!$Encoder_Report_1_summary->isExport() && !($Encoder_Report_1_summary->DrillDown && $Encoder_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Encoder_Report_1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Encoder_Report_1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Encoder_Report_1_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Encoder_Report_1_summary->List_Activities->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->List_Activities->ShowGroupHeaderAsRow) { ?>
	<th data-name="List_Activities">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->List_Activities) == "") { ?>
	<th data-name="List_Activities" class="<?php echo $Encoder_Report_1_summary->List_Activities->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_List_Activities" type="text/html"><div class="Encoder_Report_1_List_Activities"><div class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->List_Activities->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="List_Activities" class="<?php echo $Encoder_Report_1_summary->List_Activities->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_List_Activities" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->List_Activities) ?>', 1);"><div class="Encoder_Report_1_List_Activities">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->List_Activities->caption() ?></span><span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->List_Activities->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->List_Activities->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->encoder_id->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->encoder_id) == "") { ?>
	<th data-name="encoder_id" class="<?php echo $Encoder_Report_1_summary->encoder_id->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_encoder_id" type="text/html"><div class="Encoder_Report_1_encoder_id"><div class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->encoder_id->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="encoder_id" class="<?php echo $Encoder_Report_1_summary->encoder_id->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_encoder_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->encoder_id) ?>', 1);"><div class="Encoder_Report_1_encoder_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->encoder_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->encoder_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->encoder_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->date->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->date) == "") { ?>
	<th data-name="date" class="<?php echo $Encoder_Report_1_summary->date->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_date" type="text/html"><div class="Encoder_Report_1_date"><div class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->date->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="date" class="<?php echo $Encoder_Report_1_summary->date->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_date" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->date) ?>', 1);"><div class="Encoder_Report_1_date">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->action_taken->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->action_taken) == "") { ?>
	<th data-name="action_taken" class="<?php echo $Encoder_Report_1_summary->action_taken->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_action_taken" type="text/html"><div class="Encoder_Report_1_action_taken"><div class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->action_taken->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="action_taken" class="<?php echo $Encoder_Report_1_summary->action_taken->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_action_taken" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->action_taken) ?>', 1);"><div class="Encoder_Report_1_action_taken">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->action_taken->caption() ?></span><span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->action_taken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->action_taken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->total_encoded->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->total_encoded) == "") { ?>
	<th data-name="total_encoded" class="<?php echo $Encoder_Report_1_summary->total_encoded->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_total_encoded" type="text/html"><div class="Encoder_Report_1_total_encoded"><div class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->total_encoded->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="total_encoded" class="<?php echo $Encoder_Report_1_summary->total_encoded->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_total_encoded" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->total_encoded) ?>', 1);"><div class="Encoder_Report_1_total_encoded">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->total_encoded->caption() ?></span><span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->total_encoded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->total_encoded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->status_remark1->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->status_remark1) == "") { ?>
	<th data-name="status_remark1" class="<?php echo $Encoder_Report_1_summary->status_remark1->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_status_remark1" type="text/html"><div class="Encoder_Report_1_status_remark1"><div class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->status_remark1->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="status_remark1" class="<?php echo $Encoder_Report_1_summary->status_remark1->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_status_remark1" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->status_remark1) ?>', 1);"><div class="Encoder_Report_1_status_remark1">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->status_remark1->caption() ?></span><span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->status_remark1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->status_remark1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->Name_dsc->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->Name_dsc) == "") { ?>
	<th data-name="Name_dsc" class="<?php echo $Encoder_Report_1_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_Name_dsc" type="text/html"><div class="Encoder_Report_1_Name_dsc"><div class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->Name_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Name_dsc" class="<?php echo $Encoder_Report_1_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_Encoder_Report_1_Name_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->Name_dsc) ?>', 1);"><div class="Encoder_Report_1_Name_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->Name_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Encoder_Report_1_summary->TotalGroups == 0)
			break; // Show header only
		$Encoder_Report_1_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Encoder_Report_1_summary->List_Activities, $Encoder_Report_1_summary->getSqlFirstGroupField(), $Encoder_Report_1_summary->List_Activities->groupValue(), $Encoder_Report_1_summary->Dbid);
	if ($Encoder_Report_1_summary->PageFirstGroupFilter != "") $Encoder_Report_1_summary->PageFirstGroupFilter .= " OR ";
	$Encoder_Report_1_summary->PageFirstGroupFilter .= $where;
	if ($Encoder_Report_1_summary->Filter != "")
		$where = "($Encoder_Report_1_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Encoder_Report_1_summary->getSqlSelect(), $Encoder_Report_1_summary->getSqlWhere(), $Encoder_Report_1_summary->getSqlGroupBy(), $Encoder_Report_1_summary->getSqlHaving(), $Encoder_Report_1_summary->getSqlOrderBy(), $where, $Encoder_Report_1_summary->Sort);
	$rs = $Encoder_Report_1_summary->getRecordset($sql);
	$Encoder_Report_1_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Encoder_Report_1_summary->DetailRecordCount = count($Encoder_Report_1_summary->DetailRecords);
	$Encoder_Report_1_summary->setGroupCount($Encoder_Report_1_summary->DetailRecordCount, $Encoder_Report_1_summary->GroupCount);

	// Load detail records
	$Encoder_Report_1_summary->List_Activities->Records = &$Encoder_Report_1_summary->DetailRecords;
	$Encoder_Report_1_summary->List_Activities->LevelBreak = TRUE; // Set field level break
		$Encoder_Report_1_summary->GroupCounter[1] = $Encoder_Report_1_summary->GroupCount;
		$Encoder_Report_1_summary->List_Activities->getCnt($Encoder_Report_1_summary->List_Activities->Records); // Get record count
		$Encoder_Report_1_summary->setGroupCount($Encoder_Report_1_summary->List_Activities->Count, $Encoder_Report_1_summary->GroupCounter[1]);
?>
<?php if ($Encoder_Report_1_summary->List_Activities->Visible && $Encoder_Report_1_summary->List_Activities->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Encoder_Report_1_summary->resetAttributes();
		$Encoder_Report_1_summary->RowType = ROWTYPE_TOTAL;
		$Encoder_Report_1_summary->RowTotalType = ROWTOTAL_GROUP;
		$Encoder_Report_1_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Encoder_Report_1_summary->RowGroupLevel = 1;
		$Encoder_Report_1_summary->renderRow();
?>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes(); ?>>
<?php if ($Encoder_Report_1_summary->List_Activities->Visible) { ?>
		<td data-field="List_Activities"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="List_Activities" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>>
<?php if ($Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->List_Activities) == "") { ?>
		<span class="ew-summary-caption Encoder_Report_1_List_Activities"><span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->List_Activities->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Encoder_Report_1_List_Activities" onclick="ew.sort(event, '<?php echo $Encoder_Report_1_summary->sortUrl($Encoder_Report_1_summary->List_Activities) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Encoder_Report_1_summary->List_Activities->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Encoder_Report_1_summary->List_Activities->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Encoder_Report_1_summary->List_Activities->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_Encoder_Report_1_List_Activities" type="text/html"><span<?php echo $Encoder_Report_1_summary->List_Activities->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->List_Activities->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Encoder_Report_1_summary->List_Activities->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Encoder_Report_1_summary->RecordCount = 0; // Reset record count
	foreach ($Encoder_Report_1_summary->List_Activities->Records as $record) {
		$Encoder_Report_1_summary->RecordCount++;
		$Encoder_Report_1_summary->RecordIndex++;
		$Encoder_Report_1_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Encoder_Report_1_summary->resetAttributes();
		$Encoder_Report_1_summary->RowType = ROWTYPE_DETAIL;
		$Encoder_Report_1_summary->renderRow();
?>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes(); ?>>
<?php if ($Encoder_Report_1_summary->List_Activities->Visible) { ?>
	<?php if ($Encoder_Report_1_summary->List_Activities->ShowGroupHeaderAsRow) { ?>
		<td data-field="List_Activities"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="List_Activities"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_Encoder_Report_1_List_Activities" type="text/html"><span<?php echo $Encoder_Report_1_summary->List_Activities->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->List_Activities->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($Encoder_Report_1_summary->encoder_id->Visible) { ?>
		<td data-field="encoder_id"<?php echo $Encoder_Report_1_summary->encoder_id->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Encoder_Report_1_encoder_id" type="text/html">
<span<?php echo $Encoder_Report_1_summary->encoder_id->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->encoder_id->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->date->Visible) { ?>
		<td data-field="date"<?php echo $Encoder_Report_1_summary->date->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Encoder_Report_1_date" type="text/html">
<span<?php echo $Encoder_Report_1_summary->date->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->date->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->action_taken->Visible) { ?>
		<td data-field="action_taken"<?php echo $Encoder_Report_1_summary->action_taken->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Encoder_Report_1_action_taken" type="text/html">
<span<?php echo $Encoder_Report_1_summary->action_taken->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->action_taken->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->total_encoded->Visible) { ?>
		<td data-field="total_encoded"<?php echo $Encoder_Report_1_summary->total_encoded->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Encoder_Report_1_total_encoded" type="text/html">
<span<?php echo $Encoder_Report_1_summary->total_encoded->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->total_encoded->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->status_remark1->Visible) { ?>
		<td data-field="status_remark1"<?php echo $Encoder_Report_1_summary->status_remark1->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Encoder_Report_1_status_remark1" type="text/html">
<span<?php echo $Encoder_Report_1_summary->status_remark1->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->status_remark1->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Encoder_Report_1_summary->Name_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Encoder_Report_1_Name_dsc" type="text/html">
<span<?php echo $Encoder_Report_1_summary->Name_dsc->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->Name_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Encoder_Report_1_summary->TotalGroups > 0) { ?>
<?php
	$Encoder_Report_1_summary->total_encoded->getSum($Encoder_Report_1_summary->List_Activities->Records); // Get Sum
	$Encoder_Report_1_summary->resetAttributes();
	$Encoder_Report_1_summary->RowType = ROWTYPE_TOTAL;
	$Encoder_Report_1_summary->RowTotalType = ROWTOTAL_GROUP;
	$Encoder_Report_1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Encoder_Report_1_summary->RowGroupLevel = 1;
	$Encoder_Report_1_summary->renderRow();
?>
<?php if ($Encoder_Report_1_summary->List_Activities->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes(); ?>>
<?php if ($Encoder_Report_1_summary->List_Activities->Visible) { ?>
		<td data-field="List_Activities"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>>
	<?php if ($Encoder_Report_1_summary->List_Activities->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Encoder_Report_1_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Encoder_Report_1_summary->List_Activities->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->encoder_id->Visible) { ?>
		<td data-field="encoder_id"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->date->Visible) { ?>
		<td data-field="date"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->action_taken->Visible) { ?>
		<td data-field="action_taken"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->total_encoded->Visible) { ?>
		<td data-field="total_encoded"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgs<?php echo $Page->GroupCount ?>_Encoder_Report_1_total_encoded" type="text/html"><span<?php echo $Encoder_Report_1_summary->total_encoded->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->total_encoded->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->status_remark1->Visible) { ?>
		<td data-field="status_remark1"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes(); ?>>
<?php if ($Encoder_Report_1_summary->GroupColumnCount + $Encoder_Report_1_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Encoder_Report_1_summary->GroupColumnCount + $Encoder_Report_1_summary->DetailColumnCount) ?>"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Encoder_Report_1_summary->List_Activities->GroupViewValue, $Encoder_Report_1_summary->List_Activities->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Encoder_Report_1_summary->List_Activities->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes(); ?>>
<?php if ($Encoder_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Encoder_Report_1_summary->GroupColumnCount - 0) ?>"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->encoder_id->Visible) { ?>
		<td data-field="encoder_id"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->date->Visible) { ?>
		<td data-field="date"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->action_taken->Visible) { ?>
		<td data-field="action_taken"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->total_encoded->Visible) { ?>
		<td data-field="total_encoded"<?php echo $Encoder_Report_1_summary->total_encoded->cellAttributes() ?>>
<script id="tpgs<?php echo $Page->GroupCount ?>_Encoder_Report_1_total_encoded" type="text/html">
<span<?php echo $Encoder_Report_1_summary->total_encoded->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->total_encoded->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->status_remark1->Visible) { ?>
		<td data-field="status_remark1"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Encoder_Report_1_summary->List_Activities->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Encoder_Report_1_summary->loadGroupRowValues();

	// Show header if page break
	if ($Encoder_Report_1_summary->isExport())
		$Encoder_Report_1_summary->ShowHeader = ($Encoder_Report_1_summary->ExportPageBreakCount == 0) ? FALSE : ($Encoder_Report_1_summary->GroupCount % $Encoder_Report_1_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Encoder_Report_1_summary->ShowHeader)
		$Encoder_Report_1_summary->Page_Breaking($Encoder_Report_1_summary->ShowHeader, $Encoder_Report_1_summary->PageBreakContent);
	$Encoder_Report_1_summary->GroupCount++;
} // End while
?>
<?php if ($Encoder_Report_1_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Encoder_Report_1_summary->resetAttributes();
	$Encoder_Report_1_summary->RowType = ROWTYPE_TOTAL;
	$Encoder_Report_1_summary->RowTotalType = ROWTOTAL_GRAND;
	$Encoder_Report_1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Encoder_Report_1_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Encoder_Report_1_summary->renderRow();
?>
<?php if ($Encoder_Report_1_summary->List_Activities->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes() ?>><td colspan="<?php echo ($Encoder_Report_1_summary->GroupColumnCount + $Encoder_Report_1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Encoder_Report_1_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes() ?>>
<?php if ($Encoder_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Encoder_Report_1_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->encoder_id->Visible) { ?>
		<td data-field="encoder_id"<?php echo $Encoder_Report_1_summary->encoder_id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->date->Visible) { ?>
		<td data-field="date"<?php echo $Encoder_Report_1_summary->date->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->action_taken->Visible) { ?>
		<td data-field="action_taken"<?php echo $Encoder_Report_1_summary->action_taken->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->total_encoded->Visible) { ?>
		<td data-field="total_encoded"<?php echo $Encoder_Report_1_summary->total_encoded->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpts_Encoder_Report_1_total_encoded" type="text/html"><span<?php echo $Encoder_Report_1_summary->total_encoded->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->total_encoded->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->status_remark1->Visible) { ?>
		<td data-field="status_remark1"<?php echo $Encoder_Report_1_summary->status_remark1->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Encoder_Report_1_summary->Name_dsc->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes() ?>><td colspan="<?php echo ($Encoder_Report_1_summary->GroupColumnCount + $Encoder_Report_1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Encoder_Report_1_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Encoder_Report_1_summary->rowAttributes() ?>>
<?php if ($Encoder_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Encoder_Report_1_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->encoder_id->Visible) { ?>
		<td data-field="encoder_id"<?php echo $Encoder_Report_1_summary->encoder_id->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->date->Visible) { ?>
		<td data-field="date"<?php echo $Encoder_Report_1_summary->date->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->action_taken->Visible) { ?>
		<td data-field="action_taken"<?php echo $Encoder_Report_1_summary->action_taken->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->total_encoded->Visible) { ?>
		<td data-field="total_encoded"<?php echo $Encoder_Report_1_summary->total_encoded->cellAttributes() ?>>
<script id="tpts_Encoder_Report_1_total_encoded" type="text/html">
<span<?php echo $Encoder_Report_1_summary->total_encoded->viewAttributes() ?>><?php echo $Encoder_Report_1_summary->total_encoded->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->status_remark1->Visible) { ?>
		<td data-field="status_remark1"<?php echo $Encoder_Report_1_summary->status_remark1->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Encoder_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Encoder_Report_1_summary->Name_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Encoder_Report_1_summary->TotalGroups > 0) { ?>
<?php if (!$Encoder_Report_1_summary->isExport() && !($Encoder_Report_1_summary->DrillDown && $Encoder_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Encoder_Report_1_summary->Pager->render() ?>
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
<?php if ($Encoder_Report_1_summary->isExport() || $Encoder_Report_1_summary->UseCustomTemplate) { ?>
<div id="tpd_Encoder_Report_1summary"></div>
<script id="tpm_Encoder_Report_1summary" type="text/html">
<div id="ct_Encoder_Report_1_summary"><p><font size="4"><?php echo date("F j, Y"); ?><p>
<center><font size="4">Department of Social Welfare and Development</center>
<center><font size="4">Field Office VI</center>
<center><font size="4">Pantawid Pamilyang Pilipino Program</center>
<center><b><font size="4">Encoder Report</font></b></center>
<br>
 <table cellspacing="0" cellpadding="0" width="100%" height="100%" border= "1px" >
 <tr>
	<th width="10%"><font size="4"><p align="center"><b>Date</b></p></th>
	<th width="15%"><font size="4"><p align="center"><b>List Activities</b></p></th>
	<th width="45%"><font size="4"><p align="center"><b>Action Taken</b></p></th> 
	<th width="10%"><font size="4"><p align="center"><b>Status</b></p></th>
	<th width="10%"><font size="4"><p align="center"><b>Total</b></p></th>
  </tr>
<?php
$cnt = $Page->GroupCount - 1;
for ($i = 1; $i <= $cnt; $i++) {
?>

<?php
for ($j = 1; $j <= $Page->getGroupCount($i); $j++) {
?>
<!--
<style>
	div.c200{ width:200px; overflow:hidden; }
	div.c200{ width:200px; overflow:hidden; }
	div.c700{ width:700px; overflow:hidden; }
	div.c200{ width:200px; overflow:hidden; }
	div.c100{ width:100px; overflow:hidden; }
</style> 
<tr>
	<td style="word-wrap:break-word"><div class="c200"><div style="text-align: center;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_date")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c200"><div style="text-align: center;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_Encoder_Report_1_List_Activities")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c700"><div style="text-align: left;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_action_taken")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c200"><div style="text-align: center;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_status_remark1")/}}</div></td>
	<td style="word-wrap:break-word"><div class="c100"><div style="text-align: right;"><font size="5">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_total_encoded")/}}</div></td>
</tr>
-->
<tr>
	<td <div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_date")/}}</div></td>
	<td <div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_Encoder_Report_1_List_Activities")/}}</div></td>
	<td <div style="text-align: left;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_action_taken")/}}</div></td>
	<td <div style="text-align: center;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_status_remark1")/}}</div></td>
	<td <div style="text-align: right;"><font size="4">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Encoder_Report_1_total_encoded")/}}</div></td>
</tr>
<?php
}
?>
 <tr>
 			<td colspan="4"><div style="text-align: right;"><b><font size="4">TOTAL</b></div> 
 			<td><div style="text-align: right;"><b><font size="4">{{include tmpl=~getTemplate("#tpgs<?php echo $i ?>_Encoder_Report_1_total_encoded")/}}</b></div>
 </tr>
<?php
if ($Page->ExportPageBreakCount > 0 && $Page->isExport()) {
if ($i % $Page->ExportPageBreakCount == 0 && $i < $cnt) {
?>
{{include tmpl=~getTemplate("#tpb<?php echo $i ?>_Encoder_Report_1")/}}
<?php
}
}
}
?>
<tr>
	<td style="width: 204.917px; text-align: right;" colspan="4">&nbsp;&nbsp;&nbsp;<strong><span style="font-size: large;">TOTAL ENCODED&nbsp;</span></strong></td>
	<td style="width: 204.917px; text-align: right;"><strong><span style="font-size: large;">{{include tmpl=~getTemplate("#tpts_Encoder_Report_1_total_encoded")/}}</span></strong></td>
</tr>
 <div style="margin-left:0px">
		<table width="100%" height="100%" cellpadding="0" border="0" border-collapse="0">
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
		<table width="100%" height="100%" cellpadding="0" border="0" border-collapse="0">
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
<?php if ((!$Encoder_Report_1_summary->isExport() || $Encoder_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Encoder_Report_1_summary->isExport() || $Encoder_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Encoder_Report_1_summary->isExport() || $Encoder_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($Encoder_Report_1->Rows) ?> };
	ew.applyTemplate("tpd_Encoder_Report_1summary", "tpm_Encoder_Report_1summary", "Encoder_Report_1summary", "<?php echo $Encoder_Report_1->CustomExport ?>", ew.templateData.rows[0]);
	$("script.Encoder_Report_1summary_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$Encoder_Report_1_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Encoder_Report_1_summary->isExport() && !$Encoder_Report_1_summary->DrillDown && !$DashboardReport) { ?>
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
$Encoder_Report_1_summary->terminate();
?>