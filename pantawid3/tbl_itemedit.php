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
$tbl_item_edit = new tbl_item_edit();

// Run the page
$tbl_item_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_item_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_itemedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_itemedit = currentForm = new ew.Form("ftbl_itemedit", "edit");

	// Validate form
	ftbl_itemedit.validate = function() {
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
			<?php if ($tbl_item_edit->item_date_receive->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_date_receive->caption(), $tbl_item_edit->item_date_receive->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_receive");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_item_edit->item_date_receive->errorMessage()) ?>");
			<?php if ($tbl_item_edit->item_date_repaired->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_repaired");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_date_repaired->caption(), $tbl_item_edit->item_date_repaired->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_repaired");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_item_edit->item_date_repaired->errorMessage()) ?>");
			<?php if ($tbl_item_edit->item_date_pullout->Required) { ?>
				elm = this.getElements("x" + infix + "_item_date_pullout");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_date_pullout->caption(), $tbl_item_edit->item_date_pullout->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_item_date_pullout");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_item_edit->item_date_pullout->errorMessage()) ?>");
			<?php if ($tbl_item_edit->item_transmittal->Required) { ?>
				elm = this.getElements("x" + infix + "_item_transmittal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_transmittal->caption(), $tbl_item_edit->item_transmittal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->position->Required) { ?>
				elm = this.getElements("x" + infix + "_position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->position->caption(), $tbl_item_edit->position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->Contact_no->Required) { ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->Contact_no->caption(), $tbl_item_edit->Contact_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Contact_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_item_edit->Contact_no->errorMessage()) ?>");
			<?php if ($tbl_item_edit->__Request->Required) { ?>
				elm = this.getElements("x" + infix + "___Request");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->__Request->caption(), $tbl_item_edit->__Request->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->item_type->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_type->caption(), $tbl_item_edit->item_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->item_model->Required) { ?>
				elm = this.getElements("x" + infix + "_item_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_model->caption(), $tbl_item_edit->item_model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->item_serno->Required) { ?>
				elm = this.getElements("x" + infix + "_item_serno");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_serno->caption(), $tbl_item_edit->item_serno->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->item_requested_unit->Required) { ?>
				elm = this.getElements("x" + infix + "_item_requested_unit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_requested_unit->caption(), $tbl_item_edit->item_requested_unit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->Region->caption(), $tbl_item_edit->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->Province->Required) { ?>
				elm = this.getElements("x" + infix + "_Province");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->Province->caption(), $tbl_item_edit->Province->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->Cities->Required) { ?>
				elm = this.getElements("x" + infix + "_Cities");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->Cities->caption(), $tbl_item_edit->Cities->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->item_type_problem->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type_problem");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_type_problem->caption(), $tbl_item_edit->item_type_problem->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->item_action_taken->Required) { ?>
				elm = this.getElements("x" + infix + "_item_action_taken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->item_action_taken->caption(), $tbl_item_edit->item_action_taken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->employeeid->caption(), $tbl_item_edit->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->status_id->Required) { ?>
				elm = this.getElements("x" + infix + "_status_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->status_id->caption(), $tbl_item_edit->status_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->remarks->caption(), $tbl_item_edit->remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->user_last_modify->caption(), $tbl_item_edit->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_item_edit->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_item_edit->date_last_modify->caption(), $tbl_item_edit->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_itemedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_itemedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	ftbl_itemedit.multiPage = new ew.MultiPage("ftbl_itemedit");

	// Dynamic selection lists
	ftbl_itemedit.lists["x_item_transmittal"] = <?php echo $tbl_item_edit->item_transmittal->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_item_transmittal"].options = <?php echo JsonEncode($tbl_item_edit->item_transmittal->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_position"] = <?php echo $tbl_item_edit->position->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_position"].options = <?php echo JsonEncode($tbl_item_edit->position->lookupOptions()) ?>;
	ftbl_itemedit.lists["x___Request"] = <?php echo $tbl_item_edit->__Request->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x___Request"].options = <?php echo JsonEncode($tbl_item_edit->__Request->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_item_type"] = <?php echo $tbl_item_edit->item_type->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_item_type"].options = <?php echo JsonEncode($tbl_item_edit->item_type->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_item_requested_unit"] = <?php echo $tbl_item_edit->item_requested_unit->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_item_requested_unit"].options = <?php echo JsonEncode($tbl_item_edit->item_requested_unit->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_Region"] = <?php echo $tbl_item_edit->Region->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_Region"].options = <?php echo JsonEncode($tbl_item_edit->Region->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_Province"] = <?php echo $tbl_item_edit->Province->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_Province"].options = <?php echo JsonEncode($tbl_item_edit->Province->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_Cities"] = <?php echo $tbl_item_edit->Cities->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_Cities"].options = <?php echo JsonEncode($tbl_item_edit->Cities->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_employeeid"] = <?php echo $tbl_item_edit->employeeid->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_employeeid"].options = <?php echo JsonEncode($tbl_item_edit->employeeid->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_status_id"] = <?php echo $tbl_item_edit->status_id->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_status_id"].options = <?php echo JsonEncode($tbl_item_edit->status_id->lookupOptions()) ?>;
	ftbl_itemedit.lists["x_user_last_modify"] = <?php echo $tbl_item_edit->user_last_modify->Lookup->toClientList($tbl_item_edit) ?>;
	ftbl_itemedit.lists["x_user_last_modify"].options = <?php echo JsonEncode($tbl_item_edit->user_last_modify->lookupOptions()) ?>;
	loadjs.done("ftbl_itemedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_item_edit->showPageHeader(); ?>
<?php
$tbl_item_edit->showMessage();
?>
<form name="ftbl_itemedit" id="ftbl_itemedit" class="<?php echo $tbl_item_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_item">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_item_edit->IsModal ?>">
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="tbl_item_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $tbl_item_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $tbl_item_edit->MultiPages->pageStyle(1) ?>" href="#tab_tbl_item1" data-toggle="tab"><?php echo $tbl_item->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_item_edit->MultiPages->pageStyle(2) ?>" href="#tab_tbl_item2" data-toggle="tab"><?php echo $tbl_item->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $tbl_item_edit->MultiPages->pageStyle(1) ?>" id="tab_tbl_item1"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_item_edit->item_date_receive->Visible) { // item_date_receive ?>
	<div id="r_item_date_receive" class="form-group row">
		<label id="elh_tbl_item_item_date_receive" for="x_item_date_receive" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_date_receive->caption() ?><?php echo $tbl_item_edit->item_date_receive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_date_receive->cellAttributes() ?>>
<span id="el_tbl_item_item_date_receive">
<input type="text" data-table="tbl_item" data-field="x_item_date_receive" data-page="1" data-format="5" name="x_item_date_receive" id="x_item_date_receive" placeholder="<?php echo HtmlEncode($tbl_item_edit->item_date_receive->getPlaceHolder()) ?>" value="<?php echo $tbl_item_edit->item_date_receive->EditValue ?>"<?php echo $tbl_item_edit->item_date_receive->editAttributes() ?>>
<?php if (!$tbl_item_edit->item_date_receive->ReadOnly && !$tbl_item_edit->item_date_receive->Disabled && !isset($tbl_item_edit->item_date_receive->EditAttrs["readonly"]) && !isset($tbl_item_edit->item_date_receive->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_itemedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_itemedit", "x_item_date_receive", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php } ?>
</span>
<?php echo $tbl_item_edit->item_date_receive->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_transmittal->Visible) { // item_transmittal ?>
	<div id="r_item_transmittal" class="form-group row">
		<label id="elh_tbl_item_item_transmittal" for="x_item_transmittal" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_transmittal->caption() ?><?php echo $tbl_item_edit->item_transmittal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_transmittal->cellAttributes() ?>>
<span id="el_tbl_item_item_transmittal">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_item_transmittal" data-page="1" data-value-separator="<?php echo $tbl_item_edit->item_transmittal->displayValueSeparatorAttribute() ?>" id="x_item_transmittal" name="x_item_transmittal"<?php echo $tbl_item_edit->item_transmittal->editAttributes() ?>>
			<?php echo $tbl_item_edit->item_transmittal->selectOptionListHtml("x_item_transmittal") ?>
		</select>
</div>
<?php echo $tbl_item_edit->item_transmittal->Lookup->getParamTag($tbl_item_edit, "p_x_item_transmittal") ?>
</span>
<?php echo $tbl_item_edit->item_transmittal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->position->Visible) { // position ?>
	<div id="r_position" class="form-group row">
		<label id="elh_tbl_item_position" for="x_position" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->position->caption() ?><?php echo $tbl_item_edit->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->position->cellAttributes() ?>>
<span id="el_tbl_item_position">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_position" data-page="1" data-value-separator="<?php echo $tbl_item_edit->position->displayValueSeparatorAttribute() ?>" id="x_position" name="x_position"<?php echo $tbl_item_edit->position->editAttributes() ?>>
			<?php echo $tbl_item_edit->position->selectOptionListHtml("x_position") ?>
		</select>
</div>
<?php echo $tbl_item_edit->position->Lookup->getParamTag($tbl_item_edit, "p_x_position") ?>
</span>
<?php echo $tbl_item_edit->position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->Contact_no->Visible) { // Contact_no ?>
	<div id="r_Contact_no" class="form-group row">
		<label id="elh_tbl_item_Contact_no" for="x_Contact_no" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->Contact_no->caption() ?><?php echo $tbl_item_edit->Contact_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->Contact_no->cellAttributes() ?>>
<span id="el_tbl_item_Contact_no">
<input type="text" data-table="tbl_item" data-field="x_Contact_no" data-page="1" name="x_Contact_no" id="x_Contact_no" placeholder="<?php echo HtmlEncode($tbl_item_edit->Contact_no->getPlaceHolder()) ?>" value="<?php echo $tbl_item_edit->Contact_no->EditValue ?>"<?php echo $tbl_item_edit->Contact_no->editAttributes() ?>>
</span>
<?php echo $tbl_item_edit->Contact_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->__Request->Visible) { // Request ?>
	<div id="r___Request" class="form-group row">
		<label id="elh_tbl_item___Request" for="x___Request" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->__Request->caption() ?><?php echo $tbl_item_edit->__Request->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->__Request->cellAttributes() ?>>
<span id="el_tbl_item___Request">
<?php $tbl_item_edit->__Request->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x___Request" data-page="1" data-value-separator="<?php echo $tbl_item_edit->__Request->displayValueSeparatorAttribute() ?>" id="x___Request" name="x___Request"<?php echo $tbl_item_edit->__Request->editAttributes() ?>>
			<?php echo $tbl_item_edit->__Request->selectOptionListHtml("x___Request") ?>
		</select>
</div>
<?php echo $tbl_item_edit->__Request->Lookup->getParamTag($tbl_item_edit, "p_x___Request") ?>
</span>
<?php echo $tbl_item_edit->__Request->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label id="elh_tbl_item_item_type" for="x_item_type" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_type->caption() ?><?php echo $tbl_item_edit->item_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_type->cellAttributes() ?>>
<span id="el_tbl_item_item_type">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_item_type" data-page="1" data-value-separator="<?php echo $tbl_item_edit->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $tbl_item_edit->item_type->editAttributes() ?>>
			<?php echo $tbl_item_edit->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $tbl_item_edit->item_type->Lookup->getParamTag($tbl_item_edit, "p_x_item_type") ?>
</span>
<?php echo $tbl_item_edit->item_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label id="elh_tbl_item_item_model" for="x_item_model" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_model->caption() ?><?php echo $tbl_item_edit->item_model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_model->cellAttributes() ?>>
<span id="el_tbl_item_item_model">
<input type="text" data-table="tbl_item" data-field="x_item_model" data-page="1" name="x_item_model" id="x_item_model" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_item_edit->item_model->getPlaceHolder()) ?>" value="<?php echo $tbl_item_edit->item_model->EditValue ?>"<?php echo $tbl_item_edit->item_model->editAttributes() ?>>
</span>
<?php echo $tbl_item_edit->item_model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_serno->Visible) { // item_serno ?>
	<div id="r_item_serno" class="form-group row">
		<label id="elh_tbl_item_item_serno" for="x_item_serno" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_serno->caption() ?><?php echo $tbl_item_edit->item_serno->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_serno->cellAttributes() ?>>
<span id="el_tbl_item_item_serno">
<input type="text" data-table="tbl_item" data-field="x_item_serno" data-page="1" name="x_item_serno" id="x_item_serno" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_item_edit->item_serno->getPlaceHolder()) ?>" value="<?php echo $tbl_item_edit->item_serno->EditValue ?>"<?php echo $tbl_item_edit->item_serno->editAttributes() ?>>
</span>
<?php echo $tbl_item_edit->item_serno->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_requested_unit->Visible) { // item_requested_unit ?>
	<div id="r_item_requested_unit" class="form-group row">
		<label id="elh_tbl_item_item_requested_unit" for="x_item_requested_unit" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_requested_unit->caption() ?><?php echo $tbl_item_edit->item_requested_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_requested_unit->cellAttributes() ?>>
<span id="el_tbl_item_item_requested_unit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_item_requested_unit" data-page="1" data-value-separator="<?php echo $tbl_item_edit->item_requested_unit->displayValueSeparatorAttribute() ?>" id="x_item_requested_unit" name="x_item_requested_unit"<?php echo $tbl_item_edit->item_requested_unit->editAttributes() ?>>
			<?php echo $tbl_item_edit->item_requested_unit->selectOptionListHtml("x_item_requested_unit") ?>
		</select>
</div>
<?php echo $tbl_item_edit->item_requested_unit->Lookup->getParamTag($tbl_item_edit, "p_x_item_requested_unit") ?>
</span>
<?php echo $tbl_item_edit->item_requested_unit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_tbl_item_Region" for="x_Region" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->Region->caption() ?><?php echo $tbl_item_edit->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->Region->cellAttributes() ?>>
<span id="el_tbl_item_Region">
<?php $tbl_item_edit->Region->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_Region" data-page="1" data-value-separator="<?php echo $tbl_item_edit->Region->displayValueSeparatorAttribute() ?>" id="x_Region" name="x_Region"<?php echo $tbl_item_edit->Region->editAttributes() ?>>
			<?php echo $tbl_item_edit->Region->selectOptionListHtml("x_Region") ?>
		</select>
</div>
<?php echo $tbl_item_edit->Region->Lookup->getParamTag($tbl_item_edit, "p_x_Region") ?>
</span>
<?php echo $tbl_item_edit->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->Province->Visible) { // Province ?>
	<div id="r_Province" class="form-group row">
		<label id="elh_tbl_item_Province" for="x_Province" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->Province->caption() ?><?php echo $tbl_item_edit->Province->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->Province->cellAttributes() ?>>
<span id="el_tbl_item_Province">
<?php $tbl_item_edit->Province->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_Province" data-page="1" data-value-separator="<?php echo $tbl_item_edit->Province->displayValueSeparatorAttribute() ?>" id="x_Province" name="x_Province"<?php echo $tbl_item_edit->Province->editAttributes() ?>>
			<?php echo $tbl_item_edit->Province->selectOptionListHtml("x_Province") ?>
		</select>
</div>
<?php echo $tbl_item_edit->Province->Lookup->getParamTag($tbl_item_edit, "p_x_Province") ?>
</span>
<?php echo $tbl_item_edit->Province->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->Cities->Visible) { // Cities ?>
	<div id="r_Cities" class="form-group row">
		<label id="elh_tbl_item_Cities" for="x_Cities" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->Cities->caption() ?><?php echo $tbl_item_edit->Cities->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->Cities->cellAttributes() ?>>
<span id="el_tbl_item_Cities">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_Cities" data-page="1" data-value-separator="<?php echo $tbl_item_edit->Cities->displayValueSeparatorAttribute() ?>" id="x_Cities" name="x_Cities"<?php echo $tbl_item_edit->Cities->editAttributes() ?>>
			<?php echo $tbl_item_edit->Cities->selectOptionListHtml("x_Cities") ?>
		</select>
</div>
<?php echo $tbl_item_edit->Cities->Lookup->getParamTag($tbl_item_edit, "p_x_Cities") ?>
</span>
<?php echo $tbl_item_edit->Cities->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $tbl_item_edit->MultiPages->pageStyle(2) ?>" id="tab_tbl_item2"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_item_edit->item_date_repaired->Visible) { // item_date_repaired ?>
	<div id="r_item_date_repaired" class="form-group row">
		<label id="elh_tbl_item_item_date_repaired" for="x_item_date_repaired" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_date_repaired->caption() ?><?php echo $tbl_item_edit->item_date_repaired->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_date_repaired->cellAttributes() ?>>
<span id="el_tbl_item_item_date_repaired">
<input type="text" data-table="tbl_item" data-field="x_item_date_repaired" data-page="2" data-format="7" name="x_item_date_repaired" id="x_item_date_repaired" placeholder="<?php echo HtmlEncode($tbl_item_edit->item_date_repaired->getPlaceHolder()) ?>" value="<?php echo $tbl_item_edit->item_date_repaired->EditValue ?>"<?php echo $tbl_item_edit->item_date_repaired->editAttributes() ?>>
<?php if (!$tbl_item_edit->item_date_repaired->ReadOnly && !$tbl_item_edit->item_date_repaired->Disabled && !isset($tbl_item_edit->item_date_repaired->EditAttrs["readonly"]) && !isset($tbl_item_edit->item_date_repaired->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_itemedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_itemedit", "x_item_date_repaired", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $tbl_item_edit->item_date_repaired->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_date_pullout->Visible) { // item_date_pullout ?>
	<div id="r_item_date_pullout" class="form-group row">
		<label id="elh_tbl_item_item_date_pullout" for="x_item_date_pullout" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_date_pullout->caption() ?><?php echo $tbl_item_edit->item_date_pullout->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_date_pullout->cellAttributes() ?>>
<span id="el_tbl_item_item_date_pullout">
<input type="text" data-table="tbl_item" data-field="x_item_date_pullout" data-page="2" data-format="5" name="x_item_date_pullout" id="x_item_date_pullout" placeholder="<?php echo HtmlEncode($tbl_item_edit->item_date_pullout->getPlaceHolder()) ?>" value="<?php echo $tbl_item_edit->item_date_pullout->EditValue ?>"<?php echo $tbl_item_edit->item_date_pullout->editAttributes() ?>>
<?php if (!$tbl_item_edit->item_date_pullout->ReadOnly && !$tbl_item_edit->item_date_pullout->Disabled && !isset($tbl_item_edit->item_date_pullout->EditAttrs["readonly"]) && !isset($tbl_item_edit->item_date_pullout->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_itemedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_itemedit", "x_item_date_pullout", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php } ?>
</span>
<?php echo $tbl_item_edit->item_date_pullout->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_type_problem->Visible) { // item_type_problem ?>
	<div id="r_item_type_problem" class="form-group row">
		<label id="elh_tbl_item_item_type_problem" for="x_item_type_problem" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_type_problem->caption() ?><?php echo $tbl_item_edit->item_type_problem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_type_problem->cellAttributes() ?>>
<span id="el_tbl_item_item_type_problem">
<textarea data-table="tbl_item" data-field="x_item_type_problem" data-page="2" name="x_item_type_problem" id="x_item_type_problem" cols="35" rows="4" placeholder="<?php echo HtmlEncode($tbl_item_edit->item_type_problem->getPlaceHolder()) ?>"<?php echo $tbl_item_edit->item_type_problem->editAttributes() ?>><?php echo $tbl_item_edit->item_type_problem->EditValue ?></textarea>
</span>
<?php echo $tbl_item_edit->item_type_problem->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->item_action_taken->Visible) { // item_action_taken ?>
	<div id="r_item_action_taken" class="form-group row">
		<label id="elh_tbl_item_item_action_taken" for="x_item_action_taken" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->item_action_taken->caption() ?><?php echo $tbl_item_edit->item_action_taken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->item_action_taken->cellAttributes() ?>>
<span id="el_tbl_item_item_action_taken">
<textarea data-table="tbl_item" data-field="x_item_action_taken" data-page="2" name="x_item_action_taken" id="x_item_action_taken" cols="35" rows="4" placeholder="<?php echo HtmlEncode($tbl_item_edit->item_action_taken->getPlaceHolder()) ?>"<?php echo $tbl_item_edit->item_action_taken->editAttributes() ?>><?php echo $tbl_item_edit->item_action_taken->EditValue ?></textarea>
</span>
<?php echo $tbl_item_edit->item_action_taken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_tbl_item_employeeid" for="x_employeeid" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->employeeid->caption() ?><?php echo $tbl_item_edit->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->employeeid->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$tbl_item->userIDAllow("edit")) { // Non system admin ?>
<span id="el_tbl_item_employeeid">
<span<?php echo $tbl_item_edit->employeeid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_item_edit->employeeid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_item" data-field="x_employeeid" data-page="2" name="x_employeeid" id="x_employeeid" value="<?php echo HtmlEncode($tbl_item_edit->employeeid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_tbl_item_employeeid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_employeeid" data-page="2" data-value-separator="<?php echo $tbl_item_edit->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $tbl_item_edit->employeeid->editAttributes() ?>>
			<?php echo $tbl_item_edit->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $tbl_item_edit->employeeid->Lookup->getParamTag($tbl_item_edit, "p_x_employeeid") ?>
</span>
<?php } ?>
<?php echo $tbl_item_edit->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->status_id->Visible) { // status_id ?>
	<div id="r_status_id" class="form-group row">
		<label id="elh_tbl_item_status_id" for="x_status_id" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->status_id->caption() ?><?php echo $tbl_item_edit->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->status_id->cellAttributes() ?>>
<span id="el_tbl_item_status_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_item" data-field="x_status_id" data-page="2" data-value-separator="<?php echo $tbl_item_edit->status_id->displayValueSeparatorAttribute() ?>" id="x_status_id" name="x_status_id"<?php echo $tbl_item_edit->status_id->editAttributes() ?>>
			<?php echo $tbl_item_edit->status_id->selectOptionListHtml("x_status_id") ?>
		</select>
</div>
<?php echo $tbl_item_edit->status_id->Lookup->getParamTag($tbl_item_edit, "p_x_status_id") ?>
</span>
<?php echo $tbl_item_edit->status_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_item_edit->remarks->Visible) { // remarks ?>
	<div id="r_remarks" class="form-group row">
		<label id="elh_tbl_item_remarks" for="x_remarks" class="<?php echo $tbl_item_edit->LeftColumnClass ?>"><?php echo $tbl_item_edit->remarks->caption() ?><?php echo $tbl_item_edit->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_item_edit->RightColumnClass ?>"><div <?php echo $tbl_item_edit->remarks->cellAttributes() ?>>
<span id="el_tbl_item_remarks">
<textarea data-table="tbl_item" data-field="x_remarks" data-page="2" name="x_remarks" id="x_remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($tbl_item_edit->remarks->getPlaceHolder()) ?>"<?php echo $tbl_item_edit->remarks->editAttributes() ?>><?php echo $tbl_item_edit->remarks->EditValue ?></textarea>
</span>
<?php echo $tbl_item_edit->remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
	<input type="hidden" data-table="tbl_item" data-field="x_item_id" name="x_item_id" id="x_item_id" value="<?php echo HtmlEncode($tbl_item_edit->item_id->CurrentValue) ?>">
<?php if (!$tbl_item_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_item_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_item_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_item_edit->showPageFooter();
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
$tbl_item_edit->terminate();
?>