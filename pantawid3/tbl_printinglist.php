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
$tbl_printing_list = new tbl_printing_list();

// Run the page
$tbl_printing_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printing_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_printing_list->isExport()) { ?>
<script>
var ftbl_printinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_printinglist = currentForm = new ew.Form("ftbl_printinglist", "list");
	ftbl_printinglist.formKeyCountName = '<?php echo $tbl_printing_list->FormKeyCountName ?>';
	loadjs.done("ftbl_printinglist");
});
var ftbl_printinglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_printinglistsrch = currentSearchForm = new ew.Form("ftbl_printinglistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_printinglistsrch.filterList = <?php echo $tbl_printing_list->getFilterList() ?>;
	loadjs.done("ftbl_printinglistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_printing_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_printing_list->TotalRecords > 0 && $tbl_printing_list->ExportOptions->visible()) { ?>
<?php $tbl_printing_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printing_list->ImportOptions->visible()) { ?>
<?php $tbl_printing_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printing_list->SearchOptions->visible()) { ?>
<?php $tbl_printing_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printing_list->FilterOptions->visible()) { ?>
<?php $tbl_printing_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_printing_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_printing_list->isExport() && !$tbl_printing->CurrentAction) { ?>
<form name="ftbl_printinglistsrch" id="ftbl_printinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_printinglistsrch-search-panel" class="<?php echo $tbl_printing_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_printing">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_printing_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_printing_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_printing_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_printing_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_printing_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_printing_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_printing_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_printing_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_printing_list->showPageHeader(); ?>
<?php
$tbl_printing_list->showMessage();
?>
<?php if ($tbl_printing_list->TotalRecords > 0 || $tbl_printing->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_printing_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_printing">
<?php if (!$tbl_printing_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_printing_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_printing_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_printing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_printinglist" id="ftbl_printinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printing">
<div id="gmp_tbl_printing" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_printing_list->TotalRecords > 0 || $tbl_printing_list->isGridEdit()) { ?>
<table id="tbl_tbl_printinglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_printing->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_printing_list->renderListOptions();

// Render list options (header, left)
$tbl_printing_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_printing_list->printing_date->Visible) { // printing_date ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->printing_date) == "") { ?>
		<th data-name="printing_date" class="<?php echo $tbl_printing_list->printing_date->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_printing_date" class="tbl_printing_printing_date"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->printing_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="printing_date" class="<?php echo $tbl_printing_list->printing_date->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->printing_date) ?>', 1);"><div id="elh_tbl_printing_printing_date" class="tbl_printing_printing_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->printing_date->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->printing_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->printing_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_list->printing_type->Visible) { // printing_type ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->printing_type) == "") { ?>
		<th data-name="printing_type" class="<?php echo $tbl_printing_list->printing_type->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_printing_type" class="tbl_printing_printing_type"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->printing_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="printing_type" class="<?php echo $tbl_printing_list->printing_type->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->printing_type) ?>', 1);"><div id="elh_tbl_printing_printing_type" class="tbl_printing_printing_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->printing_type->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->printing_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->printing_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_list->printed_forms->Visible) { // printed_forms ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->printed_forms) == "") { ?>
		<th data-name="printed_forms" class="<?php echo $tbl_printing_list->printed_forms->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_printed_forms" class="tbl_printing_printed_forms"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->printed_forms->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="printed_forms" class="<?php echo $tbl_printing_list->printed_forms->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->printed_forms) ?>', 1);"><div id="elh_tbl_printing_printed_forms" class="tbl_printing_printed_forms">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->printed_forms->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->printed_forms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->printed_forms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_list->total_forms->Visible) { // total_forms ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->total_forms) == "") { ?>
		<th data-name="total_forms" class="<?php echo $tbl_printing_list->total_forms->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_total_forms" class="tbl_printing_total_forms"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->total_forms->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_forms" class="<?php echo $tbl_printing_list->total_forms->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->total_forms) ?>', 1);"><div id="elh_tbl_printing_total_forms" class="tbl_printing_total_forms">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->total_forms->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->total_forms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->total_forms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_list->status_printing->Visible) { // status_printing ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->status_printing) == "") { ?>
		<th data-name="status_printing" class="<?php echo $tbl_printing_list->status_printing->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_status_printing" class="tbl_printing_status_printing"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->status_printing->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_printing" class="<?php echo $tbl_printing_list->status_printing->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->status_printing) ?>', 1);"><div id="elh_tbl_printing_status_printing" class="tbl_printing_status_printing">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->status_printing->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->status_printing->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->status_printing->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_list->employee_id->Visible) { // employee_id ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->employee_id) == "") { ?>
		<th data-name="employee_id" class="<?php echo $tbl_printing_list->employee_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_employee_id" class="tbl_printing_employee_id"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->employee_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employee_id" class="<?php echo $tbl_printing_list->employee_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->employee_id) ?>', 1);"><div id="elh_tbl_printing_employee_id" class="tbl_printing_employee_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->employee_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->employee_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->employee_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_list->user_last_modify->Visible) { // user_last_modify ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->user_last_modify) == "") { ?>
		<th data-name="user_last_modify" class="<?php echo $tbl_printing_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_user_last_modify" class="tbl_printing_user_last_modify"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->user_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_last_modify" class="<?php echo $tbl_printing_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->user_last_modify) ?>', 1);"><div id="elh_tbl_printing_user_last_modify" class="tbl_printing_user_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->user_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_list->date_last_modify->Visible) { // date_last_modify ?>
	<?php if ($tbl_printing_list->SortUrl($tbl_printing_list->date_last_modify) == "") { ?>
		<th data-name="date_last_modify" class="<?php echo $tbl_printing_list->date_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_printing_date_last_modify" class="tbl_printing_date_last_modify"><div class="ew-table-header-caption"><?php echo $tbl_printing_list->date_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_last_modify" class="<?php echo $tbl_printing_list->date_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_list->SortUrl($tbl_printing_list->date_last_modify) ?>', 1);"><div id="elh_tbl_printing_date_last_modify" class="tbl_printing_date_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_list->date_last_modify->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_list->date_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_list->date_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_printing_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_printing_list->ExportAll && $tbl_printing_list->isExport()) {
	$tbl_printing_list->StopRecord = $tbl_printing_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_printing_list->TotalRecords > $tbl_printing_list->StartRecord + $tbl_printing_list->DisplayRecords - 1)
		$tbl_printing_list->StopRecord = $tbl_printing_list->StartRecord + $tbl_printing_list->DisplayRecords - 1;
	else
		$tbl_printing_list->StopRecord = $tbl_printing_list->TotalRecords;
}
$tbl_printing_list->RecordCount = $tbl_printing_list->StartRecord - 1;
if ($tbl_printing_list->Recordset && !$tbl_printing_list->Recordset->EOF) {
	$tbl_printing_list->Recordset->moveFirst();
	$selectLimit = $tbl_printing_list->UseSelectLimit;
	if (!$selectLimit && $tbl_printing_list->StartRecord > 1)
		$tbl_printing_list->Recordset->move($tbl_printing_list->StartRecord - 1);
} elseif (!$tbl_printing->AllowAddDeleteRow && $tbl_printing_list->StopRecord == 0) {
	$tbl_printing_list->StopRecord = $tbl_printing->GridAddRowCount;
}

