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
$tbl_printingtype_delete = new tbl_printingtype_delete();

// Run the page
$tbl_printingtype_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printingtype_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_printingtypedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_printingtypedelete = currentForm = new ew.Form("ftbl_printingtypedelete", "delete");
	loadjs.done("ftbl_printingtypedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_printingtype_delete->showPageHeader(); ?>
<?php
$tbl_printingtype_delete->showMessage();
?>
<form name="ftbl_printingtypedelete" id="ftbl_printingtypedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printingtype">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_printingtype_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_printingtype_delete->printingtypeID->Visible) { // printingtypeID ?>
		<th class="<?php echo $tbl_printingtype_delete->printingtypeID->headerCellClass() ?>"><span id="elh_tbl_printingtype_printingtypeID" class="tbl_printingtype_printingtypeID"><?php echo $tbl_printingtype_delete->printingtypeID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_printingtype_delete->typeofprinting->Visible) { // typeofprinting ?>
		<th class="<?php echo $tbl_printingtype_delete->typeofprinting->headerCellClass() ?>"><span id="elh_tbl_printingtype_typeofprinting" class="tbl_printingtype_typeofprinting"><?php echo $tbl_printingtype_delete->typeofprinting->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_printingtype_delete->RecordCount = 0;
$i = 0;
while (!$tbl_printingtype_delete->Recordset->EOF) {
	$tbl_printingtype_delete->RecordCount++;
	$tbl_printingtype_delete->RowCount++;

	// Set row properties
	$tbl_printingtype->resetAttributes();
	$tbl_printingtype->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_printingtype_delete->loadRowValues($tbl_printingtype_delete->Recordset);

	// Render row
	$tbl_printingtype_delete->renderRow();
?>
	<tr <?php echo $tbl_printingtype->rowAttributes() ?>>
<?php if ($tbl_printingtype_delete->printingtypeID->Visible) { // printingtypeID ?>
		<td <?php echo $tbl_printingtype_delete->printingtypeID->cellAttributes() ?>>
<span id="el<?php echo $tbl_printingtype_delete->RowCount ?>_tbl_printingtype_printingtypeID" class="tbl_printingtype_printingtypeID">
<span<?php echo $tbl_printingtype_delete->printingtypeID->viewAttributes() ?>><?php echo $tbl_printingtype_delete->printingtypeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_printingtype_delete->typeofprinting->Visible) { // typeofprinting ?>
		<td <?php echo $tbl_printingtype_delete->typeofprinting->cellAttributes() ?>>
<span id="el<?php echo $tbl_printingtype_delete->RowCount ?>_tbl_printingtype_typeofprinting" class="tbl_printingtype_typeofprinting">
<span<?php echo $tbl_printingtype_delete->typeofprinting->viewAttributes() ?>><?php echo $tbl_printingtype_delete->typeofprinting->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_printingtype_delete->Recordset->moveNext();
}
$tbl_printingtype_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_printingtype_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_printingtype_delete->showPageFooter();
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
$tbl_printingtype_delete->terminate();
?>