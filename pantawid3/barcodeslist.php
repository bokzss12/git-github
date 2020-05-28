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
$barcodes_list = new barcodes_list();

// Run the page
$barcodes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$barcodes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$barcodes_list->isExport()) { ?>
<script>
var fbarcodeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbarcodeslist = currentForm = new ew.Form("fbarcodeslist", "list");
	fbarcodeslist.formKeyCountName = '<?php echo $barcodes_list->FormKeyCountName ?>';
	loadjs.done("fbarcodeslist");
});
var fbarcodeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbarcodeslistsrch = currentSearchForm = new ew.Form("fbarcodeslistsrch");

	// Dynamic selection lists
	// Filters

	fbarcodeslistsrch.filterList = <?php echo $barcodes_list->getFilterList() ?>;
	loadjs.done("fbarcodeslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$barcodes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($barcodes_list->TotalRecords > 0 && $barcodes_list->ExportOptions->visible()) { ?>
<?php $barcodes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($barcodes_list->ImportOptions->visible()) { ?>
<?php $barcodes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($barcodes_list->SearchOptions->visible()) { ?>
<?php $barcodes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($barcodes_list->FilterOptions->visible()) { ?>
<?php $barcodes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$barcodes_list->renderOtherOptions();
?>
<?php $barcodes_list->showPageHeader(); ?>
<?php
$barcodes_list->showMessage();
?>
<?php if ($barcodes_list->TotalRecords > 0 || $barcodes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($barcodes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> barcodes">
<form name="fbarcodeslist" id="fbarcodeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="barcodes">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_barcodes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($barcodes_list->TotalRecords > 0 || $barcodes_list->isGridEdit()) { ?>
<table id="tbl_barcodeslist" class="table ew-table d-none"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$barcodes->RowType = ROWTYPE_HEADER;

// Render list options
$barcodes_list->renderListOptions();

// Render list options (header, left)
$barcodes_list->ListOptions->render("header", "left", "", "block", $barcodes->TableVar, "barcodeslist");
?>
<?php if ($barcodes_list->inventory_id->Visible) { // inventory_id ?>
	<?php if ($barcodes_list->SortUrl($barcodes_list->inventory_id) == "") { ?>
		<th data-name="inventory_id" class="<?php echo $barcodes_list->inventory_id->headerCellClass() ?>"><div id="elh_barcodes_inventory_id" class="barcodes_inventory_id"><div class="ew-table-header-caption"><script id="tpc_barcodes_inventory_id" type="text/html"><?php echo $barcodes_list->inventory_id->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="inventory_id" class="<?php echo $barcodes_list->inventory_id->headerCellClass() ?>"><script id="tpc_barcodes_inventory_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barcodes_list->SortUrl($barcodes_list->inventory_id) ?>', 1);"><div id="elh_barcodes_inventory_id" class="barcodes_inventory_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barcodes_list->inventory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($barcodes_list->inventory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barcodes_list->inventory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($barcodes_list->concat_id->Visible) { // concat_id ?>
	<?php if ($barcodes_list->SortUrl($barcodes_list->concat_id) == "") { ?>
		<th data-name="concat_id" class="<?php echo $barcodes_list->concat_id->headerCellClass() ?>"><div id="elh_barcodes_concat_id" class="barcodes_concat_id"><div class="ew-table-header-caption"><script id="tpc_barcodes_concat_id" type="text/html"><?php echo $barcodes_list->concat_id->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="concat_id" class="<?php echo $barcodes_list->concat_id->headerCellClass() ?>"><script id="tpc_barcodes_concat_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barcodes_list->SortUrl($barcodes_list->concat_id) ?>', 1);"><div id="elh_barcodes_concat_id" class="barcodes_concat_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barcodes_list->concat_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($barcodes_list->concat_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barcodes_list->concat_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($barcodes_list->item_serial->Visible) { // item_serial ?>
	<?php if ($barcodes_list->SortUrl($barcodes_list->item_serial) == "") { ?>
		<th data-name="item_serial" class="<?php echo $barcodes_list->item_serial->headerCellClass() ?>"><div id="elh_barcodes_item_serial" class="barcodes_item_serial"><div class="ew-table-header-caption"><script id="tpc_barcodes_item_serial" type="text/html"><?php echo $barcodes_list->item_serial->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_serial" class="<?php echo $barcodes_list->item_serial->headerCellClass() ?>"><script id="tpc_barcodes_item_serial" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barcodes_list->SortUrl($barcodes_list->item_serial) ?>', 1);"><div id="elh_barcodes_item_serial" class="barcodes_item_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barcodes_list->item_serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($barcodes_list->item_serial->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barcodes_list->item_serial->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($barcodes_list->Year_Purchased->Visible) { // Year_Purchased ?>
	<?php if ($barcodes_list->SortUrl($barcodes_list->Year_Purchased) == "") { ?>
		<th data-name="Year_Purchased" class="<?php echo $barcodes_list->Year_Purchased->headerCellClass() ?>"><div id="elh_barcodes_Year_Purchased" class="barcodes_Year_Purchased"><div class="ew-table-header-caption"><script id="tpc_barcodes_Year_Purchased" type="text/html"><?php echo $barcodes_list->Year_Purchased->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="Year_Purchased" class="<?php echo $barcodes_list->Year_Purchased->headerCellClass() ?>"><script id="tpc_barcodes_Year_Purchased" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barcodes_list->SortUrl($barcodes_list->Year_Purchased) ?>', 1);"><div id="elh_barcodes_Year_Purchased" class="barcodes_Year_Purchased">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barcodes_list->Year_Purchased->caption() ?></span><span class="ew-table-header-sort"><?php if ($barcodes_list->Year_Purchased->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barcodes_list->Year_Purchased->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($barcodes_list->item_model->Visible) { // item_model ?>
	<?php if ($barcodes_list->SortUrl($barcodes_list->item_model) == "") { ?>
		<th data-name="item_model" class="<?php echo $barcodes_list->item_model->headerCellClass() ?>"><div id="elh_barcodes_item_model" class="barcodes_item_model"><div class="ew-table-header-caption"><script id="tpc_barcodes_item_model" type="text/html"><?php echo $barcodes_list->item_model->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="item_model" class="<?php echo $barcodes_list->item_model->headerCellClass() ?>"><script id="tpc_barcodes_item_model" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barcodes_list->SortUrl($barcodes_list->item_model) ?>', 1);"><div id="elh_barcodes_item_model" class="barcodes_item_model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barcodes_list->item_model->caption() ?></span><span class="ew-table-header-sort"><?php if ($barcodes_list->item_model->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barcodes_list->item_model->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($barcodes_list->office_id->Visible) { // office_id ?>
	<?php if ($barcodes_list->SortUrl($barcodes_list->office_id) == "") { ?>
		<th data-name="office_id" class="<?php echo $barcodes_list->office_id->headerCellClass() ?>"><div id="elh_barcodes_office_id" class="barcodes_office_id"><div class="ew-table-header-caption"><script id="tpc_barcodes_office_id" type="text/html"><?php echo $barcodes_list->office_id->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="office_id" class="<?php echo $barcodes_list->office_id->headerCellClass() ?>"><script id="tpc_barcodes_office_id" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barcodes_list->SortUrl($barcodes_list->office_id) ?>', 1);"><div id="elh_barcodes_office_id" class="barcodes_office_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barcodes_list->office_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($barcodes_list->office_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barcodes_list->office_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($barcodes_list->name_accountable->Visible) { // name_accountable ?>
	<?php if ($barcodes_list->SortUrl($barcodes_list->name_accountable) == "") { ?>
		<th data-name="name_accountable" class="<?php echo $barcodes_list->name_accountable->headerCellClass() ?>"><div id="elh_barcodes_name_accountable" class="barcodes_name_accountable"><div class="ew-table-header-caption"><script id="tpc_barcodes_name_accountable" type="text/html"><?php echo $barcodes_list->name_accountable->caption() ?></script></div></div></th>
	<?php } else { ?>
		<th data-name="name_accountable" class="<?php echo $barcodes_list->name_accountable->headerCellClass() ?>"><script id="tpc_barcodes_name_accountable" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barcodes_list->SortUrl($barcodes_list->name_accountable) ?>', 1);"><div id="elh_barcodes_name_accountable" class="barcodes_name_accountable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barcodes_list->name_accountable->caption() ?></span><span class="ew-table-header-sort"><?php if ($barcodes_list->name_accountable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barcodes_list->name_accountable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$barcodes_list->ListOptions->render("header", "right", "", "block", $barcodes->TableVar, "barcodeslist");
?>
	</tr>
</thead>
<tbody>
<?php
if ($barcodes_list->ExportAll && $barcodes_list->isExport()) {
	$barcodes_list->StopRecord = $barcodes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($barcodes_list->TotalRecords > $barcodes_list->StartRecord + $barcodes_list->DisplayRecords - 1)
		$barcodes_list->StopRecord = $barcodes_list->StartRecord + $barcodes_list->DisplayRecords - 1;
	else
		$barcodes_list->StopRecord = $barcodes_list->TotalRecords;
}
$barcodes_list->RecordCount = $barcodes_list->StartRecord - 1;
if ($barcodes_list->Recordset && !$barcodes_list->Recordset->EOF) {
	$barcodes_list->Recordset->moveFirst();
	$selectLimit = $barcodes_list->UseSelectLimit;
	if (!$selectLimit && $barcodes_list->StartRecord > 1)
		$barcodes_list->Recordset->move($barcodes_list->StartRecord - 1);
} elseif (!$barcodes->AllowAddDeleteRow && $barcodes_list->StopRecord == 0) {
	$barcodes_list->StopRecord = $barcodes->GridAddRowCount;
}

// Initialize aggregate
$barcodes->RowType = ROWTYPE_AGGREGATEINIT;
$barcodes->resetAttributes();
$barcodes_list->renderRow();
while ($barcodes_list->RecordCount < $barcodes_list->StopRecord) {
	$barcodes_list->RecordCount++;
	if ($barcodes_list->RecordCount >= $barcodes_list->StartRecord) {
		$barcodes_list->RowCount++;

		// Set up key count
		$barcodes_list->KeyCount = $barcodes_list->RowIndex;

		// Init row class and style
		$barcodes->resetAttributes();
		$barcodes->CssClass = "";
		if ($barcodes_list->isGridAdd()) {
		} else {
			$barcodes_list->loadRowValues($barcodes_list->Recordset); // Load row values
		}
		$barcodes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$barcodes->RowAttrs->merge(["data-rowindex" => $barcodes_list->RowCount, "id" => "r" . $barcodes_list->RowCount . "_barcodes", "data-rowtype" => $barcodes->RowType]);

		// Render row
		$barcodes_list->renderRow();

		// Render list options
		$barcodes_list->renderListOptions();

		// Save row and cell attributes
		$barcodes_list->Attrs[$barcodes_list->RowCount] = ["row_attrs" => $barcodes->rowAttributes(), "cell_attrs" => []];
		$barcodes_list->Attrs[$barcodes_list->RowCount]["cell_attrs"] = $barcodes->fieldCellAttributes();
?>
	<tr <?php echo $barcodes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$barcodes_list->ListOptions->render("body", "left", $barcodes_list->RowCount, "block", $barcodes->TableVar, "barcodeslist");
?>
	<?php if ($barcodes_list->inventory_id->Visible) { // inventory_id ?>
		<td data-name="inventory_id" <?php echo $barcodes_list->inventory_id->cellAttributes() ?>>
<script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_inventory_id" type="text/html"><span id="el<?php echo $barcodes_list->RowCount ?>_barcodes_inventory_id">
<span<?php echo $barcodes_list->inventory_id->viewAttributes() ?>><?php echo $barcodes_list->inventory_id->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($barcodes_list->concat_id->Visible) { // concat_id ?>
		<td data-name="concat_id" <?php echo $barcodes_list->concat_id->cellAttributes() ?>>
<script id="orig<?php echo $barcodes_list->RowCount ?>_barcodes_concat_id" class="barcodeslist" type="text/html">
<?php echo $barcodes_list->concat_id->getViewValue() ?>
</script><script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_concat_id" class="barcodeslist" type="text/html">
<?php echo Barcode()->show($barcodes_list->concat_id->CurrentValue, 'CODE128', 60) ?>
</script>
<script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_concat_id" type="text/html"><span id="el<?php echo $barcodes_list->RowCount ?>_barcodes_concat_id">
<span<?php echo $barcodes_list->concat_id->viewAttributes() ?>>{{include tmpl=~getTemplate("#tpx<?php echo $barcodes_list->RowCount ?>_barcodes_concat_id")/}}</span>
</span></script>
</td>
	<?php } ?>
	<?php if ($barcodes_list->item_serial->Visible) { // item_serial ?>
		<td data-name="item_serial" <?php echo $barcodes_list->item_serial->cellAttributes() ?>>
<script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_item_serial" type="text/html"><span id="el<?php echo $barcodes_list->RowCount ?>_barcodes_item_serial">
<span<?php echo $barcodes_list->item_serial->viewAttributes() ?>><?php echo $barcodes_list->item_serial->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($barcodes_list->Year_Purchased->Visible) { // Year_Purchased ?>
		<td data-name="Year_Purchased" <?php echo $barcodes_list->Year_Purchased->cellAttributes() ?>>
<script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_Year_Purchased" type="text/html"><span id="el<?php echo $barcodes_list->RowCount ?>_barcodes_Year_Purchased">
<span<?php echo $barcodes_list->Year_Purchased->viewAttributes() ?>><?php echo $barcodes_list->Year_Purchased->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($barcodes_list->item_model->Visible) { // item_model ?>
		<td data-name="item_model" <?php echo $barcodes_list->item_model->cellAttributes() ?>>
<script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_item_model" type="text/html"><span id="el<?php echo $barcodes_list->RowCount ?>_barcodes_item_model">
<span<?php echo $barcodes_list->item_model->viewAttributes() ?>><?php echo $barcodes_list->item_model->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($barcodes_list->office_id->Visible) { // office_id ?>
		<td data-name="office_id" <?php echo $barcodes_list->office_id->cellAttributes() ?>>
<script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_office_id" type="text/html"><span id="el<?php echo $barcodes_list->RowCount ?>_barcodes_office_id">
<span<?php echo $barcodes_list->office_id->viewAttributes() ?>><?php echo $barcodes_list->office_id->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
	<?php if ($barcodes_list->name_accountable->Visible) { // name_accountable ?>
		<td data-name="name_accountable" <?php echo $barcodes_list->name_accountable->cellAttributes() ?>>
<script id="tpx<?php echo $barcodes_list->RowCount ?>_barcodes_name_accountable" type="text/html"><span id="el<?php echo $barcodes_list->RowCount ?>_barcodes_name_accountable">
<span<?php echo $barcodes_list->name_accountable->viewAttributes() ?>><?php echo $barcodes_list->name_accountable->getViewValue() ?></span>
</span></script>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$barcodes_list->ListOptions->render("body", "right", $barcodes_list->RowCount, "block", $barcodes->TableVar, "barcodeslist");
?>
	</tr>
<?php
	}
	if (!$barcodes_list->isGridAdd())
		$barcodes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$barcodes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<div id="tpd_barcodeslist" class="ew-custom-template"></div>
<script id="tpm_barcodeslist" type="text/html">
<div id="ct_barcodes_list"><?php if ($barcodes_list->RowCount > 0) { ?>
<div style="margin-left:0px">
		<table width="100%" cellpadding="0" border="0" border-collapse="0">
<tr>
			  <td width="0%" align="left"><p></p>
		<td width="0%" align="left"><p><b>Date Issued:</b>    <?php echo date("F j, Y"); ?></p>
	</tr>
	</table>
</div>
 <!--<p align="left"><?php echo date("F j, Y"); ?></p>-->
<Center><font size="2">Department of Social Welfare and Development</font></Center>
<Center><font size="2">Field Office VI</font></Center>
<Center><font size="2">Pantawid Pamilyang Pilipino Program</font></Center>
<Center><b><font size="2">Pantawid Inventory</font></Center>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 268px">
<colgroup>
<!--<col style="width: 150px">
<col style="width: 400px">-->
<col style="width: 150px">
<col style="width: 210px">
</colgroup>
<?php for ($i = $barcodes_list->StartRowCount; $i <= $barcodes_list->RowCount; $i++) { ?>
<tr>
	<th class="tg-0lax"><span style="font-weight:bold">Barcode:</span><br></th>
	<th class="tg-0lax">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_barcodes_concat_id")/}}</th>
  </tr>
  <tr>
	<td class="tg-0lax"><span style="font-weight:bold">Serial No.:</span></td>
	<td class="tg-0lax">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_barcodes_item_serial")/}}</td>
  </tr>
  <tr>
	<td class="tg-0lax"><span style="font-weight:bold">Year purchased:</span></td>
	<td class="tg-0lax">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_barcodes_Year_Purchased")/}}</td>
  </tr>
  <tr>
	<td class="tg-0lax"><span style="font-weight:bold">Model:</span></td>
	<td class="tg-0lax">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_barcodes_item_model")/}}</td>
  </tr>
  <tr>
	<td class="tg-0lax"><span style="font-weight:bold">Office:</span></td>
	<td class="tg-0lax">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_barcodes_office_id")/}}</td>
  </tr>
  <tr>
	<td class="tg-0lax"><span style="font-weight:bold">Issued to:</span></td>
	<td class="tg-0lax">{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_barcodes_name_accountable")/}}</td>
  </tr>
</table>

<?php } ?>
<?php if ($barcodes_list->TotalRecords > 0 && !$barcodes->isGridAdd() && !$barcodes->isGridEdit()) { ?>
<div style="margin-left:0px">
		<table width="100%" cellpadding="0" border="0" border-collapse="0">
<tr>
				<td width="0%" align="left"><p></p>
				<td width="0%" align="left"><p>COA Representative:</p></br>
			  	 	<p align="left"><b><u>________________</u></b></br>  
			  	    COA Staff</p></td>
			  	<td width="0%" align="left"><p></p>
			  	<td width="0%" align="left"><p>Agency Representative:</p></br>
			  	 	<p align="left"><b><u>___________________</u></b></br>
			  	    Agency Staff</p></td>
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
if ($barcodes_list->Recordset)
	$barcodes_list->Recordset->Close();
?>
<?php if (!$barcodes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<div class="ew-list-other-options">
<?php $barcodes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($barcodes_list->TotalRecords == 0 && !$barcodes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $barcodes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($barcodes->Rows) ?> };
	ew.applyTemplate("tpd_barcodeslist", "tpm_barcodeslist", "barcodeslist", "<?php echo $barcodes->CustomExport ?>", ew.templateData);
	$("script.barcodeslist_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$barcodes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$barcodes_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// document.write("page loaded");
	//$("a[data-caption='Printer Friendly']").attr("target","blank")

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$barcodes_list->terminate();
?>