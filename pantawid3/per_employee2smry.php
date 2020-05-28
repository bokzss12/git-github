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
$per_employee2_summary = new per_employee2_summary();

// Run the page
$per_employee2_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$per_employee2_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$per_employee2_summary->isExport() && !$per_employee2_summary->DrillDown && !$DashboardReport) { ?>
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
	fsummary.lists["x_name_accountable"] = <?php echo $per_employee2_summary->name_accountable->Lookup->toClientList($per_employee2_summary) ?>;
	fsummary.lists["x_name_accountable"].options = <?php echo JsonEncode($per_employee2_summary->name_accountable->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $per_employee2_summary->getFilterList() ?>;
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
<?php if ((!$per_employee2_summary->isExport() || $per_employee2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($per_employee2_summary->ShowCurrentFilter) { ?>
<?php $per_employee2_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$per_employee2_summary->DrillDownInPanel) {
	$per_employee2_summary->ExportOptions->render("body");
	$per_employee2_summary->SearchOptions->render("body");
	$per_employee2_summary->FilterOptions->render("body");
}
?>
</div>
<?php $per_employee2_summary->showPageHeader(); ?>
<?php
$per_employee2_summary->showMessage();
?>
<?php if ((!$per_employee2_summary->isExport() || $per_employee2_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$per_employee2_summary->isExport() || $per_employee2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $per_employee2_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$per_employee2_summary->isExport() && !$per_employee2_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$per_employee2_summary->isExport() && !$per_employee2->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $per_employee2_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="per_employee2">
	<div class="ew-extended-search">
<?php

// Render search row
$per_employee2->RowType = ROWTYPE_SEARCH;
$per_employee2->resetAttributes();
$per_employee2_summary->renderRow();
?>
<?php if ($per_employee2_summary->name_accountable->Visible) { // name_accountable ?>
	<?php
		$per_employee2_summary->SearchColumnCount++;
		if (($per_employee2_summary->SearchColumnCount - 1) % $per_employee2_summary->SearchFieldsPerRow == 0) {
			$per_employee2_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $per_employee2_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_name_accountable" class="ew-cell form-group">
		<label for="x_name_accountable" class="ew-search-caption ew-label"><?php echo $per_employee2_summary->name_accountable->caption() ?></label>
		<span id="el_per_employee2_name_accountable" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="per_employee2" data-field="x_name_accountable" data-value-separator="<?php echo $per_employee2_summary->name_accountable->displayValueSeparatorAttribute() ?>" id="x_name_accountable" name="x_name_accountable"<?php echo $per_employee2_summary->name_accountable->editAttributes() ?>>
			<?php echo $per_employee2_summary->name_accountable->selectOptionListHtml("x_name_accountable") ?>
		</select>
</div>
<?php echo $per_employee2_summary->name_accountable->Lookup->getParamTag($per_employee2_summary, "p_x_name_accountable") ?>
</span>
	</div>
	<?php if ($per_employee2_summary->SearchColumnCount % $per_employee2_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($per_employee2_summary->SearchColumnCount % $per_employee2_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $per_employee2_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($per_employee2_summary->GroupCount <= count($per_employee2_summary->GroupRecords) && $per_employee2_summary->GroupCount <= $per_employee2_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($per_employee2_summary->ShowHeader) {
?>
<?php if ($per_employee2_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($per_employee2_summary->TotalGroups > 0) { ?>
<?php if (!$per_employee2_summary->isExport() && !($per_employee2_summary->DrillDown && $per_employee2_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $per_employee2_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<script id="tpb<?php echo $per_employee2_summary->GroupCount - 1 ?>_per_employee2" type="text/html"><?php echo $per_employee2_summary->PageBreakContent ?></script>
<?php } ?>
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
<div class="<?php if (!$per_employee2_summary->isExport("word") && !$per_employee2_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $per_employee2_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$per_employee2_summary->isExport() && !($per_employee2_summary->DrillDown && $per_employee2_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $per_employee2_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_per_employee2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $per_employee2_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($per_employee2_summary->cat_desc->Visible) { ?>
	<?php if ($per_employee2_summary->cat_desc->ShowGroupHeaderAsRow) { ?>
	<th data-name="cat_desc">&nbsp;</th>
	<?php } else { ?>
		<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->cat_desc) == "") { ?>
	<th data-name="cat_desc" class="<?php echo $per_employee2_summary->cat_desc->headerCellClass() ?>"><script id="tpc_per_employee2_cat_desc" type="text/html"><div class="per_employee2_cat_desc"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->cat_desc->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="cat_desc" class="<?php echo $per_employee2_summary->cat_desc->headerCellClass() ?>"><script id="tpc_per_employee2_cat_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->cat_desc) ?>', 1);"><div class="per_employee2_cat_desc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->cat_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->inventory_id->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->inventory_id) == "") { ?>
	<th data-name="inventory_id" class="<?php echo $per_employee2_summary->inventory_id->headerCellClass() ?>" style="white-space: nowrap;"><script id="tpc_per_employee2_inventory_id" type="text/html"><div class="per_employee2_inventory_id"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->inventory_id->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="inventory_id" class="<?php echo $per_employee2_summary->inventory_id->headerCellClass() ?>" style="white-space: nowrap;"><script id="tpc_per_employee2_inventory_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->inventory_id) ?>', 1);"><div class="per_employee2_inventory_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->inventory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->item_model->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->item_model) == "") { ?>
	<th data-name="item_model" class="<?php echo $per_employee2_summary->item_model->headerCellClass() ?>"><script id="tpc_per_employee2_item_model" type="text/html"><div class="per_employee2_item_model"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->item_model->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="item_model" class="<?php echo $per_employee2_summary->item_model->headerCellClass() ?>"><script id="tpc_per_employee2_item_model" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->item_model) ?>', 1);"><div class="per_employee2_item_model">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->item_model->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->item_serial->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->item_serial) == "") { ?>
	<th data-name="item_serial" class="<?php echo $per_employee2_summary->item_serial->headerCellClass() ?>"><script id="tpc_per_employee2_item_serial" type="text/html"><div class="per_employee2_item_serial"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->item_serial->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="item_serial" class="<?php echo $per_employee2_summary->item_serial->headerCellClass() ?>"><script id="tpc_per_employee2_item_serial" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->item_serial) ?>', 1);"><div class="per_employee2_item_serial">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->item_serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->off_desc->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->off_desc) == "") { ?>
	<th data-name="off_desc" class="<?php echo $per_employee2_summary->off_desc->headerCellClass() ?>"><script id="tpc_per_employee2_off_desc" type="text/html"><div class="per_employee2_off_desc"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->off_desc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="off_desc" class="<?php echo $per_employee2_summary->off_desc->headerCellClass() ?>"><script id="tpc_per_employee2_off_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->off_desc) ?>', 1);"><div class="per_employee2_off_desc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->off_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->pos_desc->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->pos_desc) == "") { ?>
	<th data-name="pos_desc" class="<?php echo $per_employee2_summary->pos_desc->headerCellClass() ?>"><script id="tpc_per_employee2_pos_desc" type="text/html"><div class="per_employee2_pos_desc"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->pos_desc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="pos_desc" class="<?php echo $per_employee2_summary->pos_desc->headerCellClass() ?>"><script id="tpc_per_employee2_pos_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->pos_desc) ?>', 1);"><div class="per_employee2_pos_desc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->pos_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->pos_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->pos_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->Last_Date_Check->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->Last_Date_Check) == "") { ?>
	<th data-name="Last_Date_Check" class="<?php echo $per_employee2_summary->Last_Date_Check->headerCellClass() ?>"><script id="tpc_per_employee2_Last_Date_Check" type="text/html"><div class="per_employee2_Last_Date_Check"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->Last_Date_Check->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Last_Date_Check" class="<?php echo $per_employee2_summary->Last_Date_Check->headerCellClass() ?>"><script id="tpc_per_employee2_Last_Date_Check" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->Last_Date_Check) ?>', 1);"><div class="per_employee2_Last_Date_Check">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->Last_Date_Check->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->Last_Date_Check->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->Last_Date_Check->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->Name_dsc->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->Name_dsc) == "") { ?>
	<th data-name="Name_dsc" class="<?php echo $per_employee2_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_per_employee2_Name_dsc" type="text/html"><div class="per_employee2_Name_dsc"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->Name_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Name_dsc" class="<?php echo $per_employee2_summary->Name_dsc->headerCellClass() ?>"><script id="tpc_per_employee2_Name_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->Name_dsc) ?>', 1);"><div class="per_employee2_Name_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->Name_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->inventory_status_dsc->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->inventory_status_dsc) == "") { ?>
	<th data-name="inventory_status_dsc" class="<?php echo $per_employee2_summary->inventory_status_dsc->headerCellClass() ?>"><script id="tpc_per_employee2_inventory_status_dsc" type="text/html"><div class="per_employee2_inventory_status_dsc"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->inventory_status_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="inventory_status_dsc" class="<?php echo $per_employee2_summary->inventory_status_dsc->headerCellClass() ?>"><script id="tpc_per_employee2_inventory_status_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->inventory_status_dsc) ?>', 1);"><div class="per_employee2_inventory_status_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->inventory_status_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->inventory_status_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->inventory_status_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->year_dsc->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->year_dsc) == "") { ?>
	<th data-name="year_dsc" class="<?php echo $per_employee2_summary->year_dsc->headerCellClass() ?>"><script id="tpc_per_employee2_year_dsc" type="text/html"><div class="per_employee2_year_dsc"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->year_dsc->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="year_dsc" class="<?php echo $per_employee2_summary->year_dsc->headerCellClass() ?>"><script id="tpc_per_employee2_year_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->year_dsc) ?>', 1);"><div class="per_employee2_year_dsc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->year_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->year_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->year_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->name_accountable->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->name_accountable) == "") { ?>
	<th data-name="name_accountable" class="<?php echo $per_employee2_summary->name_accountable->headerCellClass() ?>"><script id="tpc_per_employee2_name_accountable" type="text/html"><div class="per_employee2_name_accountable"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->name_accountable->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="name_accountable" class="<?php echo $per_employee2_summary->name_accountable->headerCellClass() ?>"><script id="tpc_per_employee2_name_accountable" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->name_accountable) ?>', 1);"><div class="per_employee2_name_accountable">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->name_accountable->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->name_accountable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->name_accountable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->namefull->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->namefull) == "") { ?>
	<th data-name="namefull" class="<?php echo $per_employee2_summary->namefull->headerCellClass() ?>"><script id="tpc_per_employee2_namefull" type="text/html"><div class="per_employee2_namefull"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->namefull->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="namefull" class="<?php echo $per_employee2_summary->namefull->headerCellClass() ?>"><script id="tpc_per_employee2_namefull" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->namefull) ?>', 1);"><div class="per_employee2_namefull">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->namefull->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->namefull->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->namefull->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->status->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->status) == "") { ?>
	<th data-name="status" class="<?php echo $per_employee2_summary->status->headerCellClass() ?>"><script id="tpc_per_employee2_status" type="text/html"><div class="per_employee2_status"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->status->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="status" class="<?php echo $per_employee2_summary->status->headerCellClass() ?>"><script id="tpc_per_employee2_status" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->status) ?>', 1);"><div class="per_employee2_status">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->full_name_tbl->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->full_name_tbl) == "") { ?>
	<th data-name="full_name_tbl" class="<?php echo $per_employee2_summary->full_name_tbl->headerCellClass() ?>"><script id="tpc_per_employee2_full_name_tbl" type="text/html"><div class="per_employee2_full_name_tbl"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->full_name_tbl->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="full_name_tbl" class="<?php echo $per_employee2_summary->full_name_tbl->headerCellClass() ?>"><script id="tpc_per_employee2_full_name_tbl" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->full_name_tbl) ?>', 1);"><div class="per_employee2_full_name_tbl">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->full_name_tbl->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->full_name_tbl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->full_name_tbl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->position->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->position) == "") { ?>
	<th data-name="position" class="<?php echo $per_employee2_summary->position->headerCellClass() ?>"><script id="tpc_per_employee2_position" type="text/html"><div class="per_employee2_position"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->position->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="position" class="<?php echo $per_employee2_summary->position->headerCellClass() ?>"><script id="tpc_per_employee2_position" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->position) ?>', 1);"><div class="per_employee2_position">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->position->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->NameSig->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->NameSig) == "") { ?>
	<th data-name="NameSig" class="<?php echo $per_employee2_summary->NameSig->headerCellClass() ?>"><script id="tpc_per_employee2_NameSig" type="text/html"><div class="per_employee2_NameSig"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->NameSig->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="NameSig" class="<?php echo $per_employee2_summary->NameSig->headerCellClass() ?>"><script id="tpc_per_employee2_NameSig" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->NameSig) ?>', 1);"><div class="per_employee2_NameSig">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->NameSig->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->NameSig->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->NameSig->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->DesignationSig->Visible) { ?>
	<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->DesignationSig) == "") { ?>
	<th data-name="DesignationSig" class="<?php echo $per_employee2_summary->DesignationSig->headerCellClass() ?>"><script id="tpc_per_employee2_DesignationSig" type="text/html"><div class="per_employee2_DesignationSig"><div class="ew-table-header-caption"><?php echo $per_employee2_summary->DesignationSig->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="DesignationSig" class="<?php echo $per_employee2_summary->DesignationSig->headerCellClass() ?>"><script id="tpc_per_employee2_DesignationSig" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->DesignationSig) ?>', 1);"><div class="per_employee2_DesignationSig">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->DesignationSig->caption() ?></span><span class="ew-table-header-sort"><?php if ($per_employee2_summary->DesignationSig->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->DesignationSig->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($per_employee2_summary->TotalGroups == 0)
			break; // Show header only
		$per_employee2_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($per_employee2_summary->cat_desc, $per_employee2_summary->getSqlFirstGroupField(), $per_employee2_summary->cat_desc->groupValue(), $per_employee2_summary->Dbid);
	if ($per_employee2_summary->PageFirstGroupFilter != "") $per_employee2_summary->PageFirstGroupFilter .= " OR ";
	$per_employee2_summary->PageFirstGroupFilter .= $where;
	if ($per_employee2_summary->Filter != "")
		$where = "($per_employee2_summary->Filter) AND ($where)";
	$sql = BuildReportSql($per_employee2_summary->getSqlSelect(), $per_employee2_summary->getSqlWhere(), $per_employee2_summary->getSqlGroupBy(), $per_employee2_summary->getSqlHaving(), $per_employee2_summary->getSqlOrderBy(), $where, $per_employee2_summary->Sort);
	$rs = $per_employee2_summary->getRecordset($sql);
	$per_employee2_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$per_employee2_summary->DetailRecordCount = count($per_employee2_summary->DetailRecords);
	$per_employee2_summary->setGroupCount($per_employee2_summary->DetailRecordCount, $per_employee2_summary->GroupCount);

	// Load detail records
	$per_employee2_summary->cat_desc->Records = &$per_employee2_summary->DetailRecords;
	$per_employee2_summary->cat_desc->LevelBreak = TRUE; // Set field level break
		$per_employee2_summary->GroupCounter[1] = $per_employee2_summary->GroupCount;
		$per_employee2_summary->cat_desc->getCnt($per_employee2_summary->cat_desc->Records); // Get record count
		$per_employee2_summary->setGroupCount($per_employee2_summary->cat_desc->Count, $per_employee2_summary->GroupCounter[1]);
?>
<?php if ($per_employee2_summary->cat_desc->Visible && $per_employee2_summary->cat_desc->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$per_employee2_summary->resetAttributes();
		$per_employee2_summary->RowType = ROWTYPE_TOTAL;
		$per_employee2_summary->RowTotalType = ROWTOTAL_GROUP;
		$per_employee2_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$per_employee2_summary->RowGroupLevel = 1;
		$per_employee2_summary->renderRow();
?>
	<tr<?php echo $per_employee2_summary->rowAttributes(); ?>>
<?php if ($per_employee2_summary->cat_desc->Visible) { ?>
		<td data-field="cat_desc"<?php echo $per_employee2_summary->cat_desc->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="cat_desc" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $per_employee2_summary->cat_desc->cellAttributes() ?>>
<?php if ($per_employee2_summary->sortUrl($per_employee2_summary->cat_desc) == "") { ?>
		<span class="ew-summary-caption per_employee2_cat_desc"><span class="ew-table-header-caption"><?php echo $per_employee2_summary->cat_desc->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption per_employee2_cat_desc" onclick="ew.sort(event, '<?php echo $per_employee2_summary->sortUrl($per_employee2_summary->cat_desc) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $per_employee2_summary->cat_desc->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($per_employee2_summary->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($per_employee2_summary->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_per_employee2_cat_desc" type="text/html"><span<?php echo $per_employee2_summary->cat_desc->viewAttributes() ?>><?php echo $per_employee2_summary->cat_desc->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($per_employee2_summary->cat_desc->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$per_employee2_summary->RecordCount = 0; // Reset record count
	foreach ($per_employee2_summary->cat_desc->Records as $record) {
		$per_employee2_summary->RecordCount++;
		$per_employee2_summary->RecordIndex++;
		$per_employee2_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$per_employee2_summary->resetAttributes();
		$per_employee2_summary->RowType = ROWTYPE_DETAIL;
		$per_employee2_summary->renderRow();
?>
	<tr<?php echo $per_employee2_summary->rowAttributes(); ?>>
<?php if ($per_employee2_summary->cat_desc->Visible) { ?>
	<?php if ($per_employee2_summary->cat_desc->ShowGroupHeaderAsRow) { ?>
		<td data-field="cat_desc"<?php echo $per_employee2_summary->cat_desc->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="cat_desc"<?php echo $per_employee2_summary->cat_desc->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_per_employee2_cat_desc" type="text/html"><span<?php echo $per_employee2_summary->cat_desc->viewAttributes() ?>><?php echo $per_employee2_summary->cat_desc->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($per_employee2_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $per_employee2_summary->inventory_id->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_inventory_id" type="text/html">
<span<?php echo $per_employee2_summary->inventory_id->viewAttributes() ?>><?php echo $per_employee2_summary->inventory_id->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $per_employee2_summary->item_model->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_item_model" type="text/html">
<span<?php echo $per_employee2_summary->item_model->viewAttributes() ?>><?php echo $per_employee2_summary->item_model->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $per_employee2_summary->item_serial->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_item_serial" type="text/html">
<span<?php echo $per_employee2_summary->item_serial->viewAttributes() ?>><?php echo $per_employee2_summary->item_serial->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $per_employee2_summary->off_desc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_off_desc" type="text/html">
<span<?php echo $per_employee2_summary->off_desc->viewAttributes() ?>><?php echo $per_employee2_summary->off_desc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $per_employee2_summary->pos_desc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_pos_desc" type="text/html">
<span<?php echo $per_employee2_summary->pos_desc->viewAttributes() ?>><?php echo $per_employee2_summary->pos_desc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $per_employee2_summary->Last_Date_Check->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_Last_Date_Check" type="text/html">
<span<?php echo $per_employee2_summary->Last_Date_Check->viewAttributes() ?>><?php echo $per_employee2_summary->Last_Date_Check->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $per_employee2_summary->Name_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_Name_dsc" type="text/html">
<span<?php echo $per_employee2_summary->Name_dsc->viewAttributes() ?>><?php echo $per_employee2_summary->Name_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $per_employee2_summary->inventory_status_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_inventory_status_dsc" type="text/html">
<span<?php echo $per_employee2_summary->inventory_status_dsc->viewAttributes() ?>><?php echo $per_employee2_summary->inventory_status_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $per_employee2_summary->year_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_year_dsc" type="text/html">
<span<?php echo $per_employee2_summary->year_dsc->viewAttributes() ?>><?php echo $per_employee2_summary->year_dsc->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->name_accountable->Visible) { ?>
		<td data-field="name_accountable"<?php echo $per_employee2_summary->name_accountable->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_name_accountable" type="text/html">
<span<?php echo $per_employee2_summary->name_accountable->viewAttributes() ?>><?php echo $per_employee2_summary->name_accountable->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->namefull->Visible) { ?>
		<td data-field="namefull"<?php echo $per_employee2_summary->namefull->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_namefull" type="text/html">
<span<?php echo $per_employee2_summary->namefull->viewAttributes() ?>><?php echo $per_employee2_summary->namefull->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->status->Visible) { ?>
		<td data-field="status"<?php echo $per_employee2_summary->status->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_status" type="text/html">
<span<?php echo $per_employee2_summary->status->viewAttributes() ?>><?php echo $per_employee2_summary->status->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $per_employee2_summary->full_name_tbl->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_full_name_tbl" type="text/html">
<span<?php echo $per_employee2_summary->full_name_tbl->viewAttributes() ?>><?php echo $per_employee2_summary->full_name_tbl->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->position->Visible) { ?>
		<td data-field="position"<?php echo $per_employee2_summary->position->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_position" type="text/html">
<span<?php echo $per_employee2_summary->position->viewAttributes() ?>><?php echo $per_employee2_summary->position->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->NameSig->Visible) { ?>
		<td data-field="NameSig"<?php echo $per_employee2_summary->NameSig->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_NameSig" type="text/html">
<span<?php echo $per_employee2_summary->NameSig->viewAttributes() ?>><?php echo $per_employee2_summary->NameSig->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->DesignationSig->Visible) { ?>
		<td data-field="DesignationSig"<?php echo $per_employee2_summary->DesignationSig->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->RecordCount ?>_per_employee2_DesignationSig" type="text/html">
<span<?php echo $per_employee2_summary->DesignationSig->viewAttributes() ?>><?php echo $per_employee2_summary->DesignationSig->getViewValue() ?></span>
</script>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php

	// Next group
	$per_employee2_summary->loadGroupRowValues();

	// Show header if page break
	if ($per_employee2_summary->isExport())
		$per_employee2_summary->ShowHeader = ($per_employee2_summary->ExportPageBreakCount == 0) ? FALSE : ($per_employee2_summary->GroupCount % $per_employee2_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($per_employee2_summary->ShowHeader)
		$per_employee2_summary->Page_Breaking($per_employee2_summary->ShowHeader, $per_employee2_summary->PageBreakContent);
	$per_employee2_summary->GroupCount++;
} // End while
?>
<?php if ($per_employee2_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$per_employee2_summary->resetAttributes();
	$per_employee2_summary->RowType = ROWTYPE_TOTAL;
	$per_employee2_summary->RowTotalType = ROWTOTAL_GRAND;
	$per_employee2_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$per_employee2_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$per_employee2_summary->renderRow();
?>
<?php if ($per_employee2_summary->cat_desc->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $per_employee2_summary->rowAttributes() ?>><td colspan="<?php echo ($per_employee2_summary->GroupColumnCount + $per_employee2_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($per_employee2_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $per_employee2_summary->rowAttributes() ?>>
<?php if ($per_employee2_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $per_employee2_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $per_employee2_summary->inventory_id->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tptc_per_employee2_inventory_id" type="text/html"><span<?php echo $per_employee2_summary->inventory_id->viewAttributes() ?>><?php echo $per_employee2_summary->inventory_id->CntViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($per_employee2_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $per_employee2_summary->item_model->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $per_employee2_summary->item_serial->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $per_employee2_summary->off_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $per_employee2_summary->pos_desc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $per_employee2_summary->Last_Date_Check->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $per_employee2_summary->Name_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $per_employee2_summary->inventory_status_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $per_employee2_summary->year_dsc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->name_accountable->Visible) { ?>
		<td data-field="name_accountable"<?php echo $per_employee2_summary->name_accountable->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->namefull->Visible) { ?>
		<td data-field="namefull"<?php echo $per_employee2_summary->namefull->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->status->Visible) { ?>
		<td data-field="status"<?php echo $per_employee2_summary->status->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $per_employee2_summary->full_name_tbl->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->position->Visible) { ?>
		<td data-field="position"<?php echo $per_employee2_summary->position->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->NameSig->Visible) { ?>
		<td data-field="NameSig"<?php echo $per_employee2_summary->NameSig->cellAttributes() ?>></td>
<?php } ?>
<?php if ($per_employee2_summary->DesignationSig->Visible) { ?>
		<td data-field="DesignationSig"<?php echo $per_employee2_summary->DesignationSig->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $per_employee2_summary->rowAttributes() ?>><td colspan="<?php echo ($per_employee2_summary->GroupColumnCount + $per_employee2_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($per_employee2_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $per_employee2_summary->rowAttributes() ?>>
<?php if ($per_employee2_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $per_employee2_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptCnt") ?></td>
<?php } ?>
<?php if ($per_employee2_summary->inventory_id->Visible) { ?>
		<td data-field="inventory_id"<?php echo $per_employee2_summary->inventory_id->cellAttributes() ?>>
<script id="tptc_per_employee2_inventory_id" type="text/html">
<span<?php echo $per_employee2_summary->inventory_id->viewAttributes() ?>><?php echo $per_employee2_summary->inventory_id->CntViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($per_employee2_summary->item_model->Visible) { ?>
		<td data-field="item_model"<?php echo $per_employee2_summary->item_model->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->item_serial->Visible) { ?>
		<td data-field="item_serial"<?php echo $per_employee2_summary->item_serial->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->off_desc->Visible) { ?>
		<td data-field="off_desc"<?php echo $per_employee2_summary->off_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->pos_desc->Visible) { ?>
		<td data-field="pos_desc"<?php echo $per_employee2_summary->pos_desc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->Last_Date_Check->Visible) { ?>
		<td data-field="Last_Date_Check"<?php echo $per_employee2_summary->Last_Date_Check->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->Name_dsc->Visible) { ?>
		<td data-field="Name_dsc"<?php echo $per_employee2_summary->Name_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->inventory_status_dsc->Visible) { ?>
		<td data-field="inventory_status_dsc"<?php echo $per_employee2_summary->inventory_status_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->year_dsc->Visible) { ?>
		<td data-field="year_dsc"<?php echo $per_employee2_summary->year_dsc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->name_accountable->Visible) { ?>
		<td data-field="name_accountable"<?php echo $per_employee2_summary->name_accountable->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->namefull->Visible) { ?>
		<td data-field="namefull"<?php echo $per_employee2_summary->namefull->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->status->Visible) { ?>
		<td data-field="status"<?php echo $per_employee2_summary->status->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->full_name_tbl->Visible) { ?>
		<td data-field="full_name_tbl"<?php echo $per_employee2_summary->full_name_tbl->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->position->Visible) { ?>
		<td data-field="position"<?php echo $per_employee2_summary->position->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->NameSig->Visible) { ?>
		<td data-field="NameSig"<?php echo $per_employee2_summary->NameSig->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($per_employee2_summary->DesignationSig->Visible) { ?>
		<td data-field="DesignationSig"<?php echo $per_employee2_summary->DesignationSig->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($per_employee2_summary->TotalGroups > 0) { ?>
<?php if (!$per_employee2_summary->isExport() && !($per_employee2_summary->DrillDown && $per_employee2_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $per_employee2_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$per_employee2_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<?php if ($per_employee2_summary->isExport() || $per_employee2_summary->UseCustomTemplate) { ?>
<div id="tpd_per_employee2summary"></div>
<script id="tpm_per_employee2summary" type="text/html">
<div id="ct_per_employee2_summary"><p><?php echo date("F j, Y"); ?><p>
<center><font size="4">Department of Social Welfare and Development</center>
<center><font size="4">Field Office VI</center>
<center><font size="4">Pantawid Pamilyang Pilipino Program</center>
<center><b><font size="4">Inventory Report</font></b></center>
<br>
<table cellspacing="0" cellpadding="0" width="1056px" height="100%" border= "1px" >
	<tr>
	<th width="6%"><font size="4"><p align="center">YearP.</p></th>
	<th width="10%"><font size="4"><p align="center">Type</p></th> 
	<th width="10%"><font size="4"><p align="center">Model no.</p></th>
	<th width="15%"><font size="4"><p align="center">Serial no.</p></th>
	<th width="8%"><font size="4"><p align="center">Status</p></th>
	</tr>
<?php
$cnt = $Page->GroupCount - 1;
for ($i = 1; $i <= $cnt; $i++) {
?>

<?php
for ($j = 1; $j <= $Page->getGroupCount($i); $j++) {
?>
<tr>
  	<td width="6%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_per_employee2_year_dsc")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_per_employee2_cat_desc")/}}</p></td>
	<td width="10%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_per_employee2_item_model")/}}</p></td>
	<td width="15%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_per_employee2_item_serial")/}}</p></td>
	<td width="8%"><font size="4"><p align="center">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $j ?>_per_employee2_inventory_status_dsc")/}}</p></td>
</tr>
<?php
}
?>

<?php
if ($Page->ExportPageBreakCount > 0 && $Page->isExport()) {
if ($i % $Page->ExportPageBreakCount == 0 && $i < $cnt) {
?>
{{include tmpl=~getTemplate("#tpb<?php echo $i ?>_per_employee2")/}}
<?php
}
}
}
?>
<table style="height: 100px; width: 1056px; float: left;">
<tbody>
<tr style="height: 12px;">
<td style="width: 1789px; height: 12px; text-align: right;" colspan="5"><strong><span style="font-size: large;">No. of items</span></strong></td>
<td style="width: 87px; height: 12px; text-align: right;"><strong>{{include tmpl=~getTemplate("#tptc_per_employee2_inventory_id")/}}</strong></td>
</tr>
<tr style="height: 12px;">
<td style="width: 497px; height: 12px;"><span style="font-size: large;">Prepared by:</span></td>
<td style="width: 22px; height: 12px;">&nbsp;</td>
<td style="width: 718px; height: 12px;"><span style="font-size: large;">Noted</span></td>
<td style="width: 67.4334px; height: 12px;">&nbsp;</td>
<td style="width: 484.567px; height: 12px;"><span style="font-size: large;">Received by:</span></td>
<td style="width: 87px; height: 12px;">&nbsp;</td>
</tr>
<tr style="height: 101px;">
<td style="width: 497px; height: 101px; text-align: left; vertical-align: bottom;"><strong><span style="text-decoration: underline;"><span style="font-size: large;">{{:NameSig.toUpperCase()}}</span></span></strong></td>
<td style="width: 22px; height: 101px; text-align: left; vertical-align: bottom;">&nbsp;</td>
<td style="width: 718px; height: 101px; text-align: left; vertical-align: bottom;"><hr /></td>
<td style="width: 67.4334px; height: 101px; text-align: left; vertical-align: bottom;">&nbsp;</td>
<td style="width: 571.567px; height: 101px; text-align: left; vertical-align: bottom;" colspan="2">
<p><strong><span style="text-decoration: underline;"><span style="font-size: large;">{{:full_name_tbl.toUpperCase()}}</span></span></strong></p>
</td>
</tr>
<tr style="height: 15px;">
<td style="width: 497px; height: 15px; text-align: left; vertical-align: top;">&nbsp;<span style="font-size: large;">{{:DesignationSig}}</span></td>
<td style="width: 22px; height: 15px; text-align: left; vertical-align: top;">&nbsp;</td>
<td style="width: 718px; height: 15px; text-align: left; vertical-align: top;">&nbsp;</td>
<td style="width: 67.4334px; height: 15px; text-align: left; vertical-align: top;">&nbsp;</td>
<td style="width: 571.567px; height: 15px; text-align: left; vertical-align: top;" colspan="2">
<p>{{:pos_desc}}</p>
&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$per_employee2_summary->isExport() || $per_employee2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$per_employee2_summary->isExport() || $per_employee2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$per_employee2_summary->isExport() || $per_employee2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($per_employee2->Rows) ?> };
	ew.applyTemplate("tpd_per_employee2summary", "tpm_per_employee2summary", "per_employee2summary", "<?php echo $per_employee2->CustomExport ?>", ew.templateData.rows[0]);
	$("script.per_employee2summary_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$per_employee2_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$per_employee2_summary->isExport() && !$per_employee2_summary->DrillDown && !$DashboardReport) { ?>
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
$per_employee2_summary->terminate();
?>