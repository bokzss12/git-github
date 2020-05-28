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
$employee_list = new employee_list();

// Run the page
$employee_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_list->isExport()) { ?>
<script>
var femployeelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployeelist = currentForm = new ew.Form("femployeelist", "list");
	femployeelist.formKeyCountName = '<?php echo $employee_list->FormKeyCountName ?>';
	loadjs.done("femployeelist");
});
var femployeelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployeelistsrch = currentSearchForm = new ew.Form("femployeelistsrch");

	// Dynamic selection lists
	// Filters

	femployeelistsrch.filterList = <?php echo $employee_list->getFilterList() ?>;
	loadjs.done("femployeelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employee_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employee_list->TotalRecords > 0 && $employee_list->ExportOptions->visible()) { ?>
<?php $employee_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_list->ImportOptions->visible()) { ?>
<?php $employee_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_list->SearchOptions->visible()) { ?>
<?php $employee_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employee_list->FilterOptions->visible()) { ?>
<?php $employee_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employee_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employee_list->isExport() && !$employee->CurrentAction) { ?>
<form name="femployeelistsrch" id="femployeelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployeelistsrch-search-panel" class="<?php echo $employee_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employee">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employee_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employee_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employee_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employee_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employee_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employee_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employee_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employee_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employee_list->showPageHeader(); ?>
<?php
$employee_list->showMessage();
?>
<?php if ($employee_list->TotalRecords > 0 || $employee->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee">
<?php if (!$employee_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employee_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployeelist" id="femployeelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee">
<div id="gmp_employee" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employee_list->TotalRecords > 0 || $employee_list->isGridEdit()) { ?>
<table id="tbl_employeelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee->RowType = ROWTYPE_HEADER;

// Render list options
$employee_list->renderListOptions();

// Render list options (header, left)
$employee_list->ListOptions->render("header", "left");
?>
<?php if ($employee_list->employeeid->Visible) { // employeeid ?>
	<?php if ($employee_list->SortUrl($employee_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $employee_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_employeeid" class="employee_employeeid"><div class="ew-table-header-caption"><?php echo $employee_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $employee_list->employeeid->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->employeeid) ?>', 1);"><div id="elh_employee_employeeid" class="employee_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->username->Visible) { // username ?>
	<?php if ($employee_list->SortUrl($employee_list->username) == "") { ?>
		<th data-name="username" class="<?php echo $employee_list->username->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_username" class="employee_username"><div class="ew-table-header-caption"><?php echo $employee_list->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $employee_list->username->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->username) ?>', 1);"><div id="elh_employee_username" class="employee_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_list->username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->password->Visible) { // password ?>
	<?php if ($employee_list->SortUrl($employee_list->password) == "") { ?>
		<th data-name="password" class="<?php echo $employee_list->password->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_password" class="employee_password"><div class="ew-table-header-caption"><?php echo $employee_list->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $employee_list->password->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->password) ?>', 1);"><div id="elh_employee_password" class="employee_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_list->password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->userlevel_id->Visible) { // userlevel_id ?>
	<?php if ($employee_list->SortUrl($employee_list->userlevel_id) == "") { ?>
		<th data-name="userlevel_id" class="<?php echo $employee_list->userlevel_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_userlevel_id" class="employee_userlevel_id"><div class="ew-table-header-caption"><?php echo $employee_list->userlevel_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevel_id" class="<?php echo $employee_list->userlevel_id->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->userlevel_id) ?>', 1);"><div id="elh_employee_userlevel_id" class="employee_userlevel_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->userlevel_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_list->userlevel_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->userlevel_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($employee_list->SortUrl($employee_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $employee_list->Name_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_Name_dsc" class="employee_Name_dsc"><div class="ew-table-header-caption"><?php echo $employee_list->Name_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $employee_list->Name_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->Name_dsc) ?>', 1);"><div id="elh_employee_Name_dsc" class="employee_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->Name_dsc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->position->Visible) { // position ?>
	<?php if ($employee_list->SortUrl($employee_list->position) == "") { ?>
		<th data-name="position" class="<?php echo $employee_list->position->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_position" class="employee_position"><div class="ew-table-header-caption"><?php echo $employee_list->position->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="position" class="<?php echo $employee_list->position->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->position) ?>', 1);"><div id="elh_employee_position" class="employee_position">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->position->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_list->position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->_email->Visible) { // email ?>
	<?php if ($employee_list->SortUrl($employee_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $employee_list->_email->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee__email" class="employee__email"><div class="ew-table-header-caption"><?php echo $employee_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $employee_list->_email->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->_email) ?>', 1);"><div id="elh_employee__email" class="employee__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->activation->Visible) { // activation ?>
	<?php if ($employee_list->SortUrl($employee_list->activation) == "") { ?>
		<th data-name="activation" class="<?php echo $employee_list->activation->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_activation" class="employee_activation"><div class="ew-table-header-caption"><?php echo $employee_list->activation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="activation" class="<?php echo $employee_list->activation->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->activation) ?>', 1);"><div id="elh_employee_activation" class="employee_activation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->activation->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_list->activation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->activation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_list->photo->Visible) { // photo ?>
	<?php if ($employee_list->SortUrl($employee_list->photo) == "") { ?>
		<th data-name="photo" class="<?php echo $employee_list->photo->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_employee_photo" class="employee_photo"><div class="ew-table-header-caption"><?php echo $employee_list->photo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="photo" class="<?php echo $employee_list->photo->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_list->SortUrl($employee_list->photo) ?>', 1);"><div id="elh_employee_photo" class="employee_photo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_list->photo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_list->photo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_list->photo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employee_list->ExportAll && $employee_list->isExport()) {
	$employee_list->StopRecord = $employee_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employee_list->TotalRecords > $employee_list->StartRecord + $employee_list->DisplayRecords - 1)
		$employee_list->StopRecord = $employee_list->StartRecord + $employee_list->DisplayRecords - 1;
	else
		$employee_list->StopRecord = $employee_list->TotalRecords;
}
$employee_list->RecordCount = $employee_list->StartRecord - 1;
if ($employee_list->Recordset && !$employee_list->Recordset->EOF) {
	$employee_list->Recordset->moveFirst();
	$selectLimit = $employee_list->UseSelectLimit;
	if (!$selectLimit && $employee_list->StartRecord > 1)
		$employee_list->Recordset->move($employee_list->StartRecord - 1);
} elseif (!$employee->AllowAddDeleteRow && $employee_list->StopRecord == 0) {
	$employee_list->StopRecord = $employee->GridAddRowCount;
}

// Initialize aggregate
$employee->RowType = ROWTYPE_AGGREGATEINIT;
$employee->resetAttributes();
$employee_list->renderRow();
while ($employee_list->RecordCount < $employee_list->StopRecord) {
	$employee_list->RecordCount++;
	if ($employee_list->RecordCount >= $employee_list->StartRecord) {
		$employee_list->RowCount++;

		// Set up key count
		$employee_list->KeyCount = $employee_list->RowIndex;

		// Init row class and style
		$employee->resetAttributes();
		$employee->CssClass = "";
		if ($employee_list->isGridAdd()) {
		} else {
			$employee_list->loadRowValues($employee_list->Recordset); // Load row values
		}
		$employee->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employee->RowAttrs->merge(["data-rowindex" => $employee_list->RowCount, "id" => "r" . $employee_list->RowCount . "_employee", "data-rowtype" => $employee->RowType]);

		// Render row
		$employee_list->renderRow();

		// Render list options
		$employee_list->renderListOptions();
?>
	<tr <?php echo $employee->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_list->ListOptions->render("body", "left", $employee_list->RowCount);
?>
	<?php if ($employee_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $employee_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_employeeid">
<span<?php echo $employee_list->employeeid->viewAttributes() ?>><?php echo $employee_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->username->Visible) { // username ?>
		<td data-name="username" <?php echo $employee_list->username->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_username">
<span<?php echo $employee_list->username->viewAttributes() ?>><?php echo $employee_list->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->password->Visible) { // password ?>
		<td data-name="password" <?php echo $employee_list->password->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_password">
<span<?php echo $employee_list->password->viewAttributes() ?>><?php echo $employee_list->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->userlevel_id->Visible) { // userlevel_id ?>
		<td data-name="userlevel_id" <?php echo $employee_list->userlevel_id->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_userlevel_id">
<span<?php echo $employee_list->userlevel_id->viewAttributes() ?>><?php echo $employee_list->userlevel_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $employee_list->Name_dsc->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_Name_dsc">
<span<?php echo $employee_list->Name_dsc->viewAttributes() ?>><?php echo $employee_list->Name_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->position->Visible) { // position ?>
		<td data-name="position" <?php echo $employee_list->position->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_position">
<span<?php echo $employee_list->position->viewAttributes() ?>><?php echo $employee_list->position->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $employee_list->_email->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee__email">
<span<?php echo $employee_list->_email->viewAttributes() ?>><?php echo $employee_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->activation->Visible) { // activation ?>
		<td data-name="activation" <?php echo $employee_list->activation->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_activation">
<span<?php echo $employee_list->activation->viewAttributes() ?>><?php echo $employee_list->activation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_list->photo->Visible) { // photo ?>
		<td data-name="photo" <?php echo $employee_list->photo->cellAttributes() ?>>
<span id="el<?php echo $employee_list->RowCount ?>_employee_photo">
<span><?php echo GetFileViewTag($employee_list->photo, $employee_list->photo->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_list->ListOptions->render("body", "right", $employee_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$employee_list->isGridAdd())
		$employee_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$employee->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_list->Recordset)
	$employee_list->Recordset->Close();
?>
<?php if (!$employee_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employee_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_list->TotalRecords == 0 && !$employee->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employee_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_list->isExport()) { ?>
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
$employee_list->terminate();
?>