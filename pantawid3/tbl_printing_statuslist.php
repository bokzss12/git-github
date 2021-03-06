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
$tbl_printing_status_list = new tbl_printing_status_list();

// Run the page
$tbl_printing_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printing_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_printing_status_list->isExport()) { ?>
<script>
var ftbl_printing_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_printing_statuslist = currentForm = new ew.Form("ftbl_printing_statuslist", "list");
	ftbl_printing_statuslist.formKeyCountName = '<?php echo $tbl_printing_status_list->FormKeyCountName ?>';
	loadjs.done("ftbl_printing_statuslist");
});
var ftbl_printing_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_printing_statuslistsrch = currentSearchForm = new ew.Form("ftbl_printing_statuslistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_printing_statuslistsrch.filterList = <?php echo $tbl_printing_status_list->getFilterList() ?>;
	loadjs.done("ftbl_printing_statuslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_printing_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_printing_status_list->TotalRecords > 0 && $tbl_printing_status_list->ExportOptions->visible()) { ?>
<?php $tbl_printing_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printing_status_list->ImportOptions->visible()) { ?>
<?php $tbl_printing_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printing_status_list->SearchOptions->visible()) { ?>
<?php $tbl_printing_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_printing_status_list->FilterOptions->visible()) { ?>
<?php $tbl_printing_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_printing_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_printing_status_list->isExport() && !$tbl_printing_status->CurrentAction) { ?>
<form name="ftbl_printing_statuslistsrch" id="ftbl_printing_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_printing_statuslistsrch-search-panel" class="<?php echo $tbl_printing_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_printing_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_printing_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_printing_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_printing_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_printing_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_printing_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_printing_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_printing_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_printing_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_printing_status_list->showPageHeader(); ?>
<?php
$tbl_printing_status_list->showMessage();
?>
<?php if ($tbl_printing_status_list->TotalRecords > 0 || $tbl_printing_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_printing_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_printing_status">
<form name="ftbl_printing_statuslist" id="ftbl_printing_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printing_status">
<div id="gmp_tbl_printing_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_printing_status_list->TotalRecords > 0 || $tbl_printing_status_list->isGridEdit()) { ?>
<table id="tbl_tbl_printing_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_printing_status->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_printing_status_list->renderListOptions();

// Render list options (header, left)
$tbl_printing_status_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_printing_status_list->status_printingID->Visible) { // status_printingID ?>
	<?php if ($tbl_printing_status_list->SortUrl($tbl_printing_status_list->status_printingID) == "") { ?>
		<th data-name="status_printingID" class="<?php echo $tbl_printing_status_list->status_printingID->headerCellClass() ?>"><div id="elh_tbl_printing_status_status_printingID" class="tbl_printing_status_status_printingID"><div class="ew-table-header-caption"><?php echo $tbl_printing_status_list->status_printingID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_printingID" class="<?php echo $tbl_printing_status_list->status_printingID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_status_list->SortUrl($tbl_printing_status_list->status_printingID) ?>', 1);"><div id="elh_tbl_printing_status_status_printingID" class="tbl_printing_status_status_printingID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_status_list->status_printingID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_status_list->status_printingID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_status_list->status_printingID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_printing_status_list->statusPrinting->Visible) { // statusPrinting ?>
	<?php if ($tbl_printing_status_list->SortUrl($tbl_printing_status_list->statusPrinting) == "") { ?>
		<th data-name="statusPrinting" class="<?php echo $tbl_printing_status_list->statusPrinting->headerCellClass() ?>"><div id="elh_tbl_printing_status_statusPrinting" class="tbl_printing_status_statusPrinting"><div class="ew-table-header-caption"><?php echo $tbl_printing_status_list->statusPrinting->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="statusPrinting" class="<?php echo $tbl_printing_status_list->statusPrinting->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_printing_status_list->SortUrl($tbl_printing_status_list->statusPrinting) ?>', 1);"><div id="elh_tbl_printing_status_statusPrinting" class="tbl_printing_status_statusPrinting">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_printing_status_list->statusPrinting->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_printing_status_list->statusPrinting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_printing_status_list->statusPrinting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_printing_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_printing_status_list->ExportAll && $tbl_printing_status_list->isExport()) {
	$tbl_printing_status_list->StopRecord = $tbl_printing_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_printing_status_list->TotalRecords > $tbl_printing_status_list->StartRecord + $tbl_printing_status_list->DisplayRecords - 1)
		$tbl_printing_status_list->StopRecord = $tbl_printing_status_list->StartRecord + $tbl_printing_status_list->DisplayRecords - 1;
	else
		$tbl_printing_status_list->StopRecord = $tbl_printing_status_list->TotalRecords;
}
$tbl_printing_status_list->RecordCount = $tbl_printing_status_list->StartRecord - 1;
if ($tbl_printing_status_list->Recordset && !$tbl_printing_status_list->Recordset->EOF) {
	$tbl_printing_status_list->Recordset->moveFirst();
	$selectLimit = $tbl_printing_status_list->UseSelectLimit;
	if (!$selectLimit && $tbl_printing_status_list->StartRecord > 1)
		$tbl_printing_status_list->Recordset->move($tbl_printing_status_list->StartRecord - 1);
} elseif (!$tbl_printing_status->AllowAddDeleteRow && $tbl_printing_status_list->StopRecord == 0) {
	$tbl_printing_status_list->StopRecord = $tbl_printing_status->GridAddRowCount;
}

// Initialize aggregate
$tbl_printing_status->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_printing_status->resetAttributes();
$tbl_printing_status_list->renderRow();
while ($tbl_printing_status_list->RecordCount < $tbl_printing_status_list->StopRecord) {
	$tbl_printing_status_list->RecordCount++;
	if ($tbl_printing_status_list->RecordCount >= $tbl_printing_status_list->StartRecord) {
		$tbl_printing_status_list->RowCount++;

		// Set up key count
		$tbl_printing_status_list->KeyCount = $tbl_printing_status_list->RowIndex;

		// Init row class and style
		$tbl_printing_status->resetAttributes();
		$tbl_printing_status->CssClass = "";
		if ($tbl_printing_status_list->isGridAdd()) {
		} else {
			$tbl_printing_status_list->loadRowValues($tbl_printing_status_list->Recordset); // Load row values
		}
		$tbl_printing_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_printing_status->RowAttrs->merge(["data-rowindex" => $tbl_printing_status_list->RowCount, "id" => "r" . $tbl_printing_status_list->RowCount . "_tbl_printing_status", "data-rowtype" => $tbl_printing_status->RowType]);

		// Render row
		$tbl_printing_status_list->renderRow();

		// Render list options
		$tbl_printing_status_list->renderListOptions();
?>
	<tr <?php echo $tbl_printing_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_printing_status_list->ListOptions->render("body", "left", $tbl_printing_status_list->RowCount);
?>
	<?php if ($tbl_printing_status_list->status_printingID->Visible) { // status_printingID ?>
		<td data-name="status_printingID" <?php echo $tbl_printing_status_list->status_printingID->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_status_list->RowCount ?>_tbl_printing_status_status_printingID">
<span<?php echo $tbl_printing_status_list->status_printingID->viewAttributes() ?>><?php echo $tbl_printing_status_list->status_printingID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_printing_status_list->statusPrinting->Visible) { // statusPrinting ?>
		<td data-name="statusPrinting" <?php echo $tbl_printing_status_list->statusPrinting->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_status_list->RowCount ?>_tbl_printing_status_statusPrinting">
<span<?php echo $tbl_printing_status_list->statusPrinting->viewAttributes() ?>><?php echo $tbl_printing_status_list->statusPrinting->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_printing_status_list->ListOptions->render("body", "right", $tbl_printing_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_printing_status_list->isGridAdd())
		$tbl_printing_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_printing_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_printing_status_list->Recordset)
	$tbl_printing_status_list->Recordset->Close();
?>
<?php if (!$tbl_printing_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_printing_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_printing_status_list->TotalRecords == 0 && !$tbl_printing_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_printing_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_printing_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_printing_status_list->isExport()) { ?>
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
$tbl_printing_status_list->terminate();
?>