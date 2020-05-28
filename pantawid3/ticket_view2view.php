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
$ticket_view2_view = new ticket_view2_view();

// Run the page
$ticket_view2_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_view2_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_view2_view->isExport()) { ?>
<script>
var fticket_view2view, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fticket_view2view = currentForm = new ew.Form("fticket_view2view", "view");
	loadjs.done("fticket_view2view");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticket_view2_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ticket_view2_view->ExportOptions->render("body") ?>
<?php $ticket_view2_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ticket_view2_view->showPageHeader(); ?>
<?php
$ticket_view2_view->showMessage();
?>
<form name="fticket_view2view" id="fticket_view2view" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_view2">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_view2_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ticket_view2_view->item_id->Visible) { // item_id ?>
	<tr id="r_item_id">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_id"><?php echo $ticket_view2_view->item_id->caption() ?></span></td>
		<td data-name="item_id" <?php echo $ticket_view2_view->item_id->cellAttributes() ?>>
<span id="el_ticket_view2_item_id">
<span<?php echo $ticket_view2_view->item_id->viewAttributes() ?>><?php echo $ticket_view2_view->item_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->SRN->Visible) { // SRN ?>
	<tr id="r_SRN">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_SRN"><?php echo $ticket_view2_view->SRN->caption() ?></span></td>
		<td data-name="SRN" <?php echo $ticket_view2_view->SRN->cellAttributes() ?>>
<span id="el_ticket_view2_SRN">
<span<?php echo $ticket_view2_view->SRN->viewAttributes() ?>><?php echo $ticket_view2_view->SRN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->__Request->Visible) { // Request ?>
	<tr id="r___Request">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2___Request"><?php echo $ticket_view2_view->__Request->caption() ?></span></td>
		<td data-name="__Request" <?php echo $ticket_view2_view->__Request->cellAttributes() ?>>
<span id="el_ticket_view2___Request">
<span<?php echo $ticket_view2_view->__Request->viewAttributes() ?>><?php echo $ticket_view2_view->__Request->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_date_receive->Visible) { // item_date_receive ?>
	<tr id="r_item_date_receive">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_date_receive"><?php echo $ticket_view2_view->item_date_receive->caption() ?></span></td>
		<td data-name="item_date_receive" <?php echo $ticket_view2_view->item_date_receive->cellAttributes() ?>>
<span id="el_ticket_view2_item_date_receive">
<span<?php echo $ticket_view2_view->item_date_receive->viewAttributes() ?>><?php echo $ticket_view2_view->item_date_receive->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_date_repaired->Visible) { // item_date_repaired ?>
	<tr id="r_item_date_repaired">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_date_repaired"><?php echo $ticket_view2_view->item_date_repaired->caption() ?></span></td>
		<td data-name="item_date_repaired" <?php echo $ticket_view2_view->item_date_repaired->cellAttributes() ?>>
<span id="el_ticket_view2_item_date_repaired">
<span<?php echo $ticket_view2_view->item_date_repaired->viewAttributes() ?>><?php echo $ticket_view2_view->item_date_repaired->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->employeeid->Visible) { // employeeid ?>
	<tr id="r_employeeid">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_employeeid"><?php echo $ticket_view2_view->employeeid->caption() ?></span></td>
		<td data-name="employeeid" <?php echo $ticket_view2_view->employeeid->cellAttributes() ?>>
<span id="el_ticket_view2_employeeid">
<span<?php echo $ticket_view2_view->employeeid->viewAttributes() ?>><?php echo $ticket_view2_view->employeeid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_requested_unit->Visible) { // item_requested_unit ?>
	<tr id="r_item_requested_unit">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_requested_unit"><?php echo $ticket_view2_view->item_requested_unit->caption() ?></span></td>
		<td data-name="item_requested_unit" <?php echo $ticket_view2_view->item_requested_unit->cellAttributes() ?>>
<span id="el_ticket_view2_item_requested_unit">
<span<?php echo $ticket_view2_view->item_requested_unit->viewAttributes() ?>><?php echo $ticket_view2_view->item_requested_unit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_transmittal->Visible) { // item_transmittal ?>
	<tr id="r_item_transmittal">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_transmittal"><?php echo $ticket_view2_view->item_transmittal->caption() ?></span></td>
		<td data-name="item_transmittal" <?php echo $ticket_view2_view->item_transmittal->cellAttributes() ?>>
<span id="el_ticket_view2_item_transmittal">
<span<?php echo $ticket_view2_view->item_transmittal->viewAttributes() ?>><?php echo $ticket_view2_view->item_transmittal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->position->Visible) { // position ?>
	<tr id="r_position">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_position"><?php echo $ticket_view2_view->position->caption() ?></span></td>
		<td data-name="position" <?php echo $ticket_view2_view->position->cellAttributes() ?>>
<span id="el_ticket_view2_position">
<span<?php echo $ticket_view2_view->position->viewAttributes() ?>><?php echo $ticket_view2_view->position->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->Contact_no->Visible) { // Contact_no ?>
	<tr id="r_Contact_no">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_Contact_no"><?php echo $ticket_view2_view->Contact_no->caption() ?></span></td>
		<td data-name="Contact_no" <?php echo $ticket_view2_view->Contact_no->cellAttributes() ?>>
<span id="el_ticket_view2_Contact_no">
<span<?php echo $ticket_view2_view->Contact_no->viewAttributes() ?>><?php echo $ticket_view2_view->Contact_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_type->Visible) { // item_type ?>
	<tr id="r_item_type">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_type"><?php echo $ticket_view2_view->item_type->caption() ?></span></td>
		<td data-name="item_type" <?php echo $ticket_view2_view->item_type->cellAttributes() ?>>
<span id="el_ticket_view2_item_type">
<span<?php echo $ticket_view2_view->item_type->viewAttributes() ?>><?php echo $ticket_view2_view->item_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_model->Visible) { // item_model ?>
	<tr id="r_item_model">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_model"><?php echo $ticket_view2_view->item_model->caption() ?></span></td>
		<td data-name="item_model" <?php echo $ticket_view2_view->item_model->cellAttributes() ?>>
<span id="el_ticket_view2_item_model">
<span<?php echo $ticket_view2_view->item_model->viewAttributes() ?>><?php echo $ticket_view2_view->item_model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_serno->Visible) { // item_serno ?>
	<tr id="r_item_serno">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_serno"><?php echo $ticket_view2_view->item_serno->caption() ?></span></td>
		<td data-name="item_serno" <?php echo $ticket_view2_view->item_serno->cellAttributes() ?>>
<span id="el_ticket_view2_item_serno">
<span<?php echo $ticket_view2_view->item_serno->viewAttributes() ?>><?php echo $ticket_view2_view->item_serno->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_Region"><?php echo $ticket_view2_view->Region->caption() ?></span></td>
		<td data-name="Region" <?php echo $ticket_view2_view->Region->cellAttributes() ?>>
<span id="el_ticket_view2_Region">
<span<?php echo $ticket_view2_view->Region->viewAttributes() ?>><?php echo $ticket_view2_view->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->Province->Visible) { // Province ?>
	<tr id="r_Province">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_Province"><?php echo $ticket_view2_view->Province->caption() ?></span></td>
		<td data-name="Province" <?php echo $ticket_view2_view->Province->cellAttributes() ?>>
<span id="el_ticket_view2_Province">
<span<?php echo $ticket_view2_view->Province->viewAttributes() ?>><?php echo $ticket_view2_view->Province->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->Cities->Visible) { // Cities ?>
	<tr id="r_Cities">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_Cities"><?php echo $ticket_view2_view->Cities->caption() ?></span></td>
		<td data-name="Cities" <?php echo $ticket_view2_view->Cities->cellAttributes() ?>>
<span id="el_ticket_view2_Cities">
<span<?php echo $ticket_view2_view->Cities->viewAttributes() ?>><?php echo $ticket_view2_view->Cities->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_type_problem->Visible) { // item_type_problem ?>
	<tr id="r_item_type_problem">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_type_problem"><?php echo $ticket_view2_view->item_type_problem->caption() ?></span></td>
		<td data-name="item_type_problem" <?php echo $ticket_view2_view->item_type_problem->cellAttributes() ?>>
<span id="el_ticket_view2_item_type_problem">
<span<?php echo $ticket_view2_view->item_type_problem->viewAttributes() ?>><?php echo $ticket_view2_view->item_type_problem->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_action_taken->Visible) { // item_action_taken ?>
	<tr id="r_item_action_taken">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_action_taken"><?php echo $ticket_view2_view->item_action_taken->caption() ?></span></td>
		<td data-name="item_action_taken" <?php echo $ticket_view2_view->item_action_taken->cellAttributes() ?>>
<span id="el_ticket_view2_item_action_taken">
<span<?php echo $ticket_view2_view->item_action_taken->viewAttributes() ?>><?php echo $ticket_view2_view->item_action_taken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->item_date_pullout->Visible) { // item_date_pullout ?>
	<tr id="r_item_date_pullout">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_item_date_pullout"><?php echo $ticket_view2_view->item_date_pullout->caption() ?></span></td>
		<td data-name="item_date_pullout" <?php echo $ticket_view2_view->item_date_pullout->cellAttributes() ?>>
<span id="el_ticket_view2_item_date_pullout">
<span<?php echo $ticket_view2_view->item_date_pullout->viewAttributes() ?>><?php echo $ticket_view2_view->item_date_pullout->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->status_desc->Visible) { // status_desc ?>
	<tr id="r_status_desc">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_status_desc"><?php echo $ticket_view2_view->status_desc->caption() ?></span></td>
		<td data-name="status_desc" <?php echo $ticket_view2_view->status_desc->cellAttributes() ?>>
<span id="el_ticket_view2_status_desc">
<span<?php echo $ticket_view2_view->status_desc->viewAttributes() ?>><?php echo $ticket_view2_view->status_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view2_view->remarks->Visible) { // remarks ?>
	<tr id="r_remarks">
		<td class="<?php echo $ticket_view2_view->TableLeftColumnClass ?>"><span id="elh_ticket_view2_remarks"><?php echo $ticket_view2_view->remarks->caption() ?></span></td>
		<td data-name="remarks" <?php echo $ticket_view2_view->remarks->cellAttributes() ?>>
<span id="el_ticket_view2_remarks">
<span<?php echo $ticket_view2_view->remarks->viewAttributes() ?>><?php echo $ticket_view2_view->remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$ticket_view2_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_view2_view->isExport()) { ?>
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
$ticket_view2_view->terminate();
?>