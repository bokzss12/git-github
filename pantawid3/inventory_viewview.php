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
$inventory_view_view = new inventory_view_view();

// Run the page
$inventory_view_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventory_view_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$inventory_view_view->isExport()) { ?>
<script>
var finventory_viewview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	finventory_viewview = currentForm = new ew.Form("finventory_viewview", "view");
	loadjs.done("finventory_viewview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$inventory_view_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $inventory_view_view->ExportOptions->render("body") ?>
<?php $inventory_view_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inventory_view_view->showPageHeader(); ?>
<?php
$inventory_view_view->showMessage();
?>
<form name="finventory_viewview" id="finventory_viewview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventory_view">
<input type="hidden" name="modal" value="<?php echo (int)$inventory_view_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($inventory_view_view->concat_inventory->Visible) { // concat_inventory ?>
	<tr id="r_concat_inventory">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_concat_inventory"><?php echo $inventory_view_view->concat_inventory->caption() ?></span></td>
		<td data-name="concat_inventory" <?php echo $inventory_view_view->concat_inventory->cellAttributes() ?>>
<span id="el_inventory_view_concat_inventory">
<span<?php echo $inventory_view_view->concat_inventory->viewAttributes() ?>><?php echo $inventory_view_view->concat_inventory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Month_Purchased->Visible) { // Month_Purchased ?>
	<tr id="r_Month_Purchased">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Month_Purchased"><?php echo $inventory_view_view->Month_Purchased->caption() ?></span></td>
		<td data-name="Month_Purchased" <?php echo $inventory_view_view->Month_Purchased->cellAttributes() ?>>
<span id="el_inventory_view_Month_Purchased">
<span<?php echo $inventory_view_view->Month_Purchased->viewAttributes() ?>><?php echo $inventory_view_view->Month_Purchased->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Year_Purchased->Visible) { // Year_Purchased ?>
	<tr id="r_Year_Purchased">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Year_Purchased"><?php echo $inventory_view_view->Year_Purchased->caption() ?></span></td>
		<td data-name="Year_Purchased" <?php echo $inventory_view_view->Year_Purchased->cellAttributes() ?>>
<span id="el_inventory_view_Year_Purchased">
<span<?php echo $inventory_view_view->Year_Purchased->viewAttributes() ?>><?php echo $inventory_view_view->Year_Purchased->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->item_type->Visible) { // item_type ?>
	<tr id="r_item_type">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_item_type"><?php echo $inventory_view_view->item_type->caption() ?></span></td>
		<td data-name="item_type" <?php echo $inventory_view_view->item_type->cellAttributes() ?>>
<span id="el_inventory_view_item_type">
<span<?php echo $inventory_view_view->item_type->viewAttributes() ?>><?php echo $inventory_view_view->item_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->item_model->Visible) { // item_model ?>
	<tr id="r_item_model">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_item_model"><?php echo $inventory_view_view->item_model->caption() ?></span></td>
		<td data-name="item_model" <?php echo $inventory_view_view->item_model->cellAttributes() ?>>
<span id="el_inventory_view_item_model">
<span<?php echo $inventory_view_view->item_model->viewAttributes() ?>><?php echo $inventory_view_view->item_model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->item_serial->Visible) { // item_serial ?>
	<tr id="r_item_serial">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_item_serial"><?php echo $inventory_view_view->item_serial->caption() ?></span></td>
		<td data-name="item_serial" <?php echo $inventory_view_view->item_serial->cellAttributes() ?>>
<span id="el_inventory_view_item_serial">
<span<?php echo $inventory_view_view->item_serial->viewAttributes() ?>><?php echo $inventory_view_view->item_serial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->office_id->Visible) { // office_id ?>
	<tr id="r_office_id">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_office_id"><?php echo $inventory_view_view->office_id->caption() ?></span></td>
		<td data-name="office_id" <?php echo $inventory_view_view->office_id->cellAttributes() ?>>
<span id="el_inventory_view_office_id">
<span<?php echo $inventory_view_view->office_id->viewAttributes() ?>><?php echo $inventory_view_view->office_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Region->Visible) { // Region ?>
	<tr id="r_Region">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Region"><?php echo $inventory_view_view->Region->caption() ?></span></td>
		<td data-name="Region" <?php echo $inventory_view_view->Region->cellAttributes() ?>>
<span id="el_inventory_view_Region">
<span<?php echo $inventory_view_view->Region->viewAttributes() ?>><?php echo $inventory_view_view->Region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Province->Visible) { // Province ?>
	<tr id="r_Province">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Province"><?php echo $inventory_view_view->Province->caption() ?></span></td>
		<td data-name="Province" <?php echo $inventory_view_view->Province->cellAttributes() ?>>
<span id="el_inventory_view_Province">
<span<?php echo $inventory_view_view->Province->viewAttributes() ?>><?php echo $inventory_view_view->Province->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Cities->Visible) { // Cities ?>
	<tr id="r_Cities">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Cities"><?php echo $inventory_view_view->Cities->caption() ?></span></td>
		<td data-name="Cities" <?php echo $inventory_view_view->Cities->cellAttributes() ?>>
<span id="el_inventory_view_Cities">
<span<?php echo $inventory_view_view->Cities->viewAttributes() ?>><?php echo $inventory_view_view->Cities->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->name_accountable->Visible) { // name_accountable ?>
	<tr id="r_name_accountable">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_name_accountable"><?php echo $inventory_view_view->name_accountable->caption() ?></span></td>
		<td data-name="name_accountable" <?php echo $inventory_view_view->name_accountable->cellAttributes() ?>>
<span id="el_inventory_view_name_accountable">
<span<?php echo $inventory_view_view->name_accountable->viewAttributes() ?>><?php echo $inventory_view_view->name_accountable->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Designation->Visible) { // Designation ?>
	<tr id="r_Designation">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Designation"><?php echo $inventory_view_view->Designation->caption() ?></span></td>
		<td data-name="Designation" <?php echo $inventory_view_view->Designation->cellAttributes() ?>>
<span id="el_inventory_view_Designation">
<span<?php echo $inventory_view_view->Designation->viewAttributes() ?>><?php echo $inventory_view_view->Designation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Last_Date_Check->Visible) { // Last_Date_Check ?>
	<tr id="r_Last_Date_Check">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Last_Date_Check"><?php echo $inventory_view_view->Last_Date_Check->caption() ?></span></td>
		<td data-name="Last_Date_Check" <?php echo $inventory_view_view->Last_Date_Check->cellAttributes() ?>>
<span id="el_inventory_view_Last_Date_Check">
<span<?php echo $inventory_view_view->Last_Date_Check->viewAttributes() ?>><?php echo $inventory_view_view->Last_Date_Check->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->remarks->Visible) { // remarks ?>
	<tr id="r_remarks">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_remarks"><?php echo $inventory_view_view->remarks->caption() ?></span></td>
		<td data-name="remarks" <?php echo $inventory_view_view->remarks->cellAttributes() ?>>
<span id="el_inventory_view_remarks">
<span<?php echo $inventory_view_view->remarks->viewAttributes() ?>><?php echo $inventory_view_view->remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->user_last_modify->Visible) { // user_last_modify ?>
	<tr id="r_user_last_modify">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_user_last_modify"><?php echo $inventory_view_view->user_last_modify->caption() ?></span></td>
		<td data-name="user_last_modify" <?php echo $inventory_view_view->user_last_modify->cellAttributes() ?>>
<span id="el_inventory_view_user_last_modify">
<span<?php echo $inventory_view_view->user_last_modify->viewAttributes() ?>><?php echo $inventory_view_view->user_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->date_last_modify->Visible) { // date_last_modify ?>
	<tr id="r_date_last_modify">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_date_last_modify"><?php echo $inventory_view_view->date_last_modify->caption() ?></span></td>
		<td data-name="date_last_modify" <?php echo $inventory_view_view->date_last_modify->cellAttributes() ?>>
<span id="el_inventory_view_date_last_modify">
<span<?php echo $inventory_view_view->date_last_modify->viewAttributes() ?>><?php echo $inventory_view_view->date_last_modify->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->Current_Location->Visible) { // Current_Location ?>
	<tr id="r_Current_Location">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_Current_Location"><?php echo $inventory_view_view->Current_Location->caption() ?></span></td>
		<td data-name="Current_Location" <?php echo $inventory_view_view->Current_Location->cellAttributes() ?>>
<span id="el_inventory_view_Current_Location">
<span<?php echo $inventory_view_view->Current_Location->viewAttributes() ?>><?php echo $inventory_view_view->Current_Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_status"><?php echo $inventory_view_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $inventory_view_view->status->cellAttributes() ?>>
<span id="el_inventory_view_status">
<span<?php echo $inventory_view_view->status->viewAttributes() ?>><?php echo $inventory_view_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventory_view_view->pullout_date->Visible) { // pullout_date ?>
	<tr id="r_pullout_date">
		<td class="<?php echo $inventory_view_view->TableLeftColumnClass ?>"><span id="elh_inventory_view_pullout_date"><?php echo $inventory_view_view->pullout_date->caption() ?></span></td>
		<td data-name="pullout_date" <?php echo $inventory_view_view->pullout_date->cellAttributes() ?>>
<span id="el_inventory_view_pullout_date">
<span<?php echo $inventory_view_view->pullout_date->viewAttributes() ?>><?php echo $inventory_view_view->pullout_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$inventory_view_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$inventory_view_view->isExport()) { ?>
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
$inventory_view_view->terminate();
?>