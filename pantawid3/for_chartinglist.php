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
$for_charting_list = new for_charting_list();

// Run the page
$for_charting_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$for_charting_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$for_charting_list->isExport()) { ?>
<script>
var ffor_chartinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ffor_chartinglist = currentForm = new ew.Form("ffor_chartinglist", "list");
	ffor_chartinglist.formKeyCountName = '<?php echo $for_charting_list->FormKeyCountName ?>';
	loadjs.done("ffor_chartinglist");
});
var ffor_chartinglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ffor_chartinglistsrch = currentSearchForm = new ew.Form("ffor_chartinglistsrch");

	// Dynamic selection lists
	// Filters

	ffor_chartinglistsrch.filterList = <?php echo $for_charting_list->getFilterList() ?>;
	loadjs.done("ffor_chartinglistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$for_charting_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($for_charting_list->TotalRecords > 0 && $for_charting_list->ExportOptions->visible()) { ?>
<?php $for_charting_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($for_charting_list->ImportOptions->visible()) { ?>
<?php $for_charting_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($for_charting_list->SearchOptions->visible()) { ?>
<?php $for_charting_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($for_charting_list->FilterOptions->visible()) { ?>
<?php $for_charting_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$for_charting_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$for_charting_list->isExport() && !$for_charting->CurrentAction) { ?>
<form name="ffor_chartinglistsrch" id="ffor_chartinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ffor_chartinglistsrch-search-panel" class="<?php echo $for_charting_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="for_charting">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $for_charting_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($for_charting_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($for_charting_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $for_charting_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($for_charting_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($for_charting_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($for_charting_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($for_charting_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $for_charting_list->showPageHeader(); ?>
<?php
$for_charting_list->showMessage();
?>
<?php if ($for_charting_list->TotalRecords > 0 || $for_charting->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($for_charting_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> for_charting">
<form name="ffor_chartinglist" id="ffor_chartinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="for_charting">
<div id="gmp_for_charting" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($for_charting_list->TotalRecords > 0 || $for_charting_list->isGridEdit()) { ?>
<table id="tbl_for_chartinglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$for_charting->RowType = ROWTYPE_HEADER;

// Render list options
$for_charting_list->renderListOptions();

// Render list options (header, left)
$for_charting_list->ListOptions->render("header", "left");
?>
<?php if ($for_charting_list->item_id->Visible) { // item_id ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->item_id) == "") { ?>
		<th data-name="item_id" class="<?php echo $for_charting_list->item_id->headerCellClass() ?>"><div id="elh_for_charting_item_id" class="for_charting_item_id"><div class="ew-table-header-caption"><?php echo $for_charting_list->item_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_id" class="<?php echo $for_charting_list->item_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->item_id) ?>', 1);"><div id="elh_for_charting_item_id" class="for_charting_item_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->item_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->item_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->item_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->month->Visible) { // month ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->month) == "") { ?>
		<th data-name="month" class="<?php echo $for_charting_list->month->headerCellClass() ?>"><div id="elh_for_charting_month" class="for_charting_month"><div class="ew-table-header-caption"><?php echo $for_charting_list->month->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="month" class="<?php echo $for_charting_list->month->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->month) ?>', 1);"><div id="elh_for_charting_month" class="for_charting_month">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->month->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->month->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->month->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->Year->Visible) { // Year ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $for_charting_list->Year->headerCellClass() ?>"><div id="elh_for_charting_Year" class="for_charting_Year"><div class="ew-table-header-caption"><?php echo $for_charting_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $for_charting_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->Year) ?>', 1);"><div id="elh_for_charting_Year" class="for_charting_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->item_date_receive->Visible) { // item_date_receive ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->item_date_receive) == "") { ?>
		<th data-name="item_date_receive" class="<?php echo $for_charting_list->item_date_receive->headerCellClass() ?>"><div id="elh_for_charting_item_date_receive" class="for_charting_item_date_receive"><div class="ew-table-header-caption"><?php echo $for_charting_list->item_date_receive->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_receive" class="<?php echo $for_charting_list->item_date_receive->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->item_date_receive) ?>', 1);"><div id="elh_for_charting_item_date_receive" class="for_charting_item_date_receive">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->item_date_receive->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->item_date_receive->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->item_date_receive->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->item_date_repaired->Visible) { // item_date_repaired ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->item_date_repaired) == "") { ?>
		<th data-name="item_date_repaired" class="<?php echo $for_charting_list->item_date_repaired->headerCellClass() ?>"><div id="elh_for_charting_item_date_repaired" class="for_charting_item_date_repaired"><div class="ew-table-header-caption"><?php echo $for_charting_list->item_date_repaired->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_repaired" class="<?php echo $for_charting_list->item_date_repaired->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->item_date_repaired) ?>', 1);"><div id="elh_for_charting_item_date_repaired" class="for_charting_item_date_repaired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->item_date_repaired->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->item_date_repaired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->item_date_repaired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->item_date_pullout->Visible) { // item_date_pullout ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->item_date_pullout) == "") { ?>
		<th data-name="item_date_pullout" class="<?php echo $for_charting_list->item_date_pullout->headerCellClass() ?>"><div id="elh_for_charting_item_date_pullout" class="for_charting_item_date_pullout"><div class="ew-table-header-caption"><?php echo $for_charting_list->item_date_pullout->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_pullout" class="<?php echo $for_charting_list->item_date_pullout->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->item_date_pullout) ?>', 1);"><div id="elh_for_charting_item_date_pullout" class="for_charting_item_date_pullout">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->item_date_pullout->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->item_date_pullout->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->item_date_pullout->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->off_desc->Visible) { // off_desc ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->off_desc) == "") { ?>
		<th data-name="off_desc" class="<?php echo $for_charting_list->off_desc->headerCellClass() ?>"><div id="elh_for_charting_off_desc" class="for_charting_off_desc"><div class="ew-table-header-caption"><?php echo $for_charting_list->off_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off_desc" class="<?php echo $for_charting_list->off_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->off_desc) ?>', 1);"><div id="elh_for_charting_off_desc" class="for_charting_off_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->off_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->item_transmittal->Visible) { // item_transmittal ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->item_transmittal) == "") { ?>
		<th data-name="item_transmittal" class="<?php echo $for_charting_list->item_transmittal->headerCellClass() ?>"><div id="elh_for_charting_item_transmittal" class="for_charting_item_transmittal"><div class="ew-table-header-caption"><?php echo $for_charting_list->item_transmittal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_transmittal" class="<?php echo $for_charting_list->item_transmittal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->item_transmittal) ?>', 1);"><div id="elh_for_charting_item_transmittal" class="for_charting_item_transmittal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->item_transmittal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->item_transmittal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->item_transmittal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->item_model->Visible) { // item_model ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $for_charting_list->item_model->headerCellClass() ?>"><div id="elh_for_charting_item_model" class="for_charting_item_model"><div class="ew-table-header-caption"><?php echo $for_charting_list->item_model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $for_charting_list->item_model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->item_model) ?>', 1);"><div id="elh_for_charting_item_model" class="for_charting_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->item_serno->Visible) { // item_serno ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->item_serno) == "") { ?>
		<th data-name="item_serno" class="<?php echo $for_charting_list->item_serno->headerCellClass() ?>"><div id="elh_for_charting_item_serno" class="for_charting_item_serno"><div class="ew-table-header-caption"><?php echo $for_charting_list->item_serno->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_serno" class="<?php echo $for_charting_list->item_serno->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->item_serno) ?>', 1);"><div id="elh_for_charting_item_serno" class="for_charting_item_serno">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->item_serno->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->item_serno->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->item_serno->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->__Request->Visible) { // Request ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->__Request) == "") { ?>
		<th data-name="__Request" class="<?php echo $for_charting_list->__Request->headerCellClass() ?>"><div id="elh_for_charting___Request" class="for_charting___Request"><div class="ew-table-header-caption"><?php echo $for_charting_list->__Request->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="__Request" class="<?php echo $for_charting_list->__Request->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->__Request) ?>', 1);"><div id="elh_for_charting___Request" class="for_charting___Request">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->__Request->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->__Request->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->__Request->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->employeeid->Visible) { // employeeid ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $for_charting_list->employeeid->headerCellClass() ?>"><div id="elh_for_charting_employeeid" class="for_charting_employeeid"><div class="ew-table-header-caption"><?php echo $for_charting_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $for_charting_list->employeeid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->employeeid) ?>', 1);"><div id="elh_for_charting_employeeid" class="for_charting_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->region_name->Visible) { // region_name ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->region_name) == "") { ?>
		<th data-name="region_name" class="<?php echo $for_charting_list->region_name->headerCellClass() ?>"><div id="elh_for_charting_region_name" class="for_charting_region_name"><div class="ew-table-header-caption"><?php echo $for_charting_list->region_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_name" class="<?php echo $for_charting_list->region_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->region_name) ?>', 1);"><div id="elh_for_charting_region_name" class="for_charting_region_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->region_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->region_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->region_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->prov_name->Visible) { // prov_name ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->prov_name) == "") { ?>
		<th data-name="prov_name" class="<?php echo $for_charting_list->prov_name->headerCellClass() ?>"><div id="elh_for_charting_prov_name" class="for_charting_prov_name"><div class="ew-table-header-caption"><?php echo $for_charting_list->prov_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prov_name" class="<?php echo $for_charting_list->prov_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->prov_name) ?>', 1);"><div id="elh_for_charting_prov_name" class="for_charting_prov_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->prov_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->prov_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->prov_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->city_name->Visible) { // city_name ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->city_name) == "") { ?>
		<th data-name="city_name" class="<?php echo $for_charting_list->city_name->headerCellClass() ?>"><div id="elh_for_charting_city_name" class="for_charting_city_name"><div class="ew-table-header-caption"><?php echo $for_charting_list->city_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_name" class="<?php echo $for_charting_list->city_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->city_name) ?>', 1);"><div id="elh_for_charting_city_name" class="for_charting_city_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->city_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->city_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->city_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->technician_dsc->Visible) { // technician_dsc ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->technician_dsc) == "") { ?>
		<th data-name="technician_dsc" class="<?php echo $for_charting_list->technician_dsc->headerCellClass() ?>"><div id="elh_for_charting_technician_dsc" class="for_charting_technician_dsc"><div class="ew-table-header-caption"><?php echo $for_charting_list->technician_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="technician_dsc" class="<?php echo $for_charting_list->technician_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->technician_dsc) ?>', 1);"><div id="elh_for_charting_technician_dsc" class="for_charting_technician_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->technician_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->technician_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->technician_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->status_desc->Visible) { // status_desc ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->status_desc) == "") { ?>
		<th data-name="status_desc" class="<?php echo $for_charting_list->status_desc->headerCellClass() ?>"><div id="elh_for_charting_status_desc" class="for_charting_status_desc"><div class="ew-table-header-caption"><?php echo $for_charting_list->status_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_desc" class="<?php echo $for_charting_list->status_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->status_desc) ?>', 1);"><div id="elh_for_charting_status_desc" class="for_charting_status_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->status_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->status_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->status_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($for_charting_list->cat_desc->Visible) { // cat_desc ?>
	<?php if ($for_charting_list->SortUrl($for_charting_list->cat_desc) == "") { ?>
		<th data-name="cat_desc" class="<?php echo $for_charting_list->cat_desc->headerCellClass() ?>"><div id="elh_for_charting_cat_desc" class="for_charting_cat_desc"><div class="ew-table-header-caption"><?php echo $for_charting_list->cat_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cat_desc" class="<?php echo $for_charting_list->cat_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $for_charting_list->SortUrl($for_charting_list->cat_desc) ?>', 1);"><div id="elh_for_charting_cat_desc" class="for_charting_cat_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $for_charting_list->cat_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($for_charting_list->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($for_charting_list->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$for_charting_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($for_charting_list->ExportAll && $for_charting_list->isExport()) {
	$for_charting_list->StopRecord = $for_charting_list->TotalRecords;
} else {

	// Set the last record to display
	if ($for_charting_list->TotalRecords > $for_charting_list->StartRecord + $for_charting_list->DisplayRecords - 1)
		$for_charting_list->StopRecord = $for_charting_list->StartRecord + $for_charting_list->DisplayRecords - 1;
	else
		$for_charting_list->StopRecord = $for_charting_list->TotalRecords;
}
$for_charting_list->RecordCount = $for_charting_list->StartRecord - 1;
if ($for_charting_list->Recordset && !$for_charting_list->Recordset->EOF) {
	$for_charting_list->Recordset->moveFirst();
	$selectLimit = $for_charting_list->UseSelectLimit;
	if (!$selectLimit && $for_charting_list->StartRecord > 1)
		$for_charting_list->Recordset->move($for_charting_list->StartRecord - 1);
} elseif (!$for_charting->AllowAddDeleteRow && $for_charting_list->StopRecord == 0) {
	$for_charting_list->StopRecord = $for_charting->GridAddRowCount;
}

