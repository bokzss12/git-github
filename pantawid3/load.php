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
$load = new load();

// Run the page
$load->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
</head>
	<body>
		<div class='container'>
			<img src='ahol.PNG' alt='Norway' style='width:100%;'>
			<div id='auto' class='data1'></div>
			<div id='auto' class='data2'></div>
			<div id='auto' class='data3'></div>
			<div id='auto' class='data4'></div>
		</div>
	</body>
</html>


<script>
$(function() {
	startRefresh();
});

function startRefresh() {

	setTimeout(startRefresh,1000);
	$.get('refresh.php', function(data) {
		$('#auto').html(data);    
	});
}

</script>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$load->terminate();
?>