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
$tbl_supplies_add = new tbl_supplies_add();

// Run the page
$tbl_supplies_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_supplies_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_suppliesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_suppliesadd = currentForm = new ew.Form("ftbl_suppliesadd", "add");

	// Validate form
	ftbl_suppliesadd.validate = function() {
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
			<?php if ($tbl_supplies_add->supplies_cat->Required) { ?>
				elm = this.getElements("x" + infix + "_supplies_cat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->supplies_cat->caption(), $tbl_supplies_add->supplies_cat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->model->Required) { ?>
				elm = this.getElements("x" + infix + "_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->model->caption(), $tbl_supplies_add->model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->serial->Required) { ?>
				elm = this.getElements("x" + infix + "_serial");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->serial->caption(), $tbl_supplies_add->serial->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->status->caption(), $tbl_supplies_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->remark->Required) { ?>
				elm = this.getElements("x" + infix + "_remark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->remark->caption(), $tbl_supplies_add->remark->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->date_received->Required) { ?>
				elm = this.getElements("x" + infix + "_date_received");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->date_received->caption(), $tbl_supplies_add->date_received->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_received");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_supplies_add->date_received->errorMessage()) ?>");
			<?php if ($tbl_supplies_add->date_consumed->Required) { ?>
				elm = this.getElements("x" + infix + "_date_consumed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->date_consumed->caption(), $tbl_supplies_add->date_consumed->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_consumed");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_supplies_add->date_consumed->errorMessage()) ?>");
			<?php if ($tbl_supplies_add->Supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->Supplier->caption(), $tbl_supplies_add->Supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->employeeid->caption(), $tbl_supplies_add->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->user_last_modify->caption(), $tbl_supplies_add->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_supplies_add->user_date_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_date_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_supplies_add->user_date_modify->caption(), $tbl_supplies_add->user_date_modify->RequiredErrorMessage)) ?>");
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
	ftbl_suppliesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_suppliesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_suppliesadd.lists["x_supplies_cat"] = <?php echo $tbl_supplies_add->supplies_cat->Lookup->toClientList($tbl_supplies_add) ?>;
	ftbl_suppliesadd.lists["x_supplies_cat"].options = <?php echo JsonEncode($tbl_supplies_add->supplies_cat->lookupOptions()) ?>;
	ftbl_suppliesadd.lists["x_model"] = <?php echo $tbl_supplies_add->model->Lookup->toClientList($tbl_supplies_add) ?>;
	ftbl_suppliesadd.lists["x_model"].options = <?php echo JsonEncode($tbl_supplies_add->model->lookupOptions()) ?>;
	ftbl_suppliesadd.lists["x_status"] = <?php echo $tbl_supplies_add->status->Lookup->toClientList($tbl_supplies_add) ?>;
	ftbl_suppliesadd.lists["x_status"].options = <?php echo JsonEncode($tbl_supplies_add->status->lookupOptions()) ?>;
	ftbl_suppliesadd.lists["x_Supplier"] = <?php echo $tbl_supplies_add->Supplier->Lookup->toClientList($tbl_supplies_add) ?>;
	ftbl_suppliesadd.lists["x_Supplier"].options = <?php echo JsonEncode($tbl_supplies_add->Supplier->lookupOptions()) ?>;
	ftbl_suppliesadd.lists["x_employeeid"] = <?php echo $tbl_supplies_add->employeeid->Lookup->toClientList($tbl_supplies_add) ?>;
	ftbl_suppliesadd.lists["x_employeeid"].options = <?php echo JsonEncode($tbl_supplies_add->employeeid->lookupOptions()) ?>;
	loadjs.done("ftbl_suppliesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_supplies_add->showPageHeader(); ?>
<?php
$tbl_supplies_add->showMessage();
?>
<form name="ftbl_suppliesadd" id="ftbl_suppliesadd" class="<?php echo $tbl_supplies_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_supplies">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_supplies_add->IsModal ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($tbl_supplies_add->supplies_cat->Visible) { // supplies_cat ?>
	<div id="r_supplies_cat" class="form-group row">
		<label id="elh_tbl_supplies_supplies_cat" for="x_supplies_cat" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_supplies_cat" type="text/html"><?php echo $tbl_supplies_add->supplies_cat->caption() ?><?php echo $tbl_supplies_add->supplies_cat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->supplies_cat->cellAttributes() ?>>
<script id="tpx_tbl_supplies_supplies_cat" type="text/html"><span id="el_tbl_supplies_supplies_cat">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_supplies_cat" data-value-separator="<?php echo $tbl_supplies_add->supplies_cat->displayValueSeparatorAttribute() ?>" id="x_supplies_cat" name="x_supplies_cat"<?php echo $tbl_supplies_add->supplies_cat->editAttributes() ?>>
			<?php echo $tbl_supplies_add->supplies_cat->selectOptionListHtml("x_supplies_cat") ?>
		</select>
</div>
<?php echo $tbl_supplies_add->supplies_cat->Lookup->getParamTag($tbl_supplies_add, "p_x_supplies_cat") ?>
</span></script>
<?php echo $tbl_supplies_add->supplies_cat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->model->Visible) { // model ?>
	<div id="r_model" class="form-group row">
		<label id="elh_tbl_supplies_model" for="x_model" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_model" type="text/html"><?php echo $tbl_supplies_add->model->caption() ?><?php echo $tbl_supplies_add->model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->model->cellAttributes() ?>>
<script id="tpx_tbl_supplies_model" type="text/html"><span id="el_tbl_supplies_model">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_model" data-value-separator="<?php echo $tbl_supplies_add->model->displayValueSeparatorAttribute() ?>" id="x_model" name="x_model"<?php echo $tbl_supplies_add->model->editAttributes() ?>>
			<?php echo $tbl_supplies_add->model->selectOptionListHtml("x_model") ?>
		</select>
</div>
<?php echo $tbl_supplies_add->model->Lookup->getParamTag($tbl_supplies_add, "p_x_model") ?>
</span></script>
<?php echo $tbl_supplies_add->model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->serial->Visible) { // serial ?>
	<div id="r_serial" class="form-group row">
		<label id="elh_tbl_supplies_serial" for="x_serial" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_serial" type="text/html"><?php echo $tbl_supplies_add->serial->caption() ?><?php echo $tbl_supplies_add->serial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->serial->cellAttributes() ?>>
<script id="tpx_tbl_supplies_serial" type="text/html"><span id="el_tbl_supplies_serial">
<input type="text" data-table="tbl_supplies" data-field="x_serial" name="x_serial" id="x_serial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_supplies_add->serial->getPlaceHolder()) ?>" value="<?php echo $tbl_supplies_add->serial->EditValue ?>"<?php echo $tbl_supplies_add->serial->editAttributes() ?>>
</span></script>
<?php echo $tbl_supplies_add->serial->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_tbl_supplies_status" for="x_status" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_status" type="text/html"><?php echo $tbl_supplies_add->status->caption() ?><?php echo $tbl_supplies_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->status->cellAttributes() ?>>
<script id="tpx_tbl_supplies_status" type="text/html"><span id="el_tbl_supplies_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_status" data-value-separator="<?php echo $tbl_supplies_add->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $tbl_supplies_add->status->editAttributes() ?>>
			<?php echo $tbl_supplies_add->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $tbl_supplies_add->status->Lookup->getParamTag($tbl_supplies_add, "p_x_status") ?>
</span></script>
<?php echo $tbl_supplies_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->remark->Visible) { // remark ?>
	<div id="r_remark" class="form-group row">
		<label id="elh_tbl_supplies_remark" for="x_remark" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_remark" type="text/html"><?php echo $tbl_supplies_add->remark->caption() ?><?php echo $tbl_supplies_add->remark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->remark->cellAttributes() ?>>
<script id="tpx_tbl_supplies_remark" type="text/html"><span id="el_tbl_supplies_remark">
<textarea data-table="tbl_supplies" data-field="x_remark" name="x_remark" id="x_remark" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_supplies_add->remark->getPlaceHolder()) ?>"<?php echo $tbl_supplies_add->remark->editAttributes() ?>><?php echo $tbl_supplies_add->remark->EditValue ?></textarea>
</span></script>
<?php echo $tbl_supplies_add->remark->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->date_received->Visible) { // date_received ?>
	<div id="r_date_received" class="form-group row">
		<label id="elh_tbl_supplies_date_received" for="x_date_received" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_date_received" type="text/html"><?php echo $tbl_supplies_add->date_received->caption() ?><?php echo $tbl_supplies_add->date_received->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->date_received->cellAttributes() ?>>
<script id="tpx_tbl_supplies_date_received" type="text/html"><span id="el_tbl_supplies_date_received">
<input type="text" data-table="tbl_supplies" data-field="x_date_received" name="x_date_received" id="x_date_received" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_supplies_add->date_received->getPlaceHolder()) ?>" value="<?php echo $tbl_supplies_add->date_received->EditValue ?>"<?php echo $tbl_supplies_add->date_received->editAttributes() ?>>
<?php if (!$tbl_supplies_add->date_received->ReadOnly && !$tbl_supplies_add->date_received->Disabled && !isset($tbl_supplies_add->date_received->EditAttrs["readonly"]) && !isset($tbl_supplies_add->date_received->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_suppliesadd_js">
loadjs.ready(["ftbl_suppliesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_suppliesadd", "x_date_received", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_supplies_add->date_received->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->date_consumed->Visible) { // date_consumed ?>
	<div id="r_date_consumed" class="form-group row">
		<label id="elh_tbl_supplies_date_consumed" for="x_date_consumed" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_date_consumed" type="text/html"><?php echo $tbl_supplies_add->date_consumed->caption() ?><?php echo $tbl_supplies_add->date_consumed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->date_consumed->cellAttributes() ?>>
<script id="tpx_tbl_supplies_date_consumed" type="text/html"><span id="el_tbl_supplies_date_consumed">
<input type="text" data-table="tbl_supplies" data-field="x_date_consumed" name="x_date_consumed" id="x_date_consumed" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_supplies_add->date_consumed->getPlaceHolder()) ?>" value="<?php echo $tbl_supplies_add->date_consumed->EditValue ?>"<?php echo $tbl_supplies_add->date_consumed->editAttributes() ?>>
<?php if (!$tbl_supplies_add->date_consumed->ReadOnly && !$tbl_supplies_add->date_consumed->Disabled && !isset($tbl_supplies_add->date_consumed->EditAttrs["readonly"]) && !isset($tbl_supplies_add->date_consumed->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_suppliesadd_js">
loadjs.ready(["ftbl_suppliesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_suppliesadd", "x_date_consumed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_supplies_add->date_consumed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->Supplier->Visible) { // Supplier ?>
	<div id="r_Supplier" class="form-group row">
		<label id="elh_tbl_supplies_Supplier" for="x_Supplier" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_Supplier" type="text/html"><?php echo $tbl_supplies_add->Supplier->caption() ?><?php echo $tbl_supplies_add->Supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->Supplier->cellAttributes() ?>>
<script id="tpx_tbl_supplies_Supplier" type="text/html"><span id="el_tbl_supplies_Supplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_Supplier" data-value-separator="<?php echo $tbl_supplies_add->Supplier->displayValueSeparatorAttribute() ?>" id="x_Supplier" name="x_Supplier"<?php echo $tbl_supplies_add->Supplier->editAttributes() ?>>
			<?php echo $tbl_supplies_add->Supplier->selectOptionListHtml("x_Supplier") ?>
		</select>
</div>
<?php echo $tbl_supplies_add->Supplier->Lookup->getParamTag($tbl_supplies_add, "p_x_Supplier") ?>
</span></script>
<?php echo $tbl_supplies_add->Supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_supplies_add->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_tbl_supplies_employeeid" for="x_employeeid" class="<?php echo $tbl_supplies_add->LeftColumnClass ?>"><script id="tpc_tbl_supplies_employeeid" type="text/html"><?php echo $tbl_supplies_add->employeeid->caption() ?><?php echo $tbl_supplies_add->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_supplies_add->RightColumnClass ?>"><div <?php echo $tbl_supplies_add->employeeid->cellAttributes() ?>>
<script id="tpx_tbl_supplies_employeeid" type="text/html"><span id="el_tbl_supplies_employeeid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_supplies" data-field="x_employeeid" data-value-separator="<?php echo $tbl_supplies_add->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $tbl_supplies_add->employeeid->editAttributes() ?>>
			<?php echo $tbl_supplies_add->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $tbl_supplies_add->employeeid->Lookup->getParamTag($tbl_supplies_add, "p_x_employeeid") ?>
</span></script>
<?php echo $tbl_supplies_add->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_tbl_suppliesadd" class="ew-custom-template"></div>
<script id="tpm_tbl_suppliesadd" type="text/html">
<div id="ct_tbl_supplies_add"><!--<table class="ew-table">-->
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

<?php if (!$tbl_supplies_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_supplies_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_supplies_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_supplies->Rows) ?> };
	ew.applyTemplate("tpd_tbl_suppliesadd", "tpm_tbl_suppliesadd", "tbl_suppliesadd", "<?php echo $tbl_supplies->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_suppliesadd_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_supplies_add->showPageFooter();
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
$tbl_supplies_add->terminate();
?>