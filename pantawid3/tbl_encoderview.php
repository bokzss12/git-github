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
$tbl_encoder_view = new tbl_encoder_view();

// Run the page
$tbl_encoder_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_encoder_view->isExport()) { ?>
<script>
var ftbl_encoderview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_encoderview = currentForm = new ew.Form("ftbl_encoderview", "view");
	loadjs.done("ftbl_encoderview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$(document).ready(function(){$("form").append('<button class="btn btn-danger ewButton" name="btnCancel" id="btnCancel" type="Button"><?php echo $Language->Phrase("") ?>Add</button>'),$("#btnCancel").attr("onClick","document.location.href='tbl_encoderadd.php';")});
});
</script>
<?php } ?>
<?php if (!$tbl_encoder_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_encoder_view->ExportOptions->render("body") ?>
<?php $tbl_encoder_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_encoder_view->showPageHeader(); ?>
<?php
$tbl_encoder_view->showMessage();
?>
<form name="ftbl_encoderview" id="ftbl_encoderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_encoder_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_encoder_view->date->Visible) { // date ?>
	<tr id="r_date">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_date"><?php echo $tbl_encoder_view->date->caption() ?></span></td>
		<td data-name="date" <?php echo $tbl_encoder_view->date->cellAttributes() ?>>
<span id="el_tbl_encoder_date">
<span<?php echo $tbl_encoder_view->date->viewAttributes() ?>><?php echo $tbl_encoder_view->date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_view->activities->Visible) { // activities ?>
	<tr id="r_activities">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_activities"><?php echo $tbl_encoder_view->activities->caption() ?></span></td>
		<td data-name="activities" <?php echo $tbl_encoder_view->activities->cellAttributes() ?>>
<span id="el_tbl_encoder_activities">
<span<?php echo $tbl_encoder_view->activities->viewAttributes() ?>><?php echo $tbl_encoder_view->activities->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_view->action_taken->Visible) { // action_taken ?>
	<tr id="r_action_taken">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_action_taken"><?php echo $tbl_encoder_view->action_taken->caption() ?></span></td>
		<td data-name="action_taken" <?php echo $tbl_encoder_view->action_taken->cellAttributes() ?>>
<span id="el_tbl_encoder_action_taken">
<span<?php echo $tbl_encoder_view->action_taken->viewAttributes() ?>><?php echo $tbl_encoder_view->action_taken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_view->total_encoded->Visible) { // total_encoded ?>
	<tr id="r_total_encoded">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_total_encoded"><?php echo $tbl_encoder_view->total_encoded->caption() ?></span></td>
		<td data-name="total_encoded" <?php echo $tbl_encoder_view->total_encoded->cellAttributes() ?>>
<span id="el_tbl_encoder_total_encoded">
<span<?php echo $tbl_encoder_view->total_encoded->viewAttributes() ?>><?php echo $tbl_encoder_view->total_encoded->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_view->status_remark->Visible) { // status_remark ?>
	<tr id="r_status_remark">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_status_remark"><?php echo $tbl_encoder_view->status_remark->caption() ?></span></td>
		<td data-name="status_remark" <?php echo $tbl_encoder_view->status_remark->cellAttributes() ?>>
<span id="el_tbl_encoder_status_remark">
<span<?php echo $tbl_encoder_view->status_remark->viewAttributes() ?>><?php echo $tbl_encoder_view->status_remark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_view->employee_id->Visible) { // employee_id ?>
	<tr id="r_employee_id">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_employee_id"><?php echo $tbl_encoder_view->employee_id->caption() ?></span></td>
		<td data-name="employee_id" <?php echo $tbl_encoder_view->employee_id->cellAttributes() ?>>
<span id="el_tbl_encoder_employee_id">
<span<?php echo $tbl_encoder_view->employee_id->viewAttributes() ?>><?php echo $tbl_encoder_view->employee_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_user_last_modify"><?php echo $tbl_encoder_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_encoder_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_encoder_user_last_modify">
<span<?php echo $tbl_encoder_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_encoder_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $tbl_encoder_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_date_last_modify"><?php echo $tbl_encoder_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $tbl_encoder_view->date_last_modify->cellAttributes() ?>>
<span id="el_tbl_encoder_date_last_modify">
<span<?php echo $tbl_encoder_view->date_last_modify->viewAttributes() ?>><?php echo $tbl_encoder_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_encoder_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_encoder_view->isExport()) { ?>
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
$tbl_encoder_view->terminate();
?>