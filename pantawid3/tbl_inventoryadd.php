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
$tbl_inventory_add = new tbl_inventory_add();

// Run the page
$tbl_inventory_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_inventoryadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_inventoryadd = currentForm = new ew.Form("ftbl_inventoryadd", "add");

	// Validate form
	ftbl_inventoryadd.validate = function() {
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
			<?php if ($tbl_inventory_add->Month_Purchased->Required) { ?>
				elm = this.getElements("x" + infix + "_Month_Purchased");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Month_Purchased->caption(), $tbl_inventory_add->Month_Purchased->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->Year_Purchased->Required) { ?>
				elm = this.getElements("x" + infix + "_Year_Purchased");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Year_Purchased->caption(), $tbl_inventory_add->Year_Purchased->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->item_type->Required) { ?>
				elm = this.getElements("x" + infix + "_item_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->item_type->caption(), $tbl_inventory_add->item_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->item_model->Required) { ?>
				elm = this.getElements("x" + infix + "_item_model");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->item_model->caption(), $tbl_inventory_add->item_model->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->item_serial->Required) { ?>
				elm = this.getElements("x" + infix + "_item_serial");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->item_serial->caption(), $tbl_inventory_add->item_serial->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->office_id->Required) { ?>
				elm = this.getElements("x" + infix + "_office_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->office_id->caption(), $tbl_inventory_add->office_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->Region->Required) { ?>
				elm = this.getElements("x" + infix + "_Region");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Region->caption(), $tbl_inventory_add->Region->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->Province->Required) { ?>
				elm = this.getElements("x" + infix + "_Province");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Province->caption(), $tbl_inventory_add->Province->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->Cities->Required) { ?>
				elm = this.getElements("x" + infix + "_Cities");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Cities->caption(), $tbl_inventory_add->Cities->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->name_accountable->Required) { ?>
				elm = this.getElements("x" + infix + "_name_accountable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->name_accountable->caption(), $tbl_inventory_add->name_accountable->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->Designation->Required) { ?>
				elm = this.getElements("x" + infix + "_Designation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Designation->caption(), $tbl_inventory_add->Designation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->Current_Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Current_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Current_Location->caption(), $tbl_inventory_add->Current_Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->Last_Date_Check->Required) { ?>
				elm = this.getElements("x" + infix + "_Last_Date_Check");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->Last_Date_Check->caption(), $tbl_inventory_add->Last_Date_Check->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Last_Date_Check");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_inventory_add->Last_Date_Check->errorMessage()) ?>");
			<?php if ($tbl_inventory_add->employee_id->Required) { ?>
				elm = this.getElements("x" + infix + "_employee_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->employee_id->caption(), $tbl_inventory_add->employee_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->status->caption(), $tbl_inventory_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->remarks->caption(), $tbl_inventory_add->remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->picture->Required) { ?>
				felm = this.getElements("x" + infix + "_picture");
				elm = this.getElements("fn_x" + infix + "_picture");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->picture->caption(), $tbl_inventory_add->picture->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->user_last_modify->caption(), $tbl_inventory_add->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->date_last_modify->caption(), $tbl_inventory_add->date_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->pullout_i->Required) { ?>
				elm = this.getElements("x" + infix + "_pullout_i");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->pullout_i->caption(), $tbl_inventory_add->pullout_i->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_inventory_add->signatureID->Required) { ?>
				elm = this.getElements("x" + infix + "_signatureID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory_add->signatureID->caption(), $tbl_inventory_add->signatureID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_signatureID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_inventory_add->signatureID->errorMessage()) ?>");

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
	ftbl_inventoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_inventoryadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_inventoryadd.lists["x_Month_Purchased"] = <?php echo $tbl_inventory_add->Month_Purchased->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_Month_Purchased"].options = <?php echo JsonEncode($tbl_inventory_add->Month_Purchased->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_Year_Purchased"] = <?php echo $tbl_inventory_add->Year_Purchased->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_Year_Purchased"].options = <?php echo JsonEncode($tbl_inventory_add->Year_Purchased->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_item_type"] = <?php echo $tbl_inventory_add->item_type->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_item_type"].options = <?php echo JsonEncode($tbl_inventory_add->item_type->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_office_id"] = <?php echo $tbl_inventory_add->office_id->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_office_id"].options = <?php echo JsonEncode($tbl_inventory_add->office_id->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_Region"] = <?php echo $tbl_inventory_add->Region->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_Region"].options = <?php echo JsonEncode($tbl_inventory_add->Region->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_Province"] = <?php echo $tbl_inventory_add->Province->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_Province"].options = <?php echo JsonEncode($tbl_inventory_add->Province->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_Cities"] = <?php echo $tbl_inventory_add->Cities->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_Cities"].options = <?php echo JsonEncode($tbl_inventory_add->Cities->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_name_accountable"] = <?php echo $tbl_inventory_add->name_accountable->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_name_accountable"].options = <?php echo JsonEncode($tbl_inventory_add->name_accountable->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_Designation"] = <?php echo $tbl_inventory_add->Designation->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_Designation"].options = <?php echo JsonEncode($tbl_inventory_add->Designation->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_Current_Location"] = <?php echo $tbl_inventory_add->Current_Location->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_Current_Location"].options = <?php echo JsonEncode($tbl_inventory_add->Current_Location->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_employee_id"] = <?php echo $tbl_inventory_add->employee_id->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_employee_id"].options = <?php echo JsonEncode($tbl_inventory_add->employee_id->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_status"] = <?php echo $tbl_inventory_add->status->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_status"].options = <?php echo JsonEncode($tbl_inventory_add->status->lookupOptions()) ?>;
	ftbl_inventoryadd.lists["x_user_last_modify"] = <?php echo $tbl_inventory_add->user_last_modify->Lookup->toClientList($tbl_inventory_add) ?>;
	ftbl_inventoryadd.lists["x_user_last_modify"].options = <?php echo JsonEncode($tbl_inventory_add->user_last_modify->lookupOptions()) ?>;
	loadjs.done("ftbl_inventoryadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_inventory_add->showPageHeader(); ?>
<?php
$tbl_inventory_add->showMessage();
?>
<form name="ftbl_inventoryadd" id="ftbl_inventoryadd" class="<?php echo $tbl_inventory_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_inventory_add->IsModal ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($tbl_inventory_add->Month_Purchased->Visible) { // Month_Purchased ?>
	<div id="r_Month_Purchased" class="form-group row">
		<label id="elh_tbl_inventory_Month_Purchased" for="x_Month_Purchased" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Month_Purchased" type="text/html"><?php echo $tbl_inventory_add->Month_Purchased->caption() ?><?php echo $tbl_inventory_add->Month_Purchased->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Month_Purchased->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Month_Purchased" type="text/html"><span id="el_tbl_inventory_Month_Purchased">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Month_Purchased" data-value-separator="<?php echo $tbl_inventory_add->Month_Purchased->displayValueSeparatorAttribute() ?>" id="x_Month_Purchased" name="x_Month_Purchased"<?php echo $tbl_inventory_add->Month_Purchased->editAttributes() ?>>
			<?php echo $tbl_inventory_add->Month_Purchased->selectOptionListHtml("x_Month_Purchased") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->Month_Purchased->Lookup->getParamTag($tbl_inventory_add, "p_x_Month_Purchased") ?>
</span></script>
<?php echo $tbl_inventory_add->Month_Purchased->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->Year_Purchased->Visible) { // Year_Purchased ?>
	<div id="r_Year_Purchased" class="form-group row">
		<label id="elh_tbl_inventory_Year_Purchased" for="x_Year_Purchased" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Year_Purchased" type="text/html"><?php echo $tbl_inventory_add->Year_Purchased->caption() ?><?php echo $tbl_inventory_add->Year_Purchased->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Year_Purchased->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Year_Purchased" type="text/html"><span id="el_tbl_inventory_Year_Purchased">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Year_Purchased" data-value-separator="<?php echo $tbl_inventory_add->Year_Purchased->displayValueSeparatorAttribute() ?>" id="x_Year_Purchased" name="x_Year_Purchased"<?php echo $tbl_inventory_add->Year_Purchased->editAttributes() ?>>
			<?php echo $tbl_inventory_add->Year_Purchased->selectOptionListHtml("x_Year_Purchased") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->Year_Purchased->Lookup->getParamTag($tbl_inventory_add, "p_x_Year_Purchased") ?>
</span></script>
<?php echo $tbl_inventory_add->Year_Purchased->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->item_type->Visible) { // item_type ?>
	<div id="r_item_type" class="form-group row">
		<label id="elh_tbl_inventory_item_type" for="x_item_type" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_item_type" type="text/html"><?php echo $tbl_inventory_add->item_type->caption() ?><?php echo $tbl_inventory_add->item_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->item_type->cellAttributes() ?>>
<script id="tpx_tbl_inventory_item_type" type="text/html"><span id="el_tbl_inventory_item_type">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_item_type" data-value-separator="<?php echo $tbl_inventory_add->item_type->displayValueSeparatorAttribute() ?>" id="x_item_type" name="x_item_type"<?php echo $tbl_inventory_add->item_type->editAttributes() ?>>
			<?php echo $tbl_inventory_add->item_type->selectOptionListHtml("x_item_type") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->item_type->Lookup->getParamTag($tbl_inventory_add, "p_x_item_type") ?>
</span></script>
<?php echo $tbl_inventory_add->item_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->item_model->Visible) { // item_model ?>
	<div id="r_item_model" class="form-group row">
		<label id="elh_tbl_inventory_item_model" for="x_item_model" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_item_model" type="text/html"><?php echo $tbl_inventory_add->item_model->caption() ?><?php echo $tbl_inventory_add->item_model->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->item_model->cellAttributes() ?>>
<script id="tpx_tbl_inventory_item_model" type="text/html"><span id="el_tbl_inventory_item_model">
<input type="text" data-table="tbl_inventory" data-field="x_item_model" name="x_item_model" id="x_item_model" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_inventory_add->item_model->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory_add->item_model->EditValue ?>"<?php echo $tbl_inventory_add->item_model->editAttributes() ?>>
</span></script>
<?php echo $tbl_inventory_add->item_model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->item_serial->Visible) { // item_serial ?>
	<div id="r_item_serial" class="form-group row">
		<label id="elh_tbl_inventory_item_serial" for="x_item_serial" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_item_serial" type="text/html"><?php echo $tbl_inventory_add->item_serial->caption() ?><?php echo $tbl_inventory_add->item_serial->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->item_serial->cellAttributes() ?>>
<script id="tpx_tbl_inventory_item_serial" type="text/html"><span id="el_tbl_inventory_item_serial">
<input type="text" data-table="tbl_inventory" data-field="x_item_serial" name="x_item_serial" id="x_item_serial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_inventory_add->item_serial->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory_add->item_serial->EditValue ?>"<?php echo $tbl_inventory_add->item_serial->editAttributes() ?>>
</span></script>
<?php echo $tbl_inventory_add->item_serial->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->office_id->Visible) { // office_id ?>
	<div id="r_office_id" class="form-group row">
		<label id="elh_tbl_inventory_office_id" for="x_office_id" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_office_id" type="text/html"><?php echo $tbl_inventory_add->office_id->caption() ?><?php echo $tbl_inventory_add->office_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->office_id->cellAttributes() ?>>
<script id="tpx_tbl_inventory_office_id" type="text/html"><span id="el_tbl_inventory_office_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_office_id" data-value-separator="<?php echo $tbl_inventory_add->office_id->displayValueSeparatorAttribute() ?>" id="x_office_id" name="x_office_id"<?php echo $tbl_inventory_add->office_id->editAttributes() ?>>
			<?php echo $tbl_inventory_add->office_id->selectOptionListHtml("x_office_id") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->office_id->Lookup->getParamTag($tbl_inventory_add, "p_x_office_id") ?>
</span></script>
<?php echo $tbl_inventory_add->office_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->Region->Visible) { // Region ?>
	<div id="r_Region" class="form-group row">
		<label id="elh_tbl_inventory_Region" for="x_Region" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Region" type="text/html"><?php echo $tbl_inventory_add->Region->caption() ?><?php echo $tbl_inventory_add->Region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Region->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Region" type="text/html"><span id="el_tbl_inventory_Region">
<?php $tbl_inventory_add->Region->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Region" data-value-separator="<?php echo $tbl_inventory_add->Region->displayValueSeparatorAttribute() ?>" id="x_Region" name="x_Region"<?php echo $tbl_inventory_add->Region->editAttributes() ?>>
			<?php echo $tbl_inventory_add->Region->selectOptionListHtml("x_Region") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->Region->Lookup->getParamTag($tbl_inventory_add, "p_x_Region") ?>
</span></script>
<?php echo $tbl_inventory_add->Region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->Province->Visible) { // Province ?>
	<div id="r_Province" class="form-group row">
		<label id="elh_tbl_inventory_Province" for="x_Province" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Province" type="text/html"><?php echo $tbl_inventory_add->Province->caption() ?><?php echo $tbl_inventory_add->Province->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Province->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Province" type="text/html"><span id="el_tbl_inventory_Province">
<?php $tbl_inventory_add->Province->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Province" data-value-separator="<?php echo $tbl_inventory_add->Province->displayValueSeparatorAttribute() ?>" id="x_Province" name="x_Province"<?php echo $tbl_inventory_add->Province->editAttributes() ?>>
			<?php echo $tbl_inventory_add->Province->selectOptionListHtml("x_Province") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->Province->Lookup->getParamTag($tbl_inventory_add, "p_x_Province") ?>
</span></script>
<?php echo $tbl_inventory_add->Province->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->Cities->Visible) { // Cities ?>
	<div id="r_Cities" class="form-group row">
		<label id="elh_tbl_inventory_Cities" for="x_Cities" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Cities" type="text/html"><?php echo $tbl_inventory_add->Cities->caption() ?><?php echo $tbl_inventory_add->Cities->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Cities->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Cities" type="text/html"><span id="el_tbl_inventory_Cities">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Cities" data-value-separator="<?php echo $tbl_inventory_add->Cities->displayValueSeparatorAttribute() ?>" id="x_Cities" name="x_Cities"<?php echo $tbl_inventory_add->Cities->editAttributes() ?>>
			<?php echo $tbl_inventory_add->Cities->selectOptionListHtml("x_Cities") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->Cities->Lookup->getParamTag($tbl_inventory_add, "p_x_Cities") ?>
</span></script>
<?php echo $tbl_inventory_add->Cities->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->name_accountable->Visible) { // name_accountable ?>
	<div id="r_name_accountable" class="form-group row">
		<label id="elh_tbl_inventory_name_accountable" for="x_name_accountable" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_name_accountable" type="text/html"><?php echo $tbl_inventory_add->name_accountable->caption() ?><?php echo $tbl_inventory_add->name_accountable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->name_accountable->cellAttributes() ?>>
<script id="tpx_tbl_inventory_name_accountable" type="text/html"><span id="el_tbl_inventory_name_accountable">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_name_accountable" data-value-separator="<?php echo $tbl_inventory_add->name_accountable->displayValueSeparatorAttribute() ?>" id="x_name_accountable" name="x_name_accountable"<?php echo $tbl_inventory_add->name_accountable->editAttributes() ?>>
			<?php echo $tbl_inventory_add->name_accountable->selectOptionListHtml("x_name_accountable") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->name_accountable->Lookup->getParamTag($tbl_inventory_add, "p_x_name_accountable") ?>
</span></script>
<?php echo $tbl_inventory_add->name_accountable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->Designation->Visible) { // Designation ?>
	<div id="r_Designation" class="form-group row">
		<label id="elh_tbl_inventory_Designation" for="x_Designation" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Designation" type="text/html"><?php echo $tbl_inventory_add->Designation->caption() ?><?php echo $tbl_inventory_add->Designation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Designation->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Designation" type="text/html"><span id="el_tbl_inventory_Designation">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Designation" data-value-separator="<?php echo $tbl_inventory_add->Designation->displayValueSeparatorAttribute() ?>" id="x_Designation" name="x_Designation"<?php echo $tbl_inventory_add->Designation->editAttributes() ?>>
			<?php echo $tbl_inventory_add->Designation->selectOptionListHtml("x_Designation") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->Designation->Lookup->getParamTag($tbl_inventory_add, "p_x_Designation") ?>
</span></script>
<?php echo $tbl_inventory_add->Designation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->Current_Location->Visible) { // Current_Location ?>
	<div id="r_Current_Location" class="form-group row">
		<label id="elh_tbl_inventory_Current_Location" for="x_Current_Location" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Current_Location" type="text/html"><?php echo $tbl_inventory_add->Current_Location->caption() ?><?php echo $tbl_inventory_add->Current_Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Current_Location->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Current_Location" type="text/html"><span id="el_tbl_inventory_Current_Location">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_Current_Location" data-value-separator="<?php echo $tbl_inventory_add->Current_Location->displayValueSeparatorAttribute() ?>" id="x_Current_Location" name="x_Current_Location"<?php echo $tbl_inventory_add->Current_Location->editAttributes() ?>>
			<?php echo $tbl_inventory_add->Current_Location->selectOptionListHtml("x_Current_Location") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->Current_Location->Lookup->getParamTag($tbl_inventory_add, "p_x_Current_Location") ?>
</span></script>
<?php echo $tbl_inventory_add->Current_Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->Last_Date_Check->Visible) { // Last_Date_Check ?>
	<div id="r_Last_Date_Check" class="form-group row">
		<label id="elh_tbl_inventory_Last_Date_Check" for="x_Last_Date_Check" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_Last_Date_Check" type="text/html"><?php echo $tbl_inventory_add->Last_Date_Check->caption() ?><?php echo $tbl_inventory_add->Last_Date_Check->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->Last_Date_Check->cellAttributes() ?>>
<script id="tpx_tbl_inventory_Last_Date_Check" type="text/html"><span id="el_tbl_inventory_Last_Date_Check">
<input type="text" data-table="tbl_inventory" data-field="x_Last_Date_Check" data-format="5" name="x_Last_Date_Check" id="x_Last_Date_Check" placeholder="<?php echo HtmlEncode($tbl_inventory_add->Last_Date_Check->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory_add->Last_Date_Check->EditValue ?>"<?php echo $tbl_inventory_add->Last_Date_Check->editAttributes() ?>>
<?php if (!$tbl_inventory_add->Last_Date_Check->ReadOnly && !$tbl_inventory_add->Last_Date_Check->Disabled && !isset($tbl_inventory_add->Last_Date_Check->EditAttrs["readonly"]) && !isset($tbl_inventory_add->Last_Date_Check->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="tbl_inventoryadd_js">
loadjs.ready(["ftbl_inventoryadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_inventoryadd", "x_Last_Date_Check", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php echo $tbl_inventory_add->Last_Date_Check->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->employee_id->Visible) { // employee_id ?>
	<div id="r_employee_id" class="form-group row">
		<label id="elh_tbl_inventory_employee_id" for="x_employee_id" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_employee_id" type="text/html"><?php echo $tbl_inventory_add->employee_id->caption() ?><?php echo $tbl_inventory_add->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->employee_id->cellAttributes() ?>>
<script id="tpx_tbl_inventory_employee_id" type="text/html"><span id="el_tbl_inventory_employee_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_employee_id" data-value-separator="<?php echo $tbl_inventory_add->employee_id->displayValueSeparatorAttribute() ?>" id="x_employee_id" name="x_employee_id"<?php echo $tbl_inventory_add->employee_id->editAttributes() ?>>
			<?php echo $tbl_inventory_add->employee_id->selectOptionListHtml("x_employee_id") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->employee_id->Lookup->getParamTag($tbl_inventory_add, "p_x_employee_id") ?>
</span></script>
<?php echo $tbl_inventory_add->employee_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_tbl_inventory_status" for="x_status" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_status" type="text/html"><?php echo $tbl_inventory_add->status->caption() ?><?php echo $tbl_inventory_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->status->cellAttributes() ?>>
<script id="tpx_tbl_inventory_status" type="text/html"><span id="el_tbl_inventory_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_inventory" data-field="x_status" data-value-separator="<?php echo $tbl_inventory_add->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $tbl_inventory_add->status->editAttributes() ?>>
			<?php echo $tbl_inventory_add->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $tbl_inventory_add->status->Lookup->getParamTag($tbl_inventory_add, "p_x_status") ?>
</span></script>
<?php echo $tbl_inventory_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->remarks->Visible) { // remarks ?>
	<div id="r_remarks" class="form-group row">
		<label id="elh_tbl_inventory_remarks" for="x_remarks" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_remarks" type="text/html"><?php echo $tbl_inventory_add->remarks->caption() ?><?php echo $tbl_inventory_add->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->remarks->cellAttributes() ?>>
<script id="tpx_tbl_inventory_remarks" type="text/html"><span id="el_tbl_inventory_remarks">
<textarea data-table="tbl_inventory" data-field="x_remarks" name="x_remarks" id="x_remarks" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_inventory_add->remarks->getPlaceHolder()) ?>"<?php echo $tbl_inventory_add->remarks->editAttributes() ?>><?php echo $tbl_inventory_add->remarks->EditValue ?></textarea>
</span></script>
<?php echo $tbl_inventory_add->remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->picture->Visible) { // picture ?>
	<div id="r_picture" class="form-group row">
		<label id="elh_tbl_inventory_picture" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_picture" type="text/html"><?php echo $tbl_inventory_add->picture->caption() ?><?php echo $tbl_inventory_add->picture->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->picture->cellAttributes() ?>>
<script id="tpx_tbl_inventory_picture" type="text/html"><span id="el_tbl_inventory_picture">
<div id="fd_x_picture">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $tbl_inventory_add->picture->title() ?>" data-table="tbl_inventory" data-field="x_picture" name="x_picture" id="x_picture" lang="<?php echo CurrentLanguageID() ?>"<?php echo $tbl_inventory_add->picture->editAttributes() ?><?php if ($tbl_inventory_add->picture->ReadOnly || $tbl_inventory_add->picture->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_picture"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_picture" id= "fn_x_picture" value="<?php echo $tbl_inventory_add->picture->Upload->FileName ?>">
<input type="hidden" name="fa_x_picture" id= "fa_x_picture" value="0">
<input type="hidden" name="fs_x_picture" id= "fs_x_picture" value="0">
<input type="hidden" name="fx_x_picture" id= "fx_x_picture" value="<?php echo $tbl_inventory_add->picture->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_picture" id= "fm_x_picture" value="<?php echo $tbl_inventory_add->picture->UploadMaxFileSize ?>">
</div>
<table id="ft_x_picture" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span></script>
<?php echo $tbl_inventory_add->picture->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->pullout_i->Visible) { // pullout_i ?>
	<div id="r_pullout_i" class="form-group row">
		<label id="elh_tbl_inventory_pullout_i" for="x_pullout_i" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_pullout_i" type="text/html"><?php echo $tbl_inventory_add->pullout_i->caption() ?><?php echo $tbl_inventory_add->pullout_i->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->pullout_i->cellAttributes() ?>>
<script id="tpx_tbl_inventory_pullout_i" type="text/html"><span id="el_tbl_inventory_pullout_i">
<input type="text" data-table="tbl_inventory" data-field="x_pullout_i" name="x_pullout_i" id="x_pullout_i" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_inventory_add->pullout_i->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory_add->pullout_i->EditValue ?>"<?php echo $tbl_inventory_add->pullout_i->editAttributes() ?>>
</span></script>
<?php echo $tbl_inventory_add->pullout_i->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory_add->signatureID->Visible) { // signatureID ?>
	<div id="r_signatureID" class="form-group row">
		<label id="elh_tbl_inventory_signatureID" for="x_signatureID" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><script id="tpc_tbl_inventory_signatureID" type="text/html"><?php echo $tbl_inventory_add->signatureID->caption() ?><?php echo $tbl_inventory_add->signatureID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div <?php echo $tbl_inventory_add->signatureID->cellAttributes() ?>>
<script id="tpx_tbl_inventory_signatureID" type="text/html"><span id="el_tbl_inventory_signatureID">
<input type="text" data-table="tbl_inventory" data-field="x_signatureID" name="x_signatureID" id="x_signatureID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_inventory_add->signatureID->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory_add->signatureID->EditValue ?>"<?php echo $tbl_inventory_add->signatureID->editAttributes() ?>>
</span></script>
<?php echo $tbl_inventory_add->signatureID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_tbl_inventoryadd" class="ew-custom-template"></div>
<script id="tpm_tbl_inventoryadd" type="text/html">
<div id="ct_tbl_inventory_add"><!--<table class="ew-table">-->
<table style="height: 152px; width: px; " border="4" cellspacing="5" cellpadding="5">
<!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_Month_Purchased"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Month_Purchased")/}}</td>
<td style="width: 310.75px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_Region"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Region")/}}</td>
<td style="width: 284.25px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_item_type"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_item_type")/}}</td>
</tr>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_Year_Purchased"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Year_Purchased")/}}</td>
<td style="width: 310.75px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_Province"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Province")/}}</td>
<td style="width: 284.25px; height: 40px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_inventory_item_model"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_item_model")/}}</td>
</tr>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_Last_Date_Check"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Last_Date_Check")/}}</td>
<td style="width: 310.75px; height: 40px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_inventory_Cities"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Cities")/}}</td>
<td style="width: 284.25px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_item_serial"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_item_serial")/}}<br /><br /></td>
</tr>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_name_accountable"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_name_accountable")/}}</td>
<td style="width: 310.75px; height: 40px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_inventory_office_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_office_id")/}}</td>
<td style="width: 284.25px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_employee_id"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_employee_id")/}}</td>
</tr>
<tr style="height: 40px;">
<td style="width: 311px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_Designation"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Designation")/}}</td>
<td style="width: 310.75px; height: 40px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_inventory_Current_Location"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_Current_Location")/}}</td>
<td style="width: 284.25px; height: 40px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_inventory_status"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_status")/}}</td>
</tr>
<tr style="height: 35px;">
<td style="width: 311px; height: 35px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_inventory_signatureID"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_signatureID")/}}</td>
<td style="width: 310.75px; height: 66px; text-align: left;" colspan="2" rowspan="2" scope="row">&nbsp;{{include tmpl="#tpc_tbl_inventory_remarks"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_remarks")/}}&nbsp;</td>
</tr>
<tr style="height: 31px;">
<td style="width: 311px; height: 31px; text-align: left;" scope="row">&nbsp;{{include tmpl="#tpc_tbl_inventory_picture"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_inventory_picture")/}}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php
	if (in_array("tbl_repair", explode(",", $tbl_inventory->getCurrentDetailTable())) && $tbl_repair->DetailAdd) {
?>
<?php if ($tbl_inventory->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("tbl_repair", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_repairgrid.php" ?>
<?php } ?>
<?php if (!$tbl_inventory_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_inventory_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_inventory_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_inventory->Rows) ?> };
	ew.applyTemplate("tpd_tbl_inventoryadd", "tpm_tbl_inventoryadd", "tbl_inventoryadd", "<?php echo $tbl_inventory->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_inventoryadd_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_inventory_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_pullout_i").hide(),$("#r_pullout_i").hide(),$("#x_signatureID").hide(),$("#r_signatureID").hide()});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_inventory_add->terminate();
?>