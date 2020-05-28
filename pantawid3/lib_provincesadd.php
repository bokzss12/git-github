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
$lib_provinces_add = new lib_provinces_add();

// Run the page
$lib_provinces_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_provinces_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flib_provincesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flib_provincesadd = currentForm = new ew.Form("flib_provincesadd", "add");

	// Validate form
	flib_provincesadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($lib_provinces_add->prov_name->Required) { ?>
				elm = this.getElements("x" + infix + "_prov_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_provinces_add->prov_name->caption(), $lib_provinces_add->prov_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_provinces_add->psgc_prv->Required) { ?>
				elm = this.getElements("x" + infix + "_psgc_prv");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_provinces_add->psgc_prv->caption(), $lib_provinces_add->psgc_prv->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_provinces_add->region_code->Required) { ?>
				elm = this.getElements("x" + infix + "_region_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_provinces_add->region_code->caption(), $lib_provinces_add->region_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_region_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lib_provinces_add->region_code->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	flib_provincesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flib_provincesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flib_provincesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lib_provinces_add->showPageHeader(); ?>
<?php
$lib_provinces_add->showMessage();
?>
<form name="flib_provincesadd" id="flib_provincesadd" class="<?php echo $lib_provinces_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_provinces">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$lib_provinces_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($lib_provinces_add->prov_name->Visible) { // prov_name ?>
	<div id="r_prov_name" class="form-group row">
		<label id="elh_lib_provinces_prov_name" for="x_prov_name" class="<?php echo $lib_provinces_add->LeftColumnClass ?>"><?php echo $lib_provinces_add->prov_name->caption() ?><?php echo $lib_provinces_add->prov_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_provinces_add->RightColumnClass ?>"><div <?php echo $lib_provinces_add->prov_name->cellAttributes() ?>>
<span id="el_lib_provinces_prov_name">
<input type="text" data-table="lib_provinces" data-field="x_prov_name" name="x_prov_name" id="x_prov_name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($lib_provinces_add->prov_name->getPlaceHolder()) ?>" value="<?php echo $lib_provinces_add->prov_name->EditValue ?>"<?php echo $lib_provinces_add->prov_name->editAttributes() ?>>
</span>
<?php echo $lib_provinces_add->prov_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_provinces_add->psgc_prv->Visible) { // psgc_prv ?>
	<div id="r_psgc_prv" class="form-group row">
		<label id="elh_lib_provinces_psgc_prv" for="x_psgc_prv" class="<?php echo $lib_provinces_add->LeftColumnClass ?>"><?php echo $lib_provinces_add->psgc_prv->caption() ?><?php echo $lib_provinces_add->psgc_prv->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_provinces_add->RightColumnClass ?>"><div <?php echo $lib_provinces_add->psgc_prv->cellAttributes() ?>>
<span id="el_lib_provinces_psgc_prv">
<input type="text" data-table="lib_provinces" data-field="x_psgc_prv" name="x_psgc_prv" id="x_psgc_prv" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($lib_provinces_add->psgc_prv->getPlaceHolder()) ?>" value="<?php echo $lib_provinces_add->psgc_prv->EditValue ?>"<?php echo $lib_provinces_add->psgc_prv->editAttributes() ?>>
</span>
<?php echo $lib_provinces_add->psgc_prv->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_provinces_add->region_code->Visible) { // region_code ?>
	<div id="r_region_code" class="form-group row">
		<label id="elh_lib_provinces_region_code" for="x_region_code" class="<?php echo $lib_provinces_add->LeftColumnClass ?>"><?php echo $lib_provinces_add->region_code->caption() ?><?php echo $lib_provinces_add->region_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_provinces_add->RightColumnClass ?>"><div <?php echo $lib_provinces_add->region_code->cellAttributes() ?>>
<span id="el_lib_provinces_region_code">
<input type="text" data-table="lib_provinces" data-field="x_region_code" name="x_region_code" id="x_region_code" size="30" placeholder="<?php echo HtmlEncode($lib_provinces_add->region_code->getPlaceHolder()) ?>" value="<?php echo $lib_provinces_add->region_code->EditValue ?>"<?php echo $lib_provinces_add->region_code->editAttributes() ?>>
</span>
<?php echo $lib_provinces_add->region_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$lib_provinces_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $lib_provinces_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lib_provinces_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$lib_provinces_add->showPageFooter();
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
$lib_provinces_add->terminate();
?>