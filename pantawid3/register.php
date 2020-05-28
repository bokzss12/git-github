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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fregister, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "register";
	fregister = currentForm = new ew.Form("fregister", "register");

	// Validate form
	fregister.validate = function() {
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
			<?php if ($register->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->employeeid->caption(), $register->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, ew.language.phrase("EnterUserName"));
			<?php } ?>
			<?php if ($register->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, ew.language.phrase("EnterPassword"));
			<?php } ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
				if (fobj.c_password.value != fobj.x_password.value)
					return this.onError(fobj.c_password, ew.language.phrase("MismatchPassword"));
			<?php if ($register->userlevel_id->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevel_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->userlevel_id->caption(), $register->userlevel_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->Name_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_Name_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->Name_dsc->caption(), $register->Name_dsc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->position->Required) { ?>
				elm = this.getElements("x" + infix + "_position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->position->caption(), $register->position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $register->_email->caption(), $register->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($register->photo->Required) { ?>
				felm = this.getElements("x" + infix + "_photo");
				elm = this.getElements("fn_x" + infix + "_photo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $register->photo->caption(), $register->photo->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fregister.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fregister.lists["x_userlevel_id"] = <?php echo $register->userlevel_id->Lookup->toClientList($register) ?>;
	fregister.lists["x_userlevel_id"].options = <?php echo JsonEncode($register->userlevel_id->lookupOptions()) ?>;
	loadjs.done("fregister");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$register->IsModal ?>">
<input type="hidden" name="t" value="employee">
<?php if ($employee->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<div class="ew-register-div d-none"><!-- page* -->
<?php if ($register->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_employee_username" for="x_username" class="<?php echo $register->LeftColumnClass ?>"><script id="tpc_employee_username" type="text/html"><?php echo $register->username->caption() ?><?php echo $register->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->username->cellAttributes() ?>>
<?php if (!$employee->isConfirm()) { ?>
<script id="tpx_employee_username" type="text/html"><span id="el_employee_username">
<input type="text" data-table="employee" data-field="x_username" name="x_username" id="x_username" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($register->username->getPlaceHolder()) ?>" value="<?php echo $register->username->EditValue ?>"<?php echo $register->username->editAttributes() ?>>
</span></script>
<?php } else { ?>
<script id="tpx_employee_username" type="text/html"><span id="el_employee_username">
<span<?php echo $register->username->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->username->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="employee" data-field="x_username" name="x_username" id="x_username" value="<?php echo HtmlEncode($register->username->FormValue) ?>">
<?php } ?>
<?php echo $register->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_employee_password" for="x_password" class="<?php echo $register->LeftColumnClass ?>"><script id="tpc_employee_password" type="text/html"><?php echo $register->password->caption() ?><?php echo $register->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->password->cellAttributes() ?>>
<?php if (!$employee->isConfirm()) { ?>
<script id="tpx_employee_password" type="text/html"><span id="el_employee_password">
<div class="input-group" id="ig_password">
<input type="text" data-password-strength="pst_password" data-table="employee" data-field="x_password" name="x_password" id="x_password" value="<?php echo $register->password->EditValue ?>" size="20" maxlength="20" placeholder="<?php echo HtmlEncode($register->password->getPlaceHolder()) ?>"<?php echo $register->password->editAttributes() ?>>

</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span></script>
<?php } else { ?>
<script id="tpx_employee_password" type="text/html"><span id="el_employee_password">
<span<?php echo $register->password->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->password->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="employee" data-field="x_password" name="x_password" id="x_password" value="<?php echo HtmlEncode($register->password->FormValue) ?>">
<?php } ?>
<?php echo $register->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->password->Visible) { // password ?>
	<div id="r_c_password" class="form-group row">
		<label id="elh_c_employee_password" for="c_password" class="<?php echo $register->LeftColumnClass ?>"><script id="tpc_employee_c_password" type="text/html"><?php echo $Language->phrase("Confirm") ?> <?php echo $register->password->caption() ?><?php echo $register->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->password->cellAttributes() ?>>
<?php if (!$employee->isConfirm()) { ?>
<script id="tpx_employee_c_password" type="text/html"><span id="el_employee_password">
<span id="el_c_employee_password">
<input type="text" data-table="employee" data-field="x_password" name="c_password" id="c_password" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($register->password->getPlaceHolder()) ?>" value="<?php echo $register->password->EditValue ?>"<?php echo $register->password->editAttributes() ?>>
</span>
</script>
<?php } else { ?>
<span id="el_c_employee_password">
<script id="tpx_employee_c_password" type="text/html"><span id="el_employee_password">
<span<?php echo $register->password->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->password->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee" data-field="x_password" name="c_password" id="c_password" value="<?php echo HtmlEncode($register->password->FormValue) ?>">
</script>
<?php } ?>
</div></div>
	</div>
<?php } ?>
<?php if ($register->Name_dsc->Visible) { // Name_dsc ?>
	<div id="r_Name_dsc" class="form-group row">
		<label id="elh_employee_Name_dsc" for="x_Name_dsc" class="<?php echo $register->LeftColumnClass ?>"><script id="tpc_employee_Name_dsc" type="text/html"><?php echo $register->Name_dsc->caption() ?><?php echo $register->Name_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->Name_dsc->cellAttributes() ?>>
<?php if (!$employee->isConfirm()) { ?>
<script id="tpx_employee_Name_dsc" type="text/html"><span id="el_employee_Name_dsc">
<input type="text" data-table="employee" data-field="x_Name_dsc" name="x_Name_dsc" id="x_Name_dsc" size="20" maxlength="20" placeholder="<?php echo HtmlEncode($register->Name_dsc->getPlaceHolder()) ?>" value="<?php echo $register->Name_dsc->EditValue ?>"<?php echo $register->Name_dsc->editAttributes() ?>>
</span></script>
<?php } else { ?>
<script id="tpx_employee_Name_dsc" type="text/html"><span id="el_employee_Name_dsc">
<span<?php echo $register->Name_dsc->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->Name_dsc->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="employee" data-field="x_Name_dsc" name="x_Name_dsc" id="x_Name_dsc" value="<?php echo HtmlEncode($register->Name_dsc->FormValue) ?>">
<?php } ?>
<?php echo $register->Name_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->position->Visible) { // position ?>
	<div id="r_position" class="form-group row">
		<label id="elh_employee_position" for="x_position" class="<?php echo $register->LeftColumnClass ?>"><script id="tpc_employee_position" type="text/html"><?php echo $register->position->caption() ?><?php echo $register->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->position->cellAttributes() ?>>
<?php if (!$employee->isConfirm()) { ?>
<script id="tpx_employee_position" type="text/html"><span id="el_employee_position">
<input type="text" data-table="employee" data-field="x_position" name="x_position" id="x_position" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($register->position->getPlaceHolder()) ?>" value="<?php echo $register->position->EditValue ?>"<?php echo $register->position->editAttributes() ?>>
</span></script>
<?php } else { ?>
<script id="tpx_employee_position" type="text/html"><span id="el_employee_position">
<span<?php echo $register->position->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->position->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="employee" data-field="x_position" name="x_position" id="x_position" value="<?php echo HtmlEncode($register->position->FormValue) ?>">
<?php } ?>
<?php echo $register->position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_employee__email" for="x__email" class="<?php echo $register->LeftColumnClass ?>"><script id="tpc_employee__email" type="text/html"><?php echo $register->_email->caption() ?><?php echo $register->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->_email->cellAttributes() ?>>
<?php if (!$employee->isConfirm()) { ?>
<script id="tpx_employee__email" type="text/html"><span id="el_employee__email">
<input type="text" data-table="employee" data-field="x__email" name="x__email" id="x__email" size="20" maxlength="20" placeholder="<?php echo HtmlEncode($register->_email->getPlaceHolder()) ?>" value="<?php echo $register->_email->EditValue ?>"<?php echo $register->_email->editAttributes() ?>>
</span></script>
<?php } else { ?>
<script id="tpx_employee__email" type="text/html"><span id="el_employee__email">
<span<?php echo $register->_email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($register->_email->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="employee" data-field="x__email" name="x__email" id="x__email" value="<?php echo HtmlEncode($register->_email->FormValue) ?>">
<?php } ?>
<?php echo $register->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($register->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label id="elh_employee_photo" class="<?php echo $register->LeftColumnClass ?>"><script id="tpc_employee_photo" type="text/html"><?php echo $register->photo->caption() ?><?php echo $register->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div <?php echo $register->photo->cellAttributes() ?>>
<script id="tpx_employee_photo" type="text/html"><span id="el_employee_photo">
<div id="fd_x_photo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $register->photo->title() ?>" data-table="employee" data-field="x_photo" name="x_photo" id="x_photo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $register->photo->editAttributes() ?><?php if ($register->photo->ReadOnly || $register->photo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_photo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?php echo $register->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="0">
<input type="hidden" name="fs_x_photo" id= "fs_x_photo" value="255">
<input type="hidden" name="fx_x_photo" id= "fx_x_photo" value="<?php echo $register->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo" id= "fm_x_photo" value="<?php echo $register->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span></script>
<?php echo $register->photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_employeeregister" class="ew-custom-template"></div>
<script id="tpm_employeeregister" type="text/html">
<div id="ct_register"><!--<table class="ew-table">-->
<table style="height: 152px; width: 1460px;" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px;" scope="row">&nbsp;</td>
<td style="width: 310.75px; height: 40px;" scope="row">{{include tmpl="#tpc_employee_username"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_employee_username")/}}</td>
<td style="width: 310.75px; height: 40px;" scope="row">{{include tmpl="#tpc_employee_Name_dsc"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_employee_Name_dsc")/}}</td>
<td style="width: 284.25px; height: 40px;" scope="row">&nbsp;</td>
</tr>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px;" scope="row">&nbsp;</td>
<td style="width: 310.75px; height: 40px;" scope="row">{{include tmpl="#tpc_employee_password"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_employee_password")/}}</td>
<td style="width: 310.75px; height: 40px;" scope="row">{{include tmpl="#tpc_employee_position"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_employee_position")/}}</td>
<td style="width: 284.25px; height: 40px;" scope="row">&nbsp;</td>
</tr>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px;" scope="row">&nbsp;</td>
<td style="width: 310.75px; height: 40px;" scope="row">&nbsp;{{include tmpl="#tpc_employee_c_password"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_employee_c_password")/}}</td>
<td style="width: 310.75px; height: 40px;" scope="row">{{include tmpl="#tpc_employee__email"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_employee__email")/}}<br /><br /></td>
<td style="width: 284.25px; height: 40px;" scope="row">&nbsp;</td>
</tr>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px;" scope="row">&nbsp;</td>
<td style="width: 310.75px; height: 40px;" scope="row">{{include tmpl="#tpc_employee_photo"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_employee_photo")/}}</td>
<td style="width: 310.75px; height: 40px;" scope="row">&nbsp;</td>
<td style="width: 284.25px; height: 40px;" scope="row">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$register->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$employee->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($employee->Rows) ?> };
	ew.applyTemplate("tpd_employeeregister", "tpm_employeeregister", "employeeregister", "<?php echo $employee->CustomExport ?>", ew.templateData.rows[0]);
	$("script.employeeregister_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$register->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("body").addClass("sidebar-collapse");
});
</script>
<?php include_once "footer.php"; ?>
<?php
$register->terminate();
?>