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
$tbl_supplies_cat_view = new tbl_supplies_cat_view();

// Run the page
$tbl_supplies_cat_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_cat_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_supplies_cat_view->isExport()) { ?>
<script>
var ftbl_supplies_catview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_supplies_catview = currentForm = new ew.Form("ftbl_supplies_catview", "view");
	loadjs.done("ftbl_supplies_catview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_supplies_cat_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_supplies_cat_view->ExportOptions->render("body") ?>
<?php $tbl_supplies_cat_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_supplies_cat_view->showPageHeader(); ?>
<?php
$tbl_supplies_cat_view->showMessage();
?>
<form name="ftbl_supplies_catview" id="ftbl_supplies_catview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies_cat">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_supplies_cat_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_supplies_cat_view->suppliescat_id->Visible) { // suppliescat_id ?>
	<tr id="r_suppliescat_id">
		<td class="<?php echo $tbl_supplies_cat_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_cat_suppliescat_id"><?php echo $tbl_supplies_cat_view->suppliescat_id->caption() ?></span></td>
		<td data-name="suppliescat_id" <?php echo $tbl_supplies_cat_view->suppliescat_id->cellAttributes() ?>>
<span id="el_tbl_supplies_cat_suppliescat_id">
<span<?php echo $tbl_supplies_cat_view->suppliescat_id->viewAttributes() ?>><?php echo $tbl_supplies_cat_view->suppliescat_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_supplies_cat_view->category_dsc->Visible) { // category_dsc ?>
	<tr id="r_category_dsc">
		<td class="<?php echo $tbl_supplies_cat_view->TableLeftColumnClass ?>"><span id="elh_tbl_supplies_cat_category_dsc"><?php echo $tbl_supplies_cat_view->category_dsc->caption() ?></span></td>
		<td data-name="category_dsc" <?php echo $tbl_supplies_cat_view->category_dsc->cellAttributes() ?>>
<span id="el_tbl_supplies_cat_category_dsc">
<span<?php echo $tbl_supplies_cat_view->category_dsc->viewAttributes() ?>><?php echo $tbl_supplies_cat_view->category_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_supplies_cat_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_supplies_cat_view->isExport()) { ?>
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
$tbl_supplies_cat_view->terminate();
?>