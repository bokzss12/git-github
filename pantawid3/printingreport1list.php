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
$printingreport1_list = new printingreport1_list();

// Run the page
$printingreport1_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$printingreport1_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$printingreport1_list->isExport()) { ?>
<script>
var fprintingreport1list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprintingreport1list = currentForm = new ew.Form("fprintingreport1list", "list");
	fprintingreport1list.formKeyCountName = '<?php echo $printingreport1_list->FormKeyCountName ?>';
	loadjs.done("fprintingreport1list");
});
var fprintingreport1listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprintingreport1listsrch = currentSearchForm = new ew.Form("fprintingreport1listsrch");

	// Dynamic selection lists
	// Filters

	fprintingreport1listsrch.filterList = <?php echo $printingreport1_list->getFilterList() ?>;
	loadjs.done("fprintingreport1listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$printingreport1_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($printingreport1_list->TotalRecords > 0 && $printingreport1_list->ExportOptions->visible()) { ?>
<?php $printingreport1_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($printingreport1_list->ImportOptions->visible()) { ?>
<?php $printingreport1_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($printingreport1_list->SearchOptions->visible()) { ?>
<?php $printingreport1_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($printingreport1_list->FilterOptions->visible()) { ?>
<?php $printingreport1_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$printingreport1_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$printingreport1_list->isExport() && !$printingreport1->CurrentAction) { ?>
<form name="fprintingreport1listsrch" id="fprintingreport1listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprintingreport1listsrch-search-panel" class="<?php echo $printingreport1_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="printingreport1">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $printingreport1_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($printingreport1_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($printingreport1_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $printingreport1_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($printingreport1_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($printingreport1_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($printingreport1_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($printingreport1_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $printingreport1_list->showPageHeader(); ?>
<?php
$printingreport1_list->showMessage();
?>
<?php if ($printingreport1_list->TotalRecords > 0 || $printingreport1->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($printingreport1_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> printingreport1">
<form name="fprintingreport1list" id="fprintingreport1list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="printingreport1">
<div id="gmp_printingreport1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($printingreport1_list->TotalRecords > 0 || $printingreport1_list->isGridEdit()) { ?>
<table id="tbl_printingreport1list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$printingreport1->RowType = ROWTYPE_HEADER;

// Render list options
$printingreport1_list->renderListOptions();

// Render list options (header, left)
$printingreport1_list->ListOptions->render("header", "left");
?>
<?php if ($printingreport1_list->printing_date->Visible) { // printing_date ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->printing_date) == "") { ?>
		<th data-name="printing_date" class="<?php echo $printingreport1_list->printing_date->headerCellClass() ?>"><div id="elh_printingreport1_printing_date" class="printingreport1_printing_date"><div class="ew-table-header-caption"><?php echo $printingreport1_list->printing_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="printing_date" class="<?php echo $printingreport1_list->printing_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->printing_date) ?>', 1);"><div id="elh_printingreport1_printing_date" class="printingreport1_printing_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->printing_date->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->printing_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->printing_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->printed_forms->Visible) { // printed_forms ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->printed_forms) == "") { ?>
		<th data-name="printed_forms" class="<?php echo $printingreport1_list->printed_forms->headerCellClass() ?>"><div id="elh_printingreport1_printed_forms" class="printingreport1_printed_forms"><div class="ew-table-header-caption"><?php echo $printingreport1_list->printed_forms->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="printed_forms" class="<?php echo $printingreport1_list->printed_forms->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->printed_forms) ?>', 1);"><div id="elh_printingreport1_printed_forms" class="printingreport1_printed_forms">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->printed_forms->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->printed_forms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->printed_forms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->total_forms->Visible) { // total_forms ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->total_forms) == "") { ?>
		<th data-name="total_forms" class="<?php echo $printingreport1_list->total_forms->headerCellClass() ?>"><div id="elh_printingreport1_total_forms" class="printingreport1_total_forms"><div class="ew-table-header-caption"><?php echo $printingreport1_list->total_forms->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_forms" class="<?php echo $printingreport1_list->total_forms->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->total_forms) ?>', 1);"><div id="elh_printingreport1_total_forms" class="printingreport1_total_forms">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->total_forms->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->total_forms->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->total_forms->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->year_dsc->Visible) { // year_dsc ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->year_dsc) == "") { ?>
		<th data-name="year_dsc" class="<?php echo $printingreport1_list->year_dsc->headerCellClass() ?>"><div id="elh_printingreport1_year_dsc" class="printingreport1_year_dsc"><div class="ew-table-header-caption"><?php echo $printingreport1_list->year_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="year_dsc" class="<?php echo $printingreport1_list->year_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->year_dsc) ?>', 1);"><div id="elh_printingreport1_year_dsc" class="printingreport1_year_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->year_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->year_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->year_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->month_dsc->Visible) { // month_dsc ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->month_dsc) == "") { ?>
		<th data-name="month_dsc" class="<?php echo $printingreport1_list->month_dsc->headerCellClass() ?>"><div id="elh_printingreport1_month_dsc" class="printingreport1_month_dsc"><div class="ew-table-header-caption"><?php echo $printingreport1_list->month_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="month_dsc" class="<?php echo $printingreport1_list->month_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->month_dsc) ?>', 1);"><div id="elh_printingreport1_month_dsc" class="printingreport1_month_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->month_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->month_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->month_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->typeofprinting->Visible) { // typeofprinting ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->typeofprinting) == "") { ?>
		<th data-name="typeofprinting" class="<?php echo $printingreport1_list->typeofprinting->headerCellClass() ?>"><div id="elh_printingreport1_typeofprinting" class="printingreport1_typeofprinting"><div class="ew-table-header-caption"><?php echo $printingreport1_list->typeofprinting->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="typeofprinting" class="<?php echo $printingreport1_list->typeofprinting->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->typeofprinting) ?>', 1);"><div id="elh_printingreport1_typeofprinting" class="printingreport1_typeofprinting">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->typeofprinting->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->typeofprinting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->typeofprinting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->statusPrinting->Visible) { // statusPrinting ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->statusPrinting) == "") { ?>
		<th data-name="statusPrinting" class="<?php echo $printingreport1_list->statusPrinting->headerCellClass() ?>"><div id="elh_printingreport1_statusPrinting" class="printingreport1_statusPrinting"><div class="ew-table-header-caption"><?php echo $printingreport1_list->statusPrinting->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="statusPrinting" class="<?php echo $printingreport1_list->statusPrinting->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->statusPrinting) ?>', 1);"><div id="elh_printingreport1_statusPrinting" class="printingreport1_statusPrinting">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->statusPrinting->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->statusPrinting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->statusPrinting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $printingreport1_list->Name_dsc->headerCellClass() ?>"><div id="elh_printingreport1_Name_dsc" class="printingreport1_Name_dsc"><div class="ew-table-header-caption"><?php echo $printingreport1_list->Name_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $printingreport1_list->Name_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->Name_dsc) ?>', 1);"><div id="elh_printingreport1_Name_dsc" class="printingreport1_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->Name_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($printingreport1_list->employeeid->Visible) { // employeeid ?>
	<?php if ($printingreport1_list->SortUrl($printingreport1_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $printingreport1_list->employeeid->headerCellClass() ?>"><div id="elh_printingreport1_employeeid" class="printingreport1_employeeid"><div class="ew-table-header-caption"><?php echo $printingreport1_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $printingreport1_list->employeeid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $printingreport1_list->SortUrl($printingreport1_list->employeeid) ?>', 1);"><div id="elh_printingreport1_employeeid" class="printingreport1_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $printingreport1_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($printingreport1_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($printingreport1_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$printingreport1_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($printingreport1_list->ExportAll && $printingreport1_list->isExport()) {
	$printingreport1_list->StopRecord = $printingreport1_list->TotalRecords;
} else {

	// Set the last record to display
	if ($printingreport1_list->TotalRecords > $printingreport1_list->StartRecord + $printingreport1_list->DisplayRecords - 1)
		$printingreport1_list->StopRecord = $printingreport1_list->StartRecord + $printingreport1_list->DisplayRecords - 1;
	else
		$printingreport1_list->StopRecord = $printingreport1_list->TotalRecords;
}
$printingreport1_list->RecordCount = $printingreport1_list->StartRecord - 1;
if ($printingreport1_list->Recordset && !$printingreport1_list->Recordset->EOF) {
	$printingreport1_list->Recordset->moveFirst();
	$selectLimit = $printingreport1_list->UseSelectLimit;
	if (!$selectLimit && $printingreport1_list->StartRecord > 1)
		$printingreport1_list->Recordset->move($printingreport1_list->StartRecord - 1);
} elseif (!$printingreport1->AllowAddDeleteRow && $printingreport1_list->StopRecord == 0) {
	$printingreport1_list->StopRecord = $printingreport1->GridAddRowCount;
}

// Initialize aggregate
$printingreport1->RowType = ROWTYPE_AGGREGATEINIT;
$printingreport1->resetAttributes();
$printingreport1_list->renderRow();
while ($printingreport1_list->RecordCount < $printingreport1_list->StopRecord) {
	$printingreport1_list->RecordCount++;
	if ($printingreport1_list->RecordCount >= $printingreport1_list->StartRecord) {
		$printingreport1_list->RowCount++;

		// Set up key count
		$printingreport1_list->KeyCount = $printingreport1_list->RowIndex;

		// Init row class and style
		$printingreport1->resetAttributes();
		$printingreport1->CssClass = "";
		if ($printingreport1_list->isGridAdd()) {
		} else {
			$printingreport1_list->loadRowValues($printingreport1_list->Recordset); // Load row values
		}
		$printingreport1->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$printingreport1->RowAttrs->merge(["data-rowindex" => $printingreport1_list->RowCount, "id" => "r" . $printingreport1_list->RowCount . "_printingreport1", "data-rowtype" => $printingreport1->RowType]);

		// Render row
		$printingreport1_list->renderRow();

		// Render list options
		$printingreport1_list->renderListOptions();
?>
	<tr <?php echo $printingreport1->rowAttributes() ?>>
<?php

// Render list options (body, left)
$printingreport1_list->ListOptions->render("body", "left", $printingreport1_list->RowCount);
?>
	<?php if ($printingreport1_list->printing_date->Visible) { // printing_date ?>
		<td data-name="printing_date" <?php echo $printingreport1_list->printing_date->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_printing_date">
<span<?php echo $printingreport1_list->printing_date->viewAttributes() ?>><?php echo $printingreport1_list->printing_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->printed_forms->Visible) { // printed_forms ?>
		<td data-name="printed_forms" <?php echo $printingreport1_list->printed_forms->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_printed_forms">
<span<?php echo $printingreport1_list->printed_forms->viewAttributes() ?>><?php echo $printingreport1_list->printed_forms->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->total_forms->Visible) { // total_forms ?>
		<td data-name="total_forms" <?php echo $printingreport1_list->total_forms->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_total_forms">
<span<?php echo $printingreport1_list->total_forms->viewAttributes() ?>><?php echo $printingreport1_list->total_forms->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->year_dsc->Visible) { // year_dsc ?>
		<td data-name="year_dsc" <?php echo $printingreport1_list->year_dsc->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_year_dsc">
<span<?php echo $printingreport1_list->year_dsc->viewAttributes() ?>><?php echo $printingreport1_list->year_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" <?php echo $printingreport1_list->month_dsc->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_month_dsc">
<span<?php echo $printingreport1_list->month_dsc->viewAttributes() ?>><?php echo $printingreport1_list->month_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->typeofprinting->Visible) { // typeofprinting ?>
		<td data-name="typeofprinting" <?php echo $printingreport1_list->typeofprinting->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_typeofprinting">
<span<?php echo $printingreport1_list->typeofprinting->viewAttributes() ?>><?php echo $printingreport1_list->typeofprinting->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->statusPrinting->Visible) { // statusPrinting ?>
		<td data-name="statusPrinting" <?php echo $printingreport1_list->statusPrinting->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_statusPrinting">
<span<?php echo $printingreport1_list->statusPrinting->viewAttributes() ?>><?php echo $printingreport1_list->statusPrinting->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $printingreport1_list->Name_dsc->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_Name_dsc">
<span<?php echo $printingreport1_list->Name_dsc->viewAttributes() ?>><?php echo $printingreport1_list->Name_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($printingreport1_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $printingreport1_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $printingreport1_list->RowCount ?>_printingreport1_employeeid">
<span<?php echo $printingreport1_list->employeeid->viewAttributes() ?>><?php echo $printingreport1_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$printingreport1_list->ListOptions->render("body", "right", $printingreport1_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$printingreport1_list->isGridAdd())
		$printingreport1_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$printingreport1->RowType = ROWTYPE_AGGREGATE;
$printingreport1->resetAttributes();
$printingreport1_list->renderRow();
?>
<?php if ($printingreport1_list->TotalRecords > 0 && !$printingreport1_list->isGridAdd() && !$printingreport1_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$printingreport1_list->renderListOptions();

// Render list options (footer, left)
$printingreport1_list->ListOptions->render("footer", "left");
?>
	<?php if ($printingreport1_list->printing_date->Visible) { // printing_date ?>
		<td data-name="printing_date" class="<?php echo $printingreport1_list->printing_date->footerCellClass() ?>"><span id="elf_printingreport1_printing_date" class="printingreport1_printing_date">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->printed_forms->Visible) { // printed_forms ?>
		<td data-name="printed_forms" class="<?php echo $printingreport1_list->printed_forms->footerCellClass() ?>"><span id="elf_printingreport1_printed_forms" class="printingreport1_printed_forms">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->total_forms->Visible) { // total_forms ?>
		<td data-name="total_forms" class="<?php echo $printingreport1_list->total_forms->footerCellClass() ?>"><span id="elf_printingreport1_total_forms" class="printingreport1_total_forms">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $printingreport1_list->total_forms->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->year_dsc->Visible) { // year_dsc ?>
		<td data-name="year_dsc" class="<?php echo $printingreport1_list->year_dsc->footerCellClass() ?>"><span id="elf_printingreport1_year_dsc" class="printingreport1_year_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" class="<?php echo $printingreport1_list->month_dsc->footerCellClass() ?>"><span id="elf_printingreport1_month_dsc" class="printingreport1_month_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->typeofprinting->Visible) { // typeofprinting ?>
		<td data-name="typeofprinting" class="<?php echo $printingreport1_list->typeofprinting->footerCellClass() ?>"><span id="elf_printingreport1_typeofprinting" class="printingreport1_typeofprinting">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->statusPrinting->Visible) { // statusPrinting ?>
		<td data-name="statusPrinting" class="<?php echo $printingreport1_list->statusPrinting->footerCellClass() ?>"><span id="elf_printingreport1_statusPrinting" class="printingreport1_statusPrinting">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" class="<?php echo $printingreport1_list->Name_dsc->footerCellClass() ?>"><span id="elf_printingreport1_Name_dsc" class="printingreport1_Name_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($printingreport1_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" class="<?php echo $printingreport1_list->employeeid->footerCellClass() ?>"><span id="elf_printingreport1_employeeid" class="printingreport1_employeeid">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$printingreport1_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$printingreport1->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($printingreport1_list->Recordset)
	$printingreport1_list->Recordset->Close();
?>
<?php if (!$printingreport1_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $printingreport1_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($printingreport1_list->TotalRecords == 0 && !$printingreport1->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $printingreport1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$printingreport1_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$printingreport1_list->isExport()) { ?>
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
$printingreport1_list->terminate();
?>