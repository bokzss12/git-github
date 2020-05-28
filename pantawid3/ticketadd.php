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
$ticket_add = new ticket_add();

// Run the page
$ticket_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fticketadd = currentForm = new ew.Form("fticketadd", "add");

	// Validate form
	fticketadd.validate = function() {
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
			<?php if ($ticket_add->__Request->Required) { ?>
				elm = this.getElements("x" + infix + "___Request");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->__Request->caption(), $ticket_add->__Request->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->item_date_receive->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->item_date_receive->caption(), $ticket_add->item_date_receive->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->item_date_receive->errorMessage()) ?>");
			<?php if ($ticket_add->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->employeeid->caption(), $ticket_add->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->item_requested_unit->Required) { ?>
				elm = this.getElements("x" + infix + "_item_requested_unit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->item_requested_unit->caption(), $ticket_add->item_requested_unit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->item_transmittal->Required) { ?>
				elm = this.getElements("x" + infix + "_item_transmittal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->item_transmittal->caption(), $ticket_add->item_transmittal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->position->Required) { ?>
				elm = this.getElements("x" + infix + "_position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->position->caption(), $ticket_add->position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->Contact_no->Required) { ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->Contact_no->caption(), $ticket_add->Contact_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->Contact_no->errorMessage()) ?>");
			<?php if ($ticket_add->item_type->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->item_type->caption(), $ticket_add->item_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->item_model->Required) { ?>
				elm = this.getElements("x" + infix + "_item_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->item_model->caption(), $ticket_add->item_model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->item_serno->Required) { ?>
				elm = this.getElements("x" + infix + "_item_serno");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->item_serno->caption(), $ticket_add->item_serno->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->item_type_problem->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type_problem");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->item_type_problem->caption(), $ticket_add->item_type_problem->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->status_id->Required) { ?>
				elm = this.getElements("x" + infix + "_status_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->status_id->caption(), $ticket_add->status_id->RequiredErrorMessage)) ?>");
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
	fticketadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticketadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fticketadd.lists["x___Request"] = <?php echo $ticket_add->__Request->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x___Request"].options = <?php echo JsonEncode($ticket_add->__Request->lookupOptions()) ?>;
	fticketadd.lists["x_employeeid"] = <?php echo $ticket_add->employeeid->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_employeeid"].options = <?php echo JsonEncode($ticket_add->employeeid->lookupOptions()) ?>;
	fticketadd.lists["x_item_requested_unit"] = <?php echo $ticket_add->item_requested_unit->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_item_requested_unit"].options = <?php echo JsonEncode($ticket_add->item_requested_unit->lookupOptions()) ?>;
	fticketadd.lists["x_item_type"] = <?php echo $ticket_add->item_type->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_item_type"].options = <?php echo JsonEncode($ticket_add->item_type->lookupOptions()) ?>;
	fticketadd.lists["x_status_id"] = <?php echo $ticket_add->status_id->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_status_id"].options = <?php echo JsonEncode($ticket_add->status_id->lookupOptions()) ?>;
	loadjs.done("fticketadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_add->showPageHeader(); ?>
<?php
$ticket_add->showMessage();
?>
<form name="fticketadd" id="fticketadd" class="<?php echo $ticket_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_add->IsModal ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($ticket_add->__Request->Visible) { // Request ?>
	<div id="r___Request" class="form-group row">
		<label id="elh_ticket___Request" for="x___Request" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket___Request" type="text/html"><?php echo $ticket_add->__Request->caption() ?><?php echo $ticket_add->__Request->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->__Request->cellAttributes() ?>>
<script id="tpx_ticket___Request" type="text/html"><span id="el_ticket___Request">
<?php $ticket_add->__Request->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x___Request" data-value-separator="<?php echo $ticket_add->__Request->displayValueSeparatorAttribute() ?>" id="x___Request" name="x___Request"<?php echo $ticket_add->__Request->editAttributes() ?>>
			<?php echo $ticket_add->__Request->selectOptionListHtml("x___Request") ?>
		</select>
</div>
<?php echo $ticket_add->__Request->Lookup->getParamTag($ticket_add, "p_x___Request") ?>
</span></script>
<?php echo $ticket_add->__Request->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->item_date_receive->Visible) { // item_date_receive ?>
	<div id="r_item_date_receive" class="form-group row">
		<label id="elh_ticket_item_date_receive" for="x_item_date_receive" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_item_date_receive" type="text/html"><?php echo $ticket_add->item_date_receive->caption() ?><?php echo $ticket_add->item_date_receive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->item_date_receive->cellAttributes() ?>>
<script id="tpx_ticket_item_date_receive" type="text/html"><span id="el_ticket_item_date_receive">
<input type="text" data-table="ticket" data-field="x_item_date_receive" data-format="5" name="x_item_date_receive" id="x_item_date_receive" placeholder="<?php echo HtmlEncode($ticket_add->item_date_receive->getPlaceHolder()) ?>" value="<?php echo $ticket_add->item_date_receive->EditValue ?>"<?php echo $ticket_add->item_date_receive->editAttributes() ?>>
<?php if (!$ticket_add->item_date_receive->ReadOnly && !$ticket_add->item_date_receive->Disabled && !isset($ticket_add->item_date_receive->EditAttrs["readonly"]) && !isset($ticket_add->item_date_receive->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="ticketadd_js">
loadjs.ready(["fticketadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketadd", "x_item_date_receive", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php echo $ticket_add->item_date_receive->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_ticket_employeeid" for="x_employeeid" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_employeeid" type="text/html"><?php echo $ticket_add->employeeid->caption() ?><?php echo $ticket_add->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->employeeid->cellAttributes() ?>>
<script id="tpx_ticket_employeeid" type="text/html"><span id="el_ticket_employeeid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_employeeid" data-value-separator="<?php echo $ticket_add->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $ticket_add->employeeid->editAttributes() ?>>
			<?php echo $ticket_add->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $ticket_add->employeeid->Lookup->getParamTag($ticket_add, "p_x_employeeid") ?>
</span></script>
<?php echo $ticket_add->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->item_requested_unit->Visible) { // item_requested_unit ?>
	<div id="r_item_requested_unit" class="form-group row">
		<label id="elh_ticket_item_requested_unit" for="x_item_requested_unit" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_item_requested_unit" type="text/html"><?php echo $ticket_add->item_requested_unit->caption() ?><?php echo $ticket_add->item_requested_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->item_requested_unit->cellAttributes() ?>>
<script id="tpx_ticket_item_requested_unit" type="text/html"><span id="el_ticket_item_requested_unit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_item_requested_unit" data-value-separator="<?php echo $ticket_add->item_requested_unit->displayValueSeparatorAttribute() ?>" id="x_item_requested_unit" name="x_item_requested_unit"<?php echo $ticket_add->item_requested_unit->editAttributes() ?>>
			<?php echo $ticket_add->item_requested_unit->selectOptionListHtml("x_item_requested_unit") ?>
		</select>
</div>
<?php echo $ticket_add->item_requested_unit->Lookup->getParamTag($ticket_add, "p_x_item_requested_unit") ?>
</span></script>
<?php echo $ticket_add->item_requested_unit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->item_transmittal->Visible) { // item_transmittal ?>
	<div id="r_item_transmittal" class="form-group row">
		<label id="elh_ticket_item_transmittal" for="x_item_transmittal" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_item_transmittal" type="text/html"><?php echo $ticket_add->item_transmittal->caption() ?><?php echo $ticket_add->item_transmittal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->item_transmittal->cellAttributes() ?>>
<script id="tpx_ticket_item_transmittal" type="text/html"><span id="el_ticket_item_transmittal">
<input type="text" data-table="ticket" data-field="x_item_transmittal" name="x_item_transmittal" id="x_item_transmittal" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ticket_add->item_transmittal->getPlaceHolder()) ?>" value="<?php echo $ticket_add->item_transmittal->EditValue ?>"<?php echo $ticket_add->item_transmittal->editAttributes() ?>>
</span></script>
<?php echo $ticket_add->item_transmittal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->position->Visible) { // position ?>
	<div id="r_position" class="form-group row">
		<label id="elh_ticket_position" for="x_position" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_position" type="text/html"><?php echo $ticket_add->position->caption() ?><?php echo $ticket_add->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->position->cellAttributes() ?>>
<script id="tpx_ticket_position" type="text/html"><span id="el_ticket_position">
<input type="text" data-table="ticket" data-field="x_position" name="x_position" id="x_position" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ticket_add->position->getPlaceHolder()) ?>" value="<?php echo $ticket_add->position->EditValue ?>"<?php echo $ticket_add->position->editAttributes() ?>>
</span></script>
<?php echo $ticket_add->position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->Contact_no->Visible) { // Contact_no ?>
	<div id="r_Contact_no" class="form-group row">
		<label id="elh_ticket_Contact_no" for="x_Contact_no" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_Contact_no" type="text/html"><?php echo $ticket_add->Contact_no->caption() ?><?php echo $ticket_add->Contact_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->Contact_no->cellAttributes() ?>>
<script id="tpx_ticket_Contact_no" type="text/html"><span id="el_ticket_Contact_no">
<input type="text" data-table="ticket" data-field="x_Contact_no" name="x_Contact_no" id="x_Contact_no" placeholder="<?php echo HtmlEncode($ticket_add->Contact_no->getPlaceHolder()) ?>" value="<?php echo $ticket_add->Contact_no->EditValue ?>"<?php echo $ticket_add->Contact_no->editAttributes() ?>>
</span></script>
<?php echo $ticket_add->Contact_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label id="elh_ticket_item_type" for="x_item_type" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_item_type" type="text/html"><?php echo $ticket_add->item_type->caption() ?><?php echo $ticket_add->item_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->item_type->cellAttributes() ?>>
<script id="tpx_ticket_item_type" type="text/html"><span id="el_ticket_item_type">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_item_type" data-value-separator="<?php echo $ticket_add->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $ticket_add->item_type->editAttributes() ?>>
			<?php echo $ticket_add->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $ticket_add->item_type->Lookup->getParamTag($ticket_add, "p_x_item_type") ?>
</span></script>
<?php echo $ticket_add->item_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label id="elh_ticket_item_model" for="x_item_model" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_item_model" type="text/html"><?php echo $ticket_add->item_model->caption() ?><?php echo $ticket_add->item_model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->item_model->cellAttributes() ?>>
<script id="tpx_ticket_item_model" type="text/html"><span id="el_ticket_item_model">
<input type="text" data-table="ticket" data-field="x_item_model" name="x_item_model" id="x_item_model" maxlength="50" placeholder="<?php echo HtmlEncode($ticket_add->item_model->getPlaceHolder()) ?>" value="<?php echo $ticket_add->item_model->EditValue ?>"<?php echo $ticket_add->item_model->editAttributes() ?>>
</span></script>
<?php echo $ticket_add->item_model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->item_serno->Visible) { // item_serno ?>
	<div id="r_item_serno" class="form-group row">
		<label id="elh_ticket_item_serno" for="x_item_serno" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_item_serno" type="text/html"><?php echo $ticket_add->item_serno->caption() ?><?php echo $ticket_add->item_serno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->item_serno->cellAttributes() ?>>
<script id="tpx_ticket_item_serno" type="text/html"><span id="el_ticket_item_serno">
<input type="text" data-table="ticket" data-field="x_item_serno" name="x_item_serno" id="x_item_serno" maxlength="50" placeholder="<?php echo HtmlEncode($ticket_add->item_serno->getPlaceHolder()) ?>" value="<?php echo $ticket_add->item_serno->EditValue ?>"<?php echo $ticket_add->item_serno->editAttributes() ?>>
</span></script>
<?php echo $ticket_add->item_serno->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->item_type_problem->Visible) { // item_type_problem ?>
	<div id="r_item_type_problem" class="form-group row">
		<label id="elh_ticket_item_type_problem" for="x_item_type_problem" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_item_type_problem" type="text/html"><?php echo $ticket_add->item_type_problem->caption() ?><?php echo $ticket_add->item_type_problem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->item_type_problem->cellAttributes() ?>>
<script id="tpx_ticket_item_type_problem" type="text/html"><span id="el_ticket_item_type_problem">
<textarea data-table="ticket" data-field="x_item_type_problem" name="x_item_type_problem" id="x_item_type_problem" cols="100" rows="4" placeholder="<?php echo HtmlEncode($ticket_add->item_type_problem->getPlaceHolder()) ?>"<?php echo $ticket_add->item_type_problem->editAttributes() ?>><?php echo $ticket_add->item_type_problem->EditValue ?></textarea>
</span></script>
<?php echo $ticket_add->item_type_problem->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group row">
		<label id="elh_ticket_status_id" for="x_status_id" class="<?php echo $ticket_add->LeftColumnClass ?>"><script id="tpc_ticket_status_id" type="text/html"><?php echo $ticket_add->status_id->caption() ?><?php echo $ticket_add->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->status_id->cellAttributes() ?>>
<script id="tpx_ticket_status_id" type="text/html"><span id="el_ticket_status_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_status_id" data-value-separator="<?php echo $ticket_add->status_id->displayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $ticket_add->status_id->editAttributes() ?>>
			<?php echo $ticket_add->status_id->selectOptionListHtml("x_status_id") ?>
		</select>
</div>
<?php echo $ticket_add->status_id->Lookup->getParamTag($ticket_add, "p_x_status_id") ?>
</span></script>
<?php echo $ticket_add->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_ticketadd" class="ew-custom-template"></div>
<script id="tpm_ticketadd" type="text/html">
<div id="ct_ticket_add"><!--<table class="ew-table">-->
<table style="height: 77px; float: left; width: 1450px;" border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 40px;">
<td style="width: 236px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_item_date_receive"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_item_date_receive")/}}</td>
<td style="width: 250.75px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_item_requested_unit"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_item_requested_unit")/}}</td>
<td style="width: 242.25px; height: 40px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_ticket_item_type"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_item_type")/}}</td>
<td style="width: 236px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_Contact_no"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_Contact_no")/}}</td>
</tr>
<tr style="height: 40px;">
<td style="width: 236px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_employeeid"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_employeeid")/}}</td>
<td style="width: 250.75px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_item_transmittal"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_item_transmittal")/}}</td>
<td style="width: 242.25px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_item_model"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_item_model")/}}</td>
<td style="width: 236px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket___Request"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket___Request")/}}</td>
</tr>
<tr style="height: 40px;">
<td style="width: 236px; height: 40px; text-align: left;" scope="row">&nbsp;</td>
<td style="width: 250.75px; height: 40px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_ticket_position"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_position")/}}</td>
<td style="width: 242.25px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_item_serno"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_item_serno")/}}</td>
<td style="width: 236px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_ticket_status_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_status_id")/}}</td>
</tr>
<tr style="height: 40px;">
<td style="width: 236px; height: 40px; text-align: left;" scope="row">&nbsp;</td>
<td style="width: 493px; height: 40px; text-align: left;" colspan="2" scope="row">{{include tmpl="#tpc_ticket_item_type_problem"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_ticket_item_type_problem")/}}</td>
<td style="width: 236px; height: 40px; text-align: left;" scope="row">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$ticket_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($ticket->Rows) ?> };
	ew.applyTemplate("tpd_ticketadd", "tpm_ticketadd", "ticketadd", "<?php echo $ticket->CustomExport ?>", ew.templateData.rows[0]);
	$("script.ticketadd_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$ticket_add->showPageFooter();
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
$ticket_add->terminate();
?>