// Initialize aggregate
$tbl_printing->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_printing->resetAttributes();
$tbl_printing_list->renderRow();
while ($tbl_printing_list->RecordCount < $tbl_printing_list->StopRecord) {
	$tbl_printing_list->RecordCount++;
	if ($tbl_printing_list->RecordCount >= $tbl_printing_list->StartRecord) {
		$tbl_printing_list->RowCount++;

		// Set up key count
		$tbl_printing_list->KeyCount = $tbl_printing_list->RowIndex;

		// Init row class and style
		$tbl_printing->resetAttributes();
		$tbl_printing->CssClass = "";
		if ($tbl_printing_list->isGridAdd()) {
		} else {
			$tbl_printing_list->loadRowValues($tbl_printing_list->Recordset); // Load row values
		}
		$tbl_printing->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_printing->RowAttrs->merge(["data-rowindex" => $tbl_printing_list->RowCount, "id" => "r" . $tbl_printing_list->RowCount . "_tbl_printing", "data-rowtype" => $tbl_printing->RowType]);

		// Render row
		$tbl_printing_list->renderRow();

		// Render list options
		$tbl_printing_list->renderListOptions();
?>
	<tr <?php echo $tbl_printing->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_printing_list->ListOptions->render("body", "left", $tbl_printing_list->RowCount);
?>
	<?php if ($tbl_printing_list->printing_date->Visible) { // printing_date ?>
		<td data-name="printing_date" <?php echo $tbl_printing_list->printing_date->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_printing_date">
<span<?php echo $tbl_printing_list->printing_date->viewAttributes() ?>><?php echo $tbl_printing_list->printing_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_list->printing_type->Visible) { // printing_type ?>
		<td data-name="printing_type" <?php echo $tbl_printing_list->printing_type->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_printing_type">
<span<?php echo $tbl_printing_list->printing_type->viewAttributes() ?>><?php echo $tbl_printing_list->printing_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_list->printed_forms->Visible) { // printed_forms ?>
		<td data-name="printed_forms" <?php echo $tbl_printing_list->printed_forms->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_printed_forms">
<span<?php echo $tbl_printing_list->printed_forms->viewAttributes() ?>><?php echo $tbl_printing_list->printed_forms->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_list->total_forms->Visible) { // total_forms ?>
		<td data-name="total_forms" <?php echo $tbl_printing_list->total_forms->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_total_forms">
<span<?php echo $tbl_printing_list->total_forms->viewAttributes() ?>><?php echo $tbl_printing_list->total_forms->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_list->status_printing->Visible) { // status_printing ?>
		<td data-name="status_printing" <?php echo $tbl_printing_list->status_printing->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_status_printing">
<span<?php echo $tbl_printing_list->status_printing->viewAttributes() ?>><?php echo $tbl_printing_list->status_printing->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_list->employee_id->Visible) { // employee_id ?>
		<td data-name="employee_id" <?php echo $tbl_printing_list->employee_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_employee_id">
<span<?php echo $tbl_printing_list->employee_id->viewAttributes() ?>><?php echo $tbl_printing_list->employee_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" <?php echo $tbl_printing_list->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_user_last_modify">
<span<?php echo $tbl_printing_list->user_last_modify->viewAttributes() ?>><?php echo $tbl_printing_list->user_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_list->date_last_modify->Visible) { // date_last_modify ?>
		<td data-name="date_last_modify" <?php echo $tbl_printing_list->date_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_list->RowCount ?>_tbl_printing_date_last_modify">
<span<?php echo $tbl_printing_list->date_last_modify->viewAttributes() ?>><?php echo $tbl_printing_list->date_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_printing_list->ListOptions->render("body", "right", $tbl_printing_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_printing_list->isGridAdd())
		$tbl_printing_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_printing->RowType = ROWTYPE_AGGREGATE;
$tbl_printing->resetAttributes();
$tbl_printing_list->renderRow();
?>
<?php if ($tbl_printing_list->TotalRecords > 0 && !$tbl_printing_list->isGridAdd() && !$tbl_printing_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_printing_list->renderListOptions();

// Render list options (footer, left)
$tbl_printing_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_printing_list->printing_date->Visible) { // printing_date ?>
		<td data-name="printing_date" class="<?php echo $tbl_printing_list->printing_date->footerCellClass() ?>"><span id="elf_tbl_printing_printing_date" class="tbl_printing_printing_date">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_printing_list->printing_type->Visible) { // printing_type ?>
		<td data-name="printing_type" class="<?php echo $tbl_printing_list->printing_type->footerCellClass() ?>"><span id="elf_tbl_printing_printing_type" class="tbl_printing_printing_type">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_printing_list->printed_forms->Visible) { // printed_forms ?>
		<td data-name="printed_forms" class="<?php echo $tbl_printing_list->printed_forms->footerCellClass() ?>"><span id="elf_tbl_printing_printed_forms" class="tbl_printing_printed_forms">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_printing_list->total_forms->Visible) { // total_forms ?>
		<td data-name="total_forms" class="<?php echo $tbl_printing_list->total_forms->footerCellClass() ?>"><span id="elf_tbl_printing_total_forms" class="tbl_printing_total_forms">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_printing_list->total_forms->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_printing_list->status_printing->Visible) { // status_printing ?>
		<td data-name="status_printing" class="<?php echo $tbl_printing_list->status_printing->footerCellClass() ?>"><span id="elf_tbl_printing_status_printing" class="tbl_printing_status_printing">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_printing_list->employee_id->Visible) { // employee_id ?>
		<td data-name="employee_id" class="<?php echo $tbl_printing_list->employee_id->footerCellClass() ?>"><span id="elf_tbl_printing_employee_id" class="tbl_printing_employee_id">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_printing_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" class="<?php echo $tbl_printing_list->user_last_modify->footerCellClass() ?>"><span id="elf_tbl_printing_user_last_modify" class="tbl_printing_user_last_modify">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_printing_list->date_last_modify->Visible) { // date_last_modify ?>
		<td data-name="date_last_modify" class="<?php echo $tbl_printing_list->date_last_modify->footerCellClass() ?>"><span id="elf_tbl_printing_date_last_modify" class="tbl_printing_date_last_modify">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_printing_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_printing->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_printing_list->Recordset)
	$tbl_printing_list->Recordset->Close();
?>
<?php if (!$tbl_printing_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_printing_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_printing_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_printing_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_printing_list->TotalRecords == 0 && !$tbl_printing->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_printing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_printing_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_printing_list->isExport()) { ?>
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
$tbl_printing_list->terminate();
?>