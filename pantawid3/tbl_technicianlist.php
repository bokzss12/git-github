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
$tbl_technician_list = new tbl_technician_list();

// Run the page
$tbl_technician_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_technician_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_technician_list->isExport()) { ?>
<script>
var ftbl_technicianlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_technicianlist = currentForm = new ew.Form("ftbl_technicianlist", "list");
	ftbl_technicianlist.formKeyCountName = '<?php echo $tbl_technician_list->FormKeyCountName ?>';
	loadjs.done("ftbl_technicianlist");
});
var ftbl_technicianlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_technicianlistsrch = currentSearchForm = new ew.Form("ftbl_technicianlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_technicianlistsrch.filterList = <?php echo $tbl_technician_list->getFilterList() ?>;
	loadjs.done("ftbl_technicianlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_technician_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_technician_list->TotalRecords > 0 && $tbl_technician_list->ExportOptions->visible()) { ?>
<?php $tbl_technician_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_technician_list->ImportOptions->visible()) { ?>
<?php $tbl_technician_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_technician_list->SearchOptions->visible()) { ?>
<?php $tbl_technician_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_technician_list->FilterOptions->visible()) { ?>
<?php $tbl_technician_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_technician_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_technician_list->isExport() && !$tbl_technician->CurrentAction) { ?>
<form name="ftbl_technicianlistsrch" id="ftbl_technicianlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_technicianlistsrch-search-panel" class="<?php echo $tbl_technician_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_technician">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_technician_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_technician_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_technician_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_technician_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_technician_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_technician_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_technician_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_technician_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_technician_list->showPageHeader(); ?>
<?php
$tbl_technician_list->showMessage();
?>
<?php if ($tbl_technician_list->TotalRecords > 0 || $tbl_technician->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_technician_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_technician">
<form name="ftbl_technicianlist" id="ftbl_technicianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_technician">
<div id="gmp_tbl_technician" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_technician_list->TotalRecords > 0 || $tbl_technician_list->isGridEdit()) { ?>
<table id="tbl_tbl_technicianlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_technician->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_technician_list->renderListOptions();

// Render list options (header, left)
$tbl_technician_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_technician_list->technician_id->Visible) { // technician_id ?>
	<?php if ($tbl_technician_list->SortUrl($tbl_technician_list->technician_id) == "") { ?>
		<th data-name="technician_id" class="<?php echo $tbl_technician_list->technician_id->headerCellClass() ?>"><div id="elh_tbl_technician_technician_id" class="tbl_technician_technician_id"><div class="ew-table-header-caption"><?php echo $tbl_technician_list->technician_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="technician_id" class="<?php echo $tbl_technician_list->technician_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_technician_list->SortUrl($tbl_technician_list->technician_id) ?>', 1);"><div id="elh_tbl_technician_technician_id" class="tbl_technician_technician_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_technician_list->technician_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_technician_list->technician_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_technician_list->technician_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_technician_list->technician_dsc->Visible) { // technician_dsc ?>
	<?php if ($tbl_technician_list->SortUrl($tbl_technician_list->technician_dsc) == "") { ?>
		<th data-name="technician_dsc" class="<?php echo $tbl_technician_list->technician_dsc->headerCellClass() ?>"><div id="elh_tbl_technician_technician_dsc" class="tbl_technician_technician_dsc"><div class="ew-table-header-caption"><?php echo $tbl_technician_list->technician_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="technician_dsc" class="<?php echo $tbl_technician_list->technician_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_technician_list->SortUrl($tbl_technician_list->technician_dsc) ?>', 1);"><div id="elh_tbl_technician_technician_dsc" class="tbl_technician_technician_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_technician_list->technician_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_technician_list->technician_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_technician_list->technician_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_technician_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_technician_list->ExportAll && $tbl_technician_list->isExport()) {
	$tbl_technician_list->StopRecord = $tbl_technician_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_technician_list->TotalRecords > $tbl_technician_list->StartRecord + $tbl_technician_list->DisplayRecords - 1)
		$tbl_technician_list->StopRecord = $tbl_technician_list->StartRecord + $tbl_technician_list->DisplayRecords - 1;
	else
		$tbl_technician_list->StopRecord = $tbl_technician_list->TotalRecords;
}
$tbl_technician_list->RecordCount = $tbl_technician_list->StartRecord - 1;
if ($tbl_technician_list->Recordset && !$tbl_technician_list->Recordset->EOF) {
	$tbl_technician_list->Recordset->moveFirst();
	$selectLimit = $tbl_technician_list->UseSelectLimit;
	if (!$selectLimit && $tbl_technician_list->StartRecord > 1)
		$tbl_technician_list->Recordset->move($tbl_technician_list->StartRecord - 1);
} elseif (!$tbl_technician->AllowAddDeleteRow && $tbl_technician_list->StopRecord == 0) {
	$tbl_technician_list->StopRecord = $tbl_technician->GridAddRowCount;
}

// Initialize aggregate
$tbl_technician->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_technician->resetAttributes();
$tbl_technician_list->renderRow();
while ($tbl_technician_list->RecordCount < $tbl_technician_list->StopRecord) {
	$tbl_technician_list->RecordCount++;
	if ($tbl_technician_list->RecordCount >= $tbl_technician_list->StartRecord) {
		$tbl_technician_list->RowCount++;

		// Set up key count
		$tbl_technician_list->KeyCount = $tbl_technician_list->RowIndex;

		// Init row class and style
		$tbl_technician->resetAttributes();
		$tbl_technician->CssClass = "";
		if ($tbl_technician_list->isGridAdd()) {
		} else {
			$tbl_technician_list->loadRowValues($tbl_technician_list->Recordset); // Load row values
		}
		$tbl_technician->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_technician->RowAttrs->merge(["data-rowindex" => $tbl_technician_list->RowCount, "id" => "r" . $tbl_technician_list->RowCount . "_tbl_technician", "data-rowtype" => $tbl_technician->RowType]);

		// Render row
		$tbl_technician_list->renderRow();

		// Render list options
		$tbl_technician_list->renderListOptions();
?>
	<tr <?php echo $tbl_technician->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_technician_list->ListOptions->render("body", "left", $tbl_technician_list->RowCount);
?>
	<?php if ($tbl_technician_list->technician_id->Visible) { // technician_id ?>
		<td data-name="technician_id" <?php echo $tbl_technician_list->technician_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_technician_list->RowCount ?>_tbl_technician_technician_id">
<span<?php echo $tbl_technician_list->technician_id->viewAttributes() ?>><?php echo $tbl_technician_list->technician_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_technician_list->technician_dsc->Visible) { // technician_dsc ?>
		<td data-name="technician_dsc" <?php echo $tbl_technician_list->technician_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_technician_list->RowCount ?>_tbl_technician_technician_dsc">
<span<?php echo $tbl_technician_list->technician_dsc->viewAttributes() ?>><?php echo $tbl_technician_list->technician_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_technician_list->ListOptions->render("body", "right", $tbl_technician_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_technician_list->isGridAdd())
		$tbl_technician_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_technician->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_technician_list->Recordset)
	$tbl_technician_list->Recordset->Close();
?>
<?php if (!$tbl_technician_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_technician_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_technician_list->TotalRecords == 0 && !$tbl_technician->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_technician_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_technician_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_technician_list->isExport()) { ?>
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
$tbl_technician_list->terminate();
?>