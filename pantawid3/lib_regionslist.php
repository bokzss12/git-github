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
$lib_regions_list = new lib_regions_list();

// Run the page
$lib_regions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_regions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lib_regions_list->isExport()) { ?>
<script>
var flib_regionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flib_regionslist = currentForm = new ew.Form("flib_regionslist", "list");
	flib_regionslist.formKeyCountName = '<?php echo $lib_regions_list->FormKeyCountName ?>';
	loadjs.done("flib_regionslist");
});
var flib_regionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flib_regionslistsrch = currentSearchForm = new ew.Form("flib_regionslistsrch");

	// Dynamic selection lists
	// Filters

	flib_regionslistsrch.filterList = <?php echo $lib_regions_list->getFilterList() ?>;
	loadjs.done("flib_regionslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$lib_regions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($lib_regions_list->TotalRecords > 0 && $lib_regions_list->ExportOptions->visible()) { ?>
<?php $lib_regions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($lib_regions_list->ImportOptions->visible()) { ?>
<?php $lib_regions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($lib_regions_list->SearchOptions->visible()) { ?>
<?php $lib_regions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($lib_regions_list->FilterOptions->visible()) { ?>
<?php $lib_regions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$lib_regions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$lib_regions_list->isExport() && !$lib_regions->CurrentAction) { ?>
<form name="flib_regionslistsrch" id="flib_regionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flib_regionslistsrch-search-panel" class="<?php echo $lib_regions_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="lib_regions">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $lib_regions_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($lib_regions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($lib_regions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $lib_regions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($lib_regions_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($lib_regions_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($lib_regions_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($lib_regions_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $lib_regions_list->showPageHeader(); ?>
<?php
$lib_regions_list->showMessage();
?>
<?php if ($lib_regions_list->TotalRecords > 0 || $lib_regions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($lib_regions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> lib_regions">
<form name="flib_regionslist" id="flib_regionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_regions">
<div id="gmp_lib_regions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($lib_regions_list->TotalRecords > 0 || $lib_regions_list->isGridEdit()) { ?>
<table id="tbl_lib_regionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$lib_regions->RowType = ROWTYPE_HEADER;

// Render list options
$lib_regions_list->renderListOptions();

// Render list options (header, left)
$lib_regions_list->ListOptions->render("header", "left");
?>
<?php if ($lib_regions_list->region_code->Visible) { // region_code ?>
	<?php if ($lib_regions_list->SortUrl($lib_regions_list->region_code) == "") { ?>
		<th data-name="region_code" class="<?php echo $lib_regions_list->region_code->headerCellClass() ?>"><div id="elh_lib_regions_region_code" class="lib_regions_region_code"><div class="ew-table-header-caption"><?php echo $lib_regions_list->region_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_code" class="<?php echo $lib_regions_list->region_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_regions_list->SortUrl($lib_regions_list->region_code) ?>', 1);"><div id="elh_lib_regions_region_code" class="lib_regions_region_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_regions_list->region_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_regions_list->region_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_regions_list->region_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_regions_list->region_name->Visible) { // region_name ?>
	<?php if ($lib_regions_list->SortUrl($lib_regions_list->region_name) == "") { ?>
		<th data-name="region_name" class="<?php echo $lib_regions_list->region_name->headerCellClass() ?>"><div id="elh_lib_regions_region_name" class="lib_regions_region_name"><div class="ew-table-header-caption"><?php echo $lib_regions_list->region_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_name" class="<?php echo $lib_regions_list->region_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_regions_list->SortUrl($lib_regions_list->region_name) ?>', 1);"><div id="elh_lib_regions_region_name" class="lib_regions_region_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_regions_list->region_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_regions_list->region_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_regions_list->region_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_regions_list->region_nick->Visible) { // region_nick ?>
	<?php if ($lib_regions_list->SortUrl($lib_regions_list->region_nick) == "") { ?>
		<th data-name="region_nick" class="<?php echo $lib_regions_list->region_nick->headerCellClass() ?>"><div id="elh_lib_regions_region_nick" class="lib_regions_region_nick"><div class="ew-table-header-caption"><?php echo $lib_regions_list->region_nick->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_nick" class="<?php echo $lib_regions_list->region_nick->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_regions_list->SortUrl($lib_regions_list->region_nick) ?>', 1);"><div id="elh_lib_regions_region_nick" class="lib_regions_region_nick">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_regions_list->region_nick->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_regions_list->region_nick->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_regions_list->region_nick->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_regions_list->region_director->Visible) { // region_director ?>
	<?php if ($lib_regions_list->SortUrl($lib_regions_list->region_director) == "") { ?>
		<th data-name="region_director" class="<?php echo $lib_regions_list->region_director->headerCellClass() ?>"><div id="elh_lib_regions_region_director" class="lib_regions_region_director"><div class="ew-table-header-caption"><?php echo $lib_regions_list->region_director->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region_director" class="<?php echo $lib_regions_list->region_director->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_regions_list->SortUrl($lib_regions_list->region_director) ?>', 1);"><div id="elh_lib_regions_region_director" class="lib_regions_region_director">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_regions_list->region_director->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_regions_list->region_director->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_regions_list->region_director->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_regions_list->psgc_rgn->Visible) { // psgc_rgn ?>
	<?php if ($lib_regions_list->SortUrl($lib_regions_list->psgc_rgn) == "") { ?>
		<th data-name="psgc_rgn" class="<?php echo $lib_regions_list->psgc_rgn->headerCellClass() ?>"><div id="elh_lib_regions_psgc_rgn" class="lib_regions_psgc_rgn"><div class="ew-table-header-caption"><?php echo $lib_regions_list->psgc_rgn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="psgc_rgn" class="<?php echo $lib_regions_list->psgc_rgn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_regions_list->SortUrl($lib_regions_list->psgc_rgn) ?>', 1);"><div id="elh_lib_regions_psgc_rgn" class="lib_regions_psgc_rgn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_regions_list->psgc_rgn->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_regions_list->psgc_rgn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_regions_list->psgc_rgn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$lib_regions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($lib_regions_list->ExportAll && $lib_regions_list->isExport()) {
	$lib_regions_list->StopRecord = $lib_regions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($lib_regions_list->TotalRecords > $lib_regions_list->StartRecord + $lib_regions_list->DisplayRecords - 1)
		$lib_regions_list->StopRecord = $lib_regions_list->StartRecord + $lib_regions_list->DisplayRecords - 1;
	else
		$lib_regions_list->StopRecord = $lib_regions_list->TotalRecords;
}
$lib_regions_list->RecordCount = $lib_regions_list->StartRecord - 1;
if ($lib_regions_list->Recordset && !$lib_regions_list->Recordset->EOF) {
	$lib_regions_list->Recordset->moveFirst();
	$selectLimit = $lib_regions_list->UseSelectLimit;
	if (!$selectLimit && $lib_regions_list->StartRecord > 1)
		$lib_regions_list->Recordset->move($lib_regions_list->StartRecord - 1);
} elseif (!$lib_regions->AllowAddDeleteRow && $lib_regions_list->StopRecord == 0) {
	$lib_regions_list->StopRecord = $lib_regions->GridAddRowCount;
}

// Initialize aggregate
$lib_regions->RowType = ROWTYPE_AGGREGATEINIT;
$lib_regions->resetAttributes();
$lib_regions_list->renderRow();
while ($lib_regions_list->RecordCount < $lib_regions_list->StopRecord) {
	$lib_regions_list->RecordCount++;
	if ($lib_regions_list->RecordCount >= $lib_regions_list->StartRecord) {
		$lib_regions_list->RowCount++;

		// Set up key count
		$lib_regions_list->KeyCount = $lib_regions_list->RowIndex;

		// Init row class and style
		$lib_regions->resetAttributes();
		$lib_regions->CssClass = "";
		if ($lib_regions_list->isGridAdd()) {
		} else {
			$lib_regions_list->loadRowValues($lib_regions_list->Recordset); // Load row values
		}
		$lib_regions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$lib_regions->RowAttrs->merge(["data-rowindex" => $lib_regions_list->RowCount, "id" => "r" . $lib_regions_list->RowCount . "_lib_regions", "data-rowtype" => $lib_regions->RowType]);

		// Render row
		$lib_regions_list->renderRow();

		// Render list options
		$lib_regions_list->renderListOptions();
?>
	<tr <?php echo $lib_regions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$lib_regions_list->ListOptions->render("body", "left", $lib_regions_list->RowCount);
?>
	<?php if ($lib_regions_list->region_code->Visible) { // region_code ?>
		<td data-name="region_code" <?php echo $lib_regions_list->region_code->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_list->RowCount ?>_lib_regions_region_code">
<span<?php echo $lib_regions_list->region_code->viewAttributes() ?>><?php echo $lib_regions_list->region_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_regions_list->region_name->Visible) { // region_name ?>
		<td data-name="region_name" <?php echo $lib_regions_list->region_name->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_list->RowCount ?>_lib_regions_region_name">
<span<?php echo $lib_regions_list->region_name->viewAttributes() ?>><?php echo $lib_regions_list->region_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_regions_list->region_nick->Visible) { // region_nick ?>
		<td data-name="region_nick" <?php echo $lib_regions_list->region_nick->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_list->RowCount ?>_lib_regions_region_nick">
<span<?php echo $lib_regions_list->region_nick->viewAttributes() ?>><?php echo $lib_regions_list->region_nick->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_regions_list->region_director->Visible) { // region_director ?>
		<td data-name="region_director" <?php echo $lib_regions_list->region_director->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_list->RowCount ?>_lib_regions_region_director">
<span<?php echo $lib_regions_list->region_director->viewAttributes() ?>><?php echo $lib_regions_list->region_director->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_regions_list->psgc_rgn->Visible) { // psgc_rgn ?>
		<td data-name="psgc_rgn" <?php echo $lib_regions_list->psgc_rgn->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_list->RowCount ?>_lib_regions_psgc_rgn">
<span<?php echo $lib_regions_list->psgc_rgn->viewAttributes() ?>><?php echo $lib_regions_list->psgc_rgn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$lib_regions_list->ListOptions->render("body", "right", $lib_regions_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$lib_regions_list->isGridAdd())
		$lib_regions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$lib_regions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($lib_regions_list->Recordset)
	$lib_regions_list->Recordset->Close();
?>
<?php if (!$lib_regions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $lib_regions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($lib_regions_list->TotalRecords == 0 && !$lib_regions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $lib_regions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$lib_regions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lib_regions_list->isExport()) { ?>
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
$lib_regions_list->terminate();
?>