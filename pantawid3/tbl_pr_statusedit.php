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
$tbl_pr_status_edit = new tbl_pr_status_edit();

// Run the page
$tbl_pr_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_pr_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_pr_statusedit = currentForm = new ew.Form("ftbl_pr_statusedit", "edit");

	// Validate form
	ftbl_pr_statusedit.validate = function() {
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
			<?php if ($tbl_pr_status_edit->pr_statusID->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_statusID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_status_edit->pr_statusID->caption(), $tbl_pr_status_edit->pr_statusID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_pr_status_edit->pr_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_status_edit->pr_dsc->caption(), $tbl_pr_status_edit->pr_dsc->RequiredErrorMessage)) ?>");
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
	ftbl_pr_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_pr_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_pr_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_pr_status_edit->showPageHeader(); ?>
<?php
$tbl_pr_status_edit->showMessage();
?>
<form name="ftbl_pr_statusedit" id="ftbl_pr_statusedit" class="<?php echo $tbl_pr_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pr_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_pr_status_edit->pr_statusID->Visible) { // pr_statusID ?>
	<div id="r_pr_statusID" class="form-group row">
		<label id="elh_tbl_pr_status_pr_statusID" class="<?php echo $tbl_pr_status_edit->LeftColumnClass ?>"><?php echo $tbl_pr_status_edit->pr_statusID->caption() ?><?php echo $tbl_pr_status_edit->pr_statusID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_status_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_status_edit->pr_statusID->cellAttributes() ?>>
<span id="el_tbl_pr_status_pr_statusID">
<span<?php echo $tbl_pr_status_edit->pr_statusID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_pr_status_edit->pr_statusID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_pr_status" data-field="x_pr_statusID" name="x_pr_statusID" id="x_pr_statusID" value="<?php echo HtmlEncode($tbl_pr_status_edit->pr_statusID->CurrentValue) ?>">
<?php echo $tbl_pr_status_edit->pr_statusID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_pr_status_edit->pr_dsc->Visible) { // pr_dsc ?>
	<div id="r_pr_dsc" class="form-group row">
		<label id="elh_tbl_pr_status_pr_dsc" for="x_pr_dsc" class="<?php echo $tbl_pr_status_edit->LeftColumnClass ?>"><?php echo $tbl_pr_status_edit->pr_dsc->caption() ?><?php echo $tbl_pr_status_edit->pr_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_status_edit->RightColumnClass ?>"><div <?php echo $tbl_pr_status_edit->pr_dsc->cellAttributes() ?>>
<span id="el_tbl_pr_status_pr_dsc">
<input type="text" data-table="tbl_pr_status" data-field="x_pr_dsc" name="x_pr_dsc" id="x_pr_dsc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_pr_status_edit->pr_dsc->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_status_edit->pr_dsc->EditValue ?>"<?php echo $tbl_pr_status_edit->pr_dsc->editAttributes() ?>>
</span>
<?php echo $tbl_pr_status_edit->pr_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_pr_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_pr_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pr_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_pr_status_edit->showPageFooter();
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
$tbl_pr_status_edit->terminate();
?>