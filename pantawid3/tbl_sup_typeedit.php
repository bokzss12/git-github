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
$tbl_sup_type_edit = new tbl_sup_type_edit();

// Run the page
$tbl_sup_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_sup_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_sup_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_sup_typeedit = currentForm = new ew.Form("ftbl_sup_typeedit", "edit");

	// Validate form
	ftbl_sup_typeedit.validate = function() {
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
			<?php if ($tbl_sup_type_edit->sup_listID->Required) { ?>
				elm = this.getElements("x" + infix + "_sup_listID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_sup_type_edit->sup_listID->caption(), $tbl_sup_type_edit->sup_listID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_sup_type_edit->sup_types->Required) { ?>
				elm = this.getElements("x" + infix + "_sup_types");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_sup_type_edit->sup_types->caption(), $tbl_sup_type_edit->sup_types->RequiredErrorMessage)) ?>");
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
	ftbl_sup_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_sup_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_sup_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_sup_type_edit->showPageHeader(); ?>
<?php
$tbl_sup_type_edit->showMessage();
?>
<form name="ftbl_sup_typeedit" id="ftbl_sup_typeedit" class="<?php echo $tbl_sup_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_sup_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_sup_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_sup_type_edit->sup_listID->Visible) { // sup_listID ?>
	<div id="r_sup_listID" class="form-group row">
		<label id="elh_tbl_sup_type_sup_listID" class="<?php echo $tbl_sup_type_edit->LeftColumnClass ?>"><?php echo $tbl_sup_type_edit->sup_listID->caption() ?><?php echo $tbl_sup_type_edit->sup_listID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_sup_type_edit->RightColumnClass ?>"><div <?php echo $tbl_sup_type_edit->sup_listID->cellAttributes() ?>>
<span id="el_tbl_sup_type_sup_listID">
<span<?php echo $tbl_sup_type_edit->sup_listID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_sup_type_edit->sup_listID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_sup_type" data-field="x_sup_listID" name="x_sup_listID" id="x_sup_listID" value="<?php echo HtmlEncode($tbl_sup_type_edit->sup_listID->CurrentValue) ?>">
<?php echo $tbl_sup_type_edit->sup_listID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_sup_type_edit->sup_types->Visible) { // sup_types ?>
	<div id="r_sup_types" class="form-group row">
		<label id="elh_tbl_sup_type_sup_types" for="x_sup_types" class="<?php echo $tbl_sup_type_edit->LeftColumnClass ?>"><?php echo $tbl_sup_type_edit->sup_types->caption() ?><?php echo $tbl_sup_type_edit->sup_types->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_sup_type_edit->RightColumnClass ?>"><div <?php echo $tbl_sup_type_edit->sup_types->cellAttributes() ?>>
<span id="el_tbl_sup_type_sup_types">
<input type="text" data-table="tbl_sup_type" data-field="x_sup_types" name="x_sup_types" id="x_sup_types" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_sup_type_edit->sup_types->getPlaceHolder()) ?>" value="<?php echo $tbl_sup_type_edit->sup_types->EditValue ?>"<?php echo $tbl_sup_type_edit->sup_types->editAttributes() ?>>
</span>
<?php echo $tbl_sup_type_edit->sup_types->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_sup_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_sup_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_sup_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_sup_type_edit->showPageFooter();
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
$tbl_sup_type_edit->terminate();
?>