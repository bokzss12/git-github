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
$tbl_month_delete = new tbl_month_delete();

// Run the page
$tbl_month_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_month_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_monthdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_monthdelete = currentForm = new ew.Form("ftbl_monthdelete", "delete");
	loadjs.done("ftbl_monthdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_month_delete->showPageHeader(); ?>
<?php
$tbl_month_delete->showMessage();
?>
<form name="ftbl_monthdelete" id="ftbl_monthdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_month">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_month_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_month_delete->month_id->Visible) { // month_id ?>
		<th class="<?php echo $tbl_month_delete->month_id->headerCellClass() ?>"><span id="elh_tbl_month_month_id" class="tbl_month_month_id"><?php echo $tbl_month_delete->month_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_month_delete->month_dsc->Visible) { // month_dsc ?>
		<th class="<?php echo $tbl_month_delete->month_dsc->headerCellClass() ?>"><span id="elh_tbl_month_month_dsc" class="tbl_month_month_dsc"><?php echo $tbl_month_delete->month_dsc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_month_delete->RecordCount = 0;
$i = 0;
while (!$tbl_month_delete->Recordset->EOF) {
	$tbl_month_delete->RecordCount++;
	$tbl_month_delete->RowCount++;

	// Set row properties
	$tbl_month->resetAttributes();
	$tbl_month->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_month_delete->loadRowValues($tbl_month_delete->Recordset);

	// Render row
	$tbl_month_delete->renderRow();
?>
	<tr <?php echo $tbl_month->rowAttributes() ?>>
<?php if ($tbl_month_delete->month_id->Visible) { // month_id ?>
		<td <?php echo $tbl_month_delete->month_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_month_delete->RowCount ?>_tbl_month_month_id" class="tbl_month_month_id">
<span<?php echo $tbl_month_delete->month_id->viewAttributes() ?>><?php echo $tbl_month_delete->month_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_month_delete->month_dsc->Visible) { // month_dsc ?>
		<td <?php echo $tbl_month_delete->month_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_month_delete->RowCount ?>_tbl_month_month_dsc" class="tbl_month_month_dsc">
<span<?php echo $tbl_month_delete->month_dsc->viewAttributes() ?>><?php echo $tbl_month_delete->month_dsc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_month_delete->Recordset->moveNext();
}
$tbl_month_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_month_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_month_delete->showPageFooter();
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
$tbl_month_delete->terminate();
?>