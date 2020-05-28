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
$tbl_request_edit = new tbl_request_edit();

// Run the page
$tbl_request_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_request_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_requestedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftbl_requestedit = currentForm = new ew.Form("ftbl_requestedit", "edit");

	// Validate form
	ftbl_requestedit.validate = function() {
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
			<?php if ($tbl_request_edit->request_id->Required) { ?>
				elm = this.getElements("x" + infix + "_request_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_request_edit->request_id->caption(), $tbl_request_edit->request_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_request_edit->request_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_request_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_request_edit->request_dsc->caption(), $tbl_request_edit->request_dsc->RequiredErrorMessage)) ?>");
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
	ftbl_requestedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_requestedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_requestedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_request_edit->showPageHeader(); ?>
<?php
$tbl_request_edit->showMessage();
?>
<form name="ftbl_requestedit" id="ftbl_requestedit" class="<?php echo $tbl_request_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_request">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_request_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_request_edit->request_id->Visible) { // request_id ?>
	<div id="r_request_id" class="form-group row">
		<label id="elh_tbl_request_request_id" class="<?php echo $tbl_request_edit->LeftColumnClass ?>"><?php echo $tbl_request_edit->request_id->caption() ?><?php echo $tbl_request_edit->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_request_edit->RightColumnClass ?>"><div <?php echo $tbl_request_edit->request_id->cellAttributes() ?>>
<span id="el_tbl_request_request_id">
<span<?php echo $tbl_request_edit->request_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_request_edit->request_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_request" data-field="x_request_id" name="x_request_id" id="x_request_id" value="<?php echo HtmlEncode($tbl_request_edit->request_id->CurrentValue) ?>">
<?php echo $tbl_request_edit->request_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_request_edit->request_dsc->Visible) { // request_dsc ?>
	<div id="r_request_dsc" class="form-group row">
		<label id="elh_tbl_request_request_dsc" for="x_request_dsc" class="<?php echo $tbl_request_edit->LeftColumnClass ?>"><?php echo $tbl_request_edit->request_dsc->caption() ?><?php echo $tbl_request_edit->request_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_request_edit->RightColumnClass ?>"><div <?php echo $tbl_request_edit->request_dsc->cellAttributes() ?>>
<span id="el_tbl_request_request_dsc">
<input type="text" data-table="tbl_request" data-field="x_request_dsc" name="x_request_dsc" id="x_request_dsc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_request_edit->request_dsc->getPlaceHolder()) ?>" value="<?php echo $tbl_request_edit->request_dsc->EditValue ?>"<?php echo $tbl_request_edit->request_dsc->editAttributes() ?>>
</span>
<?php echo $tbl_request_edit->request_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_request_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_request_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_request_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_request_edit->showPageFooter();
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
$tbl_request_edit->terminate();
?>