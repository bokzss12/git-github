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
$ticket_view2_add = new ticket_view2_add();

// Run the page
$ticket_view2_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_view2_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_view2add, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fticket_view2add = currentForm = new ew.Form("fticket_view2add", "add");

	// Validate form
	fticket_view2add.validate = function() {
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
			<?php if ($ticket_view2_add->SRN->Required) { ?>
				elm = this.getElements("x" + infix + "_SRN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->SRN->caption(), $ticket_view2_add->SRN->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->__Request->Required) { ?>
				elm = this.getElements("x" + infix + "___Request");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->__Request->caption(), $ticket_view2_add->__Request->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->month->Required) { ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->month->caption(), $ticket_view2_add->month->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->Year->Required) { ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->Year->caption(), $ticket_view2_add->Year->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_date_receive->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_date_receive->caption(), $ticket_view2_add->item_date_receive->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_view2_add->item_date_receive->errorMessage()) ?>");
			<?php if ($ticket_view2_add->item_date_repaired->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_repaired");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_date_repaired->caption(), $ticket_view2_add->item_date_repaired->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_repaired");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_view2_add->item_date_repaired->errorMessage()) ?>");
			<?php if ($ticket_view2_add->technician_name->Required) { ?>
				elm = this.getElements("x" + infix + "_technician_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->technician_name->caption(), $ticket_view2_add->technician_name->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_technician_name");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_view2_add->technician_name->errorMessage()) ?>");
			<?php if ($ticket_view2_add->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->employeeid->caption(), $ticket_view2_add->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_requested_unit->Required) { ?>
				elm = this.getElements("x" + infix + "_item_requested_unit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_requested_unit->caption(), $ticket_view2_add->item_requested_unit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_transmittal->Required) { ?>
				elm = this.getElements("x" + infix + "_item_transmittal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_transmittal->caption(), $ticket_view2_add->item_transmittal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->position->Required) { ?>
				elm = this.getElements("x" + infix + "_position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->position->caption(), $ticket_view2_add->position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->Contact_no->Required) { ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->Contact_no->caption(), $ticket_view2_add->Contact_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_view2_add->Contact_no->errorMessage()) ?>");
			<?php if ($ticket_view2_add->item_type->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_type->caption(), $ticket_view2_add->item_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_model->Required) { ?>
				elm = this.getElements("x" + infix + "_item_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_model->caption(), $ticket_view2_add->item_model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_serno->Required) { ?>
				elm = this.getElements("x" + infix + "_item_serno");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_serno->caption(), $ticket_view2_add->item_serno->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->Region->caption(), $ticket_view2_add->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->Province->Required) { ?>
				elm = this.getElements("x" + infix + "_Province");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->Province->caption(), $ticket_view2_add->Province->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->Cities->Required) { ?>
				elm = this.getElements("x" + infix + "_Cities");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->Cities->caption(), $ticket_view2_add->Cities->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_type_problem->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type_problem");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_type_problem->caption(), $ticket_view2_add->item_type_problem->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_action_taken->Required) { ?>
				elm = this.getElements("x" + infix + "_item_action_taken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_action_taken->caption(), $ticket_view2_add->item_action_taken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->item_date_pullout->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_pullout");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->item_date_pullout->caption(), $ticket_view2_add->item_date_pullout->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_pullout");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_view2_add->item_date_pullout->errorMessage()) ?>");
			<?php if ($ticket_view2_add->status_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_status_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->status_desc->caption(), $ticket_view2_add->status_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_view2_add->remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_view2_add->remarks->caption(), $ticket_view2_add->remarks->RequiredErrorMessage)) ?>");
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
	fticket_view2add.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticket_view2add.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fticket_view2add.lists["x___Request"] = <?php echo $ticket_view2_add->__Request->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x___Request"].options = <?php echo JsonEncode($ticket_view2_add->__Request->lookupOptions()) ?>;
	fticket_view2add.lists["x_month"] = <?php echo $ticket_view2_add->month->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_month"].options = <?php echo JsonEncode($ticket_view2_add->month->lookupOptions()) ?>;
	fticket_view2add.lists["x_Year"] = <?php echo $ticket_view2_add->Year->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_Year"].options = <?php echo JsonEncode($ticket_view2_add->Year->lookupOptions()) ?>;
	fticket_view2add.autoSuggests["x_Year"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fticket_view2add.lists["x_technician_name"] = <?php echo $ticket_view2_add->technician_name->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_technician_name"].options = <?php echo JsonEncode($ticket_view2_add->technician_name->lookupOptions()) ?>;
	fticket_view2add.autoSuggests["x_technician_name"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fticket_view2add.lists["x_employeeid"] = <?php echo $ticket_view2_add->employeeid->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_employeeid"].options = <?php echo JsonEncode($ticket_view2_add->employeeid->lookupOptions()) ?>;
	fticket_view2add.lists["x_item_requested_unit"] = <?php echo $ticket_view2_add->item_requested_unit->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_item_requested_unit"].options = <?php echo JsonEncode($ticket_view2_add->item_requested_unit->lookupOptions()) ?>;
	fticket_view2add.lists["x_item_type"] = <?php echo $ticket_view2_add->item_type->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_item_type"].options = <?php echo JsonEncode($ticket_view2_add->item_type->lookupOptions()) ?>;
	fticket_view2add.lists["x_Region"] = <?php echo $ticket_view2_add->Region->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_Region"].options = <?php echo JsonEncode($ticket_view2_add->Region->lookupOptions()) ?>;
	fticket_view2add.lists["x_Province"] = <?php echo $ticket_view2_add->Province->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_Province"].options = <?php echo JsonEncode($ticket_view2_add->Province->lookupOptions()) ?>;
	fticket_view2add.lists["x_Cities"] = <?php echo $ticket_view2_add->Cities->Lookup->toClientList($ticket_view2_add) ?>;
	fticket_view2add.lists["x_Cities"].options = <?php echo JsonEncode($ticket_view2_add->Cities->lookupOptions()) ?>;
	loadjs.done("fticket_view2add");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_view2_add->showPageHeader(); ?>
<?php
$ticket_view2_add->showMessage();
?>
<form name="fticket_view2add" id="fticket_view2add" class="<?php echo $ticket_view2_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_view2">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_view2_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ticket_view2_add->SRN->Visible) { // SRN ?>
	<div id="r_SRN" class="form-group row">
		<label id="elh_ticket_view2_SRN" for="x_SRN" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->SRN->caption() ?><?php echo $ticket_view2_add->SRN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->SRN->cellAttributes() ?>>
<span id="el_ticket_view2_SRN">
<input type="text" data-table="ticket_view2" data-field="x_SRN" name="x_SRN" id="x_SRN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ticket_view2_add->SRN->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->SRN->EditValue ?>"<?php echo $ticket_view2_add->SRN->editAttributes() ?>>
</span>
<?php echo $ticket_view2_add->SRN->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->__Request->Visible) { // Request ?>
	<div id="r___Request" class="form-group row">
		<label id="elh_ticket_view2___Request" for="x___Request" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->__Request->caption() ?><?php echo $ticket_view2_add->__Request->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->__Request->cellAttributes() ?>>
<span id="el_ticket_view2___Request">
<?php $ticket_view2_add->__Request->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x___Request" data-value-separator="<?php echo $ticket_view2_add->__Request->displayValueSeparatorAttribute() ?>" id="x___Request" name="x___Request"<?php echo $ticket_view2_add->__Request->editAttributes() ?>>
			<?php echo $ticket_view2_add->__Request->selectOptionListHtml("x___Request") ?>
		</select>
</div>
<?php echo $ticket_view2_add->__Request->Lookup->getParamTag($ticket_view2_add, "p_x___Request") ?>
</span>
<?php echo $ticket_view2_add->__Request->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->month->Visible) { // month ?>
	<div id="r_month" class="form-group row">
		<label id="elh_ticket_view2_month" for="x_month" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->month->caption() ?><?php echo $ticket_view2_add->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->month->cellAttributes() ?>>
<span id="el_ticket_view2_month">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x_month" data-value-separator="<?php echo $ticket_view2_add->month->displayValueSeparatorAttribute() ?>" id="x_month" name="x_month"<?php echo $ticket_view2_add->month->editAttributes() ?>>
			<?php echo $ticket_view2_add->month->selectOptionListHtml("x_month") ?>
		</select>
</div>
<?php echo $ticket_view2_add->month->Lookup->getParamTag($ticket_view2_add, "p_x_month") ?>
</span>
<?php echo $ticket_view2_add->month->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->Year->Visible) { // Year ?>
	<div id="r_Year" class="form-group row">
		<label id="elh_ticket_view2_Year" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->Year->caption() ?><?php echo $ticket_view2_add->Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->Year->cellAttributes() ?>>
<span id="el_ticket_view2_Year">
<?php
$onchange = $ticket_view2_add->Year->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ticket_view2_add->Year->EditAttrs["onchange"] = "";
?>
<span id="as_x_Year">
	<input type="text" class="form-control" name="sv_x_Year" id="sv_x_Year" value="<?php echo RemoveHtml($ticket_view2_add->Year->EditValue) ?>" size="10" placeholder="<?php echo HtmlEncode($ticket_view2_add->Year->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ticket_view2_add->Year->getPlaceHolder()) ?>"<?php echo $ticket_view2_add->Year->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticket_view2" data-field="x_Year" data-value-separator="<?php echo $ticket_view2_add->Year->displayValueSeparatorAttribute() ?>" name="x_Year" id="x_Year" value="<?php echo HtmlEncode($ticket_view2_add->Year->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fticket_view2add"], function() {
	fticket_view2add.createAutoSuggest({"id":"x_Year","forceSelect":true});
});
</script>
<?php echo $ticket_view2_add->Year->Lookup->getParamTag($ticket_view2_add, "p_x_Year") ?>
</span>
<?php echo $ticket_view2_add->Year->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_date_receive->Visible) { // item_date_receive ?>
	<div id="r_item_date_receive" class="form-group row">
		<label id="elh_ticket_view2_item_date_receive" for="x_item_date_receive" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_date_receive->caption() ?><?php echo $ticket_view2_add->item_date_receive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_date_receive->cellAttributes() ?>>
<span id="el_ticket_view2_item_date_receive">
<input type="text" data-table="ticket_view2" data-field="x_item_date_receive" data-format="5" name="x_item_date_receive" id="x_item_date_receive" size="70" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_date_receive->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->item_date_receive->EditValue ?>"<?php echo $ticket_view2_add->item_date_receive->editAttributes() ?>>
<?php if (!$ticket_view2_add->item_date_receive->ReadOnly && !$ticket_view2_add->item_date_receive->Disabled && !isset($ticket_view2_add->item_date_receive->EditAttrs["readonly"]) && !isset($ticket_view2_add->item_date_receive->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticket_view2add", "datetimepicker"], function() {
	ew.createDateTimePicker("fticket_view2add", "x_item_date_receive", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_view2_add->item_date_receive->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_date_repaired->Visible) { // item_date_repaired ?>
	<div id="r_item_date_repaired" class="form-group row">
		<label id="elh_ticket_view2_item_date_repaired" for="x_item_date_repaired" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_date_repaired->caption() ?><?php echo $ticket_view2_add->item_date_repaired->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_date_repaired->cellAttributes() ?>>
<span id="el_ticket_view2_item_date_repaired">
<input type="text" data-table="ticket_view2" data-field="x_item_date_repaired" data-format="1" name="x_item_date_repaired" id="x_item_date_repaired" size="70" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_date_repaired->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->item_date_repaired->EditValue ?>"<?php echo $ticket_view2_add->item_date_repaired->editAttributes() ?>>
<?php if (!$ticket_view2_add->item_date_repaired->ReadOnly && !$ticket_view2_add->item_date_repaired->Disabled && !isset($ticket_view2_add->item_date_repaired->EditAttrs["readonly"]) && !isset($ticket_view2_add->item_date_repaired->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticket_view2add", "datetimepicker"], function() {
	ew.createDateTimePicker("fticket_view2add", "x_item_date_repaired", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_view2_add->item_date_repaired->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->technician_name->Visible) { // technician_name ?>
	<div id="r_technician_name" class="form-group row">
		<label id="elh_ticket_view2_technician_name" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->technician_name->caption() ?><?php echo $ticket_view2_add->technician_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->technician_name->cellAttributes() ?>>
<span id="el_ticket_view2_technician_name">
<?php
$onchange = $ticket_view2_add->technician_name->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ticket_view2_add->technician_name->EditAttrs["onchange"] = "";
?>
<span id="as_x_technician_name">
	<input type="text" class="form-control" name="sv_x_technician_name" id="sv_x_technician_name" value="<?php echo RemoveHtml($ticket_view2_add->technician_name->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ticket_view2_add->technician_name->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ticket_view2_add->technician_name->getPlaceHolder()) ?>"<?php echo $ticket_view2_add->technician_name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticket_view2" data-field="x_technician_name" data-value-separator="<?php echo $ticket_view2_add->technician_name->displayValueSeparatorAttribute() ?>" name="x_technician_name" id="x_technician_name" value="<?php echo HtmlEncode($ticket_view2_add->technician_name->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fticket_view2add"], function() {
	fticket_view2add.createAutoSuggest({"id":"x_technician_name","forceSelect":false});
});
</script>
<?php echo $ticket_view2_add->technician_name->Lookup->getParamTag($ticket_view2_add, "p_x_technician_name") ?>
</span>
<?php echo $ticket_view2_add->technician_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_ticket_view2_employeeid" for="x_employeeid" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->employeeid->caption() ?><?php echo $ticket_view2_add->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->employeeid->cellAttributes() ?>>
<span id="el_ticket_view2_employeeid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x_employeeid" data-value-separator="<?php echo $ticket_view2_add->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $ticket_view2_add->employeeid->editAttributes() ?>>
			<?php echo $ticket_view2_add->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $ticket_view2_add->employeeid->Lookup->getParamTag($ticket_view2_add, "p_x_employeeid") ?>
</span>
<?php echo $ticket_view2_add->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_requested_unit->Visible) { // item_requested_unit ?>
	<div id="r_item_requested_unit" class="form-group row">
		<label id="elh_ticket_view2_item_requested_unit" for="x_item_requested_unit" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_requested_unit->caption() ?><?php echo $ticket_view2_add->item_requested_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_requested_unit->cellAttributes() ?>>
<span id="el_ticket_view2_item_requested_unit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x_item_requested_unit" data-value-separator="<?php echo $ticket_view2_add->item_requested_unit->displayValueSeparatorAttribute() ?>" id="x_item_requested_unit" name="x_item_requested_unit"<?php echo $ticket_view2_add->item_requested_unit->editAttributes() ?>>
			<?php echo $ticket_view2_add->item_requested_unit->selectOptionListHtml("x_item_requested_unit") ?>
		</select>
</div>
<?php echo $ticket_view2_add->item_requested_unit->Lookup->getParamTag($ticket_view2_add, "p_x_item_requested_unit") ?>
</span>
<?php echo $ticket_view2_add->item_requested_unit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_transmittal->Visible) { // item_transmittal ?>
	<div id="r_item_transmittal" class="form-group row">
		<label id="elh_ticket_view2_item_transmittal" for="x_item_transmittal" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_transmittal->caption() ?><?php echo $ticket_view2_add->item_transmittal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_transmittal->cellAttributes() ?>>
<span id="el_ticket_view2_item_transmittal">
<input type="text" data-table="ticket_view2" data-field="x_item_transmittal" name="x_item_transmittal" id="x_item_transmittal" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_transmittal->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->item_transmittal->EditValue ?>"<?php echo $ticket_view2_add->item_transmittal->editAttributes() ?>>
</span>
<?php echo $ticket_view2_add->item_transmittal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->position->Visible) { // position ?>
	<div id="r_position" class="form-group row">
		<label id="elh_ticket_view2_position" for="x_position" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->position->caption() ?><?php echo $ticket_view2_add->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->position->cellAttributes() ?>>
<span id="el_ticket_view2_position">
<input type="text" data-table="ticket_view2" data-field="x_position" name="x_position" id="x_position" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ticket_view2_add->position->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->position->EditValue ?>"<?php echo $ticket_view2_add->position->editAttributes() ?>>
</span>
<?php echo $ticket_view2_add->position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->Contact_no->Visible) { // Contact_no ?>
	<div id="r_Contact_no" class="form-group row">
		<label id="elh_ticket_view2_Contact_no" for="x_Contact_no" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->Contact_no->caption() ?><?php echo $ticket_view2_add->Contact_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->Contact_no->cellAttributes() ?>>
<span id="el_ticket_view2_Contact_no">
<input type="text" data-table="ticket_view2" data-field="x_Contact_no" name="x_Contact_no" id="x_Contact_no" size="70" placeholder="<?php echo HtmlEncode($ticket_view2_add->Contact_no->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->Contact_no->EditValue ?>"<?php echo $ticket_view2_add->Contact_no->editAttributes() ?>>
</span>
<?php echo $ticket_view2_add->Contact_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label id="elh_ticket_view2_item_type" for="x_item_type" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_type->caption() ?><?php echo $ticket_view2_add->item_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_type->cellAttributes() ?>>
<span id="el_ticket_view2_item_type">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x_item_type" data-value-separator="<?php echo $ticket_view2_add->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $ticket_view2_add->item_type->editAttributes() ?>>
			<?php echo $ticket_view2_add->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $ticket_view2_add->item_type->Lookup->getParamTag($ticket_view2_add, "p_x_item_type") ?>
</span>
<?php echo $ticket_view2_add->item_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label id="elh_ticket_view2_item_model" for="x_item_model" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_model->caption() ?><?php echo $ticket_view2_add->item_model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_model->cellAttributes() ?>>
<span id="el_ticket_view2_item_model">
<input type="text" data-table="ticket_view2" data-field="x_item_model" name="x_item_model" id="x_item_model" size="70" maxlength="50" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_model->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->item_model->EditValue ?>"<?php echo $ticket_view2_add->item_model->editAttributes() ?>>
</span>
<?php echo $ticket_view2_add->item_model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_serno->Visible) { // item_serno ?>
	<div id="r_item_serno" class="form-group row">
		<label id="elh_ticket_view2_item_serno" for="x_item_serno" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_serno->caption() ?><?php echo $ticket_view2_add->item_serno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_serno->cellAttributes() ?>>
<span id="el_ticket_view2_item_serno">
<input type="text" data-table="ticket_view2" data-field="x_item_serno" name="x_item_serno" id="x_item_serno" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_serno->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->item_serno->EditValue ?>"<?php echo $ticket_view2_add->item_serno->editAttributes() ?>>
</span>
<?php echo $ticket_view2_add->item_serno->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_ticket_view2_Region" for="x_Region" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->Region->caption() ?><?php echo $ticket_view2_add->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->Region->cellAttributes() ?>>
<span id="el_ticket_view2_Region">
<?php $ticket_view2_add->Region->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x_Region" data-value-separator="<?php echo $ticket_view2_add->Region->displayValueSeparatorAttribute() ?>" id="x_Region" name="x_Region"<?php echo $ticket_view2_add->Region->editAttributes() ?>>
			<?php echo $ticket_view2_add->Region->selectOptionListHtml("x_Region") ?>
		</select>
</div>
<?php echo $ticket_view2_add->Region->Lookup->getParamTag($ticket_view2_add, "p_x_Region") ?>
</span>
<?php echo $ticket_view2_add->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->Province->Visible) { // Province ?>
	<div id="r_Province" class="form-group row">
		<label id="elh_ticket_view2_Province" for="x_Province" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->Province->caption() ?><?php echo $ticket_view2_add->Province->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->Province->cellAttributes() ?>>
<span id="el_ticket_view2_Province">
<?php $ticket_view2_add->Province->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x_Province" data-value-separator="<?php echo $ticket_view2_add->Province->displayValueSeparatorAttribute() ?>" id="x_Province" name="x_Province"<?php echo $ticket_view2_add->Province->editAttributes() ?>>
			<?php echo $ticket_view2_add->Province->selectOptionListHtml("x_Province") ?>
		</select>
</div>
<?php echo $ticket_view2_add->Province->Lookup->getParamTag($ticket_view2_add, "p_x_Province") ?>
</span>
<?php echo $ticket_view2_add->Province->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->Cities->Visible) { // Cities ?>
	<div id="r_Cities" class="form-group row">
		<label id="elh_ticket_view2_Cities" for="x_Cities" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->Cities->caption() ?><?php echo $ticket_view2_add->Cities->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->Cities->cellAttributes() ?>>
<span id="el_ticket_view2_Cities">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_view2" data-field="x_Cities" data-value-separator="<?php echo $ticket_view2_add->Cities->displayValueSeparatorAttribute() ?>" id="x_Cities" name="x_Cities"<?php echo $ticket_view2_add->Cities->editAttributes() ?>>
			<?php echo $ticket_view2_add->Cities->selectOptionListHtml("x_Cities") ?>
		</select>
</div>
<?php echo $ticket_view2_add->Cities->Lookup->getParamTag($ticket_view2_add, "p_x_Cities") ?>
</span>
<?php echo $ticket_view2_add->Cities->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_type_problem->Visible) { // item_type_problem ?>
	<div id="r_item_type_problem" class="form-group row">
		<label id="elh_ticket_view2_item_type_problem" for="x_item_type_problem" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_type_problem->caption() ?><?php echo $ticket_view2_add->item_type_problem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_type_problem->cellAttributes() ?>>
<span id="el_ticket_view2_item_type_problem">
<textarea data-table="ticket_view2" data-field="x_item_type_problem" name="x_item_type_problem" id="x_item_type_problem" cols="70" rows="5" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_type_problem->getPlaceHolder()) ?>"<?php echo $ticket_view2_add->item_type_problem->editAttributes() ?>><?php echo $ticket_view2_add->item_type_problem->EditValue ?></textarea>
</span>
<?php echo $ticket_view2_add->item_type_problem->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_action_taken->Visible) { // item_action_taken ?>
	<div id="r_item_action_taken" class="form-group row">
		<label id="elh_ticket_view2_item_action_taken" for="x_item_action_taken" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_action_taken->caption() ?><?php echo $ticket_view2_add->item_action_taken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_action_taken->cellAttributes() ?>>
<span id="el_ticket_view2_item_action_taken">
<textarea data-table="ticket_view2" data-field="x_item_action_taken" name="x_item_action_taken" id="x_item_action_taken" cols="70" rows="5" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_action_taken->getPlaceHolder()) ?>"<?php echo $ticket_view2_add->item_action_taken->editAttributes() ?>><?php echo $ticket_view2_add->item_action_taken->EditValue ?></textarea>
</span>
<?php echo $ticket_view2_add->item_action_taken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->item_date_pullout->Visible) { // item_date_pullout ?>
	<div id="r_item_date_pullout" class="form-group row">
		<label id="elh_ticket_view2_item_date_pullout" for="x_item_date_pullout" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->item_date_pullout->caption() ?><?php echo $ticket_view2_add->item_date_pullout->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->item_date_pullout->cellAttributes() ?>>
<span id="el_ticket_view2_item_date_pullout">
<input type="text" data-table="ticket_view2" data-field="x_item_date_pullout" data-format="1" name="x_item_date_pullout" id="x_item_date_pullout" placeholder="<?php echo HtmlEncode($ticket_view2_add->item_date_pullout->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->item_date_pullout->EditValue ?>"<?php echo $ticket_view2_add->item_date_pullout->editAttributes() ?>>
<?php if (!$ticket_view2_add->item_date_pullout->ReadOnly && !$ticket_view2_add->item_date_pullout->Disabled && !isset($ticket_view2_add->item_date_pullout->EditAttrs["readonly"]) && !isset($ticket_view2_add->item_date_pullout->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticket_view2add", "datetimepicker"], function() {
	ew.createDateTimePicker("fticket_view2add", "x_item_date_pullout", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_view2_add->item_date_pullout->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->status_desc->Visible) { // status_desc ?>
	<div id="r_status_desc" class="form-group row">
		<label id="elh_ticket_view2_status_desc" for="x_status_desc" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->status_desc->caption() ?><?php echo $ticket_view2_add->status_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->status_desc->cellAttributes() ?>>
<span id="el_ticket_view2_status_desc">
<input type="text" data-table="ticket_view2" data-field="x_status_desc" name="x_status_desc" id="x_status_desc" size="70" maxlength="30" placeholder="<?php echo HtmlEncode($ticket_view2_add->status_desc->getPlaceHolder()) ?>" value="<?php echo $ticket_view2_add->status_desc->EditValue ?>"<?php echo $ticket_view2_add->status_desc->editAttributes() ?>>
</span>
<?php echo $ticket_view2_add->status_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_view2_add->remarks->Visible) { // remarks ?>
	<div id="r_remarks" class="form-group row">
		<label id="elh_ticket_view2_remarks" for="x_remarks" class="<?php echo $ticket_view2_add->LeftColumnClass ?>"><?php echo $ticket_view2_add->remarks->caption() ?><?php echo $ticket_view2_add->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_view2_add->RightColumnClass ?>"><div <?php echo $ticket_view2_add->remarks->cellAttributes() ?>>
<span id="el_ticket_view2_remarks">
<textarea data-table="ticket_view2" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="70" rows="5" placeholder="<?php echo HtmlEncode($ticket_view2_add->remarks->getPlaceHolder()) ?>"<?php echo $ticket_view2_add->remarks->editAttributes() ?>><?php echo $ticket_view2_add->remarks->EditValue ?></textarea>
</span>
<?php echo $ticket_view2_add->remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticket_view2_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_view2_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_view2_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ticket_view2_add->showPageFooter();
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
$ticket_view2_add->terminate();
?>