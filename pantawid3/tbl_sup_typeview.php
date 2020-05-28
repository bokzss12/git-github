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
$tbl_sup_type_view = new tbl_sup_type_view();

// Run the page
$tbl_sup_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_sup_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_sup_type_view->isExport()) { ?>
<script>
var ftbl_sup_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_sup_typeview = currentForm = new ew.Form("ftbl_sup_typeview", "view");
	loadjs.done("ftbl_sup_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_sup_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_sup_type_view->ExportOptions->render("body") ?>
<?php $tbl_sup_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_sup_type_view->showPageHeader(); ?>
<?php
$tbl_sup_type_view->showMessage();
?>
<form name="ftbl_sup_typeview" id="ftbl_sup_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_sup_type">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_sup_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_sup_type_view->sup_listID->Visible) { // sup_listID ?>
	<tr id="r_sup_listID">
		<td class="<?php echo $tbl_sup_type_view->TableLeftColumnClass ?>"><span id="elh_tbl_sup_type_sup_listID"><?php echo $tbl_sup_type_view->sup_listID->caption() ?></span></td>
		<td data-name="sup_listID" <?php echo $tbl_sup_type_view->sup_listID->cellAttributes() ?>>
<span id="el_tbl_sup_type_sup_listID">
<span<?php echo $tbl_sup_type_view->sup_listID->viewAttributes() ?>><?php echo $tbl_sup_type_view->sup_listID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_sup_type_view->sup_types->Visible) { // sup_types ?>
	<tr id="r_sup_types">
		<td class="<?php echo $tbl_sup_type_view->TableLeftColumnClass ?>"><span id="elh_tbl_sup_type_sup_types"><?php echo $tbl_sup_type_view->sup_types->caption() ?></span></td>
		<td data-name="sup_types" <?php echo $tbl_sup_type_view->sup_types->cellAttributes() ?>>
<span id="el_tbl_sup_type_sup_types">
<span<?php echo $tbl_sup_type_view->sup_types->viewAttributes() ?>><?php echo $tbl_sup_type_view->sup_types->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_sup_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_sup_type_view->isExport()) { ?>
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
$tbl_sup_type_view->terminate();
?>