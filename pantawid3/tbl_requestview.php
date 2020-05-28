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
$tbl_request_view = new tbl_request_view();

// Run the page
$tbl_request_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_request_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_request_view->isExport()) { ?>
<script>
var ftbl_requestview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_requestview = currentForm = new ew.Form("ftbl_requestview", "view");
	loadjs.done("ftbl_requestview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_request_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_request_view->ExportOptions->render("body") ?>
<?php $tbl_request_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_request_view->showPageHeader(); ?>
<?php
$tbl_request_view->showMessage();
?>
<form name="ftbl_requestview" id="ftbl_requestview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_request">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_request_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_request_view->request_id->Visible) { // request_id ?>
	<tr id="r_request_id">
		<td class="<?php echo $tbl_request_view->TableLeftColumnClass ?>"><span id="elh_tbl_request_request_id"><?php echo $tbl_request_view->request_id->caption() ?></span></td>
		<td data-name="request_id" <?php echo $tbl_request_view->request_id->cellAttributes() ?>>
<span id="el_tbl_request_request_id">
<span<?php echo $tbl_request_view->request_id->viewAttributes() ?>><?php echo $tbl_request_view->request_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_request_view->request_dsc->Visible) { // request_dsc ?>
	<tr id="r_request_dsc">
		<td class="<?php echo $tbl_request_view->TableLeftColumnClass ?>"><span id="elh_tbl_request_request_dsc"><?php echo $tbl_request_view->request_dsc->caption() ?></span></td>
		<td data-name="request_dsc" <?php echo $tbl_request_view->request_dsc->cellAttributes() ?>>
<span id="el_tbl_request_request_dsc">
<span<?php echo $tbl_request_view->request_dsc->viewAttributes() ?>><?php echo $tbl_request_view->request_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_request_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_request_view->isExport()) { ?>
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
$tbl_request_view->terminate();
?>