<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Class for index
 */
class index
{

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Constructor
	public function __construct() {
		$this->CheckToken = Config("CHECK_TOKEN");
	}

	// Terminate page
	public function terminate($url = "")
	{

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Page Redirecting event
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url != "") {
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	//
	// Page run
	//

	public function run()
	{
		global $Language, $UserProfile, $Security, $Breadcrumb;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// User profile
		$UserProfile = new UserProfile();

		// Security object
		$Security = new AdvancedSecurity();
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Breadcrumb
		$Breadcrumb = new Breadcrumb();

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->phrase("SessionExpired"));
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level
		if ($Security->allowList(CurrentProjectID() . 'tbl_item'))
			$this->terminate("tbl_itemlist.php"); // Exit and go to default page
		if ($Security->allowList(CurrentProjectID() . 'tbl_cat'))
			$this->terminate("tbl_catlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_item_status'))
			$this->terminate("tbl_item_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_off'))
			$this->terminate("tbl_offlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_pos'))
			$this->terminate("tbl_poslist.php");
		if ($Security->allowList(CurrentProjectID() . 'employee'))
			$this->terminate("employeelist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevelpermissions'))
			$this->terminate("userlevelpermissionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevels'))
			$this->terminate("userlevelslist.php");
		if ($Security->allowList(CurrentProjectID() . 'audittrail'))
			$this->terminate("audittraillist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_inventory'))
			$this->terminate("tbl_inventorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_inventory_status'))
			$this->terminate("tbl_inventory_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_month'))
			$this->terminate("tbl_monthlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_year'))
			$this->terminate("tbl_yearlist.php");
		if ($Security->allowList(CurrentProjectID() . 'lib_cities'))
			$this->terminate("lib_citieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'lib_provinces'))
			$this->terminate("lib_provinceslist.php");
		if ($Security->allowList(CurrentProjectID() . 'lib_regions'))
			$this->terminate("lib_regionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_barrowed_status'))
			$this->terminate("tbl_barrowed_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_borrowers'))
			$this->terminate("tbl_borrowerslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_technician'))
			$this->terminate("tbl_technicianlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_request'))
			$this->terminate("tbl_requestlist.php");
		if ($Security->allowList(CurrentProjectID() . 'Import.php'))
			$this->terminate("excel-upload/Import.php");
		if ($Security->allowList(CurrentProjectID() . 'inventory reports'))
			$this->terminate("inventory_reportslist.php");
		if ($Security->allowList(CurrentProjectID() . 'for_charting'))
			$this->terminate("for_chartinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'inventory_chart'))
			$this->terminate("inventory_chartlist.php");
		if ($Security->allowList(CurrentProjectID() . 'ta_report2'))
			$this->terminate("ta_report2list.php");
		if ($Security->allowList(CurrentProjectID() . 'ticket'))
			$this->terminate("ticketlist.php");
		if ($Security->allowList(CurrentProjectID() . 'ticket_view2'))
			$this->terminate("ticket_view2list.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_activate'))
			$this->terminate("tbl_activatelist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_encoder'))
			$this->terminate("tbl_encoderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_encoder_lactivities'))
			$this->terminate("tbl_encoder_lactivitieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_encoder_status'))
			$this->terminate("tbl_encoder_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_printing'))
			$this->terminate("tbl_printinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_printingtype'))
			$this->terminate("tbl_printingtypelist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_printing_status'))
			$this->terminate("tbl_printing_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'encoderreport1'))
			$this->terminate("encoderreport1list.php");
		if ($Security->allowList(CurrentProjectID() . 'printingreport1'))
			$this->terminate("printingreport1list.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_sup_status'))
			$this->terminate("tbl_sup_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_sup_type'))
			$this->terminate("tbl_sup_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'audittrailview'))
			$this->terminate("audittrailviewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_repair'))
			$this->terminate("tbl_repairlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_repair_status'))
			$this->terminate("tbl_repair_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'inventory_view'))
			$this->terminate("inventory_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'barcodes'))
			$this->terminate("barcodeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Encoder Report 1'))
			$this->terminate("Encoder_Report_1smry.php");
		if ($Security->allowList(CurrentProjectID() . 'Printing Report 1'))
			$this->terminate("Printing_Report_1smry.php");
		if ($Security->allowList(CurrentProjectID() . 'Inventory Report 1'))
			$this->terminate("Inventory_Report_1smry.php");
		if ($Security->allowList(CurrentProjectID() . 'for_charting2'))
			$this->terminate("for_charting2smry.php");
		if ($Security->allowList(CurrentProjectID() . 'inventory_chart2'))
			$this->terminate("inventory_chart2smry.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_accountable_name'))
			$this->terminate("tbl_accountable_namelist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_current_loc'))
			$this->terminate("tbl_current_loclist.php");
		if ($Security->allowList(CurrentProjectID() . 'item_per_employee'))
			$this->terminate("item_per_employeelist.php");
		if ($Security->allowList(CurrentProjectID() . 'per_employee2'))
			$this->terminate("per_employee2smry.php");
		if ($Security->allowList(CurrentProjectID() . 'signatory'))
			$this->terminate("signatorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_supplies'))
			$this->terminate("tbl_supplieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'supplies_report'))
			$this->terminate("supplies_reportlist.php");
		if ($Security->allowList(CurrentProjectID() . 'supplies'))
			$this->terminate("suppliessmry.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_supplies_cat'))
			$this->terminate("tbl_supplies_catlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_pr'))
			$this->terminate("tbl_prlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_purchase_unit'))
			$this->terminate("tbl_purchase_unitlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_spec'))
			$this->terminate("tbl_speclist.php");
		if ($Security->allowList(CurrentProjectID() . 'purchace_view'))
			$this->terminate("purchace_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'purchase_report'))
			$this->terminate("purchase_reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_pr_status'))
			$this->terminate("tbl_pr_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_supplier'))
			$this->terminate("tbl_supplierlist.php");
		if ($Security->allowList(CurrentProjectID() . 'inspection_report'))
			$this->terminate("inspection_reportlist.php");
		if ($Security->allowList(CurrentProjectID() . 'Ticket_report'))
			$this->terminate("Ticket_reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Dashboard1'))
			$this->terminate("Dashboard1dsb.php");
		if ($Security->allowList(CurrentProjectID() . 'load.php'))
			$this->terminate("load.php");
		if ($Security->isLoggedIn()) {
			$this->setFailureMessage(DeniedMessage() . "<br><br><a href=\"logout.php\">" . $Language->phrase("BackToLogin") . "</a>");
		} else {
			$this->terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "for_charting2smry.php";
	//}

	global $Security;
	  if (!$Security->IsLoggedIn()) {
	  	$url = "login.php"; // redirect to the login page if users have not logged in
	  	  } else if(CurrentUserLevel() == "3") { // if userlevel is tracker
	  	$url = "tbl_encoderlist.php";
	  	  } else if (CurrentUserLevel() == "4") { // if userlevel is encoder
	  	$url = "tbl_encoderlist.php";
	  	  } else if (CurrentUserLevel() == "0") { // if userlevel is encoder
	  	$url = "tbl_inventorylist.php";
	  	  } else { // case default
	 $url = "Dashboard1dsb.php";
	 }
	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>