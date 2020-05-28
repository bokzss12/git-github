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
$lib_regions_view = new lib_regions_view();

// Run the page
$lib_regions_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_regions_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lib_regions_view->isExport()) { ?>
<script>
var flib_regionsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flib_regionsview = currentForm = new ew.Form("flib_regionsview", "view");
	loadjs.done("flib_regionsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$lib_regions_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $lib_regions_view->ExportOptions->render("body") ?>
<?php $lib_regions_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $lib_regions_view->showPageHeader(); ?>
<?php
$lib_regions_view->showMessage();
?>
<form name="flib_regionsview" id="flib_regionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_regions">
<input type="hidden" name="modal" value="<?php echo (int)$lib_regions_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($lib_regions_view->region_code->Visible) { // region_code ?>
	<tr id="r_region_code">
		<td class="<?php echo $lib_regions_view->TableLeftColumnClass ?>"><span id="elh_lib_regions_region_code"><?php echo $lib_regions_view->region_code->caption() ?></span></td>
		<td data-name="region_code" <?php echo $lib_regions_view->region_code->cellAttributes() ?>>
<span id="el_lib_regions_region_code">
<span<?php echo $lib_regions_view->region_code->viewAttributes() ?>><?php echo $lib_regions_view->region_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_regions_view->region_name->Visible) { // region_name ?>
	<tr id="r_region_name">
		<td class="<?php echo $lib_regions_view->TableLeftColumnClass ?>"><span id="elh_lib_regions_region_name"><?php echo $lib_regions_view->region_name->caption() ?></span></td>
		<td data-name="region_name" <?php echo $lib_regions_view->region_name->cellAttributes() ?>>
<span id="el_lib_regions_region_name">
<span<?php echo $lib_regions_view->region_name->viewAttributes() ?>><?php echo $lib_regions_view->region_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_regions_view->region_nick->Visible) { // region_nick ?>
	<tr id="r_region_nick">
		<td class="<?php echo $lib_regions_view->TableLeftColumnClass ?>"><span id="elh_lib_regions_region_nick"><?php echo $lib_regions_view->region_nick->caption() ?></span></td>
		<td data-name="region_nick" <?php echo $lib_regions_view->region_nick->cellAttributes() ?>>
<span id="el_lib_regions_region_nick">
<span<?php echo $lib_regions_view->region_nick->viewAttributes() ?>><?php echo $lib_regions_view->region_nick->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_regions_view->region_director->Visible) { // region_director ?>
	<tr id="r_region_director">
		<td class="<?php echo $lib_regions_view->TableLeftColumnClass ?>"><span id="elh_lib_regions_region_director"><?php echo $lib_regions_view->region_director->caption() ?></span></td>
		<td data-name="region_director" <?php echo $lib_regions_view->region_director->cellAttributes() ?>>
<span id="el_lib_regions_region_director">
<span<?php echo $lib_regions_view->region_director->viewAttributes() ?>><?php echo $lib_regions_view->region_director->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_regions_view->psgc_rgn->Visible) { // psgc_rgn ?>
	<tr id="r_psgc_rgn">
		<td class="<?php echo $lib_regions_view->TableLeftColumnClass ?>"><span id="elh_lib_regions_psgc_rgn"><?php echo $lib_regions_view->psgc_rgn->caption() ?></span></td>
		<td data-name="psgc_rgn" <?php echo $lib_regions_view->psgc_rgn->cellAttributes() ?>>
<span id="el_lib_regions_psgc_rgn">
<span<?php echo $lib_regions_view->psgc_rgn->viewAttributes() ?>><?php echo $lib_regions_view->psgc_rgn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$lib_regions_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lib_regions_view->isExport()) { ?>
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
$lib_regions_view->terminate();
?>