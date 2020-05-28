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
$tbl_activate_add = new tbl_activate_add();

// Run the page
$tbl_activate_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_activate_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_activateadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_activateadd = currentForm = new ew.Form("ftbl_activateadd", "add");

	// Validate form
	ftbl_activateadd.validate = function() {
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
			<?php if ($tbl_activate_add->activate_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_activate_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_activate_add->activate_dsc->caption(), $tbl_activate_add->activate_dsc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_activate_add->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_activate_add->Value->caption(), $tbl_activate_add->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_activate_add->Value->errorMessage()) ?>");

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
	ftbl_activateadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_activateadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_activateadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_activate_add->showPageHeader(); ?>
<?php
$tbl_activate_add->showMessage();
?>
<form name="ftbl_activateadd" id="ftbl_activateadd" class="<?php echo $tbl_activate_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_activate">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_activate_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_activate_add->activate_dsc->Visible) { // activate_dsc ?>
	<div id="r_activate_dsc" class="form-group row">
		<label id="elh_tbl_activate_activate_dsc" for="x_activate_dsc" class="<?php echo $tbl_activate_add->LeftColumnClass ?>"><?php echo $tbl_activate_add->activate_dsc->caption() ?><?php echo $tbl_activate_add->activate_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_activate_add->RightColumnClass ?>"><div <?php echo $tbl_activate_add->activate_dsc->cellAttributes() ?>>
<span id="el_tbl_activate_activate_dsc">
<input type="text" data-table="tbl_activate" data-field="x_activate_dsc" name="x_activate_dsc" id="x_activate_dsc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_activate_add->activate_dsc->getPlaceHolder()) ?>" value="<?php echo $tbl_activate_add->activate_dsc->EditValue ?>"<?php echo $tbl_activate_add->activate_dsc->editAttributes() ?>>
</span>
<?php echo $tbl_activate_add->activate_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_activate_add->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_tbl_activate_Value" for="x_Value" class="<?php echo $tbl_activate_add->LeftColumnClass ?>"><?php echo $tbl_activate_add->Value->caption() ?><?php echo $tbl_activate_add->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_activate_add->RightColumnClass ?>"><div <?php echo $tbl_activate_add->Value->cellAttributes() ?>>
<span id="el_tbl_activate_Value">
<input type="text" data-table="tbl_activate" data-field="x_Value" name="x_Value" id="x_Value" size="30" placeholder="<?php echo HtmlEncode($tbl_activate_add->Value->getPlaceHolder()) ?>" value="<?php echo $tbl_activate_add->Value->EditValue ?>"<?php echo $tbl_activate_add->Value->editAttributes() ?>>
</span>
<?php echo $tbl_activate_add->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_activate_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_activate_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_activate_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_activate_add->showPageFooter();
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
$tbl_activate_add->terminate();
?>