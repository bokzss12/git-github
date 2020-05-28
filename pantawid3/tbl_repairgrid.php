<?php
namespace PHPMaker2020\pantawid2020;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_repair_grid))
	$tbl_repair_grid = new tbl_repair_grid();

// Run the page
$tbl_repair_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_repair_grid->Page_Render();
?>
<?php if (!$tbl_repair_grid->isExport()) { ?>
<script>
var ftbl_repairgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ftbl_repairgrid = new ew.Form("ftbl_repairgrid", "grid");
	ftbl_repairgrid.formKeyCountName = '<?php echo $tbl_repair_grid->FormKeyCountName ?>';

	// Validate form
	ftbl_repairgrid.validate = function() {
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
			<?php if ($tbl_repair_grid->inventory_id->Required) { ?>
				elm = this.getElements("x" + infix + "_inventory_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->inventory_id->caption(), $tbl_repair_grid->inventory_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_grid->inventory_idr->Required) { ?>
				elm = this.getElements("x" + infix + "_inventory_idr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->inventory_idr->caption(), $tbl_repair_grid->inventory_idr->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_inventory_idr");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_repair_grid->inventory_idr->errorMessage()) ?>");
			<?php if ($tbl_repair_grid->date_repaired->Required) { ?>
				elm = this.getElements("x" + infix + "_date_repaired");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->date_repaired->caption(), $tbl_repair_grid->date_repaired->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date_repaired");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tbl_repair_grid->date_repaired->errorMessage()) ?>");
			<?php if ($tbl_repair_grid->type_problem->Required) { ?>
				elm = this.getElements("x" + infix + "_type_problem");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->type_problem->caption(), $tbl_repair_grid->type_problem->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_grid->action_taken->Required) { ?>
				elm = this.getElements("x" + infix + "_action_taken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->action_taken->caption(), $tbl_repair_grid->action_taken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_grid->employee_id->Required) { ?>
				elm = this.getElements("x" + infix + "_employee_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->employee_id->caption(), $tbl_repair_grid->employee_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_grid->status_h->Required) { ?>
				elm = this.getElements("x" + infix + "_status_h");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->status_h->caption(), $tbl_repair_grid->status_h->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tbl_repair_grid->remark->Required) { ?>
				elm = this.getElements("x" + infix + "_remark");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_repair_grid->remark->caption(), $tbl_repair_grid->remark->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ftbl_repairgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "inventory_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "inventory_idr", false)) return false;
		if (ew.valueChanged(fobj, infix, "date_repaired", false)) return false;
		if (ew.valueChanged(fobj, infix, "type_problem", false)) return false;
		if (ew.valueChanged(fobj, infix, "action_taken", false)) return false;
		if (ew.valueChanged(fobj, infix, "employee_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "status_h", false)) return false;
		if (ew.valueChanged(fobj, infix, "remark", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ftbl_repairgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftbl_repairgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftbl_repairgrid.lists["x_employee_id"] = <?php echo $tbl_repair_grid->employee_id->Lookup->toClientList($tbl_repair_grid) ?>;
	ftbl_repairgrid.lists["x_employee_id"].options = <?php echo JsonEncode($tbl_repair_grid->employee_id->options(FALSE, TRUE)) ?>;
	ftbl_repairgrid.lists["x_status_h"] = <?php echo $tbl_repair_grid->status_h->Lookup->toClientList($tbl_repair_grid) ?>;
	ftbl_repairgrid.lists["x_status_h"].options = <?php echo JsonEncode($tbl_repair_grid->status_h->lookupOptions()) ?>;
	loadjs.done("ftbl_repairgrid");
});
</script>
<?php } ?>
<?php
$tbl_repair_grid->renderOtherOptions();
?>
<?php if ($tbl_repair_grid->TotalRecords > 0 || $tbl_repair->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_repair_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_repair">
<div id="ftbl_repairgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_repair" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_repairgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_repair->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_repair_grid->renderListOptions();

// Render list options (header, left)
$tbl_repair_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_repair_grid->inventory_id->Visible) { // inventory_id ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->inventory_id) == "") { ?>
		<th data-name="inventory_id" class="<?php echo $tbl_repair_grid->inventory_id->headerCellClass() ?>"><div id="elh_tbl_repair_inventory_id" class="tbl_repair_inventory_id"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->inventory_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_id" class="<?php echo $tbl_repair_grid->inventory_id->headerCellClass() ?>"><div><div id="elh_tbl_repair_inventory_id" class="tbl_repair_inventory_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->inventory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_grid->inventory_idr->Visible) { // inventory_idr ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->inventory_idr) == "") { ?>
		<th data-name="inventory_idr" class="<?php echo $tbl_repair_grid->inventory_idr->headerCellClass() ?>"><div id="elh_tbl_repair_inventory_idr" class="tbl_repair_inventory_idr"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->inventory_idr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_idr" class="<?php echo $tbl_repair_grid->inventory_idr->headerCellClass() ?>"><div><div id="elh_tbl_repair_inventory_idr" class="tbl_repair_inventory_idr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->inventory_idr->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->inventory_idr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->inventory_idr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_grid->date_repaired->Visible) { // date_repaired ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->date_repaired) == "") { ?>
		<th data-name="date_repaired" class="<?php echo $tbl_repair_grid->date_repaired->headerCellClass() ?>"><div id="elh_tbl_repair_date_repaired" class="tbl_repair_date_repaired"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->date_repaired->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date_repaired" class="<?php echo $tbl_repair_grid->date_repaired->headerCellClass() ?>"><div><div id="elh_tbl_repair_date_repaired" class="tbl_repair_date_repaired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->date_repaired->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->date_repaired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->date_repaired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_grid->type_problem->Visible) { // type_problem ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->type_problem) == "") { ?>
		<th data-name="type_problem" class="<?php echo $tbl_repair_grid->type_problem->headerCellClass() ?>"><div id="elh_tbl_repair_type_problem" class="tbl_repair_type_problem"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->type_problem->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type_problem" class="<?php echo $tbl_repair_grid->type_problem->headerCellClass() ?>"><div><div id="elh_tbl_repair_type_problem" class="tbl_repair_type_problem">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->type_problem->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->type_problem->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->type_problem->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_grid->action_taken->Visible) { // action_taken ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->action_taken) == "") { ?>
		<th data-name="action_taken" class="<?php echo $tbl_repair_grid->action_taken->headerCellClass() ?>"><div id="elh_tbl_repair_action_taken" class="tbl_repair_action_taken"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->action_taken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="action_taken" class="<?php echo $tbl_repair_grid->action_taken->headerCellClass() ?>"><div><div id="elh_tbl_repair_action_taken" class="tbl_repair_action_taken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->action_taken->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->action_taken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->action_taken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_grid->employee_id->Visible) { // employee_id ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->employee_id) == "") { ?>
		<th data-name="employee_id" class="<?php echo $tbl_repair_grid->employee_id->headerCellClass() ?>"><div id="elh_tbl_repair_employee_id" class="tbl_repair_employee_id"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->employee_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="employee_id" class="<?php echo $tbl_repair_grid->employee_id->headerCellClass() ?>"><div><div id="elh_tbl_repair_employee_id" class="tbl_repair_employee_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->employee_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->employee_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->employee_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_grid->status_h->Visible) { // status_h ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->status_h) == "") { ?>
		<th data-name="status_h" class="<?php echo $tbl_repair_grid->status_h->headerCellClass() ?>"><div id="elh_tbl_repair_status_h" class="tbl_repair_status_h"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->status_h->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_h" class="<?php echo $tbl_repair_grid->status_h->headerCellClass() ?>"><div><div id="elh_tbl_repair_status_h" class="tbl_repair_status_h">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->status_h->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->status_h->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->status_h->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_repair_grid->remark->Visible) { // remark ?>
	<?php if ($tbl_repair_grid->SortUrl($tbl_repair_grid->remark) == "") { ?>
		<th data-name="remark" class="<?php echo $tbl_repair_grid->remark->headerCellClass() ?>"><div id="elh_tbl_repair_remark" class="tbl_repair_remark"><div class="ew-table-header-caption"><?php echo $tbl_repair_grid->remark->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remark" class="<?php echo $tbl_repair_grid->remark->headerCellClass() ?>"><div><div id="elh_tbl_repair_remark" class="tbl_repair_remark">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_repair_grid->remark->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_repair_grid->remark->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tbl_repair_grid->remark->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_repair_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_repair_grid->StartRecord = 1;
$tbl_repair_grid->StopRecord = $tbl_repair_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($tbl_repair->isConfirm() || $tbl_repair_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_repair_grid->FormKeyCountName) && ($tbl_repair_grid->isGridAdd() || $tbl_repair_grid->isGridEdit() || $tbl_repair->isConfirm())) {
		$tbl_repair_grid->KeyCount = $CurrentForm->getValue($tbl_repair_grid->FormKeyCountName);
		$tbl_repair_grid->StopRecord = $tbl_repair_grid->StartRecord + $tbl_repair_grid->KeyCount - 1;
	}
}
$tbl_repair_grid->RecordCount = $tbl_repair_grid->StartRecord - 1;
if ($tbl_repair_grid->Recordset && !$tbl_repair_grid->Recordset->EOF) {
	$tbl_repair_grid->Recordset->moveFirst();
	$selectLimit = $tbl_repair_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_repair_grid->StartRecord > 1)
		$tbl_repair_grid->Recordset->move($tbl_repair_grid->StartRecord - 1);
} elseif (!$tbl_repair->AllowAddDeleteRow && $tbl_repair_grid->StopRecord == 0) {
	$tbl_repair_grid->StopRecord = $tbl_repair->GridAddRowCount;
}

// Initialize aggregate
$tbl_repair->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_repair->resetAttributes();
$tbl_repair_grid->renderRow();
if ($tbl_repair_grid->isGridAdd())
	$tbl_repair_grid->RowIndex = 0;
if ($tbl_repair_grid->isGridEdit())
	$tbl_repair_grid->RowIndex = 0;
while ($tbl_repair_grid->RecordCount < $tbl_repair_grid->StopRecord) {
	$tbl_repair_grid->RecordCount++;
	if ($tbl_repair_grid->RecordCount >= $tbl_repair_grid->StartRecord) {
		$tbl_repair_grid->RowCount++;
		if ($tbl_repair_grid->isGridAdd() || $tbl_repair_grid->isGridEdit() || $tbl_repair->isConfirm()) {
			$tbl_repair_grid->RowIndex++;
			$CurrentForm->Index = $tbl_repair_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_repair_grid->FormActionName) && ($tbl_repair->isConfirm() || $tbl_repair_grid->EventCancelled))
				$tbl_repair_grid->RowAction = strval($CurrentForm->getValue($tbl_repair_grid->FormActionName));
			elseif ($tbl_repair_grid->isGridAdd())
				$tbl_repair_grid->RowAction = "insert";
			else
				$tbl_repair_grid->RowAction = "";
		}

		// Set up key count
		$tbl_repair_grid->KeyCount = $tbl_repair_grid->RowIndex;

		// Init row class and style
		$tbl_repair->resetAttributes();
		$tbl_repair->CssClass = "";
		if ($tbl_repair_grid->isGridAdd()) {
			if ($tbl_repair->CurrentMode == "copy") {
				$tbl_repair_grid->loadRowValues($tbl_repair_grid->Recordset); // Load row values
				$tbl_repair_grid->setRecordKey($tbl_repair_grid->RowOldKey, $tbl_repair_grid->Recordset); // Set old record key
			} else {
				$tbl_repair_grid->loadRowValues(); // Load default values
				$tbl_repair_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_repair_grid->loadRowValues($tbl_repair_grid->Recordset); // Load row values
		}
		$tbl_repair->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_repair_grid->isGridAdd()) // Grid add
			$tbl_repair->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_repair_grid->isGridAdd() && $tbl_repair->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_repair_grid->restoreCurrentRowFormValues($tbl_repair_grid->RowIndex); // Restore form values
		if ($tbl_repair_grid->isGridEdit()) { // Grid edit
			if ($tbl_repair->EventCancelled)
				$tbl_repair_grid->restoreCurrentRowFormValues($tbl_repair_grid->RowIndex); // Restore form values
			if ($tbl_repair_grid->RowAction == "insert")
				$tbl_repair->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_repair->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_repair_grid->isGridEdit() && ($tbl_repair->RowType == ROWTYPE_EDIT || $tbl_repair->RowType == ROWTYPE_ADD) && $tbl_repair->EventCancelled) // Update failed
			$tbl_repair_grid->restoreCurrentRowFormValues($tbl_repair_grid->RowIndex); // Restore form values
		if ($tbl_repair->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_repair_grid->EditRowCount++;
		if ($tbl_repair->isConfirm()) // Confirm row
			$tbl_repair_grid->restoreCurrentRowFormValues($tbl_repair_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_repair->RowAttrs->merge(["data-rowindex" => $tbl_repair_grid->RowCount, "id" => "r" . $tbl_repair_grid->RowCount . "_tbl_repair", "data-rowtype" => $tbl_repair->RowType]);

		// Render row
		$tbl_repair_grid->renderRow();

		// Render list options
		$tbl_repair_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_repair_grid->RowAction != "delete" && $tbl_repair_grid->RowAction != "insertdelete" && !($tbl_repair_grid->RowAction == "insert" && $tbl_repair->isConfirm() && $tbl_repair_grid->emptyRow())) {
?>
	<tr <?php echo $tbl_repair->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_repair_grid->ListOptions->render("body", "left", $tbl_repair_grid->RowCount);
?>
	<?php if ($tbl_repair_grid->inventory_id->Visible) { // inventory_id ?>
		<td data-name="inventory_id" <?php echo $tbl_repair_grid->inventory_id->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($tbl_repair_grid->inventory_id->getSessionValue() != "") { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_id" class="form-group">
<span<?php echo $tbl_repair_grid->inventory_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_id" class="form-group">
<input type="text" data-table="tbl_repair" data-field="x_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->inventory_id->EditValue ?>"<?php echo $tbl_repair_grid->inventory_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_id" name="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($tbl_repair_grid->inventory_id->getSessionValue() != "") { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_id" class="form-group">
<span<?php echo $tbl_repair_grid->inventory_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_id" class="form-group">
<input type="text" data-table="tbl_repair" data-field="x_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->inventory_id->EditValue ?>"<?php echo $tbl_repair_grid->inventory_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_id">
<span<?php echo $tbl_repair_grid->inventory_id->viewAttributes() ?>><?php echo $tbl_repair_grid->inventory_id->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_id" name="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_id" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_id" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_repair" data-field="x_repair_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_repair_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_repair_id" value="<?php echo HtmlEncode($tbl_repair_grid->repair_id->CurrentValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_repair_id" name="o<?php echo $tbl_repair_grid->RowIndex ?>_repair_id" id="o<?php echo $tbl_repair_grid->RowIndex ?>_repair_id" value="<?php echo HtmlEncode($tbl_repair_grid->repair_id->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT || $tbl_repair->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_repair_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_repair_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_repair_id" value="<?php echo HtmlEncode($tbl_repair_grid->repair_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_repair_grid->inventory_idr->Visible) { // inventory_idr ?>
		<td data-name="inventory_idr" <?php echo $tbl_repair_grid->inventory_idr->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($tbl_repair_grid->inventory_idr->getSessionValue() != "") { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_idr" class="form-group">
<span<?php echo $tbl_repair_grid->inventory_idr->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_idr->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_idr" class="form-group">
<input type="text" data-table="tbl_repair" data-field="x_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" maxlength="11" placeholder="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->inventory_idr->EditValue ?>"<?php echo $tbl_repair_grid->inventory_idr->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_idr" name="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($tbl_repair_grid->inventory_idr->getSessionValue() != "") { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_idr" class="form-group">
<span<?php echo $tbl_repair_grid->inventory_idr->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_idr->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_idr" class="form-group">
<input type="text" data-table="tbl_repair" data-field="x_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" maxlength="11" placeholder="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->inventory_idr->EditValue ?>"<?php echo $tbl_repair_grid->inventory_idr->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_inventory_idr">
<span<?php echo $tbl_repair_grid->inventory_idr->viewAttributes() ?>><?php echo $tbl_repair_grid->inventory_idr->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_idr" name="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_idr" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_idr" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->date_repaired->Visible) { // date_repaired ?>
		<td data-name="date_repaired" <?php echo $tbl_repair_grid->date_repaired->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_date_repaired" class="form-group">
<input type="text" data-table="tbl_repair" data-field="x_date_repaired" name="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" placeholder="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->date_repaired->EditValue ?>"<?php echo $tbl_repair_grid->date_repaired->editAttributes() ?>>
<?php if (!$tbl_repair_grid->date_repaired->ReadOnly && !$tbl_repair_grid->date_repaired->Disabled && !isset($tbl_repair_grid->date_repaired->EditAttrs["readonly"]) && !isset($tbl_repair_grid->date_repaired->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_repairgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_repairgrid", "x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_date_repaired" name="o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" value="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_date_repaired" class="form-group">
<input type="text" data-table="tbl_repair" data-field="x_date_repaired" name="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" placeholder="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->date_repaired->EditValue ?>"<?php echo $tbl_repair_grid->date_repaired->editAttributes() ?>>
<?php if (!$tbl_repair_grid->date_repaired->ReadOnly && !$tbl_repair_grid->date_repaired->Disabled && !isset($tbl_repair_grid->date_repaired->EditAttrs["readonly"]) && !isset($tbl_repair_grid->date_repaired->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_repairgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_repairgrid", "x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_date_repaired">
<span<?php echo $tbl_repair_grid->date_repaired->viewAttributes() ?>><?php echo $tbl_repair_grid->date_repaired->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_date_repaired" name="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" value="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_date_repaired" name="o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" value="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_date_repaired" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" value="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_date_repaired" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" value="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->type_problem->Visible) { // type_problem ?>
		<td data-name="type_problem" <?php echo $tbl_repair_grid->type_problem->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_type_problem" class="form-group">
<textarea data-table="tbl_repair" data-field="x_type_problem" name="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->type_problem->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->type_problem->editAttributes() ?>><?php echo $tbl_repair_grid->type_problem->EditValue ?></textarea>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_type_problem" name="o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" value="<?php echo HtmlEncode($tbl_repair_grid->type_problem->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_type_problem" class="form-group">
<textarea data-table="tbl_repair" data-field="x_type_problem" name="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->type_problem->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->type_problem->editAttributes() ?>><?php echo $tbl_repair_grid->type_problem->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_type_problem">
<span<?php echo $tbl_repair_grid->type_problem->viewAttributes() ?>><?php echo $tbl_repair_grid->type_problem->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_type_problem" name="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" value="<?php echo HtmlEncode($tbl_repair_grid->type_problem->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_type_problem" name="o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" value="<?php echo HtmlEncode($tbl_repair_grid->type_problem->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_type_problem" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" value="<?php echo HtmlEncode($tbl_repair_grid->type_problem->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_type_problem" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" value="<?php echo HtmlEncode($tbl_repair_grid->type_problem->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->action_taken->Visible) { // action_taken ?>
		<td data-name="action_taken" <?php echo $tbl_repair_grid->action_taken->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_action_taken" class="form-group">
<textarea data-table="tbl_repair" data-field="x_action_taken" name="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->action_taken->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->action_taken->editAttributes() ?>><?php echo $tbl_repair_grid->action_taken->EditValue ?></textarea>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_action_taken" name="o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" value="<?php echo HtmlEncode($tbl_repair_grid->action_taken->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_action_taken" class="form-group">
<textarea data-table="tbl_repair" data-field="x_action_taken" name="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->action_taken->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->action_taken->editAttributes() ?>><?php echo $tbl_repair_grid->action_taken->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_action_taken">
<span<?php echo $tbl_repair_grid->action_taken->viewAttributes() ?>><?php echo $tbl_repair_grid->action_taken->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_action_taken" name="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" value="<?php echo HtmlEncode($tbl_repair_grid->action_taken->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_action_taken" name="o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" value="<?php echo HtmlEncode($tbl_repair_grid->action_taken->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_action_taken" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" value="<?php echo HtmlEncode($tbl_repair_grid->action_taken->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_action_taken" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" value="<?php echo HtmlEncode($tbl_repair_grid->action_taken->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->employee_id->Visible) { // employee_id ?>
		<td data-name="employee_id" <?php echo $tbl_repair_grid->employee_id->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_employee_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_employee_id" data-value-separator="<?php echo $tbl_repair_grid->employee_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id"<?php echo $tbl_repair_grid->employee_id->editAttributes() ?>>
			<?php echo $tbl_repair_grid->employee_id->selectOptionListHtml("x{$tbl_repair_grid->RowIndex}_employee_id") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_employee_id" name="o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" id="o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" value="<?php echo HtmlEncode($tbl_repair_grid->employee_id->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_employee_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_employee_id" data-value-separator="<?php echo $tbl_repair_grid->employee_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id"<?php echo $tbl_repair_grid->employee_id->editAttributes() ?>>
			<?php echo $tbl_repair_grid->employee_id->selectOptionListHtml("x{$tbl_repair_grid->RowIndex}_employee_id") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_employee_id">
<span<?php echo $tbl_repair_grid->employee_id->viewAttributes() ?>><?php echo $tbl_repair_grid->employee_id->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_employee_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" value="<?php echo HtmlEncode($tbl_repair_grid->employee_id->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_employee_id" name="o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" id="o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" value="<?php echo HtmlEncode($tbl_repair_grid->employee_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_employee_id" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" value="<?php echo HtmlEncode($tbl_repair_grid->employee_id->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_employee_id" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" value="<?php echo HtmlEncode($tbl_repair_grid->employee_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->status_h->Visible) { // status_h ?>
		<td data-name="status_h" <?php echo $tbl_repair_grid->status_h->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_status_h" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_status_h" data-value-separator="<?php echo $tbl_repair_grid->status_h->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" name="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h"<?php echo $tbl_repair_grid->status_h->editAttributes() ?>>
			<?php echo $tbl_repair_grid->status_h->selectOptionListHtml("x{$tbl_repair_grid->RowIndex}_status_h") ?>
		</select>
</div>
<?php echo $tbl_repair_grid->status_h->Lookup->getParamTag($tbl_repair_grid, "p_x" . $tbl_repair_grid->RowIndex . "_status_h") ?>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_status_h" name="o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" id="o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" value="<?php echo HtmlEncode($tbl_repair_grid->status_h->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_status_h" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_status_h" data-value-separator="<?php echo $tbl_repair_grid->status_h->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" name="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h"<?php echo $tbl_repair_grid->status_h->editAttributes() ?>>
			<?php echo $tbl_repair_grid->status_h->selectOptionListHtml("x{$tbl_repair_grid->RowIndex}_status_h") ?>
		</select>
</div>
<?php echo $tbl_repair_grid->status_h->Lookup->getParamTag($tbl_repair_grid, "p_x" . $tbl_repair_grid->RowIndex . "_status_h") ?>
</span>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_status_h">
<span<?php echo $tbl_repair_grid->status_h->viewAttributes() ?>><?php echo $tbl_repair_grid->status_h->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_status_h" name="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" id="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" value="<?php echo HtmlEncode($tbl_repair_grid->status_h->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_status_h" name="o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" id="o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" value="<?php echo HtmlEncode($tbl_repair_grid->status_h->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_status_h" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" value="<?php echo HtmlEncode($tbl_repair_grid->status_h->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_status_h" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" value="<?php echo HtmlEncode($tbl_repair_grid->status_h->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->remark->Visible) { // remark ?>
		<td data-name="remark" <?php echo $tbl_repair_grid->remark->cellAttributes() ?>>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_remark" class="form-group">
<textarea data-table="tbl_repair" data-field="x_remark" name="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->remark->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->remark->editAttributes() ?>><?php echo $tbl_repair_grid->remark->EditValue ?></textarea>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_remark" name="o<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="o<?php echo $tbl_repair_grid->RowIndex ?>_remark" value="<?php echo HtmlEncode($tbl_repair_grid->remark->OldValue) ?>">
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_remark" class="form-group">
<textarea data-table="tbl_repair" data-field="x_remark" name="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->remark->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->remark->editAttributes() ?>><?php echo $tbl_repair_grid->remark->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($tbl_repair->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_repair_grid->RowCount ?>_tbl_repair_remark">
<span<?php echo $tbl_repair_grid->remark->viewAttributes() ?>><?php echo $tbl_repair_grid->remark->getViewValue() ?></span>
</span>
<?php if (!$tbl_repair->isConfirm()) { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_remark" name="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" value="<?php echo HtmlEncode($tbl_repair_grid->remark->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_remark" name="o<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="o<?php echo $tbl_repair_grid->RowIndex ?>_remark" value="<?php echo HtmlEncode($tbl_repair_grid->remark->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_repair" data-field="x_remark" name="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="ftbl_repairgrid$x<?php echo $tbl_repair_grid->RowIndex ?>_remark" value="<?php echo HtmlEncode($tbl_repair_grid->remark->FormValue) ?>">
<input type="hidden" data-table="tbl_repair" data-field="x_remark" name="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="ftbl_repairgrid$o<?php echo $tbl_repair_grid->RowIndex ?>_remark" value="<?php echo HtmlEncode($tbl_repair_grid->remark->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_repair_grid->ListOptions->render("body", "right", $tbl_repair_grid->RowCount);
?>
	</tr>
<?php if ($tbl_repair->RowType == ROWTYPE_ADD || $tbl_repair->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ftbl_repairgrid", "load"], function() {
	ftbl_repairgrid.updateLists(<?php echo $tbl_repair_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_repair_grid->isGridAdd() || $tbl_repair->CurrentMode == "copy")
		if (!$tbl_repair_grid->Recordset->EOF)
			$tbl_repair_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_repair->CurrentMode == "add" || $tbl_repair->CurrentMode == "copy" || $tbl_repair->CurrentMode == "edit") {
		$tbl_repair_grid->RowIndex = '$rowindex$';
		$tbl_repair_grid->loadRowValues();

		// Set row properties
		$tbl_repair->resetAttributes();
		$tbl_repair->RowAttrs->merge(["data-rowindex" => $tbl_repair_grid->RowIndex, "id" => "r0_tbl_repair", "data-rowtype" => ROWTYPE_ADD]);
		$tbl_repair->RowAttrs->appendClass("ew-template");
		$tbl_repair->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_repair_grid->renderRow();

		// Render list options
		$tbl_repair_grid->renderListOptions();
		$tbl_repair_grid->StartRowCount = 0;
?>
	<tr <?php echo $tbl_repair->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_repair_grid->ListOptions->render("body", "left", $tbl_repair_grid->RowIndex);
?>
	<?php if ($tbl_repair_grid->inventory_id->Visible) { // inventory_id ?>
		<td data-name="inventory_id">
<?php if (!$tbl_repair->isConfirm()) { ?>
<?php if ($tbl_repair_grid->inventory_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_tbl_repair_inventory_id" class="form-group tbl_repair_inventory_id">
<span<?php echo $tbl_repair_grid->inventory_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_inventory_id" class="form-group tbl_repair_inventory_id">
<input type="text" data-table="tbl_repair" data-field="x_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->inventory_id->EditValue ?>"<?php echo $tbl_repair_grid->inventory_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_inventory_id" class="form-group tbl_repair_inventory_id">
<span<?php echo $tbl_repair_grid->inventory_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_id" name="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" id="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_id" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->inventory_idr->Visible) { // inventory_idr ?>
		<td data-name="inventory_idr">
<?php if (!$tbl_repair->isConfirm()) { ?>
<?php if ($tbl_repair_grid->inventory_idr->getSessionValue() != "") { ?>
<span id="el$rowindex$_tbl_repair_inventory_idr" class="form-group tbl_repair_inventory_idr">
<span<?php echo $tbl_repair_grid->inventory_idr->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_idr->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_inventory_idr" class="form-group tbl_repair_inventory_idr">
<input type="text" data-table="tbl_repair" data-field="x_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" maxlength="11" placeholder="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->inventory_idr->EditValue ?>"<?php echo $tbl_repair_grid->inventory_idr->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_inventory_idr" class="form-group tbl_repair_inventory_idr">
<span<?php echo $tbl_repair_grid->inventory_idr->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->inventory_idr->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_idr" name="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="x<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_inventory_idr" name="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" id="o<?php echo $tbl_repair_grid->RowIndex ?>_inventory_idr" value="<?php echo HtmlEncode($tbl_repair_grid->inventory_idr->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->date_repaired->Visible) { // date_repaired ?>
		<td data-name="date_repaired">
<?php if (!$tbl_repair->isConfirm()) { ?>
<span id="el$rowindex$_tbl_repair_date_repaired" class="form-group tbl_repair_date_repaired">
<input type="text" data-table="tbl_repair" data-field="x_date_repaired" name="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" placeholder="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->getPlaceHolder()) ?>" value="<?php echo $tbl_repair_grid->date_repaired->EditValue ?>"<?php echo $tbl_repair_grid->date_repaired->editAttributes() ?>>
<?php if (!$tbl_repair_grid->date_repaired->ReadOnly && !$tbl_repair_grid->date_repaired->Disabled && !isset($tbl_repair_grid->date_repaired->EditAttrs["readonly"]) && !isset($tbl_repair_grid->date_repaired->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftbl_repairgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("ftbl_repairgrid", "x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_date_repaired" class="form-group tbl_repair_date_repaired">
<span<?php echo $tbl_repair_grid->date_repaired->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->date_repaired->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_date_repaired" name="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="x<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" value="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_date_repaired" name="o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" id="o<?php echo $tbl_repair_grid->RowIndex ?>_date_repaired" value="<?php echo HtmlEncode($tbl_repair_grid->date_repaired->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->type_problem->Visible) { // type_problem ?>
		<td data-name="type_problem">
<?php if (!$tbl_repair->isConfirm()) { ?>
<span id="el$rowindex$_tbl_repair_type_problem" class="form-group tbl_repair_type_problem">
<textarea data-table="tbl_repair" data-field="x_type_problem" name="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->type_problem->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->type_problem->editAttributes() ?>><?php echo $tbl_repair_grid->type_problem->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_type_problem" class="form-group tbl_repair_type_problem">
<span<?php echo $tbl_repair_grid->type_problem->viewAttributes() ?>><?php echo $tbl_repair_grid->type_problem->ViewValue ?></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_type_problem" name="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="x<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" value="<?php echo HtmlEncode($tbl_repair_grid->type_problem->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_type_problem" name="o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" id="o<?php echo $tbl_repair_grid->RowIndex ?>_type_problem" value="<?php echo HtmlEncode($tbl_repair_grid->type_problem->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->action_taken->Visible) { // action_taken ?>
		<td data-name="action_taken">
<?php if (!$tbl_repair->isConfirm()) { ?>
<span id="el$rowindex$_tbl_repair_action_taken" class="form-group tbl_repair_action_taken">
<textarea data-table="tbl_repair" data-field="x_action_taken" name="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->action_taken->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->action_taken->editAttributes() ?>><?php echo $tbl_repair_grid->action_taken->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_action_taken" class="form-group tbl_repair_action_taken">
<span<?php echo $tbl_repair_grid->action_taken->viewAttributes() ?>><?php echo $tbl_repair_grid->action_taken->ViewValue ?></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_action_taken" name="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="x<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" value="<?php echo HtmlEncode($tbl_repair_grid->action_taken->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_action_taken" name="o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" id="o<?php echo $tbl_repair_grid->RowIndex ?>_action_taken" value="<?php echo HtmlEncode($tbl_repair_grid->action_taken->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->employee_id->Visible) { // employee_id ?>
		<td data-name="employee_id">
<?php if (!$tbl_repair->isConfirm()) { ?>
<span id="el$rowindex$_tbl_repair_employee_id" class="form-group tbl_repair_employee_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_employee_id" data-value-separator="<?php echo $tbl_repair_grid->employee_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id"<?php echo $tbl_repair_grid->employee_id->editAttributes() ?>>
			<?php echo $tbl_repair_grid->employee_id->selectOptionListHtml("x{$tbl_repair_grid->RowIndex}_employee_id") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_employee_id" class="form-group tbl_repair_employee_id">
<span<?php echo $tbl_repair_grid->employee_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->employee_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_employee_id" name="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" id="x<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" value="<?php echo HtmlEncode($tbl_repair_grid->employee_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_employee_id" name="o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" id="o<?php echo $tbl_repair_grid->RowIndex ?>_employee_id" value="<?php echo HtmlEncode($tbl_repair_grid->employee_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->status_h->Visible) { // status_h ?>
		<td data-name="status_h">
<?php if (!$tbl_repair->isConfirm()) { ?>
<span id="el$rowindex$_tbl_repair_status_h" class="form-group tbl_repair_status_h">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_repair" data-field="x_status_h" data-value-separator="<?php echo $tbl_repair_grid->status_h->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" name="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h"<?php echo $tbl_repair_grid->status_h->editAttributes() ?>>
			<?php echo $tbl_repair_grid->status_h->selectOptionListHtml("x{$tbl_repair_grid->RowIndex}_status_h") ?>
		</select>
</div>
<?php echo $tbl_repair_grid->status_h->Lookup->getParamTag($tbl_repair_grid, "p_x" . $tbl_repair_grid->RowIndex . "_status_h") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_status_h" class="form-group tbl_repair_status_h">
<span<?php echo $tbl_repair_grid->status_h->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tbl_repair_grid->status_h->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_status_h" name="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" id="x<?php echo $tbl_repair_grid->RowIndex ?>_status_h" value="<?php echo HtmlEncode($tbl_repair_grid->status_h->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_status_h" name="o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" id="o<?php echo $tbl_repair_grid->RowIndex ?>_status_h" value="<?php echo HtmlEncode($tbl_repair_grid->status_h->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_repair_grid->remark->Visible) { // remark ?>
		<td data-name="remark">
<?php if (!$tbl_repair->isConfirm()) { ?>
<span id="el$rowindex$_tbl_repair_remark" class="form-group tbl_repair_remark">
<textarea data-table="tbl_repair" data-field="x_remark" name="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" cols="35" rows="3" placeholder="<?php echo HtmlEncode($tbl_repair_grid->remark->getPlaceHolder()) ?>"<?php echo $tbl_repair_grid->remark->editAttributes() ?>><?php echo $tbl_repair_grid->remark->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_repair_remark" class="form-group tbl_repair_remark">
<span<?php echo $tbl_repair_grid->remark->viewAttributes() ?>><?php echo $tbl_repair_grid->remark->ViewValue ?></span>
</span>
<input type="hidden" data-table="tbl_repair" data-field="x_remark" name="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="x<?php echo $tbl_repair_grid->RowIndex ?>_remark" value="<?php echo HtmlEncode($tbl_repair_grid->remark->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_repair" data-field="x_remark" name="o<?php echo $tbl_repair_grid->RowIndex ?>_remark" id="o<?php echo $tbl_repair_grid->RowIndex ?>_remark" value="<?php echo HtmlEncode($tbl_repair_grid->remark->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_repair_grid->ListOptions->render("body", "right", $tbl_repair_grid->RowIndex);
?>
<script>
loadjs.ready(["ftbl_repairgrid", "load"], function() {
	ftbl_repairgrid.updateLists(<?php echo $tbl_repair_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($tbl_repair->CurrentMode == "add" || $tbl_repair->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_repair_grid->FormKeyCountName ?>" id="<?php echo $tbl_repair_grid->FormKeyCountName ?>" value="<?php echo $tbl_repair_grid->KeyCount ?>">
<?php echo $tbl_repair_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_repair->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_repair_grid->FormKeyCountName ?>" id="<?php echo $tbl_repair_grid->FormKeyCountName ?>" value="<?php echo $tbl_repair_grid->KeyCount ?>">
<?php echo $tbl_repair_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_repair->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_repairgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_repair_grid->Recordset)
	$tbl_repair_grid->Recordset->Close();
?>
<?php if ($tbl_repair_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_repair_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_repair_grid->TotalRecords == 0 && !$tbl_repair->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_repair_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$tbl_repair_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$tbl_repair_grid->terminate();
?>