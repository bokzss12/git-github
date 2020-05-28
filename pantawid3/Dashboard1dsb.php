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
$Dashboard1_dashboard = new Dashboard1_dashboard();

// Run the page
$Dashboard1_dashboard->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Dashboard1_dashboard->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdashboard, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "dashboard";
	fdashboard = currentForm = new ew.Form("fdashboard", "dashboard");
	loadjs.done("fdashboard");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar"></div>
<?php $Dashboard1_dashboard->showPageHeader(); ?>
<?php
$Dashboard1_dashboard->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard ew-horizontal">
<div class="row">
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[0] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item1" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Ticket_report", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Ticket_reportsmry.php"; ?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[1] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item2" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("for_charting2", "Chart1", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$for_charting2->Chart1->Width = 500;
$for_charting2->Chart1->Height = 500;
$for_charting2->Chart1->setParameter("clickurl", "for_charting2smry.php"); // Add click URL
$for_charting2->Chart1->DrillDownUrl = ""; // No drill down for dashboard
$for_charting2->Chart1->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[2] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item3" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("for_charting2", "Chart2", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$for_charting2->Chart2->Width = 500;
$for_charting2->Chart2->Height = 500;
$for_charting2->Chart2->setParameter("clickurl", "for_charting2smry.php"); // Add click URL
$for_charting2->Chart2->DrillDownUrl = ""; // No drill down for dashboard
$for_charting2->Chart2->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[3] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item4" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("for_charting2", "Chart3", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$for_charting2->Chart3->Width = 500;
$for_charting2->Chart3->Height = 500;
$for_charting2->Chart3->setParameter("clickurl", "for_charting2smry.php"); // Add click URL
$for_charting2->Chart3->DrillDownUrl = ""; // No drill down for dashboard
$for_charting2->Chart3->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[4] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item5" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("for_charting2", "Chart4", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$for_charting2->Chart4->Width = 500;
$for_charting2->Chart4->Height = 500;
$for_charting2->Chart4->setParameter("clickurl", "for_charting2smry.php"); // Add click URL
$for_charting2->Chart4->DrillDownUrl = ""; // No drill down for dashboard
$for_charting2->Chart4->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[5] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item6" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("inventory_chart2", "Chart1", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$inventory_chart2->Chart1->Width = 500;
$inventory_chart2->Chart1->Height = 500;
$inventory_chart2->Chart1->setParameter("clickurl", "inventory_chart2smry.php"); // Add click URL
$inventory_chart2->Chart1->DrillDownUrl = ""; // No drill down for dashboard
$inventory_chart2->Chart1->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[6] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item7" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("inventory_chart2", "Chart2", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$inventory_chart2->Chart2->Width = 500;
$inventory_chart2->Chart2->Height = 500;
$inventory_chart2->Chart2->setParameter("clickurl", "inventory_chart2smry.php"); // Add click URL
$inventory_chart2->Chart2->DrillDownUrl = ""; // No drill down for dashboard
$inventory_chart2->Chart2->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[7] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item8" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("inventory_chart2", "Chart3", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$inventory_chart2->Chart3->Width = 500;
$inventory_chart2->Chart3->Height = 500;
$inventory_chart2->Chart3->setParameter("clickurl", "inventory_chart2smry.php"); // Add click URL
$inventory_chart2->Chart3->DrillDownUrl = ""; // No drill down for dashboard
$inventory_chart2->Chart3->render("ew-chart-top");
?>
</div>
</div>
</div>
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[8] ?>" style='min-width: 550px; min-height: 520px;'>
<div id="Item9" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("inventory_chart2", "Chart4", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$inventory_chart2->Chart4->Width = 500;
$inventory_chart2->Chart4->Height = 500;
$inventory_chart2->Chart4->setParameter("clickurl", "inventory_chart2smry.php"); // Add click URL
$inventory_chart2->Chart4->DrillDownUrl = ""; // No drill down for dashboard
$inventory_chart2->Chart4->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Dashboard1_dashboard->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	setTimeout(function(){location.reload()},1e4);
});
</script>
<?php include_once "footer.php"; ?>
<?php
$Dashboard1_dashboard->terminate();
?>