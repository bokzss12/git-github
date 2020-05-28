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
$inventory_reports_search = new inventory_reports_search();

// Run the page
$inventory_reports_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventory_reports_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finventory_reportssearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($inventory_reports_search->IsModal) { ?>
	finventory_reportssearch = currentAdvancedSearchForm = new ew.Form("finventory_reportssearch", "search");
	<?php } else { ?>
	finventory_reportssearch = currentForm = new ew.Form("finventory_reportssearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	finventory_reportssearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_inventory_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($inventory_reports_search->inventory_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Last_Date_Check");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($inventory_reports_search->Last_Date_Check->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_date_last_modify");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($inventory_reports_search->date_last_modify->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_pullout_date");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($inventory_reports_search->pullout_date->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	finventory_reportssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	finventory_reportssearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("finventory_reportssearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $inventory_reports_search->showPageHeader(); ?>
<?php
$inventory_reports_search->showMessage();
?>
<form name="finventory_reportssearch" id="finventory_reportssearch" class="<?php echo $inventory_reports_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventory_reports">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$inventory_reports_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($inventory_reports_search->inventory_id->Visible) { // inventory_id ?>
	<div id="r_inventory_id" class="form-group row">
		<label for="x_inventory_id" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_inventory_id"><?php echo $inventory_reports_search->inventory_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_inventory_id" id="z_inventory_id" value="=">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->inventory_id->cellAttributes() ?>>
			<span id="el_inventory_reports_inventory_id" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_inventory_id" name="x_inventory_id" id="x_inventory_id" placeholder="<?php echo HtmlEncode($inventory_reports_search->inventory_id->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->inventory_id->EditValue ?>"<?php echo $inventory_reports_search->inventory_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->month_dsc->Visible) { // month_dsc ?>
	<div id="r_month_dsc" class="form-group row">
		<label for="x_month_dsc" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_month_dsc"><?php echo $inventory_reports_search->month_dsc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_month_dsc" id="z_month_dsc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->month_dsc->cellAttributes() ?>>
			<span id="el_inventory_reports_month_dsc" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_month_dsc" name="x_month_dsc" id="x_month_dsc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->month_dsc->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->month_dsc->EditValue ?>"<?php echo $inventory_reports_search->month_dsc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->year_dsc->Visible) { // year_dsc ?>
	<div id="r_year_dsc" class="form-group row">
		<label for="x_year_dsc" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_year_dsc"><?php echo $inventory_reports_search->year_dsc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_year_dsc" id="z_year_dsc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->year_dsc->cellAttributes() ?>>
			<span id="el_inventory_reports_year_dsc" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_year_dsc" name="x_year_dsc" id="x_year_dsc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->year_dsc->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->year_dsc->EditValue ?>"<?php echo $inventory_reports_search->year_dsc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->cat_desc->Visible) { // cat_desc ?>
	<div id="r_cat_desc" class="form-group row">
		<label for="x_cat_desc" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_cat_desc"><?php echo $inventory_reports_search->cat_desc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_cat_desc" id="z_cat_desc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->cat_desc->cellAttributes() ?>>
			<span id="el_inventory_reports_cat_desc" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_cat_desc" name="x_cat_desc" id="x_cat_desc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->cat_desc->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->cat_desc->EditValue ?>"<?php echo $inventory_reports_search->cat_desc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label for="x_item_model" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_item_model"><?php echo $inventory_reports_search->item_model->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_item_model" id="z_item_model" value="=">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->item_model->cellAttributes() ?>>
			<span id="el_inventory_reports_item_model" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_item_model" name="x_item_model" id="x_item_model" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($inventory_reports_search->item_model->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->item_model->EditValue ?>"<?php echo $inventory_reports_search->item_model->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->off_desc->Visible) { // off_desc ?>
	<div id="r_off_desc" class="form-group row">
		<label for="x_off_desc" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_off_desc"><?php echo $inventory_reports_search->off_desc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_off_desc" id="z_off_desc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->off_desc->cellAttributes() ?>>
			<span id="el_inventory_reports_off_desc" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_off_desc" name="x_off_desc" id="x_off_desc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->off_desc->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->off_desc->EditValue ?>"<?php echo $inventory_reports_search->off_desc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->region_name->Visible) { // region_name ?>
	<div id="r_region_name" class="form-group row">
		<label for="x_region_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_region_name"><?php echo $inventory_reports_search->region_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_region_name" id="z_region_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->region_name->cellAttributes() ?>>
			<span id="el_inventory_reports_region_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_region_name" name="x_region_name" id="x_region_name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($inventory_reports_search->region_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->region_name->EditValue ?>"<?php echo $inventory_reports_search->region_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->prov_name->Visible) { // prov_name ?>
	<div id="r_prov_name" class="form-group row">
		<label for="x_prov_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_prov_name"><?php echo $inventory_reports_search->prov_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_prov_name" id="z_prov_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->prov_name->cellAttributes() ?>>
			<span id="el_inventory_reports_prov_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_prov_name" name="x_prov_name" id="x_prov_name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($inventory_reports_search->prov_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->prov_name->EditValue ?>"<?php echo $inventory_reports_search->prov_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->city_name->Visible) { // city_name ?>
	<div id="r_city_name" class="form-group row">
		<label for="x_city_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_city_name"><?php echo $inventory_reports_search->city_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_city_name" id="z_city_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->city_name->cellAttributes() ?>>
			<span id="el_inventory_reports_city_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_city_name" name="x_city_name" id="x_city_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($inventory_reports_search->city_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->city_name->EditValue ?>"<?php echo $inventory_reports_search->city_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->inventory_status_dsc->Visible) { // inventory_status_dsc ?>
	<div id="r_inventory_status_dsc" class="form-group row">
		<label for="x_inventory_status_dsc" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_inventory_status_dsc"><?php echo $inventory_reports_search->inventory_status_dsc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_inventory_status_dsc" id="z_inventory_status_dsc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->inventory_status_dsc->cellAttributes() ?>>
			<span id="el_inventory_reports_inventory_status_dsc" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_inventory_status_dsc" name="x_inventory_status_dsc" id="x_inventory_status_dsc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->inventory_status_dsc->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->inventory_status_dsc->EditValue ?>"<?php echo $inventory_reports_search->inventory_status_dsc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->Last_Date_Check->Visible) { // Last_Date_Check ?>
	<div id="r_Last_Date_Check" class="form-group row">
		<label for="x_Last_Date_Check" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_Last_Date_Check"><?php echo $inventory_reports_search->Last_Date_Check->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Last_Date_Check" id="z_Last_Date_Check" value="=">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->Last_Date_Check->cellAttributes() ?>>
			<span id="el_inventory_reports_Last_Date_Check" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_Last_Date_Check" name="x_Last_Date_Check" id="x_Last_Date_Check" placeholder="<?php echo HtmlEncode($inventory_reports_search->Last_Date_Check->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->Last_Date_Check->EditValue ?>"<?php echo $inventory_reports_search->Last_Date_Check->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->Name_dsc->Visible) { // Name_dsc ?>
	<div id="r_Name_dsc" class="form-group row">
		<label for="x_Name_dsc" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_Name_dsc"><?php echo $inventory_reports_search->Name_dsc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Name_dsc" id="z_Name_dsc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->Name_dsc->cellAttributes() ?>>
			<span id="el_inventory_reports_Name_dsc" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_Name_dsc" name="x_Name_dsc" id="x_Name_dsc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->Name_dsc->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->Name_dsc->EditValue ?>"<?php echo $inventory_reports_search->Name_dsc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->user_last_modify->Visible) { // user_last_modify ?>
	<div id="r_user_last_modify" class="form-group row">
		<label for="x_user_last_modify" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_user_last_modify"><?php echo $inventory_reports_search->user_last_modify->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_user_last_modify" id="z_user_last_modify" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->user_last_modify->cellAttributes() ?>>
			<span id="el_inventory_reports_user_last_modify" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_user_last_modify" name="x_user_last_modify" id="x_user_last_modify" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->user_last_modify->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->user_last_modify->EditValue ?>"<?php echo $inventory_reports_search->user_last_modify->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->date_last_modify->Visible) { // date_last_modify ?>
	<div id="r_date_last_modify" class="form-group row">
		<label for="x_date_last_modify" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_date_last_modify"><?php echo $inventory_reports_search->date_last_modify->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_date_last_modify" id="z_date_last_modify" value="=">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->date_last_modify->cellAttributes() ?>>
			<span id="el_inventory_reports_date_last_modify" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_date_last_modify" name="x_date_last_modify" id="x_date_last_modify" maxlength="19" placeholder="<?php echo HtmlEncode($inventory_reports_search->date_last_modify->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->date_last_modify->EditValue ?>"<?php echo $inventory_reports_search->date_last_modify->editAttributes() ?>>
<?php if (!$inventory_reports_search->date_last_modify->ReadOnly && !$inventory_reports_search->date_last_modify->Disabled && !isset($inventory_reports_search->date_last_modify->EditAttrs["readonly"]) && !isset($inventory_reports_search->date_last_modify->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finventory_reportssearch", "datetimepicker"], function() {
	ew.createDateTimePicker("finventory_reportssearch", "x_date_last_modify", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->pullout_date->Visible) { // pullout_date ?>
	<div id="r_pullout_date" class="form-group row">
		<label for="x_pullout_date" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_pullout_date"><?php echo $inventory_reports_search->pullout_date->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_pullout_date" id="z_pullout_date" value="=">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->pullout_date->cellAttributes() ?>>
			<span id="el_inventory_reports_pullout_date" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_pullout_date" name="x_pullout_date" id="x_pullout_date" maxlength="19" placeholder="<?php echo HtmlEncode($inventory_reports_search->pullout_date->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->pullout_date->EditValue ?>"<?php echo $inventory_reports_search->pullout_date->editAttributes() ?>>
<?php if (!$inventory_reports_search->pullout_date->ReadOnly && !$inventory_reports_search->pullout_date->Disabled && !isset($inventory_reports_search->pullout_date->EditAttrs["readonly"]) && !isset($inventory_reports_search->pullout_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finventory_reportssearch", "datetimepicker"], function() {
	ew.createDateTimePicker("finventory_reportssearch", "x_pullout_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->pos_desc->Visible) { // pos_desc ?>
	<div id="r_pos_desc" class="form-group row">
		<label for="x_pos_desc" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_pos_desc"><?php echo $inventory_reports_search->pos_desc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pos_desc" id="z_pos_desc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->pos_desc->cellAttributes() ?>>
			<span id="el_inventory_reports_pos_desc" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_pos_desc" name="x_pos_desc" id="x_pos_desc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->pos_desc->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->pos_desc->EditValue ?>"<?php echo $inventory_reports_search->pos_desc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->current_location->Visible) { // current_location ?>
	<div id="r_current_location" class="form-group row">
		<label for="x_current_location" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_current_location"><?php echo $inventory_reports_search->current_location->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_current_location" id="z_current_location" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->current_location->cellAttributes() ?>>
			<span id="el_inventory_reports_current_location" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_current_location" name="x_current_location" id="x_current_location" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($inventory_reports_search->current_location->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->current_location->EditValue ?>"<?php echo $inventory_reports_search->current_location->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->last_name->Visible) { // last_name ?>
	<div id="r_last_name" class="form-group row">
		<label for="x_last_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_last_name"><?php echo $inventory_reports_search->last_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_last_name" id="z_last_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->last_name->cellAttributes() ?>>
			<span id="el_inventory_reports_last_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_last_name" name="x_last_name" id="x_last_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($inventory_reports_search->last_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->last_name->EditValue ?>"<?php echo $inventory_reports_search->last_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->first_name->Visible) { // first_name ?>
	<div id="r_first_name" class="form-group row">
		<label for="x_first_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_first_name"><?php echo $inventory_reports_search->first_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_first_name" id="z_first_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->first_name->cellAttributes() ?>>
			<span id="el_inventory_reports_first_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_first_name" name="x_first_name" id="x_first_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($inventory_reports_search->first_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->first_name->EditValue ?>"<?php echo $inventory_reports_search->first_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->mid_name->Visible) { // mid_name ?>
	<div id="r_mid_name" class="form-group row">
		<label for="x_mid_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_mid_name"><?php echo $inventory_reports_search->mid_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_mid_name" id="z_mid_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->mid_name->cellAttributes() ?>>
			<span id="el_inventory_reports_mid_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_mid_name" name="x_mid_name" id="x_mid_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($inventory_reports_search->mid_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->mid_name->EditValue ?>"<?php echo $inventory_reports_search->mid_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->ext_name->Visible) { // ext_name ?>
	<div id="r_ext_name" class="form-group row">
		<label for="x_ext_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_ext_name"><?php echo $inventory_reports_search->ext_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ext_name" id="z_ext_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->ext_name->cellAttributes() ?>>
			<span id="el_inventory_reports_ext_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_ext_name" name="x_ext_name" id="x_ext_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($inventory_reports_search->ext_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->ext_name->EditValue ?>"<?php echo $inventory_reports_search->ext_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->full_name->Visible) { // full_name ?>
	<div id="r_full_name" class="form-group row">
		<label for="x_full_name" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_full_name"><?php echo $inventory_reports_search->full_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_full_name" id="z_full_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->full_name->cellAttributes() ?>>
			<span id="el_inventory_reports_full_name" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_full_name" name="x_full_name" id="x_full_name" size="35" maxlength="403" placeholder="<?php echo HtmlEncode($inventory_reports_search->full_name->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->full_name->EditValue ?>"<?php echo $inventory_reports_search->full_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($inventory_reports_search->full_name_tbl->Visible) { // full_name_tbl ?>
	<div id="r_full_name_tbl" class="form-group row">
		<label for="x_full_name_tbl" class="<?php echo $inventory_reports_search->LeftColumnClass ?>"><span id="elh_inventory_reports_full_name_tbl"><?php echo $inventory_reports_search->full_name_tbl->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_full_name_tbl" id="z_full_name_tbl" value="LIKE">
</span>
		</label>
		<div class="<?php echo $inventory_reports_search->RightColumnClass ?>"><div <?php echo $inventory_reports_search->full_name_tbl->cellAttributes() ?>>
			<span id="el_inventory_reports_full_name_tbl" class="ew-search-field">
<input type="text" data-table="inventory_reports" data-field="x_full_name_tbl" name="x_full_name_tbl" id="x_full_name_tbl" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inventory_reports_search->full_name_tbl->getPlaceHolder()) ?>" value="<?php echo $inventory_reports_search->full_name_tbl->EditValue ?>"<?php echo $inventory_reports_search->full_name_tbl->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inventory_reports_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inventory_reports_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inventory_reports_search->showPageFooter();
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
$inventory_reports_search->terminate();
?>