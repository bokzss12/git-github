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
$tbl_month_list = new tbl_month_list();

// Run the page
$tbl_month_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_month_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_month_list->isExport()) { ?>
<script>
var ftbl_monthlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_monthlist = currentForm = new ew.Form("ftbl_monthlist", "list");
	ftbl_monthlist.formKeyCountName = '<?php echo $tbl_month_list->FormKeyCountName ?>';
	loadjs.done("ftbl_monthlist");
});
var ftbl_monthlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_monthlistsrch = currentSearchForm = new ew.Form("ftbl_monthlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_monthlistsrch.filterList = <?php echo $tbl_month_list->getFilterList() ?>;
	loadjs.done("ftbl_monthlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_month_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_month_list->TotalRecords > 0 && $tbl_month_list->ExportOptions->visible()) { ?>
<?php $tbl_month_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_month_list->ImportOptions->visible()) { ?>
<?php $tbl_month_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_month_list->SearchOptions->visible()) { ?>
<?php $tbl_month_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_month_list->FilterOptions->visible()) { ?>
<?php $tbl_month_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_month_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_month_list->isExport() && !$tbl_month->CurrentAction) { ?>
<form name="ftbl_monthlistsrch" id="ftbl_monthlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_monthlistsrch-search-panel" class="<?php echo $tbl_month_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_month">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_month_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_month_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_month_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_month_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_month_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_month_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_month_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_month_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_month_list->showPageHeader(); ?>
<?php
$tbl_month_list->showMessage();
?>
<?php if ($tbl_month_list->TotalRecords > 0 || $tbl_month->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_month_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_month">
<form name="ftbl_monthlist" id="ftbl_monthlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_month">
<div id="gmp_tbl_month" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_month_list->TotalRecords > 0 || $tbl_month_list->isGridEdit()) { ?>
<table id="tbl_tbl_monthlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_month->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_month_list->renderListOptions();

// Render list options (header, left)
$tbl_month_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_month_list->month_id->Visible) { // month_id ?>
	<?php if ($tbl_month_list->SortUrl($tbl_month_list->month_id) == "") { ?>
		<th data-name="month_id" class="<?php echo $tbl_month_list->month_id->headerCellClass() ?>"><div id="elh_tbl_month_month_id" class="tbl_month_month_id"><div class="ew-table-header-caption"><?php echo $tbl_month_list->month_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="month_id" class="<?php echo $tbl_month_list->month_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_month_list->SortUrl($tbl_month_list->month_id) ?>', 1);"><div id="elh_tbl_month_month_id" class="tbl_month_month_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_month_list->month_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_month_list->month_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_month_list->month_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_month_list->month_dsc->Visible) { // month_dsc ?>
	<?php if ($tbl_month_list->SortUrl($tbl_month_list->month_dsc) == "") { ?>
		<th data-name="month_dsc" class="<?php echo $tbl_month_list->month_dsc->headerCellClass() ?>"><div id="elh_tbl_month_month_dsc" class="tbl_month_month_dsc"><div class="ew-table-header-caption"><?php echo $tbl_month_list->month_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="month_dsc" class="<?php echo $tbl_month_list->month_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_month_list->SortUrl($tbl_month_list->month_dsc) ?>', 1);"><div id="elh_tbl_month_month_dsc" class="tbl_month_month_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_month_list->month_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_month_list->month_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_month_list->month_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_month_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_month_list->ExportAll && $tbl_month_list->isExport()) {
	$tbl_month_list->StopRecord = $tbl_month_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_month_list->TotalRecords > $tbl_month_list->StartRecord + $tbl_month_list->DisplayRecords - 1)
		$tbl_month_list->StopRecord = $tbl_month_list->StartRecord + $tbl_month_list->DisplayRecords - 1;
	else
		$tbl_month_list->StopRecord = $tbl_month_list->TotalRecords;
}
$tbl_month_list->RecordCount = $tbl_month_list->StartRecord - 1;
if ($tbl_month_list->Recordset && !$tbl_month_list->Recordset->EOF) {
	$tbl_month_list->Recordset->moveFirst();
	$selectLimit = $tbl_month_list->UseSelectLimit;
	if (!$selectLimit && $tbl_month_list->StartRecord > 1)
		$tbl_month_list->Recordset->move($tbl_month_list->StartRecord - 1);
} elseif (!$tbl_month->AllowAddDeleteRow && $tbl_month_list->StopRecord == 0) {
	$tbl_month_list->StopRecord = $tbl_month->GridAddRowCount;
}

// Initialize aggregate
$tbl_month->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_month->resetAttributes();
$tbl_month_list->renderRow();
while ($tbl_month_list->RecordCount < $tbl_month_list->StopRecord) {
	$tbl_month_list->RecordCount++;
	if ($tbl_month_list->RecordCount >= $tbl_month_list->StartRecord) {
		$tbl_month_list->RowCount++;

		// Set up key count
		$tbl_month_list->KeyCount = $tbl_month_list->RowIndex;

		// Init row class and style
		$tbl_month->resetAttributes();
		$tbl_month->CssClass = "";
		if ($tbl_month_list->isGridAdd()) {
		} else {
			$tbl_month_list->loadRowValues($tbl_month_list->Recordset); // Load row values
		}
		$tbl_month->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_month->RowAttrs->merge(["data-rowindex" => $tbl_month_list->RowCount, "id" => "r" . $tbl_month_list->RowCount . "_tbl_month", "data-rowtype" => $tbl_month->RowType]);

		// Render row
		$tbl_month_list->renderRow();

		// Render list options
		$tbl_month_list->renderListOptions();
?>
	<tr <?php echo $tbl_month->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_month_list->ListOptions->render("body", "left", $tbl_month_list->RowCount);
?>
	<?php if ($tbl_month_list->month_id->Visible) { // month_id ?>
		<td data-name="month_id" <?php echo $tbl_month_list->month_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_month_list->RowCount ?>_tbl_month_month_id">
<span<?php echo $tbl_month_list->month_id->viewAttributes() ?>><?php echo $tbl_month_list->month_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_month_list->month_dsc->Visible) { // month_dsc ?>
		<td data-name="month_dsc" <?php echo $tbl_month_list->month_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_month_list->RowCount ?>_tbl_month_month_dsc">
<span<?php echo $tbl_month_list->month_dsc->viewAttributes() ?>><?php echo $tbl_month_list->month_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_month_list->ListOptions->render("body", "right", $tbl_month_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_month_list->isGridAdd())
		$tbl_month_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_month->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_month_list->Recordset)
	$tbl_month_list->Recordset->Close();
?>
<?php if (!$tbl_month_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_month_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_month_list->TotalRecords == 0 && !$tbl_month->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_month_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_month_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_month_list->isExport()) { ?>
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
$tbl_month_list->terminate();
?>