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
$tbl_supplies_cat_list = new tbl_supplies_cat_list();

// Run the page
$tbl_supplies_cat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_cat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_supplies_cat_list->isExport()) { ?>
<script>
var ftbl_supplies_catlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_supplies_catlist = currentForm = new ew.Form("ftbl_supplies_catlist", "list");
	ftbl_supplies_catlist.formKeyCountName = '<?php echo $tbl_supplies_cat_list->FormKeyCountName ?>';
	loadjs.done("ftbl_supplies_catlist");
});
var ftbl_supplies_catlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_supplies_catlistsrch = currentSearchForm = new ew.Form("ftbl_supplies_catlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_supplies_catlistsrch.filterList = <?php echo $tbl_supplies_cat_list->getFilterList() ?>;
	loadjs.done("ftbl_supplies_catlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_supplies_cat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_supplies_cat_list->TotalRecords > 0 && $tbl_supplies_cat_list->ExportOptions->visible()) { ?>
<?php $tbl_supplies_cat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplies_cat_list->ImportOptions->visible()) { ?>
<?php $tbl_supplies_cat_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplies_cat_list->SearchOptions->visible()) { ?>
<?php $tbl_supplies_cat_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplies_cat_list->FilterOptions->visible()) { ?>
<?php $tbl_supplies_cat_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_supplies_cat_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_supplies_cat_list->isExport() && !$tbl_supplies_cat->CurrentAction) { ?>
<form name="ftbl_supplies_catlistsrch" id="ftbl_supplies_catlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_supplies_catlistsrch-search-panel" class="<?php echo $tbl_supplies_cat_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_supplies_cat">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_supplies_cat_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_supplies_cat_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_supplies_cat_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_supplies_cat_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_supplies_cat_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplies_cat_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplies_cat_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplies_cat_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_supplies_cat_list->showPageHeader(); ?>
<?php
$tbl_supplies_cat_list->showMessage();
?>
<?php if ($tbl_supplies_cat_list->TotalRecords > 0 || $tbl_supplies_cat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_supplies_cat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_supplies_cat">
<?php if (!$tbl_supplies_cat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_supplies_cat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_supplies_cat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_supplies_cat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_supplies_catlist" id="ftbl_supplies_catlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies_cat">
<div id="gmp_tbl_supplies_cat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_supplies_cat_list->TotalRecords > 0 || $tbl_supplies_cat_list->isGridEdit()) { ?>
<table id="tbl_tbl_supplies_catlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_supplies_cat->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_supplies_cat_list->renderListOptions();

// Render list options (header, left)
$tbl_supplies_cat_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_supplies_cat_list->suppliescat_id->Visible) { // suppliescat_id ?>
	<?php if ($tbl_supplies_cat_list->SortUrl($tbl_supplies_cat_list->suppliescat_id) == "") { ?>
		<th data-name="suppliescat_id" class="<?php echo $tbl_supplies_cat_list->suppliescat_id->headerCellClass() ?>"><div id="elh_tbl_supplies_cat_suppliescat_id" class="tbl_supplies_cat_suppliescat_id"><div class="ew-table-header-caption"><?php echo $tbl_supplies_cat_list->suppliescat_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="suppliescat_id" class="<?php echo $tbl_supplies_cat_list->suppliescat_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_cat_list->SortUrl($tbl_supplies_cat_list->suppliescat_id) ?>', 1);"><div id="elh_tbl_supplies_cat_suppliescat_id" class="tbl_supplies_cat_suppliescat_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_cat_list->suppliescat_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_cat_list->suppliescat_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_cat_list->suppliescat_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_cat_list->category_dsc->Visible) { // category_dsc ?>
	<?php if ($tbl_supplies_cat_list->SortUrl($tbl_supplies_cat_list->category_dsc) == "") { ?>
		<th data-name="category_dsc" class="<?php echo $tbl_supplies_cat_list->category_dsc->headerCellClass() ?>"><div id="elh_tbl_supplies_cat_category_dsc" class="tbl_supplies_cat_category_dsc"><div class="ew-table-header-caption"><?php echo $tbl_supplies_cat_list->category_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category_dsc" class="<?php echo $tbl_supplies_cat_list->category_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_cat_list->SortUrl($tbl_supplies_cat_list->category_dsc) ?>', 1);"><div id="elh_tbl_supplies_cat_category_dsc" class="tbl_supplies_cat_category_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_cat_list->category_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_cat_list->category_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_cat_list->category_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_supplies_cat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_supplies_cat_list->ExportAll && $tbl_supplies_cat_list->isExport()) {
	$tbl_supplies_cat_list->StopRecord = $tbl_supplies_cat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_supplies_cat_list->TotalRecords > $tbl_supplies_cat_list->StartRecord + $tbl_supplies_cat_list->DisplayRecords - 1)
		$tbl_supplies_cat_list->StopRecord = $tbl_supplies_cat_list->StartRecord + $tbl_supplies_cat_list->DisplayRecords - 1;
	else
		$tbl_supplies_cat_list->StopRecord = $tbl_supplies_cat_list->TotalRecords;
}
$tbl_supplies_cat_list->RecordCount = $tbl_supplies_cat_list->StartRecord - 1;
if ($tbl_supplies_cat_list->Recordset && !$tbl_supplies_cat_list->Recordset->EOF) {
	$tbl_supplies_cat_list->Recordset->moveFirst();
	$selectLimit = $tbl_supplies_cat_list->UseSelectLimit;
	if (!$selectLimit && $tbl_supplies_cat_list->StartRecord > 1)
		$tbl_supplies_cat_list->Recordset->move($tbl_supplies_cat_list->StartRecord - 1);
} elseif (!$tbl_supplies_cat->AllowAddDeleteRow && $tbl_supplies_cat_list->StopRecord == 0) {
	$tbl_supplies_cat_list->StopRecord = $tbl_supplies_cat->GridAddRowCount;
}

// Initialize aggregate
$tbl_supplies_cat->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_supplies_cat->resetAttributes();
$tbl_supplies_cat_list->renderRow();
while ($tbl_supplies_cat_list->RecordCount < $tbl_supplies_cat_list->StopRecord) {
	$tbl_supplies_cat_list->RecordCount++;
	if ($tbl_supplies_cat_list->RecordCount >= $tbl_supplies_cat_list->StartRecord) {
		$tbl_supplies_cat_list->RowCount++;

		// Set up key count
		$tbl_supplies_cat_list->KeyCount = $tbl_supplies_cat_list->RowIndex;

		// Init row class and style
		$tbl_supplies_cat->resetAttributes();
		$tbl_supplies_cat->CssClass = "";
		if ($tbl_supplies_cat_list->isGridAdd()) {
		} else {
			$tbl_supplies_cat_list->loadRowValues($tbl_supplies_cat_list->Recordset); // Load row values
		}
		$tbl_supplies_cat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_supplies_cat->RowAttrs->merge(["data-rowindex" => $tbl_supplies_cat_list->RowCount, "id" => "r" . $tbl_supplies_cat_list->RowCount . "_tbl_supplies_cat", "data-rowtype" => $tbl_supplies_cat->RowType]);

		// Render row
		$tbl_supplies_cat_list->renderRow();

		// Render list options
		$tbl_supplies_cat_list->renderListOptions();
?>
	<tr <?php echo $tbl_supplies_cat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_supplies_cat_list->ListOptions->render("body", "left", $tbl_supplies_cat_list->RowCount);
?>
	<?php if ($tbl_supplies_cat_list->suppliescat_id->Visible) { // suppliescat_id ?>
		<td data-name="suppliescat_id" <?php echo $tbl_supplies_cat_list->suppliescat_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_cat_list->RowCount ?>_tbl_supplies_cat_suppliescat_id">
<span<?php echo $tbl_supplies_cat_list->suppliescat_id->viewAttributes() ?>><?php echo $tbl_supplies_cat_list->suppliescat_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_cat_list->category_dsc->Visible) { // category_dsc ?>
		<td data-name="category_dsc" <?php echo $tbl_supplies_cat_list->category_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_cat_list->RowCount ?>_tbl_supplies_cat_category_dsc">
<span<?php echo $tbl_supplies_cat_list->category_dsc->viewAttributes() ?>><?php echo $tbl_supplies_cat_list->category_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_supplies_cat_list->ListOptions->render("body", "right", $tbl_supplies_cat_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_supplies_cat_list->isGridAdd())
		$tbl_supplies_cat_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_supplies_cat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_supplies_cat_list->Recordset)
	$tbl_supplies_cat_list->Recordset->Close();
?>
<?php if (!$tbl_supplies_cat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_supplies_cat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_supplies_cat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_supplies_cat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_supplies_cat_list->TotalRecords == 0 && !$tbl_supplies_cat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_supplies_cat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_supplies_cat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_supplies_cat_list->isExport()) { ?>
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
$tbl_supplies_cat_list->terminate();
?>