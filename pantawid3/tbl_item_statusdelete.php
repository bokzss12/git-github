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
$tbl_item_status_delete = new tbl_item_status_delete();

// Run the page
$tbl_item_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_item_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_item_statusdelete = currentForm = new ew.Form("ftbl_item_statusdelete", "delete");
	loadjs.done("ftbl_item_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_item_status_delete->showPageHeader(); ?>
<?php
$tbl_item_status_delete->showMessage();
?>
<form name="ftbl_item_statusdelete" id="ftbl_item_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_item_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_item_status_delete->status_id->Visible) { // status_id ?>
		<th class="<?php echo $tbl_item_status_delete->status_id->headerCellClass() ?>"><span id="elh_tbl_item_status_status_id" class="tbl_item_status_status_id"><?php echo $tbl_item_status_delete->status_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_status_delete->status_desc->Visible) { // status_desc ?>
		<th class="<?php echo $tbl_item_status_delete->status_desc->headerCellClass() ?>"><span id="elh_tbl_item_status_status_desc" class="tbl_item_status_status_desc"><?php echo $tbl_item_status_delete->status_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_item_status_delete->RecordCount = 0;
$i = 0;
while (!$tbl_item_status_delete->Recordset->EOF) {
	$tbl_item_status_delete->RecordCount++;
	$tbl_item_status_delete->RowCount++;

	// Set row properties
	$tbl_item_status->resetAttributes();
	$tbl_item_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_item_status_delete->loadRowValues($tbl_item_status_delete->Recordset);

	// Render row
	$tbl_item_status_delete->renderRow();
?>
	<tr <?php echo $tbl_item_status->rowAttributes() ?>>
<?php if ($tbl_item_status_delete->status_id->Visible) { // status_id ?>
		<td <?php echo $tbl_item_status_delete->status_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_status_delete->RowCount ?>_tbl_item_status_status_id" class="tbl_item_status_status_id">
<span<?php echo $tbl_item_status_delete->status_id->viewAttributes() ?>><?php echo $tbl_item_status_delete->status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_status_delete->status_desc->Visible) { // status_desc ?>
		<td <?php echo $tbl_item_status_delete->status_desc->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_status_delete->RowCount ?>_tbl_item_status_status_desc" class="tbl_item_status_status_desc">
<span<?php echo $tbl_item_status_delete->status_desc->viewAttributes() ?>><?php echo $tbl_item_status_delete->status_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_item_status_delete->Recordset->moveNext();
}
$tbl_item_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_item_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_item_status_delete->showPageFooter();
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
$tbl_item_status_delete->terminate();
?>