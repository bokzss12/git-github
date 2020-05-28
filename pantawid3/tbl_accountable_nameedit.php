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
$tbl_accountable_name_edit = new tbl_accountable_name_edit();

// Run the page
$tbl_accountable_name_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_accountable_name_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_accountable_nameedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_accountable_nameedit = currentForm = new ew.Form("ftbl_accountable_nameedit", "edit");

	// Validate form
	ftbl_accountable_nameedit.validate = function() {
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
			<?php if ($tbl_accountable_name_edit->last_name->Required) { ?>
				elm = this.getElements("x" + infix + "_last_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_accountable_name_edit->last_name->caption(), $tbl_accountable_name_edit->last_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_accountable_name_edit->first_name->Required) { ?>
				elm = this.getElements("x" + infix + "_first_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_accountable_name_edit->first_name->caption(), $tbl_accountable_name_edit->first_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_accountable_name_edit->mid_name->Required) { ?>
				elm = this.getElements("x" + infix + "_mid_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_accountable_name_edit->mid_name->caption(), $tbl_accountable_name_edit->mid_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_accountable_name_edit->ext_name->Required) { ?>
				elm = this.getElements("x" + infix + "_ext_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_accountable_name_edit->ext_name->caption(), $tbl_accountable_name_edit->ext_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_accountable_name_edit->full_name_tbl->Required) { ?>
				elm = this.getElements("x" + infix + "_full_name_tbl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_accountable_name_edit->full_name_tbl->caption(), $tbl_accountable_name_edit->full_name_tbl->RequiredErrorMessage)) ?>");
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
	ftbl_accountable_nameedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_accountable_nameedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_accountable_nameedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_accountable_name_edit->showPageHeader(); ?>
<?php
$tbl_accountable_name_edit->showMessage();
?>
<form name="ftbl_accountable_nameedit" id="ftbl_accountable_nameedit" class="<?php echo $tbl_accountable_name_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_accountable_name">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_accountable_name_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_accountable_name_edit->last_name->Visible) { // last_name ?>
	<div id="r_last_name" class="form-group row">
		<label id="elh_tbl_accountable_name_last_name" for="x_last_name" class="<?php echo $tbl_accountable_name_edit->LeftColumnClass ?>"><?php echo $tbl_accountable_name_edit->last_name->caption() ?><?php echo $tbl_accountable_name_edit->last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_accountable_name_edit->RightColumnClass ?>"><div <?php echo $tbl_accountable_name_edit->last_name->cellAttributes() ?>>
<span id="el_tbl_accountable_name_last_name">
<input type="text" data-table="tbl_accountable_name" data-field="x_last_name" name="x_last_name" id="x_last_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_accountable_name_edit->last_name->getPlaceHolder()) ?>" value="<?php echo $tbl_accountable_name_edit->last_name->EditValue ?>"<?php echo $tbl_accountable_name_edit->last_name->editAttributes() ?>>
</span>
<?php echo $tbl_accountable_name_edit->last_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_accountable_name_edit->first_name->Visible) { // first_name ?>
	<div id="r_first_name" class="form-group row">
		<label id="elh_tbl_accountable_name_first_name" for="x_first_name" class="<?php echo $tbl_accountable_name_edit->LeftColumnClass ?>"><?php echo $tbl_accountable_name_edit->first_name->caption() ?><?php echo $tbl_accountable_name_edit->first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_accountable_name_edit->RightColumnClass ?>"><div <?php echo $tbl_accountable_name_edit->first_name->cellAttributes() ?>>
<span id="el_tbl_accountable_name_first_name">
<input type="text" data-table="tbl_accountable_name" data-field="x_first_name" name="x_first_name" id="x_first_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_accountable_name_edit->first_name->getPlaceHolder()) ?>" value="<?php echo $tbl_accountable_name_edit->first_name->EditValue ?>"<?php echo $tbl_accountable_name_edit->first_name->editAttributes() ?>>
</span>
<?php echo $tbl_accountable_name_edit->first_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_accountable_name_edit->mid_name->Visible) { // mid_name ?>
	<div id="r_mid_name" class="form-group row">
		<label id="elh_tbl_accountable_name_mid_name" for="x_mid_name" class="<?php echo $tbl_accountable_name_edit->LeftColumnClass ?>"><?php echo $tbl_accountable_name_edit->mid_name->caption() ?><?php echo $tbl_accountable_name_edit->mid_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_accountable_name_edit->RightColumnClass ?>"><div <?php echo $tbl_accountable_name_edit->mid_name->cellAttributes() ?>>
<span id="el_tbl_accountable_name_mid_name">
<input type="text" data-table="tbl_accountable_name" data-field="x_mid_name" name="x_mid_name" id="x_mid_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_accountable_name_edit->mid_name->getPlaceHolder()) ?>" value="<?php echo $tbl_accountable_name_edit->mid_name->EditValue ?>"<?php echo $tbl_accountable_name_edit->mid_name->editAttributes() ?>>
</span>
<?php echo $tbl_accountable_name_edit->mid_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_accountable_name_edit->ext_name->Visible) { // ext_name ?>
	<div id="r_ext_name" class="form-group row">
		<label id="elh_tbl_accountable_name_ext_name" for="x_ext_name" class="<?php echo $tbl_accountable_name_edit->LeftColumnClass ?>"><?php echo $tbl_accountable_name_edit->ext_name->caption() ?><?php echo $tbl_accountable_name_edit->ext_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_accountable_name_edit->RightColumnClass ?>"><div <?php echo $tbl_accountable_name_edit->ext_name->cellAttributes() ?>>
<span id="el_tbl_accountable_name_ext_name">
<input type="text" data-table="tbl_accountable_name" data-field="x_ext_name" name="x_ext_name" id="x_ext_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_accountable_name_edit->ext_name->getPlaceHolder()) ?>" value="<?php echo $tbl_accountable_name_edit->ext_name->EditValue ?>"<?php echo $tbl_accountable_name_edit->ext_name->editAttributes() ?>>
</span>
<?php echo $tbl_accountable_name_edit->ext_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_accountable_name_edit->full_name_tbl->Visible) { // full_name_tbl ?>
	<div id="r_full_name_tbl" class="form-group row">
		<label id="elh_tbl_accountable_name_full_name_tbl" for="x_full_name_tbl" class="<?php echo $tbl_accountable_name_edit->LeftColumnClass ?>"><?php echo $tbl_accountable_name_edit->full_name_tbl->caption() ?><?php echo $tbl_accountable_name_edit->full_name_tbl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_accountable_name_edit->RightColumnClass ?>"><div <?php echo $tbl_accountable_name_edit->full_name_tbl->cellAttributes() ?>>
<span id="el_tbl_accountable_name_full_name_tbl">
<input type="text" data-table="tbl_accountable_name" data-field="x_full_name_tbl" name="x_full_name_tbl" id="x_full_name_tbl" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_accountable_name_edit->full_name_tbl->getPlaceHolder()) ?>" value="<?php echo $tbl_accountable_name_edit->full_name_tbl->EditValue ?>"<?php echo $tbl_accountable_name_edit->full_name_tbl->editAttributes() ?>>
</span>
<?php echo $tbl_accountable_name_edit->full_name_tbl->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_accountable_name" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($tbl_accountable_name_edit->id->CurrentValue) ?>">
<?php if (!$tbl_accountable_name_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_accountable_name_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_accountable_name_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_accountable_name_edit->showPageFooter();
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
$tbl_accountable_name_edit->terminate();
?>