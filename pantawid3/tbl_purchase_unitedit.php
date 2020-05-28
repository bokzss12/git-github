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
$tbl_purchase_unit_edit = new tbl_purchase_unit_edit();

// Run the page
$tbl_purchase_unit_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_purchase_unit_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_purchase_unitedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_purchase_unitedit = currentForm = new ew.Form("ftbl_purchase_unitedit", "edit");

	// Validate form
	ftbl_purchase_unitedit.validate = function() {
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
			<?php if ($tbl_purchase_unit_edit->pruID->Required) { ?>
				elm = this.getElements("x" + infix + "_pruID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_purchase_unit_edit->pruID->caption(), $tbl_purchase_unit_edit->pruID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_purchase_unit_edit->unit_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_unit_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_purchase_unit_edit->unit_desc->caption(), $tbl_purchase_unit_edit->unit_desc->RequiredErrorMessage)) ?>");
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
	ftbl_purchase_unitedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_purchase_unitedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_purchase_unitedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_purchase_unit_edit->showPageHeader(); ?>
<?php
$tbl_purchase_unit_edit->showMessage();
?>
<form name="ftbl_purchase_unitedit" id="ftbl_purchase_unitedit" class="<?php echo $tbl_purchase_unit_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_purchase_unit">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_purchase_unit_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_purchase_unit_edit->pruID->Visible) { // pruID ?>
	<div id="r_pruID" class="form-group row">
		<label id="elh_tbl_purchase_unit_pruID" class="<?php echo $tbl_purchase_unit_edit->LeftColumnClass ?>"><?php echo $tbl_purchase_unit_edit->pruID->caption() ?><?php echo $tbl_purchase_unit_edit->pruID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_purchase_unit_edit->RightColumnClass ?>"><div <?php echo $tbl_purchase_unit_edit->pruID->cellAttributes() ?>>
<span id="el_tbl_purchase_unit_pruID">
<span<?php echo $tbl_purchase_unit_edit->pruID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_purchase_unit_edit->pruID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_purchase_unit" data-field="x_pruID" name="x_pruID" id="x_pruID" value="<?php echo HtmlEncode($tbl_purchase_unit_edit->pruID->CurrentValue) ?>">
<?php echo $tbl_purchase_unit_edit->pruID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_purchase_unit_edit->unit_desc->Visible) { // unit_desc ?>
	<div id="r_unit_desc" class="form-group row">
		<label id="elh_tbl_purchase_unit_unit_desc" for="x_unit_desc" class="<?php echo $tbl_purchase_unit_edit->LeftColumnClass ?>"><?php echo $tbl_purchase_unit_edit->unit_desc->caption() ?><?php echo $tbl_purchase_unit_edit->unit_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_purchase_unit_edit->RightColumnClass ?>"><div <?php echo $tbl_purchase_unit_edit->unit_desc->cellAttributes() ?>>
<span id="el_tbl_purchase_unit_unit_desc">
<input type="text" data-table="tbl_purchase_unit" data-field="x_unit_desc" name="x_unit_desc" id="x_unit_desc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_purchase_unit_edit->unit_desc->getPlaceHolder()) ?>" value="<?php echo $tbl_purchase_unit_edit->unit_desc->EditValue ?>"<?php echo $tbl_purchase_unit_edit->unit_desc->editAttributes() ?>>
</span>
<?php echo $tbl_purchase_unit_edit->unit_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_purchase_unit_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_purchase_unit_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_purchase_unit_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_purchase_unit_edit->showPageFooter();
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
$tbl_purchase_unit_edit->terminate();
?>