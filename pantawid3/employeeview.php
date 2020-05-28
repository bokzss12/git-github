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
$employee_view = new employee_view();

// Run the page
$employee_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_view->isExport()) { ?>
<script>
var femployeeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femployeeview = currentForm = new ew.Form("femployeeview", "view");
	loadjs.done("femployeeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employee_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employee_view->ExportOptions->render("body") ?>
<?php $employee_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employee_view->showPageHeader(); ?>
<?php
$employee_view->showMessage();
?>
<form name="femployeeview" id="femployeeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee">
<input type="hidden" name="modal" value="<?php echo (int)$employee_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employee_view->employeeid->Visible) { // employeeid ?>
	<tr id="r_employeeid">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_employeeid"><?php echo $employee_view->employeeid->caption() ?></span></td>
		<td data-name="employeeid" <?php echo $employee_view->employeeid->cellAttributes() ?>>
<span id="el_employee_employeeid">
<span<?php echo $employee_view->employeeid->viewAttributes() ?>><?php echo $employee_view->employeeid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_username"><?php echo $employee_view->username->caption() ?></span></td>
		<td data-name="username" <?php echo $employee_view->username->cellAttributes() ?>>
<span id="el_employee_username">
<span<?php echo $employee_view->username->viewAttributes() ?>><?php echo $employee_view->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_password"><?php echo $employee_view->password->caption() ?></span></td>
		<td data-name="password" <?php echo $employee_view->password->cellAttributes() ?>>
<span id="el_employee_password">
<span<?php echo $employee_view->password->viewAttributes() ?>><?php echo $employee_view->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->userlevel_id->Visible) { // userlevel_id ?>
	<tr id="r_userlevel_id">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_userlevel_id"><?php echo $employee_view->userlevel_id->caption() ?></span></td>
		<td data-name="userlevel_id" <?php echo $employee_view->userlevel_id->cellAttributes() ?>>
<span id="el_employee_userlevel_id">
<span<?php echo $employee_view->userlevel_id->viewAttributes() ?>><?php echo $employee_view->userlevel_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->Name_dsc->Visible) { // Name_dsc ?>
	<tr id="r_Name_dsc">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_Name_dsc"><?php echo $employee_view->Name_dsc->caption() ?></span></td>
		<td data-name="Name_dsc" <?php echo $employee_view->Name_dsc->cellAttributes() ?>>
<span id="el_employee_Name_dsc">
<span<?php echo $employee_view->Name_dsc->viewAttributes() ?>><?php echo $employee_view->Name_dsc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->position->Visible) { // position ?>
	<tr id="r_position">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_position"><?php echo $employee_view->position->caption() ?></span></td>
		<td data-name="position" <?php echo $employee_view->position->cellAttributes() ?>>
<span id="el_employee_position">
<span<?php echo $employee_view->position->viewAttributes() ?>><?php echo $employee_view->position->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee__email"><?php echo $employee_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $employee_view->_email->cellAttributes() ?>>
<span id="el_employee__email">
<span<?php echo $employee_view->_email->viewAttributes() ?>><?php echo $employee_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->activation->Visible) { // activation ?>
	<tr id="r_activation">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_activation"><?php echo $employee_view->activation->caption() ?></span></td>
		<td data-name="activation" <?php echo $employee_view->activation->cellAttributes() ?>>
<span id="el_employee_activation">
<span<?php echo $employee_view->activation->viewAttributes() ?>><?php echo $employee_view->activation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_view->photo->Visible) { // photo ?>
	<tr id="r_photo">
		<td class="<?php echo $employee_view->TableLeftColumnClass ?>"><span id="elh_employee_photo"><?php echo $employee_view->photo->caption() ?></span></td>
		<td data-name="photo" <?php echo $employee_view->photo->cellAttributes() ?>>
<span id="el_employee_photo">
<span><?php echo GetFileViewTag($employee_view->photo, $employee_view->photo->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$employee_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_view->isExport()) { ?>
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
$employee_view->terminate();
?>