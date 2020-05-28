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
$tbl_supplies_delete = new tbl_supplies_delete();

// Run the page
$tbl_supplies_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_suppliesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_suppliesdelete = currentForm = new ew.Form("ftbl_suppliesdelete", "delete");
	loadjs.done("ftbl_suppliesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_supplies_delete->showPageHeader(); ?>
<?php
$tbl_supplies_delete->showMessage();
?>
<form name="ftbl_suppliesdelete" id="ftbl_suppliesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_supplies_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_supplies_delete->supplies_cat->Visible) { // supplies_cat ?>
		<th class="<?php echo $tbl_supplies_delete->supplies_cat->headerCellClass() ?>"><span id="elh_tbl_supplies_supplies_cat" class="tbl_supplies_supplies_cat"><?php echo $tbl_supplies_delete->supplies_cat->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->model->Visible) { // model ?>
		<th class="<?php echo $tbl_supplies_delete->model->headerCellClass() ?>"><span id="elh_tbl_supplies_model" class="tbl_supplies_model"><?php echo $tbl_supplies_delete->model->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->serial->Visible) { // serial ?>
		<th class="<?php echo $tbl_supplies_delete->serial->headerCellClass() ?>"><span id="elh_tbl_supplies_serial" class="tbl_supplies_serial"><?php echo $tbl_supplies_delete->serial->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->status->Visible) { // status ?>
		<th class="<?php echo $tbl_supplies_delete->status->headerCellClass() ?>"><span id="elh_tbl_supplies_status" class="tbl_supplies_status"><?php echo $tbl_supplies_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->date_received->Visible) { // date_received ?>
		<th class="<?php echo $tbl_supplies_delete->date_received->headerCellClass() ?>"><span id="elh_tbl_supplies_date_received" class="tbl_supplies_date_received"><?php echo $tbl_supplies_delete->date_received->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->date_consumed->Visible) { // date_consumed ?>
		<th class="<?php echo $tbl_supplies_delete->date_consumed->headerCellClass() ?>"><span id="elh_tbl_supplies_date_consumed" class="tbl_supplies_date_consumed"><?php echo $tbl_supplies_delete->date_consumed->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->Supplier->Visible) { // Supplier ?>
		<th class="<?php echo $tbl_supplies_delete->Supplier->headerCellClass() ?>"><span id="elh_tbl_supplies_Supplier" class="tbl_supplies_Supplier"><?php echo $tbl_supplies_delete->Supplier->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->employeeid->Visible) { // employeeid ?>
		<th class="<?php echo $tbl_supplies_delete->employeeid->headerCellClass() ?>"><span id="elh_tbl_supplies_employeeid" class="tbl_supplies_employeeid"><?php echo $tbl_supplies_delete->employeeid->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->user_last_modify->Visible) { // user_last_modify ?>
		<th class="<?php echo $tbl_supplies_delete->user_last_modify->headerCellClass() ?>"><span id="elh_tbl_supplies_user_last_modify" class="tbl_supplies_user_last_modify"><?php echo $tbl_supplies_delete->user_last_modify->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_delete->user_date_modify->Visible) { // user_date_modify ?>
		<th class="<?php echo $tbl_supplies_delete->user_date_modify->headerCellClass() ?>"><span id="elh_tbl_supplies_user_date_modify" class="tbl_supplies_user_date_modify"><?php echo $tbl_supplies_delete->user_date_modify->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_supplies_delete->RecordCount = 0;
$i = 0;
while (!$tbl_supplies_delete->Recordset->EOF) {
	$tbl_supplies_delete->RecordCount++;
	$tbl_supplies_delete->RowCount++;

	// Set row properties
	$tbl_supplies->resetAttributes();
	$tbl_supplies->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_supplies_delete->loadRowValues($tbl_supplies_delete->Recordset);

	// Render row
	$tbl_supplies_delete->renderRow();
?>
	<tr <?php echo $tbl_supplies->rowAttributes() ?>>
<?php if ($tbl_supplies_delete->supplies_cat->Visible) { // supplies_cat ?>
		<td <?php echo $tbl_supplies_delete->supplies_cat->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_supplies_cat" class="tbl_supplies_supplies_cat">
<span<?php echo $tbl_supplies_delete->supplies_cat->viewAttributes() ?>><?php echo $tbl_supplies_delete->supplies_cat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->model->Visible) { // model ?>
		<td <?php echo $tbl_supplies_delete->model->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_model" class="tbl_supplies_model">
<span<?php echo $tbl_supplies_delete->model->viewAttributes() ?>><?php echo $tbl_supplies_delete->model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->serial->Visible) { // serial ?>
		<td <?php echo $tbl_supplies_delete->serial->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_serial" class="tbl_supplies_serial">
<span<?php echo $tbl_supplies_delete->serial->viewAttributes() ?>><?php echo $tbl_supplies_delete->serial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->status->Visible) { // status ?>
		<td <?php echo $tbl_supplies_delete->status->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_status" class="tbl_supplies_status">
<span<?php echo $tbl_supplies_delete->status->viewAttributes() ?>><?php echo $tbl_supplies_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->date_received->Visible) { // date_received ?>
		<td <?php echo $tbl_supplies_delete->date_received->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_date_received" class="tbl_supplies_date_received">
<span<?php echo $tbl_supplies_delete->date_received->viewAttributes() ?>><?php echo $tbl_supplies_delete->date_received->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->date_consumed->Visible) { // date_consumed ?>
		<td <?php echo $tbl_supplies_delete->date_consumed->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_date_consumed" class="tbl_supplies_date_consumed">
<span<?php echo $tbl_supplies_delete->date_consumed->viewAttributes() ?>><?php echo $tbl_supplies_delete->date_consumed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->Supplier->Visible) { // Supplier ?>
		<td <?php echo $tbl_supplies_delete->Supplier->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_Supplier" class="tbl_supplies_Supplier">
<span<?php echo $tbl_supplies_delete->Supplier->viewAttributes() ?>><?php echo $tbl_supplies_delete->Supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->employeeid->Visible) { // employeeid ?>
		<td <?php echo $tbl_supplies_delete->employeeid->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_employeeid" class="tbl_supplies_employeeid">
<span<?php echo $tbl_supplies_delete->employeeid->viewAttributes() ?>><?php echo $tbl_supplies_delete->employeeid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->user_last_modify->Visible) { // user_last_modify ?>
		<td <?php echo $tbl_supplies_delete->user_last_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_user_last_modify" class="tbl_supplies_user_last_modify">
<span<?php echo $tbl_supplies_delete->user_last_modify->viewAttributes() ?>><?php echo $tbl_supplies_delete->user_last_modify->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_delete->user_date_modify->Visible) { // user_date_modify ?>
		<td <?php echo $tbl_supplies_delete->user_date_modify->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_delete->RowCount ?>_tbl_supplies_user_date_modify" class="tbl_supplies_user_date_modify">
<span<?php echo $tbl_supplies_delete->user_date_modify->viewAttributes() ?>><?php echo $tbl_supplies_delete->user_date_modify->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_supplies_delete->Recordset->moveNext();
}
$tbl_supplies_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_supplies_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_supplies_delete->showPageFooter();
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
$tbl_supplies_delete->terminate();
?>