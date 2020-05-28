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
$tbl_printing_search = new tbl_printing_search();

// Run the page
$tbl_printing_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printing_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_printingsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($tbl_printing_search->IsModal) { ?>
	ftbl_printingsearch = currentAdvancedSearchForm = new ew.Form("ftbl_printingsearch", "search");
	<?php } else { ?>
	ftbl_printingsearch = currentForm = new ew.Form("ftbl_printingsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftbl_printingsearch.validate = function(fobj) {
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
	ftbl_printingsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_printingsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_printingsearch.lists["x_printing_type"] = <?php echo $tbl_printing_search->printing_type->Lookup->toClientList($tbl_printing_search) ?>;
	ftbl_printingsearch.lists["x_printing_type"].options = <?php echo JsonEncode($tbl_printing_search->printing_type->lookupOptions()) ?>;
	ftbl_printingsearch.lists["x_employee_id"] = <?php echo $tbl_printing_search->employee_id->Lookup->toClientList($tbl_printing_search) ?>;
	ftbl_printingsearch.lists["x_employee_id"].options = <?php echo JsonEncode($tbl_printing_search->employee_id->lookupOptions()) ?>;
	loadjs.done("ftbl_printingsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_printing_search->showPageHeader(); ?>
<?php
$tbl_printing_search->showMessage();
?>
<form name="ftbl_printingsearch" id="ftbl_printingsearch" class="<?php echo $tbl_printing_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printing">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_printing_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($tbl_printing_search->printing_type->Visible) { // printing_type ?>
	<div id="r_printing_type" class="form-group row">
		<label for="x_printing_type" class="<?php echo $tbl_printing_search->LeftColumnClass ?>"><span id="elh_tbl_printing_printing_type"><?php echo $tbl_printing_search->printing_type->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_printing_type" id="z_printing_type" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_printing_search->RightColumnClass ?>"><div <?php echo $tbl_printing_search->printing_type->cellAttributes() ?>>
			<span id="el_tbl_printing_printing_type" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_printing" data-field="x_printing_type" data-value-separator="<?php echo $tbl_printing_search->printing_type->displayValueSeparatorAttribute() ?>" id="x_printing_type" name="x_printing_type"<?php echo $tbl_printing_search->printing_type->editAttributes() ?>>
			<?php echo $tbl_printing_search->printing_type->selectOptionListHtml("x_printing_type") ?>
		</select>
</div>
<?php echo $tbl_printing_search->printing_type->Lookup->getParamTag($tbl_printing_search, "p_x_printing_type") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_printing_search->employee_id->Visible) { // employee_id ?>
	<div id="r_employee_id" class="form-group row">
		<label for="x_employee_id" class="<?php echo $tbl_printing_search->LeftColumnClass ?>"><span id="elh_tbl_printing_employee_id"><?php echo $tbl_printing_search->employee_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_employee_id" id="z_employee_id" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_printing_search->RightColumnClass ?>"><div <?php echo $tbl_printing_search->employee_id->cellAttributes() ?>>
			<span id="el_tbl_printing_employee_id" class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$tbl_printing->userIDAllow("search")) { // Non system admin ?>
<span<?php echo $tbl_printing_search->employee_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_printing_search->employee_id->EditValue)) ?>"></span>
<input type="hidden" data-table="tbl_printing" data-field="x_employee_id" name="x_employee_id" id="x_employee_id" value="<?php echo HtmlEncode($tbl_printing_search->employee_id->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_printing" data-field="x_employee_id" data-value-separator="<?php echo $tbl_printing_search->employee_id->displayValueSeparatorAttribute() ?>" id="x_employee_id" name="x_employee_id"<?php echo $tbl_printing_search->employee_id->editAttributes() ?>>
			<?php echo $tbl_printing_search->employee_id->selectOptionListHtml("x_employee_id") ?>
		</select>
</div>
<?php echo $tbl_printing_search->employee_id->Lookup->getParamTag($tbl_printing_search, "p_x_employee_id") ?>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_printing_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_printing_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_printing_search->showPageFooter();
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
$tbl_printing_search->terminate();
?>