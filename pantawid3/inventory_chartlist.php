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
$inventory_chart_list = new inventory_chart_list();

// Run the page
$inventory_chart_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventory_chart_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$inventory_chart_list->isExport()) { ?>
<script>
var finventory_chartlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	finventory_chartlist = currentForm = new ew.Form("finventory_chartlist", "list");
	finventory_chartlist.formKeyCountName = '<?php echo $inventory_chart_list->FormKeyCountName ?>';
	loadjs.done("finventory_chartlist");
});
var finventory_chartlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	finventory_chartlistsrch = currentSearchForm = new ew.Form("finventory_chartlistsrch");

	// Dynamic selection lists
	// Filters

	finventory_chartlistsrch.filterList = <?php echo $inventory_chart_list->getFilterList() ?>;
	loadjs.done("finventory_chartlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$inventory_chart_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inventory_chart_list->TotalRecords > 0 && $inventory_chart_list->ExportOptions->visible()) { ?>
<?php $inventory_chart_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_chart_list->ImportOptions->visible()) { ?>
<?php $inventory_chart_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_chart_list->SearchOptions->visible()) { ?>
<?php $inventory_chart_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_chart_list->FilterOptions->visible()) { ?>
<?php $inventory_chart_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inventory_chart_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$inventory_chart_list->isExport() && !$inventory_chart->CurrentAction) { ?>
<form name="finventory_chartlistsrch" id="finventory_chartlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="finventory_chartlistsrch-search-panel" class="<?php echo $inventory_chart_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inventory_chart">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $inventory_chart_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($inventory_chart_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($inventory_chart_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inventory_chart_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inventory_chart_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inventory_chart_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inventory_chart_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inventory_chart_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $inventory_chart_list->showPageHeader(); ?>
<?php
$inventory_chart_list->showMessage();
?>
<?php if ($inventory_chart_list->TotalRecords > 0 || $inventory_chart->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inventory_chart_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inventory_chart">
<form name="finventory_chartlist" id="finventory_chartlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventory_chart">
<div id="gmp_inventory_chart" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($inventory_chart_list->TotalRecords > 0 || $inventory_chart_list->isGridEdit()) { ?>
<table id="tbl_inventory_chartlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inventory_chart->RowType = ROWTYPE_HEADER;

// Render list options
$inventory_chart_list->renderListOptions();

// Render list options (header, left)
$inventory_chart_list->ListOptions->render("header", "left");
?>
<?php if ($inventory_chart_list->inventory_id->Visible) { // inventory_id ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->inventory_id) == "") { ?>
		<th data-name="inventory_id" class="<?php echo $inventory_chart_list->inventory_id->headerCellClass() ?>"><div id="elh_inventory_chart_inventory_id" class="inventory_chart_inventory_id"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->inventory_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_id" class="<?php echo $inventory_chart_list->inventory_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->inventory_id) ?>', 1);"><div id="elh_inventory_chart_inventory_id" class="inventory_chart_inventory_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->inventory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->month_dsc->Visible) { // month_dsc ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->month_dsc) == "") { ?>
		<th data-name="month_dsc" class="<?php echo $inventory_chart_list->month_dsc->headerCellClass() ?>"><div id="elh_inventory_chart_month_dsc" class="inventory_chart_month_dsc"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->month_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="month_dsc" class="<?php echo $inventory_chart_list->month_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->month_dsc) ?>', 1);"><div id="elh_inventory_chart_month_dsc" class="inventory_chart_month_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->month_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->month_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->month_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->year_dsc->Visible) { // year_dsc ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->year_dsc) == "") { ?>
		<th data-name="year_dsc" class="<?php echo $inventory_chart_list->year_dsc->headerCellClass() ?>"><div id="elh_inventory_chart_year_dsc" class="inventory_chart_year_dsc"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->year_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="year_dsc" class="<?php echo $inventory_chart_list->year_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->year_dsc) ?>', 1);"><div id="elh_inventory_chart_year_dsc" class="inventory_chart_year_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->year_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->year_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->year_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->cat_desc->Visible) { // cat_desc ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->cat_desc) == "") { ?>
		<th data-name="cat_desc" class="<?php echo $inventory_chart_list->cat_desc->headerCellClass() ?>"><div id="elh_inventory_chart_cat_desc" class="inventory_chart_cat_desc"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->cat_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cat_desc" class="<?php echo $inventory_chart_list->cat_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->cat_desc) ?>', 1);"><div id="elh_inventory_chart_cat_desc" class="inventory_chart_cat_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->cat_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->item_model->Visible) { // item_model ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $inventory_chart_list->item_model->headerCellClass() ?>"><div id="elh_inventory_chart_item_model" class="inventory_chart_item_model"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->item_model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $inventory_chart_list->item_model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->item_model) ?>', 1);"><div id="elh_inventory_chart_item_model" class="inventory_chart_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->item_serial->Visible) { // item_serial ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->item_serial) == "") { ?>
		<th data-name="item_serial" class="<?php echo $inventory_chart_list->item_serial->headerCellClass() ?>"><div id="elh_inventory_chart_item_serial" class="inventory_chart_item_serial"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->item_serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_serial" class="<?php echo $inventory_chart_list->item_serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->item_serial) ?>', 1);"><div id="elh_inventory_chart_item_serial" class="inventory_chart_item_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->item_serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->off_desc->Visible) { // off_desc ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->off_desc) == "") { ?>
		<th data-name="off_desc" class="<?php echo $inventory_chart_list->off_desc->headerCellClass() ?>"><div id="elh_inventory_chart_off_desc" class="inventory_chart_off_desc"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->off_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off_desc" class="<?php echo $inventory_chart_list->off_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->off_desc) ?>', 1);"><div id="elh_inventory_chart_off_desc" class="inventory_chart_off_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->off_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->region_name->Visible) { // region_name ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->region_name) == "") { ?>
		<th data-name="region_name" class="<?php echo $inventory_chart_list->region_name->headerCellClass() ?>"><div id="elh_inventory_chart_region_name" class="inventory_chart_region_name"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->region_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_name" class="<?php echo $inventory_chart_list->region_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->region_name) ?>', 1);"><div id="elh_inventory_chart_region_name" class="inventory_chart_region_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->region_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->region_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->region_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->prov_name->Visible) { // prov_name ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->prov_name) == "") { ?>
		<th data-name="prov_name" class="<?php echo $inventory_chart_list->prov_name->headerCellClass() ?>"><div id="elh_inventory_chart_prov_name" class="inventory_chart_prov_name"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->prov_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prov_name" class="<?php echo $inventory_chart_list->prov_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->prov_name) ?>', 1);"><div id="elh_inventory_chart_prov_name" class="inventory_chart_prov_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->prov_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->prov_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->prov_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->city_name->Visible) { // city_name ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->city_name) == "") { ?>
		<th data-name="city_name" class="<?php echo $inventory_chart_list->city_name->headerCellClass() ?>"><div id="elh_inventory_chart_city_name" class="inventory_chart_city_name"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->city_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_name" class="<?php echo $inventory_chart_list->city_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->city_name) ?>', 1);"><div id="elh_inventory_chart_city_name" class="inventory_chart_city_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->city_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->city_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->city_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->name_accountable->Visible) { // name_accountable ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->name_accountable) == "") { ?>
		<th data-name="name_accountable" class="<?php echo $inventory_chart_list->name_accountable->headerCellClass() ?>"><div id="elh_inventory_chart_name_accountable" class="inventory_chart_name_accountable"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->name_accountable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name_accountable" class="<?php echo $inventory_chart_list->name_accountable->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->name_accountable) ?>', 1);"><div id="elh_inventory_chart_name_accountable" class="inventory_chart_name_accountable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->name_accountable->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->name_accountable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->name_accountable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->Designation->Visible) { // Designation ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->Designation) == "") { ?>
		<th data-name="Designation" class="<?php echo $inventory_chart_list->Designation->headerCellClass() ?>"><div id="elh_inventory_chart_Designation" class="inventory_chart_Designation"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->Designation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Designation" class="<?php echo $inventory_chart_list->Designation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->Designation) ?>', 1);"><div id="elh_inventory_chart_Designation" class="inventory_chart_Designation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->Designation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->Designation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->Designation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_chart_list->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
	<?php if ($inventory_chart_list->SortUrl($inventory_chart_list->inventory_status_dsc) == "") { ?>
		<th data-name="inventory_status_dsc" class="<?php echo $inventory_chart_list->inventory_status_dsc->headerCellClass() ?>"><div id="elh_inventory_chart_inventory_status_dsc" class="inventory_chart_inventory_status_dsc"><div class="ew-table-header-caption"><?php echo $inventory_chart_list->inventory_status_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_status_dsc" class="<?php echo $inventory_chart_list->inventory_status_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_chart_list->SortUrl($inventory_chart_list->inventory_status_dsc) ?>', 1);"><div id="elh_inventory_chart_inventory_status_dsc" class="inventory_chart_inventory_status_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_chart_list->inventory_status_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_chart_list->inventory_status_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_chart_list->inventory_status_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inventory_chart_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inventory_chart_list->ExportAll && $inventory_chart_list->isExport()) {
	$inventory_chart_list->StopRecord = $inventory_chart_list->TotalRecords;
} else {

	// Set the last record to display
	if ($inventory_chart_list->TotalRecords > $inventory_chart_list->StartRecord + $inventory_chart_list->DisplayRecords - 1)
		$inventory_chart_list->StopRecord = $inventory_chart_list->StartRecord + $inventory_chart_list->DisplayRecords - 1;
	else
		$inventory_chart_list->StopRecord = $inventory_chart_list->TotalRecords;
}
$inventory_chart_list->RecordCount = $inventory_chart_list->StartRecord - 1;
if ($inventory_chart_list->Recordset && !$inventory_chart_list->Recordset->EOF) {
	$inventory_chart_list->Recordset->moveFirst();
	$selectLimit = $inventory_chart_list->UseSelectLimit;
	if (!$selectLimit && $inventory_chart_list->StartRecord > 1)
		$inventory_chart_list->Recordset->move($inventory_chart_list->StartRecord - 1);
} elseif (!$inventory_chart->AllowAddDeleteRow && $inventory_chart_list->StopRecord == 0) {
	$inventory_chart_list->StopRecord = $inventory_chart->GridAddRowCount;
}

