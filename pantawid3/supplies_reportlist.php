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
$supplies_report_list = new supplies_report_list();

// Run the page
$supplies_report_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$supplies_report_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$supplies_report_list->isExport()) { ?>
<script>
var fsupplies_reportlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsupplies_reportlist = currentForm = new ew.Form("fsupplies_reportlist", "list");
	fsupplies_reportlist.formKeyCountName = '<?php echo $supplies_report_list->FormKeyCountName ?>';
	loadjs.done("fsupplies_reportlist");
});
var fsupplies_reportlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsupplies_reportlistsrch = currentSearchForm = new ew.Form("fsupplies_reportlistsrch");

	// Dynamic selection lists
	// Filters

	fsupplies_reportlistsrch.filterList = <?php echo $supplies_report_list->getFilterList() ?>;
	loadjs.done("fsupplies_reportlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$supplies_report_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($supplies_report_list->TotalRecords > 0 && $supplies_report_list->ExportOptions->visible()) { ?>
<?php $supplies_report_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($supplies_report_list->ImportOptions->visible()) { ?>
<?php $supplies_report_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($supplies_report_list->SearchOptions->visible()) { ?>
<?php $supplies_report_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($supplies_report_list->FilterOptions->visible()) { ?>
<?php $supplies_report_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$supplies_report_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$supplies_report_list->isExport() && !$supplies_report->CurrentAction) { ?>
<form name="fsupplies_reportlistsrch" id="fsupplies_reportlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsupplies_reportlistsrch-search-panel" class="<?php echo $supplies_report_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="supplies_report">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $supplies_report_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($supplies_report_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($supplies_report_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $supplies_report_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($supplies_report_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($supplies_report_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($supplies_report_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($supplies_report_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $supplies_report_list->showPageHeader(); ?>
<?php
$supplies_report_list->showMessage();
?>
<?php if ($supplies_report_list->TotalRecords > 0 || $supplies_report->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($supplies_report_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> supplies_report">
<form name="fsupplies_reportlist" id="fsupplies_reportlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="supplies_report">
<div id="gmp_supplies_report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($supplies_report_list->TotalRecords > 0 || $supplies_report_list->isGridEdit()) { ?>
<table id="tbl_supplies_reportlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$supplies_report->RowType = ROWTYPE_HEADER;

// Render list options
$supplies_report_list->renderListOptions();

// Render list options (header, left)
$supplies_report_list->ListOptions->render("header", "left");
?>
<?php if ($supplies_report_list->id->Visible) { // id ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $supplies_report_list->id->headerCellClass() ?>"><div id="elh_supplies_report_id" class="supplies_report_id"><div class="ew-table-header-caption"><?php echo $supplies_report_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $supplies_report_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->id) ?>', 1);"><div id="elh_supplies_report_id" class="supplies_report_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->model->Visible) { // model ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->model) == "") { ?>
		<th data-name="model" class="<?php echo $supplies_report_list->model->headerCellClass() ?>"><div id="elh_supplies_report_model" class="supplies_report_model"><div class="ew-table-header-caption"><?php echo $supplies_report_list->model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="model" class="<?php echo $supplies_report_list->model->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->model) ?>', 1);"><div id="elh_supplies_report_model" class="supplies_report_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->model->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->serial->Visible) { // serial ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->serial) == "") { ?>
		<th data-name="serial" class="<?php echo $supplies_report_list->serial->headerCellClass() ?>"><div id="elh_supplies_report_serial" class="supplies_report_serial"><div class="ew-table-header-caption"><?php echo $supplies_report_list->serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="serial" class="<?php echo $supplies_report_list->serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->serial) ?>', 1);"><div id="elh_supplies_report_serial" class="supplies_report_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->serial->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->status->Visible) { // status ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $supplies_report_list->status->headerCellClass() ?>"><div id="elh_supplies_report_status" class="supplies_report_status"><div class="ew-table-header-caption"><?php echo $supplies_report_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $supplies_report_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->status) ?>', 1);"><div id="elh_supplies_report_status" class="supplies_report_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->date_received->Visible) { // date_received ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->date_received) == "") { ?>
		<th data-name="date_received" class="<?php echo $supplies_report_list->date_received->headerCellClass() ?>"><div id="elh_supplies_report_date_received" class="supplies_report_date_received"><div class="ew-table-header-caption"><?php echo $supplies_report_list->date_received->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_received" class="<?php echo $supplies_report_list->date_received->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->date_received) ?>', 1);"><div id="elh_supplies_report_date_received" class="supplies_report_date_received">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->date_received->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->date_received->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->date_received->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->date_consumed->Visible) { // date_consumed ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->date_consumed) == "") { ?>
		<th data-name="date_consumed" class="<?php echo $supplies_report_list->date_consumed->headerCellClass() ?>"><div id="elh_supplies_report_date_consumed" class="supplies_report_date_consumed"><div class="ew-table-header-caption"><?php echo $supplies_report_list->date_consumed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_consumed" class="<?php echo $supplies_report_list->date_consumed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->date_consumed) ?>', 1);"><div id="elh_supplies_report_date_consumed" class="supplies_report_date_consumed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->date_consumed->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->date_consumed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->date_consumed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->employeeid->Visible) { // employeeid ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $supplies_report_list->employeeid->headerCellClass() ?>"><div id="elh_supplies_report_employeeid" class="supplies_report_employeeid"><div class="ew-table-header-caption"><?php echo $supplies_report_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $supplies_report_list->employeeid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->employeeid) ?>', 1);"><div id="elh_supplies_report_employeeid" class="supplies_report_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->user_last_modify->Visible) { // user_last_modify ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->user_last_modify) == "") { ?>
		<th data-name="user_last_modify" class="<?php echo $supplies_report_list->user_last_modify->headerCellClass() ?>"><div id="elh_supplies_report_user_last_modify" class="supplies_report_user_last_modify"><div class="ew-table-header-caption"><?php echo $supplies_report_list->user_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_last_modify" class="<?php echo $supplies_report_list->user_last_modify->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->user_last_modify) ?>', 1);"><div id="elh_supplies_report_user_last_modify" class="supplies_report_user_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->user_last_modify->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($supplies_report_list->user_date_modify->Visible) { // user_date_modify ?>
	<?php if ($supplies_report_list->SortUrl($supplies_report_list->user_date_modify) == "") { ?>
		<th data-name="user_date_modify" class="<?php echo $supplies_report_list->user_date_modify->headerCellClass() ?>"><div id="elh_supplies_report_user_date_modify" class="supplies_report_user_date_modify"><div class="ew-table-header-caption"><?php echo $supplies_report_list->user_date_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_date_modify" class="<?php echo $supplies_report_list->user_date_modify->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $supplies_report_list->SortUrl($supplies_report_list->user_date_modify) ?>', 1);"><div id="elh_supplies_report_user_date_modify" class="supplies_report_user_date_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $supplies_report_list->user_date_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($supplies_report_list->user_date_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($supplies_report_list->user_date_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$supplies_report_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($supplies_report_list->ExportAll && $supplies_report_list->isExport()) {
	$supplies_report_list->StopRecord = $supplies_report_list->TotalRecords;
} else {

	// Set the last record to display
	if ($supplies_report_list->TotalRecords > $supplies_report_list->StartRecord + $supplies_report_list->DisplayRecords - 1)
		$supplies_report_list->StopRecord = $supplies_report_list->StartRecord + $supplies_report_list->DisplayRecords - 1;
	else
		$supplies_report_list->StopRecord = $supplies_report_list->TotalRecords;
}
$supplies_report_list->RecordCount = $supplies_report_list->StartRecord - 1;
if ($supplies_report_list->Recordset && !$supplies_report_list->Recordset->EOF) {
	$supplies_report_list->Recordset->moveFirst();
	$selectLimit = $supplies_report_list->UseSelectLimit;
	if (!$selectLimit && $supplies_report_list->StartRecord > 1)
		$supplies_report_list->Recordset->move($supplies_report_list->StartRecord - 1);
} elseif (!$supplies_report->AllowAddDeleteRow && $supplies_report_list->StopRecord == 0) {
	$supplies_report_list->StopRecord = $supplies_report->GridAddRowCount;
}

// Initialize aggregate
$supplies_report->RowType = ROWTYPE_AGGREGATEINIT;
$supplies_report->resetAttributes();
$supplies_report_list->renderRow();
while ($supplies_report_list->RecordCount < $supplies_report_list->StopRecord) {
	$supplies_report_list->RecordCount++;
	if ($supplies_report_list->RecordCount >= $supplies_report_list->StartRecord) {
		$supplies_report_list->RowCount++;

		// Set up key count
		$supplies_report_list->KeyCount = $supplies_report_list->RowIndex;

		// Init row class and style
		$supplies_report->resetAttributes();
		$supplies_report->CssClass = "";
		if ($supplies_report_list->isGridAdd()) {
		} else {
			$supplies_report_list->loadRowValues($supplies_report_list->Recordset); // Load row values
		}
		$supplies_report->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$supplies_report->RowAttrs->merge(["data-rowindex" => $supplies_report_list->RowCount, "id" => "r" . $supplies_report_list->RowCount . "_supplies_report", "data-rowtype" => $supplies_report->RowType]);

		// Render row
		$supplies_report_list->renderRow();

		// Render list options
		$supplies_report_list->renderListOptions();
?>
	<tr <?php echo $supplies_report->rowAttributes() ?>>
<?php

// Render list options (body, left)
$supplies_report_list->ListOptions->render("body", "left", $supplies_report_list->RowCount);
?>
	<?php if ($supplies_report_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $supplies_report_list->id->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_id">
<span<?php echo $supplies_report_list->id->viewAttributes() ?>><?php echo $supplies_report_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->model->Visible) { // model ?>
		<td data-name="model" <?php echo $supplies_report_list->model->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_model">
<span<?php echo $supplies_report_list->model->viewAttributes() ?>><?php echo $supplies_report_list->model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->serial->Visible) { // serial ?>
		<td data-name="serial" <?php echo $supplies_report_list->serial->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_serial">
<span<?php echo $supplies_report_list->serial->viewAttributes() ?>><?php echo $supplies_report_list->serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $supplies_report_list->status->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_status">
<span<?php echo $supplies_report_list->status->viewAttributes() ?>><?php echo $supplies_report_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->date_received->Visible) { // date_received ?>
		<td data-name="date_received" <?php echo $supplies_report_list->date_received->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_date_received">
<span<?php echo $supplies_report_list->date_received->viewAttributes() ?>><?php echo $supplies_report_list->date_received->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->date_consumed->Visible) { // date_consumed ?>
		<td data-name="date_consumed" <?php echo $supplies_report_list->date_consumed->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_date_consumed">
<span<?php echo $supplies_report_list->date_consumed->viewAttributes() ?>><?php echo $supplies_report_list->date_consumed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $supplies_report_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_employeeid">
<span<?php echo $supplies_report_list->employeeid->viewAttributes() ?>><?php echo $supplies_report_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" <?php echo $supplies_report_list->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_user_last_modify">
<span<?php echo $supplies_report_list->user_last_modify->viewAttributes() ?>><?php echo $supplies_report_list->user_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($supplies_report_list->user_date_modify->Visible) { // user_date_modify ?>
		<td data-name="user_date_modify" <?php echo $supplies_report_list->user_date_modify->cellAttributes() ?>>
<span id="el<?php echo $supplies_report_list->RowCount ?>_supplies_report_user_date_modify">
<span<?php echo $supplies_report_list->user_date_modify->viewAttributes() ?>><?php echo $supplies_report_list->user_date_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$supplies_report_list->ListOptions->render("body", "right", $supplies_report_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$supplies_report_list->isGridAdd())
		$supplies_report_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$supplies_report->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($supplies_report_list->Recordset)
	$supplies_report_list->Recordset->Close();
?>
<?php if (!$supplies_report_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $supplies_report_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($supplies_report_list->TotalRecords == 0 && !$supplies_report->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $supplies_report_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$supplies_report_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$supplies_report_list->isExport()) { ?>
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
$supplies_report_list->terminate();
?>