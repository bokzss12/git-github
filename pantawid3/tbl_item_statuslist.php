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
$tbl_item_status_list = new tbl_item_status_list();

// Run the page
$tbl_item_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_item_status_list->isExport()) { ?>
<script>
var ftbl_item_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_item_statuslist = currentForm = new ew.Form("ftbl_item_statuslist", "list");
	ftbl_item_statuslist.formKeyCountName = '<?php echo $tbl_item_status_list->FormKeyCountName ?>';
	loadjs.done("ftbl_item_statuslist");
});
var ftbl_item_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_item_statuslistsrch = currentSearchForm = new ew.Form("ftbl_item_statuslistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_item_statuslistsrch.filterList = <?php echo $tbl_item_status_list->getFilterList() ?>;
	loadjs.done("ftbl_item_statuslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_item_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_item_status_list->TotalRecords > 0 && $tbl_item_status_list->ExportOptions->visible()) { ?>
<?php $tbl_item_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_item_status_list->ImportOptions->visible()) { ?>
<?php $tbl_item_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_item_status_list->SearchOptions->visible()) { ?>
<?php $tbl_item_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_item_status_list->FilterOptions->visible()) { ?>
<?php $tbl_item_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_item_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_item_status_list->isExport() && !$tbl_item_status->CurrentAction) { ?>
<form name="ftbl_item_statuslistsrch" id="ftbl_item_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_item_statuslistsrch-search-panel" class="<?php echo $tbl_item_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_item_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_item_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_item_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_item_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_item_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_item_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_item_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_item_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_item_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_item_status_list->showPageHeader(); ?>
<?php
$tbl_item_status_list->showMessage();
?>
<?php if ($tbl_item_status_list->TotalRecords > 0 || $tbl_item_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_item_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_item_status">
<form name="ftbl_item_statuslist" id="ftbl_item_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item_status">
<div id="gmp_tbl_item_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_item_status_list->TotalRecords > 0 || $tbl_item_status_list->isGridEdit()) { ?>
<table id="tbl_tbl_item_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_item_status->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_item_status_list->renderListOptions();

// Render list options (header, left)
$tbl_item_status_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_item_status_list->status_id->Visible) { // status_id ?>
	<?php if ($tbl_item_status_list->SortUrl($tbl_item_status_list->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $tbl_item_status_list->status_id->headerCellClass() ?>"><div id="elh_tbl_item_status_status_id" class="tbl_item_status_status_id"><div class="ew-table-header-caption"><?php echo $tbl_item_status_list->status_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $tbl_item_status_list->status_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_status_list->SortUrl($tbl_item_status_list->status_id) ?>', 1);"><div id="elh_tbl_item_status_status_id" class="tbl_item_status_status_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_status_list->status_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_status_list->status_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_status_list->status_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_item_status_list->status_desc->Visible) { // status_desc ?>
	<?php if ($tbl_item_status_list->SortUrl($tbl_item_status_list->status_desc) == "") { ?>
		<th data-name="status_desc" class="<?php echo $tbl_item_status_list->status_desc->headerCellClass() ?>"><div id="elh_tbl_item_status_status_desc" class="tbl_item_status_status_desc"><div class="ew-table-header-caption"><?php echo $tbl_item_status_list->status_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_desc" class="<?php echo $tbl_item_status_list->status_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_item_status_list->SortUrl($tbl_item_status_list->status_desc) ?>', 1);"><div id="elh_tbl_item_status_status_desc" class="tbl_item_status_status_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_item_status_list->status_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_item_status_list->status_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_item_status_list->status_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_item_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_item_status_list->ExportAll && $tbl_item_status_list->isExport()) {
	$tbl_item_status_list->StopRecord = $tbl_item_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_item_status_list->TotalRecords > $tbl_item_status_list->StartRecord + $tbl_item_status_list->DisplayRecords - 1)
		$tbl_item_status_list->StopRecord = $tbl_item_status_list->StartRecord + $tbl_item_status_list->DisplayRecords - 1;
	else
		$tbl_item_status_list->StopRecord = $tbl_item_status_list->TotalRecords;
}
$tbl_item_status_list->RecordCount = $tbl_item_status_list->StartRecord - 1;
if ($tbl_item_status_list->Recordset && !$tbl_item_status_list->Recordset->EOF) {
	$tbl_item_status_list->Recordset->moveFirst();
	$selectLimit = $tbl_item_status_list->UseSelectLimit;
	if (!$selectLimit && $tbl_item_status_list->StartRecord > 1)
		$tbl_item_status_list->Recordset->move($tbl_item_status_list->StartRecord - 1);
} elseif (!$tbl_item_status->AllowAddDeleteRow && $tbl_item_status_list->StopRecord == 0) {
	$tbl_item_status_list->StopRecord = $tbl_item_status->GridAddRowCount;
}

// Initialize aggregate
$tbl_item_status->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_item_status->resetAttributes();
$tbl_item_status_list->renderRow();
while ($tbl_item_status_list->RecordCount < $tbl_item_status_list->StopRecord) {
	$tbl_item_status_list->RecordCount++;
	if ($tbl_item_status_list->RecordCount >= $tbl_item_status_list->StartRecord) {
		$tbl_item_status_list->RowCount++;

		// Set up key count
		$tbl_item_status_list->KeyCount = $tbl_item_status_list->RowIndex;

		// Init row class and style
		$tbl_item_status->resetAttributes();
		$tbl_item_status->CssClass = "";
		if ($tbl_item_status_list->isGridAdd()) {
		} else {
			$tbl_item_status_list->loadRowValues($tbl_item_status_list->Recordset); // Load row values
		}
		$tbl_item_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_item_status->RowAttrs->merge(["data-rowindex" => $tbl_item_status_list->RowCount, "id" => "r" . $tbl_item_status_list->RowCount . "_tbl_item_status", "data-rowtype" => $tbl_item_status->RowType]);

		// Render row
		$tbl_item_status_list->renderRow();

		// Render list options
		$tbl_item_status_list->renderListOptions();
?>
	<tr <?php echo $tbl_item_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_item_status_list->ListOptions->render("body", "left", $tbl_item_status_list->RowCount);
?>
	<?php if ($tbl_item_status_list->status_id->Visible) { // status_id ?>
		<td data-name="status_id" <?php echo $tbl_item_status_list->status_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_status_list->RowCount ?>_tbl_item_status_status_id">
<span<?php echo $tbl_item_status_list->status_id->viewAttributes() ?>><?php echo $tbl_item_status_list->status_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_item_status_list->status_desc->Visible) { // status_desc ?>
		<td data-name="status_desc" <?php echo $tbl_item_status_list->status_desc->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_status_list->RowCount ?>_tbl_item_status_status_desc">
<span<?php echo $tbl_item_status_list->status_desc->viewAttributes() ?>><?php echo $tbl_item_status_list->status_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_item_status_list->ListOptions->render("body", "right", $tbl_item_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_item_status_list->isGridAdd())
		$tbl_item_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_item_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_item_status_list->Recordset)
	$tbl_item_status_list->Recordset->Close();
?>
<?php if (!$tbl_item_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_item_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_item_status_list->TotalRecords == 0 && !$tbl_item_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_item_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_item_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_item_status_list->isExport()) { ?>
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
$tbl_item_status_list->terminate();
?>