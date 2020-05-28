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
$tbl_printingtype_view = new tbl_printingtype_view();

// Run the page
$tbl_printingtype_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printingtype_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_printingtype_view->isExport()) { ?>
<script>
var ftbl_printingtypeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_printingtypeview = currentForm = new ew.Form("ftbl_printingtypeview", "view");
	loadjs.done("ftbl_printingtypeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_printingtype_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_printingtype_view->ExportOptions->render("body") ?>
<?php $tbl_printingtype_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_printingtype_view->showPageHeader(); ?>
<?php
$tbl_printingtype_view->showMessage();
?>
<form name="ftbl_printingtypeview" id="ftbl_printingtypeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printingtype">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_printingtype_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_printingtype_view->printingtypeID->Visible) { // printingtypeID ?>
	<tr id="r_printingtypeID">
		<td class="<?php echo $tbl_printingtype_view->TableLeftColumnClass ?>"><span id="elh_tbl_printingtype_printingtypeID"><?php echo $tbl_printingtype_view->printingtypeID->caption() ?></span></td>
		<td data-name="printingtypeID" <?php echo $tbl_printingtype_view->printingtypeID->cellAttributes() ?>>
<span id="el_tbl_printingtype_printingtypeID">
<span<?php echo $tbl_printingtype_view->printingtypeID->viewAttributes() ?>><?php echo $tbl_printingtype_view->printingtypeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_printingtype_view->typeofprinting->Visible) { // typeofprinting ?>
	<tr id="r_typeofprinting">
		<td class="<?php echo $tbl_printingtype_view->TableLeftColumnClass ?>"><span id="elh_tbl_printingtype_typeofprinting"><?php echo $tbl_printingtype_view->typeofprinting->caption() ?></span></td>
		<td data-name="typeofprinting" <?php echo $tbl_printingtype_view->typeofprinting->cellAttributes() ?>>
<span id="el_tbl_printingtype_typeofprinting">
<span<?php echo $tbl_printingtype_view->typeofprinting->viewAttributes() ?>><?php echo $tbl_printingtype_view->typeofprinting->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_printingtype_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_printingtype_view->isExport()) { ?>
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
$tbl_printingtype_view->terminate();
?>