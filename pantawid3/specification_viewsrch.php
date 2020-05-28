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
$specification_view_search = new specification_view_search();

// Run the page
$specification_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$specification_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fspecification_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($specification_view_search->IsModal) { ?>
	fspecification_viewsearch = currentAdvancedSearchForm = new ew.Form("fspecification_viewsearch", "search");
	<?php } else { ?>
	fspecification_viewsearch = currentForm = new ew.Form("fspecification_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fspecification_viewsearch.validate = function(fobj) {
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
	fspecification_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fspecification_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fspecification_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $specification_view_search->showPageHeader(); ?>
<?php
$specification_view_search->showMessage();
?>
<form name="fspecification_viewsearch" id="fspecification_viewsearch" class="<?php echo $specification_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="specification_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$specification_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($specification_view_search->pr_number->Visible) { // pr_number ?>
	<div id="r_pr_number" class="form-group row">
		<label for="x_pr_number" class="<?php echo $specification_view_search->LeftColumnClass ?>"><span id="elh_specification_view_pr_number"><?php echo $specification_view_search->pr_number->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pr_number" id="z_pr_number" value="LIKE">
</span>
		</label>
		<div class="<?php echo $specification_view_search->RightColumnClass ?>"><div <?php echo $specification_view_search->pr_number->cellAttributes() ?>>
			<span id="el_specification_view_pr_number" class="ew-search-field">
<input type="text" data-table="specification_view" data-field="x_pr_number" name="x_pr_number" id="x_pr_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($specification_view_search->pr_number->getPlaceHolder()) ?>" value="<?php echo $specification_view_search->pr_number->EditValue ?>"<?php echo $specification_view_search->pr_number->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($specification_view_search->spec_dsc->Visible) { // spec_dsc ?>
	<div id="r_spec_dsc" class="form-group row">
		<label for="x_spec_dsc" class="<?php echo $specification_view_search->LeftColumnClass ?>"><span id="elh_specification_view_spec_dsc"><?php echo $specification_view_search->spec_dsc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_spec_dsc" id="z_spec_dsc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $specification_view_search->RightColumnClass ?>"><div <?php echo $specification_view_search->spec_dsc->cellAttributes() ?>>
			<span id="el_specification_view_spec_dsc" class="ew-search-field">
<input type="text" data-table="specification_view" data-field="x_spec_dsc" name="x_spec_dsc" id="x_spec_dsc" maxlength="100" placeholder="<?php echo HtmlEncode($specification_view_search->spec_dsc->getPlaceHolder()) ?>" value="<?php echo $specification_view_search->spec_dsc->EditValue ?>"<?php echo $specification_view_search->spec_dsc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$specification_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $specification_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$specification_view_search->showPageFooter();
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
$specification_view_search->terminate();
?>