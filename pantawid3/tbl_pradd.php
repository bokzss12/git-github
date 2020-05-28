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
$tbl_pr_add = new tbl_pr_add();

// Run the page
$tbl_pr_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_pradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_pradd = currentForm = new ew.Form("ftbl_pradd", "add");

	// Validate form
	ftbl_pradd.validate = function() {
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
			<?php if ($tbl_pr_add->date_prep->Required) { ?>
				elm = this.getElements("x" + infix + "_date_prep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->date_prep->caption(), $tbl_pr_add->date_prep->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_prep");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_pr_add->date_prep->errorMessage()) ?>");
			<?php if ($tbl_pr_add->pr_number->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->pr_number->caption(), $tbl_pr_add->pr_number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_add->purpose->Required) { ?>
				elm = this.getElements("x" + infix + "_purpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->purpose->caption(), $tbl_pr_add->purpose->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_add->pr_status->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->pr_status->caption(), $tbl_pr_add->pr_status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_add->sup_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sup_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->sup_id->caption(), $tbl_pr_add->sup_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_add->date_delivered->Required) { ?>
				elm = this.getElements("x" + infix + "_date_delivered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->date_delivered->caption(), $tbl_pr_add->date_delivered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_delivered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_pr_add->date_delivered->errorMessage()) ?>");
			<?php if ($tbl_pr_add->employeeid->Required) { ?>
				elm = this.getElements("x" + infix + "_employeeid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->employeeid->caption(), $tbl_pr_add->employeeid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_add->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->user_last_modify->caption(), $tbl_pr_add->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_add->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_add->date_last_modify->caption(), $tbl_pr_add->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_pradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_pradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_pradd.lists["x_pr_status"] = <?php echo $tbl_pr_add->pr_status->Lookup->toClientList($tbl_pr_add) ?>;
	ftbl_pradd.lists["x_pr_status"].options = <?php echo JsonEncode($tbl_pr_add->pr_status->lookupOptions()) ?>;
	ftbl_pradd.lists["x_sup_id"] = <?php echo $tbl_pr_add->sup_id->Lookup->toClientList($tbl_pr_add) ?>;
	ftbl_pradd.lists["x_sup_id"].options = <?php echo JsonEncode($tbl_pr_add->sup_id->lookupOptions()) ?>;
	ftbl_pradd.lists["x_employeeid"] = <?php echo $tbl_pr_add->employeeid->Lookup->toClientList($tbl_pr_add) ?>;
	ftbl_pradd.lists["x_employeeid"].options = <?php echo JsonEncode($tbl_pr_add->employeeid->lookupOptions()) ?>;
	loadjs.done("ftbl_pradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_pr_add->showPageHeader(); ?>
<?php
$tbl_pr_add->showMessage();
?>
<form name="ftbl_pradd" id="ftbl_pradd" class="<?php echo $tbl_pr_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pr_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_pr_add->date_prep->Visible) { // date_prep ?>
	<div id="r_date_prep" class="form-group row">
		<label id="elh_tbl_pr_date_prep" for="x_date_prep" class="<?php echo $tbl_pr_add->LeftColumnClass ?>"><?php echo $tbl_pr_add->date_prep->caption() ?><?php echo $tbl_pr_add->date_prep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_add->RightColumnClass ?>"><div <?php echo $tbl_pr_add->date_prep->cellAttributes() ?>>
<span id="el_tbl_pr_date_prep">
<input type="text" data-table="tbl_pr" data-field="x_date_prep" name="x_date_prep" id="x_date_prep" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_pr_add->date_prep->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_add->date_prep->EditValue ?>"<?php echo $tbl_pr_add->date_prep->editAttributes() ?>>
<?php if (!$tbl_pr_add->date_prep->ReadOnly && !$tbl_pr_add->date_prep->Disabled && !isset($tbl_pr_add->date_prep->EditAttrs["readonly"]) && !isset($tbl_pr_add->date_prep->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_pradd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_pradd", "x_date_prep", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tbl_pr_add->date_prep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_add->pr_number->Visible) { // pr_number ?>
	<div id="r_pr_number" class="form-group row">
		<label id="elh_tbl_pr_pr_number" for="x_pr_number" class="<?php echo $tbl_pr_add->LeftColumnClass ?>"><?php echo $tbl_pr_add->pr_number->caption() ?><?php echo $tbl_pr_add->pr_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_add->RightColumnClass ?>"><div <?php echo $tbl_pr_add->pr_number->cellAttributes() ?>>
<span id="el_tbl_pr_pr_number">
<input type="text" data-table="tbl_pr" data-field="x_pr_number" name="x_pr_number" id="x_pr_number" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_pr_add->pr_number->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_add->pr_number->EditValue ?>"<?php echo $tbl_pr_add->pr_number->editAttributes() ?>>
</span>
<?php echo $tbl_pr_add->pr_number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_add->purpose->Visible) { // purpose ?>
	<div id="r_purpose" class="form-group row">
		<label id="elh_tbl_pr_purpose" for="x_purpose" class="<?php echo $tbl_pr_add->LeftColumnClass ?>"><?php echo $tbl_pr_add->purpose->caption() ?><?php echo $tbl_pr_add->purpose->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_add->RightColumnClass ?>"><div <?php echo $tbl_pr_add->purpose->cellAttributes() ?>>
<span id="el_tbl_pr_purpose">
<textarea data-table="tbl_pr" data-field="x_purpose" name="x_purpose" id="x_purpose" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_pr_add->purpose->getPlaceHolder()) ?>"<?php echo $tbl_pr_add->purpose->editAttributes() ?>><?php echo $tbl_pr_add->purpose->EditValue ?></textarea>
</span>
<?php echo $tbl_pr_add->purpose->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_add->pr_status->Visible) { // pr_status ?>
	<div id="r_pr_status" class="form-group row">
		<label id="elh_tbl_pr_pr_status" for="x_pr_status" class="<?php echo $tbl_pr_add->LeftColumnClass ?>"><?php echo $tbl_pr_add->pr_status->caption() ?><?php echo $tbl_pr_add->pr_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_add->RightColumnClass ?>"><div <?php echo $tbl_pr_add->pr_status->cellAttributes() ?>>
<span id="el_tbl_pr_pr_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pr" data-field="x_pr_status" data-value-separator="<?php echo $tbl_pr_add->pr_status->displayValueSeparatorAttribute() ?>" id="x_pr_status" name="x_pr_status"<?php echo $tbl_pr_add->pr_status->editAttributes() ?>>
			<?php echo $tbl_pr_add->pr_status->selectOptionListHtml("x_pr_status") ?>
		</select>
</div>
<?php echo $tbl_pr_add->pr_status->Lookup->getParamTag($tbl_pr_add, "p_x_pr_status") ?>
</span>
<?php echo $tbl_pr_add->pr_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_add->sup_id->Visible) { // sup_id ?>
	<div id="r_sup_id" class="form-group row">
		<label id="elh_tbl_pr_sup_id" for="x_sup_id" class="<?php echo $tbl_pr_add->LeftColumnClass ?>"><?php echo $tbl_pr_add->sup_id->caption() ?><?php echo $tbl_pr_add->sup_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_add->RightColumnClass ?>"><div <?php echo $tbl_pr_add->sup_id->cellAttributes() ?>>
<span id="el_tbl_pr_sup_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pr" data-field="x_sup_id" data-value-separator="<?php echo $tbl_pr_add->sup_id->displayValueSeparatorAttribute() ?>" id="x_sup_id" name="x_sup_id"<?php echo $tbl_pr_add->sup_id->editAttributes() ?>>
			<?php echo $tbl_pr_add->sup_id->selectOptionListHtml("x_sup_id") ?>
		</select>
</div>
<?php echo $tbl_pr_add->sup_id->Lookup->getParamTag($tbl_pr_add, "p_x_sup_id") ?>
</span>
<?php echo $tbl_pr_add->sup_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_add->date_delivered->Visible) { // date_delivered ?>
	<div id="r_date_delivered" class="form-group row">
		<label id="elh_tbl_pr_date_delivered" for="x_date_delivered" class="<?php echo $tbl_pr_add->LeftColumnClass ?>"><?php echo $tbl_pr_add->date_delivered->caption() ?><?php echo $tbl_pr_add->date_delivered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_add->RightColumnClass ?>"><div <?php echo $tbl_pr_add->date_delivered->cellAttributes() ?>>
<span id="el_tbl_pr_date_delivered">
<input type="text" data-table="tbl_pr" data-field="x_date_delivered" name="x_date_delivered" id="x_date_delivered" maxlength="10" placeholder="<?php echo HtmlEncode($tbl_pr_add->date_delivered->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_add->date_delivered->EditValue ?>"<?php echo $tbl_pr_add->date_delivered->editAttributes() ?>>
<?php if (!$tbl_pr_add->date_delivered->ReadOnly && !$tbl_pr_add->date_delivered->Disabled && !isset($tbl_pr_add->date_delivered->EditAttrs["readonly"]) && !isset($tbl_pr_add->date_delivered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_pradd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_pradd", "x_date_delivered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tbl_pr_add->date_delivered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_add->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label id="elh_tbl_pr_employeeid" for="x_employeeid" class="<?php echo $tbl_pr_add->LeftColumnClass ?>"><?php echo $tbl_pr_add->employeeid->caption() ?><?php echo $tbl_pr_add->employeeid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_add->RightColumnClass ?>"><div <?php echo $tbl_pr_add->employeeid->cellAttributes() ?>>
<span id="el_tbl_pr_employeeid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pr" data-field="x_employeeid" data-value-separator="<?php echo $tbl_pr_add->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $tbl_pr_add->employeeid->editAttributes() ?>>
			<?php echo $tbl_pr_add->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $tbl_pr_add->employeeid->Lookup->getParamTag($tbl_pr_add, "p_x_employeeid") ?>
</span>
<?php echo $tbl_pr_add->employeeid->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("tbl_spec", explode(",", $tbl_pr->getCurrentDetailTable())) && $tbl_spec->DetailAdd) {
?>
<?php if ($tbl_pr->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("tbl_spec", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_specgrid.php" ?>
<?php } ?>
<?php if (!$tbl_pr_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_pr_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pr_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_pr_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_date_delivered").attr("disabled","disabled")});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_pr_add->terminate();
?>