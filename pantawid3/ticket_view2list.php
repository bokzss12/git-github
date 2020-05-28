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
$ticket_view2_list = new ticket_view2_list();

// Run the page
$ticket_view2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_view2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_view2_list->isExport()) { ?>
<script>
var fticket_view2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fticket_view2list = currentForm = new ew.Form("fticket_view2list", "list");
	fticket_view2list.formKeyCountName = '<?php echo $ticket_view2_list->FormKeyCountName ?>';
	loadjs.done("fticket_view2list");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticket_view2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ticket_view2_list->TotalRecords > 0 && $ticket_view2_list->ExportOptions->visible()) { ?>
<?php $ticket_view2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_view2_list->ImportOptions->visible()) { ?>
<?php $ticket_view2_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ticket_view2_list->renderOtherOptions();
?>
<?php $ticket_view2_list->showPageHeader(); ?>
<?php
$ticket_view2_list->showMessage();
?>
<?php if ($ticket_view2_list->TotalRecords > 0 || $ticket_view2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ticket_view2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ticket_view2">
<form name="fticket_view2list" id="fticket_view2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_view2">
<div id="gmp_ticket_view2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ticket_view2_list->TotalRecords > 0 || $ticket_view2_list->isGridEdit()) { ?>
<table id="tbl_ticket_view2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ticket_view2->RowType = ROWTYPE_HEADER;

// Render list options
$ticket_view2_list->renderListOptions();

// Render list options (header, left)
$ticket_view2_list->ListOptions->render("header", "left");
?>
<?php if ($ticket_view2_list->SRN->Visible) { // SRN ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->SRN) == "") { ?>
		<th data-name="SRN" class="<?php echo $ticket_view2_list->SRN->headerCellClass() ?>"><div id="elh_ticket_view2_SRN" class="ticket_view2_SRN"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->SRN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SRN" class="<?php echo $ticket_view2_list->SRN->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->SRN) ?>', 1);"><div id="elh_ticket_view2_SRN" class="ticket_view2_SRN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->SRN->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->SRN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->SRN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->__Request->Visible) { // Request ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->__Request) == "") { ?>
		<th data-name="__Request" class="<?php echo $ticket_view2_list->__Request->headerCellClass() ?>"><div id="elh_ticket_view2___Request" class="ticket_view2___Request"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->__Request->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="__Request" class="<?php echo $ticket_view2_list->__Request->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->__Request) ?>', 1);"><div id="elh_ticket_view2___Request" class="ticket_view2___Request">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->__Request->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->__Request->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->__Request->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->item_date_receive->Visible) { // item_date_receive ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->item_date_receive) == "") { ?>
		<th data-name="item_date_receive" class="<?php echo $ticket_view2_list->item_date_receive->headerCellClass() ?>"><div id="elh_ticket_view2_item_date_receive" class="ticket_view2_item_date_receive"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->item_date_receive->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_receive" class="<?php echo $ticket_view2_list->item_date_receive->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->item_date_receive) ?>', 1);"><div id="elh_ticket_view2_item_date_receive" class="ticket_view2_item_date_receive">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->item_date_receive->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->item_date_receive->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->item_date_receive->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->employeeid->Visible) { // employeeid ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $ticket_view2_list->employeeid->headerCellClass() ?>"><div id="elh_ticket_view2_employeeid" class="ticket_view2_employeeid"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->employeeid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $ticket_view2_list->employeeid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->employeeid) ?>', 1);"><div id="elh_ticket_view2_employeeid" class="ticket_view2_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->item_requested_unit->Visible) { // item_requested_unit ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->item_requested_unit) == "") { ?>
		<th data-name="item_requested_unit" class="<?php echo $ticket_view2_list->item_requested_unit->headerCellClass() ?>"><div id="elh_ticket_view2_item_requested_unit" class="ticket_view2_item_requested_unit"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->item_requested_unit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_requested_unit" class="<?php echo $ticket_view2_list->item_requested_unit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->item_requested_unit) ?>', 1);"><div id="elh_ticket_view2_item_requested_unit" class="ticket_view2_item_requested_unit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->item_requested_unit->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->item_requested_unit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->item_requested_unit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->item_transmittal->Visible) { // item_transmittal ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->item_transmittal) == "") { ?>
		<th data-name="item_transmittal" class="<?php echo $ticket_view2_list->item_transmittal->headerCellClass() ?>"><div id="elh_ticket_view2_item_transmittal" class="ticket_view2_item_transmittal"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->item_transmittal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_transmittal" class="<?php echo $ticket_view2_list->item_transmittal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->item_transmittal) ?>', 1);"><div id="elh_ticket_view2_item_transmittal" class="ticket_view2_item_transmittal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->item_transmittal->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->item_transmittal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->item_transmittal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->position->Visible) { // position ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->position) == "") { ?>
		<th data-name="position" class="<?php echo $ticket_view2_list->position->headerCellClass() ?>"><div id="elh_ticket_view2_position" class="ticket_view2_position"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->position->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="position" class="<?php echo $ticket_view2_list->position->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->position) ?>', 1);"><div id="elh_ticket_view2_position" class="ticket_view2_position">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->position->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->Contact_no->Visible) { // Contact_no ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->Contact_no) == "") { ?>
		<th data-name="Contact_no" class="<?php echo $ticket_view2_list->Contact_no->headerCellClass() ?>"><div id="elh_ticket_view2_Contact_no" class="ticket_view2_Contact_no"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->Contact_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Contact_no" class="<?php echo $ticket_view2_list->Contact_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->Contact_no) ?>', 1);"><div id="elh_ticket_view2_Contact_no" class="ticket_view2_Contact_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->Contact_no->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->Contact_no->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->Contact_no->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->item_type->Visible) { // item_type ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->item_type) == "") { ?>
		<th data-name="item_type" class="<?php echo $ticket_view2_list->item_type->headerCellClass() ?>"><div id="elh_ticket_view2_item_type" class="ticket_view2_item_type"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->item_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item_type" class="<?php echo $ticket_view2_list->item_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->item_type) ?>', 1);"><div id="elh_ticket_view2_item_type" class="ticket_view2_item_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->item_type->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->item_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->item_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_view2_list->status_desc->Visible) { // status_desc ?>
	<?php if ($ticket_view2_list->SortUrl($ticket_view2_list->status_desc) == "") { ?>
		<th data-name="status_desc" class="<?php echo $ticket_view2_list->status_desc->headerCellClass() ?>"><div id="elh_ticket_view2_status_desc" class="ticket_view2_status_desc"><div class="ew-table-header-caption"><?php echo $ticket_view2_list->status_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_desc" class="<?php echo $ticket_view2_list->status_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_view2_list->SortUrl($ticket_view2_list->status_desc) ?>', 1);"><div id="elh_ticket_view2_status_desc" class="ticket_view2_status_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_view2_list->status_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_view2_list->status_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_view2_list->status_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ticket_view2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ticket_view2_list->ExportAll && $ticket_view2_list->isExport()) {
	$ticket_view2_list->StopRecord = $ticket_view2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ticket_view2_list->TotalRecords > $ticket_view2_list->StartRecord + $ticket_view2_list->DisplayRecords - 1)
		$ticket_view2_list->StopRecord = $ticket_view2_list->StartRecord + $ticket_view2_list->DisplayRecords - 1;
	else
		$ticket_view2_list->StopRecord = $ticket_view2_list->TotalRecords;
}
$ticket_view2_list->RecordCount = $ticket_view2_list->StartRecord - 1;
if ($ticket_view2_list->Recordset && !$ticket_view2_list->Recordset->EOF) {
	$ticket_view2_list->Recordset->moveFirst();
	$selectLimit = $ticket_view2_list->UseSelectLimit;
	if (!$selectLimit && $ticket_view2_list->StartRecord > 1)
		$ticket_view2_list->Recordset->move($ticket_view2_list->StartRecord - 1);
} elseif (!$ticket_view2->AllowAddDeleteRow && $ticket_view2_list->StopRecord == 0) {
	$ticket_view2_list->StopRecord = $ticket_view2->GridAddRowCount;
}

