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
$tbl_encoder_add = new tbl_encoder_add();

// Run the page
$tbl_encoder_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_encoderadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_encoderadd = currentForm = new ew.Form("ftbl_encoderadd", "add");

	// Validate form
	ftbl_encoderadd.validate = function() {
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
			<?php if ($tbl_encoder_add->date->Required) { ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->date->caption(), $tbl_encoder_add->date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_encoder_add->date->errorMessage()) ?>");
			<?php if ($tbl_encoder_add->activities->Required) { ?>
				elm = this.getElements("x" + infix + "_activities");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->activities->caption(), $tbl_encoder_add->activities->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_encoder_add->action_taken->Required) { ?>
				elm = this.getElements("x" + infix + "_action_taken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->action_taken->caption(), $tbl_encoder_add->action_taken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_encoder_add->total_encoded->Required) { ?>
				elm = this.getElements("x" + infix + "_total_encoded");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->total_encoded->caption(), $tbl_encoder_add->total_encoded->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_encoded");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_encoder_add->total_encoded->errorMessage()) ?>");
			<?php if ($tbl_encoder_add->status_remark->Required) { ?>
				elm = this.getElements("x" + infix + "_status_remark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->status_remark->caption(), $tbl_encoder_add->status_remark->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_encoder_add->employee_id->Required) { ?>
				elm = this.getElements("x" + infix + "_employee_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->employee_id->caption(), $tbl_encoder_add->employee_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_encoder_add->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->user_last_modify->caption(), $tbl_encoder_add->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_encoder_add->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_add->date_last_modify->caption(), $tbl_encoder_add->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_encoderadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_encoderadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_encoderadd.lists["x_activities"] = <?php echo $tbl_encoder_add->activities->Lookup->toClientList($tbl_encoder_add) ?>;
	ftbl_encoderadd.lists["x_activities"].options = <?php echo JsonEncode($tbl_encoder_add->activities->lookupOptions()) ?>;
	ftbl_encoderadd.lists["x_status_remark"] = <?php echo $tbl_encoder_add->status_remark->Lookup->toClientList($tbl_encoder_add) ?>;
	ftbl_encoderadd.lists["x_status_remark"].options = <?php echo JsonEncode($tbl_encoder_add->status_remark->lookupOptions()) ?>;
	ftbl_encoderadd.lists["x_employee_id"] = <?php echo $tbl_encoder_add->employee_id->Lookup->toClientList($tbl_encoder_add) ?>;
	ftbl_encoderadd.lists["x_employee_id"].options = <?php echo JsonEncode($tbl_encoder_add->employee_id->lookupOptions()) ?>;
	ftbl_encoderadd.lists["x_user_last_modify"] = <?php echo $tbl_encoder_add->user_last_modify->Lookup->toClientList($tbl_encoder_add) ?>;
	ftbl_encoderadd.lists["x_user_last_modify"].options = <?php echo JsonEncode($tbl_encoder_add->user_last_modify->lookupOptions()) ?>;
	loadjs.done("ftbl_encoderadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_encoder_add->showPageHeader(); ?>
<?php
$tbl_encoder_add->showMessage();
?>
<form name="ftbl_encoderadd" id="ftbl_encoderadd" class="<?php echo $tbl_encoder_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_encoder_add->IsModal ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($tbl_encoder_add->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label id="elh_tbl_encoder_date" for="x_date" class="<?php echo $tbl_encoder_add->LeftColumnClass ?>"><script id="tpc_tbl_encoder_date" type="text/html"><?php echo $tbl_encoder_add->date->caption() ?><?php echo $tbl_encoder_add->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_encoder_add->RightColumnClass ?>"><div <?php echo $tbl_encoder_add->date->cellAttributes() ?>>
<script id="tpx_tbl_encoder_date" type="text/html"><span id="el_tbl_encoder_date">
<input type="text" data-table="tbl_encoder" data-field="x_date" data-format="5" name="x_date" id="x_date" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_encoder_add->date->getPlaceHolder()) ?>" value="<?php echo $tbl_encoder_add->date->EditValue ?>"<?php echo $tbl_encoder_add->date->editAttributes() ?>>
<?php if (!$tbl_encoder_add->date->ReadOnly && !$tbl_encoder_add->date->Disabled && !isset($tbl_encoder_add->date->EditAttrs["readonly"]) && !isset($tbl_encoder_add->date->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_encoderadd_js">
loadjs.ready(["ftbl_encoderadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_encoderadd", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php echo $tbl_encoder_add->date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_encoder_add->activities->Visible) { // activities ?>
	<div id="r_activities" class="form-group row">
		<label id="elh_tbl_encoder_activities" for="x_activities" class="<?php echo $tbl_encoder_add->LeftColumnClass ?>"><script id="tpc_tbl_encoder_activities" type="text/html"><?php echo $tbl_encoder_add->activities->caption() ?><?php echo $tbl_encoder_add->activities->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_encoder_add->RightColumnClass ?>"><div <?php echo $tbl_encoder_add->activities->cellAttributes() ?>>
<script id="tpx_tbl_encoder_activities" type="text/html"><span id="el_tbl_encoder_activities">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_encoder" data-field="x_activities" data-value-separator="<?php echo $tbl_encoder_add->activities->displayValueSeparatorAttribute() ?>" id="x_activities" name="x_activities"<?php echo $tbl_encoder_add->activities->editAttributes() ?>>
			<?php echo $tbl_encoder_add->activities->selectOptionListHtml("x_activities") ?>
		</select>
</div>
<?php echo $tbl_encoder_add->activities->Lookup->getParamTag($tbl_encoder_add, "p_x_activities") ?>
</span></script>
<?php echo $tbl_encoder_add->activities->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_encoder_add->action_taken->Visible) { // action_taken ?>
	<div id="r_action_taken" class="form-group row">
		<label id="elh_tbl_encoder_action_taken" for="x_action_taken" class="<?php echo $tbl_encoder_add->LeftColumnClass ?>"><script id="tpc_tbl_encoder_action_taken" type="text/html"><?php echo $tbl_encoder_add->action_taken->caption() ?><?php echo $tbl_encoder_add->action_taken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_encoder_add->RightColumnClass ?>"><div <?php echo $tbl_encoder_add->action_taken->cellAttributes() ?>>
<script id="tpx_tbl_encoder_action_taken" type="text/html"><span id="el_tbl_encoder_action_taken">
<textarea data-table="tbl_encoder" data-field="x_action_taken" name="x_action_taken" id="x_action_taken" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_encoder_add->action_taken->getPlaceHolder()) ?>"<?php echo $tbl_encoder_add->action_taken->editAttributes() ?>><?php echo $tbl_encoder_add->action_taken->EditValue ?></textarea>
</span></script>
<?php echo $tbl_encoder_add->action_taken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_encoder_add->total_encoded->Visible) { // total_encoded ?>
	<div id="r_total_encoded" class="form-group row">
		<label id="elh_tbl_encoder_total_encoded" for="x_total_encoded" class="<?php echo $tbl_encoder_add->LeftColumnClass ?>"><script id="tpc_tbl_encoder_total_encoded" type="text/html"><?php echo $tbl_encoder_add->total_encoded->caption() ?><?php echo $tbl_encoder_add->total_encoded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_encoder_add->RightColumnClass ?>"><div <?php echo $tbl_encoder_add->total_encoded->cellAttributes() ?>>
<script id="tpx_tbl_encoder_total_encoded" type="text/html"><span id="el_tbl_encoder_total_encoded">
<input type="text" data-table="tbl_encoder" data-field="x_total_encoded" name="x_total_encoded" id="x_total_encoded" size="30" maxlength="7" placeholder="<?php echo HtmlEncode($tbl_encoder_add->total_encoded->getPlaceHolder()) ?>" value="<?php echo $tbl_encoder_add->total_encoded->EditValue ?>"<?php echo $tbl_encoder_add->total_encoded->editAttributes() ?>>
</span></script>
<?php echo $tbl_encoder_add->total_encoded->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_encoder_add->status_remark->Visible) { // status_remark ?>
	<div id="r_status_remark" class="form-group row">
		<label id="elh_tbl_encoder_status_remark" for="x_status_remark" class="<?php echo $tbl_encoder_add->LeftColumnClass ?>"><script id="tpc_tbl_encoder_status_remark" type="text/html"><?php echo $tbl_encoder_add->status_remark->caption() ?><?php echo $tbl_encoder_add->status_remark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_encoder_add->RightColumnClass ?>"><div <?php echo $tbl_encoder_add->status_remark->cellAttributes() ?>>
<script id="tpx_tbl_encoder_status_remark" type="text/html"><span id="el_tbl_encoder_status_remark">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_encoder" data-field="x_status_remark" data-value-separator="<?php echo $tbl_encoder_add->status_remark->displayValueSeparatorAttribute() ?>" id="x_status_remark" name="x_status_remark"<?php echo $tbl_encoder_add->status_remark->editAttributes() ?>>
			<?php echo $tbl_encoder_add->status_remark->selectOptionListHtml("x_status_remark") ?>
		</select>
</div>
<?php echo $tbl_encoder_add->status_remark->Lookup->getParamTag($tbl_encoder_add, "p_x_status_remark") ?>
</span></script>
<?php echo $tbl_encoder_add->status_remark->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_encoder_add->employee_id->Visible) { // employee_id ?>
	<div id="r_employee_id" class="form-group row">
		<label id="elh_tbl_encoder_employee_id" for="x_employee_id" class="<?php echo $tbl_encoder_add->LeftColumnClass ?>"><script id="tpc_tbl_encoder_employee_id" type="text/html"><?php echo $tbl_encoder_add->employee_id->caption() ?><?php echo $tbl_encoder_add->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_encoder_add->RightColumnClass ?>"><div <?php echo $tbl_encoder_add->employee_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$tbl_encoder->userIDAllow("add")) { // Non system admin ?>
<script id="tpx_tbl_encoder_employee_id" type="text/html"><span id="el_tbl_encoder_employee_id">
<span<?php echo $tbl_encoder_add->employee_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_encoder_add->employee_id->EditValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="tbl_encoder" data-field="x_employee_id" name="x_employee_id" id="x_employee_id" value="<?php echo HtmlEncode($tbl_encoder_add->employee_id->CurrentValue) ?>">
<?php } else { ?>
<script id="tpx_tbl_encoder_employee_id" type="text/html"><span id="el_tbl_encoder_employee_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_encoder" data-field="x_employee_id" data-value-separator="<?php echo $tbl_encoder_add->employee_id->displayValueSeparatorAttribute() ?>" id="x_employee_id" name="x_employee_id"<?php echo $tbl_encoder_add->employee_id->editAttributes() ?>>
			<?php echo $tbl_encoder_add->employee_id->selectOptionListHtml("x_employee_id") ?>
		</select>
</div>
<?php echo $tbl_encoder_add->employee_id->Lookup->getParamTag($tbl_encoder_add, "p_x_employee_id") ?>
</span></script>
<?php } ?>
<?php echo $tbl_encoder_add->employee_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_tbl_encoderadd" class="ew-custom-template"></div>
<script id="tpm_tbl_encoderadd" type="text/html">
<div id="ct_tbl_encoder_add"><!--<table class="ew-table">-->
<table style="height: 174px; width: 889.983px;" border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 33px;">
<td style="width: 560px; height: 33px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_encoder_date"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_encoder_date")/}}</td>
<td style="width: 283.983px; height: 33px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_encoder_employee_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_encoder_employee_id")/}}</td>
</tr>
<tr style="height: 40px;">
<td style="width: 560px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_encoder_activities"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_encoder_activities")/}}</td>
<td style="width: 283.983px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_encoder_status_remark"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_encoder_status_remark")/}}&nbsp;</td>
</tr>
<tr style="height: 39px;">
<td style="width: 560px; height: 33px; text-align: left;" rowspan="2" scope="row">{{include tmpl="#tpc_tbl_encoder_action_taken"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_encoder_action_taken")/}}</td>
<td style="width: 283.983px; height: 39px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_encoder_total_encoded"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_encoder_total_encoded")/}}</td>
</tr>
<tr style="height: 5px;">
<td style="width: 283.983px; height: 5px; text-align: left;" scope="row">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$tbl_encoder_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_encoder_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_encoder_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_encoder->Rows) ?> };
	ew.applyTemplate("tpd_tbl_encoderadd", "tpm_tbl_encoderadd", "tbl_encoderadd", "<?php echo $tbl_encoder->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_encoderadd_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_encoder_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_total_encoded").attr("disabled","disabled"),$("#x_activities").change(function(){$("option:selected",this);"1"==this.value?($("#x_total_encoded").removeAttr("disabled"),$("#x_total_encoded").prop("required",!0)):"2"==this.value?($("#x_total_encoded").removeAttr("disabled"),$("#x_total_encoded").prop("required",!0)):"3"==this.value?($("#x_total_encoded").removeAttr("disabled"),$("#x_total_encoded").prop("required",!0)):($("#x_total_encoded").attr("disabled","disabled"),$("#x_total_encoded").prop("required",!1))})});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_encoder_add->terminate();
?>