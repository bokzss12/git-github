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
$lib_cities_add = new lib_cities_add();

// Run the page
$lib_cities_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_cities_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flib_citiesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flib_citiesadd = currentForm = new ew.Form("flib_citiesadd", "add");

	// Validate form
	flib_citiesadd.validate = function() {
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
			<?php if ($lib_cities_add->city_name->Required) { ?>
				elm = this.getElements("x" + infix + "_city_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_cities_add->city_name->caption(), $lib_cities_add->city_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_cities_add->is_Urban->Required) { ?>
				elm = this.getElements("x" + infix + "_is_Urban");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_cities_add->is_Urban->caption(), $lib_cities_add->is_Urban->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_is_Urban");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lib_cities_add->is_Urban->errorMessage()) ?>");
			<?php if ($lib_cities_add->locked->Required) { ?>
				elm = this.getElements("x" + infix + "_locked");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_cities_add->locked->caption(), $lib_cities_add->locked->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_locked");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lib_cities_add->locked->errorMessage()) ?>");
			<?php if ($lib_cities_add->app_target_hh->Required) { ?>
				elm = this.getElements("x" + infix + "_app_target_hh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_cities_add->app_target_hh->caption(), $lib_cities_add->app_target_hh->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_app_target_hh");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lib_cities_add->app_target_hh->errorMessage()) ?>");
			<?php if ($lib_cities_add->_4p_areas->Required) { ?>
				elm = this.getElements("x" + infix + "__4p_areas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_cities_add->_4p_areas->caption(), $lib_cities_add->_4p_areas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__4p_areas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lib_cities_add->_4p_areas->errorMessage()) ?>");
			<?php if ($lib_cities_add->psgc_cty->Required) { ?>
				elm = this.getElements("x" + infix + "_psgc_cty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_cities_add->psgc_cty->caption(), $lib_cities_add->psgc_cty->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_cities_add->prov_code->Required) { ?>
				elm = this.getElements("x" + infix + "_prov_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_cities_add->prov_code->caption(), $lib_cities_add->prov_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prov_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lib_cities_add->prov_code->errorMessage()) ?>");

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
	flib_citiesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flib_citiesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flib_citiesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lib_cities_add->showPageHeader(); ?>
<?php
$lib_cities_add->showMessage();
?>
<form name="flib_citiesadd" id="flib_citiesadd" class="<?php echo $lib_cities_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_cities">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$lib_cities_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($lib_cities_add->city_name->Visible) { // city_name ?>
	<div id="r_city_name" class="form-group row">
		<label id="elh_lib_cities_city_name" for="x_city_name" class="<?php echo $lib_cities_add->LeftColumnClass ?>"><?php echo $lib_cities_add->city_name->caption() ?><?php echo $lib_cities_add->city_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_cities_add->RightColumnClass ?>"><div <?php echo $lib_cities_add->city_name->cellAttributes() ?>>
<span id="el_lib_cities_city_name">
<input type="text" data-table="lib_cities" data-field="x_city_name" name="x_city_name" id="x_city_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($lib_cities_add->city_name->getPlaceHolder()) ?>" value="<?php echo $lib_cities_add->city_name->EditValue ?>"<?php echo $lib_cities_add->city_name->editAttributes() ?>>
</span>
<?php echo $lib_cities_add->city_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_cities_add->is_Urban->Visible) { // is_Urban ?>
	<div id="r_is_Urban" class="form-group row">
		<label id="elh_lib_cities_is_Urban" for="x_is_Urban" class="<?php echo $lib_cities_add->LeftColumnClass ?>"><?php echo $lib_cities_add->is_Urban->caption() ?><?php echo $lib_cities_add->is_Urban->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_cities_add->RightColumnClass ?>"><div <?php echo $lib_cities_add->is_Urban->cellAttributes() ?>>
<span id="el_lib_cities_is_Urban">
<input type="text" data-table="lib_cities" data-field="x_is_Urban" name="x_is_Urban" id="x_is_Urban" size="30" placeholder="<?php echo HtmlEncode($lib_cities_add->is_Urban->getPlaceHolder()) ?>" value="<?php echo $lib_cities_add->is_Urban->EditValue ?>"<?php echo $lib_cities_add->is_Urban->editAttributes() ?>>
</span>
<?php echo $lib_cities_add->is_Urban->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_cities_add->locked->Visible) { // locked ?>
	<div id="r_locked" class="form-group row">
		<label id="elh_lib_cities_locked" for="x_locked" class="<?php echo $lib_cities_add->LeftColumnClass ?>"><?php echo $lib_cities_add->locked->caption() ?><?php echo $lib_cities_add->locked->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_cities_add->RightColumnClass ?>"><div <?php echo $lib_cities_add->locked->cellAttributes() ?>>
<span id="el_lib_cities_locked">
<input type="text" data-table="lib_cities" data-field="x_locked" name="x_locked" id="x_locked" size="30" placeholder="<?php echo HtmlEncode($lib_cities_add->locked->getPlaceHolder()) ?>" value="<?php echo $lib_cities_add->locked->EditValue ?>"<?php echo $lib_cities_add->locked->editAttributes() ?>>
</span>
<?php echo $lib_cities_add->locked->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_cities_add->app_target_hh->Visible) { // app_target_hh ?>
	<div id="r_app_target_hh" class="form-group row">
		<label id="elh_lib_cities_app_target_hh" for="x_app_target_hh" class="<?php echo $lib_cities_add->LeftColumnClass ?>"><?php echo $lib_cities_add->app_target_hh->caption() ?><?php echo $lib_cities_add->app_target_hh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_cities_add->RightColumnClass ?>"><div <?php echo $lib_cities_add->app_target_hh->cellAttributes() ?>>
<span id="el_lib_cities_app_target_hh">
<input type="text" data-table="lib_cities" data-field="x_app_target_hh" name="x_app_target_hh" id="x_app_target_hh" size="30" placeholder="<?php echo HtmlEncode($lib_cities_add->app_target_hh->getPlaceHolder()) ?>" value="<?php echo $lib_cities_add->app_target_hh->EditValue ?>"<?php echo $lib_cities_add->app_target_hh->editAttributes() ?>>
</span>
<?php echo $lib_cities_add->app_target_hh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_cities_add->_4p_areas->Visible) { // 4p_areas ?>
	<div id="r__4p_areas" class="form-group row">
		<label id="elh_lib_cities__4p_areas" for="x__4p_areas" class="<?php echo $lib_cities_add->LeftColumnClass ?>"><?php echo $lib_cities_add->_4p_areas->caption() ?><?php echo $lib_cities_add->_4p_areas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_cities_add->RightColumnClass ?>"><div <?php echo $lib_cities_add->_4p_areas->cellAttributes() ?>>
<span id="el_lib_cities__4p_areas">
<input type="text" data-table="lib_cities" data-field="x__4p_areas" name="x__4p_areas" id="x__4p_areas" size="30" placeholder="<?php echo HtmlEncode($lib_cities_add->_4p_areas->getPlaceHolder()) ?>" value="<?php echo $lib_cities_add->_4p_areas->EditValue ?>"<?php echo $lib_cities_add->_4p_areas->editAttributes() ?>>
</span>
<?php echo $lib_cities_add->_4p_areas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_cities_add->psgc_cty->Visible) { // psgc_cty ?>
	<div id="r_psgc_cty" class="form-group row">
		<label id="elh_lib_cities_psgc_cty" for="x_psgc_cty" class="<?php echo $lib_cities_add->LeftColumnClass ?>"><?php echo $lib_cities_add->psgc_cty->caption() ?><?php echo $lib_cities_add->psgc_cty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_cities_add->RightColumnClass ?>"><div <?php echo $lib_cities_add->psgc_cty->cellAttributes() ?>>
<span id="el_lib_cities_psgc_cty">
<input type="text" data-table="lib_cities" data-field="x_psgc_cty" name="x_psgc_cty" id="x_psgc_cty" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($lib_cities_add->psgc_cty->getPlaceHolder()) ?>" value="<?php echo $lib_cities_add->psgc_cty->EditValue ?>"<?php echo $lib_cities_add->psgc_cty->editAttributes() ?>>
</span>
<?php echo $lib_cities_add->psgc_cty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_cities_add->prov_code->Visible) { // prov_code ?>
	<div id="r_prov_code" class="form-group row">
		<label id="elh_lib_cities_prov_code" for="x_prov_code" class="<?php echo $lib_cities_add->LeftColumnClass ?>"><?php echo $lib_cities_add->prov_code->caption() ?><?php echo $lib_cities_add->prov_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_cities_add->RightColumnClass ?>"><div <?php echo $lib_cities_add->prov_code->cellAttributes() ?>>
<span id="el_lib_cities_prov_code">
<input type="text" data-table="lib_cities" data-field="x_prov_code" name="x_prov_code" id="x_prov_code" size="30" placeholder="<?php echo HtmlEncode($lib_cities_add->prov_code->getPlaceHolder()) ?>" value="<?php echo $lib_cities_add->prov_code->EditValue ?>"<?php echo $lib_cities_add->prov_code->editAttributes() ?>>
</span>
<?php echo $lib_cities_add->prov_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$lib_cities_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $lib_cities_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lib_cities_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$lib_cities_add->showPageFooter();
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
$lib_cities_add->terminate();
?>