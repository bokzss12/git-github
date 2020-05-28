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
$tbl_pr_edit = new tbl_pr_edit();

// Run the page
$tbl_pr_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_predit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_predit = currentForm = new ew.Form("ftbl_predit", "edit");

	// Validate form
	ftbl_predit.validate = function() {
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
			<?php if ($tbl_pr_edit->date_prep->Required) { ?>
				elm = this.getElements("x" + infix + "_date_prep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->date_prep->caption(), $tbl_pr_edit->date_prep->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_prep");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_pr_edit->date_prep->errorMessage()) ?>");
			<?php if ($tbl_pr_edit->pr_number->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->pr_number->caption(), $tbl_pr_edit->pr_number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_edit->purpose->Required) { ?>
				elm = this.getElements("x" + infix + "_purpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->purpose->caption(), $tbl_pr_edit->purpose->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_edit->pr_status->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->pr_status->caption(), $tbl_pr_edit->pr_status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_edit->sup_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sup_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->sup_id->caption(), $tbl_pr_edit->sup_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_edit->date_delivered->Required) { ?>
				elm = this.getElements("x" + infix + "_date_delivered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->date_delivered->caption(), $tbl_pr_edit->date_delivered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_delivered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_pr_edit->date_delivered->errorMessage()) ?>");
			<?php if ($tbl_pr_edit->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->employeeid->caption(), $tbl_pr_edit->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_edit->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->user_last_modify->caption(), $tbl_pr_edit->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_edit->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_edit->date_last_modify->caption(), $tbl_pr_edit->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_predit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_predit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_predit.lists["x_pr_status"] = <?php echo $tbl_pr_edit->pr_status->Lookup->toClientList($tbl_pr_edit) ?>;
	ftbl_predit.lists["x_pr_status"].options = <?php echo JsonEncode($tbl_pr_edit->pr_status->lookupOptions()) ?>;
	ftbl_predit.lists["x_sup_id"] = <?php echo $tbl_pr_edit->sup_id->Lookup->toClientList($tbl_pr_edit) ?>;
	ftbl_predit.lists["x_sup_id"].options = <?php echo JsonEncode($tbl_pr_edit->sup_id->lookupOptions()) ?>;
	ftbl_predit.lists["x_employeeid"] = <?php echo $tbl_pr_edit->employeeid->Lookup->toClientList($tbl_pr_edit) ?>;
	ftbl_predit.lists["x_employeeid"].options = <?php echo JsonEncode($tbl_pr_edit->employeeid->lookupOptions()) ?>;
	loadjs.done("ftbl_predit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_pr_edit->showPageHeader(); ?>
<?php
$tbl_pr_edit->showMessage();
?>
<form name="ftbl_predit" id="ftbl_predit" class="<?php echo $tbl_pr_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pr_edit->IsModal ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($tbl_pr_edit->date_prep->Visible) { // date_prep ?>
	<div id="r_date_prep" class="form-group row">
		<label id="elh_tbl_pr_date_prep" for="x_date_prep" class="<?php echo $tbl_pr_edit->LeftColumnClass ?>"><script id="tpc_tbl_pr_date_prep" type="text/html"><?php echo $tbl_pr_edit->date_prep->caption() ?><?php echo $tbl_pr_edit->date_prep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_pr_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_edit->date_prep->cellAttributes() ?>>
<script id="tpx_tbl_pr_date_prep" type="text/html"><span id="el_tbl_pr_date_prep">
<input type="text" data-table="tbl_pr" data-field="x_date_prep" name="x_date_prep" id="x_date_prep" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_pr_edit->date_prep->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_edit->date_prep->EditValue ?>"<?php echo $tbl_pr_edit->date_prep->editAttributes() ?>>
<?php if (!$tbl_pr_edit->date_prep->ReadOnly && !$tbl_pr_edit->date_prep->Disabled && !isset($tbl_pr_edit->date_prep->EditAttrs["readonly"]) && !isset($tbl_pr_edit->date_prep->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_predit_js">
loadjs.ready(["ftbl_predit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_predit", "x_date_prep", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_pr_edit->date_prep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_edit->pr_number->Visible) { // pr_number ?>
	<div id="r_pr_number" class="form-group row">
		<label id="elh_tbl_pr_pr_number" for="x_pr_number" class="<?php echo $tbl_pr_edit->LeftColumnClass ?>"><script id="tpc_tbl_pr_pr_number" type="text/html"><?php echo $tbl_pr_edit->pr_number->caption() ?><?php echo $tbl_pr_edit->pr_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_pr_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_edit->pr_number->cellAttributes() ?>>
<script id="tpx_tbl_pr_pr_number" type="text/html"><span id="el_tbl_pr_pr_number">
<input type="text" data-table="tbl_pr" data-field="x_pr_number" name="x_pr_number" id="x_pr_number" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_pr_edit->pr_number->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_edit->pr_number->EditValue ?>"<?php echo $tbl_pr_edit->pr_number->editAttributes() ?>>
</span></script>
<?php echo $tbl_pr_edit->pr_number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_edit->purpose->Visible) { // purpose ?>
	<div id="r_purpose" class="form-group row">
		<label id="elh_tbl_pr_purpose" for="x_purpose" class="<?php echo $tbl_pr_edit->LeftColumnClass ?>"><script id="tpc_tbl_pr_purpose" type="text/html"><?php echo $tbl_pr_edit->purpose->caption() ?><?php echo $tbl_pr_edit->purpose->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_pr_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_edit->purpose->cellAttributes() ?>>
<script id="tpx_tbl_pr_purpose" type="text/html"><span id="el_tbl_pr_purpose">
<textarea data-table="tbl_pr" data-field="x_purpose" name="x_purpose" id="x_purpose" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_pr_edit->purpose->getPlaceHolder()) ?>"<?php echo $tbl_pr_edit->purpose->editAttributes() ?>><?php echo $tbl_pr_edit->purpose->EditValue ?></textarea>
</span></script>
<?php echo $tbl_pr_edit->purpose->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_edit->pr_status->Visible) { // pr_status ?>
	<div id="r_pr_status" class="form-group row">
		<label id="elh_tbl_pr_pr_status" for="x_pr_status" class="<?php echo $tbl_pr_edit->LeftColumnClass ?>"><script id="tpc_tbl_pr_pr_status" type="text/html"><?php echo $tbl_pr_edit->pr_status->caption() ?><?php echo $tbl_pr_edit->pr_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_pr_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_edit->pr_status->cellAttributes() ?>>
<script id="tpx_tbl_pr_pr_status" type="text/html"><span id="el_tbl_pr_pr_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pr" data-field="x_pr_status" data-value-separator="<?php echo $tbl_pr_edit->pr_status->displayValueSeparatorAttribute() ?>" id="x_pr_status" name="x_pr_status"<?php echo $tbl_pr_edit->pr_status->editAttributes() ?>>
			<?php echo $tbl_pr_edit->pr_status->selectOptionListHtml("x_pr_status") ?>
		</select>
</div>
<?php echo $tbl_pr_edit->pr_status->Lookup->getParamTag($tbl_pr_edit, "p_x_pr_status") ?>
</span></script>
<?php echo $tbl_pr_edit->pr_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_edit->sup_id->Visible) { // sup_id ?>
	<div id="r_sup_id" class="form-group row">
		<label id="elh_tbl_pr_sup_id" for="x_sup_id" class="<?php echo $tbl_pr_edit->LeftColumnClass ?>"><script id="tpc_tbl_pr_sup_id" type="text/html"><?php echo $tbl_pr_edit->sup_id->caption() ?><?php echo $tbl_pr_edit->sup_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_pr_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_edit->sup_id->cellAttributes() ?>>
<script id="tpx_tbl_pr_sup_id" type="text/html"><span id="el_tbl_pr_sup_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pr" data-field="x_sup_id" data-value-separator="<?php echo $tbl_pr_edit->sup_id->displayValueSeparatorAttribute() ?>" id="x_sup_id" name="x_sup_id"<?php echo $tbl_pr_edit->sup_id->editAttributes() ?>>
			<?php echo $tbl_pr_edit->sup_id->selectOptionListHtml("x_sup_id") ?>
		</select>
</div>
<?php echo $tbl_pr_edit->sup_id->Lookup->getParamTag($tbl_pr_edit, "p_x_sup_id") ?>
</span></script>
<?php echo $tbl_pr_edit->sup_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_edit->date_delivered->Visible) { // date_delivered ?>
	<div id="r_date_delivered" class="form-group row">
		<label id="elh_tbl_pr_date_delivered" for="x_date_delivered" class="<?php echo $tbl_pr_edit->LeftColumnClass ?>"><script id="tpc_tbl_pr_date_delivered" type="text/html"><?php echo $tbl_pr_edit->date_delivered->caption() ?><?php echo $tbl_pr_edit->date_delivered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_pr_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_edit->date_delivered->cellAttributes() ?>>
<script id="tpx_tbl_pr_date_delivered" type="text/html"><span id="el_tbl_pr_date_delivered">
<input type="text" data-table="tbl_pr" data-field="x_date_delivered" name="x_date_delivered" id="x_date_delivered" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_pr_edit->date_delivered->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_edit->date_delivered->EditValue ?>"<?php echo $tbl_pr_edit->date_delivered->editAttributes() ?>>
<?php if (!$tbl_pr_edit->date_delivered->ReadOnly && !$tbl_pr_edit->date_delivered->Disabled && !isset($tbl_pr_edit->date_delivered->EditAttrs["readonly"]) && !isset($tbl_pr_edit->date_delivered->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_predit_js">
loadjs.ready(["ftbl_predit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_predit", "x_date_delivered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_pr_edit->date_delivered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_edit->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_tbl_pr_employeeid" for="x_employeeid" class="<?php echo $tbl_pr_edit->LeftColumnClass ?>"><script id="tpc_tbl_pr_employeeid" type="text/html"><?php echo $tbl_pr_edit->employeeid->caption() ?><?php echo $tbl_pr_edit->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_pr_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_edit->employeeid->cellAttributes() ?>>
<script id="tpx_tbl_pr_employeeid" type="text/html"><span id="el_tbl_pr_employeeid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pr" data-field="x_employeeid" data-value-separator="<?php echo $tbl_pr_edit->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $tbl_pr_edit->employeeid->editAttributes() ?>>
			<?php echo $tbl_pr_edit->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $tbl_pr_edit->employeeid->Lookup->getParamTag($tbl_pr_edit, "p_x_employeeid") ?>
</span></script>
<?php echo $tbl_pr_edit->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_pr" data-field="x_prID" name="x_prID" id="x_prID" value="<?php echo HtmlEncode($tbl_pr_edit->prID->CurrentValue) ?>">
<div id="tpd_tbl_predit" class="ew-custom-template"></div>
<script id="tpm_tbl_predit" type="text/html">
<div id="ct_tbl_pr_edit"><!--<table class="ew-table">-->
<table style="height: 188px; width: 942px;" border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 9px;">
<td style="width: 923px; height: 9px; text-align: left; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_pr_date_prep"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_pr_date_prep")/}}</td>
<td style="width: 770.367px; height: 9px; text-align: left; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_pr_pr_number"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_pr_pr_number")/}}</td>
<td style="width: 604.633px; height: 9px; text-align: left; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_pr_employeeid"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_pr_employeeid")/}}&nbsp;&nbsp;</td>
</tr>
<tr style="height: 1px;">
<td style="width: 923px; height: 16.8167px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_pr_pr_status"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_pr_pr_status")/}}</td>
<td style="width: 770.367px; height: 16.8167px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_pr_sup_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_pr_sup_id")/}}</td>
<td style="width: 604.633px; height: 1px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_pr_date_delivered"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_pr_date_delivered")/}}</td>
</tr>
<tr style="height: 15.8167px;">
<td style="width: 1693.37px; height: 15.8167px; text-align: left;" colspan="2" scope="row">{{include tmpl="#tpc_tbl_pr_purpose"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_pr_purpose")/}}</td>
<td style="width: 604.633px; height: 15.8167px; text-align: left;" scope="row">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php
	if (in_array("tbl_spec", explode(",", $tbl_pr->getCurrentDetailTable())) && $tbl_spec->DetailEdit) {
?>
<?php if ($tbl_pr->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("tbl_spec", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_specgrid.php" ?>
<?php } ?>
<?php if (!$tbl_pr_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_pr_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pr_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_pr->Rows) ?> };
	ew.applyTemplate("tpd_tbl_predit", "tpm_tbl_predit", "tbl_predit", "<?php echo $tbl_pr->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_predit_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_pr_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_sup_id").attr("disabled","disabled"),$("#x_date_delivered").attr("disabled","disabled"),$("#x_pr_status").change(function(){$("option:selected",this);"2"==this.value?($("#x_sup_id").removeAttr("disabled"),$("#x_sup_id").prop("required",!0),$("#x_date_delivered").removeAttr("disabled"),$("#x_date_delivered").prop("required",!0)):($("#x_sup_id").attr("disabled","disabled"),$("#x_sup_id")[0].selectedIndex=0,$("#x_sup_id").prop("required",!1),$("#x_date_delivered").attr("disabled","disabled"),$("#x_date_delivered")[0].selectedIndex=0,$("#x_date_delivered").prop("required",!1))})}),$(document).ready(function(){$("#x_date_prep").attr("disabled","disabled")});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_pr_edit->terminate();
?>