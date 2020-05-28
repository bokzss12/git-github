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
$ta_report2_list = new ta_report2_list();

// Run the page
$ta_report2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ta_report2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ta_report2_list->isExport()) { ?>
<script>
var fta_report2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fta_report2list = currentForm = new ew.Form("fta_report2list", "list");
	fta_report2list.formKeyCountName = '<?php echo $ta_report2_list->FormKeyCountName ?>';
	loadjs.done("fta_report2list");
});
var fta_report2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fta_report2listsrch = currentSearchForm = new ew.Form("fta_report2listsrch");

	// Dynamic selection lists
	// Filters

	fta_report2listsrch.filterList = <?php echo $ta_report2_list->getFilterList() ?>;
	loadjs.done("fta_report2listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ta_report2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ta_report2_list->TotalRecords > 0 && $ta_report2_list->ExportOptions->visible()) { ?>
<?php $ta_report2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ta_report2_list->ImportOptions->visible()) { ?>
<?php $ta_report2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ta_report2_list->SearchOptions->visible()) { ?>
<?php $ta_report2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ta_report2_list->FilterOptions->visible()) { ?>
<?php $ta_report2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ta_report2_list->renderOtherOptions();
?>
<?php $ta_report2_list->showPageHeader(); ?>
<?php
$ta_report2_list->showMessage();
?>
<?php if ($ta_report2_list->TotalRecords > 0 || $ta_report2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ta_report2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ta_report2">
<?php if (!$ta_report2_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ta_report2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ta_report2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ta_report2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fta_report2list" id="fta_report2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ta_report2">
<div id="gmp_ta_report2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ta_report2_list->TotalRecords > 0 || $ta_report2_list->isGridEdit()) { ?>
<table id="tbl_ta_report2list" class="table ew-table d-none"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ta_report2->RowType = ROWTYPE_HEADER;

// Render list options
$ta_report2_list->renderListOptions();

// Render list options (header, left)
$ta_report2_list->ListOptions->render("header", "left", "", "block", $ta_report2->TableVar, "ta_report2list");
?>
<?php if ($ta_report2_list->Year->Visible) { // Year ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $ta_report2_list->Year->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_ta_report2_Year" class="ta_report2_Year"><div class="ew-table-header-caption"><script id="tpc_ta_report2_Year" type="text/html"><?php echo $ta_report2_list->Year->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $ta_report2_list->Year->headerCellClass() ?>" style="white-space: nowrap;"><script id="tpc_ta_report2_Year" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->Year) ?>', 1);"><div id="elh_ta_report2_Year" class="ta_report2_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_date_receive->Visible) { // item_date_receive ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_date_receive) == "") { ?>
		<th data-name="item_date_receive" class="<?php echo $ta_report2_list->item_date_receive->headerCellClass() ?>"><div id="elh_ta_report2_item_date_receive" class="ta_report2_item_date_receive"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_date_receive" type="text/html"><?php echo $ta_report2_list->item_date_receive->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_receive" class="<?php echo $ta_report2_list->item_date_receive->headerCellClass() ?>"><script id="tpc_ta_report2_item_date_receive" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_date_receive) ?>', 1);"><div id="elh_ta_report2_item_date_receive" class="ta_report2_item_date_receive">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_date_receive->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_date_receive->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_date_receive->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_date_repaired->Visible) { // item_date_repaired ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_date_repaired) == "") { ?>
		<th data-name="item_date_repaired" class="<?php echo $ta_report2_list->item_date_repaired->headerCellClass() ?>"><div id="elh_ta_report2_item_date_repaired" class="ta_report2_item_date_repaired"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_date_repaired" type="text/html"><?php echo $ta_report2_list->item_date_repaired->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_repaired" class="<?php echo $ta_report2_list->item_date_repaired->headerCellClass() ?>"><script id="tpc_ta_report2_item_date_repaired" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_date_repaired) ?>', 1);"><div id="elh_ta_report2_item_date_repaired" class="ta_report2_item_date_repaired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_date_repaired->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_date_repaired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_date_repaired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->Concat->Visible) { // Concat ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->Concat) == "") { ?>
		<th data-name="Concat" class="<?php echo $ta_report2_list->Concat->headerCellClass() ?>"><div id="elh_ta_report2_Concat" class="ta_report2_Concat"><div class="ew-table-header-caption"><script id="tpc_ta_report2_Concat" type="text/html"><?php echo $ta_report2_list->Concat->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Concat" class="<?php echo $ta_report2_list->Concat->headerCellClass() ?>"><script id="tpc_ta_report2_Concat" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->Concat) ?>', 1);"><div id="elh_ta_report2_Concat" class="ta_report2_Concat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->Concat->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->Concat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->Concat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_transmittal->Visible) { // item_transmittal ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_transmittal) == "") { ?>
		<th data-name="item_transmittal" class="<?php echo $ta_report2_list->item_transmittal->headerCellClass() ?>"><div id="elh_ta_report2_item_transmittal" class="ta_report2_item_transmittal"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_transmittal" type="text/html"><?php echo $ta_report2_list->item_transmittal->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_transmittal" class="<?php echo $ta_report2_list->item_transmittal->headerCellClass() ?>"><script id="tpc_ta_report2_item_transmittal" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_transmittal) ?>', 1);"><div id="elh_ta_report2_item_transmittal" class="ta_report2_item_transmittal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_transmittal->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_transmittal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_transmittal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->position->Visible) { // position ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->position) == "") { ?>
		<th data-name="position" class="<?php echo $ta_report2_list->position->headerCellClass() ?>"><div id="elh_ta_report2_position" class="ta_report2_position"><div class="ew-table-header-caption"><script id="tpc_ta_report2_position" type="text/html"><?php echo $ta_report2_list->position->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="position" class="<?php echo $ta_report2_list->position->headerCellClass() ?>"><script id="tpc_ta_report2_position" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->position) ?>', 1);"><div id="elh_ta_report2_position" class="ta_report2_position">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->position->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->off_desc->Visible) { // off_desc ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->off_desc) == "") { ?>
		<th data-name="off_desc" class="<?php echo $ta_report2_list->off_desc->headerCellClass() ?>"><div id="elh_ta_report2_off_desc" class="ta_report2_off_desc"><div class="ew-table-header-caption"><script id="tpc_ta_report2_off_desc" type="text/html"><?php echo $ta_report2_list->off_desc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="off_desc" class="<?php echo $ta_report2_list->off_desc->headerCellClass() ?>"><script id="tpc_ta_report2_off_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->off_desc) ?>', 1);"><div id="elh_ta_report2_off_desc" class="ta_report2_off_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->off_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->off_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->off_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->off_desc1->Visible) { // off_desc1 ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->off_desc1) == "") { ?>
		<th data-name="off_desc1" class="<?php echo $ta_report2_list->off_desc1->headerCellClass() ?>"><div id="elh_ta_report2_off_desc1" class="ta_report2_off_desc1"><div class="ew-table-header-caption"><script id="tpc_ta_report2_off_desc1" type="text/html"><?php echo $ta_report2_list->off_desc1->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="off_desc1" class="<?php echo $ta_report2_list->off_desc1->headerCellClass() ?>"><script id="tpc_ta_report2_off_desc1" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->off_desc1) ?>', 1);"><div id="elh_ta_report2_off_desc1" class="ta_report2_off_desc1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->off_desc1->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->off_desc1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->off_desc1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->model->Visible) { // model ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->model) == "") { ?>
		<th data-name="model" class="<?php echo $ta_report2_list->model->headerCellClass() ?>"><div id="elh_ta_report2_model" class="ta_report2_model"><div class="ew-table-header-caption"><script id="tpc_ta_report2_model" type="text/html"><?php echo $ta_report2_list->model->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="model" class="<?php echo $ta_report2_list->model->headerCellClass() ?>"><script id="tpc_ta_report2_model" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->model) ?>', 1);"><div id="elh_ta_report2_model" class="ta_report2_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->model->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->cat_desc->Visible) { // cat_desc ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->cat_desc) == "") { ?>
		<th data-name="cat_desc" class="<?php echo $ta_report2_list->cat_desc->headerCellClass() ?>"><div id="elh_ta_report2_cat_desc" class="ta_report2_cat_desc"><div class="ew-table-header-caption"><script id="tpc_ta_report2_cat_desc" type="text/html"><?php echo $ta_report2_list->cat_desc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="cat_desc" class="<?php echo $ta_report2_list->cat_desc->headerCellClass() ?>"><script id="tpc_ta_report2_cat_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->cat_desc) ?>', 1);"><div id="elh_ta_report2_cat_desc" class="ta_report2_cat_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->cat_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->cat_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->cat_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_model->Visible) { // item_model ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $ta_report2_list->item_model->headerCellClass() ?>"><div id="elh_ta_report2_item_model" class="ta_report2_item_model"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_model" type="text/html"><?php echo $ta_report2_list->item_model->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $ta_report2_list->item_model->headerCellClass() ?>"><script id="tpc_ta_report2_item_model" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_model) ?>', 1);"><div id="elh_ta_report2_item_model" class="ta_report2_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_model->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_serno->Visible) { // item_serno ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_serno) == "") { ?>
		<th data-name="item_serno" class="<?php echo $ta_report2_list->item_serno->headerCellClass() ?>"><div id="elh_ta_report2_item_serno" class="ta_report2_item_serno"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_serno" type="text/html"><?php echo $ta_report2_list->item_serno->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_serno" class="<?php echo $ta_report2_list->item_serno->headerCellClass() ?>"><script id="tpc_ta_report2_item_serno" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_serno) ?>', 1);"><div id="elh_ta_report2_item_serno" class="ta_report2_item_serno">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_serno->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_serno->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_serno->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_type_problem->Visible) { // item_type_problem ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_type_problem) == "") { ?>
		<th data-name="item_type_problem" class="<?php echo $ta_report2_list->item_type_problem->headerCellClass() ?>"><div id="elh_ta_report2_item_type_problem" class="ta_report2_item_type_problem"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_type_problem" type="text/html"><?php echo $ta_report2_list->item_type_problem->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_type_problem" class="<?php echo $ta_report2_list->item_type_problem->headerCellClass() ?>"><script id="tpc_ta_report2_item_type_problem" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_type_problem) ?>', 1);"><div id="elh_ta_report2_item_type_problem" class="ta_report2_item_type_problem">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_type_problem->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_type_problem->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_type_problem->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_action_taken->Visible) { // item_action_taken ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_action_taken) == "") { ?>
		<th data-name="item_action_taken" class="<?php echo $ta_report2_list->item_action_taken->headerCellClass() ?>"><div id="elh_ta_report2_item_action_taken" class="ta_report2_item_action_taken"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_action_taken" type="text/html"><?php echo $ta_report2_list->item_action_taken->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_action_taken" class="<?php echo $ta_report2_list->item_action_taken->headerCellClass() ?>"><script id="tpc_ta_report2_item_action_taken" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_action_taken) ?>', 1);"><div id="elh_ta_report2_item_action_taken" class="ta_report2_item_action_taken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_action_taken->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_action_taken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_action_taken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->employeeid->Visible) { // employeeid ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->employeeid) == "") { ?>
		<th data-name="employeeid" class="<?php echo $ta_report2_list->employeeid->headerCellClass() ?>"><div id="elh_ta_report2_employeeid" class="ta_report2_employeeid"><div class="ew-table-header-caption"><script id="tpc_ta_report2_employeeid" type="text/html"><?php echo $ta_report2_list->employeeid->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="employeeid" class="<?php echo $ta_report2_list->employeeid->headerCellClass() ?>"><script id="tpc_ta_report2_employeeid" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->employeeid) ?>', 1);"><div id="elh_ta_report2_employeeid" class="ta_report2_employeeid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->employeeid->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->employeeid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->employeeid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->status_desc->Visible) { // status_desc ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->status_desc) == "") { ?>
		<th data-name="status_desc" class="<?php echo $ta_report2_list->status_desc->headerCellClass() ?>"><div id="elh_ta_report2_status_desc" class="ta_report2_status_desc"><div class="ew-table-header-caption"><script id="tpc_ta_report2_status_desc" type="text/html"><?php echo $ta_report2_list->status_desc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="status_desc" class="<?php echo $ta_report2_list->status_desc->headerCellClass() ?>"><script id="tpc_ta_report2_status_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->status_desc) ?>', 1);"><div id="elh_ta_report2_status_desc" class="ta_report2_status_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->status_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->status_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->status_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->Name_dsc->Visible) { // Name_dsc ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->Name_dsc) == "") { ?>
		<th data-name="Name_dsc" class="<?php echo $ta_report2_list->Name_dsc->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_ta_report2_Name_dsc" class="ta_report2_Name_dsc"><div class="ew-table-header-caption"><script id="tpc_ta_report2_Name_dsc" type="text/html"><?php echo $ta_report2_list->Name_dsc->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Name_dsc" class="<?php echo $ta_report2_list->Name_dsc->headerCellClass() ?>" style="white-space: nowrap;"><script id="tpc_ta_report2_Name_dsc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->Name_dsc) ?>', 1);"><div id="elh_ta_report2_Name_dsc" class="ta_report2_Name_dsc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->Name_dsc->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->Name_dsc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->Name_dsc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_date_pullout->Visible) { // item_date_pullout ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_date_pullout) == "") { ?>
		<th data-name="item_date_pullout" class="<?php echo $ta_report2_list->item_date_pullout->headerCellClass() ?>"><div id="elh_ta_report2_item_date_pullout" class="ta_report2_item_date_pullout"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_date_pullout" type="text/html"><?php echo $ta_report2_list->item_date_pullout->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_date_pullout" class="<?php echo $ta_report2_list->item_date_pullout->headerCellClass() ?>"><script id="tpc_ta_report2_item_date_pullout" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_date_pullout) ?>', 1);"><div id="elh_ta_report2_item_date_pullout" class="ta_report2_item_date_pullout">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_date_pullout->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_date_pullout->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_date_pullout->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->Region->Visible) { // Region ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->Region) == "") { ?>
		<th data-name="Region" class="<?php echo $ta_report2_list->Region->headerCellClass() ?>"><div id="elh_ta_report2_Region" class="ta_report2_Region"><div class="ew-table-header-caption"><script id="tpc_ta_report2_Region" type="text/html"><?php echo $ta_report2_list->Region->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Region" class="<?php echo $ta_report2_list->Region->headerCellClass() ?>"><script id="tpc_ta_report2_Region" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->Region) ?>', 1);"><div id="elh_ta_report2_Region" class="ta_report2_Region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->Region->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->Region->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->Region->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->Province->Visible) { // Province ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->Province) == "") { ?>
		<th data-name="Province" class="<?php echo $ta_report2_list->Province->headerCellClass() ?>"><div id="elh_ta_report2_Province" class="ta_report2_Province"><div class="ew-table-header-caption"><script id="tpc_ta_report2_Province" type="text/html"><?php echo $ta_report2_list->Province->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Province" class="<?php echo $ta_report2_list->Province->headerCellClass() ?>"><script id="tpc_ta_report2_Province" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->Province) ?>', 1);"><div id="elh_ta_report2_Province" class="ta_report2_Province">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->Province->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->Province->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->Province->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->Cities->Visible) { // Cities ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->Cities) == "") { ?>
		<th data-name="Cities" class="<?php echo $ta_report2_list->Cities->headerCellClass() ?>"><div id="elh_ta_report2_Cities" class="ta_report2_Cities"><div class="ew-table-header-caption"><script id="tpc_ta_report2_Cities" type="text/html"><?php echo $ta_report2_list->Cities->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Cities" class="<?php echo $ta_report2_list->Cities->headerCellClass() ?>"><script id="tpc_ta_report2_Cities" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->Cities) ?>', 1);"><div id="elh_ta_report2_Cities" class="ta_report2_Cities">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->Cities->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->Cities->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->Cities->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->__Request->Visible) { // Request ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->__Request) == "") { ?>
		<th data-name="__Request" class="<?php echo $ta_report2_list->__Request->headerCellClass() ?>"><div id="elh_ta_report2___Request" class="ta_report2___Request"><div class="ew-table-header-caption"><script id="tpc_ta_report2___Request" type="text/html"><?php echo $ta_report2_list->__Request->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="__Request" class="<?php echo $ta_report2_list->__Request->headerCellClass() ?>"><script id="tpc_ta_report2___Request" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->__Request) ?>', 1);"><div id="elh_ta_report2___Request" class="ta_report2___Request">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->__Request->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->__Request->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->__Request->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->user_last_modify->Visible) { // user_last_modify ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->user_last_modify) == "") { ?>
		<th data-name="user_last_modify" class="<?php echo $ta_report2_list->user_last_modify->headerCellClass() ?>"><div id="elh_ta_report2_user_last_modify" class="ta_report2_user_last_modify"><div class="ew-table-header-caption"><script id="tpc_ta_report2_user_last_modify" type="text/html"><?php echo $ta_report2_list->user_last_modify->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="user_last_modify" class="<?php echo $ta_report2_list->user_last_modify->headerCellClass() ?>"><script id="tpc_ta_report2_user_last_modify" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->user_last_modify) ?>', 1);"><div id="elh_ta_report2_user_last_modify" class="ta_report2_user_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->user_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->user_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->user_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->date_last_modify->Visible) { // date_last_modify ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->date_last_modify) == "") { ?>
		<th data-name="date_last_modify" class="<?php echo $ta_report2_list->date_last_modify->headerCellClass() ?>"><div id="elh_ta_report2_date_last_modify" class="ta_report2_date_last_modify"><div class="ew-table-header-caption"><script id="tpc_ta_report2_date_last_modify" type="text/html"><?php echo $ta_report2_list->date_last_modify->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="date_last_modify" class="<?php echo $ta_report2_list->date_last_modify->headerCellClass() ?>"><script id="tpc_ta_report2_date_last_modify" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->date_last_modify) ?>', 1);"><div id="elh_ta_report2_date_last_modify" class="ta_report2_date_last_modify">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->date_last_modify->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->date_last_modify->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->date_last_modify->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->SRN->Visible) { // SRN ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->SRN) == "") { ?>
		<th data-name="SRN" class="<?php echo $ta_report2_list->SRN->headerCellClass() ?>"><div id="elh_ta_report2_SRN" class="ta_report2_SRN"><div class="ew-table-header-caption"><script id="tpc_ta_report2_SRN" type="text/html"><?php echo $ta_report2_list->SRN->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="SRN" class="<?php echo $ta_report2_list->SRN->headerCellClass() ?>"><script id="tpc_ta_report2_SRN" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->SRN) ?>', 1);"><div id="elh_ta_report2_SRN" class="ta_report2_SRN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->SRN->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->SRN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->SRN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->Contact_no->Visible) { // Contact_no ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->Contact_no) == "") { ?>
		<th data-name="Contact_no" class="<?php echo $ta_report2_list->Contact_no->headerCellClass() ?>"><div id="elh_ta_report2_Contact_no" class="ta_report2_Contact_no"><div class="ew-table-header-caption"><script id="tpc_ta_report2_Contact_no" type="text/html"><?php echo $ta_report2_list->Contact_no->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Contact_no" class="<?php echo $ta_report2_list->Contact_no->headerCellClass() ?>"><script id="tpc_ta_report2_Contact_no" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->Contact_no) ?>', 1);"><div id="elh_ta_report2_Contact_no" class="ta_report2_Contact_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->Contact_no->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->Contact_no->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->Contact_no->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($ta_report2_list->item_id->Visible) { // item_id ?>
	<?php if ($ta_report2_list->SortUrl($ta_report2_list->item_id) == "") { ?>
		<th data-name="item_id" class="<?php echo $ta_report2_list->item_id->headerCellClass() ?>"><div id="elh_ta_report2_item_id" class="ta_report2_item_id"><div class="ew-table-header-caption"><script id="tpc_ta_report2_item_id" type="text/html"><?php echo $ta_report2_list->item_id->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_id" class="<?php echo $ta_report2_list->item_id->headerCellClass() ?>"><script id="tpc_ta_report2_item_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ta_report2_list->SortUrl($ta_report2_list->item_id) ?>', 1);"><div id="elh_ta_report2_item_id" class="ta_report2_item_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ta_report2_list->item_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ta_report2_list->item_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ta_report2_list->item_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ta_report2_list->ListOptions->render("header", "right", "", "block", $ta_report2->TableVar, "ta_report2list");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ta_report2_list->ExportAll && $ta_report2_list->isExport()) {
	$ta_report2_list->StopRecord = $ta_report2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ta_report2_list->TotalRecords > $ta_report2_list->StartRecord + $ta_report2_list->DisplayRecords - 1)
		$ta_report2_list->StopRecord = $ta_report2_list->StartRecord + $ta_report2_list->DisplayRecords - 1;
	else
		$ta_report2_list->StopRecord = $ta_report2_list->TotalRecords;
}
$ta_report2_list->RecordCount = $ta_report2_list->StartRecord - 1;
if ($ta_report2_list->Recordset && !$ta_report2_list->Recordset->EOF) {
	$ta_report2_list->Recordset->moveFirst();
	$selectLimit = $ta_report2_list->UseSelectLimit;
	if (!$selectLimit && $ta_report2_list->StartRecord > 1)
		$ta_report2_list->Recordset->move($ta_report2_list->StartRecord - 1);
} elseif (!$ta_report2->AllowAddDeleteRow && $ta_report2_list->StopRecord == 0) {
	$ta_report2_list->StopRecord = $ta_report2->GridAddRowCount;
}

