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
$ta_report2_search = new ta_report2_search();

// Run the page
$ta_report2_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ta_report2_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fta_report2search, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($ta_report2_search->IsModal) { ?>
	fta_report2search = currentAdvancedSearchForm = new ew.Form("fta_report2search", "search");
	<?php } else { ?>
	fta_report2search = currentForm = new ew.Form("fta_report2search", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fta_report2search.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_item_date_receive");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ta_report2_search->item_date_receive->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fta_report2search.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fta_report2search.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fta_report2search.lists["x_employeeid"] = <?php echo $ta_report2_search->employeeid->Lookup->toClientList($ta_report2_search) ?>;
	fta_report2search.lists["x_employeeid"].options = <?php echo JsonEncode($ta_report2_search->employeeid->lookupOptions()) ?>;
	fta_report2search.lists["x_status_desc"] = <?php echo $ta_report2_search->status_desc->Lookup->toClientList($ta_report2_search) ?>;
	fta_report2search.lists["x_status_desc"].options = <?php echo JsonEncode($ta_report2_search->status_desc->lookupOptions()) ?>;
	loadjs.done("fta_report2search");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$(document).ready(function(){$("form").append('<button class="btn btn-danger ewButton" name="btnCancel" id="btnCancel" type="Button"><?php echo $Language->Phrase("") ?>Back to Main</button>'),$("#btnCancel").attr("onClick","document.location.href='tbl_itemlist.php';")});
});
</script>
<?php $ta_report2_search->showPageHeader(); ?>
<?php
$ta_report2_search->showMessage();
?>
<form name="fta_report2search" id="fta_report2search" class="<?php echo $ta_report2_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ta_report2">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$ta_report2_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($ta_report2_search->item_date_receive->Visible) { // item_date_receive ?>
	<div id="r_item_date_receive" class="form-group row">
		<label for="x_item_date_receive" class="<?php echo $ta_report2_search->LeftColumnClass ?>"><span id="elh_ta_report2_item_date_receive"><?php echo $ta_report2_search->item_date_receive->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_item_date_receive" id="z_item_date_receive" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $ta_report2_search->RightColumnClass ?>"><div <?php echo $ta_report2_search->item_date_receive->cellAttributes() ?>>
			<span id="el_ta_report2_item_date_receive" class="ew-search-field">
<input type="text" data-table="ta_report2" data-field="x_item_date_receive" name="x_item_date_receive" id="x_item_date_receive" size="70" maxlength="10" placeholder="<?php echo HtmlEncode($ta_report2_search->item_date_receive->getPlaceHolder()) ?>" value="<?php echo $ta_report2_search->item_date_receive->EditValue ?>"<?php echo $ta_report2_search->item_date_receive->editAttributes() ?>>
<?php if (!$ta_report2_search->item_date_receive->ReadOnly && !$ta_report2_search->item_date_receive->Disabled && !isset($ta_report2_search->item_date_receive->EditAttrs["readonly"]) && !isset($ta_report2_search->item_date_receive->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fta_report2search", "datetimepicker"], function() {
	ew.createDateTimePicker("fta_report2search", "x_item_date_receive", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_ta_report2_item_date_receive" class="ew-search-field2">
<input type="text" data-table="ta_report2" data-field="x_item_date_receive" name="y_item_date_receive" id="y_item_date_receive" size="70" maxlength="10" placeholder="<?php echo HtmlEncode($ta_report2_search->item_date_receive->getPlaceHolder()) ?>" value="<?php echo $ta_report2_search->item_date_receive->EditValue2 ?>"<?php echo $ta_report2_search->item_date_receive->editAttributes() ?>>
<?php if (!$ta_report2_search->item_date_receive->ReadOnly && !$ta_report2_search->item_date_receive->Disabled && !isset($ta_report2_search->item_date_receive->EditAttrs["readonly"]) && !isset($ta_report2_search->item_date_receive->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fta_report2search", "datetimepicker"], function() {
	ew.createDateTimePicker("fta_report2search", "y_item_date_receive", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ta_report2_search->employeeid->Visible) { // employeeid ?>
	<div id="r_employeeid" class="form-group row">
		<label for="x_employeeid" class="<?php echo $ta_report2_search->LeftColumnClass ?>"><span id="elh_ta_report2_employeeid"><?php echo $ta_report2_search->employeeid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_employeeid" id="z_employeeid" value="=">
</span>
		</label>
		<div class="<?php echo $ta_report2_search->RightColumnClass ?>"><div <?php echo $ta_report2_search->employeeid->cellAttributes() ?>>
			<span id="el_ta_report2_employeeid" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ta_report2" data-field="x_employeeid" data-value-separator="<?php echo $ta_report2_search->employeeid->displayValueSeparatorAttribute() ?>" id="x_employeeid" name="x_employeeid"<?php echo $ta_report2_search->employeeid->editAttributes() ?>>
			<?php echo $ta_report2_search->employeeid->selectOptionListHtml("x_employeeid") ?>
		</select>
</div>
<?php echo $ta_report2_search->employeeid->Lookup->getParamTag($ta_report2_search, "p_x_employeeid") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ta_report2_search->status_desc->Visible) { // status_desc ?>
	<div id="r_status_desc" class="form-group row">
		<label for="x_status_desc" class="<?php echo $ta_report2_search->LeftColumnClass ?>"><span id="elh_ta_report2_status_desc"><?php echo $ta_report2_search->status_desc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status_desc" id="z_status_desc" value="=">
</span>
		</label>
		<div class="<?php echo $ta_report2_search->RightColumnClass ?>"><div <?php echo $ta_report2_search->status_desc->cellAttributes() ?>>
			<span id="el_ta_report2_status_desc" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ta_report2" data-field="x_status_desc" data-value-separator="<?php echo $ta_report2_search->status_desc->displayValueSeparatorAttribute() ?>" id="x_status_desc" name="x_status_desc"<?php echo $ta_report2_search->status_desc->editAttributes() ?>>
			<?php echo $ta_report2_search->status_desc->selectOptionListHtml("x_status_desc") ?>
		</select>
</div>
<?php echo $ta_report2_search->status_desc->Lookup->getParamTag($ta_report2_search, "p_x_status_desc") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ta_report2_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ta_report2_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ta_report2_search->showPageFooter();
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
$ta_report2_search->terminate();
?>