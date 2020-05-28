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
$tbl_sup_type_delete = new tbl_sup_type_delete();

// Run the page
$tbl_sup_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_sup_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_sup_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_sup_typedelete = currentForm = new ew.Form("ftbl_sup_typedelete", "delete");
	loadjs.done("ftbl_sup_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_sup_type_delete->showPageHeader(); ?>
<?php
$tbl_sup_type_delete->showMessage();
?>
<form name="ftbl_sup_typedelete" id="ftbl_sup_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_sup_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_sup_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_sup_type_delete->sup_listID->Visible) { // sup_listID ?>
		<th class="<?php echo $tbl_sup_type_delete->sup_listID->headerCellClass() ?>"><span id="elh_tbl_sup_type_sup_listID" class="tbl_sup_type_sup_listID"><?php echo $tbl_sup_type_delete->sup_listID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_sup_type_delete->sup_types->Visible) { // sup_types ?>
		<th class="<?php echo $tbl_sup_type_delete->sup_types->headerCellClass() ?>"><span id="elh_tbl_sup_type_sup_types" class="tbl_sup_type_sup_types"><?php echo $tbl_sup_type_delete->sup_types->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_sup_type_delete->RecordCount = 0;
$i = 0;
while (!$tbl_sup_type_delete->Recordset->EOF) {
	$tbl_sup_type_delete->RecordCount++;
	$tbl_sup_type_delete->RowCount++;

	// Set row properties
	$tbl_sup_type->resetAttributes();
	$tbl_sup_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_sup_type_delete->loadRowValues($tbl_sup_type_delete->Recordset);

	// Render row
	$tbl_sup_type_delete->renderRow();
?>
	<tr <?php echo $tbl_sup_type->rowAttributes() ?>>
<?php if ($tbl_sup_type_delete->sup_listID->Visible) { // sup_listID ?>
		<td <?php echo $tbl_sup_type_delete->sup_listID->cellAttributes() ?>>
<span id="el<?php echo $tbl_sup_type_delete->RowCount ?>_tbl_sup_type_sup_listID" class="tbl_sup_type_sup_listID">
<span<?php echo $tbl_sup_type_delete->sup_listID->viewAttributes() ?>><?php echo $tbl_sup_type_delete->sup_listID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_sup_type_delete->sup_types->Visible) { // sup_types ?>
		<td <?php echo $tbl_sup_type_delete->sup_types->cellAttributes() ?>>
<span id="el<?php echo $tbl_sup_type_delete->RowCount ?>_tbl_sup_type_sup_types" class="tbl_sup_type_sup_types">
<span<?php echo $tbl_sup_type_delete->sup_types->viewAttributes() ?>><?php echo $tbl_sup_type_delete->sup_types->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_sup_type_delete->Recordset->moveNext();
}
$tbl_sup_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_sup_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_sup_type_delete->showPageFooter();
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
$tbl_sup_type_delete->terminate();
?>