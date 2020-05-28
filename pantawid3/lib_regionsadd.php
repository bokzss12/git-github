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
$lib_regions_add = new lib_regions_add();

// Run the page
$lib_regions_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lib_regions_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flib_regionsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flib_regionsadd = currentForm = new ew.Form("flib_regionsadd", "add");

	// Validate form
	flib_regionsadd.validate = function() {
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
			<?php if ($lib_regions_add->region_name->Required) { ?>
				elm = this.getElements("x" + infix + "_region_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_regions_add->region_name->caption(), $lib_regions_add->region_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_regions_add->region_nick->Required) { ?>
				elm = this.getElements("x" + infix + "_region_nick");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_regions_add->region_nick->caption(), $lib_regions_add->region_nick->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_regions_add->region_director->Required) { ?>
				elm = this.getElements("x" + infix + "_region_director");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_regions_add->region_director->caption(), $lib_regions_add->region_director->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lib_regions_add->psgc_rgn->Required) { ?>
				elm = this.getElements("x" + infix + "_psgc_rgn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lib_regions_add->psgc_rgn->caption(), $lib_regions_add->psgc_rgn->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	flib_regionsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flib_regionsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flib_regionsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lib_regions_add->showPageHeader(); ?>
<?php
$lib_regions_add->showMessage();
?>
<form name="flib_regionsadd" id="flib_regionsadd" class="<?php echo $lib_regions_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lib_regions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$lib_regions_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($lib_regions_add->region_name->Visible) { // region_name ?>
	<div id="r_region_name" class="form-group row">
		<label id="elh_lib_regions_region_name" for="x_region_name" class="<?php echo $lib_regions_add->LeftColumnClass ?>"><?php echo $lib_regions_add->region_name->caption() ?><?php echo $lib_regions_add->region_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_regions_add->RightColumnClass ?>"><div <?php echo $lib_regions_add->region_name->cellAttributes() ?>>
<span id="el_lib_regions_region_name">
<input type="text" data-table="lib_regions" data-field="x_region_name" name="x_region_name" id="x_region_name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($lib_regions_add->region_name->getPlaceHolder()) ?>" value="<?php echo $lib_regions_add->region_name->EditValue ?>"<?php echo $lib_regions_add->region_name->editAttributes() ?>>
</span>
<?php echo $lib_regions_add->region_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_regions_add->region_nick->Visible) { // region_nick ?>
	<div id="r_region_nick" class="form-group row">
		<label id="elh_lib_regions_region_nick" for="x_region_nick" class="<?php echo $lib_regions_add->LeftColumnClass ?>"><?php echo $lib_regions_add->region_nick->caption() ?><?php echo $lib_regions_add->region_nick->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_regions_add->RightColumnClass ?>"><div <?php echo $lib_regions_add->region_nick->cellAttributes() ?>>
<span id="el_lib_regions_region_nick">
<input type="text" data-table="lib_regions" data-field="x_region_nick" name="x_region_nick" id="x_region_nick" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($lib_regions_add->region_nick->getPlaceHolder()) ?>" value="<?php echo $lib_regions_add->region_nick->EditValue ?>"<?php echo $lib_regions_add->region_nick->editAttributes() ?>>
</span>
<?php echo $lib_regions_add->region_nick->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_regions_add->region_director->Visible) { // region_director ?>
	<div id="r_region_director" class="form-group row">
		<label id="elh_lib_regions_region_director" for="x_region_director" class="<?php echo $lib_regions_add->LeftColumnClass ?>"><?php echo $lib_regions_add->region_director->caption() ?><?php echo $lib_regions_add->region_director->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_regions_add->RightColumnClass ?>"><div <?php echo $lib_regions_add->region_director->cellAttributes() ?>>
<span id="el_lib_regions_region_director">
<input type="text" data-table="lib_regions" data-field="x_region_director" name="x_region_director" id="x_region_director" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($lib_regions_add->region_director->getPlaceHolder()) ?>" value="<?php echo $lib_regions_add->region_director->EditValue ?>"<?php echo $lib_regions_add->region_director->editAttributes() ?>>
</span>
<?php echo $lib_regions_add->region_director->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lib_regions_add->psgc_rgn->Visible) { // psgc_rgn ?>
	<div id="r_psgc_rgn" class="form-group row">
		<label id="elh_lib_regions_psgc_rgn" for="x_psgc_rgn" class="<?php echo $lib_regions_add->LeftColumnClass ?>"><?php echo $lib_regions_add->psgc_rgn->caption() ?><?php echo $lib_regions_add->psgc_rgn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lib_regions_add->RightColumnClass ?>"><div <?php echo $lib_regions_add->psgc_rgn->cellAttributes() ?>>
<span id="el_lib_regions_psgc_rgn">
<input type="text" data-table="lib_regions" data-field="x_psgc_rgn" name="x_psgc_rgn" id="x_psgc_rgn" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($lib_regions_add->psgc_rgn->getPlaceHolder()) ?>" value="<?php echo $lib_regions_add->psgc_rgn->EditValue ?>"<?php echo $lib_regions_add->psgc_rgn->editAttributes() ?>>
</span>
<?php echo $lib_regions_add->psgc_rgn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$lib_regions_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $lib_regions_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lib_regions_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$lib_regions_add->showPageFooter();
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
$lib_regions_add->terminate();
?>