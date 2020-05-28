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
$tbl_purchase_unit_view = new tbl_purchase_unit_view();

// Run the page
$tbl_purchase_unit_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_purchase_unit_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_purchase_unit_view->isExport()) { ?>
<script>
var ftbl_purchase_unitview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_purchase_unitview = currentForm = new ew.Form("ftbl_purchase_unitview", "view");
	loadjs.done("ftbl_purchase_unitview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_purchase_unit_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_purchase_unit_view->ExportOptions->render("body") ?>
<?php $tbl_purchase_unit_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_purchase_unit_view->showPageHeader(); ?>
<?php
$tbl_purchase_unit_view->showMessage();
?>
<form name="ftbl_purchase_unitview" id="ftbl_purchase_unitview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_purchase_unit">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_purchase_unit_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_purchase_unit_view->pruID->Visible) { // pruID ?>
	<tr id="r_pruID">
		<td class="<?php echo $tbl_purchase_unit_view->TableLeftColumnClass ?>"><span id="elh_tbl_purchase_unit_pruID"><?php echo $tbl_purchase_unit_view->pruID->caption() ?></span></td>
		<td data-name="pruID" <?php echo $tbl_purchase_unit_view->pruID->cellAttributes() ?>>
<span id="el_tbl_purchase_unit_pruID">
<span<?php echo $tbl_purchase_unit_view->pruID->viewAttributes() ?>><?php echo $tbl_purchase_unit_view->pruID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_purchase_unit_view->unit_desc->Visible) { // unit_desc ?>
	<tr id="r_unit_desc">
		<td class="<?php echo $tbl_purchase_unit_view->TableLeftColumnClass ?>"><span id="elh_tbl_purchase_unit_unit_desc"><?php echo $tbl_purchase_unit_view->unit_desc->caption() ?></span></td>
		<td data-name="unit_desc" <?php echo $tbl_purchase_unit_view->unit_desc->cellAttributes() ?>>
<span id="el_tbl_purchase_unit_unit_desc">
<span<?php echo $tbl_purchase_unit_view->unit_desc->viewAttributes() ?>><?php echo $tbl_purchase_unit_view->unit_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_purchase_unit_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_purchase_unit_view->isExport()) { ?>
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
$tbl_purchase_unit_view->terminate();
?>