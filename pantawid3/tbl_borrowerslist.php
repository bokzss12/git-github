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
$tbl_borrowers_list = new tbl_borrowers_list();

// Run the page
$tbl_borrowers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_borrowers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_borrowers_list->isExport()) { ?>
<script>
var ftbl_borrowerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_borrowerslist = currentForm = new ew.Form("ftbl_borrowerslist", "list");
	ftbl_borrowerslist.formKeyCountName = '<?php echo $tbl_borrowers_list->FormKeyCountName ?>';
	loadjs.done("ftbl_borrowerslist");
});
var ftbl_borrowerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_borrowerslistsrch = currentSearchForm = new ew.Form("ftbl_borrowerslistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_borrowerslistsrch.filterList = <?php echo $tbl_borrowers_list->getFilterList() ?>;
	loadjs.done("ftbl_borrowerslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_borrowers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_borrowers_list->TotalRecords > 0 && $tbl_borrowers_list->ExportOptions->visible()) { ?>
<?php $tbl_borrowers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_borrowers_list->ImportOptions->visible()) { ?>
<?php $tbl_borrowers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_borrowers_list->SearchOptions->visible()) { ?>
<?php $tbl_borrowers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_borrowers_list->FilterOptions->visible()) { ?>
<?php $tbl_borrowers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_borrowers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_borrowers_list->isExport() && !$tbl_borrowers->CurrentAction) { ?>
<form name="ftbl_borrowerslistsrch" id="ftbl_borrowerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_borrowerslistsrch-search-panel" class="<?php echo $tbl_borrowers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_borrowers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_borrowers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_borrowers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_borrowers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_borrowers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_borrowers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_borrowers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_borrowers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_borrowers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_borrowers_list->showPageHeader(); ?>
<?php
$tbl_borrowers_list->showMessage();
?>
<?php if ($tbl_borrowers_list->TotalRecords > 0 || $tbl_borrowers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_borrowers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_borrowers">
<?php if (!$tbl_borrowers_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_borrowers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_borrowers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_borrowers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_borrowerslist" id="ftbl_borrowerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_borrowers">
<div id="gmp_tbl_borrowers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_borrowers_list->TotalRecords > 0 || $tbl_borrowers_list->isGridEdit()) { ?>
<table id="tbl_tbl_borrowerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_borrowers->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_borrowers_list->renderListOptions();

// Render list options (header, left)
$tbl_borrowers_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_borrowers_list->Date_Barrowed->Visible) { // Date_Barrowed ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->Date_Barrowed) == "") { ?>
		<th data-name="Date_Barrowed" class="<?php echo $tbl_borrowers_list->Date_Barrowed->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_Date_Barrowed" class="tbl_borrowers_Date_Barrowed"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->Date_Barrowed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date_Barrowed" class="<?php echo $tbl_borrowers_list->Date_Barrowed->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->Date_Barrowed) ?>', 1);"><div id="elh_tbl_borrowers_Date_Barrowed" class="tbl_borrowers_Date_Barrowed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->Date_Barrowed->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->Date_Barrowed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->Date_Barrowed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->Date_Returned->Visible) { // Date_Returned ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->Date_Returned) == "") { ?>
		<th data-name="Date_Returned" class="<?php echo $tbl_borrowers_list->Date_Returned->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_Date_Returned" class="tbl_borrowers_Date_Returned"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->Date_Returned->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date_Returned" class="<?php echo $tbl_borrowers_list->Date_Returned->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->Date_Returned) ?>', 1);"><div id="elh_tbl_borrowers_Date_Returned" class="tbl_borrowers_Date_Returned">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->Date_Returned->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->Date_Returned->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->Date_Returned->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->item_type->Visible) { // item_type ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->item_type) == "") { ?>
		<th data-name="item_type" class="<?php echo $tbl_borrowers_list->item_type->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_item_type" class="tbl_borrowers_item_type"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->item_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_type" class="<?php echo $tbl_borrowers_list->item_type->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->item_type) ?>', 1);"><div id="elh_tbl_borrowers_item_type" class="tbl_borrowers_item_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->item_type->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->item_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->item_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->item_model->Visible) { // item_model ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $tbl_borrowers_list->item_model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_item_model" class="tbl_borrowers_item_model"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->item_model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $tbl_borrowers_list->item_model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->item_model) ?>', 1);"><div id="elh_tbl_borrowers_item_model" class="tbl_borrowers_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->item_serial->Visible) { // item_serial ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->item_serial) == "") { ?>
		<th data-name="item_serial" class="<?php echo $tbl_borrowers_list->item_serial->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_item_serial" class="tbl_borrowers_item_serial"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->item_serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_serial" class="<?php echo $tbl_borrowers_list->item_serial->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->item_serial) ?>', 1);"><div id="elh_tbl_borrowers_item_serial" class="tbl_borrowers_item_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->item_serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->name_barrowers->Visible) { // name_barrowers ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->name_barrowers) == "") { ?>
		<th data-name="name_barrowers" class="<?php echo $tbl_borrowers_list->name_barrowers->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_name_barrowers" class="tbl_borrowers_name_barrowers"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->name_barrowers->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name_barrowers" class="<?php echo $tbl_borrowers_list->name_barrowers->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->name_barrowers) ?>', 1);"><div id="elh_tbl_borrowers_name_barrowers" class="tbl_borrowers_name_barrowers">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->name_barrowers->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->name_barrowers->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->name_barrowers->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->Designation->Visible) { // Designation ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->Designation) == "") { ?>
		<th data-name="Designation" class="<?php echo $tbl_borrowers_list->Designation->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_Designation" class="tbl_borrowers_Designation"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->Designation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Designation" class="<?php echo $tbl_borrowers_list->Designation->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->Designation) ?>', 1);"><div id="elh_tbl_borrowers_Designation" class="tbl_borrowers_Designation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->Designation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->Designation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->Designation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->office_id->Visible) { // office_id ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->office_id) == "") { ?>
		<th data-name="office_id" class="<?php echo $tbl_borrowers_list->office_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_office_id" class="tbl_borrowers_office_id"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->office_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="office_id" class="<?php echo $tbl_borrowers_list->office_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->office_id) ?>', 1);"><div id="elh_tbl_borrowers_office_id" class="tbl_borrowers_office_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->office_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->office_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->office_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_borrowers_list->status->Visible) { // status ?>
	<?php if ($tbl_borrowers_list->SortUrl($tbl_borrowers_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $tbl_borrowers_list->status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_borrowers_status" class="tbl_borrowers_status"><div class="ew-table-header-caption"><?php echo $tbl_borrowers_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $tbl_borrowers_list->status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_borrowers_list->SortUrl($tbl_borrowers_list->status) ?>', 1);"><div id="elh_tbl_borrowers_status" class="tbl_borrowers_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_borrowers_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_borrowers_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_borrowers_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_borrowers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_borrowers_list->ExportAll && $tbl_borrowers_list->isExport()) {
	$tbl_borrowers_list->StopRecord = $tbl_borrowers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_borrowers_list->TotalRecords > $tbl_borrowers_list->StartRecord + $tbl_borrowers_list->DisplayRecords - 1)
		$tbl_borrowers_list->StopRecord = $tbl_borrowers_list->StartRecord + $tbl_borrowers_list->DisplayRecords - 1;
	else
		$tbl_borrowers_list->StopRecord = $tbl_borrowers_list->TotalRecords;
}
$tbl_borrowers_list->RecordCount = $tbl_borrowers_list->StartRecord - 1;
if ($tbl_borrowers_list->Recordset && !$tbl_borrowers_list->Recordset->EOF) {
	$tbl_borrowers_list->Recordset->moveFirst();
	$selectLimit = $tbl_borrowers_list->UseSelectLimit;
	if (!$selectLimit && $tbl_borrowers_list->StartRecord > 1)
		$tbl_borrowers_list->Recordset->move($tbl_borrowers_list->StartRecord - 1);
} elseif (!$tbl_borrowers->AllowAddDeleteRow && $tbl_borrowers_list->StopRecord == 0) {
	$tbl_borrowers_list->StopRecord = $tbl_borrowers->GridAddRowCount;
}

