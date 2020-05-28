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
$lib_provinces_list = new lib_provinces_list();

// Run the page
$lib_provinces_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_provinces_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lib_provinces_list->isExport()) { ?>
<script>
var flib_provinceslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flib_provinceslist = currentForm = new ew.Form("flib_provinceslist", "list");
	flib_provinceslist.formKeyCountName = '<?php echo $lib_provinces_list->FormKeyCountName ?>';
	loadjs.done("flib_provinceslist");
});
var flib_provinceslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flib_provinceslistsrch = currentSearchForm = new ew.Form("flib_provinceslistsrch");

	// Dynamic selection lists
	// Filters

	flib_provinceslistsrch.filterList = <?php echo $lib_provinces_list->getFilterList() ?>;
	loadjs.done("flib_provinceslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$lib_provinces_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($lib_provinces_list->TotalRecords > 0 && $lib_provinces_list->ExportOptions->visible()) { ?>
<?php $lib_provinces_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($lib_provinces_list->ImportOptions->visible()) { ?>
<?php $lib_provinces_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($lib_provinces_list->SearchOptions->visible()) { ?>
<?php $lib_provinces_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($lib_provinces_list->FilterOptions->visible()) { ?>
<?php $lib_provinces_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$lib_provinces_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$lib_provinces_list->isExport() && !$lib_provinces->CurrentAction) { ?>
<form name="flib_provinceslistsrch" id="flib_provinceslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flib_provinceslistsrch-search-panel" class="<?php echo $lib_provinces_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="lib_provinces">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $lib_provinces_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($lib_provinces_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($lib_provinces_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $lib_provinces_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($lib_provinces_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($lib_provinces_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($lib_provinces_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($lib_provinces_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $lib_provinces_list->showPageHeader(); ?>
<?php
$lib_provinces_list->showMessage();
?>
<?php if ($lib_provinces_list->TotalRecords > 0 || $lib_provinces->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($lib_provinces_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> lib_provinces">
<form name="flib_provinceslist" id="flib_provinceslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_provinces">
<div id="gmp_lib_provinces" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($lib_provinces_list->TotalRecords > 0 || $lib_provinces_list->isGridEdit()) { ?>
<table id="tbl_lib_provinceslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$lib_provinces->RowType = ROWTYPE_HEADER;

// Render list options
$lib_provinces_list->renderListOptions();

// Render list options (header, left)
$lib_provinces_list->ListOptions->render("header", "left");
?>
<?php if ($lib_provinces_list->prov_code->Visible) { // prov_code ?>
	<?php if ($lib_provinces_list->SortUrl($lib_provinces_list->prov_code) == "") { ?>
		<th data-name="prov_code" class="<?php echo $lib_provinces_list->prov_code->headerCellClass() ?>"><div id="elh_lib_provinces_prov_code" class="lib_provinces_prov_code"><div class="ew-table-header-caption"><?php echo $lib_provinces_list->prov_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prov_code" class="<?php echo $lib_provinces_list->prov_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_provinces_list->SortUrl($lib_provinces_list->prov_code) ?>', 1);"><div id="elh_lib_provinces_prov_code" class="lib_provinces_prov_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_provinces_list->prov_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_provinces_list->prov_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_provinces_list->prov_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_provinces_list->prov_name->Visible) { // prov_name ?>
	<?php if ($lib_provinces_list->SortUrl($lib_provinces_list->prov_name) == "") { ?>
		<th data-name="prov_name" class="<?php echo $lib_provinces_list->prov_name->headerCellClass() ?>"><div id="elh_lib_provinces_prov_name" class="lib_provinces_prov_name"><div class="ew-table-header-caption"><?php echo $lib_provinces_list->prov_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prov_name" class="<?php echo $lib_provinces_list->prov_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_provinces_list->SortUrl($lib_provinces_list->prov_name) ?>', 1);"><div id="elh_lib_provinces_prov_name" class="lib_provinces_prov_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_provinces_list->prov_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_provinces_list->prov_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_provinces_list->prov_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_provinces_list->psgc_prv->Visible) { // psgc_prv ?>
	<?php if ($lib_provinces_list->SortUrl($lib_provinces_list->psgc_prv) == "") { ?>
		<th data-name="psgc_prv" class="<?php echo $lib_provinces_list->psgc_prv->headerCellClass() ?>"><div id="elh_lib_provinces_psgc_prv" class="lib_provinces_psgc_prv"><div class="ew-table-header-caption"><?php echo $lib_provinces_list->psgc_prv->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="psgc_prv" class="<?php echo $lib_provinces_list->psgc_prv->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_provinces_list->SortUrl($lib_provinces_list->psgc_prv) ?>', 1);"><div id="elh_lib_provinces_psgc_prv" class="lib_provinces_psgc_prv">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_provinces_list->psgc_prv->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_provinces_list->psgc_prv->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_provinces_list->psgc_prv->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_provinces_list->region_code->Visible) { // region_code ?>
	<?php if ($lib_provinces_list->SortUrl($lib_provinces_list->region_code) == "") { ?>
		<th data-name="region_code" class="<?php echo $lib_provinces_list->region_code->headerCellClass() ?>"><div id="elh_lib_provinces_region_code" class="lib_provinces_region_code"><div class="ew-table-header-caption"><?php echo $lib_provinces_list->region_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_code" class="<?php echo $lib_provinces_list->region_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_provinces_list->SortUrl($lib_provinces_list->region_code) ?>', 1);"><div id="elh_lib_provinces_region_code" class="lib_provinces_region_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_provinces_list->region_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_provinces_list->region_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_provinces_list->region_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$lib_provinces_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($lib_provinces_list->ExportAll && $lib_provinces_list->isExport()) {
	$lib_provinces_list->StopRecord = $lib_provinces_list->TotalRecords;
} else {

	// Set the last record to display
	if ($lib_provinces_list->TotalRecords > $lib_provinces_list->StartRecord + $lib_provinces_list->DisplayRecords - 1)
		$lib_provinces_list->StopRecord = $lib_provinces_list->StartRecord + $lib_provinces_list->DisplayRecords - 1;
	else
		$lib_provinces_list->StopRecord = $lib_provinces_list->TotalRecords;
}
$lib_provinces_list->RecordCount = $lib_provinces_list->StartRecord - 1;
if ($lib_provinces_list->Recordset && !$lib_provinces_list->Recordset->EOF) {
	$lib_provinces_list->Recordset->moveFirst();
	$selectLimit = $lib_provinces_list->UseSelectLimit;
	if (!$selectLimit && $lib_provinces_list->StartRecord > 1)
		$lib_provinces_list->Recordset->move($lib_provinces_list->StartRecord - 1);
} elseif (!$lib_provinces->AllowAddDeleteRow && $lib_provinces_list->StopRecord == 0) {
	$lib_provinces_list->StopRecord = $lib_provinces->GridAddRowCount;
}

// Initialize aggregate
$lib_provinces->RowType = ROWTYPE_AGGREGATEINIT;
$lib_provinces->resetAttributes();
$lib_provinces_list->renderRow();
while ($lib_provinces_list->RecordCount < $lib_provinces_list->StopRecord) {
	$lib_provinces_list->RecordCount++;
	if ($lib_provinces_list->RecordCount >= $lib_provinces_list->StartRecord) {
		$lib_provinces_list->RowCount++;

		// Set up key count
		$lib_provinces_list->KeyCount = $lib_provinces_list->RowIndex;

		// Init row class and style
		$lib_provinces->resetAttributes();
		$lib_provinces->CssClass = "";
		if ($lib_provinces_list->isGridAdd()) {
		} else {
			$lib_provinces_list->loadRowValues($lib_provinces_list->Recordset); // Load row values
		}
		$lib_provinces->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$lib_provinces->RowAttrs->merge(["data-rowindex" => $lib_provinces_list->RowCount, "id" => "r" . $lib_provinces_list->RowCount . "_lib_provinces", "data-rowtype" => $lib_provinces->RowType]);

		// Render row
		$lib_provinces_list->renderRow();

		// Render list options
		$lib_provinces_list->renderListOptions();
?>
	<tr <?php echo $lib_provinces->rowAttributes() ?>>
<?php

// Render list options (body, left)
$lib_provinces_list->ListOptions->render("body", "left", $lib_provinces_list->RowCount);
?>
	<?php if ($lib_provinces_list->prov_code->Visible) { // prov_code ?>
		<td data-name="prov_code" <?php echo $lib_provinces_list->prov_code->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_list->RowCount ?>_lib_provinces_prov_code">
<span<?php echo $lib_provinces_list->prov_code->viewAttributes() ?>><?php echo $lib_provinces_list->prov_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_provinces_list->prov_name->Visible) { // prov_name ?>
		<td data-name="prov_name" <?php echo $lib_provinces_list->prov_name->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_list->RowCount ?>_lib_provinces_prov_name">
<span<?php echo $lib_provinces_list->prov_name->viewAttributes() ?>><?php echo $lib_provinces_list->prov_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_provinces_list->psgc_prv->Visible) { // psgc_prv ?>
		<td data-name="psgc_prv" <?php echo $lib_provinces_list->psgc_prv->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_list->RowCount ?>_lib_provinces_psgc_prv">
<span<?php echo $lib_provinces_list->psgc_prv->viewAttributes() ?>><?php echo $lib_provinces_list->psgc_prv->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_provinces_list->region_code->Visible) { // region_code ?>
		<td data-name="region_code" <?php echo $lib_provinces_list->region_code->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_list->RowCount ?>_lib_provinces_region_code">
<span<?php echo $lib_provinces_list->region_code->viewAttributes() ?>><?php echo $lib_provinces_list->region_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$lib_provinces_list->ListOptions->render("body", "right", $lib_provinces_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$lib_provinces_list->isGridAdd())
		$lib_provinces_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$lib_provinces->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($lib_provinces_list->Recordset)
	$lib_provinces_list->Recordset->Close();
?>
<?php if (!$lib_provinces_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $lib_provinces_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($lib_provinces_list->TotalRecords == 0 && !$lib_provinces->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $lib_provinces_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$lib_provinces_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lib_provinces_list->isExport()) { ?>
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
$lib_provinces_list->terminate();
?>