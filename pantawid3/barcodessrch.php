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
$barcodes_search = new barcodes_search();

// Run the page
$barcodes_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$barcodes_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbarcodessearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($barcodes_search->IsModal) { ?>
	fbarcodessearch = currentAdvancedSearchForm = new ew.Form("fbarcodessearch", "search");
	<?php } else { ?>
	fbarcodessearch = currentForm = new ew.Form("fbarcodessearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fbarcodessearch.validate = function(fobj) {
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
	fbarcodessearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbarcodessearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbarcodessearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $barcodes_search->showPageHeader(); ?>
<?php
$barcodes_search->showMessage();
?>
<form name="fbarcodessearch" id="fbarcodessearch" class="<?php echo $barcodes_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="barcodes">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$barcodes_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($barcodes_search->concat_id->Visible) { // concat_id ?>
	<div id="r_concat_id" class="form-group row">
		<label for="x_concat_id" class="<?php echo $barcodes_search->LeftColumnClass ?>"><span id="elh_barcodes_concat_id"><?php echo $barcodes_search->concat_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_concat_id" id="z_concat_id" value="=">
</span>
		</label>
		<div class="<?php echo $barcodes_search->RightColumnClass ?>"><div <?php echo $barcodes_search->concat_id->cellAttributes() ?>>
			<span id="el_barcodes_concat_id" class="ew-search-field">
<input type="text" data-table="barcodes" data-field="x_concat_id" name="x_concat_id" id="x_concat_id" size="30" maxlength="17" placeholder="<?php echo HtmlEncode($barcodes_search->concat_id->getPlaceHolder()) ?>" value="<?php echo $barcodes_search->concat_id->EditValue ?>"<?php echo $barcodes_search->concat_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$barcodes_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $barcodes_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$barcodes_search->showPageFooter();
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
$barcodes_search->terminate();
?>