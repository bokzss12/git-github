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
$tbl_inventory_view = new tbl_inventory_view();

// Run the page
$tbl_inventory_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_inventory_view->isExport()) { ?>
<script>
var ftbl_inventoryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_inventoryview = currentForm = new ew.Form("ftbl_inventoryview", "view");
	loadjs.done("ftbl_inventoryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

	/*
	$(document).ready(function() {
	$('form').append('<button class="btn btn-danger ewButton" name="btnCancel" id="btnCancel" type="Button"><?php echo $Language->Phrase("") ?>Print Barcode</button>');
	$('#btnCancel').attr('onClick', "document.location.href='barcodessrch.php';");
	//$('#btnCancel').attr('onClick', "document.location.href='barcodeslist.php?x_concat_id=';");
	});
	*/
});
</script>
<?php } ?>
<?php if (!$tbl_inventory_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_inventory_view->ExportOptions->render("body") ?>
<?php $tbl_inventory_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_inventory_view->showPageHeader(); ?>
<?php
$tbl_inventory_view->showMessage();
?>
<form name="ftbl_inventoryview" id="ftbl_inventoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_inventory_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_inventory_view->concat_inventory->Visible) { // concat_inventory ?>
	<tr id="r_concat_inventory">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_concat_inventory"><?php echo $tbl_inventory_view->concat_inventory->caption() ?></span></td>
		<td data-name="concat_inventory" <?php echo $tbl_inventory_view->concat_inventory->cellAttributes() ?>>
<span id="el_tbl_inventory_concat_inventory">
<span<?php echo $tbl_inventory_view->concat_inventory->viewAttributes() ?>><?php if (!EmptyString($tbl_inventory_view->concat_inventory->getViewValue()) && $tbl_inventory_view->concat_inventory->linkAttributes() != "") { ?>
<a<?php echo $tbl_inventory_view->concat_inventory->linkAttributes() ?>><?php echo $tbl_inventory_view->concat_inventory->getViewValue() ?></a>
<?php } else { ?>
<?php echo $tbl_inventory_view->concat_inventory->getViewValue() ?>
<?php } ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Month_Purchased->Visible) { // Month_Purchased ?>
	<tr id="r_Month_Purchased">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Month_Purchased"><?php echo $tbl_inventory_view->Month_Purchased->caption() ?></span></td>
		<td data-name="Month_Purchased" <?php echo $tbl_inventory_view->Month_Purchased->cellAttributes() ?>>
<span id="el_tbl_inventory_Month_Purchased">
<span<?php echo $tbl_inventory_view->Month_Purchased->viewAttributes() ?>><?php echo $tbl_inventory_view->Month_Purchased->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Year_Purchased->Visible) { // Year_Purchased ?>
	<tr id="r_Year_Purchased">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Year_Purchased"><?php echo $tbl_inventory_view->Year_Purchased->caption() ?></span></td>
		<td data-name="Year_Purchased" <?php echo $tbl_inventory_view->Year_Purchased->cellAttributes() ?>>
<span id="el_tbl_inventory_Year_Purchased">
<span<?php echo $tbl_inventory_view->Year_Purchased->viewAttributes() ?>><?php echo $tbl_inventory_view->Year_Purchased->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->item_type->Visible) { // item_type ?>
	<tr id="r_item_type">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_item_type"><?php echo $tbl_inventory_view->item_type->caption() ?></span></td>
		<td data-name="item_type" <?php echo $tbl_inventory_view->item_type->cellAttributes() ?>>
<span id="el_tbl_inventory_item_type">
<span<?php echo $tbl_inventory_view->item_type->viewAttributes() ?>><?php echo $tbl_inventory_view->item_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->item_model->Visible) { // item_model ?>
	<tr id="r_item_model">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_item_model"><?php echo $tbl_inventory_view->item_model->caption() ?></span></td>
		<td data-name="item_model" <?php echo $tbl_inventory_view->item_model->cellAttributes() ?>>
<span id="el_tbl_inventory_item_model">
<span<?php echo $tbl_inventory_view->item_model->viewAttributes() ?>><?php echo $tbl_inventory_view->item_model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->item_serial->Visible) { // item_serial ?>
	<tr id="r_item_serial">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_item_serial"><?php echo $tbl_inventory_view->item_serial->caption() ?></span></td>
		<td data-name="item_serial" <?php echo $tbl_inventory_view->item_serial->cellAttributes() ?>>
<span id="el_tbl_inventory_item_serial">
<span<?php echo $tbl_inventory_view->item_serial->viewAttributes() ?>><?php echo $tbl_inventory_view->item_serial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->office_id->Visible) { // office_id ?>
	<tr id="r_office_id">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_office_id"><?php echo $tbl_inventory_view->office_id->caption() ?></span></td>
		<td data-name="office_id" <?php echo $tbl_inventory_view->office_id->cellAttributes() ?>>
<span id="el_tbl_inventory_office_id">
<span<?php echo $tbl_inventory_view->office_id->viewAttributes() ?>><?php echo $tbl_inventory_view->office_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Region"><?php echo $tbl_inventory_view->Region->caption() ?></span></td>
		<td data-name="Region" <?php echo $tbl_inventory_view->Region->cellAttributes() ?>>
<span id="el_tbl_inventory_Region">
<span<?php echo $tbl_inventory_view->Region->viewAttributes() ?>><?php echo $tbl_inventory_view->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Province->Visible) { // Province ?>
	<tr id="r_Province">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Province"><?php echo $tbl_inventory_view->Province->caption() ?></span></td>
		<td data-name="Province" <?php echo $tbl_inventory_view->Province->cellAttributes() ?>>
<span id="el_tbl_inventory_Province">
<span<?php echo $tbl_inventory_view->Province->viewAttributes() ?>><?php echo $tbl_inventory_view->Province->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Cities->Visible) { // Cities ?>
	<tr id="r_Cities">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Cities"><?php echo $tbl_inventory_view->Cities->caption() ?></span></td>
		<td data-name="Cities" <?php echo $tbl_inventory_view->Cities->cellAttributes() ?>>
<span id="el_tbl_inventory_Cities">
<span<?php echo $tbl_inventory_view->Cities->viewAttributes() ?>><?php echo $tbl_inventory_view->Cities->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->name_accountable->Visible) { // name_accountable ?>
	<tr id="r_name_accountable">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_name_accountable"><?php echo $tbl_inventory_view->name_accountable->caption() ?></span></td>
		<td data-name="name_accountable" <?php echo $tbl_inventory_view->name_accountable->cellAttributes() ?>>
<span id="el_tbl_inventory_name_accountable">
<span<?php echo $tbl_inventory_view->name_accountable->viewAttributes() ?>><?php echo $tbl_inventory_view->name_accountable->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Designation->Visible) { // Designation ?>
	<tr id="r_Designation">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Designation"><?php echo $tbl_inventory_view->Designation->caption() ?></span></td>
		<td data-name="Designation" <?php echo $tbl_inventory_view->Designation->cellAttributes() ?>>
<span id="el_tbl_inventory_Designation">
<span<?php echo $tbl_inventory_view->Designation->viewAttributes() ?>><?php echo $tbl_inventory_view->Designation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Current_Location->Visible) { // Current_Location ?>
	<tr id="r_Current_Location">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Current_Location"><?php echo $tbl_inventory_view->Current_Location->caption() ?></span></td>
		<td data-name="Current_Location" <?php echo $tbl_inventory_view->Current_Location->cellAttributes() ?>>
<span id="el_tbl_inventory_Current_Location">
<span<?php echo $tbl_inventory_view->Current_Location->viewAttributes() ?>><?php echo $tbl_inventory_view->Current_Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->Last_Date_Check->Visible) { // Last_Date_Check ?>
	<tr id="r_Last_Date_Check">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Last_Date_Check"><?php echo $tbl_inventory_view->Last_Date_Check->caption() ?></span></td>
		<td data-name="Last_Date_Check" <?php echo $tbl_inventory_view->Last_Date_Check->cellAttributes() ?>>
<span id="el_tbl_inventory_Last_Date_Check">
<span<?php echo $tbl_inventory_view->Last_Date_Check->viewAttributes() ?>><?php echo $tbl_inventory_view->Last_Date_Check->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->employee_id->Visible) { // employee_id ?>
	<tr id="r_employee_id">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_employee_id"><?php echo $tbl_inventory_view->employee_id->caption() ?></span></td>
		<td data-name="employee_id" <?php echo $tbl_inventory_view->employee_id->cellAttributes() ?>>
<span id="el_tbl_inventory_employee_id">
<span<?php echo $tbl_inventory_view->employee_id->viewAttributes() ?>><?php echo $tbl_inventory_view->employee_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_status"><?php echo $tbl_inventory_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $tbl_inventory_view->status->cellAttributes() ?>>
<span id="el_tbl_inventory_status">
<span<?php echo $tbl_inventory_view->status->viewAttributes() ?>><?php echo $tbl_inventory_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->remarks->Visible) { // remarks ?>
	<tr id="r_remarks">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_remarks"><?php echo $tbl_inventory_view->remarks->caption() ?></span></td>
		<td data-name="remarks" <?php echo $tbl_inventory_view->remarks->cellAttributes() ?>>
<span id="el_tbl_inventory_remarks">
<span<?php echo $tbl_inventory_view->remarks->viewAttributes() ?>><?php echo $tbl_inventory_view->remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->picture->Visible) { // picture ?>
	<tr id="r_picture">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_picture"><?php echo $tbl_inventory_view->picture->caption() ?></span></td>
		<td data-name="picture" <?php echo $tbl_inventory_view->picture->cellAttributes() ?>>
<span id="el_tbl_inventory_picture">
<span><?php echo GetFileViewTag($tbl_inventory_view->picture, $tbl_inventory_view->picture->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_user_last_modify"><?php echo $tbl_inventory_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_inventory_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_inventory_user_last_modify">
<span<?php echo $tbl_inventory_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_inventory_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_date_last_modify"><?php echo $tbl_inventory_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $tbl_inventory_view->date_last_modify->cellAttributes() ?>>
<span id="el_tbl_inventory_date_last_modify">
<span<?php echo $tbl_inventory_view->date_last_modify->viewAttributes() ?>><?php echo $tbl_inventory_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_view->pullout_date->Visible) { // pullout_date ?>
	<tr id="r_pullout_date">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_pullout_date"><?php echo $tbl_inventory_view->pullout_date->caption() ?></span></td>
		<td data-name="pullout_date" <?php echo $tbl_inventory_view->pullout_date->cellAttributes() ?>>
<span id="el_tbl_inventory_pullout_date">
<span<?php echo $tbl_inventory_view->pullout_date->viewAttributes() ?>><?php echo $tbl_inventory_view->pullout_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tbl_repair", explode(",", $tbl_inventory->getCurrentDetailTable())) && $tbl_repair->DetailView) {
?>
<?php if ($tbl_inventory->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("tbl_repair", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $tbl_inventory_view->tbl_repair_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "tbl_repairgrid.php" ?>
<?php } ?>
</form>
<?php
$tbl_inventory_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_inventory_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$tbl_inventory_view->terminate();
?>