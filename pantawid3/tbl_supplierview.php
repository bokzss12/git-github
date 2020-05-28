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
$tbl_supplier_view = new tbl_supplier_view();

// Run the page
$tbl_supplier_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplier_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_supplier_view->isExport()) { ?>
<script>
var ftbl_supplierview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_supplierview = currentForm = new ew.Form("ftbl_supplierview", "view");
	loadjs.done("ftbl_supplierview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_supplier_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_supplier_view->ExportOptions->render("body") ?>
<?php $tbl_supplier_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_supplier_view->showPageHeader(); ?>
<?php
$tbl_supplier_view->showMessage();
?>
<form name="ftbl_supplierview" id="ftbl_supplierview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplier">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_supplier_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_supplier_view->supplierID->Visible) { // supplierID ?>
	<tr id="r_supplierID">
		<td class="<?php echo $tbl_supplier_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplier_supplierID"><?php echo $tbl_supplier_view->supplierID->caption() ?></span></td>
		<td data-name="supplierID" <?php echo $tbl_supplier_view->supplierID->cellAttributes() ?>>
<span id="el_tbl_supplier_supplierID">
<span<?php echo $tbl_supplier_view->supplierID->viewAttributes() ?>><?php echo $tbl_supplier_view->supplierID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplier_view->supplier_dsc->Visible) { // supplier_dsc ?>
	<tr id="r_supplier_dsc">
		<td class="<?php echo $tbl_supplier_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplier_supplier_dsc"><?php echo $tbl_supplier_view->supplier_dsc->caption() ?></span></td>
		<td data-name="supplier_dsc" <?php echo $tbl_supplier_view->supplier_dsc->cellAttributes() ?>>
<span id="el_tbl_supplier_supplier_dsc">
<span<?php echo $tbl_supplier_view->supplier_dsc->viewAttributes() ?>><?php echo $tbl_supplier_view->supplier_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_supplier_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_supplier_view->isExport()) { ?>
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
$tbl_supplier_view->terminate();
?>