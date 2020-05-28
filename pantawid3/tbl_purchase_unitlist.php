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
$tbl_purchase_unit_list = new tbl_purchase_unit_list();

// Run the page
$tbl_purchase_unit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_purchase_unit_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_purchase_unit_list->isExport()) { ?>
<script>
var ftbl_purchase_unitlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_purchase_unitlist = currentForm = new ew.Form("ftbl_purchase_unitlist", "list");
	ftbl_purchase_unitlist.formKeyCountName = '<?php echo $tbl_purchase_unit_list->FormKeyCountName ?>';
	loadjs.done("ftbl_purchase_unitlist");
});
var ftbl_purchase_unitlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_purchase_unitlistsrch = currentSearchForm = new ew.Form("ftbl_purchase_unitlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_purchase_unitlistsrch.filterList = <?php echo $tbl_purchase_unit_list->getFilterList() ?>;
	loadjs.done("ftbl_purchase_unitlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_purchase_unit_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_purchase_unit_list->TotalRecords > 0 && $tbl_purchase_unit_list->ExportOptions->visible()) { ?>
<?php $tbl_purchase_unit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_purchase_unit_list->ImportOptions->visible()) { ?>
<?php $tbl_purchase_unit_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_purchase_unit_list->SearchOptions->visible()) { ?>
<?php $tbl_purchase_unit_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_purchase_unit_list->FilterOptions->visible()) { ?>
<?php $tbl_purchase_unit_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_purchase_unit_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_purchase_unit_list->isExport() && !$tbl_purchase_unit->CurrentAction) { ?>
<form name="ftbl_purchase_unitlistsrch" id="ftbl_purchase_unitlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_purchase_unitlistsrch-search-panel" class="<?php echo $tbl_purchase_unit_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_purchase_unit">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_purchase_unit_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_purchase_unit_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_purchase_unit_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_purchase_unit_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_purchase_unit_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_purchase_unit_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_purchase_unit_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_purchase_unit_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_purchase_unit_list->showPageHeader(); ?>
<?php
$tbl_purchase_unit_list->showMessage();
?>
<?php if ($tbl_purchase_unit_list->TotalRecords > 0 || $tbl_purchase_unit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_purchase_unit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_purchase_unit">
<?php if (!$tbl_purchase_unit_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_purchase_unit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_purchase_unit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_purchase_unit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_purchase_unitlist" id="ftbl_purchase_unitlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_purchase_unit">
<div id="gmp_tbl_purchase_unit" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_purchase_unit_list->TotalRecords > 0 || $tbl_purchase_unit_list->isGridEdit()) { ?>
<table id="tbl_tbl_purchase_unitlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_purchase_unit->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_purchase_unit_list->renderListOptions();

// Render list options (header, left)
$tbl_purchase_unit_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_purchase_unit_list->pruID->Visible) { // pruID ?>
	<?php if ($tbl_purchase_unit_list->SortUrl($tbl_purchase_unit_list->pruID) == "") { ?>
		<th data-name="pruID" class="<?php echo $tbl_purchase_unit_list->pruID->headerCellClass() ?>"><div id="elh_tbl_purchase_unit_pruID" class="tbl_purchase_unit_pruID"><div class="ew-table-header-caption"><?php echo $tbl_purchase_unit_list->pruID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pruID" class="<?php echo $tbl_purchase_unit_list->pruID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_purchase_unit_list->SortUrl($tbl_purchase_unit_list->pruID) ?>', 1);"><div id="elh_tbl_purchase_unit_pruID" class="tbl_purchase_unit_pruID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_purchase_unit_list->pruID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_purchase_unit_list->pruID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_purchase_unit_list->pruID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_purchase_unit_list->unit_desc->Visible) { // unit_desc ?>
	<?php if ($tbl_purchase_unit_list->SortUrl($tbl_purchase_unit_list->unit_desc) == "") { ?>
		<th data-name="unit_desc" class="<?php echo $tbl_purchase_unit_list->unit_desc->headerCellClass() ?>"><div id="elh_tbl_purchase_unit_unit_desc" class="tbl_purchase_unit_unit_desc"><div class="ew-table-header-caption"><?php echo $tbl_purchase_unit_list->unit_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unit_desc" class="<?php echo $tbl_purchase_unit_list->unit_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_purchase_unit_list->SortUrl($tbl_purchase_unit_list->unit_desc) ?>', 1);"><div id="elh_tbl_purchase_unit_unit_desc" class="tbl_purchase_unit_unit_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_purchase_unit_list->unit_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_purchase_unit_list->unit_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_purchase_unit_list->unit_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_purchase_unit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_purchase_unit_list->ExportAll && $tbl_purchase_unit_list->isExport()) {
	$tbl_purchase_unit_list->StopRecord = $tbl_purchase_unit_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_purchase_unit_list->TotalRecords > $tbl_purchase_unit_list->StartRecord + $tbl_purchase_unit_list->DisplayRecords - 1)
		$tbl_purchase_unit_list->StopRecord = $tbl_purchase_unit_list->StartRecord + $tbl_purchase_unit_list->DisplayRecords - 1;
	else
		$tbl_purchase_unit_list->StopRecord = $tbl_purchase_unit_list->TotalRecords;
}
$tbl_purchase_unit_list->RecordCount = $tbl_purchase_unit_list->StartRecord - 1;
if ($tbl_purchase_unit_list->Recordset && !$tbl_purchase_unit_list->Recordset->EOF) {
	$tbl_purchase_unit_list->Recordset->moveFirst();
	$selectLimit = $tbl_purchase_unit_list->UseSelectLimit;
	if (!$selectLimit && $tbl_purchase_unit_list->StartRecord > 1)
		$tbl_purchase_unit_list->Recordset->move($tbl_purchase_unit_list->StartRecord - 1);
} elseif (!$tbl_purchase_unit->AllowAddDeleteRow && $tbl_purchase_unit_list->StopRecord == 0) {
	$tbl_purchase_unit_list->StopRecord = $tbl_purchase_unit->GridAddRowCount;
}

// Initialize aggregate
$tbl_purchase_unit->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_purchase_unit->resetAttributes();
$tbl_purchase_unit_list->renderRow();
while ($tbl_purchase_unit_list->RecordCount < $tbl_purchase_unit_list->StopRecord) {
	$tbl_purchase_unit_list->RecordCount++;
	if ($tbl_purchase_unit_list->RecordCount >= $tbl_purchase_unit_list->StartRecord) {
		$tbl_purchase_unit_list->RowCount++;

		// Set up key count
		$tbl_purchase_unit_list->KeyCount = $tbl_purchase_unit_list->RowIndex;

		// Init row class and style
		$tbl_purchase_unit->resetAttributes();
		$tbl_purchase_unit->CssClass = "";
		if ($tbl_purchase_unit_list->isGridAdd()) {
		} else {
			$tbl_purchase_unit_list->loadRowValues($tbl_purchase_unit_list->Recordset); // Load row values
		}
		$tbl_purchase_unit->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_purchase_unit->RowAttrs->merge(["data-rowindex" => $tbl_purchase_unit_list->RowCount, "id" => "r" . $tbl_purchase_unit_list->RowCount . "_tbl_purchase_unit", "data-rowtype" => $tbl_purchase_unit->RowType]);

		// Render row
		$tbl_purchase_unit_list->renderRow();

		// Render list options
		$tbl_purchase_unit_list->renderListOptions();
?>
	<tr <?php echo $tbl_purchase_unit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_purchase_unit_list->ListOptions->render("body", "left", $tbl_purchase_unit_list->RowCount);
?>
	<?php if ($tbl_purchase_unit_list->pruID->Visible) { // pruID ?>
		<td data-name="pruID" <?php echo $tbl_purchase_unit_list->pruID->cellAttributes() ?>>
<span id="el<?php echo $tbl_purchase_unit_list->RowCount ?>_tbl_purchase_unit_pruID">
<span<?php echo $tbl_purchase_unit_list->pruID->viewAttributes() ?>><?php echo $tbl_purchase_unit_list->pruID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_purchase_unit_list->unit_desc->Visible) { // unit_desc ?>
		<td data-name="unit_desc" <?php echo $tbl_purchase_unit_list->unit_desc->cellAttributes() ?>>
<span id="el<?php echo $tbl_purchase_unit_list->RowCount ?>_tbl_purchase_unit_unit_desc">
<span<?php echo $tbl_purchase_unit_list->unit_desc->viewAttributes() ?>><?php echo $tbl_purchase_unit_list->unit_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_purchase_unit_list->ListOptions->render("body", "right", $tbl_purchase_unit_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_purchase_unit_list->isGridAdd())
		$tbl_purchase_unit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_purchase_unit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_purchase_unit_list->Recordset)
	$tbl_purchase_unit_list->Recordset->Close();
?>
<?php if (!$tbl_purchase_unit_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_purchase_unit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_purchase_unit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_purchase_unit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_purchase_unit_list->TotalRecords == 0 && !$tbl_purchase_unit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_purchase_unit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_purchase_unit_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_purchase_unit_list->isExport()) { ?>
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
$tbl_purchase_unit_list->terminate();
?>