// Initialize aggregate
$inventory_chart->RowType = ROWTYPE_AGGREGATEINIT;
$inventory_chart->resetAttributes();
$inventory_chart_list->renderRow();
while ($inventory_chart_list->RecordCount < $inventory_chart_list->StopRecord) {
	$inventory_chart_list->RecordCount++;
	if ($inventory_chart_list->RecordCount >= $inventory_chart_list->StartRecord) {
		$inventory_chart_list->RowCount++;

		// Set up key count
		$inventory_chart_list->KeyCount = $inventory_chart_list->RowIndex;

		// Init row class and style
		$inventory_chart->resetAttributes();
		$inventory_chart->CssClass = "";
		if ($inventory_chart_list->isGridAdd()) {
		} else {
			$inventory_chart_list->loadRowValues($inventory_chart_list->Recordset); // Load row values
		}
		$inventory_chart->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inventory_chart->RowAttrs->merge(["data-rowindex" => $inventory_chart_list->RowCount, "id" => "r" . $inventory_chart_list->RowCount . "_inventory_chart", "data-rowtype" => $inventory_chart->RowType]);

		// Render row
		$inventory_chart_list->renderRow();

		// Render list options
		$inventory_chart_list->renderListOptions();
?>
	<tr <?php echo $inventory_chart->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inventory_chart_list->ListOptions->render("body", "left", $inventory_chart_list->RowCount);
?>
	<?php if ($inventory_chart_list->inventory_id->Visible) { // inventory_id ?>
		<td data-name="inventory_id" <?php echo $inventory_chart_list->inventory_id->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_inventory_id">
<span<?php echo $inventory_chart_list->inventory_id->viewAttributes() ?>><?php echo $inventory_chart_list->inventory_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" <?php echo $inventory_chart_list->month_dsc->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_month_dsc">
<span<?php echo $inventory_chart_list->month_dsc->viewAttributes() ?>><?php echo $inventory_chart_list->month_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->year_dsc->Visible) { // year_dsc ?>
		<td data-name="year_dsc" <?php echo $inventory_chart_list->year_dsc->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_year_dsc">
<span<?php echo $inventory_chart_list->year_dsc->viewAttributes() ?>><?php echo $inventory_chart_list->year_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->cat_desc->Visible) { // cat_desc ?>
		<td data-name="cat_desc" <?php echo $inventory_chart_list->cat_desc->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_cat_desc">
<span<?php echo $inventory_chart_list->cat_desc->viewAttributes() ?>><?php echo $inventory_chart_list->cat_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $inventory_chart_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_item_model">
<span<?php echo $inventory_chart_list->item_model->viewAttributes() ?>><?php echo $inventory_chart_list->item_model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->item_serial->Visible) { // item_serial ?>
		<td data-name="item_serial" <?php echo $inventory_chart_list->item_serial->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_item_serial">
<span<?php echo $inventory_chart_list->item_serial->viewAttributes() ?>><?php echo $inventory_chart_list->item_serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->off_desc->Visible) { // off_desc ?>
		<td data-name="off_desc" <?php echo $inventory_chart_list->off_desc->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_off_desc">
<span<?php echo $inventory_chart_list->off_desc->viewAttributes() ?>><?php echo $inventory_chart_list->off_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->region_name->Visible) { // region_name ?>
		<td data-name="region_name" <?php echo $inventory_chart_list->region_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_region_name">
<span<?php echo $inventory_chart_list->region_name->viewAttributes() ?>><?php echo $inventory_chart_list->region_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->prov_name->Visible) { // prov_name ?>
		<td data-name="prov_name" <?php echo $inventory_chart_list->prov_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_prov_name">
<span<?php echo $inventory_chart_list->prov_name->viewAttributes() ?>><?php echo $inventory_chart_list->prov_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->city_name->Visible) { // city_name ?>
		<td data-name="city_name" <?php echo $inventory_chart_list->city_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_city_name">
<span<?php echo $inventory_chart_list->city_name->viewAttributes() ?>><?php echo $inventory_chart_list->city_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->name_accountable->Visible) { // name_accountable ?>
		<td data-name="name_accountable" <?php echo $inventory_chart_list->name_accountable->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_name_accountable">
<span<?php echo $inventory_chart_list->name_accountable->viewAttributes() ?>><?php echo $inventory_chart_list->name_accountable->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->Designation->Visible) { // Designation ?>
		<td data-name="Designation" <?php echo $inventory_chart_list->Designation->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_Designation">
<span<?php echo $inventory_chart_list->Designation->viewAttributes() ?>><?php echo $inventory_chart_list->Designation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_chart_list->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
		<td data-name="inventory_status_dsc" <?php echo $inventory_chart_list->inventory_status_dsc->cellAttributes() ?>>
<span id="el<?php echo $inventory_chart_list->RowCount ?>_inventory_chart_inventory_status_dsc">
<span<?php echo $inventory_chart_list->inventory_status_dsc->viewAttributes() ?>><?php echo $inventory_chart_list->inventory_status_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inventory_chart_list->ListOptions->render("body", "right", $inventory_chart_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$inventory_chart_list->isGridAdd())
		$inventory_chart_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$inventory_chart->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inventory_chart_list->Recordset)
	$inventory_chart_list->Recordset->Close();
?>
<?php if (!$inventory_chart_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $inventory_chart_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inventory_chart_list->TotalRecords == 0 && !$inventory_chart->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inventory_chart_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inventory_chart_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$inventory_chart_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$inventory_chart_list->terminate();
?>