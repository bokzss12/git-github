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
$tbl_current_loc_list = new tbl_current_loc_list();

// Run the page
$tbl_current_loc_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_current_loc_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_current_loc_list->isExport()) { ?>
<script>
var ftbl_current_loclist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_current_loclist = currentForm = new ew.Form("ftbl_current_loclist", "list");
	ftbl_current_loclist.formKeyCountName = '<?php echo $tbl_current_loc_list->FormKeyCountName ?>';
	loadjs.done("ftbl_current_loclist");
});
var ftbl_current_loclistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_current_loclistsrch = currentSearchForm = new ew.Form("ftbl_current_loclistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_current_loclistsrch.filterList = <?php echo $tbl_current_loc_list->getFilterList() ?>;
	loadjs.done("ftbl_current_loclistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_current_loc_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_current_loc_list->TotalRecords > 0 && $tbl_current_loc_list->ExportOptions->visible()) { ?>
<?php $tbl_current_loc_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_current_loc_list->ImportOptions->visible()) { ?>
<?php $tbl_current_loc_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_current_loc_list->SearchOptions->visible()) { ?>
<?php $tbl_current_loc_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_current_loc_list->FilterOptions->visible()) { ?>
<?php $tbl_current_loc_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_current_loc_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_current_loc_list->isExport() && !$tbl_current_loc->CurrentAction) { ?>
<form name="ftbl_current_loclistsrch" id="ftbl_current_loclistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_current_loclistsrch-search-panel" class="<?php echo $tbl_current_loc_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_current_loc">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_current_loc_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_current_loc_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_current_loc_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_current_loc_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_current_loc_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_current_loc_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_current_loc_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_current_loc_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_current_loc_list->showPageHeader(); ?>
<?php
$tbl_current_loc_list->showMessage();
?>
<?php if ($tbl_current_loc_list->TotalRecords > 0 || $tbl_current_loc->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_current_loc_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_current_loc">
<?php if (!$tbl_current_loc_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_current_loc_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_current_loc_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_current_loc_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_current_loclist" id="ftbl_current_loclist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_current_loc">
<div id="gmp_tbl_current_loc" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_current_loc_list->TotalRecords > 0 || $tbl_current_loc_list->isGridEdit()) { ?>
<table id="tbl_tbl_current_loclist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_current_loc->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_current_loc_list->renderListOptions();

// Render list options (header, left)
$tbl_current_loc_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_current_loc_list->current_id->Visible) { // current_id ?>
	<?php if ($tbl_current_loc_list->SortUrl($tbl_current_loc_list->current_id) == "") { ?>
		<th data-name="current_id" class="<?php echo $tbl_current_loc_list->current_id->headerCellClass() ?>"><div id="elh_tbl_current_loc_current_id" class="tbl_current_loc_current_id"><div class="ew-table-header-caption"><?php echo $tbl_current_loc_list->current_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="current_id" class="<?php echo $tbl_current_loc_list->current_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_current_loc_list->SortUrl($tbl_current_loc_list->current_id) ?>', 1);"><div id="elh_tbl_current_loc_current_id" class="tbl_current_loc_current_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_current_loc_list->current_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_current_loc_list->current_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_current_loc_list->current_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_current_loc_list->current_location->Visible) { // current_location ?>
	<?php if ($tbl_current_loc_list->SortUrl($tbl_current_loc_list->current_location) == "") { ?>
		<th data-name="current_location" class="<?php echo $tbl_current_loc_list->current_location->headerCellClass() ?>"><div id="elh_tbl_current_loc_current_location" class="tbl_current_loc_current_location"><div class="ew-table-header-caption"><?php echo $tbl_current_loc_list->current_location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="current_location" class="<?php echo $tbl_current_loc_list->current_location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_current_loc_list->SortUrl($tbl_current_loc_list->current_location) ?>', 1);"><div id="elh_tbl_current_loc_current_location" class="tbl_current_loc_current_location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_current_loc_list->current_location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_current_loc_list->current_location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_current_loc_list->current_location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_current_loc_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_current_loc_list->ExportAll && $tbl_current_loc_list->isExport()) {
	$tbl_current_loc_list->StopRecord = $tbl_current_loc_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_current_loc_list->TotalRecords > $tbl_current_loc_list->StartRecord + $tbl_current_loc_list->DisplayRecords - 1)
		$tbl_current_loc_list->StopRecord = $tbl_current_loc_list->StartRecord + $tbl_current_loc_list->DisplayRecords - 1;
	else
		$tbl_current_loc_list->StopRecord = $tbl_current_loc_list->TotalRecords;
}
$tbl_current_loc_list->RecordCount = $tbl_current_loc_list->StartRecord - 1;
if ($tbl_current_loc_list->Recordset && !$tbl_current_loc_list->Recordset->EOF) {
	$tbl_current_loc_list->Recordset->moveFirst();
	$selectLimit = $tbl_current_loc_list->UseSelectLimit;
	if (!$selectLimit && $tbl_current_loc_list->StartRecord > 1)
		$tbl_current_loc_list->Recordset->move($tbl_current_loc_list->StartRecord - 1);
} elseif (!$tbl_current_loc->AllowAddDeleteRow && $tbl_current_loc_list->StopRecord == 0) {
	$tbl_current_loc_list->StopRecord = $tbl_current_loc->GridAddRowCount;
}

// Initialize aggregate
$tbl_current_loc->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_current_loc->resetAttributes();
$tbl_current_loc_list->renderRow();
while ($tbl_current_loc_list->RecordCount < $tbl_current_loc_list->StopRecord) {
	$tbl_current_loc_list->RecordCount++;
	if ($tbl_current_loc_list->RecordCount >= $tbl_current_loc_list->StartRecord) {
		$tbl_current_loc_list->RowCount++;

		// Set up key count
		$tbl_current_loc_list->KeyCount = $tbl_current_loc_list->RowIndex;

		// Init row class and style
		$tbl_current_loc->resetAttributes();
		$tbl_current_loc->CssClass = "";
		if ($tbl_current_loc_list->isGridAdd()) {
		} else {
			$tbl_current_loc_list->loadRowValues($tbl_current_loc_list->Recordset); // Load row values
		}
		$tbl_current_loc->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_current_loc->RowAttrs->merge(["data-rowindex" => $tbl_current_loc_list->RowCount, "id" => "r" . $tbl_current_loc_list->RowCount . "_tbl_current_loc", "data-rowtype" => $tbl_current_loc->RowType]);

		// Render row
		$tbl_current_loc_list->renderRow();

		// Render list options
		$tbl_current_loc_list->renderListOptions();
?>
	<tr <?php echo $tbl_current_loc->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_current_loc_list->ListOptions->render("body", "left", $tbl_current_loc_list->RowCount);
?>
	<?php if ($tbl_current_loc_list->current_id->Visible) { // current_id ?>
		<td data-name="current_id" <?php echo $tbl_current_loc_list->current_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_current_loc_list->RowCount ?>_tbl_current_loc_current_id">
<span<?php echo $tbl_current_loc_list->current_id->viewAttributes() ?>><?php echo $tbl_current_loc_list->current_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_current_loc_list->current_location->Visible) { // current_location ?>
		<td data-name="current_location" <?php echo $tbl_current_loc_list->current_location->cellAttributes() ?>>
<span id="el<?php echo $tbl_current_loc_list->RowCount ?>_tbl_current_loc_current_location">
<span<?php echo $tbl_current_loc_list->current_location->viewAttributes() ?>><?php echo $tbl_current_loc_list->current_location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_current_loc_list->ListOptions->render("body", "right", $tbl_current_loc_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_current_loc_list->isGridAdd())
		$tbl_current_loc_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_current_loc->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_current_loc_list->Recordset)
	$tbl_current_loc_list->Recordset->Close();
?>
<?php if (!$tbl_current_loc_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_current_loc_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_current_loc_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_current_loc_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_current_loc_list->TotalRecords == 0 && !$tbl_current_loc->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_current_loc_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_current_loc_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_current_loc_list->isExport()) { ?>
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
$tbl_current_loc_list->terminate();
?>