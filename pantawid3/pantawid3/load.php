<?php
namespace PHPMaker2020\pantawid2020;
$RELATIVE_PATH = "../";

// Autoload
include_once $RELATIVE_PATH . "autoload.php";

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
$load = new load();

// Run the page
$load->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once $RELATIVE_PATH . "header.php"; ?>
<div class="container">
	<form method="POST" action="excelUpload.php" enctype="multipart/form-data">
		<div class="form-group">
			<label>Upload Excel File</label>
			<input type="file" name="file" class="form-control">
		</div>
		<div class="form-group">
			<button type="submit" name="Submit" class="btn btn-success">Upload</button>
		</div>
	</form>
</div>


<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once $RELATIVE_PATH . "footer.php"; ?>
<?php
$load->terminate();
?>