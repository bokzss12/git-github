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
$tbl_supplies_view = new tbl_supplies_view();

// Run the page
$tbl_supplies_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_supplies_view->isExport()) { ?>
<script>
var ftbl_suppliesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_suppliesview = currentForm = new ew.Form("ftbl_suppliesview", "view");
	loadjs.done("ftbl_suppliesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_supplies_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_supplies_view->ExportOptions->render("body") ?>
<?php $tbl_supplies_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_supplies_view->showPageHeader(); ?>
<?php
$tbl_supplies_view->showMessage();
?>
<form name="ftbl_suppliesview" id="ftbl_suppliesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_supplies_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_supplies_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_id"><?php echo $tbl_supplies_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tbl_supplies_view->id->cellAttributes() ?>>
<span id="el_tbl_supplies_id">
<span<?php echo $tbl_supplies_view->id->viewAttributes() ?>><?php echo $tbl_supplies_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->supplies_cat->Visible) { // supplies_cat ?>
	<tr id="r_supplies_cat">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_supplies_cat"><?php echo $tbl_supplies_view->supplies_cat->caption() ?></span></td>
		<td data-name="supplies_cat" <?php echo $tbl_supplies_view->supplies_cat->cellAttributes() ?>>
<span id="el_tbl_supplies_supplies_cat">
<span<?php echo $tbl_supplies_view->supplies_cat->viewAttributes() ?>><?php echo $tbl_supplies_view->supplies_cat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->model->Visible) { // model ?>
	<tr id="r_model">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_model"><?php echo $tbl_supplies_view->model->caption() ?></span></td>
		<td data-name="model" <?php echo $tbl_supplies_view->model->cellAttributes() ?>>
<span id="el_tbl_supplies_model">
<span<?php echo $tbl_supplies_view->model->viewAttributes() ?>><?php echo $tbl_supplies_view->model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->serial->Visible) { // serial ?>
	<tr id="r_serial">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_serial"><?php echo $tbl_supplies_view->serial->caption() ?></span></td>
		<td data-name="serial" <?php echo $tbl_supplies_view->serial->cellAttributes() ?>>
<span id="el_tbl_supplies_serial">
<span<?php echo $tbl_supplies_view->serial->viewAttributes() ?>><?php echo $tbl_supplies_view->serial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_status"><?php echo $tbl_supplies_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $tbl_supplies_view->status->cellAttributes() ?>>
<span id="el_tbl_supplies_status">
<span<?php echo $tbl_supplies_view->status->viewAttributes() ?>><?php echo $tbl_supplies_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->remark->Visible) { // remark ?>
	<tr id="r_remark">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_remark"><?php echo $tbl_supplies_view->remark->caption() ?></span></td>
		<td data-name="remark" <?php echo $tbl_supplies_view->remark->cellAttributes() ?>>
<span id="el_tbl_supplies_remark">
<span<?php echo $tbl_supplies_view->remark->viewAttributes() ?>><?php echo $tbl_supplies_view->remark->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->date_received->Visible) { // date_received ?>
	<tr id="r_date_received">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_date_received"><?php echo $tbl_supplies_view->date_received->caption() ?></span></td>
		<td data-name="date_received" <?php echo $tbl_supplies_view->date_received->cellAttributes() ?>>
<span id="el_tbl_supplies_date_received">
<span<?php echo $tbl_supplies_view->date_received->viewAttributes() ?>><?php echo $tbl_supplies_view->date_received->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->date_consumed->Visible) { // date_consumed ?>
	<tr id="r_date_consumed">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_date_consumed"><?php echo $tbl_supplies_view->date_consumed->caption() ?></span></td>
		<td data-name="date_consumed" <?php echo $tbl_supplies_view->date_consumed->cellAttributes() ?>>
<span id="el_tbl_supplies_date_consumed">
<span<?php echo $tbl_supplies_view->date_consumed->viewAttributes() ?>><?php echo $tbl_supplies_view->date_consumed->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->Supplier->Visible) { // Supplier ?>
	<tr id="r_Supplier">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_Supplier"><?php echo $tbl_supplies_view->Supplier->caption() ?></span></td>
		<td data-name="Supplier" <?php echo $tbl_supplies_view->Supplier->cellAttributes() ?>>
<span id="el_tbl_supplies_Supplier">
<span<?php echo $tbl_supplies_view->Supplier->viewAttributes() ?>><?php echo $tbl_supplies_view->Supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->employeeid->Visible) { // employeeid ?>
	<tr id="r_employeeid">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_employeeid"><?php echo $tbl_supplies_view->employeeid->caption() ?></span></td>
		<td data-name="employeeid" <?php echo $tbl_supplies_view->employeeid->cellAttributes() ?>>
<span id="el_tbl_supplies_employeeid">
<span<?php echo $tbl_supplies_view->employeeid->viewAttributes() ?>><?php echo $tbl_supplies_view->employeeid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_user_last_modify"><?php echo $tbl_supplies_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_supplies_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_supplies_user_last_modify">
<span<?php echo $tbl_supplies_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_supplies_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_view->user_date_modify->Visible) { // user_date_modify ?>
	<tr id="r_user_date_modify">
		<td class="<?php echo $tbl_supplies_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_user_date_modify"><?php echo $tbl_supplies_view->user_date_modify->caption() ?></span></td>
		<td data-name="user_date_modify" <?php echo $tbl_supplies_view->user_date_modify->cellAttributes() ?>>
<span id="el_tbl_supplies_user_date_modify">
<span<?php echo $tbl_supplies_view->user_date_modify->viewAttributes() ?>><?php echo $tbl_supplies_view->user_date_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_supplies_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_supplies_view->isExport()) { ?>
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
$tbl_supplies_view->terminate();
?>