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
$item_per_employee_list = new item_per_employee_list();

// Run the page
$item_per_employee_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$item_per_employee_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$item_per_employee_list->isExport()) { ?>
<script>
var fitem_per_employeelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fitem_per_employeelist = currentForm = new ew.Form("fitem_per_employeelist", "list");
	fitem_per_employeelist.formKeyCountName = '<?php echo $item_per_employee_list->FormKeyCountName ?>';
	loadjs.done("fitem_per_employeelist");
});
var fitem_per_employeelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fitem_per_employeelistsrch = currentSearchForm = new ew.Form("fitem_per_employeelistsrch");

	// Dynamic selection lists
	// Filters

	fitem_per_employeelistsrch.filterList = <?php echo $item_per_employee_list->getFilterList() ?>;
	loadjs.done("fitem_per_employeelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$item_per_employee_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($item_per_employee_list->TotalRecords > 0 && $item_per_employee_list->ExportOptions->visible()) { ?>
<?php $item_per_employee_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($item_per_employee_list->ImportOptions->visible()) { ?>
<?php $item_per_employee_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($item_per_employee_list->SearchOptions->visible()) { ?>
<?php $item_per_employee_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($item_per_employee_list->FilterOptions->visible()) { ?>
<?php $item_per_employee_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$item_per_employee_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$item_per_employee_list->isExport() && !$item_per_employee->CurrentAction) { ?>
<form name="fitem_per_employeelistsrch" id="fitem_per_employeelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fitem_per_employeelistsrch-search-panel" class="<?php echo $item_per_employee_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="item_per_employee">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $item_per_employee_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($item_per_employee_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($item_per_employee_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $item_per_employee_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($item_per_employee_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($item_per_employee_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($item_per_employee_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($item_per_employee_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $item_per_employee_list->showPageHeader(); ?>
<?php
$item_per_employee_list->showMessage();
?>
<?php if ($item_per_employee_list->TotalRecords > 0 || $item_per_employee->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($item_per_employee_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> item_per_employee">
<?php if (!$item_per_employee_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$item_per_employee_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $item_per_employee_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $item_per_employee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fitem_per_employeelist" id="fitem_per_employeelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="item_per_employee">
<div id="gmp_item_per_employee" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($item_per_employee_list->TotalRecords > 0 || $item_per_employee_list->isGridEdit()) { ?>
<table id="tbl_item_per_employeelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$item_per_employee->RowType = ROWTYPE_HEADER;

// Render list options
$item_per_employee_list->renderListOptions();

// Render list options (header, left)
$item_per_employee_list->ListOptions->render("header", "left");
?>
<?php if ($item_per_employee_list->inventory_id->Visible) { // inventory_id ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->inventory_id) == "") { ?>
		<th data-name="inventory_id" class="<?php echo $item_per_employee_list->inventory_id->headerCellClass() ?>"><div id="elh_item_per_employee_inventory_id" class="item_per_employee_inventory_id"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->inventory_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_id" class="<?php echo $item_per_employee_list->inventory_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->inventory_id) ?>', 1);"><div id="elh_item_per_employee_inventory_id" class="item_per_employee_inventory_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->inventory_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->cat_desc->Visible) { // cat_desc ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->cat_desc) == "") { ?>
		<th data-name="cat_desc" class="<?php echo $item_per_employee_list->cat_desc->headerCellClass() ?>"><div id="elh_item_per_employee_cat_desc" class="item_per_employee_cat_desc"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->cat_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cat_desc" class="<?php echo $item_per_employee_list->cat_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->cat_desc) ?>', 1);"><div id="elh_item_per_employee_cat_desc" class="item_per_employee_cat_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->cat_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->item_model->Visible) { // item_model ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $item_per_employee_list->item_model->headerCellClass() ?>"><div id="elh_item_per_employee_item_model" class="item_per_employee_item_model"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->item_model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $item_per_employee_list->item_model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->item_model) ?>', 1);"><div id="elh_item_per_employee_item_model" class="item_per_employee_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->item_serial->Visible) { // item_serial ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->item_serial) == "") { ?>
		<th data-name="item_serial" class="<?php echo $item_per_employee_list->item_serial->headerCellClass() ?>"><div id="elh_item_per_employee_item_serial" class="item_per_employee_item_serial"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->item_serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_serial" class="<?php echo $item_per_employee_list->item_serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->item_serial) ?>', 1);"><div id="elh_item_per_employee_item_serial" class="item_per_employee_item_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->item_serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->off_desc->Visible) { // off_desc ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->off_desc) == "") { ?>
		<th data-name="off_desc" class="<?php echo $item_per_employee_list->off_desc->headerCellClass() ?>"><div id="elh_item_per_employee_off_desc" class="item_per_employee_off_desc"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->off_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off_desc" class="<?php echo $item_per_employee_list->off_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->off_desc) ?>', 1);"><div id="elh_item_per_employee_off_desc" class="item_per_employee_off_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->off_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->region_name->Visible) { // region_name ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->region_name) == "") { ?>
		<th data-name="region_name" class="<?php echo $item_per_employee_list->region_name->headerCellClass() ?>"><div id="elh_item_per_employee_region_name" class="item_per_employee_region_name"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->region_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_name" class="<?php echo $item_per_employee_list->region_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->region_name) ?>', 1);"><div id="elh_item_per_employee_region_name" class="item_per_employee_region_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->region_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->region_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->region_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->prov_name->Visible) { // prov_name ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->prov_name) == "") { ?>
		<th data-name="prov_name" class="<?php echo $item_per_employee_list->prov_name->headerCellClass() ?>"><div id="elh_item_per_employee_prov_name" class="item_per_employee_prov_name"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->prov_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prov_name" class="<?php echo $item_per_employee_list->prov_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->prov_name) ?>', 1);"><div id="elh_item_per_employee_prov_name" class="item_per_employee_prov_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->prov_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->prov_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->prov_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->city_name->Visible) { // city_name ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->city_name) == "") { ?>
		<th data-name="city_name" class="<?php echo $item_per_employee_list->city_name->headerCellClass() ?>"><div id="elh_item_per_employee_city_name" class="item_per_employee_city_name"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->city_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_name" class="<?php echo $item_per_employee_list->city_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->city_name) ?>', 1);"><div id="elh_item_per_employee_city_name" class="item_per_employee_city_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->city_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->city_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->city_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->pos_desc->Visible) { // pos_desc ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->pos_desc) == "") { ?>
		<th data-name="pos_desc" class="<?php echo $item_per_employee_list->pos_desc->headerCellClass() ?>"><div id="elh_item_per_employee_pos_desc" class="item_per_employee_pos_desc"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->pos_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pos_desc" class="<?php echo $item_per_employee_list->pos_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->pos_desc) ?>', 1);"><div id="elh_item_per_employee_pos_desc" class="item_per_employee_pos_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->pos_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->pos_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->pos_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->current_location->Visible) { // current_location ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->current_location) == "") { ?>
		<th data-name="current_location" class="<?php echo $item_per_employee_list->current_location->headerCellClass() ?>"><div id="elh_item_per_employee_current_location" class="item_per_employee_current_location"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->current_location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="current_location" class="<?php echo $item_per_employee_list->current_location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->current_location) ?>', 1);"><div id="elh_item_per_employee_current_location" class="item_per_employee_current_location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->current_location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->current_location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->current_location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->Last_Date_Check->Visible) { // Last_Date_Check ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->Last_Date_Check) == "") { ?>
		<th data-name="Last_Date_Check" class="<?php echo $item_per_employee_list->Last_Date_Check->headerCellClass() ?>"><div id="elh_item_per_employee_Last_Date_Check" class="item_per_employee_Last_Date_Check"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->Last_Date_Check->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Last_Date_Check" class="<?php echo $item_per_employee_list->Last_Date_Check->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->Last_Date_Check) ?>', 1);"><div id="elh_item_per_employee_Last_Date_Check" class="item_per_employee_Last_Date_Check">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->Last_Date_Check->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->Last_Date_Check->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->Last_Date_Check->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $item_per_employee_list->Name_dsc->headerCellClass() ?>"><div id="elh_item_per_employee_Name_dsc" class="item_per_employee_Name_dsc"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->Name_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $item_per_employee_list->Name_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->Name_dsc) ?>', 1);"><div id="elh_item_per_employee_Name_dsc" class="item_per_employee_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->Name_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->inventory_status_dsc) == "") { ?>
		<th data-name="inventory_status_dsc" class="<?php echo $item_per_employee_list->inventory_status_dsc->headerCellClass() ?>"><div id="elh_item_per_employee_inventory_status_dsc" class="item_per_employee_inventory_status_dsc"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->inventory_status_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_status_dsc" class="<?php echo $item_per_employee_list->inventory_status_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->inventory_status_dsc) ?>', 1);"><div id="elh_item_per_employee_inventory_status_dsc" class="item_per_employee_inventory_status_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->inventory_status_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->inventory_status_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->inventory_status_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->remarks->Visible) { // remarks ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->remarks) == "") { ?>
		<th data-name="remarks" class="<?php echo $item_per_employee_list->remarks->headerCellClass() ?>"><div id="elh_item_per_employee_remarks" class="item_per_employee_remarks"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remarks" class="<?php echo $item_per_employee_list->remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->remarks) ?>', 1);"><div id="elh_item_per_employee_remarks" class="item_per_employee_remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->year_dsc->Visible) { // year_dsc ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->year_dsc) == "") { ?>
		<th data-name="year_dsc" class="<?php echo $item_per_employee_list->year_dsc->headerCellClass() ?>"><div id="elh_item_per_employee_year_dsc" class="item_per_employee_year_dsc"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->year_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="year_dsc" class="<?php echo $item_per_employee_list->year_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->year_dsc) ?>', 1);"><div id="elh_item_per_employee_year_dsc" class="item_per_employee_year_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->year_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->year_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->year_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->name_accountable->Visible) { // name_accountable ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->name_accountable) == "") { ?>
		<th data-name="name_accountable" class="<?php echo $item_per_employee_list->name_accountable->headerCellClass() ?>"><div id="elh_item_per_employee_name_accountable" class="item_per_employee_name_accountable"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->name_accountable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name_accountable" class="<?php echo $item_per_employee_list->name_accountable->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->name_accountable) ?>', 1);"><div id="elh_item_per_employee_name_accountable" class="item_per_employee_name_accountable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->name_accountable->caption() ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->name_accountable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->name_accountable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->last_name->Visible) { // last_name ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->last_name) == "") { ?>
		<th data-name="last_name" class="<?php echo $item_per_employee_list->last_name->headerCellClass() ?>"><div id="elh_item_per_employee_last_name" class="item_per_employee_last_name"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->last_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="last_name" class="<?php echo $item_per_employee_list->last_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->last_name) ?>', 1);"><div id="elh_item_per_employee_last_name" class="item_per_employee_last_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->last_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->last_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->last_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->first_name->Visible) { // first_name ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->first_name) == "") { ?>
		<th data-name="first_name" class="<?php echo $item_per_employee_list->first_name->headerCellClass() ?>"><div id="elh_item_per_employee_first_name" class="item_per_employee_first_name"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="first_name" class="<?php echo $item_per_employee_list->first_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->first_name) ?>', 1);"><div id="elh_item_per_employee_first_name" class="item_per_employee_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->first_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->mid_name->Visible) { // mid_name ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->mid_name) == "") { ?>
		<th data-name="mid_name" class="<?php echo $item_per_employee_list->mid_name->headerCellClass() ?>"><div id="elh_item_per_employee_mid_name" class="item_per_employee_mid_name"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->mid_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mid_name" class="<?php echo $item_per_employee_list->mid_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->mid_name) ?>', 1);"><div id="elh_item_per_employee_mid_name" class="item_per_employee_mid_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->mid_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->mid_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->mid_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->ext_name->Visible) { // ext_name ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->ext_name) == "") { ?>
		<th data-name="ext_name" class="<?php echo $item_per_employee_list->ext_name->headerCellClass() ?>"><div id="elh_item_per_employee_ext_name" class="item_per_employee_ext_name"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->ext_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ext_name" class="<?php echo $item_per_employee_list->ext_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->ext_name) ?>', 1);"><div id="elh_item_per_employee_ext_name" class="item_per_employee_ext_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->ext_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->ext_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->ext_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->namefull->Visible) { // namefull ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->namefull) == "") { ?>
		<th data-name="namefull" class="<?php echo $item_per_employee_list->namefull->headerCellClass() ?>"><div id="elh_item_per_employee_namefull" class="item_per_employee_namefull"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->namefull->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namefull" class="<?php echo $item_per_employee_list->namefull->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->namefull) ?>', 1);"><div id="elh_item_per_employee_namefull" class="item_per_employee_namefull">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->namefull->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->namefull->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->namefull->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->status->Visible) { // status ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $item_per_employee_list->status->headerCellClass() ?>"><div id="elh_item_per_employee_status" class="item_per_employee_status"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $item_per_employee_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->status) ?>', 1);"><div id="elh_item_per_employee_status" class="item_per_employee_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->month_dsc->Visible) { // month_dsc ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->month_dsc) == "") { ?>
		<th data-name="month_dsc" class="<?php echo $item_per_employee_list->month_dsc->headerCellClass() ?>"><div id="elh_item_per_employee_month_dsc" class="item_per_employee_month_dsc"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->month_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="month_dsc" class="<?php echo $item_per_employee_list->month_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->month_dsc) ?>', 1);"><div id="elh_item_per_employee_month_dsc" class="item_per_employee_month_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->month_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->month_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->month_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->full_name_tbl->Visible) { // full_name_tbl ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->full_name_tbl) == "") { ?>
		<th data-name="full_name_tbl" class="<?php echo $item_per_employee_list->full_name_tbl->headerCellClass() ?>"><div id="elh_item_per_employee_full_name_tbl" class="item_per_employee_full_name_tbl"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->full_name_tbl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="full_name_tbl" class="<?php echo $item_per_employee_list->full_name_tbl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->full_name_tbl) ?>', 1);"><div id="elh_item_per_employee_full_name_tbl" class="item_per_employee_full_name_tbl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->full_name_tbl->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->full_name_tbl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->full_name_tbl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->position->Visible) { // position ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->position) == "") { ?>
		<th data-name="position" class="<?php echo $item_per_employee_list->position->headerCellClass() ?>"><div id="elh_item_per_employee_position" class="item_per_employee_position"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->position->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="position" class="<?php echo $item_per_employee_list->position->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->position) ?>', 1);"><div id="elh_item_per_employee_position" class="item_per_employee_position">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->position->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->NameSig->Visible) { // NameSig ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->NameSig) == "") { ?>
		<th data-name="NameSig" class="<?php echo $item_per_employee_list->NameSig->headerCellClass() ?>"><div id="elh_item_per_employee_NameSig" class="item_per_employee_NameSig"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->NameSig->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NameSig" class="<?php echo $item_per_employee_list->NameSig->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->NameSig) ?>', 1);"><div id="elh_item_per_employee_NameSig" class="item_per_employee_NameSig">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->NameSig->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->NameSig->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->NameSig->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($item_per_employee_list->DesignationSig->Visible) { // DesignationSig ?>
	<?php if ($item_per_employee_list->SortUrl($item_per_employee_list->DesignationSig) == "") { ?>
		<th data-name="DesignationSig" class="<?php echo $item_per_employee_list->DesignationSig->headerCellClass() ?>"><div id="elh_item_per_employee_DesignationSig" class="item_per_employee_DesignationSig"><div class="ew-table-header-caption"><?php echo $item_per_employee_list->DesignationSig->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DesignationSig" class="<?php echo $item_per_employee_list->DesignationSig->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $item_per_employee_list->SortUrl($item_per_employee_list->DesignationSig) ?>', 1);"><div id="elh_item_per_employee_DesignationSig" class="item_per_employee_DesignationSig">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $item_per_employee_list->DesignationSig->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($item_per_employee_list->DesignationSig->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($item_per_employee_list->DesignationSig->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$item_per_employee_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($item_per_employee_list->ExportAll && $item_per_employee_list->isExport()) {
	$item_per_employee_list->StopRecord = $item_per_employee_list->TotalRecords;
} else {

	// Set the last record to display
	if ($item_per_employee_list->TotalRecords > $item_per_employee_list->StartRecord + $item_per_employee_list->DisplayRecords - 1)
		$item_per_employee_list->StopRecord = $item_per_employee_list->StartRecord + $item_per_employee_list->DisplayRecords - 1;
	else
		$item_per_employee_list->StopRecord = $item_per_employee_list->TotalRecords;
}
$item_per_employee_list->RecordCount = $item_per_employee_list->StartRecord - 1;
if ($item_per_employee_list->Recordset && !$item_per_employee_list->Recordset->EOF) {
	$item_per_employee_list->Recordset->moveFirst();
	$selectLimit = $item_per_employee_list->UseSelectLimit;
	if (!$selectLimit && $item_per_employee_list->StartRecord > 1)
		$item_per_employee_list->Recordset->move($item_per_employee_list->StartRecord - 1);
} elseif (!$item_per_employee->AllowAddDeleteRow && $item_per_employee_list->StopRecord == 0) {
	$item_per_employee_list->StopRecord = $item_per_employee->GridAddRowCount;
}

