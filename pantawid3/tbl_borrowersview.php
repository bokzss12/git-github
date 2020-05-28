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
$tbl_borrowers_view = new tbl_borrowers_view();

// Run the page
$tbl_borrowers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_borrowers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_borrowers_view->isExport()) { ?>
<script>
var ftbl_borrowersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_borrowersview = currentForm = new ew.Form("ftbl_borrowersview", "view");
	loadjs.done("ftbl_borrowersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$(document).ready(function(){$("form").append('<button class="btn btn-danger ewButton" name="btnCancel" id="btnCancel" type="Button"><?php echo $Language->Phrase("") ?>Back</button>'),$("#btnCancel").attr("onClick","window.history.back()")});
});
</script>
<?php } ?>
<?php if (!$tbl_borrowers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_borrowers_view->ExportOptions->render("body") ?>
<?php $tbl_borrowers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_borrowers_view->showPageHeader(); ?>
<?php
$tbl_borrowers_view->showMessage();
?>
<form name="ftbl_borrowersview" id="ftbl_borrowersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_borrowers">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_borrowers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_borrowers_view->borrowers_id->Visible) { // borrowers_id ?>
	<tr id="r_borrowers_id">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_borrowers_id"><?php echo $tbl_borrowers_view->borrowers_id->caption() ?></span></td>
		<td data-name="borrowers_id" <?php echo $tbl_borrowers_view->borrowers_id->cellAttributes() ?>>
<span id="el_tbl_borrowers_borrowers_id">
<span<?php echo $tbl_borrowers_view->borrowers_id->viewAttributes() ?>><?php echo $tbl_borrowers_view->borrowers_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->Date_Barrowed->Visible) { // Date_Barrowed ?>
	<tr id="r_Date_Barrowed">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_Date_Barrowed"><?php echo $tbl_borrowers_view->Date_Barrowed->caption() ?></span></td>
		<td data-name="Date_Barrowed" <?php echo $tbl_borrowers_view->Date_Barrowed->cellAttributes() ?>>
<span id="el_tbl_borrowers_Date_Barrowed">
<span<?php echo $tbl_borrowers_view->Date_Barrowed->viewAttributes() ?>><?php echo $tbl_borrowers_view->Date_Barrowed->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->Date_Returned->Visible) { // Date_Returned ?>
	<tr id="r_Date_Returned">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_Date_Returned"><?php echo $tbl_borrowers_view->Date_Returned->caption() ?></span></td>
		<td data-name="Date_Returned" <?php echo $tbl_borrowers_view->Date_Returned->cellAttributes() ?>>
<span id="el_tbl_borrowers_Date_Returned">
<span<?php echo $tbl_borrowers_view->Date_Returned->viewAttributes() ?>><?php echo $tbl_borrowers_view->Date_Returned->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->item_type->Visible) { // item_type ?>
	<tr id="r_item_type">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_item_type"><?php echo $tbl_borrowers_view->item_type->caption() ?></span></td>
		<td data-name="item_type" <?php echo $tbl_borrowers_view->item_type->cellAttributes() ?>>
<span id="el_tbl_borrowers_item_type">
<span<?php echo $tbl_borrowers_view->item_type->viewAttributes() ?>><?php echo $tbl_borrowers_view->item_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->item_model->Visible) { // item_model ?>
	<tr id="r_item_model">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_item_model"><?php echo $tbl_borrowers_view->item_model->caption() ?></span></td>
		<td data-name="item_model" <?php echo $tbl_borrowers_view->item_model->cellAttributes() ?>>
<span id="el_tbl_borrowers_item_model">
<span<?php echo $tbl_borrowers_view->item_model->viewAttributes() ?>><?php echo $tbl_borrowers_view->item_model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->item_serial->Visible) { // item_serial ?>
	<tr id="r_item_serial">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_item_serial"><?php echo $tbl_borrowers_view->item_serial->caption() ?></span></td>
		<td data-name="item_serial" <?php echo $tbl_borrowers_view->item_serial->cellAttributes() ?>>
<span id="el_tbl_borrowers_item_serial">
<span<?php echo $tbl_borrowers_view->item_serial->viewAttributes() ?>><?php echo $tbl_borrowers_view->item_serial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->name_barrowers->Visible) { // name_barrowers ?>
	<tr id="r_name_barrowers">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_name_barrowers"><?php echo $tbl_borrowers_view->name_barrowers->caption() ?></span></td>
		<td data-name="name_barrowers" <?php echo $tbl_borrowers_view->name_barrowers->cellAttributes() ?>>
<span id="el_tbl_borrowers_name_barrowers">
<span<?php echo $tbl_borrowers_view->name_barrowers->viewAttributes() ?>><?php echo $tbl_borrowers_view->name_barrowers->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->Designation->Visible) { // Designation ?>
	<tr id="r_Designation">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_Designation"><?php echo $tbl_borrowers_view->Designation->caption() ?></span></td>
		<td data-name="Designation" <?php echo $tbl_borrowers_view->Designation->cellAttributes() ?>>
<span id="el_tbl_borrowers_Designation">
<span<?php echo $tbl_borrowers_view->Designation->viewAttributes() ?>><?php echo $tbl_borrowers_view->Designation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->office_id->Visible) { // office_id ?>
	<tr id="r_office_id">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_office_id"><?php echo $tbl_borrowers_view->office_id->caption() ?></span></td>
		<td data-name="office_id" <?php echo $tbl_borrowers_view->office_id->cellAttributes() ?>>
<span id="el_tbl_borrowers_office_id">
<span<?php echo $tbl_borrowers_view->office_id->viewAttributes() ?>><?php echo $tbl_borrowers_view->office_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_status"><?php echo $tbl_borrowers_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $tbl_borrowers_view->status->cellAttributes() ?>>
<span id="el_tbl_borrowers_status">
<span<?php echo $tbl_borrowers_view->status->viewAttributes() ?>><?php echo $tbl_borrowers_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->Remarks->Visible) { // Remarks ?>
	<tr id="r_Remarks">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_Remarks"><?php echo $tbl_borrowers_view->Remarks->caption() ?></span></td>
		<td data-name="Remarks" <?php echo $tbl_borrowers_view->Remarks->cellAttributes() ?>>
<span id="el_tbl_borrowers_Remarks">
<span<?php echo $tbl_borrowers_view->Remarks->viewAttributes() ?>><?php echo $tbl_borrowers_view->Remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_user_last_modify"><?php echo $tbl_borrowers_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_borrowers_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_borrowers_user_last_modify">
<span<?php echo $tbl_borrowers_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_borrowers_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_borrowers_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $tbl_borrowers_view->TableLeftColumnClass ?>"><span id="elh_tbl_borrowers_date_last_modify"><?php echo $tbl_borrowers_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $tbl_borrowers_view->date_last_modify->cellAttributes() ?>>
<span id="el_tbl_borrowers_date_last_modify">
<span<?php echo $tbl_borrowers_view->date_last_modify->viewAttributes() ?>><?php echo $tbl_borrowers_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_borrowers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_borrowers_view->isExport()) { ?>
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
$tbl_borrowers_view->terminate();
?>