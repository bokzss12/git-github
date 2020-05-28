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
$Inventory_Report_1_summary = new Inventory_Report_1_summary();

// Run the page
$Inventory_Report_1_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Inventory_Report_1_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Inventory_Report_1_summary->isExport() && !$Inventory_Report_1_summary->DrillDown && !$DashboardReport) { ?>
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
		elm = this.getElements("x" + infix + "_Last_Date_Check");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Inventory_Report_1_summary->Last_Date_Check->errorMessage()) ?>");

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
	fsummary.lists["x_Name_dsc"] = <?php echo $Inventory_Report_1_summary->Name_dsc->Lookup->toClientList($Inventory_Report_1_summary) ?>;
	fsummary.lists["x_Name_dsc"].options = <?php echo JsonEncode($Inventory_Report_1_summary->Name_dsc->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Inventory_Report_1_summary->getFilterList() ?>;
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
<?php if ((!$Inventory_Report_1_summary->isExport() || $Inventory_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Inventory_Report_1_summary->ShowCurrentFilter) { ?>
<?php $Inventory_Report_1_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Inventory_Report_1_summary->DrillDownInPanel) {
	$Inventory_Report_1_summary->ExportOptions->render("body");
	$Inventory_Report_1_summary->SearchOptions->render("body");
	$Inventory_Report_1_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Inventory_Report_1_summary->showPageHeader(); ?>
<?php
$Inventory_Report_1_summary->showMessage();
?>
<?php if ((!$Inventory_Report_1_summary->isExport() || $Inventory_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Inventory_Report_1_summary->isExport() || $Inventory_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Inventory_Report_1_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Inventory_Report_1_summary->isExport() && !$Inventory_Report_1_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Inventory_Report_1_summary->isExport() && !$Inventory_Report_1->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Inventory_Report_1_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Inventory_Report_1">
	<div class="ew-extended-search">
<?php

// Render search row
$Inventory_Report_1->RowType = ROWTYPE_SEARCH;
$Inventory_Report_1->resetAttributes();
$Inventory_Report_1_summary->renderRow();
?>
<?php if ($Inventory_Report_1_summary->Last_Date_Check->Visible) { // Last_Date_Check ?>
	<?php
		$Inventory_Report_1_summary->SearchColumnCount++;
		if (($Inventory_Report_1_summary->SearchColumnCount - 1) % $Inventory_Report_1_summary->SearchFieldsPerRow == 0) {
			$Inventory_Report_1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Inventory_Report_1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Last_Date_Check" class="ew-cell form-group">
		<label for="x_Last_Date_Check" class="ew-search-caption ew-label"><?php echo $Inventory_Report_1_summary->Last_Date_Check->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_Last_Date_Check" id="z_Last_Date_Check" value="BETWEEN">
</span>
		<span id="el_Inventory_Report_1_Last_Date_Check" class="ew-search-field">
<input type="text" data-table="Inventory_Report_1" data-field="x_Last_Date_Check" data-format="2" name="x_Last_Date_Check" id="x_Last_Date_Check" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($Inventory_Report_1_summary->Last_Date_Check->getPlaceHolder()) ?>" value="<?php echo $Inventory_Report_1_summary->Last_Date_Check->EditValue ?>"<?php echo $Inventory_Report_1_summary->Last_Date_Check->editAttributes() ?>>
<?php if (!$Inventory_Report_1_summary->Last_Date_Check->ReadOnly && !$Inventory_Report_1_summary->Last_Date_Check->Disabled && !isset($Inventory_Report_1_summary->Last_Date_Check->EditAttrs["readonly"]) && !isset($Inventory_Report_1_summary->Last_Date_Check->EditAttrs["disabled"])) { ?>
<?php } ?>
</span><script type="text/html" class="Inventory_Report_1summary_js">
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "x_Last_Date_Check", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_Inventory_Report_1_Last_Date_Check" class="ew-search-field2">
<input type="text" data-table="Inventory_Report_1" data-field="x_Last_Date_Check" data-format="2" name="y_Last_Date_Check" id="y_Last_Date_Check" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($Inventory_Report_1_summary->Last_Date_Check->getPlaceHolder()) ?>" value="<?php echo $Inventory_Report_1_summary->Last_Date_Check->EditValue2 ?>"<?php echo $Inventory_Report_1_summary->Last_Date_Check->editAttributes() ?>>
<?php if (!$Inventory_Report_1_summary->Last_Date_Check->ReadOnly && !$Inventory_Report_1_summary->Last_Date_Check->Disabled && !isset($Inventory_Report_1_summary->Last_Date_Check->EditAttrs["readonly"]) && !isset($Inventory_Report_1_summary->Last_Date_Check->EditAttrs["disabled"])) { ?>
<?php } ?>
</span><script type="text/html" class="Inventory_Report_1summary_js">
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "y_Last_Date_Check", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
	</div>
	<?php if ($Inventory_Report_1_summary->SearchColumnCount % $Inventory_Report_1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Name_dsc->Visible) { // Name_dsc ?>
	<?php
		$Inventory_Report_1_summary->SearchColumnCount++;
		if (($Inventory_Report_1_summary->SearchColumnCount - 1) % $Inventory_Report_1_summary->SearchFieldsPerRow == 0) {
			$Inventory_Report_1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Inventory_Report_1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Name_dsc" class="ew-cell form-group">
		<label for="x_Name_dsc" class="ew-search-caption ew-label"><?php echo $Inventory_Report_1_summary->Name_dsc->caption() ?></label>
		<span id="el_Inventory_Report_1_Name_dsc" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Inventory_Report_1" data-field="x_Name_dsc" data-value-separator="<?php echo $Inventory_Report_1_summary->Name_dsc->displayValueSeparatorAttribute() ?>" id="x_Name_dsc" name="x_Name_dsc"<?php echo $Inventory_Report_1_summary->Name_dsc->editAttributes() ?>>
			<?php echo $Inventory_Report_1_summary->Name_dsc->selectOptionListHtml("x_Name_dsc") ?>
		</select>
</div>
<?php echo $Inventory_Report_1_summary->Name_dsc->Lookup->getParamTag($Inventory_Report_1_summary, "p_x_Name_dsc") ?>
</span>
	</div>
	<?php if ($Inventory_Report_1_summary->SearchColumnCount % $Inventory_Report_1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Inventory_Report_1_summary->SearchColumnCount % $Inventory_Report_1_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Inventory_Report_1_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Inventory_Report_1_summary->GroupCount <= count($Inventory_Report_1_summary->GroupRecords) && $Inventory_Report_1_summary->GroupCount <= $Inventory_Report_1_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Inventory_Report_1_summary->ShowHeader) {
?>
<?php if ($Inventory_Report_1_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Inventory_Report_1_summary->TotalGroups > 0) { ?>
<?php if (!$Inventory_Report_1_summary->isExport() && !($Inventory_Report_1_summary->DrillDown && $Inventory_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Inventory_Report_1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<script id="tpb<?php echo $Inventory_Report_1_summary->GroupCount - 1 ?>_Inventory_Report_1" type="text/html"><?php echo $Inventory_Report_1_summary->PageBreakContent ?></script>
<?php } ?>
<div class="<?php if (!$Inventory_Report_1_summary->isExport("word") && !$Inventory_Report_1_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Inventory_Report_1_summary->ReportTableStyle ?>>
<?php if (!$Inventory_Report_1_summary->isExport() && !($Inventory_Report_1_summary->DrillDown && $Inventory_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Inventory_Report_1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Inventory_Report_1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Inventory_Report_1_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Inventory_Report_1_summary->cat_desc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->cat_desc->ShowGroupHeaderAsRow) { ?>
	<th data-name="cat_desc">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->cat_desc) == "") { ?>
	<th data-name="cat_desc" class="<?php echo $Inventory_Report_1_summary->cat_desc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_cat_desc" type="text/html"><div class="Inventory_Report_1_cat_desc"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->cat_desc->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="cat_desc" class="<?php echo $Inventory_Report_1_summary->cat_desc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_cat_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->cat_desc) ?>', 1);"><div class="Inventory_Report_1_cat_desc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->cat_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_id->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->inventory_id) == "") { ?>
	<th data-name="inventory_id" class="<?php echo $Inventory_Report_1_summary->inventory_id->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_inventory_id" type="text/html"><div class="Inventory_Report_1_inventory_id"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->inventory_id->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="inventory_id" class="<?php echo $Inventory_Report_1_summary->inventory_id->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_inventory_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->inventory_id) ?>', 1);"><div class="Inventory_Report_1_inventory_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->inventory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->month_dsc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->month_dsc) == "") { ?>
	<th data-name="month_dsc" class="<?php echo $Inventory_Report_1_summary->month_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_month_dsc" type="text/html"><div class="Inventory_Report_1_month_dsc"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->month_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="month_dsc" class="<?php echo $Inventory_Report_1_summary->month_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_month_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->month_dsc) ?>', 1);"><div class="Inventory_Report_1_month_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->month_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->month_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->month_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->year_dsc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->year_dsc) == "") { ?>
	<th data-name="year_dsc" class="<?php echo $Inventory_Report_1_summary->year_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_year_dsc" type="text/html"><div class="Inventory_Report_1_year_dsc"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->year_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="year_dsc" class="<?php echo $Inventory_Report_1_summary->year_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_year_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->year_dsc) ?>', 1);"><div class="Inventory_Report_1_year_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->year_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->year_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->year_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_model->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->item_model) == "") { ?>
	<th data-name="item_model" class="<?php echo $Inventory_Report_1_summary->item_model->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_item_model" type="text/html"><div class="Inventory_Report_1_item_model"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->item_model->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="item_model" class="<?php echo $Inventory_Report_1_summary->item_model->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_item_model" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->item_model) ?>', 1);"><div class="Inventory_Report_1_item_model">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->item_model->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_serial->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->item_serial) == "") { ?>
	<th data-name="item_serial" class="<?php echo $Inventory_Report_1_summary->item_serial->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_item_serial" type="text/html"><div class="Inventory_Report_1_item_serial"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->item_serial->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="item_serial" class="<?php echo $Inventory_Report_1_summary->item_serial->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_item_serial" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->item_serial) ?>', 1);"><div class="Inventory_Report_1_item_serial">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->item_serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->off_desc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->off_desc) == "") { ?>
	<th data-name="off_desc" class="<?php echo $Inventory_Report_1_summary->off_desc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_off_desc" type="text/html"><div class="Inventory_Report_1_off_desc"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->off_desc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="off_desc" class="<?php echo $Inventory_Report_1_summary->off_desc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_off_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->off_desc) ?>', 1);"><div class="Inventory_Report_1_off_desc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->off_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Last_Date_Check->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->Last_Date_Check) == "") { ?>
	<th data-name="Last_Date_Check" class="<?php echo $Inventory_Report_1_summary->Last_Date_Check->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_Last_Date_Check" type="text/html"><div class="Inventory_Report_1_Last_Date_Check"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->Last_Date_Check->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Last_Date_Check" class="<?php echo $Inventory_Report_1_summary->Last_Date_Check->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_Last_Date_Check" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->Last_Date_Check) ?>', 1);"><div class="Inventory_Report_1_Last_Date_Check">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->Last_Date_Check->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->Last_Date_Check->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->Last_Date_Check->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_status_dsc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->inventory_status_dsc) == "") { ?>
	<th data-name="inventory_status_dsc" class="<?php echo $Inventory_Report_1_summary->inventory_status_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_inventory_status_dsc" type="text/html"><div class="Inventory_Report_1_inventory_status_dsc"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->inventory_status_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="inventory_status_dsc" class="<?php echo $Inventory_Report_1_summary->inventory_status_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_inventory_status_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->inventory_status_dsc) ?>', 1);"><div class="Inventory_Report_1_inventory_status_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->inventory_status_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->inventory_status_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->inventory_status_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->remarks->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->remarks) == "") { ?>
	<th data-name="remarks" class="<?php echo $Inventory_Report_1_summary->remarks->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_remarks" type="text/html"><div class="Inventory_Report_1_remarks"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->remarks->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="remarks" class="<?php echo $Inventory_Report_1_summary->remarks->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_remarks" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->remarks) ?>', 1);"><div class="Inventory_Report_1_remarks">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Name_dsc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->Name_dsc) == "") { ?>
	<th data-name="Name_dsc" class="<?php echo $Inventory_Report_1_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_Name_dsc" type="text/html"><div class="Inventory_Report_1_Name_dsc"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->Name_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Name_dsc" class="<?php echo $Inventory_Report_1_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_Name_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->Name_dsc) ?>', 1);"><div class="Inventory_Report_1_Name_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->Name_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->user_last_modify->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->user_last_modify) == "") { ?>
	<th data-name="user_last_modify" class="<?php echo $Inventory_Report_1_summary->user_last_modify->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_user_last_modify" type="text/html"><div class="Inventory_Report_1_user_last_modify"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->user_last_modify->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="user_last_modify" class="<?php echo $Inventory_Report_1_summary->user_last_modify->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_user_last_modify" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->user_last_modify) ?>', 1);"><div class="Inventory_Report_1_user_last_modify">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->user_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->date_last_modify->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->date_last_modify) == "") { ?>
	<th data-name="date_last_modify" class="<?php echo $Inventory_Report_1_summary->date_last_modify->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_date_last_modify" type="text/html"><div class="Inventory_Report_1_date_last_modify"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->date_last_modify->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="date_last_modify" class="<?php echo $Inventory_Report_1_summary->date_last_modify->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_date_last_modify" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->date_last_modify) ?>', 1);"><div class="Inventory_Report_1_date_last_modify">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->date_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->date_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->date_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pullout_date->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->pullout_date) == "") { ?>
	<th data-name="pullout_date" class="<?php echo $Inventory_Report_1_summary->pullout_date->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_pullout_date" type="text/html"><div class="Inventory_Report_1_pullout_date"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->pullout_date->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="pullout_date" class="<?php echo $Inventory_Report_1_summary->pullout_date->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_pullout_date" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->pullout_date) ?>', 1);"><div class="Inventory_Report_1_pullout_date">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->pullout_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->pullout_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->pullout_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pos_desc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->pos_desc) == "") { ?>
	<th data-name="pos_desc" class="<?php echo $Inventory_Report_1_summary->pos_desc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_pos_desc" type="text/html"><div class="Inventory_Report_1_pos_desc"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->pos_desc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="pos_desc" class="<?php echo $Inventory_Report_1_summary->pos_desc->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_pos_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->pos_desc) ?>', 1);"><div class="Inventory_Report_1_pos_desc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->pos_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->pos_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->pos_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->current_location->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->current_location) == "") { ?>
	<th data-name="current_location" class="<?php echo $Inventory_Report_1_summary->current_location->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_current_location" type="text/html"><div class="Inventory_Report_1_current_location"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->current_location->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="current_location" class="<?php echo $Inventory_Report_1_summary->current_location->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_current_location" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->current_location) ?>', 1);"><div class="Inventory_Report_1_current_location">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->current_location->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->current_location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->current_location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->last_name->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->last_name) == "") { ?>
	<th data-name="last_name" class="<?php echo $Inventory_Report_1_summary->last_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_last_name" type="text/html"><div class="Inventory_Report_1_last_name"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->last_name->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="last_name" class="<?php echo $Inventory_Report_1_summary->last_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_last_name" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->last_name) ?>', 1);"><div class="Inventory_Report_1_last_name">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->last_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->last_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->last_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->first_name->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->first_name) == "") { ?>
	<th data-name="first_name" class="<?php echo $Inventory_Report_1_summary->first_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_first_name" type="text/html"><div class="Inventory_Report_1_first_name"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->first_name->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="first_name" class="<?php echo $Inventory_Report_1_summary->first_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_first_name" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->first_name) ?>', 1);"><div class="Inventory_Report_1_first_name">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->first_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->mid_name->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->mid_name) == "") { ?>
	<th data-name="mid_name" class="<?php echo $Inventory_Report_1_summary->mid_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_mid_name" type="text/html"><div class="Inventory_Report_1_mid_name"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->mid_name->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="mid_name" class="<?php echo $Inventory_Report_1_summary->mid_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_mid_name" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->mid_name) ?>', 1);"><div class="Inventory_Report_1_mid_name">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->mid_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->mid_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->mid_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->ext_name->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->ext_name) == "") { ?>
	<th data-name="ext_name" class="<?php echo $Inventory_Report_1_summary->ext_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_ext_name" type="text/html"><div class="Inventory_Report_1_ext_name"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->ext_name->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="ext_name" class="<?php echo $Inventory_Report_1_summary->ext_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_ext_name" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->ext_name) ?>', 1);"><div class="Inventory_Report_1_ext_name">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->ext_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->ext_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->ext_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->full_name) == "") { ?>
	<th data-name="full_name" class="<?php echo $Inventory_Report_1_summary->full_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_full_name" type="text/html"><div class="Inventory_Report_1_full_name"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->full_name->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="full_name" class="<?php echo $Inventory_Report_1_summary->full_name->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_full_name" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->full_name) ?>', 1);"><div class="Inventory_Report_1_full_name">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->full_name->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->full_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->full_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name_tbl->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->full_name_tbl) == "") { ?>
	<th data-name="full_name_tbl" class="<?php echo $Inventory_Report_1_summary->full_name_tbl->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_full_name_tbl" type="text/html"><div class="Inventory_Report_1_full_name_tbl"><div class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->full_name_tbl->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="full_name_tbl" class="<?php echo $Inventory_Report_1_summary->full_name_tbl->headerCellClass() ?>"><script id="tpc_Inventory_Report_1_full_name_tbl" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->full_name_tbl) ?>', 1);"><div class="Inventory_Report_1_full_name_tbl">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->full_name_tbl->caption() ?></span><span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->full_name_tbl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->full_name_tbl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Inventory_Report_1_summary->TotalGroups == 0)
			break; // Show header only
		$Inventory_Report_1_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Inventory_Report_1_summary->cat_desc, $Inventory_Report_1_summary->getSqlFirstGroupField(), $Inventory_Report_1_summary->cat_desc->groupValue(), $Inventory_Report_1_summary->Dbid);
	if ($Inventory_Report_1_summary->PageFirstGroupFilter != "") $Inventory_Report_1_summary->PageFirstGroupFilter .= " OR ";
	$Inventory_Report_1_summary->PageFirstGroupFilter .= $where;
	if ($Inventory_Report_1_summary->Filter != "")
		$where = "($Inventory_Report_1_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Inventory_Report_1_summary->getSqlSelect(), $Inventory_Report_1_summary->getSqlWhere(), $Inventory_Report_1_summary->getSqlGroupBy(), $Inventory_Report_1_summary->getSqlHaving(), $Inventory_Report_1_summary->getSqlOrderBy(), $where, $Inventory_Report_1_summary->Sort);
	$rs = $Inventory_Report_1_summary->getRecordset($sql);
	$Inventory_Report_1_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Inventory_Report_1_summary->DetailRecordCount = count($Inventory_Report_1_summary->DetailRecords);
	$Inventory_Report_1_summary->setGroupCount($Inventory_Report_1_summary->DetailRecordCount, $Inventory_Report_1_summary->GroupCount);

	// Load detail records
	$Inventory_Report_1_summary->cat_desc->Records = &$Inventory_Report_1_summary->DetailRecords;
	$Inventory_Report_1_summary->cat_desc->LevelBreak = TRUE; // Set field level break
		$Inventory_Report_1_summary->GroupCounter[1] = $Inventory_Report_1_summary->GroupCount;
		$Inventory_Report_1_summary->cat_desc->getCnt($Inventory_Report_1_summary->cat_desc->Records); // Get record count
		$Inventory_Report_1_summary->setGroupCount($Inventory_Report_1_summary->cat_desc->Count, $Inventory_Report_1_summary->GroupCounter[1]);
