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
$tbl_inventory_delete = new tbl_inventory_delete();

// Run the page
$tbl_inventory_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_inventorydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_inventorydelete = currentForm = new ew.Form("ftbl_inventorydelete", "delete");
	loadjs.done("ftbl_inventorydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_inventory_delete->showPageHeader(); ?>
<?php
$tbl_inventory_delete->showMessage();
?>
<form name="ftbl_inventorydelete" id="ftbl_inventorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_inventory_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_inventory_delete->concat_inventory->Visible) { // concat_inventory ?>
		<th class="<?php echo $tbl_inventory_delete->concat_inventory->headerCellClass() ?>"><span id="elh_tbl_inventory_concat_inventory" class="tbl_inventory_concat_inventory"><?php echo $tbl_inventory_delete->concat_inventory->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory_delete->item_model->Visible) { // item_model ?>
		<th class="<?php echo $tbl_inventory_delete->item_model->headerCellClass() ?>"><span id="elh_tbl_inventory_item_model" class="tbl_inventory_item_model"><?php echo $tbl_inventory_delete->item_model->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory_delete->item_serial->Visible) { // item_serial ?>
		<th class="<?php echo $tbl_inventory_delete->item_serial->headerCellClass() ?>"><span id="elh_tbl_inventory_item_serial" class="tbl_inventory_item_serial"><?php echo $tbl_inventory_delete->item_serial->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory_delete->office_id->Visible) { // office_id ?>
		<th class="<?php echo $tbl_inventory_delete->office_id->headerCellClass() ?>"><span id="elh_tbl_inventory_office_id" class="tbl_inventory_office_id"><?php echo $tbl_inventory_delete->office_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory_delete->name_accountable->Visible) { // name_accountable ?>
		<th class="<?php echo $tbl_inventory_delete->name_accountable->headerCellClass() ?>"><span id="elh_tbl_inventory_name_accountable" class="tbl_inventory_name_accountable"><?php echo $tbl_inventory_delete->name_accountable->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory_delete->Designation->Visible) { // Designation ?>
		<th class="<?php echo $tbl_inventory_delete->Designation->headerCellClass() ?>"><span id="elh_tbl_inventory_Designation" class="tbl_inventory_Designation"><?php echo $tbl_inventory_delete->Designation->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory_delete->status->Visible) { // status ?>
		<th class="<?php echo $tbl_inventory_delete->status->headerCellClass() ?>"><span id="elh_tbl_inventory_status" class="tbl_inventory_status"><?php echo $tbl_inventory_delete->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_inventory_delete->RecordCount = 0;
$i = 0;
while (!$tbl_inventory_delete->Recordset->EOF) {
	$tbl_inventory_delete->RecordCount++;
	$tbl_inventory_delete->RowCount++;

	// Set row properties
	$tbl_inventory->resetAttributes();
	$tbl_inventory->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_inventory_delete->loadRowValues($tbl_inventory_delete->Recordset);

	// Render row
	$tbl_inventory_delete->renderRow();
?>
	<tr <?php echo $tbl_inventory->rowAttributes() ?>>
<?php if ($tbl_inventory_delete->concat_inventory->Visible) { // concat_inventory ?>
		<td <?php echo $tbl_inventory_delete->concat_inventory->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCount ?>_tbl_inventory_concat_inventory" class="tbl_inventory_concat_inventory">
<span<?php echo $tbl_inventory_delete->concat_inventory->viewAttributes() ?>><?php if (!EmptyString($tbl_inventory_delete->concat_inventory->getViewValue()) && $tbl_inventory_delete->concat_inventory->linkAttributes() != "") { ?>
<a<?php echo $tbl_inventory_delete->concat_inventory->linkAttributes() ?>><?php echo $tbl_inventory_delete->concat_inventory->getViewValue() ?></a>
<?php } else { ?>
<?php echo $tbl_inventory_delete->concat_inventory->getViewValue() ?>
<?php } ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory_delete->item_model->Visible) { // item_model ?>
		<td <?php echo $tbl_inventory_delete->item_model->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCount ?>_tbl_inventory_item_model" class="tbl_inventory_item_model">
<span<?php echo $tbl_inventory_delete->item_model->viewAttributes() ?>><?php echo $tbl_inventory_delete->item_model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory_delete->item_serial->Visible) { // item_serial ?>
		<td <?php echo $tbl_inventory_delete->item_serial->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCount ?>_tbl_inventory_item_serial" class="tbl_inventory_item_serial">
<span<?php echo $tbl_inventory_delete->item_serial->viewAttributes() ?>><?php echo $tbl_inventory_delete->item_serial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory_delete->office_id->Visible) { // office_id ?>
		<td <?php echo $tbl_inventory_delete->office_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCount ?>_tbl_inventory_office_id" class="tbl_inventory_office_id">
<span<?php echo $tbl_inventory_delete->office_id->viewAttributes() ?>><?php echo $tbl_inventory_delete->office_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory_delete->name_accountable->Visible) { // name_accountable ?>
		<td <?php echo $tbl_inventory_delete->name_accountable->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCount ?>_tbl_inventory_name_accountable" class="tbl_inventory_name_accountable">
<span<?php echo $tbl_inventory_delete->name_accountable->viewAttributes() ?>><?php echo $tbl_inventory_delete->name_accountable->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory_delete->Designation->Visible) { // Designation ?>
		<td <?php echo $tbl_inventory_delete->Designation->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCount ?>_tbl_inventory_Designation" class="tbl_inventory_Designation">
<span<?php echo $tbl_inventory_delete->Designation->viewAttributes() ?>><?php echo $tbl_inventory_delete->Designation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory_delete->status->Visible) { // status ?>
		<td <?php echo $tbl_inventory_delete->status->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCount ?>_tbl_inventory_status" class="tbl_inventory_status">
<span<?php echo $tbl_inventory_delete->status->viewAttributes() ?>><?php echo $tbl_inventory_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_inventory_delete->Recordset->moveNext();
}
$tbl_inventory_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_inventory_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_inventory_delete->showPageFooter();
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
$tbl_inventory_delete->terminate();
?>