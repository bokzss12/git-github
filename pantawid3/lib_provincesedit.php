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
$lib_provinces_edit = new lib_provinces_edit();

// Run the page
$lib_provinces_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_provinces_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flib_provincesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	flib_provincesedit = currentForm = new ew.Form("flib_provincesedit", "edit");

	// Validate form
	flib_provincesedit.validate = function() {
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
			<?php if ($lib_provinces_edit->prov_code->Required) { ?>
				elm = this.getElements("x" + infix + "_prov_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_provinces_edit->prov_code->caption(), $lib_provinces_edit->prov_code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_provinces_edit->prov_name->Required) { ?>
				elm = this.getElements("x" + infix + "_prov_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_provinces_edit->prov_name->caption(), $lib_provinces_edit->prov_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_provinces_edit->psgc_prv->Required) { ?>
				elm = this.getElements("x" + infix + "_psgc_prv");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_provinces_edit->psgc_prv->caption(), $lib_provinces_edit->psgc_prv->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_provinces_edit->region_code->Required) { ?>
				elm = this.getElements("x" + infix + "_region_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_provinces_edit->region_code->caption(), $lib_provinces_edit->region_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_region_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lib_provinces_edit->region_code->errorMessage()) ?>");

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
	flib_provincesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flib_provincesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flib_provincesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lib_provinces_edit->showPageHeader(); ?>
<?php
$lib_provinces_edit->showMessage();
?>
<form name="flib_provincesedit" id="flib_provincesedit" class="<?php echo $lib_provinces_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_provinces">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$lib_provinces_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($lib_provinces_edit->prov_code->Visible) { // prov_code ?>
	<div id="r_prov_code" class="form-group row">
		<label id="elh_lib_provinces_prov_code" class="<?php echo $lib_provinces_edit->LeftColumnClass ?>"><?php echo $lib_provinces_edit->prov_code->caption() ?><?php echo $lib_provinces_edit->prov_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_provinces_edit->RightColumnClass ?>"><div <?php echo $lib_provinces_edit->prov_code->cellAttributes() ?>>
<span id="el_lib_provinces_prov_code">
<span<?php echo $lib_provinces_edit->prov_code->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($lib_provinces_edit->prov_code->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="lib_provinces" data-field="x_prov_code" name="x_prov_code" id="x_prov_code" value="<?php echo HtmlEncode($lib_provinces_edit->prov_code->CurrentValue) ?>">
<?php echo $lib_provinces_edit->prov_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_provinces_edit->prov_name->Visible) { // prov_name ?>
	<div id="r_prov_name" class="form-group row">
		<label id="elh_lib_provinces_prov_name" for="x_prov_name" class="<?php echo $lib_provinces_edit->LeftColumnClass ?>"><?php echo $lib_provinces_edit->prov_name->caption() ?><?php echo $lib_provinces_edit->prov_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_provinces_edit->RightColumnClass ?>"><div <?php echo $lib_provinces_edit->prov_name->cellAttributes() ?>>
<span id="el_lib_provinces_prov_name">
<input type="text" data-table="lib_provinces" data-field="x_prov_name" name="x_prov_name" id="x_prov_name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($lib_provinces_edit->prov_name->getPlaceHolder()) ?>" value="<?php echo $lib_provinces_edit->prov_name->EditValue ?>"<?php echo $lib_provinces_edit->prov_name->editAttributes() ?>>
</span>
<?php echo $lib_provinces_edit->prov_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_provinces_edit->psgc_prv->Visible) { // psgc_prv ?>
	<div id="r_psgc_prv" class="form-group row">
		<label id="elh_lib_provinces_psgc_prv" for="x_psgc_prv" class="<?php echo $lib_provinces_edit->LeftColumnClass ?>"><?php echo $lib_provinces_edit->psgc_prv->caption() ?><?php echo $lib_provinces_edit->psgc_prv->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_provinces_edit->RightColumnClass ?>"><div <?php echo $lib_provinces_edit->psgc_prv->cellAttributes() ?>>
<span id="el_lib_provinces_psgc_prv">
<input type="text" data-table="lib_provinces" data-field="x_psgc_prv" name="x_psgc_prv" id="x_psgc_prv" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($lib_provinces_edit->psgc_prv->getPlaceHolder()) ?>" value="<?php echo $lib_provinces_edit->psgc_prv->EditValue ?>"<?php echo $lib_provinces_edit->psgc_prv->editAttributes() ?>>
</span>
<?php echo $lib_provinces_edit->psgc_prv->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_provinces_edit->region_code->Visible) { // region_code ?>
	<div id="r_region_code" class="form-group row">
		<label id="elh_lib_provinces_region_code" for="x_region_code" class="<?php echo $lib_provinces_edit->LeftColumnClass ?>"><?php echo $lib_provinces_edit->region_code->caption() ?><?php echo $lib_provinces_edit->region_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_provinces_edit->RightColumnClass ?>"><div <?php echo $lib_provinces_edit->region_code->cellAttributes() ?>>
<span id="el_lib_provinces_region_code">
<input type="text" data-table="lib_provinces" data-field="x_region_code" name="x_region_code" id="x_region_code" size="30" placeholder="<?php echo HtmlEncode($lib_provinces_edit->region_code->getPlaceHolder()) ?>" value="<?php echo $lib_provinces_edit->region_code->EditValue ?>"<?php echo $lib_provinces_edit->region_code->editAttributes() ?>>
</span>
<?php echo $lib_provinces_edit->region_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$lib_provinces_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $lib_provinces_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lib_provinces_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$lib_provinces_edit->showPageFooter();
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
$lib_provinces_edit->terminate();
?>