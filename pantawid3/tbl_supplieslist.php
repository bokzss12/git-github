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
$tbl_supplies_list = new tbl_supplies_list();

// Run the page
$tbl_supplies_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_supplies_list->isExport()) { ?>
<script>
var ftbl_supplieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_supplieslist = currentForm = new ew.Form("ftbl_supplieslist", "list");
	ftbl_supplieslist.formKeyCountName = '<?php echo $tbl_supplies_list->FormKeyCountName ?>';
	loadjs.done("ftbl_supplieslist");
});
var ftbl_supplieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_supplieslistsrch = currentSearchForm = new ew.Form("ftbl_supplieslistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_supplieslistsrch.filterList = <?php echo $tbl_supplies_list->getFilterList() ?>;
	loadjs.done("ftbl_supplieslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_supplies_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_supplies_list->TotalRecords > 0 && $tbl_supplies_list->ExportOptions->visible()) { ?>
<?php $tbl_supplies_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplies_list->ImportOptions->visible()) { ?>
<?php $tbl_supplies_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplies_list->SearchOptions->visible()) { ?>
<?php $tbl_supplies_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_supplies_list->FilterOptions->visible()) { ?>
<?php $tbl_supplies_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_supplies_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_supplies_list->isExport() && !$tbl_supplies->CurrentAction) { ?>
<form name="ftbl_supplieslistsrch" id="ftbl_supplieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_supplieslistsrch-search-panel" class="<?php echo $tbl_supplies_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_supplies">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_supplies_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_supplies_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_supplies_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_supplies_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_supplies_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplies_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplies_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_supplies_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_supplies_list->showPageHeader(); ?>
<?php
$tbl_supplies_list->showMessage();
?>
<?php if ($tbl_supplies_list->TotalRecords > 0 || $tbl_supplies->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_supplies_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_supplies">
<?php if (!$tbl_supplies_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_supplies_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_supplies_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_supplies_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_supplieslist" id="ftbl_supplieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies">
<div id="gmp_tbl_supplies" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_supplies_list->TotalRecords > 0 || $tbl_supplies_list->isGridEdit()) { ?>
<table id="tbl_tbl_supplieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_supplies->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_supplies_list->renderListOptions();

// Render list options (header, left)
$tbl_supplies_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_supplies_list->supplies_cat->Visible) { // supplies_cat ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->supplies_cat) == "") { ?>
		<th data-name="supplies_cat" class="<?php echo $tbl_supplies_list->supplies_cat->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_supplies_cat" class="tbl_supplies_supplies_cat"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->supplies_cat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="supplies_cat" class="<?php echo $tbl_supplies_list->supplies_cat->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->supplies_cat) ?>', 1);"><div id="elh_tbl_supplies_supplies_cat" class="tbl_supplies_supplies_cat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->supplies_cat->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->supplies_cat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->supplies_cat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->model->Visible) { // model ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->model) == "") { ?>
		<th data-name="model" class="<?php echo $tbl_supplies_list->model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_model" class="tbl_supplies_model"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="model" class="<?php echo $tbl_supplies_list->model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->model) ?>', 1);"><div id="elh_tbl_supplies_model" class="tbl_supplies_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->model->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->serial->Visible) { // serial ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->serial) == "") { ?>
		<th data-name="serial" class="<?php echo $tbl_supplies_list->serial->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_serial" class="tbl_supplies_serial"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="serial" class="<?php echo $tbl_supplies_list->serial->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->serial) ?>', 1);"><div id="elh_tbl_supplies_serial" class="tbl_supplies_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->status->Visible) { // status ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $tbl_supplies_list->status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_status" class="tbl_supplies_status"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $tbl_supplies_list->status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->status) ?>', 1);"><div id="elh_tbl_supplies_status" class="tbl_supplies_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->date_received->Visible) { // date_received ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->date_received) == "") { ?>
		<th data-name="date_received" class="<?php echo $tbl_supplies_list->date_received->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_date_received" class="tbl_supplies_date_received"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->date_received->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_received" class="<?php echo $tbl_supplies_list->date_received->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->date_received) ?>', 1);"><div id="elh_tbl_supplies_date_received" class="tbl_supplies_date_received">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->date_received->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->date_received->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->date_received->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->date_consumed->Visible) { // date_consumed ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->date_consumed) == "") { ?>
		<th data-name="date_consumed" class="<?php echo $tbl_supplies_list->date_consumed->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_date_consumed" class="tbl_supplies_date_consumed"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->date_consumed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_consumed" class="<?php echo $tbl_supplies_list->date_consumed->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->date_consumed) ?>', 1);"><div id="elh_tbl_supplies_date_consumed" class="tbl_supplies_date_consumed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->date_consumed->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->date_consumed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->date_consumed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->Supplier->Visible) { // Supplier ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->Supplier) == "") { ?>
		<th data-name="Supplier" class="<?php echo $tbl_supplies_list->Supplier->headerCellClass() ?>"><div id="elh_tbl_supplies_Supplier" class="tbl_supplies_Supplier"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->Supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Supplier" class="<?php echo $tbl_supplies_list->Supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->Supplier) ?>', 1);"><div id="elh_tbl_supplies_Supplier" class="tbl_supplies_Supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->Supplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->Supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->Supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->employeeid->Visible) { // employeeid ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $tbl_supplies_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_employeeid" class="tbl_supplies_employeeid"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $tbl_supplies_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->employeeid) ?>', 1);"><div id="elh_tbl_supplies_employeeid" class="tbl_supplies_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->user_last_modify->Visible) { // user_last_modify ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->user_last_modify) == "") { ?>
		<th data-name="user_last_modify" class="<?php echo $tbl_supplies_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_user_last_modify" class="tbl_supplies_user_last_modify"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->user_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_last_modify" class="<?php echo $tbl_supplies_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->user_last_modify) ?>', 1);"><div id="elh_tbl_supplies_user_last_modify" class="tbl_supplies_user_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->user_last_modify->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_supplies_list->user_date_modify->Visible) { // user_date_modify ?>
	<?php if ($tbl_supplies_list->SortUrl($tbl_supplies_list->user_date_modify) == "") { ?>
		<th data-name="user_date_modify" class="<?php echo $tbl_supplies_list->user_date_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_supplies_user_date_modify" class="tbl_supplies_user_date_modify"><div class="ew-table-header-caption"><?php echo $tbl_supplies_list->user_date_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_date_modify" class="<?php echo $tbl_supplies_list->user_date_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_supplies_list->SortUrl($tbl_supplies_list->user_date_modify) ?>', 1);"><div id="elh_tbl_supplies_user_date_modify" class="tbl_supplies_user_date_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_supplies_list->user_date_modify->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_supplies_list->user_date_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_supplies_list->user_date_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_supplies_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_supplies_list->ExportAll && $tbl_supplies_list->isExport()) {
	$tbl_supplies_list->StopRecord = $tbl_supplies_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_supplies_list->TotalRecords > $tbl_supplies_list->StartRecord + $tbl_supplies_list->DisplayRecords - 1)
		$tbl_supplies_list->StopRecord = $tbl_supplies_list->StartRecord + $tbl_supplies_list->DisplayRecords - 1;
	else
		$tbl_supplies_list->StopRecord = $tbl_supplies_list->TotalRecords;
}
$tbl_supplies_list->RecordCount = $tbl_supplies_list->StartRecord - 1;
if ($tbl_supplies_list->Recordset && !$tbl_supplies_list->Recordset->EOF) {
	$tbl_supplies_list->Recordset->moveFirst();
	$selectLimit = $tbl_supplies_list->UseSelectLimit;
	if (!$selectLimit && $tbl_supplies_list->StartRecord > 1)
		$tbl_supplies_list->Recordset->move($tbl_supplies_list->StartRecord - 1);
} elseif (!$tbl_supplies->AllowAddDeleteRow && $tbl_supplies_list->StopRecord == 0) {
	$tbl_supplies_list->StopRecord = $tbl_supplies->GridAddRowCount;
}

