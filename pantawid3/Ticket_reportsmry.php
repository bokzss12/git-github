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
$Ticket_report_summary = new Ticket_report_summary();

// Run the page
$Ticket_report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Ticket_report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Ticket_report_summary->isExport() && !$Ticket_report_summary->DrillDown && !$DashboardReport) { ?>
<script>
var fsummary, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fsummary = currentForm = new ew.Form("fsummary", "summary");
	currentPageID = ew.PAGE_ID = "summary";

	// Validate function for search
	fsummary.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fsummary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsummary.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsummary.lists["x_status_desc"] = <?php echo $Ticket_report_summary->status_desc->Lookup->toClientList($Ticket_report_summary) ?>;
	fsummary.lists["x_status_desc"].options = <?php echo JsonEncode($Ticket_report_summary->status_desc->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Ticket_report_summary->getFilterList() ?>;
	loadjs.done("fsummary");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Ticket_report_summary->isExport() || $Ticket_report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Ticket_report_summary->ShowCurrentFilter) { ?>
<?php $Ticket_report_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Ticket_report_summary->DrillDownInPanel) {
	$Ticket_report_summary->ExportOptions->render("body");
	$Ticket_report_summary->SearchOptions->render("body");
	$Ticket_report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Ticket_report_summary->showPageHeader(); ?>
<?php
$Ticket_report_summary->showMessage();
?>
<?php if ((!$Ticket_report_summary->isExport() || $Ticket_report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Ticket_report_summary->isExport() || $Ticket_report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Ticket_report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Ticket_report_summary->isExport() && !$Ticket_report_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Ticket_report_summary->isExport() && !$Ticket_report->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Ticket_report_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Ticket_report">
	<div class="ew-extended-search">
<?php

// Render search row
$Ticket_report->RowType = ROWTYPE_SEARCH;
$Ticket_report->resetAttributes();
$Ticket_report_summary->renderRow();
?>
<?php if ($Ticket_report_summary->status_desc->Visible) { // status_desc ?>
	<?php
		$Ticket_report_summary->SearchColumnCount++;
		if (($Ticket_report_summary->SearchColumnCount - 1) % $Ticket_report_summary->SearchFieldsPerRow == 0) {
			$Ticket_report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Ticket_report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_status_desc" class="ew-cell form-group">
		<label for="x_status_desc" class="ew-search-caption ew-label"><?php echo $Ticket_report_summary->status_desc->caption() ?></label>
		<span id="el_Ticket_report_status_desc" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Ticket_report" data-field="x_status_desc" data-value-separator="<?php echo $Ticket_report_summary->status_desc->displayValueSeparatorAttribute() ?>" id="x_status_desc" name="x_status_desc"<?php echo $Ticket_report_summary->status_desc->editAttributes() ?>>
			<?php echo $Ticket_report_summary->status_desc->selectOptionListHtml("x_status_desc") ?>
		</select>
</div>
<?php echo $Ticket_report_summary->status_desc->Lookup->getParamTag($Ticket_report_summary, "p_x_status_desc") ?>
</span>
	</div>
	<?php if ($Ticket_report_summary->SearchColumnCount % $Ticket_report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Ticket_report_summary->SearchColumnCount % $Ticket_report_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Ticket_report_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Ticket_report_summary->GroupCount <= count($Ticket_report_summary->GroupRecords) && $Ticket_report_summary->GroupCount <= $Ticket_report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Ticket_report_summary->ShowHeader) {
?>
<?php if ($Ticket_report_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<script id="tpb<?php echo $Ticket_report_summary->GroupCount - 1 ?>_Ticket_report" type="text/html"><?php echo $Ticket_report_summary->PageBreakContent ?></script>
<?php } ?>
<div class="<?php if (!$Ticket_report_summary->isExport("word") && !$Ticket_report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Ticket_report_summary->ReportTableStyle ?>>
<!-- Report grid (begin) -->
<div id="gmp_Ticket_report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Ticket_report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Ticket_report_summary->status_desc->Visible) { ?>
	<?php if ($Ticket_report_summary->status_desc->ShowGroupHeaderAsRow) { ?>
	<th data-name="status_desc"><script id="tpc_Ticket_report_status_desc" type="text/html">&nbsp;</script></th>
	<?php } else { ?>
		<?php if ($Ticket_report_summary->sortUrl($Ticket_report_summary->status_desc) == "") { ?>
	<th data-name="status_desc" class="<?php echo $Ticket_report_summary->status_desc->headerCellClass() ?>"><script id="tpc_Ticket_report_status_desc" type="text/html"><div class="Ticket_report_status_desc"><div class="ew-table-header-caption"><?php echo $Ticket_report_summary->status_desc->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="status_desc" class="<?php echo $Ticket_report_summary->status_desc->headerCellClass() ?>"><script id="tpc_Ticket_report_status_desc" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Ticket_report_summary->sortUrl($Ticket_report_summary->status_desc) ?>', 1);"><div class="Ticket_report_status_desc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Ticket_report_summary->status_desc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Ticket_report_summary->status_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Ticket_report_summary->status_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Ticket_report_summary->item_id->Visible) { ?>
	<th data-name="item_id" class="<?php echo $Ticket_report_summary->item_id->headerCellClass() ?>"><script id="tpc_Ticket_report_item_id" type="text/html"><div class="ew-table-header-btn"><div class="ew-table-header-caption"><?php echo $Ticket_report_summary->item_id->caption() ?> (<?php echo $Language->phrase("RptCnt") ?>)</div></div></script></th>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Ticket_report_summary->TotalGroups == 0)
			break; // Show header only
		$Ticket_report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Ticket_report_summary->status_desc, $Ticket_report_summary->getSqlFirstGroupField(), $Ticket_report_summary->status_desc->groupValue(), $Ticket_report_summary->Dbid);
	if ($Ticket_report_summary->PageFirstGroupFilter != "") $Ticket_report_summary->PageFirstGroupFilter .= " OR ";
	$Ticket_report_summary->PageFirstGroupFilter .= $where;
	if ($Ticket_report_summary->Filter != "")
		$where = "($Ticket_report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Ticket_report_summary->getSqlSelect(), $Ticket_report_summary->getSqlWhere(), $Ticket_report_summary->getSqlGroupBy(), $Ticket_report_summary->getSqlHaving(), $Ticket_report_summary->getSqlOrderBy(), $where, $Ticket_report_summary->Sort);
	$rs = $Ticket_report_summary->getRecordset($sql);
	$Ticket_report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Ticket_report_summary->DetailRecordCount = count($Ticket_report_summary->DetailRecords);
	$Ticket_report_summary->setGroupCount($Ticket_report_summary->DetailRecordCount, $Ticket_report_summary->GroupCount);

	// Load detail records
	$Ticket_report_summary->status_desc->Records = &$Ticket_report_summary->DetailRecords;
	$Ticket_report_summary->status_desc->LevelBreak = TRUE; // Set field level break
		$Ticket_report_summary->GroupCounter[1] = $Ticket_report_summary->GroupCount;
		$Ticket_report_summary->status_desc->getCnt($Ticket_report_summary->status_desc->Records); // Get record count
		$Ticket_report_summary->setGroupCount($Ticket_report_summary->status_desc->Count, $Ticket_report_summary->GroupCounter[1]);
?>
<?php if ($Ticket_report_summary->status_desc->Visible && $Ticket_report_summary->status_desc->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Ticket_report_summary->resetAttributes();
		$Ticket_report_summary->RowType = ROWTYPE_TOTAL;
		$Ticket_report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Ticket_report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Ticket_report_summary->RowGroupLevel = 1;
		$Ticket_report_summary->renderRow();
?>
	<tr<?php echo $Ticket_report_summary->rowAttributes(); ?>>
<?php if ($Ticket_report_summary->status_desc->Visible) { ?>
		<td data-field="status_desc"<?php echo $Ticket_report_summary->status_desc->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="status_desc" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Ticket_report_summary->status_desc->cellAttributes() ?>>
<?php if ($Ticket_report_summary->sortUrl($Ticket_report_summary->status_desc) == "") { ?>
		<span class="ew-summary-caption Ticket_report_status_desc"><span class="ew-table-header-caption"><?php echo $Ticket_report_summary->status_desc->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Ticket_report_status_desc" onclick="ew.sort(event, '<?php echo $Ticket_report_summary->sortUrl($Ticket_report_summary->status_desc) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Ticket_report_summary->status_desc->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Ticket_report_summary->status_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Ticket_report_summary->status_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_Ticket_report_status_desc" type="text/html"><span<?php echo $Ticket_report_summary->status_desc->viewAttributes() ?>><?php echo $Ticket_report_summary->status_desc->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Ticket_report_summary->status_desc->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Ticket_report_summary->RecordCount = 0; // Reset record count
	foreach ($Ticket_report_summary->status_desc->Records as $record) {
		$Ticket_report_summary->RecordCount++;
		$Ticket_report_summary->RecordIndex++;
		$Ticket_report_summary->loadRowValues($record);
?>
<?php
	}
?>
<?php if ($Ticket_report_summary->TotalGroups > 0) { ?>
<?php
	$Ticket_report_summary->item_id->getCnt($Ticket_report_summary->status_desc->Records); // Get Cnt
	$Ticket_report_summary->resetAttributes();
	$Ticket_report_summary->RowType = ROWTYPE_TOTAL;
	$Ticket_report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Ticket_report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Ticket_report_summary->RowGroupLevel = 1;
	$Ticket_report_summary->renderRow();
?>
	<tr<?php echo $Ticket_report_summary->rowAttributes(); ?>>
<?php if ($Ticket_report_summary->status_desc->Visible) { ?>
		<td data-field="status_desc"<?php echo $Ticket_report_summary->status_desc->cellAttributes() ?>><script id="tpx<?php echo $Page->GroupCount ?>_Ticket_report_status_desc" type="text/html"><span<?php echo $Ticket_report_summary->status_desc->viewAttributes() ?>><?php echo $Ticket_report_summary->status_desc->GroupViewValue ?></span></script>&nbsp;<span class="ew-detail-count">(<?php echo FormatNumber($Ticket_report_summary->status_desc->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
<?php if ($Ticket_report_summary->item_id->Visible) { ?>
		<td data-field="item_id"<?php echo $Ticket_report_summary->item_id->cellAttributes() ?>>
<script id="tpgc<?php echo $Page->GroupCount ?>_Ticket_report_item_id" type="text/html">
<span<?php echo $Ticket_report_summary->item_id->viewAttributes() ?>><?php echo $Ticket_report_summary->item_id->CntViewValue ?></span>
</script>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Ticket_report_summary->loadGroupRowValues();

	// Show header if page break
	if ($Ticket_report_summary->isExport())
		$Ticket_report_summary->ShowHeader = ($Ticket_report_summary->ExportPageBreakCount == 0) ? FALSE : ($Ticket_report_summary->GroupCount % $Ticket_report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Ticket_report_summary->ShowHeader)
		$Ticket_report_summary->Page_Breaking($Ticket_report_summary->ShowHeader, $Ticket_report_summary->PageBreakContent);
	$Ticket_report_summary->GroupCount++;
} // End while
?>
<?php if ($Ticket_report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<?php if ($Ticket_report_summary->isExport() || $Ticket_report_summary->UseCustomTemplate) { ?>
<div id="tpd_Ticket_reportsummary"></div>
<script id="tpm_Ticket_reportsummary" type="text/html">
<div id="ct_Ticket_report_summary"><table style="height: 148px; border-color: yellow; background-color: blue; margin-left: auto; margin-right: auto;" border="6" width="395" cellspacing="5" cellpadding="5">
<?php
$cnt = $Page->GroupCount - 1;
for ($i = 1; $i <= $cnt; $i++) {
?>

<?php
for ($j = 1; $j <= $Page->getGroupCount($i); $j++) {
?>
  <!--<div id="auto"></div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <div class="container" id="auto"></div>  -->
<?php
}
?>
<tr>
<td style="width: 384.533px; background-color: blue; border-color: green; text-align: center;">
<h1><span style="color: #ffffff;"><font size="50">{{include tmpl=~getTemplate("#tpgc<?php echo $i ?>_Ticket_report_item_id")/}}</span></h1>
</td>
</tr>
<?php
if ($Page->ExportPageBreakCount > 0 && $Page->isExport()) {
if ($i % $Page->ExportPageBreakCount == 0 && $i < $cnt) {
?>
{{include tmpl=~getTemplate("#tpb<?php echo $i ?>_Ticket_report")/}}
<?php
}
}
}
?>
</div>
</script>

<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Ticket_report_summary->isExport() || $Ticket_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Ticket_report_summary->isExport() || $Ticket_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Ticket_report_summary->isExport() || $Ticket_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($Ticket_report->Rows) ?> };
	ew.applyTemplate("tpd_Ticket_reportsummary", "tpm_Ticket_reportsummary", "Ticket_reportsummary", "<?php echo $Ticket_report->CustomExport ?>", ew.templateData.rows[0]);
	$("script.Ticket_reportsummary_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$Ticket_report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Ticket_report_summary->isExport() && !$Ticket_report_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

	/*
	setTimeout(function() {   //refresh whole page
	  location.reload();
	}, 1000); */
	//add sidebar-collapse classs to the body, this forces admin lte to collapse navbar.
	//===============working script==========

	/*$(function() {
		startRefresh();
	});
	function startRefresh() {
		setTimeout(startRefresh,1000);
		$.get('refresh.php', function(data) {
			$('#auto').html(data);    
		});
	}
	*/
	 //html:
	 //body
	 //used; <div id="auto"></div>
	 //create php: load.php file

	/*
	$("body").addClass("sidebar-collapse"); // collapse
	function refreshTable() {
	tableRefresh = setInterval(function() {
	$('table.ew-table > tbody').load(location.href + ' table.ew-table > tbody tr', function() {
	$(this).find('tr:even').removeClass('ew-table-alt-row').addClass('ew-table-row');
	$(this).find('tr:odd').removeClass('ew-table-row').addClass('ew-table-alt-row');
	});
	}, 3000); // Change this value as appropriate to set the refresh period ... 1000 = 1 second
	}
	refreshTable();
	*/
});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$Ticket_report_summary->terminate();
?>