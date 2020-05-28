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
$tbl_sup_status_list = new tbl_sup_status_list();

// Run the page
$tbl_sup_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_sup_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_sup_status_list->isExport()) { ?>
<script>
var ftbl_sup_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_sup_statuslist = currentForm = new ew.Form("ftbl_sup_statuslist", "list");
	ftbl_sup_statuslist.formKeyCountName = '<?php echo $tbl_sup_status_list->FormKeyCountName ?>';
	loadjs.done("ftbl_sup_statuslist");
});
var ftbl_sup_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_sup_statuslistsrch = currentSearchForm = new ew.Form("ftbl_sup_statuslistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_sup_statuslistsrch.filterList = <?php echo $tbl_sup_status_list->getFilterList() ?>;
	loadjs.done("ftbl_sup_statuslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_sup_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_sup_status_list->TotalRecords > 0 && $tbl_sup_status_list->ExportOptions->visible()) { ?>
<?php $tbl_sup_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_sup_status_list->ImportOptions->visible()) { ?>
<?php $tbl_sup_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_sup_status_list->SearchOptions->visible()) { ?>
<?php $tbl_sup_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_sup_status_list->FilterOptions->visible()) { ?>
<?php $tbl_sup_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_sup_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_sup_status_list->isExport() && !$tbl_sup_status->CurrentAction) { ?>
<form name="ftbl_sup_statuslistsrch" id="ftbl_sup_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_sup_statuslistsrch-search-panel" class="<?php echo $tbl_sup_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_sup_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_sup_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_sup_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_sup_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_sup_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_sup_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_sup_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_sup_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_sup_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_sup_status_list->showPageHeader(); ?>
<?php
$tbl_sup_status_list->showMessage();
?>
<?php if ($tbl_sup_status_list->TotalRecords > 0 || $tbl_sup_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_sup_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_sup_status">
<form name="ftbl_sup_statuslist" id="ftbl_sup_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_sup_status">
<div id="gmp_tbl_sup_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_sup_status_list->TotalRecords > 0 || $tbl_sup_status_list->isGridEdit()) { ?>
<table id="tbl_tbl_sup_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_sup_status->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_sup_status_list->renderListOptions();

// Render list options (header, left)
$tbl_sup_status_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_sup_status_list->sup_statusID->Visible) { // sup_statusID ?>
	<?php if ($tbl_sup_status_list->SortUrl($tbl_sup_status_list->sup_statusID) == "") { ?>
		<th data-name="sup_statusID" class="<?php echo $tbl_sup_status_list->sup_statusID->headerCellClass() ?>"><div id="elh_tbl_sup_status_sup_statusID" class="tbl_sup_status_sup_statusID"><div class="ew-table-header-caption"><?php echo $tbl_sup_status_list->sup_statusID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sup_statusID" class="<?php echo $tbl_sup_status_list->sup_statusID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_sup_status_list->SortUrl($tbl_sup_status_list->sup_statusID) ?>', 1);"><div id="elh_tbl_sup_status_sup_statusID" class="tbl_sup_status_sup_statusID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_sup_status_list->sup_statusID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_sup_status_list->sup_statusID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_sup_status_list->sup_statusID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_sup_status_list->sup_status->Visible) { // sup_status ?>
	<?php if ($tbl_sup_status_list->SortUrl($tbl_sup_status_list->sup_status) == "") { ?>
		<th data-name="sup_status" class="<?php echo $tbl_sup_status_list->sup_status->headerCellClass() ?>"><div id="elh_tbl_sup_status_sup_status" class="tbl_sup_status_sup_status"><div class="ew-table-header-caption"><?php echo $tbl_sup_status_list->sup_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sup_status" class="<?php echo $tbl_sup_status_list->sup_status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_sup_status_list->SortUrl($tbl_sup_status_list->sup_status) ?>', 1);"><div id="elh_tbl_sup_status_sup_status" class="tbl_sup_status_sup_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_sup_status_list->sup_status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_sup_status_list->sup_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_sup_status_list->sup_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_sup_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_sup_status_list->ExportAll && $tbl_sup_status_list->isExport()) {
	$tbl_sup_status_list->StopRecord = $tbl_sup_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_sup_status_list->TotalRecords > $tbl_sup_status_list->StartRecord + $tbl_sup_status_list->DisplayRecords - 1)
		$tbl_sup_status_list->StopRecord = $tbl_sup_status_list->StartRecord + $tbl_sup_status_list->DisplayRecords - 1;
	else
		$tbl_sup_status_list->StopRecord = $tbl_sup_status_list->TotalRecords;
}
$tbl_sup_status_list->RecordCount = $tbl_sup_status_list->StartRecord - 1;
if ($tbl_sup_status_list->Recordset && !$tbl_sup_status_list->Recordset->EOF) {
	$tbl_sup_status_list->Recordset->moveFirst();
	$selectLimit = $tbl_sup_status_list->UseSelectLimit;
	if (!$selectLimit && $tbl_sup_status_list->StartRecord > 1)
		$tbl_sup_status_list->Recordset->move($tbl_sup_status_list->StartRecord - 1);
} elseif (!$tbl_sup_status->AllowAddDeleteRow && $tbl_sup_status_list->StopRecord == 0) {
	$tbl_sup_status_list->StopRecord = $tbl_sup_status->GridAddRowCount;
}

// Initialize aggregate
$tbl_sup_status->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_sup_status->resetAttributes();
$tbl_sup_status_list->renderRow();
while ($tbl_sup_status_list->RecordCount < $tbl_sup_status_list->StopRecord) {
	$tbl_sup_status_list->RecordCount++;
	if ($tbl_sup_status_list->RecordCount >= $tbl_sup_status_list->StartRecord) {
		$tbl_sup_status_list->RowCount++;

		// Set up key count
		$tbl_sup_status_list->KeyCount = $tbl_sup_status_list->RowIndex;

		// Init row class and style
		$tbl_sup_status->resetAttributes();
		$tbl_sup_status->CssClass = "";
		if ($tbl_sup_status_list->isGridAdd()) {
		} else {
			$tbl_sup_status_list->loadRowValues($tbl_sup_status_list->Recordset); // Load row values
		}
		$tbl_sup_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_sup_status->RowAttrs->merge(["data-rowindex" => $tbl_sup_status_list->RowCount, "id" => "r" . $tbl_sup_status_list->RowCount . "_tbl_sup_status", "data-rowtype" => $tbl_sup_status->RowType]);

		// Render row
		$tbl_sup_status_list->renderRow();

		// Render list options
		$tbl_sup_status_list->renderListOptions();
?>
	<tr <?php echo $tbl_sup_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_sup_status_list->ListOptions->render("body", "left", $tbl_sup_status_list->RowCount);
?>
	<?php if ($tbl_sup_status_list->sup_statusID->Visible) { // sup_statusID ?>
		<td data-name="sup_statusID" <?php echo $tbl_sup_status_list->sup_statusID->cellAttributes() ?>>
<span id="el<?php echo $tbl_sup_status_list->RowCount ?>_tbl_sup_status_sup_statusID">
<span<?php echo $tbl_sup_status_list->sup_statusID->viewAttributes() ?>><?php echo $tbl_sup_status_list->sup_statusID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_sup_status_list->sup_status->Visible) { // sup_status ?>
		<td data-name="sup_status" <?php echo $tbl_sup_status_list->sup_status->cellAttributes() ?>>
<span id="el<?php echo $tbl_sup_status_list->RowCount ?>_tbl_sup_status_sup_status">
<span<?php echo $tbl_sup_status_list->sup_status->viewAttributes() ?>><?php echo $tbl_sup_status_list->sup_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_sup_status_list->ListOptions->render("body", "right", $tbl_sup_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_sup_status_list->isGridAdd())
		$tbl_sup_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_sup_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_sup_status_list->Recordset)
	$tbl_sup_status_list->Recordset->Close();
?>
<?php if (!$tbl_sup_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_sup_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_sup_status_list->TotalRecords == 0 && !$tbl_sup_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_sup_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_sup_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_sup_status_list->isExport()) { ?>
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
$tbl_sup_status_list->terminate();
?>