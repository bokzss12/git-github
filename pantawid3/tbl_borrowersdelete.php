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
$tbl_borrowers_delete = new tbl_borrowers_delete();

// Run the page
$tbl_borrowers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_borrowers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_borrowersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_borrowersdelete = currentForm = new ew.Form("ftbl_borrowersdelete", "delete");
	loadjs.done("ftbl_borrowersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_borrowers_delete->showPageHeader(); ?>
<?php
$tbl_borrowers_delete->showMessage();
?>
<form name="ftbl_borrowersdelete" id="ftbl_borrowersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_borrowers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_borrowers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_borrowers_delete->Date_Barrowed->Visible) { // Date_Barrowed ?>
		<th class="<?php echo $tbl_borrowers_delete->Date_Barrowed->headerCellClass() ?>"><span id="elh_tbl_borrowers_Date_Barrowed" class="tbl_borrowers_Date_Barrowed"><?php echo $tbl_borrowers_delete->Date_Barrowed->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->Date_Returned->Visible) { // Date_Returned ?>
		<th class="<?php echo $tbl_borrowers_delete->Date_Returned->headerCellClass() ?>"><span id="elh_tbl_borrowers_Date_Returned" class="tbl_borrowers_Date_Returned"><?php echo $tbl_borrowers_delete->Date_Returned->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->item_type->Visible) { // item_type ?>
		<th class="<?php echo $tbl_borrowers_delete->item_type->headerCellClass() ?>"><span id="elh_tbl_borrowers_item_type" class="tbl_borrowers_item_type"><?php echo $tbl_borrowers_delete->item_type->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->item_model->Visible) { // item_model ?>
		<th class="<?php echo $tbl_borrowers_delete->item_model->headerCellClass() ?>"><span id="elh_tbl_borrowers_item_model" class="tbl_borrowers_item_model"><?php echo $tbl_borrowers_delete->item_model->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->item_serial->Visible) { // item_serial ?>
		<th class="<?php echo $tbl_borrowers_delete->item_serial->headerCellClass() ?>"><span id="elh_tbl_borrowers_item_serial" class="tbl_borrowers_item_serial"><?php echo $tbl_borrowers_delete->item_serial->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->name_barrowers->Visible) { // name_barrowers ?>
		<th class="<?php echo $tbl_borrowers_delete->name_barrowers->headerCellClass() ?>"><span id="elh_tbl_borrowers_name_barrowers" class="tbl_borrowers_name_barrowers"><?php echo $tbl_borrowers_delete->name_barrowers->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->Designation->Visible) { // Designation ?>
		<th class="<?php echo $tbl_borrowers_delete->Designation->headerCellClass() ?>"><span id="elh_tbl_borrowers_Designation" class="tbl_borrowers_Designation"><?php echo $tbl_borrowers_delete->Designation->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->office_id->Visible) { // office_id ?>
		<th class="<?php echo $tbl_borrowers_delete->office_id->headerCellClass() ?>"><span id="elh_tbl_borrowers_office_id" class="tbl_borrowers_office_id"><?php echo $tbl_borrowers_delete->office_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_borrowers_delete->status->Visible) { // status ?>
		<th class="<?php echo $tbl_borrowers_delete->status->headerCellClass() ?>"><span id="elh_tbl_borrowers_status" class="tbl_borrowers_status"><?php echo $tbl_borrowers_delete->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_borrowers_delete->RecordCount = 0;
$i = 0;
while (!$tbl_borrowers_delete->Recordset->EOF) {
	$tbl_borrowers_delete->RecordCount++;
	$tbl_borrowers_delete->RowCount++;

	// Set row properties
	$tbl_borrowers->resetAttributes();
	$tbl_borrowers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_borrowers_delete->loadRowValues($tbl_borrowers_delete->Recordset);

	// Render row
	$tbl_borrowers_delete->renderRow();
?>
	<tr <?php echo $tbl_borrowers->rowAttributes() ?>>
<?php if ($tbl_borrowers_delete->Date_Barrowed->Visible) { // Date_Barrowed ?>
		<td <?php echo $tbl_borrowers_delete->Date_Barrowed->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_Date_Barrowed" class="tbl_borrowers_Date_Barrowed">
<span<?php echo $tbl_borrowers_delete->Date_Barrowed->viewAttributes() ?>><?php echo $tbl_borrowers_delete->Date_Barrowed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->Date_Returned->Visible) { // Date_Returned ?>
		<td <?php echo $tbl_borrowers_delete->Date_Returned->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_Date_Returned" class="tbl_borrowers_Date_Returned">
<span<?php echo $tbl_borrowers_delete->Date_Returned->viewAttributes() ?>><?php echo $tbl_borrowers_delete->Date_Returned->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->item_type->Visible) { // item_type ?>
		<td <?php echo $tbl_borrowers_delete->item_type->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_item_type" class="tbl_borrowers_item_type">
<span<?php echo $tbl_borrowers_delete->item_type->viewAttributes() ?>><?php echo $tbl_borrowers_delete->item_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->item_model->Visible) { // item_model ?>
		<td <?php echo $tbl_borrowers_delete->item_model->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_item_model" class="tbl_borrowers_item_model">
<span<?php echo $tbl_borrowers_delete->item_model->viewAttributes() ?>><?php echo $tbl_borrowers_delete->item_model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->item_serial->Visible) { // item_serial ?>
		<td <?php echo $tbl_borrowers_delete->item_serial->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_item_serial" class="tbl_borrowers_item_serial">
<span<?php echo $tbl_borrowers_delete->item_serial->viewAttributes() ?>><?php echo $tbl_borrowers_delete->item_serial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->name_barrowers->Visible) { // name_barrowers ?>
		<td <?php echo $tbl_borrowers_delete->name_barrowers->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_name_barrowers" class="tbl_borrowers_name_barrowers">
<span<?php echo $tbl_borrowers_delete->name_barrowers->viewAttributes() ?>><?php echo $tbl_borrowers_delete->name_barrowers->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->Designation->Visible) { // Designation ?>
		<td <?php echo $tbl_borrowers_delete->Designation->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_Designation" class="tbl_borrowers_Designation">
<span<?php echo $tbl_borrowers_delete->Designation->viewAttributes() ?>><?php echo $tbl_borrowers_delete->Designation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->office_id->Visible) { // office_id ?>
		<td <?php echo $tbl_borrowers_delete->office_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_office_id" class="tbl_borrowers_office_id">
<span<?php echo $tbl_borrowers_delete->office_id->viewAttributes() ?>><?php echo $tbl_borrowers_delete->office_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_borrowers_delete->status->Visible) { // status ?>
		<td <?php echo $tbl_borrowers_delete->status->cellAttributes() ?>>
<span id="el<?php echo $tbl_borrowers_delete->RowCount ?>_tbl_borrowers_status" class="tbl_borrowers_status">
<span<?php echo $tbl_borrowers_delete->status->viewAttributes() ?>><?php echo $tbl_borrowers_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_borrowers_delete->Recordset->moveNext();
}
$tbl_borrowers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_borrowers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_borrowers_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_borrowers_delete->terminate();
?>