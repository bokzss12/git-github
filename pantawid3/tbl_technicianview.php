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
$tbl_technician_view = new tbl_technician_view();

// Run the page
$tbl_technician_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_technician_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_technician_view->isExport()) { ?>
<script>
var ftbl_technicianview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_technicianview = currentForm = new ew.Form("ftbl_technicianview", "view");
	loadjs.done("ftbl_technicianview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_technician_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_technician_view->ExportOptions->render("body") ?>
<?php $tbl_technician_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_technician_view->showPageHeader(); ?>
<?php
$tbl_technician_view->showMessage();
?>
<form name="ftbl_technicianview" id="ftbl_technicianview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_technician">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_technician_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_technician_view->technician_id->Visible) { // technician_id ?>
	<tr id="r_technician_id">
		<td class="<?php echo $tbl_technician_view->TableLeftColumnClass ?>"><span id="elh_tbl_technician_technician_id"><?php echo $tbl_technician_view->technician_id->caption() ?></span></td>
		<td data-name="technician_id" <?php echo $tbl_technician_view->technician_id->cellAttributes() ?>>
<span id="el_tbl_technician_technician_id">
<span<?php echo $tbl_technician_view->technician_id->viewAttributes() ?>><?php echo $tbl_technician_view->technician_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_technician_view->technician_dsc->Visible) { // technician_dsc ?>
	<tr id="r_technician_dsc">
		<td class="<?php echo $tbl_technician_view->TableLeftColumnClass ?>"><span id="elh_tbl_technician_technician_dsc"><?php echo $tbl_technician_view->technician_dsc->caption() ?></span></td>
		<td data-name="technician_dsc" <?php echo $tbl_technician_view->technician_dsc->cellAttributes() ?>>
<span id="el_tbl_technician_technician_dsc">
<span<?php echo $tbl_technician_view->technician_dsc->viewAttributes() ?>><?php echo $tbl_technician_view->technician_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_technician_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_technician_view->isExport()) { ?>
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
$tbl_technician_view->terminate();
?>