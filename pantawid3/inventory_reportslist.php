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
$inventory_reports_list = new inventory_reports_list();

// Run the page
$inventory_reports_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventory_reports_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$inventory_reports_list->isExport()) { ?>
<script>
var finventory_reportslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	finventory_reportslist = currentForm = new ew.Form("finventory_reportslist", "list");
	finventory_reportslist.formKeyCountName = '<?php echo $inventory_reports_list->FormKeyCountName ?>';
	loadjs.done("finventory_reportslist");
});
var finventory_reportslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	finventory_reportslistsrch = currentSearchForm = new ew.Form("finventory_reportslistsrch");

	// Dynamic selection lists
	// Filters

	finventory_reportslistsrch.filterList = <?php echo $inventory_reports_list->getFilterList() ?>;
	loadjs.done("finventory_reportslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$inventory_reports_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inventory_reports_list->TotalRecords > 0 && $inventory_reports_list->ExportOptions->visible()) { ?>
<?php $inventory_reports_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_reports_list->ImportOptions->visible()) { ?>
<?php $inventory_reports_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_reports_list->SearchOptions->visible()) { ?>
<?php $inventory_reports_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_reports_list->FilterOptions->visible()) { ?>
<?php $inventory_reports_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inventory_reports_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$inventory_reports_list->isExport() && !$inventory_reports->CurrentAction) { ?>
<form name="finventory_reportslistsrch" id="finventory_reportslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="finventory_reportslistsrch-search-panel" class="<?php echo $inventory_reports_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inventory_reports">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $inventory_reports_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($inventory_reports_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($inventory_reports_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inventory_reports_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inventory_reports_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inventory_reports_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inventory_reports_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inventory_reports_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $inventory_reports_list->showPageHeader(); ?>
<?php
$inventory_reports_list->showMessage();
?>
<?php if ($inventory_reports_list->TotalRecords > 0 || $inventory_reports->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inventory_reports_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inventory_reports">
<?php if (!$inventory_reports_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$inventory_reports_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $inventory_reports_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inventory_reports_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="finventory_reportslist" id="finventory_reportslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventory_reports">
<div id="gmp_inventory_reports" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($inventory_reports_list->TotalRecords > 0 || $inventory_reports_list->isGridEdit()) { ?>
<table id="tbl_inventory_reportslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inventory_reports->RowType = ROWTYPE_HEADER;

// Render list options
$inventory_reports_list->renderListOptions();

// Render list options (header, left)
$inventory_reports_list->ListOptions->render("header", "left");
?>
<?php if ($inventory_reports_list->inventory_id->Visible) { // inventory_id ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->inventory_id) == "") { ?>
		<th data-name="inventory_id" class="<?php echo $inventory_reports_list->inventory_id->headerCellClass() ?>"><div id="elh_inventory_reports_inventory_id" class="inventory_reports_inventory_id"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->inventory_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_id" class="<?php echo $inventory_reports_list->inventory_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->inventory_id) ?>', 1);"><div id="elh_inventory_reports_inventory_id" class="inventory_reports_inventory_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->inventory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->month_dsc->Visible) { // month_dsc ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->month_dsc) == "") { ?>
		<th data-name="month_dsc" class="<?php echo $inventory_reports_list->month_dsc->headerCellClass() ?>"><div id="elh_inventory_reports_month_dsc" class="inventory_reports_month_dsc"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->month_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="month_dsc" class="<?php echo $inventory_reports_list->month_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->month_dsc) ?>', 1);"><div id="elh_inventory_reports_month_dsc" class="inventory_reports_month_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->month_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->month_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->month_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->year_dsc->Visible) { // year_dsc ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->year_dsc) == "") { ?>
		<th data-name="year_dsc" class="<?php echo $inventory_reports_list->year_dsc->headerCellClass() ?>"><div id="elh_inventory_reports_year_dsc" class="inventory_reports_year_dsc"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->year_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="year_dsc" class="<?php echo $inventory_reports_list->year_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->year_dsc) ?>', 1);"><div id="elh_inventory_reports_year_dsc" class="inventory_reports_year_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->year_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->year_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->year_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->cat_desc->Visible) { // cat_desc ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->cat_desc) == "") { ?>
		<th data-name="cat_desc" class="<?php echo $inventory_reports_list->cat_desc->headerCellClass() ?>"><div id="elh_inventory_reports_cat_desc" class="inventory_reports_cat_desc"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->cat_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cat_desc" class="<?php echo $inventory_reports_list->cat_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->cat_desc) ?>', 1);"><div id="elh_inventory_reports_cat_desc" class="inventory_reports_cat_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->cat_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->item_model->Visible) { // item_model ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $inventory_reports_list->item_model->headerCellClass() ?>"><div id="elh_inventory_reports_item_model" class="inventory_reports_item_model"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->item_model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $inventory_reports_list->item_model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->item_model) ?>', 1);"><div id="elh_inventory_reports_item_model" class="inventory_reports_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->item_serial->Visible) { // item_serial ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->item_serial) == "") { ?>
		<th data-name="item_serial" class="<?php echo $inventory_reports_list->item_serial->headerCellClass() ?>"><div id="elh_inventory_reports_item_serial" class="inventory_reports_item_serial"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->item_serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_serial" class="<?php echo $inventory_reports_list->item_serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->item_serial) ?>', 1);"><div id="elh_inventory_reports_item_serial" class="inventory_reports_item_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->item_serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->off_desc->Visible) { // off_desc ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->off_desc) == "") { ?>
		<th data-name="off_desc" class="<?php echo $inventory_reports_list->off_desc->headerCellClass() ?>"><div id="elh_inventory_reports_off_desc" class="inventory_reports_off_desc"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->off_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off_desc" class="<?php echo $inventory_reports_list->off_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->off_desc) ?>', 1);"><div id="elh_inventory_reports_off_desc" class="inventory_reports_off_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->off_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->region_name->Visible) { // region_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->region_name) == "") { ?>
		<th data-name="region_name" class="<?php echo $inventory_reports_list->region_name->headerCellClass() ?>"><div id="elh_inventory_reports_region_name" class="inventory_reports_region_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->region_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_name" class="<?php echo $inventory_reports_list->region_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->region_name) ?>', 1);"><div id="elh_inventory_reports_region_name" class="inventory_reports_region_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->region_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->region_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->region_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->prov_name->Visible) { // prov_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->prov_name) == "") { ?>
		<th data-name="prov_name" class="<?php echo $inventory_reports_list->prov_name->headerCellClass() ?>"><div id="elh_inventory_reports_prov_name" class="inventory_reports_prov_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->prov_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prov_name" class="<?php echo $inventory_reports_list->prov_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->prov_name) ?>', 1);"><div id="elh_inventory_reports_prov_name" class="inventory_reports_prov_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->prov_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->prov_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->prov_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->city_name->Visible) { // city_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->city_name) == "") { ?>
		<th data-name="city_name" class="<?php echo $inventory_reports_list->city_name->headerCellClass() ?>"><div id="elh_inventory_reports_city_name" class="inventory_reports_city_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->city_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_name" class="<?php echo $inventory_reports_list->city_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->city_name) ?>', 1);"><div id="elh_inventory_reports_city_name" class="inventory_reports_city_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->city_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->city_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->city_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->inventory_status_dsc) == "") { ?>
		<th data-name="inventory_status_dsc" class="<?php echo $inventory_reports_list->inventory_status_dsc->headerCellClass() ?>"><div id="elh_inventory_reports_inventory_status_dsc" class="inventory_reports_inventory_status_dsc"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->inventory_status_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_status_dsc" class="<?php echo $inventory_reports_list->inventory_status_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->inventory_status_dsc) ?>', 1);"><div id="elh_inventory_reports_inventory_status_dsc" class="inventory_reports_inventory_status_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->inventory_status_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->inventory_status_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->inventory_status_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->Last_Date_Check->Visible) { // Last_Date_Check ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->Last_Date_Check) == "") { ?>
		<th data-name="Last_Date_Check" class="<?php echo $inventory_reports_list->Last_Date_Check->headerCellClass() ?>"><div id="elh_inventory_reports_Last_Date_Check" class="inventory_reports_Last_Date_Check"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->Last_Date_Check->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Last_Date_Check" class="<?php echo $inventory_reports_list->Last_Date_Check->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->Last_Date_Check) ?>', 1);"><div id="elh_inventory_reports_Last_Date_Check" class="inventory_reports_Last_Date_Check">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->Last_Date_Check->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->Last_Date_Check->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->Last_Date_Check->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->remarks->Visible) { // remarks ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->remarks) == "") { ?>
		<th data-name="remarks" class="<?php echo $inventory_reports_list->remarks->headerCellClass() ?>"><div id="elh_inventory_reports_remarks" class="inventory_reports_remarks"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remarks" class="<?php echo $inventory_reports_list->remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->remarks) ?>', 1);"><div id="elh_inventory_reports_remarks" class="inventory_reports_remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $inventory_reports_list->Name_dsc->headerCellClass() ?>"><div id="elh_inventory_reports_Name_dsc" class="inventory_reports_Name_dsc"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->Name_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $inventory_reports_list->Name_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->Name_dsc) ?>', 1);"><div id="elh_inventory_reports_Name_dsc" class="inventory_reports_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->Name_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->user_last_modify->Visible) { // user_last_modify ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->user_last_modify) == "") { ?>
		<th data-name="user_last_modify" class="<?php echo $inventory_reports_list->user_last_modify->headerCellClass() ?>"><div id="elh_inventory_reports_user_last_modify" class="inventory_reports_user_last_modify"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->user_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_last_modify" class="<?php echo $inventory_reports_list->user_last_modify->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->user_last_modify) ?>', 1);"><div id="elh_inventory_reports_user_last_modify" class="inventory_reports_user_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->user_last_modify->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->date_last_modify->Visible) { // date_last_modify ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->date_last_modify) == "") { ?>
		<th data-name="date_last_modify" class="<?php echo $inventory_reports_list->date_last_modify->headerCellClass() ?>"><div id="elh_inventory_reports_date_last_modify" class="inventory_reports_date_last_modify"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->date_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_last_modify" class="<?php echo $inventory_reports_list->date_last_modify->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->date_last_modify) ?>', 1);"><div id="elh_inventory_reports_date_last_modify" class="inventory_reports_date_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->date_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->date_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->date_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->pullout_date->Visible) { // pullout_date ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->pullout_date) == "") { ?>
		<th data-name="pullout_date" class="<?php echo $inventory_reports_list->pullout_date->headerCellClass() ?>"><div id="elh_inventory_reports_pullout_date" class="inventory_reports_pullout_date"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->pullout_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pullout_date" class="<?php echo $inventory_reports_list->pullout_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->pullout_date) ?>', 1);"><div id="elh_inventory_reports_pullout_date" class="inventory_reports_pullout_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->pullout_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->pullout_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->pullout_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->pos_desc->Visible) { // pos_desc ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->pos_desc) == "") { ?>
		<th data-name="pos_desc" class="<?php echo $inventory_reports_list->pos_desc->headerCellClass() ?>"><div id="elh_inventory_reports_pos_desc" class="inventory_reports_pos_desc"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->pos_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pos_desc" class="<?php echo $inventory_reports_list->pos_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->pos_desc) ?>', 1);"><div id="elh_inventory_reports_pos_desc" class="inventory_reports_pos_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->pos_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->pos_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->pos_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->current_location->Visible) { // current_location ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->current_location) == "") { ?>
		<th data-name="current_location" class="<?php echo $inventory_reports_list->current_location->headerCellClass() ?>"><div id="elh_inventory_reports_current_location" class="inventory_reports_current_location"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->current_location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="current_location" class="<?php echo $inventory_reports_list->current_location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->current_location) ?>', 1);"><div id="elh_inventory_reports_current_location" class="inventory_reports_current_location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->current_location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->current_location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->current_location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->last_name->Visible) { // last_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->last_name) == "") { ?>
		<th data-name="last_name" class="<?php echo $inventory_reports_list->last_name->headerCellClass() ?>"><div id="elh_inventory_reports_last_name" class="inventory_reports_last_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->last_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="last_name" class="<?php echo $inventory_reports_list->last_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->last_name) ?>', 1);"><div id="elh_inventory_reports_last_name" class="inventory_reports_last_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->last_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->last_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->last_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->first_name->Visible) { // first_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->first_name) == "") { ?>
		<th data-name="first_name" class="<?php echo $inventory_reports_list->first_name->headerCellClass() ?>"><div id="elh_inventory_reports_first_name" class="inventory_reports_first_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="first_name" class="<?php echo $inventory_reports_list->first_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->first_name) ?>', 1);"><div id="elh_inventory_reports_first_name" class="inventory_reports_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->first_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->mid_name->Visible) { // mid_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->mid_name) == "") { ?>
		<th data-name="mid_name" class="<?php echo $inventory_reports_list->mid_name->headerCellClass() ?>"><div id="elh_inventory_reports_mid_name" class="inventory_reports_mid_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->mid_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mid_name" class="<?php echo $inventory_reports_list->mid_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->mid_name) ?>', 1);"><div id="elh_inventory_reports_mid_name" class="inventory_reports_mid_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->mid_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->mid_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->mid_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->ext_name->Visible) { // ext_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->ext_name) == "") { ?>
		<th data-name="ext_name" class="<?php echo $inventory_reports_list->ext_name->headerCellClass() ?>"><div id="elh_inventory_reports_ext_name" class="inventory_reports_ext_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->ext_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ext_name" class="<?php echo $inventory_reports_list->ext_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->ext_name) ?>', 1);"><div id="elh_inventory_reports_ext_name" class="inventory_reports_ext_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->ext_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->ext_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->ext_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->full_name->Visible) { // full_name ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->full_name) == "") { ?>
		<th data-name="full_name" class="<?php echo $inventory_reports_list->full_name->headerCellClass() ?>"><div id="elh_inventory_reports_full_name" class="inventory_reports_full_name"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->full_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="full_name" class="<?php echo $inventory_reports_list->full_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->full_name) ?>', 1);"><div id="elh_inventory_reports_full_name" class="inventory_reports_full_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->full_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->full_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->full_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_reports_list->full_name_tbl->Visible) { // full_name_tbl ?>
	<?php if ($inventory_reports_list->SortUrl($inventory_reports_list->full_name_tbl) == "") { ?>
		<th data-name="full_name_tbl" class="<?php echo $inventory_reports_list->full_name_tbl->headerCellClass() ?>"><div id="elh_inventory_reports_full_name_tbl" class="inventory_reports_full_name_tbl"><div class="ew-table-header-caption"><?php echo $inventory_reports_list->full_name_tbl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="full_name_tbl" class="<?php echo $inventory_reports_list->full_name_tbl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_reports_list->SortUrl($inventory_reports_list->full_name_tbl) ?>', 1);"><div id="elh_inventory_reports_full_name_tbl" class="inventory_reports_full_name_tbl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_reports_list->full_name_tbl->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_reports_list->full_name_tbl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_reports_list->full_name_tbl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inventory_reports_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inventory_reports_list->ExportAll && $inventory_reports_list->isExport()) {
	$inventory_reports_list->StopRecord = $inventory_reports_list->TotalRecords;
} else {

	// Set the last record to display
	if ($inventory_reports_list->TotalRecords > $inventory_reports_list->StartRecord + $inventory_reports_list->DisplayRecords - 1)
		$inventory_reports_list->StopRecord = $inventory_reports_list->StartRecord + $inventory_reports_list->DisplayRecords - 1;
	else
		$inventory_reports_list->StopRecord = $inventory_reports_list->TotalRecords;
}
$inventory_reports_list->RecordCount = $inventory_reports_list->StartRecord - 1;
if ($inventory_reports_list->Recordset && !$inventory_reports_list->Recordset->EOF) {
	$inventory_reports_list->Recordset->moveFirst();
	$selectLimit = $inventory_reports_list->UseSelectLimit;
	if (!$selectLimit && $inventory_reports_list->StartRecord > 1)
		$inventory_reports_list->Recordset->move($inventory_reports_list->StartRecord - 1);
} elseif (!$inventory_reports->AllowAddDeleteRow && $inventory_reports_list->StopRecord == 0) {
	$inventory_reports_list->StopRecord = $inventory_reports->GridAddRowCount;
}