// Initialize aggregate
$for_charting->RowType = ROWTYPE_AGGREGATEINIT;
$for_charting->resetAttributes();
$for_charting_list->renderRow();
while ($for_charting_list->RecordCount < $for_charting_list->StopRecord) {
	$for_charting_list->RecordCount++;
	if ($for_charting_list->RecordCount >= $for_charting_list->StartRecord) {
		$for_charting_list->RowCount++;

		// Set up key count
		$for_charting_list->KeyCount = $for_charting_list->RowIndex;

		// Init row class and style
		$for_charting->resetAttributes();
		$for_charting->CssClass = "";
		if ($for_charting_list->isGridAdd()) {
		} else {
			$for_charting_list->loadRowValues($for_charting_list->Recordset); // Load row values
		}
		$for_charting->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$for_charting->RowAttrs->merge(["data-rowindex" => $for_charting_list->RowCount, "id" => "r" . $for_charting_list->RowCount . "_for_charting", "data-rowtype" => $for_charting->RowType]);

		// Render row
		$for_charting_list->renderRow();

		// Render list options
		$for_charting_list->renderListOptions();
?>
	<tr <?php echo $for_charting->rowAttributes() ?>>
<?php

// Render list options (body, left)
$for_charting_list->ListOptions->render("body", "left", $for_charting_list->RowCount);
?>
	<?php if ($for_charting_list->item_id->Visible) { // item_id ?>
		<td data-name="item_id" <?php echo $for_charting_list->item_id->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_item_id">
<span<?php echo $for_charting_list->item_id->viewAttributes() ?>><?php echo $for_charting_list->item_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->month->Visible) { // month ?>
		<td data-name="month" <?php echo $for_charting_list->month->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_month">
<span<?php echo $for_charting_list->month->viewAttributes() ?>><?php echo $for_charting_list->month->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $for_charting_list->Year->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_Year">
<span<?php echo $for_charting_list->Year->viewAttributes() ?>><?php echo $for_charting_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->item_date_receive->Visible) { // item_date_receive ?>
		<td data-name="item_date_receive" <?php echo $for_charting_list->item_date_receive->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_item_date_receive">
<span<?php echo $for_charting_list->item_date_receive->viewAttributes() ?>><?php echo $for_charting_list->item_date_receive->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->item_date_repaired->Visible) { // item_date_repaired ?>
		<td data-name="item_date_repaired" <?php echo $for_charting_list->item_date_repaired->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_item_date_repaired">
<span<?php echo $for_charting_list->item_date_repaired->viewAttributes() ?>><?php echo $for_charting_list->item_date_repaired->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->item_date_pullout->Visible) { // item_date_pullout ?>
		<td data-name="item_date_pullout" <?php echo $for_charting_list->item_date_pullout->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_item_date_pullout">
<span<?php echo $for_charting_list->item_date_pullout->viewAttributes() ?>><?php echo $for_charting_list->item_date_pullout->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->off_desc->Visible) { // off_desc ?>
		<td data-name="off_desc" <?php echo $for_charting_list->off_desc->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_off_desc">
<span<?php echo $for_charting_list->off_desc->viewAttributes() ?>><?php echo $for_charting_list->off_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->item_transmittal->Visible) { // item_transmittal ?>
		<td data-name="item_transmittal" <?php echo $for_charting_list->item_transmittal->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_item_transmittal">
<span<?php echo $for_charting_list->item_transmittal->viewAttributes() ?>><?php echo $for_charting_list->item_transmittal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $for_charting_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_item_model">
<span<?php echo $for_charting_list->item_model->viewAttributes() ?>><?php echo $for_charting_list->item_model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->item_serno->Visible) { // item_serno ?>
		<td data-name="item_serno" <?php echo $for_charting_list->item_serno->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_item_serno">
<span<?php echo $for_charting_list->item_serno->viewAttributes() ?>><?php echo $for_charting_list->item_serno->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->__Request->Visible) { // Request ?>
		<td data-name="__Request" <?php echo $for_charting_list->__Request->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting___Request">
<span<?php echo $for_charting_list->__Request->viewAttributes() ?>><?php echo $for_charting_list->__Request->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $for_charting_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_employeeid">
<span<?php echo $for_charting_list->employeeid->viewAttributes() ?>><?php echo $for_charting_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->region_name->Visible) { // region_name ?>
		<td data-name="region_name" <?php echo $for_charting_list->region_name->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_region_name">
<span<?php echo $for_charting_list->region_name->viewAttributes() ?>><?php echo $for_charting_list->region_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->prov_name->Visible) { // prov_name ?>
		<td data-name="prov_name" <?php echo $for_charting_list->prov_name->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_prov_name">
<span<?php echo $for_charting_list->prov_name->viewAttributes() ?>><?php echo $for_charting_list->prov_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->city_name->Visible) { // city_name ?>
		<td data-name="city_name" <?php echo $for_charting_list->city_name->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_city_name">
<span<?php echo $for_charting_list->city_name->viewAttributes() ?>><?php echo $for_charting_list->city_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->technician_dsc->Visible) { // technician_dsc ?>
		<td data-name="technician_dsc" <?php echo $for_charting_list->technician_dsc->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_technician_dsc">
<span<?php echo $for_charting_list->technician_dsc->viewAttributes() ?>><?php echo $for_charting_list->technician_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->status_desc->Visible) { // status_desc ?>
		<td data-name="status_desc" <?php echo $for_charting_list->status_desc->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_status_desc">
<span<?php echo $for_charting_list->status_desc->viewAttributes() ?>><?php echo $for_charting_list->status_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($for_charting_list->cat_desc->Visible) { // cat_desc ?>
		<td data-name="cat_desc" <?php echo $for_charting_list->cat_desc->cellAttributes() ?>>
<span id="el<?php echo $for_charting_list->RowCount ?>_for_charting_cat_desc">
<span<?php echo $for_charting_list->cat_desc->viewAttributes() ?>><?php echo $for_charting_list->cat_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$for_charting_list->ListOptions->render("body", "right", $for_charting_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$for_charting_list->isGridAdd())
		$for_charting_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$for_charting->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($for_charting_list->Recordset)
	$for_charting_list->Recordset->Close();
?>
<?php if (!$for_charting_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $for_charting_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($for_charting_list->TotalRecords == 0 && !$for_charting->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $for_charting_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$for_charting_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$for_charting_list->isExport()) { ?>
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
$for_charting_list->terminate();
?>