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
$tbl_supplies_search = new tbl_supplies_search();

// Run the page
$tbl_supplies_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_suppliessearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($tbl_supplies_search->IsModal) { ?>
	ftbl_suppliessearch = currentAdvancedSearchForm = new ew.Form("ftbl_suppliessearch", "search");
	<?php } else { ?>
	ftbl_suppliessearch = currentForm = new ew.Form("ftbl_suppliessearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftbl_suppliessearch.validate = function(fobj) {
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
	ftbl_suppliessearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_suppliessearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_suppliessearch.lists["x_supplies_cat"] = <?php echo $tbl_supplies_search->supplies_cat->Lookup->toClientList($tbl_supplies_search) ?>;
	ftbl_suppliessearch.lists["x_supplies_cat"].options = <?php echo JsonEncode($tbl_supplies_search->supplies_cat->lookupOptions()) ?>;
	ftbl_suppliessearch.lists["x_model"] = <?php echo $tbl_supplies_search->model->Lookup->toClientList($tbl_supplies_search) ?>;
	ftbl_suppliessearch.lists["x_model"].options = <?php echo JsonEncode($tbl_supplies_search->model->lookupOptions()) ?>;
	ftbl_suppliessearch.lists["x_status"] = <?php echo $tbl_supplies_search->status->Lookup->toClientList($tbl_supplies_search) ?>;
	ftbl_suppliessearch.lists["x_status"].options = <?php echo JsonEncode($tbl_supplies_search->status->lookupOptions()) ?>;
	ftbl_suppliessearch.lists["x_Supplier"] = <?php echo $tbl_supplies_search->Supplier->Lookup->toClientList($tbl_supplies_search) ?>;
	ftbl_suppliessearch.lists["x_Supplier"].options = <?php echo JsonEncode($tbl_supplies_search->Supplier->lookupOptions()) ?>;
	ftbl_suppliessearch.lists["x_employeeid"] = <?php echo $tbl_supplies_search->employeeid->Lookup->toClientList($tbl_supplies_search) ?>;
	ftbl_suppliessearch.lists["x_employeeid"].options = <?php echo JsonEncode($tbl_supplies_search->employeeid->lookupOptions()) ?>;
	loadjs.done("ftbl_suppliessearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_supplies_search->showPageHeader(); ?>
<?php
$tbl_supplies_search->showMessage();
?>
<form name="ftbl_suppliessearch" id="ftbl_suppliessearch" class="<?php echo $tbl_supplies_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_supplies_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($tbl_supplies_search->supplies_cat->Visible) { // supplies_cat ?>
	<div id="r_supplies_cat" class="form-group row">
		<label for="x_supplies_cat" class="<?php echo $tbl_supplies_search->LeftColumnClass ?>"><span id="elh_tbl_supplies_supplies_cat"><?php echo $tbl_supplies_search->supplies_cat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_supplies_cat" id="z_supplies_cat" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_supplies_search->RightColumnClass ?>"><div <?php echo $tbl_supplies_search->supplies_cat->cellAttributes() ?>>
			<span id="el_tbl_supplies_supplies_cat" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_supplies_cat" data-value-separator="<?php echo $tbl_supplies_search->supplies_cat->displayValueSeparatorAttribute() ?>" id="x_supplies_cat" name="x_supplies_cat"<?php echo $tbl_supplies_search->supplies_cat->editAttributes() ?>>
			<?php echo $tbl_supplies_search->supplies_cat->selectOptionListHtml("x_supplies_cat") ?>
		</select>
</div>
<?php echo $tbl_supplies_search->supplies_cat->Lookup->getParamTag($tbl_supplies_search, "p_x_supplies_cat") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_search->model->Visible) { // model ?>
	<div id="r_model" class="form-group row">
		<label for="x_model" class="<?php echo $tbl_supplies_search->LeftColumnClass ?>"><span id="elh_tbl_supplies_model"><?php echo $tbl_supplies_search->model->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_model" id="z_model" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_supplies_search->RightColumnClass ?>"><div <?php echo $tbl_supplies_search->model->cellAttributes() ?>>
			<span id="el_tbl_supplies_model" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_model" data-value-separator="<?php echo $tbl_supplies_search->model->displayValueSeparatorAttribute() ?>" id="x_model" name="x_model"<?php echo $tbl_supplies_search->model->editAttributes() ?>>
			<?php echo $tbl_supplies_search->model->selectOptionListHtml("x_model") ?>
		</select>
</div>
<?php echo $tbl_supplies_search->model->Lookup->getParamTag($tbl_supplies_search, "p_x_model") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_search->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label for="x_status" class="<?php echo $tbl_supplies_search->LeftColumnClass ?>"><span id="elh_tbl_supplies_status"><?php echo $tbl_supplies_search->status->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status" id="z_status" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_supplies_search->RightColumnClass ?>"><div <?php echo $tbl_supplies_search->status->cellAttributes() ?>>
			<span id="el_tbl_supplies_status" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_status" data-value-separator="<?php echo $tbl_supplies_search->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $tbl_supplies_search->status->editAttributes() ?>>
			<?php echo $tbl_supplies_search->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $tbl_supplies_search->status->Lookup->getParamTag($tbl_supplies_search, "p_x_status") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_search->Supplier->Visible) { // Supplier ?>
	<div id="r_Supplier" class="form-group row">
		<label for="x_Supplier" class="<?php echo $tbl_supplies_search->LeftColumnClass ?>"><span id="elh_tbl_supplies_Supplier"><?php echo $tbl_supplies_search->Supplier->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Supplier" id="z_Supplier" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_supplies_search->RightColumnClass ?>"><div <?php echo $tbl_supplies_search->Supplier->cellAttributes() ?>>
			<span id="el_tbl_supplies_Supplier" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_Supplier" data-value-separator="<?php echo $tbl_supplies_search->Supplier->displayValueSeparatorAttribute() ?>" id="x_Supplier" name="x_Supplier"<?php echo $tbl_supplies_search->Supplier->editAttributes() ?>>
			<?php echo $tbl_supplies_search->Supplier->selectOptionListHtml("x_Supplier") ?>
		</select>
</div>
<?php echo $tbl_supplies_search->Supplier->Lookup->getParamTag($tbl_supplies_search, "p_x_Supplier") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_search->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label for="x_employeeid" class="<?php echo $tbl_supplies_search->LeftColumnClass ?>"><span id="elh_tbl_supplies_employeeid"><?php echo $tbl_supplies_search->employeeid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_employeeid" id="z_employeeid" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_supplies_search->RightColumnClass ?>"><div <?php echo $tbl_supplies_search->employeeid->cellAttributes() ?>>
			<span id="el_tbl_supplies_employeeid" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_employeeid" data-value-separator="<?php echo $tbl_supplies_search->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $tbl_supplies_search->employeeid->editAttributes() ?>>
			<?php echo $tbl_supplies_search->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $tbl_supplies_search->employeeid->Lookup->getParamTag($tbl_supplies_search, "p_x_employeeid") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_supplies_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_supplies_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_supplies_search->showPageFooter();
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
$tbl_supplies_search->terminate();
?>