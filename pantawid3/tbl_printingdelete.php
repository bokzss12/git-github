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
$tbl_printing_delete = new tbl_printing_delete();

// Run the page
$tbl_printing_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printing_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_printingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_printingdelete = currentForm = new ew.Form("ftbl_printingdelete", "delete");
	loadjs.done("ftbl_printingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_printing_delete->showPageHeader(); ?>
<?php
$tbl_printing_delete->showMessage();
?>
<form name="ftbl_printingdelete" id="ftbl_printingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printing">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_printing_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_printing_delete->printing_date->Visible) { // printing_date ?>
		<th class="<?php echo $tbl_printing_delete->printing_date->headerCellClass() ?>"><span id="elh_tbl_printing_printing_date" class="tbl_printing_printing_date"><?php echo $tbl_printing_delete->printing_date->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printing_delete->printing_type->Visible) { // printing_type ?>
		<th class="<?php echo $tbl_printing_delete->printing_type->headerCellClass() ?>"><span id="elh_tbl_printing_printing_type" class="tbl_printing_printing_type"><?php echo $tbl_printing_delete->printing_type->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printing_delete->printed_forms->Visible) { // printed_forms ?>
		<th class="<?php echo $tbl_printing_delete->printed_forms->headerCellClass() ?>"><span id="elh_tbl_printing_printed_forms" class="tbl_printing_printed_forms"><?php echo $tbl_printing_delete->printed_forms->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printing_delete->total_forms->Visible) { // total_forms ?>
		<th class="<?php echo $tbl_printing_delete->total_forms->headerCellClass() ?>"><span id="elh_tbl_printing_total_forms" class="tbl_printing_total_forms"><?php echo $tbl_printing_delete->total_forms->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printing_delete->status_printing->Visible) { // status_printing ?>
		<th class="<?php echo $tbl_printing_delete->status_printing->headerCellClass() ?>"><span id="elh_tbl_printing_status_printing" class="tbl_printing_status_printing"><?php echo $tbl_printing_delete->status_printing->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printing_delete->employee_id->Visible) { // employee_id ?>
		<th class="<?php echo $tbl_printing_delete->employee_id->headerCellClass() ?>"><span id="elh_tbl_printing_employee_id" class="tbl_printing_employee_id"><?php echo $tbl_printing_delete->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printing_delete->user_last_modify->Visible) { // user_last_modify ?>
		<th class="<?php echo $tbl_printing_delete->user_last_modify->headerCellClass() ?>"><span id="elh_tbl_printing_user_last_modify" class="tbl_printing_user_last_modify"><?php echo $tbl_printing_delete->user_last_modify->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printing_delete->date_last_modify->Visible) { // date_last_modify ?>
		<th class="<?php echo $tbl_printing_delete->date_last_modify->headerCellClass() ?>"><span id="elh_tbl_printing_date_last_modify" class="tbl_printing_date_last_modify"><?php echo $tbl_printing_delete->date_last_modify->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_printing_delete->RecordCount = 0;
$i = 0;
while (!$tbl_printing_delete->Recordset->EOF) {
	$tbl_printing_delete->RecordCount++;
	$tbl_printing_delete->RowCount++;

	// Set row properties
	$tbl_printing->resetAttributes();
	$tbl_printing->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_printing_delete->loadRowValues($tbl_printing_delete->Recordset);

	// Render row
	$tbl_printing_delete->renderRow();
?>
	<tr <?php echo $tbl_printing->rowAttributes() ?>>
<?php if ($tbl_printing_delete->printing_date->Visible) { // printing_date ?>
		<td <?php echo $tbl_printing_delete->printing_date->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_printing_date" class="tbl_printing_printing_date">
<span<?php echo $tbl_printing_delete->printing_date->viewAttributes() ?>><?php echo $tbl_printing_delete->printing_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printing_delete->printing_type->Visible) { // printing_type ?>
		<td <?php echo $tbl_printing_delete->printing_type->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_printing_type" class="tbl_printing_printing_type">
<span<?php echo $tbl_printing_delete->printing_type->viewAttributes() ?>><?php echo $tbl_printing_delete->printing_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printing_delete->printed_forms->Visible) { // printed_forms ?>
		<td <?php echo $tbl_printing_delete->printed_forms->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_printed_forms" class="tbl_printing_printed_forms">
<span<?php echo $tbl_printing_delete->printed_forms->viewAttributes() ?>><?php echo $tbl_printing_delete->printed_forms->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printing_delete->total_forms->Visible) { // total_forms ?>
		<td <?php echo $tbl_printing_delete->total_forms->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_total_forms" class="tbl_printing_total_forms">
<span<?php echo $tbl_printing_delete->total_forms->viewAttributes() ?>><?php echo $tbl_printing_delete->total_forms->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printing_delete->status_printing->Visible) { // status_printing ?>
		<td <?php echo $tbl_printing_delete->status_printing->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_status_printing" class="tbl_printing_status_printing">
<span<?php echo $tbl_printing_delete->status_printing->viewAttributes() ?>><?php echo $tbl_printing_delete->status_printing->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printing_delete->employee_id->Visible) { // employee_id ?>
		<td <?php echo $tbl_printing_delete->employee_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_employee_id" class="tbl_printing_employee_id">
<span<?php echo $tbl_printing_delete->employee_id->viewAttributes() ?>><?php echo $tbl_printing_delete->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printing_delete->user_last_modify->Visible) { // user_last_modify ?>
		<td <?php echo $tbl_printing_delete->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_user_last_modify" class="tbl_printing_user_last_modify">
<span<?php echo $tbl_printing_delete->user_last_modify->viewAttributes() ?>><?php echo $tbl_printing_delete->user_last_modify->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printing_delete->date_last_modify->Visible) { // date_last_modify ?>
		<td <?php echo $tbl_printing_delete->date_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_printing_delete->RowCount ?>_tbl_printing_date_last_modify" class="tbl_printing_date_last_modify">
<span<?php echo $tbl_printing_delete->date_last_modify->viewAttributes() ?>><?php echo $tbl_printing_delete->date_last_modify->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_printing_delete->Recordset->moveNext();
}
$tbl_printing_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_printing_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_printing_delete->showPageFooter();
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
$tbl_printing_delete->terminate();
?>