// Initialize aggregate
$tbl_borrowers->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_borrowers->resetAttributes();
$tbl_borrowers_list->renderRow();
while ($tbl_borrowers_list->RecordCount < $tbl_borrowers_list->StopRecord) {
	$tbl_borrowers_list->RecordCount++;
	if ($tbl_borrowers_list->RecordCount >= $tbl_borrowers_list->StartRecord) {
		$tbl_borrowers_list->RowCount++;

		// Set up key count
		$tbl_borrowers_list->KeyCount = $tbl_borrowers_list->RowIndex;

		// Init row class and style
		$tbl_borrowers->resetAttributes();
		$tbl_borrowers->CssClass = "";
		if ($tbl_borrowers_list->isGridAdd()) {
		} else {
			$tbl_borrowers_list->loadRowValues($tbl_borrowers_list->Recordset); // Load row values
		}
		$tbl_borrowers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_borrowers->RowAttrs->merge(["data-rowindex" => $tbl_borrowers_list->RowCount, "id" => "r" . $tbl_borrowers_list->RowCount . "_tbl_borrowers", "data-rowtype" => $tbl_borrowers->RowType]);

		// Render row
		$tbl_borrowers_list->renderRow();

		// Render list options
		$tbl_borrowers_list->renderListOptions();
?>
	<tr <?php echo $tbl_borrowers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_borrowers_list->ListOptions->render("body", "left", $tbl_borrowers_list->RowCount);
?>
	<?php if ($tbl_borrowers_list->Date_Barrowed->Visible) { // Date_Barrowed ?>
		<td data-name="Date_Barrowed" <?php echo $tbl_borrowers_list->Date_Barrowed->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_Date_Barrowed">
<span<?php echo $tbl_borrowers_list->Date_Barrowed->viewAttributes() ?>><?php echo $tbl_borrowers_list->Date_Barrowed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->Date_Returned->Visible) { // Date_Returned ?>
		<td data-name="Date_Returned" <?php echo $tbl_borrowers_list->Date_Returned->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_Date_Returned">
<span<?php echo $tbl_borrowers_list->Date_Returned->viewAttributes() ?>><?php echo $tbl_borrowers_list->Date_Returned->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->item_type->Visible) { // item_type ?>
		<td data-name="item_type" <?php echo $tbl_borrowers_list->item_type->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_item_type">
<span<?php echo $tbl_borrowers_list->item_type->viewAttributes() ?>><?php echo $tbl_borrowers_list->item_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $tbl_borrowers_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_item_model">
<span<?php echo $tbl_borrowers_list->item_model->viewAttributes() ?>><?php echo $tbl_borrowers_list->item_model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->item_serial->Visible) { // item_serial ?>
		<td data-name="item_serial" <?php echo $tbl_borrowers_list->item_serial->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_item_serial">
<span<?php echo $tbl_borrowers_list->item_serial->viewAttributes() ?>><?php echo $tbl_borrowers_list->item_serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->name_barrowers->Visible) { // name_barrowers ?>
		<td data-name="name_barrowers" <?php echo $tbl_borrowers_list->name_barrowers->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_name_barrowers">
<span<?php echo $tbl_borrowers_list->name_barrowers->viewAttributes() ?>><?php echo $tbl_borrowers_list->name_barrowers->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->Designation->Visible) { // Designation ?>
		<td data-name="Designation" <?php echo $tbl_borrowers_list->Designation->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_Designation">
<span<?php echo $tbl_borrowers_list->Designation->viewAttributes() ?>><?php echo $tbl_borrowers_list->Designation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->office_id->Visible) { // office_id ?>
		<td data-name="office_id" <?php echo $tbl_borrowers_list->office_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_office_id">
<span<?php echo $tbl_borrowers_list->office_id->viewAttributes() ?>><?php echo $tbl_borrowers_list->office_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_borrowers_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $tbl_borrowers_list->status->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_list->RowCount ?>_tbl_borrowers_status">
<span<?php echo $tbl_borrowers_list->status->viewAttributes() ?>><?php echo $tbl_borrowers_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_borrowers_list->ListOptions->render("body", "right", $tbl_borrowers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_borrowers_list->isGridAdd())
		$tbl_borrowers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_borrowers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_borrowers_list->Recordset)
	$tbl_borrowers_list->Recordset->Close();
?>
<?php if (!$tbl_borrowers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_borrowers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_borrowers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_borrowers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_borrowers_list->TotalRecords == 0 && !$tbl_borrowers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_borrowers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_borrowers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_borrowers_list->isExport()) { ?>
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
$tbl_borrowers_list->terminate();
?>