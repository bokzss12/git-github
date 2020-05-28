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
$inspection_report_add = new inspection_report_add();

// Run the page
$inspection_report_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inspection_report_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finspection_reportadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	finspection_reportadd = currentForm = new ew.Form("finspection_reportadd", "add");

	// Validate form
	finspection_reportadd.validate = function() {
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
			<?php if ($inspection_report_add->item_date_repaired->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_repaired");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_date_repaired->caption(), $inspection_report_add->item_date_repaired->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_repaired");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->item_date_repaired->errorMessage()) ?>");
			<?php if ($inspection_report_add->item_model->Required) { ?>
				elm = this.getElements("x" + infix + "_item_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_model->caption(), $inspection_report_add->item_model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->item_serno->Required) { ?>
				elm = this.getElements("x" + infix + "_item_serno");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_serno->caption(), $inspection_report_add->item_serno->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->item_transmittal->Required) { ?>
				elm = this.getElements("x" + infix + "_item_transmittal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_transmittal->caption(), $inspection_report_add->item_transmittal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->position->Required) { ?>
				elm = this.getElements("x" + infix + "_position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->position->caption(), $inspection_report_add->position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->item_type_problem->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type_problem");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_type_problem->caption(), $inspection_report_add->item_type_problem->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->item_action_taken->Required) { ?>
				elm = this.getElements("x" + infix + "_item_action_taken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_action_taken->caption(), $inspection_report_add->item_action_taken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->remarks->caption(), $inspection_report_add->remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->SRN->Required) { ?>
				elm = this.getElements("x" + infix + "_SRN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->SRN->caption(), $inspection_report_add->SRN->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->inventory_id->Required) { ?>
				elm = this.getElements("x" + infix + "_inventory_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->inventory_id->caption(), $inspection_report_add->inventory_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->month->Required) { ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->month->caption(), $inspection_report_add->month->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->month->errorMessage()) ?>");
			<?php if ($inspection_report_add->Year->Required) { ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->Year->caption(), $inspection_report_add->Year->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->Year->errorMessage()) ?>");
			<?php if ($inspection_report_add->item_date_receive->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_date_receive->caption(), $inspection_report_add->item_date_receive->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->item_date_receive->errorMessage()) ?>");
			<?php if ($inspection_report_add->Date_Finished->Required) { ?>
				elm = this.getElements("x" + infix + "_Date_Finished");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->Date_Finished->caption(), $inspection_report_add->Date_Finished->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date_Finished");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->Date_Finished->errorMessage()) ?>");
			<?php if ($inspection_report_add->item_date_pullout->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_pullout");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_date_pullout->caption(), $inspection_report_add->item_date_pullout->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_pullout");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->item_date_pullout->errorMessage()) ?>");
			<?php if ($inspection_report_add->__Request->Required) { ?>
				elm = this.getElements("x" + infix + "___Request");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->__Request->caption(), $inspection_report_add->__Request->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "___Request");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->__Request->errorMessage()) ?>");
			<?php if ($inspection_report_add->item_type->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_type->caption(), $inspection_report_add->item_type->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_type");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->item_type->errorMessage()) ?>");
			<?php if ($inspection_report_add->item_requested_unit->Required) { ?>
				elm = this.getElements("x" + infix + "_item_requested_unit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->item_requested_unit->caption(), $inspection_report_add->item_requested_unit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_requested_unit");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->item_requested_unit->errorMessage()) ?>");
			<?php if ($inspection_report_add->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->Region->caption(), $inspection_report_add->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->Region->errorMessage()) ?>");
			<?php if ($inspection_report_add->Province->Required) { ?>
				elm = this.getElements("x" + infix + "_Province");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->Province->caption(), $inspection_report_add->Province->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Province");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->Province->errorMessage()) ?>");
			<?php if ($inspection_report_add->Cities->Required) { ?>
				elm = this.getElements("x" + infix + "_Cities");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->Cities->caption(), $inspection_report_add->Cities->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Cities");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->Cities->errorMessage()) ?>");
			<?php if ($inspection_report_add->technician_name->Required) { ?>
				elm = this.getElements("x" + infix + "_technician_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->technician_name->caption(), $inspection_report_add->technician_name->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_technician_name");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->technician_name->errorMessage()) ?>");
			<?php if ($inspection_report_add->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->employeeid->caption(), $inspection_report_add->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->employeeid->errorMessage()) ?>");
			<?php if ($inspection_report_add->status_id->Required) { ?>
				elm = this.getElements("x" + infix + "_status_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->status_id->caption(), $inspection_report_add->status_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_status_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->status_id->errorMessage()) ?>");
			<?php if ($inspection_report_add->Contact_no->Required) { ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->Contact_no->caption(), $inspection_report_add->Contact_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->Contact_no->errorMessage()) ?>");
			<?php if ($inspection_report_add->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->user_last_modify->caption(), $inspection_report_add->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inspection_report_add->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->date_last_modify->caption(), $inspection_report_add->date_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inspection_report_add->date_last_modify->errorMessage()) ?>");
			<?php if ($inspection_report_add->inventory_idt->Required) { ?>
				elm = this.getElements("x" + infix + "_inventory_idt");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inspection_report_add->inventory_idt->caption(), $inspection_report_add->inventory_idt->RequiredErrorMessage)) ?>");
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
	finspection_reportadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	finspection_reportadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	finspection_reportadd.lists["x_item_transmittal"] = <?php echo $inspection_report_add->item_transmittal->Lookup->toClientList($inspection_report_add) ?>;
	finspection_reportadd.lists["x_item_transmittal"].options = <?php echo JsonEncode($inspection_report_add->item_transmittal->lookupOptions()) ?>;
	finspection_reportadd.lists["x_position"] = <?php echo $inspection_report_add->position->Lookup->toClientList($inspection_report_add) ?>;
	finspection_reportadd.lists["x_position"].options = <?php echo JsonEncode($inspection_report_add->position->lookupOptions()) ?>;
	loadjs.done("finspection_reportadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $inspection_report_add->showPageHeader(); ?>
<?php
$inspection_report_add->showMessage();
?>
<form name="finspection_reportadd" id="finspection_reportadd" class="<?php echo $inspection_report_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inspection_report">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$inspection_report_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($inspection_report_add->item_date_repaired->Visible) { // item_date_repaired ?>
	<div id="r_item_date_repaired" class="form-group row">
		<label id="elh_inspection_report_item_date_repaired" for="x_item_date_repaired" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_date_repaired->caption() ?><?php echo $inspection_report_add->item_date_repaired->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_date_repaired->cellAttributes() ?>>
<span id="el_inspection_report_item_date_repaired">
<input type="text" data-table="inspection_report" data-field="x_item_date_repaired" data-format="7" name="x_item_date_repaired" id="x_item_date_repaired" placeholder="<?php echo HtmlEncode($inspection_report_add->item_date_repaired->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->item_date_repaired->EditValue ?>"<?php echo $inspection_report_add->item_date_repaired->editAttributes() ?>>
<?php if (!$inspection_report_add->item_date_repaired->ReadOnly && !$inspection_report_add->item_date_repaired->Disabled && !isset($inspection_report_add->item_date_repaired->EditAttrs["readonly"]) && !isset($inspection_report_add->item_date_repaired->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finspection_reportadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finspection_reportadd", "x_item_date_repaired", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $inspection_report_add->item_date_repaired->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label id="elh_inspection_report_item_model" for="x_item_model" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_model->caption() ?><?php echo $inspection_report_add->item_model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_model->cellAttributes() ?>>
<span id="el_inspection_report_item_model">
<input type="text" data-table="inspection_report" data-field="x_item_model" name="x_item_model" id="x_item_model" maxlength="50" placeholder="<?php echo HtmlEncode($inspection_report_add->item_model->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->item_model->EditValue ?>"<?php echo $inspection_report_add->item_model->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->item_model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_serno->Visible) { // item_serno ?>
	<div id="r_item_serno" class="form-group row">
		<label id="elh_inspection_report_item_serno" for="x_item_serno" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_serno->caption() ?><?php echo $inspection_report_add->item_serno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_serno->cellAttributes() ?>>
<span id="el_inspection_report_item_serno">
<input type="text" data-table="inspection_report" data-field="x_item_serno" name="x_item_serno" id="x_item_serno" maxlength="50" placeholder="<?php echo HtmlEncode($inspection_report_add->item_serno->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->item_serno->EditValue ?>"<?php echo $inspection_report_add->item_serno->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->item_serno->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_transmittal->Visible) { // item_transmittal ?>
	<div id="r_item_transmittal" class="form-group row">
		<label id="elh_inspection_report_item_transmittal" for="x_item_transmittal" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_transmittal->caption() ?><?php echo $inspection_report_add->item_transmittal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_transmittal->cellAttributes() ?>>
<span id="el_inspection_report_item_transmittal">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="inspection_report" data-field="x_item_transmittal" data-value-separator="<?php echo $inspection_report_add->item_transmittal->displayValueSeparatorAttribute() ?>" id="x_item_transmittal" name="x_item_transmittal"<?php echo $inspection_report_add->item_transmittal->editAttributes() ?>>
			<?php echo $inspection_report_add->item_transmittal->selectOptionListHtml("x_item_transmittal") ?>
		</select>
</div>
<?php echo $inspection_report_add->item_transmittal->Lookup->getParamTag($inspection_report_add, "p_x_item_transmittal") ?>
</span>
<?php echo $inspection_report_add->item_transmittal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->position->Visible) { // position ?>
	<div id="r_position" class="form-group row">
		<label id="elh_inspection_report_position" for="x_position" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->position->caption() ?><?php echo $inspection_report_add->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->position->cellAttributes() ?>>
<span id="el_inspection_report_position">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="inspection_report" data-field="x_position" data-value-separator="<?php echo $inspection_report_add->position->displayValueSeparatorAttribute() ?>" id="x_position" name="x_position"<?php echo $inspection_report_add->position->editAttributes() ?>>
			<?php echo $inspection_report_add->position->selectOptionListHtml("x_position") ?>
		</select>
</div>
<?php echo $inspection_report_add->position->Lookup->getParamTag($inspection_report_add, "p_x_position") ?>
</span>
<?php echo $inspection_report_add->position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_type_problem->Visible) { // item_type_problem ?>
	<div id="r_item_type_problem" class="form-group row">
		<label id="elh_inspection_report_item_type_problem" for="x_item_type_problem" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_type_problem->caption() ?><?php echo $inspection_report_add->item_type_problem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_type_problem->cellAttributes() ?>>
<span id="el_inspection_report_item_type_problem">
<textarea data-table="inspection_report" data-field="x_item_type_problem" name="x_item_type_problem" id="x_item_type_problem" cols="35" rows="4" placeholder="<?php echo HtmlEncode($inspection_report_add->item_type_problem->getPlaceHolder()) ?>"<?php echo $inspection_report_add->item_type_problem->editAttributes() ?>><?php echo $inspection_report_add->item_type_problem->EditValue ?></textarea>
</span>
<?php echo $inspection_report_add->item_type_problem->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_action_taken->Visible) { // item_action_taken ?>
	<div id="r_item_action_taken" class="form-group row">
		<label id="elh_inspection_report_item_action_taken" for="x_item_action_taken" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_action_taken->caption() ?><?php echo $inspection_report_add->item_action_taken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_action_taken->cellAttributes() ?>>
<span id="el_inspection_report_item_action_taken">
<textarea data-table="inspection_report" data-field="x_item_action_taken" name="x_item_action_taken" id="x_item_action_taken" cols="35" rows="4" placeholder="<?php echo HtmlEncode($inspection_report_add->item_action_taken->getPlaceHolder()) ?>"<?php echo $inspection_report_add->item_action_taken->editAttributes() ?>><?php echo $inspection_report_add->item_action_taken->EditValue ?></textarea>
</span>
<?php echo $inspection_report_add->item_action_taken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->remarks->Visible) { // remarks ?>
	<div id="r_remarks" class="form-group row">
		<label id="elh_inspection_report_remarks" for="x_remarks" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->remarks->caption() ?><?php echo $inspection_report_add->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->remarks->cellAttributes() ?>>
<span id="el_inspection_report_remarks">
<textarea data-table="inspection_report" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($inspection_report_add->remarks->getPlaceHolder()) ?>"<?php echo $inspection_report_add->remarks->editAttributes() ?>><?php echo $inspection_report_add->remarks->EditValue ?></textarea>
</span>
<?php echo $inspection_report_add->remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->SRN->Visible) { // SRN ?>
	<div id="r_SRN" class="form-group row">
		<label id="elh_inspection_report_SRN" for="x_SRN" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->SRN->caption() ?><?php echo $inspection_report_add->SRN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->SRN->cellAttributes() ?>>
<span id="el_inspection_report_SRN">
<input type="text" data-table="inspection_report" data-field="x_SRN" name="x_SRN" id="x_SRN" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($inspection_report_add->SRN->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->SRN->EditValue ?>"<?php echo $inspection_report_add->SRN->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->SRN->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->inventory_id->Visible) { // inventory_id ?>
	<div id="r_inventory_id" class="form-group row">
		<label id="elh_inspection_report_inventory_id" for="x_inventory_id" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->inventory_id->caption() ?><?php echo $inspection_report_add->inventory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->inventory_id->cellAttributes() ?>>
<span id="el_inspection_report_inventory_id">
<input type="text" data-table="inspection_report" data-field="x_inventory_id" name="x_inventory_id" id="x_inventory_id" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($inspection_report_add->inventory_id->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->inventory_id->EditValue ?>"<?php echo $inspection_report_add->inventory_id->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->inventory_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->month->Visible) { // month ?>
	<div id="r_month" class="form-group row">
		<label id="elh_inspection_report_month" for="x_month" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->month->caption() ?><?php echo $inspection_report_add->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->month->cellAttributes() ?>>
<span id="el_inspection_report_month">
<input type="text" data-table="inspection_report" data-field="x_month" name="x_month" id="x_month" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->month->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->month->EditValue ?>"<?php echo $inspection_report_add->month->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->month->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->Year->Visible) { // Year ?>
	<div id="r_Year" class="form-group row">
		<label id="elh_inspection_report_Year" for="x_Year" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->Year->caption() ?><?php echo $inspection_report_add->Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->Year->cellAttributes() ?>>
<span id="el_inspection_report_Year">
<input type="text" data-table="inspection_report" data-field="x_Year" name="x_Year" id="x_Year" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->Year->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->Year->EditValue ?>"<?php echo $inspection_report_add->Year->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->Year->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_date_receive->Visible) { // item_date_receive ?>
	<div id="r_item_date_receive" class="form-group row">
		<label id="elh_inspection_report_item_date_receive" for="x_item_date_receive" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_date_receive->caption() ?><?php echo $inspection_report_add->item_date_receive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_date_receive->cellAttributes() ?>>
<span id="el_inspection_report_item_date_receive">
<input type="text" data-table="inspection_report" data-field="x_item_date_receive" name="x_item_date_receive" id="x_item_date_receive" maxlength="10" placeholder="<?php echo HtmlEncode($inspection_report_add->item_date_receive->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->item_date_receive->EditValue ?>"<?php echo $inspection_report_add->item_date_receive->editAttributes() ?>>
<?php if (!$inspection_report_add->item_date_receive->ReadOnly && !$inspection_report_add->item_date_receive->Disabled && !isset($inspection_report_add->item_date_receive->EditAttrs["readonly"]) && !isset($inspection_report_add->item_date_receive->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finspection_reportadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finspection_reportadd", "x_item_date_receive", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $inspection_report_add->item_date_receive->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->Date_Finished->Visible) { // Date_Finished ?>
	<div id="r_Date_Finished" class="form-group row">
		<label id="elh_inspection_report_Date_Finished" for="x_Date_Finished" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->Date_Finished->caption() ?><?php echo $inspection_report_add->Date_Finished->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->Date_Finished->cellAttributes() ?>>
<span id="el_inspection_report_Date_Finished">
<input type="text" data-table="inspection_report" data-field="x_Date_Finished" name="x_Date_Finished" id="x_Date_Finished" maxlength="10" placeholder="<?php echo HtmlEncode($inspection_report_add->Date_Finished->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->Date_Finished->EditValue ?>"<?php echo $inspection_report_add->Date_Finished->editAttributes() ?>>
<?php if (!$inspection_report_add->Date_Finished->ReadOnly && !$inspection_report_add->Date_Finished->Disabled && !isset($inspection_report_add->Date_Finished->EditAttrs["readonly"]) && !isset($inspection_report_add->Date_Finished->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finspection_reportadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finspection_reportadd", "x_Date_Finished", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $inspection_report_add->Date_Finished->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_date_pullout->Visible) { // item_date_pullout ?>
	<div id="r_item_date_pullout" class="form-group row">
		<label id="elh_inspection_report_item_date_pullout" for="x_item_date_pullout" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_date_pullout->caption() ?><?php echo $inspection_report_add->item_date_pullout->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_date_pullout->cellAttributes() ?>>
<span id="el_inspection_report_item_date_pullout">
<input type="text" data-table="inspection_report" data-field="x_item_date_pullout" name="x_item_date_pullout" id="x_item_date_pullout" maxlength="10" placeholder="<?php echo HtmlEncode($inspection_report_add->item_date_pullout->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->item_date_pullout->EditValue ?>"<?php echo $inspection_report_add->item_date_pullout->editAttributes() ?>>
<?php if (!$inspection_report_add->item_date_pullout->ReadOnly && !$inspection_report_add->item_date_pullout->Disabled && !isset($inspection_report_add->item_date_pullout->EditAttrs["readonly"]) && !isset($inspection_report_add->item_date_pullout->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finspection_reportadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finspection_reportadd", "x_item_date_pullout", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $inspection_report_add->item_date_pullout->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->__Request->Visible) { // Request ?>
	<div id="r___Request" class="form-group row">
		<label id="elh_inspection_report___Request" for="x___Request" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->__Request->caption() ?><?php echo $inspection_report_add->__Request->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->__Request->cellAttributes() ?>>
<span id="el_inspection_report___Request">
<input type="text" data-table="inspection_report" data-field="x___Request" name="x___Request" id="x___Request" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->__Request->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->__Request->EditValue ?>"<?php echo $inspection_report_add->__Request->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->__Request->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label id="elh_inspection_report_item_type" for="x_item_type" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_type->caption() ?><?php echo $inspection_report_add->item_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_type->cellAttributes() ?>>
<span id="el_inspection_report_item_type">
<input type="text" data-table="inspection_report" data-field="x_item_type" name="x_item_type" id="x_item_type" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inspection_report_add->item_type->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->item_type->EditValue ?>"<?php echo $inspection_report_add->item_type->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->item_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->item_requested_unit->Visible) { // item_requested_unit ?>
	<div id="r_item_requested_unit" class="form-group row">
		<label id="elh_inspection_report_item_requested_unit" for="x_item_requested_unit" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->item_requested_unit->caption() ?><?php echo $inspection_report_add->item_requested_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->item_requested_unit->cellAttributes() ?>>
<span id="el_inspection_report_item_requested_unit">
<input type="text" data-table="inspection_report" data-field="x_item_requested_unit" name="x_item_requested_unit" id="x_item_requested_unit" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inspection_report_add->item_requested_unit->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->item_requested_unit->EditValue ?>"<?php echo $inspection_report_add->item_requested_unit->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->item_requested_unit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_inspection_report_Region" for="x_Region" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->Region->caption() ?><?php echo $inspection_report_add->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->Region->cellAttributes() ?>>
<span id="el_inspection_report_Region">
<input type="text" data-table="inspection_report" data-field="x_Region" name="x_Region" id="x_Region" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->Region->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->Region->EditValue ?>"<?php echo $inspection_report_add->Region->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->Province->Visible) { // Province ?>
	<div id="r_Province" class="form-group row">
		<label id="elh_inspection_report_Province" for="x_Province" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->Province->caption() ?><?php echo $inspection_report_add->Province->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->Province->cellAttributes() ?>>
<span id="el_inspection_report_Province">
<input type="text" data-table="inspection_report" data-field="x_Province" name="x_Province" id="x_Province" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->Province->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->Province->EditValue ?>"<?php echo $inspection_report_add->Province->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->Province->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->Cities->Visible) { // Cities ?>
	<div id="r_Cities" class="form-group row">
		<label id="elh_inspection_report_Cities" for="x_Cities" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->Cities->caption() ?><?php echo $inspection_report_add->Cities->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->Cities->cellAttributes() ?>>
<span id="el_inspection_report_Cities">
<input type="text" data-table="inspection_report" data-field="x_Cities" name="x_Cities" id="x_Cities" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->Cities->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->Cities->EditValue ?>"<?php echo $inspection_report_add->Cities->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->Cities->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->technician_name->Visible) { // technician_name ?>
	<div id="r_technician_name" class="form-group row">
		<label id="elh_inspection_report_technician_name" for="x_technician_name" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->technician_name->caption() ?><?php echo $inspection_report_add->technician_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->technician_name->cellAttributes() ?>>
<span id="el_inspection_report_technician_name">
<input type="text" data-table="inspection_report" data-field="x_technician_name" name="x_technician_name" id="x_technician_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inspection_report_add->technician_name->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->technician_name->EditValue ?>"<?php echo $inspection_report_add->technician_name->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->technician_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_inspection_report_employeeid" for="x_employeeid" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->employeeid->caption() ?><?php echo $inspection_report_add->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->employeeid->cellAttributes() ?>>
<span id="el_inspection_report_employeeid">
<input type="text" data-table="inspection_report" data-field="x_employeeid" name="x_employeeid" id="x_employeeid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->employeeid->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->employeeid->EditValue ?>"<?php echo $inspection_report_add->employeeid->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group row">
		<label id="elh_inspection_report_status_id" for="x_status_id" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->status_id->caption() ?><?php echo $inspection_report_add->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->status_id->cellAttributes() ?>>
<span id="el_inspection_report_status_id">
<input type="text" data-table="inspection_report" data-field="x_status_id" name="x_status_id" id="x_status_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->status_id->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->status_id->EditValue ?>"<?php echo $inspection_report_add->status_id->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->Contact_no->Visible) { // Contact_no ?>
	<div id="r_Contact_no" class="form-group row">
		<label id="elh_inspection_report_Contact_no" for="x_Contact_no" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->Contact_no->caption() ?><?php echo $inspection_report_add->Contact_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->Contact_no->cellAttributes() ?>>
<span id="el_inspection_report_Contact_no">
<input type="text" data-table="inspection_report" data-field="x_Contact_no" name="x_Contact_no" id="x_Contact_no" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($inspection_report_add->Contact_no->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->Contact_no->EditValue ?>"<?php echo $inspection_report_add->Contact_no->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->Contact_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->user_last_modify->Visible) { // user_last_modify ?>
	<div id="r_user_last_modify" class="form-group row">
		<label id="elh_inspection_report_user_last_modify" for="x_user_last_modify" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->user_last_modify->caption() ?><?php echo $inspection_report_add->user_last_modify->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->user_last_modify->cellAttributes() ?>>
<span id="el_inspection_report_user_last_modify">
<input type="text" data-table="inspection_report" data-field="x_user_last_modify" name="x_user_last_modify" id="x_user_last_modify" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($inspection_report_add->user_last_modify->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->user_last_modify->EditValue ?>"<?php echo $inspection_report_add->user_last_modify->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->user_last_modify->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->date_last_modify->Visible) { // date_last_modify ?>
	<div id="r_date_last_modify" class="form-group row">
		<label id="elh_inspection_report_date_last_modify" for="x_date_last_modify" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->date_last_modify->caption() ?><?php echo $inspection_report_add->date_last_modify->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->date_last_modify->cellAttributes() ?>>
<span id="el_inspection_report_date_last_modify">
<input type="text" data-table="inspection_report" data-field="x_date_last_modify" name="x_date_last_modify" id="x_date_last_modify" maxlength="19" placeholder="<?php echo HtmlEncode($inspection_report_add->date_last_modify->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->date_last_modify->EditValue ?>"<?php echo $inspection_report_add->date_last_modify->editAttributes() ?>>
<?php if (!$inspection_report_add->date_last_modify->ReadOnly && !$inspection_report_add->date_last_modify->Disabled && !isset($inspection_report_add->date_last_modify->EditAttrs["readonly"]) && !isset($inspection_report_add->date_last_modify->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finspection_reportadd", "datetimepicker"], function() {
	ew.createDateTimePicker("finspection_reportadd", "x_date_last_modify", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $inspection_report_add->date_last_modify->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inspection_report_add->inventory_idt->Visible) { // inventory_idt ?>
	<div id="r_inventory_idt" class="form-group row">
		<label id="elh_inspection_report_inventory_idt" for="x_inventory_idt" class="<?php echo $inspection_report_add->LeftColumnClass ?>"><?php echo $inspection_report_add->inventory_idt->caption() ?><?php echo $inspection_report_add->inventory_idt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inspection_report_add->RightColumnClass ?>"><div <?php echo $inspection_report_add->inventory_idt->cellAttributes() ?>>
<span id="el_inspection_report_inventory_idt">
<input type="text" data-table="inspection_report" data-field="x_inventory_idt" name="x_inventory_idt" id="x_inventory_idt" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($inspection_report_add->inventory_idt->getPlaceHolder()) ?>" value="<?php echo $inspection_report_add->inventory_idt->EditValue ?>"<?php echo $inspection_report_add->inventory_idt->editAttributes() ?>>
</span>
<?php echo $inspection_report_add->inventory_idt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inspection_report_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inspection_report_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inspection_report_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inspection_report_add->showPageFooter();
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
$inspection_report_add->terminate();
?>