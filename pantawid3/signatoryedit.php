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
$signatory_edit = new signatory_edit();

// Run the page
$signatory_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$signatory_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsignatoryedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsignatoryedit = currentForm = new ew.Form("fsignatoryedit", "edit");

	// Validate form
	fsignatoryedit.validate = function() {
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
			<?php if ($signatory_edit->sidID->Required) { ?>
				elm = this.getElements("x" + infix + "_sidID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $signatory_edit->sidID->caption(), $signatory_edit->sidID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($signatory_edit->NameSig->Required) { ?>
				elm = this.getElements("x" + infix + "_NameSig");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $signatory_edit->NameSig->caption(), $signatory_edit->NameSig->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($signatory_edit->DesignationSig->Required) { ?>
				elm = this.getElements("x" + infix + "_DesignationSig");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $signatory_edit->DesignationSig->caption(), $signatory_edit->DesignationSig->RequiredErrorMessage)) ?>");
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
	fsignatoryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsignatoryedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsignatoryedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $signatory_edit->showPageHeader(); ?>
<?php
$signatory_edit->showMessage();
?>
<form name="fsignatoryedit" id="fsignatoryedit" class="<?php echo $signatory_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="signatory">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$signatory_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($signatory_edit->sidID->Visible) { // sidID ?>
	<div id="r_sidID" class="form-group row">
		<label id="elh_signatory_sidID" class="<?php echo $signatory_edit->LeftColumnClass ?>"><?php echo $signatory_edit->sidID->caption() ?><?php echo $signatory_edit->sidID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $signatory_edit->RightColumnClass ?>"><div <?php echo $signatory_edit->sidID->cellAttributes() ?>>
<span id="el_signatory_sidID">
<span<?php echo $signatory_edit->sidID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($signatory_edit->sidID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="signatory" data-field="x_sidID" name="x_sidID" id="x_sidID" value="<?php echo HtmlEncode($signatory_edit->sidID->CurrentValue) ?>">
<?php echo $signatory_edit->sidID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($signatory_edit->NameSig->Visible) { // NameSig ?>
	<div id="r_NameSig" class="form-group row">
		<label id="elh_signatory_NameSig" for="x_NameSig" class="<?php echo $signatory_edit->LeftColumnClass ?>"><?php echo $signatory_edit->NameSig->caption() ?><?php echo $signatory_edit->NameSig->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $signatory_edit->RightColumnClass ?>"><div <?php echo $signatory_edit->NameSig->cellAttributes() ?>>
<span id="el_signatory_NameSig">
<input type="text" data-table="signatory" data-field="x_NameSig" name="x_NameSig" id="x_NameSig" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($signatory_edit->NameSig->getPlaceHolder()) ?>" value="<?php echo $signatory_edit->NameSig->EditValue ?>"<?php echo $signatory_edit->NameSig->editAttributes() ?>>
</span>
<?php echo $signatory_edit->NameSig->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($signatory_edit->DesignationSig->Visible) { // DesignationSig ?>
	<div id="r_DesignationSig" class="form-group row">
		<label id="elh_signatory_DesignationSig" for="x_DesignationSig" class="<?php echo $signatory_edit->LeftColumnClass ?>"><?php echo $signatory_edit->DesignationSig->caption() ?><?php echo $signatory_edit->DesignationSig->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $signatory_edit->RightColumnClass ?>"><div <?php echo $signatory_edit->DesignationSig->cellAttributes() ?>>
<span id="el_signatory_DesignationSig">
<input type="text" data-table="signatory" data-field="x_DesignationSig" name="x_DesignationSig" id="x_DesignationSig" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($signatory_edit->DesignationSig->getPlaceHolder()) ?>" value="<?php echo $signatory_edit->DesignationSig->EditValue ?>"<?php echo $signatory_edit->DesignationSig->editAttributes() ?>>
</span>
<?php echo $signatory_edit->DesignationSig->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$signatory_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $signatory_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $signatory_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$signatory_edit->showPageFooter();
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
$signatory_edit->terminate();
?>