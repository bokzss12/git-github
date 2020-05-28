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
$tbl_encoder_lactivities_view = new tbl_encoder_lactivities_view();

// Run the page
$tbl_encoder_lactivities_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_encoder_lactivities_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_encoder_lactivities_view->isExport()) { ?>
<script>
var ftbl_encoder_lactivitiesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftbl_encoder_lactivitiesview = currentForm = new ew.Form("ftbl_encoder_lactivitiesview", "view");
	loadjs.done("ftbl_encoder_lactivitiesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_encoder_lactivities_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_encoder_lactivities_view->ExportOptions->render("body") ?>
<?php $tbl_encoder_lactivities_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_encoder_lactivities_view->showPageHeader(); ?>
<?php
$tbl_encoder_lactivities_view->showMessage();
?>
<form name="ftbl_encoder_lactivitiesview" id="ftbl_encoder_lactivitiesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_encoder_lactivities">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_encoder_lactivities_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_encoder_lactivities_view->enc_activities_id->Visible) { // enc_activities_id ?>
	<tr id="r_enc_activities_id">
		<td class="<?php echo $tbl_encoder_lactivities_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_lactivities_enc_activities_id"><?php echo $tbl_encoder_lactivities_view->enc_activities_id->caption() ?></span></td>
		<td data-name="enc_activities_id" <?php echo $tbl_encoder_lactivities_view->enc_activities_id->cellAttributes() ?>>
<span id="el_tbl_encoder_lactivities_enc_activities_id">
<span<?php echo $tbl_encoder_lactivities_view->enc_activities_id->viewAttributes() ?>><?php echo $tbl_encoder_lactivities_view->enc_activities_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_encoder_lactivities_view->List_Activities->Visible) { // List_Activities ?>
	<tr id="r_List_Activities">
		<td class="<?php echo $tbl_encoder_lactivities_view->TableLeftColumnClass ?>"><span id="elh_tbl_encoder_lactivities_List_Activities"><?php echo $tbl_encoder_lactivities_view->List_Activities->caption() ?></span></td>
		<td data-name="List_Activities" <?php echo $tbl_encoder_lactivities_view->List_Activities->cellAttributes() ?>>
<span id="el_tbl_encoder_lactivities_List_Activities">
<span<?php echo $tbl_encoder_lactivities_view->List_Activities->viewAttributes() ?>><?php echo $tbl_encoder_lactivities_view->List_Activities->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_encoder_lactivities_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_encoder_lactivities_view->isExport()) { ?>
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
$tbl_encoder_lactivities_view->terminate();
?>