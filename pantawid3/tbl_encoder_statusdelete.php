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
$tbl_encoder_status_delete = new tbl_encoder_status_delete();

// Run the page
$tbl_encoder_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_encoder_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_encoder_statusdelete = currentForm = new ew.Form("ftbl_encoder_statusdelete", "delete");
	loadjs.done("ftbl_encoder_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_encoder_status_delete->showPageHeader(); ?>
<?php
$tbl_encoder_status_delete->showMessage();
?>
<form name="ftbl_encoder_statusdelete" id="ftbl_encoder_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_encoder_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_encoder_status_delete->status_enc_id->Visible) { // status_enc_id ?>
		<th class="<?php echo $tbl_encoder_status_delete->status_enc_id->headerCellClass() ?>"><span id="elh_tbl_encoder_status_status_enc_id" class="tbl_encoder_status_status_enc_id"><?php echo $tbl_encoder_status_delete->status_enc_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_encoder_status_delete->status_remark->Visible) { // status_remark ?>
		<th class="<?php echo $tbl_encoder_status_delete->status_remark->headerCellClass() ?>"><span id="elh_tbl_encoder_status_status_remark" class="tbl_encoder_status_status_remark"><?php echo $tbl_encoder_status_delete->status_remark->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_encoder_status_delete->RecordCount = 0;
$i = 0;
while (!$tbl_encoder_status_delete->Recordset->EOF) {
	$tbl_encoder_status_delete->RecordCount++;
	$tbl_encoder_status_delete->RowCount++;

	// Set row properties
	$tbl_encoder_status->resetAttributes();
	$tbl_encoder_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_encoder_status_delete->loadRowValues($tbl_encoder_status_delete->Recordset);

	// Render row
	$tbl_encoder_status_delete->renderRow();
?>
	<tr <?php echo $tbl_encoder_status->rowAttributes() ?>>
<?php if ($tbl_encoder_status_delete->status_enc_id->Visible) { // status_enc_id ?>
		<td <?php echo $tbl_encoder_status_delete->status_enc_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_status_delete->RowCount ?>_tbl_encoder_status_status_enc_id" class="tbl_encoder_status_status_enc_id">
<span<?php echo $tbl_encoder_status_delete->status_enc_id->viewAttributes() ?>><?php echo $tbl_encoder_status_delete->status_enc_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_encoder_status_delete->status_remark->Visible) { // status_remark ?>
		<td <?php echo $tbl_encoder_status_delete->status_remark->cellAttributes() ?>>
<span id="el<?php echo $tbl_encoder_status_delete->RowCount ?>_tbl_encoder_status_status_remark" class="tbl_encoder_status_status_remark">
<span<?php echo $tbl_encoder_status_delete->status_remark->viewAttributes() ?>><?php echo $tbl_encoder_status_delete->status_remark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_encoder_status_delete->Recordset->moveNext();
}
$tbl_encoder_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_encoder_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_encoder_status_delete->showPageFooter();
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
$tbl_encoder_status_delete->terminate();
?>