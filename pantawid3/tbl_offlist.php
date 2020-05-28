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
$tbl_off_list = new tbl_off_list();

// Run the page
$tbl_off_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_off_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_off_list->isExport()) { ?>
<script>
var ftbl_offlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_offlist = currentForm = new ew.Form("ftbl_offlist", "list");
	ftbl_offlist.formKeyCountName = '<?php echo $tbl_off_list->FormKeyCountName ?>';
	loadjs.done("ftbl_offlist");
});
var ftbl_offlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_offlistsrch = currentSearchForm = new ew.Form("ftbl_offlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_offlistsrch.filterList = <?php echo $tbl_off_list->getFilterList() ?>;
	loadjs.done("ftbl_offlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_off_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_off_list->TotalRecords > 0 && $tbl_off_list->ExportOptions->visible()) { ?>
<?php $tbl_off_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_off_list->ImportOptions->visible()) { ?>
<?php $tbl_off_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_off_list->SearchOptions->visible()) { ?>
<?php $tbl_off_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_off_list->FilterOptions->visible()) { ?>
<?php $tbl_off_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_off_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_off_list->isExport() && !$tbl_off->CurrentAction) { ?>
<form name="ftbl_offlistsrch" id="ftbl_offlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_offlistsrch-search-panel" class="<?php echo $tbl_off_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_off">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_off_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_off_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_off_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_off_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_off_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_off_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_off_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_off_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_off_list->showPageHeader(); ?>
<?php
$tbl_off_list->showMessage();
?>
<?php if ($tbl_off_list->TotalRecords > 0 || $tbl_off->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_off_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_off">
<?php if (!$tbl_off_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_off_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_off_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_off_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_offlist" id="ftbl_offlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_off">
<div id="gmp_tbl_off" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_off_list->TotalRecords > 0 || $tbl_off_list->isGridEdit()) { ?>
<table id="tbl_tbl_offlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_off->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_off_list->renderListOptions();

// Render list options (header, left)
$tbl_off_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_off_list->off_id->Visible) { // off_id ?>
	<?php if ($tbl_off_list->SortUrl($tbl_off_list->off_id) == "") { ?>
		<th data-name="off_id" class="<?php echo $tbl_off_list->off_id->headerCellClass() ?>"><div id="elh_tbl_off_off_id" class="tbl_off_off_id"><div class="ew-table-header-caption"><?php echo $tbl_off_list->off_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off_id" class="<?php echo $tbl_off_list->off_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_off_list->SortUrl($tbl_off_list->off_id) ?>', 1);"><div id="elh_tbl_off_off_id" class="tbl_off_off_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_off_list->off_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_off_list->off_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_off_list->off_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_off_list->off_desc->Visible) { // off_desc ?>
	<?php if ($tbl_off_list->SortUrl($tbl_off_list->off_desc) == "") { ?>
		<th data-name="off_desc" class="<?php echo $tbl_off_list->off_desc->headerCellClass() ?>"><div id="elh_tbl_off_off_desc" class="tbl_off_off_desc"><div class="ew-table-header-caption"><?php echo $tbl_off_list->off_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off_desc" class="<?php echo $tbl_off_list->off_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_off_list->SortUrl($tbl_off_list->off_desc) ?>', 1);"><div id="elh_tbl_off_off_desc" class="tbl_off_off_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_off_list->off_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_off_list->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_off_list->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_off_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_off_list->ExportAll && $tbl_off_list->isExport()) {
	$tbl_off_list->StopRecord = $tbl_off_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_off_list->TotalRecords > $tbl_off_list->StartRecord + $tbl_off_list->DisplayRecords - 1)
		$tbl_off_list->StopRecord = $tbl_off_list->StartRecord + $tbl_off_list->DisplayRecords - 1;
	else
		$tbl_off_list->StopRecord = $tbl_off_list->TotalRecords;
}
$tbl_off_list->RecordCount = $tbl_off_list->StartRecord - 1;
if ($tbl_off_list->Recordset && !$tbl_off_list->Recordset->EOF) {
	$tbl_off_list->Recordset->moveFirst();
	$selectLimit = $tbl_off_list->UseSelectLimit;
	if (!$selectLimit && $tbl_off_list->StartRecord > 1)
		$tbl_off_list->Recordset->move($tbl_off_list->StartRecord - 1);
} elseif (!$tbl_off->AllowAddDeleteRow && $tbl_off_list->StopRecord == 0) {
	$tbl_off_list->StopRecord = $tbl_off->GridAddRowCount;
}

// Initialize aggregate
$tbl_off->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_off->resetAttributes();
$tbl_off_list->renderRow();
while ($tbl_off_list->RecordCount < $tbl_off_list->StopRecord) {
	$tbl_off_list->RecordCount++;
	if ($tbl_off_list->RecordCount >= $tbl_off_list->StartRecord) {
		$tbl_off_list->RowCount++;

		// Set up key count
		$tbl_off_list->KeyCount = $tbl_off_list->RowIndex;

		// Init row class and style
		$tbl_off->resetAttributes();
		$tbl_off->CssClass = "";
		if ($tbl_off_list->isGridAdd()) {
		} else {
			$tbl_off_list->loadRowValues($tbl_off_list->Recordset); // Load row values
		}
		$tbl_off->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_off->RowAttrs->merge(["data-rowindex" => $tbl_off_list->RowCount, "id" => "r" . $tbl_off_list->RowCount . "_tbl_off", "data-rowtype" => $tbl_off->RowType]);

		// Render row
		$tbl_off_list->renderRow();

		// Render list options
		$tbl_off_list->renderListOptions();
?>
	<tr <?php echo $tbl_off->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_off_list->ListOptions->render("body", "left", $tbl_off_list->RowCount);
?>
	<?php if ($tbl_off_list->off_id->Visible) { // off_id ?>
		<td data-name="off_id" <?php echo $tbl_off_list->off_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_off_list->RowCount ?>_tbl_off_off_id">
<span<?php echo $tbl_off_list->off_id->viewAttributes() ?>><?php echo $tbl_off_list->off_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_off_list->off_desc->Visible) { // off_desc ?>
		<td data-name="off_desc" <?php echo $tbl_off_list->off_desc->cellAttributes() ?>>
<span id="el<?php echo $tbl_off_list->RowCount ?>_tbl_off_off_desc">
<span<?php echo $tbl_off_list->off_desc->viewAttributes() ?>><?php echo $tbl_off_list->off_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_off_list->ListOptions->render("body", "right", $tbl_off_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_off_list->isGridAdd())
		$tbl_off_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_off->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_off_list->Recordset)
	$tbl_off_list->Recordset->Close();
?>
<?php if (!$tbl_off_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_off_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_off_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_off_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_off_list->TotalRecords == 0 && !$tbl_off->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_off_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_off_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_off_list->isExport()) { ?>
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
$tbl_off_list->terminate();
?>