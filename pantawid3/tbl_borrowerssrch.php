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
$tbl_borrowers_search = new tbl_borrowers_search();

// Run the page
$tbl_borrowers_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_borrowers_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_borrowerssearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($tbl_borrowers_search->IsModal) { ?>
	ftbl_borrowerssearch = currentAdvancedSearchForm = new ew.Form("ftbl_borrowerssearch", "search");
	<?php } else { ?>
	ftbl_borrowerssearch = currentForm = new ew.Form("ftbl_borrowerssearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftbl_borrowerssearch.validate = function(fobj) {
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
	ftbl_borrowerssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_borrowerssearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_borrowerssearch.lists["x_item_type"] = <?php echo $tbl_borrowers_search->item_type->Lookup->toClientList($tbl_borrowers_search) ?>;
	ftbl_borrowerssearch.lists["x_item_type"].options = <?php echo JsonEncode($tbl_borrowers_search->item_type->lookupOptions()) ?>;
	ftbl_borrowerssearch.lists["x_status"] = <?php echo $tbl_borrowers_search->status->Lookup->toClientList($tbl_borrowers_search) ?>;
	ftbl_borrowerssearch.lists["x_status"].options = <?php echo JsonEncode($tbl_borrowers_search->status->lookupOptions()) ?>;
	loadjs.done("ftbl_borrowerssearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_borrowers_search->showPageHeader(); ?>
<?php
$tbl_borrowers_search->showMessage();
?>
<form name="ftbl_borrowerssearch" id="ftbl_borrowerssearch" class="<?php echo $tbl_borrowers_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_borrowers">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_borrowers_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($tbl_borrowers_search->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label for="x_item_type" class="<?php echo $tbl_borrowers_search->LeftColumnClass ?>"><span id="elh_tbl_borrowers_item_type"><?php echo $tbl_borrowers_search->item_type->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_item_type" id="z_item_type" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_borrowers_search->RightColumnClass ?>"><div <?php echo $tbl_borrowers_search->item_type->cellAttributes() ?>>
			<span id="el_tbl_borrowers_item_type" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_item_type" data-value-separator="<?php echo $tbl_borrowers_search->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $tbl_borrowers_search->item_type->editAttributes() ?>>
			<?php echo $tbl_borrowers_search->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $tbl_borrowers_search->item_type->Lookup->getParamTag($tbl_borrowers_search, "p_x_item_type") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_search->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label for="x_item_model" class="<?php echo $tbl_borrowers_search->LeftColumnClass ?>"><span id="elh_tbl_borrowers_item_model"><?php echo $tbl_borrowers_search->item_model->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_item_model" id="z_item_model" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_borrowers_search->RightColumnClass ?>"><div <?php echo $tbl_borrowers_search->item_model->cellAttributes() ?>>
			<span id="el_tbl_borrowers_item_model" class="ew-search-field">
<input type="text" data-table="tbl_borrowers" data-field="x_item_model" name="x_item_model" id="x_item_model" size="71" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_borrowers_search->item_model->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_search->item_model->EditValue ?>"<?php echo $tbl_borrowers_search->item_model->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_search->item_serial->Visible) { // item_serial ?>
	<div id="r_item_serial" class="form-group row">
		<label for="x_item_serial" class="<?php echo $tbl_borrowers_search->LeftColumnClass ?>"><span id="elh_tbl_borrowers_item_serial"><?php echo $tbl_borrowers_search->item_serial->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_item_serial" id="z_item_serial" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_borrowers_search->RightColumnClass ?>"><div <?php echo $tbl_borrowers_search->item_serial->cellAttributes() ?>>
			<span id="el_tbl_borrowers_item_serial" class="ew-search-field">
<input type="text" data-table="tbl_borrowers" data-field="x_item_serial" name="x_item_serial" id="x_item_serial" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($tbl_borrowers_search->item_serial->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_search->item_serial->EditValue ?>"<?php echo $tbl_borrowers_search->item_serial->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_search->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label for="x_status" class="<?php echo $tbl_borrowers_search->LeftColumnClass ?>"><span id="elh_tbl_borrowers_status"><?php echo $tbl_borrowers_search->status->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status" id="z_status" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_borrowers_search->RightColumnClass ?>"><div <?php echo $tbl_borrowers_search->status->cellAttributes() ?>>
			<span id="el_tbl_borrowers_status" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_status" data-value-separator="<?php echo $tbl_borrowers_search->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $tbl_borrowers_search->status->editAttributes() ?>>
			<?php echo $tbl_borrowers_search->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $tbl_borrowers_search->status->Lookup->getParamTag($tbl_borrowers_search, "p_x_status") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_borrowers_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_borrowers_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_borrowers_search->showPageFooter();
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
$tbl_borrowers_search->terminate();
?>