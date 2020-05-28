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
$tbl_encoder_list = new tbl_encoder_list();

// Run the page
$tbl_encoder_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_encoder_list->isExport()) { ?>
<script>
var ftbl_encoderlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_encoderlist = currentForm = new ew.Form("ftbl_encoderlist", "list");
	ftbl_encoderlist.formKeyCountName = '<?php echo $tbl_encoder_list->FormKeyCountName ?>';
	loadjs.done("ftbl_encoderlist");
});
var ftbl_encoderlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_encoderlistsrch = currentSearchForm = new ew.Form("ftbl_encoderlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_encoderlistsrch.filterList = <?php echo $tbl_encoder_list->getFilterList() ?>;
	loadjs.done("ftbl_encoderlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_encoder_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_encoder_list->TotalRecords > 0 && $tbl_encoder_list->ExportOptions->visible()) { ?>
<?php $tbl_encoder_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_encoder_list->ImportOptions->visible()) { ?>
<?php $tbl_encoder_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_encoder_list->SearchOptions->visible()) { ?>
<?php $tbl_encoder_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_encoder_list->FilterOptions->visible()) { ?>
<?php $tbl_encoder_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_encoder_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_encoder_list->isExport() && !$tbl_encoder->CurrentAction) { ?>
<form name="ftbl_encoderlistsrch" id="ftbl_encoderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_encoderlistsrch-search-panel" class="<?php echo $tbl_encoder_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_encoder">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_encoder_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_encoder_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_encoder_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_encoder_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_encoder_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_encoder_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_encoder_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_encoder_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_encoder_list->showPageHeader(); ?>
<?php
$tbl_encoder_list->showMessage();
?>
<?php if ($tbl_encoder_list->TotalRecords > 0 || $tbl_encoder->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_encoder_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_encoder">
<?php if (!$tbl_encoder_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_encoder_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_encoder_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_encoder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_encoderlist" id="ftbl_encoderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder">
<div id="gmp_tbl_encoder" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_encoder_list->TotalRecords > 0 || $tbl_encoder_list->isGridEdit()) { ?>
<table id="tbl_tbl_encoderlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_encoder->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_encoder_list->renderListOptions();

// Render list options (header, left)
$tbl_encoder_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_encoder_list->date->Visible) { // date ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->date) == "") { ?>
		<th data-name="date" class="<?php echo $tbl_encoder_list->date->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_date" class="tbl_encoder_date"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $tbl_encoder_list->date->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->date) ?>', 1);"><div id="elh_tbl_encoder_date" class="tbl_encoder_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->date->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_list->activities->Visible) { // activities ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->activities) == "") { ?>
		<th data-name="activities" class="<?php echo $tbl_encoder_list->activities->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_activities" class="tbl_encoder_activities"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->activities->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="activities" class="<?php echo $tbl_encoder_list->activities->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->activities) ?>', 1);"><div id="elh_tbl_encoder_activities" class="tbl_encoder_activities">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->activities->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->activities->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->activities->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_list->action_taken->Visible) { // action_taken ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->action_taken) == "") { ?>
		<th data-name="action_taken" class="<?php echo $tbl_encoder_list->action_taken->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_action_taken" class="tbl_encoder_action_taken"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->action_taken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="action_taken" class="<?php echo $tbl_encoder_list->action_taken->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->action_taken) ?>', 1);"><div id="elh_tbl_encoder_action_taken" class="tbl_encoder_action_taken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->action_taken->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->action_taken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->action_taken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_list->total_encoded->Visible) { // total_encoded ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->total_encoded) == "") { ?>
		<th data-name="total_encoded" class="<?php echo $tbl_encoder_list->total_encoded->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_total_encoded" class="tbl_encoder_total_encoded"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->total_encoded->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_encoded" class="<?php echo $tbl_encoder_list->total_encoded->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->total_encoded) ?>', 1);"><div id="elh_tbl_encoder_total_encoded" class="tbl_encoder_total_encoded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->total_encoded->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->total_encoded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->total_encoded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_list->status_remark->Visible) { // status_remark ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->status_remark) == "") { ?>
		<th data-name="status_remark" class="<?php echo $tbl_encoder_list->status_remark->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_status_remark" class="tbl_encoder_status_remark"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->status_remark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_remark" class="<?php echo $tbl_encoder_list->status_remark->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->status_remark) ?>', 1);"><div id="elh_tbl_encoder_status_remark" class="tbl_encoder_status_remark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->status_remark->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->status_remark->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->status_remark->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_list->employee_id->Visible) { // employee_id ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->employee_id) == "") { ?>
		<th data-name="employee_id" class="<?php echo $tbl_encoder_list->employee_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_employee_id" class="tbl_encoder_employee_id"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->employee_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employee_id" class="<?php echo $tbl_encoder_list->employee_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->employee_id) ?>', 1);"><div id="elh_tbl_encoder_employee_id" class="tbl_encoder_employee_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->employee_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->employee_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->employee_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_list->user_last_modify->Visible) { // user_last_modify ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->user_last_modify) == "") { ?>
		<th data-name="user_last_modify" class="<?php echo $tbl_encoder_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_user_last_modify" class="tbl_encoder_user_last_modify"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->user_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_last_modify" class="<?php echo $tbl_encoder_list->user_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->user_last_modify) ?>', 1);"><div id="elh_tbl_encoder_user_last_modify" class="tbl_encoder_user_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->user_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_list->date_last_modify->Visible) { // date_last_modify ?>
	<?php if ($tbl_encoder_list->SortUrl($tbl_encoder_list->date_last_modify) == "") { ?>
		<th data-name="date_last_modify" class="<?php echo $tbl_encoder_list->date_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_encoder_date_last_modify" class="tbl_encoder_date_last_modify"><div class="ew-table-header-caption"><?php echo $tbl_encoder_list->date_last_modify->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_last_modify" class="<?php echo $tbl_encoder_list->date_last_modify->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_list->SortUrl($tbl_encoder_list->date_last_modify) ?>', 1);"><div id="elh_tbl_encoder_date_last_modify" class="tbl_encoder_date_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_list->date_last_modify->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_list->date_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_list->date_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_encoder_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_encoder_list->ExportAll && $tbl_encoder_list->isExport()) {
	$tbl_encoder_list->StopRecord = $tbl_encoder_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_encoder_list->TotalRecords > $tbl_encoder_list->StartRecord + $tbl_encoder_list->DisplayRecords - 1)
		$tbl_encoder_list->StopRecord = $tbl_encoder_list->StartRecord + $tbl_encoder_list->DisplayRecords - 1;
	else
		$tbl_encoder_list->StopRecord = $tbl_encoder_list->TotalRecords;
}
$tbl_encoder_list->RecordCount = $tbl_encoder_list->StartRecord - 1;
if ($tbl_encoder_list->Recordset && !$tbl_encoder_list->Recordset->EOF) {
	$tbl_encoder_list->Recordset->moveFirst();
	$selectLimit = $tbl_encoder_list->UseSelectLimit;
	if (!$selectLimit && $tbl_encoder_list->StartRecord > 1)
		$tbl_encoder_list->Recordset->move($tbl_encoder_list->StartRecord - 1);
} elseif (!$tbl_encoder->AllowAddDeleteRow && $tbl_encoder_list->StopRecord == 0) {
	$tbl_encoder_list->StopRecord = $tbl_encoder->GridAddRowCount;
}

