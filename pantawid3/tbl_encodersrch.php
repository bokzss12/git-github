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
$tbl_encoder_search = new tbl_encoder_search();

// Run the page
$tbl_encoder_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_encodersearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($tbl_encoder_search->IsModal) { ?>
	ftbl_encodersearch = currentAdvancedSearchForm = new ew.Form("ftbl_encodersearch", "search");
	<?php } else { ?>
	ftbl_encodersearch = currentForm = new ew.Form("ftbl_encodersearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftbl_encodersearch.validate = function(fobj) {
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
	ftbl_encodersearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_encodersearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_encodersearch.lists["x_activities"] = <?php echo $tbl_encoder_search->activities->Lookup->toClientList($tbl_encoder_search) ?>;
	ftbl_encodersearch.lists["x_activities"].options = <?php echo JsonEncode($tbl_encoder_search->activities->lookupOptions()) ?>;
	ftbl_encodersearch.lists["x_employee_id"] = <?php echo $tbl_encoder_search->employee_id->Lookup->toClientList($tbl_encoder_search) ?>;
	ftbl_encodersearch.lists["x_employee_id"].options = <?php echo JsonEncode($tbl_encoder_search->employee_id->lookupOptions()) ?>;
	loadjs.done("ftbl_encodersearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_encoder_search->showPageHeader(); ?>
<?php
$tbl_encoder_search->showMessage();
?>
<form name="ftbl_encodersearch" id="ftbl_encodersearch" class="<?php echo $tbl_encoder_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_encoder_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($tbl_encoder_search->activities->Visible) { // activities ?>
	<div id="r_activities" class="form-group row">
		<label for="x_activities" class="<?php echo $tbl_encoder_search->LeftColumnClass ?>"><span id="elh_tbl_encoder_activities"><?php echo $tbl_encoder_search->activities->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_activities" id="z_activities" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_encoder_search->RightColumnClass ?>"><div <?php echo $tbl_encoder_search->activities->cellAttributes() ?>>
			<span id="el_tbl_encoder_activities" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_encoder" data-field="x_activities" data-value-separator="<?php echo $tbl_encoder_search->activities->displayValueSeparatorAttribute() ?>" id="x_activities" name="x_activities"<?php echo $tbl_encoder_search->activities->editAttributes() ?>>
			<?php echo $tbl_encoder_search->activities->selectOptionListHtml("x_activities") ?>
		</select>
</div>
<?php echo $tbl_encoder_search->activities->Lookup->getParamTag($tbl_encoder_search, "p_x_activities") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($tbl_encoder_search->employee_id->Visible) { // employee_id ?>
	<div id="r_employee_id" class="form-group row">
		<label for="x_employee_id" class="<?php echo $tbl_encoder_search->LeftColumnClass ?>"><span id="elh_tbl_encoder_employee_id"><?php echo $tbl_encoder_search->employee_id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_employee_id" id="z_employee_id" value="=">
</span>
		</label>
		<div class="<?php echo $tbl_encoder_search->RightColumnClass ?>"><div <?php echo $tbl_encoder_search->employee_id->cellAttributes() ?>>
			<span id="el_tbl_encoder_employee_id" class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$tbl_encoder->userIDAllow("search")) { // Non system admin ?>
<span<?php echo $tbl_encoder_search->employee_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_encoder_search->employee_id->EditValue)) ?>"></span>
<input type="hidden" data-table="tbl_encoder" data-field="x_employee_id" name="x_employee_id" id="x_employee_id" value="<?php echo HtmlEncode($tbl_encoder_search->employee_id->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_encoder" data-field="x_employee_id" data-value-separator="<?php echo $tbl_encoder_search->employee_id->displayValueSeparatorAttribute() ?>" id="x_employee_id" name="x_employee_id"<?php echo $tbl_encoder_search->employee_id->editAttributes() ?>>
			<?php echo $tbl_encoder_search->employee_id->selectOptionListHtml("x_employee_id") ?>
		</select>
</div>
<?php echo $tbl_encoder_search->employee_id->Lookup->getParamTag($tbl_encoder_search, "p_x_employee_id") ?>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_encoder_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_encoder_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_encoder_search->showPageFooter();
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
$tbl_encoder_search->terminate();
?>