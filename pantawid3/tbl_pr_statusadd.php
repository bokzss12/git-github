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
$tbl_pr_status_add = new tbl_pr_status_add();

// Run the page
$tbl_pr_status_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pr_status_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_pr_statusadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_pr_statusadd = currentForm = new ew.Form("ftbl_pr_statusadd", "add");

	// Validate form
	ftbl_pr_statusadd.validate = function() {
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
			<?php if ($tbl_pr_status_add->pr_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_pr_status_add->pr_dsc->caption(), $tbl_pr_status_add->pr_dsc->RequiredErrorMessage)) ?>");
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
	ftbl_pr_statusadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_pr_statusadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_pr_statusadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_pr_status_add->showPageHeader(); ?>
<?php
$tbl_pr_status_add->showMessage();
?>
<form name="ftbl_pr_statusadd" id="ftbl_pr_statusadd" class="<?php echo $tbl_pr_status_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pr_status">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pr_status_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_pr_status_add->pr_dsc->Visible) { // pr_dsc ?>
	<div id="r_pr_dsc" class="form-group row">
		<label id="elh_tbl_pr_status_pr_dsc" for="x_pr_dsc" class="<?php echo $tbl_pr_status_add->LeftColumnClass ?>"><?php echo $tbl_pr_status_add->pr_dsc->caption() ?><?php echo $tbl_pr_status_add->pr_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_pr_status_add->RightColumnClass ?>"><div <?php echo $tbl_pr_status_add->pr_dsc->cellAttributes() ?>>
<span id="el_tbl_pr_status_pr_dsc">
<input type="text" data-table="tbl_pr_status" data-field="x_pr_dsc" name="x_pr_dsc" id="x_pr_dsc" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_pr_status_add->pr_dsc->getPlaceHolder()) ?>" value="<?php echo $tbl_pr_status_add->pr_dsc->EditValue ?>"<?php echo $tbl_pr_status_add->pr_dsc->editAttributes() ?>>
</span>
<?php echo $tbl_pr_status_add->pr_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_pr_status_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_pr_status_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pr_status_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_pr_status_add->showPageFooter();
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
$tbl_pr_status_add->terminate();
?>