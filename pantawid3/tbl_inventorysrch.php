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
$tbl_inventory_search = new tbl_inventory_search();

// Run the page
$tbl_inventory_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_inventorysearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($tbl_inventory_search->IsModal) { ?>
	ftbl_inventorysearch = currentAdvancedSearchForm = new ew.Form("ftbl_inventorysearch", "search");
	<?php } else { ?>
	ftbl_inventorysearch = currentForm = new ew.Form("ftbl_inventorysearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftbl_inventorysearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ftbl_inventorysearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_inventorysearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_inventorysearch.lists["x_item_type"] = <?php echo $tbl_inventory_search->item_type->Lookup->toClientList($tbl_inventory_search) ?>;
	ftbl_inventorysearch.lists["x_item_type"].options = <?php echo JsonEncode($tbl_inventory_search->item_type->lookupOptions()) ?>;
	ftbl_inventorysearch.lists["x_office_id"] = <?php echo $tbl_inventory_search->office_id->Lookup->toClientList($tbl_inventory_search) ?>;
	ftbl_inventorysearch.lists["x_office_id"].options = <?php echo JsonEncode($tbl_inventory_search->office_id->lookupOptions()) ?>;
	ftbl_inventorysearch.lists["x_Region"] = <?php echo $tbl_inventory_search->Region->Lookup->toClientList($tbl_inventory_search) ?>;
	ftbl_inventorysearch.lists["x_Region"].options = <?php echo JsonEncode($tbl_inventory_search->Region->lookupOptions()) ?>;
	ftbl_inventorysearch.lists["x_Province"] = <?php echo $tbl_inventory_search->Province->Lookup->toClientList($tbl_inventory_search) ?>;
	ftbl_inventorysearch.lists["x_Province"].options = <?php echo JsonEncode($tbl_inventory_search->Province->lookupOptions()) ?>;
	ftbl_inventorysearch.lists["x_Cities"] = <?php echo $tbl_inventory_search->Cities->Lookup->toClientList($tbl_inventory_search) ?>;
	ftbl_inventorysearch.lists["x_Cities"].options = <?php echo JsonEncode($tbl_inventory_search->Cities->lookupOptions()) ?>;
	ftbl_inventorysearch.lists["x_status"] = <?php echo $tbl_inventory_search->status->Lookup->toClientList($tbl_inventory_search) ?>;
	ftbl_inventorysearch.lists["x_status"].options = <?php echo JsonEncode($tbl_inventory_search->status->lookupOptions()) ?>;
	loadjs.done("ftbl_inventorysearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_inventory_search->showPageHeader(); ?>
<?php
$tbl_inventory_search->showMessage();
?>
<form name="ftbl_inventorysearch" id="ftbl_inventorysearch" class="<?php echo $tbl_inventory_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_inventory_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($tbl_inventory_search->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label for="x_item_type" class="<?php echo $tbl_inventory_search->LeftColumnClass ?>"><span id="elh_tbl_inventory_item_type"><?php echo $tbl_inventory_search->item_type->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_item_type" id="z_item_type" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_inventory_search->RightColumnClass ?>"><div <?php echo $tbl_inventory_search->item_type->cellAttributes() ?>>
			<span id="el_tbl_inventory_item_type" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_item_type" data-value-separator="<?php echo $tbl_inventory_search->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $tbl_inventory_search->item_type->editAttributes() ?>>
			<?php echo $tbl_inventory_search->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $tbl_inventory_search->item_type->Lookup->getParamTag($tbl_inventory_search, "p_x_item_type") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_search->office_id->Visible) { // office_id ?>
	<div id="r_office_id" class="form-group row">
		<label for="x_office_id" class="<?php echo $tbl_inventory_search->LeftColumnClass ?>"><span id="elh_tbl_inventory_office_id"><?php echo $tbl_inventory_search->office_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_office_id" id="z_office_id" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_inventory_search->RightColumnClass ?>"><div <?php echo $tbl_inventory_search->office_id->cellAttributes() ?>>
			<span id="el_tbl_inventory_office_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_office_id" data-value-separator="<?php echo $tbl_inventory_search->office_id->displayValueSeparatorAttribute() ?>" id="x_office_id" name="x_office_id"<?php echo $tbl_inventory_search->office_id->editAttributes() ?>>
			<?php echo $tbl_inventory_search->office_id->selectOptionListHtml("x_office_id") ?>
		</select>
</div>
<?php echo $tbl_inventory_search->office_id->Lookup->getParamTag($tbl_inventory_search, "p_x_office_id") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_search->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label for="x_Region" class="<?php echo $tbl_inventory_search->LeftColumnClass ?>"><span id="elh_tbl_inventory_Region"><?php echo $tbl_inventory_search->Region->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Region" id="z_Region" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_inventory_search->RightColumnClass ?>"><div <?php echo $tbl_inventory_search->Region->cellAttributes() ?>>
			<span id="el_tbl_inventory_Region" class="ew-search-field">
<?php $tbl_inventory_search->Region->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Region" data-value-separator="<?php echo $tbl_inventory_search->Region->displayValueSeparatorAttribute() ?>" id="x_Region" name="x_Region"<?php echo $tbl_inventory_search->Region->editAttributes() ?>>
			<?php echo $tbl_inventory_search->Region->selectOptionListHtml("x_Region") ?>
		</select>
</div>
<?php echo $tbl_inventory_search->Region->Lookup->getParamTag($tbl_inventory_search, "p_x_Region") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_search->Province->Visible) { // Province ?>
	<div id="r_Province" class="form-group row">
		<label for="x_Province" class="<?php echo $tbl_inventory_search->LeftColumnClass ?>"><span id="elh_tbl_inventory_Province"><?php echo $tbl_inventory_search->Province->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Province" id="z_Province" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_inventory_search->RightColumnClass ?>"><div <?php echo $tbl_inventory_search->Province->cellAttributes() ?>>
			<span id="el_tbl_inventory_Province" class="ew-search-field">
<?php $tbl_inventory_search->Province->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Province" data-value-separator="<?php echo $tbl_inventory_search->Province->displayValueSeparatorAttribute() ?>" id="x_Province" name="x_Province"<?php echo $tbl_inventory_search->Province->editAttributes() ?>>
			<?php echo $tbl_inventory_search->Province->selectOptionListHtml("x_Province") ?>
		</select>
</div>
<?php echo $tbl_inventory_search->Province->Lookup->getParamTag($tbl_inventory_search, "p_x_Province") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_search->Cities->Visible) { // Cities ?>
	<div id="r_Cities" class="form-group row">
		<label for="x_Cities" class="<?php echo $tbl_inventory_search->LeftColumnClass ?>"><span id="elh_tbl_inventory_Cities"><?php echo $tbl_inventory_search->Cities->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Cities" id="z_Cities" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_inventory_search->RightColumnClass ?>"><div <?php echo $tbl_inventory_search->Cities->cellAttributes() ?>>
			<span id="el_tbl_inventory_Cities" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Cities" data-value-separator="<?php echo $tbl_inventory_search->Cities->displayValueSeparatorAttribute() ?>" id="x_Cities" name="x_Cities"<?php echo $tbl_inventory_search->Cities->editAttributes() ?>>
			<?php echo $tbl_inventory_search->Cities->selectOptionListHtml("x_Cities") ?>
		</select>
</div>
<?php echo $tbl_inventory_search->Cities->Lookup->getParamTag($tbl_inventory_search, "p_x_Cities") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_search->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label for="x_status" class="<?php echo $tbl_inventory_search->LeftColumnClass ?>"><span id="elh_tbl_inventory_status"><?php echo $tbl_inventory_search->status->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status" id="z_status" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_inventory_search->RightColumnClass ?>"><div <?php echo $tbl_inventory_search->status->cellAttributes() ?>>
			<span id="el_tbl_inventory_status" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_status" data-value-separator="<?php echo $tbl_inventory_search->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $tbl_inventory_search->status->editAttributes() ?>>
			<?php echo $tbl_inventory_search->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $tbl_inventory_search->status->Lookup->getParamTag($tbl_inventory_search, "p_x_status") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_inventory_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_inventory_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_inventory_search->showPageFooter();
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
$tbl_inventory_search->terminate();
?>