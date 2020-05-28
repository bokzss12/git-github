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
$tbl_purchase_unit_delete = new tbl_purchase_unit_delete();

// Run the page
$tbl_purchase_unit_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_purchase_unit_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_purchase_unitdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_purchase_unitdelete = currentForm = new ew.Form("ftbl_purchase_unitdelete", "delete");
	loadjs.done("ftbl_purchase_unitdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_purchase_unit_delete->showPageHeader(); ?>
<?php
$tbl_purchase_unit_delete->showMessage();
?>
<form name="ftbl_purchase_unitdelete" id="ftbl_purchase_unitdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_purchase_unit">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_purchase_unit_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_purchase_unit_delete->pruID->Visible) { // pruID ?>
		<th class="<?php echo $tbl_purchase_unit_delete->pruID->headerCellClass() ?>"><span id="elh_tbl_purchase_unit_pruID" class="tbl_purchase_unit_pruID"><?php echo $tbl_purchase_unit_delete->pruID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_purchase_unit_delete->unit_desc->Visible) { // unit_desc ?>
		<th class="<?php echo $tbl_purchase_unit_delete->unit_desc->headerCellClass() ?>"><span id="elh_tbl_purchase_unit_unit_desc" class="tbl_purchase_unit_unit_desc"><?php echo $tbl_purchase_unit_delete->unit_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_purchase_unit_delete->RecordCount = 0;
$i = 0;
while (!$tbl_purchase_unit_delete->Recordset->EOF) {
	$tbl_purchase_unit_delete->RecordCount++;
	$tbl_purchase_unit_delete->RowCount++;

	// Set row properties
	$tbl_purchase_unit->resetAttributes();
	$tbl_purchase_unit->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_purchase_unit_delete->loadRowValues($tbl_purchase_unit_delete->Recordset);

	// Render row
	$tbl_purchase_unit_delete->renderRow();
?>
	<tr <?php echo $tbl_purchase_unit->rowAttributes() ?>>
<?php if ($tbl_purchase_unit_delete->pruID->Visible) { // pruID ?>
		<td <?php echo $tbl_purchase_unit_delete->pruID->cellAttributes() ?>>
<span id="el<?php echo $tbl_purchase_unit_delete->RowCount ?>_tbl_purchase_unit_pruID" class="tbl_purchase_unit_pruID">
<span<?php echo $tbl_purchase_unit_delete->pruID->viewAttributes() ?>><?php echo $tbl_purchase_unit_delete->pruID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_purchase_unit_delete->unit_desc->Visible) { // unit_desc ?>
		<td <?php echo $tbl_purchase_unit_delete->unit_desc->cellAttributes() ?>>
<span id="el<?php echo $tbl_purchase_unit_delete->RowCount ?>_tbl_purchase_unit_unit_desc" class="tbl_purchase_unit_unit_desc">
<span<?php echo $tbl_purchase_unit_delete->unit_desc->viewAttributes() ?>><?php echo $tbl_purchase_unit_delete->unit_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_purchase_unit_delete->Recordset->moveNext();
}
$tbl_purchase_unit_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_purchase_unit_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_purchase_unit_delete->showPageFooter();
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
$tbl_purchase_unit_delete->terminate();
?>