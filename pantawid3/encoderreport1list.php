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
$encoderreport1_list = new encoderreport1_list();

// Run the page
$encoderreport1_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$encoderreport1_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$encoderreport1_list->isExport()) { ?>
<script>
var fencoderreport1list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fencoderreport1list = currentForm = new ew.Form("fencoderreport1list", "list");
	fencoderreport1list.formKeyCountName = '<?php echo $encoderreport1_list->FormKeyCountName ?>';
	loadjs.done("fencoderreport1list");
});
var fencoderreport1listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fencoderreport1listsrch = currentSearchForm = new ew.Form("fencoderreport1listsrch");

	// Dynamic selection lists
	// Filters

	fencoderreport1listsrch.filterList = <?php echo $encoderreport1_list->getFilterList() ?>;
	loadjs.done("fencoderreport1listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$encoderreport1_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($encoderreport1_list->TotalRecords > 0 && $encoderreport1_list->ExportOptions->visible()) { ?>
<?php $encoderreport1_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($encoderreport1_list->ImportOptions->visible()) { ?>
<?php $encoderreport1_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($encoderreport1_list->SearchOptions->visible()) { ?>
<?php $encoderreport1_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($encoderreport1_list->FilterOptions->visible()) { ?>
<?php $encoderreport1_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$encoderreport1_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$encoderreport1_list->isExport() && !$encoderreport1->CurrentAction) { ?>
<form name="fencoderreport1listsrch" id="fencoderreport1listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fencoderreport1listsrch-search-panel" class="<?php echo $encoderreport1_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="encoderreport1">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $encoderreport1_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($encoderreport1_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($encoderreport1_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $encoderreport1_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($encoderreport1_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($encoderreport1_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($encoderreport1_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($encoderreport1_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $encoderreport1_list->showPageHeader(); ?>
<?php
$encoderreport1_list->showMessage();
?>
<?php if ($encoderreport1_list->TotalRecords > 0 || $encoderreport1->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($encoderreport1_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> encoderreport1">
<form name="fencoderreport1list" id="fencoderreport1list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="encoderreport1">
<div id="gmp_encoderreport1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($encoderreport1_list->TotalRecords > 0 || $encoderreport1_list->isGridEdit()) { ?>
<table id="tbl_encoderreport1list" class="table ew-table d-none"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$encoderreport1->RowType = ROWTYPE_HEADER;

// Render list options
$encoderreport1_list->renderListOptions();

// Render list options (header, left)
$encoderreport1_list->ListOptions->render("header", "left", "", "block", $encoderreport1->TableVar, "encoderreport1list");
?>
<?php if ($encoderreport1_list->date->Visible) { // date ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->date) == "") { ?>
		<th data-name="date" class="<?php echo $encoderreport1_list->date->headerCellClass() ?>"><div id="elh_encoderreport1_date" class="encoderreport1_date"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_date" type="text/html"><?php echo $encoderreport1_list->date->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $encoderreport1_list->date->headerCellClass() ?>"><script id="tpc_encoderreport1_date" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->date) ?>', 1);"><div id="elh_encoderreport1_date" class="encoderreport1_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->date->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->action_taken->Visible) { // action_taken ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->action_taken) == "") { ?>
		<th data-name="action_taken" class="<?php echo $encoderreport1_list->action_taken->headerCellClass() ?>"><div id="elh_encoderreport1_action_taken" class="encoderreport1_action_taken"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_action_taken" type="text/html"><?php echo $encoderreport1_list->action_taken->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="action_taken" class="<?php echo $encoderreport1_list->action_taken->headerCellClass() ?>"><script id="tpc_encoderreport1_action_taken" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->action_taken) ?>', 1);"><div id="elh_encoderreport1_action_taken" class="encoderreport1_action_taken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->action_taken->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->action_taken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->action_taken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->total_encoded->Visible) { // total_encoded ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->total_encoded) == "") { ?>
		<th data-name="total_encoded" class="<?php echo $encoderreport1_list->total_encoded->headerCellClass() ?>"><div id="elh_encoderreport1_total_encoded" class="encoderreport1_total_encoded"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_total_encoded" type="text/html"><?php echo $encoderreport1_list->total_encoded->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="total_encoded" class="<?php echo $encoderreport1_list->total_encoded->headerCellClass() ?>"><script id="tpc_encoderreport1_total_encoded" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->total_encoded) ?>', 1);"><div id="elh_encoderreport1_total_encoded" class="encoderreport1_total_encoded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->total_encoded->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->total_encoded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->total_encoded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->year_dsc->Visible) { // year_dsc ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->year_dsc) == "") { ?>
		<th data-name="year_dsc" class="<?php echo $encoderreport1_list->year_dsc->headerCellClass() ?>"><div id="elh_encoderreport1_year_dsc" class="encoderreport1_year_dsc"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_year_dsc" type="text/html"><?php echo $encoderreport1_list->year_dsc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="year_dsc" class="<?php echo $encoderreport1_list->year_dsc->headerCellClass() ?>"><script id="tpc_encoderreport1_year_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->year_dsc) ?>', 1);"><div id="elh_encoderreport1_year_dsc" class="encoderreport1_year_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->year_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->year_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->year_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->month_dsc->Visible) { // month_dsc ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->month_dsc) == "") { ?>
		<th data-name="month_dsc" class="<?php echo $encoderreport1_list->month_dsc->headerCellClass() ?>"><div id="elh_encoderreport1_month_dsc" class="encoderreport1_month_dsc"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_month_dsc" type="text/html"><?php echo $encoderreport1_list->month_dsc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="month_dsc" class="<?php echo $encoderreport1_list->month_dsc->headerCellClass() ?>"><script id="tpc_encoderreport1_month_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->month_dsc) ?>', 1);"><div id="elh_encoderreport1_month_dsc" class="encoderreport1_month_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->month_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->month_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->month_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->status_remark1->Visible) { // status_remark1 ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->status_remark1) == "") { ?>
		<th data-name="status_remark1" class="<?php echo $encoderreport1_list->status_remark1->headerCellClass() ?>"><div id="elh_encoderreport1_status_remark1" class="encoderreport1_status_remark1"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_status_remark1" type="text/html"><?php echo $encoderreport1_list->status_remark1->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="status_remark1" class="<?php echo $encoderreport1_list->status_remark1->headerCellClass() ?>"><script id="tpc_encoderreport1_status_remark1" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->status_remark1) ?>', 1);"><div id="elh_encoderreport1_status_remark1" class="encoderreport1_status_remark1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->status_remark1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->status_remark1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->status_remark1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $encoderreport1_list->Name_dsc->headerCellClass() ?>"><div id="elh_encoderreport1_Name_dsc" class="encoderreport1_Name_dsc"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_Name_dsc" type="text/html"><?php echo $encoderreport1_list->Name_dsc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $encoderreport1_list->Name_dsc->headerCellClass() ?>"><script id="tpc_encoderreport1_Name_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->Name_dsc) ?>', 1);"><div id="elh_encoderreport1_Name_dsc" class="encoderreport1_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->Name_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->List_Activities->Visible) { // List_Activities ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->List_Activities) == "") { ?>
		<th data-name="List_Activities" class="<?php echo $encoderreport1_list->List_Activities->headerCellClass() ?>"><div id="elh_encoderreport1_List_Activities" class="encoderreport1_List_Activities"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_List_Activities" type="text/html"><?php echo $encoderreport1_list->List_Activities->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="List_Activities" class="<?php echo $encoderreport1_list->List_Activities->headerCellClass() ?>"><script id="tpc_encoderreport1_List_Activities" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->List_Activities) ?>', 1);"><div id="elh_encoderreport1_List_Activities" class="encoderreport1_List_Activities">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->List_Activities->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->List_Activities->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->List_Activities->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($encoderreport1_list->employeeid->Visible) { // employeeid ?>
	<?php if ($encoderreport1_list->SortUrl($encoderreport1_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $encoderreport1_list->employeeid->headerCellClass() ?>"><div id="elh_encoderreport1_employeeid" class="encoderreport1_employeeid"><div class="ew-table-header-caption"><script id="tpc_encoderreport1_employeeid" type="text/html"><?php echo $encoderreport1_list->employeeid->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $encoderreport1_list->employeeid->headerCellClass() ?>"><script id="tpc_encoderreport1_employeeid" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $encoderreport1_list->SortUrl($encoderreport1_list->employeeid) ?>', 1);"><div id="elh_encoderreport1_employeeid" class="encoderreport1_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $encoderreport1_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($encoderreport1_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($encoderreport1_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$encoderreport1_list->ListOptions->render("header", "right", "", "block", $encoderreport1->TableVar, "encoderreport1list");
?>
	</tr>
</thead>
<tbody>
<?php
if ($encoderreport1_list->ExportAll && $encoderreport1_list->isExport()) {
	$encoderreport1_list->StopRecord = $encoderreport1_list->TotalRecords;
} else {

	// Set the last record to display
	if ($encoderreport1_list->TotalRecords > $encoderreport1_list->StartRecord + $encoderreport1_list->DisplayRecords - 1)
		$encoderreport1_list->StopRecord = $encoderreport1_list->StartRecord + $encoderreport1_list->DisplayRecords - 1;
	else
		$encoderreport1_list->StopRecord = $encoderreport1_list->TotalRecords;
}
$encoderreport1_list->RecordCount = $encoderreport1_list->StartRecord - 1;
if ($encoderreport1_list->Recordset && !$encoderreport1_list->Recordset->EOF) {
	$encoderreport1_list->Recordset->moveFirst();
	$selectLimit = $encoderreport1_list->UseSelectLimit;
	if (!$selectLimit && $encoderreport1_list->StartRecord > 1)
		$encoderreport1_list->Recordset->move($encoderreport1_list->StartRecord - 1);
} elseif (!$encoderreport1->AllowAddDeleteRow && $encoderreport1_list->StopRecord == 0) {
	$encoderreport1_list->StopRecord = $encoderreport1->GridAddRowCount;
}

// Initialize aggregate
$encoderreport1->RowType = ROWTYPE_AGGREGATEINIT;
$encoderreport1->resetAttributes();
$encoderreport1_list->renderRow();
while ($encoderreport1_list->RecordCount < $encoderreport1_list->StopRecord) {
	$encoderreport1_list->RecordCount++;
	if ($encoderreport1_list->RecordCount >= $encoderreport1_list->StartRecord) {
		$encoderreport1_list->RowCount++;

		// Set up key count
		$encoderreport1_list->KeyCount = $encoderreport1_list->RowIndex;

		// Init row class and style
		$encoderreport1->resetAttributes();
		$encoderreport1->CssClass = "";
		if ($encoderreport1_list->isGridAdd()) {
		} else {
			$encoderreport1_list->loadRowValues($encoderreport1_list->Recordset); // Load row values
		}
		$encoderreport1->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$encoderreport1->RowAttrs->merge(["data-rowindex" => $encoderreport1_list->RowCount, "id" => "r" . $encoderreport1_list->RowCount . "_encoderreport1", "data-rowtype" => $encoderreport1->RowType]);

		// Render row
		$encoderreport1_list->renderRow();

		// Render list options
		$encoderreport1_list->renderListOptions();

		// Save row and cell attributes
		$encoderreport1_list->Attrs[$encoderreport1_list->RowCount] = ["row_attrs" => $encoderreport1->rowAttributes(), "cell_attrs" => []];
		$encoderreport1_list->Attrs[$encoderreport1_list->RowCount]["cell_attrs"] = $encoderreport1->fieldCellAttributes();
?>
	<tr <?php echo $encoderreport1->rowAttributes() ?>>
<?php

// Render list options (body, left)
$encoderreport1_list->ListOptions->render("body", "left", $encoderreport1_list->RowCount, "block", $encoderreport1->TableVar, "encoderreport1list");
?>
	<?php if ($encoderreport1_list->date->Visible) { // date ?>
		<td data-name="date" <?php echo $encoderreport1_list->date->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_date" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_date">
<span<?php echo $encoderreport1_list->date->viewAttributes() ?>><?php echo $encoderreport1_list->date->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->action_taken->Visible) { // action_taken ?>
		<td data-name="action_taken" <?php echo $encoderreport1_list->action_taken->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_action_taken" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_action_taken">
<span<?php echo $encoderreport1_list->action_taken->viewAttributes() ?>><?php echo $encoderreport1_list->action_taken->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->total_encoded->Visible) { // total_encoded ?>
		<td data-name="total_encoded" <?php echo $encoderreport1_list->total_encoded->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_total_encoded" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_total_encoded">
<span<?php echo $encoderreport1_list->total_encoded->viewAttributes() ?>><?php echo $encoderreport1_list->total_encoded->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->year_dsc->Visible) { // year_dsc ?>
		<td data-name="year_dsc" <?php echo $encoderreport1_list->year_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_year_dsc" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_year_dsc">
<span<?php echo $encoderreport1_list->year_dsc->viewAttributes() ?>><?php echo $encoderreport1_list->year_dsc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" <?php echo $encoderreport1_list->month_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_month_dsc" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_month_dsc">
<span<?php echo $encoderreport1_list->month_dsc->viewAttributes() ?>><?php echo $encoderreport1_list->month_dsc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->status_remark1->Visible) { // status_remark1 ?>
		<td data-name="status_remark1" <?php echo $encoderreport1_list->status_remark1->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_status_remark1" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_status_remark1">
<span<?php echo $encoderreport1_list->status_remark1->viewAttributes() ?>><?php echo $encoderreport1_list->status_remark1->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $encoderreport1_list->Name_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_Name_dsc" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_Name_dsc">
<span<?php echo $encoderreport1_list->Name_dsc->viewAttributes() ?>><?php echo $encoderreport1_list->Name_dsc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->List_Activities->Visible) { // List_Activities ?>
		<td data-name="List_Activities" <?php echo $encoderreport1_list->List_Activities->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_List_Activities" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_List_Activities">
<span<?php echo $encoderreport1_list->List_Activities->viewAttributes() ?>><?php echo $encoderreport1_list->List_Activities->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($encoderreport1_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $encoderreport1_list->employeeid->cellAttributes() ?>>
<script id="tpx<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_employeeid" type="text/html"><span id="el<?php echo $encoderreport1_list->RowCount ?>_encoderreport1_employeeid">
<span<?php echo $encoderreport1_list->employeeid->viewAttributes() ?>><?php echo $encoderreport1_list->employeeid->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$encoderreport1_list->ListOptions->render("body", "right", $encoderreport1_list->RowCount, "block", $encoderreport1->TableVar, "encoderreport1list");
?>
	</tr>
<?php
	}
	if (!$encoderreport1_list->isGridAdd())
		$encoderreport1_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$encoderreport1->RowType = ROWTYPE_AGGREGATE;
$encoderreport1->resetAttributes();
$encoderreport1_list->renderRow();
?>
<?php if ($encoderreport1_list->TotalRecords > 0 && !$encoderreport1_list->isGridAdd() && !$encoderreport1_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$encoderreport1_list->renderListOptions();

// Render list options (footer, left)
$encoderreport1_list->ListOptions->render("footer", "left", "", "block", $encoderreport1->TableVar, "encoderreport1list");
?>
	<?php if ($encoderreport1_list->date->Visible) { // date ?>
		<td data-name="date" class="<?php echo $encoderreport1_list->date->footerCellClass() ?>"><span id="elf_encoderreport1_date" class="encoderreport1_date">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->action_taken->Visible) { // action_taken ?>
		<td data-name="action_taken" class="<?php echo $encoderreport1_list->action_taken->footerCellClass() ?>"><span id="elf_encoderreport1_action_taken" class="encoderreport1_action_taken">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->total_encoded->Visible) { // total_encoded ?>
		<td data-name="total_encoded" class="<?php echo $encoderreport1_list->total_encoded->footerCellClass() ?>"><span id="elf_encoderreport1_total_encoded" class="encoderreport1_total_encoded">
		<script id="tpg_encoderreport1_total_encoded" class="encoderreport1list" type="text/html"><span<?php echo $encoderreport1_list->total_encoded->viewAttributes() ?>><span class="ew-aggregate-value"><span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $encoderreport1_list->total_encoded->ViewValue ?></span></span></span></script>
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->year_dsc->Visible) { // year_dsc ?>
		<td data-name="year_dsc" class="<?php echo $encoderreport1_list->year_dsc->footerCellClass() ?>"><span id="elf_encoderreport1_year_dsc" class="encoderreport1_year_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" class="<?php echo $encoderreport1_list->month_dsc->footerCellClass() ?>"><span id="elf_encoderreport1_month_dsc" class="encoderreport1_month_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->status_remark1->Visible) { // status_remark1 ?>
		<td data-name="status_remark1" class="<?php echo $encoderreport1_list->status_remark1->footerCellClass() ?>"><span id="elf_encoderreport1_status_remark1" class="encoderreport1_status_remark1">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" class="<?php echo $encoderreport1_list->Name_dsc->footerCellClass() ?>"><span id="elf_encoderreport1_Name_dsc" class="encoderreport1_Name_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->List_Activities->Visible) { // List_Activities ?>
		<td data-name="List_Activities" class="<?php echo $encoderreport1_list->List_Activities->footerCellClass() ?>"><span id="elf_encoderreport1_List_Activities" class="encoderreport1_List_Activities">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($encoderreport1_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" class="<?php echo $encoderreport1_list->employeeid->footerCellClass() ?>"><span id="elf_encoderreport1_employeeid" class="encoderreport1_employeeid">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$encoderreport1_list->ListOptions->render("footer", "right", "", "block", $encoderreport1->TableVar, "encoderreport1list");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$encoderreport1->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<div id="tpd_encoderreport1list" class="ew-custom-template"></div>
<script id="tpm_encoderreport1list" type="text/html">
<div id="ct_encoderreport1_list"><?php if ($encoderreport1_list->RowCount > 0) { ?>
<p><b><?php echo date("F j, Y"); ?></b><p>
<center><b>Department of Social Welfare and Development</b></center>
<center><b>Field Office VI</b></center>
<center><b>Pantawid Pamilyang Pilipino Program</b></center>
<center><b><font size="3">Encoder Report</font></b></center>
<br>
<br>
<style>
<!--table { table-layout: fixed; }  
th, td { width:"50px"; }-->
table, td,th{  
  border: 1px solid black;
 }
</style>
<!--<table style="width:100%; border-collapse: collapse;" >-->
<table style="width:100%; border-collapse: collapse;" >
	<tr>
	<th width="20">Date</th>
	<th width="25">List Activities</th>
	<th width="100">Action Taken</th> 
	<th width="15">Status</th>
	<th width="15">Encoded</th>
  </tr>
<?php for ($i = $encoderreport1_list->StartRowCount; $i <= $encoderreport1_list->RowCount; $i++) { ?>
<tr>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_encoderreport1_date")/}}</td>
  	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_encoderreport1_List_Activities")/}}</td>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_encoderreport1_action_taken")/}}</td>
	<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_encoderreport1_status_remark1")/}}</td>
	<td ><div style="text-align: right;">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_encoderreport1_total_encoded")/}}</dv></td>
  </tr>

<?php } ?>
<?php } ?>
</div>
</script>

</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($encoderreport1_list->Recordset)
	$encoderreport1_list->Recordset->Close();
?>
<?php if (!$encoderreport1_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $encoderreport1_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($encoderreport1_list->TotalRecords == 0 && !$encoderreport1->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $encoderreport1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($encoderreport1->Rows) ?> };
	ew.applyTemplate("tpd_encoderreport1list", "tpm_encoderreport1list", "encoderreport1list", "<?php echo $encoderreport1->CustomExport ?>", ew.templateData);
	$("script.encoderreport1list_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$encoderreport1_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$encoderreport1_list->isExport()) { ?>
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
$encoderreport1_list->terminate();
?>