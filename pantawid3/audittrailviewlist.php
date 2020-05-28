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
$audittrailview_list = new audittrailview_list();

// Run the page
$audittrailview_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrailview_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$audittrailview_list->isExport()) { ?>
<script>
var faudittrailviewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	faudittrailviewlist = currentForm = new ew.Form("faudittrailviewlist", "list");
	faudittrailviewlist.formKeyCountName = '<?php echo $audittrailview_list->FormKeyCountName ?>';
	loadjs.done("faudittrailviewlist");
});
var faudittrailviewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	faudittrailviewlistsrch = currentSearchForm = new ew.Form("faudittrailviewlistsrch");

	// Dynamic selection lists
	// Filters

	faudittrailviewlistsrch.filterList = <?php echo $audittrailview_list->getFilterList() ?>;
	loadjs.done("faudittrailviewlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$audittrailview_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($audittrailview_list->TotalRecords > 0 && $audittrailview_list->ExportOptions->visible()) { ?>
<?php $audittrailview_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($audittrailview_list->ImportOptions->visible()) { ?>
<?php $audittrailview_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($audittrailview_list->SearchOptions->visible()) { ?>
<?php $audittrailview_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($audittrailview_list->FilterOptions->visible()) { ?>
<?php $audittrailview_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$audittrailview_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$audittrailview_list->isExport() && !$audittrailview->CurrentAction) { ?>
<form name="faudittrailviewlistsrch" id="faudittrailviewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="faudittrailviewlistsrch-search-panel" class="<?php echo $audittrailview_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="audittrailview">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $audittrailview_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($audittrailview_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($audittrailview_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $audittrailview_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($audittrailview_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($audittrailview_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($audittrailview_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($audittrailview_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $audittrailview_list->showPageHeader(); ?>
<?php
$audittrailview_list->showMessage();
?>
<?php if ($audittrailview_list->TotalRecords > 0 || $audittrailview->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($audittrailview_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> audittrailview">
<form name="faudittrailviewlist" id="faudittrailviewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrailview">
<div id="gmp_audittrailview" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($audittrailview_list->TotalRecords > 0 || $audittrailview_list->isGridEdit()) { ?>
<table id="tbl_audittrailviewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$audittrailview->RowType = ROWTYPE_HEADER;

// Render list options
$audittrailview_list->renderListOptions();

// Render list options (header, left)
$audittrailview_list->ListOptions->render("header", "left");
?>
<?php if ($audittrailview_list->id->Visible) { // id ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $audittrailview_list->id->headerCellClass() ?>"><div id="elh_audittrailview_id" class="audittrailview_id"><div class="ew-table-header-caption"><?php echo $audittrailview_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $audittrailview_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->id) ?>', 1);"><div id="elh_audittrailview_id" class="audittrailview_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->datetime->Visible) { // datetime ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $audittrailview_list->datetime->headerCellClass() ?>"><div id="elh_audittrailview_datetime" class="audittrailview_datetime"><div class="ew-table-header-caption"><?php echo $audittrailview_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $audittrailview_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->datetime) ?>', 1);"><div id="elh_audittrailview_datetime" class="audittrailview_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->datetime->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->script->Visible) { // script ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->script) == "") { ?>
		<th data-name="script" class="<?php echo $audittrailview_list->script->headerCellClass() ?>"><div id="elh_audittrailview_script" class="audittrailview_script"><div class="ew-table-header-caption"><?php echo $audittrailview_list->script->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="script" class="<?php echo $audittrailview_list->script->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->script) ?>', 1);"><div id="elh_audittrailview_script" class="audittrailview_script">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->script->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->script->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->script->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $audittrailview_list->Name_dsc->headerCellClass() ?>"><div id="elh_audittrailview_Name_dsc" class="audittrailview_Name_dsc"><div class="ew-table-header-caption"><?php echo $audittrailview_list->Name_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $audittrailview_list->Name_dsc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->Name_dsc) ?>', 1);"><div id="elh_audittrailview_Name_dsc" class="audittrailview_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->Name_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->_action->Visible) { // action ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->_action) == "") { ?>
		<th data-name="_action" class="<?php echo $audittrailview_list->_action->headerCellClass() ?>"><div id="elh_audittrailview__action" class="audittrailview__action"><div class="ew-table-header-caption"><?php echo $audittrailview_list->_action->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_action" class="<?php echo $audittrailview_list->_action->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->_action) ?>', 1);"><div id="elh_audittrailview__action" class="audittrailview__action">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->_action->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->_action->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->_action->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->_table->Visible) { // table ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->_table) == "") { ?>
		<th data-name="_table" class="<?php echo $audittrailview_list->_table->headerCellClass() ?>"><div id="elh_audittrailview__table" class="audittrailview__table"><div class="ew-table-header-caption"><?php echo $audittrailview_list->_table->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_table" class="<?php echo $audittrailview_list->_table->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->_table) ?>', 1);"><div id="elh_audittrailview__table" class="audittrailview__table">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->_table->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->_table->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->_table->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->field->Visible) { // field ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->field) == "") { ?>
		<th data-name="field" class="<?php echo $audittrailview_list->field->headerCellClass() ?>"><div id="elh_audittrailview_field" class="audittrailview_field"><div class="ew-table-header-caption"><?php echo $audittrailview_list->field->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field" class="<?php echo $audittrailview_list->field->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->field) ?>', 1);"><div id="elh_audittrailview_field" class="audittrailview_field">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->field->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->field->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->field->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->oldvalue->Visible) { // oldvalue ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->oldvalue) == "") { ?>
		<th data-name="oldvalue" class="<?php echo $audittrailview_list->oldvalue->headerCellClass() ?>"><div id="elh_audittrailview_oldvalue" class="audittrailview_oldvalue"><div class="ew-table-header-caption"><?php echo $audittrailview_list->oldvalue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="oldvalue" class="<?php echo $audittrailview_list->oldvalue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->oldvalue) ?>', 1);"><div id="elh_audittrailview_oldvalue" class="audittrailview_oldvalue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->oldvalue->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->oldvalue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->oldvalue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrailview_list->newvalue->Visible) { // newvalue ?>
	<?php if ($audittrailview_list->SortUrl($audittrailview_list->newvalue) == "") { ?>
		<th data-name="newvalue" class="<?php echo $audittrailview_list->newvalue->headerCellClass() ?>"><div id="elh_audittrailview_newvalue" class="audittrailview_newvalue"><div class="ew-table-header-caption"><?php echo $audittrailview_list->newvalue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="newvalue" class="<?php echo $audittrailview_list->newvalue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrailview_list->SortUrl($audittrailview_list->newvalue) ?>', 1);"><div id="elh_audittrailview_newvalue" class="audittrailview_newvalue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrailview_list->newvalue->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrailview_list->newvalue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrailview_list->newvalue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$audittrailview_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($audittrailview_list->ExportAll && $audittrailview_list->isExport()) {
	$audittrailview_list->StopRecord = $audittrailview_list->TotalRecords;
} else {

	// Set the last record to display
	if ($audittrailview_list->TotalRecords > $audittrailview_list->StartRecord + $audittrailview_list->DisplayRecords - 1)
		$audittrailview_list->StopRecord = $audittrailview_list->StartRecord + $audittrailview_list->DisplayRecords - 1;
	else
		$audittrailview_list->StopRecord = $audittrailview_list->TotalRecords;
}
$audittrailview_list->RecordCount = $audittrailview_list->StartRecord - 1;
if ($audittrailview_list->Recordset && !$audittrailview_list->Recordset->EOF) {
	$audittrailview_list->Recordset->moveFirst();
	$selectLimit = $audittrailview_list->UseSelectLimit;
	if (!$selectLimit && $audittrailview_list->StartRecord > 1)
		$audittrailview_list->Recordset->move($audittrailview_list->StartRecord - 1);
} elseif (!$audittrailview->AllowAddDeleteRow && $audittrailview_list->StopRecord == 0) {
	$audittrailview_list->StopRecord = $audittrailview->GridAddRowCount;
}

// Initialize aggregate
$audittrailview->RowType = ROWTYPE_AGGREGATEINIT;
$audittrailview->resetAttributes();
$audittrailview_list->renderRow();
while ($audittrailview_list->RecordCount < $audittrailview_list->StopRecord) {
	$audittrailview_list->RecordCount++;
	if ($audittrailview_list->RecordCount >= $audittrailview_list->StartRecord) {
		$audittrailview_list->RowCount++;

		// Set up key count
		$audittrailview_list->KeyCount = $audittrailview_list->RowIndex;

		// Init row class and style
		$audittrailview->resetAttributes();
		$audittrailview->CssClass = "";
		if ($audittrailview_list->isGridAdd()) {
		} else {
			$audittrailview_list->loadRowValues($audittrailview_list->Recordset); // Load row values
		}
		$audittrailview->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$audittrailview->RowAttrs->merge(["data-rowindex" => $audittrailview_list->RowCount, "id" => "r" . $audittrailview_list->RowCount . "_audittrailview", "data-rowtype" => $audittrailview->RowType]);

		// Render row
		$audittrailview_list->renderRow();

		// Render list options
		$audittrailview_list->renderListOptions();
?>
	<tr <?php echo $audittrailview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$audittrailview_list->ListOptions->render("body", "left", $audittrailview_list->RowCount);
?>
	<?php if ($audittrailview_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $audittrailview_list->id->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview_id">
<span<?php echo $audittrailview_list->id->viewAttributes() ?>><?php echo $audittrailview_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $audittrailview_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview_datetime">
<span<?php echo $audittrailview_list->datetime->viewAttributes() ?>><?php echo $audittrailview_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->script->Visible) { // script ?>
		<td data-name="script" <?php echo $audittrailview_list->script->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview_script">
<span<?php echo $audittrailview_list->script->viewAttributes() ?>><?php echo $audittrailview_list->script->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $audittrailview_list->Name_dsc->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview_Name_dsc">
<span<?php echo $audittrailview_list->Name_dsc->viewAttributes() ?>><?php echo $audittrailview_list->Name_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->_action->Visible) { // action ?>
		<td data-name="_action" <?php echo $audittrailview_list->_action->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview__action">
<span<?php echo $audittrailview_list->_action->viewAttributes() ?>><?php echo $audittrailview_list->_action->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->_table->Visible) { // table ?>
		<td data-name="_table" <?php echo $audittrailview_list->_table->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview__table">
<span<?php echo $audittrailview_list->_table->viewAttributes() ?>><?php echo $audittrailview_list->_table->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->field->Visible) { // field ?>
		<td data-name="field" <?php echo $audittrailview_list->field->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview_field">
<span<?php echo $audittrailview_list->field->viewAttributes() ?>><?php echo $audittrailview_list->field->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->oldvalue->Visible) { // oldvalue ?>
		<td data-name="oldvalue" <?php echo $audittrailview_list->oldvalue->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview_oldvalue">
<span<?php echo $audittrailview_list->oldvalue->viewAttributes() ?>><?php echo $audittrailview_list->oldvalue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrailview_list->newvalue->Visible) { // newvalue ?>
		<td data-name="newvalue" <?php echo $audittrailview_list->newvalue->cellAttributes() ?>>
<span id="el<?php echo $audittrailview_list->RowCount ?>_audittrailview_newvalue">
<span<?php echo $audittrailview_list->newvalue->viewAttributes() ?>><?php echo $audittrailview_list->newvalue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$audittrailview_list->ListOptions->render("body", "right", $audittrailview_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$audittrailview_list->isGridAdd())
		$audittrailview_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$audittrailview->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($audittrailview_list->Recordset)
	$audittrailview_list->Recordset->Close();
?>
<?php if (!$audittrailview_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $audittrailview_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($audittrailview_list->TotalRecords == 0 && !$audittrailview->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $audittrailview_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$audittrailview_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$audittrailview_list->isExport()) { ?>
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
$audittrailview_list->terminate();
?>