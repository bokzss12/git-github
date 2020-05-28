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
$tbl_spec_edit = new tbl_spec_edit();

// Run the page
$tbl_spec_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_spec_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_specedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_specedit = currentForm = new ew.Form("ftbl_specedit", "edit");

	// Validate form
	ftbl_specedit.validate = function() {
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
			<?php if ($tbl_spec_edit->specID->Required) { ?>
				elm = this.getElements("x" + infix + "_specID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->specID->caption(), $tbl_spec_edit->specID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_edit->pr_number->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->pr_number->caption(), $tbl_spec_edit->pr_number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_edit->spec_unit->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_unit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->spec_unit->caption(), $tbl_spec_edit->spec_unit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_edit->spec_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->spec_dsc->caption(), $tbl_spec_edit->spec_dsc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_edit->spec_qty->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->spec_qty->caption(), $tbl_spec_edit->spec_qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_qty");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_edit->spec_qty->errorMessage()) ?>");
			<?php if ($tbl_spec_edit->spec_unitprice->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_unitprice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->spec_unitprice->caption(), $tbl_spec_edit->spec_unitprice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_unitprice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_edit->spec_unitprice->errorMessage()) ?>");
			<?php if ($tbl_spec_edit->spec_totalprice->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_totalprice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->spec_totalprice->caption(), $tbl_spec_edit->spec_totalprice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_totalprice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_edit->spec_totalprice->errorMessage()) ?>");
			<?php if ($tbl_spec_edit->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->user_last_modify->caption(), $tbl_spec_edit->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_edit->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_edit->date_last_modify->caption(), $tbl_spec_edit->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_specedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_specedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_specedit.lists["x_spec_unit"] = <?php echo $tbl_spec_edit->spec_unit->Lookup->toClientList($tbl_spec_edit) ?>;
	ftbl_specedit.lists["x_spec_unit"].options = <?php echo JsonEncode($tbl_spec_edit->spec_unit->lookupOptions()) ?>;
	loadjs.done("ftbl_specedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_spec_edit->showPageHeader(); ?>
<?php
$tbl_spec_edit->showMessage();
?>
<form name="ftbl_specedit" id="ftbl_specedit" class="<?php echo $tbl_spec_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_spec">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_spec_edit->IsModal ?>">
<?php if ($tbl_spec->getCurrentMasterTable() == "tbl_pr") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="tbl_pr">
<input type="hidden" name="fk_pr_number" value="<?php echo HtmlEncode($tbl_spec_edit->pr_number->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_spec_edit->specID->Visible) { // specID ?>
	<div id="r_specID" class="form-group row">
		<label id="elh_tbl_spec_specID" class="<?php echo $tbl_spec_edit->LeftColumnClass ?>"><?php echo $tbl_spec_edit->specID->caption() ?><?php echo $tbl_spec_edit->specID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_spec_edit->RightColumnClass ?>"><div <?php echo $tbl_spec_edit->specID->cellAttributes() ?>>
<span id="el_tbl_spec_specID">
<span<?php echo $tbl_spec_edit->specID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_edit->specID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_specID" name="x_specID" id="x_specID" value="<?php echo HtmlEncode($tbl_spec_edit->specID->CurrentValue) ?>">
<?php echo $tbl_spec_edit->specID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_edit->pr_number->Visible) { // pr_number ?>
	<div id="r_pr_number" class="form-group row">
		<label id="elh_tbl_spec_pr_number" for="x_pr_number" class="<?php echo $tbl_spec_edit->LeftColumnClass ?>"><?php echo $tbl_spec_edit->pr_number->caption() ?><?php echo $tbl_spec_edit->pr_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_spec_edit->RightColumnClass ?>"><div <?php echo $tbl_spec_edit->pr_number->cellAttributes() ?>>
<?php if ($tbl_spec_edit->pr_number->getSessionValue() != "") { ?>
<span id="el_tbl_spec_pr_number">
<span<?php echo $tbl_spec_edit->pr_number->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_edit->pr_number->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pr_number" name="x_pr_number" value="<?php echo HtmlEncode($tbl_spec_edit->pr_number->CurrentValue) ?>">
<?php } else { ?>
<span id="el_tbl_spec_pr_number">
<input type="text" data-table="tbl_spec" data-field="x_pr_number" name="x_pr_number" id="x_pr_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_spec_edit->pr_number->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_edit->pr_number->EditValue ?>"<?php echo $tbl_spec_edit->pr_number->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $tbl_spec_edit->pr_number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_edit->spec_unit->Visible) { // spec_unit ?>
	<div id="r_spec_unit" class="form-group row">
		<label id="elh_tbl_spec_spec_unit" for="x_spec_unit" class="<?php echo $tbl_spec_edit->LeftColumnClass ?>"><?php echo $tbl_spec_edit->spec_unit->caption() ?><?php echo $tbl_spec_edit->spec_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_spec_edit->RightColumnClass ?>"><div <?php echo $tbl_spec_edit->spec_unit->cellAttributes() ?>>
<span id="el_tbl_spec_spec_unit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_spec" data-field="x_spec_unit" data-value-separator="<?php echo $tbl_spec_edit->spec_unit->displayValueSeparatorAttribute() ?>" id="x_spec_unit" name="x_spec_unit"<?php echo $tbl_spec_edit->spec_unit->editAttributes() ?>>
			<?php echo $tbl_spec_edit->spec_unit->selectOptionListHtml("x_spec_unit") ?>
		</select>
</div>
<?php echo $tbl_spec_edit->spec_unit->Lookup->getParamTag($tbl_spec_edit, "p_x_spec_unit") ?>
</span>
<?php echo $tbl_spec_edit->spec_unit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_edit->spec_dsc->Visible) { // spec_dsc ?>
	<div id="r_spec_dsc" class="form-group row">
		<label id="elh_tbl_spec_spec_dsc" for="x_spec_dsc" class="<?php echo $tbl_spec_edit->LeftColumnClass ?>"><?php echo $tbl_spec_edit->spec_dsc->caption() ?><?php echo $tbl_spec_edit->spec_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_spec_edit->RightColumnClass ?>"><div <?php echo $tbl_spec_edit->spec_dsc->cellAttributes() ?>>
<span id="el_tbl_spec_spec_dsc">
<textarea data-table="tbl_spec" data-field="x_spec_dsc" name="x_spec_dsc" id="x_spec_dsc" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_spec_edit->spec_dsc->getPlaceHolder()) ?>"<?php echo $tbl_spec_edit->spec_dsc->editAttributes() ?>><?php echo $tbl_spec_edit->spec_dsc->EditValue ?></textarea>
</span>
<?php echo $tbl_spec_edit->spec_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_edit->spec_qty->Visible) { // spec_qty ?>
	<div id="r_spec_qty" class="form-group row">
		<label id="elh_tbl_spec_spec_qty" for="x_spec_qty" class="<?php echo $tbl_spec_edit->LeftColumnClass ?>"><?php echo $tbl_spec_edit->spec_qty->caption() ?><?php echo $tbl_spec_edit->spec_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_spec_edit->RightColumnClass ?>"><div <?php echo $tbl_spec_edit->spec_qty->cellAttributes() ?>>
<span id="el_tbl_spec_spec_qty">
<input type="text" data-table="tbl_spec" data-field="x_spec_qty" name="x_spec_qty" id="x_spec_qty" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_edit->spec_qty->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_edit->spec_qty->EditValue ?>"<?php echo $tbl_spec_edit->spec_qty->editAttributes() ?>>
</span>
<?php echo $tbl_spec_edit->spec_qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_edit->spec_unitprice->Visible) { // spec_unitprice ?>
	<div id="r_spec_unitprice" class="form-group row">
		<label id="elh_tbl_spec_spec_unitprice" for="x_spec_unitprice" class="<?php echo $tbl_spec_edit->LeftColumnClass ?>"><?php echo $tbl_spec_edit->spec_unitprice->caption() ?><?php echo $tbl_spec_edit->spec_unitprice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_spec_edit->RightColumnClass ?>"><div <?php echo $tbl_spec_edit->spec_unitprice->cellAttributes() ?>>
<span id="el_tbl_spec_spec_unitprice">
<input type="text" data-table="tbl_spec" data-field="x_spec_unitprice" name="x_spec_unitprice" id="x_spec_unitprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_edit->spec_unitprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_edit->spec_unitprice->EditValue ?>"<?php echo $tbl_spec_edit->spec_unitprice->editAttributes() ?>>
</span>
<?php echo $tbl_spec_edit->spec_unitprice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_edit->spec_totalprice->Visible) { // spec_totalprice ?>
	<div id="r_spec_totalprice" class="form-group row">
		<label id="elh_tbl_spec_spec_totalprice" for="x_spec_totalprice" class="<?php echo $tbl_spec_edit->LeftColumnClass ?>"><?php echo $tbl_spec_edit->spec_totalprice->caption() ?><?php echo $tbl_spec_edit->spec_totalprice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_spec_edit->RightColumnClass ?>"><div <?php echo $tbl_spec_edit->spec_totalprice->cellAttributes() ?>>
<span id="el_tbl_spec_spec_totalprice">
<input type="text" data-table="tbl_spec" data-field="x_spec_totalprice" name="x_spec_totalprice" id="x_spec_totalprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_edit->spec_totalprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_edit->spec_totalprice->EditValue ?>"<?php echo $tbl_spec_edit->spec_totalprice->editAttributes() ?>>
</span>
<?php echo $tbl_spec_edit->spec_totalprice->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_spec_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_spec_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_spec_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_spec_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#x_spec_unitprice").on("change keyup paste mouseup",function(){$("#x_spec_totalprice").val(+$("#x_spec_unitprice").val()*+$("#x_spec_qty").val())}),$("#x_spec_qty").on("change keyup paste mouseup",function(){$("#x_spec_totalprice").val(+$("#x_spec_unitprice").val()*+$("#x_spec_qty").val())});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_spec_edit->terminate();
?>