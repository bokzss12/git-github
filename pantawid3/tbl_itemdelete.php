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
$tbl_item_delete = new tbl_item_delete();

// Run the page
$tbl_item_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_itemdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_itemdelete = currentForm = new ew.Form("ftbl_itemdelete", "delete");
	loadjs.done("ftbl_itemdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_item_delete->showPageHeader(); ?>
<?php
$tbl_item_delete->showMessage();
?>
<form name="ftbl_itemdelete" id="ftbl_itemdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_item_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_item_delete->SRN->Visible) { // SRN ?>
		<th class="<?php echo $tbl_item_delete->SRN->headerCellClass() ?>"><span id="elh_tbl_item_SRN" class="tbl_item_SRN"><?php echo $tbl_item_delete->SRN->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_delete->item_date_receive->Visible) { // item_date_receive ?>
		<th class="<?php echo $tbl_item_delete->item_date_receive->headerCellClass() ?>"><span id="elh_tbl_item_item_date_receive" class="tbl_item_item_date_receive"><?php echo $tbl_item_delete->item_date_receive->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_delete->item_date_repaired->Visible) { // item_date_repaired ?>
		<th class="<?php echo $tbl_item_delete->item_date_repaired->headerCellClass() ?>"><span id="elh_tbl_item_item_date_repaired" class="tbl_item_item_date_repaired"><?php echo $tbl_item_delete->item_date_repaired->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_delete->item_transmittal->Visible) { // item_transmittal ?>
		<th class="<?php echo $tbl_item_delete->item_transmittal->headerCellClass() ?>"><span id="elh_tbl_item_item_transmittal" class="tbl_item_item_transmittal"><?php echo $tbl_item_delete->item_transmittal->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_delete->Province->Visible) { // Province ?>
		<th class="<?php echo $tbl_item_delete->Province->headerCellClass() ?>"><span id="elh_tbl_item_Province" class="tbl_item_Province"><?php echo $tbl_item_delete->Province->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_delete->Cities->Visible) { // Cities ?>
		<th class="<?php echo $tbl_item_delete->Cities->headerCellClass() ?>"><span id="elh_tbl_item_Cities" class="tbl_item_Cities"><?php echo $tbl_item_delete->Cities->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_delete->employeeid->Visible) { // employeeid ?>
		<th class="<?php echo $tbl_item_delete->employeeid->headerCellClass() ?>"><span id="elh_tbl_item_employeeid" class="tbl_item_employeeid"><?php echo $tbl_item_delete->employeeid->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_item_delete->status_id->Visible) { // status_id ?>
		<th class="<?php echo $tbl_item_delete->status_id->headerCellClass() ?>"><span id="elh_tbl_item_status_id" class="tbl_item_status_id"><?php echo $tbl_item_delete->status_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_item_delete->RecordCount = 0;
$i = 0;
while (!$tbl_item_delete->Recordset->EOF) {
	$tbl_item_delete->RecordCount++;
	$tbl_item_delete->RowCount++;

	// Set row properties
	$tbl_item->resetAttributes();
	$tbl_item->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_item_delete->loadRowValues($tbl_item_delete->Recordset);

	// Render row
	$tbl_item_delete->renderRow();
?>
	<tr <?php echo $tbl_item->rowAttributes() ?>>
<?php if ($tbl_item_delete->SRN->Visible) { // SRN ?>
		<td <?php echo $tbl_item_delete->SRN->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_SRN" class="tbl_item_SRN">
<span<?php echo $tbl_item_delete->SRN->viewAttributes() ?>><?php echo $tbl_item_delete->SRN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_delete->item_date_receive->Visible) { // item_date_receive ?>
		<td <?php echo $tbl_item_delete->item_date_receive->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_item_date_receive" class="tbl_item_item_date_receive">
<span<?php echo $tbl_item_delete->item_date_receive->viewAttributes() ?>><?php echo $tbl_item_delete->item_date_receive->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_delete->item_date_repaired->Visible) { // item_date_repaired ?>
		<td <?php echo $tbl_item_delete->item_date_repaired->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_item_date_repaired" class="tbl_item_item_date_repaired">
<span<?php echo $tbl_item_delete->item_date_repaired->viewAttributes() ?>><?php echo $tbl_item_delete->item_date_repaired->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_delete->item_transmittal->Visible) { // item_transmittal ?>
		<td <?php echo $tbl_item_delete->item_transmittal->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_item_transmittal" class="tbl_item_item_transmittal">
<span<?php echo $tbl_item_delete->item_transmittal->viewAttributes() ?>><?php echo $tbl_item_delete->item_transmittal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_delete->Province->Visible) { // Province ?>
		<td <?php echo $tbl_item_delete->Province->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_Province" class="tbl_item_Province">
<span<?php echo $tbl_item_delete->Province->viewAttributes() ?>><?php echo $tbl_item_delete->Province->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_delete->Cities->Visible) { // Cities ?>
		<td <?php echo $tbl_item_delete->Cities->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_Cities" class="tbl_item_Cities">
<span<?php echo $tbl_item_delete->Cities->viewAttributes() ?>><?php echo $tbl_item_delete->Cities->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_delete->employeeid->Visible) { // employeeid ?>
		<td <?php echo $tbl_item_delete->employeeid->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_employeeid" class="tbl_item_employeeid">
<span<?php echo $tbl_item_delete->employeeid->viewAttributes() ?>><?php echo $tbl_item_delete->employeeid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_item_delete->status_id->Visible) { // status_id ?>
		<td <?php echo $tbl_item_delete->status_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_item_delete->RowCount ?>_tbl_item_status_id" class="tbl_item_status_id">
<span<?php echo $tbl_item_delete->status_id->viewAttributes() ?>><?php echo $tbl_item_delete->status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_item_delete->Recordset->moveNext();
}
$tbl_item_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_item_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_item_delete->showPageFooter();
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
$tbl_item_delete->terminate();
?>