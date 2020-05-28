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
$tbl_activate_delete = new tbl_activate_delete();

// Run the page
$tbl_activate_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_activate_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_activatedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_activatedelete = currentForm = new ew.Form("ftbl_activatedelete", "delete");
	loadjs.done("ftbl_activatedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_activate_delete->showPageHeader(); ?>
<?php
$tbl_activate_delete->showMessage();
?>
<form name="ftbl_activatedelete" id="ftbl_activatedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_activate">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_activate_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_activate_delete->activate_id->Visible) { // activate_id ?>
		<th class="<?php echo $tbl_activate_delete->activate_id->headerCellClass() ?>"><span id="elh_tbl_activate_activate_id" class="tbl_activate_activate_id"><?php echo $tbl_activate_delete->activate_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_activate_delete->activate_dsc->Visible) { // activate_dsc ?>
		<th class="<?php echo $tbl_activate_delete->activate_dsc->headerCellClass() ?>"><span id="elh_tbl_activate_activate_dsc" class="tbl_activate_activate_dsc"><?php echo $tbl_activate_delete->activate_dsc->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_activate_delete->Value->Visible) { // Value ?>
		<th class="<?php echo $tbl_activate_delete->Value->headerCellClass() ?>"><span id="elh_tbl_activate_Value" class="tbl_activate_Value"><?php echo $tbl_activate_delete->Value->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_activate_delete->RecordCount = 0;
$i = 0;
while (!$tbl_activate_delete->Recordset->EOF) {
	$tbl_activate_delete->RecordCount++;
	$tbl_activate_delete->RowCount++;

	// Set row properties
	$tbl_activate->resetAttributes();
	$tbl_activate->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_activate_delete->loadRowValues($tbl_activate_delete->Recordset);

	// Render row
	$tbl_activate_delete->renderRow();
?>
	<tr <?php echo $tbl_activate->rowAttributes() ?>>
<?php if ($tbl_activate_delete->activate_id->Visible) { // activate_id ?>
		<td <?php echo $tbl_activate_delete->activate_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_activate_delete->RowCount ?>_tbl_activate_activate_id" class="tbl_activate_activate_id">
<span<?php echo $tbl_activate_delete->activate_id->viewAttributes() ?>><?php echo $tbl_activate_delete->activate_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_activate_delete->activate_dsc->Visible) { // activate_dsc ?>
		<td <?php echo $tbl_activate_delete->activate_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_activate_delete->RowCount ?>_tbl_activate_activate_dsc" class="tbl_activate_activate_dsc">
<span<?php echo $tbl_activate_delete->activate_dsc->viewAttributes() ?>><?php echo $tbl_activate_delete->activate_dsc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_activate_delete->Value->Visible) { // Value ?>
		<td <?php echo $tbl_activate_delete->Value->cellAttributes() ?>>
<span id="el<?php echo $tbl_activate_delete->RowCount ?>_tbl_activate_Value" class="tbl_activate_Value">
<span<?php echo $tbl_activate_delete->Value->viewAttributes() ?>><?php echo $tbl_activate_delete->Value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_activate_delete->Recordset->moveNext();
}
$tbl_activate_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_activate_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_activate_delete->showPageFooter();
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
$tbl_activate_delete->terminate();
?>