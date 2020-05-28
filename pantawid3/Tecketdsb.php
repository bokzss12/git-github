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
$Tecket_dashboard = new Tecket_dashboard();

// Run the page
$Tecket_dashboard->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Tecket_dashboard->Page_Render();
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
<?php $Tecket_dashboard->showPageHeader(); ?>
<?php
$Tecket_dashboard->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard ew-vertical">
<div class="row">
<div class="<?php echo $Tecket_dashboard->ItemClassNames[0] ?>" style='min-width: 90px; min-height: 70px;'>
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
</div>
<div class="row">
<div class="<?php echo $Tecket_dashboard->ItemClassNames[1] ?>" style='min-width: 90px; min-height: 70px;'>
<div id="Item2" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Encoder_Report_1", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Encoder_Report_1smry.php"; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $Tecket_dashboard->ItemClassNames[2] ?>" style='min-width: 90px; min-height: 70px;'>
<div id="Item3" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Printing_Report_1", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Printing_Report_1smry.php"; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $Tecket_dashboard->ItemClassNames[3] ?>" style='min-width: 90px; min-height: 70px;'>
<div id="Item4" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Inventory_Report_1", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Inventory_Report_1smry.php"; ?>
</div>
</div>
</div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Tecket_dashboard->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$Tecket_dashboard->terminate();
?>