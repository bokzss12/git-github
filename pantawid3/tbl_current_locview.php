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
$tbl_current_loc_view = new tbl_current_loc_view();

// Run the page
$tbl_current_loc_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_current_loc_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_current_loc_view->isExport()) { ?>
<script>
var ftbl_current_locview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_current_locview = currentForm = new ew.Form("ftbl_current_locview", "view");
	loadjs.done("ftbl_current_locview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_current_loc_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_current_loc_view->ExportOptions->render("body") ?>
<?php $tbl_current_loc_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_current_loc_view->showPageHeader(); ?>
<?php
$tbl_current_loc_view->showMessage();
?>
<form name="ftbl_current_locview" id="ftbl_current_locview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_current_loc">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_current_loc_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_current_loc_view->current_id->Visible) { // current_id ?>
	<tr id="r_current_id">
		<td class="<?php echo $tbl_current_loc_view->TableLeftColumnClass ?>"><span id="elh_tbl_current_loc_current_id"><?php echo $tbl_current_loc_view->current_id->caption() ?></span></td>
		<td data-name="current_id" <?php echo $tbl_current_loc_view->current_id->cellAttributes() ?>>
<span id="el_tbl_current_loc_current_id">
<span<?php echo $tbl_current_loc_view->current_id->viewAttributes() ?>><?php echo $tbl_current_loc_view->current_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_current_loc_view->current_location->Visible) { // current_location ?>
	<tr id="r_current_location">
		<td class="<?php echo $tbl_current_loc_view->TableLeftColumnClass ?>"><span id="elh_tbl_current_loc_current_location"><?php echo $tbl_current_loc_view->current_location->caption() ?></span></td>
		<td data-name="current_location" <?php echo $tbl_current_loc_view->current_location->cellAttributes() ?>>
<span id="el_tbl_current_loc_current_location">
<span<?php echo $tbl_current_loc_view->current_location->viewAttributes() ?>><?php echo $tbl_current_loc_view->current_location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_current_loc_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_current_loc_view->isExport()) { ?>
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
$tbl_current_loc_view->terminate();
?>