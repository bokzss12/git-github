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
$inventory_view_edit = new inventory_view_edit();

// Run the page
$inventory_view_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventory_view_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finventory_viewedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	finventory_viewedit = currentForm = new ew.Form("finventory_viewedit", "edit");

	// Validate form
	finventory_viewedit.validate = function() {
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
			<?php if ($inventory_view_edit->pullout_i->Required) { ?>
				elm = this.getElements("x" + infix + "_pullout_i[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventory_view_edit->pullout_i->caption(), $inventory_view_edit->pullout_i->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inventory_view_edit->Current_Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Current_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventory_view_edit->Current_Location->caption(), $inventory_view_edit->Current_Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($inventory_view_edit->pullout_date->Required) { ?>
				elm = this.getElements("x" + infix + "_pullout_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventory_view_edit->pullout_date->caption(), $inventory_view_edit->pullout_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pullout_date");
				if (elm && !ew.checkDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($inventory_view_edit->pullout_date->errorMessage()) ?>");

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
	finventory_viewedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	finventory_viewedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	finventory_viewedit.lists["x_pullout_i[]"] = <?php echo $inventory_view_edit->pullout_i->Lookup->toClientList($inventory_view_edit) ?>;
	finventory_viewedit.lists["x_pullout_i[]"].options = <?php echo JsonEncode($inventory_view_edit->pullout_i->options(FALSE, TRUE)) ?>;
	finventory_viewedit.lists["x_Current_Location"] = <?php echo $inventory_view_edit->Current_Location->Lookup->toClientList($inventory_view_edit) ?>;
	finventory_viewedit.lists["x_Current_Location"].options = <?php echo JsonEncode($inventory_view_edit->Current_Location->lookupOptions()) ?>;
	loadjs.done("finventory_viewedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $inventory_view_edit->showPageHeader(); ?>
<?php
$inventory_view_edit->showMessage();
?>
<form name="finventory_viewedit" id="finventory_viewedit" class="<?php echo $inventory_view_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventory_view">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$inventory_view_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($inventory_view_edit->pullout_i->Visible) { // pullout_i ?>
	<div id="r_pullout_i" class="form-group row">
		<label id="elh_inventory_view_pullout_i" class="<?php echo $inventory_view_edit->LeftColumnClass ?>"><?php echo $inventory_view_edit->pullout_i->caption() ?><?php echo $inventory_view_edit->pullout_i->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventory_view_edit->RightColumnClass ?>"><div <?php echo $inventory_view_edit->pullout_i->cellAttributes() ?>>
<span id="el_inventory_view_pullout_i">
<div id="tp_x_pullout_i" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="inventory_view" data-field="x_pullout_i" data-value-separator="<?php echo $inventory_view_edit->pullout_i->displayValueSeparatorAttribute() ?>" name="x_pullout_i[]" id="x_pullout_i[]" value="{value}"<?php echo $inventory_view_edit->pullout_i->editAttributes() ?>></div>
<div id="dsl_x_pullout_i" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $inventory_view_edit->pullout_i->checkBoxListHtml(FALSE, "x_pullout_i[]") ?>
</div></div>
</span>
<?php echo $inventory_view_edit->pullout_i->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventory_view_edit->Current_Location->Visible) { // Current_Location ?>
	<div id="r_Current_Location" class="form-group row">
		<label id="elh_inventory_view_Current_Location" for="x_Current_Location" class="<?php echo $inventory_view_edit->LeftColumnClass ?>"><?php echo $inventory_view_edit->Current_Location->caption() ?><?php echo $inventory_view_edit->Current_Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventory_view_edit->RightColumnClass ?>"><div <?php echo $inventory_view_edit->Current_Location->cellAttributes() ?>>
<span id="el_inventory_view_Current_Location">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="inventory_view" data-field="x_Current_Location" data-value-separator="<?php echo $inventory_view_edit->Current_Location->displayValueSeparatorAttribute() ?>" id="x_Current_Location" name="x_Current_Location"<?php echo $inventory_view_edit->Current_Location->editAttributes() ?>>
			<?php echo $inventory_view_edit->Current_Location->selectOptionListHtml("x_Current_Location") ?>
		</select>
</div>
<?php echo $inventory_view_edit->Current_Location->Lookup->getParamTag($inventory_view_edit, "p_x_Current_Location") ?>
</span>
<?php echo $inventory_view_edit->Current_Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventory_view_edit->pullout_date->Visible) { // pullout_date ?>
	<div id="r_pullout_date" class="form-group row">
		<label id="elh_inventory_view_pullout_date" for="x_pullout_date" class="<?php echo $inventory_view_edit->LeftColumnClass ?>"><?php echo $inventory_view_edit->pullout_date->caption() ?><?php echo $inventory_view_edit->pullout_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventory_view_edit->RightColumnClass ?>"><div <?php echo $inventory_view_edit->pullout_date->cellAttributes() ?>>
<span id="el_inventory_view_pullout_date">
<input type="text" data-table="inventory_view" data-field="x_pullout_date" data-format="5" name="x_pullout_date" id="x_pullout_date" placeholder="<?php echo HtmlEncode($inventory_view_edit->pullout_date->getPlaceHolder()) ?>" value="<?php echo $inventory_view_edit->pullout_date->EditValue ?>"<?php echo $inventory_view_edit->pullout_date->editAttributes() ?>>
<?php if (!$inventory_view_edit->pullout_date->ReadOnly && !$inventory_view_edit->pullout_date->Disabled && !isset($inventory_view_edit->pullout_date->EditAttrs["readonly"]) && !isset($inventory_view_edit->pullout_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["finventory_viewedit", "datetimepicker"], function() {
	ew.createDateTimePicker("finventory_viewedit", "x_pullout_date", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php } ?>
</span>
<?php echo $inventory_view_edit->pullout_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="inventory_view" data-field="x_inventory_id" name="x_inventory_id" id="x_inventory_id" value="<?php echo HtmlEncode($inventory_view_edit->inventory_id->CurrentValue) ?>">
<?php if (!$inventory_view_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inventory_view_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inventory_view_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inventory_view_edit->showPageFooter();
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
$inventory_view_edit->terminate();
?>