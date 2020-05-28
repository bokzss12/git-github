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
$signatory_list = new signatory_list();

// Run the page
$signatory_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$signatory_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$signatory_list->isExport()) { ?>
<script>
var fsignatorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsignatorylist = currentForm = new ew.Form("fsignatorylist", "list");
	fsignatorylist.formKeyCountName = '<?php echo $signatory_list->FormKeyCountName ?>';
	loadjs.done("fsignatorylist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$signatory_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($signatory_list->TotalRecords > 0 && $signatory_list->ExportOptions->visible()) { ?>
<?php $signatory_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($signatory_list->ImportOptions->visible()) { ?>
<?php $signatory_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$signatory_list->renderOtherOptions();
?>
<?php $signatory_list->showPageHeader(); ?>
<?php
$signatory_list->showMessage();
?>
<?php if ($signatory_list->TotalRecords > 0 || $signatory->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($signatory_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> signatory">
<form name="fsignatorylist" id="fsignatorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="signatory">
<div id="gmp_signatory" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($signatory_list->TotalRecords > 0 || $signatory_list->isGridEdit()) { ?>
<table id="tbl_signatorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$signatory->RowType = ROWTYPE_HEADER;

// Render list options
$signatory_list->renderListOptions();

// Render list options (header, left)
$signatory_list->ListOptions->render("header", "left");
?>
<?php if ($signatory_list->NameSig->Visible) { // NameSig ?>
	<?php if ($signatory_list->SortUrl($signatory_list->NameSig) == "") { ?>
		<th data-name="NameSig" class="<?php echo $signatory_list->NameSig->headerCellClass() ?>"><div id="elh_signatory_NameSig" class="signatory_NameSig"><div class="ew-table-header-caption"><?php echo $signatory_list->NameSig->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NameSig" class="<?php echo $signatory_list->NameSig->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $signatory_list->SortUrl($signatory_list->NameSig) ?>', 1);"><div id="elh_signatory_NameSig" class="signatory_NameSig">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $signatory_list->NameSig->caption() ?></span><span class="ew-table-header-sort"><?php if ($signatory_list->NameSig->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($signatory_list->NameSig->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($signatory_list->DesignationSig->Visible) { // DesignationSig ?>
	<?php if ($signatory_list->SortUrl($signatory_list->DesignationSig) == "") { ?>
		<th data-name="DesignationSig" class="<?php echo $signatory_list->DesignationSig->headerCellClass() ?>"><div id="elh_signatory_DesignationSig" class="signatory_DesignationSig"><div class="ew-table-header-caption"><?php echo $signatory_list->DesignationSig->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DesignationSig" class="<?php echo $signatory_list->DesignationSig->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $signatory_list->SortUrl($signatory_list->DesignationSig) ?>', 1);"><div id="elh_signatory_DesignationSig" class="signatory_DesignationSig">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $signatory_list->DesignationSig->caption() ?></span><span class="ew-table-header-sort"><?php if ($signatory_list->DesignationSig->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($signatory_list->DesignationSig->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$signatory_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($signatory_list->ExportAll && $signatory_list->isExport()) {
	$signatory_list->StopRecord = $signatory_list->TotalRecords;
} else {

	// Set the last record to display
	if ($signatory_list->TotalRecords > $signatory_list->StartRecord + $signatory_list->DisplayRecords - 1)
		$signatory_list->StopRecord = $signatory_list->StartRecord + $signatory_list->DisplayRecords - 1;
	else
		$signatory_list->StopRecord = $signatory_list->TotalRecords;
}
$signatory_list->RecordCount = $signatory_list->StartRecord - 1;
if ($signatory_list->Recordset && !$signatory_list->Recordset->EOF) {
	$signatory_list->Recordset->moveFirst();
	$selectLimit = $signatory_list->UseSelectLimit;
	if (!$selectLimit && $signatory_list->StartRecord > 1)
		$signatory_list->Recordset->move($signatory_list->StartRecord - 1);
} elseif (!$signatory->AllowAddDeleteRow && $signatory_list->StopRecord == 0) {
	$signatory_list->StopRecord = $signatory->GridAddRowCount;
}

// Initialize aggregate
$signatory->RowType = ROWTYPE_AGGREGATEINIT;
$signatory->resetAttributes();
$signatory_list->renderRow();
while ($signatory_list->RecordCount < $signatory_list->StopRecord) {
	$signatory_list->RecordCount++;
	if ($signatory_list->RecordCount >= $signatory_list->StartRecord) {
		$signatory_list->RowCount++;

		// Set up key count
		$signatory_list->KeyCount = $signatory_list->RowIndex;

		// Init row class and style
		$signatory->resetAttributes();
		$signatory->CssClass = "";
		if ($signatory_list->isGridAdd()) {
		} else {
			$signatory_list->loadRowValues($signatory_list->Recordset); // Load row values
		}
		$signatory->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$signatory->RowAttrs->merge(["data-rowindex" => $signatory_list->RowCount, "id" => "r" . $signatory_list->RowCount . "_signatory", "data-rowtype" => $signatory->RowType]);

		// Render row
		$signatory_list->renderRow();

		// Render list options
		$signatory_list->renderListOptions();
?>
	<tr <?php echo $signatory->rowAttributes() ?>>
<?php

// Render list options (body, left)
$signatory_list->ListOptions->render("body", "left", $signatory_list->RowCount);
?>
	<?php if ($signatory_list->NameSig->Visible) { // NameSig ?>
		<td data-name="NameSig" <?php echo $signatory_list->NameSig->cellAttributes() ?>>
<span id="el<?php echo $signatory_list->RowCount ?>_signatory_NameSig">
<span<?php echo $signatory_list->NameSig->viewAttributes() ?>><?php echo $signatory_list->NameSig->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($signatory_list->DesignationSig->Visible) { // DesignationSig ?>
		<td data-name="DesignationSig" <?php echo $signatory_list->DesignationSig->cellAttributes() ?>>
<span id="el<?php echo $signatory_list->RowCount ?>_signatory_DesignationSig">
<span<?php echo $signatory_list->DesignationSig->viewAttributes() ?>><?php echo $signatory_list->DesignationSig->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$signatory_list->ListOptions->render("body", "right", $signatory_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$signatory_list->isGridAdd())
		$signatory_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$signatory->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($signatory_list->Recordset)
	$signatory_list->Recordset->Close();
?>
<?php if (!$signatory_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $signatory_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($signatory_list->TotalRecords == 0 && !$signatory->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $signatory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$signatory_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$signatory_list->isExport()) { ?>
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
$signatory_list->terminate();
?>