// Initialize aggregate
$ticket_view2->RowType = ROWTYPE_AGGREGATEINIT;
$ticket_view2->resetAttributes();
$ticket_view2_list->renderRow();
while ($ticket_view2_list->RecordCount < $ticket_view2_list->StopRecord) {
	$ticket_view2_list->RecordCount++;
	if ($ticket_view2_list->RecordCount >= $ticket_view2_list->StartRecord) {
		$ticket_view2_list->RowCount++;

		// Set up key count
		$ticket_view2_list->KeyCount = $ticket_view2_list->RowIndex;

		// Init row class and style
		$ticket_view2->resetAttributes();
		$ticket_view2->CssClass = "";
		if ($ticket_view2_list->isGridAdd()) {
		} else {
			$ticket_view2_list->loadRowValues($ticket_view2_list->Recordset); // Load row values
		}
		$ticket_view2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ticket_view2->RowAttrs->merge(["data-rowindex" => $ticket_view2_list->RowCount, "id" => "r" . $ticket_view2_list->RowCount . "_ticket_view2", "data-rowtype" => $ticket_view2->RowType]);

		// Render row
		$ticket_view2_list->renderRow();

		// Render list options
		$ticket_view2_list->renderListOptions();
?>
	<tr <?php echo $ticket_view2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticket_view2_list->ListOptions->render("body", "left", $ticket_view2_list->RowCount);
?>
	<?php if ($ticket_view2_list->SRN->Visible) { // SRN ?>
		<td data-name="SRN" <?php echo $ticket_view2_list->SRN->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_SRN">
<span<?php echo $ticket_view2_list->SRN->viewAttributes() ?>><?php echo $ticket_view2_list->SRN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->__Request->Visible) { // Request ?>
		<td data-name="__Request" <?php echo $ticket_view2_list->__Request->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2___Request">
<span<?php echo $ticket_view2_list->__Request->viewAttributes() ?>><?php echo $ticket_view2_list->__Request->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_date_receive->Visible) { // item_date_receive ?>
		<td data-name="item_date_receive" <?php echo $ticket_view2_list->item_date_receive->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_item_date_receive">
<span<?php echo $ticket_view2_list->item_date_receive->viewAttributes() ?>><?php echo $ticket_view2_list->item_date_receive->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $ticket_view2_list->employeeid->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_employeeid">
<span<?php echo $ticket_view2_list->employeeid->viewAttributes() ?>><?php echo $ticket_view2_list->employeeid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_requested_unit->Visible) { // item_requested_unit ?>
		<td data-name="item_requested_unit" <?php echo $ticket_view2_list->item_requested_unit->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_item_requested_unit">
<span<?php echo $ticket_view2_list->item_requested_unit->viewAttributes() ?>><?php echo $ticket_view2_list->item_requested_unit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_transmittal->Visible) { // item_transmittal ?>
		<td data-name="item_transmittal" <?php echo $ticket_view2_list->item_transmittal->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_item_transmittal">
<span<?php echo $ticket_view2_list->item_transmittal->viewAttributes() ?>><?php echo $ticket_view2_list->item_transmittal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->position->Visible) { // position ?>
		<td data-name="position" <?php echo $ticket_view2_list->position->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_position">
<span<?php echo $ticket_view2_list->position->viewAttributes() ?>><?php echo $ticket_view2_list->position->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->Contact_no->Visible) { // Contact_no ?>
		<td data-name="Contact_no" <?php echo $ticket_view2_list->Contact_no->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_Contact_no">
<span<?php echo $ticket_view2_list->Contact_no->viewAttributes() ?>><?php echo $ticket_view2_list->Contact_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_type->Visible) { // item_type ?>
		<td data-name="item_type" <?php echo $ticket_view2_list->item_type->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_item_type">
<span<?php echo $ticket_view2_list->item_type->viewAttributes() ?>><?php echo $ticket_view2_list->item_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_view2_list->status_desc->Visible) { // status_desc ?>
		<td data-name="status_desc" <?php echo $ticket_view2_list->status_desc->cellAttributes() ?>>
<span id="el<?php echo $ticket_view2_list->RowCount ?>_ticket_view2_status_desc">
<span<?php echo $ticket_view2_list->status_desc->viewAttributes() ?>><?php echo $ticket_view2_list->status_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ticket_view2_list->ListOptions->render("body", "right", $ticket_view2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ticket_view2_list->isGridAdd())
		$ticket_view2_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$ticket_view2->RowType = ROWTYPE_AGGREGATE;
$ticket_view2->resetAttributes();
$ticket_view2_list->renderRow();
?>
<?php if ($ticket_view2_list->TotalRecords > 0 && !$ticket_view2_list->isGridAdd() && !$ticket_view2_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$ticket_view2_list->renderListOptions();

// Render list options (footer, left)
$ticket_view2_list->ListOptions->render("footer", "left");
?>
	<?php if ($ticket_view2_list->SRN->Visible) { // SRN ?>
		<td data-name="SRN" class="<?php echo $ticket_view2_list->SRN->footerCellClass() ?>"><span id="elf_ticket_view2_SRN" class="ticket_view2_SRN">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->__Request->Visible) { // Request ?>
		<td data-name="__Request" class="<?php echo $ticket_view2_list->__Request->footerCellClass() ?>"><span id="elf_ticket_view2___Request" class="ticket_view2___Request">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_date_receive->Visible) { // item_date_receive ?>
		<td data-name="item_date_receive" class="<?php echo $ticket_view2_list->item_date_receive->footerCellClass() ?>"><span id="elf_ticket_view2_item_date_receive" class="ticket_view2_item_date_receive">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" class="<?php echo $ticket_view2_list->employeeid->footerCellClass() ?>"><span id="elf_ticket_view2_employeeid" class="ticket_view2_employeeid">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_requested_unit->Visible) { // item_requested_unit ?>
		<td data-name="item_requested_unit" class="<?php echo $ticket_view2_list->item_requested_unit->footerCellClass() ?>"><span id="elf_ticket_view2_item_requested_unit" class="ticket_view2_item_requested_unit">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_transmittal->Visible) { // item_transmittal ?>
		<td data-name="item_transmittal" class="<?php echo $ticket_view2_list->item_transmittal->footerCellClass() ?>"><span id="elf_ticket_view2_item_transmittal" class="ticket_view2_item_transmittal">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->position->Visible) { // position ?>
		<td data-name="position" class="<?php echo $ticket_view2_list->position->footerCellClass() ?>"><span id="elf_ticket_view2_position" class="ticket_view2_position">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->Contact_no->Visible) { // Contact_no ?>
		<td data-name="Contact_no" class="<?php echo $ticket_view2_list->Contact_no->footerCellClass() ?>"><span id="elf_ticket_view2_Contact_no" class="ticket_view2_Contact_no">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->item_type->Visible) { // item_type ?>
		<td data-name="item_type" class="<?php echo $ticket_view2_list->item_type->footerCellClass() ?>"><span id="elf_ticket_view2_item_type" class="ticket_view2_item_type">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ticket_view2_list->status_desc->Visible) { // status_desc ?>
		<td data-name="status_desc" class="<?php echo $ticket_view2_list->status_desc->footerCellClass() ?>"><span id="elf_ticket_view2_status_desc" class="ticket_view2_status_desc">
		<span class="ew-aggregate"><?php echo $Language->phrase("COUNT") ?></span><span class="ew-aggregate-value">
		<?php echo $ticket_view2_list->status_desc->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$ticket_view2_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ticket_view2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ticket_view2_list->Recordset)
	$ticket_view2_list->Recordset->Close();
?>
<?php if (!$ticket_view2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $ticket_view2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ticket_view2_list->TotalRecords == 0 && !$ticket_view2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ticket_view2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ticket_view2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_view2_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	function refreshTable(){tableRefresh=setInterval(function(){$("table.ew-table > tbody").load(location.href+" table.ew-table > tbody tr",function(){$(this).find("tr:even").removeClass("ew-table-alt-row").addClass("ew-table-row"),$(this).find("tr:odd").removeClass("ew-table-row").addClass("ew-table-alt-row")})},1e3)}$("body").addClass("sidebar-collapse"),refreshTable();
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$ticket_view2_list->terminate();
?>