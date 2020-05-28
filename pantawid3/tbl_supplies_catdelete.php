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
$tbl_supplies_cat_delete = new tbl_supplies_cat_delete();

// Run the page
$tbl_supplies_cat_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_cat_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_supplies_catdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftbl_supplies_catdelete = currentForm = new ew.Form("ftbl_supplies_catdelete", "delete");
	loadjs.done("ftbl_supplies_catdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_supplies_cat_delete->showPageHeader(); ?>
<?php
$tbl_supplies_cat_delete->showMessage();
?>
<form name="ftbl_supplies_catdelete" id="ftbl_supplies_catdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies_cat">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_supplies_cat_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_supplies_cat_delete->suppliescat_id->Visible) { // suppliescat_id ?>
		<th class="<?php echo $tbl_supplies_cat_delete->suppliescat_id->headerCellClass() ?>"><span id="elh_tbl_supplies_cat_suppliescat_id" class="tbl_supplies_cat_suppliescat_id"><?php echo $tbl_supplies_cat_delete->suppliescat_id->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_supplies_cat_delete->category_dsc->Visible) { // category_dsc ?>
		<th class="<?php echo $tbl_supplies_cat_delete->category_dsc->headerCellClass() ?>"><span id="elh_tbl_supplies_cat_category_dsc" class="tbl_supplies_cat_category_dsc"><?php echo $tbl_supplies_cat_delete->category_dsc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_supplies_cat_delete->RecordCount = 0;
$i = 0;
while (!$tbl_supplies_cat_delete->Recordset->EOF) {
	$tbl_supplies_cat_delete->RecordCount++;
	$tbl_supplies_cat_delete->RowCount++;

	// Set row properties
	$tbl_supplies_cat->resetAttributes();
	$tbl_supplies_cat->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_supplies_cat_delete->loadRowValues($tbl_supplies_cat_delete->Recordset);

	// Render row
	$tbl_supplies_cat_delete->renderRow();
?>
	<tr <?php echo $tbl_supplies_cat->rowAttributes() ?>>
<?php if ($tbl_supplies_cat_delete->suppliescat_id->Visible) { // suppliescat_id ?>
		<td <?php echo $tbl_supplies_cat_delete->suppliescat_id->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_cat_delete->RowCount ?>_tbl_supplies_cat_suppliescat_id" class="tbl_supplies_cat_suppliescat_id">
<span<?php echo $tbl_supplies_cat_delete->suppliescat_id->viewAttributes() ?>><?php echo $tbl_supplies_cat_delete->suppliescat_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_supplies_cat_delete->category_dsc->Visible) { // category_dsc ?>
		<td <?php echo $tbl_supplies_cat_delete->category_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_supplies_cat_delete->RowCount ?>_tbl_supplies_cat_category_dsc" class="tbl_supplies_cat_category_dsc">
<span<?php echo $tbl_supplies_cat_delete->category_dsc->viewAttributes() ?>><?php echo $tbl_supplies_cat_delete->category_dsc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_supplies_cat_delete->Recordset->moveNext();
}
$tbl_supplies_cat_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_supplies_cat_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_supplies_cat_delete->showPageFooter();
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
$tbl_supplies_cat_delete->terminate();
?>