// Initialize aggregate
$item_per_employee->RowType = ROWTYPE_AGGREGATEINIT;
$item_per_employee->resetAttributes();
$item_per_employee_list->renderRow();
while ($item_per_employee_list->RecordCount < $item_per_employee_list->StopRecord) {
	$item_per_employee_list->RecordCount++;
	if ($item_per_employee_list->RecordCount >= $item_per_employee_list->StartRecord) {
		$item_per_employee_list->RowCount++;

		// Set up key count
		$item_per_employee_list->KeyCount = $item_per_employee_list->RowIndex;

		// Init row class and style
		$item_per_employee->resetAttributes();
		$item_per_employee->CssClass = "";
		if ($item_per_employee_list->isGridAdd()) {
		} else {
			$item_per_employee_list->loadRowValues($item_per_employee_list->Recordset); // Load row values
		}
		$item_per_employee->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$item_per_employee->RowAttrs->merge(["data-rowindex" => $item_per_employee_list->RowCount, "id" => "r" . $item_per_employee_list->RowCount . "_item_per_employee", "data-rowtype" => $item_per_employee->RowType]);

		// Render row
		$item_per_employee_list->renderRow();

		// Render list options
		$item_per_employee_list->renderListOptions();
?>
	<tr <?php echo $item_per_employee->rowAttributes() ?>>
<?php

// Render list options (body, left)
$item_per_employee_list->ListOptions->render("body", "left", $item_per_employee_list->RowCount);
?>
	<?php if ($item_per_employee_list->inventory_id->Visible) { // inventory_id ?>
		<td data-name="inventory_id" <?php echo $item_per_employee_list->inventory_id->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_inventory_id">
<span<?php echo $item_per_employee_list->inventory_id->viewAttributes() ?>><?php echo $item_per_employee_list->inventory_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->cat_desc->Visible) { // cat_desc ?>
		<td data-name="cat_desc" <?php echo $item_per_employee_list->cat_desc->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_cat_desc">
<span<?php echo $item_per_employee_list->cat_desc->viewAttributes() ?>><?php echo $item_per_employee_list->cat_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $item_per_employee_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_item_model">
<span<?php echo $item_per_employee_list->item_model->viewAttributes() ?>><?php echo $item_per_employee_list->item_model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->item_serial->Visible) { // item_serial ?>
		<td data-name="item_serial" <?php echo $item_per_employee_list->item_serial->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_item_serial">
<span<?php echo $item_per_employee_list->item_serial->viewAttributes() ?>><?php echo $item_per_employee_list->item_serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->off_desc->Visible) { // off_desc ?>
		<td data-name="off_desc" <?php echo $item_per_employee_list->off_desc->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_off_desc">
<span<?php echo $item_per_employee_list->off_desc->viewAttributes() ?>><?php echo $item_per_employee_list->off_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->region_name->Visible) { // region_name ?>
		<td data-name="region_name" <?php echo $item_per_employee_list->region_name->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_region_name">
<span<?php echo $item_per_employee_list->region_name->viewAttributes() ?>><?php echo $item_per_employee_list->region_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->prov_name->Visible) { // prov_name ?>
		<td data-name="prov_name" <?php echo $item_per_employee_list->prov_name->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_prov_name">
<span<?php echo $item_per_employee_list->prov_name->viewAttributes() ?>><?php echo $item_per_employee_list->prov_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->city_name->Visible) { // city_name ?>
		<td data-name="city_name" <?php echo $item_per_employee_list->city_name->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_city_name">
<span<?php echo $item_per_employee_list->city_name->viewAttributes() ?>><?php echo $item_per_employee_list->city_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->pos_desc->Visible) { // pos_desc ?>
		<td data-name="pos_desc" <?php echo $item_per_employee_list->pos_desc->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_pos_desc">
<span<?php echo $item_per_employee_list->pos_desc->viewAttributes() ?>><?php echo $item_per_employee_list->pos_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->current_location->Visible) { // current_location ?>
		<td data-name="current_location" <?php echo $item_per_employee_list->current_location->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_current_location">
<span<?php echo $item_per_employee_list->current_location->viewAttributes() ?>><?php echo $item_per_employee_list->current_location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->Last_Date_Check->Visible) { // Last_Date_Check ?>
		<td data-name="Last_Date_Check" <?php echo $item_per_employee_list->Last_Date_Check->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_Last_Date_Check">
<span<?php echo $item_per_employee_list->Last_Date_Check->viewAttributes() ?>><?php echo $item_per_employee_list->Last_Date_Check->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $item_per_employee_list->Name_dsc->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_Name_dsc">
<span<?php echo $item_per_employee_list->Name_dsc->viewAttributes() ?>><?php echo $item_per_employee_list->Name_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
		<td data-name="inventory_status_dsc" <?php echo $item_per_employee_list->inventory_status_dsc->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_inventory_status_dsc">
<span<?php echo $item_per_employee_list->inventory_status_dsc->viewAttributes() ?>><?php echo $item_per_employee_list->inventory_status_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->remarks->Visible) { // remarks ?>
		<td data-name="remarks" <?php echo $item_per_employee_list->remarks->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_remarks">
<span<?php echo $item_per_employee_list->remarks->viewAttributes() ?>><?php echo $item_per_employee_list->remarks->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->year_dsc->Visible) { // year_dsc ?>
		<td data-name="year_dsc" <?php echo $item_per_employee_list->year_dsc->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_year_dsc">
<span<?php echo $item_per_employee_list->year_dsc->viewAttributes() ?>><?php echo $item_per_employee_list->year_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->name_accountable->Visible) { // name_accountable ?>
		<td data-name="name_accountable" <?php echo $item_per_employee_list->name_accountable->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_name_accountable">
<span<?php echo $item_per_employee_list->name_accountable->viewAttributes() ?>><?php echo $item_per_employee_list->name_accountable->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->last_name->Visible) { // last_name ?>
		<td data-name="last_name" <?php echo $item_per_employee_list->last_name->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_last_name">
<span<?php echo $item_per_employee_list->last_name->viewAttributes() ?>><?php echo $item_per_employee_list->last_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->first_name->Visible) { // first_name ?>
		<td data-name="first_name" <?php echo $item_per_employee_list->first_name->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_first_name">
<span<?php echo $item_per_employee_list->first_name->viewAttributes() ?>><?php echo $item_per_employee_list->first_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->mid_name->Visible) { // mid_name ?>
		<td data-name="mid_name" <?php echo $item_per_employee_list->mid_name->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_mid_name">
<span<?php echo $item_per_employee_list->mid_name->viewAttributes() ?>><?php echo $item_per_employee_list->mid_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->ext_name->Visible) { // ext_name ?>
		<td data-name="ext_name" <?php echo $item_per_employee_list->ext_name->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_ext_name">
<span<?php echo $item_per_employee_list->ext_name->viewAttributes() ?>><?php echo $item_per_employee_list->ext_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->namefull->Visible) { // namefull ?>
		<td data-name="namefull" <?php echo $item_per_employee_list->namefull->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_namefull">
<span<?php echo $item_per_employee_list->namefull->viewAttributes() ?>><?php echo $item_per_employee_list->namefull->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $item_per_employee_list->status->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_status">
<span<?php echo $item_per_employee_list->status->viewAttributes() ?>><?php echo $item_per_employee_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" <?php echo $item_per_employee_list->month_dsc->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_month_dsc">
<span<?php echo $item_per_employee_list->month_dsc->viewAttributes() ?>><?php echo $item_per_employee_list->month_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->full_name_tbl->Visible) { // full_name_tbl ?>
		<td data-name="full_name_tbl" <?php echo $item_per_employee_list->full_name_tbl->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_full_name_tbl">
<span<?php echo $item_per_employee_list->full_name_tbl->viewAttributes() ?>><?php echo $item_per_employee_list->full_name_tbl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->position->Visible) { // position ?>
		<td data-name="position" <?php echo $item_per_employee_list->position->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_position">
<span<?php echo $item_per_employee_list->position->viewAttributes() ?>><?php echo $item_per_employee_list->position->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->NameSig->Visible) { // NameSig ?>
		<td data-name="NameSig" <?php echo $item_per_employee_list->NameSig->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_NameSig">
<span<?php echo $item_per_employee_list->NameSig->viewAttributes() ?>><?php echo $item_per_employee_list->NameSig->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($item_per_employee_list->DesignationSig->Visible) { // DesignationSig ?>
		<td data-name="DesignationSig" <?php echo $item_per_employee_list->DesignationSig->cellAttributes() ?>>
<span id="el<?php echo $item_per_employee_list->RowCount ?>_item_per_employee_DesignationSig">
<span<?php echo $item_per_employee_list->DesignationSig->viewAttributes() ?>><?php echo $item_per_employee_list->DesignationSig->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$item_per_employee_list->ListOptions->render("body", "right", $item_per_employee_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$item_per_employee_list->isGridAdd())
		$item_per_employee_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$item_per_employee->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($item_per_employee_list->Recordset)
	$item_per_employee_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($item_per_employee_list->TotalRecords == 0 && !$item_per_employee->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $item_per_employee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$item_per_employee_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$item_per_employee_list->isExport()) { ?>
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
$item_per_employee_list->terminate();
?>