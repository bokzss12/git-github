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
$inventory_view_list = new inventory_view_list();

// Run the page
$inventory_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventory_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$inventory_view_list->isExport()) { ?>
<script>
var finventory_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	finventory_viewlist = currentForm = new ew.Form("finventory_viewlist", "list");
	finventory_viewlist.formKeyCountName = '<?php echo $inventory_view_list->FormKeyCountName ?>';
	loadjs.done("finventory_viewlist");
});
var finventory_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	finventory_viewlistsrch = currentSearchForm = new ew.Form("finventory_viewlistsrch");

	// Dynamic selection lists
	// Filters

	finventory_viewlistsrch.filterList = <?php echo $inventory_view_list->getFilterList() ?>;
	loadjs.done("finventory_viewlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$inventory_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inventory_view_list->TotalRecords > 0 && $inventory_view_list->ExportOptions->visible()) { ?>
<?php $inventory_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_view_list->ImportOptions->visible()) { ?>
<?php $inventory_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_view_list->SearchOptions->visible()) { ?>
<?php $inventory_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inventory_view_list->FilterOptions->visible()) { ?>
<?php $inventory_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inventory_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$inventory_view_list->isExport() && !$inventory_view->CurrentAction) { ?>
<form name="finventory_viewlistsrch" id="finventory_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="finventory_viewlistsrch-search-panel" class="<?php echo $inventory_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inventory_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $inventory_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($inventory_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($inventory_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inventory_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inventory_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inventory_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inventory_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inventory_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $inventory_view_list->showPageHeader(); ?>
<?php
$inventory_view_list->showMessage();
?>
<?php if ($inventory_view_list->TotalRecords > 0 || $inventory_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inventory_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inventory_view">
<?php if (!$inventory_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$inventory_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $inventory_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inventory_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="finventory_viewlist" id="finventory_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventory_view">
<div id="gmp_inventory_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($inventory_view_list->TotalRecords > 0 || $inventory_view_list->isGridEdit()) { ?>
<table id="tbl_inventory_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inventory_view->RowType = ROWTYPE_HEADER;

// Render list options
$inventory_view_list->renderListOptions();

// Render list options (header, left)
$inventory_view_list->ListOptions->render("header", "left");
?>
<?php if ($inventory_view_list->concat_inventory->Visible) { // concat_inventory ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->concat_inventory) == "") { ?>
		<th data-name="concat_inventory" class="<?php echo $inventory_view_list->concat_inventory->headerCellClass() ?>"><div id="elh_inventory_view_concat_inventory" class="inventory_view_concat_inventory"><div class="ew-table-header-caption"><?php echo $inventory_view_list->concat_inventory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="concat_inventory" class="<?php echo $inventory_view_list->concat_inventory->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->concat_inventory) ?>', 1);"><div id="elh_inventory_view_concat_inventory" class="inventory_view_concat_inventory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->concat_inventory->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->concat_inventory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->concat_inventory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->item_type->Visible) { // item_type ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->item_type) == "") { ?>
		<th data-name="item_type" class="<?php echo $inventory_view_list->item_type->headerCellClass() ?>"><div id="elh_inventory_view_item_type" class="inventory_view_item_type"><div class="ew-table-header-caption"><?php echo $inventory_view_list->item_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_type" class="<?php echo $inventory_view_list->item_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->item_type) ?>', 1);"><div id="elh_inventory_view_item_type" class="inventory_view_item_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->item_type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->item_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->item_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->item_model->Visible) { // item_model ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $inventory_view_list->item_model->headerCellClass() ?>"><div id="elh_inventory_view_item_model" class="inventory_view_item_model"><div class="ew-table-header-caption"><?php echo $inventory_view_list->item_model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $inventory_view_list->item_model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->item_model) ?>', 1);"><div id="elh_inventory_view_item_model" class="inventory_view_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->item_serial->Visible) { // item_serial ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->item_serial) == "") { ?>
		<th data-name="item_serial" class="<?php echo $inventory_view_list->item_serial->headerCellClass() ?>"><div id="elh_inventory_view_item_serial" class="inventory_view_item_serial"><div class="ew-table-header-caption"><?php echo $inventory_view_list->item_serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_serial" class="<?php echo $inventory_view_list->item_serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->item_serial) ?>', 1);"><div id="elh_inventory_view_item_serial" class="inventory_view_item_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->item_serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->office_id->Visible) { // office_id ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->office_id) == "") { ?>
		<th data-name="office_id" class="<?php echo $inventory_view_list->office_id->headerCellClass() ?>"><div id="elh_inventory_view_office_id" class="inventory_view_office_id"><div class="ew-table-header-caption"><?php echo $inventory_view_list->office_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="office_id" class="<?php echo $inventory_view_list->office_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->office_id) ?>', 1);"><div id="elh_inventory_view_office_id" class="inventory_view_office_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->office_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->office_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->office_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->name_accountable->Visible) { // name_accountable ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->name_accountable) == "") { ?>
		<th data-name="name_accountable" class="<?php echo $inventory_view_list->name_accountable->headerCellClass() ?>"><div id="elh_inventory_view_name_accountable" class="inventory_view_name_accountable"><div class="ew-table-header-caption"><?php echo $inventory_view_list->name_accountable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name_accountable" class="<?php echo $inventory_view_list->name_accountable->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->name_accountable) ?>', 1);"><div id="elh_inventory_view_name_accountable" class="inventory_view_name_accountable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->name_accountable->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->name_accountable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->name_accountable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->Designation->Visible) { // Designation ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->Designation) == "") { ?>
		<th data-name="Designation" class="<?php echo $inventory_view_list->Designation->headerCellClass() ?>"><div id="elh_inventory_view_Designation" class="inventory_view_Designation"><div class="ew-table-header-caption"><?php echo $inventory_view_list->Designation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Designation" class="<?php echo $inventory_view_list->Designation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->Designation) ?>', 1);"><div id="elh_inventory_view_Designation" class="inventory_view_Designation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->Designation->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->Designation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->Designation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->status->Visible) { // status ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $inventory_view_list->status->headerCellClass() ?>"><div id="elh_inventory_view_status" class="inventory_view_status"><div class="ew-table-header-caption"><?php echo $inventory_view_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $inventory_view_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->status) ?>', 1);"><div id="elh_inventory_view_status" class="inventory_view_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventory_view_list->pullout_date->Visible) { // pullout_date ?>
	<?php if ($inventory_view_list->SortUrl($inventory_view_list->pullout_date) == "") { ?>
		<th data-name="pullout_date" class="<?php echo $inventory_view_list->pullout_date->headerCellClass() ?>"><div id="elh_inventory_view_pullout_date" class="inventory_view_pullout_date"><div class="ew-table-header-caption"><?php echo $inventory_view_list->pullout_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pullout_date" class="<?php echo $inventory_view_list->pullout_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inventory_view_list->SortUrl($inventory_view_list->pullout_date) ?>', 1);"><div id="elh_inventory_view_pullout_date" class="inventory_view_pullout_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventory_view_list->pullout_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventory_view_list->pullout_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inventory_view_list->pullout_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inventory_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inventory_view_list->ExportAll && $inventory_view_list->isExport()) {
	$inventory_view_list->StopRecord = $inventory_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($inventory_view_list->TotalRecords > $inventory_view_list->StartRecord + $inventory_view_list->DisplayRecords - 1)
		$inventory_view_list->StopRecord = $inventory_view_list->StartRecord + $inventory_view_list->DisplayRecords - 1;
	else
		$inventory_view_list->StopRecord = $inventory_view_list->TotalRecords;
}
$inventory_view_list->RecordCount = $inventory_view_list->StartRecord - 1;
if ($inventory_view_list->Recordset && !$inventory_view_list->Recordset->EOF) {
	$inventory_view_list->Recordset->moveFirst();
	$selectLimit = $inventory_view_list->UseSelectLimit;
	if (!$selectLimit && $inventory_view_list->StartRecord > 1)
		$inventory_view_list->Recordset->move($inventory_view_list->StartRecord - 1);
} elseif (!$inventory_view->AllowAddDeleteRow && $inventory_view_list->StopRecord == 0) {
	$inventory_view_list->StopRecord = $inventory_view->GridAddRowCount;
}

// Initialize aggregate
$inventory_view->RowType = ROWTYPE_AGGREGATEINIT;
$inventory_view->resetAttributes();
$inventory_view_list->renderRow();
while ($inventory_view_list->RecordCount < $inventory_view_list->StopRecord) {
	$inventory_view_list->RecordCount++;
	if ($inventory_view_list->RecordCount >= $inventory_view_list->StartRecord) {
		$inventory_view_list->RowCount++;

		// Set up key count
		$inventory_view_list->KeyCount = $inventory_view_list->RowIndex;

		// Init row class and style
		$inventory_view->resetAttributes();
		$inventory_view->CssClass = "";
		if ($inventory_view_list->isGridAdd()) {
		} else {
			$inventory_view_list->loadRowValues($inventory_view_list->Recordset); // Load row values
		}
		$inventory_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inventory_view->RowAttrs->merge(["data-rowindex" => $inventory_view_list->RowCount, "id" => "r" . $inventory_view_list->RowCount . "_inventory_view", "data-rowtype" => $inventory_view->RowType]);

		// Render row
		$inventory_view_list->renderRow();

		// Render list options
		$inventory_view_list->renderListOptions();
?>
	<tr <?php echo $inventory_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inventory_view_list->ListOptions->render("body", "left", $inventory_view_list->RowCount);
?>
	<?php if ($inventory_view_list->concat_inventory->Visible) { // concat_inventory ?>
		<td data-name="concat_inventory" <?php echo $inventory_view_list->concat_inventory->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_concat_inventory">
<span<?php echo $inventory_view_list->concat_inventory->viewAttributes() ?>><?php echo $inventory_view_list->concat_inventory->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->item_type->Visible) { // item_type ?>
		<td data-name="item_type" <?php echo $inventory_view_list->item_type->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_item_type">
<span<?php echo $inventory_view_list->item_type->viewAttributes() ?>><?php echo $inventory_view_list->item_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $inventory_view_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_item_model">
<span<?php echo $inventory_view_list->item_model->viewAttributes() ?>><?php echo $inventory_view_list->item_model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->item_serial->Visible) { // item_serial ?>
		<td data-name="item_serial" <?php echo $inventory_view_list->item_serial->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_item_serial">
<span<?php echo $inventory_view_list->item_serial->viewAttributes() ?>><?php echo $inventory_view_list->item_serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->office_id->Visible) { // office_id ?>
		<td data-name="office_id" <?php echo $inventory_view_list->office_id->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_office_id">
<span<?php echo $inventory_view_list->office_id->viewAttributes() ?>><?php echo $inventory_view_list->office_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->name_accountable->Visible) { // name_accountable ?>
		<td data-name="name_accountable" <?php echo $inventory_view_list->name_accountable->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_name_accountable">
<span<?php echo $inventory_view_list->name_accountable->viewAttributes() ?>><?php echo $inventory_view_list->name_accountable->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->Designation->Visible) { // Designation ?>
		<td data-name="Designation" <?php echo $inventory_view_list->Designation->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_Designation">
<span<?php echo $inventory_view_list->Designation->viewAttributes() ?>><?php echo $inventory_view_list->Designation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $inventory_view_list->status->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_status">
<span<?php echo $inventory_view_list->status->viewAttributes() ?>><?php echo $inventory_view_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventory_view_list->pullout_date->Visible) { // pullout_date ?>
		<td data-name="pullout_date" <?php echo $inventory_view_list->pullout_date->cellAttributes() ?>>
<span id="el<?php echo $inventory_view_list->RowCount ?>_inventory_view_pullout_date">
<span<?php echo $inventory_view_list->pullout_date->viewAttributes() ?>><?php echo $inventory_view_list->pullout_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inventory_view_list->ListOptions->render("body", "right", $inventory_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$inventory_view_list->isGridAdd())
		$inventory_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$inventory_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inventory_view_list->Recordset)
	$inventory_view_list->Recordset->Close();
?>
<?php if (!$inventory_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inventory_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $inventory_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inventory_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inventory_view_list->TotalRecords == 0 && !$inventory_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inventory_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inventory_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$inventory_view_list->isExport()) { ?>
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
$inventory_view_list->terminate();
?>