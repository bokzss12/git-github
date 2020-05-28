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
$employee_add = new employee_add();

// Run the page
$employee_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femployeeadd = currentForm = new ew.Form("femployeeadd", "add");

	// Validate form
	femployeeadd.validate = function() {
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
			<?php if ($employee_add->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_add->username->caption(), $employee_add->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_add->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_add->password->caption(), $employee_add->password->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($employee_add->userlevel_id->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevel_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_add->userlevel_id->caption(), $employee_add->userlevel_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_add->Name_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_Name_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_add->Name_dsc->caption(), $employee_add->Name_dsc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_add->position->Required) { ?>
				elm = this.getElements("x" + infix + "_position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_add->position->caption(), $employee_add->position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_add->_email->caption(), $employee_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_add->activation->Required) { ?>
				elm = this.getElements("x" + infix + "_activation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_add->activation->caption(), $employee_add->activation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_add->photo->Required) { ?>
				felm = this.getElements("x" + infix + "_photo");
				elm = this.getElements("fn_x" + infix + "_photo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $employee_add->photo->caption(), $employee_add->photo->RequiredErrorMessage)) ?>");
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
	femployeeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployeeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployeeadd.lists["x_userlevel_id"] = <?php echo $employee_add->userlevel_id->Lookup->toClientList($employee_add) ?>;
	femployeeadd.lists["x_userlevel_id"].options = <?php echo JsonEncode($employee_add->userlevel_id->lookupOptions()) ?>;
	femployeeadd.lists["x_activation"] = <?php echo $employee_add->activation->Lookup->toClientList($employee_add) ?>;
	femployeeadd.lists["x_activation"].options = <?php echo JsonEncode($employee_add->activation->lookupOptions()) ?>;
	loadjs.done("femployeeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_add->showPageHeader(); ?>
<?php
$employee_add->showMessage();
?>
<form name="femployeeadd" id="femployeeadd" class="<?php echo $employee_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employee_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($employee_add->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_employee_username" for="x_username" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->username->caption() ?><?php echo $employee_add->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->username->cellAttributes() ?>>
<span id="el_employee_username">
<input type="text" data-table="employee" data-field="x_username" name="x_username" id="x_username" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($employee_add->username->getPlaceHolder()) ?>" value="<?php echo $employee_add->username->EditValue ?>"<?php echo $employee_add->username->editAttributes() ?>>
</span>
<?php echo $employee_add->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_add->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_employee_password" for="x_password" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->password->caption() ?><?php echo $employee_add->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->password->cellAttributes() ?>>
<span id="el_employee_password">
<div class="input-group" id="ig_password">
<input type="text" data-password-strength="pst_password" data-table="employee" data-field="x_password" name="x_password" id="x_password" value="<?php echo $employee_add->password->EditValue ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employee_add->password->getPlaceHolder()) ?>"<?php echo $employee_add->password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-strength="pst_password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $employee_add->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_add->userlevel_id->Visible) { // userlevel_id ?>
	<div id="r_userlevel_id" class="form-group row">
		<label id="elh_employee_userlevel_id" for="x_userlevel_id" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->userlevel_id->caption() ?><?php echo $employee_add->userlevel_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->userlevel_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_employee_userlevel_id">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_add->userlevel_id->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_employee_userlevel_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employee" data-field="x_userlevel_id" data-value-separator="<?php echo $employee_add->userlevel_id->displayValueSeparatorAttribute() ?>" id="x_userlevel_id" name="x_userlevel_id"<?php echo $employee_add->userlevel_id->editAttributes() ?>>
			<?php echo $employee_add->userlevel_id->selectOptionListHtml("x_userlevel_id") ?>
		</select>
</div>
<?php echo $employee_add->userlevel_id->Lookup->getParamTag($employee_add, "p_x_userlevel_id") ?>
</span>
<?php } ?>
<?php echo $employee_add->userlevel_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_add->Name_dsc->Visible) { // Name_dsc ?>
	<div id="r_Name_dsc" class="form-group row">
		<label id="elh_employee_Name_dsc" for="x_Name_dsc" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->Name_dsc->caption() ?><?php echo $employee_add->Name_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->Name_dsc->cellAttributes() ?>>
<span id="el_employee_Name_dsc">
<input type="text" data-table="employee" data-field="x_Name_dsc" name="x_Name_dsc" id="x_Name_dsc" size="20" maxlength="20" placeholder="<?php echo HtmlEncode($employee_add->Name_dsc->getPlaceHolder()) ?>" value="<?php echo $employee_add->Name_dsc->EditValue ?>"<?php echo $employee_add->Name_dsc->editAttributes() ?>>
</span>
<?php echo $employee_add->Name_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_add->position->Visible) { // position ?>
	<div id="r_position" class="form-group row">
		<label id="elh_employee_position" for="x_position" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->position->caption() ?><?php echo $employee_add->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->position->cellAttributes() ?>>
<span id="el_employee_position">
<input type="text" data-table="employee" data-field="x_position" name="x_position" id="x_position" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employee_add->position->getPlaceHolder()) ?>" value="<?php echo $employee_add->position->EditValue ?>"<?php echo $employee_add->position->editAttributes() ?>>
</span>
<?php echo $employee_add->position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_employee__email" for="x__email" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->_email->caption() ?><?php echo $employee_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->_email->cellAttributes() ?>>
<span id="el_employee__email">
<input type="text" data-table="employee" data-field="x__email" name="x__email" id="x__email" size="20" maxlength="20" placeholder="<?php echo HtmlEncode($employee_add->_email->getPlaceHolder()) ?>" value="<?php echo $employee_add->_email->EditValue ?>"<?php echo $employee_add->_email->editAttributes() ?>>
</span>
<?php echo $employee_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_add->activation->Visible) { // activation ?>
	<div id="r_activation" class="form-group row">
		<label id="elh_employee_activation" for="x_activation" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->activation->caption() ?><?php echo $employee_add->activation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->activation->cellAttributes() ?>>
<span id="el_employee_activation">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employee" data-field="x_activation" data-value-separator="<?php echo $employee_add->activation->displayValueSeparatorAttribute() ?>" id="x_activation" name="x_activation"<?php echo $employee_add->activation->editAttributes() ?>>
			<?php echo $employee_add->activation->selectOptionListHtml("x_activation") ?>
		</select>
</div>
<?php echo $employee_add->activation->Lookup->getParamTag($employee_add, "p_x_activation") ?>
</span>
<?php echo $employee_add->activation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_add->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label id="elh_employee_photo" class="<?php echo $employee_add->LeftColumnClass ?>"><?php echo $employee_add->photo->caption() ?><?php echo $employee_add->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_add->RightColumnClass ?>"><div <?php echo $employee_add->photo->cellAttributes() ?>>
<span id="el_employee_photo">
<div id="fd_x_photo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $employee_add->photo->title() ?>" data-table="employee" data-field="x_photo" name="x_photo" id="x_photo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $employee_add->photo->editAttributes() ?><?php if ($employee_add->photo->ReadOnly || $employee_add->photo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_photo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?php echo $employee_add->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="0">
<input type="hidden" name="fs_x_photo" id= "fs_x_photo" value="255">
<input type="hidden" name="fx_x_photo" id= "fx_x_photo" value="<?php echo $employee_add->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo" id= "fm_x_photo" value="<?php echo $employee_add->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $employee_add->photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employee_add->showPageFooter();
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
$employee_add->terminate();
?>