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
$tbl_encoder_lactivities_list = new tbl_encoder_lactivities_list();

// Run the page
$tbl_encoder_lactivities_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_lactivities_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_encoder_lactivities_list->isExport()) { ?>
<script>
var ftbl_encoder_lactivitieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_encoder_lactivitieslist = currentForm = new ew.Form("ftbl_encoder_lactivitieslist", "list");
	ftbl_encoder_lactivitieslist.formKeyCountName = '<?php echo $tbl_encoder_lactivities_list->FormKeyCountName ?>';
	loadjs.done("ftbl_encoder_lactivitieslist");
});
var ftbl_encoder_lactivitieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_encoder_lactivitieslistsrch = currentSearchForm = new ew.Form("ftbl_encoder_lactivitieslistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_encoder_lactivitieslistsrch.filterList = <?php echo $tbl_encoder_lactivities_list->getFilterList() ?>;
	loadjs.done("ftbl_encoder_lactivitieslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_encoder_lactivities_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_encoder_lactivities_list->TotalRecords > 0 && $tbl_encoder_lactivities_list->ExportOptions->visible()) { ?>
<?php $tbl_encoder_lactivities_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_encoder_lactivities_list->ImportOptions->visible()) { ?>
<?php $tbl_encoder_lactivities_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_encoder_lactivities_list->SearchOptions->visible()) { ?>
<?php $tbl_encoder_lactivities_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_encoder_lactivities_list->FilterOptions->visible()) { ?>
<?php $tbl_encoder_lactivities_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_encoder_lactivities_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_encoder_lactivities_list->isExport() && !$tbl_encoder_lactivities->CurrentAction) { ?>
<form name="ftbl_encoder_lactivitieslistsrch" id="ftbl_encoder_lactivitieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_encoder_lactivitieslistsrch-search-panel" class="<?php echo $tbl_encoder_lactivities_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_encoder_lactivities">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_encoder_lactivities_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_encoder_lactivities_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_encoder_lactivities_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_encoder_lactivities_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_encoder_lactivities_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_encoder_lactivities_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_encoder_lactivities_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_encoder_lactivities_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_encoder_lactivities_list->showPageHeader(); ?>
<?php
$tbl_encoder_lactivities_list->showMessage();
?>
<?php if ($tbl_encoder_lactivities_list->TotalRecords > 0 || $tbl_encoder_lactivities->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_encoder_lactivities_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_encoder_lactivities">
<?php if (!$tbl_encoder_lactivities_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_encoder_lactivities_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_encoder_lactivities_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_encoder_lactivities_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_encoder_lactivitieslist" id="ftbl_encoder_lactivitieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder_lactivities">
<div id="gmp_tbl_encoder_lactivities" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_encoder_lactivities_list->TotalRecords > 0 || $tbl_encoder_lactivities_list->isGridEdit()) { ?>
<table id="tbl_tbl_encoder_lactivitieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_encoder_lactivities->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_encoder_lactivities_list->renderListOptions();

// Render list options (header, left)
$tbl_encoder_lactivities_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_encoder_lactivities_list->enc_activities_id->Visible) { // enc_activities_id ?>
	<?php if ($tbl_encoder_lactivities_list->SortUrl($tbl_encoder_lactivities_list->enc_activities_id) == "") { ?>
		<th data-name="enc_activities_id" class="<?php echo $tbl_encoder_lactivities_list->enc_activities_id->headerCellClass() ?>"><div id="elh_tbl_encoder_lactivities_enc_activities_id" class="tbl_encoder_lactivities_enc_activities_id"><div class="ew-table-header-caption"><?php echo $tbl_encoder_lactivities_list->enc_activities_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="enc_activities_id" class="<?php echo $tbl_encoder_lactivities_list->enc_activities_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_lactivities_list->SortUrl($tbl_encoder_lactivities_list->enc_activities_id) ?>', 1);"><div id="elh_tbl_encoder_lactivities_enc_activities_id" class="tbl_encoder_lactivities_enc_activities_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_lactivities_list->enc_activities_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_lactivities_list->enc_activities_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_lactivities_list->enc_activities_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_encoder_lactivities_list->List_Activities->Visible) { // List_Activities ?>
	<?php if ($tbl_encoder_lactivities_list->SortUrl($tbl_encoder_lactivities_list->List_Activities) == "") { ?>
		<th data-name="List_Activities" class="<?php echo $tbl_encoder_lactivities_list->List_Activities->headerCellClass() ?>"><div id="elh_tbl_encoder_lactivities_List_Activities" class="tbl_encoder_lactivities_List_Activities"><div class="ew-table-header-caption"><?php echo $tbl_encoder_lactivities_list->List_Activities->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="List_Activities" class="<?php echo $tbl_encoder_lactivities_list->List_Activities->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_encoder_lactivities_list->SortUrl($tbl_encoder_lactivities_list->List_Activities) ?>', 1);"><div id="elh_tbl_encoder_lactivities_List_Activities" class="tbl_encoder_lactivities_List_Activities">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_encoder_lactivities_list->List_Activities->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_encoder_lactivities_list->List_Activities->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_encoder_lactivities_list->List_Activities->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_encoder_lactivities_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_encoder_lactivities_list->ExportAll && $tbl_encoder_lactivities_list->isExport()) {
	$tbl_encoder_lactivities_list->StopRecord = $tbl_encoder_lactivities_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_encoder_lactivities_list->TotalRecords > $tbl_encoder_lactivities_list->StartRecord + $tbl_encoder_lactivities_list->DisplayRecords - 1)
		$tbl_encoder_lactivities_list->StopRecord = $tbl_encoder_lactivities_list->StartRecord + $tbl_encoder_lactivities_list->DisplayRecords - 1;
	else
		$tbl_encoder_lactivities_list->StopRecord = $tbl_encoder_lactivities_list->TotalRecords;
}
$tbl_encoder_lactivities_list->RecordCount = $tbl_encoder_lactivities_list->StartRecord - 1;
if ($tbl_encoder_lactivities_list->Recordset && !$tbl_encoder_lactivities_list->Recordset->EOF) {
	$tbl_encoder_lactivities_list->Recordset->moveFirst();
	$selectLimit = $tbl_encoder_lactivities_list->UseSelectLimit;
	if (!$selectLimit && $tbl_encoder_lactivities_list->StartRecord > 1)
		$tbl_encoder_lactivities_list->Recordset->move($tbl_encoder_lactivities_list->StartRecord - 1);
} elseif (!$tbl_encoder_lactivities->AllowAddDeleteRow && $tbl_encoder_lactivities_list->StopRecord == 0) {
	$tbl_encoder_lactivities_list->StopRecord = $tbl_encoder_lactivities->GridAddRowCount;
}

// Initialize aggregate
$tbl_encoder_lactivities->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_encoder_lactivities->resetAttributes();
$tbl_encoder_lactivities_list->renderRow();
while ($tbl_encoder_lactivities_list->RecordCount < $tbl_encoder_lactivities_list->StopRecord) {
	$tbl_encoder_lactivities_list->RecordCount++;
	if ($tbl_encoder_lactivities_list->RecordCount >= $tbl_encoder_lactivities_list->StartRecord) {
		$tbl_encoder_lactivities_list->RowCount++;

		// Set up key count
		$tbl_encoder_lactivities_list->KeyCount = $tbl_encoder_lactivities_list->RowIndex;

		// Init row class and style
		$tbl_encoder_lactivities->resetAttributes();
		$tbl_encoder_lactivities->CssClass = "";
		if ($tbl_encoder_lactivities_list->isGridAdd()) {
		} else {
			$tbl_encoder_lactivities_list->loadRowValues($tbl_encoder_lactivities_list->Recordset); // Load row values
		}
		$tbl_encoder_lactivities->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_encoder_lactivities->RowAttrs->merge(["data-rowindex" => $tbl_encoder_lactivities_list->RowCount, "id" => "r" . $tbl_encoder_lactivities_list->RowCount . "_tbl_encoder_lactivities", "data-rowtype" => $tbl_encoder_lactivities->RowType]);

		// Render row
		$tbl_encoder_lactivities_list->renderRow();

		// Render list options
		$tbl_encoder_lactivities_list->renderListOptions();
?>
	<tr <?php echo $tbl_encoder_lactivities->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_encoder_lactivities_list->ListOptions->render("body", "left", $tbl_encoder_lactivities_list->RowCount);
?>
	<?php if ($tbl_encoder_lactivities_list->enc_activities_id->Visible) { // enc_activities_id ?>
		<td data-name="enc_activities_id" <?php echo $tbl_encoder_lactivities_list->enc_activities_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_lactivities_list->RowCount ?>_tbl_encoder_lactivities_enc_activities_id">
<span<?php echo $tbl_encoder_lactivities_list->enc_activities_id->viewAttributes() ?>><?php echo $tbl_encoder_lactivities_list->enc_activities_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_encoder_lactivities_list->List_Activities->Visible) { // List_Activities ?>
		<td data-name="List_Activities" <?php echo $tbl_encoder_lactivities_list->List_Activities->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_lactivities_list->RowCount ?>_tbl_encoder_lactivities_List_Activities">
<span<?php echo $tbl_encoder_lactivities_list->List_Activities->viewAttributes() ?>><?php echo $tbl_encoder_lactivities_list->List_Activities->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_encoder_lactivities_list->ListOptions->render("body", "right", $tbl_encoder_lactivities_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_encoder_lactivities_list->isGridAdd())
		$tbl_encoder_lactivities_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_encoder_lactivities->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_encoder_lactivities_list->Recordset)
	$tbl_encoder_lactivities_list->Recordset->Close();
?>
<?php if (!$tbl_encoder_lactivities_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_encoder_lactivities_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_encoder_lactivities_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_encoder_lactivities_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_encoder_lactivities_list->TotalRecords == 0 && !$tbl_encoder_lactivities->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_encoder_lactivities_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_encoder_lactivities_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_encoder_lactivities_list->isExport()) { ?>
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
$tbl_encoder_lactivities_list->terminate();
?>