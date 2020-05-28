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
$tbl_accountable_name_list = new tbl_accountable_name_list();

// Run the page
$tbl_accountable_name_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_accountable_name_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_accountable_name_list->isExport()) { ?>
<script>
var ftbl_accountable_namelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_accountable_namelist = currentForm = new ew.Form("ftbl_accountable_namelist", "list");
	ftbl_accountable_namelist.formKeyCountName = '<?php echo $tbl_accountable_name_list->FormKeyCountName ?>';
	loadjs.done("ftbl_accountable_namelist");
});
var ftbl_accountable_namelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_accountable_namelistsrch = currentSearchForm = new ew.Form("ftbl_accountable_namelistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_accountable_namelistsrch.filterList = <?php echo $tbl_accountable_name_list->getFilterList() ?>;
	loadjs.done("ftbl_accountable_namelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_accountable_name_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_accountable_name_list->TotalRecords > 0 && $tbl_accountable_name_list->ExportOptions->visible()) { ?>
<?php $tbl_accountable_name_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->ImportOptions->visible()) { ?>
<?php $tbl_accountable_name_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->SearchOptions->visible()) { ?>
<?php $tbl_accountable_name_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->FilterOptions->visible()) { ?>
<?php $tbl_accountable_name_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_accountable_name_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_accountable_name_list->isExport() && !$tbl_accountable_name->CurrentAction) { ?>
<form name="ftbl_accountable_namelistsrch" id="ftbl_accountable_namelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_accountable_namelistsrch-search-panel" class="<?php echo $tbl_accountable_name_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_accountable_name">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_accountable_name_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_accountable_name_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_accountable_name_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_accountable_name_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_accountable_name_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_accountable_name_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_accountable_name_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_accountable_name_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_accountable_name_list->showPageHeader(); ?>
<?php
$tbl_accountable_name_list->showMessage();
?>
<?php if ($tbl_accountable_name_list->TotalRecords > 0 || $tbl_accountable_name->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_accountable_name_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_accountable_name">
<?php if (!$tbl_accountable_name_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_accountable_name_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_accountable_name_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_accountable_name_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_accountable_namelist" id="ftbl_accountable_namelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_accountable_name">
<div id="gmp_tbl_accountable_name" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_accountable_name_list->TotalRecords > 0 || $tbl_accountable_name_list->isGridEdit()) { ?>
<table id="tbl_tbl_accountable_namelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_accountable_name->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_accountable_name_list->renderListOptions();

// Render list options (header, left)
$tbl_accountable_name_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_accountable_name_list->id->Visible) { // id ?>
	<?php if ($tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $tbl_accountable_name_list->id->headerCellClass() ?>"><div id="elh_tbl_accountable_name_id" class="tbl_accountable_name_id"><div class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tbl_accountable_name_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->id) ?>', 1);"><div id="elh_tbl_accountable_name_id" class="tbl_accountable_name_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_accountable_name_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_accountable_name_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->name_id->Visible) { // name_id ?>
	<?php if ($tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->name_id) == "") { ?>
		<th data-name="name_id" class="<?php echo $tbl_accountable_name_list->name_id->headerCellClass() ?>"><div id="elh_tbl_accountable_name_name_id" class="tbl_accountable_name_name_id"><div class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->name_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name_id" class="<?php echo $tbl_accountable_name_list->name_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->name_id) ?>', 1);"><div id="elh_tbl_accountable_name_name_id" class="tbl_accountable_name_name_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->name_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_accountable_name_list->name_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_accountable_name_list->name_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->last_name->Visible) { // last_name ?>
	<?php if ($tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->last_name) == "") { ?>
		<th data-name="last_name" class="<?php echo $tbl_accountable_name_list->last_name->headerCellClass() ?>"><div id="elh_tbl_accountable_name_last_name" class="tbl_accountable_name_last_name"><div class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->last_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="last_name" class="<?php echo $tbl_accountable_name_list->last_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->last_name) ?>', 1);"><div id="elh_tbl_accountable_name_last_name" class="tbl_accountable_name_last_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->last_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_accountable_name_list->last_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_accountable_name_list->last_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->first_name->Visible) { // first_name ?>
	<?php if ($tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->first_name) == "") { ?>
		<th data-name="first_name" class="<?php echo $tbl_accountable_name_list->first_name->headerCellClass() ?>"><div id="elh_tbl_accountable_name_first_name" class="tbl_accountable_name_first_name"><div class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->first_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="first_name" class="<?php echo $tbl_accountable_name_list->first_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->first_name) ?>', 1);"><div id="elh_tbl_accountable_name_first_name" class="tbl_accountable_name_first_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->first_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_accountable_name_list->first_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_accountable_name_list->first_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->mid_name->Visible) { // mid_name ?>
	<?php if ($tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->mid_name) == "") { ?>
		<th data-name="mid_name" class="<?php echo $tbl_accountable_name_list->mid_name->headerCellClass() ?>"><div id="elh_tbl_accountable_name_mid_name" class="tbl_accountable_name_mid_name"><div class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->mid_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mid_name" class="<?php echo $tbl_accountable_name_list->mid_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->mid_name) ?>', 1);"><div id="elh_tbl_accountable_name_mid_name" class="tbl_accountable_name_mid_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->mid_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_accountable_name_list->mid_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_accountable_name_list->mid_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->ext_name->Visible) { // ext_name ?>
	<?php if ($tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->ext_name) == "") { ?>
		<th data-name="ext_name" class="<?php echo $tbl_accountable_name_list->ext_name->headerCellClass() ?>"><div id="elh_tbl_accountable_name_ext_name" class="tbl_accountable_name_ext_name"><div class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->ext_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ext_name" class="<?php echo $tbl_accountable_name_list->ext_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->ext_name) ?>', 1);"><div id="elh_tbl_accountable_name_ext_name" class="tbl_accountable_name_ext_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->ext_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_accountable_name_list->ext_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_accountable_name_list->ext_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_accountable_name_list->full_name_tbl->Visible) { // full_name_tbl ?>
	<?php if ($tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->full_name_tbl) == "") { ?>
		<th data-name="full_name_tbl" class="<?php echo $tbl_accountable_name_list->full_name_tbl->headerCellClass() ?>"><div id="elh_tbl_accountable_name_full_name_tbl" class="tbl_accountable_name_full_name_tbl"><div class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->full_name_tbl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="full_name_tbl" class="<?php echo $tbl_accountable_name_list->full_name_tbl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_accountable_name_list->SortUrl($tbl_accountable_name_list->full_name_tbl) ?>', 1);"><div id="elh_tbl_accountable_name_full_name_tbl" class="tbl_accountable_name_full_name_tbl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_accountable_name_list->full_name_tbl->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_accountable_name_list->full_name_tbl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_accountable_name_list->full_name_tbl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_accountable_name_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_accountable_name_list->ExportAll && $tbl_accountable_name_list->isExport()) {
	$tbl_accountable_name_list->StopRecord = $tbl_accountable_name_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_accountable_name_list->TotalRecords > $tbl_accountable_name_list->StartRecord + $tbl_accountable_name_list->DisplayRecords - 1)
		$tbl_accountable_name_list->StopRecord = $tbl_accountable_name_list->StartRecord + $tbl_accountable_name_list->DisplayRecords - 1;
	else
		$tbl_accountable_name_list->StopRecord = $tbl_accountable_name_list->TotalRecords;
}
$tbl_accountable_name_list->RecordCount = $tbl_accountable_name_list->StartRecord - 1;
if ($tbl_accountable_name_list->Recordset && !$tbl_accountable_name_list->Recordset->EOF) {
	$tbl_accountable_name_list->Recordset->moveFirst();
	$selectLimit = $tbl_accountable_name_list->UseSelectLimit;
	if (!$selectLimit && $tbl_accountable_name_list->StartRecord > 1)
		$tbl_accountable_name_list->Recordset->move($tbl_accountable_name_list->StartRecord - 1);
} elseif (!$tbl_accountable_name->AllowAddDeleteRow && $tbl_accountable_name_list->StopRecord == 0) {
	$tbl_accountable_name_list->StopRecord = $tbl_accountable_name->GridAddRowCount;
}