// Initialize aggregate
$ta_report2->RowType = ROWTYPE_AGGREGATEINIT;
$ta_report2->resetAttributes();
$ta_report2_list->renderRow();
while ($ta_report2_list->RecordCount < $ta_report2_list->StopRecord) {
	$ta_report2_list->RecordCount++;
	if ($ta_report2_list->RecordCount >= $ta_report2_list->StartRecord) {
		$ta_report2_list->RowCount++;

		// Set up key count
		$ta_report2_list->KeyCount = $ta_report2_list->RowIndex;

		// Init row class and style
		$ta_report2->resetAttributes();
		$ta_report2->CssClass = "";
		if ($ta_report2_list->isGridAdd()) {
		} else {
			$ta_report2_list->loadRowValues($ta_report2_list->Recordset); // Load row values
		}
		$ta_report2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ta_report2->RowAttrs->merge(["data-rowindex" => $ta_report2_list->RowCount, "id" => "r" . $ta_report2_list->RowCount . "_ta_report2", "data-rowtype" => $ta_report2->RowType]);

		// Render row
		$ta_report2_list->renderRow();

		// Render list options
		$ta_report2_list->renderListOptions();

		// Save row and cell attributes
		$ta_report2_list->Attrs[$ta_report2_list->RowCount] = ["row_attrs" => $ta_report2->rowAttributes(), "cell_attrs" => []];
		$ta_report2_list->Attrs[$ta_report2_list->RowCount]["cell_attrs"] = $ta_report2->fieldCellAttributes();
?>
	<tr <?php echo $ta_report2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ta_report2_list->ListOptions->render("body", "left", $ta_report2_list->RowCount, "single", $ta_report2->TableVar, "ta_report2list");
?>
	<?php if ($ta_report2_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $ta_report2_list->Year->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_Year" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_Year">
<span<?php echo $ta_report2_list->Year->viewAttributes() ?>><?php echo $ta_report2_list->Year->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_date_receive->Visible) { // item_date_receive ?>
		<td data-name="item_date_receive" <?php echo $ta_report2_list->item_date_receive->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_date_receive" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_date_receive">
<span<?php echo $ta_report2_list->item_date_receive->viewAttributes() ?>><?php echo $ta_report2_list->item_date_receive->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_date_repaired->Visible) { // item_date_repaired ?>
		<td data-name="item_date_repaired" <?php echo $ta_report2_list->item_date_repaired->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_date_repaired" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_date_repaired">
<span<?php echo $ta_report2_list->item_date_repaired->viewAttributes() ?>><?php echo $ta_report2_list->item_date_repaired->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->Concat->Visible) { // Concat ?>
		<td data-name="Concat" <?php echo $ta_report2_list->Concat->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_Concat" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_Concat">
<span<?php echo $ta_report2_list->Concat->viewAttributes() ?>><?php echo $ta_report2_list->Concat->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_transmittal->Visible) { // item_transmittal ?>
		<td data-name="item_transmittal" <?php echo $ta_report2_list->item_transmittal->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_transmittal" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_transmittal">
<span<?php echo $ta_report2_list->item_transmittal->viewAttributes() ?>><?php echo $ta_report2_list->item_transmittal->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->position->Visible) { // position ?>
		<td data-name="position" <?php echo $ta_report2_list->position->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_position" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_position">
<span<?php echo $ta_report2_list->position->viewAttributes() ?>><?php echo $ta_report2_list->position->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->off_desc->Visible) { // off_desc ?>
		<td data-name="off_desc" <?php echo $ta_report2_list->off_desc->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_off_desc" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_off_desc">
<span<?php echo $ta_report2_list->off_desc->viewAttributes() ?>><?php echo $ta_report2_list->off_desc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->off_desc1->Visible) { // off_desc1 ?>
		<td data-name="off_desc1" <?php echo $ta_report2_list->off_desc1->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_off_desc1" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_off_desc1">
<span<?php echo $ta_report2_list->off_desc1->viewAttributes() ?>><?php echo $ta_report2_list->off_desc1->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->model->Visible) { // model ?>
		<td data-name="model" <?php echo $ta_report2_list->model->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_model" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_model">
<span<?php echo $ta_report2_list->model->viewAttributes() ?>><?php echo $ta_report2_list->model->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->cat_desc->Visible) { // cat_desc ?>
		<td data-name="cat_desc" <?php echo $ta_report2_list->cat_desc->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_cat_desc" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_cat_desc">
<span<?php echo $ta_report2_list->cat_desc->viewAttributes() ?>><?php echo $ta_report2_list->cat_desc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $ta_report2_list->item_model->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_model" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_model">
<span<?php echo $ta_report2_list->item_model->viewAttributes() ?>><?php echo $ta_report2_list->item_model->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_serno->Visible) { // item_serno ?>
		<td data-name="item_serno" <?php echo $ta_report2_list->item_serno->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_serno" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_serno">
<span<?php echo $ta_report2_list->item_serno->viewAttributes() ?>><?php echo $ta_report2_list->item_serno->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_type_problem->Visible) { // item_type_problem ?>
		<td data-name="item_type_problem" <?php echo $ta_report2_list->item_type_problem->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_type_problem" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_type_problem">
<span<?php echo $ta_report2_list->item_type_problem->viewAttributes() ?>><?php echo $ta_report2_list->item_type_problem->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_action_taken->Visible) { // item_action_taken ?>
		<td data-name="item_action_taken" <?php echo $ta_report2_list->item_action_taken->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_action_taken" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_action_taken">
<span<?php echo $ta_report2_list->item_action_taken->viewAttributes() ?>><?php echo $ta_report2_list->item_action_taken->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->employeeid->Visible) { // employeeid ?>
		<td data-name="employeeid" <?php echo $ta_report2_list->employeeid->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_employeeid" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_employeeid">
<span<?php echo $ta_report2_list->employeeid->viewAttributes() ?>><?php echo $ta_report2_list->employeeid->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->status_desc->Visible) { // status_desc ?>
		<td data-name="status_desc" <?php echo $ta_report2_list->status_desc->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_status_desc" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_status_desc">
<span<?php echo $ta_report2_list->status_desc->viewAttributes() ?>><?php echo $ta_report2_list->status_desc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->Name_dsc->Visible) { // Name_dsc ?>
		<td data-name="Name_dsc" <?php echo $ta_report2_list->Name_dsc->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_Name_dsc" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_Name_dsc">
<span<?php echo $ta_report2_list->Name_dsc->viewAttributes() ?>><?php echo $ta_report2_list->Name_dsc->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_date_pullout->Visible) { // item_date_pullout ?>
		<td data-name="item_date_pullout" <?php echo $ta_report2_list->item_date_pullout->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_date_pullout" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_date_pullout">
<span<?php echo $ta_report2_list->item_date_pullout->viewAttributes() ?>><?php echo $ta_report2_list->item_date_pullout->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->Region->Visible) { // Region ?>
		<td data-name="Region" <?php echo $ta_report2_list->Region->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_Region" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_Region">
<span<?php echo $ta_report2_list->Region->viewAttributes() ?>><?php echo $ta_report2_list->Region->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->Province->Visible) { // Province ?>
		<td data-name="Province" <?php echo $ta_report2_list->Province->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_Province" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_Province">
<span<?php echo $ta_report2_list->Province->viewAttributes() ?>><?php echo $ta_report2_list->Province->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->Cities->Visible) { // Cities ?>
		<td data-name="Cities" <?php echo $ta_report2_list->Cities->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_Cities" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_Cities">
<span<?php echo $ta_report2_list->Cities->viewAttributes() ?>><?php echo $ta_report2_list->Cities->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->__Request->Visible) { // Request ?>
		<td data-name="__Request" <?php echo $ta_report2_list->__Request->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2___Request" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2___Request">
<span<?php echo $ta_report2_list->__Request->viewAttributes() ?>><?php echo $ta_report2_list->__Request->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->user_last_modify->Visible) { // user_last_modify ?>
		<td data-name="user_last_modify" <?php echo $ta_report2_list->user_last_modify->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_user_last_modify" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_user_last_modify">
<span<?php echo $ta_report2_list->user_last_modify->viewAttributes() ?>><?php echo $ta_report2_list->user_last_modify->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->date_last_modify->Visible) { // date_last_modify ?>
		<td data-name="date_last_modify" <?php echo $ta_report2_list->date_last_modify->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_date_last_modify" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_date_last_modify">
<span<?php echo $ta_report2_list->date_last_modify->viewAttributes() ?>><?php echo $ta_report2_list->date_last_modify->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->SRN->Visible) { // SRN ?>
		<td data-name="SRN" <?php echo $ta_report2_list->SRN->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_SRN" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_SRN">
<span<?php echo $ta_report2_list->SRN->viewAttributes() ?>><?php echo $ta_report2_list->SRN->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->Contact_no->Visible) { // Contact_no ?>
		<td data-name="Contact_no" <?php echo $ta_report2_list->Contact_no->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_Contact_no" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_Contact_no">
<span<?php echo $ta_report2_list->Contact_no->viewAttributes() ?>><?php echo $ta_report2_list->Contact_no->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($ta_report2_list->item_id->Visible) { // item_id ?>
		<td data-name="item_id" <?php echo $ta_report2_list->item_id->cellAttributes() ?>>
<script id="tpx<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_id" type="text/html"><span id="el<?php echo $ta_report2_list->RowCount ?>_ta_report2_item_id">
<span<?php echo $ta_report2_list->item_id->viewAttributes() ?>><?php echo $ta_report2_list->item_id->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ta_report2_list->ListOptions->render("body", "right", $ta_report2_list->RowCount, "single", $ta_report2->TableVar, "ta_report2list");
?>
	</tr>
<?php
	}
	if (!$ta_report2_list->isGridAdd())
		$ta_report2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ta_report2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<div id="tpd_ta_report2list" class="ew-custom-template"></div>
<script id="tpm_ta_report2list" type="text/html">
<div id="ct_ta_report2_list"><?php if ($ta_report2_list->RowCount > 0) { ?>
<div style="margin-left:0px">
		<table width="100%" cellpadding="0" border="0" border-collapse="0">
<tr>
			  <td width="0%" align="left"><p></p>
			  <td width="0%" align="left"><p><?php echo date("F j, Y"); ?></p>
</tr>
	</table>
</div>
 <!--<p align="left"><?php echo date("F j, Y"); ?></p>-->
<center><font size="2">Department of Social Welfare and Development</center>
<center><font size="2">Field Office VI</center>
<center><font size="2">Pantawid Pamilyang Pilipino Program</center></br></br>
<center><b><font size="5">Technical Assistance Report</font></b></center></br>
<table cellspacing="0" cellpadding="0" width="100%" height="0" border= "1px" >
<tr>
	<th width="2%"><font size="2"><p align="right">no.</p></th> 
	<th width="8%"><font size="2"><p align="center">Date Received</p></th>
	<th width="8%"><font size="2"><p align="center">Date Repaired/TA/Monitoring</p></th>
	<th width="10%"><font size="2"><p align="center">Requested Unit Division / Location</p></th> 
	<th width="10%"><font size="2"><p align="center">ICT Equipment use (OPTIONAL)</p></th>
	<th width="8%"><font size="2"><p align="center">Problem/TA/Monitoring</p></th>
	<th width="15%"><font size="2"><p align="center">Action Taken</p></th>
	<th width="6%"><font size="2"><p align="center">Status</p></th>
 </tr>
<?php for ($i = $ta_report2_list->StartRowCount; $i <= $ta_report2_list->RowCount; $i++) { ?>

</tr>
	 <!--<td><p align="left"><?php echo $i ?></p></td>         --- sequence no in page only-->
	<td><p align="left">{{include tmpl=~getTemplate("#tpob<?php echo $i ?>_ta_report2_sequence")/}}</p></td>
	<td><p align="left">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_ta_report2_item_date_receive")/}}</p></td>
  	<td><p align="left">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_ta_report2_item_date_repaired")/}}</p></td>
	<td><p align="left">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_ta_report2_Concat")/}}</p></td>
	<td><p align="left">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_ta_report2_model")/}}</p></td>
	<td><p align="left">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_ta_report2_item_type_problem")/}}</p></td>
	<td><p align="left">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_ta_report2_item_action_taken")/}}</p></td>
	<td><p align="left">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_ta_report2_status_desc")/}}</p></td>
</tr>

<?php } ?>
<?php if ($ta_report2_list->TotalRecords > 0 && !$ta_report2->isGridAdd() && !$ta_report2->isGridEdit()) { ?>
<div style="margin-left:0px">
		<table width="100%" cellpadding="0" border="0" border-collapse="0">
<tr>
				<td width="0%" align="left"><p></p>
				<td width="0%" align="left"><p>Prepared by:</p></br>
			  	 	<p align="left"><b><u>{{:Name_dsc}}</u></b></br>  
			  	    CMT II-Pantawid</p></td>
			  	<td width="0%" align="left"><p></p>
			  	<td width="0%" align="left"><p>Noted</p></br>
			  	 	<p align="left"><b><u>RICHARD A. SEVILLA</u></b></br>
			  	    RITO I-Pantawid</p></td>
	</tr>
	</table>
</div>
<?php } ?>
<?php } ?>
</div>
</script>

</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ta_report2_list->Recordset)
	$ta_report2_list->Recordset->Close();
?>
<?php if (!$ta_report2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ta_report2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ta_report2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ta_report2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ta_report2_list->TotalRecords == 0 && !$ta_report2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ta_report2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($ta_report2->Rows) ?> };
	ew.applyTemplate("tpd_ta_report2list", "tpm_ta_report2list", "ta_report2list", "<?php echo $ta_report2->CustomExport ?>", ew.templateData);
	$("script.ta_report2list_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$ta_report2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ta_report2_list->isExport()) { ?>
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
$ta_report2_list->terminate();
?>