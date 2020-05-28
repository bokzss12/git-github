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
$specification_view_list = new specification_view_list();

// Run the page
$specification_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$specification_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$specification_view_list->isExport()) { ?>
<script>
var fspecification_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fspecification_viewlist = currentForm = new ew.Form("fspecification_viewlist", "list");
	fspecification_viewlist.formKeyCountName = '<?php echo $specification_view_list->FormKeyCountName ?>';
	loadjs.done("fspecification_viewlist");
});
var fspecification_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fspecification_viewlistsrch = currentSearchForm = new ew.Form("fspecification_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fspecification_viewlistsrch.filterList = <?php echo $specification_view_list->getFilterList() ?>;
	loadjs.done("fspecification_viewlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$specification_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($specification_view_list->TotalRecords > 0 && $specification_view_list->ExportOptions->visible()) { ?>
<?php $specification_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($specification_view_list->ImportOptions->visible()) { ?>
<?php $specification_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($specification_view_list->SearchOptions->visible()) { ?>
<?php $specification_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($specification_view_list->FilterOptions->visible()) { ?>
<?php $specification_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$specification_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$specification_view_list->isExport() && !$specification_view->CurrentAction) { ?>
<form name="fspecification_viewlistsrch" id="fspecification_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fspecification_viewlistsrch-search-panel" class="<?php echo $specification_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="specification_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $specification_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($specification_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($specification_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $specification_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($specification_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($specification_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($specification_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($specification_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $specification_view_list->showPageHeader(); ?>
<?php
$specification_view_list->showMessage();
?>
<?php if ($specification_view_list->TotalRecords > 0 || $specification_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($specification_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> specification_view">
<form name="fspecification_viewlist" id="fspecification_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="specification_view">
<div id="gmp_specification_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($specification_view_list->TotalRecords > 0 || $specification_view_list->isGridEdit()) { ?>
<table id="tbl_specification_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$specification_view->RowType = ROWTYPE_HEADER;

// Render list options
$specification_view_list->renderListOptions();

// Render list options (header, left)
$specification_view_list->ListOptions->render("header", "left");
?>
<?php if ($specification_view_list->pr_number->Visible) { // pr_number ?>
	<?php if ($specification_view_list->SortUrl($specification_view_list->pr_number) == "") { ?>
		<th data-name="pr_number" class="<?php echo $specification_view_list->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_specification_view_pr_number" class="specification_view_pr_number"><div class="ew-table-header-caption"><?php echo $specification_view_list->pr_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pr_number" class="<?php echo $specification_view_list->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $specification_view_list->SortUrl($specification_view_list->pr_number) ?>', 1);"><div id="elh_specification_view_pr_number" class="specification_view_pr_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $specification_view_list->pr_number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($specification_view_list->pr_number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($specification_view_list->pr_number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($specification_view_list->spec_unit->Visible) { // spec_unit ?>
	<?php if ($specification_view_list->SortUrl($specification_view_list->spec_unit) == "") { ?>
		<th data-name="spec_unit" class="<?php echo $specification_view_list->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_specification_view_spec_unit" class="specification_view_spec_unit"><div class="ew-table-header-caption"><?php echo $specification_view_list->spec_unit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unit" class="<?php echo $specification_view_list->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $specification_view_list->SortUrl($specification_view_list->spec_unit) ?>', 1);"><div id="elh_specification_view_spec_unit" class="specification_view_spec_unit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $specification_view_list->spec_unit->caption() ?></span><span class="ew-table-header-sort"><?php if ($specification_view_list->spec_unit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($specification_view_list->spec_unit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($specification_view_list->spec_dsc->Visible) { // spec_dsc ?>
	<?php if ($specification_view_list->SortUrl($specification_view_list->spec_dsc) == "") { ?>
		<th data-name="spec_dsc" class="<?php echo $specification_view_list->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_specification_view_spec_dsc" class="specification_view_spec_dsc"><div class="ew-table-header-caption"><?php echo $specification_view_list->spec_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_dsc" class="<?php echo $specification_view_list->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $specification_view_list->SortUrl($specification_view_list->spec_dsc) ?>', 1);"><div id="elh_specification_view_spec_dsc" class="specification_view_spec_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $specification_view_list->spec_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($specification_view_list->spec_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($specification_view_list->spec_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($specification_view_list->spec_qty->Visible) { // spec_qty ?>
	<?php if ($specification_view_list->SortUrl($specification_view_list->spec_qty) == "") { ?>
		<th data-name="spec_qty" class="<?php echo $specification_view_list->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_specification_view_spec_qty" class="specification_view_spec_qty"><div class="ew-table-header-caption"><?php echo $specification_view_list->spec_qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_qty" class="<?php echo $specification_view_list->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $specification_view_list->SortUrl($specification_view_list->spec_qty) ?>', 1);"><div id="elh_specification_view_spec_qty" class="specification_view_spec_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $specification_view_list->spec_qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($specification_view_list->spec_qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($specification_view_list->spec_qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($specification_view_list->spec_unitprice->Visible) { // spec_unitprice ?>
	<?php if ($specification_view_list->SortUrl($specification_view_list->spec_unitprice) == "") { ?>
		<th data-name="spec_unitprice" class="<?php echo $specification_view_list->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_specification_view_spec_unitprice" class="specification_view_spec_unitprice"><div class="ew-table-header-caption"><?php echo $specification_view_list->spec_unitprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unitprice" class="<?php echo $specification_view_list->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $specification_view_list->SortUrl($specification_view_list->spec_unitprice) ?>', 1);"><div id="elh_specification_view_spec_unitprice" class="specification_view_spec_unitprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $specification_view_list->spec_unitprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($specification_view_list->spec_unitprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($specification_view_list->spec_unitprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($specification_view_list->spec_totalprice->Visible) { // spec_totalprice ?>
	<?php if ($specification_view_list->SortUrl($specification_view_list->spec_totalprice) == "") { ?>
		<th data-name="spec_totalprice" class="<?php echo $specification_view_list->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_specification_view_spec_totalprice" class="specification_view_spec_totalprice"><div class="ew-table-header-caption"><?php echo $specification_view_list->spec_totalprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_totalprice" class="<?php echo $specification_view_list->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $specification_view_list->SortUrl($specification_view_list->spec_totalprice) ?>', 1);"><div id="elh_specification_view_spec_totalprice" class="specification_view_spec_totalprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $specification_view_list->spec_totalprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($specification_view_list->spec_totalprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($specification_view_list->spec_totalprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$specification_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($specification_view_list->ExportAll && $specification_view_list->isExport()) {
	$specification_view_list->StopRecord = $specification_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($specification_view_list->TotalRecords > $specification_view_list->StartRecord + $specification_view_list->DisplayRecords - 1)
		$specification_view_list->StopRecord = $specification_view_list->StartRecord + $specification_view_list->DisplayRecords - 1;
	else
		$specification_view_list->StopRecord = $specification_view_list->TotalRecords;
}
$specification_view_list->RecordCount = $specification_view_list->StartRecord - 1;
if ($specification_view_list->Recordset && !$specification_view_list->Recordset->EOF) {
	$specification_view_list->Recordset->moveFirst();
	$selectLimit = $specification_view_list->UseSelectLimit;
	if (!$selectLimit && $specification_view_list->StartRecord > 1)
		$specification_view_list->Recordset->move($specification_view_list->StartRecord - 1);
} elseif (!$specification_view->AllowAddDeleteRow && $specification_view_list->StopRecord == 0) {
	$specification_view_list->StopRecord = $specification_view->GridAddRowCount;
}

// Initialize aggregate
$specification_view->RowType = ROWTYPE_AGGREGATEINIT;
$specification_view->resetAttributes();
$specification_view_list->renderRow();
while ($specification_view_list->RecordCount < $specification_view_list->StopRecord) {
	$specification_view_list->RecordCount++;
	if ($specification_view_list->RecordCount >= $specification_view_list->StartRecord) {
		$specification_view_list->RowCount++;

		// Set up key count
		$specification_view_list->KeyCount = $specification_view_list->RowIndex;

		// Init row class and style
		$specification_view->resetAttributes();
		$specification_view->CssClass = "";
		if ($specification_view_list->isGridAdd()) {
		} else {
			$specification_view_list->loadRowValues($specification_view_list->Recordset); // Load row values
		}
		$specification_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$specification_view->RowAttrs->merge(["data-rowindex" => $specification_view_list->RowCount, "id" => "r" . $specification_view_list->RowCount . "_specification_view", "data-rowtype" => $specification_view->RowType]);

		// Render row
		$specification_view_list->renderRow();

		// Render list options
		$specification_view_list->renderListOptions();
?>
	<tr <?php echo $specification_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$specification_view_list->ListOptions->render("body", "left", $specification_view_list->RowCount);
?>
	<?php if ($specification_view_list->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" <?php echo $specification_view_list->pr_number->cellAttributes() ?>>
<span id="el<?php echo $specification_view_list->RowCount ?>_specification_view_pr_number">
<span<?php echo $specification_view_list->pr_number->viewAttributes() ?>><?php echo $specification_view_list->pr_number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($specification_view_list->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit" <?php echo $specification_view_list->spec_unit->cellAttributes() ?>>
<span id="el<?php echo $specification_view_list->RowCount ?>_specification_view_spec_unit">
<span<?php echo $specification_view_list->spec_unit->viewAttributes() ?>><?php echo $specification_view_list->spec_unit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($specification_view_list->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc" <?php echo $specification_view_list->spec_dsc->cellAttributes() ?>>
<span id="el<?php echo $specification_view_list->RowCount ?>_specification_view_spec_dsc">
<span<?php echo $specification_view_list->spec_dsc->viewAttributes() ?>><?php echo $specification_view_list->spec_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($specification_view_list->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty" <?php echo $specification_view_list->spec_qty->cellAttributes() ?>>
<span id="el<?php echo $specification_view_list->RowCount ?>_specification_view_spec_qty">
<span<?php echo $specification_view_list->spec_qty->viewAttributes() ?>><?php echo $specification_view_list->spec_qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($specification_view_list->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice" <?php echo $specification_view_list->spec_unitprice->cellAttributes() ?>>
<span id="el<?php echo $specification_view_list->RowCount ?>_specification_view_spec_unitprice">
<span<?php echo $specification_view_list->spec_unitprice->viewAttributes() ?>><?php echo $specification_view_list->spec_unitprice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($specification_view_list->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice" <?php echo $specification_view_list->spec_totalprice->cellAttributes() ?>>
<span id="el<?php echo $specification_view_list->RowCount ?>_specification_view_spec_totalprice">
<span<?php echo $specification_view_list->spec_totalprice->viewAttributes() ?>><?php echo $specification_view_list->spec_totalprice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$specification_view_list->ListOptions->render("body", "right", $specification_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$specification_view_list->isGridAdd())
		$specification_view_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$specification_view->RowType = ROWTYPE_AGGREGATE;
$specification_view->resetAttributes();
$specification_view_list->renderRow();
?>
<?php if ($specification_view_list->TotalRecords > 0 && !$specification_view_list->isGridAdd() && !$specification_view_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$specification_view_list->renderListOptions();

// Render list options (footer, left)
$specification_view_list->ListOptions->render("footer", "left");
?>
	<?php if ($specification_view_list->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" class="<?php echo $specification_view_list->pr_number->footerCellClass() ?>"><span id="elf_specification_view_pr_number" class="specification_view_pr_number">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($specification_view_list->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit" class="<?php echo $specification_view_list->spec_unit->footerCellClass() ?>"><span id="elf_specification_view_spec_unit" class="specification_view_spec_unit">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($specification_view_list->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc" class="<?php echo $specification_view_list->spec_dsc->footerCellClass() ?>"><span id="elf_specification_view_spec_dsc" class="specification_view_spec_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($specification_view_list->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty" class="<?php echo $specification_view_list->spec_qty->footerCellClass() ?>"><span id="elf_specification_view_spec_qty" class="specification_view_spec_qty">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($specification_view_list->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice" class="<?php echo $specification_view_list->spec_unitprice->footerCellClass() ?>"><span id="elf_specification_view_spec_unitprice" class="specification_view_spec_unitprice">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($specification_view_list->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice" class="<?php echo $specification_view_list->spec_totalprice->footerCellClass() ?>"><span id="elf_specification_view_spec_totalprice" class="specification_view_spec_totalprice">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $specification_view_list->spec_totalprice->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$specification_view_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$specification_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($specification_view_list->Recordset)
	$specification_view_list->Recordset->Close();
?>
<?php if (!$specification_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $specification_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($specification_view_list->TotalRecords == 0 && !$specification_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $specification_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$specification_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$specification_view_list->isExport()) { ?>
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
$specification_view_list->terminate();
?>