<?php
namespace PHPMaker2020\pantawid2020;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_spec_grid))
	$tbl_spec_grid = new tbl_spec_grid();

// Run the page
$tbl_spec_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_spec_grid->Page_Render();
?>
<?php if (!$tbl_spec_grid->isExport()) { ?>
<script>
var ftbl_specgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ftbl_specgrid = new ew.Form("ftbl_specgrid", "grid");
	ftbl_specgrid.formKeyCountName = '<?php echo $tbl_spec_grid->FormKeyCountName ?>';

	// Validate form
	ftbl_specgrid.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($tbl_spec_grid->pr_number->Required) { ?>
				elm = this.getElements("x" + infix + "_pr_number");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_grid->pr_number->caption(), $tbl_spec_grid->pr_number->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_grid->spec_unit->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_unit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_grid->spec_unit->caption(), $tbl_spec_grid->spec_unit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_grid->spec_dsc->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_dsc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_grid->spec_dsc->caption(), $tbl_spec_grid->spec_dsc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_spec_grid->spec_qty->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_grid->spec_qty->caption(), $tbl_spec_grid->spec_qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_qty");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_grid->spec_qty->errorMessage()) ?>");
			<?php if ($tbl_spec_grid->spec_unitprice->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_unitprice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_grid->spec_unitprice->caption(), $tbl_spec_grid->spec_unitprice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_unitprice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_grid->spec_unitprice->errorMessage()) ?>");
			<?php if ($tbl_spec_grid->spec_totalprice->Required) { ?>
				elm = this.getElements("x" + infix + "_spec_totalprice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_spec_grid->spec_totalprice->caption(), $tbl_spec_grid->spec_totalprice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_spec_totalprice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_spec_grid->spec_totalprice->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ftbl_specgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pr_number", false)) return false;
		if (ew.valueChanged(fobj, infix, "spec_unit", false)) return false;
		if (ew.valueChanged(fobj, infix, "spec_dsc", false)) return false;
		if (ew.valueChanged(fobj, infix, "spec_qty", false)) return false;
		if (ew.valueChanged(fobj, infix, "spec_unitprice", false)) return false;
		if (ew.valueChanged(fobj, infix, "spec_totalprice", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ftbl_specgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_specgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_specgrid.lists["x_spec_unit"] = <?php echo $tbl_spec_grid->spec_unit->Lookup->toClientList($tbl_spec_grid) ?>;
	ftbl_specgrid.lists["x_spec_unit"].options = <?php echo JsonEncode($tbl_spec_grid->spec_unit->lookupOptions()) ?>;
	loadjs.done("ftbl_specgrid");
});
</script>
<?php } ?>
<?php
$tbl_spec_grid->renderOtherOptions();
?>
<?php if ($tbl_spec_grid->TotalRecords > 0 || $tbl_spec->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_spec_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_spec">
<div id="ftbl_specgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_spec" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_specgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_spec->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_spec_grid->renderListOptions();

// Render list options (header, left)
$tbl_spec_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_spec_grid->pr_number->Visible) { // pr_number ?>
	<?php if ($tbl_spec_grid->SortUrl($tbl_spec_grid->pr_number) == "") { ?>
		<th data-name="pr_number" class="<?php echo $tbl_spec_grid->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_pr_number" class="tbl_spec_pr_number"><div class="ew-table-header-caption"><?php echo $tbl_spec_grid->pr_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pr_number" class="<?php echo $tbl_spec_grid->pr_number->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div><div id="elh_tbl_spec_pr_number" class="tbl_spec_pr_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_grid->pr_number->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_grid->pr_number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_grid->pr_number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_grid->spec_unit->Visible) { // spec_unit ?>
	<?php if ($tbl_spec_grid->SortUrl($tbl_spec_grid->spec_unit) == "") { ?>
		<th data-name="spec_unit" class="<?php echo $tbl_spec_grid->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_unit" class="tbl_spec_spec_unit"><div class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_unit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unit" class="<?php echo $tbl_spec_grid->spec_unit->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div><div id="elh_tbl_spec_spec_unit" class="tbl_spec_spec_unit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_unit->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_grid->spec_unit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_grid->spec_unit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_grid->spec_dsc->Visible) { // spec_dsc ?>
	<?php if ($tbl_spec_grid->SortUrl($tbl_spec_grid->spec_dsc) == "") { ?>
		<th data-name="spec_dsc" class="<?php echo $tbl_spec_grid->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc"><div class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_dsc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_dsc" class="<?php echo $tbl_spec_grid->spec_dsc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div><div id="elh_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_grid->spec_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_grid->spec_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_grid->spec_qty->Visible) { // spec_qty ?>
	<?php if ($tbl_spec_grid->SortUrl($tbl_spec_grid->spec_qty) == "") { ?>
		<th data-name="spec_qty" class="<?php echo $tbl_spec_grid->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_qty" class="tbl_spec_spec_qty"><div class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_qty" class="<?php echo $tbl_spec_grid->spec_qty->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div><div id="elh_tbl_spec_spec_qty" class="tbl_spec_spec_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_grid->spec_qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_grid->spec_qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_grid->spec_unitprice->Visible) { // spec_unitprice ?>
	<?php if ($tbl_spec_grid->SortUrl($tbl_spec_grid->spec_unitprice) == "") { ?>
		<th data-name="spec_unitprice" class="<?php echo $tbl_spec_grid->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice"><div class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_unitprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_unitprice" class="<?php echo $tbl_spec_grid->spec_unitprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div><div id="elh_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_unitprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_grid->spec_unitprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_grid->spec_unitprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_spec_grid->spec_totalprice->Visible) { // spec_totalprice ?>
	<?php if ($tbl_spec_grid->SortUrl($tbl_spec_grid->spec_totalprice) == "") { ?>
		<th data-name="spec_totalprice" class="<?php echo $tbl_spec_grid->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice"><div class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_totalprice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spec_totalprice" class="<?php echo $tbl_spec_grid->spec_totalprice->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div><div id="elh_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_spec_grid->spec_totalprice->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_spec_grid->spec_totalprice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_spec_grid->spec_totalprice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_spec_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_spec_grid->StartRecord = 1;
$tbl_spec_grid->StopRecord = $tbl_spec_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($tbl_spec->isConfirm() || $tbl_spec_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_spec_grid->FormKeyCountName) && ($tbl_spec_grid->isGridAdd() || $tbl_spec_grid->isGridEdit() || $tbl_spec->isConfirm())) {
		$tbl_spec_grid->KeyCount = $CurrentForm->getValue($tbl_spec_grid->FormKeyCountName);
		$tbl_spec_grid->StopRecord = $tbl_spec_grid->StartRecord + $tbl_spec_grid->KeyCount - 1;
	}
}
$tbl_spec_grid->RecordCount = $tbl_spec_grid->StartRecord - 1;
if ($tbl_spec_grid->Recordset && !$tbl_spec_grid->Recordset->EOF) {
	$tbl_spec_grid->Recordset->moveFirst();
	$selectLimit = $tbl_spec_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_spec_grid->StartRecord > 1)
		$tbl_spec_grid->Recordset->move($tbl_spec_grid->StartRecord - 1);
} elseif (!$tbl_spec->AllowAddDeleteRow && $tbl_spec_grid->StopRecord == 0) {
	$tbl_spec_grid->StopRecord = $tbl_spec->GridAddRowCount;
}

// Initialize aggregate
$tbl_spec->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_spec->resetAttributes();
$tbl_spec_grid->renderRow();
if ($tbl_spec_grid->isGridAdd())
	$tbl_spec_grid->RowIndex = 0;
if ($tbl_spec_grid->isGridEdit())
	$tbl_spec_grid->RowIndex = 0;
while ($tbl_spec_grid->RecordCount < $tbl_spec_grid->StopRecord) {
	$tbl_spec_grid->RecordCount++;
	if ($tbl_spec_grid->RecordCount >= $tbl_spec_grid->StartRecord) {
		$tbl_spec_grid->RowCount++;
		if ($tbl_spec_grid->isGridAdd() || $tbl_spec_grid->isGridEdit() || $tbl_spec->isConfirm()) {
			$tbl_spec_grid->RowIndex++;
			$CurrentForm->Index = $tbl_spec_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_spec_grid->FormActionName) && ($tbl_spec->isConfirm() || $tbl_spec_grid->EventCancelled))
				$tbl_spec_grid->RowAction = strval($CurrentForm->getValue($tbl_spec_grid->FormActionName));
			elseif ($tbl_spec_grid->isGridAdd())
				$tbl_spec_grid->RowAction = "insert";
			else
				$tbl_spec_grid->RowAction = "";
		}

		// Set up key count
		$tbl_spec_grid->KeyCount = $tbl_spec_grid->RowIndex;

		// Init row class and style
		$tbl_spec->resetAttributes();
		$tbl_spec->CssClass = "";
		if ($tbl_spec_grid->isGridAdd()) {
			if ($tbl_spec->CurrentMode == "copy") {
				$tbl_spec_grid->loadRowValues($tbl_spec_grid->Recordset); // Load row values
				$tbl_spec_grid->setRecordKey($tbl_spec_grid->RowOldKey, $tbl_spec_grid->Recordset); // Set old record key
			} else {
				$tbl_spec_grid->loadRowValues(); // Load default values
				$tbl_spec_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_spec_grid->loadRowValues($tbl_spec_grid->Recordset); // Load row values
		}
		$tbl_spec->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_spec_grid->isGridAdd()) // Grid add
			$tbl_spec->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_spec_grid->isGridAdd() && $tbl_spec->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_spec_grid->restoreCurrentRowFormValues($tbl_spec_grid->RowIndex); // Restore form values
		if ($tbl_spec_grid->isGridEdit()) { // Grid edit
			if ($tbl_spec->EventCancelled)
				$tbl_spec_grid->restoreCurrentRowFormValues($tbl_spec_grid->RowIndex); // Restore form values
			if ($tbl_spec_grid->RowAction == "insert")
				$tbl_spec->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_spec->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_spec_grid->isGridEdit() && ($tbl_spec->RowType == ROWTYPE_EDIT || $tbl_spec->RowType == ROWTYPE_ADD) && $tbl_spec->EventCancelled) // Update failed
			$tbl_spec_grid->restoreCurrentRowFormValues($tbl_spec_grid->RowIndex); // Restore form values
		if ($tbl_spec->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_spec_grid->EditRowCount++;
		if ($tbl_spec->isConfirm()) // Confirm row
			$tbl_spec_grid->restoreCurrentRowFormValues($tbl_spec_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_spec->RowAttrs->merge(["data-rowindex" => $tbl_spec_grid->RowCount, "id" => "r" . $tbl_spec_grid->RowCount . "_tbl_spec", "data-rowtype" => $tbl_spec->RowType]);

		// Render row
		$tbl_spec_grid->renderRow();

		// Render list options
		$tbl_spec_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_spec_grid->RowAction != "delete" && $tbl_spec_grid->RowAction != "insertdelete" && !($tbl_spec_grid->RowAction == "insert" && $tbl_spec->isConfirm() && $tbl_spec_grid->emptyRow())) {
?>
	<tr <?php echo $tbl_spec->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_spec_grid->ListOptions->render("body", "left", $tbl_spec_grid->RowCount);
?>
	<?php if ($tbl_spec_grid->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" <?php echo $tbl_spec_grid->pr_number->cellAttributes() ?>>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($tbl_spec_grid->pr_number->getSessionValue() != "") { ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_pr_number" class="form-group">
<span<?php echo $tbl_spec_grid->pr_number->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->pr_number->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_pr_number" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_spec_grid->pr_number->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->pr_number->EditValue ?>"<?php echo $tbl_spec_grid->pr_number->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="tbl_spec" data-field="x_pr_number" name="o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->OldValue) ?>">
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($tbl_spec_grid->pr_number->getSessionValue() != "") { ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_pr_number" class="form-group">
<span<?php echo $tbl_spec_grid->pr_number->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->pr_number->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_pr_number" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_spec_grid->pr_number->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->pr_number->EditValue ?>"<?php echo $tbl_spec_grid->pr_number->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_pr_number">
<span<?php echo $tbl_spec_grid->pr_number->viewAttributes() ?>><?php echo $tbl_spec_grid->pr_number->getViewValue() ?></span>
</span>
<?php if (!$tbl_spec->isConfirm()) { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_pr_number" name="o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_pr_number" name="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_pr_number" name="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_spec" data-field="x_specID" name="x<?php echo $tbl_spec_grid->RowIndex ?>_specID" id="x<?php echo $tbl_spec_grid->RowIndex ?>_specID" value="<?php echo HtmlEncode($tbl_spec_grid->specID->CurrentValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_specID" name="o<?php echo $tbl_spec_grid->RowIndex ?>_specID" id="o<?php echo $tbl_spec_grid->RowIndex ?>_specID" value="<?php echo HtmlEncode($tbl_spec_grid->specID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_EDIT || $tbl_spec->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_specID" name="x<?php echo $tbl_spec_grid->RowIndex ?>_specID" id="x<?php echo $tbl_spec_grid->RowIndex ?>_specID" value="<?php echo HtmlEncode($tbl_spec_grid->specID->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_spec_grid->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit" <?php echo $tbl_spec_grid->spec_unit->cellAttributes() ?>>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_unit" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_spec" data-field="x_spec_unit" data-value-separator="<?php echo $tbl_spec_grid->spec_unit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit"<?php echo $tbl_spec_grid->spec_unit->editAttributes() ?>>
			<?php echo $tbl_spec_grid->spec_unit->selectOptionListHtml("x{$tbl_spec_grid->RowIndex}_spec_unit") ?>
		</select>
</div>
<?php echo $tbl_spec_grid->spec_unit->Lookup->getParamTag($tbl_spec_grid, "p_x" . $tbl_spec_grid->RowIndex . "_spec_unit") ?>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unit" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unit->OldValue) ?>">
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_unit" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_spec" data-field="x_spec_unit" data-value-separator="<?php echo $tbl_spec_grid->spec_unit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit"<?php echo $tbl_spec_grid->spec_unit->editAttributes() ?>>
			<?php echo $tbl_spec_grid->spec_unit->selectOptionListHtml("x{$tbl_spec_grid->RowIndex}_spec_unit") ?>
		</select>
</div>
<?php echo $tbl_spec_grid->spec_unit->Lookup->getParamTag($tbl_spec_grid, "p_x" . $tbl_spec_grid->RowIndex . "_spec_unit") ?>
</span>
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_unit">
<span<?php echo $tbl_spec_grid->spec_unit->viewAttributes() ?>><?php echo $tbl_spec_grid->spec_unit->getViewValue() ?></span>
</span>
<?php if (!$tbl_spec->isConfirm()) { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unit" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unit->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unit" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unit->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unit" name="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" id="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unit->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unit" name="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" id="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc" <?php echo $tbl_spec_grid->spec_dsc->cellAttributes() ?>>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_dsc" class="form-group">
<textarea data-table="tbl_spec" data-field="x_spec_dsc" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->getPlaceHolder()) ?>"<?php echo $tbl_spec_grid->spec_dsc->editAttributes() ?>><?php echo $tbl_spec_grid->spec_dsc->EditValue ?></textarea>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_dsc" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" value="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->OldValue) ?>">
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_dsc" class="form-group">
<textarea data-table="tbl_spec" data-field="x_spec_dsc" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->getPlaceHolder()) ?>"<?php echo $tbl_spec_grid->spec_dsc->editAttributes() ?>><?php echo $tbl_spec_grid->spec_dsc->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_dsc">
<span<?php echo $tbl_spec_grid->spec_dsc->viewAttributes() ?>><?php echo $tbl_spec_grid->spec_dsc->getViewValue() ?></span>
</span>
<?php if (!$tbl_spec->isConfirm()) { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_dsc" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" value="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_dsc" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" value="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_dsc" name="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" value="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_dsc" name="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" value="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty" <?php echo $tbl_spec_grid->spec_qty->cellAttributes() ?>>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_qty" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_spec_qty" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_qty->EditValue ?>"<?php echo $tbl_spec_grid->spec_qty->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_qty" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" value="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->OldValue) ?>">
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_qty" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_spec_qty" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_qty->EditValue ?>"<?php echo $tbl_spec_grid->spec_qty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_qty">
<span<?php echo $tbl_spec_grid->spec_qty->viewAttributes() ?>><?php echo $tbl_spec_grid->spec_qty->getViewValue() ?></span>
</span>
<?php if (!$tbl_spec->isConfirm()) { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_qty" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" value="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_qty" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" value="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_qty" name="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" value="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_qty" name="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" value="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice" <?php echo $tbl_spec_grid->spec_unitprice->cellAttributes() ?>>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_unitprice" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_spec_unitprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_unitprice->EditValue ?>"<?php echo $tbl_spec_grid->spec_unitprice->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unitprice" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->OldValue) ?>">
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_unitprice" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_spec_unitprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_unitprice->EditValue ?>"<?php echo $tbl_spec_grid->spec_unitprice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_unitprice">
<span<?php echo $tbl_spec_grid->spec_unitprice->viewAttributes() ?>><?php echo $tbl_spec_grid->spec_unitprice->getViewValue() ?></span>
</span>
<?php if (!$tbl_spec->isConfirm()) { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unitprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unitprice" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unitprice" name="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unitprice" name="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice" <?php echo $tbl_spec_grid->spec_totalprice->cellAttributes() ?>>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_totalprice" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_spec_totalprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_totalprice->EditValue ?>"<?php echo $tbl_spec_grid->spec_totalprice->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_totalprice" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->OldValue) ?>">
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_totalprice" class="form-group">
<input type="text" data-table="tbl_spec" data-field="x_spec_totalprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_totalprice->EditValue ?>"<?php echo $tbl_spec_grid->spec_totalprice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_spec->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_spec_grid->RowCount ?>_tbl_spec_spec_totalprice">
<span<?php echo $tbl_spec_grid->spec_totalprice->viewAttributes() ?>><?php echo $tbl_spec_grid->spec_totalprice->getViewValue() ?></span>
</span>
<?php if (!$tbl_spec->isConfirm()) { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_totalprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_totalprice" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_totalprice" name="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="ftbl_specgrid$x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->FormValue) ?>">
<input type="hidden" data-table="tbl_spec" data-field="x_spec_totalprice" name="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="ftbl_specgrid$o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_spec_grid->ListOptions->render("body", "right", $tbl_spec_grid->RowCount);
?>
	</tr>
<?php if ($tbl_spec->RowType == ROWTYPE_ADD || $tbl_spec->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ftbl_specgrid", "load"], function() {
	ftbl_specgrid.updateLists(<?php echo $tbl_spec_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_spec_grid->isGridAdd() || $tbl_spec->CurrentMode == "copy")
		if (!$tbl_spec_grid->Recordset->EOF)
			$tbl_spec_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_spec->CurrentMode == "add" || $tbl_spec->CurrentMode == "copy" || $tbl_spec->CurrentMode == "edit") {
		$tbl_spec_grid->RowIndex = '$rowindex$';
		$tbl_spec_grid->loadRowValues();

		// Set row properties
		$tbl_spec->resetAttributes();
		$tbl_spec->RowAttrs->merge(["data-rowindex" => $tbl_spec_grid->RowIndex, "id" => "r0_tbl_spec", "data-rowtype" => ROWTYPE_ADD]);
		$tbl_spec->RowAttrs->appendClass("ew-template");
		$tbl_spec->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_spec_grid->renderRow();

		// Render list options
		$tbl_spec_grid->renderListOptions();
		$tbl_spec_grid->StartRowCount = 0;
?>
	<tr <?php echo $tbl_spec->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_spec_grid->ListOptions->render("body", "left", $tbl_spec_grid->RowIndex);
?>
	<?php if ($tbl_spec_grid->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number">
<?php if (!$tbl_spec->isConfirm()) { ?>
<?php if ($tbl_spec_grid->pr_number->getSessionValue() != "") { ?>
<span id="el$rowindex$_tbl_spec_pr_number" class="form-group tbl_spec_pr_number">
<span<?php echo $tbl_spec_grid->pr_number->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->pr_number->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_tbl_spec_pr_number" class="form-group tbl_spec_pr_number">
<input type="text" data-table="tbl_spec" data-field="x_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($tbl_spec_grid->pr_number->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->pr_number->EditValue ?>"<?php echo $tbl_spec_grid->pr_number->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_spec_pr_number" class="form-group tbl_spec_pr_number">
<span<?php echo $tbl_spec_grid->pr_number->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->pr_number->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_pr_number" name="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="x<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_spec" data-field="x_pr_number" name="o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" id="o<?php echo $tbl_spec_grid->RowIndex ?>_pr_number" value="<?php echo HtmlEncode($tbl_spec_grid->pr_number->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit">
<?php if (!$tbl_spec->isConfirm()) { ?>
<span id="el$rowindex$_tbl_spec_spec_unit" class="form-group tbl_spec_spec_unit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_spec" data-field="x_spec_unit" data-value-separator="<?php echo $tbl_spec_grid->spec_unit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit"<?php echo $tbl_spec_grid->spec_unit->editAttributes() ?>>
			<?php echo $tbl_spec_grid->spec_unit->selectOptionListHtml("x{$tbl_spec_grid->RowIndex}_spec_unit") ?>
		</select>
</div>
<?php echo $tbl_spec_grid->spec_unit->Lookup->getParamTag($tbl_spec_grid, "p_x" . $tbl_spec_grid->RowIndex . "_spec_unit") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_spec_spec_unit" class="form-group tbl_spec_spec_unit">
<span<?php echo $tbl_spec_grid->spec_unit->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->spec_unit->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unit" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unit" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unit" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc">
<?php if (!$tbl_spec->isConfirm()) { ?>
<span id="el$rowindex$_tbl_spec_spec_dsc" class="form-group tbl_spec_spec_dsc">
<textarea data-table="tbl_spec" data-field="x_spec_dsc" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->getPlaceHolder()) ?>"<?php echo $tbl_spec_grid->spec_dsc->editAttributes() ?>><?php echo $tbl_spec_grid->spec_dsc->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_spec_spec_dsc" class="form-group tbl_spec_spec_dsc">
<span<?php echo $tbl_spec_grid->spec_dsc->viewAttributes() ?>><?php echo $tbl_spec_grid->spec_dsc->ViewValue ?></span>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_dsc" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" value="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_dsc" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_dsc" value="<?php echo HtmlEncode($tbl_spec_grid->spec_dsc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty">
<?php if (!$tbl_spec->isConfirm()) { ?>
<span id="el$rowindex$_tbl_spec_spec_qty" class="form-group tbl_spec_spec_qty">
<input type="text" data-table="tbl_spec" data-field="x_spec_qty" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_qty->EditValue ?>"<?php echo $tbl_spec_grid->spec_qty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_spec_spec_qty" class="form-group tbl_spec_spec_qty">
<span<?php echo $tbl_spec_grid->spec_qty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->spec_qty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_qty" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" value="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_qty" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_qty" value="<?php echo HtmlEncode($tbl_spec_grid->spec_qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice">
<?php if (!$tbl_spec->isConfirm()) { ?>
<span id="el$rowindex$_tbl_spec_spec_unitprice" class="form-group tbl_spec_spec_unitprice">
<input type="text" data-table="tbl_spec" data-field="x_spec_unitprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_unitprice->EditValue ?>"<?php echo $tbl_spec_grid->spec_unitprice->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_spec_spec_unitprice" class="form-group tbl_spec_spec_unitprice">
<span<?php echo $tbl_spec_grid->spec_unitprice->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->spec_unitprice->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unitprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_unitprice" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_unitprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_unitprice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice">
<?php if (!$tbl_spec->isConfirm()) { ?>
<span id="el$rowindex$_tbl_spec_spec_totalprice" class="form-group tbl_spec_spec_totalprice">
<input type="text" data-table="tbl_spec" data-field="x_spec_totalprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" size="30" maxlength="51" placeholder="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->getPlaceHolder()) ?>" value="<?php echo $tbl_spec_grid->spec_totalprice->EditValue ?>"<?php echo $tbl_spec_grid->spec_totalprice->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_spec_spec_totalprice" class="form-group tbl_spec_spec_totalprice">
<span<?php echo $tbl_spec_grid->spec_totalprice->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_spec_grid->spec_totalprice->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_totalprice" name="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="x<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_spec" data-field="x_spec_totalprice" name="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" id="o<?php echo $tbl_spec_grid->RowIndex ?>_spec_totalprice" value="<?php echo HtmlEncode($tbl_spec_grid->spec_totalprice->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_spec_grid->ListOptions->render("body", "right", $tbl_spec_grid->RowIndex);
?>
<script>
loadjs.ready(["ftbl_specgrid", "load"], function() {
	ftbl_specgrid.updateLists(<?php echo $tbl_spec_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$tbl_spec->RowType = ROWTYPE_AGGREGATE;
$tbl_spec->resetAttributes();
$tbl_spec_grid->renderRow();
?>
<?php if ($tbl_spec_grid->TotalRecords > 0 && $tbl_spec->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_spec_grid->renderListOptions();

// Render list options (footer, left)
$tbl_spec_grid->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_spec_grid->pr_number->Visible) { // pr_number ?>
		<td data-name="pr_number" class="<?php echo $tbl_spec_grid->pr_number->footerCellClass() ?>"><span id="elf_tbl_spec_pr_number" class="tbl_spec_pr_number">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_unit->Visible) { // spec_unit ?>
		<td data-name="spec_unit" class="<?php echo $tbl_spec_grid->spec_unit->footerCellClass() ?>"><span id="elf_tbl_spec_spec_unit" class="tbl_spec_spec_unit">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_dsc->Visible) { // spec_dsc ?>
		<td data-name="spec_dsc" class="<?php echo $tbl_spec_grid->spec_dsc->footerCellClass() ?>"><span id="elf_tbl_spec_spec_dsc" class="tbl_spec_spec_dsc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_qty->Visible) { // spec_qty ?>
		<td data-name="spec_qty" class="<?php echo $tbl_spec_grid->spec_qty->footerCellClass() ?>"><span id="elf_tbl_spec_spec_qty" class="tbl_spec_spec_qty">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_unitprice->Visible) { // spec_unitprice ?>
		<td data-name="spec_unitprice" class="<?php echo $tbl_spec_grid->spec_unitprice->footerCellClass() ?>"><span id="elf_tbl_spec_spec_unitprice" class="tbl_spec_spec_unitprice">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_spec_grid->spec_totalprice->Visible) { // spec_totalprice ?>
		<td data-name="spec_totalprice" class="<?php echo $tbl_spec_grid->spec_totalprice->footerCellClass() ?>"><span id="elf_tbl_spec_spec_totalprice" class="tbl_spec_spec_totalprice">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_spec_grid->spec_totalprice->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_spec_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($tbl_spec->CurrentMode == "add" || $tbl_spec->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_spec_grid->FormKeyCountName ?>" id="<?php echo $tbl_spec_grid->FormKeyCountName ?>" value="<?php echo $tbl_spec_grid->KeyCount ?>">
<?php echo $tbl_spec_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_spec->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_spec_grid->FormKeyCountName ?>" id="<?php echo $tbl_spec_grid->FormKeyCountName ?>" value="<?php echo $tbl_spec_grid->KeyCount ?>">
<?php echo $tbl_spec_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_spec->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_specgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_spec_grid->Recordset)
	$tbl_spec_grid->Recordset->Close();
?>
<?php if ($tbl_spec_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_spec_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_spec_grid->TotalRecords == 0 && !$tbl_spec->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_spec_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$tbl_spec_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$tbl_spec_grid->terminate();
?>