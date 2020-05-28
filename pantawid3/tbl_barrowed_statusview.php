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
$tbl_barrowed_status_view = new tbl_barrowed_status_view();

// Run the page
$tbl_barrowed_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_barrowed_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_barrowed_status_view->isExport()) { ?>
<script>
var ftbl_barrowed_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_barrowed_statusview = currentForm = new ew.Form("ftbl_barrowed_statusview", "view");
	loadjs.done("ftbl_barrowed_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_barrowed_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_barrowed_status_view->ExportOptions->render("body") ?>
<?php $tbl_barrowed_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_barrowed_status_view->showPageHeader(); ?>
<?php
$tbl_barrowed_status_view->showMessage();
?>
<form name="ftbl_barrowed_statusview" id="ftbl_barrowed_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_barrowed_status">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_barrowed_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_barrowed_status_view->barrowed_status_id->Visible) { // barrowed_status_id ?>
	<tr id="r_barrowed_status_id">
		<td class="<?php echo $tbl_barrowed_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_barrowed_status_barrowed_status_id"><?php echo $tbl_barrowed_status_view->barrowed_status_id->caption() ?></span></td>
		<td data-name="barrowed_status_id" <?php echo $tbl_barrowed_status_view->barrowed_status_id->cellAttributes() ?>>
<span id="el_tbl_barrowed_status_barrowed_status_id">
<span<?php echo $tbl_barrowed_status_view->barrowed_status_id->viewAttributes() ?>><?php echo $tbl_barrowed_status_view->barrowed_status_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_barrowed_status_view->staus_dsc->Visible) { // staus_dsc ?>
	<tr id="r_staus_dsc">
		<td class="<?php echo $tbl_barrowed_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_barrowed_status_staus_dsc"><?php echo $tbl_barrowed_status_view->staus_dsc->caption() ?></span></td>
		<td data-name="staus_dsc" <?php echo $tbl_barrowed_status_view->staus_dsc->cellAttributes() ?>>
<span id="el_tbl_barrowed_status_staus_dsc">
<span<?php echo $tbl_barrowed_status_view->staus_dsc->viewAttributes() ?>><?php echo $tbl_barrowed_status_view->staus_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_barrowed_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_barrowed_status_view->isExport()) { ?>
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
$tbl_barrowed_status_view->terminate();
?>