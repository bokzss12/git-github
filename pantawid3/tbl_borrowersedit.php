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
$tbl_borrowers_edit = new tbl_borrowers_edit();

// Run the page
$tbl_borrowers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_borrowers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_borrowersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_borrowersedit = currentForm = new ew.Form("ftbl_borrowersedit", "edit");

	// Validate form
	ftbl_borrowersedit.validate = function() {
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
			<?php if ($tbl_borrowers_edit->borrowers_id->Required) { ?>
				elm = this.getElements("x" + infix + "_borrowers_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->borrowers_id->caption(), $tbl_borrowers_edit->borrowers_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->Date_Barrowed->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Barrowed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->Date_Barrowed->caption(), $tbl_borrowers_edit->Date_Barrowed->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Barrowed");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_borrowers_edit->Date_Barrowed->errorMessage()) ?>");
			<?php if ($tbl_borrowers_edit->Date_Returned->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Returned");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->Date_Returned->caption(), $tbl_borrowers_edit->Date_Returned->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Returned");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_borrowers_edit->Date_Returned->errorMessage()) ?>");
			<?php if ($tbl_borrowers_edit->item_type->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->item_type->caption(), $tbl_borrowers_edit->item_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->item_model->Required) { ?>
				elm = this.getElements("x" + infix + "_item_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->item_model->caption(), $tbl_borrowers_edit->item_model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->item_serial->Required) { ?>
				elm = this.getElements("x" + infix + "_item_serial");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->item_serial->caption(), $tbl_borrowers_edit->item_serial->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->name_barrowers->Required) { ?>
				elm = this.getElements("x" + infix + "_name_barrowers");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->name_barrowers->caption(), $tbl_borrowers_edit->name_barrowers->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->Designation->Required) { ?>
				elm = this.getElements("x" + infix + "_Designation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->Designation->caption(), $tbl_borrowers_edit->Designation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->office_id->Required) { ?>
				elm = this.getElements("x" + infix + "_office_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->office_id->caption(), $tbl_borrowers_edit->office_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->Region->caption(), $tbl_borrowers_edit->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->Province->Required) { ?>
				elm = this.getElements("x" + infix + "_Province");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->Province->caption(), $tbl_borrowers_edit->Province->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->Cities->Required) { ?>
				elm = this.getElements("x" + infix + "_Cities");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->Cities->caption(), $tbl_borrowers_edit->Cities->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->status->caption(), $tbl_borrowers_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->Remarks->caption(), $tbl_borrowers_edit->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->user_last_modify->caption(), $tbl_borrowers_edit->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_borrowers_edit->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_borrowers_edit->date_last_modify->caption(), $tbl_borrowers_edit->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_borrowersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_borrowersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_borrowersedit.lists["x_item_type"] = <?php echo $tbl_borrowers_edit->item_type->Lookup->toClientList($tbl_borrowers_edit) ?>;
	ftbl_borrowersedit.lists["x_item_type"].options = <?php echo JsonEncode($tbl_borrowers_edit->item_type->lookupOptions()) ?>;
	ftbl_borrowersedit.lists["x_office_id"] = <?php echo $tbl_borrowers_edit->office_id->Lookup->toClientList($tbl_borrowers_edit) ?>;
	ftbl_borrowersedit.lists["x_office_id"].options = <?php echo JsonEncode($tbl_borrowers_edit->office_id->lookupOptions()) ?>;
	ftbl_borrowersedit.lists["x_Region"] = <?php echo $tbl_borrowers_edit->Region->Lookup->toClientList($tbl_borrowers_edit) ?>;
	ftbl_borrowersedit.lists["x_Region"].options = <?php echo JsonEncode($tbl_borrowers_edit->Region->lookupOptions()) ?>;
	ftbl_borrowersedit.lists["x_Province"] = <?php echo $tbl_borrowers_edit->Province->Lookup->toClientList($tbl_borrowers_edit) ?>;
	ftbl_borrowersedit.lists["x_Province"].options = <?php echo JsonEncode($tbl_borrowers_edit->Province->lookupOptions()) ?>;
	ftbl_borrowersedit.lists["x_Cities"] = <?php echo $tbl_borrowers_edit->Cities->Lookup->toClientList($tbl_borrowers_edit) ?>;
	ftbl_borrowersedit.lists["x_Cities"].options = <?php echo JsonEncode($tbl_borrowers_edit->Cities->lookupOptions()) ?>;
	ftbl_borrowersedit.lists["x_status"] = <?php echo $tbl_borrowers_edit->status->Lookup->toClientList($tbl_borrowers_edit) ?>;
	ftbl_borrowersedit.lists["x_status"].options = <?php echo JsonEncode($tbl_borrowers_edit->status->lookupOptions()) ?>;
	loadjs.done("ftbl_borrowersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_borrowers_edit->showPageHeader(); ?>
<?php
$tbl_borrowers_edit->showMessage();
?>
<form name="ftbl_borrowersedit" id="ftbl_borrowersedit" class="<?php echo $tbl_borrowers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_borrowers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_borrowers_edit->IsModal ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($tbl_borrowers_edit->borrowers_id->Visible) { // borrowers_id ?>
	<div id="r_borrowers_id" class="form-group row">
		<label id="elh_tbl_borrowers_borrowers_id" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_borrowers_id" type="text/html"><?php echo $tbl_borrowers_edit->borrowers_id->caption() ?><?php echo $tbl_borrowers_edit->borrowers_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->borrowers_id->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_borrowers_id" type="text/html"><span id="el_tbl_borrowers_borrowers_id">
<span<?php echo $tbl_borrowers_edit->borrowers_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_borrowers_edit->borrowers_id->EditValue)) ?>"></span>
</span></script>
<input type="hidden" data-table="tbl_borrowers" data-field="x_borrowers_id" name="x_borrowers_id" id="x_borrowers_id" value="<?php echo HtmlEncode($tbl_borrowers_edit->borrowers_id->CurrentValue) ?>">
<?php echo $tbl_borrowers_edit->borrowers_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->Date_Barrowed->Visible) { // Date_Barrowed ?>
	<div id="r_Date_Barrowed" class="form-group row">
		<label id="elh_tbl_borrowers_Date_Barrowed" for="x_Date_Barrowed" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_Date_Barrowed" type="text/html"><?php echo $tbl_borrowers_edit->Date_Barrowed->caption() ?><?php echo $tbl_borrowers_edit->Date_Barrowed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->Date_Barrowed->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_Date_Barrowed" type="text/html"><span id="el_tbl_borrowers_Date_Barrowed">
<input type="text" data-table="tbl_borrowers" data-field="x_Date_Barrowed" data-format="5" name="x_Date_Barrowed" id="x_Date_Barrowed" placeholder="<?php echo HtmlEncode($tbl_borrowers_edit->Date_Barrowed->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_edit->Date_Barrowed->EditValue ?>"<?php echo $tbl_borrowers_edit->Date_Barrowed->editAttributes() ?>>
<?php if (!$tbl_borrowers_edit->Date_Barrowed->ReadOnly && !$tbl_borrowers_edit->Date_Barrowed->Disabled && !isset($tbl_borrowers_edit->Date_Barrowed->EditAttrs["readonly"]) && !isset($tbl_borrowers_edit->Date_Barrowed->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_borrowersedit_js">
loadjs.ready(["ftbl_borrowersedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_borrowersedit", "x_Date_Barrowed", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php echo $tbl_borrowers_edit->Date_Barrowed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->Date_Returned->Visible) { // Date_Returned ?>
	<div id="r_Date_Returned" class="form-group row">
		<label id="elh_tbl_borrowers_Date_Returned" for="x_Date_Returned" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_Date_Returned" type="text/html"><?php echo $tbl_borrowers_edit->Date_Returned->caption() ?><?php echo $tbl_borrowers_edit->Date_Returned->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->Date_Returned->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_Date_Returned" type="text/html"><span id="el_tbl_borrowers_Date_Returned">
<input type="text" data-table="tbl_borrowers" data-field="x_Date_Returned" name="x_Date_Returned" id="x_Date_Returned" placeholder="<?php echo HtmlEncode($tbl_borrowers_edit->Date_Returned->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_edit->Date_Returned->EditValue ?>"<?php echo $tbl_borrowers_edit->Date_Returned->editAttributes() ?>>
<?php if (!$tbl_borrowers_edit->Date_Returned->ReadOnly && !$tbl_borrowers_edit->Date_Returned->Disabled && !isset($tbl_borrowers_edit->Date_Returned->EditAttrs["readonly"]) && !isset($tbl_borrowers_edit->Date_Returned->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_borrowersedit_js">
loadjs.ready(["ftbl_borrowersedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_borrowersedit", "x_Date_Returned", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_borrowers_edit->Date_Returned->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label id="elh_tbl_borrowers_item_type" for="x_item_type" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_item_type" type="text/html"><?php echo $tbl_borrowers_edit->item_type->caption() ?><?php echo $tbl_borrowers_edit->item_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->item_type->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_item_type" type="text/html"><span id="el_tbl_borrowers_item_type">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_item_type" data-value-separator="<?php echo $tbl_borrowers_edit->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $tbl_borrowers_edit->item_type->editAttributes() ?>>
			<?php echo $tbl_borrowers_edit->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $tbl_borrowers_edit->item_type->Lookup->getParamTag($tbl_borrowers_edit, "p_x_item_type") ?>
</span></script>
<?php echo $tbl_borrowers_edit->item_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label id="elh_tbl_borrowers_item_model" for="x_item_model" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_item_model" type="text/html"><?php echo $tbl_borrowers_edit->item_model->caption() ?><?php echo $tbl_borrowers_edit->item_model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->item_model->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_item_model" type="text/html"><span id="el_tbl_borrowers_item_model">
<input type="text" data-table="tbl_borrowers" data-field="x_item_model" name="x_item_model" id="x_item_model" size="71" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_borrowers_edit->item_model->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_edit->item_model->EditValue ?>"<?php echo $tbl_borrowers_edit->item_model->editAttributes() ?>>
</span></script>
<?php echo $tbl_borrowers_edit->item_model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->item_serial->Visible) { // item_serial ?>
	<div id="r_item_serial" class="form-group row">
		<label id="elh_tbl_borrowers_item_serial" for="x_item_serial" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_item_serial" type="text/html"><?php echo $tbl_borrowers_edit->item_serial->caption() ?><?php echo $tbl_borrowers_edit->item_serial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->item_serial->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_item_serial" type="text/html"><span id="el_tbl_borrowers_item_serial">
<input type="text" data-table="tbl_borrowers" data-field="x_item_serial" name="x_item_serial" id="x_item_serial" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($tbl_borrowers_edit->item_serial->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_edit->item_serial->EditValue ?>"<?php echo $tbl_borrowers_edit->item_serial->editAttributes() ?>>
</span></script>
<?php echo $tbl_borrowers_edit->item_serial->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->name_barrowers->Visible) { // name_barrowers ?>
	<div id="r_name_barrowers" class="form-group row">
		<label id="elh_tbl_borrowers_name_barrowers" for="x_name_barrowers" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_name_barrowers" type="text/html"><?php echo $tbl_borrowers_edit->name_barrowers->caption() ?><?php echo $tbl_borrowers_edit->name_barrowers->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->name_barrowers->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_name_barrowers" type="text/html"><span id="el_tbl_borrowers_name_barrowers">
<input type="text" data-table="tbl_borrowers" data-field="x_name_barrowers" name="x_name_barrowers" id="x_name_barrowers" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_borrowers_edit->name_barrowers->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_edit->name_barrowers->EditValue ?>"<?php echo $tbl_borrowers_edit->name_barrowers->editAttributes() ?>>
</span></script>
<?php echo $tbl_borrowers_edit->name_barrowers->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->Designation->Visible) { // Designation ?>
	<div id="r_Designation" class="form-group row">
		<label id="elh_tbl_borrowers_Designation" for="x_Designation" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_Designation" type="text/html"><?php echo $tbl_borrowers_edit->Designation->caption() ?><?php echo $tbl_borrowers_edit->Designation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->Designation->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_Designation" type="text/html"><span id="el_tbl_borrowers_Designation">
<input type="text" data-table="tbl_borrowers" data-field="x_Designation" name="x_Designation" id="x_Designation" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_borrowers_edit->Designation->getPlaceHolder()) ?>" value="<?php echo $tbl_borrowers_edit->Designation->EditValue ?>"<?php echo $tbl_borrowers_edit->Designation->editAttributes() ?>>
</span></script>
<?php echo $tbl_borrowers_edit->Designation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->office_id->Visible) { // office_id ?>
	<div id="r_office_id" class="form-group row">
		<label id="elh_tbl_borrowers_office_id" for="x_office_id" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_office_id" type="text/html"><?php echo $tbl_borrowers_edit->office_id->caption() ?><?php echo $tbl_borrowers_edit->office_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->office_id->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_office_id" type="text/html"><span id="el_tbl_borrowers_office_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_office_id" data-value-separator="<?php echo $tbl_borrowers_edit->office_id->displayValueSeparatorAttribute() ?>" id="x_office_id" name="x_office_id"<?php echo $tbl_borrowers_edit->office_id->editAttributes() ?>>
			<?php echo $tbl_borrowers_edit->office_id->selectOptionListHtml("x_office_id") ?>
		</select>
</div>
<?php echo $tbl_borrowers_edit->office_id->Lookup->getParamTag($tbl_borrowers_edit, "p_x_office_id") ?>
</span></script>
<?php echo $tbl_borrowers_edit->office_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_tbl_borrowers_Region" for="x_Region" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_Region" type="text/html"><?php echo $tbl_borrowers_edit->Region->caption() ?><?php echo $tbl_borrowers_edit->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->Region->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_Region" type="text/html"><span id="el_tbl_borrowers_Region">
<?php $tbl_borrowers_edit->Region->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_Region" data-value-separator="<?php echo $tbl_borrowers_edit->Region->displayValueSeparatorAttribute() ?>" id="x_Region" name="x_Region"<?php echo $tbl_borrowers_edit->Region->editAttributes() ?>>
			<?php echo $tbl_borrowers_edit->Region->selectOptionListHtml("x_Region") ?>
		</select>
</div>
<?php echo $tbl_borrowers_edit->Region->Lookup->getParamTag($tbl_borrowers_edit, "p_x_Region") ?>
</span></script>
<?php echo $tbl_borrowers_edit->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->Province->Visible) { // Province ?>
	<div id="r_Province" class="form-group row">
		<label id="elh_tbl_borrowers_Province" for="x_Province" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_Province" type="text/html"><?php echo $tbl_borrowers_edit->Province->caption() ?><?php echo $tbl_borrowers_edit->Province->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->Province->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_Province" type="text/html"><span id="el_tbl_borrowers_Province">
<?php $tbl_borrowers_edit->Province->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_Province" data-value-separator="<?php echo $tbl_borrowers_edit->Province->displayValueSeparatorAttribute() ?>" id="x_Province" name="x_Province"<?php echo $tbl_borrowers_edit->Province->editAttributes() ?>>
			<?php echo $tbl_borrowers_edit->Province->selectOptionListHtml("x_Province") ?>
		</select>
</div>
<?php echo $tbl_borrowers_edit->Province->Lookup->getParamTag($tbl_borrowers_edit, "p_x_Province") ?>
</span></script>
<?php echo $tbl_borrowers_edit->Province->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->Cities->Visible) { // Cities ?>
	<div id="r_Cities" class="form-group row">
		<label id="elh_tbl_borrowers_Cities" for="x_Cities" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_Cities" type="text/html"><?php echo $tbl_borrowers_edit->Cities->caption() ?><?php echo $tbl_borrowers_edit->Cities->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->Cities->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_Cities" type="text/html"><span id="el_tbl_borrowers_Cities">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_Cities" data-value-separator="<?php echo $tbl_borrowers_edit->Cities->displayValueSeparatorAttribute() ?>" id="x_Cities" name="x_Cities"<?php echo $tbl_borrowers_edit->Cities->editAttributes() ?>>
			<?php echo $tbl_borrowers_edit->Cities->selectOptionListHtml("x_Cities") ?>
		</select>
</div>
<?php echo $tbl_borrowers_edit->Cities->Lookup->getParamTag($tbl_borrowers_edit, "p_x_Cities") ?>
</span></script>
<?php echo $tbl_borrowers_edit->Cities->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_tbl_borrowers_status" for="x_status" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_status" type="text/html"><?php echo $tbl_borrowers_edit->status->caption() ?><?php echo $tbl_borrowers_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->status->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_status" type="text/html"><span id="el_tbl_borrowers_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_borrowers" data-field="x_status" data-value-separator="<?php echo $tbl_borrowers_edit->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $tbl_borrowers_edit->status->editAttributes() ?>>
			<?php echo $tbl_borrowers_edit->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $tbl_borrowers_edit->status->Lookup->getParamTag($tbl_borrowers_edit, "p_x_status") ?>
</span></script>
<?php echo $tbl_borrowers_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_borrowers_edit->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_tbl_borrowers_Remarks" for="x_Remarks" class="<?php echo $tbl_borrowers_edit->LeftColumnClass ?>"><script id="tpc_tbl_borrowers_Remarks" type="text/html"><?php echo $tbl_borrowers_edit->Remarks->caption() ?><?php echo $tbl_borrowers_edit->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_borrowers_edit->RightColumnClass ?>"><div <?php echo $tbl_borrowers_edit->Remarks->cellAttributes() ?>>
<script id="tpx_tbl_borrowers_Remarks" type="text/html"><span id="el_tbl_borrowers_Remarks">
<textarea data-table="tbl_borrowers" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_borrowers_edit->Remarks->getPlaceHolder()) ?>"<?php echo $tbl_borrowers_edit->Remarks->editAttributes() ?>><?php echo $tbl_borrowers_edit->Remarks->EditValue ?></textarea>
</span></script>
<?php echo $tbl_borrowers_edit->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_tbl_borrowersedit" class="ew-custom-template"></div>
<script id="tpm_tbl_borrowersedit" type="text/html">
<div id="ct_tbl_borrowers_edit"><!--<table class="ew-table">-->
<table style="height: 256px; width: 920px;" border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 43px;">
<td style="width: 305.6px; height: 43px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_borrowers_Date_Barrowed"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_Date_Barrowed")/}}</td>
<td style="width: 288.017px; height: 43px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_borrowers_item_type"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_item_type")/}}</td>
<td style="width: 262.983px; height: 43px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_borrowers_name_barrowers"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_name_barrowers")/}}</td>
</tr>
<tr style="height: 43.8167px;">
<td style="width: 305.6px; height: 43.8167px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_borrowers_Date_Returned"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_Date_Returned")/}}</td>
<td style="width: 288.017px; height: 43.8167px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_borrowers_item_serial"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_item_serial")/}}</td>
<td style="width: 262.983px; height: 43.8167px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_borrowers_Designation"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_Designation")/}}</td>
</tr>
<tr style="height: 43px;">
<td style="width: 305.6px; height: 43px; text-align: left;" scope="row">&nbsp;</td>
<td style="width: 288.017px; height: 43px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_borrowers_status"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_status")/}}</td>
<td style="width: 262.983px; height: 43px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_borrowers_office_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_office_id")/}}</td>
</tr>
<tr style="height: 43px;">
<td style="width: 610.85px; height: 43px; text-align: left;" colspan="2" scope="row">{{include tmpl="#tpc_tbl_borrowers_Remarks"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_borrowers_Remarks")/}}&nbsp;</td>
<td style="width: 262.983px; height: 43px; text-align: left;" scope="row">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$tbl_borrowers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_borrowers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_borrowers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_borrowers->Rows) ?> };
	ew.applyTemplate("tpd_tbl_borrowersedit", "tpm_tbl_borrowersedit", "tbl_borrowersedit", "<?php echo $tbl_borrowers->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_borrowersedit_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_borrowers_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_Date_Returned").attr("disabled","disabled"),$("#x_status").change(function(){$("option:selected",this);"2"==this.value?($("#x_Date_Returned").removeAttr("disabled"),$("#x_Date_Returned").prop("required",!0)):($("#x_Date_Returned").attr("disabled","disabled"),$("#x_Date_Returned")[0].selectedIndex=0,$("#x_Date_Returned").prop("required",!1))})}),$(document).ready(function(){$("#x_Date_Barrowed").attr("disabled","disabled")});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_borrowers_edit->terminate();
?>