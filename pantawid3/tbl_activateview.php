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
$tbl_activate_view = new tbl_activate_view();

// Run the page
$tbl_activate_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_activate_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_activate_view->isExport()) { ?>
<script>
var ftbl_activateview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_activateview = currentForm = new ew.Form("ftbl_activateview", "view");
	loadjs.done("ftbl_activateview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_activate_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_activate_view->ExportOptions->render("body") ?>
<?php $tbl_activate_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_activate_view->showPageHeader(); ?>
<?php
$tbl_activate_view->showMessage();
?>
<form name="ftbl_activateview" id="ftbl_activateview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_activate">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_activate_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_activate_view->activate_id->Visible) { // activate_id ?>
	<tr id="r_activate_id">
		<td class="<?php echo $tbl_activate_view->TableLeftColumnClass ?>"><span id="elh_tbl_activate_activate_id"><?php echo $tbl_activate_view->activate_id->caption() ?></span></td>
		<td data-name="activate_id" <?php echo $tbl_activate_view->activate_id->cellAttributes() ?>>
<span id="el_tbl_activate_activate_id">
<span<?php echo $tbl_activate_view->activate_id->viewAttributes() ?>><?php echo $tbl_activate_view->activate_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_activate_view->activate_dsc->Visible) { // activate_dsc ?>
	<tr id="r_activate_dsc">
		<td class="<?php echo $tbl_activate_view->TableLeftColumnClass ?>"><span id="elh_tbl_activate_activate_dsc"><?php echo $tbl_activate_view->activate_dsc->caption() ?></span></td>
		<td data-name="activate_dsc" <?php echo $tbl_activate_view->activate_dsc->cellAttributes() ?>>
<span id="el_tbl_activate_activate_dsc">
<span<?php echo $tbl_activate_view->activate_dsc->viewAttributes() ?>><?php echo $tbl_activate_view->activate_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_activate_view->Value->Visible) { // Value ?>
	<tr id="r_Value">
		<td class="<?php echo $tbl_activate_view->TableLeftColumnClass ?>"><span id="elh_tbl_activate_Value"><?php echo $tbl_activate_view->Value->caption() ?></span></td>
		<td data-name="Value" <?php echo $tbl_activate_view->Value->cellAttributes() ?>>
<span id="el_tbl_activate_Value">
<span<?php echo $tbl_activate_view->Value->viewAttributes() ?>><?php echo $tbl_activate_view->Value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_activate_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_activate_view->isExport()) { ?>
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
$tbl_activate_view->terminate();
?>