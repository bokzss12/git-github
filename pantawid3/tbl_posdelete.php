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
$tbl_pos_delete = new tbl_pos_delete();

// Run the page
$tbl_pos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_posdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_posdelete = currentForm = new ew.Form("ftbl_posdelete", "delete");
	loadjs.done("ftbl_posdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_pos_delete->showPageHeader(); ?>
<?php
$tbl_pos_delete->showMessage();
?>
<form name="ftbl_posdelete" id="ftbl_posdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_pos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_pos_delete->pos_id->Visible) { // pos_id ?>
		<th class="<?php echo $tbl_pos_delete->pos_id->headerCellClass() ?>"><span id="elh_tbl_pos_pos_id" class="tbl_pos_pos_id"><?php echo $tbl_pos_delete->pos_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pos_delete->pos_desc->Visible) { // pos_desc ?>
		<th class="<?php echo $tbl_pos_delete->pos_desc->headerCellClass() ?>"><span id="elh_tbl_pos_pos_desc" class="tbl_pos_pos_desc"><?php echo $tbl_pos_delete->pos_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_pos_delete->RecordCount = 0;
$i = 0;
while (!$tbl_pos_delete->Recordset->EOF) {
	$tbl_pos_delete->RecordCount++;
	$tbl_pos_delete->RowCount++;

	// Set row properties
	$tbl_pos->resetAttributes();
	$tbl_pos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_pos_delete->loadRowValues($tbl_pos_delete->Recordset);

	// Render row
	$tbl_pos_delete->renderRow();
?>
	<tr <?php echo $tbl_pos->rowAttributes() ?>>
<?php if ($tbl_pos_delete->pos_id->Visible) { // pos_id ?>
		<td <?php echo $tbl_pos_delete->pos_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_pos_delete->RowCount ?>_tbl_pos_pos_id" class="tbl_pos_pos_id">
<span<?php echo $tbl_pos_delete->pos_id->viewAttributes() ?>><?php echo $tbl_pos_delete->pos_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pos_delete->pos_desc->Visible) { // pos_desc ?>
		<td <?php echo $tbl_pos_delete->pos_desc->cellAttributes() ?>>
<span id="el<?php echo $tbl_pos_delete->RowCount ?>_tbl_pos_pos_desc" class="tbl_pos_pos_desc">
<span<?php echo $tbl_pos_delete->pos_desc->viewAttributes() ?>><?php echo $tbl_pos_delete->pos_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_pos_delete->Recordset->moveNext();
}
$tbl_pos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_pos_delete->showPageFooter();
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
$tbl_pos_delete->terminate();
?>