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
$tbl_pr_status_view = new tbl_pr_status_view();

// Run the page
$tbl_pr_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_pr_status_view->isExport()) { ?>
<script>
var ftbl_pr_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_pr_statusview = currentForm = new ew.Form("ftbl_pr_statusview", "view");
	loadjs.done("ftbl_pr_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_pr_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_pr_status_view->ExportOptions->render("body") ?>
<?php $tbl_pr_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_pr_status_view->showPageHeader(); ?>
<?php
$tbl_pr_status_view->showMessage();
?>
<form name="ftbl_pr_statusview" id="ftbl_pr_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr_status">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pr_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_pr_status_view->pr_statusID->Visible) { // pr_statusID ?>
	<tr id="r_pr_statusID">
		<td class="<?php echo $tbl_pr_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_status_pr_statusID"><?php echo $tbl_pr_status_view->pr_statusID->caption() ?></span></td>
		<td data-name="pr_statusID" <?php echo $tbl_pr_status_view->pr_statusID->cellAttributes() ?>>
<span id="el_tbl_pr_status_pr_statusID">
<span<?php echo $tbl_pr_status_view->pr_statusID->viewAttributes() ?>><?php echo $tbl_pr_status_view->pr_statusID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pr_status_view->pr_dsc->Visible) { // pr_dsc ?>
	<tr id="r_pr_dsc">
		<td class="<?php echo $tbl_pr_status_view->TableLeftColumnClass ?>"><span id="elh_tbl_pr_status_pr_dsc"><?php echo $tbl_pr_status_view->pr_dsc->caption() ?></span></td>
		<td data-name="pr_dsc" <?php echo $tbl_pr_status_view->pr_dsc->cellAttributes() ?>>
<span id="el_tbl_pr_status_pr_dsc">
<span<?php echo $tbl_pr_status_view->pr_dsc->viewAttributes() ?>><?php echo $tbl_pr_status_view->pr_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_pr_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_pr_status_view->isExport()) { ?>
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
$tbl_pr_status_view->terminate();
?>