// Initialize aggregate
$inventory_reports->RowType = ROWTYPE_AGGREGATEINIT;
$inventory_reports->resetAttributes();
$inventory_reports_list->renderRow();
while ($inventory_reports_list->RecordCount < $inventory_reports_list->StopRecord) {
	$inventory_reports_list->RecordCount++;
	if ($inventory_reports_list->RecordCount >= $inventory_reports_list->StartRecord) {
		$inventory_reports_list->RowCount++;

		// Set up key count
		$inventory_reports_list->KeyCount = $inventory_reports_list->RowIndex;

		// Init row class and style
		$inventory_reports->resetAttributes();
		$inventory_reports->CssClass = "";
		if ($inventory_reports_list->isGridAdd()) {
		} else {
			$inventory_reports_list->loadRowValues($inventory_reports_list->Recordset); // Load row values
		}
		$inventory_reports->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inventory_reports->RowAttrs->merge(["data-rowindex" => $inventory_reports_list->RowCount, "id" => "r" . $inventory_reports_list->RowCount . "_inventory_reports", "data-rowtype" => $inventory_reports->RowType]);

		// Render row
		$inventory_reports_list->renderRow();

		// Render list options
		$inventory_reports_list->renderListOptions();
?>
	<tr <?php echo $inventory_reports->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inventory_reports_list->ListOptions->render("body", "left", $inventory_reports_list->RowCount);
?>
	<?php if ($inventory_reports_list->inventory_id->Visible) { // inventory_id ?>
		<td data-name="inventory_id" <?php echo $inventory_reports_list->inventory_id->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_inventory_id">
<span<?php echo $inventory_reports_list->inventory_id->viewAttributes() ?>><?php echo $inventory_reports_list->inventory_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" <?php echo $inventory_reports_list->month_dsc->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_month_dsc">
<span<?php echo $inventory_reports_list->month_dsc->viewAttributes() ?>><?php echo $inventory_reports_list->month_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->year_dsc->Visible) { // year_dsc ?>
		<td data-name="year_dsc" <?php echo $inventory_reports_list->year_dsc->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_year_dsc">
<span<?php echo $inventory_reports_list->year_dsc->viewAttributes() ?>><?php echo $inventory_reports_list->year_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->cat_desc->Visible) { // cat_desc ?>
		<td data-name="cat_desc" <?php echo $inventory_reports_list->cat_desc->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_cat_desc">
<span<?php echo $inventory_reports_list->cat_desc->viewAttributes() ?>><?php echo $inventory_reports_list->cat_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $inventory_reports_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_item_model">
<span<?php echo $inventory_reports_list->item_model->viewAttributes() ?>><?php echo $inventory_reports_list->item_model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->item_serial->Visible) { // item_serial ?>
		<td data-name="item_serial" <?php echo $inventory_reports_list->item_serial->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_item_serial">
<span<?php echo $inventory_reports_list->item_serial->viewAttributes() ?>><?php echo $inventory_reports_list->item_serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->off_desc->Visible) { // off_desc ?>
		<td data-name="off_desc" <?php echo $inventory_reports_list->off_desc->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_off_desc">
<span<?php echo $inventory_reports_list->off_desc->viewAttributes() ?>><?php echo $inventory_reports_list->off_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->region_name->Visible) { // region_name ?>
		<td data-name="region_name" <?php echo $inventory_reports_list->region_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_region_name">
<span<?php echo $inventory_reports_list->region_name->viewAttributes() ?>><?php echo $inventory_reports_list->region_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->prov_name->Visible) { // prov_name ?>
		<td data-name="prov_name" <?php echo $inventory_reports_list->prov_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_prov_name">
<span<?php echo $inventory_reports_list->prov_name->viewAttributes() ?>><?php echo $inventory_reports_list->prov_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->city_name->Visible) { // city_name ?>
		<td data-name="city_name" <?php echo $inventory_reports_list->city_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_city_name">
<span<?php echo $inventory_reports_list->city_name->viewAttributes() ?>><?php echo $inventory_reports_list->city_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
		<td data-name="inventory_status_dsc" <?php echo $inventory_reports_list->inventory_status_dsc->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_inventory_status_dsc">
<span<?php echo $inventory_reports_list->inventory_status_dsc->viewAttributes() ?>><?php echo $inventory_reports_list->inventory_status_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->Last_Date_Check->Visible) { // Last_Date_Check ?>
		<td data-name="Last_Date_Check" <?php echo $inventory_reports_list->Last_Date_Check->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_Last_Date_Check">
<span<?php echo $inventory_reports_list->Last_Date_Check->viewAttributes() ?>><?php echo $inventory_reports_list->Last_Date_Check->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->remarks->Visible) { // remarks ?>
		<td data-name="remarks" <?php echo $inventory_reports_list->remarks->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_remarks">
<span<?php echo $inventory_reports_list->remarks->viewAttributes() ?>><?php echo $inventory_reports_list->remarks->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $inventory_reports_list->Name_dsc->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_Name_dsc">
<span<?php echo $inventory_reports_list->Name_dsc->viewAttributes() ?>><?php echo $inventory_reports_list->Name_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" <?php echo $inventory_reports_list->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_user_last_modify">
<span<?php echo $inventory_reports_list->user_last_modify->viewAttributes() ?>><?php echo $inventory_reports_list->user_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->date_last_modify->Visible) { // date_last_modify ?>
		<td data-name="date_last_modify" <?php echo $inventory_reports_list->date_last_modify->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_date_last_modify">
<span<?php echo $inventory_reports_list->date_last_modify->viewAttributes() ?>><?php echo $inventory_reports_list->date_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->pullout_date->Visible) { // pullout_date ?>
		<td data-name="pullout_date" <?php echo $inventory_reports_list->pullout_date->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_pullout_date">
<span<?php echo $inventory_reports_list->pullout_date->viewAttributes() ?>><?php echo $inventory_reports_list->pullout_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->pos_desc->Visible) { // pos_desc ?>
		<td data-name="pos_desc" <?php echo $inventory_reports_list->pos_desc->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_pos_desc">
<span<?php echo $inventory_reports_list->pos_desc->viewAttributes() ?>><?php echo $inventory_reports_list->pos_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->current_location->Visible) { // current_location ?>
		<td data-name="current_location" <?php echo $inventory_reports_list->current_location->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_current_location">
<span<?php echo $inventory_reports_list->current_location->viewAttributes() ?>><?php echo $inventory_reports_list->current_location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->last_name->Visible) { // last_name ?>
		<td data-name="last_name" <?php echo $inventory_reports_list->last_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_last_name">
<span<?php echo $inventory_reports_list->last_name->viewAttributes() ?>><?php echo $inventory_reports_list->last_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->first_name->Visible) { // first_name ?>
		<td data-name="first_name" <?php echo $inventory_reports_list->first_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_first_name">
<span<?php echo $inventory_reports_list->first_name->viewAttributes() ?>><?php echo $inventory_reports_list->first_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->mid_name->Visible) { // mid_name ?>
		<td data-name="mid_name" <?php echo $inventory_reports_list->mid_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_mid_name">
<span<?php echo $inventory_reports_list->mid_name->viewAttributes() ?>><?php echo $inventory_reports_list->mid_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->ext_name->Visible) { // ext_name ?>
		<td data-name="ext_name" <?php echo $inventory_reports_list->ext_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_ext_name">
<span<?php echo $inventory_reports_list->ext_name->viewAttributes() ?>><?php echo $inventory_reports_list->ext_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->full_name->Visible) { // full_name ?>
		<td data-name="full_name" <?php echo $inventory_reports_list->full_name->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_full_name">
<span<?php echo $inventory_reports_list->full_name->viewAttributes() ?>><?php echo $inventory_reports_list->full_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_reports_list->full_name_tbl->Visible) { // full_name_tbl ?>
		<td data-name="full_name_tbl" <?php echo $inventory_reports_list->full_name_tbl->cellAttributes() ?>>
<span id="el<?php echo $inventory_reports_list->RowCount ?>_inventory_reports_full_name_tbl">
<span<?php echo $inventory_reports_list->full_name_tbl->viewAttributes() ?>><?php echo $inventory_reports_list->full_name_tbl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inventory_reports_list->ListOptions->render("body", "right", $inventory_reports_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$inventory_reports_list->isGridAdd())
		$inventory_reports_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$inventory_reports->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inventory_reports_list->Recordset)
	$inventory_reports_list->Recordset->Close();
?>
<?php if (!$inventory_reports_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inventory_reports_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $inventory_reports_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inventory_reports_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inventory_reports_list->TotalRecords == 0 && !$inventory_reports->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inventory_reports_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inventory_reports_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$inventory_reports_list->isExport()) { ?>
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
$inventory_reports_list->terminate();
?>