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
$tbl_repair_list = new tbl_repair_list();

// Run the page
$tbl_repair_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_repair_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_repair_list->isExport()) { ?>
<script>
var ftbl_repairlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_repairlist = currentForm = new ew.Form("ftbl_repairlist", "list");
	ftbl_repairlist.formKeyCountName = '<?php echo $tbl_repair_list->FormKeyCountName ?>';
	loadjs.done("ftbl_repairlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_repair_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_repair_list->TotalRecords > 0 && $tbl_repair_list->ExportOptions->visible()) { ?>
<?php $tbl_repair_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_repair_list->ImportOptions->visible()) { ?>
<?php $tbl_repair_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_repair_list->isExport() || Config("EXPORT_MASTER_RECORD") && $tbl_repair_list->isExport("print")) { ?>
<?php
if ($tbl_repair_list->DbMasterFilter != "" && $tbl_repair->getCurrentMasterTable() == "tbl_inventory") {
	if ($tbl_repair_list->MasterRecordExists) {
		include_once "tbl_inventorymaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_repair_list->renderOtherOptions();
?>
<?php $tbl_repair_list->showPageHeader(); ?>
<?php
$tbl_repair_list->showMessage();
?>
<?php if ($tbl_repair_list->TotalRecords > 0 || $tbl_repair->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_repair_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_repair">
<form name="ftbl_repairlist" id="ftbl_repairlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_repair">
<?php if ($tbl_repair->getCurrentMasterTable() == "tbl_inventory" && $tbl_repair->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="tbl_inventory">
<input type="hidden" name="fk_item_type" value="<?php echo HtmlEncode($tbl_repair_list->itemtype->getSessionValue()) ?>">
<input type="hidden" name="fk_item_model" value="<?php echo HtmlEncode($tbl_repair_list->itemmodel->getSessionValue()) ?>">
<input type="hidden" name="fk_item_serial" value="<?php echo HtmlEncode($tbl_repair_list->item_serial->getSessionValue()) ?>">
<input type="hidden" name="fk_office_id" value="<?php echo HtmlEncode($tbl_repair_list->office_id->getSessionValue()) ?>">
<input type="hidden" name="fk_name_accountable" value="<?php echo HtmlEncode($tbl_repair_list->name_accountable->getSessionValue()) ?>">
<input type="hidden" name="fk_Designation" value="<?php echo HtmlEncode($tbl_repair_list->Designation->getSessionValue()) ?>">
<input type="hidden" name="fk_Region" value="<?php echo HtmlEncode($tbl_repair_list->region->getSessionValue()) ?>">
<input type="hidden" name="fk_Province" value="<?php echo HtmlEncode($tbl_repair_list->province->getSessionValue()) ?>">
<input type="hidden" name="fk_Cities" value="<?php echo HtmlEncode($tbl_repair_list->city->getSessionValue()) ?>">
<input type="hidden" name="fk_concat_inventory" value="<?php echo HtmlEncode($tbl_repair_list->inventory_id->getSessionValue()) ?>">
<input type="hidden" name="fk_inventory_id" value="<?php echo HtmlEncode($tbl_repair_list->inventory_idr->getSessionValue()) ?>">
<input type="hidden" name="fk_Current_Location" value="<?php echo HtmlEncode($tbl_repair_list->current_loc_r->getSessionValue()) ?>">
<input type="hidden" name="fk_Last_Date_Check" value="<?php echo HtmlEncode($tbl_repair_list->date_received->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_tbl_repair" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_repair_list->TotalRecords > 0 || $tbl_repair_list->isGridEdit()) { ?>
<table id="tbl_tbl_repairlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_repair->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_repair_list->renderListOptions();

// Render list options (header, left)
$tbl_repair_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_repair_list->inventory_id->Visible) { // inventory_id ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->inventory_id) == "") { ?>
		<th data-name="inventory_id" class="<?php echo $tbl_repair_list->inventory_id->headerCellClass() ?>"><div id="elh_tbl_repair_inventory_id" class="tbl_repair_inventory_id"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->inventory_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_id" class="<?php echo $tbl_repair_list->inventory_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->inventory_id) ?>', 1);"><div id="elh_tbl_repair_inventory_id" class="tbl_repair_inventory_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->inventory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_list->inventory_idr->Visible) { // inventory_idr ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->inventory_idr) == "") { ?>
		<th data-name="inventory_idr" class="<?php echo $tbl_repair_list->inventory_idr->headerCellClass() ?>"><div id="elh_tbl_repair_inventory_idr" class="tbl_repair_inventory_idr"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->inventory_idr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_idr" class="<?php echo $tbl_repair_list->inventory_idr->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->inventory_idr) ?>', 1);"><div id="elh_tbl_repair_inventory_idr" class="tbl_repair_inventory_idr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->inventory_idr->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->inventory_idr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->inventory_idr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_list->date_repaired->Visible) { // date_repaired ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->date_repaired) == "") { ?>
		<th data-name="date_repaired" class="<?php echo $tbl_repair_list->date_repaired->headerCellClass() ?>"><div id="elh_tbl_repair_date_repaired" class="tbl_repair_date_repaired"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->date_repaired->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_repaired" class="<?php echo $tbl_repair_list->date_repaired->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->date_repaired) ?>', 1);"><div id="elh_tbl_repair_date_repaired" class="tbl_repair_date_repaired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->date_repaired->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->date_repaired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->date_repaired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_list->type_problem->Visible) { // type_problem ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->type_problem) == "") { ?>
		<th data-name="type_problem" class="<?php echo $tbl_repair_list->type_problem->headerCellClass() ?>"><div id="elh_tbl_repair_type_problem" class="tbl_repair_type_problem"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->type_problem->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type_problem" class="<?php echo $tbl_repair_list->type_problem->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->type_problem) ?>', 1);"><div id="elh_tbl_repair_type_problem" class="tbl_repair_type_problem">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->type_problem->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->type_problem->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->type_problem->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_list->action_taken->Visible) { // action_taken ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->action_taken) == "") { ?>
		<th data-name="action_taken" class="<?php echo $tbl_repair_list->action_taken->headerCellClass() ?>"><div id="elh_tbl_repair_action_taken" class="tbl_repair_action_taken"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->action_taken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="action_taken" class="<?php echo $tbl_repair_list->action_taken->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->action_taken) ?>', 1);"><div id="elh_tbl_repair_action_taken" class="tbl_repair_action_taken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->action_taken->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->action_taken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->action_taken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_list->employee_id->Visible) { // employee_id ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->employee_id) == "") { ?>
		<th data-name="employee_id" class="<?php echo $tbl_repair_list->employee_id->headerCellClass() ?>"><div id="elh_tbl_repair_employee_id" class="tbl_repair_employee_id"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->employee_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employee_id" class="<?php echo $tbl_repair_list->employee_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->employee_id) ?>', 1);"><div id="elh_tbl_repair_employee_id" class="tbl_repair_employee_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->employee_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->employee_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->employee_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_list->status_h->Visible) { // status_h ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->status_h) == "") { ?>
		<th data-name="status_h" class="<?php echo $tbl_repair_list->status_h->headerCellClass() ?>"><div id="elh_tbl_repair_status_h" class="tbl_repair_status_h"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->status_h->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_h" class="<?php echo $tbl_repair_list->status_h->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->status_h) ?>', 1);"><div id="elh_tbl_repair_status_h" class="tbl_repair_status_h">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->status_h->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->status_h->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->status_h->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_list->remark->Visible) { // remark ?>
	<?php if ($tbl_repair_list->SortUrl($tbl_repair_list->remark) == "") { ?>
		<th data-name="remark" class="<?php echo $tbl_repair_list->remark->headerCellClass() ?>"><div id="elh_tbl_repair_remark" class="tbl_repair_remark"><div class="ew-table-header-caption"><?php echo $tbl_repair_list->remark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remark" class="<?php echo $tbl_repair_list->remark->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_repair_list->SortUrl($tbl_repair_list->remark) ?>', 1);"><div id="elh_tbl_repair_remark" class="tbl_repair_remark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_list->remark->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_list->remark->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_list->remark->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_repair_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_repair_list->ExportAll && $tbl_repair_list->isExport()) {
	$tbl_repair_list->StopRecord = $tbl_repair_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_repair_list->TotalRecords > $tbl_repair_list->StartRecord + $tbl_repair_list->DisplayRecords - 1)
		$tbl_repair_list->StopRecord = $tbl_repair_list->StartRecord + $tbl_repair_list->DisplayRecords - 1;
	else
		$tbl_repair_list->StopRecord = $tbl_repair_list->TotalRecords;
}
$tbl_repair_list->RecordCount = $tbl_repair_list->StartRecord - 1;
if ($tbl_repair_list->Recordset && !$tbl_repair_list->Recordset->EOF) {
	$tbl_repair_list->Recordset->moveFirst();
	$selectLimit = $tbl_repair_list->UseSelectLimit;
	if (!$selectLimit && $tbl_repair_list->StartRecord > 1)
		$tbl_repair_list->Recordset->move($tbl_repair_list->StartRecord - 1);
} elseif (!$tbl_repair->AllowAddDeleteRow && $tbl_repair_list->StopRecord == 0) {
	$tbl_repair_list->StopRecord = $tbl_repair->GridAddRowCount;
}

