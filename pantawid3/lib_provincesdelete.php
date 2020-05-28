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
$lib_provinces_delete = new lib_provinces_delete();

// Run the page
$lib_provinces_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_provinces_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flib_provincesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flib_provincesdelete = currentForm = new ew.Form("flib_provincesdelete", "delete");
	loadjs.done("flib_provincesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lib_provinces_delete->showPageHeader(); ?>
<?php
$lib_provinces_delete->showMessage();
?>
<form name="flib_provincesdelete" id="flib_provincesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_provinces">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($lib_provinces_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($lib_provinces_delete->prov_code->Visible) { // prov_code ?>
		<th class="<?php echo $lib_provinces_delete->prov_code->headerCellClass() ?>"><span id="elh_lib_provinces_prov_code" class="lib_provinces_prov_code"><?php echo $lib_provinces_delete->prov_code->caption() ?></span></th>
<?php } ?>
<?php if ($lib_provinces_delete->prov_name->Visible) { // prov_name ?>
		<th class="<?php echo $lib_provinces_delete->prov_name->headerCellClass() ?>"><span id="elh_lib_provinces_prov_name" class="lib_provinces_prov_name"><?php echo $lib_provinces_delete->prov_name->caption() ?></span></th>
<?php } ?>
<?php if ($lib_provinces_delete->psgc_prv->Visible) { // psgc_prv ?>
		<th class="<?php echo $lib_provinces_delete->psgc_prv->headerCellClass() ?>"><span id="elh_lib_provinces_psgc_prv" class="lib_provinces_psgc_prv"><?php echo $lib_provinces_delete->psgc_prv->caption() ?></span></th>
<?php } ?>
<?php if ($lib_provinces_delete->region_code->Visible) { // region_code ?>
		<th class="<?php echo $lib_provinces_delete->region_code->headerCellClass() ?>"><span id="elh_lib_provinces_region_code" class="lib_provinces_region_code"><?php echo $lib_provinces_delete->region_code->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$lib_provinces_delete->RecordCount = 0;
$i = 0;
while (!$lib_provinces_delete->Recordset->EOF) {
	$lib_provinces_delete->RecordCount++;
	$lib_provinces_delete->RowCount++;

	// Set row properties
	$lib_provinces->resetAttributes();
	$lib_provinces->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$lib_provinces_delete->loadRowValues($lib_provinces_delete->Recordset);

	// Render row
	$lib_provinces_delete->renderRow();
?>
	<tr <?php echo $lib_provinces->rowAttributes() ?>>
<?php if ($lib_provinces_delete->prov_code->Visible) { // prov_code ?>
		<td <?php echo $lib_provinces_delete->prov_code->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_delete->RowCount ?>_lib_provinces_prov_code" class="lib_provinces_prov_code">
<span<?php echo $lib_provinces_delete->prov_code->viewAttributes() ?>><?php echo $lib_provinces_delete->prov_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_provinces_delete->prov_name->Visible) { // prov_name ?>
		<td <?php echo $lib_provinces_delete->prov_name->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_delete->RowCount ?>_lib_provinces_prov_name" class="lib_provinces_prov_name">
<span<?php echo $lib_provinces_delete->prov_name->viewAttributes() ?>><?php echo $lib_provinces_delete->prov_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_provinces_delete->psgc_prv->Visible) { // psgc_prv ?>
		<td <?php echo $lib_provinces_delete->psgc_prv->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_delete->RowCount ?>_lib_provinces_psgc_prv" class="lib_provinces_psgc_prv">
<span<?php echo $lib_provinces_delete->psgc_prv->viewAttributes() ?>><?php echo $lib_provinces_delete->psgc_prv->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_provinces_delete->region_code->Visible) { // region_code ?>
		<td <?php echo $lib_provinces_delete->region_code->cellAttributes() ?>>
<span id="el<?php echo $lib_provinces_delete->RowCount ?>_lib_provinces_region_code" class="lib_provinces_region_code">
<span<?php echo $lib_provinces_delete->region_code->viewAttributes() ?>><?php echo $lib_provinces_delete->region_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$lib_provinces_delete->Recordset->moveNext();
}
$lib_provinces_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lib_provinces_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$lib_provinces_delete->showPageFooter();
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
$lib_provinces_delete->terminate();
?>