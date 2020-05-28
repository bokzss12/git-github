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
$tbl_item_list = new tbl_item_list();

// Run the page
$tbl_item_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_item_list->isExport()) { ?>
<script>
var ftbl_itemlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_itemlist = currentForm = new ew.Form("ftbl_itemlist", "list");
	ftbl_itemlist.formKeyCountName = '<?php echo $tbl_item_list->FormKeyCountName ?>';
	loadjs.done("ftbl_itemlist");
});
var ftbl_itemlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_itemlistsrch = currentSearchForm = new ew.Form("ftbl_itemlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_itemlistsrch.filterList = <?php echo $tbl_item_list->getFilterList() ?>;
	loadjs.done("ftbl_itemlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_item_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_item_list->TotalRecords > 0 && $tbl_item_list->ExportOptions->visible()) { ?>
<?php $tbl_item_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_item_list->ImportOptions->visible()) { ?>
<?php $tbl_item_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_item_list->SearchOptions->visible()) { ?>
<?php $tbl_item_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_item_list->FilterOptions->visible()) { ?>
<?php $tbl_item_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_item_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_item_list->isExport() && !$tbl_item->CurrentAction) { ?>
<form name="ftbl_itemlistsrch" id="ftbl_itemlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_itemlistsrch-search-panel" class="<?php echo $tbl_item_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_item">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_item_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_item_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_item_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_item_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_item_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_item_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_item_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_item_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_item_list->showPageHeader(); ?>
<?php
$tbl_item_list->showMessage();
?>
<?php if ($tbl_item_list->TotalRecords > 0 || $tbl_item->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_item_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_item">
<?php if (!$tbl_item_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_item_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_item_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_item_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_itemlist" id="ftbl_itemlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item">
<div id="gmp_tbl_item" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_item_list->TotalRecords > 0 || $tbl_item_list->isGridEdit()) { ?>
<table id="tbl_tbl_itemlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_item->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_item_list->renderListOptions();

// Render list options (header, left)
$tbl_item_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_item_list->SRN->Visible) { // SRN ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->SRN) == "") { ?>
		<th data-name="SRN" class="<?php echo $tbl_item_list->SRN->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_SRN" class="tbl_item_SRN"><div class="ew-table-header-caption"><?php echo $tbl_item_list->SRN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SRN" class="<?php echo $tbl_item_list->SRN->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->SRN) ?>', 1);"><div id="elh_tbl_item_SRN" class="tbl_item_SRN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->SRN->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->SRN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->SRN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_list->item_date_receive->Visible) { // item_date_receive ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->item_date_receive) == "") { ?>
		<th data-name="item_date_receive" class="<?php echo $tbl_item_list->item_date_receive->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_item_date_receive" class="tbl_item_item_date_receive"><div class="ew-table-header-caption"><?php echo $tbl_item_list->item_date_receive->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_receive" class="<?php echo $tbl_item_list->item_date_receive->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->item_date_receive) ?>', 1);"><div id="elh_tbl_item_item_date_receive" class="tbl_item_item_date_receive">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->item_date_receive->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->item_date_receive->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->item_date_receive->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_list->item_date_repaired->Visible) { // item_date_repaired ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->item_date_repaired) == "") { ?>
		<th data-name="item_date_repaired" class="<?php echo $tbl_item_list->item_date_repaired->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_item_date_repaired" class="tbl_item_item_date_repaired"><div class="ew-table-header-caption"><?php echo $tbl_item_list->item_date_repaired->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_repaired" class="<?php echo $tbl_item_list->item_date_repaired->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->item_date_repaired) ?>', 1);"><div id="elh_tbl_item_item_date_repaired" class="tbl_item_item_date_repaired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->item_date_repaired->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->item_date_repaired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->item_date_repaired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_list->item_transmittal->Visible) { // item_transmittal ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->item_transmittal) == "") { ?>
		<th data-name="item_transmittal" class="<?php echo $tbl_item_list->item_transmittal->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_item_transmittal" class="tbl_item_item_transmittal"><div class="ew-table-header-caption"><?php echo $tbl_item_list->item_transmittal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_transmittal" class="<?php echo $tbl_item_list->item_transmittal->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->item_transmittal) ?>', 1);"><div id="elh_tbl_item_item_transmittal" class="tbl_item_item_transmittal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->item_transmittal->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->item_transmittal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->item_transmittal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_list->Province->Visible) { // Province ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->Province) == "") { ?>
		<th data-name="Province" class="<?php echo $tbl_item_list->Province->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_Province" class="tbl_item_Province"><div class="ew-table-header-caption"><?php echo $tbl_item_list->Province->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Province" class="<?php echo $tbl_item_list->Province->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->Province) ?>', 1);"><div id="elh_tbl_item_Province" class="tbl_item_Province">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->Province->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->Province->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->Province->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_list->Cities->Visible) { // Cities ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->Cities) == "") { ?>
		<th data-name="Cities" class="<?php echo $tbl_item_list->Cities->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_Cities" class="tbl_item_Cities"><div class="ew-table-header-caption"><?php echo $tbl_item_list->Cities->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cities" class="<?php echo $tbl_item_list->Cities->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->Cities) ?>', 1);"><div id="elh_tbl_item_Cities" class="tbl_item_Cities">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->Cities->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->Cities->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->Cities->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_list->employeeid->Visible) { // employeeid ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $tbl_item_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_employeeid" class="tbl_item_employeeid"><div class="ew-table-header-caption"><?php echo $tbl_item_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $tbl_item_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->employeeid) ?>', 1);"><div id="elh_tbl_item_employeeid" class="tbl_item_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_list->status_id->Visible) { // status_id ?>
	<?php if ($tbl_item_list->SortUrl($tbl_item_list->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $tbl_item_list->status_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_item_status_id" class="tbl_item_status_id"><div class="ew-table-header-caption"><?php echo $tbl_item_list->status_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $tbl_item_list->status_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_list->SortUrl($tbl_item_list->status_id) ?>', 1);"><div id="elh_tbl_item_status_id" class="tbl_item_status_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_list->status_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_list->status_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_list->status_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_item_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_item_list->ExportAll && $tbl_item_list->isExport()) {
	$tbl_item_list->StopRecord = $tbl_item_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_item_list->TotalRecords > $tbl_item_list->StartRecord + $tbl_item_list->DisplayRecords - 1)
		$tbl_item_list->StopRecord = $tbl_item_list->StartRecord + $tbl_item_list->DisplayRecords - 1;
	else
		$tbl_item_list->StopRecord = $tbl_item_list->TotalRecords;
}
$tbl_item_list->RecordCount = $tbl_item_list->StartRecord - 1;
if ($tbl_item_list->Recordset && !$tbl_item_list->Recordset->EOF) {
	$tbl_item_list->Recordset->moveFirst();
	$selectLimit = $tbl_item_list->UseSelectLimit;
	if (!$selectLimit && $tbl_item_list->StartRecord > 1)
		$tbl_item_list->Recordset->move($tbl_item_list->StartRecord - 1);
} elseif (!$tbl_item->AllowAddDeleteRow && $tbl_item_list->StopRecord == 0) {
	$tbl_item_list->StopRecord = $tbl_item->GridAddRowCount;
}

// Initialize aggregate
$tbl_item->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_item->resetAttributes();
$tbl_item_list->renderRow();
while ($tbl_item_list->RecordCount < $tbl_item_list->StopRecord) {
	$tbl_item_list->RecordCount++;
	if ($tbl_item_list->RecordCount >= $tbl_item_list->StartRecord) {
		$tbl_item_list->RowCount++;

		// Set up key count
		$tbl_item_list->KeyCount = $tbl_item_list->RowIndex;

		// Init row class and style
		$tbl_item->resetAttributes();
		$tbl_item->CssClass = "";
		if ($tbl_item_list->isGridAdd()) {
		} else {
			$tbl_item_list->loadRowValues($tbl_item_list->Recordset); // Load row values
		}
		$tbl_item->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_item->RowAttrs->merge(["data-rowindex" => $tbl_item_list->RowCount, "id" => "r" . $tbl_item_list->RowCount . "_tbl_item", "data-rowtype" => $tbl_item->RowType]);

		// Render row
		$tbl_item_list->renderRow();

		// Render list options
		$tbl_item_list->renderListOptions();
?>
	<tr <?php echo $tbl_item->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_item_list->ListOptions->render("body", "left", $tbl_item_list->RowCount);
?>
	<?php if ($tbl_item_list->SRN->Visible) { // SRN ?>
		<td data-name="SRN" <?php echo $tbl_item_list->SRN->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_SRN">
<span<?php echo $tbl_item_list->SRN->viewAttributes() ?>><?php echo $tbl_item_list->SRN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_list->item_date_receive->Visible) { // item_date_receive ?>
		<td data-name="item_date_receive" <?php echo $tbl_item_list->item_date_receive->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_item_date_receive">
<span<?php echo $tbl_item_list->item_date_receive->viewAttributes() ?>><?php echo $tbl_item_list->item_date_receive->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_list->item_date_repaired->Visible) { // item_date_repaired ?>
		<td data-name="item_date_repaired" <?php echo $tbl_item_list->item_date_repaired->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_item_date_repaired">
<span<?php echo $tbl_item_list->item_date_repaired->viewAttributes() ?>><?php echo $tbl_item_list->item_date_repaired->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_list->item_transmittal->Visible) { // item_transmittal ?>
		<td data-name="item_transmittal" <?php echo $tbl_item_list->item_transmittal->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_item_transmittal">
<span<?php echo $tbl_item_list->item_transmittal->viewAttributes() ?>><?php echo $tbl_item_list->item_transmittal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_list->Province->Visible) { // Province ?>
		<td data-name="Province" <?php echo $tbl_item_list->Province->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_Province">
<span<?php echo $tbl_item_list->Province->viewAttributes() ?>><?php echo $tbl_item_list->Province->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_list->Cities->Visible) { // Cities ?>
		<td data-name="Cities" <?php echo $tbl_item_list->Cities->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_Cities">
<span<?php echo $tbl_item_list->Cities->viewAttributes() ?>><?php echo $tbl_item_list->Cities->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $tbl_item_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_employeeid">
<span<?php echo $tbl_item_list->employeeid->viewAttributes() ?>><?php echo $tbl_item_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_list->status_id->Visible) { // status_id ?>
		<td data-name="status_id" <?php echo $tbl_item_list->status_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_list->RowCount ?>_tbl_item_status_id">
<span<?php echo $tbl_item_list->status_id->viewAttributes() ?>><?php echo $tbl_item_list->status_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_item_list->ListOptions->render("body", "right", $tbl_item_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_item_list->isGridAdd())
		$tbl_item_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_item->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_item_list->Recordset)
	$tbl_item_list->Recordset->Close();
?>
<?php if (!$tbl_item_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_item_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_item_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_item_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_item_list->TotalRecords == 0 && !$tbl_item->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_item_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_item_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_item_list->isExport()) { ?>
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
$tbl_item_list->terminate();
?>