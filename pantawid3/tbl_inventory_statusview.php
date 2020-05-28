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
$tbl_inventory_status_view = new tbl_inventory_status_view();

// Run the page
$tbl_inventory_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_inventory_status_view->isExport()) { ?>
<script>
var ftbl_inventory_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_inventory_statusview = currentForm = new ew.Form("ftbl_inventory_statusview", "view");
	loadjs.done("ftbl_inventory_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_inventory_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_inventory_status_view->ExportOptions->render("body") ?>
<?php $tbl_inventory_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_inventory_status_view->showPageHeader(); ?>
<?php
$tbl_inventory_status_view->showMessage();
?>
<form name="ftbl_inventory_statusview" id="ftbl_inventory_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory_status">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_inventory_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_inventory_status_view->inventory_status_id->Visible) { // inventory_status_id ?>
	<tr id="r_inventory_status_id">
		<td class="<?php echo $tbl_inventory_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_status_inventory_status_id"><?php echo $tbl_inventory_status_view->inventory_status_id->caption() ?></span></td>
		<td data-name="inventory_status_id" <?php echo $tbl_inventory_status_view->inventory_status_id->cellAttributes() ?>>
<span id="el_tbl_inventory_status_inventory_status_id">
<span<?php echo $tbl_inventory_status_view->inventory_status_id->viewAttributes() ?>><?php echo $tbl_inventory_status_view->inventory_status_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory_status_view->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
	<tr id="r_inventory_status_dsc">
		<td class="<?php echo $tbl_inventory_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_status_inventory_status_dsc"><?php echo $tbl_inventory_status_view->inventory_status_dsc->caption() ?></span></td>
		<td data-name="inventory_status_dsc" <?php echo $tbl_inventory_status_view->inventory_status_dsc->cellAttributes() ?>>
<span id="el_tbl_inventory_status_inventory_status_dsc">
<span<?php echo $tbl_inventory_status_view->inventory_status_dsc->viewAttributes() ?>><?php echo $tbl_inventory_status_view->inventory_status_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_inventory_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_inventory_status_view->isExport()) { ?>
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
$tbl_inventory_status_view->terminate();
?>