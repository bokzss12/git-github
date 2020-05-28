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
$employee_edit = new employee_edit();

// Run the page
$employee_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femployeeedit = currentForm = new ew.Form("femployeeedit", "edit");

	// Validate form
	femployeeedit.validate = function() {
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
			<?php if ($employee_edit->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->employeeid->caption(), $employee_edit->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_edit->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->username->caption(), $employee_edit->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_edit->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->password->caption(), $employee_edit->password->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($employee_edit->userlevel_id->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevel_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->userlevel_id->caption(), $employee_edit->userlevel_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_edit->Name_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_Name_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->Name_dsc->caption(), $employee_edit->Name_dsc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_edit->position->Required) { ?>
				elm = this.getElements("x" + infix + "_position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->position->caption(), $employee_edit->position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->_email->caption(), $employee_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_edit->activation->Required) { ?>
				elm = this.getElements("x" + infix + "_activation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_edit->activation->caption(), $employee_edit->activation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_edit->photo->Required) { ?>
				felm = this.getElements("x" + infix + "_photo");
				elm = this.getElements("fn_x" + infix + "_photo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $employee_edit->photo->caption(), $employee_edit->photo->RequiredErrorMessage)) ?>");
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
	femployeeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployeeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployeeedit.lists["x_userlevel_id"] = <?php echo $employee_edit->userlevel_id->Lookup->toClientList($employee_edit) ?>;
	femployeeedit.lists["x_userlevel_id"].options = <?php echo JsonEncode($employee_edit->userlevel_id->lookupOptions()) ?>;
	femployeeedit.lists["x_activation"] = <?php echo $employee_edit->activation->Lookup->toClientList($employee_edit) ?>;
	femployeeedit.lists["x_activation"].options = <?php echo JsonEncode($employee_edit->activation->lookupOptions()) ?>;
	loadjs.done("femployeeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_edit->showPageHeader(); ?>
<?php
$employee_edit->showMessage();
?>
<form name="femployeeedit" id="femployeeedit" class="<?php echo $employee_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employee_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($employee_edit->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_employee_employeeid" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->employeeid->caption() ?><?php echo $employee_edit->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->employeeid->cellAttributes() ?>>
<span id="el_employee_employeeid">
<span<?php echo $employee_edit->employeeid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_edit->employeeid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee" data-field="x_employeeid" name="x_employeeid" id="x_employeeid" value="<?php echo HtmlEncode($employee_edit->employeeid->CurrentValue) ?>">
<?php echo $employee_edit->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_employee_username" for="x_username" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->username->caption() ?><?php echo $employee_edit->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->username->cellAttributes() ?>>
<span id="el_employee_username">
<input type="text" data-table="employee" data-field="x_username" name="x_username" id="x_username" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($employee_edit->username->getPlaceHolder()) ?>" value="<?php echo $employee_edit->username->EditValue ?>"<?php echo $employee_edit->username->editAttributes() ?>>
</span>
<?php echo $employee_edit->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_employee_password" for="x_password" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->password->caption() ?><?php echo $employee_edit->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->password->cellAttributes() ?>>
<span id="el_employee_password">
<div class="input-group" id="ig_password">
<input type="text" data-password-strength="pst_password" data-table="employee" data-field="x_password" name="x_password" id="x_password" value="<?php echo $employee_edit->password->EditValue ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employee_edit->password->getPlaceHolder()) ?>"<?php echo $employee_edit->password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-strength="pst_password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $employee_edit->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->userlevel_id->Visible) { // userlevel_id ?>
	<div id="r_userlevel_id" class="form-group row">
		<label id="elh_employee_userlevel_id" for="x_userlevel_id" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->userlevel_id->caption() ?><?php echo $employee_edit->userlevel_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->userlevel_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_employee_userlevel_id">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_edit->userlevel_id->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_employee_userlevel_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employee" data-field="x_userlevel_id" data-value-separator="<?php echo $employee_edit->userlevel_id->displayValueSeparatorAttribute() ?>" id="x_userlevel_id" name="x_userlevel_id"<?php echo $employee_edit->userlevel_id->editAttributes() ?>>
			<?php echo $employee_edit->userlevel_id->selectOptionListHtml("x_userlevel_id") ?>
		</select>
</div>
<?php echo $employee_edit->userlevel_id->Lookup->getParamTag($employee_edit, "p_x_userlevel_id") ?>
</span>
<?php } ?>
<?php echo $employee_edit->userlevel_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->Name_dsc->Visible) { // Name_dsc ?>
	<div id="r_Name_dsc" class="form-group row">
		<label id="elh_employee_Name_dsc" for="x_Name_dsc" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->Name_dsc->caption() ?><?php echo $employee_edit->Name_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->Name_dsc->cellAttributes() ?>>
<span id="el_employee_Name_dsc">
<input type="text" data-table="employee" data-field="x_Name_dsc" name="x_Name_dsc" id="x_Name_dsc" size="20" maxlength="20" placeholder="<?php echo HtmlEncode($employee_edit->Name_dsc->getPlaceHolder()) ?>" value="<?php echo $employee_edit->Name_dsc->EditValue ?>"<?php echo $employee_edit->Name_dsc->editAttributes() ?>>
</span>
<?php echo $employee_edit->Name_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->position->Visible) { // position ?>
	<div id="r_position" class="form-group row">
		<label id="elh_employee_position" for="x_position" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->position->caption() ?><?php echo $employee_edit->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->position->cellAttributes() ?>>
<span id="el_employee_position">
<input type="text" data-table="employee" data-field="x_position" name="x_position" id="x_position" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employee_edit->position->getPlaceHolder()) ?>" value="<?php echo $employee_edit->position->EditValue ?>"<?php echo $employee_edit->position->editAttributes() ?>>
</span>
<?php echo $employee_edit->position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_employee__email" for="x__email" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->_email->caption() ?><?php echo $employee_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->_email->cellAttributes() ?>>
<span id="el_employee__email">
<input type="text" data-table="employee" data-field="x__email" name="x__email" id="x__email" size="20" maxlength="20" placeholder="<?php echo HtmlEncode($employee_edit->_email->getPlaceHolder()) ?>" value="<?php echo $employee_edit->_email->EditValue ?>"<?php echo $employee_edit->_email->editAttributes() ?>>
</span>
<?php echo $employee_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->activation->Visible) { // activation ?>
	<div id="r_activation" class="form-group row">
		<label id="elh_employee_activation" for="x_activation" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->activation->caption() ?><?php echo $employee_edit->activation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->activation->cellAttributes() ?>>
<span id="el_employee_activation">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employee" data-field="x_activation" data-value-separator="<?php echo $employee_edit->activation->displayValueSeparatorAttribute() ?>" id="x_activation" name="x_activation"<?php echo $employee_edit->activation->editAttributes() ?>>
			<?php echo $employee_edit->activation->selectOptionListHtml("x_activation") ?>
		</select>
</div>
<?php echo $employee_edit->activation->Lookup->getParamTag($employee_edit, "p_x_activation") ?>
</span>
<?php echo $employee_edit->activation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_edit->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label id="elh_employee_photo" class="<?php echo $employee_edit->LeftColumnClass ?>"><?php echo $employee_edit->photo->caption() ?><?php echo $employee_edit->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_edit->RightColumnClass ?>"><div <?php echo $employee_edit->photo->cellAttributes() ?>>
<span id="el_employee_photo">
<div id="fd_x_photo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $employee_edit->photo->title() ?>" data-table="employee" data-field="x_photo" name="x_photo" id="x_photo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $employee_edit->photo->editAttributes() ?><?php if ($employee_edit->photo->ReadOnly || $employee_edit->photo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_photo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?php echo $employee_edit->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="<?php echo (Post("fa_x_photo") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_photo" id= "fs_x_photo" value="255">
<input type="hidden" name="fx_x_photo" id= "fx_x_photo" value="<?php echo $employee_edit->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo" id= "fm_x_photo" value="<?php echo $employee_edit->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $employee_edit->photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employee_edit->showPageFooter();
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
$employee_edit->terminate();
?>