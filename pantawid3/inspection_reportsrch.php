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
$inspection_report_search = new inspection_report_search();

// Run the page
$inspection_report_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inspection_report_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finspection_reportsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($inspection_report_search->IsModal) { ?>
	finspection_reportsearch = currentAdvancedSearchForm = new ew.Form("finspection_reportsearch", "search");
	<?php } else { ?>
	finspection_reportsearch = currentForm = new ew.Form("finspection_reportsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	finspection_reportsearch.validate = function(fobj) {
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
	finspection_reportsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	finspection_reportsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("finspection_reportsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $inspection_report_search->showPageHeader(); ?>
<?php
$inspection_report_search->showMessage();
?>
<form name="finspection_reportsearch" id="finspection_reportsearch" class="<?php echo $inspection_report_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inspection_report">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$inspection_report_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($inspection_report_search->SRN->Visible) { // SRN ?>
	<div id="r_SRN" class="form-group row">
		<label for="x_SRN" class="<?php echo $inspection_report_search->LeftColumnClass ?>"><span id="elh_inspection_report_SRN"><?php echo $inspection_report_search->SRN->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SRN" id="z_SRN" value="=">
</span>
		</label>
		<div class="<?php echo $inspection_report_search->RightColumnClass ?>"><div <?php echo $inspection_report_search->SRN->cellAttributes() ?>>
			<span id="el_inspection_report_SRN" class="ew-search-field">
<input type="text" data-table="inspection_report" data-field="x_SRN" name="x_SRN" id="x_SRN" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($inspection_report_search->SRN->getPlaceHolder()) ?>" value="<?php echo $inspection_report_search->SRN->EditValue ?>"<?php echo $inspection_report_search->SRN->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inspection_report_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inspection_report_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inspection_report_search->showPageFooter();
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
$inspection_report_search->terminate();
?>