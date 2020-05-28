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
$lib_cities_list = new lib_cities_list();

// Run the page
$lib_cities_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_cities_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lib_cities_list->isExport()) { ?>
<script>
var flib_citieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flib_citieslist = currentForm = new ew.Form("flib_citieslist", "list");
	flib_citieslist.formKeyCountName = '<?php echo $lib_cities_list->FormKeyCountName ?>';
	loadjs.done("flib_citieslist");
});
var flib_citieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flib_citieslistsrch = currentSearchForm = new ew.Form("flib_citieslistsrch");

	// Dynamic selection lists
	// Filters

	flib_citieslistsrch.filterList = <?php echo $lib_cities_list->getFilterList() ?>;
	loadjs.done("flib_citieslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$lib_cities_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($lib_cities_list->TotalRecords > 0 && $lib_cities_list->ExportOptions->visible()) { ?>
<?php $lib_cities_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($lib_cities_list->ImportOptions->visible()) { ?>
<?php $lib_cities_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($lib_cities_list->SearchOptions->visible()) { ?>
<?php $lib_cities_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($lib_cities_list->FilterOptions->visible()) { ?>
<?php $lib_cities_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$lib_cities_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$lib_cities_list->isExport() && !$lib_cities->CurrentAction) { ?>
<form name="flib_citieslistsrch" id="flib_citieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flib_citieslistsrch-search-panel" class="<?php echo $lib_cities_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="lib_cities">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $lib_cities_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($lib_cities_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($lib_cities_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $lib_cities_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($lib_cities_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($lib_cities_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($lib_cities_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($lib_cities_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $lib_cities_list->showPageHeader(); ?>
<?php
$lib_cities_list->showMessage();
?>
<?php if ($lib_cities_list->TotalRecords > 0 || $lib_cities->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($lib_cities_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> lib_cities">
<form name="flib_citieslist" id="flib_citieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_cities">
<div id="gmp_lib_cities" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($lib_cities_list->TotalRecords > 0 || $lib_cities_list->isGridEdit()) { ?>
<table id="tbl_lib_citieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$lib_cities->RowType = ROWTYPE_HEADER;

// Render list options
$lib_cities_list->renderListOptions();

// Render list options (header, left)
$lib_cities_list->ListOptions->render("header", "left");
?>
<?php if ($lib_cities_list->city_code->Visible) { // city_code ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->city_code) == "") { ?>
		<th data-name="city_code" class="<?php echo $lib_cities_list->city_code->headerCellClass() ?>"><div id="elh_lib_cities_city_code" class="lib_cities_city_code"><div class="ew-table-header-caption"><?php echo $lib_cities_list->city_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_code" class="<?php echo $lib_cities_list->city_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->city_code) ?>', 1);"><div id="elh_lib_cities_city_code" class="lib_cities_city_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->city_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->city_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->city_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_cities_list->city_name->Visible) { // city_name ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->city_name) == "") { ?>
		<th data-name="city_name" class="<?php echo $lib_cities_list->city_name->headerCellClass() ?>"><div id="elh_lib_cities_city_name" class="lib_cities_city_name"><div class="ew-table-header-caption"><?php echo $lib_cities_list->city_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_name" class="<?php echo $lib_cities_list->city_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->city_name) ?>', 1);"><div id="elh_lib_cities_city_name" class="lib_cities_city_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->city_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->city_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->city_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_cities_list->is_Urban->Visible) { // is_Urban ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->is_Urban) == "") { ?>
		<th data-name="is_Urban" class="<?php echo $lib_cities_list->is_Urban->headerCellClass() ?>"><div id="elh_lib_cities_is_Urban" class="lib_cities_is_Urban"><div class="ew-table-header-caption"><?php echo $lib_cities_list->is_Urban->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="is_Urban" class="<?php echo $lib_cities_list->is_Urban->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->is_Urban) ?>', 1);"><div id="elh_lib_cities_is_Urban" class="lib_cities_is_Urban">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->is_Urban->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->is_Urban->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->is_Urban->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_cities_list->locked->Visible) { // locked ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->locked) == "") { ?>
		<th data-name="locked" class="<?php echo $lib_cities_list->locked->headerCellClass() ?>"><div id="elh_lib_cities_locked" class="lib_cities_locked"><div class="ew-table-header-caption"><?php echo $lib_cities_list->locked->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="locked" class="<?php echo $lib_cities_list->locked->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->locked) ?>', 1);"><div id="elh_lib_cities_locked" class="lib_cities_locked">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->locked->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->locked->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->locked->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_cities_list->app_target_hh->Visible) { // app_target_hh ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->app_target_hh) == "") { ?>
		<th data-name="app_target_hh" class="<?php echo $lib_cities_list->app_target_hh->headerCellClass() ?>"><div id="elh_lib_cities_app_target_hh" class="lib_cities_app_target_hh"><div class="ew-table-header-caption"><?php echo $lib_cities_list->app_target_hh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="app_target_hh" class="<?php echo $lib_cities_list->app_target_hh->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->app_target_hh) ?>', 1);"><div id="elh_lib_cities_app_target_hh" class="lib_cities_app_target_hh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->app_target_hh->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->app_target_hh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->app_target_hh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_cities_list->_4p_areas->Visible) { // 4p_areas ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->_4p_areas) == "") { ?>
		<th data-name="_4p_areas" class="<?php echo $lib_cities_list->_4p_areas->headerCellClass() ?>"><div id="elh_lib_cities__4p_areas" class="lib_cities__4p_areas"><div class="ew-table-header-caption"><?php echo $lib_cities_list->_4p_areas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_4p_areas" class="<?php echo $lib_cities_list->_4p_areas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->_4p_areas) ?>', 1);"><div id="elh_lib_cities__4p_areas" class="lib_cities__4p_areas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->_4p_areas->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->_4p_areas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->_4p_areas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_cities_list->psgc_cty->Visible) { // psgc_cty ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->psgc_cty) == "") { ?>
		<th data-name="psgc_cty" class="<?php echo $lib_cities_list->psgc_cty->headerCellClass() ?>"><div id="elh_lib_cities_psgc_cty" class="lib_cities_psgc_cty"><div class="ew-table-header-caption"><?php echo $lib_cities_list->psgc_cty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="psgc_cty" class="<?php echo $lib_cities_list->psgc_cty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->psgc_cty) ?>', 1);"><div id="elh_lib_cities_psgc_cty" class="lib_cities_psgc_cty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->psgc_cty->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->psgc_cty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->psgc_cty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lib_cities_list->prov_code->Visible) { // prov_code ?>
	<?php if ($lib_cities_list->SortUrl($lib_cities_list->prov_code) == "") { ?>
		<th data-name="prov_code" class="<?php echo $lib_cities_list->prov_code->headerCellClass() ?>"><div id="elh_lib_cities_prov_code" class="lib_cities_prov_code"><div class="ew-table-header-caption"><?php echo $lib_cities_list->prov_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prov_code" class="<?php echo $lib_cities_list->prov_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lib_cities_list->SortUrl($lib_cities_list->prov_code) ?>', 1);"><div id="elh_lib_cities_prov_code" class="lib_cities_prov_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lib_cities_list->prov_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($lib_cities_list->prov_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lib_cities_list->prov_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$lib_cities_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($lib_cities_list->ExportAll && $lib_cities_list->isExport()) {
	$lib_cities_list->StopRecord = $lib_cities_list->TotalRecords;
} else {

	// Set the last record to display
	if ($lib_cities_list->TotalRecords > $lib_cities_list->StartRecord + $lib_cities_list->DisplayRecords - 1)
		$lib_cities_list->StopRecord = $lib_cities_list->StartRecord + $lib_cities_list->DisplayRecords - 1;
	else
		$lib_cities_list->StopRecord = $lib_cities_list->TotalRecords;
}
$lib_cities_list->RecordCount = $lib_cities_list->StartRecord - 1;
if ($lib_cities_list->Recordset && !$lib_cities_list->Recordset->EOF) {
	$lib_cities_list->Recordset->moveFirst();
	$selectLimit = $lib_cities_list->UseSelectLimit;
	if (!$selectLimit && $lib_cities_list->StartRecord > 1)
		$lib_cities_list->Recordset->move($lib_cities_list->StartRecord - 1);
} elseif (!$lib_cities->AllowAddDeleteRow && $lib_cities_list->StopRecord == 0) {
	$lib_cities_list->StopRecord = $lib_cities->GridAddRowCount;
}

// Initialize aggregate
$lib_cities->RowType = ROWTYPE_AGGREGATEINIT;
$lib_cities->resetAttributes();
$lib_cities_list->renderRow();
while ($lib_cities_list->RecordCount < $lib_cities_list->StopRecord) {
	$lib_cities_list->RecordCount++;
	if ($lib_cities_list->RecordCount >= $lib_cities_list->StartRecord) {
		$lib_cities_list->RowCount++;

		// Set up key count
		$lib_cities_list->KeyCount = $lib_cities_list->RowIndex;

		// Init row class and style
		$lib_cities->resetAttributes();
		$lib_cities->CssClass = "";
		if ($lib_cities_list->isGridAdd()) {
		} else {
			$lib_cities_list->loadRowValues($lib_cities_list->Recordset); // Load row values
		}
		$lib_cities->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$lib_cities->RowAttrs->merge(["data-rowindex" => $lib_cities_list->RowCount, "id" => "r" . $lib_cities_list->RowCount . "_lib_cities", "data-rowtype" => $lib_cities->RowType]);

		// Render row
		$lib_cities_list->renderRow();

		// Render list options
		$lib_cities_list->renderListOptions();
?>
	<tr <?php echo $lib_cities->rowAttributes() ?>>
<?php

// Render list options (body, left)
$lib_cities_list->ListOptions->render("body", "left", $lib_cities_list->RowCount);
?>
	<?php if ($lib_cities_list->city_code->Visible) { // city_code ?>
		<td data-name="city_code" <?php echo $lib_cities_list->city_code->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities_city_code">
<span<?php echo $lib_cities_list->city_code->viewAttributes() ?>><?php echo $lib_cities_list->city_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_cities_list->city_name->Visible) { // city_name ?>
		<td data-name="city_name" <?php echo $lib_cities_list->city_name->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities_city_name">
<span<?php echo $lib_cities_list->city_name->viewAttributes() ?>><?php echo $lib_cities_list->city_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_cities_list->is_Urban->Visible) { // is_Urban ?>
		<td data-name="is_Urban" <?php echo $lib_cities_list->is_Urban->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities_is_Urban">
<span<?php echo $lib_cities_list->is_Urban->viewAttributes() ?>><?php echo $lib_cities_list->is_Urban->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_cities_list->locked->Visible) { // locked ?>
		<td data-name="locked" <?php echo $lib_cities_list->locked->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities_locked">
<span<?php echo $lib_cities_list->locked->viewAttributes() ?>><?php echo $lib_cities_list->locked->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_cities_list->app_target_hh->Visible) { // app_target_hh ?>
		<td data-name="app_target_hh" <?php echo $lib_cities_list->app_target_hh->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities_app_target_hh">
<span<?php echo $lib_cities_list->app_target_hh->viewAttributes() ?>><?php echo $lib_cities_list->app_target_hh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_cities_list->_4p_areas->Visible) { // 4p_areas ?>
		<td data-name="_4p_areas" <?php echo $lib_cities_list->_4p_areas->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities__4p_areas">
<span<?php echo $lib_cities_list->_4p_areas->viewAttributes() ?>><?php echo $lib_cities_list->_4p_areas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_cities_list->psgc_cty->Visible) { // psgc_cty ?>
		<td data-name="psgc_cty" <?php echo $lib_cities_list->psgc_cty->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities_psgc_cty">
<span<?php echo $lib_cities_list->psgc_cty->viewAttributes() ?>><?php echo $lib_cities_list->psgc_cty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lib_cities_list->prov_code->Visible) { // prov_code ?>
		<td data-name="prov_code" <?php echo $lib_cities_list->prov_code->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_list->RowCount ?>_lib_cities_prov_code">
<span<?php echo $lib_cities_list->prov_code->viewAttributes() ?>><?php echo $lib_cities_list->prov_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$lib_cities_list->ListOptions->render("body", "right", $lib_cities_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$lib_cities_list->isGridAdd())
		$lib_cities_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$lib_cities->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($lib_cities_list->Recordset)
	$lib_cities_list->Recordset->Close();
?>
<?php if (!$lib_cities_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $lib_cities_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($lib_cities_list->TotalRecords == 0 && !$lib_cities->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $lib_cities_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$lib_cities_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lib_cities_list->isExport()) { ?>
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
$lib_cities_list->terminate();
?>