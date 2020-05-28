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
$tbl_printing_view = new tbl_printing_view();

// Run the page
$tbl_printing_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printing_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_printing_view->isExport()) { ?>
<script>
var ftbl_printingview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_printingview = currentForm = new ew.Form("ftbl_printingview", "view");
	loadjs.done("ftbl_printingview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$(document).ready(function(){$("form").append('<button class="btn btn-danger ewButton" name="btnCancel" id="btnCancel" type="Button"><?php echo $Language->Phrase("") ?>Add</button>'),$("#btnCancel").attr("onClick","document.location.href='tbl_printingadd.php';")});
});
</script>
<?php } ?>
<?php if (!$tbl_printing_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_printing_view->ExportOptions->render("body") ?>
<?php $tbl_printing_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_printing_view->showPageHeader(); ?>
<?php
$tbl_printing_view->showMessage();
?>
<form name="ftbl_printingview" id="ftbl_printingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printing">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_printing_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_printing_view->printing_date->Visible) { // printing_date ?>
	<tr id="r_printing_date">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_printing_date"><?php echo $tbl_printing_view->printing_date->caption() ?></span></td>
		<td data-name="printing_date" <?php echo $tbl_printing_view->printing_date->cellAttributes() ?>>
<span id="el_tbl_printing_printing_date">
<span<?php echo $tbl_printing_view->printing_date->viewAttributes() ?>><?php echo $tbl_printing_view->printing_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printing_view->printing_type->Visible) { // printing_type ?>
	<tr id="r_printing_type">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_printing_type"><?php echo $tbl_printing_view->printing_type->caption() ?></span></td>
		<td data-name="printing_type" <?php echo $tbl_printing_view->printing_type->cellAttributes() ?>>
<span id="el_tbl_printing_printing_type">
<span<?php echo $tbl_printing_view->printing_type->viewAttributes() ?>><?php echo $tbl_printing_view->printing_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printing_view->printed_forms->Visible) { // printed_forms ?>
	<tr id="r_printed_forms">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_printed_forms"><?php echo $tbl_printing_view->printed_forms->caption() ?></span></td>
		<td data-name="printed_forms" <?php echo $tbl_printing_view->printed_forms->cellAttributes() ?>>
<span id="el_tbl_printing_printed_forms">
<span<?php echo $tbl_printing_view->printed_forms->viewAttributes() ?>><?php echo $tbl_printing_view->printed_forms->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printing_view->total_forms->Visible) { // total_forms ?>
	<tr id="r_total_forms">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_total_forms"><?php echo $tbl_printing_view->total_forms->caption() ?></span></td>
		<td data-name="total_forms" <?php echo $tbl_printing_view->total_forms->cellAttributes() ?>>
<span id="el_tbl_printing_total_forms">
<span<?php echo $tbl_printing_view->total_forms->viewAttributes() ?>><?php echo $tbl_printing_view->total_forms->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printing_view->status_printing->Visible) { // status_printing ?>
	<tr id="r_status_printing">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_status_printing"><?php echo $tbl_printing_view->status_printing->caption() ?></span></td>
		<td data-name="status_printing" <?php echo $tbl_printing_view->status_printing->cellAttributes() ?>>
<span id="el_tbl_printing_status_printing">
<span<?php echo $tbl_printing_view->status_printing->viewAttributes() ?>><?php echo $tbl_printing_view->status_printing->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printing_view->employee_id->Visible) { // employee_id ?>
	<tr id="r_employee_id">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_employee_id"><?php echo $tbl_printing_view->employee_id->caption() ?></span></td>
		<td data-name="employee_id" <?php echo $tbl_printing_view->employee_id->cellAttributes() ?>>
<span id="el_tbl_printing_employee_id">
<span<?php echo $tbl_printing_view->employee_id->viewAttributes() ?>><?php echo $tbl_printing_view->employee_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printing_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_user_last_modify"><?php echo $tbl_printing_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_printing_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_printing_user_last_modify">
<span<?php echo $tbl_printing_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_printing_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printing_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $tbl_printing_view->TableLeftColumnClass ?>"><span id="elh_tbl_printing_date_last_modify"><?php echo $tbl_printing_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $tbl_printing_view->date_last_modify->cellAttributes() ?>>
<span id="el_tbl_printing_date_last_modify">
<span<?php echo $tbl_printing_view->date_last_modify->viewAttributes() ?>><?php echo $tbl_printing_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_printing_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_printing_view->isExport()) { ?>
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
$tbl_printing_view->terminate();
?>