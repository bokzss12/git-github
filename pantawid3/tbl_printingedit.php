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
$tbl_printing_edit = new tbl_printing_edit();

// Run the page
$tbl_printing_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_printing_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_printingedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_printingedit = currentForm = new ew.Form("ftbl_printingedit", "edit");

	// Validate form
	ftbl_printingedit.validate = function() {
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
			<?php if ($tbl_printing_edit->printingID->Required) { ?>
				elm = this.getElements("x" + infix + "_printingID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->printingID->caption(), $tbl_printing_edit->printingID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_printing_edit->printing_date->Required) { ?>
				elm = this.getElements("x" + infix + "_printing_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->printing_date->caption(), $tbl_printing_edit->printing_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_printing_date");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_printing_edit->printing_date->errorMessage()) ?>");
			<?php if ($tbl_printing_edit->printing_type->Required) { ?>
				elm = this.getElements("x" + infix + "_printing_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->printing_type->caption(), $tbl_printing_edit->printing_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_printing_edit->printed_forms->Required) { ?>
				elm = this.getElements("x" + infix + "_printed_forms");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->printed_forms->caption(), $tbl_printing_edit->printed_forms->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_printing_edit->total_forms->Required) { ?>
				elm = this.getElements("x" + infix + "_total_forms");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->total_forms->caption(), $tbl_printing_edit->total_forms->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_forms");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_printing_edit->total_forms->errorMessage()) ?>");
			<?php if ($tbl_printing_edit->status_printing->Required) { ?>
				elm = this.getElements("x" + infix + "_status_printing");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->status_printing->caption(), $tbl_printing_edit->status_printing->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_printing_edit->employee_id->Required) { ?>
				elm = this.getElements("x" + infix + "_employee_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->employee_id->caption(), $tbl_printing_edit->employee_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_printing_edit->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->user_last_modify->caption(), $tbl_printing_edit->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_printing_edit->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_printing_edit->date_last_modify->caption(), $tbl_printing_edit->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_printingedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_printingedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_printingedit.lists["x_printing_type"] = <?php echo $tbl_printing_edit->printing_type->Lookup->toClientList($tbl_printing_edit) ?>;
	ftbl_printingedit.lists["x_printing_type"].options = <?php echo JsonEncode($tbl_printing_edit->printing_type->lookupOptions()) ?>;
	ftbl_printingedit.lists["x_status_printing"] = <?php echo $tbl_printing_edit->status_printing->Lookup->toClientList($tbl_printing_edit) ?>;
	ftbl_printingedit.lists["x_status_printing"].options = <?php echo JsonEncode($tbl_printing_edit->status_printing->lookupOptions()) ?>;
	ftbl_printingedit.lists["x_employee_id"] = <?php echo $tbl_printing_edit->employee_id->Lookup->toClientList($tbl_printing_edit) ?>;
	ftbl_printingedit.lists["x_employee_id"].options = <?php echo JsonEncode($tbl_printing_edit->employee_id->lookupOptions()) ?>;
	ftbl_printingedit.lists["x_user_last_modify"] = <?php echo $tbl_printing_edit->user_last_modify->Lookup->toClientList($tbl_printing_edit) ?>;
	ftbl_printingedit.lists["x_user_last_modify"].options = <?php echo JsonEncode($tbl_printing_edit->user_last_modify->lookupOptions()) ?>;
	loadjs.done("ftbl_printingedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_printing_edit->showPageHeader(); ?>
<?php
$tbl_printing_edit->showMessage();
?>
<form name="ftbl_printingedit" id="ftbl_printingedit" class="<?php echo $tbl_printing_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_printing">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_printing_edit->IsModal ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($tbl_printing_edit->printingID->Visible) { // printingID ?>
	<div id="r_printingID" class="form-group row">
		<label id="elh_tbl_printing_printingID" class="<?php echo $tbl_printing_edit->LeftColumnClass ?>"><script id="tpc_tbl_printing_printingID" type="text/html"><?php echo $tbl_printing_edit->printingID->caption() ?><?php echo $tbl_printing_edit->printingID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_printing_edit->RightColumnClass ?>"><div <?php echo $tbl_printing_edit->printingID->cellAttributes() ?>>
<script id="tpx_tbl_printing_printingID" type="text/html"><span id="el_tbl_printing_printingID">
<span<?php echo $tbl_printing_edit->printingID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_printing_edit->printingID->EditValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="tbl_printing" data-field="x_printingID" name="x_printingID" id="x_printingID" value="<?php echo HtmlEncode($tbl_printing_edit->printingID->CurrentValue) ?>">
<?php echo $tbl_printing_edit->printingID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_printing_edit->printing_date->Visible) { // printing_date ?>
	<div id="r_printing_date" class="form-group row">
		<label id="elh_tbl_printing_printing_date" for="x_printing_date" class="<?php echo $tbl_printing_edit->LeftColumnClass ?>"><script id="tpc_tbl_printing_printing_date" type="text/html"><?php echo $tbl_printing_edit->printing_date->caption() ?><?php echo $tbl_printing_edit->printing_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_printing_edit->RightColumnClass ?>"><div <?php echo $tbl_printing_edit->printing_date->cellAttributes() ?>>
<script id="tpx_tbl_printing_printing_date" type="text/html"><span id="el_tbl_printing_printing_date">
<input type="text" data-table="tbl_printing" data-field="x_printing_date" data-format="5" name="x_printing_date" id="x_printing_date" placeholder="<?php echo HtmlEncode($tbl_printing_edit->printing_date->getPlaceHolder()) ?>" value="<?php echo $tbl_printing_edit->printing_date->EditValue ?>"<?php echo $tbl_printing_edit->printing_date->editAttributes() ?>>
<?php if (!$tbl_printing_edit->printing_date->ReadOnly && !$tbl_printing_edit->printing_date->Disabled && !isset($tbl_printing_edit->printing_date->EditAttrs["readonly"]) && !isset($tbl_printing_edit->printing_date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_printingedit_js">
loadjs.ready(["ftbl_printingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_printingedit", "x_printing_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php echo $tbl_printing_edit->printing_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_printing_edit->printing_type->Visible) { // printing_type ?>
	<div id="r_printing_type" class="form-group row">
		<label id="elh_tbl_printing_printing_type" for="x_printing_type" class="<?php echo $tbl_printing_edit->LeftColumnClass ?>"><script id="tpc_tbl_printing_printing_type" type="text/html"><?php echo $tbl_printing_edit->printing_type->caption() ?><?php echo $tbl_printing_edit->printing_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_printing_edit->RightColumnClass ?>"><div <?php echo $tbl_printing_edit->printing_type->cellAttributes() ?>>
<script id="tpx_tbl_printing_printing_type" type="text/html"><span id="el_tbl_printing_printing_type">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_printing" data-field="x_printing_type" data-value-separator="<?php echo $tbl_printing_edit->printing_type->displayValueSeparatorAttribute() ?>" id="x_printing_type" name="x_printing_type"<?php echo $tbl_printing_edit->printing_type->editAttributes() ?>>
			<?php echo $tbl_printing_edit->printing_type->selectOptionListHtml("x_printing_type") ?>
		</select>
</div>
<?php echo $tbl_printing_edit->printing_type->Lookup->getParamTag($tbl_printing_edit, "p_x_printing_type") ?>
</span></script>
<?php echo $tbl_printing_edit->printing_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_printing_edit->printed_forms->Visible) { // printed_forms ?>
	<div id="r_printed_forms" class="form-group row">
		<label id="elh_tbl_printing_printed_forms" for="x_printed_forms" class="<?php echo $tbl_printing_edit->LeftColumnClass ?>"><script id="tpc_tbl_printing_printed_forms" type="text/html"><?php echo $tbl_printing_edit->printed_forms->caption() ?><?php echo $tbl_printing_edit->printed_forms->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_printing_edit->RightColumnClass ?>"><div <?php echo $tbl_printing_edit->printed_forms->cellAttributes() ?>>
<script id="tpx_tbl_printing_printed_forms" type="text/html"><span id="el_tbl_printing_printed_forms">
<textarea data-table="tbl_printing" data-field="x_printed_forms" name="x_printed_forms" id="x_printed_forms" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_printing_edit->printed_forms->getPlaceHolder()) ?>"<?php echo $tbl_printing_edit->printed_forms->editAttributes() ?>><?php echo $tbl_printing_edit->printed_forms->EditValue ?></textarea>
</span></script>
<?php echo $tbl_printing_edit->printed_forms->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_printing_edit->total_forms->Visible) { // total_forms ?>
	<div id="r_total_forms" class="form-group row">
		<label id="elh_tbl_printing_total_forms" for="x_total_forms" class="<?php echo $tbl_printing_edit->LeftColumnClass ?>"><script id="tpc_tbl_printing_total_forms" type="text/html"><?php echo $tbl_printing_edit->total_forms->caption() ?><?php echo $tbl_printing_edit->total_forms->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_printing_edit->RightColumnClass ?>"><div <?php echo $tbl_printing_edit->total_forms->cellAttributes() ?>>
<script id="tpx_tbl_printing_total_forms" type="text/html"><span id="el_tbl_printing_total_forms">
<input type="text" data-table="tbl_printing" data-field="x_total_forms" name="x_total_forms" id="x_total_forms" size="30" maxlength="7" placeholder="<?php echo HtmlEncode($tbl_printing_edit->total_forms->getPlaceHolder()) ?>" value="<?php echo $tbl_printing_edit->total_forms->EditValue ?>"<?php echo $tbl_printing_edit->total_forms->editAttributes() ?>>
</span></script>
<?php echo $tbl_printing_edit->total_forms->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_printing_edit->status_printing->Visible) { // status_printing ?>
	<div id="r_status_printing" class="form-group row">
		<label id="elh_tbl_printing_status_printing" for="x_status_printing" class="<?php echo $tbl_printing_edit->LeftColumnClass ?>"><script id="tpc_tbl_printing_status_printing" type="text/html"><?php echo $tbl_printing_edit->status_printing->caption() ?><?php echo $tbl_printing_edit->status_printing->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_printing_edit->RightColumnClass ?>"><div <?php echo $tbl_printing_edit->status_printing->cellAttributes() ?>>
<script id="tpx_tbl_printing_status_printing" type="text/html"><span id="el_tbl_printing_status_printing">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_printing" data-field="x_status_printing" data-value-separator="<?php echo $tbl_printing_edit->status_printing->displayValueSeparatorAttribute() ?>" id="x_status_printing" name="x_status_printing"<?php echo $tbl_printing_edit->status_printing->editAttributes() ?>>
			<?php echo $tbl_printing_edit->status_printing->selectOptionListHtml("x_status_printing") ?>
		</select>
</div>
<?php echo $tbl_printing_edit->status_printing->Lookup->getParamTag($tbl_printing_edit, "p_x_status_printing") ?>
</span></script>
<?php echo $tbl_printing_edit->status_printing->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_printing_edit->employee_id->Visible) { // employee_id ?>
	<div id="r_employee_id" class="form-group row">
		<label id="elh_tbl_printing_employee_id" for="x_employee_id" class="<?php echo $tbl_printing_edit->LeftColumnClass ?>"><script id="tpc_tbl_printing_employee_id" type="text/html"><?php echo $tbl_printing_edit->employee_id->caption() ?><?php echo $tbl_printing_edit->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_printing_edit->RightColumnClass ?>"><div <?php echo $tbl_printing_edit->employee_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$tbl_printing->userIDAllow("edit")) { // Non system admin ?>
<script id="tpx_tbl_printing_employee_id" type="text/html"><span id="el_tbl_printing_employee_id">
<span<?php echo $tbl_printing_edit->employee_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_printing_edit->employee_id->EditValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="tbl_printing" data-field="x_employee_id" name="x_employee_id" id="x_employee_id" value="<?php echo HtmlEncode($tbl_printing_edit->employee_id->CurrentValue) ?>">
<?php } else { ?>
<script id="tpx_tbl_printing_employee_id" type="text/html"><span id="el_tbl_printing_employee_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_printing" data-field="x_employee_id" data-value-separator="<?php echo $tbl_printing_edit->employee_id->displayValueSeparatorAttribute() ?>" id="x_employee_id" name="x_employee_id"<?php echo $tbl_printing_edit->employee_id->editAttributes() ?>>
			<?php echo $tbl_printing_edit->employee_id->selectOptionListHtml("x_employee_id") ?>
		</select>
</div>
<?php echo $tbl_printing_edit->employee_id->Lookup->getParamTag($tbl_printing_edit, "p_x_employee_id") ?>
</span></script>
<?php } ?>
<?php echo $tbl_printing_edit->employee_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_tbl_printingedit" class="ew-custom-template"></div>
<script id="tpm_tbl_printingedit" type="text/html">
<div id="ct_tbl_printing_edit"><!--<table class="ew-table">-->
<table style="height: 199px; width: 898px; " border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 10px;">
<td style="width: 562.533px; height: 10px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_printing_printing_date"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_printing_printing_date")/}}</td>
<td style="width: 279.467px; height: 10px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_printing_employee_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_printing_employee_id")/}}</td>
</tr>
<tr style="height: 10px;">
<td style="width: 562.533px; height: 21px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_printing_printing_type"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_printing_printing_type")/}}</td>
<td style="width: 279.467px; height: 21px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_printing_status_printing"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_printing_status_printing")/}}&nbsp;</td>
</tr>
<tr style="height: 11px;">
<td style="width: 562.533px; height: 11px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_printing_printed_forms"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_printing_printed_forms")/}}</td>
<td style="width: 279.467px; height: 11px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_printing_total_forms"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_printing_total_forms")/}}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$tbl_printing_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_printing_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_printing_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_printing->Rows) ?> };
	ew.applyTemplate("tpd_tbl_printingedit", "tpm_tbl_printingedit", "tbl_printingedit", "<?php echo $tbl_printing->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_printingedit_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_printing_edit->showPageFooter();
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
$tbl_printing_edit->terminate();
?>