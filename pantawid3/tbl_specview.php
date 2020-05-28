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
$tbl_spec_view = new tbl_spec_view();

// Run the page
$tbl_spec_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_spec_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_spec_view->isExport()) { ?>
<script>
var ftbl_specview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_specview = currentForm = new ew.Form("ftbl_specview", "view");
	loadjs.done("ftbl_specview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_spec_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_spec_view->ExportOptions->render("body") ?>
<?php $tbl_spec_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_spec_view->showPageHeader(); ?>
<?php
$tbl_spec_view->showMessage();
?>
<form name="ftbl_specview" id="ftbl_specview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_spec">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_spec_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_spec_view->specID->Visible) { // specID ?>
	<tr id="r_specID">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_specID"><?php echo $tbl_spec_view->specID->caption() ?></span></td>
		<td data-name="specID" <?php echo $tbl_spec_view->specID->cellAttributes() ?>>
<span id="el_tbl_spec_specID">
<span<?php echo $tbl_spec_view->specID->viewAttributes() ?>><?php echo $tbl_spec_view->specID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->pr_number->Visible) { // pr_number ?>
	<tr id="r_pr_number">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_pr_number"><?php echo $tbl_spec_view->pr_number->caption() ?></span></td>
		<td data-name="pr_number" <?php echo $tbl_spec_view->pr_number->cellAttributes() ?>>
<span id="el_tbl_spec_pr_number">
<span<?php echo $tbl_spec_view->pr_number->viewAttributes() ?>><?php echo $tbl_spec_view->pr_number->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->spec_unit->Visible) { // spec_unit ?>
	<tr id="r_spec_unit">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_spec_unit"><?php echo $tbl_spec_view->spec_unit->caption() ?></span></td>
		<td data-name="spec_unit" <?php echo $tbl_spec_view->spec_unit->cellAttributes() ?>>
<span id="el_tbl_spec_spec_unit">
<span<?php echo $tbl_spec_view->spec_unit->viewAttributes() ?>><?php echo $tbl_spec_view->spec_unit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->spec_dsc->Visible) { // spec_dsc ?>
	<tr id="r_spec_dsc">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_spec_dsc"><?php echo $tbl_spec_view->spec_dsc->caption() ?></span></td>
		<td data-name="spec_dsc" <?php echo $tbl_spec_view->spec_dsc->cellAttributes() ?>>
<span id="el_tbl_spec_spec_dsc">
<span<?php echo $tbl_spec_view->spec_dsc->viewAttributes() ?>><?php echo $tbl_spec_view->spec_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->spec_qty->Visible) { // spec_qty ?>
	<tr id="r_spec_qty">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_spec_qty"><?php echo $tbl_spec_view->spec_qty->caption() ?></span></td>
		<td data-name="spec_qty" <?php echo $tbl_spec_view->spec_qty->cellAttributes() ?>>
<span id="el_tbl_spec_spec_qty">
<span<?php echo $tbl_spec_view->spec_qty->viewAttributes() ?>><?php echo $tbl_spec_view->spec_qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->spec_unitprice->Visible) { // spec_unitprice ?>
	<tr id="r_spec_unitprice">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_spec_unitprice"><?php echo $tbl_spec_view->spec_unitprice->caption() ?></span></td>
		<td data-name="spec_unitprice" <?php echo $tbl_spec_view->spec_unitprice->cellAttributes() ?>>
<span id="el_tbl_spec_spec_unitprice">
<span<?php echo $tbl_spec_view->spec_unitprice->viewAttributes() ?>><?php echo $tbl_spec_view->spec_unitprice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->spec_totalprice->Visible) { // spec_totalprice ?>
	<tr id="r_spec_totalprice">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_spec_totalprice"><?php echo $tbl_spec_view->spec_totalprice->caption() ?></span></td>
		<td data-name="spec_totalprice" <?php echo $tbl_spec_view->spec_totalprice->cellAttributes() ?>>
<span id="el_tbl_spec_spec_totalprice">
<span<?php echo $tbl_spec_view->spec_totalprice->viewAttributes() ?>><?php echo $tbl_spec_view->spec_totalprice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_user_last_modify"><?php echo $tbl_spec_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $tbl_spec_view->user_last_modify->cellAttributes() ?>>
<span id="el_tbl_spec_user_last_modify">
<span<?php echo $tbl_spec_view->user_last_modify->viewAttributes() ?>><?php echo $tbl_spec_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_spec_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $tbl_spec_view->TableLeftColumnClass ?>"><span id="elh_tbl_spec_date_last_modify"><?php echo $tbl_spec_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $tbl_spec_view->date_last_modify->cellAttributes() ?>>
<span id="el_tbl_spec_date_last_modify">
<span<?php echo $tbl_spec_view->date_last_modify->viewAttributes() ?>><?php echo $tbl_spec_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_spec_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_spec_view->isExport()) { ?>
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
$tbl_spec_view->terminate();
?>