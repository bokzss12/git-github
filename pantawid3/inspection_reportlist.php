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
$inspection_report_list = new inspection_report_list();

// Run the page
$inspection_report_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inspection_report_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$inspection_report_list->isExport()) { ?>
<script>
var finspection_reportlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	finspection_reportlist = currentForm = new ew.Form("finspection_reportlist", "list");
	finspection_reportlist.formKeyCountName = '<?php echo $inspection_report_list->FormKeyCountName ?>';
	loadjs.done("finspection_reportlist");
});
var finspection_reportlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	finspection_reportlistsrch = currentSearchForm = new ew.Form("finspection_reportlistsrch");

	// Dynamic selection lists
	// Filters

	finspection_reportlistsrch.filterList = <?php echo $inspection_report_list->getFilterList() ?>;
	loadjs.done("finspection_reportlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$inspection_report_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inspection_report_list->TotalRecords > 0 && $inspection_report_list->ExportOptions->visible()) { ?>
<?php $inspection_report_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inspection_report_list->ImportOptions->visible()) { ?>
<?php $inspection_report_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inspection_report_list->SearchOptions->visible()) { ?>
<?php $inspection_report_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inspection_report_list->FilterOptions->visible()) { ?>
<?php $inspection_report_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inspection_report_list->renderOtherOptions();
?>
<?php $inspection_report_list->showPageHeader(); ?>
<?php
$inspection_report_list->showMessage();
?>
<?php if ($inspection_report_list->TotalRecords > 0 || $inspection_report->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inspection_report_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inspection_report">
<form name="finspection_reportlist" id="finspection_reportlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inspection_report">
<div id="gmp_inspection_report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($inspection_report_list->TotalRecords > 0 || $inspection_report_list->isGridEdit()) { ?>
<table id="tbl_inspection_reportlist" class="table ew-table d-none"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inspection_report->RowType = ROWTYPE_HEADER;

// Render list options
$inspection_report_list->renderListOptions();

// Render list options (header, left)
$inspection_report_list->ListOptions->render("header", "left", "", "block", $inspection_report->TableVar, "inspection_reportlist");
?>
<?php if ($inspection_report_list->SRN->Visible) { // SRN ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->SRN) == "") { ?>
		<th data-name="SRN" class="<?php echo $inspection_report_list->SRN->headerCellClass() ?>"><div id="elh_inspection_report_SRN" class="inspection_report_SRN"><div class="ew-table-header-caption"><script id="tpc_inspection_report_SRN" type="text/html"><?php echo $inspection_report_list->SRN->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="SRN" class="<?php echo $inspection_report_list->SRN->headerCellClass() ?>"><script id="tpc_inspection_report_SRN" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->SRN) ?>', 1);"><div id="elh_inspection_report_SRN" class="inspection_report_SRN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->SRN->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->SRN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->SRN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->item_date_repaired->Visible) { // item_date_repaired ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->item_date_repaired) == "") { ?>
		<th data-name="item_date_repaired" class="<?php echo $inspection_report_list->item_date_repaired->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_item_date_repaired" class="inspection_report_item_date_repaired"><div class="ew-table-header-caption"><script id="tpc_inspection_report_item_date_repaired" type="text/html"><?php echo $inspection_report_list->item_date_repaired->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_repaired" class="<?php echo $inspection_report_list->item_date_repaired->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_item_date_repaired" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->item_date_repaired) ?>', 1);"><div id="elh_inspection_report_item_date_repaired" class="inspection_report_item_date_repaired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->item_date_repaired->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->item_date_repaired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->item_date_repaired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->item_model->Visible) { // item_model ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $inspection_report_list->item_model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_item_model" class="inspection_report_item_model"><div class="ew-table-header-caption"><script id="tpc_inspection_report_item_model" type="text/html"><?php echo $inspection_report_list->item_model->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $inspection_report_list->item_model->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_item_model" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->item_model) ?>', 1);"><div id="elh_inspection_report_item_model" class="inspection_report_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->item_model->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->item_serno->Visible) { // item_serno ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->item_serno) == "") { ?>
		<th data-name="item_serno" class="<?php echo $inspection_report_list->item_serno->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_item_serno" class="inspection_report_item_serno"><div class="ew-table-header-caption"><script id="tpc_inspection_report_item_serno" type="text/html"><?php echo $inspection_report_list->item_serno->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_serno" class="<?php echo $inspection_report_list->item_serno->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_item_serno" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->item_serno) ?>', 1);"><div id="elh_inspection_report_item_serno" class="inspection_report_item_serno">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->item_serno->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->item_serno->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->item_serno->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->Current_loc->Visible) { // Current_loc ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->Current_loc) == "") { ?>
		<th data-name="Current_loc" class="<?php echo $inspection_report_list->Current_loc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_Current_loc" class="inspection_report_Current_loc"><div class="ew-table-header-caption"><script id="tpc_inspection_report_Current_loc" type="text/html"><?php echo $inspection_report_list->Current_loc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Current_loc" class="<?php echo $inspection_report_list->Current_loc->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_Current_loc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->Current_loc) ?>', 1);"><div id="elh_inspection_report_Current_loc" class="inspection_report_Current_loc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->Current_loc->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->Current_loc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->Current_loc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->item_transmittal->Visible) { // item_transmittal ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->item_transmittal) == "") { ?>
		<th data-name="item_transmittal" class="<?php echo $inspection_report_list->item_transmittal->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_item_transmittal" class="inspection_report_item_transmittal"><div class="ew-table-header-caption"><script id="tpc_inspection_report_item_transmittal" type="text/html"><?php echo $inspection_report_list->item_transmittal->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_transmittal" class="<?php echo $inspection_report_list->item_transmittal->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_item_transmittal" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->item_transmittal) ?>', 1);"><div id="elh_inspection_report_item_transmittal" class="inspection_report_item_transmittal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->item_transmittal->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->item_transmittal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->item_transmittal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->position->Visible) { // position ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->position) == "") { ?>
		<th data-name="position" class="<?php echo $inspection_report_list->position->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_position" class="inspection_report_position"><div class="ew-table-header-caption"><script id="tpc_inspection_report_position" type="text/html"><?php echo $inspection_report_list->position->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="position" class="<?php echo $inspection_report_list->position->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_position" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->position) ?>', 1);"><div id="elh_inspection_report_position" class="inspection_report_position">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->position->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->item_type_problem->Visible) { // item_type_problem ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->item_type_problem) == "") { ?>
		<th data-name="item_type_problem" class="<?php echo $inspection_report_list->item_type_problem->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_item_type_problem" class="inspection_report_item_type_problem"><div class="ew-table-header-caption"><script id="tpc_inspection_report_item_type_problem" type="text/html"><?php echo $inspection_report_list->item_type_problem->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_type_problem" class="<?php echo $inspection_report_list->item_type_problem->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_item_type_problem" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->item_type_problem) ?>', 1);"><div id="elh_inspection_report_item_type_problem" class="inspection_report_item_type_problem">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->item_type_problem->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->item_type_problem->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->item_type_problem->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->item_action_taken->Visible) { // item_action_taken ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->item_action_taken) == "") { ?>
		<th data-name="item_action_taken" class="<?php echo $inspection_report_list->item_action_taken->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_item_action_taken" class="inspection_report_item_action_taken"><div class="ew-table-header-caption"><script id="tpc_inspection_report_item_action_taken" type="text/html"><?php echo $inspection_report_list->item_action_taken->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_action_taken" class="<?php echo $inspection_report_list->item_action_taken->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_item_action_taken" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->item_action_taken) ?>', 1);"><div id="elh_inspection_report_item_action_taken" class="inspection_report_item_action_taken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->item_action_taken->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->item_action_taken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->item_action_taken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->remarks->Visible) { // remarks ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->remarks) == "") { ?>
		<th data-name="remarks" class="<?php echo $inspection_report_list->remarks->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><div id="elh_inspection_report_remarks" class="inspection_report_remarks"><div class="ew-table-header-caption"><script id="tpc_inspection_report_remarks" type="text/html"><?php echo $inspection_report_list->remarks->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="remarks" class="<?php echo $inspection_report_list->remarks->headerCellClass() ?>" style="width: 0px; white-space: nowrap;"><script id="tpc_inspection_report_remarks" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->remarks) ?>', 1);"><div id="elh_inspection_report_remarks" class="inspection_report_remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->__Request->Visible) { // Request ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->__Request) == "") { ?>
		<th data-name="__Request" class="<?php echo $inspection_report_list->__Request->headerCellClass() ?>"><div id="elh_inspection_report___Request" class="inspection_report___Request"><div class="ew-table-header-caption"><script id="tpc_inspection_report___Request" type="text/html"><?php echo $inspection_report_list->__Request->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="__Request" class="<?php echo $inspection_report_list->__Request->headerCellClass() ?>"><script id="tpc_inspection_report___Request" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->__Request) ?>', 1);"><div id="elh_inspection_report___Request" class="inspection_report___Request">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->__Request->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->__Request->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->__Request->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->employeeid->Visible) { // employeeid ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $inspection_report_list->employeeid->headerCellClass() ?>"><div id="elh_inspection_report_employeeid" class="inspection_report_employeeid"><div class="ew-table-header-caption"><script id="tpc_inspection_report_employeeid" type="text/html"><?php echo $inspection_report_list->employeeid->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $inspection_report_list->employeeid->headerCellClass() ?>"><script id="tpc_inspection_report_employeeid" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->employeeid) ?>', 1);"><div id="elh_inspection_report_employeeid" class="inspection_report_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($inspection_report_list->status_id->Visible) { // status_id ?>
	<?php if ($inspection_report_list->SortUrl($inspection_report_list->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $inspection_report_list->status_id->headerCellClass() ?>"><div id="elh_inspection_report_status_id" class="inspection_report_status_id"><div class="ew-table-header-caption"><script id="tpc_inspection_report_status_id" type="text/html"><?php echo $inspection_report_list->status_id->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $inspection_report_list->status_id->headerCellClass() ?>"><script id="tpc_inspection_report_status_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $inspection_report_list->SortUrl($inspection_report_list->status_id) ?>', 1);"><div id="elh_inspection_report_status_id" class="inspection_report_status_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inspection_report_list->status_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($inspection_report_list->status_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($inspection_report_list->status_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inspection_report_list->ListOptions->render("header", "right", "", "block", $inspection_report->TableVar, "inspection_reportlist");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inspection_report_list->ExportAll && $inspection_report_list->isExport()) {
	$inspection_report_list->StopRecord = $inspection_report_list->TotalRecords;
} else {

	// Set the last record to display
	if ($inspection_report_list->TotalRecords > $inspection_report_list->StartRecord + $inspection_report_list->DisplayRecords - 1)
		$inspection_report_list->StopRecord = $inspection_report_list->StartRecord + $inspection_report_list->DisplayRecords - 1;
	else
		$inspection_report_list->StopRecord = $inspection_report_list->TotalRecords;
}
$inspection_report_list->RecordCount = $inspection_report_list->StartRecord - 1;
if ($inspection_report_list->Recordset && !$inspection_report_list->Recordset->EOF) {
	$inspection_report_list->Recordset->moveFirst();
	$selectLimit = $inspection_report_list->UseSelectLimit;
	if (!$selectLimit && $inspection_report_list->StartRecord > 1)
		$inspection_report_list->Recordset->move($inspection_report_list->StartRecord - 1);
} elseif (!$inspection_report->AllowAddDeleteRow && $inspection_report_list->StopRecord == 0) {
	$inspection_report_list->StopRecord = $inspection_report->GridAddRowCount;
}

// Initialize aggregate
$inspection_report->RowType = ROWTYPE_AGGREGATEINIT;
$inspection_report->resetAttributes();
$inspection_report_list->renderRow();
while ($inspection_report_list->RecordCount < $inspection_report_list->StopRecord) {
	$inspection_report_list->RecordCount++;
	if ($inspection_report_list->RecordCount >= $inspection_report_list->StartRecord) {
		$inspection_report_list->RowCount++;

		// Set up key count
		$inspection_report_list->KeyCount = $inspection_report_list->RowIndex;

		// Init row class and style
		$inspection_report->resetAttributes();
		$inspection_report->CssClass = "";
		if ($inspection_report_list->isGridAdd()) {
		} else {
			$inspection_report_list->loadRowValues($inspection_report_list->Recordset); // Load row values
		}
		$inspection_report->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inspection_report->RowAttrs->merge(["data-rowindex" => $inspection_report_list->RowCount, "id" => "r" . $inspection_report_list->RowCount . "_inspection_report", "data-rowtype" => $inspection_report->RowType]);

		// Render row
		$inspection_report_list->renderRow();

		// Render list options
		$inspection_report_list->renderListOptions();

		// Save row and cell attributes
		$inspection_report_list->Attrs[$inspection_report_list->RowCount] = ["row_attrs" => $inspection_report->rowAttributes(), "cell_attrs" => []];
		$inspection_report_list->Attrs[$inspection_report_list->RowCount]["cell_attrs"] = $inspection_report->fieldCellAttributes();
?>
	<tr <?php echo $inspection_report->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inspection_report_list->ListOptions->render("body", "left", $inspection_report_list->RowCount, "block", $inspection_report->TableVar, "inspection_reportlist");
?>
	<?php if ($inspection_report_list->SRN->Visible) { // SRN ?>
		<td data-name="SRN" <?php echo $inspection_report_list->SRN->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_SRN" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_SRN">
<span<?php echo $inspection_report_list->SRN->viewAttributes() ?>><?php echo $inspection_report_list->SRN->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->item_date_repaired->Visible) { // item_date_repaired ?>
		<td data-name="item_date_repaired" <?php echo $inspection_report_list->item_date_repaired->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_date_repaired" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_date_repaired">
<span<?php echo $inspection_report_list->item_date_repaired->viewAttributes() ?>><?php echo $inspection_report_list->item_date_repaired->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $inspection_report_list->item_model->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_model" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_model">
<span<?php echo $inspection_report_list->item_model->viewAttributes() ?>><?php echo $inspection_report_list->item_model->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->item_serno->Visible) { // item_serno ?>
		<td data-name="item_serno" <?php echo $inspection_report_list->item_serno->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_serno" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_serno">
<span<?php echo $inspection_report_list->item_serno->viewAttributes() ?>><?php echo $inspection_report_list->item_serno->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->Current_loc->Visible) { // Current_loc ?>
		<td data-name="Current_loc" <?php echo $inspection_report_list->Current_loc->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_Current_loc" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_Current_loc">
<span<?php echo $inspection_report_list->Current_loc->viewAttributes() ?>><?php echo $inspection_report_list->Current_loc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->item_transmittal->Visible) { // item_transmittal ?>
		<td data-name="item_transmittal" <?php echo $inspection_report_list->item_transmittal->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_transmittal" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_transmittal">
<span<?php echo $inspection_report_list->item_transmittal->viewAttributes() ?>><?php echo $inspection_report_list->item_transmittal->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->position->Visible) { // position ?>
		<td data-name="position" <?php echo $inspection_report_list->position->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_position" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_position">
<span<?php echo $inspection_report_list->position->viewAttributes() ?>><?php echo $inspection_report_list->position->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->item_type_problem->Visible) { // item_type_problem ?>
		<td data-name="item_type_problem" <?php echo $inspection_report_list->item_type_problem->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_type_problem" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_type_problem">
<span<?php echo $inspection_report_list->item_type_problem->viewAttributes() ?>><?php echo $inspection_report_list->item_type_problem->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->item_action_taken->Visible) { // item_action_taken ?>
		<td data-name="item_action_taken" <?php echo $inspection_report_list->item_action_taken->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_action_taken" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_item_action_taken">
<span<?php echo $inspection_report_list->item_action_taken->viewAttributes() ?>><?php echo $inspection_report_list->item_action_taken->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->remarks->Visible) { // remarks ?>
		<td data-name="remarks" <?php echo $inspection_report_list->remarks->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_remarks" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_remarks">
<span<?php echo $inspection_report_list->remarks->viewAttributes() ?>><?php echo $inspection_report_list->remarks->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->__Request->Visible) { // Request ?>
		<td data-name="__Request" <?php echo $inspection_report_list->__Request->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report___Request" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report___Request">
<span<?php echo $inspection_report_list->__Request->viewAttributes() ?>><?php echo $inspection_report_list->__Request->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $inspection_report_list->employeeid->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_employeeid" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_employeeid">
<span<?php echo $inspection_report_list->employeeid->viewAttributes() ?>><?php echo $inspection_report_list->employeeid->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($inspection_report_list->status_id->Visible) { // status_id ?>
		<td data-name="status_id" <?php echo $inspection_report_list->status_id->cellAttributes() ?>>
<script id="tpx<?php echo $inspection_report_list->RowCount ?>_inspection_report_status_id" type="text/html"><span id="el<?php echo $inspection_report_list->RowCount ?>_inspection_report_status_id">
<span<?php echo $inspection_report_list->status_id->viewAttributes() ?>><?php echo $inspection_report_list->status_id->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inspection_report_list->ListOptions->render("body", "right", $inspection_report_list->RowCount, "block", $inspection_report->TableVar, "inspection_reportlist");
?>
	</tr>
<?php
	}
	if (!$inspection_report_list->isGridAdd())
		$inspection_report_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$inspection_report->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<div id="tpd_inspection_reportlist" class="ew-custom-template"></div>
<script id="tpm_inspection_reportlist" type="text/html">
<div id="ct_inspection_report_list"><?php if ($inspection_report_list->RowCount > 0) { ?>
<div class="header">
  <img src="phpimages/dswd.png" alt="logo" />
  <h1></h1>
</div>
<p align="right"><font size="4"><?php echo date("F j, Y"); ?>&nbsp;&nbsp;&nbsp;</p>
<center><font size="4">Department of Social Welfare and Development</center>
<center><font size="4">Field Office VI</center>
<center><font size="4">Pantawid Pamilyang Pilipino Program</center>
<center><b><font size="4">Service Report</font></b></center>
<br>
<?php for ($i = $inspection_report_list->StartRowCount; $i <= $inspection_report_list->RowCount; $i++) { ?>
<table style="height: 1056px; width: 1034px; float: left;" border="4" cellspacing="5" cellpadding="5">
<tbody>
<tr style="height: 5px;">
<td style="width: 271.017px; height: 5px; vertical-align: bottom;" scope="col"><strong>Office:</strong></td>
<td style="width: 422.317px; height: 5px; vertical-align: bottom;" colspan="6" scope="col"><strong>Name of Service Support Staff:</strong></td>
<td style="width: 277.267px; height: 5px; text-align: left;" colspan="6" scope="col"><strong>Date:</strong></td>
</tr>
<tr style="height: 31px;">
<td style="width: 271.017px; height: 31px;" scope="col">RPMO</td>
<td style="width: 422.317px; height: 31px; text-align: left;" colspan="6" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_employeeid")/}}&nbsp;</td>
<td style="width: 277.267px; height: 31px; text-align: left;" colspan="6" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_item_date_repaired")/}}&nbsp;</td>
</tr>
<tr style="height: 10px;">
<td style="width: 271.017px; height: 10px; text-align: left; vertical-align: bottom;" scope="col"><strong>Account Name:</strong></td>
<td style="width: 716.817px; height: 10px; text-align: left; vertical-align: bottom;" colspan="12" scope="col"><strong>Office Location:</strong></td>
</tr>
<tr style="height: 26px;">
<td style="width: 271.017px; height: 26px;" scope="col">DSWD FO-VI</td>
<td style="width: 716.817px; height: 26px;" colspan="12" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_Current_loc")/}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 7px;">
<td style="width: 271.017px; height: 7px; text-align: left;" scope="col"><strong>Model No./Type:</strong></td>
<td style="width: 716.817px; height: 7px; text-align: left;" colspan="12" scope="col"><strong>Serial No.:</strong></td>
</tr>
<tr style="height: 26px;">
<td style="width: 271.017px; height: 26px;" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_item_model")/}}</td>
<td style="width: 716.817px; height: 26px;" colspan="12" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_item_serno")/}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 6px;">
<td style="width: 1005.07px; height: 6px; text-align: left;" colspan="13" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 9px;">
<td style="width: 1005.07px; height: 9px; text-align: left; vertical-align: bottom;" colspan="13" scope="col"><strong>If visit is for service, state the reported problem:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
</tr>
<tr style="height: 88px;">
<td style="width: 1005.07px; height: 88px; text-align: left;" colspan="13" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_item_type_problem")/}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 14px;">
<td style="width: 1005.07px; height: 14px; text-align: left; vertical-align: bottom;" colspan="13" scope="col"><strong>Action taken:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
</tr>
<tr style="height: 88px;">
<td style="width: 1005.07px; height: 88px; text-align: left;" colspan="13" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_item_action_taken")/}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 11px;">
<td style="width: 1005.07px; height: 11px; text-align: left; vertical-align: bottom;" colspan="13" scope="col"><strong>Other recommendations:&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 92px;">
<td style="width: 1005.07px; height: 92px; text-align: left;" colspan="13" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_remarks")/}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 61px;">
<td style="width: 271.017px; height: 98px; text-align: center;" rowspan="3" scope="col">
<p>&nbsp;<strong>Rate US:&nbsp;</strong></p>
<p>Please respond to the following question by placing a check mark (&radic;)</p>
</td>
<td style="width: 226.117px; height: 61px; text-align: right;" colspan="2" scope="col">Not All LikeLy &nbsp; *&nbsp;&nbsp;</td>
<td style="width: 228.033px; height: 61px; text-align: right;" colspan="5" scope="col">Nuetral&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;</td>
<td style="width: 228.2px; height: 61px; text-align: right;" colspan="5" scope="col">Extremely Likely&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;</td>
</tr>
<tr style="height: 20px;">
<td style="width: 177.067px; height: 37px; vertical-align: middle; text-align: center;" rowspan="2" scope="col">How satisfied are you with the quality of the support you received?</td>
<td style="width: 31.8167px; height: 20px; text-align: center; vertical-align: middle;" scope="col">0</td>
<td style="width: 31.8167px; height: 20px; text-align: center; vertical-align: middle;" scope="col">1</td>
<td style="width: 31.8167px; height: 20px; text-align: center; vertical-align: middle;" scope="col">2</td>
<td style="width: 31.8167px; height: 20px; text-align: center; vertical-align: middle;" scope="col">3</td>
<td style="width: 31.8167px; height: 20px; text-align: center; vertical-align: middle;" scope="col">4</td>
<td style="width: 31.8333px; height: 20px; text-align: center; vertical-align: middle;" scope="col">5</td>
<td style="width: 31.85px; height: 20px; text-align: center; vertical-align: middle;" scope="col">6</td>
<td style="width: 31.8333px; height: 20px; text-align: center; vertical-align: middle;" scope="col">7</td>
<td style="width: 31.85px; height: 20px; text-align: center; vertical-align: middle;" scope="col">8</td>
<td style="width: 31.8333px; height: 20px; text-align: center; vertical-align: middle;" scope="col">9</td>
<td style="width: 31.9px; height: 20px; text-align: center; vertical-align: middle;" scope="col">10</td>
</tr>
<tr style="height: 17px;">
<td style="width: 31.8167px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.8167px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.8167px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.8167px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.8167px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.8333px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.85px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.8333px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.85px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.8333px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
<td style="width: 31.9px; height: 17px; text-align: center; vertical-align: middle;" scope="col">&nbsp;</td>
</tr>
<tr style="height: 8px;">
<td style="width: 1005.07px; height: 8px; text-align: left;" colspan="13" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr style="height: 10px;">
<td style="width: 271.017px; height: 10px; text-align: left; vertical-align: bottom;" scope="col"><strong>Name of Client&nbsp;</strong></td>
<td style="width: 373.267px; height: 10px; text-align: left; vertical-align: bottom;" colspan="5" scope="col"><strong>Position Tittle </strong></td>
<td style="width: 326.317px; height: 10px; text-align: left; vertical-align: bottom;" colspan="7" scope="col"><strong>Signature</strong></td>
</tr>
<tr style="height: 61px;">
<td style="width: 271.017px; height: 61px; text-align: left;" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_item_transmittal")/}}&nbsp;</td>
<td style="width: 373.267px; height: 61px; text-align: left;" colspan="5" scope="col">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_inspection_report_position")/}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td style="width: 326.317px; height: 61px; text-align: left;" colspan="7" scope="col">&nbsp;</td>
</tr>
<tr style="height: 5px;">
<td style="width: 271.017px; height: 69.7167px; text-align: left;" rowspan="2" scope="col">I hereby certify that above info. are true &amp; correct:</td>
<td style="width: 373.267px; height: 5px; text-align: left; vertical-align: middle;" colspan="5" scope="col"><strong>Service Support Staff Signature:</strong></td>
<td style="width: 326.317px; height: 5px; text-align: left; vertical-align: middle;" colspan="7" scope="col"><strong>Verified by (Supervisor's Signature):</strong></td>
</tr>
<tr style="height: 64.7167px;">
<td style="width: 373.267px; height: 64.7167px; text-align: left; vertical-align: bottom;" colspan="5" scope="col">&nbsp;</td>
<td style="width: 326.317px; height: 64.7167px; text-align: left; vertical-align: bottom;" colspan="7" scope="col">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>

<?php } ?>
<?php } ?>
</div>
</script>

</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inspection_report_list->Recordset)
	$inspection_report_list->Recordset->Close();
?>
<?php if (!$inspection_report_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $inspection_report_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inspection_report_list->TotalRecords == 0 && !$inspection_report->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inspection_report_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($inspection_report->Rows) ?> };
	ew.applyTemplate("tpd_inspection_reportlist", "tpm_inspection_reportlist", "inspection_reportlist", "<?php echo $inspection_report->CustomExport ?>", ew.templateData);
	$("script.inspection_reportlist_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$inspection_report_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$inspection_report_list->isExport()) { ?>
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
$inspection_report_list->terminate();
?>