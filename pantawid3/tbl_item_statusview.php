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
$tbl_item_status_view = new tbl_item_status_view();

// Run the page
$tbl_item_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_item_status_view->isExport()) { ?>
<script>
var ftbl_item_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_item_statusview = currentForm = new ew.Form("ftbl_item_statusview", "view");
	loadjs.done("ftbl_item_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_item_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_item_status_view->ExportOptions->render("body") ?>
<?php $tbl_item_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_item_status_view->showPageHeader(); ?>
<?php
$tbl_item_status_view->showMessage();
?>
<form name="ftbl_item_statusview" id="ftbl_item_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item_status">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_item_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_item_status_view->status_id->Visible) { // status_id ?>
	<tr id="r_status_id">
		<td class="<?php echo $tbl_item_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_status_status_id"><?php echo $tbl_item_status_view->status_id->caption() ?></span></td>
		<td data-name="status_id" <?php echo $tbl_item_status_view->status_id->cellAttributes() ?>>
<span id="el_tbl_item_status_status_id">
<span<?php echo $tbl_item_status_view->status_id->viewAttributes() ?>><?php echo $tbl_item_status_view->status_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_item_status_view->status_desc->Visible) { // status_desc ?>
	<tr id="r_status_desc">
		<td class="<?php echo $tbl_item_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_item_status_status_desc"><?php echo $tbl_item_status_view->status_desc->caption() ?></span></td>
		<td data-name="status_desc" <?php echo $tbl_item_status_view->status_desc->cellAttributes() ?>>
<span id="el_tbl_item_status_status_desc">
<span<?php echo $tbl_item_status_view->status_desc->viewAttributes() ?>><?php echo $tbl_item_status_view->status_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_item_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_item_status_view->isExport()) { ?>
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
$tbl_item_status_view->terminate();
?>