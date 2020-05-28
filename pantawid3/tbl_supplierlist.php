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
$tbl_supplier_list = new tbl_supplier_list();

// Run the page
$tbl_supplier_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplier_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_supplier_list->isExport()) { ?>
<script>
var ftbl_supplierlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_supplierlist = currentForm = new ew.Form("ftbl_supplierlist", "list");
	ftbl_supplierlist.formKeyCountName = '<?php echo $tbl_supplier_list->FormKeyCountName ?>';
	loadjs.done("ftbl_supplierlist");
});
var ftbl_supplierlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_supplierlistsrch = currentSearchForm = new ew.Form("ftbl_supplierlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_supplierlistsrch.filterList = <?php echo $tbl_supplier_list->getFilterList() ?>;
	loadjs.done("ftbl_supplierlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_supplier_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_supplier_list->TotalRecords > 0 && $tbl_supplier_list->ExportOptions->visible()) { ?>
<?php $tbl_supplier_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplier_list->ImportOptions->visible()) { ?>
<?php $tbl_supplier_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplier_list->SearchOptions->visible()) { ?>
<?php $tbl_supplier_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplier_list->FilterOptions->visible()) { ?>
<?php $tbl_supplier_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_supplier_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_supplier_list->isExport() && !$tbl_supplier->CurrentAction) { ?>
<form name="ftbl_supplierlistsrch" id="ftbl_supplierlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_supplierlistsrch-search-panel" class="<?php echo $tbl_supplier_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_supplier">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_supplier_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_supplier_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_supplier_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_supplier_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_supplier_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplier_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplier_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplier_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_supplier_list->showPageHeader(); ?>
<?php
$tbl_supplier_list->showMessage();
?>
<?php if ($tbl_supplier_list->TotalRecords > 0 || $tbl_supplier->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_supplier_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_supplier">
<form name="ftbl_supplierlist" id="ftbl_supplierlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplier">
<div id="gmp_tbl_supplier" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_supplier_list->TotalRecords > 0 || $tbl_supplier_list->isGridEdit()) { ?>
<table id="tbl_tbl_supplierlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_supplier->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_supplier_list->renderListOptions();

// Render list options (header, left)
$tbl_supplier_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_supplier_list->supplierID->Visible) { // supplierID ?>
	<?php if ($tbl_supplier_list->SortUrl($tbl_supplier_list->supplierID) == "") { ?>
		<th data-name="supplierID" class="<?php echo $tbl_supplier_list->supplierID->headerCellClass() ?>"><div id="elh_tbl_supplier_supplierID" class="tbl_supplier_supplierID"><div class="ew-table-header-caption"><?php echo $tbl_supplier_list->supplierID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="supplierID" class="<?php echo $tbl_supplier_list->supplierID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplier_list->SortUrl($tbl_supplier_list->supplierID) ?>', 1);"><div id="elh_tbl_supplier_supplierID" class="tbl_supplier_supplierID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplier_list->supplierID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplier_list->supplierID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplier_list->supplierID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplier_list->supplier_dsc->Visible) { // supplier_dsc ?>
	<?php if ($tbl_supplier_list->SortUrl($tbl_supplier_list->supplier_dsc) == "") { ?>
		<th data-name="supplier_dsc" class="<?php echo $tbl_supplier_list->supplier_dsc->headerCellClass() ?>"><div id="elh_tbl_supplier_supplier_dsc" class="tbl_supplier_supplier_dsc"><div class="ew-table-header-caption"><?php echo $tbl_supplier_list->supplier_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="supplier_dsc" class="<?php echo $tbl_supplier_list->supplier_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplier_list->SortUrl($tbl_supplier_list->supplier_dsc) ?>', 1);"><div id="elh_tbl_supplier_supplier_dsc" class="tbl_supplier_supplier_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplier_list->supplier_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplier_list->supplier_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplier_list->supplier_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_supplier_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_supplier_list->ExportAll && $tbl_supplier_list->isExport()) {
	$tbl_supplier_list->StopRecord = $tbl_supplier_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_supplier_list->TotalRecords > $tbl_supplier_list->StartRecord + $tbl_supplier_list->DisplayRecords - 1)
		$tbl_supplier_list->StopRecord = $tbl_supplier_list->StartRecord + $tbl_supplier_list->DisplayRecords - 1;
	else
		$tbl_supplier_list->StopRecord = $tbl_supplier_list->TotalRecords;
}
$tbl_supplier_list->RecordCount = $tbl_supplier_list->StartRecord - 1;
if ($tbl_supplier_list->Recordset && !$tbl_supplier_list->Recordset->EOF) {
	$tbl_supplier_list->Recordset->moveFirst();
	$selectLimit = $tbl_supplier_list->UseSelectLimit;
	if (!$selectLimit && $tbl_supplier_list->StartRecord > 1)
		$tbl_supplier_list->Recordset->move($tbl_supplier_list->StartRecord - 1);
} elseif (!$tbl_supplier->AllowAddDeleteRow && $tbl_supplier_list->StopRecord == 0) {
	$tbl_supplier_list->StopRecord = $tbl_supplier->GridAddRowCount;
}

// Initialize aggregate
$tbl_supplier->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_supplier->resetAttributes();
$tbl_supplier_list->renderRow();
while ($tbl_supplier_list->RecordCount < $tbl_supplier_list->StopRecord) {
	$tbl_supplier_list->RecordCount++;
	if ($tbl_supplier_list->RecordCount >= $tbl_supplier_list->StartRecord) {
		$tbl_supplier_list->RowCount++;

		// Set up key count
		$tbl_supplier_list->KeyCount = $tbl_supplier_list->RowIndex;

		// Init row class and style
		$tbl_supplier->resetAttributes();
		$tbl_supplier->CssClass = "";
		if ($tbl_supplier_list->isGridAdd()) {
		} else {
			$tbl_supplier_list->loadRowValues($tbl_supplier_list->Recordset); // Load row values
		}
		$tbl_supplier->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_supplier->RowAttrs->merge(["data-rowindex" => $tbl_supplier_list->RowCount, "id" => "r" . $tbl_supplier_list->RowCount . "_tbl_supplier", "data-rowtype" => $tbl_supplier->RowType]);

		// Render row
		$tbl_supplier_list->renderRow();

		// Render list options
		$tbl_supplier_list->renderListOptions();
?>
	<tr <?php echo $tbl_supplier->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_supplier_list->ListOptions->render("body", "left", $tbl_supplier_list->RowCount);
?>
	<?php if ($tbl_supplier_list->supplierID->Visible) { // supplierID ?>
		<td data-name="supplierID" <?php echo $tbl_supplier_list->supplierID->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_list->RowCount ?>_tbl_supplier_supplierID">
<span<?php echo $tbl_supplier_list->supplierID->viewAttributes() ?>><?php echo $tbl_supplier_list->supplierID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplier_list->supplier_dsc->Visible) { // supplier_dsc ?>
		<td data-name="supplier_dsc" <?php echo $tbl_supplier_list->supplier_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_list->RowCount ?>_tbl_supplier_supplier_dsc">
<span<?php echo $tbl_supplier_list->supplier_dsc->viewAttributes() ?>><?php echo $tbl_supplier_list->supplier_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_supplier_list->ListOptions->render("body", "right", $tbl_supplier_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_supplier_list->isGridAdd())
		$tbl_supplier_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_supplier->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_supplier_list->Recordset)
	$tbl_supplier_list->Recordset->Close();
?>
<?php if (!$tbl_supplier_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_supplier_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_supplier_list->TotalRecords == 0 && !$tbl_supplier->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_supplier_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_supplier_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_supplier_list->isExport()) { ?>
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
$tbl_supplier_list->terminate();
?>