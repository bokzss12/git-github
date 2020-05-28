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
$tbl_accountable_name_delete = new tbl_accountable_name_delete();

// Run the page
$tbl_accountable_name_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_accountable_name_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_accountable_namedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_accountable_namedelete = currentForm = new ew.Form("ftbl_accountable_namedelete", "delete");
	loadjs.done("ftbl_accountable_namedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_accountable_name_delete->showPageHeader(); ?>
<?php
$tbl_accountable_name_delete->showMessage();
?>
<form name="ftbl_accountable_namedelete" id="ftbl_accountable_namedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_accountable_name">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_accountable_name_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_accountable_name_delete->id->Visible) { // id ?>
		<th class="<?php echo $tbl_accountable_name_delete->id->headerCellClass() ?>"><span id="elh_tbl_accountable_name_id" class="tbl_accountable_name_id"><?php echo $tbl_accountable_name_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_accountable_name_delete->name_id->Visible) { // name_id ?>
		<th class="<?php echo $tbl_accountable_name_delete->name_id->headerCellClass() ?>"><span id="elh_tbl_accountable_name_name_id" class="tbl_accountable_name_name_id"><?php echo $tbl_accountable_name_delete->name_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_accountable_name_delete->last_name->Visible) { // last_name ?>
		<th class="<?php echo $tbl_accountable_name_delete->last_name->headerCellClass() ?>"><span id="elh_tbl_accountable_name_last_name" class="tbl_accountable_name_last_name"><?php echo $tbl_accountable_name_delete->last_name->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_accountable_name_delete->first_name->Visible) { // first_name ?>
		<th class="<?php echo $tbl_accountable_name_delete->first_name->headerCellClass() ?>"><span id="elh_tbl_accountable_name_first_name" class="tbl_accountable_name_first_name"><?php echo $tbl_accountable_name_delete->first_name->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_accountable_name_delete->mid_name->Visible) { // mid_name ?>
		<th class="<?php echo $tbl_accountable_name_delete->mid_name->headerCellClass() ?>"><span id="elh_tbl_accountable_name_mid_name" class="tbl_accountable_name_mid_name"><?php echo $tbl_accountable_name_delete->mid_name->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_accountable_name_delete->ext_name->Visible) { // ext_name ?>
		<th class="<?php echo $tbl_accountable_name_delete->ext_name->headerCellClass() ?>"><span id="elh_tbl_accountable_name_ext_name" class="tbl_accountable_name_ext_name"><?php echo $tbl_accountable_name_delete->ext_name->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_accountable_name_delete->full_name_tbl->Visible) { // full_name_tbl ?>
		<th class="<?php echo $tbl_accountable_name_delete->full_name_tbl->headerCellClass() ?>"><span id="elh_tbl_accountable_name_full_name_tbl" class="tbl_accountable_name_full_name_tbl"><?php echo $tbl_accountable_name_delete->full_name_tbl->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_accountable_name_delete->RecordCount = 0;
$i = 0;
while (!$tbl_accountable_name_delete->Recordset->EOF) {
	$tbl_accountable_name_delete->RecordCount++;
	$tbl_accountable_name_delete->RowCount++;

	// Set row properties
	$tbl_accountable_name->resetAttributes();
	$tbl_accountable_name->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_accountable_name_delete->loadRowValues($tbl_accountable_name_delete->Recordset);

	// Render row
	$tbl_accountable_name_delete->renderRow();
?>
	<tr <?php echo $tbl_accountable_name->rowAttributes() ?>>
<?php if ($tbl_accountable_name_delete->id->Visible) { // id ?>
		<td <?php echo $tbl_accountable_name_delete->id->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_delete->RowCount ?>_tbl_accountable_name_id" class="tbl_accountable_name_id">
<span<?php echo $tbl_accountable_name_delete->id->viewAttributes() ?>><?php echo $tbl_accountable_name_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_accountable_name_delete->name_id->Visible) { // name_id ?>
		<td <?php echo $tbl_accountable_name_delete->name_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_delete->RowCount ?>_tbl_accountable_name_name_id" class="tbl_accountable_name_name_id">
<span<?php echo $tbl_accountable_name_delete->name_id->viewAttributes() ?>><?php echo $tbl_accountable_name_delete->name_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_accountable_name_delete->last_name->Visible) { // last_name ?>
		<td <?php echo $tbl_accountable_name_delete->last_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_delete->RowCount ?>_tbl_accountable_name_last_name" class="tbl_accountable_name_last_name">
<span<?php echo $tbl_accountable_name_delete->last_name->viewAttributes() ?>><?php echo $tbl_accountable_name_delete->last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_accountable_name_delete->first_name->Visible) { // first_name ?>
		<td <?php echo $tbl_accountable_name_delete->first_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_delete->RowCount ?>_tbl_accountable_name_first_name" class="tbl_accountable_name_first_name">
<span<?php echo $tbl_accountable_name_delete->first_name->viewAttributes() ?>><?php echo $tbl_accountable_name_delete->first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_accountable_name_delete->mid_name->Visible) { // mid_name ?>
		<td <?php echo $tbl_accountable_name_delete->mid_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_delete->RowCount ?>_tbl_accountable_name_mid_name" class="tbl_accountable_name_mid_name">
<span<?php echo $tbl_accountable_name_delete->mid_name->viewAttributes() ?>><?php echo $tbl_accountable_name_delete->mid_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_accountable_name_delete->ext_name->Visible) { // ext_name ?>
		<td <?php echo $tbl_accountable_name_delete->ext_name->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_delete->RowCount ?>_tbl_accountable_name_ext_name" class="tbl_accountable_name_ext_name">
<span<?php echo $tbl_accountable_name_delete->ext_name->viewAttributes() ?>><?php echo $tbl_accountable_name_delete->ext_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_accountable_name_delete->full_name_tbl->Visible) { // full_name_tbl ?>
		<td <?php echo $tbl_accountable_name_delete->full_name_tbl->cellAttributes() ?>>
<span id="el<?php echo $tbl_accountable_name_delete->RowCount ?>_tbl_accountable_name_full_name_tbl" class="tbl_accountable_name_full_name_tbl">
<span<?php echo $tbl_accountable_name_delete->full_name_tbl->viewAttributes() ?>><?php echo $tbl_accountable_name_delete->full_name_tbl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_accountable_name_delete->Recordset->moveNext();
}
$tbl_accountable_name_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_accountable_name_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_accountable_name_delete->showPageFooter();
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
$tbl_accountable_name_delete->terminate();
?>