// Initialize aggregate
$tbl_supplies->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_supplies->resetAttributes();
$tbl_supplies_list->renderRow();
while ($tbl_supplies_list->RecordCount < $tbl_supplies_list->StopRecord) {
	$tbl_supplies_list->RecordCount++;
	if ($tbl_supplies_list->RecordCount >= $tbl_supplies_list->StartRecord) {
		$tbl_supplies_list->RowCount++;

		// Set up key count
		$tbl_supplies_list->KeyCount = $tbl_supplies_list->RowIndex;

		// Init row class and style
		$tbl_supplies->resetAttributes();
		$tbl_supplies->CssClass = "";
		if ($tbl_supplies_list->isGridAdd()) {
		} else {
			$tbl_supplies_list->loadRowValues($tbl_supplies_list->Recordset); // Load row values
		}
		$tbl_supplies->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_supplies->RowAttrs->merge(["data-rowindex" => $tbl_supplies_list->RowCount, "id" => "r" . $tbl_supplies_list->RowCount . "_tbl_supplies", "data-rowtype" => $tbl_supplies->RowType]);

		// Render row
		$tbl_supplies_list->renderRow();

		// Render list options
		$tbl_supplies_list->renderListOptions();
?>
	<tr <?php echo $tbl_supplies->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_supplies_list->ListOptions->render("body", "left", $tbl_supplies_list->RowCount);
?>
	<?php if ($tbl_supplies_list->supplies_cat->Visible) { // supplies_cat ?>
		<td data-name="supplies_cat" <?php echo $tbl_supplies_list->supplies_cat->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_supplies_cat">
<span<?php echo $tbl_supplies_list->supplies_cat->viewAttributes() ?>><?php echo $tbl_supplies_list->supplies_cat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->model->Visible) { // model ?>
		<td data-name="model" <?php echo $tbl_supplies_list->model->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_model">
<span<?php echo $tbl_supplies_list->model->viewAttributes() ?>><?php echo $tbl_supplies_list->model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->serial->Visible) { // serial ?>
		<td data-name="serial" <?php echo $tbl_supplies_list->serial->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_serial">
<span<?php echo $tbl_supplies_list->serial->viewAttributes() ?>><?php echo $tbl_supplies_list->serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $tbl_supplies_list->status->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_status">
<span<?php echo $tbl_supplies_list->status->viewAttributes() ?>><?php echo $tbl_supplies_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->date_received->Visible) { // date_received ?>
		<td data-name="date_received" <?php echo $tbl_supplies_list->date_received->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_date_received">
<span<?php echo $tbl_supplies_list->date_received->viewAttributes() ?>><?php echo $tbl_supplies_list->date_received->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->date_consumed->Visible) { // date_consumed ?>
		<td data-name="date_consumed" <?php echo $tbl_supplies_list->date_consumed->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_date_consumed">
<span<?php echo $tbl_supplies_list->date_consumed->viewAttributes() ?>><?php echo $tbl_supplies_list->date_consumed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->Supplier->Visible) { // Supplier ?>
		<td data-name="Supplier" <?php echo $tbl_supplies_list->Supplier->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_Supplier">
<span<?php echo $tbl_supplies_list->Supplier->viewAttributes() ?>><?php echo $tbl_supplies_list->Supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $tbl_supplies_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_employeeid">
<span<?php echo $tbl_supplies_list->employeeid->viewAttributes() ?>><?php echo $tbl_supplies_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" <?php echo $tbl_supplies_list->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_user_last_modify">
<span<?php echo $tbl_supplies_list->user_last_modify->viewAttributes() ?>><?php echo $tbl_supplies_list->user_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_supplies_list->user_date_modify->Visible) { // user_date_modify ?>
		<td data-name="user_date_modify" <?php echo $tbl_supplies_list->user_date_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_list->RowCount ?>_tbl_supplies_user_date_modify">
<span<?php echo $tbl_supplies_list->user_date_modify->viewAttributes() ?>><?php echo $tbl_supplies_list->user_date_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_supplies_list->ListOptions->render("body", "right", $tbl_supplies_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_supplies_list->isGridAdd())
		$tbl_supplies_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_supplies->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_supplies_list->Recordset)
	$tbl_supplies_list->Recordset->Close();
?>
<?php if (!$tbl_supplies_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_supplies_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_supplies_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_supplies_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_supplies_list->TotalRecords == 0 && !$tbl_supplies->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_supplies_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_supplies_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_supplies_list->isExport()) { ?>
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
$tbl_supplies_list->terminate();
?>