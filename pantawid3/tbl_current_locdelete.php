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
$tbl_current_loc_delete = new tbl_current_loc_delete();

// Run the page
$tbl_current_loc_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_current_loc_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_current_locdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_current_locdelete = currentForm = new ew.Form("ftbl_current_locdelete", "delete");
	loadjs.done("ftbl_current_locdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_current_loc_delete->showPageHeader(); ?>
<?php
$tbl_current_loc_delete->showMessage();
?>
<form name="ftbl_current_locdelete" id="ftbl_current_locdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_current_loc">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_current_loc_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_current_loc_delete->current_id->Visible) { // current_id ?>
		<th class="<?php echo $tbl_current_loc_delete->current_id->headerCellClass() ?>"><span id="elh_tbl_current_loc_current_id" class="tbl_current_loc_current_id"><?php echo $tbl_current_loc_delete->current_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_current_loc_delete->current_location->Visible) { // current_location ?>
		<th class="<?php echo $tbl_current_loc_delete->current_location->headerCellClass() ?>"><span id="elh_tbl_current_loc_current_location" class="tbl_current_loc_current_location"><?php echo $tbl_current_loc_delete->current_location->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_current_loc_delete->RecordCount = 0;
$i = 0;
while (!$tbl_current_loc_delete->Recordset->EOF) {
	$tbl_current_loc_delete->RecordCount++;
	$tbl_current_loc_delete->RowCount++;

	// Set row properties
	$tbl_current_loc->resetAttributes();
	$tbl_current_loc->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_current_loc_delete->loadRowValues($tbl_current_loc_delete->Recordset);

	// Render row
	$tbl_current_loc_delete->renderRow();
?>
	<tr <?php echo $tbl_current_loc->rowAttributes() ?>>
<?php if ($tbl_current_loc_delete->current_id->Visible) { // current_id ?>
		<td <?php echo $tbl_current_loc_delete->current_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_current_loc_delete->RowCount ?>_tbl_current_loc_current_id" class="tbl_current_loc_current_id">
<span<?php echo $tbl_current_loc_delete->current_id->viewAttributes() ?>><?php echo $tbl_current_loc_delete->current_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_current_loc_delete->current_location->Visible) { // current_location ?>
		<td <?php echo $tbl_current_loc_delete->current_location->cellAttributes() ?>>
<span id="el<?php echo $tbl_current_loc_delete->RowCount ?>_tbl_current_loc_current_location" class="tbl_current_loc_current_location">
<span<?php echo $tbl_current_loc_delete->current_location->viewAttributes() ?>><?php echo $tbl_current_loc_delete->current_location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_current_loc_delete->Recordset->moveNext();
}
$tbl_current_loc_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_current_loc_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_current_loc_delete->showPageFooter();
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
$tbl_current_loc_delete->terminate();
?>