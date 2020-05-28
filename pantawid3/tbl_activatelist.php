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
$tbl_activate_list = new tbl_activate_list();

// Run the page
$tbl_activate_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_activate_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_activate_list->isExport()) { ?>
<script>
var ftbl_activatelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_activatelist = currentForm = new ew.Form("ftbl_activatelist", "list");
	ftbl_activatelist.formKeyCountName = '<?php echo $tbl_activate_list->FormKeyCountName ?>';
	loadjs.done("ftbl_activatelist");
});
var ftbl_activatelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_activatelistsrch = currentSearchForm = new ew.Form("ftbl_activatelistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_activatelistsrch.filterList = <?php echo $tbl_activate_list->getFilterList() ?>;
	loadjs.done("ftbl_activatelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_activate_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_activate_list->TotalRecords > 0 && $tbl_activate_list->ExportOptions->visible()) { ?>
<?php $tbl_activate_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_activate_list->ImportOptions->visible()) { ?>
<?php $tbl_activate_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_activate_list->SearchOptions->visible()) { ?>
<?php $tbl_activate_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_activate_list->FilterOptions->visible()) { ?>
<?php $tbl_activate_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_activate_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_activate_list->isExport() && !$tbl_activate->CurrentAction) { ?>
<form name="ftbl_activatelistsrch" id="ftbl_activatelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_activatelistsrch-search-panel" class="<?php echo $tbl_activate_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_activate">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_activate_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_activate_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_activate_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_activate_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_activate_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_activate_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_activate_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_activate_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_activate_list->showPageHeader(); ?>
<?php
$tbl_activate_list->showMessage();
?>
<?php if ($tbl_activate_list->TotalRecords > 0 || $tbl_activate->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_activate_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_activate">
<form name="ftbl_activatelist" id="ftbl_activatelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_activate">
<div id="gmp_tbl_activate" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_activate_list->TotalRecords > 0 || $tbl_activate_list->isGridEdit()) { ?>
<table id="tbl_tbl_activatelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_activate->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_activate_list->renderListOptions();

// Render list options (header, left)
$tbl_activate_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_activate_list->activate_id->Visible) { // activate_id ?>
	<?php if ($tbl_activate_list->SortUrl($tbl_activate_list->activate_id) == "") { ?>
		<th data-name="activate_id" class="<?php echo $tbl_activate_list->activate_id->headerCellClass() ?>"><div id="elh_tbl_activate_activate_id" class="tbl_activate_activate_id"><div class="ew-table-header-caption"><?php echo $tbl_activate_list->activate_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="activate_id" class="<?php echo $tbl_activate_list->activate_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_activate_list->SortUrl($tbl_activate_list->activate_id) ?>', 1);"><div id="elh_tbl_activate_activate_id" class="tbl_activate_activate_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_activate_list->activate_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_activate_list->activate_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_activate_list->activate_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_activate_list->activate_dsc->Visible) { // activate_dsc ?>
	<?php if ($tbl_activate_list->SortUrl($tbl_activate_list->activate_dsc) == "") { ?>
		<th data-name="activate_dsc" class="<?php echo $tbl_activate_list->activate_dsc->headerCellClass() ?>"><div id="elh_tbl_activate_activate_dsc" class="tbl_activate_activate_dsc"><div class="ew-table-header-caption"><?php echo $tbl_activate_list->activate_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="activate_dsc" class="<?php echo $tbl_activate_list->activate_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_activate_list->SortUrl($tbl_activate_list->activate_dsc) ?>', 1);"><div id="elh_tbl_activate_activate_dsc" class="tbl_activate_activate_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_activate_list->activate_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_activate_list->activate_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_activate_list->activate_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_activate_list->Value->Visible) { // Value ?>
	<?php if ($tbl_activate_list->SortUrl($tbl_activate_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $tbl_activate_list->Value->headerCellClass() ?>"><div id="elh_tbl_activate_Value" class="tbl_activate_Value"><div class="ew-table-header-caption"><?php echo $tbl_activate_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $tbl_activate_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_activate_list->SortUrl($tbl_activate_list->Value) ?>', 1);"><div id="elh_tbl_activate_Value" class="tbl_activate_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_activate_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_activate_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_activate_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_activate_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_activate_list->ExportAll && $tbl_activate_list->isExport()) {
	$tbl_activate_list->StopRecord = $tbl_activate_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_activate_list->TotalRecords > $tbl_activate_list->StartRecord + $tbl_activate_list->DisplayRecords - 1)
		$tbl_activate_list->StopRecord = $tbl_activate_list->StartRecord + $tbl_activate_list->DisplayRecords - 1;
	else
		$tbl_activate_list->StopRecord = $tbl_activate_list->TotalRecords;
}
$tbl_activate_list->RecordCount = $tbl_activate_list->StartRecord - 1;
if ($tbl_activate_list->Recordset && !$tbl_activate_list->Recordset->EOF) {
	$tbl_activate_list->Recordset->moveFirst();
	$selectLimit = $tbl_activate_list->UseSelectLimit;
	if (!$selectLimit && $tbl_activate_list->StartRecord > 1)
		$tbl_activate_list->Recordset->move($tbl_activate_list->StartRecord - 1);
} elseif (!$tbl_activate->AllowAddDeleteRow && $tbl_activate_list->StopRecord == 0) {
	$tbl_activate_list->StopRecord = $tbl_activate->GridAddRowCount;
}

// Initialize aggregate
$tbl_activate->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_activate->resetAttributes();
$tbl_activate_list->renderRow();
while ($tbl_activate_list->RecordCount < $tbl_activate_list->StopRecord) {
	$tbl_activate_list->RecordCount++;
	if ($tbl_activate_list->RecordCount >= $tbl_activate_list->StartRecord) {
		$tbl_activate_list->RowCount++;

		// Set up key count
		$tbl_activate_list->KeyCount = $tbl_activate_list->RowIndex;

		// Init row class and style
		$tbl_activate->resetAttributes();
		$tbl_activate->CssClass = "";
		if ($tbl_activate_list->isGridAdd()) {
		} else {
			$tbl_activate_list->loadRowValues($tbl_activate_list->Recordset); // Load row values
		}
		$tbl_activate->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_activate->RowAttrs->merge(["data-rowindex" => $tbl_activate_list->RowCount, "id" => "r" . $tbl_activate_list->RowCount . "_tbl_activate", "data-rowtype" => $tbl_activate->RowType]);

		// Render row
		$tbl_activate_list->renderRow();

		// Render list options
		$tbl_activate_list->renderListOptions();
?>
	<tr <?php echo $tbl_activate->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_activate_list->ListOptions->render("body", "left", $tbl_activate_list->RowCount);
?>
	<?php if ($tbl_activate_list->activate_id->Visible) { // activate_id ?>
		<td data-name="activate_id" <?php echo $tbl_activate_list->activate_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_activate_list->RowCount ?>_tbl_activate_activate_id">
<span<?php echo $tbl_activate_list->activate_id->viewAttributes() ?>><?php echo $tbl_activate_list->activate_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_activate_list->activate_dsc->Visible) { // activate_dsc ?>
		<td data-name="activate_dsc" <?php echo $tbl_activate_list->activate_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_activate_list->RowCount ?>_tbl_activate_activate_dsc">
<span<?php echo $tbl_activate_list->activate_dsc->viewAttributes() ?>><?php echo $tbl_activate_list->activate_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_activate_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $tbl_activate_list->Value->cellAttributes() ?>>
<span id="el<?php echo $tbl_activate_list->RowCount ?>_tbl_activate_Value">
<span<?php echo $tbl_activate_list->Value->viewAttributes() ?>><?php echo $tbl_activate_list->Value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_activate_list->ListOptions->render("body", "right", $tbl_activate_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_activate_list->isGridAdd())
		$tbl_activate_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_activate->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_activate_list->Recordset)
	$tbl_activate_list->Recordset->Close();
?>
<?php if (!$tbl_activate_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_activate_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_activate_list->TotalRecords == 0 && !$tbl_activate->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_activate_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_activate_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_activate_list->isExport()) { ?>
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
$tbl_activate_list->terminate();
?>