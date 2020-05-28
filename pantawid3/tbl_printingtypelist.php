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
$tbl_printingtype_list = new tbl_printingtype_list();

// Run the page
$tbl_printingtype_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printingtype_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_printingtype_list->isExport()) { ?>
<script>
var ftbl_printingtypelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_printingtypelist = currentForm = new ew.Form("ftbl_printingtypelist", "list");
	ftbl_printingtypelist.formKeyCountName = '<?php echo $tbl_printingtype_list->FormKeyCountName ?>';
	loadjs.done("ftbl_printingtypelist");
});
var ftbl_printingtypelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_printingtypelistsrch = currentSearchForm = new ew.Form("ftbl_printingtypelistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_printingtypelistsrch.filterList = <?php echo $tbl_printingtype_list->getFilterList() ?>;
	loadjs.done("ftbl_printingtypelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_printingtype_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_printingtype_list->TotalRecords > 0 && $tbl_printingtype_list->ExportOptions->visible()) { ?>
<?php $tbl_printingtype_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printingtype_list->ImportOptions->visible()) { ?>
<?php $tbl_printingtype_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printingtype_list->SearchOptions->visible()) { ?>
<?php $tbl_printingtype_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printingtype_list->FilterOptions->visible()) { ?>
<?php $tbl_printingtype_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_printingtype_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_printingtype_list->isExport() && !$tbl_printingtype->CurrentAction) { ?>
<form name="ftbl_printingtypelistsrch" id="ftbl_printingtypelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_printingtypelistsrch-search-panel" class="<?php echo $tbl_printingtype_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_printingtype">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_printingtype_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_printingtype_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_printingtype_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_printingtype_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_printingtype_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_printingtype_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_printingtype_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_printingtype_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_printingtype_list->showPageHeader(); ?>
<?php
$tbl_printingtype_list->showMessage();
?>
<?php if ($tbl_printingtype_list->TotalRecords > 0 || $tbl_printingtype->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_printingtype_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_printingtype">
<form name="ftbl_printingtypelist" id="ftbl_printingtypelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printingtype">
<div id="gmp_tbl_printingtype" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_printingtype_list->TotalRecords > 0 || $tbl_printingtype_list->isGridEdit()) { ?>
<table id="tbl_tbl_printingtypelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_printingtype->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_printingtype_list->renderListOptions();

// Render list options (header, left)
$tbl_printingtype_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_printingtype_list->printingtypeID->Visible) { // printingtypeID ?>
	<?php if ($tbl_printingtype_list->SortUrl($tbl_printingtype_list->printingtypeID) == "") { ?>
		<th data-name="printingtypeID" class="<?php echo $tbl_printingtype_list->printingtypeID->headerCellClass() ?>"><div id="elh_tbl_printingtype_printingtypeID" class="tbl_printingtype_printingtypeID"><div class="ew-table-header-caption"><?php echo $tbl_printingtype_list->printingtypeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="printingtypeID" class="<?php echo $tbl_printingtype_list->printingtypeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printingtype_list->SortUrl($tbl_printingtype_list->printingtypeID) ?>', 1);"><div id="elh_tbl_printingtype_printingtypeID" class="tbl_printingtype_printingtypeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printingtype_list->printingtypeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_printingtype_list->printingtypeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printingtype_list->printingtypeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printingtype_list->typeofprinting->Visible) { // typeofprinting ?>
	<?php if ($tbl_printingtype_list->SortUrl($tbl_printingtype_list->typeofprinting) == "") { ?>
		<th data-name="typeofprinting" class="<?php echo $tbl_printingtype_list->typeofprinting->headerCellClass() ?>"><div id="elh_tbl_printingtype_typeofprinting" class="tbl_printingtype_typeofprinting"><div class="ew-table-header-caption"><?php echo $tbl_printingtype_list->typeofprinting->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="typeofprinting" class="<?php echo $tbl_printingtype_list->typeofprinting->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printingtype_list->SortUrl($tbl_printingtype_list->typeofprinting) ?>', 1);"><div id="elh_tbl_printingtype_typeofprinting" class="tbl_printingtype_typeofprinting">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printingtype_list->typeofprinting->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_printingtype_list->typeofprinting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printingtype_list->typeofprinting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_printingtype_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_printingtype_list->ExportAll && $tbl_printingtype_list->isExport()) {
	$tbl_printingtype_list->StopRecord = $tbl_printingtype_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_printingtype_list->TotalRecords > $tbl_printingtype_list->StartRecord + $tbl_printingtype_list->DisplayRecords - 1)
		$tbl_printingtype_list->StopRecord = $tbl_printingtype_list->StartRecord + $tbl_printingtype_list->DisplayRecords - 1;
	else
		$tbl_printingtype_list->StopRecord = $tbl_printingtype_list->TotalRecords;
}
$tbl_printingtype_list->RecordCount = $tbl_printingtype_list->StartRecord - 1;
if ($tbl_printingtype_list->Recordset && !$tbl_printingtype_list->Recordset->EOF) {
	$tbl_printingtype_list->Recordset->moveFirst();
	$selectLimit = $tbl_printingtype_list->UseSelectLimit;
	if (!$selectLimit && $tbl_printingtype_list->StartRecord > 1)
		$tbl_printingtype_list->Recordset->move($tbl_printingtype_list->StartRecord - 1);
} elseif (!$tbl_printingtype->AllowAddDeleteRow && $tbl_printingtype_list->StopRecord == 0) {
	$tbl_printingtype_list->StopRecord = $tbl_printingtype->GridAddRowCount;
}

// Initialize aggregate
$tbl_printingtype->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_printingtype->resetAttributes();
$tbl_printingtype_list->renderRow();
while ($tbl_printingtype_list->RecordCount < $tbl_printingtype_list->StopRecord) {
	$tbl_printingtype_list->RecordCount++;
	if ($tbl_printingtype_list->RecordCount >= $tbl_printingtype_list->StartRecord) {
		$tbl_printingtype_list->RowCount++;

		// Set up key count
		$tbl_printingtype_list->KeyCount = $tbl_printingtype_list->RowIndex;

		// Init row class and style
		$tbl_printingtype->resetAttributes();
		$tbl_printingtype->CssClass = "";
		if ($tbl_printingtype_list->isGridAdd()) {
		} else {
			$tbl_printingtype_list->loadRowValues($tbl_printingtype_list->Recordset); // Load row values
		}
		$tbl_printingtype->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_printingtype->RowAttrs->merge(["data-rowindex" => $tbl_printingtype_list->RowCount, "id" => "r" . $tbl_printingtype_list->RowCount . "_tbl_printingtype", "data-rowtype" => $tbl_printingtype->RowType]);

		// Render row
		$tbl_printingtype_list->renderRow();

		// Render list options
		$tbl_printingtype_list->renderListOptions();
?>
	<tr <?php echo $tbl_printingtype->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_printingtype_list->ListOptions->render("body", "left", $tbl_printingtype_list->RowCount);
?>
	<?php if ($tbl_printingtype_list->printingtypeID->Visible) { // printingtypeID ?>
		<td data-name="printingtypeID" <?php echo $tbl_printingtype_list->printingtypeID->cellAttributes() ?>>
<span id="el<?php echo $tbl_printingtype_list->RowCount ?>_tbl_printingtype_printingtypeID">
<span<?php echo $tbl_printingtype_list->printingtypeID->viewAttributes() ?>><?php echo $tbl_printingtype_list->printingtypeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printingtype_list->typeofprinting->Visible) { // typeofprinting ?>
		<td data-name="typeofprinting" <?php echo $tbl_printingtype_list->typeofprinting->cellAttributes() ?>>
<span id="el<?php echo $tbl_printingtype_list->RowCount ?>_tbl_printingtype_typeofprinting">
<span<?php echo $tbl_printingtype_list->typeofprinting->viewAttributes() ?>><?php echo $tbl_printingtype_list->typeofprinting->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_printingtype_list->ListOptions->render("body", "right", $tbl_printingtype_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_printingtype_list->isGridAdd())
		$tbl_printingtype_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_printingtype->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_printingtype_list->Recordset)
	$tbl_printingtype_list->Recordset->Close();
?>
<?php if (!$tbl_printingtype_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_printingtype_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_printingtype_list->TotalRecords == 0 && !$tbl_printingtype->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_printingtype_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_printingtype_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_printingtype_list->isExport()) { ?>
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
$tbl_printingtype_list->terminate();
?>