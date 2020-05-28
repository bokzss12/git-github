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
$tbl_pos_list = new tbl_pos_list();

// Run the page
$tbl_pos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_pos_list->isExport()) { ?>
<script>
var ftbl_poslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_poslist = currentForm = new ew.Form("ftbl_poslist", "list");
	ftbl_poslist.formKeyCountName = '<?php echo $tbl_pos_list->FormKeyCountName ?>';
	loadjs.done("ftbl_poslist");
});
var ftbl_poslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_poslistsrch = currentSearchForm = new ew.Form("ftbl_poslistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_poslistsrch.filterList = <?php echo $tbl_pos_list->getFilterList() ?>;
	loadjs.done("ftbl_poslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_pos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_pos_list->TotalRecords > 0 && $tbl_pos_list->ExportOptions->visible()) { ?>
<?php $tbl_pos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pos_list->ImportOptions->visible()) { ?>
<?php $tbl_pos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pos_list->SearchOptions->visible()) { ?>
<?php $tbl_pos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pos_list->FilterOptions->visible()) { ?>
<?php $tbl_pos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_pos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_pos_list->isExport() && !$tbl_pos->CurrentAction) { ?>
<form name="ftbl_poslistsrch" id="ftbl_poslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_poslistsrch-search-panel" class="<?php echo $tbl_pos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_pos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_pos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_pos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_pos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_pos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_pos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_pos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_pos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_pos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_pos_list->showPageHeader(); ?>
<?php
$tbl_pos_list->showMessage();
?>
<?php if ($tbl_pos_list->TotalRecords > 0 || $tbl_pos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_pos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_pos">
<?php if (!$tbl_pos_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_pos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_pos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_pos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_poslist" id="ftbl_poslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pos">
<div id="gmp_tbl_pos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_pos_list->TotalRecords > 0 || $tbl_pos_list->isGridEdit()) { ?>
<table id="tbl_tbl_poslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_pos->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_pos_list->renderListOptions();

// Render list options (header, left)
$tbl_pos_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_pos_list->pos_id->Visible) { // pos_id ?>
	<?php if ($tbl_pos_list->SortUrl($tbl_pos_list->pos_id) == "") { ?>
		<th data-name="pos_id" class="<?php echo $tbl_pos_list->pos_id->headerCellClass() ?>"><div id="elh_tbl_pos_pos_id" class="tbl_pos_pos_id"><div class="ew-table-header-caption"><?php echo $tbl_pos_list->pos_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pos_id" class="<?php echo $tbl_pos_list->pos_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pos_list->SortUrl($tbl_pos_list->pos_id) ?>', 1);"><div id="elh_tbl_pos_pos_id" class="tbl_pos_pos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pos_list->pos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pos_list->pos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pos_list->pos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pos_list->pos_desc->Visible) { // pos_desc ?>
	<?php if ($tbl_pos_list->SortUrl($tbl_pos_list->pos_desc) == "") { ?>
		<th data-name="pos_desc" class="<?php echo $tbl_pos_list->pos_desc->headerCellClass() ?>"><div id="elh_tbl_pos_pos_desc" class="tbl_pos_pos_desc"><div class="ew-table-header-caption"><?php echo $tbl_pos_list->pos_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pos_desc" class="<?php echo $tbl_pos_list->pos_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pos_list->SortUrl($tbl_pos_list->pos_desc) ?>', 1);"><div id="elh_tbl_pos_pos_desc" class="tbl_pos_pos_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pos_list->pos_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_pos_list->pos_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pos_list->pos_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_pos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_pos_list->ExportAll && $tbl_pos_list->isExport()) {
	$tbl_pos_list->StopRecord = $tbl_pos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_pos_list->TotalRecords > $tbl_pos_list->StartRecord + $tbl_pos_list->DisplayRecords - 1)
		$tbl_pos_list->StopRecord = $tbl_pos_list->StartRecord + $tbl_pos_list->DisplayRecords - 1;
	else
		$tbl_pos_list->StopRecord = $tbl_pos_list->TotalRecords;
}
$tbl_pos_list->RecordCount = $tbl_pos_list->StartRecord - 1;
if ($tbl_pos_list->Recordset && !$tbl_pos_list->Recordset->EOF) {
	$tbl_pos_list->Recordset->moveFirst();
	$selectLimit = $tbl_pos_list->UseSelectLimit;
	if (!$selectLimit && $tbl_pos_list->StartRecord > 1)
		$tbl_pos_list->Recordset->move($tbl_pos_list->StartRecord - 1);
} elseif (!$tbl_pos->AllowAddDeleteRow && $tbl_pos_list->StopRecord == 0) {
	$tbl_pos_list->StopRecord = $tbl_pos->GridAddRowCount;
}

// Initialize aggregate
$tbl_pos->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_pos->resetAttributes();
$tbl_pos_list->renderRow();
while ($tbl_pos_list->RecordCount < $tbl_pos_list->StopRecord) {
	$tbl_pos_list->RecordCount++;
	if ($tbl_pos_list->RecordCount >= $tbl_pos_list->StartRecord) {
		$tbl_pos_list->RowCount++;

		// Set up key count
		$tbl_pos_list->KeyCount = $tbl_pos_list->RowIndex;

		// Init row class and style
		$tbl_pos->resetAttributes();
		$tbl_pos->CssClass = "";
		if ($tbl_pos_list->isGridAdd()) {
		} else {
			$tbl_pos_list->loadRowValues($tbl_pos_list->Recordset); // Load row values
		}
		$tbl_pos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_pos->RowAttrs->merge(["data-rowindex" => $tbl_pos_list->RowCount, "id" => "r" . $tbl_pos_list->RowCount . "_tbl_pos", "data-rowtype" => $tbl_pos->RowType]);

		// Render row
		$tbl_pos_list->renderRow();

		// Render list options
		$tbl_pos_list->renderListOptions();
?>
	<tr <?php echo $tbl_pos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_pos_list->ListOptions->render("body", "left", $tbl_pos_list->RowCount);
?>
	<?php if ($tbl_pos_list->pos_id->Visible) { // pos_id ?>
		<td data-name="pos_id" <?php echo $tbl_pos_list->pos_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_pos_list->RowCount ?>_tbl_pos_pos_id">
<span<?php echo $tbl_pos_list->pos_id->viewAttributes() ?>><?php echo $tbl_pos_list->pos_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pos_list->pos_desc->Visible) { // pos_desc ?>
		<td data-name="pos_desc" <?php echo $tbl_pos_list->pos_desc->cellAttributes() ?>>
<span id="el<?php echo $tbl_pos_list->RowCount ?>_tbl_pos_pos_desc">
<span<?php echo $tbl_pos_list->pos_desc->viewAttributes() ?>><?php echo $tbl_pos_list->pos_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_pos_list->ListOptions->render("body", "right", $tbl_pos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_pos_list->isGridAdd())
		$tbl_pos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_pos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_pos_list->Recordset)
	$tbl_pos_list->Recordset->Close();
?>
<?php if (!$tbl_pos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_pos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_pos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_pos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_pos_list->TotalRecords == 0 && !$tbl_pos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_pos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_pos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_pos_list->isExport()) { ?>
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
$tbl_pos_list->terminate();
?>