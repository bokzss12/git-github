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
$tbl_sup_status_edit = new tbl_sup_status_edit();

// Run the page
$tbl_sup_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_sup_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_sup_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_sup_statusedit = currentForm = new ew.Form("ftbl_sup_statusedit", "edit");

	// Validate form
	ftbl_sup_statusedit.validate = function() {
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
			<?php if ($tbl_sup_status_edit->sup_statusID->Required) { ?>
				elm = this.getElements("x" + infix + "_sup_statusID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_sup_status_edit->sup_statusID->caption(), $tbl_sup_status_edit->sup_statusID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_sup_status_edit->sup_status->Required) { ?>
				elm = this.getElements("x" + infix + "_sup_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_sup_status_edit->sup_status->caption(), $tbl_sup_status_edit->sup_status->RequiredErrorMessage)) ?>");
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
	ftbl_sup_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_sup_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_sup_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_sup_status_edit->showPageHeader(); ?>
<?php
$tbl_sup_status_edit->showMessage();
?>
<form name="ftbl_sup_statusedit" id="ftbl_sup_statusedit" class="<?php echo $tbl_sup_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_sup_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_sup_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_sup_status_edit->sup_statusID->Visible) { // sup_statusID ?>
	<div id="r_sup_statusID" class="form-group row">
		<label id="elh_tbl_sup_status_sup_statusID" class="<?php echo $tbl_sup_status_edit->LeftColumnClass ?>"><?php echo $tbl_sup_status_edit->sup_statusID->caption() ?><?php echo $tbl_sup_status_edit->sup_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_sup_status_edit->RightColumnClass ?>"><div <?php echo $tbl_sup_status_edit->sup_statusID->cellAttributes() ?>>
<span id="el_tbl_sup_status_sup_statusID">
<span<?php echo $tbl_sup_status_edit->sup_statusID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_sup_status_edit->sup_statusID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_sup_status" data-field="x_sup_statusID" name="x_sup_statusID" id="x_sup_statusID" value="<?php echo HtmlEncode($tbl_sup_status_edit->sup_statusID->CurrentValue) ?>">
<?php echo $tbl_sup_status_edit->sup_statusID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_sup_status_edit->sup_status->Visible) { // sup_status ?>
	<div id="r_sup_status" class="form-group row">
		<label id="elh_tbl_sup_status_sup_status" for="x_sup_status" class="<?php echo $tbl_sup_status_edit->LeftColumnClass ?>"><?php echo $tbl_sup_status_edit->sup_status->caption() ?><?php echo $tbl_sup_status_edit->sup_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_sup_status_edit->RightColumnClass ?>"><div <?php echo $tbl_sup_status_edit->sup_status->cellAttributes() ?>>
<span id="el_tbl_sup_status_sup_status">
<input type="text" data-table="tbl_sup_status" data-field="x_sup_status" name="x_sup_status" id="x_sup_status" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_sup_status_edit->sup_status->getPlaceHolder()) ?>" value="<?php echo $tbl_sup_status_edit->sup_status->EditValue ?>"<?php echo $tbl_sup_status_edit->sup_status->editAttributes() ?>>
</span>
<?php echo $tbl_sup_status_edit->sup_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_sup_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_sup_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_sup_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_sup_status_edit->showPageFooter();
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
$tbl_sup_status_edit->terminate();
?>