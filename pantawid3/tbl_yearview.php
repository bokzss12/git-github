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
$tbl_year_view = new tbl_year_view();

// Run the page
$tbl_year_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_year_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_year_view->isExport()) { ?>
<script>
var ftbl_yearview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_yearview = currentForm = new ew.Form("ftbl_yearview", "view");
	loadjs.done("ftbl_yearview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_year_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_year_view->ExportOptions->render("body") ?>
<?php $tbl_year_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_year_view->showPageHeader(); ?>
<?php
$tbl_year_view->showMessage();
?>
<form name="ftbl_yearview" id="ftbl_yearview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_year">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_year_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_year_view->year_id->Visible) { // year_id ?>
	<tr id="r_year_id">
		<td class="<?php echo $tbl_year_view->TableLeftColumnClass ?>"><span id="elh_tbl_year_year_id"><?php echo $tbl_year_view->year_id->caption() ?></span></td>
		<td data-name="year_id" <?php echo $tbl_year_view->year_id->cellAttributes() ?>>
<span id="el_tbl_year_year_id">
<span<?php echo $tbl_year_view->year_id->viewAttributes() ?>><?php echo $tbl_year_view->year_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_year_view->year_dsc->Visible) { // year_dsc ?>
	<tr id="r_year_dsc">
		<td class="<?php echo $tbl_year_view->TableLeftColumnClass ?>"><span id="elh_tbl_year_year_dsc"><?php echo $tbl_year_view->year_dsc->caption() ?></span></td>
		<td data-name="year_dsc" <?php echo $tbl_year_view->year_dsc->cellAttributes() ?>>
<span id="el_tbl_year_year_dsc">
<span<?php echo $tbl_year_view->year_dsc->viewAttributes() ?>><?php echo $tbl_year_view->year_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_year_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_year_view->isExport()) { ?>
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
$tbl_year_view->terminate();
?>