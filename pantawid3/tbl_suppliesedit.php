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
$tbl_supplies_edit = new tbl_supplies_edit();

// Run the page
$tbl_supplies_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_suppliesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_suppliesedit = currentForm = new ew.Form("ftbl_suppliesedit", "edit");

	// Validate form
	ftbl_suppliesedit.validate = function() {
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
			<?php if ($tbl_supplies_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->id->caption(), $tbl_supplies_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->supplies_cat->Required) { ?>
				elm = this.getElements("x" + infix + "_supplies_cat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->supplies_cat->caption(), $tbl_supplies_edit->supplies_cat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->model->Required) { ?>
				elm = this.getElements("x" + infix + "_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->model->caption(), $tbl_supplies_edit->model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->serial->Required) { ?>
				elm = this.getElements("x" + infix + "_serial");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->serial->caption(), $tbl_supplies_edit->serial->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->status->caption(), $tbl_supplies_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->remark->Required) { ?>
				elm = this.getElements("x" + infix + "_remark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->remark->caption(), $tbl_supplies_edit->remark->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->date_received->Required) { ?>
				elm = this.getElements("x" + infix + "_date_received");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->date_received->caption(), $tbl_supplies_edit->date_received->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_received");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_supplies_edit->date_received->errorMessage()) ?>");
			<?php if ($tbl_supplies_edit->date_consumed->Required) { ?>
				elm = this.getElements("x" + infix + "_date_consumed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->date_consumed->caption(), $tbl_supplies_edit->date_consumed->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_consumed");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_supplies_edit->date_consumed->errorMessage()) ?>");
			<?php if ($tbl_supplies_edit->Supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->Supplier->caption(), $tbl_supplies_edit->Supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->employeeid->caption(), $tbl_supplies_edit->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->user_last_modify->caption(), $tbl_supplies_edit->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_edit->user_date_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_date_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_edit->user_date_modify->caption(), $tbl_supplies_edit->user_date_modify->RequiredErrorMessage)) ?>");
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
	ftbl_suppliesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_suppliesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_suppliesedit.lists["x_supplies_cat"] = <?php echo $tbl_supplies_edit->supplies_cat->Lookup->toClientList($tbl_supplies_edit) ?>;
	ftbl_suppliesedit.lists["x_supplies_cat"].options = <?php echo JsonEncode($tbl_supplies_edit->supplies_cat->lookupOptions()) ?>;
	ftbl_suppliesedit.lists["x_model"] = <?php echo $tbl_supplies_edit->model->Lookup->toClientList($tbl_supplies_edit) ?>;
	ftbl_suppliesedit.lists["x_model"].options = <?php echo JsonEncode($tbl_supplies_edit->model->lookupOptions()) ?>;
	ftbl_suppliesedit.lists["x_status"] = <?php echo $tbl_supplies_edit->status->Lookup->toClientList($tbl_supplies_edit) ?>;
	ftbl_suppliesedit.lists["x_status"].options = <?php echo JsonEncode($tbl_supplies_edit->status->lookupOptions()) ?>;
	ftbl_suppliesedit.lists["x_Supplier"] = <?php echo $tbl_supplies_edit->Supplier->Lookup->toClientList($tbl_supplies_edit) ?>;
	ftbl_suppliesedit.lists["x_Supplier"].options = <?php echo JsonEncode($tbl_supplies_edit->Supplier->lookupOptions()) ?>;
	ftbl_suppliesedit.lists["x_employeeid"] = <?php echo $tbl_supplies_edit->employeeid->Lookup->toClientList($tbl_supplies_edit) ?>;
	ftbl_suppliesedit.lists["x_employeeid"].options = <?php echo JsonEncode($tbl_supplies_edit->employeeid->lookupOptions()) ?>;
	loadjs.done("ftbl_suppliesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_supplies_edit->showPageHeader(); ?>
<?php
$tbl_supplies_edit->showMessage();
?>
<form name="ftbl_suppliesedit" id="ftbl_suppliesedit" class="<?php echo $tbl_supplies_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_supplies_edit->IsModal ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($tbl_supplies_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_tbl_supplies_id" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_id" type="text/html"><?php echo $tbl_supplies_edit->id->caption() ?><?php echo $tbl_supplies_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->id->cellAttributes() ?>>
<script id="tpx_tbl_supplies_id" type="text/html"><span id="el_tbl_supplies_id">
<span<?php echo $tbl_supplies_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_supplies_edit->id->EditValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="tbl_supplies" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($tbl_supplies_edit->id->CurrentValue) ?>">
<?php echo $tbl_supplies_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->supplies_cat->Visible) { // supplies_cat ?>
	<div id="r_supplies_cat" class="form-group row">
		<label id="elh_tbl_supplies_supplies_cat" for="x_supplies_cat" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_supplies_cat" type="text/html"><?php echo $tbl_supplies_edit->supplies_cat->caption() ?><?php echo $tbl_supplies_edit->supplies_cat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->supplies_cat->cellAttributes() ?>>
<script id="tpx_tbl_supplies_supplies_cat" type="text/html"><span id="el_tbl_supplies_supplies_cat">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_supplies_cat" data-value-separator="<?php echo $tbl_supplies_edit->supplies_cat->displayValueSeparatorAttribute() ?>" id="x_supplies_cat" name="x_supplies_cat"<?php echo $tbl_supplies_edit->supplies_cat->editAttributes() ?>>
			<?php echo $tbl_supplies_edit->supplies_cat->selectOptionListHtml("x_supplies_cat") ?>
		</select>
</div>
<?php echo $tbl_supplies_edit->supplies_cat->Lookup->getParamTag($tbl_supplies_edit, "p_x_supplies_cat") ?>
</span></script>
<?php echo $tbl_supplies_edit->supplies_cat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->model->Visible) { // model ?>
	<div id="r_model" class="form-group row">
		<label id="elh_tbl_supplies_model" for="x_model" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_model" type="text/html"><?php echo $tbl_supplies_edit->model->caption() ?><?php echo $tbl_supplies_edit->model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->model->cellAttributes() ?>>
<script id="tpx_tbl_supplies_model" type="text/html"><span id="el_tbl_supplies_model">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_model" data-value-separator="<?php echo $tbl_supplies_edit->model->displayValueSeparatorAttribute() ?>" id="x_model" name="x_model"<?php echo $tbl_supplies_edit->model->editAttributes() ?>>
			<?php echo $tbl_supplies_edit->model->selectOptionListHtml("x_model") ?>
		</select>
</div>
<?php echo $tbl_supplies_edit->model->Lookup->getParamTag($tbl_supplies_edit, "p_x_model") ?>
</span></script>
<?php echo $tbl_supplies_edit->model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->serial->Visible) { // serial ?>
	<div id="r_serial" class="form-group row">
		<label id="elh_tbl_supplies_serial" for="x_serial" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_serial" type="text/html"><?php echo $tbl_supplies_edit->serial->caption() ?><?php echo $tbl_supplies_edit->serial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->serial->cellAttributes() ?>>
<script id="tpx_tbl_supplies_serial" type="text/html"><span id="el_tbl_supplies_serial">
<input type="text" data-table="tbl_supplies" data-field="x_serial" name="x_serial" id="x_serial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_supplies_edit->serial->getPlaceHolder()) ?>" value="<?php echo $tbl_supplies_edit->serial->EditValue ?>"<?php echo $tbl_supplies_edit->serial->editAttributes() ?>>
</span></script>
<?php echo $tbl_supplies_edit->serial->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_tbl_supplies_status" for="x_status" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_status" type="text/html"><?php echo $tbl_supplies_edit->status->caption() ?><?php echo $tbl_supplies_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->status->cellAttributes() ?>>
<script id="tpx_tbl_supplies_status" type="text/html"><span id="el_tbl_supplies_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_status" data-value-separator="<?php echo $tbl_supplies_edit->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $tbl_supplies_edit->status->editAttributes() ?>>
			<?php echo $tbl_supplies_edit->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $tbl_supplies_edit->status->Lookup->getParamTag($tbl_supplies_edit, "p_x_status") ?>
</span></script>
<?php echo $tbl_supplies_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->remark->Visible) { // remark ?>
	<div id="r_remark" class="form-group row">
		<label id="elh_tbl_supplies_remark" for="x_remark" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_remark" type="text/html"><?php echo $tbl_supplies_edit->remark->caption() ?><?php echo $tbl_supplies_edit->remark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->remark->cellAttributes() ?>>
<script id="tpx_tbl_supplies_remark" type="text/html"><span id="el_tbl_supplies_remark">
<textarea data-table="tbl_supplies" data-field="x_remark" name="x_remark" id="x_remark" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_supplies_edit->remark->getPlaceHolder()) ?>"<?php echo $tbl_supplies_edit->remark->editAttributes() ?>><?php echo $tbl_supplies_edit->remark->EditValue ?></textarea>
</span></script>
<?php echo $tbl_supplies_edit->remark->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->date_received->Visible) { // date_received ?>
	<div id="r_date_received" class="form-group row">
		<label id="elh_tbl_supplies_date_received" for="x_date_received" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_date_received" type="text/html"><?php echo $tbl_supplies_edit->date_received->caption() ?><?php echo $tbl_supplies_edit->date_received->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->date_received->cellAttributes() ?>>
<script id="tpx_tbl_supplies_date_received" type="text/html"><span id="el_tbl_supplies_date_received">
<input type="text" data-table="tbl_supplies" data-field="x_date_received" name="x_date_received" id="x_date_received" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_supplies_edit->date_received->getPlaceHolder()) ?>" value="<?php echo $tbl_supplies_edit->date_received->EditValue ?>"<?php echo $tbl_supplies_edit->date_received->editAttributes() ?>>
<?php if (!$tbl_supplies_edit->date_received->ReadOnly && !$tbl_supplies_edit->date_received->Disabled && !isset($tbl_supplies_edit->date_received->EditAttrs["readonly"]) && !isset($tbl_supplies_edit->date_received->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_suppliesedit_js">
loadjs.ready(["ftbl_suppliesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_suppliesedit", "x_date_received", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_supplies_edit->date_received->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->date_consumed->Visible) { // date_consumed ?>
	<div id="r_date_consumed" class="form-group row">
		<label id="elh_tbl_supplies_date_consumed" for="x_date_consumed" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_date_consumed" type="text/html"><?php echo $tbl_supplies_edit->date_consumed->caption() ?><?php echo $tbl_supplies_edit->date_consumed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->date_consumed->cellAttributes() ?>>
<script id="tpx_tbl_supplies_date_consumed" type="text/html"><span id="el_tbl_supplies_date_consumed">
<input type="text" data-table="tbl_supplies" data-field="x_date_consumed" name="x_date_consumed" id="x_date_consumed" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_supplies_edit->date_consumed->getPlaceHolder()) ?>" value="<?php echo $tbl_supplies_edit->date_consumed->EditValue ?>"<?php echo $tbl_supplies_edit->date_consumed->editAttributes() ?>>
<?php if (!$tbl_supplies_edit->date_consumed->ReadOnly && !$tbl_supplies_edit->date_consumed->Disabled && !isset($tbl_supplies_edit->date_consumed->EditAttrs["readonly"]) && !isset($tbl_supplies_edit->date_consumed->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_suppliesedit_js">
loadjs.ready(["ftbl_suppliesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_suppliesedit", "x_date_consumed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_supplies_edit->date_consumed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->Supplier->Visible) { // Supplier ?>
	<div id="r_Supplier" class="form-group row">
		<label id="elh_tbl_supplies_Supplier" for="x_Supplier" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_Supplier" type="text/html"><?php echo $tbl_supplies_edit->Supplier->caption() ?><?php echo $tbl_supplies_edit->Supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->Supplier->cellAttributes() ?>>
<script id="tpx_tbl_supplies_Supplier" type="text/html"><span id="el_tbl_supplies_Supplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_Supplier" data-value-separator="<?php echo $tbl_supplies_edit->Supplier->displayValueSeparatorAttribute() ?>" id="x_Supplier" name="x_Supplier"<?php echo $tbl_supplies_edit->Supplier->editAttributes() ?>>
			<?php echo $tbl_supplies_edit->Supplier->selectOptionListHtml("x_Supplier") ?>
		</select>
</div>
<?php echo $tbl_supplies_edit->Supplier->Lookup->getParamTag($tbl_supplies_edit, "p_x_Supplier") ?>
</span></script>
<?php echo $tbl_supplies_edit->Supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_edit->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_tbl_supplies_employeeid" for="x_employeeid" class="<?php echo $tbl_supplies_edit->LeftColumnClass ?>"><script id="tpc_tbl_supplies_employeeid" type="text/html"><?php echo $tbl_supplies_edit->employeeid->caption() ?><?php echo $tbl_supplies_edit->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_edit->RightColumnClass ?>"><div <?php echo $tbl_supplies_edit->employeeid->cellAttributes() ?>>
<script id="tpx_tbl_supplies_employeeid" type="text/html"><span id="el_tbl_supplies_employeeid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_employeeid" data-value-separator="<?php echo $tbl_supplies_edit->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $tbl_supplies_edit->employeeid->editAttributes() ?>>
			<?php echo $tbl_supplies_edit->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $tbl_supplies_edit->employeeid->Lookup->getParamTag($tbl_supplies_edit, "p_x_employeeid") ?>
</span></script>
<?php echo $tbl_supplies_edit->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_tbl_suppliesedit" class="ew-custom-template"></div>
<script id="tpm_tbl_suppliesedit" type="text/html">
<div id="ct_tbl_supplies_edit"><!--<table class="ew-table">-->
<table style="height: 154px; width: 920.017px;" border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 19px;">
<td style="width: 241px; height: 19px; vertical-align: middle;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_supplies_employeeid"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_employeeid")/}}</td>
<td style="width: 239px; height: 19px; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_supplies_serial"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_serial")/}}</td>
<td style="width: 330.017px; height: 19px; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_supplies_date_received"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_date_received")/}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 241px; height: 21px; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_supplies_supplies_cat"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_supplies_cat")/}}</td>
<td style="width: 239px; height: 21px; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_supplies_model"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_model")/}}</td>
<td style="width: 330.017px; height: 21px; vertical-align: middle;" scope="row">{{include tmpl="#tpc_tbl_supplies_date_consumed"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_date_consumed")/}}</td>
</tr>
<tr style="height: 23.05px;">
<td style="width: 480px; height: 23.05px; vertical-align: middle;" colspan="2" rowspan="2" scope="row">{{include tmpl="#tpc_tbl_supplies_remark"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_remark")/}}</td>
<td style="width: 330.017px; height: 23.05px; vertical-align: middle;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_supplies_status"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_status")/}}</td>
</tr>
<tr style="height: 26px;">
<td style="width: 330.017px; height: 26px; vertical-align: middle;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_supplies_Supplier"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_supplies_Supplier")/}}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$tbl_supplies_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_supplies_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_supplies_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_supplies->Rows) ?> };
	ew.applyTemplate("tpd_tbl_suppliesedit", "tpm_tbl_suppliesedit", "tbl_suppliesedit", "<?php echo $tbl_supplies->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_suppliesedit_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_supplies_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_date_consumed").attr("disabled","disabled"),$("#x_status").change(function(){$("option:selected",this);"1"==this.value?($("#x_date_consumed").removeAttr("disabled"),$("#x_date_consumed").prop("required",!0)):($("#x_date_consumed").attr("disabled","disabled"),$("#x_date_consumed")[0].selectedIndex=0,$("#x_date_consumed").prop("required",!1))})}),$(document).ready(function(){$("#x_date_received").attr("disabled","disabled")});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_supplies_edit->terminate();
?>