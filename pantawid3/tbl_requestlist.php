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
$tbl_request_list = new tbl_request_list();

// Run the page
$tbl_request_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_request_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_request_list->isExport()) { ?>
<script>
var ftbl_requestlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_requestlist = currentForm = new ew.Form("ftbl_requestlist", "list");
	ftbl_requestlist.formKeyCountName = '<?php echo $tbl_request_list->FormKeyCountName ?>';
	loadjs.done("ftbl_requestlist");
});
var ftbl_requestlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_requestlistsrch = currentSearchForm = new ew.Form("ftbl_requestlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_requestlistsrch.filterList = <?php echo $tbl_request_list->getFilterList() ?>;
	loadjs.done("ftbl_requestlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_request_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_request_list->TotalRecords > 0 && $tbl_request_list->ExportOptions->visible()) { ?>
<?php $tbl_request_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_request_list->ImportOptions->visible()) { ?>
<?php $tbl_request_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_request_list->SearchOptions->visible()) { ?>
<?php $tbl_request_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_request_list->FilterOptions->visible()) { ?>
<?php $tbl_request_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_request_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_request_list->isExport() && !$tbl_request->CurrentAction) { ?>
<form name="ftbl_requestlistsrch" id="ftbl_requestlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_requestlistsrch-search-panel" class="<?php echo $tbl_request_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_request">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_request_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_request_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_request_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_request_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_request_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_request_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_request_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_request_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_request_list->showPageHeader(); ?>
<?php
$tbl_request_list->showMessage();
?>
<?php if ($tbl_request_list->TotalRecords > 0 || $tbl_request->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_request_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_request">
<form name="ftbl_requestlist" id="ftbl_requestlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_request">
<div id="gmp_tbl_request" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_request_list->TotalRecords > 0 || $tbl_request_list->isGridEdit()) { ?>
<table id="tbl_tbl_requestlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_request->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_request_list->renderListOptions();

// Render list options (header, left)
$tbl_request_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_request_list->request_id->Visible) { // request_id ?>
	<?php if ($tbl_request_list->SortUrl($tbl_request_list->request_id) == "") { ?>
		<th data-name="request_id" class="<?php echo $tbl_request_list->request_id->headerCellClass() ?>"><div id="elh_tbl_request_request_id" class="tbl_request_request_id"><div class="ew-table-header-caption"><?php echo $tbl_request_list->request_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="request_id" class="<?php echo $tbl_request_list->request_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_request_list->SortUrl($tbl_request_list->request_id) ?>', 1);"><div id="elh_tbl_request_request_id" class="tbl_request_request_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_request_list->request_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_request_list->request_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_request_list->request_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_request_list->request_dsc->Visible) { // request_dsc ?>
	<?php if ($tbl_request_list->SortUrl($tbl_request_list->request_dsc) == "") { ?>
		<th data-name="request_dsc" class="<?php echo $tbl_request_list->request_dsc->headerCellClass() ?>"><div id="elh_tbl_request_request_dsc" class="tbl_request_request_dsc"><div class="ew-table-header-caption"><?php echo $tbl_request_list->request_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="request_dsc" class="<?php echo $tbl_request_list->request_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_request_list->SortUrl($tbl_request_list->request_dsc) ?>', 1);"><div id="elh_tbl_request_request_dsc" class="tbl_request_request_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_request_list->request_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_request_list->request_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_request_list->request_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_request_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_request_list->ExportAll && $tbl_request_list->isExport()) {
	$tbl_request_list->StopRecord = $tbl_request_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_request_list->TotalRecords > $tbl_request_list->StartRecord + $tbl_request_list->DisplayRecords - 1)
		$tbl_request_list->StopRecord = $tbl_request_list->StartRecord + $tbl_request_list->DisplayRecords - 1;
	else
		$tbl_request_list->StopRecord = $tbl_request_list->TotalRecords;
}
$tbl_request_list->RecordCount = $tbl_request_list->StartRecord - 1;
if ($tbl_request_list->Recordset && !$tbl_request_list->Recordset->EOF) {
	$tbl_request_list->Recordset->moveFirst();
	$selectLimit = $tbl_request_list->UseSelectLimit;
	if (!$selectLimit && $tbl_request_list->StartRecord > 1)
		$tbl_request_list->Recordset->move($tbl_request_list->StartRecord - 1);
} elseif (!$tbl_request->AllowAddDeleteRow && $tbl_request_list->StopRecord == 0) {
	$tbl_request_list->StopRecord = $tbl_request->GridAddRowCount;
}

// Initialize aggregate
$tbl_request->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_request->resetAttributes();
$tbl_request_list->renderRow();
while ($tbl_request_list->RecordCount < $tbl_request_list->StopRecord) {
	$tbl_request_list->RecordCount++;
	if ($tbl_request_list->RecordCount >= $tbl_request_list->StartRecord) {
		$tbl_request_list->RowCount++;

		// Set up key count
		$tbl_request_list->KeyCount = $tbl_request_list->RowIndex;

		// Init row class and style
		$tbl_request->resetAttributes();
		$tbl_request->CssClass = "";
		if ($tbl_request_list->isGridAdd()) {
		} else {
			$tbl_request_list->loadRowValues($tbl_request_list->Recordset); // Load row values
		}
		$tbl_request->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_request->RowAttrs->merge(["data-rowindex" => $tbl_request_list->RowCount, "id" => "r" . $tbl_request_list->RowCount . "_tbl_request", "data-rowtype" => $tbl_request->RowType]);

		// Render row
		$tbl_request_list->renderRow();

		// Render list options
		$tbl_request_list->renderListOptions();
?>
	<tr <?php echo $tbl_request->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_request_list->ListOptions->render("body", "left", $tbl_request_list->RowCount);
?>
	<?php if ($tbl_request_list->request_id->Visible) { // request_id ?>
		<td data-name="request_id" <?php echo $tbl_request_list->request_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_request_list->RowCount ?>_tbl_request_request_id">
<span<?php echo $tbl_request_list->request_id->viewAttributes() ?>><?php echo $tbl_request_list->request_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_request_list->request_dsc->Visible) { // request_dsc ?>
		<td data-name="request_dsc" <?php echo $tbl_request_list->request_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_request_list->RowCount ?>_tbl_request_request_dsc">
<span<?php echo $tbl_request_list->request_dsc->viewAttributes() ?>><?php echo $tbl_request_list->request_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_request_list->ListOptions->render("body", "right", $tbl_request_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_request_list->isGridAdd())
		$tbl_request_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_request->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_request_list->Recordset)
	$tbl_request_list->Recordset->Close();
?>
<?php if (!$tbl_request_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_request_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_request_list->TotalRecords == 0 && !$tbl_request->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_request_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_request_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_request_list->isExport()) { ?>
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
$tbl_request_list->terminate();
?>