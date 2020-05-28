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
$tbl_pr_list = new tbl_pr_list();

// Run the page
$tbl_pr_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_pr_list->isExport()) { ?>
<script>
var ftbl_prlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_prlist = currentForm = new ew.Form("ftbl_prlist", "list");
	ftbl_prlist.formKeyCountName = '<?php echo $tbl_pr_list->FormKeyCountName ?>';
	loadjs.done("ftbl_prlist");
});
var ftbl_prlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftbl_prlistsrch = currentSearchForm = new ew.Form("ftbl_prlistsrch");

	// Dynamic selection lists
	// Filters

	ftbl_prlistsrch.filterList = <?php echo $tbl_pr_list->getFilterList() ?>;
	loadjs.done("ftbl_prlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_pr_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_pr_list->TotalRecords > 0 && $tbl_pr_list->ExportOptions->visible()) { ?>
<?php $tbl_pr_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pr_list->ImportOptions->visible()) { ?>
<?php $tbl_pr_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pr_list->SearchOptions->visible()) { ?>
<?php $tbl_pr_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pr_list->FilterOptions->visible()) { ?>
<?php $tbl_pr_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_pr_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_pr_list->isExport() && !$tbl_pr->CurrentAction) { ?>
<form name="ftbl_prlistsrch" id="ftbl_prlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftbl_prlistsrch-search-panel" class="<?php echo $tbl_pr_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_pr">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tbl_pr_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tbl_pr_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tbl_pr_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_pr_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_pr_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_pr_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_pr_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_pr_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tbl_pr_list->showPageHeader(); ?>
<?php
$tbl_pr_list->showMessage();
?>
<?php if ($tbl_pr_list->TotalRecords > 0 || $tbl_pr->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_pr_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_pr">
<?php if (!$tbl_pr_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_pr_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_pr_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_pr_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_prlist" id="ftbl_prlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr">
<div id="gmp_tbl_pr" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_pr_list->TotalRecords > 0 || $tbl_pr_list->isGridEdit()) { ?>
<table id="tbl_tbl_prlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_pr->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_pr_list->renderListOptions();

// Render list options (header, left)
$tbl_pr_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_pr_list->prID->Visible) { // prID ?>
	<?php if ($tbl_pr_list->SortUrl($tbl_pr_list->prID) == "") { ?>
		<th data-name="prID" class="<?php echo $tbl_pr_list->prID->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_pr_prID" class="tbl_pr_prID"><div class="ew-table-header-caption"><?php echo $tbl_pr_list->prID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prID" class="<?php echo $tbl_pr_list->prID->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pr_list->SortUrl($tbl_pr_list->prID) ?>', 1);"><div id="elh_tbl_pr_prID" class="tbl_pr_prID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pr_list->prID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pr_list->prID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pr_list->prID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pr_list->date_prep->Visible) { // date_prep ?>
	<?php if ($tbl_pr_list->SortUrl($tbl_pr_list->date_prep) == "") { ?>
		<th data-name="date_prep" class="<?php echo $tbl_pr_list->date_prep->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_pr_date_prep" class="tbl_pr_date_prep"><div class="ew-table-header-caption"><?php echo $tbl_pr_list->date_prep->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_prep" class="<?php echo $tbl_pr_list->date_prep->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pr_list->SortUrl($tbl_pr_list->date_prep) ?>', 1);"><div id="elh_tbl_pr_date_prep" class="tbl_pr_date_prep">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pr_list->date_prep->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pr_list->date_prep->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pr_list->date_prep->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pr_list->pr_number->Visible) { // pr_number ?>
	<?php if ($tbl_pr_list->SortUrl($tbl_pr_list->pr_number) == "") { ?>
		<th data-name="pr_number" class="<?php echo $tbl_pr_list->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_pr_pr_number" class="tbl_pr_pr_number"><div class="ew-table-header-caption"><?php echo $tbl_pr_list->pr_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pr_number" class="<?php echo $tbl_pr_list->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pr_list->SortUrl($tbl_pr_list->pr_number) ?>', 1);"><div id="elh_tbl_pr_pr_number" class="tbl_pr_pr_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pr_list->pr_number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_pr_list->pr_number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pr_list->pr_number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pr_list->purpose->Visible) { // purpose ?>
	<?php if ($tbl_pr_list->SortUrl($tbl_pr_list->purpose) == "") { ?>
		<th data-name="purpose" class="<?php echo $tbl_pr_list->purpose->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_pr_purpose" class="tbl_pr_purpose"><div class="ew-table-header-caption"><?php echo $tbl_pr_list->purpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="purpose" class="<?php echo $tbl_pr_list->purpose->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pr_list->SortUrl($tbl_pr_list->purpose) ?>', 1);"><div id="elh_tbl_pr_purpose" class="tbl_pr_purpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pr_list->purpose->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_pr_list->purpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pr_list->purpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pr_list->pr_status->Visible) { // pr_status ?>
	<?php if ($tbl_pr_list->SortUrl($tbl_pr_list->pr_status) == "") { ?>
		<th data-name="pr_status" class="<?php echo $tbl_pr_list->pr_status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_pr_pr_status" class="tbl_pr_pr_status"><div class="ew-table-header-caption"><?php echo $tbl_pr_list->pr_status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pr_status" class="<?php echo $tbl_pr_list->pr_status->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pr_list->SortUrl($tbl_pr_list->pr_status) ?>', 1);"><div id="elh_tbl_pr_pr_status" class="tbl_pr_pr_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pr_list->pr_status->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pr_list->pr_status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pr_list->pr_status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pr_list->employeeid->Visible) { // employeeid ?>
	<?php if ($tbl_pr_list->SortUrl($tbl_pr_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $tbl_pr_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_pr_employeeid" class="tbl_pr_employeeid"><div class="ew-table-header-caption"><?php echo $tbl_pr_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $tbl_pr_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_pr_list->SortUrl($tbl_pr_list->employeeid) ?>', 1);"><div id="elh_tbl_pr_employeeid" class="tbl_pr_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pr_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pr_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_pr_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_pr_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_pr_list->ExportAll && $tbl_pr_list->isExport()) {
	$tbl_pr_list->StopRecord = $tbl_pr_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_pr_list->TotalRecords > $tbl_pr_list->StartRecord + $tbl_pr_list->DisplayRecords - 1)
		$tbl_pr_list->StopRecord = $tbl_pr_list->StartRecord + $tbl_pr_list->DisplayRecords - 1;
	else
		$tbl_pr_list->StopRecord = $tbl_pr_list->TotalRecords;
}
$tbl_pr_list->RecordCount = $tbl_pr_list->StartRecord - 1;
if ($tbl_pr_list->Recordset && !$tbl_pr_list->Recordset->EOF) {
	$tbl_pr_list->Recordset->moveFirst();
	$selectLimit = $tbl_pr_list->UseSelectLimit;
	if (!$selectLimit && $tbl_pr_list->StartRecord > 1)
		$tbl_pr_list->Recordset->move($tbl_pr_list->StartRecord - 1);
} elseif (!$tbl_pr->AllowAddDeleteRow && $tbl_pr_list->StopRecord == 0) {
	$tbl_pr_list->StopRecord = $tbl_pr->GridAddRowCount;
}

// Initialize aggregate
$tbl_pr->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_pr->resetAttributes();
$tbl_pr_list->renderRow();
while ($tbl_pr_list->RecordCount < $tbl_pr_list->StopRecord) {
	$tbl_pr_list->RecordCount++;
	if ($tbl_pr_list->RecordCount >= $tbl_pr_list->StartRecord) {
		$tbl_pr_list->RowCount++;

		// Set up key count
		$tbl_pr_list->KeyCount = $tbl_pr_list->RowIndex;

		// Init row class and style
		$tbl_pr->resetAttributes();
		$tbl_pr->CssClass = "";
		if ($tbl_pr_list->isGridAdd()) {
		} else {
			$tbl_pr_list->loadRowValues($tbl_pr_list->Recordset); // Load row values
		}
		$tbl_pr->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_pr->RowAttrs->merge(["data-rowindex" => $tbl_pr_list->RowCount, "id" => "r" . $tbl_pr_list->RowCount . "_tbl_pr", "data-rowtype" => $tbl_pr->RowType]);

		// Render row
		$tbl_pr_list->renderRow();

		// Render list options
		$tbl_pr_list->renderListOptions();
?>
	<tr <?php echo $tbl_pr->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_pr_list->ListOptions->render("body", "left", $tbl_pr_list->RowCount);
?>
	<?php if ($tbl_pr_list->prID->Visible) { // prID ?>
		<td data-name="prID" <?php echo $tbl_pr_list->prID->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_list->RowCount ?>_tbl_pr_prID">
<span<?php echo $tbl_pr_list->prID->viewAttributes() ?>><?php echo $tbl_pr_list->prID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pr_list->date_prep->Visible) { // date_prep ?>
		<td data-name="date_prep" <?php echo $tbl_pr_list->date_prep->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_list->RowCount ?>_tbl_pr_date_prep">
<span<?php echo $tbl_pr_list->date_prep->viewAttributes() ?>><?php echo $tbl_pr_list->date_prep->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pr_list->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" <?php echo $tbl_pr_list->pr_number->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_list->RowCount ?>_tbl_pr_pr_number">
<span<?php echo $tbl_pr_list->pr_number->viewAttributes() ?>><?php echo $tbl_pr_list->pr_number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pr_list->purpose->Visible) { // purpose ?>
		<td data-name="purpose" <?php echo $tbl_pr_list->purpose->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_list->RowCount ?>_tbl_pr_purpose">
<span<?php echo $tbl_pr_list->purpose->viewAttributes() ?>><?php echo $tbl_pr_list->purpose->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pr_list->pr_status->Visible) { // pr_status ?>
		<td data-name="pr_status" <?php echo $tbl_pr_list->pr_status->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_list->RowCount ?>_tbl_pr_pr_status">
<span<?php echo $tbl_pr_list->pr_status->viewAttributes() ?>><?php echo $tbl_pr_list->pr_status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pr_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $tbl_pr_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_list->RowCount ?>_tbl_pr_employeeid">
<span<?php echo $tbl_pr_list->employeeid->viewAttributes() ?>><?php echo $tbl_pr_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_pr_list->ListOptions->render("body", "right", $tbl_pr_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_pr_list->isGridAdd())
		$tbl_pr_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_pr->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_pr_list->Recordset)
	$tbl_pr_list->Recordset->Close();
?>
<?php if (!$tbl_pr_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_pr_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tbl_pr_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_pr_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_pr_list->TotalRecords == 0 && !$tbl_pr->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_pr_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_pr_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_pr_list->isExport()) { ?>
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
$tbl_pr_list->terminate();
?>