// Initialize aggregate
$tbl_accountable_name->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_accountable_name->resetAttributes();
$tbl_accountable_name_list->renderRow();
while ($tbl_accountable_name_list->RecordCount < $tbl_accountable_name_list->StopRecord) {
	$tbl_accountable_name_list->RecordCount++;
	if ($tbl_accountable_name_list->RecordCount >= $tbl_accountable_name_list->StartRecord) {
		$tbl_accountable_name_list->RowCount++;

		// Set up key count
		$tbl_accountable_name_list->KeyCount = $tbl_accountable_name_list->RowIndex;

		// Init row class and style
		$tbl_accountable_name->resetAttributes();
		$tbl_accountable_name->CssClass = "";
		if ($tbl_accountable_name_list->isGridAdd()) {
		} else {
			$tbl_accountable_name_list->loadRowValues($tbl_accountable_name_list->Recordset); // Load row values
		}
		$tbl_accountable_name->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_accountable_name->RowAttrs->merge(["data-rowindex" => $tbl_accountable_name_list->RowCount, "id" => "r" . $tbl_accountable_name_list->RowCount . "_tbl_accountable_name", "data-rowtype" => $tbl_accountable_name->RowType]);

		// Render row
		$tbl_accountable_name_list->renderRow();

		// Render list options
		$tbl_accountable_name_list->renderListOptions();
?>
	<tr <?php echo $tbl_accountable_name->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_accountable_name_list->ListOptions->render("body", "left", $tbl_accountable_name_list->RowCount);
?>
	<?php if ($tbl_accountable_name_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $tbl_accountable_name_list->id->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_list->RowCount ?>_tbl_accountable_name_id">
<span<?php echo $tbl_accountable_name_list->id->viewAttributes() ?>><?php echo $tbl_accountable_name_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_accountable_name_list->name_id->Visible) { // name_id ?>
		<td data-name="name_id" <?php echo $tbl_accountable_name_list->name_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_list->RowCount ?>_tbl_accountable_name_name_id">
<span<?php echo $tbl_accountable_name_list->name_id->viewAttributes() ?>><?php echo $tbl_accountable_name_list->name_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_accountable_name_list->last_name->Visible) { // last_name ?>
		<td data-name="last_name" <?php echo $tbl_accountable_name_list->last_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_list->RowCount ?>_tbl_accountable_name_last_name">
<span<?php echo $tbl_accountable_name_list->last_name->viewAttributes() ?>><?php echo $tbl_accountable_name_list->last_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_accountable_name_list->first_name->Visible) { // first_name ?>
		<td data-name="first_name" <?php echo $tbl_accountable_name_list->first_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_list->RowCount ?>_tbl_accountable_name_first_name">
<span<?php echo $tbl_accountable_name_list->first_name->viewAttributes() ?>><?php echo $tbl_accountable_name_list->first_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_accountable_name_list->mid_name->Visible) { // mid_name ?>
		<td data-name="mid_name" <?php echo $tbl_accountable_name_list->mid_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_list->RowCount ?>_tbl_accountable_name_mid_name">
<span<?php echo $tbl_accountable_name_list->mid_name->viewAttributes() ?>><?php echo $tbl_accountable_name_list->mid_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_accountable_name_list->ext_name->Visible) { // ext_name ?>
		<td data-name="ext_name" <?php echo $tbl_accountable_name_list->ext_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_list->RowCount ?>_tbl_accountable_name_ext_name">
<span<?php echo $tbl_accountable_name_list->ext_name->viewAttributes() ?>><?php echo $tbl_accountable_name_list->ext_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_accountable_name_list->full_name_tbl->Visible) { // full_name_tbl ?>
		<td data-name="full_name_tbl" <?php echo $tbl_accountable_name_list->full_name_tbl->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_list->RowCount ?>_tbl_accountable_name_full_name_tbl">
<span<?php echo $tbl_accountable_name_list->full_name_tbl->viewAttributes() ?>><?php echo $tbl_accountable_name_list->full_name_tbl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_accountable_name_list->ListOptions->render("body", "right", $tbl_accountable_name_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_accountable_name_list->isGridAdd())
		$tbl_accountable_name_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_accountable_name->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_accountable_name_list->Recordset)
	$tbl_accountable_name_list->Recordset->Close();
?>
<?php if (!$tbl_accountable_name_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_accountable_name_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_accountable_name_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_accountable_name_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_accountable_name_list->TotalRecords == 0 && !$tbl_accountable_name->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_accountable_name_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_accountable_name_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_accountable_name_list->isExport()) { ?>
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
$tbl_accountable_name_list->terminate();
?>