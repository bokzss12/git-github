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
$tbl_year_delete = new tbl_year_delete();

// Run the page
$tbl_year_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_year_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_yeardelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_yeardelete = currentForm = new ew.Form("ftbl_yeardelete", "delete");
	loadjs.done("ftbl_yeardelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_year_delete->showPageHeader(); ?>
<?php
$tbl_year_delete->showMessage();
?>
<form name="ftbl_yeardelete" id="ftbl_yeardelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_year">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_year_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_year_delete->year_id->Visible) { // year_id ?>
		<th class="<?php echo $tbl_year_delete->year_id->headerCellClass() ?>"><span id="elh_tbl_year_year_id" class="tbl_year_year_id"><?php echo $tbl_year_delete->year_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_year_delete->year_dsc->Visible) { // year_dsc ?>
		<th class="<?php echo $tbl_year_delete->year_dsc->headerCellClass() ?>"><span id="elh_tbl_year_year_dsc" class="tbl_year_year_dsc"><?php echo $tbl_year_delete->year_dsc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_year_delete->RecordCount = 0;
$i = 0;
while (!$tbl_year_delete->Recordset->EOF) {
	$tbl_year_delete->RecordCount++;
	$tbl_year_delete->RowCount++;

	// Set row properties
	$tbl_year->resetAttributes();
	$tbl_year->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_year_delete->loadRowValues($tbl_year_delete->Recordset);

	// Render row
	$tbl_year_delete->renderRow();
?>
	<tr <?php echo $tbl_year->rowAttributes() ?>>
<?php if ($tbl_year_delete->year_id->Visible) { // year_id ?>
		<td <?php echo $tbl_year_delete->year_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_year_delete->RowCount ?>_tbl_year_year_id" class="tbl_year_year_id">
<span<?php echo $tbl_year_delete->year_id->viewAttributes() ?>><?php echo $tbl_year_delete->year_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_year_delete->year_dsc->Visible) { // year_dsc ?>
		<td <?php echo $tbl_year_delete->year_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_year_delete->RowCount ?>_tbl_year_year_dsc" class="tbl_year_year_dsc">
<span<?php echo $tbl_year_delete->year_dsc->viewAttributes() ?>><?php echo $tbl_year_delete->year_dsc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_year_delete->Recordset->moveNext();
}
$tbl_year_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_year_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_year_delete->showPageFooter();
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
$tbl_year_delete->terminate();
?>