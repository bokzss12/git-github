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
$tbl_encoder_status_add = new tbl_encoder_status_add();

// Run the page
$tbl_encoder_status_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_status_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_encoder_statusadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_encoder_statusadd = currentForm = new ew.Form("ftbl_encoder_statusadd", "add");

	// Validate form
	ftbl_encoder_statusadd.validate = function() {
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
			<?php if ($tbl_encoder_status_add->status_remark->Required) { ?>
				elm = this.getElements("x" + infix + "_status_remark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_encoder_status_add->status_remark->caption(), $tbl_encoder_status_add->status_remark->RequiredErrorMessage)) ?>");
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
	ftbl_encoder_statusadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_encoder_statusadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftbl_encoder_statusadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_encoder_status_add->showPageHeader(); ?>
<?php
$tbl_encoder_status_add->showMessage();
?>
<form name="ftbl_encoder_statusadd" id="ftbl_encoder_statusadd" class="<?php echo $tbl_encoder_status_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder_status">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_encoder_status_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_encoder_status_add->status_remark->Visible) { // status_remark ?>
	<div id="r_status_remark" class="form-group row">
		<label id="elh_tbl_encoder_status_status_remark" for="x_status_remark" class="<?php echo $tbl_encoder_status_add->LeftColumnClass ?>"><?php echo $tbl_encoder_status_add->status_remark->caption() ?><?php echo $tbl_encoder_status_add->status_remark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_encoder_status_add->RightColumnClass ?>"><div <?php echo $tbl_encoder_status_add->status_remark->cellAttributes() ?>>
<span id="el_tbl_encoder_status_status_remark">
<input type="text" data-table="tbl_encoder_status" data-field="x_status_remark" name="x_status_remark" id="x_status_remark" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_encoder_status_add->status_remark->getPlaceHolder()) ?>" value="<?php echo $tbl_encoder_status_add->status_remark->EditValue ?>"<?php echo $tbl_encoder_status_add->status_remark->editAttributes() ?>>
</span>
<?php echo $tbl_encoder_status_add->status_remark->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_encoder_status_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_encoder_status_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_encoder_status_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_encoder_status_add->showPageFooter();
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
$tbl_encoder_status_add->terminate();
?>