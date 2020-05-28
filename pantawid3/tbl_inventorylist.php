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
$tbl_inventory_list = new tbl_inventory_list();

// Run the page
$tbl_inventory_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_inventory_list->isExport()) { ?>
<script>
var ftbl_inventorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_inventorylist = currentForm = new ew.Form("ftbl_inventorylist", "list");
	ftbl_inventorylist.formKeyCountName = '<?php echo $tbl_inventory_list->FormKeyCountName ?>';
	loadjs.done("ftbl_inventorylist");
});
var ftbl_inventorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_inventorylistsrch = currentSearchForm = new ew.Form("ftbl_inventorylistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_inventorylistsrch.filterList = <?php echo $tbl_inventory_list->getFilterList() ?>;
	loadjs.done("ftbl_inventorylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_inventory_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_inventory_list->TotalRecords > 0 && $tbl_inventory_list->ExportOptions->visible()) { ?>
<?php $tbl_inventory_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_inventory_list->ImportOptions->visible()) { ?>
<?php $tbl_inventory_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_inventory_list->SearchOptions->visible()) { ?>
<?php $tbl_inventory_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_inventory_list->FilterOptions->visible()) { ?>
<?php $tbl_inventory_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_inventory_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_inventory_list->isExport() && !$tbl_inventory->CurrentAction) { ?>
<form name="ftbl_inventorylistsrch" id="ftbl_inventorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_inventorylistsrch-search-panel" class="<?php echo $tbl_inventory_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_inventory">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_inventory_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_inventory_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_inventory_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_inventory_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_inventory_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_inventory_list->showPageHeader(); ?>
<?php
$tbl_inventory_list->showMessage();
?>
<?php if ($tbl_inventory_list->TotalRecords > 0 || $tbl_inventory->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_inventory_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_inventory">
<?php if (!$tbl_inventory_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_inventory_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_inventory_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_inventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_inventorylist" id="ftbl_inventorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<div id="gmp_tbl_inventory" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_inventory_list->TotalRecords > 0 || $tbl_inventory_list->isGridEdit()) { ?>
<table id="tbl_tbl_inventorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_inventory->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_inventory_list->renderListOptions();

// Render list options (header, left)
$tbl_inventory_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_inventory_list->concat_inventory->Visible) { // concat_inventory ?>
	<?php if ($tbl_inventory_list->SortUrl($tbl_inventory_list->concat_inventory) == "") { ?>
		<th data-name="concat_inventory" class="<?php echo $tbl_inventory_list->concat_inventory->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_inventory_concat_inventory" class="tbl_inventory_concat_inventory"><div class="ew-table-header-caption"><?php echo $tbl_inventory_list->concat_inventory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="concat_inventory" class="<?php echo $tbl_inventory_list->concat_inventory->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_inventory_list->SortUrl($tbl_inventory_list->concat_inventory) ?>', 1);"><div id="elh_tbl_inventory_concat_inventory" class="tbl_inventory_concat_inventory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory_list->concat_inventory->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory_list->concat_inventory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_inventory_list->concat_inventory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory_list->item_model->Visible) { // item_model ?>
	<?php if ($tbl_inventory_list->SortUrl($tbl_inventory_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $tbl_inventory_list->item_model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_inventory_item_model" class="tbl_inventory_item_model"><div class="ew-table-header-caption"><?php echo $tbl_inventory_list->item_model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $tbl_inventory_list->item_model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_inventory_list->SortUrl($tbl_inventory_list->item_model) ?>', 1);"><div id="elh_tbl_inventory_item_model" class="tbl_inventory_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_inventory_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory_list->item_serial->Visible) { // item_serial ?>
	<?php if ($tbl_inventory_list->SortUrl($tbl_inventory_list->item_serial) == "") { ?>
		<th data-name="item_serial" class="<?php echo $tbl_inventory_list->item_serial->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_inventory_item_serial" class="tbl_inventory_item_serial"><div class="ew-table-header-caption"><?php echo $tbl_inventory_list->item_serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_serial" class="<?php echo $tbl_inventory_list->item_serial->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_inventory_list->SortUrl($tbl_inventory_list->item_serial) ?>', 1);"><div id="elh_tbl_inventory_item_serial" class="tbl_inventory_item_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory_list->item_serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory_list->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_inventory_list->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory_list->office_id->Visible) { // office_id ?>
	<?php if ($tbl_inventory_list->SortUrl($tbl_inventory_list->office_id) == "") { ?>
		<th data-name="office_id" class="<?php echo $tbl_inventory_list->office_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_inventory_office_id" class="tbl_inventory_office_id"><div class="ew-table-header-caption"><?php echo $tbl_inventory_list->office_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="office_id" class="<?php echo $tbl_inventory_list->office_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_inventory_list->SortUrl($tbl_inventory_list->office_id) ?>', 1);"><div id="elh_tbl_inventory_office_id" class="tbl_inventory_office_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory_list->office_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory_list->office_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_inventory_list->office_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory_list->name_accountable->Visible) { // name_accountable ?>
	<?php if ($tbl_inventory_list->SortUrl($tbl_inventory_list->name_accountable) == "") { ?>
		<th data-name="name_accountable" class="<?php echo $tbl_inventory_list->name_accountable->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_inventory_name_accountable" class="tbl_inventory_name_accountable"><div class="ew-table-header-caption"><?php echo $tbl_inventory_list->name_accountable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name_accountable" class="<?php echo $tbl_inventory_list->name_accountable->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_inventory_list->SortUrl($tbl_inventory_list->name_accountable) ?>', 1);"><div id="elh_tbl_inventory_name_accountable" class="tbl_inventory_name_accountable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory_list->name_accountable->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory_list->name_accountable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_inventory_list->name_accountable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory_list->Designation->Visible) { // Designation ?>
	<?php if ($tbl_inventory_list->SortUrl($tbl_inventory_list->Designation) == "") { ?>
		<th data-name="Designation" class="<?php echo $tbl_inventory_list->Designation->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_inventory_Designation" class="tbl_inventory_Designation"><div class="ew-table-header-caption"><?php echo $tbl_inventory_list->Designation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Designation" class="<?php echo $tbl_inventory_list->Designation->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_inventory_list->SortUrl($tbl_inventory_list->Designation) ?>', 1);"><div id="elh_tbl_inventory_Designation" class="tbl_inventory_Designation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory_list->Designation->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory_list->Designation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_inventory_list->Designation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_inventory_list->status->Visible) { // status ?>
	<?php if ($tbl_inventory_list->SortUrl($tbl_inventory_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $tbl_inventory_list->status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_inventory_status" class="tbl_inventory_status"><div class="ew-table-header-caption"><?php echo $tbl_inventory_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $tbl_inventory_list->status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_inventory_list->SortUrl($tbl_inventory_list->status) ?>', 1);"><div id="elh_tbl_inventory_status" class="tbl_inventory_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_inventory_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_inventory_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_inventory_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_inventory_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_inventory_list->ExportAll && $tbl_inventory_list->isExport()) {
	$tbl_inventory_list->StopRecord = $tbl_inventory_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_inventory_list->TotalRecords > $tbl_inventory_list->StartRecord + $tbl_inventory_list->DisplayRecords - 1)
		$tbl_inventory_list->StopRecord = $tbl_inventory_list->StartRecord + $tbl_inventory_list->DisplayRecords - 1;
	else
		$tbl_inventory_list->StopRecord = $tbl_inventory_list->TotalRecords;
}
$tbl_inventory_list->RecordCount = $tbl_inventory_list->StartRecord - 1;
if ($tbl_inventory_list->Recordset && !$tbl_inventory_list->Recordset->EOF) {
	$tbl_inventory_list->Recordset->moveFirst();
	$selectLimit = $tbl_inventory_list->UseSelectLimit;
	if (!$selectLimit && $tbl_inventory_list->StartRecord > 1)
		$tbl_inventory_list->Recordset->move($tbl_inventory_list->StartRecord - 1);
} elseif (!$tbl_inventory->AllowAddDeleteRow && $tbl_inventory_list->StopRecord == 0) {
	$tbl_inventory_list->StopRecord = $tbl_inventory->GridAddRowCount;
}

// Initialize aggregate
$tbl_inventory->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_inventory->resetAttributes();
$tbl_inventory_list->renderRow();
while ($tbl_inventory_list->RecordCount < $tbl_inventory_list->StopRecord) {
	$tbl_inventory_list->RecordCount++;
	if ($tbl_inventory_list->RecordCount >= $tbl_inventory_list->StartRecord) {
		$tbl_inventory_list->RowCount++;

		// Set up key count
		$tbl_inventory_list->KeyCount = $tbl_inventory_list->RowIndex;

		// Init row class and style
		$tbl_inventory->resetAttributes();
		$tbl_inventory->CssClass = "";
		if ($tbl_inventory_list->isGridAdd()) {
		} else {
			$tbl_inventory_list->loadRowValues($tbl_inventory_list->Recordset); // Load row values
		}
		$tbl_inventory->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_inventory->RowAttrs->merge(["data-rowindex" => $tbl_inventory_list->RowCount, "id" => "r" . $tbl_inventory_list->RowCount . "_tbl_inventory", "data-rowtype" => $tbl_inventory->RowType]);

		// Render row
		$tbl_inventory_list->renderRow();

		// Render list options
		$tbl_inventory_list->renderListOptions();
?>
	<tr <?php echo $tbl_inventory->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_inventory_list->ListOptions->render("body", "left", $tbl_inventory_list->RowCount);
?>
	<?php if ($tbl_inventory_list->concat_inventory->Visible) { // concat_inventory ?>
		<td data-name="concat_inventory" <?php echo $tbl_inventory_list->concat_inventory->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_list->RowCount ?>_tbl_inventory_concat_inventory">
<span<?php echo $tbl_inventory_list->concat_inventory->viewAttributes() ?>><?php if (!EmptyString($tbl_inventory_list->concat_inventory->getViewValue()) && $tbl_inventory_list->concat_inventory->linkAttributes() != "") { ?>
<a<?php echo $tbl_inventory_list->concat_inventory->linkAttributes() ?>><?php echo $tbl_inventory_list->concat_inventory->getViewValue() ?></a>
<?php } else { ?>
<?php echo $tbl_inventory_list->concat_inventory->getViewValue() ?>
<?php } ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_inventory_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $tbl_inventory_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_list->RowCount ?>_tbl_inventory_item_model">
<span<?php echo $tbl_inventory_list->item_model->viewAttributes() ?>><?php echo $tbl_inventory_list->item_model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_inventory_list->item_serial->Visible) { // item_serial ?>
		<td data-name="item_serial" <?php echo $tbl_inventory_list->item_serial->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_list->RowCount ?>_tbl_inventory_item_serial">
<span<?php echo $tbl_inventory_list->item_serial->viewAttributes() ?>><?php echo $tbl_inventory_list->item_serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_inventory_list->office_id->Visible) { // office_id ?>
		<td data-name="office_id" <?php echo $tbl_inventory_list->office_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_list->RowCount ?>_tbl_inventory_office_id">
<span<?php echo $tbl_inventory_list->office_id->viewAttributes() ?>><?php echo $tbl_inventory_list->office_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_inventory_list->name_accountable->Visible) { // name_accountable ?>
		<td data-name="name_accountable" <?php echo $tbl_inventory_list->name_accountable->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_list->RowCount ?>_tbl_inventory_name_accountable">
<span<?php echo $tbl_inventory_list->name_accountable->viewAttributes() ?>><?php echo $tbl_inventory_list->name_accountable->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_inventory_list->Designation->Visible) { // Designation ?>
		<td data-name="Designation" <?php echo $tbl_inventory_list->Designation->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_list->RowCount ?>_tbl_inventory_Designation">
<span<?php echo $tbl_inventory_list->Designation->viewAttributes() ?>><?php echo $tbl_inventory_list->Designation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_inventory_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $tbl_inventory_list->status->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_list->RowCount ?>_tbl_inventory_status">
<span<?php echo $tbl_inventory_list->status->viewAttributes() ?>><?php echo $tbl_inventory_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_inventory_list->ListOptions->render("body", "right", $tbl_inventory_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_inventory_list->isGridAdd())
		$tbl_inventory_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_inventory->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_inventory_list->Recordset)
	$tbl_inventory_list->Recordset->Close();
?>
<?php if (!$tbl_inventory_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_inventory_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_inventory_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_inventory_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_inventory_list->TotalRecords == 0 && !$tbl_inventory->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_inventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_inventory_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_inventory_list->isExport()) { ?>
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
$tbl_inventory_list->terminate();
?>