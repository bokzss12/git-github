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
$tbl_item_search = new tbl_item_search();

// Run the page
$tbl_item_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_itemsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($tbl_item_search->IsModal) { ?>
	ftbl_itemsearch = currentAdvancedSearchForm = new ew.Form("ftbl_itemsearch", "search");
	<?php } else { ?>
	ftbl_itemsearch = currentForm = new ew.Form("ftbl_itemsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftbl_itemsearch.validate = function(fobj) {
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
	ftbl_itemsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_itemsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_itemsearch.lists["x___Request"] = <?php echo $tbl_item_search->__Request->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x___Request"].options = <?php echo JsonEncode($tbl_item_search->__Request->lookupOptions()) ?>;
	ftbl_itemsearch.lists["x_item_type"] = <?php echo $tbl_item_search->item_type->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x_item_type"].options = <?php echo JsonEncode($tbl_item_search->item_type->lookupOptions()) ?>;
	ftbl_itemsearch.lists["x_item_requested_unit"] = <?php echo $tbl_item_search->item_requested_unit->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x_item_requested_unit"].options = <?php echo JsonEncode($tbl_item_search->item_requested_unit->lookupOptions()) ?>;
	ftbl_itemsearch.lists["x_Region"] = <?php echo $tbl_item_search->Region->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x_Region"].options = <?php echo JsonEncode($tbl_item_search->Region->lookupOptions()) ?>;
	ftbl_itemsearch.lists["x_Province"] = <?php echo $tbl_item_search->Province->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x_Province"].options = <?php echo JsonEncode($tbl_item_search->Province->lookupOptions()) ?>;
	ftbl_itemsearch.lists["x_Cities"] = <?php echo $tbl_item_search->Cities->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x_Cities"].options = <?php echo JsonEncode($tbl_item_search->Cities->lookupOptions()) ?>;
	ftbl_itemsearch.lists["x_employeeid"] = <?php echo $tbl_item_search->employeeid->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x_employeeid"].options = <?php echo JsonEncode($tbl_item_search->employeeid->lookupOptions()) ?>;
	ftbl_itemsearch.lists["x_status_id"] = <?php echo $tbl_item_search->status_id->Lookup->toClientList($tbl_item_search) ?>;
	ftbl_itemsearch.lists["x_status_id"].options = <?php echo JsonEncode($tbl_item_search->status_id->lookupOptions()) ?>;
	loadjs.done("ftbl_itemsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_item_search->showPageHeader(); ?>
<?php
$tbl_item_search->showMessage();
?>
<form name="ftbl_itemsearch" id="ftbl_itemsearch" class="<?php echo $tbl_item_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_item_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($tbl_item_search->__Request->Visible) { // Request ?>
	<div id="r___Request" class="form-group row">
		<label for="x___Request" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item___Request"><?php echo $tbl_item_search->__Request->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z___Request" id="z___Request" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->__Request->cellAttributes() ?>>
			<span id="el_tbl_item___Request" class="ew-search-field">
<?php $tbl_item_search->__Request->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x___Request" data-value-separator="<?php echo $tbl_item_search->__Request->displayValueSeparatorAttribute() ?>" id="x___Request" name="x___Request"<?php echo $tbl_item_search->__Request->editAttributes() ?>>
			<?php echo $tbl_item_search->__Request->selectOptionListHtml("x___Request") ?>
		</select>
</div>
<?php echo $tbl_item_search->__Request->Lookup->getParamTag($tbl_item_search, "p_x___Request") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_search->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label for="x_item_type" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item_item_type"><?php echo $tbl_item_search->item_type->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_item_type" id="z_item_type" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->item_type->cellAttributes() ?>>
			<span id="el_tbl_item_item_type" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_item_type" data-value-separator="<?php echo $tbl_item_search->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $tbl_item_search->item_type->editAttributes() ?>>
			<?php echo $tbl_item_search->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $tbl_item_search->item_type->Lookup->getParamTag($tbl_item_search, "p_x_item_type") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_search->item_requested_unit->Visible) { // item_requested_unit ?>
	<div id="r_item_requested_unit" class="form-group row">
		<label for="x_item_requested_unit" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item_item_requested_unit"><?php echo $tbl_item_search->item_requested_unit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_item_requested_unit" id="z_item_requested_unit" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->item_requested_unit->cellAttributes() ?>>
			<span id="el_tbl_item_item_requested_unit" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_item_requested_unit" data-value-separator="<?php echo $tbl_item_search->item_requested_unit->displayValueSeparatorAttribute() ?>" id="x_item_requested_unit" name="x_item_requested_unit"<?php echo $tbl_item_search->item_requested_unit->editAttributes() ?>>
			<?php echo $tbl_item_search->item_requested_unit->selectOptionListHtml("x_item_requested_unit") ?>
		</select>
</div>
<?php echo $tbl_item_search->item_requested_unit->Lookup->getParamTag($tbl_item_search, "p_x_item_requested_unit") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_search->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label for="x_Region" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item_Region"><?php echo $tbl_item_search->Region->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Region" id="z_Region" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->Region->cellAttributes() ?>>
			<span id="el_tbl_item_Region" class="ew-search-field">
<?php $tbl_item_search->Region->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_Region" data-value-separator="<?php echo $tbl_item_search->Region->displayValueSeparatorAttribute() ?>" id="x_Region" name="x_Region"<?php echo $tbl_item_search->Region->editAttributes() ?>>
			<?php echo $tbl_item_search->Region->selectOptionListHtml("x_Region") ?>
		</select>
</div>
<?php echo $tbl_item_search->Region->Lookup->getParamTag($tbl_item_search, "p_x_Region") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_search->Province->Visible) { // Province ?>
	<div id="r_Province" class="form-group row">
		<label for="x_Province" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item_Province"><?php echo $tbl_item_search->Province->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Province" id="z_Province" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->Province->cellAttributes() ?>>
			<span id="el_tbl_item_Province" class="ew-search-field">
<?php $tbl_item_search->Province->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_Province" data-value-separator="<?php echo $tbl_item_search->Province->displayValueSeparatorAttribute() ?>" id="x_Province" name="x_Province"<?php echo $tbl_item_search->Province->editAttributes() ?>>
			<?php echo $tbl_item_search->Province->selectOptionListHtml("x_Province") ?>
		</select>
</div>
<?php echo $tbl_item_search->Province->Lookup->getParamTag($tbl_item_search, "p_x_Province") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_search->Cities->Visible) { // Cities ?>
	<div id="r_Cities" class="form-group row">
		<label for="x_Cities" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item_Cities"><?php echo $tbl_item_search->Cities->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Cities" id="z_Cities" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->Cities->cellAttributes() ?>>
			<span id="el_tbl_item_Cities" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_Cities" data-value-separator="<?php echo $tbl_item_search->Cities->displayValueSeparatorAttribute() ?>" id="x_Cities" name="x_Cities"<?php echo $tbl_item_search->Cities->editAttributes() ?>>
			<?php echo $tbl_item_search->Cities->selectOptionListHtml("x_Cities") ?>
		</select>
</div>
<?php echo $tbl_item_search->Cities->Lookup->getParamTag($tbl_item_search, "p_x_Cities") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_search->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label for="x_employeeid" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item_employeeid"><?php echo $tbl_item_search->employeeid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_employeeid" id="z_employeeid" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->employeeid->cellAttributes() ?>>
			<span id="el_tbl_item_employeeid" class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$tbl_item->userIDAllow("search")) { // Non system admin ?>
<span<?php echo $tbl_item_search->employeeid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_item_search->employeeid->EditValue)) ?>"></span>
<input type="hidden" data-table="tbl_item" data-field="x_employeeid" name="x_employeeid" id="x_employeeid" value="<?php echo HtmlEncode($tbl_item_search->employeeid->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_employeeid" data-value-separator="<?php echo $tbl_item_search->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $tbl_item_search->employeeid->editAttributes() ?>>
			<?php echo $tbl_item_search->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $tbl_item_search->employeeid->Lookup->getParamTag($tbl_item_search, "p_x_employeeid") ?>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_search->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group row">
		<label for="x_status_id" class="<?php echo $tbl_item_search->LeftColumnClass ?>"><span id="elh_tbl_item_status_id"><?php echo $tbl_item_search->status_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status_id" id="z_status_id" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_item_search->RightColumnClass ?>"><div <?php echo $tbl_item_search->status_id->cellAttributes() ?>>
			<span id="el_tbl_item_status_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_status_id" data-value-separator="<?php echo $tbl_item_search->status_id->displayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $tbl_item_search->status_id->editAttributes() ?>>
			<?php echo $tbl_item_search->status_id->selectOptionListHtml("x_status_id") ?>
		</select>
</div>
<?php echo $tbl_item_search->status_id->Lookup->getParamTag($tbl_item_search, "p_x_status_id") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_item_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_item_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_item_search->showPageFooter();
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
$tbl_item_search->terminate();
?>