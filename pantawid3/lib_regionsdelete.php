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
$lib_regions_delete = new lib_regions_delete();

// Run the page
$lib_regions_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_regions_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flib_regionsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flib_regionsdelete = currentForm = new ew.Form("flib_regionsdelete", "delete");
	loadjs.done("flib_regionsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lib_regions_delete->showPageHeader(); ?>
<?php
$lib_regions_delete->showMessage();
?>
<form name="flib_regionsdelete" id="flib_regionsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_regions">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($lib_regions_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($lib_regions_delete->region_code->Visible) { // region_code ?>
		<th class="<?php echo $lib_regions_delete->region_code->headerCellClass() ?>"><span id="elh_lib_regions_region_code" class="lib_regions_region_code"><?php echo $lib_regions_delete->region_code->caption() ?></span></th>
<?php } ?>
<?php if ($lib_regions_delete->region_name->Visible) { // region_name ?>
		<th class="<?php echo $lib_regions_delete->region_name->headerCellClass() ?>"><span id="elh_lib_regions_region_name" class="lib_regions_region_name"><?php echo $lib_regions_delete->region_name->caption() ?></span></th>
<?php } ?>
<?php if ($lib_regions_delete->region_nick->Visible) { // region_nick ?>
		<th class="<?php echo $lib_regions_delete->region_nick->headerCellClass() ?>"><span id="elh_lib_regions_region_nick" class="lib_regions_region_nick"><?php echo $lib_regions_delete->region_nick->caption() ?></span></th>
<?php } ?>
<?php if ($lib_regions_delete->region_director->Visible) { // region_director ?>
		<th class="<?php echo $lib_regions_delete->region_director->headerCellClass() ?>"><span id="elh_lib_regions_region_director" class="lib_regions_region_director"><?php echo $lib_regions_delete->region_director->caption() ?></span></th>
<?php } ?>
<?php if ($lib_regions_delete->psgc_rgn->Visible) { // psgc_rgn ?>
		<th class="<?php echo $lib_regions_delete->psgc_rgn->headerCellClass() ?>"><span id="elh_lib_regions_psgc_rgn" class="lib_regions_psgc_rgn"><?php echo $lib_regions_delete->psgc_rgn->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$lib_regions_delete->RecordCount = 0;
$i = 0;
while (!$lib_regions_delete->Recordset->EOF) {
	$lib_regions_delete->RecordCount++;
	$lib_regions_delete->RowCount++;

	// Set row properties
	$lib_regions->resetAttributes();
	$lib_regions->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$lib_regions_delete->loadRowValues($lib_regions_delete->Recordset);

	// Render row
	$lib_regions_delete->renderRow();
?>
	<tr <?php echo $lib_regions->rowAttributes() ?>>
<?php if ($lib_regions_delete->region_code->Visible) { // region_code ?>
		<td <?php echo $lib_regions_delete->region_code->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_delete->RowCount ?>_lib_regions_region_code" class="lib_regions_region_code">
<span<?php echo $lib_regions_delete->region_code->viewAttributes() ?>><?php echo $lib_regions_delete->region_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_regions_delete->region_name->Visible) { // region_name ?>
		<td <?php echo $lib_regions_delete->region_name->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_delete->RowCount ?>_lib_regions_region_name" class="lib_regions_region_name">
<span<?php echo $lib_regions_delete->region_name->viewAttributes() ?>><?php echo $lib_regions_delete->region_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_regions_delete->region_nick->Visible) { // region_nick ?>
		<td <?php echo $lib_regions_delete->region_nick->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_delete->RowCount ?>_lib_regions_region_nick" class="lib_regions_region_nick">
<span<?php echo $lib_regions_delete->region_nick->viewAttributes() ?>><?php echo $lib_regions_delete->region_nick->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_regions_delete->region_director->Visible) { // region_director ?>
		<td <?php echo $lib_regions_delete->region_director->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_delete->RowCount ?>_lib_regions_region_director" class="lib_regions_region_director">
<span<?php echo $lib_regions_delete->region_director->viewAttributes() ?>><?php echo $lib_regions_delete->region_director->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lib_regions_delete->psgc_rgn->Visible) { // psgc_rgn ?>
		<td <?php echo $lib_regions_delete->psgc_rgn->cellAttributes() ?>>
<span id="el<?php echo $lib_regions_delete->RowCount ?>_lib_regions_psgc_rgn" class="lib_regions_psgc_rgn">
<span<?php echo $lib_regions_delete->psgc_rgn->viewAttributes() ?>><?php echo $lib_regions_delete->psgc_rgn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$lib_regions_delete->Recordset->moveNext();
}
$lib_regions_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lib_regions_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$lib_regions_delete->showPageFooter();
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
$lib_regions_delete->terminate();
?>