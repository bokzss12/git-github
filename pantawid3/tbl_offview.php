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
$tbl_off_view = new tbl_off_view();

// Run the page
$tbl_off_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_off_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_off_view->isExport()) { ?>
<script>
var ftbl_offview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_offview = currentForm = new ew.Form("ftbl_offview", "view");
	loadjs.done("ftbl_offview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_off_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_off_view->ExportOptions->render("body") ?>
<?php $tbl_off_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_off_view->showPageHeader(); ?>
<?php
$tbl_off_view->showMessage();
?>
<form name="ftbl_offview" id="ftbl_offview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_off">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_off_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_off_view->off_id->Visible) { // off_id ?>
	<tr id="r_off_id">
		<td class="<?php echo $tbl_off_view->TableLeftColumnClass ?>"><span id="elh_tbl_off_off_id"><?php echo $tbl_off_view->off_id->caption() ?></span></td>
		<td data-name="off_id" <?php echo $tbl_off_view->off_id->cellAttributes() ?>>
<span id="el_tbl_off_off_id">
<span<?php echo $tbl_off_view->off_id->viewAttributes() ?>><?php echo $tbl_off_view->off_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_off_view->off_desc->Visible) { // off_desc ?>
	<tr id="r_off_desc">
		<td class="<?php echo $tbl_off_view->TableLeftColumnClass ?>"><span id="elh_tbl_off_off_desc"><?php echo $tbl_off_view->off_desc->caption() ?></span></td>
		<td data-name="off_desc" <?php echo $tbl_off_view->off_desc->cellAttributes() ?>>
<span id="el_tbl_off_off_desc">
<span<?php echo $tbl_off_view->off_desc->viewAttributes() ?>><?php echo $tbl_off_view->off_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_off_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_off_view->isExport()) { ?>
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
$tbl_off_view->terminate();
?>