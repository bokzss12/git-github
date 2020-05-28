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
$tbl_spec_list = new tbl_spec_list();

// Run the page
$tbl_spec_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_spec_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tbl_spec_list->isExport()) { ?>
<script>
var ftbl_speclist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftbl_speclist = currentForm = new ew.Form("ftbl_speclist", "list");
	ftbl_speclist.formKeyCountName = '<?php echo $tbl_spec_list->FormKeyCountName ?>';
	loadjs.done("ftbl_speclist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tbl_spec_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_spec_list->TotalRecords > 0 && $tbl_spec_list->ExportOptions->visible()) { ?>
<?php $tbl_spec_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_spec_list->ImportOptions->visible()) { ?>
<?php $tbl_spec_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_spec_list->isExport() || Config("EXPORT_MASTER_RECORD") && $tbl_spec_list->isExport("print")) { ?>
<?php
if ($tbl_spec_list->DbMasterFilter != "" && $tbl_spec->getCurrentMasterTable() == "tbl_pr") {
	if ($tbl_spec_list->MasterRecordExists) {
		include_once "tbl_prmaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_spec_list->renderOtherOptions();
?>
<?php $tbl_spec_list->showPageHeader(); ?>
<?php
$tbl_spec_list->showMessage();
?>
<?php if ($tbl_spec_list->TotalRecords > 0 || $tbl_spec->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_spec_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_spec">
<form name="ftbl_speclist" id="ftbl_speclist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_spec">
<?php if ($tbl_spec->getCurrentMasterTable() == "tbl_pr" && $tbl_spec->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="tbl_pr">
<input type="hidden" name="fk_pr_number" value="<?php echo HtmlEncode($tbl_spec_list->pr_number->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_tbl_spec" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tbl_spec_list->TotalRecords > 0 || $tbl_spec_list->isGridEdit()) { ?>
<table id="tbl_tbl_speclist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_spec->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_spec_list->renderListOptions();

// Render list options (header, left)
$tbl_spec_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_spec_list->pr_number->Visible) { // pr_number ?>
	<?php if ($tbl_spec_list->SortUrl($tbl_spec_list->pr_number) == "") { ?>
		<th data-name="pr_number" class="<?php echo $tbl_spec_list->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_pr_number" class="tbl_spec_pr_number"><div class="ew-table-header-caption"><?php echo $tbl_spec_list->pr_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pr_number" class="<?php echo $tbl_spec_list->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_spec_list->SortUrl($tbl_spec_list->pr_number) ?>', 1);"><div id="elh_tbl_spec_pr_number" class="tbl_spec_pr_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_list->pr_number->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_list->pr_number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_list->pr_number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_list->spec_unit->Visible) { // spec_unit ?>
	<?php if ($tbl_spec_list->SortUrl($tbl_spec_list->spec_unit) == "") { ?>
		<th data-name="spec_unit" class="<?php echo $tbl_spec_list->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_unit" class="tbl_spec_spec_unit"><div class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_unit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unit" class="<?php echo $tbl_spec_list->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_spec_list->SortUrl($tbl_spec_list->spec_unit) ?>', 1);"><div id="elh_tbl_spec_spec_unit" class="tbl_spec_spec_unit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_unit->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_list->spec_unit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_list->spec_unit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_list->spec_dsc->Visible) { // spec_dsc ?>
	<?php if ($tbl_spec_list->SortUrl($tbl_spec_list->spec_dsc) == "") { ?>
		<th data-name="spec_dsc" class="<?php echo $tbl_spec_list->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc"><div class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_dsc" class="<?php echo $tbl_spec_list->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_spec_list->SortUrl($tbl_spec_list->spec_dsc) ?>', 1);"><div id="elh_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_list->spec_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_list->spec_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_list->spec_qty->Visible) { // spec_qty ?>
	<?php if ($tbl_spec_list->SortUrl($tbl_spec_list->spec_qty) == "") { ?>
		<th data-name="spec_qty" class="<?php echo $tbl_spec_list->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_qty" class="tbl_spec_spec_qty"><div class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_qty" class="<?php echo $tbl_spec_list->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_spec_list->SortUrl($tbl_spec_list->spec_qty) ?>', 1);"><div id="elh_tbl_spec_spec_qty" class="tbl_spec_spec_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_list->spec_qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_list->spec_qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_list->spec_unitprice->Visible) { // spec_unitprice ?>
	<?php if ($tbl_spec_list->SortUrl($tbl_spec_list->spec_unitprice) == "") { ?>
		<th data-name="spec_unitprice" class="<?php echo $tbl_spec_list->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice"><div class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_unitprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unitprice" class="<?php echo $tbl_spec_list->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_spec_list->SortUrl($tbl_spec_list->spec_unitprice) ?>', 1);"><div id="elh_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_unitprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_list->spec_unitprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_list->spec_unitprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_list->spec_totalprice->Visible) { // spec_totalprice ?>
	<?php if ($tbl_spec_list->SortUrl($tbl_spec_list->spec_totalprice) == "") { ?>
		<th data-name="spec_totalprice" class="<?php echo $tbl_spec_list->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice"><div class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_totalprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_totalprice" class="<?php echo $tbl_spec_list->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tbl_spec_list->SortUrl($tbl_spec_list->spec_totalprice) ?>', 1);"><div id="elh_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_list->spec_totalprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_list->spec_totalprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_list->spec_totalprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_spec_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_spec_list->ExportAll && $tbl_spec_list->isExport()) {
	$tbl_spec_list->StopRecord = $tbl_spec_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tbl_spec_list->TotalRecords > $tbl_spec_list->StartRecord + $tbl_spec_list->DisplayRecords - 1)
		$tbl_spec_list->StopRecord = $tbl_spec_list->StartRecord + $tbl_spec_list->DisplayRecords - 1;
	else
		$tbl_spec_list->StopRecord = $tbl_spec_list->TotalRecords;
}
$tbl_spec_list->RecordCount = $tbl_spec_list->StartRecord - 1;
if ($tbl_spec_list->Recordset && !$tbl_spec_list->Recordset->EOF) {
	$tbl_spec_list->Recordset->moveFirst();
	$selectLimit = $tbl_spec_list->UseSelectLimit;
	if (!$selectLimit && $tbl_spec_list->StartRecord > 1)
		$tbl_spec_list->Recordset->move($tbl_spec_list->StartRecord - 1);
} elseif (!$tbl_spec->AllowAddDeleteRow && $tbl_spec_list->StopRecord == 0) {
	$tbl_spec_list->StopRecord = $tbl_spec->GridAddRowCount;
}

// Initialize aggregate
$tbl_spec->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_spec->resetAttributes();
$tbl_spec_list->renderRow();
while ($tbl_spec_list->RecordCount < $tbl_spec_list->StopRecord) {
	$tbl_spec_list->RecordCount++;
	if ($tbl_spec_list->RecordCount >= $tbl_spec_list->StartRecord) {
		$tbl_spec_list->RowCount++;

		// Set up key count
		$tbl_spec_list->KeyCount = $tbl_spec_list->RowIndex;

		// Init row class and style
		$tbl_spec->resetAttributes();
		$tbl_spec->CssClass = "";
		if ($tbl_spec_list->isGridAdd()) {
		} else {
			$tbl_spec_list->loadRowValues($tbl_spec_list->Recordset); // Load row values
		}
		$tbl_spec->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_spec->RowAttrs->merge(["data-rowindex" => $tbl_spec_list->RowCount, "id" => "r" . $tbl_spec_list->RowCount . "_tbl_spec", "data-rowtype" => $tbl_spec->RowType]);

		// Render row
		$tbl_spec_list->renderRow();

		// Render list options
		$tbl_spec_list->renderListOptions();
?>
	<tr <?php echo $tbl_spec->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_spec_list->ListOptions->render("body", "left", $tbl_spec_list->RowCount);
?>
	<?php if ($tbl_spec_list->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" <?php echo $tbl_spec_list->pr_number->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_list->RowCount ?>_tbl_spec_pr_number">
<span<?php echo $tbl_spec_list->pr_number->viewAttributes() ?>><?php echo $tbl_spec_list->pr_number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit" <?php echo $tbl_spec_list->spec_unit->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_list->RowCount ?>_tbl_spec_spec_unit">
<span<?php echo $tbl_spec_list->spec_unit->viewAttributes() ?>><?php echo $tbl_spec_list->spec_unit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc" <?php echo $tbl_spec_list->spec_dsc->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_list->RowCount ?>_tbl_spec_spec_dsc">
<span<?php echo $tbl_spec_list->spec_dsc->viewAttributes() ?>><?php echo $tbl_spec_list->spec_dsc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty" <?php echo $tbl_spec_list->spec_qty->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_list->RowCount ?>_tbl_spec_spec_qty">
<span<?php echo $tbl_spec_list->spec_qty->viewAttributes() ?>><?php echo $tbl_spec_list->spec_qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice" <?php echo $tbl_spec_list->spec_unitprice->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_list->RowCount ?>_tbl_spec_spec_unitprice">
<span<?php echo $tbl_spec_list->spec_unitprice->viewAttributes() ?>><?php echo $tbl_spec_list->spec_unitprice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice" <?php echo $tbl_spec_list->spec_totalprice->cellAttributes() ?>>
<span id="el<?php echo $tbl_spec_list->RowCount ?>_tbl_spec_spec_totalprice">
<span<?php echo $tbl_spec_list->spec_totalprice->viewAttributes() ?>><?php echo $tbl_spec_list->spec_totalprice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_spec_list->ListOptions->render("body", "right", $tbl_spec_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tbl_spec_list->isGridAdd())
		$tbl_spec_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_spec->RowType = ROWTYPE_AGGREGATE;
$tbl_spec->resetAttributes();
$tbl_spec_list->renderRow();
?>
<?php if ($tbl_spec_list->TotalRecords > 0 && !$tbl_spec_list->isGridAdd() && !$tbl_spec_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_spec_list->renderListOptions();

// Render list options (footer, left)
$tbl_spec_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_spec_list->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" class="<?php echo $tbl_spec_list->pr_number->footerCellClass() ?>"><span id="elf_tbl_spec_pr_number" class="tbl_spec_pr_number">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit" class="<?php echo $tbl_spec_list->spec_unit->footerCellClass() ?>"><span id="elf_tbl_spec_spec_unit" class="tbl_spec_spec_unit">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc" class="<?php echo $tbl_spec_list->spec_dsc->footerCellClass() ?>"><span id="elf_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty" class="<?php echo $tbl_spec_list->spec_qty->footerCellClass() ?>"><span id="elf_tbl_spec_spec_qty" class="tbl_spec_spec_qty">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice" class="<?php echo $tbl_spec_list->spec_unitprice->footerCellClass() ?>"><span id="elf_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_list->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice" class="<?php echo $tbl_spec_list->spec_totalprice->footerCellClass() ?>"><span id="elf_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_spec_list->spec_totalprice->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_spec_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tbl_spec->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_spec_list->Recordset)
	$tbl_spec_list->Recordset->Close();
?>
<?php if (!$tbl_spec_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $tbl_spec_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_spec_list->TotalRecords == 0 && !$tbl_spec->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_spec_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_spec_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tbl_spec_list->isExport()) { ?>
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
$tbl_spec_list->terminate();
?>