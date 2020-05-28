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
$lib_cities_view = new lib_cities_view();

// Run the page
$lib_cities_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_cities_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lib_cities_view->isExport()) { ?>
<script>
var flib_citiesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flib_citiesview = currentForm = new ew.Form("flib_citiesview", "view");
	loadjs.done("flib_citiesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$lib_cities_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $lib_cities_view->ExportOptions->render("body") ?>
<?php $lib_cities_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $lib_cities_view->showPageHeader(); ?>
<?php
$lib_cities_view->showMessage();
?>
<form name="flib_citiesview" id="flib_citiesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_cities">
<input type="hidden" name="modal" value="<?php echo (int)$lib_cities_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($lib_cities_view->city_code->Visible) { // city_code ?>
	<tr id="r_city_code">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities_city_code"><?php echo $lib_cities_view->city_code->caption() ?></span></td>
		<td data-name="city_code" <?php echo $lib_cities_view->city_code->cellAttributes() ?>>
<span id="el_lib_cities_city_code">
<span<?php echo $lib_cities_view->city_code->viewAttributes() ?>><?php echo $lib_cities_view->city_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_cities_view->city_name->Visible) { // city_name ?>
	<tr id="r_city_name">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities_city_name"><?php echo $lib_cities_view->city_name->caption() ?></span></td>
		<td data-name="city_name" <?php echo $lib_cities_view->city_name->cellAttributes() ?>>
<span id="el_lib_cities_city_name">
<span<?php echo $lib_cities_view->city_name->viewAttributes() ?>><?php echo $lib_cities_view->city_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_cities_view->is_Urban->Visible) { // is_Urban ?>
	<tr id="r_is_Urban">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities_is_Urban"><?php echo $lib_cities_view->is_Urban->caption() ?></span></td>
		<td data-name="is_Urban" <?php echo $lib_cities_view->is_Urban->cellAttributes() ?>>
<span id="el_lib_cities_is_Urban">
<span<?php echo $lib_cities_view->is_Urban->viewAttributes() ?>><?php echo $lib_cities_view->is_Urban->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_cities_view->locked->Visible) { // locked ?>
	<tr id="r_locked">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities_locked"><?php echo $lib_cities_view->locked->caption() ?></span></td>
		<td data-name="locked" <?php echo $lib_cities_view->locked->cellAttributes() ?>>
<span id="el_lib_cities_locked">
<span<?php echo $lib_cities_view->locked->viewAttributes() ?>><?php echo $lib_cities_view->locked->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_cities_view->app_target_hh->Visible) { // app_target_hh ?>
	<tr id="r_app_target_hh">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities_app_target_hh"><?php echo $lib_cities_view->app_target_hh->caption() ?></span></td>
		<td data-name="app_target_hh" <?php echo $lib_cities_view->app_target_hh->cellAttributes() ?>>
<span id="el_lib_cities_app_target_hh">
<span<?php echo $lib_cities_view->app_target_hh->viewAttributes() ?>><?php echo $lib_cities_view->app_target_hh->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_cities_view->_4p_areas->Visible) { // 4p_areas ?>
	<tr id="r__4p_areas">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities__4p_areas"><?php echo $lib_cities_view->_4p_areas->caption() ?></span></td>
		<td data-name="_4p_areas" <?php echo $lib_cities_view->_4p_areas->cellAttributes() ?>>
<span id="el_lib_cities__4p_areas">
<span<?php echo $lib_cities_view->_4p_areas->viewAttributes() ?>><?php echo $lib_cities_view->_4p_areas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_cities_view->psgc_cty->Visible) { // psgc_cty ?>
	<tr id="r_psgc_cty">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities_psgc_cty"><?php echo $lib_cities_view->psgc_cty->caption() ?></span></td>
		<td data-name="psgc_cty" <?php echo $lib_cities_view->psgc_cty->cellAttributes() ?>>
<span id="el_lib_cities_psgc_cty">
<span<?php echo $lib_cities_view->psgc_cty->viewAttributes() ?>><?php echo $lib_cities_view->psgc_cty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lib_cities_view->prov_code->Visible) { // prov_code ?>
	<tr id="r_prov_code">
		<td class="<?php echo $lib_cities_view->TableLeftColumnClass ?>"><span id="elh_lib_cities_prov_code"><?php echo $lib_cities_view->prov_code->caption() ?></span></td>
		<td data-name="prov_code" <?php echo $lib_cities_view->prov_code->cellAttributes() ?>>
<span id="el_lib_cities_prov_code">
<span<?php echo $lib_cities_view->prov_code->viewAttributes() ?>><?php echo $lib_cities_view->prov_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$lib_cities_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lib_cities_view->isExport()) { ?>
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
$lib_cities_view->terminate();
?>