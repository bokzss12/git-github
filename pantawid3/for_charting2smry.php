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
$for_charting2_summary = new for_charting2_summary();

// Run the page
$for_charting2_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$for_charting2_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$for_charting2_summary->isExport() && !$for_charting2_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$for_charting2_summary->DrillDownInPanel) {
	$for_charting2_summary->ExportOptions->render("body");
	$for_charting2_summary->SearchOptions->render("body");
	$for_charting2_summary->FilterOptions->render("body");
}
?>
</div>
<?php $for_charting2_summary->showPageHeader(); ?>
<?php
$for_charting2_summary->showMessage();
?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Left Container -->
<div id="ew-left" class="<?php echo $for_charting2_summary->LeftContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($for_charting2_summary->isExport("print") || $for_charting2_summary->isExport("pdf") || $for_charting2_summary->isExport("email") || $for_charting2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $for_charting2_summary->isExport("word") && Config("USE_PHPWORD")) && $for_charting2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$for_charting2_summary->Page_Breaking($for_charting2_summary->ExportChartPageBreak, $for_charting2_summary->PageBreakContent);
		$for_charting2->Chart1->PageBreakType = "after"; // Page break type
		$for_charting2->Chart1->PageBreak = $for_charting2_summary->ExportChartPageBreak;
		$for_charting2->Chart1->PageBreakContent = $for_charting2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$for_charting2->Chart1->DrillDownInPanel = $for_charting2_summary->DrillDownInPanel;
	$for_charting2->Chart1->render("ew-chart-top");
}
?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($for_charting2_summary->isExport("print") || $for_charting2_summary->isExport("pdf") || $for_charting2_summary->isExport("email") || $for_charting2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $for_charting2_summary->isExport("word") && Config("USE_PHPWORD")) && $for_charting2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$for_charting2_summary->Page_Breaking($for_charting2_summary->ExportChartPageBreak, $for_charting2_summary->PageBreakContent);
		$for_charting2->Chart3->PageBreakType = "after"; // Page break type
		$for_charting2->Chart3->PageBreak = $for_charting2_summary->ExportChartPageBreak;
		$for_charting2->Chart3->PageBreakContent = $for_charting2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$for_charting2->Chart3->DrillDownInPanel = $for_charting2_summary->DrillDownInPanel;
	$for_charting2->Chart3->render("ew-chart-top");
}
?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-left -->
<?php } ?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $for_charting2_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$for_charting2_summary->isExport() && !$for_charting2_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Right Container -->
<div id="ew-right" class="<?php echo $for_charting2_summary->RightContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($for_charting2_summary->isExport("print") || $for_charting2_summary->isExport("pdf") || $for_charting2_summary->isExport("email") || $for_charting2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $for_charting2_summary->isExport("word") && Config("USE_PHPWORD")) && $for_charting2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$for_charting2_summary->Page_Breaking($for_charting2_summary->ExportChartPageBreak, $for_charting2_summary->PageBreakContent);
		$for_charting2->Chart2->PageBreakType = ""; // Page break type
		$for_charting2->Chart2->PageBreak = $for_charting2_summary->ExportChartPageBreak;
		$for_charting2->Chart2->PageBreakContent = $for_charting2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$for_charting2->Chart2->DrillDownInPanel = $for_charting2_summary->DrillDownInPanel;
	$for_charting2->Chart2->render("ew-chart-top");
}
?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($for_charting2_summary->isExport("print") || $for_charting2_summary->isExport("pdf") || $for_charting2_summary->isExport("email") || $for_charting2_summary->isExport("excel") && Config("USE_PHPEXCEL") || $for_charting2_summary->isExport("word") && Config("USE_PHPWORD")) && $for_charting2_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$for_charting2_summary->Page_Breaking($for_charting2_summary->ExportChartPageBreak, $for_charting2_summary->PageBreakContent);
		$for_charting2->Chart4->PageBreakType = "before"; // Page break type
		$for_charting2->Chart4->PageBreak = $for_charting2_summary->ExportChartPageBreak;
		$for_charting2->Chart4->PageBreakContent = $for_charting2_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$for_charting2->Chart4->DrillDownInPanel = $for_charting2_summary->DrillDownInPanel;
	$for_charting2->Chart4->render("ew-chart-bottom");
}
?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-right -->
<?php } ?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$for_charting2_summary->isExport() || $for_charting2_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$for_charting2_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$for_charting2_summary->isExport() && !$for_charting2_summary->DrillDown && !$DashboardReport) { ?>
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
$for_charting2_summary->terminate();
?>