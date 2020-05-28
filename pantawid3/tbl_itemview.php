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
$tbl_item_view = new tbl_item_view();

// Run the page
$tbl_item_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_item_view->isExport()) { ?>
<script>
var ftbl_itemview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_itemview = currentForm = new ew.Form("ftbl_itemview", "view");
	loadjs.done("ftbl_itemview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$(document).ready(function(){$("form").append('<button class="btn btn-danger ewButton" name="btnCancel" id="btnCancel" type="Button"><?php echo $Language->Phrase("") ?>Back</button>'),$("#btnCancel").attr("onClick","document.location.href='tbl_itemlist.php';")});
});
</script>
<?php } ?>
<?php if (!$tbl_item_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_item_view->ExportOptions->render("body") ?>
<?php $tbl_item_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_item_view->showPageHeader(); ?>
<?php
$tbl_item_view->showMessage();
?>
<form name="ftbl_itemview" id="ftbl_itemview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_item_view->IsModal ?>">
<?php if (!$tbl_item_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="tbl_item_view"><!-- multi-page tabs -->
	<ul class="<?php echo $tbl_item_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $tbl_item_view->MultiPages->pageStyle(1) ?>" href="#tab_tbl_item1" data-toggle="tab"><?php echo $tbl_item->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_item_view->MultiPages->pageStyle(2) ?>" href="#tab_tbl_item2" data-toggle="tab"><?php echo $tbl_item->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$tbl_item_view->isExport()) { ?>
		<div class="tab-pane<?php echo $tbl_item_view->MultiPages->pageStyle(1) ?>" id="tab_tbl_item1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_item_view->SRN->Visible) { // SRN ?>
	<tr id="r_SRN">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_SRN"><?php echo $tbl_item_view->SRN->caption() ?></span></td>
		<td data-name="SRN" <?php echo $tbl_item_view->SRN->cellAttributes() ?>>
<span id="el_tbl_item_SRN" data-page="1">
<span<?php echo $tbl_item_view->SRN->viewAttributes() ?>><?php echo $tbl_item_view->SRN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_date_receive->Visible) { // item_date_receive ?>
	<tr id="r_item_date_receive">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_date_receive"><?php echo $tbl_item_view->item_date_receive->caption() ?></span></td>
		<td data-name="item_date_receive" <?php echo $tbl_item_view->item_date_receive->cellAttributes() ?>>
<span id="el_tbl_item_item_date_receive" data-page="1">
<span<?php echo $tbl_item_view->item_date_receive->viewAttributes() ?>><?php echo $tbl_item_view->item_date_receive->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_transmittal->Visible) { // item_transmittal ?>
	<tr id="r_item_transmittal">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_transmittal"><?php echo $tbl_item_view->item_transmittal->caption() ?></span></td>
		<td data-name="item_transmittal" <?php echo $tbl_item_view->item_transmittal->cellAttributes() ?>>
<span id="el_tbl_item_item_transmittal" data-page="1">
<span<?php echo $tbl_item_view->item_transmittal->viewAttributes() ?>><?php echo $tbl_item_view->item_transmittal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->position->Visible) { // position ?>
	<tr id="r_position">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_position"><?php echo $tbl_item_view->position->caption() ?></span></td>
		<td data-name="position" <?php echo $tbl_item_view->position->cellAttributes() ?>>
<span id="el_tbl_item_position" data-page="1">
<span<?php echo $tbl_item_view->position->viewAttributes() ?>><?php echo $tbl_item_view->position->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->Contact_no->Visible) { // Contact_no ?>
	<tr id="r_Contact_no">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_Contact_no"><?php echo $tbl_item_view->Contact_no->caption() ?></span></td>
		<td data-name="Contact_no" <?php echo $tbl_item_view->Contact_no->cellAttributes() ?>>
<span id="el_tbl_item_Contact_no" data-page="1">
<span<?php echo $tbl_item_view->Contact_no->viewAttributes() ?>><?php echo $tbl_item_view->Contact_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->__Request->Visible) { // Request ?>
	<tr id="r___Request">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item___Request"><?php echo $tbl_item_view->__Request->caption() ?></span></td>
		<td data-name="__Request" <?php echo $tbl_item_view->__Request->cellAttributes() ?>>
<span id="el_tbl_item___Request" data-page="1">
<span<?php echo $tbl_item_view->__Request->viewAttributes() ?>><?php echo $tbl_item_view->__Request->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_type->Visible) { // item_type ?>
	<tr id="r_item_type">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_type"><?php echo $tbl_item_view->item_type->caption() ?></span></td>
		<td data-name="item_type" <?php echo $tbl_item_view->item_type->cellAttributes() ?>>
<span id="el_tbl_item_item_type" data-page="1">
<span<?php echo $tbl_item_view->item_type->viewAttributes() ?>><?php echo $tbl_item_view->item_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_model->Visible) { // item_model ?>
	<tr id="r_item_model">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_model"><?php echo $tbl_item_view->item_model->caption() ?></span></td>
		<td data-name="item_model" <?php echo $tbl_item_view->item_model->cellAttributes() ?>>
<span id="el_tbl_item_item_model" data-page="1">
<span<?php echo $tbl_item_view->item_model->viewAttributes() ?>><?php echo $tbl_item_view->item_model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_serno->Visible) { // item_serno ?>
	<tr id="r_item_serno">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_serno"><?php echo $tbl_item_view->item_serno->caption() ?></span></td>
		<td data-name="item_serno" <?php echo $tbl_item_view->item_serno->cellAttributes() ?>>
<span id="el_tbl_item_item_serno" data-page="1">
<span<?php echo $tbl_item_view->item_serno->viewAttributes() ?>><?php echo $tbl_item_view->item_serno->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_requested_unit->Visible) { // item_requested_unit ?>
	<tr id="r_item_requested_unit">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_requested_unit"><?php echo $tbl_item_view->item_requested_unit->caption() ?></span></td>
		<td data-name="item_requested_unit" <?php echo $tbl_item_view->item_requested_unit->cellAttributes() ?>>
<span id="el_tbl_item_item_requested_unit" data-page="1">
<span<?php echo $tbl_item_view->item_requested_unit->viewAttributes() ?>><?php echo $tbl_item_view->item_requested_unit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_Region"><?php echo $tbl_item_view->Region->caption() ?></span></td>
		<td data-name="Region" <?php echo $tbl_item_view->Region->cellAttributes() ?>>
<span id="el_tbl_item_Region" data-page="1">
<span<?php echo $tbl_item_view->Region->viewAttributes() ?>><?php echo $tbl_item_view->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->Province->Visible) { // Province ?>
	<tr id="r_Province">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_Province"><?php echo $tbl_item_view->Province->caption() ?></span></td>
		<td data-name="Province" <?php echo $tbl_item_view->Province->cellAttributes() ?>>
<span id="el_tbl_item_Province" data-page="1">
<span<?php echo $tbl_item_view->Province->viewAttributes() ?>><?php echo $tbl_item_view->Province->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->Cities->Visible) { // Cities ?>
	<tr id="r_Cities">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_Cities"><?php echo $tbl_item_view->Cities->caption() ?></span></td>
		<td data-name="Cities" <?php echo $tbl_item_view->Cities->cellAttributes() ?>>
<span id="el_tbl_item_Cities" data-page="1">
<span<?php echo $tbl_item_view->Cities->viewAttributes() ?>><?php echo $tbl_item_view->Cities->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->Current_loc->Visible) { // Current_loc ?>
	<tr id="r_Current_loc">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_Current_loc"><?php echo $tbl_item_view->Current_loc->caption() ?></span></td>
		<td data-name="Current_loc" <?php echo $tbl_item_view->Current_loc->cellAttributes() ?>>
<span id="el_tbl_item_Current_loc" data-page="1">
<span<?php echo $tbl_item_view->Current_loc->viewAttributes() ?>><?php echo $tbl_item_view->Current_loc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_user_last_modify"><?php echo $tbl_item_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_item_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_item_user_last_modify" data-page="1">
<span<?php echo $tbl_item_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_item_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_date_last_modify"><?php echo $tbl_item_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $tbl_item_view->date_last_modify->cellAttributes() ?>>
<span id="el_tbl_item_date_last_modify" data-page="1">
<span<?php echo $tbl_item_view->date_last_modify->viewAttributes() ?>><?php echo $tbl_item_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$tbl_item_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$tbl_item_view->isExport()) { ?>
		<div class="tab-pane<?php echo $tbl_item_view->MultiPages->pageStyle(2) ?>" id="tab_tbl_item2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_item_view->item_date_repaired->Visible) { // item_date_repaired ?>
	<tr id="r_item_date_repaired">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_date_repaired"><?php echo $tbl_item_view->item_date_repaired->caption() ?></span></td>
		<td data-name="item_date_repaired" <?php echo $tbl_item_view->item_date_repaired->cellAttributes() ?>>
<span id="el_tbl_item_item_date_repaired" data-page="2">
<span<?php echo $tbl_item_view->item_date_repaired->viewAttributes() ?>><?php echo $tbl_item_view->item_date_repaired->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_date_pullout->Visible) { // item_date_pullout ?>
	<tr id="r_item_date_pullout">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_date_pullout"><?php echo $tbl_item_view->item_date_pullout->caption() ?></span></td>
		<td data-name="item_date_pullout" <?php echo $tbl_item_view->item_date_pullout->cellAttributes() ?>>
<span id="el_tbl_item_item_date_pullout" data-page="2">
<span<?php echo $tbl_item_view->item_date_pullout->viewAttributes() ?>><?php echo $tbl_item_view->item_date_pullout->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_type_problem->Visible) { // item_type_problem ?>
	<tr id="r_item_type_problem">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_type_problem"><?php echo $tbl_item_view->item_type_problem->caption() ?></span></td>
		<td data-name="item_type_problem" <?php echo $tbl_item_view->item_type_problem->cellAttributes() ?>>
<span id="el_tbl_item_item_type_problem" data-page="2">
<span<?php echo $tbl_item_view->item_type_problem->viewAttributes() ?>><?php echo $tbl_item_view->item_type_problem->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->item_action_taken->Visible) { // item_action_taken ?>
	<tr id="r_item_action_taken">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_item_action_taken"><?php echo $tbl_item_view->item_action_taken->caption() ?></span></td>
		<td data-name="item_action_taken" <?php echo $tbl_item_view->item_action_taken->cellAttributes() ?>>
<span id="el_tbl_item_item_action_taken" data-page="2">
<span<?php echo $tbl_item_view->item_action_taken->viewAttributes() ?>><?php echo $tbl_item_view->item_action_taken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->employeeid->Visible) { // employeeid ?>
	<tr id="r_employeeid">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_employeeid"><?php echo $tbl_item_view->employeeid->caption() ?></span></td>
		<td data-name="employeeid" <?php echo $tbl_item_view->employeeid->cellAttributes() ?>>
<span id="el_tbl_item_employeeid" data-page="2">
<span<?php echo $tbl_item_view->employeeid->viewAttributes() ?>><?php echo $tbl_item_view->employeeid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->status_id->Visible) { // status_id ?>
	<tr id="r_status_id">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_status_id"><?php echo $tbl_item_view->status_id->caption() ?></span></td>
		<td data-name="status_id" <?php echo $tbl_item_view->status_id->cellAttributes() ?>>
<span id="el_tbl_item_status_id" data-page="2">
<span<?php echo $tbl_item_view->status_id->viewAttributes() ?>><?php echo $tbl_item_view->status_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_view->remarks->Visible) { // remarks ?>
	<tr id="r_remarks">
		<td class="<?php echo $tbl_item_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_remarks"><?php echo $tbl_item_view->remarks->caption() ?></span></td>
		<td data-name="remarks" <?php echo $tbl_item_view->remarks->cellAttributes() ?>>
<span id="el_tbl_item_remarks" data-page="2">
<span<?php echo $tbl_item_view->remarks->viewAttributes() ?>><?php echo $tbl_item_view->remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$tbl_item_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$tbl_item_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
</form>
<?php
$tbl_item_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_item_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");

	/*$(document).ready(function() {
	$('.ewAdd').hide();
	$('.ewCopy').hide();
	$('.ewEdit').hide();
	$('.ewDelete').hide();
	}); */
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$tbl_item_view->terminate();
?>