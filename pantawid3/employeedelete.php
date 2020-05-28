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
$employee_delete = new employee_delete();

// Run the page
$employee_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployeedelete = currentForm = new ew.Form("femployeedelete", "delete");
	loadjs.done("femployeedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_delete->showPageHeader(); ?>
<?php
$employee_delete->showMessage();
?>
<form name="femployeedelete" id="femployeedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employee_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employee_delete->employeeid->Visible) { // employeeid ?>
		<th class="<?php echo $employee_delete->employeeid->headerCellClass() ?>"><span id="elh_employee_employeeid" class="employee_employeeid"><?php echo $employee_delete->employeeid->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->username->Visible) { // username ?>
		<th class="<?php echo $employee_delete->username->headerCellClass() ?>"><span id="elh_employee_username" class="employee_username"><?php echo $employee_delete->username->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->password->Visible) { // password ?>
		<th class="<?php echo $employee_delete->password->headerCellClass() ?>"><span id="elh_employee_password" class="employee_password"><?php echo $employee_delete->password->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->userlevel_id->Visible) { // userlevel_id ?>
		<th class="<?php echo $employee_delete->userlevel_id->headerCellClass() ?>"><span id="elh_employee_userlevel_id" class="employee_userlevel_id"><?php echo $employee_delete->userlevel_id->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->Name_dsc->Visible) { // Name_dsc ?>
		<th class="<?php echo $employee_delete->Name_dsc->headerCellClass() ?>"><span id="elh_employee_Name_dsc" class="employee_Name_dsc"><?php echo $employee_delete->Name_dsc->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->position->Visible) { // position ?>
		<th class="<?php echo $employee_delete->position->headerCellClass() ?>"><span id="elh_employee_position" class="employee_position"><?php echo $employee_delete->position->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->_email->Visible) { // email ?>
		<th class="<?php echo $employee_delete->_email->headerCellClass() ?>"><span id="elh_employee__email" class="employee__email"><?php echo $employee_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->activation->Visible) { // activation ?>
		<th class="<?php echo $employee_delete->activation->headerCellClass() ?>"><span id="elh_employee_activation" class="employee_activation"><?php echo $employee_delete->activation->caption() ?></span></th>
<?php } ?>
<?php if ($employee_delete->photo->Visible) { // photo ?>
		<th class="<?php echo $employee_delete->photo->headerCellClass() ?>"><span id="elh_employee_photo" class="employee_photo"><?php echo $employee_delete->photo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employee_delete->RecordCount = 0;
$i = 0;
while (!$employee_delete->Recordset->EOF) {
	$employee_delete->RecordCount++;
	$employee_delete->RowCount++;

	// Set row properties
	$employee->resetAttributes();
	$employee->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employee_delete->loadRowValues($employee_delete->Recordset);

	// Render row
	$employee_delete->renderRow();
?>
	<tr <?php echo $employee->rowAttributes() ?>>
<?php if ($employee_delete->employeeid->Visible) { // employeeid ?>
		<td <?php echo $employee_delete->employeeid->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_employeeid" class="employee_employeeid">
<span<?php echo $employee_delete->employeeid->viewAttributes() ?>><?php echo $employee_delete->employeeid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->username->Visible) { // username ?>
		<td <?php echo $employee_delete->username->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_username" class="employee_username">
<span<?php echo $employee_delete->username->viewAttributes() ?>><?php echo $employee_delete->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->password->Visible) { // password ?>
		<td <?php echo $employee_delete->password->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_password" class="employee_password">
<span<?php echo $employee_delete->password->viewAttributes() ?>><?php echo $employee_delete->password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->userlevel_id->Visible) { // userlevel_id ?>
		<td <?php echo $employee_delete->userlevel_id->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_userlevel_id" class="employee_userlevel_id">
<span<?php echo $employee_delete->userlevel_id->viewAttributes() ?>><?php echo $employee_delete->userlevel_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->Name_dsc->Visible) { // Name_dsc ?>
		<td <?php echo $employee_delete->Name_dsc->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_Name_dsc" class="employee_Name_dsc">
<span<?php echo $employee_delete->Name_dsc->viewAttributes() ?>><?php echo $employee_delete->Name_dsc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->position->Visible) { // position ?>
		<td <?php echo $employee_delete->position->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_position" class="employee_position">
<span<?php echo $employee_delete->position->viewAttributes() ?>><?php echo $employee_delete->position->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->_email->Visible) { // email ?>
		<td <?php echo $employee_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee__email" class="employee__email">
<span<?php echo $employee_delete->_email->viewAttributes() ?>><?php echo $employee_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->activation->Visible) { // activation ?>
		<td <?php echo $employee_delete->activation->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_activation" class="employee_activation">
<span<?php echo $employee_delete->activation->viewAttributes() ?>><?php echo $employee_delete->activation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_delete->photo->Visible) { // photo ?>
		<td <?php echo $employee_delete->photo->cellAttributes() ?>>
<span id="el<?php echo $employee_delete->RowCount ?>_employee_photo" class="employee_photo">
<span><?php echo GetFileViewTag($employee_delete->photo, $employee_delete->photo->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employee_delete->Recordset->moveNext();
}
$employee_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employee_delete->showPageFooter();
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
$employee_delete->terminate();
?>