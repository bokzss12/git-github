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
$tbl_month_view = new tbl_month_view();

// Run the page
$tbl_month_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_month_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_month_view->isExport()) { ?>
<script>
var ftbl_monthview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_monthview = currentForm = new ew.Form("ftbl_monthview", "view");
	loadjs.done("ftbl_monthview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_month_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_month_view->ExportOptions->render("body") ?>
<?php $tbl_month_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_month_view->showPageHeader(); ?>
<?php
$tbl_month_view->showMessage();
?>
<form name="ftbl_monthview" id="ftbl_monthview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_month">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_month_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_month_view->month_id->Visible) { // month_id ?>
	<tr id="r_month_id">
		<td class="<?php echo $tbl_month_view->TableLeftColumnClass ?>"><span id="elh_tbl_month_month_id"><?php echo $tbl_month_view->month_id->caption() ?></span></td>
		<td data-name="month_id" <?php echo $tbl_month_view->month_id->cellAttributes() ?>>
<span id="el_tbl_month_month_id">
<span<?php echo $tbl_month_view->month_id->viewAttributes() ?>><?php echo $tbl_month_view->month_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_month_view->month_dsc->Visible) { // month_dsc ?>
	<tr id="r_month_dsc">
		<td class="<?php echo $tbl_month_view->TableLeftColumnClass ?>"><span id="elh_tbl_month_month_dsc"><?php echo $tbl_month_view->month_dsc->caption() ?></span></td>
		<td data-name="month_dsc" <?php echo $tbl_month_view->month_dsc->cellAttributes() ?>>
<span id="el_tbl_month_month_dsc">
<span<?php echo $tbl_month_view->month_dsc->viewAttributes() ?>><?php echo $tbl_month_view->month_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_month_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_month_view->isExport()) { ?>
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
$tbl_month_view->terminate();
?>