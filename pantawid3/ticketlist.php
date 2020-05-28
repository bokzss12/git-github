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
$ticket_list = new ticket_list();

// Run the page
$ticket_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_list->isExport()) { ?>
<script>
var fticketlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fticketlist = currentForm = new ew.Form("fticketlist", "list");
	fticketlist.formKeyCountName = '<?php echo $ticket_list->FormKeyCountName ?>';
	loadjs.done("fticketlist");
});
var fticketlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fticketlistsrch = currentSearchForm = new ew.Form("fticketlistsrch");

	// Dynamic selection lists
	// Filters

	fticketlistsrch.filterList = <?php echo $ticket_list->getFilterList() ?>;
	loadjs.done("fticketlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticket_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ticket_list->TotalRecords > 0 && $ticket_list->ExportOptions->visible()) { ?>
<?php $ticket_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_list->ImportOptions->visible()) { ?>
<?php $ticket_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_list->SearchOptions->visible()) { ?>
<?php $ticket_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_list->FilterOptions->visible()) { ?>
<?php $ticket_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ticket_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ticket_list->isExport() && !$ticket->CurrentAction) { ?>
<form name="fticketlistsrch" id="fticketlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fticketlistsrch-search-panel" class="<?php echo $ticket_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ticket">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ticket_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ticket_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ticket_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ticket_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ticket_list->showPageHeader(); ?>
<?php
$ticket_list->showMessage();
?>
<?php if ($ticket_list->TotalRecords > 0 || $ticket->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<form name="fticketlist" id="fticketlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<div class="row ew-multi-column-row">
<?php if ($ticket_list->TotalRecords > 0 || $ticket_list->isGridEdit()) { ?>
<?php
if ($ticket_list->ExportAll && $ticket_list->isExport()) {
	$ticket_list->StopRecord = $ticket_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ticket_list->TotalRecords > $ticket_list->StartRecord + $ticket_list->DisplayRecords - 1)
		$ticket_list->StopRecord = $ticket_list->StartRecord + $ticket_list->DisplayRecords - 1;
	else
		$ticket_list->StopRecord = $ticket_list->TotalRecords;
}
$ticket_list->RecordCount = $ticket_list->StartRecord - 1;
if ($ticket_list->Recordset && !$ticket_list->Recordset->EOF) {
	$ticket_list->Recordset->moveFirst();
	$selectLimit = $ticket_list->UseSelectLimit;
	if (!$selectLimit && $ticket_list->StartRecord > 1)
		$ticket_list->Recordset->move($ticket_list->StartRecord - 1);
} elseif (!$ticket->AllowAddDeleteRow && $ticket_list->StopRecord == 0) {
	$ticket_list->StopRecord = $ticket->GridAddRowCount;
}
while ($ticket_list->RecordCount < $ticket_list->StopRecord) {
	$ticket_list->RecordCount++;
	if ($ticket_list->RecordCount >= $ticket_list->StartRecord) {
		$ticket_list->RowCount++;

		// Set up key count
		$ticket_list->KeyCount = $ticket_list->RowIndex;

		// Init row class and style
		$ticket->resetAttributes();
		$ticket->CssClass = "";
		if ($ticket_list->isGridAdd()) {
		} else {
			$ticket_list->loadRowValues($ticket_list->Recordset); // Load row values
		}
		$ticket->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ticket->RowAttrs->merge(["data-rowindex" => $ticket_list->RowCount, "id" => "r" . $ticket_list->RowCount . "_ticket", "data-rowtype" => $ticket->RowType]);

		// Render row
		$ticket_list->renderRow();

		// Render list options
		$ticket_list->renderListOptions();
?>
<div class="<?php echo $ticket_list->getMultiColumnClass() ?>" <?php echo $ticket->rowAttributes() ?>>
	<div class="card ew-card">
	<div class="card-body">
	<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
	<table class="table table-striped table-sm ew-view-table">
	<?php } ?>
	<?php if ($ticket_list->SRN->Visible) { // SRN ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_SRN">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->SRN) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->SRN->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->SRN) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->SRN->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->SRN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->SRN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->SRN->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_SRN">
<span<?php echo $ticket_list->SRN->viewAttributes() ?>><?php echo $ticket_list->SRN->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_SRN">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->SRN->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->SRN->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_SRN">
<span<?php echo $ticket_list->SRN->viewAttributes() ?>><?php echo $ticket_list->SRN->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->__Request->Visible) { // Request ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket___Request">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->__Request) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->__Request->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->__Request) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->__Request->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->__Request->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->__Request->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->__Request->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket___Request">
<span<?php echo $ticket_list->__Request->viewAttributes() ?>><?php echo $ticket_list->__Request->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket___Request">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->__Request->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->__Request->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket___Request">
<span<?php echo $ticket_list->__Request->viewAttributes() ?>><?php echo $ticket_list->__Request->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->item_date_receive->Visible) { // item_date_receive ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_item_date_receive">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->item_date_receive) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->item_date_receive->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->item_date_receive) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->item_date_receive->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->item_date_receive->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->item_date_receive->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->item_date_receive->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_date_receive">
<span<?php echo $ticket_list->item_date_receive->viewAttributes() ?>><?php echo $ticket_list->item_date_receive->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_item_date_receive">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->item_date_receive->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->item_date_receive->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_date_receive">
<span<?php echo $ticket_list->item_date_receive->viewAttributes() ?>><?php echo $ticket_list->item_date_receive->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->item_requested_unit->Visible) { // item_requested_unit ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_item_requested_unit">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->item_requested_unit) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->item_requested_unit->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->item_requested_unit) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->item_requested_unit->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->item_requested_unit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->item_requested_unit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->item_requested_unit->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_requested_unit">
<span<?php echo $ticket_list->item_requested_unit->viewAttributes() ?>><?php echo $ticket_list->item_requested_unit->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_item_requested_unit">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->item_requested_unit->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->item_requested_unit->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_requested_unit">
<span<?php echo $ticket_list->item_requested_unit->viewAttributes() ?>><?php echo $ticket_list->item_requested_unit->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->item_transmittal->Visible) { // item_transmittal ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_item_transmittal">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->item_transmittal) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->item_transmittal->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->item_transmittal) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->item_transmittal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->item_transmittal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->item_transmittal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->item_transmittal->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_transmittal">
<span<?php echo $ticket_list->item_transmittal->viewAttributes() ?>><?php echo $ticket_list->item_transmittal->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_item_transmittal">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->item_transmittal->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->item_transmittal->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_transmittal">
<span<?php echo $ticket_list->item_transmittal->viewAttributes() ?>><?php echo $ticket_list->item_transmittal->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->position->Visible) { // position ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_position">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->position) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->position->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->position) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->position->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->position->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_position">
<span<?php echo $ticket_list->position->viewAttributes() ?>><?php echo $ticket_list->position->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_position">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->position->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->position->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_position">
<span<?php echo $ticket_list->position->viewAttributes() ?>><?php echo $ticket_list->position->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->Contact_no->Visible) { // Contact_no ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_Contact_no">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->Contact_no) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->Contact_no->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->Contact_no) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->Contact_no->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->Contact_no->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->Contact_no->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->Contact_no->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_Contact_no">
<span<?php echo $ticket_list->Contact_no->viewAttributes() ?>><?php echo $ticket_list->Contact_no->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_Contact_no">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->Contact_no->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->Contact_no->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_Contact_no">
<span<?php echo $ticket_list->Contact_no->viewAttributes() ?>><?php echo $ticket_list->Contact_no->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->item_type->Visible) { // item_type ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_item_type">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->item_type) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->item_type->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->item_type) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->item_type->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->item_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->item_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->item_type->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_type">
<span<?php echo $ticket_list->item_type->viewAttributes() ?>><?php echo $ticket_list->item_type->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_item_type">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->item_type->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->item_type->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_type">
<span<?php echo $ticket_list->item_type->viewAttributes() ?>><?php echo $ticket_list->item_type->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->item_model->Visible) { // item_model ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_item_model">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->item_model) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->item_model->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->item_model) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->item_model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_model">
<span<?php echo $ticket_list->item_model->viewAttributes() ?>><?php echo $ticket_list->item_model->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_item_model">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->item_model->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->item_model->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_model">
<span<?php echo $ticket_list->item_model->viewAttributes() ?>><?php echo $ticket_list->item_model->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->item_type_problem->Visible) { // item_type_problem ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_item_type_problem">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->item_type_problem) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->item_type_problem->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->item_type_problem) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->item_type_problem->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->item_type_problem->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->item_type_problem->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->item_type_problem->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_type_problem">
<span<?php echo $ticket_list->item_type_problem->viewAttributes() ?>><?php echo $ticket_list->item_type_problem->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_item_type_problem">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->item_type_problem->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->item_type_problem->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_type_problem">
<span<?php echo $ticket_list->item_type_problem->viewAttributes() ?>><?php echo $ticket_list->item_type_problem->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->item_date_pullout->Visible) { // item_date_pullout ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_item_date_pullout">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->item_date_pullout) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->item_date_pullout->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->item_date_pullout) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->item_date_pullout->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->item_date_pullout->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->item_date_pullout->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->item_date_pullout->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_date_pullout">
<span<?php echo $ticket_list->item_date_pullout->viewAttributes() ?>><?php echo $ticket_list->item_date_pullout->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_item_date_pullout">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->item_date_pullout->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->item_date_pullout->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_item_date_pullout">
<span<?php echo $ticket_list->item_date_pullout->viewAttributes() ?>><?php echo $ticket_list->item_date_pullout->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket_list->status_id->Visible) { // status_id ?>
		<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
		<tr>
			<td class="ew-table-header <?php echo $ticket_list->TableLeftColumnClass ?>"><span class="ticket_status_id">
<?php if ($ticket_list->isExport() || $ticket_list->SortUrl($ticket_list->status_id) == "") { ?>
				<div class="ew-table-header-caption"><?php echo $ticket_list->status_id->caption() ?></div>
<?php } else { ?>
				<div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->status_id) ?>', 2);">
				<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->status_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->status_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->status_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td <?php echo $ticket_list->status_id->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_status_id">
<span<?php echo $ticket_list->status_id->viewAttributes() ?>><?php echo $ticket_list->status_id->getViewValue() ?></span>
</span>
</td>
		</tr>
		<?php } else { // Add/edit record ?>
		<div class="form-group row ticket_status_id">
			<label class="<?php echo $ticket_list->LeftColumnClass ?>"><?php echo $ticket_list->status_id->caption() ?></label>
			<div class="<?php echo $ticket_list->RightColumnClass ?>"><div <?php echo $ticket_list->status_id->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_status_id">
<span<?php echo $ticket_list->status_id->viewAttributes() ?>><?php echo $ticket_list->status_id->getViewValue() ?></span>
</span>
</div></div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if ($ticket->RowType == ROWTYPE_VIEW) { // View record ?>
	</table>
	<?php } ?>
	</div><!-- /.card-body -->
<?php if (!$ticket_list->isExport()) { ?>
	<div class="card-footer">
		<div class="ew-multi-column-list-option">
<?php

// Render list options (body, bottom)
$ticket_list->ListOptions->render("body", "bottom", $ticket_list->RowCount);
?>
		</div><!-- /.ew-multi-column-list-option -->
		<div class="clearfix"></div>
	</div><!-- /.card-footer -->
<?php } ?>
	</div><!-- /.card -->
</div><!-- /.col-* -->
<?php
	}
	if (!$ticket_list->isGridAdd())
		$ticket_list->Recordset->moveNext();
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if (!$ticket->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ticket_list->Recordset)
	$ticket_list->Recordset->Close();
?>
<?php if (!$ticket_list->isExport()) { ?>
<div>
<div class="ew-list-other-options">
<?php $ticket_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($ticket_list->TotalRecords == 0 && !$ticket->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ticket_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ticket_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_list->isExport()) { ?>
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
$ticket_list->terminate();
?>