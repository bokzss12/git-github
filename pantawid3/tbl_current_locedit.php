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
$tbl_current_loc_edit = new tbl_current_loc_edit();

// Run the page
$tbl_current_loc_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_current_loc_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_current_locedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_current_locedit = currentForm = new ew.Form("ftbl_current_locedit", "edit");

	// Validate form
	ftbl_current_locedit.validate = function() {
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
			<?php if ($tbl_current_loc_edit->current_id->Required) { ?>
				elm = this.getElements("x" + infix + "_current_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_current_loc_edit->current_id->caption(), $tbl_current_loc_edit->current_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_current_loc_edit->current_location->Required) { ?>
				elm = this.getElements("x" + infix + "_current_location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_current_loc_edit->current_location->caption(), $tbl_current_loc_edit->current_location->RequiredErrorMessage)) ?>");
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
	ftbl_current_locedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_current_locedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_current_locedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_current_loc_edit->showPageHeader(); ?>
<?php
$tbl_current_loc_edit->showMessage();
?>
<form name="ftbl_current_locedit" id="ftbl_current_locedit" class="<?php echo $tbl_current_loc_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_current_loc">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_current_loc_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_current_loc_edit->current_id->Visible) { // current_id ?>
	<div id="r_current_id" class="form-group row">
		<label id="elh_tbl_current_loc_current_id" class="<?php echo $tbl_current_loc_edit->LeftColumnClass ?>"><?php echo $tbl_current_loc_edit->current_id->caption() ?><?php echo $tbl_current_loc_edit->current_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_current_loc_edit->RightColumnClass ?>"><div <?php echo $tbl_current_loc_edit->current_id->cellAttributes() ?>>
<span id="el_tbl_current_loc_current_id">
<span<?php echo $tbl_current_loc_edit->current_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_current_loc_edit->current_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_current_loc" data-field="x_current_id" name="x_current_id" id="x_current_id" value="<?php echo HtmlEncode($tbl_current_loc_edit->current_id->CurrentValue) ?>">
<?php echo $tbl_current_loc_edit->current_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_current_loc_edit->current_location->Visible) { // current_location ?>
	<div id="r_current_location" class="form-group row">
		<label id="elh_tbl_current_loc_current_location" for="x_current_location" class="<?php echo $tbl_current_loc_edit->LeftColumnClass ?>"><?php echo $tbl_current_loc_edit->current_location->caption() ?><?php echo $tbl_current_loc_edit->current_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_current_loc_edit->RightColumnClass ?>"><div <?php echo $tbl_current_loc_edit->current_location->cellAttributes() ?>>
<span id="el_tbl_current_loc_current_location">
<input type="text" data-table="tbl_current_loc" data-field="x_current_location" name="x_current_location" id="x_current_location" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_current_loc_edit->current_location->getPlaceHolder()) ?>" value="<?php echo $tbl_current_loc_edit->current_location->EditValue ?>"<?php echo $tbl_current_loc_edit->current_location->editAttributes() ?>>
</span>
<?php echo $tbl_current_loc_edit->current_location->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_current_loc_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_current_loc_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_current_loc_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_current_loc_edit->showPageFooter();
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
$tbl_current_loc_edit->terminate();
?>