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
$tbl_pr_view = new tbl_pr_view();

// Run the page
$tbl_pr_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_pr_view->isExport()) { ?>
<script>
var ftbl_prview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_prview = currentForm = new ew.Form("ftbl_prview", "view");
	loadjs.done("ftbl_prview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_pr_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_pr_view->ExportOptions->render("body") ?>
<?php $tbl_pr_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_pr_view->showPageHeader(); ?>
<?php
$tbl_pr_view->showMessage();
?>
<form name="ftbl_prview" id="ftbl_prview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pr_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_pr_view->date_prep->Visible) { // date_prep ?>
	<tr id="r_date_prep">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_date_prep"><?php echo $tbl_pr_view->date_prep->caption() ?></span></td>
		<td data-name="date_prep" <?php echo $tbl_pr_view->date_prep->cellAttributes() ?>>
<span id="el_tbl_pr_date_prep">
<span<?php echo $tbl_pr_view->date_prep->viewAttributes() ?>><?php echo $tbl_pr_view->date_prep->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->pr_number->Visible) { // pr_number ?>
	<tr id="r_pr_number">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_pr_number"><?php echo $tbl_pr_view->pr_number->caption() ?></span></td>
		<td data-name="pr_number" <?php echo $tbl_pr_view->pr_number->cellAttributes() ?>>
<span id="el_tbl_pr_pr_number">
<span<?php echo $tbl_pr_view->pr_number->viewAttributes() ?>><?php echo $tbl_pr_view->pr_number->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->purpose->Visible) { // purpose ?>
	<tr id="r_purpose">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_purpose"><?php echo $tbl_pr_view->purpose->caption() ?></span></td>
		<td data-name="purpose" <?php echo $tbl_pr_view->purpose->cellAttributes() ?>>
<span id="el_tbl_pr_purpose">
<span<?php echo $tbl_pr_view->purpose->viewAttributes() ?>><?php echo $tbl_pr_view->purpose->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->pr_status->Visible) { // pr_status ?>
	<tr id="r_pr_status">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_pr_status"><?php echo $tbl_pr_view->pr_status->caption() ?></span></td>
		<td data-name="pr_status" <?php echo $tbl_pr_view->pr_status->cellAttributes() ?>>
<span id="el_tbl_pr_pr_status">
<span<?php echo $tbl_pr_view->pr_status->viewAttributes() ?>><?php echo $tbl_pr_view->pr_status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->sup_id->Visible) { // sup_id ?>
	<tr id="r_sup_id">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_sup_id"><?php echo $tbl_pr_view->sup_id->caption() ?></span></td>
		<td data-name="sup_id" <?php echo $tbl_pr_view->sup_id->cellAttributes() ?>>
<span id="el_tbl_pr_sup_id">
<span<?php echo $tbl_pr_view->sup_id->viewAttributes() ?>><?php echo $tbl_pr_view->sup_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->date_delivered->Visible) { // date_delivered ?>
	<tr id="r_date_delivered">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_date_delivered"><?php echo $tbl_pr_view->date_delivered->caption() ?></span></td>
		<td data-name="date_delivered" <?php echo $tbl_pr_view->date_delivered->cellAttributes() ?>>
<span id="el_tbl_pr_date_delivered">
<span<?php echo $tbl_pr_view->date_delivered->viewAttributes() ?>><?php echo $tbl_pr_view->date_delivered->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->employeeid->Visible) { // employeeid ?>
	<tr id="r_employeeid">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_employeeid"><?php echo $tbl_pr_view->employeeid->caption() ?></span></td>
		<td data-name="employeeid" <?php echo $tbl_pr_view->employeeid->cellAttributes() ?>>
<span id="el_tbl_pr_employeeid">
<span<?php echo $tbl_pr_view->employeeid->viewAttributes() ?>><?php echo $tbl_pr_view->employeeid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_user_last_modify"><?php echo $tbl_pr_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_pr_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_pr_user_last_modify">
<span<?php echo $tbl_pr_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_pr_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $tbl_pr_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_date_last_modify"><?php echo $tbl_pr_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $tbl_pr_view->date_last_modify->cellAttributes() ?>>
<span id="el_tbl_pr_date_last_modify">
<span<?php echo $tbl_pr_view->date_last_modify->viewAttributes() ?>><?php echo $tbl_pr_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tbl_spec", explode(",", $tbl_pr->getCurrentDetailTable())) && $tbl_spec->DetailView) {
?>
<?php if ($tbl_pr->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("tbl_spec", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_specgrid.php" ?>
<?php } ?>
</form>
<?php
$tbl_pr_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_pr_view->isExport()) { ?>
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
$tbl_pr_view->terminate();
?>