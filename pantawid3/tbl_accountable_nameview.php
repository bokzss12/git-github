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
$tbl_accountable_name_view = new tbl_accountable_name_view();

// Run the page
$tbl_accountable_name_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_accountable_name_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_accountable_name_view->isExport()) { ?>
<script>
var ftbl_accountable_nameview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_accountable_nameview = currentForm = new ew.Form("ftbl_accountable_nameview", "view");
	loadjs.done("ftbl_accountable_nameview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_accountable_name_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_accountable_name_view->ExportOptions->render("body") ?>
<?php $tbl_accountable_name_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_accountable_name_view->showPageHeader(); ?>
<?php
$tbl_accountable_name_view->showMessage();
?>
<form name="ftbl_accountable_nameview" id="ftbl_accountable_nameview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_accountable_name">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_accountable_name_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_accountable_name_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tbl_accountable_name_view->TableLeftColumnClass ?>"><span id="elh_tbl_accountable_name_id"><?php echo $tbl_accountable_name_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tbl_accountable_name_view->id->cellAttributes() ?>>
<span id="el_tbl_accountable_name_id">
<span<?php echo $tbl_accountable_name_view->id->viewAttributes() ?>><?php echo $tbl_accountable_name_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_accountable_name_view->name_id->Visible) { // name_id ?>
	<tr id="r_name_id">
		<td class="<?php echo $tbl_accountable_name_view->TableLeftColumnClass ?>"><span id="elh_tbl_accountable_name_name_id"><?php echo $tbl_accountable_name_view->name_id->caption() ?></span></td>
		<td data-name="name_id" <?php echo $tbl_accountable_name_view->name_id->cellAttributes() ?>>
<span id="el_tbl_accountable_name_name_id">
<span<?php echo $tbl_accountable_name_view->name_id->viewAttributes() ?>><?php echo $tbl_accountable_name_view->name_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_accountable_name_view->full_name_tbl->Visible) { // full_name_tbl ?>
	<tr id="r_full_name_tbl">
		<td class="<?php echo $tbl_accountable_name_view->TableLeftColumnClass ?>"><span id="elh_tbl_accountable_name_full_name_tbl"><?php echo $tbl_accountable_name_view->full_name_tbl->caption() ?></span></td>
		<td data-name="full_name_tbl" <?php echo $tbl_accountable_name_view->full_name_tbl->cellAttributes() ?>>
<span id="el_tbl_accountable_name_full_name_tbl">
<span<?php echo $tbl_accountable_name_view->full_name_tbl->viewAttributes() ?>><?php echo $tbl_accountable_name_view->full_name_tbl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_accountable_name_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_accountable_name_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$tbl_accountable_name_view->terminate();
?>