?>
<?php if ($Inventory_Report_1_summary->cat_desc->Visible && $Inventory_Report_1_summary->cat_desc->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Inventory_Report_1_summary->resetAttributes();
		$Inventory_Report_1_summary->RowType = ROWTYPE_TOTAL;
		$Inventory_Report_1_summary->RowTotalType = ROWTOTAL_GROUP;
		$Inventory_Report_1_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Inventory_Report_1_summary->RowGroupLevel = 1;
		$Inventory_Report_1_summary->renderRow();
?>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes(); ?>>
<?php if ($Inventory_Report_1_summary->cat_desc->Visible) { ?>
		<td data-field="cat_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="cat_desc" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>
<?php if ($Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->cat_desc) == "") { ?>
		<span class="ew-summary-caption Inventory_Report_1_cat_desc"><span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->cat_desc->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Inventory_Report_1_cat_desc" onclick="ew.sort(event, '<?php echo $Inventory_Report_1_summary->sortUrl($Inventory_Report_1_summary->cat_desc) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Inventory_Report_1_summary->cat_desc->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Inventory_Report_1_summary->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Inventory_Report_1_summary->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_Inventory_Report_1_cat_desc" type="text/html"><span<?php echo $Inventory_Report_1_summary->cat_desc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->cat_desc->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Inventory_Report_1_summary->cat_desc->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Inventory_Report_1_summary->RecordCount = 0; // Reset record count
	foreach ($Inventory_Report_1_summary->cat_desc->Records as $record) {
		$Inventory_Report_1_summary->RecordCount++;
		$Inventory_Report_1_summary->RecordIndex++;
		$Inventory_Report_1_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Inventory_Report_1_summary->resetAttributes();
		$Inventory_Report_1_summary->RowType = ROWTYPE_DETAIL;
		$Inventory_Report_1_summary->renderRow();
?>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes(); ?>>
<?php if ($Inventory_Report_1_summary->cat_desc->Visible) { ?>
	<?php if ($Inventory_Report_1_summary->cat_desc->ShowGroupHeaderAsRow) { ?>
		<td data-field="cat_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="cat_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_Inventory_Report_1_cat_desc" type="text/html"><span<?php echo $Inventory_Report_1_summary->cat_desc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->cat_desc->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $Inventory_Report_1_summary->inventory_id->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_inventory_id" type="text/html">
<span<?php echo $Inventory_Report_1_summary->inventory_id->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->inventory_id->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->month_dsc->Visible) { ?>
		<td data-field="month_dsc"<?php echo $Inventory_Report_1_summary->month_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_month_dsc" type="text/html">
<span<?php echo $Inventory_Report_1_summary->month_dsc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->month_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $Inventory_Report_1_summary->year_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_year_dsc" type="text/html">
<span<?php echo $Inventory_Report_1_summary->year_dsc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->year_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $Inventory_Report_1_summary->item_model->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_item_model" type="text/html">
<span<?php echo $Inventory_Report_1_summary->item_model->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->item_model->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $Inventory_Report_1_summary->item_serial->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_item_serial" type="text/html">
<span<?php echo $Inventory_Report_1_summary->item_serial->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->item_serial->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $Inventory_Report_1_summary->off_desc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_off_desc" type="text/html">
<span<?php echo $Inventory_Report_1_summary->off_desc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->off_desc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $Inventory_Report_1_summary->Last_Date_Check->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_Last_Date_Check" type="text/html">
<span<?php echo $Inventory_Report_1_summary->Last_Date_Check->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->Last_Date_Check->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $Inventory_Report_1_summary->inventory_status_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_inventory_status_dsc" type="text/html">
<span<?php echo $Inventory_Report_1_summary->inventory_status_dsc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->inventory_status_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->remarks->Visible) { ?>
		<td data-field="remarks"<?php echo $Inventory_Report_1_summary->remarks->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_remarks" type="text/html">
<span<?php echo $Inventory_Report_1_summary->remarks->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->remarks->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Inventory_Report_1_summary->Name_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_Name_dsc" type="text/html">
<span<?php echo $Inventory_Report_1_summary->Name_dsc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->Name_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->user_last_modify->Visible) { ?>
		<td data-field="user_last_modify"<?php echo $Inventory_Report_1_summary->user_last_modify->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_user_last_modify" type="text/html">
<span<?php echo $Inventory_Report_1_summary->user_last_modify->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->user_last_modify->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->date_last_modify->Visible) { ?>
		<td data-field="date_last_modify"<?php echo $Inventory_Report_1_summary->date_last_modify->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_date_last_modify" type="text/html">
<span<?php echo $Inventory_Report_1_summary->date_last_modify->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->date_last_modify->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pullout_date->Visible) { ?>
		<td data-field="pullout_date"<?php echo $Inventory_Report_1_summary->pullout_date->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_pullout_date" type="text/html">
<span<?php echo $Inventory_Report_1_summary->pullout_date->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->pullout_date->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $Inventory_Report_1_summary->pos_desc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_pos_desc" type="text/html">
<span<?php echo $Inventory_Report_1_summary->pos_desc->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->pos_desc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->current_location->Visible) { ?>
		<td data-field="current_location"<?php echo $Inventory_Report_1_summary->current_location->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_current_location" type="text/html">
<span<?php echo $Inventory_Report_1_summary->current_location->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->current_location->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->last_name->Visible) { ?>
		<td data-field="last_name"<?php echo $Inventory_Report_1_summary->last_name->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_last_name" type="text/html">
<span<?php echo $Inventory_Report_1_summary->last_name->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->last_name->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->first_name->Visible) { ?>
		<td data-field="first_name"<?php echo $Inventory_Report_1_summary->first_name->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_first_name" type="text/html">
<span<?php echo $Inventory_Report_1_summary->first_name->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->first_name->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->mid_name->Visible) { ?>
		<td data-field="mid_name"<?php echo $Inventory_Report_1_summary->mid_name->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_mid_name" type="text/html">
<span<?php echo $Inventory_Report_1_summary->mid_name->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->mid_name->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->ext_name->Visible) { ?>
		<td data-field="ext_name"<?php echo $Inventory_Report_1_summary->ext_name->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_ext_name" type="text/html">
<span<?php echo $Inventory_Report_1_summary->ext_name->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->ext_name->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name->Visible) { ?>
		<td data-field="full_name"<?php echo $Inventory_Report_1_summary->full_name->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_full_name" type="text/html">
<span<?php echo $Inventory_Report_1_summary->full_name->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->full_name->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $Inventory_Report_1_summary->full_name_tbl->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_Inventory_Report_1_full_name_tbl" type="text/html">
<span<?php echo $Inventory_Report_1_summary->full_name_tbl->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->full_name_tbl->getViewValue() ?></span>
</script>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Inventory_Report_1_summary->TotalGroups > 0) { ?>
<?php
	$Inventory_Report_1_summary->inventory_id->getCnt($Inventory_Report_1_summary->cat_desc->Records); // Get Cnt
	$Inventory_Report_1_summary->resetAttributes();
	$Inventory_Report_1_summary->RowType = ROWTYPE_TOTAL;
	$Inventory_Report_1_summary->RowTotalType = ROWTOTAL_GROUP;
	$Inventory_Report_1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Inventory_Report_1_summary->RowGroupLevel = 1;
	$Inventory_Report_1_summary->renderRow();
?>
<?php if ($Inventory_Report_1_summary->cat_desc->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes(); ?>>
<?php if ($Inventory_Report_1_summary->cat_desc->Visible) { ?>
		<td data-field="cat_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>
	<?php if ($Inventory_Report_1_summary->cat_desc->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Inventory_Report_1_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Inventory_Report_1_summary->cat_desc->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgc<?php echo $Page->GroupCount ?>_Inventory_Report_1_inventory_id" type="text/html"><span<?php echo $Inventory_Report_1_summary->inventory_id->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->inventory_id->CntViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->month_dsc->Visible) { ?>
		<td data-field="month_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->remarks->Visible) { ?>
		<td data-field="remarks"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->user_last_modify->Visible) { ?>
		<td data-field="user_last_modify"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->date_last_modify->Visible) { ?>
		<td data-field="date_last_modify"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pullout_date->Visible) { ?>
		<td data-field="pullout_date"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->current_location->Visible) { ?>
		<td data-field="current_location"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->last_name->Visible) { ?>
		<td data-field="last_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->first_name->Visible) { ?>
		<td data-field="first_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->mid_name->Visible) { ?>
		<td data-field="mid_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->ext_name->Visible) { ?>
		<td data-field="ext_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name->Visible) { ?>
		<td data-field="full_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes(); ?>>
<?php if ($Inventory_Report_1_summary->GroupColumnCount + $Inventory_Report_1_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Inventory_Report_1_summary->GroupColumnCount + $Inventory_Report_1_summary->DetailColumnCount) ?>"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Inventory_Report_1_summary->cat_desc->GroupViewValue, $Inventory_Report_1_summary->cat_desc->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Inventory_Report_1_summary->cat_desc->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes(); ?>>
<?php if ($Inventory_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Inventory_Report_1_summary->GroupColumnCount - 0) ?>"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>><?php echo $Language->phrase("RptCnt") ?></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $Inventory_Report_1_summary->inventory_id->cellAttributes() ?>>
<script id="tpgc<?php echo $Page->GroupCount ?>_Inventory_Report_1_inventory_id" type="text/html">
<span<?php echo $Inventory_Report_1_summary->inventory_id->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->inventory_id->CntViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->month_dsc->Visible) { ?>
		<td data-field="month_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->remarks->Visible) { ?>
		<td data-field="remarks"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->user_last_modify->Visible) { ?>
		<td data-field="user_last_modify"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->date_last_modify->Visible) { ?>
		<td data-field="date_last_modify"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pullout_date->Visible) { ?>
		<td data-field="pullout_date"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->current_location->Visible) { ?>
		<td data-field="current_location"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->last_name->Visible) { ?>
		<td data-field="last_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->first_name->Visible) { ?>
		<td data-field="first_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->mid_name->Visible) { ?>
		<td data-field="mid_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->ext_name->Visible) { ?>
		<td data-field="ext_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name->Visible) { ?>
		<td data-field="full_name"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $Inventory_Report_1_summary->cat_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Inventory_Report_1_summary->loadGroupRowValues();

	// Show header if page break
	if ($Inventory_Report_1_summary->isExport())
		$Inventory_Report_1_summary->ShowHeader = ($Inventory_Report_1_summary->ExportPageBreakCount == 0) ? FALSE : ($Inventory_Report_1_summary->GroupCount % $Inventory_Report_1_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Inventory_Report_1_summary->ShowHeader)
		$Inventory_Report_1_summary->Page_Breaking($Inventory_Report_1_summary->ShowHeader, $Inventory_Report_1_summary->PageBreakContent);
	$Inventory_Report_1_summary->GroupCount++;
} // End while
?>
<?php if ($Inventory_Report_1_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Inventory_Report_1_summary->resetAttributes();
	$Inventory_Report_1_summary->RowType = ROWTYPE_TOTAL;
	$Inventory_Report_1_summary->RowTotalType = ROWTOTAL_GRAND;
	$Inventory_Report_1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Inventory_Report_1_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Inventory_Report_1_summary->renderRow();
?>
<?php if ($Inventory_Report_1_summary->cat_desc->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes() ?>><td colspan="<?php echo ($Inventory_Report_1_summary->GroupColumnCount + $Inventory_Report_1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Inventory_Report_1_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes() ?>>
<?php if ($Inventory_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Inventory_Report_1_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $Inventory_Report_1_summary->inventory_id->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tptc_Inventory_Report_1_inventory_id" type="text/html"><span<?php echo $Inventory_Report_1_summary->inventory_id->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->inventory_id->CntViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->month_dsc->Visible) { ?>
		<td data-field="month_dsc"<?php echo $Inventory_Report_1_summary->month_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $Inventory_Report_1_summary->year_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $Inventory_Report_1_summary->item_model->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $Inventory_Report_1_summary->item_serial->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $Inventory_Report_1_summary->off_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $Inventory_Report_1_summary->Last_Date_Check->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $Inventory_Report_1_summary->inventory_status_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->remarks->Visible) { ?>
		<td data-field="remarks"<?php echo $Inventory_Report_1_summary->remarks->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Inventory_Report_1_summary->Name_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->user_last_modify->Visible) { ?>
		<td data-field="user_last_modify"<?php echo $Inventory_Report_1_summary->user_last_modify->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->date_last_modify->Visible) { ?>
		<td data-field="date_last_modify"<?php echo $Inventory_Report_1_summary->date_last_modify->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pullout_date->Visible) { ?>
		<td data-field="pullout_date"<?php echo $Inventory_Report_1_summary->pullout_date->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $Inventory_Report_1_summary->pos_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->current_location->Visible) { ?>
		<td data-field="current_location"<?php echo $Inventory_Report_1_summary->current_location->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->last_name->Visible) { ?>
		<td data-field="last_name"<?php echo $Inventory_Report_1_summary->last_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->first_name->Visible) { ?>
		<td data-field="first_name"<?php echo $Inventory_Report_1_summary->first_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->mid_name->Visible) { ?>
		<td data-field="mid_name"<?php echo $Inventory_Report_1_summary->mid_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->ext_name->Visible) { ?>
		<td data-field="ext_name"<?php echo $Inventory_Report_1_summary->ext_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name->Visible) { ?>
		<td data-field="full_name"<?php echo $Inventory_Report_1_summary->full_name->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $Inventory_Report_1_summary->full_name_tbl->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes() ?>><td colspan="<?php echo ($Inventory_Report_1_summary->GroupColumnCount + $Inventory_Report_1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Inventory_Report_1_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Inventory_Report_1_summary->rowAttributes() ?>>
<?php if ($Inventory_Report_1_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Inventory_Report_1_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptCnt") ?></td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $Inventory_Report_1_summary->inventory_id->cellAttributes() ?>>
<script id="tptc_Inventory_Report_1_inventory_id" type="text/html">
<span<?php echo $Inventory_Report_1_summary->inventory_id->viewAttributes() ?>><?php echo $Inventory_Report_1_summary->inventory_id->CntViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->month_dsc->Visible) { ?>
		<td data-field="month_dsc"<?php echo $Inventory_Report_1_summary->month_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $Inventory_Report_1_summary->year_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $Inventory_Report_1_summary->item_model->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $Inventory_Report_1_summary->item_serial->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $Inventory_Report_1_summary->off_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $Inventory_Report_1_summary->Last_Date_Check->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $Inventory_Report_1_summary->inventory_status_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->remarks->Visible) { ?>
		<td data-field="remarks"<?php echo $Inventory_Report_1_summary->remarks->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $Inventory_Report_1_summary->Name_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->user_last_modify->Visible) { ?>
		<td data-field="user_last_modify"<?php echo $Inventory_Report_1_summary->user_last_modify->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->date_last_modify->Visible) { ?>
		<td data-field="date_last_modify"<?php echo $Inventory_Report_1_summary->date_last_modify->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pullout_date->Visible) { ?>
		<td data-field="pullout_date"<?php echo $Inventory_Report_1_summary->pullout_date->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $Inventory_Report_1_summary->pos_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->current_location->Visible) { ?>
		<td data-field="current_location"<?php echo $Inventory_Report_1_summary->current_location->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->last_name->Visible) { ?>
		<td data-field="last_name"<?php echo $Inventory_Report_1_summary->last_name->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->first_name->Visible) { ?>
		<td data-field="first_name"<?php echo $Inventory_Report_1_summary->first_name->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->mid_name->Visible) { ?>
		<td data-field="mid_name"<?php echo $Inventory_Report_1_summary->mid_name->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->ext_name->Visible) { ?>
		<td data-field="ext_name"<?php echo $Inventory_Report_1_summary->ext_name->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name->Visible) { ?>
		<td data-field="full_name"<?php echo $Inventory_Report_1_summary->full_name->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Inventory_Report_1_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $Inventory_Report_1_summary->full_name_tbl->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Inventory_Report_1_summary->TotalGroups > 0) { ?>
<?php if (!$Inventory_Report_1_summary->isExport() && !($Inventory_Report_1_summary->DrillDown && $Inventory_Report_1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Inventory_Report_1_summary->Pager->render() ?>
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
<?php if ($Inventory_Report_1_summary->isExport() || $Inventory_Report_1_summary->UseCustomTemplate) { ?>
<div id="tpd_Inventory_Report_1summary"></div>
<script id="tpm_Inventory_Report_1summary" type="text/html">
<div id="ct_Inventory_Report_1_summary"><p><?php echo date("F j, Y"); ?><p>
<center><font size="4">Department of Social Welfare and Development</center>
<center><font size="4">Field Office VI</center>
<center><font size="4">Pantawid Pamilyang Pilipino Program</center>
<center><b><font size="4">Inventory Report</font></b></center>
<br>
<table cellspacing="0" cellpadding="0" width="100%" height="63px" border= "1px" >
	<tr>
	<th width="10%"><font size="4"><p align="center">YearP.</p></th>
	<th width="10%"><font size="4"><p align="center">Type</p></th> 
	<th width="10%"><font size="4"><p align="center">Model no.</p></th>
	<th width="10%"><font size="4"><p align="center">Serial no.</p></th>
	<th width="10%"><font size="4"><p align="center">Office</p></th>
	<th width="10%"><font size="4"><p align="center">C/O to.</p></th>
	<th width="10%"><font size="4"><p align="center">Position</p></th>
	<th width="10%"><font size="4"><p align="center">Status</p></th>
	</tr>
<?php
$cnt = $Page->GroupCount - 1;
for ($i = 1; $i <= $cnt; $i++) {
?>

<?php
for ($j = 1; $j <= $Page->getGroupCount($i); $j++) {
?>
<tr>
  	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Inventory_Report_1_year_dsc")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_Inventory_Report_1_cat_desc")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Inventory_Report_1_item_model")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Inventory_Report_1_item_serial")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Inventory_Report_1_off_desc")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Inventory_Report_1_full_name_tbl")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Inventory_Report_1_pos_desc")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_Inventory_Report_1_inventory_status_dsc")/}}</p></td>
</tr>
<?php
}
?>
 <tr>
 			<td colspan="7"><div style="text-align: right;"><font size="4"><b>TOTAL COUNT</b></div> 
 			<td><div style="text-align: center;"><b><font size="5">{{include tmpl=~getTemplate("#tpgc<?php echo $i ?>_Inventory_Report_1_inventory_id")/}}</b></div>
 </tr>
<?php
if ($Page->ExportPageBreakCount > 0 && $Page->isExport()) {
if ($i % $Page->ExportPageBreakCount == 0 && $i < $cnt) {
?>
{{include tmpl=~getTemplate("#tpb<?php echo $i ?>_Inventory_Report_1")/}}
<?php
}
}
}
?>
 	
 <td colspan="8"><div style="text-align: center;"><b><font size="4">Total of ICT Equipments&nbsp;&nbsp;&nbsp;{{include tmpl=~getTemplate("#tptc_Inventory_Report_1_inventory_id")/}}</font></b></div>
 </tr>
<div style="margin-left:0px">
		<table width="100%" cellpadding="0" border="0" border-collapse="0">
	<tr>
			  <td width="20%" align="left"><font size="3"><p>Inventory by:</p></br>
			  	 	<font size="4"><p align="left"><b><u>{{:Name_dsc.toUpperCase()}}</u></b></br>
			  	    <font size="4">Pantawid Staff</p></td>
			  <td width="40%" align="left"><font size="4"><p>Noted by:</p></br>
			  	 	<p align="left"><b><u>_____________________</u></b></br>
	</tr>
	   </table>
</div>
</div>
</script>

<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Inventory_Report_1_summary->isExport() || $Inventory_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Inventory_Report_1_summary->isExport() || $Inventory_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Inventory_Report_1_summary->isExport() || $Inventory_Report_1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($Inventory_Report_1->Rows) ?> };
	ew.applyTemplate("tpd_Inventory_Report_1summary", "tpm_Inventory_Report_1summary", "Inventory_Report_1summary", "<?php echo $Inventory_Report_1->CustomExport ?>", ew.templateData.rows[0]);
	$("script.Inventory_Report_1summary_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$Inventory_Report_1_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Inventory_Report_1_summary->isExport() && !$Inventory_Report_1_summary->DrillDown && !$DashboardReport) { ?>
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
$Inventory_Report_1_summary->terminate();
?>