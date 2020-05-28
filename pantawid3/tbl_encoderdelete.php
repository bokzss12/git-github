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
$tbl_encoder_delete = new tbl_encoder_delete();

// Run the page
$tbl_encoder_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_encoderdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_encoderdelete = currentForm = new ew.Form("ftbl_encoderdelete", "delete");
	loadjs.done("ftbl_encoderdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_encoder_delete->showPageHeader(); ?>
<?php
$tbl_encoder_delete->showMessage();
?>
<form name="ftbl_encoderdelete" id="ftbl_encoderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_encoder_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_encoder_delete->date->Visible) { // date ?>
		<th class="<?php echo $tbl_encoder_delete->date->headerCellClass() ?>"><span id="elh_tbl_encoder_date" class="tbl_encoder_date"><?php echo $tbl_encoder_delete->date->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_delete->activities->Visible) { // activities ?>
		<th class="<?php echo $tbl_encoder_delete->activities->headerCellClass() ?>"><span id="elh_tbl_encoder_activities" class="tbl_encoder_activities"><?php echo $tbl_encoder_delete->activities->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_delete->action_taken->Visible) { // action_taken ?>
		<th class="<?php echo $tbl_encoder_delete->action_taken->headerCellClass() ?>"><span id="elh_tbl_encoder_action_taken" class="tbl_encoder_action_taken"><?php echo $tbl_encoder_delete->action_taken->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_delete->total_encoded->Visible) { // total_encoded ?>
		<th class="<?php echo $tbl_encoder_delete->total_encoded->headerCellClass() ?>"><span id="elh_tbl_encoder_total_encoded" class="tbl_encoder_total_encoded"><?php echo $tbl_encoder_delete->total_encoded->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_delete->status_remark->Visible) { // status_remark ?>
		<th class="<?php echo $tbl_encoder_delete->status_remark->headerCellClass() ?>"><span id="elh_tbl_encoder_status_remark" class="tbl_encoder_status_remark"><?php echo $tbl_encoder_delete->status_remark->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_delete->employee_id->Visible) { // employee_id ?>
		<th class="<?php echo $tbl_encoder_delete->employee_id->headerCellClass() ?>"><span id="elh_tbl_encoder_employee_id" class="tbl_encoder_employee_id"><?php echo $tbl_encoder_delete->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_delete->user_last_modify->Visible) { // user_last_modify ?>
		<th class="<?php echo $tbl_encoder_delete->user_last_modify->headerCellClass() ?>"><span id="elh_tbl_encoder_user_last_modify" class="tbl_encoder_user_last_modify"><?php echo $tbl_encoder_delete->user_last_modify->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_delete->date_last_modify->Visible) { // date_last_modify ?>
		<th class="<?php echo $tbl_encoder_delete->date_last_modify->headerCellClass() ?>"><span id="elh_tbl_encoder_date_last_modify" class="tbl_encoder_date_last_modify"><?php echo $tbl_encoder_delete->date_last_modify->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_encoder_delete->RecordCount = 0;
$i = 0;
while (!$tbl_encoder_delete->Recordset->EOF) {
	$tbl_encoder_delete->RecordCount++;
	$tbl_encoder_delete->RowCount++;

	// Set row properties
	$tbl_encoder->resetAttributes();
	$tbl_encoder->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_encoder_delete->loadRowValues($tbl_encoder_delete->Recordset);

	// Render row
	$tbl_encoder_delete->renderRow();
?>
	<tr <?php echo $tbl_encoder->rowAttributes() ?>>
<?php if ($tbl_encoder_delete->date->Visible) { // date ?>
		<td <?php echo $tbl_encoder_delete->date->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_date" class="tbl_encoder_date">
<span<?php echo $tbl_encoder_delete->date->viewAttributes() ?>><?php echo $tbl_encoder_delete->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_delete->activities->Visible) { // activities ?>
		<td <?php echo $tbl_encoder_delete->activities->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_activities" class="tbl_encoder_activities">
<span<?php echo $tbl_encoder_delete->activities->viewAttributes() ?>><?php echo $tbl_encoder_delete->activities->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_delete->action_taken->Visible) { // action_taken ?>
		<td <?php echo $tbl_encoder_delete->action_taken->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_action_taken" class="tbl_encoder_action_taken">
<span<?php echo $tbl_encoder_delete->action_taken->viewAttributes() ?>><?php echo $tbl_encoder_delete->action_taken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_delete->total_encoded->Visible) { // total_encoded ?>
		<td <?php echo $tbl_encoder_delete->total_encoded->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_total_encoded" class="tbl_encoder_total_encoded">
<span<?php echo $tbl_encoder_delete->total_encoded->viewAttributes() ?>><?php echo $tbl_encoder_delete->total_encoded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_delete->status_remark->Visible) { // status_remark ?>
		<td <?php echo $tbl_encoder_delete->status_remark->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_status_remark" class="tbl_encoder_status_remark">
<span<?php echo $tbl_encoder_delete->status_remark->viewAttributes() ?>><?php echo $tbl_encoder_delete->status_remark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_delete->employee_id->Visible) { // employee_id ?>
		<td <?php echo $tbl_encoder_delete->employee_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_employee_id" class="tbl_encoder_employee_id">
<span<?php echo $tbl_encoder_delete->employee_id->viewAttributes() ?>><?php echo $tbl_encoder_delete->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_delete->user_last_modify->Visible) { // user_last_modify ?>
		<td <?php echo $tbl_encoder_delete->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_user_last_modify" class="tbl_encoder_user_last_modify">
<span<?php echo $tbl_encoder_delete->user_last_modify->viewAttributes() ?>><?php echo $tbl_encoder_delete->user_last_modify->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_delete->date_last_modify->Visible) { // date_last_modify ?>
		<td <?php echo $tbl_encoder_delete->date_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_delete->RowCount ?>_tbl_encoder_date_last_modify" class="tbl_encoder_date_last_modify">
<span<?php echo $tbl_encoder_delete->date_last_modify->viewAttributes() ?>><?php echo $tbl_encoder_delete->date_last_modify->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_encoder_delete->Recordset->moveNext();
}
$tbl_encoder_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_encoder_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_encoder_delete->showPageFooter();
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
$tbl_encoder_delete->terminate();
?>