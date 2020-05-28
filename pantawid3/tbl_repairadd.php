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
$tbl_repair_add = new tbl_repair_add();

// Run the page
$tbl_repair_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_repair_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_repairadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_repairadd = currentForm = new ew.Form("ftbl_repairadd", "add");

	// Validate form
	ftbl_repairadd.validate = function() {
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
			<?php if ($tbl_repair_add->inventory_id->Required) { ?>
				elm = this.getElements("x" + infix + "_inventory_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->inventory_id->caption(), $tbl_repair_add->inventory_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->current_loc_r->Required) { ?>
				elm = this.getElements("x" + infix + "_current_loc_r");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->current_loc_r->caption(), $tbl_repair_add->current_loc_r->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->inventory_idr->Required) { ?>
				elm = this.getElements("x" + infix + "_inventory_idr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->inventory_idr->caption(), $tbl_repair_add->inventory_idr->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_inventory_idr");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_repair_add->inventory_idr->errorMessage()) ?>");
			<?php if ($tbl_repair_add->date_received->Required) { ?>
				elm = this.getElements("x" + infix + "_date_received");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->date_received->caption(), $tbl_repair_add->date_received->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_received");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_repair_add->date_received->errorMessage()) ?>");
			<?php if ($tbl_repair_add->date_repaired->Required) { ?>
				elm = this.getElements("x" + infix + "_date_repaired");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->date_repaired->caption(), $tbl_repair_add->date_repaired->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_repaired");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_repair_add->date_repaired->errorMessage()) ?>");
			<?php if ($tbl_repair_add->type_problem->Required) { ?>
				elm = this.getElements("x" + infix + "_type_problem");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->type_problem->caption(), $tbl_repair_add->type_problem->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->action_taken->Required) { ?>
				elm = this.getElements("x" + infix + "_action_taken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->action_taken->caption(), $tbl_repair_add->action_taken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->employee_id->Required) { ?>
				elm = this.getElements("x" + infix + "_employee_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->employee_id->caption(), $tbl_repair_add->employee_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->status_h->Required) { ?>
				elm = this.getElements("x" + infix + "_status_h");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->status_h->caption(), $tbl_repair_add->status_h->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->pullout_r->Required) { ?>
				elm = this.getElements("x" + infix + "_pullout_r");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->pullout_r->caption(), $tbl_repair_add->pullout_r->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->remark->Required) { ?>
				elm = this.getElements("x" + infix + "_remark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->remark->caption(), $tbl_repair_add->remark->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->userlastmodify->Required) { ?>
				elm = this.getElements("x" + infix + "_userlastmodify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->userlastmodify->caption(), $tbl_repair_add->userlastmodify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_add->datelastmodify->Required) { ?>
				elm = this.getElements("x" + infix + "_datelastmodify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_add->datelastmodify->caption(), $tbl_repair_add->datelastmodify->RequiredErrorMessage)) ?>");
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
	ftbl_repairadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_repairadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_repairadd.lists["x_current_loc_r"] = <?php echo $tbl_repair_add->current_loc_r->Lookup->toClientList($tbl_repair_add) ?>;
	ftbl_repairadd.lists["x_current_loc_r"].options = <?php echo JsonEncode($tbl_repair_add->current_loc_r->lookupOptions()) ?>;
	ftbl_repairadd.lists["x_employee_id"] = <?php echo $tbl_repair_add->employee_id->Lookup->toClientList($tbl_repair_add) ?>;
	ftbl_repairadd.lists["x_employee_id"].options = <?php echo JsonEncode($tbl_repair_add->employee_id->options(FALSE, TRUE)) ?>;
	ftbl_repairadd.lists["x_status_h"] = <?php echo $tbl_repair_add->status_h->Lookup->toClientList($tbl_repair_add) ?>;
	ftbl_repairadd.lists["x_status_h"].options = <?php echo JsonEncode($tbl_repair_add->status_h->lookupOptions()) ?>;
	ftbl_repairadd.lists["x_pullout_r"] = <?php echo $tbl_repair_add->pullout_r->Lookup->toClientList($tbl_repair_add) ?>;
	ftbl_repairadd.lists["x_pullout_r"].options = <?php echo JsonEncode($tbl_repair_add->pullout_r->options(FALSE, TRUE)) ?>;
	loadjs.done("ftbl_repairadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_repair_add->showPageHeader(); ?>
<?php
$tbl_repair_add->showMessage();
?>
<form name="ftbl_repairadd" id="ftbl_repairadd" class="<?php echo $tbl_repair_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_repair">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_repair_add->IsModal ?>">
<?php if ($tbl_repair->getCurrentMasterTable() == "tbl_inventory") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="tbl_inventory">
<input type="hidden" name="fk_item_type" value="<?php echo HtmlEncode($tbl_repair_add->itemtype->getSessionValue()) ?>">
<input type="hidden" name="fk_item_model" value="<?php echo HtmlEncode($tbl_repair_add->itemmodel->getSessionValue()) ?>">
<input type="hidden" name="fk_item_serial" value="<?php echo HtmlEncode($tbl_repair_add->item_serial->getSessionValue()) ?>">
<input type="hidden" name="fk_office_id" value="<?php echo HtmlEncode($tbl_repair_add->office_id->getSessionValue()) ?>">
<input type="hidden" name="fk_name_accountable" value="<?php echo HtmlEncode($tbl_repair_add->name_accountable->getSessionValue()) ?>">
<input type="hidden" name="fk_Designation" value="<?php echo HtmlEncode($tbl_repair_add->Designation->getSessionValue()) ?>">
<input type="hidden" name="fk_Region" value="<?php echo HtmlEncode($tbl_repair_add->region->getSessionValue()) ?>">
<input type="hidden" name="fk_Province" value="<?php echo HtmlEncode($tbl_repair_add->province->getSessionValue()) ?>">
<input type="hidden" name="fk_Cities" value="<?php echo HtmlEncode($tbl_repair_add->city->getSessionValue()) ?>">
<input type="hidden" name="fk_concat_inventory" value="<?php echo HtmlEncode($tbl_repair_add->inventory_id->getSessionValue()) ?>">
<input type="hidden" name="fk_inventory_id" value="<?php echo HtmlEncode($tbl_repair_add->inventory_idr->getSessionValue()) ?>">
<input type="hidden" name="fk_Current_Location" value="<?php echo HtmlEncode($tbl_repair_add->current_loc_r->getSessionValue()) ?>">
<input type="hidden" name="fk_Last_Date_Check" value="<?php echo HtmlEncode($tbl_repair_add->date_received->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($tbl_repair_add->inventory_id->Visible) { // inventory_id ?>
	<div id="r_inventory_id" class="form-group row">
		<label id="elh_tbl_repair_inventory_id" for="x_inventory_id" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_inventory_id" type="text/html"><?php echo $tbl_repair_add->inventory_id->caption() ?><?php echo $tbl_repair_add->inventory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->inventory_id->cellAttributes() ?>>
<?php if ($tbl_repair_add->inventory_id->getSessionValue() != "") { ?>
<script id="tpx_tbl_repair_inventory_id" type="text/html"><span id="el_tbl_repair_inventory_id">
<span<?php echo $tbl_repair_add->inventory_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_add->inventory_id->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" id="x_inventory_id" name="x_inventory_id" value="<?php echo HtmlEncode($tbl_repair_add->inventory_id->CurrentValue) ?>">
<?php } else { ?>
<script id="tpx_tbl_repair_inventory_id" type="text/html"><span id="el_tbl_repair_inventory_id">
<input type="text" data-table="tbl_repair" data-field="x_inventory_id" name="x_inventory_id" id="x_inventory_id" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_repair_add->inventory_id->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_add->inventory_id->EditValue ?>"<?php echo $tbl_repair_add->inventory_id->editAttributes() ?>>
</span></script>
<?php } ?>
<?php echo $tbl_repair_add->inventory_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->current_loc_r->Visible) { // current_loc_r ?>
	<div id="r_current_loc_r" class="form-group row">
		<label id="elh_tbl_repair_current_loc_r" for="x_current_loc_r" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_current_loc_r" type="text/html"><?php echo $tbl_repair_add->current_loc_r->caption() ?><?php echo $tbl_repair_add->current_loc_r->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->current_loc_r->cellAttributes() ?>>
<?php if ($tbl_repair_add->current_loc_r->getSessionValue() != "") { ?>
<script id="tpx_tbl_repair_current_loc_r" type="text/html"><span id="el_tbl_repair_current_loc_r">
<span<?php echo $tbl_repair_add->current_loc_r->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_add->current_loc_r->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" id="x_current_loc_r" name="x_current_loc_r" value="<?php echo HtmlEncode($tbl_repair_add->current_loc_r->CurrentValue) ?>">
<?php } else { ?>
<script id="tpx_tbl_repair_current_loc_r" type="text/html"><span id="el_tbl_repair_current_loc_r">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_current_loc_r" data-value-separator="<?php echo $tbl_repair_add->current_loc_r->displayValueSeparatorAttribute() ?>" id="x_current_loc_r" name="x_current_loc_r"<?php echo $tbl_repair_add->current_loc_r->editAttributes() ?>>
			<?php echo $tbl_repair_add->current_loc_r->selectOptionListHtml("x_current_loc_r") ?>
		</select>
</div>
<?php echo $tbl_repair_add->current_loc_r->Lookup->getParamTag($tbl_repair_add, "p_x_current_loc_r") ?>
</span></script>
<?php } ?>
<?php echo $tbl_repair_add->current_loc_r->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->inventory_idr->Visible) { // inventory_idr ?>
	<div id="r_inventory_idr" class="form-group row">
		<label id="elh_tbl_repair_inventory_idr" for="x_inventory_idr" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_inventory_idr" type="text/html"><?php echo $tbl_repair_add->inventory_idr->caption() ?><?php echo $tbl_repair_add->inventory_idr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->inventory_idr->cellAttributes() ?>>
<?php if ($tbl_repair_add->inventory_idr->getSessionValue() != "") { ?>
<script id="tpx_tbl_repair_inventory_idr" type="text/html"><span id="el_tbl_repair_inventory_idr">
<span<?php echo $tbl_repair_add->inventory_idr->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_add->inventory_idr->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" id="x_inventory_idr" name="x_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_add->inventory_idr->CurrentValue) ?>">
<?php } else { ?>
<script id="tpx_tbl_repair_inventory_idr" type="text/html"><span id="el_tbl_repair_inventory_idr">
<input type="text" data-table="tbl_repair" data-field="x_inventory_idr" name="x_inventory_idr" id="x_inventory_idr" maxlength="11" placeholder="<?php echo HtmlEncode($tbl_repair_add->inventory_idr->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_add->inventory_idr->EditValue ?>"<?php echo $tbl_repair_add->inventory_idr->editAttributes() ?>>
</span></script>
<?php } ?>
<?php echo $tbl_repair_add->inventory_idr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->date_received->Visible) { // date_received ?>
	<div id="r_date_received" class="form-group row">
		<label id="elh_tbl_repair_date_received" for="x_date_received" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_date_received" type="text/html"><?php echo $tbl_repair_add->date_received->caption() ?><?php echo $tbl_repair_add->date_received->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->date_received->cellAttributes() ?>>
<?php if ($tbl_repair_add->date_received->getSessionValue() != "") { ?>
<script id="tpx_tbl_repair_date_received" type="text/html"><span id="el_tbl_repair_date_received">
<span<?php echo $tbl_repair_add->date_received->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_add->date_received->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" id="x_date_received" name="x_date_received" value="<?php echo HtmlEncode(FormatDateTime($tbl_repair_add->date_received->CurrentValue, 0)) ?>">
<?php } else { ?>
<script id="tpx_tbl_repair_date_received" type="text/html"><span id="el_tbl_repair_date_received">
<input type="text" data-table="tbl_repair" data-field="x_date_received" name="x_date_received" id="x_date_received" placeholder="<?php echo HtmlEncode($tbl_repair_add->date_received->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_add->date_received->EditValue ?>"<?php echo $tbl_repair_add->date_received->editAttributes() ?>>
<?php if (!$tbl_repair_add->date_received->ReadOnly && !$tbl_repair_add->date_received->Disabled && !isset($tbl_repair_add->date_received->EditAttrs["readonly"]) && !isset($tbl_repair_add->date_received->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<?php } ?>
<script type="text/html" class="tbl_repairadd_js">
loadjs.ready(["ftbl_repairadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_repairadd", "x_date_received", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_repair_add->date_received->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->date_repaired->Visible) { // date_repaired ?>
	<div id="r_date_repaired" class="form-group row">
		<label id="elh_tbl_repair_date_repaired" for="x_date_repaired" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_date_repaired" type="text/html"><?php echo $tbl_repair_add->date_repaired->caption() ?><?php echo $tbl_repair_add->date_repaired->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->date_repaired->cellAttributes() ?>>
<script id="tpx_tbl_repair_date_repaired" type="text/html"><span id="el_tbl_repair_date_repaired">
<input type="text" data-table="tbl_repair" data-field="x_date_repaired" name="x_date_repaired" id="x_date_repaired" placeholder="<?php echo HtmlEncode($tbl_repair_add->date_repaired->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_add->date_repaired->EditValue ?>"<?php echo $tbl_repair_add->date_repaired->editAttributes() ?>>
<?php if (!$tbl_repair_add->date_repaired->ReadOnly && !$tbl_repair_add->date_repaired->Disabled && !isset($tbl_repair_add->date_repaired->EditAttrs["readonly"]) && !isset($tbl_repair_add->date_repaired->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_repairadd_js">
loadjs.ready(["ftbl_repairadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_repairadd", "x_date_repaired", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php echo $tbl_repair_add->date_repaired->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->type_problem->Visible) { // type_problem ?>
	<div id="r_type_problem" class="form-group row">
		<label id="elh_tbl_repair_type_problem" for="x_type_problem" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_type_problem" type="text/html"><?php echo $tbl_repair_add->type_problem->caption() ?><?php echo $tbl_repair_add->type_problem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->type_problem->cellAttributes() ?>>
<script id="tpx_tbl_repair_type_problem" type="text/html"><span id="el_tbl_repair_type_problem">
<textarea data-table="tbl_repair" data-field="x_type_problem" name="x_type_problem" id="x_type_problem" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_add->type_problem->getPlaceHolder()) ?>"<?php echo $tbl_repair_add->type_problem->editAttributes() ?>><?php echo $tbl_repair_add->type_problem->EditValue ?></textarea>
</span></script>
<?php echo $tbl_repair_add->type_problem->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->action_taken->Visible) { // action_taken ?>
	<div id="r_action_taken" class="form-group row">
		<label id="elh_tbl_repair_action_taken" for="x_action_taken" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_action_taken" type="text/html"><?php echo $tbl_repair_add->action_taken->caption() ?><?php echo $tbl_repair_add->action_taken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->action_taken->cellAttributes() ?>>
<script id="tpx_tbl_repair_action_taken" type="text/html"><span id="el_tbl_repair_action_taken">
<textarea data-table="tbl_repair" data-field="x_action_taken" name="x_action_taken" id="x_action_taken" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_add->action_taken->getPlaceHolder()) ?>"<?php echo $tbl_repair_add->action_taken->editAttributes() ?>><?php echo $tbl_repair_add->action_taken->EditValue ?></textarea>
</span></script>
<?php echo $tbl_repair_add->action_taken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->employee_id->Visible) { // employee_id ?>
	<div id="r_employee_id" class="form-group row">
		<label id="elh_tbl_repair_employee_id" for="x_employee_id" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_employee_id" type="text/html"><?php echo $tbl_repair_add->employee_id->caption() ?><?php echo $tbl_repair_add->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->employee_id->cellAttributes() ?>>
<script id="tpx_tbl_repair_employee_id" type="text/html"><span id="el_tbl_repair_employee_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_employee_id" data-value-separator="<?php echo $tbl_repair_add->employee_id->displayValueSeparatorAttribute() ?>" id="x_employee_id" name="x_employee_id"<?php echo $tbl_repair_add->employee_id->editAttributes() ?>>
			<?php echo $tbl_repair_add->employee_id->selectOptionListHtml("x_employee_id") ?>
		</select>
</div>
</span></script>
<?php echo $tbl_repair_add->employee_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->status_h->Visible) { // status_h ?>
	<div id="r_status_h" class="form-group row">
		<label id="elh_tbl_repair_status_h" for="x_status_h" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_status_h" type="text/html"><?php echo $tbl_repair_add->status_h->caption() ?><?php echo $tbl_repair_add->status_h->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->status_h->cellAttributes() ?>>
<script id="tpx_tbl_repair_status_h" type="text/html"><span id="el_tbl_repair_status_h">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_status_h" data-value-separator="<?php echo $tbl_repair_add->status_h->displayValueSeparatorAttribute() ?>" id="x_status_h" name="x_status_h"<?php echo $tbl_repair_add->status_h->editAttributes() ?>>
			<?php echo $tbl_repair_add->status_h->selectOptionListHtml("x_status_h") ?>
		</select>
</div>
<?php echo $tbl_repair_add->status_h->Lookup->getParamTag($tbl_repair_add, "p_x_status_h") ?>
</span></script>
<?php echo $tbl_repair_add->status_h->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->pullout_r->Visible) { // pullout_r ?>
	<div id="r_pullout_r" class="form-group row">
		<label id="elh_tbl_repair_pullout_r" for="x_pullout_r" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_pullout_r" type="text/html"><?php echo $tbl_repair_add->pullout_r->caption() ?><?php echo $tbl_repair_add->pullout_r->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->pullout_r->cellAttributes() ?>>
<script id="tpx_tbl_repair_pullout_r" type="text/html"><span id="el_tbl_repair_pullout_r">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_pullout_r" data-value-separator="<?php echo $tbl_repair_add->pullout_r->displayValueSeparatorAttribute() ?>" id="x_pullout_r" name="x_pullout_r"<?php echo $tbl_repair_add->pullout_r->editAttributes() ?>>
			<?php echo $tbl_repair_add->pullout_r->selectOptionListHtml("x_pullout_r") ?>
		</select>
</div>
</span></script>
<?php echo $tbl_repair_add->pullout_r->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_repair_add->remark->Visible) { // remark ?>
	<div id="r_remark" class="form-group row">
		<label id="elh_tbl_repair_remark" for="x_remark" class="<?php echo $tbl_repair_add->LeftColumnClass ?>"><script id="tpc_tbl_repair_remark" type="text/html"><?php echo $tbl_repair_add->remark->caption() ?><?php echo $tbl_repair_add->remark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_repair_add->RightColumnClass ?>"><div <?php echo $tbl_repair_add->remark->cellAttributes() ?>>
<script id="tpx_tbl_repair_remark" type="text/html"><span id="el_tbl_repair_remark">
<textarea data-table="tbl_repair" data-field="x_remark" name="x_remark" id="x_remark" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_add->remark->getPlaceHolder()) ?>"<?php echo $tbl_repair_add->remark->editAttributes() ?>><?php echo $tbl_repair_add->remark->EditValue ?></textarea>
</span></script>
<?php echo $tbl_repair_add->remark->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($tbl_repair_add->name_accountable->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_name_accountable" id="x_name_accountable" value="<?php echo HtmlEncode(strval($tbl_repair_add->name_accountable->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->Designation->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_Designation" id="x_Designation" value="<?php echo HtmlEncode(strval($tbl_repair_add->Designation->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->office_id->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_office_id" id="x_office_id" value="<?php echo HtmlEncode(strval($tbl_repair_add->office_id->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->region->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_region" id="x_region" value="<?php echo HtmlEncode(strval($tbl_repair_add->region->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->province->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_province" id="x_province" value="<?php echo HtmlEncode(strval($tbl_repair_add->province->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->city->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_city" id="x_city" value="<?php echo HtmlEncode(strval($tbl_repair_add->city->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->itemtype->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_itemtype" id="x_itemtype" value="<?php echo HtmlEncode(strval($tbl_repair_add->itemtype->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->itemmodel->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_itemmodel" id="x_itemmodel" value="<?php echo HtmlEncode(strval($tbl_repair_add->itemmodel->getSessionValue())) ?>">
	<?php } ?>
	<?php if (strval($tbl_repair_add->item_serial->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_item_serial" id="x_item_serial" value="<?php echo HtmlEncode(strval($tbl_repair_add->item_serial->getSessionValue())) ?>">
	<?php } ?>
<div id="tpd_tbl_repairadd" class="ew-custom-template"></div>
<script id="tpm_tbl_repairadd" type="text/html">
<div id="ct_tbl_repair_add"><table style="height: 375px; float: left; width: 919.383px;" border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">  -->
<tbody>
<tr style="height: 13px;">
<td style="width: 373px; height: 13px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_repair_inventory_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_inventory_id")/}}</td>
<td style="width: 744.383px; height: 13px; text-align: left;" colspan="2" rowspan="2" scope="row">{{include tmpl="#tpc_tbl_repair_type_problem"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_type_problem")/}}&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 7px;">
<td style="width: 373px; height: 13px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_repair_current_loc_r"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_current_loc_r")/}}</td>
</tr>
<tr style="height: 6px;">
<td style="width: 373px; height: 13px; text-align: left;" scope="row">&nbsp;</td>
<td style="width: 744.383px; height: 13px; text-align: left;" colspan="2" rowspan="2" scope="row">&nbsp;{{include tmpl="#tpc_tbl_repair_action_taken"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_action_taken")/}}&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 3px;">
<td style="width: 373px; height: 13px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_repair_date_received"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_date_received")/}}</td>
</tr>
<tr style="height: 8px;">
<td style="width: 373px; height: 13px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_repair_date_repaired"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_date_repaired")/}}</td>
<td style="width: 454px; height: 13px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_repair_status_h"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_status_h")/}}</td>
<td style="width: 290.383px; height: 13px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_repair_pullout_r"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_pullout_r")/}}</td>
</tr>
<tr style="height: 4px;">
<td style="width: 373px; height: 13px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_repair_employee_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_employee_id")/}}</td>
<td style="width: 744.383px; height: 13px; text-align: left;" colspan="2" rowspan="2" scope="row">&nbsp;{{include tmpl="#tpc_tbl_repair_remark"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_repair_remark")/}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 5px;">
<td style="width: 373px; height: 13px; text-align: left;" scope="row">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$tbl_repair_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_repair_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_repair_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_repair->Rows) ?> };
	ew.applyTemplate("tpd_tbl_repairadd", "tpm_tbl_repairadd", "tbl_repairadd", "<?php echo $tbl_repair->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_repairadd_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_repair_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_pullout_r").attr("disabled","disabled"),$("#x_status_h").change(function(){$("option:selected",this);"1"==this.value?($("#x_pullout_r").removeAttr("disabled"),$("#x_pullout_r").prop("required",!0)):($("#x_pullout_r").attr("disabled","disabled"),$("#x_pullout_r")[0].selectedIndex=0,$("#x_pullout_r").prop("required",!1))})}),$(document).ready(function(){$("#r_inventory_idr").hide(),$("#r_current_loc_r").hide(),$("#r_inventory_id").hide()});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_repair_add->terminate();
?>