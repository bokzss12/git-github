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
$tbl_spec_delete = new tbl_spec_delete();

// Run the page
$tbl_spec_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_spec_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_specdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_specdelete = currentForm = new ew.Form("ftbl_specdelete", "delete");
	loadjs.done("ftbl_specdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_spec_delete->showPageHeader(); ?>
<?php
$tbl_spec_delete->showMessage();
?>
<form name="ftbl_specdelete" id="ftbl_specdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_spec">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_spec_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_spec_delete->pr_number->Visible) { // pr_number ?>
		<th class="<?php echo $tbl_spec_delete->pr_number->headerCellClass() ?>"><span id="elh_tbl_spec_pr_number" class="tbl_spec_pr_number"><?php echo $tbl_spec_delete->pr_number->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_spec_delete->spec_unit->Visible) { // spec_unit ?>
		<th class="<?php echo $tbl_spec_delete->spec_unit->headerCellClass() ?>"><span id="elh_tbl_spec_spec_unit" class="tbl_spec_spec_unit"><?php echo $tbl_spec_delete->spec_unit->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_spec_delete->spec_dsc->Visible) { // spec_dsc ?>
		<th class="<?php echo $tbl_spec_delete->spec_dsc->headerCellClass() ?>"><span id="elh_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc"><?php echo $tbl_spec_delete->spec_dsc->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_spec_delete->spec_qty->Visible) { // spec_qty ?>
		<th class="<?php echo $tbl_spec_delete->spec_qty->headerCellClass() ?>"><span id="elh_tbl_spec_spec_qty" class="tbl_spec_spec_qty"><?php echo $tbl_spec_delete->spec_qty->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_spec_delete->spec_unitprice->Visible) { // spec_unitprice ?>
		<th class="<?php echo $tbl_spec_delete->spec_unitprice->headerCellClass() ?>"><span id="elh_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice"><?php echo $tbl_spec_delete->spec_unitprice->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_spec_delete->spec_totalprice->Visible) { // spec_totalprice ?>
		<th class="<?php echo $tbl_spec_delete->spec_totalprice->headerCellClass() ?>"><span id="elh_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice"><?php echo $tbl_spec_delete->spec_totalprice->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_spec_delete->RecordCount = 0;
$i = 0;
while (!$tbl_spec_delete->Recordset->EOF) {
	$tbl_spec_delete->RecordCount++;
	$tbl_spec_delete->RowCount++;

	// Set row properties
	$tbl_spec->resetAttributes();
	$tbl_spec->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_spec_delete->loadRowValues($tbl_spec_delete->Recordset);

	// Render row
	$tbl_spec_delete->renderRow();
?>
	<tr <?php echo $tbl_spec->rowAttributes() ?>>
<?php if ($tbl_spec_delete->pr_number->Visible) { // pr_number ?>
		<td <?php echo $tbl_spec_delete->pr_number->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_delete->RowCount ?>_tbl_spec_pr_number" class="tbl_spec_pr_number">
<span<?php echo $tbl_spec_delete->pr_number->viewAttributes() ?>><?php echo $tbl_spec_delete->pr_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_spec_delete->spec_unit->Visible) { // spec_unit ?>
		<td <?php echo $tbl_spec_delete->spec_unit->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_delete->RowCount ?>_tbl_spec_spec_unit" class="tbl_spec_spec_unit">
<span<?php echo $tbl_spec_delete->spec_unit->viewAttributes() ?>><?php echo $tbl_spec_delete->spec_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_spec_delete->spec_dsc->Visible) { // spec_dsc ?>
		<td <?php echo $tbl_spec_delete->spec_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_delete->RowCount ?>_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc">
<span<?php echo $tbl_spec_delete->spec_dsc->viewAttributes() ?>><?php echo $tbl_spec_delete->spec_dsc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_spec_delete->spec_qty->Visible) { // spec_qty ?>
		<td <?php echo $tbl_spec_delete->spec_qty->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_delete->RowCount ?>_tbl_spec_spec_qty" class="tbl_spec_spec_qty">
<span<?php echo $tbl_spec_delete->spec_qty->viewAttributes() ?>><?php echo $tbl_spec_delete->spec_qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_spec_delete->spec_unitprice->Visible) { // spec_unitprice ?>
		<td <?php echo $tbl_spec_delete->spec_unitprice->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_delete->RowCount ?>_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice">
<span<?php echo $tbl_spec_delete->spec_unitprice->viewAttributes() ?>><?php echo $tbl_spec_delete->spec_unitprice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_spec_delete->spec_totalprice->Visible) { // spec_totalprice ?>
		<td <?php echo $tbl_spec_delete->spec_totalprice->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_delete->RowCount ?>_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice">
<span<?php echo $tbl_spec_delete->spec_totalprice->viewAttributes() ?>><?php echo $tbl_spec_delete->spec_totalprice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_spec_delete->Recordset->moveNext();
}
$tbl_spec_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_spec_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_spec_delete->showPageFooter();
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
$tbl_spec_delete->terminate();
?>