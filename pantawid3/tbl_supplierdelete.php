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
$tbl_supplier_delete = new tbl_supplier_delete();

// Run the page
$tbl_supplier_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplier_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_supplierdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_supplierdelete = currentForm = new ew.Form("ftbl_supplierdelete", "delete");
	loadjs.done("ftbl_supplierdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_supplier_delete->showPageHeader(); ?>
<?php
$tbl_supplier_delete->showMessage();
?>
<form name="ftbl_supplierdelete" id="ftbl_supplierdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplier">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_supplier_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_supplier_delete->supplierID->Visible) { // supplierID ?>
		<th class="<?php echo $tbl_supplier_delete->supplierID->headerCellClass() ?>"><span id="elh_tbl_supplier_supplierID" class="tbl_supplier_supplierID"><?php echo $tbl_supplier_delete->supplierID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplier_delete->supplier_dsc->Visible) { // supplier_dsc ?>
		<th class="<?php echo $tbl_supplier_delete->supplier_dsc->headerCellClass() ?>"><span id="elh_tbl_supplier_supplier_dsc" class="tbl_supplier_supplier_dsc"><?php echo $tbl_supplier_delete->supplier_dsc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_supplier_delete->RecordCount = 0;
$i = 0;
while (!$tbl_supplier_delete->Recordset->EOF) {
	$tbl_supplier_delete->RecordCount++;
	$tbl_supplier_delete->RowCount++;

	// Set row properties
	$tbl_supplier->resetAttributes();
	$tbl_supplier->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_supplier_delete->loadRowValues($tbl_supplier_delete->Recordset);

	// Render row
	$tbl_supplier_delete->renderRow();
?>
	<tr <?php echo $tbl_supplier->rowAttributes() ?>>
<?php if ($tbl_supplier_delete->supplierID->Visible) { // supplierID ?>
		<td <?php echo $tbl_supplier_delete->supplierID->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCount ?>_tbl_supplier_supplierID" class="tbl_supplier_supplierID">
<span<?php echo $tbl_supplier_delete->supplierID->viewAttributes() ?>><?php echo $tbl_supplier_delete->supplierID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplier_delete->supplier_dsc->Visible) { // supplier_dsc ?>
		<td <?php echo $tbl_supplier_delete->supplier_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplier_delete->RowCount ?>_tbl_supplier_supplier_dsc" class="tbl_supplier_supplier_dsc">
<span<?php echo $tbl_supplier_delete->supplier_dsc->viewAttributes() ?>><?php echo $tbl_supplier_delete->supplier_dsc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_supplier_delete->Recordset->moveNext();
}
$tbl_supplier_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_supplier_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_supplier_delete->showPageFooter();
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
$tbl_supplier_delete->terminate();
?>