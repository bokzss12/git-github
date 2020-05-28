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
$tbl_repair_view = new tbl_repair_view();

// Run the page
$tbl_repair_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_repair_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_repair_view->isExport()) { ?>
<script>
var ftbl_repairview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_repairview = currentForm = new ew.Form("ftbl_repairview", "view");
	loadjs.done("ftbl_repairview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_repair_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_repair_view->ExportOptions->render("body") ?>
<?php $tbl_repair_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_repair_view->showPageHeader(); ?>
<?php
$tbl_repair_view->showMessage();
?>
<form name="ftbl_repairview" id="ftbl_repairview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_repair">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_repair_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_repair_view->inventory_id->Visible) { // inventory_id ?>
	<tr id="r_inventory_id">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_inventory_id"><?php echo $tbl_repair_view->inventory_id->caption() ?></span></td>
		<td data-name="inventory_id" <?php echo $tbl_repair_view->inventory_id->cellAttributes() ?>>
<span id="el_tbl_repair_inventory_id">
<span<?php echo $tbl_repair_view->inventory_id->viewAttributes() ?>><?php echo $tbl_repair_view->inventory_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->current_loc_r->Visible) { // current_loc_r ?>
	<tr id="r_current_loc_r">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_current_loc_r"><?php echo $tbl_repair_view->current_loc_r->caption() ?></span></td>
		<td data-name="current_loc_r" <?php echo $tbl_repair_view->current_loc_r->cellAttributes() ?>>
<span id="el_tbl_repair_current_loc_r">
<span<?php echo $tbl_repair_view->current_loc_r->viewAttributes() ?>><?php echo $tbl_repair_view->current_loc_r->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->date_received->Visible) { // date_received ?>
	<tr id="r_date_received">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_date_received"><?php echo $tbl_repair_view->date_received->caption() ?></span></td>
		<td data-name="date_received" <?php echo $tbl_repair_view->date_received->cellAttributes() ?>>
<span id="el_tbl_repair_date_received">
<span<?php echo $tbl_repair_view->date_received->viewAttributes() ?>><?php echo $tbl_repair_view->date_received->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->date_repaired->Visible) { // date_repaired ?>
	<tr id="r_date_repaired">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_date_repaired"><?php echo $tbl_repair_view->date_repaired->caption() ?></span></td>
		<td data-name="date_repaired" <?php echo $tbl_repair_view->date_repaired->cellAttributes() ?>>
<span id="el_tbl_repair_date_repaired">
<span<?php echo $tbl_repair_view->date_repaired->viewAttributes() ?>><?php echo $tbl_repair_view->date_repaired->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->name_accountable->Visible) { // name_accountable ?>
	<tr id="r_name_accountable">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_name_accountable"><?php echo $tbl_repair_view->name_accountable->caption() ?></span></td>
		<td data-name="name_accountable" <?php echo $tbl_repair_view->name_accountable->cellAttributes() ?>>
<span id="el_tbl_repair_name_accountable">
<span<?php echo $tbl_repair_view->name_accountable->viewAttributes() ?>><?php echo $tbl_repair_view->name_accountable->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->Designation->Visible) { // Designation ?>
	<tr id="r_Designation">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_Designation"><?php echo $tbl_repair_view->Designation->caption() ?></span></td>
		<td data-name="Designation" <?php echo $tbl_repair_view->Designation->cellAttributes() ?>>
<span id="el_tbl_repair_Designation">
<span<?php echo $tbl_repair_view->Designation->viewAttributes() ?>><?php echo $tbl_repair_view->Designation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->office_id->Visible) { // office_id ?>
	<tr id="r_office_id">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_office_id"><?php echo $tbl_repair_view->office_id->caption() ?></span></td>
		<td data-name="office_id" <?php echo $tbl_repair_view->office_id->cellAttributes() ?>>
<span id="el_tbl_repair_office_id">
<span<?php echo $tbl_repair_view->office_id->viewAttributes() ?>><?php echo $tbl_repair_view->office_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->region->Visible) { // region ?>
	<tr id="r_region">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_region"><?php echo $tbl_repair_view->region->caption() ?></span></td>
		<td data-name="region" <?php echo $tbl_repair_view->region->cellAttributes() ?>>
<span id="el_tbl_repair_region">
<span<?php echo $tbl_repair_view->region->viewAttributes() ?>><?php echo $tbl_repair_view->region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->province->Visible) { // province ?>
	<tr id="r_province">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_province"><?php echo $tbl_repair_view->province->caption() ?></span></td>
		<td data-name="province" <?php echo $tbl_repair_view->province->cellAttributes() ?>>
<span id="el_tbl_repair_province">
<span<?php echo $tbl_repair_view->province->viewAttributes() ?>><?php echo $tbl_repair_view->province->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->city->Visible) { // city ?>
	<tr id="r_city">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_city"><?php echo $tbl_repair_view->city->caption() ?></span></td>
		<td data-name="city" <?php echo $tbl_repair_view->city->cellAttributes() ?>>
<span id="el_tbl_repair_city">
<span<?php echo $tbl_repair_view->city->viewAttributes() ?>><?php echo $tbl_repair_view->city->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->itemtype->Visible) { // itemtype ?>
	<tr id="r_itemtype">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_itemtype"><?php echo $tbl_repair_view->itemtype->caption() ?></span></td>
		<td data-name="itemtype" <?php echo $tbl_repair_view->itemtype->cellAttributes() ?>>
<span id="el_tbl_repair_itemtype">
<span<?php echo $tbl_repair_view->itemtype->viewAttributes() ?>><?php echo $tbl_repair_view->itemtype->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->itemmodel->Visible) { // itemmodel ?>
	<tr id="r_itemmodel">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_itemmodel"><?php echo $tbl_repair_view->itemmodel->caption() ?></span></td>
		<td data-name="itemmodel" <?php echo $tbl_repair_view->itemmodel->cellAttributes() ?>>
<span id="el_tbl_repair_itemmodel">
<span<?php echo $tbl_repair_view->itemmodel->viewAttributes() ?>><?php echo $tbl_repair_view->itemmodel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->item_serial->Visible) { // item_serial ?>
	<tr id="r_item_serial">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_item_serial"><?php echo $tbl_repair_view->item_serial->caption() ?></span></td>
		<td data-name="item_serial" <?php echo $tbl_repair_view->item_serial->cellAttributes() ?>>
<span id="el_tbl_repair_item_serial">
<span<?php echo $tbl_repair_view->item_serial->viewAttributes() ?>><?php echo $tbl_repair_view->item_serial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->type_problem->Visible) { // type_problem ?>
	<tr id="r_type_problem">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_type_problem"><?php echo $tbl_repair_view->type_problem->caption() ?></span></td>
		<td data-name="type_problem" <?php echo $tbl_repair_view->type_problem->cellAttributes() ?>>
<span id="el_tbl_repair_type_problem">
<span<?php echo $tbl_repair_view->type_problem->viewAttributes() ?>><?php echo $tbl_repair_view->type_problem->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->action_taken->Visible) { // action_taken ?>
	<tr id="r_action_taken">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_action_taken"><?php echo $tbl_repair_view->action_taken->caption() ?></span></td>
		<td data-name="action_taken" <?php echo $tbl_repair_view->action_taken->cellAttributes() ?>>
<span id="el_tbl_repair_action_taken">
<span<?php echo $tbl_repair_view->action_taken->viewAttributes() ?>><?php echo $tbl_repair_view->action_taken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->employee_id->Visible) { // employee_id ?>
	<tr id="r_employee_id">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_employee_id"><?php echo $tbl_repair_view->employee_id->caption() ?></span></td>
		<td data-name="employee_id" <?php echo $tbl_repair_view->employee_id->cellAttributes() ?>>
<span id="el_tbl_repair_employee_id">
<span<?php echo $tbl_repair_view->employee_id->viewAttributes() ?>><?php echo $tbl_repair_view->employee_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->status_h->Visible) { // status_h ?>
	<tr id="r_status_h">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_status_h"><?php echo $tbl_repair_view->status_h->caption() ?></span></td>
		<td data-name="status_h" <?php echo $tbl_repair_view->status_h->cellAttributes() ?>>
<span id="el_tbl_repair_status_h">
<span<?php echo $tbl_repair_view->status_h->viewAttributes() ?>><?php echo $tbl_repair_view->status_h->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->remark->Visible) { // remark ?>
	<tr id="r_remark">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_remark"><?php echo $tbl_repair_view->remark->caption() ?></span></td>
		<td data-name="remark" <?php echo $tbl_repair_view->remark->cellAttributes() ?>>
<span id="el_tbl_repair_remark">
<span<?php echo $tbl_repair_view->remark->viewAttributes() ?>><?php echo $tbl_repair_view->remark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->userlastmodify->Visible) { // userlastmodify ?>
	<tr id="r_userlastmodify">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_userlastmodify"><?php echo $tbl_repair_view->userlastmodify->caption() ?></span></td>
		<td data-name="userlastmodify" <?php echo $tbl_repair_view->userlastmodify->cellAttributes() ?>>
<span id="el_tbl_repair_userlastmodify">
<span<?php echo $tbl_repair_view->userlastmodify->viewAttributes() ?>><?php echo $tbl_repair_view->userlastmodify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_repair_view->datelastmodify->Visible) { // datelastmodify ?>
	<tr id="r_datelastmodify">
		<td class="<?php echo $tbl_repair_view->TableLeftColumnClass ?>"><span id="elh_tbl_repair_datelastmodify"><?php echo $tbl_repair_view->datelastmodify->caption() ?></span></td>
		<td data-name="datelastmodify" <?php echo $tbl_repair_view->datelastmodify->cellAttributes() ?>>
<span id="el_tbl_repair_datelastmodify">
<span<?php echo $tbl_repair_view->datelastmodify->viewAttributes() ?>><?php echo $tbl_repair_view->datelastmodify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_repair_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_repair_view->isExport()) { ?>
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
$tbl_repair_view->terminate();
?>