// Initialize aggregate
$tbl_encoder->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_encoder->resetAttributes();
$tbl_encoder_list->renderRow();
while ($tbl_encoder_list->RecordCount < $tbl_encoder_list->StopRecord) {
	$tbl_encoder_list->RecordCount++;
	if ($tbl_encoder_list->RecordCount >= $tbl_encoder_list->StartRecord) {
		$tbl_encoder_list->RowCount++;

		// Set up key count
		$tbl_encoder_list->KeyCount = $tbl_encoder_list->RowIndex;

		// Init row class and style
		$tbl_encoder->resetAttributes();
		$tbl_encoder->CssClass = "";
		if ($tbl_encoder_list->isGridAdd()) {
		} else {
			$tbl_encoder_list->loadRowValues($tbl_encoder_list->Recordset); // Load row values
		}
		$tbl_encoder->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_encoder->RowAttrs->merge(["data-rowindex" => $tbl_encoder_list->RowCount, "id" => "r" . $tbl_encoder_list->RowCount . "_tbl_encoder", "data-rowtype" => $tbl_encoder->RowType]);

		// Render row
		$tbl_encoder_list->renderRow();

		// Render list options
		$tbl_encoder_list->renderListOptions();
?>
	<tr <?php echo $tbl_encoder->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_encoder_list->ListOptions->render("body", "left", $tbl_encoder_list->RowCount);
?>
	<?php if ($tbl_encoder_list->date->Visible) { // date ?>
		<td data-name="date" <?php echo $tbl_encoder_list->date->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_date">
<span<?php echo $tbl_encoder_list->date->viewAttributes() ?>><?php echo $tbl_encoder_list->date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_list->activities->Visible) { // activities ?>
		<td data-name="activities" <?php echo $tbl_encoder_list->activities->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_activities">
<span<?php echo $tbl_encoder_list->activities->viewAttributes() ?>><?php echo $tbl_encoder_list->activities->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_list->action_taken->Visible) { // action_taken ?>
		<td data-name="action_taken" <?php echo $tbl_encoder_list->action_taken->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_action_taken">
<span<?php echo $tbl_encoder_list->action_taken->viewAttributes() ?>><?php echo $tbl_encoder_list->action_taken->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_list->total_encoded->Visible) { // total_encoded ?>
		<td data-name="total_encoded" <?php echo $tbl_encoder_list->total_encoded->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_total_encoded">
<span<?php echo $tbl_encoder_list->total_encoded->viewAttributes() ?>><?php echo $tbl_encoder_list->total_encoded->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_list->status_remark->Visible) { // status_remark ?>
		<td data-name="status_remark" <?php echo $tbl_encoder_list->status_remark->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_status_remark">
<span<?php echo $tbl_encoder_list->status_remark->viewAttributes() ?>><?php echo $tbl_encoder_list->status_remark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_list->employee_id->Visible) { // employee_id ?>
		<td data-name="employee_id" <?php echo $tbl_encoder_list->employee_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_employee_id">
<span<?php echo $tbl_encoder_list->employee_id->viewAttributes() ?>><?php echo $tbl_encoder_list->employee_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" <?php echo $tbl_encoder_list->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_user_last_modify">
<span<?php echo $tbl_encoder_list->user_last_modify->viewAttributes() ?>><?php echo $tbl_encoder_list->user_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_list->date_last_modify->Visible) { // date_last_modify ?>
		<td data-name="date_last_modify" <?php echo $tbl_encoder_list->date_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_list->RowCount ?>_tbl_encoder_date_last_modify">
<span<?php echo $tbl_encoder_list->date_last_modify->viewAttributes() ?>><?php echo $tbl_encoder_list->date_last_modify->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_encoder_list->ListOptions->render("body", "right", $tbl_encoder_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_encoder_list->isGridAdd())
		$tbl_encoder_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_encoder->RowType = ROWTYPE_AGGREGATE;
$tbl_encoder->resetAttributes();
$tbl_encoder_list->renderRow();
?>
<?php if ($tbl_encoder_list->TotalRecords > 0 && !$tbl_encoder_list->isGridAdd() && !$tbl_encoder_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_encoder_list->renderListOptions();

// Render list options (footer, left)
$tbl_encoder_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_encoder_list->date->Visible) { // date ?>
		<td data-name="date" class="<?php echo $tbl_encoder_list->date->footerCellClass() ?>"><span id="elf_tbl_encoder_date" class="tbl_encoder_date">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_encoder_list->activities->Visible) { // activities ?>
		<td data-name="activities" class="<?php echo $tbl_encoder_list->activities->footerCellClass() ?>"><span id="elf_tbl_encoder_activities" class="tbl_encoder_activities">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_encoder_list->action_taken->Visible) { // action_taken ?>
		<td data-name="action_taken" class="<?php echo $tbl_encoder_list->action_taken->footerCellClass() ?>"><span id="elf_tbl_encoder_action_taken" class="tbl_encoder_action_taken">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_encoder_list->total_encoded->Visible) { // total_encoded ?>
		<td data-name="total_encoded" class="<?php echo $tbl_encoder_list->total_encoded->footerCellClass() ?>"><span id="elf_tbl_encoder_total_encoded" class="tbl_encoder_total_encoded">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_encoder_list->total_encoded->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_encoder_list->status_remark->Visible) { // status_remark ?>
		<td data-name="status_remark" class="<?php echo $tbl_encoder_list->status_remark->footerCellClass() ?>"><span id="elf_tbl_encoder_status_remark" class="tbl_encoder_status_remark">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_encoder_list->employee_id->Visible) { // employee_id ?>
		<td data-name="employee_id" class="<?php echo $tbl_encoder_list->employee_id->footerCellClass() ?>"><span id="elf_tbl_encoder_employee_id" class="tbl_encoder_employee_id">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_encoder_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" class="<?php echo $tbl_encoder_list->user_last_modify->footerCellClass() ?>"><span id="elf_tbl_encoder_user_last_modify" class="tbl_encoder_user_last_modify">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_encoder_list->date_last_modify->Visible) { // date_last_modify ?>
		<td data-name="date_last_modify" class="<?php echo $tbl_encoder_list->date_last_modify->footerCellClass() ?>"><span id="elf_tbl_encoder_date_last_modify" class="tbl_encoder_date_last_modify">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_encoder_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_encoder->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_encoder_list->Recordset)
	$tbl_encoder_list->Recordset->Close();
?>
<?php if (!$tbl_encoder_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_encoder_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_encoder_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_encoder_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_encoder_list->TotalRecords == 0 && !$tbl_encoder->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_encoder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_encoder_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_encoder_list->isExport()) { ?>
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
$tbl_encoder_list->terminate();
?>