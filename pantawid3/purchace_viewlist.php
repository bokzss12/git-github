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
$purchace_view_list = new purchace_view_list();

// Run the page
$purchace_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$purchace_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$purchace_view_list->isExport()) { ?>
<script>
var fpurchace_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpurchace_viewlist = currentForm = new ew.Form("fpurchace_viewlist", "list");
	fpurchace_viewlist.formKeyCountName = '<?php echo $purchace_view_list->FormKeyCountName ?>';
	loadjs.done("fpurchace_viewlist");
});
var fpurchace_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpurchace_viewlistsrch = currentSearchForm = new ew.Form("fpurchace_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fpurchace_viewlistsrch.filterList = <?php echo $purchace_view_list->getFilterList() ?>;
	loadjs.done("fpurchace_viewlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$purchace_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($purchace_view_list->TotalRecords > 0 && $purchace_view_list->ExportOptions->visible()) { ?>
<?php $purchace_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($purchace_view_list->ImportOptions->visible()) { ?>
<?php $purchace_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($purchace_view_list->SearchOptions->visible()) { ?>
<?php $purchace_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($purchace_view_list->FilterOptions->visible()) { ?>
<?php $purchace_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$purchace_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$purchace_view_list->isExport() && !$purchace_view->CurrentAction) { ?>
<form name="fpurchace_viewlistsrch" id="fpurchace_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpurchace_viewlistsrch-search-panel" class="<?php echo $purchace_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="purchace_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $purchace_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($purchace_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($purchace_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $purchace_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($purchace_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($purchace_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($purchace_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($purchace_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $purchace_view_list->showPageHeader(); ?>
<?php
$purchace_view_list->showMessage();
?>
<?php if ($purchace_view_list->TotalRecords > 0 || $purchace_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($purchace_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> purchace_view">
<form name="fpurchace_viewlist" id="fpurchace_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="purchace_view">
<div id="gmp_purchace_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($purchace_view_list->TotalRecords > 0 || $purchace_view_list->isGridEdit()) { ?>
<table id="tbl_purchace_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$purchace_view->RowType = ROWTYPE_HEADER;

// Render list options
$purchace_view_list->renderListOptions();

// Render list options (header, left)
$purchace_view_list->ListOptions->render("header", "left");
?>
<?php if ($purchace_view_list->pr_number->Visible) { // pr_number ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->pr_number) == "") { ?>
		<th data-name="pr_number" class="<?php echo $purchace_view_list->pr_number->headerCellClass() ?>"><div id="elh_purchace_view_pr_number" class="purchace_view_pr_number"><div class="ew-table-header-caption"><?php echo $purchace_view_list->pr_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pr_number" class="<?php echo $purchace_view_list->pr_number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->pr_number) ?>', 1);"><div id="elh_purchace_view_pr_number" class="purchace_view_pr_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->pr_number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->pr_number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->pr_number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->date_prep->Visible) { // date_prep ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->date_prep) == "") { ?>
		<th data-name="date_prep" class="<?php echo $purchace_view_list->date_prep->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_purchace_view_date_prep" class="purchace_view_date_prep"><div class="ew-table-header-caption"><?php echo $purchace_view_list->date_prep->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_prep" class="<?php echo $purchace_view_list->date_prep->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->date_prep) ?>', 1);"><div id="elh_purchace_view_date_prep" class="purchace_view_date_prep">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->date_prep->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->date_prep->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->date_prep->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->spec_unit->Visible) { // spec_unit ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->spec_unit) == "") { ?>
		<th data-name="spec_unit" class="<?php echo $purchace_view_list->spec_unit->headerCellClass() ?>"><div id="elh_purchace_view_spec_unit" class="purchace_view_spec_unit"><div class="ew-table-header-caption"><?php echo $purchace_view_list->spec_unit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unit" class="<?php echo $purchace_view_list->spec_unit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->spec_unit) ?>', 1);"><div id="elh_purchace_view_spec_unit" class="purchace_view_spec_unit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->spec_unit->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->spec_unit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->spec_unit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->spec_dsc->Visible) { // spec_dsc ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->spec_dsc) == "") { ?>
		<th data-name="spec_dsc" class="<?php echo $purchace_view_list->spec_dsc->headerCellClass() ?>"><div id="elh_purchace_view_spec_dsc" class="purchace_view_spec_dsc"><div class="ew-table-header-caption"><?php echo $purchace_view_list->spec_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_dsc" class="<?php echo $purchace_view_list->spec_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->spec_dsc) ?>', 1);"><div id="elh_purchace_view_spec_dsc" class="purchace_view_spec_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->spec_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->spec_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->spec_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->spec_qty->Visible) { // spec_qty ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->spec_qty) == "") { ?>
		<th data-name="spec_qty" class="<?php echo $purchace_view_list->spec_qty->headerCellClass() ?>"><div id="elh_purchace_view_spec_qty" class="purchace_view_spec_qty"><div class="ew-table-header-caption"><?php echo $purchace_view_list->spec_qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_qty" class="<?php echo $purchace_view_list->spec_qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->spec_qty) ?>', 1);"><div id="elh_purchace_view_spec_qty" class="purchace_view_spec_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->spec_qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->spec_qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->spec_qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->spec_unitprice->Visible) { // spec_unitprice ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->spec_unitprice) == "") { ?>
		<th data-name="spec_unitprice" class="<?php echo $purchace_view_list->spec_unitprice->headerCellClass() ?>"><div id="elh_purchace_view_spec_unitprice" class="purchace_view_spec_unitprice"><div class="ew-table-header-caption"><?php echo $purchace_view_list->spec_unitprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unitprice" class="<?php echo $purchace_view_list->spec_unitprice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->spec_unitprice) ?>', 1);"><div id="elh_purchace_view_spec_unitprice" class="purchace_view_spec_unitprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->spec_unitprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->spec_unitprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->spec_unitprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->spec_totalprice->Visible) { // spec_totalprice ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->spec_totalprice) == "") { ?>
		<th data-name="spec_totalprice" class="<?php echo $purchace_view_list->spec_totalprice->headerCellClass() ?>"><div id="elh_purchace_view_spec_totalprice" class="purchace_view_spec_totalprice"><div class="ew-table-header-caption"><?php echo $purchace_view_list->spec_totalprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_totalprice" class="<?php echo $purchace_view_list->spec_totalprice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->spec_totalprice) ?>', 1);"><div id="elh_purchace_view_spec_totalprice" class="purchace_view_spec_totalprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->spec_totalprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->spec_totalprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->spec_totalprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $purchace_view_list->Name_dsc->headerCellClass() ?>"><div id="elh_purchace_view_Name_dsc" class="purchace_view_Name_dsc"><div class="ew-table-header-caption"><?php echo $purchace_view_list->Name_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $purchace_view_list->Name_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->Name_dsc) ?>', 1);"><div id="elh_purchace_view_Name_dsc" class="purchace_view_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->Name_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->user_last_modify->Visible) { // user_last_modify ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->user_last_modify) == "") { ?>
		<th data-name="user_last_modify" class="<?php echo $purchace_view_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_purchace_view_user_last_modify" class="purchace_view_user_last_modify"><div class="ew-table-header-caption"><?php echo $purchace_view_list->user_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_last_modify" class="<?php echo $purchace_view_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->user_last_modify) ?>', 1);"><div id="elh_purchace_view_user_last_modify" class="purchace_view_user_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->user_last_modify->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->date_last_modify->Visible) { // date_last_modify ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->date_last_modify) == "") { ?>
		<th data-name="date_last_modify" class="<?php echo $purchace_view_list->date_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_purchace_view_date_last_modify" class="purchace_view_date_last_modify"><div class="ew-table-header-caption"><?php echo $purchace_view_list->date_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_last_modify" class="<?php echo $purchace_view_list->date_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->date_last_modify) ?>', 1);"><div id="elh_purchace_view_date_last_modify" class="purchace_view_date_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->date_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->date_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->date_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchace_view_list->purpose->Visible) { // purpose ?>
	<?php if ($purchace_view_list->SortUrl($purchace_view_list->purpose) == "") { ?>
		<th data-name="purpose" class="<?php echo $purchace_view_list->purpose->headerCellClass() ?>"><div id="elh_purchace_view_purpose" class="purchace_view_purpose"><div class="ew-table-header-caption"><?php echo $purchace_view_list->purpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="purpose" class="<?php echo $purchace_view_list->purpose->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchace_view_list->SortUrl($purchace_view_list->purpose) ?>', 1);"><div id="elh_purchace_view_purpose" class="purchace_view_purpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchace_view_list->purpose->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchace_view_list->purpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchace_view_list->purpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$purchace_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($purchace_view_list->ExportAll && $purchace_view_list->isExport()) {
	$purchace_view_list->StopRecord = $purchace_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($purchace_view_list->TotalRecords > $purchace_view_list->StartRecord + $purchace_view_list->DisplayRecords - 1)
		$purchace_view_list->StopRecord = $purchace_view_list->StartRecord + $purchace_view_list->DisplayRecords - 1;
	else
		$purchace_view_list->StopRecord = $purchace_view_list->TotalRecords;
}
$purchace_view_list->RecordCount = $purchace_view_list->StartRecord - 1;
if ($purchace_view_list->Recordset && !$purchace_view_list->Recordset->EOF) {
	$purchace_view_list->Recordset->moveFirst();
	$selectLimit = $purchace_view_list->UseSelectLimit;
	if (!$selectLimit && $purchace_view_list->StartRecord > 1)
		$purchace_view_list->Recordset->move($purchace_view_list->StartRecord - 1);
} elseif (!$purchace_view->AllowAddDeleteRow && $purchace_view_list->StopRecord == 0) {
	$purchace_view_list->StopRecord = $purchace_view->GridAddRowCount;
}

// Initialize aggregate
$purchace_view->RowType = ROWTYPE_AGGREGATEINIT;
$purchace_view->resetAttributes();
$purchace_view_list->renderRow();
while ($purchace_view_list->RecordCount < $purchace_view_list->StopRecord) {
	$purchace_view_list->RecordCount++;
	if ($purchace_view_list->RecordCount >= $purchace_view_list->StartRecord) {
		$purchace_view_list->RowCount++;

		// Set up key count
		$purchace_view_list->KeyCount = $purchace_view_list->RowIndex;

		// Init row class and style
		$purchace_view->resetAttributes();
		$purchace_view->CssClass = "";
		if ($purchace_view_list->isGridAdd()) {
		} else {
			$purchace_view_list->loadRowValues($purchace_view_list->Recordset); // Load row values
		}
		$purchace_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$purchace_view->RowAttrs->merge(["data-rowindex" => $purchace_view_list->RowCount, "id" => "r" . $purchace_view_list->RowCount . "_purchace_view", "data-rowtype" => $purchace_view->RowType]);

		// Render row
		$purchace_view_list->renderRow();

		// Render list options
		$purchace_view_list->renderListOptions();
?>
	<tr <?php echo $purchace_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$purchace_view_list->ListOptions->render("body", "left", $purchace_view_list->RowCount);
?>
	<?php if ($purchace_view_list->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" <?php echo $purchace_view_list->pr_number->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_pr_number">
<span<?php echo $purchace_view_list->pr_number->viewAttributes() ?>><?php echo $purchace_view_list->pr_number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->date_prep->Visible) { // date_prep ?>
		<td data-name="date_prep" <?php echo $purchace_view_list->date_prep->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_date_prep">
<span<?php echo $purchace_view_list->date_prep->viewAttributes() ?>><?php echo $purchace_view_list->date_prep->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit" <?php echo $purchace_view_list->spec_unit->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_spec_unit">
<span<?php echo $purchace_view_list->spec_unit->viewAttributes() ?>><?php echo $purchace_view_list->spec_unit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc" <?php echo $purchace_view_list->spec_dsc->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_spec_dsc">
<span<?php echo $purchace_view_list->spec_dsc->viewAttributes() ?>><?php echo $purchace_view_list->spec_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty" <?php echo $purchace_view_list->spec_qty->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_spec_qty">
<span<?php echo $purchace_view_list->spec_qty->viewAttributes() ?>><?php echo $purchace_view_list->spec_qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice" <?php echo $purchace_view_list->spec_unitprice->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_spec_unitprice">
<span<?php echo $purchace_view_list->spec_unitprice->viewAttributes() ?>><?php echo $purchace_view_list->spec_unitprice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice" <?php echo $purchace_view_list->spec_totalprice->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_spec_totalprice">
<span<?php echo $purchace_view_list->spec_totalprice->viewAttributes() ?>><?php echo $purchace_view_list->spec_totalprice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $purchace_view_list->Name_dsc->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_Name_dsc">
<span<?php echo $purchace_view_list->Name_dsc->viewAttributes() ?>><?php echo $purchace_view_list->Name_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" <?php echo $purchace_view_list->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_user_last_modify">
<span<?php echo $purchace_view_list->user_last_modify->viewAttributes() ?>><?php echo $purchace_view_list->user_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->date_last_modify->Visible) { // date_last_modify ?>
		<td data-name="date_last_modify" <?php echo $purchace_view_list->date_last_modify->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_date_last_modify">
<span<?php echo $purchace_view_list->date_last_modify->viewAttributes() ?>><?php echo $purchace_view_list->date_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchace_view_list->purpose->Visible) { // purpose ?>
		<td data-name="purpose" <?php echo $purchace_view_list->purpose->cellAttributes() ?>>
<span id="el<?php echo $purchace_view_list->RowCount ?>_purchace_view_purpose">
<span<?php echo $purchace_view_list->purpose->viewAttributes() ?>><?php echo $purchace_view_list->purpose->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$purchace_view_list->ListOptions->render("body", "right", $purchace_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$purchace_view_list->isGridAdd())
		$purchace_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$purchace_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($purchace_view_list->Recordset)
	$purchace_view_list->Recordset->Close();
?>
<?php if (!$purchace_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $purchace_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($purchace_view_list->TotalRecords == 0 && !$purchace_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $purchace_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$purchace_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$purchace_view_list->isExport()) { ?>
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
$purchace_view_list->terminate();
?>