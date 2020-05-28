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
$inventory_chart2_summary = new inventory_chart2_summary();

// Run the page
$inventory_chart2_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventory_chart2_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$inventory_chart2_summary->isExport() && !$inventory_chart2_summary->DrillDown && !$DashboardReport) { ?>
<script>
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$inventory_chart2_summary->DrillDownInPanel) {
	$inventory_chart2_summary->ExportOptions->render("body");
	$inventory_chart2_summary->SearchOptions->render("body");
	$inventory_chart2_summary->FilterOptions->render("body");
}
?>
</div>
<?php $inventory_chart2_summary->showPageHeader(); ?>
<?php
$inventory_chart2_summary->showMessage();
?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Left Container -->
<div id="ew-left" class="<?php echo $inventory_chart2_summary->LeftContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($inventory_chart2_summary->isExport("print") || $inventory_chart2_summary->isExport("pdf") || $inventory_chart2_summary->isExport("email") || $inventory_chart2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $inventory_chart2_summary->isExport("word") && Config("USE_PHPWORD")) && $inventory_chart2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$inventory_chart2_summary->Page_Breaking($inventory_chart2_summary->ExportChartPageBreak, $inventory_chart2_summary->PageBreakContent);
		$inventory_chart2->Chart2->PageBreakType = "after"; // Page break type
		$inventory_chart2->Chart2->PageBreak = $inventory_chart2_summary->ExportChartPageBreak;
		$inventory_chart2->Chart2->PageBreakContent = $inventory_chart2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$inventory_chart2->Chart2->DrillDownInPanel = $inventory_chart2_summary->DrillDownInPanel;
	$inventory_chart2->Chart2->render("ew-chart-top");
}
?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($inventory_chart2_summary->isExport("print") || $inventory_chart2_summary->isExport("pdf") || $inventory_chart2_summary->isExport("email") || $inventory_chart2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $inventory_chart2_summary->isExport("word") && Config("USE_PHPWORD")) && $inventory_chart2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$inventory_chart2_summary->Page_Breaking($inventory_chart2_summary->ExportChartPageBreak, $inventory_chart2_summary->PageBreakContent);
		$inventory_chart2->Chart3->PageBreakType = "after"; // Page break type
		$inventory_chart2->Chart3->PageBreak = $inventory_chart2_summary->ExportChartPageBreak;
		$inventory_chart2->Chart3->PageBreakContent = $inventory_chart2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$inventory_chart2->Chart3->DrillDownInPanel = $inventory_chart2_summary->DrillDownInPanel;
	$inventory_chart2->Chart3->render("ew-chart-top");
}
?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-left -->
<?php } ?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $inventory_chart2_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$inventory_chart2_summary->isExport() && !$inventory_chart2_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Right Container -->
<div id="ew-right" class="<?php echo $inventory_chart2_summary->RightContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($inventory_chart2_summary->isExport("print") || $inventory_chart2_summary->isExport("pdf") || $inventory_chart2_summary->isExport("email") || $inventory_chart2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $inventory_chart2_summary->isExport("word") && Config("USE_PHPWORD")) && $inventory_chart2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$inventory_chart2_summary->Page_Breaking($inventory_chart2_summary->ExportChartPageBreak, $inventory_chart2_summary->PageBreakContent);
		$inventory_chart2->Chart1->PageBreakType = ""; // Page break type
		$inventory_chart2->Chart1->PageBreak = $inventory_chart2_summary->ExportChartPageBreak;
		$inventory_chart2->Chart1->PageBreakContent = $inventory_chart2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$inventory_chart2->Chart1->DrillDownInPanel = $inventory_chart2_summary->DrillDownInPanel;
	$inventory_chart2->Chart1->render("ew-chart-top");
}
?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($inventory_chart2_summary->isExport("print") || $inventory_chart2_summary->isExport("pdf") || $inventory_chart2_summary->isExport("email") || $inventory_chart2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $inventory_chart2_summary->isExport("word") && Config("USE_PHPWORD")) && $inventory_chart2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$inventory_chart2_summary->Page_Breaking($inventory_chart2_summary->ExportChartPageBreak, $inventory_chart2_summary->PageBreakContent);
		$inventory_chart2->Chart4->PageBreakType = "before"; // Page break type
		$inventory_chart2->Chart4->PageBreak = $inventory_chart2_summary->ExportChartPageBreak;
		$inventory_chart2->Chart4->PageBreakContent = $inventory_chart2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$inventory_chart2->Chart4->DrillDownInPanel = $inventory_chart2_summary->DrillDownInPanel;
	$inventory_chart2->Chart4->render("ew-chart-bottom");
}
?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-right -->
<?php } ?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$inventory_chart2_summary->isExport() || $inventory_chart2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$inventory_chart2_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$inventory_chart2_summary->isExport() && !$inventory_chart2_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$inventory_chart2_summary->terminate();
?>