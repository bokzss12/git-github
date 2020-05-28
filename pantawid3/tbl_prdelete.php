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
$tbl_pr_delete = new tbl_pr_delete();

// Run the page
$tbl_pr_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_prdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_prdelete = currentForm = new ew.Form("ftbl_prdelete", "delete");
	loadjs.done("ftbl_prdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_pr_delete->showPageHeader(); ?>
<?php
$tbl_pr_delete->showMessage();
?>
<form name="ftbl_prdelete" id="ftbl_prdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_pr_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_pr_delete->prID->Visible) { // prID ?>
		<th class="<?php echo $tbl_pr_delete->prID->headerCellClass() ?>"><span id="elh_tbl_pr_prID" class="tbl_pr_prID"><?php echo $tbl_pr_delete->prID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pr_delete->date_prep->Visible) { // date_prep ?>
		<th class="<?php echo $tbl_pr_delete->date_prep->headerCellClass() ?>"><span id="elh_tbl_pr_date_prep" class="tbl_pr_date_prep"><?php echo $tbl_pr_delete->date_prep->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pr_delete->pr_number->Visible) { // pr_number ?>
		<th class="<?php echo $tbl_pr_delete->pr_number->headerCellClass() ?>"><span id="elh_tbl_pr_pr_number" class="tbl_pr_pr_number"><?php echo $tbl_pr_delete->pr_number->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pr_delete->purpose->Visible) { // purpose ?>
		<th class="<?php echo $tbl_pr_delete->purpose->headerCellClass() ?>"><span id="elh_tbl_pr_purpose" class="tbl_pr_purpose"><?php echo $tbl_pr_delete->purpose->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pr_delete->pr_status->Visible) { // pr_status ?>
		<th class="<?php echo $tbl_pr_delete->pr_status->headerCellClass() ?>"><span id="elh_tbl_pr_pr_status" class="tbl_pr_pr_status"><?php echo $tbl_pr_delete->pr_status->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pr_delete->employeeid->Visible) { // employeeid ?>
		<th class="<?php echo $tbl_pr_delete->employeeid->headerCellClass() ?>"><span id="elh_tbl_pr_employeeid" class="tbl_pr_employeeid"><?php echo $tbl_pr_delete->employeeid->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_pr_delete->RecordCount = 0;
$i = 0;
while (!$tbl_pr_delete->Recordset->EOF) {
	$tbl_pr_delete->RecordCount++;
	$tbl_pr_delete->RowCount++;

	// Set row properties
	$tbl_pr->resetAttributes();
	$tbl_pr->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_pr_delete->loadRowValues($tbl_pr_delete->Recordset);

	// Render row
	$tbl_pr_delete->renderRow();
?>
	<tr <?php echo $tbl_pr->rowAttributes() ?>>
<?php if ($tbl_pr_delete->prID->Visible) { // prID ?>
		<td <?php echo $tbl_pr_delete->prID->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_delete->RowCount ?>_tbl_pr_prID" class="tbl_pr_prID">
<span<?php echo $tbl_pr_delete->prID->viewAttributes() ?>><?php echo $tbl_pr_delete->prID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pr_delete->date_prep->Visible) { // date_prep ?>
		<td <?php echo $tbl_pr_delete->date_prep->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_delete->RowCount ?>_tbl_pr_date_prep" class="tbl_pr_date_prep">
<span<?php echo $tbl_pr_delete->date_prep->viewAttributes() ?>><?php echo $tbl_pr_delete->date_prep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pr_delete->pr_number->Visible) { // pr_number ?>
		<td <?php echo $tbl_pr_delete->pr_number->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_delete->RowCount ?>_tbl_pr_pr_number" class="tbl_pr_pr_number">
<span<?php echo $tbl_pr_delete->pr_number->viewAttributes() ?>><?php echo $tbl_pr_delete->pr_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pr_delete->purpose->Visible) { // purpose ?>
		<td <?php echo $tbl_pr_delete->purpose->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_delete->RowCount ?>_tbl_pr_purpose" class="tbl_pr_purpose">
<span<?php echo $tbl_pr_delete->purpose->viewAttributes() ?>><?php echo $tbl_pr_delete->purpose->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pr_delete->pr_status->Visible) { // pr_status ?>
		<td <?php echo $tbl_pr_delete->pr_status->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_delete->RowCount ?>_tbl_pr_pr_status" class="tbl_pr_pr_status">
<span<?php echo $tbl_pr_delete->pr_status->viewAttributes() ?>><?php echo $tbl_pr_delete->pr_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pr_delete->employeeid->Visible) { // employeeid ?>
		<td <?php echo $tbl_pr_delete->employeeid->cellAttributes() ?>>
<span id="el<?php echo $tbl_pr_delete->RowCount ?>_tbl_pr_employeeid" class="tbl_pr_employeeid">
<span<?php echo $tbl_pr_delete->employeeid->viewAttributes() ?>><?php echo $tbl_pr_delete->employeeid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_pr_delete->Recordset->moveNext();
}
$tbl_pr_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pr_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_pr_delete->showPageFooter();
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
$tbl_pr_delete->terminate();
?>