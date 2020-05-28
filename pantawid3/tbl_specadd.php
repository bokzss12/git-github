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
$tbl_spec_add = new tbl_spec_add();

// Run the page
$tbl_spec_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_spec_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftbl_specadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftbl_specadd = currentForm = new ew.Form("ftbl_specadd", "add");

	// Validate form
	ftbl_specadd.validate = function() {
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
			<?php if ($tbl_spec_add->pr_number->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->pr_number->caption(), $tbl_spec_add->pr_number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_add->spec_unit->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_unit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->spec_unit->caption(), $tbl_spec_add->spec_unit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_add->spec_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->spec_dsc->caption(), $tbl_spec_add->spec_dsc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_add->spec_qty->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->spec_qty->caption(), $tbl_spec_add->spec_qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_qty");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_add->spec_qty->errorMessage()) ?>");
			<?php if ($tbl_spec_add->spec_unitprice->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_unitprice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->spec_unitprice->caption(), $tbl_spec_add->spec_unitprice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_unitprice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_add->spec_unitprice->errorMessage()) ?>");
			<?php if ($tbl_spec_add->spec_totalprice->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_totalprice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->spec_totalprice->caption(), $tbl_spec_add->spec_totalprice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_totalprice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_add->spec_totalprice->errorMessage()) ?>");
			<?php if ($tbl_spec_add->user_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_user_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->user_last_modify->caption(), $tbl_spec_add->user_last_modify->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_add->date_last_modify->Required) { ?>
				elm = this.getElements("x" + infix + "_date_last_modify");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_add->date_last_modify->caption(), $tbl_spec_add->date_last_modify->RequiredErrorMessage)) ?>");
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
	ftbl_specadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_specadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_specadd.lists["x_spec_unit"] = <?php echo $tbl_spec_add->spec_unit->Lookup->toClientList($tbl_spec_add) ?>;
	ftbl_specadd.lists["x_spec_unit"].options = <?php echo JsonEncode($tbl_spec_add->spec_unit->lookupOptions()) ?>;
	loadjs.done("ftbl_specadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tbl_spec_add->showPageHeader(); ?>
<?php
$tbl_spec_add->showMessage();
?>
<form name="ftbl_specadd" id="ftbl_specadd" class="<?php echo $tbl_spec_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_spec">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_spec_add->IsModal ?>">
<?php if ($tbl_spec->getCurrentMasterTable() == "tbl_pr") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="tbl_pr">
<input type="hidden" name="fk_pr_number" value="<?php echo HtmlEncode($tbl_spec_add->pr_number->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($tbl_spec_add->pr_number->Visible) { // pr_number ?>
	<div id="r_pr_number" class="form-group row">
		<label id="elh_tbl_spec_pr_number" for="x_pr_number" class="<?php echo $tbl_spec_add->LeftColumnClass ?>"><script id="tpc_tbl_spec_pr_number" type="text/html"><?php echo $tbl_spec_add->pr_number->caption() ?><?php echo $tbl_spec_add->pr_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_spec_add->RightColumnClass ?>"><div <?php echo $tbl_spec_add->pr_number->cellAttributes() ?>>
<?php if ($tbl_spec_add->pr_number->getSessionValue() != "") { ?>
<script id="tpx_tbl_spec_pr_number" type="text/html"><span id="el_tbl_spec_pr_number">
<span<?php echo $tbl_spec_add->pr_number->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_add->pr_number->ViewValue)) ?>"></span>
</span></script>
<input type="hidden" id="x_pr_number" name="x_pr_number" value="<?php echo HtmlEncode($tbl_spec_add->pr_number->CurrentValue) ?>">
<?php } else { ?>
<script id="tpx_tbl_spec_pr_number" type="text/html"><span id="el_tbl_spec_pr_number">
<input type="text" data-table="tbl_spec" data-field="x_pr_number" name="x_pr_number" id="x_pr_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_spec_add->pr_number->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_add->pr_number->EditValue ?>"<?php echo $tbl_spec_add->pr_number->editAttributes() ?>>
</span></script>
<?php } ?>
<?php echo $tbl_spec_add->pr_number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_add->spec_unit->Visible) { // spec_unit ?>
	<div id="r_spec_unit" class="form-group row">
		<label id="elh_tbl_spec_spec_unit" for="x_spec_unit" class="<?php echo $tbl_spec_add->LeftColumnClass ?>"><script id="tpc_tbl_spec_spec_unit" type="text/html"><?php echo $tbl_spec_add->spec_unit->caption() ?><?php echo $tbl_spec_add->spec_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_spec_add->RightColumnClass ?>"><div <?php echo $tbl_spec_add->spec_unit->cellAttributes() ?>>
<script id="tpx_tbl_spec_spec_unit" type="text/html"><span id="el_tbl_spec_spec_unit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_spec" data-field="x_spec_unit" data-value-separator="<?php echo $tbl_spec_add->spec_unit->displayValueSeparatorAttribute() ?>" id="x_spec_unit" name="x_spec_unit"<?php echo $tbl_spec_add->spec_unit->editAttributes() ?>>
			<?php echo $tbl_spec_add->spec_unit->selectOptionListHtml("x_spec_unit") ?>
		</select>
</div>
<?php echo $tbl_spec_add->spec_unit->Lookup->getParamTag($tbl_spec_add, "p_x_spec_unit") ?>
</span></script>
<?php echo $tbl_spec_add->spec_unit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_add->spec_dsc->Visible) { // spec_dsc ?>
	<div id="r_spec_dsc" class="form-group row">
		<label id="elh_tbl_spec_spec_dsc" for="x_spec_dsc" class="<?php echo $tbl_spec_add->LeftColumnClass ?>"><script id="tpc_tbl_spec_spec_dsc" type="text/html"><?php echo $tbl_spec_add->spec_dsc->caption() ?><?php echo $tbl_spec_add->spec_dsc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_spec_add->RightColumnClass ?>"><div <?php echo $tbl_spec_add->spec_dsc->cellAttributes() ?>>
<script id="tpx_tbl_spec_spec_dsc" type="text/html"><span id="el_tbl_spec_spec_dsc">
<textarea data-table="tbl_spec" data-field="x_spec_dsc" name="x_spec_dsc" id="x_spec_dsc" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_spec_add->spec_dsc->getPlaceHolder()) ?>"<?php echo $tbl_spec_add->spec_dsc->editAttributes() ?>><?php echo $tbl_spec_add->spec_dsc->EditValue ?></textarea>
</span></script>
<?php echo $tbl_spec_add->spec_dsc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_add->spec_qty->Visible) { // spec_qty ?>
	<div id="r_spec_qty" class="form-group row">
		<label id="elh_tbl_spec_spec_qty" for="x_spec_qty" class="<?php echo $tbl_spec_add->LeftColumnClass ?>"><script id="tpc_tbl_spec_spec_qty" type="text/html"><?php echo $tbl_spec_add->spec_qty->caption() ?><?php echo $tbl_spec_add->spec_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_spec_add->RightColumnClass ?>"><div <?php echo $tbl_spec_add->spec_qty->cellAttributes() ?>>
<script id="tpx_tbl_spec_spec_qty" type="text/html"><span id="el_tbl_spec_spec_qty">
<input type="text" data-table="tbl_spec" data-field="x_spec_qty" name="x_spec_qty" id="x_spec_qty" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_add->spec_qty->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_add->spec_qty->EditValue ?>"<?php echo $tbl_spec_add->spec_qty->editAttributes() ?>>
</span></script>
<?php echo $tbl_spec_add->spec_qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_add->spec_unitprice->Visible) { // spec_unitprice ?>
	<div id="r_spec_unitprice" class="form-group row">
		<label id="elh_tbl_spec_spec_unitprice" for="x_spec_unitprice" class="<?php echo $tbl_spec_add->LeftColumnClass ?>"><script id="tpc_tbl_spec_spec_unitprice" type="text/html"><?php echo $tbl_spec_add->spec_unitprice->caption() ?><?php echo $tbl_spec_add->spec_unitprice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_spec_add->RightColumnClass ?>"><div <?php echo $tbl_spec_add->spec_unitprice->cellAttributes() ?>>
<script id="tpx_tbl_spec_spec_unitprice" type="text/html"><span id="el_tbl_spec_spec_unitprice">
<input type="text" data-table="tbl_spec" data-field="x_spec_unitprice" name="x_spec_unitprice" id="x_spec_unitprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_add->spec_unitprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_add->spec_unitprice->EditValue ?>"<?php echo $tbl_spec_add->spec_unitprice->editAttributes() ?>>
</span></script>
<?php echo $tbl_spec_add->spec_unitprice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_spec_add->spec_totalprice->Visible) { // spec_totalprice ?>
	<div id="r_spec_totalprice" class="form-group row">
		<label id="elh_tbl_spec_spec_totalprice" for="x_spec_totalprice" class="<?php echo $tbl_spec_add->LeftColumnClass ?>"><script id="tpc_tbl_spec_spec_totalprice" type="text/html"><?php echo $tbl_spec_add->spec_totalprice->caption() ?><?php echo $tbl_spec_add->spec_totalprice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $tbl_spec_add->RightColumnClass ?>"><div <?php echo $tbl_spec_add->spec_totalprice->cellAttributes() ?>>
<script id="tpx_tbl_spec_spec_totalprice" type="text/html"><span id="el_tbl_spec_spec_totalprice">
<input type="text" data-table="tbl_spec" data-field="x_spec_totalprice" name="x_spec_totalprice" id="x_spec_totalprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_add->spec_totalprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_add->spec_totalprice->EditValue ?>"<?php echo $tbl_spec_add->spec_totalprice->editAttributes() ?>>
</span></script>
<?php echo $tbl_spec_add->spec_totalprice->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_tbl_specadd" class="ew-custom-template"></div>
<script id="tpm_tbl_specadd" type="text/html">
<div id="ct_tbl_spec_add"><!--<table class="ew-table">-->
<table style="height: 188px; width: 975px;" border="4" cellspacing="5" cellpadding="5"><!--<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 879px; float: left;">
<table style="height: 152px; width: 932px; float: left;" border="5" cellspacing="5" cellpadding="5">-->
<tbody>
<tr style="height: 42px;">
<td style="width: 362px; height: 42px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_spec_spec_unit"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_spec_spec_unit")/}}</td>
<td style="width: 362px; height: 42px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_spec_spec_qty"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_spec_spec_qty")/}}</td>
<td style="width: 362px; height: 42px; text-align: left;" scope="row">{{include tmpl="#tpc_tbl_spec_spec_unitprice"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_spec_spec_unitprice")/}}</td>
</tr>
<tr style="height: 102.217px;">
<td style="width: 362px; height: 102.217px; text-align: left;" colspan="2" scope="row">{{include tmpl="#tpc_tbl_spec_spec_dsc"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_spec_spec_dsc")/}}<br />&nbsp;</td>
<td style="width: 362px; height: 102.217px; text-align: left; vertical-align: top;" scope="row">{{include tmpl="#tpc_tbl_spec_spec_totalprice"/}}&nbsp;{{include tmpl=~getTemplate("#tpx_tbl_spec_spec_totalprice")/}}&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</div>
</script>

<?php if (!$tbl_spec_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_spec_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_spec_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($tbl_spec->Rows) ?> };
	ew.applyTemplate("tpd_tbl_specadd", "tpm_tbl_specadd", "tbl_specadd", "<?php echo $tbl_spec->CustomExport ?>", ew.templateData.rows[0]);
	$("script.tbl_specadd_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$tbl_spec_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#x_spec_unitprice").on("change keyup paste mouseup",function(){$("#x_spec_totalprice").val(+$("#x_spec_unitprice").val()*+$("#x_spec_qty").val())}),$("#x_spec_qty").on("change keyup paste mouseup",function(){$("#x_spec_totalprice").val(+$("#x_spec_unitprice").val()*+$("#x_spec_qty").val())});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$tbl_spec_add->terminate();
?>