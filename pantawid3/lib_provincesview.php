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
$lib_provinces_view = new lib_provinces_view();

// Run the page
$lib_provinces_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_provinces_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lib_provinces_view->isExport()) { ?>
<script>
var flib_provincesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flib_provincesview = currentForm = new ew.Form("flib_provincesview", "view");
	loadjs.done("flib_provincesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$lib_provinces_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $lib_provinces_view->ExportOptions->render("body") ?>
<?php $lib_provinces_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $lib_provinces_view->showPageHeader(); ?>
<?php
$lib_provinces_view->showMessage();
?>
<form name="flib_provincesview" id="flib_provincesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_provinces">
<input type="hidden" name="modal" value="<?php echo (int)$lib_provinces_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($lib_provinces_view->prov_code->Visible) { // prov_code ?>
	<tr id="r_prov_code">
		<td class="<?php echo $lib_provinces_view->TableLeftColumnClass ?>"><span id="elh_lib_provinces_prov_code"><?php echo $lib_provinces_view->prov_code->caption() ?></span></td>
		<td data-name="prov_code" <?php echo $lib_provinces_view->prov_code->cellAttributes() ?>>
<span id="el_lib_provinces_prov_code">
<span<?php echo $lib_provinces_view->prov_code->viewAttributes() ?>><?php echo $lib_provinces_view->prov_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_provinces_view->prov_name->Visible) { // prov_name ?>
	<tr id="r_prov_name">
		<td class="<?php echo $lib_provinces_view->TableLeftColumnClass ?>"><span id="elh_lib_provinces_prov_name"><?php echo $lib_provinces_view->prov_name->caption() ?></span></td>
		<td data-name="prov_name" <?php echo $lib_provinces_view->prov_name->cellAttributes() ?>>
<span id="el_lib_provinces_prov_name">
<span<?php echo $lib_provinces_view->prov_name->viewAttributes() ?>><?php echo $lib_provinces_view->prov_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_provinces_view->psgc_prv->Visible) { // psgc_prv ?>
	<tr id="r_psgc_prv">
		<td class="<?php echo $lib_provinces_view->TableLeftColumnClass ?>"><span id="elh_lib_provinces_psgc_prv"><?php echo $lib_provinces_view->psgc_prv->caption() ?></span></td>
		<td data-name="psgc_prv" <?php echo $lib_provinces_view->psgc_prv->cellAttributes() ?>>
<span id="el_lib_provinces_psgc_prv">
<span<?php echo $lib_provinces_view->psgc_prv->viewAttributes() ?>><?php echo $lib_provinces_view->psgc_prv->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_provinces_view->region_code->Visible) { // region_code ?>
	<tr id="r_region_code">
		<td class="<?php echo $lib_provinces_view->TableLeftColumnClass ?>"><span id="elh_lib_provinces_region_code"><?php echo $lib_provinces_view->region_code->caption() ?></span></td>
		<td data-name="region_code" <?php echo $lib_provinces_view->region_code->cellAttributes() ?>>
<span id="el_lib_provinces_region_code">
<span<?php echo $lib_provinces_view->region_code->viewAttributes() ?>><?php echo $lib_provinces_view->region_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$lib_provinces_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lib_provinces_view->isExport()) { ?>
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
$lib_provinces_view->terminate();
?>