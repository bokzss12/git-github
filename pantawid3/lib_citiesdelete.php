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
$lib_cities_delete = new lib_cities_delete();

// Run the page
$lib_cities_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_cities_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flib_citiesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flib_citiesdelete = currentForm = new ew.Form("flib_citiesdelete", "delete");
	loadjs.done("flib_citiesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lib_cities_delete->showPageHeader(); ?>
<?php
$lib_cities_delete->showMessage();
?>
<form name="flib_citiesdelete" id="flib_citiesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_cities">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($lib_cities_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($lib_cities_delete->city_code->Visible) { // city_code ?>
		<th class="<?php echo $lib_cities_delete->city_code->headerCellClass() ?>"><span id="elh_lib_cities_city_code" class="lib_cities_city_code"><?php echo $lib_cities_delete->city_code->caption() ?></span></th>
<?php } ?>
<?php if ($lib_cities_delete->city_name->Visible) { // city_name ?>
		<th class="<?php echo $lib_cities_delete->city_name->headerCellClass() ?>"><span id="elh_lib_cities_city_name" class="lib_cities_city_name"><?php echo $lib_cities_delete->city_name->caption() ?></span></th>
<?php } ?>
<?php if ($lib_cities_delete->is_Urban->Visible) { // is_Urban ?>
		<th class="<?php echo $lib_cities_delete->is_Urban->headerCellClass() ?>"><span id="elh_lib_cities_is_Urban" class="lib_cities_is_Urban"><?php echo $lib_cities_delete->is_Urban->caption() ?></span></th>
<?php } ?>
<?php if ($lib_cities_delete->locked->Visible) { // locked ?>
		<th class="<?php echo $lib_cities_delete->locked->headerCellClass() ?>"><span id="elh_lib_cities_locked" class="lib_cities_locked"><?php echo $lib_cities_delete->locked->caption() ?></span></th>
<?php } ?>
<?php if ($lib_cities_delete->app_target_hh->Visible) { // app_target_hh ?>
		<th class="<?php echo $lib_cities_delete->app_target_hh->headerCellClass() ?>"><span id="elh_lib_cities_app_target_hh" class="lib_cities_app_target_hh"><?php echo $lib_cities_delete->app_target_hh->caption() ?></span></th>
<?php } ?>
<?php if ($lib_cities_delete->_4p_areas->Visible) { // 4p_areas ?>
		<th class="<?php echo $lib_cities_delete->_4p_areas->headerCellClass() ?>"><span id="elh_lib_cities__4p_areas" class="lib_cities__4p_areas"><?php echo $lib_cities_delete->_4p_areas->caption() ?></span></th>
<?php } ?>
<?php if ($lib_cities_delete->psgc_cty->Visible) { // psgc_cty ?>
		<th class="<?php echo $lib_cities_delete->psgc_cty->headerCellClass() ?>"><span id="elh_lib_cities_psgc_cty" class="lib_cities_psgc_cty"><?php echo $lib_cities_delete->psgc_cty->caption() ?></span></th>
<?php } ?>
<?php if ($lib_cities_delete->prov_code->Visible) { // prov_code ?>
		<th class="<?php echo $lib_cities_delete->prov_code->headerCellClass() ?>"><span id="elh_lib_cities_prov_code" class="lib_cities_prov_code"><?php echo $lib_cities_delete->prov_code->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$lib_cities_delete->RecordCount = 0;
$i = 0;
while (!$lib_cities_delete->Recordset->EOF) {
	$lib_cities_delete->RecordCount++;
	$lib_cities_delete->RowCount++;

	// Set row properties
	$lib_cities->resetAttributes();
	$lib_cities->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$lib_cities_delete->loadRowValues($lib_cities_delete->Recordset);

	// Render row
	$lib_cities_delete->renderRow();
?>
	<tr <?php echo $lib_cities->rowAttributes() ?>>
<?php if ($lib_cities_delete->city_code->Visible) { // city_code ?>
		<td <?php echo $lib_cities_delete->city_code->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities_city_code" class="lib_cities_city_code">
<span<?php echo $lib_cities_delete->city_code->viewAttributes() ?>><?php echo $lib_cities_delete->city_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_cities_delete->city_name->Visible) { // city_name ?>
		<td <?php echo $lib_cities_delete->city_name->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities_city_name" class="lib_cities_city_name">
<span<?php echo $lib_cities_delete->city_name->viewAttributes() ?>><?php echo $lib_cities_delete->city_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_cities_delete->is_Urban->Visible) { // is_Urban ?>
		<td <?php echo $lib_cities_delete->is_Urban->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities_is_Urban" class="lib_cities_is_Urban">
<span<?php echo $lib_cities_delete->is_Urban->viewAttributes() ?>><?php echo $lib_cities_delete->is_Urban->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_cities_delete->locked->Visible) { // locked ?>
		<td <?php echo $lib_cities_delete->locked->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities_locked" class="lib_cities_locked">
<span<?php echo $lib_cities_delete->locked->viewAttributes() ?>><?php echo $lib_cities_delete->locked->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_cities_delete->app_target_hh->Visible) { // app_target_hh ?>
		<td <?php echo $lib_cities_delete->app_target_hh->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities_app_target_hh" class="lib_cities_app_target_hh">
<span<?php echo $lib_cities_delete->app_target_hh->viewAttributes() ?>><?php echo $lib_cities_delete->app_target_hh->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_cities_delete->_4p_areas->Visible) { // 4p_areas ?>
		<td <?php echo $lib_cities_delete->_4p_areas->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities__4p_areas" class="lib_cities__4p_areas">
<span<?php echo $lib_cities_delete->_4p_areas->viewAttributes() ?>><?php echo $lib_cities_delete->_4p_areas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_cities_delete->psgc_cty->Visible) { // psgc_cty ?>
		<td <?php echo $lib_cities_delete->psgc_cty->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities_psgc_cty" class="lib_cities_psgc_cty">
<span<?php echo $lib_cities_delete->psgc_cty->viewAttributes() ?>><?php echo $lib_cities_delete->psgc_cty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_cities_delete->prov_code->Visible) { // prov_code ?>
		<td <?php echo $lib_cities_delete->prov_code->cellAttributes() ?>>
<span id="el<?php echo $lib_cities_delete->RowCount ?>_lib_cities_prov_code" class="lib_cities_prov_code">
<span<?php echo $lib_cities_delete->prov_code->viewAttributes() ?>><?php echo $lib_cities_delete->prov_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$lib_cities_delete->Recordset->moveNext();
}
$lib_cities_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lib_cities_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$lib_cities_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$lib_cities_delete->terminate();
?>