// Initialize aggregate
$tbl_repair->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_repair->resetAttributes();
$tbl_repair_list->renderRow();
while ($tbl_repair_list->RecordCount < $tbl_repair_list->StopRecord) {
	$tbl_repair_list->RecordCount++;
	if ($tbl_repair_list->RecordCount >= $tbl_repair_list->StartRecord) {
		$tbl_repair_list->RowCount++;

		// Set up key count
		$tbl_repair_list->KeyCount = $tbl_repair_list->RowIndex;

		// Init row class and style
		$tbl_repair->resetAttributes();
		$tbl_repair->CssClass = "";
		if ($tbl_repair_list->isGridAdd()) {
		} else {
			$tbl_repair_list->loadRowValues($tbl_repair_list->Recordset); // Load row values
		}
		$tbl_repair->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_repair->RowAttrs->merge(["data-rowindex" => $tbl_repair_list->RowCount, "id" => "r" . $tbl_repair_list->RowCount . "_tbl_repair", "data-rowtype" => $tbl_repair->RowType]);

		// Render row
		$tbl_repair_list->renderRow();

		// Render list options
		$tbl_repair_list->renderListOptions();
?>
	<tr <?php echo $tbl_repair->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_repair_list->ListOptions->render("body", "left", $tbl_repair_list->RowCount);
?>
	<?php if ($tbl_repair_list->inventory_id->Visible) { // inventory_id ?>
		<td data-name="inventory_id" <?php echo $tbl_repair_list->inventory_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_inventory_id">
<span<?php echo $tbl_repair_list->inventory_id->viewAttributes() ?>><?php echo $tbl_repair_list->inventory_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_repair_list->inventory_idr->Visible) { // inventory_idr ?>
		<td data-name="inventory_idr" <?php echo $tbl_repair_list->inventory_idr->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_inventory_idr">
<span<?php echo $tbl_repair_list->inventory_idr->viewAttributes() ?>><?php echo $tbl_repair_list->inventory_idr->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_repair_list->date_repaired->Visible) { // date_repaired ?>
		<td data-name="date_repaired" <?php echo $tbl_repair_list->date_repaired->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_date_repaired">
<span<?php echo $tbl_repair_list->date_repaired->viewAttributes() ?>><?php echo $tbl_repair_list->date_repaired->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_repair_list->type_problem->Visible) { // type_problem ?>
		<td data-name="type_problem" <?php echo $tbl_repair_list->type_problem->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_type_problem">
<span<?php echo $tbl_repair_list->type_problem->viewAttributes() ?>><?php echo $tbl_repair_list->type_problem->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_repair_list->action_taken->Visible) { // action_taken ?>
		<td data-name="action_taken" <?php echo $tbl_repair_list->action_taken->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_action_taken">
<span<?php echo $tbl_repair_list->action_taken->viewAttributes() ?>><?php echo $tbl_repair_list->action_taken->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_repair_list->employee_id->Visible) { // employee_id ?>
		<td data-name="employee_id" <?php echo $tbl_repair_list->employee_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_employee_id">
<span<?php echo $tbl_repair_list->employee_id->viewAttributes() ?>><?php echo $tbl_repair_list->employee_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_repair_list->status_h->Visible) { // status_h ?>
		<td data-name="status_h" <?php echo $tbl_repair_list->status_h->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_status_h">
<span<?php echo $tbl_repair_list->status_h->viewAttributes() ?>><?php echo $tbl_repair_list->status_h->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_repair_list->remark->Visible) { // remark ?>
		<td data-name="remark" <?php echo $tbl_repair_list->remark->cellAttributes() ?>>
<span id="el<?php echo $tbl_repair_list->RowCount ?>_tbl_repair_remark">
<span<?php echo $tbl_repair_list->remark->viewAttributes() ?>><?php echo $tbl_repair_list->remark->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_repair_list->ListOptions->render("body", "right", $tbl_repair_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_repair_list->isGridAdd())
		$tbl_repair_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_repair->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_repair_list->Recordset)
	$tbl_repair_list->Recordset->Close();
?>
<?php if (!$tbl_repair_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_repair_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_repair_list->TotalRecords == 0 && !$tbl_repair->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_repair_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_repair_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_repair_list->isExport()) { ?>
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
$tbl_repair_list->terminate();
?>