<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class Inventory_Report_1_summary extends Inventory_Report_1
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'Inventory Report 1';

	// Page object name
	public $PageObjName = "Inventory_Report_1_summary";

	// CSS
	public $ReportTableClass = "";
	public $ReportTableStyle = "";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = TRUE;
	public $ExportWordCustom = TRUE;
	public $ExportPdfCustom = TRUE;
	public $ExportEmailCustom = TRUE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		return $url;
	}

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

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (Inventory_Report_1)
		if (!isset($GLOBALS["Inventory_Report_1"]) || get_class($GLOBALS["Inventory_Report_1"]) == PROJECT_NAMESPACE . "Inventory_Report_1") {
			$GLOBALS["Inventory_Report_1"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Inventory_Report_1"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'summary');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Inventory Report 1');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (employee)
		$UserTable = $UserTable ?: new employee();

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fsummary";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;
		if (Post("customexport") === NULL) {

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		}

		// Export
		if ($this->isExport() && !$this->isExport("print") && $fn = Config("REPORT_EXPORT_FUNCTIONS." . $this->Export)) {
			if (Post("data") !== NULL)
				$content = Post("data");
			else
				$content = ob_get_clean();
			$this->$fn($content);
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection if not in dashboard
		if (!$DashboardReport)
			CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}

		// Exit if not in dashboard
		if (!$DashboardReport)
			exit();
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;
		if (in_array($lookup->LinkTable, [$this->ReportSourceTable, $this->TableVar]))
			$lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
		$lookup->RenderEditFunc = ""; // Set up edit renderer

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}

	// Initialize common variables
	public $HideOptions = FALSE;
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $FilterOptions; // Filter options

	// Records
	public $GroupRecords = [];
	public $DetailRecords = [];
	public $DetailRecordCount = 0;

	// Paging variables
	public $RecordIndex = 0; // Record index
	public $RecordCount = 0; // Record count (start from 1 for each group)
	public $StartGroup = 0; // Start group
	public $StopGroup = 0; // Stop group
	public $TotalGroups = 0; // Total groups
	public $GroupCount = 0; // Group count
	public $GroupCounter = []; // Group counter
	public $DisplayGroups = 3; // Groups per page
	public $GroupRange = 10;
	public $PageSizes = "1,2,3,5,-1"; // Page sizes (comma separated)
	public $Sort = "";
	public $Filter = "";
	public $PageFirstGroupFilter = "";
	public $UserIDFilter = "";
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = "";
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $DrillDownList = "";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $SearchCommand = FALSE;
	public $ShowHeader;
	public $GroupColumnCount = 0;
	public $SubGroupColumnCount = 0;
	public $DetailColumnCount = 0;
	public $TotalCount;
	public $PageTotalCount;
	public $TopContentClass = "col-sm-12 ew-top";
	public $LeftContentClass = "ew-left";
	public $CenterContentClass = "col-sm-12 ew-center";
	public $RightContentClass = "ew-right";
	public $BottomContentClass = "col-sm-12 ew-bottom";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $ExportFileName, $Language, $Security, $UserProfile,
			$Security, $FormError, $DrillDownInPanel, $Breadcrumb,
			$DashboardReport, $CustomExportType, $ReportExportType;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canReport()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header
		$ReportExportType = $ExportType; // Report export type, used in header

		// Custom export (post back from ew.applyTemplate), export and terminate page
		if (Post("customexport") !== NULL) {
			$this->CustomExport = Post("customexport");
			$this->Export = $this->CustomExport;
			$this->terminate();
		}

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up table class
		if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf"))
			$this->ReportTableClass = "ew-table";
		else
			$this->ReportTableClass = "table ew-table";

		// Hide main table for custom layout
		if ($this->isExport() || $this->UseCustomTemplate)
			$this->ReportTableStyle = ' style="display: none;"';

		// Set field visibility for detail fields
		$this->inventory_id->setVisibility();
		$this->month_dsc->setVisibility();
		$this->year_dsc->setVisibility();
		$this->item_model->setVisibility();
		$this->item_serial->setVisibility();
		$this->off_desc->setVisibility();
		$this->Last_Date_Check->setVisibility();
		$this->inventory_status_dsc->setVisibility();
		$this->remarks->setVisibility();
		$this->Name_dsc->setVisibility();
		$this->user_last_modify->setVisibility();
		$this->date_last_modify->setVisibility();
		$this->pullout_date->setVisibility();
		$this->pos_desc->setVisibility();
		$this->current_location->setVisibility();
		$this->last_name->setVisibility();
		$this->first_name->setVisibility();
		$this->mid_name->setVisibility();
		$this->ext_name->setVisibility();
		$this->full_name->setVisibility();
		$this->full_name_tbl->setVisibility();

		// Set up groups per page dynamically
		$this->setupDisplayGroups();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Check if search command
		$this->SearchCommand = (Get("cmd", "") == "search");

		// Load custom filters
		$this->Page_FilterLoad();

		// Extended filter
		$extendedFilter = "";

		// Restore filter list
		$this->restoreFilterList();

		// Build extended filter
		$extendedFilter = $this->getExtendedFilter();
		AddFilter($this->SearchWhere, $extendedFilter);

		// Call Page Selecting event
		$this->Page_Selecting($this->SearchWhere);

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Get sort
		$this->Sort = $this->getSort();

		// Update filter
		AddFilter($this->Filter, $this->SearchWhere);

		// Get total group count
		$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
		$this->TotalGroups = $this->getRecordCount($sql);
		if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) // Display all groups
			$this->DisplayGroups = $this->TotalGroups;
		$this->StartGroup = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGroups > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->isExport())
			$this->DisplayGroups = $this->TotalGroups;
		else
			$this->setupStartGroup();

		// Set no record found message
		if ($this->TotalGroups == 0) {
			if ($Security->canList()) {
				if ($this->SearchWhere == "0=101") {
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($Language->phrase("NoRecord"));
				}
			} else {
				$this->setWarningMessage(DeniedMessage());
			}
		}

		// Hide export options if export/dashboard report/hide options
		if ($this->isExport() || $DashboardReport || $this->HideOptions)
			$this->ExportOptions->hideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report/hide options
		if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}

		// Get group records
		if ($this->TotalGroups > 0) {
			$grpSort = UpdateSortFields($this->getSqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
			$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderByGroup(), $this->Filter, $grpSort);
			$grpRs = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);
			$this->GroupRecords = $grpRs->getRows(); // Get records of first grouping field
			$this->loadGroupRowValues();
			$this->GroupCount = 1;
		}

		// Init detail records
		$this->DetailRecords = [];
		$this->setupFieldCount();

		// Set the last group to display if not export all
		if ($this->ExportAll && $this->isExport()) {
			$this->StopGroup = $this->TotalGroups;
		} else {
			$this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
		}

		// Stop group <= total number of groups
		if (intval($this->StopGroup) > intval($this->TotalGroups))
			$this->StopGroup = $this->TotalGroups;
		$this->RecordCount = 0;
		$this->RecordIndex = 0;

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Load group row values
	public function loadGroupRowValues()
	{
		$cnt = count($this->GroupRecords); // Get record count
		if ($this->GroupCount < $cnt)
			$this->cat_desc->setGroupValue($this->GroupRecords[$this->GroupCount][0]);
		else
			$this->cat_desc->setGroupValue("");
	}

	// Load row values
	public function loadRowValues($record)
	{
		if ($this->RecordIndex == 1) { // Load first row data
			$data = [];
			$data["inventory_id"] = $record['inventory_id'];
			$data["month_dsc"] = $record['month_dsc'];
			$data["year_dsc"] = $record['year_dsc'];
			$data["cat_desc"] = $record['cat_desc'];
			$data["item_model"] = $record['item_model'];
			$data["item_serial"] = $record['item_serial'];
			$data["off_desc"] = $record['off_desc'];
			$data["region_name"] = $record['region_name'];
			$data["prov_name"] = $record['prov_name'];
			$data["city_name"] = $record['city_name'];
			$data["Last_Date_Check"] = $record['Last_Date_Check'];
			$data["inventory_status_dsc"] = $record['inventory_status_dsc'];
			$data["Name_dsc"] = $record['Name_dsc'];
			$data["user_last_modify"] = $record['user_last_modify'];
			$data["date_last_modify"] = $record['date_last_modify'];
			$data["pullout_date"] = $record['pullout_date'];
			$data["pos_desc"] = $record['pos_desc'];
			$data["current_location"] = $record['current_location'];
			$data["last_name"] = $record['last_name'];
			$data["first_name"] = $record['first_name'];
			$data["mid_name"] = $record['mid_name'];
			$data["ext_name"] = $record['ext_name'];
			$data["full_name_tbl"] = $record['full_name_tbl'];
			$this->Rows[] = $data;
		}
		$this->inventory_id->setDbValue($record['inventory_id']);
		$this->month_dsc->setDbValue($record['month_dsc']);
		$this->year_dsc->setDbValue($record['year_dsc']);
		$this->cat_desc->setDbValue(GroupValue($this->cat_desc, $record['cat_desc']));
		$this->item_model->setDbValue($record['item_model']);
		$this->item_serial->setDbValue($record['item_serial']);
		$this->off_desc->setDbValue($record['off_desc']);
		$this->region_name->setDbValue($record['region_name']);
		$this->prov_name->setDbValue($record['prov_name']);
		$this->city_name->setDbValue($record['city_name']);
		$this->Last_Date_Check->setDbValue($record['Last_Date_Check']);
		$this->inventory_status_dsc->setDbValue($record['inventory_status_dsc']);
		$this->remarks->setDbValue($record['remarks']);
		$this->Name_dsc->setDbValue($record['Name_dsc']);
		$this->user_last_modify->setDbValue($record['user_last_modify']);
		$this->date_last_modify->setDbValue($record['date_last_modify']);
		$this->pullout_date->setDbValue($record['pullout_date']);
		$this->pos_desc->setDbValue($record['pos_desc']);
		$this->current_location->setDbValue($record['current_location']);
		$this->last_name->setDbValue($record['last_name']);
		$this->first_name->setDbValue($record['first_name']);
		$this->mid_name->setDbValue($record['mid_name']);
		$this->ext_name->setDbValue($record['ext_name']);
		$this->full_name->setDbValue($record['full_name']);
		$this->full_name_tbl->setDbValue($record['full_name_tbl']);
	}

	// Render row
	public function renderRow()
	{
		global $Security, $Language, $Language;
		$conn = $this->getConnection();
		if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total

			// Build detail SQL
			$firstGrpFld = &$this->cat_desc;
			$firstGrpFld->getDistinctValues($this->GroupRecords);
			$where = DetailFilterSql($firstGrpFld, $this->getSqlFirstGroupField(), $firstGrpFld->DistinctValues, $this->Dbid);
			if ($this->Filter != "")
				$where = "($this->Filter) AND ($where)";
			$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $where, $this->Sort);
			$rs = $this->getRecordset($sql);
			$records = $rs ? $rs->getRows() : [];
			$this->inventory_id->getCnt($records);
			$this->PageTotalCount = count($records);
		} elseif ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_GRAND) { // Get Grand total
			$hasCount = FALSE;
			$hasSummary = FALSE;

			// Get total count from SQL directly
			$sql = BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->execute($sql);
			if ($rstot) {
				$cnt = ($rstot->recordCount() > 1) ? $rstot->recordCount() : $rstot->fields[0];
				$rstot->close();
				$hasCount = TRUE;
			} else {
				$cnt = 0;
			}
			$this->TotalCount = $cnt;

			// Get total from SQL directly
			$sql = BuildReportSql($this->getSqlSelectAggregate(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$sql = $this->getSqlAggregatePrefix() . $sql . $this->getSqlAggregateSuffix();
			$rsagg = $conn->execute($sql);
			if ($rsagg) {
				$this->inventory_id->Count = $this->TotalCount;
				$this->inventory_id->CntValue = $rsagg->fields("cnt_inventory_id");
				$this->month_dsc->Count = $this->TotalCount;
				$this->year_dsc->Count = $this->TotalCount;
				$this->item_model->Count = $this->TotalCount;
				$this->item_serial->Count = $this->TotalCount;
				$this->off_desc->Count = $this->TotalCount;
				$this->Last_Date_Check->Count = $this->TotalCount;
				$this->inventory_status_dsc->Count = $this->TotalCount;
				$this->remarks->Count = $this->TotalCount;
				$this->Name_dsc->Count = $this->TotalCount;
				$this->user_last_modify->Count = $this->TotalCount;
				$this->date_last_modify->Count = $this->TotalCount;
				$this->pullout_date->Count = $this->TotalCount;
				$this->pos_desc->Count = $this->TotalCount;
				$this->current_location->Count = $this->TotalCount;
				$this->last_name->Count = $this->TotalCount;
				$this->first_name->Count = $this->TotalCount;
				$this->mid_name->Count = $this->TotalCount;
				$this->ext_name->Count = $this->TotalCount;
				$this->full_name->Count = $this->TotalCount;
				$this->full_name_tbl->Count = $this->TotalCount;
				$rsagg->close();
				$hasSummary = TRUE;
			}

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $this->getRecordset($sql);
				$this->DetailRecords = $rs ? $rs->getRows() : [];
			$this->inventory_id->getCnt($this->DetailRecords);
			}
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		// cat_desc
		// inventory_id
		// month_dsc
		// year_dsc
		// item_model
		// item_serial
		// off_desc
		// Last_Date_Check
		// inventory_status_dsc
		// remarks
		// Name_dsc
		// user_last_modify
		// date_last_modify
		// pullout_date
		// pos_desc
		// current_location
		// last_name
		// first_name
		// mid_name
		// ext_name
		// full_name
		// full_name_tbl

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// Last_Date_Check
			$this->Last_Date_Check->EditAttrs["class"] = "form-control";
			$this->Last_Date_Check->EditCustomAttributes = "";
			$this->Last_Date_Check->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->Last_Date_Check->AdvancedSearch->SearchValue, 2), 2));
			$this->Last_Date_Check->PlaceHolder = RemoveHtml($this->Last_Date_Check->caption());
			$this->Last_Date_Check->EditAttrs["class"] = "form-control";
			$this->Last_Date_Check->EditCustomAttributes = "";
			$this->Last_Date_Check->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->Last_Date_Check->AdvancedSearch->SearchValue2, 2), 2));
			$this->Last_Date_Check->PlaceHolder = RemoveHtml($this->Last_Date_Check->caption());

			// Name_dsc
			$this->Name_dsc->EditAttrs["class"] = "form-control";
			$this->Name_dsc->EditCustomAttributes = "";
			$curVal = trim(strval($this->Name_dsc->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Name_dsc->AdvancedSearch->ViewValue = $this->Name_dsc->lookupCacheOption($curVal);
			else
				$this->Name_dsc->AdvancedSearch->ViewValue = $this->Name_dsc->Lookup !== NULL && is_array($this->Name_dsc->Lookup->Options) ? $curVal : NULL;
			if ($this->Name_dsc->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Name_dsc->EditValue = array_values($this->Name_dsc->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Name_dsc`" . SearchString("=", $this->Name_dsc->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Name_dsc->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Name_dsc->EditValue = $arwrk;
			}
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP)
				$this->RowAttrs["data-group"] = $this->cat_desc->groupValue(); // Set up group attribute

			// cat_desc
			$this->cat_desc->GroupViewValue = $this->cat_desc->groupValue();
			$this->cat_desc->CellCssClass = "ew-rpt-grp-field-%g";
			$this->cat_desc->CellCssStyle .= "text-align: left;";
			$this->cat_desc->ViewCustomAttributes = "";
			$this->cat_desc->GroupViewValue = DisplayGroupValue($this->cat_desc, $this->cat_desc->GroupViewValue);

			// inventory_id
			$this->inventory_id->CntViewValue = $this->inventory_id->CntValue;
			$this->inventory_id->CntViewValue = FormatNumber($this->inventory_id->CntViewValue, 0, -2, -2, -1);
			$this->inventory_id->CellCssStyle .= "text-align: left;";
			$this->inventory_id->ViewCustomAttributes = "";
			$this->inventory_id->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// cat_desc
			$this->cat_desc->HrefValue = "";

			// inventory_id
			$this->inventory_id->HrefValue = "";

			// month_dsc
			$this->month_dsc->HrefValue = "";

			// year_dsc
			$this->year_dsc->HrefValue = "";

			// item_model
			$this->item_model->HrefValue = "";

			// item_serial
			$this->item_serial->HrefValue = "";

			// off_desc
			$this->off_desc->HrefValue = "";

			// Last_Date_Check
			$this->Last_Date_Check->HrefValue = "";

			// inventory_status_dsc
			$this->inventory_status_dsc->HrefValue = "";

			// remarks
			$this->remarks->HrefValue = "";

			// Name_dsc
			$this->Name_dsc->HrefValue = "";

			// user_last_modify
			$this->user_last_modify->HrefValue = "";

			// date_last_modify
			$this->date_last_modify->HrefValue = "";

			// pullout_date
			$this->pullout_date->HrefValue = "";

			// pos_desc
			$this->pos_desc->HrefValue = "";

			// current_location
			$this->current_location->HrefValue = "";

			// last_name
			$this->last_name->HrefValue = "";

			// first_name
			$this->first_name->HrefValue = "";

			// mid_name
			$this->mid_name->HrefValue = "";

			// ext_name
			$this->ext_name->HrefValue = "";

			// full_name
			$this->full_name->HrefValue = "";

			// full_name_tbl
			$this->full_name_tbl->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->cat_desc->groupValue(); // Set up group attribute
			} else {
			$this->RowAttrs["data-group"] = $this->cat_desc->groupValue(); // Set up group attribute
			}

			// cat_desc
			$this->cat_desc->GroupViewValue = $this->cat_desc->groupValue();
			$this->cat_desc->CellCssClass = "ew-rpt-grp-field-1";
			$this->cat_desc->CellCssStyle .= "text-align: left;";
			$this->cat_desc->ViewCustomAttributes = "";
			$this->cat_desc->GroupViewValue = DisplayGroupValue($this->cat_desc, $this->cat_desc->GroupViewValue);
			if (!$this->cat_desc->LevelBreak)
				$this->cat_desc->GroupViewValue = "&nbsp;";
			else
				$this->cat_desc->LevelBreak = FALSE;

			// inventory_id
			$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
			$this->inventory_id->ViewValue = FormatNumber($this->inventory_id->ViewValue, 0, -2, -2, -1);
			$this->inventory_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->inventory_id->CellCssStyle .= "text-align: left;";
			$this->inventory_id->ViewCustomAttributes = "";

			// month_dsc
			$arwrk = [];
			$arwrk[1] = $this->month_dsc->CurrentValue;
			$this->month_dsc->ViewValue = $this->month_dsc->displayValue($arwrk);
			$this->month_dsc->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->month_dsc->CellCssStyle .= "text-align: left;";
			$this->month_dsc->ViewCustomAttributes = "";

			// year_dsc
			$arwrk = [];
			$arwrk[1] = $this->year_dsc->CurrentValue;
			$this->year_dsc->ViewValue = $this->year_dsc->displayValue($arwrk);
			$this->year_dsc->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->year_dsc->CellCssStyle .= "text-align: left;";
			$this->year_dsc->ViewCustomAttributes = "";

			// item_model
			$this->item_model->ViewValue = $this->item_model->CurrentValue;
			$this->item_model->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->item_model->CellCssStyle .= "text-align: left;";
			$this->item_model->ViewCustomAttributes = "";

			// item_serial
			$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
			$this->item_serial->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->item_serial->CellCssStyle .= "text-align: left;";
			$this->item_serial->ViewCustomAttributes = "";

			// off_desc
			$arwrk = [];
			$arwrk[1] = $this->off_desc->CurrentValue;
			$this->off_desc->ViewValue = $this->off_desc->displayValue($arwrk);
			$this->off_desc->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->off_desc->CellCssStyle .= "text-align: left;";
			$this->off_desc->ViewCustomAttributes = "";

			// Last_Date_Check
			$this->Last_Date_Check->ViewValue = $this->Last_Date_Check->CurrentValue;
			$this->Last_Date_Check->ViewValue = FormatDateTime($this->Last_Date_Check->ViewValue, 2);
			$this->Last_Date_Check->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->Last_Date_Check->CellCssStyle .= "text-align: left;";
			$this->Last_Date_Check->ViewCustomAttributes = "";

			// inventory_status_dsc
			$arwrk = [];
			$arwrk[1] = $this->inventory_status_dsc->CurrentValue;
			$this->inventory_status_dsc->ViewValue = $this->inventory_status_dsc->displayValue($arwrk);
			$this->inventory_status_dsc->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->inventory_status_dsc->CellCssStyle .= "text-align: left;";
			$this->inventory_status_dsc->ViewCustomAttributes = "";

			// remarks
			$this->remarks->ViewValue = $this->remarks->CurrentValue;
			$this->remarks->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->remarks->CellCssStyle .= "text-align: left;";
			$this->remarks->ViewCustomAttributes = "";

			// Name_dsc
			$arwrk = [];
			$arwrk[1] = $this->Name_dsc->CurrentValue;
			$this->Name_dsc->ViewValue = $this->Name_dsc->displayValue($arwrk);
			$this->Name_dsc->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->Name_dsc->CellCssStyle .= "text-align: left;";
			$this->Name_dsc->ViewCustomAttributes = "";

			// user_last_modify
			$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
			$this->user_last_modify->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->user_last_modify->ViewCustomAttributes = "";

			// date_last_modify
			$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
			$this->date_last_modify->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->date_last_modify->ViewCustomAttributes = "";

			// pullout_date
			$this->pullout_date->ViewValue = $this->pullout_date->CurrentValue;
			$this->pullout_date->ViewValue = FormatDateTime($this->pullout_date->ViewValue, 0);
			$this->pullout_date->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->pullout_date->ViewCustomAttributes = "";

			// pos_desc
			$this->pos_desc->ViewValue = $this->pos_desc->CurrentValue;
			$this->pos_desc->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->pos_desc->ViewCustomAttributes = "";

			// current_location
			$this->current_location->ViewValue = $this->current_location->CurrentValue;
			$this->current_location->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->current_location->ViewCustomAttributes = "";

			// last_name
			$this->last_name->ViewValue = $this->last_name->CurrentValue;
			$this->last_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->last_name->ViewCustomAttributes = "";

			// first_name
			$this->first_name->ViewValue = $this->first_name->CurrentValue;
			$this->first_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->first_name->ViewCustomAttributes = "";

			// mid_name
			$this->mid_name->ViewValue = $this->mid_name->CurrentValue;
			$this->mid_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->mid_name->ViewCustomAttributes = "";

			// ext_name
			$this->ext_name->ViewValue = $this->ext_name->CurrentValue;
			$this->ext_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->ext_name->ViewCustomAttributes = "";

			// full_name
			$this->full_name->ViewValue = $this->full_name->CurrentValue;
			$this->full_name->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->full_name->ViewCustomAttributes = "";

			// full_name_tbl
			$this->full_name_tbl->ViewValue = $this->full_name_tbl->CurrentValue;
			$this->full_name_tbl->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->full_name_tbl->ViewCustomAttributes = "";

			// cat_desc
			$this->cat_desc->LinkCustomAttributes = "";
			$this->cat_desc->HrefValue = "";
			$this->cat_desc->TooltipValue = "";

			// inventory_id
			$this->inventory_id->LinkCustomAttributes = "";
			$this->inventory_id->HrefValue = "";
			$this->inventory_id->TooltipValue = "";

			// month_dsc
			$this->month_dsc->LinkCustomAttributes = "";
			$this->month_dsc->HrefValue = "";
			$this->month_dsc->TooltipValue = "";

			// year_dsc
			$this->year_dsc->LinkCustomAttributes = "";
			$this->year_dsc->HrefValue = "";
			$this->year_dsc->TooltipValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";
			$this->item_model->TooltipValue = "";

			// item_serial
			$this->item_serial->LinkCustomAttributes = "";
			$this->item_serial->HrefValue = "";
			$this->item_serial->TooltipValue = "";

			// off_desc
			$this->off_desc->LinkCustomAttributes = "";
			$this->off_desc->HrefValue = "";
			$this->off_desc->TooltipValue = "";

			// Last_Date_Check
			$this->Last_Date_Check->LinkCustomAttributes = "";
			$this->Last_Date_Check->HrefValue = "";
			$this->Last_Date_Check->TooltipValue = "";

			// inventory_status_dsc
			$this->inventory_status_dsc->LinkCustomAttributes = "";
			$this->inventory_status_dsc->HrefValue = "";
			$this->inventory_status_dsc->TooltipValue = "";

			// remarks
			$this->remarks->LinkCustomAttributes = "";
			$this->remarks->HrefValue = "";
			$this->remarks->TooltipValue = "";

			// Name_dsc
			$this->Name_dsc->LinkCustomAttributes = "";
			$this->Name_dsc->HrefValue = "";
			$this->Name_dsc->TooltipValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";

			// pullout_date
			$this->pullout_date->LinkCustomAttributes = "";
			$this->pullout_date->HrefValue = "";
			$this->pullout_date->TooltipValue = "";

			// pos_desc
			$this->pos_desc->LinkCustomAttributes = "";
			$this->pos_desc->HrefValue = "";
			$this->pos_desc->TooltipValue = "";

			// current_location
			$this->current_location->LinkCustomAttributes = "";
			$this->current_location->HrefValue = "";
			$this->current_location->TooltipValue = "";

			// last_name
			$this->last_name->LinkCustomAttributes = "";
			$this->last_name->HrefValue = "";
			$this->last_name->TooltipValue = "";

			// first_name
			$this->first_name->LinkCustomAttributes = "";
			$this->first_name->HrefValue = "";
			$this->first_name->TooltipValue = "";

			// mid_name
			$this->mid_name->LinkCustomAttributes = "";
			$this->mid_name->HrefValue = "";
			$this->mid_name->TooltipValue = "";

			// ext_name
			$this->ext_name->LinkCustomAttributes = "";
			$this->ext_name->HrefValue = "";
			$this->ext_name->TooltipValue = "";

			// full_name
			$this->full_name->LinkCustomAttributes = "";
			$this->full_name->HrefValue = "";
			$this->full_name->TooltipValue = "";

			// full_name_tbl
			$this->full_name_tbl->LinkCustomAttributes = "";
			$this->full_name_tbl->HrefValue = "";
			$this->full_name_tbl->TooltipValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row

			// cat_desc
			$currentValue = $this->cat_desc->GroupViewValue;
			$viewValue = &$this->cat_desc->GroupViewValue;
			$viewAttrs = &$this->cat_desc->ViewAttrs;
			$cellAttrs = &$this->cat_desc->CellAttrs;
			$hrefValue = &$this->cat_desc->HrefValue;
			$linkAttrs = &$this->cat_desc->LinkAttrs;
			$this->Cell_Rendered($this->cat_desc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// inventory_id
			$currentValue = $this->inventory_id->CntValue;
			$viewValue = &$this->inventory_id->CntViewValue;
			$viewAttrs = &$this->inventory_id->ViewAttrs;
			$cellAttrs = &$this->inventory_id->CellAttrs;
			$hrefValue = &$this->inventory_id->HrefValue;
			$linkAttrs = &$this->inventory_id->LinkAttrs;
			$this->Cell_Rendered($this->inventory_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// cat_desc
			$currentValue = $this->cat_desc->groupValue();
			$viewValue = &$this->cat_desc->GroupViewValue;
			$viewAttrs = &$this->cat_desc->ViewAttrs;
			$cellAttrs = &$this->cat_desc->CellAttrs;
			$hrefValue = &$this->cat_desc->HrefValue;
			$linkAttrs = &$this->cat_desc->LinkAttrs;
			$this->Cell_Rendered($this->cat_desc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// inventory_id
			$currentValue = $this->inventory_id->CurrentValue;
			$viewValue = &$this->inventory_id->ViewValue;
			$viewAttrs = &$this->inventory_id->ViewAttrs;
			$cellAttrs = &$this->inventory_id->CellAttrs;
			$hrefValue = &$this->inventory_id->HrefValue;
			$linkAttrs = &$this->inventory_id->LinkAttrs;
			$this->Cell_Rendered($this->inventory_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// month_dsc
			$currentValue = $this->month_dsc->CurrentValue;
			$viewValue = &$this->month_dsc->ViewValue;
			$viewAttrs = &$this->month_dsc->ViewAttrs;
			$cellAttrs = &$this->month_dsc->CellAttrs;
			$hrefValue = &$this->month_dsc->HrefValue;
			$linkAttrs = &$this->month_dsc->LinkAttrs;
			$this->Cell_Rendered($this->month_dsc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// year_dsc
			$currentValue = $this->year_dsc->CurrentValue;
			$viewValue = &$this->year_dsc->ViewValue;
			$viewAttrs = &$this->year_dsc->ViewAttrs;
			$cellAttrs = &$this->year_dsc->CellAttrs;
			$hrefValue = &$this->year_dsc->HrefValue;
			$linkAttrs = &$this->year_dsc->LinkAttrs;
			$this->Cell_Rendered($this->year_dsc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// item_model
			$currentValue = $this->item_model->CurrentValue;
			$viewValue = &$this->item_model->ViewValue;
			$viewAttrs = &$this->item_model->ViewAttrs;
			$cellAttrs = &$this->item_model->CellAttrs;
			$hrefValue = &$this->item_model->HrefValue;
			$linkAttrs = &$this->item_model->LinkAttrs;
			$this->Cell_Rendered($this->item_model, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// item_serial
			$currentValue = $this->item_serial->CurrentValue;
			$viewValue = &$this->item_serial->ViewValue;
			$viewAttrs = &$this->item_serial->ViewAttrs;
			$cellAttrs = &$this->item_serial->CellAttrs;
			$hrefValue = &$this->item_serial->HrefValue;
			$linkAttrs = &$this->item_serial->LinkAttrs;
			$this->Cell_Rendered($this->item_serial, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// off_desc
			$currentValue = $this->off_desc->CurrentValue;
			$viewValue = &$this->off_desc->ViewValue;
			$viewAttrs = &$this->off_desc->ViewAttrs;
			$cellAttrs = &$this->off_desc->CellAttrs;
			$hrefValue = &$this->off_desc->HrefValue;
			$linkAttrs = &$this->off_desc->LinkAttrs;
			$this->Cell_Rendered($this->off_desc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Last_Date_Check
			$currentValue = $this->Last_Date_Check->CurrentValue;
			$viewValue = &$this->Last_Date_Check->ViewValue;
			$viewAttrs = &$this->Last_Date_Check->ViewAttrs;
			$cellAttrs = &$this->Last_Date_Check->CellAttrs;
			$hrefValue = &$this->Last_Date_Check->HrefValue;
			$linkAttrs = &$this->Last_Date_Check->LinkAttrs;
			$this->Cell_Rendered($this->Last_Date_Check, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// inventory_status_dsc
			$currentValue = $this->inventory_status_dsc->CurrentValue;
			$viewValue = &$this->inventory_status_dsc->ViewValue;
			$viewAttrs = &$this->inventory_status_dsc->ViewAttrs;
			$cellAttrs = &$this->inventory_status_dsc->CellAttrs;
			$hrefValue = &$this->inventory_status_dsc->HrefValue;
			$linkAttrs = &$this->inventory_status_dsc->LinkAttrs;
			$this->Cell_Rendered($this->inventory_status_dsc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// remarks
			$currentValue = $this->remarks->CurrentValue;
			$viewValue = &$this->remarks->ViewValue;
			$viewAttrs = &$this->remarks->ViewAttrs;
			$cellAttrs = &$this->remarks->CellAttrs;
			$hrefValue = &$this->remarks->HrefValue;
			$linkAttrs = &$this->remarks->LinkAttrs;
			$this->Cell_Rendered($this->remarks, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Name_dsc
			$currentValue = $this->Name_dsc->CurrentValue;
			$viewValue = &$this->Name_dsc->ViewValue;
			$viewAttrs = &$this->Name_dsc->ViewAttrs;
			$cellAttrs = &$this->Name_dsc->CellAttrs;
			$hrefValue = &$this->Name_dsc->HrefValue;
			$linkAttrs = &$this->Name_dsc->LinkAttrs;
			$this->Cell_Rendered($this->Name_dsc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// user_last_modify
			$currentValue = $this->user_last_modify->CurrentValue;
			$viewValue = &$this->user_last_modify->ViewValue;
			$viewAttrs = &$this->user_last_modify->ViewAttrs;
			$cellAttrs = &$this->user_last_modify->CellAttrs;
			$hrefValue = &$this->user_last_modify->HrefValue;
			$linkAttrs = &$this->user_last_modify->LinkAttrs;
			$this->Cell_Rendered($this->user_last_modify, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// date_last_modify
			$currentValue = $this->date_last_modify->CurrentValue;
			$viewValue = &$this->date_last_modify->ViewValue;
			$viewAttrs = &$this->date_last_modify->ViewAttrs;
			$cellAttrs = &$this->date_last_modify->CellAttrs;
			$hrefValue = &$this->date_last_modify->HrefValue;
			$linkAttrs = &$this->date_last_modify->LinkAttrs;
			$this->Cell_Rendered($this->date_last_modify, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// pullout_date
			$currentValue = $this->pullout_date->CurrentValue;
			$viewValue = &$this->pullout_date->ViewValue;
			$viewAttrs = &$this->pullout_date->ViewAttrs;
			$cellAttrs = &$this->pullout_date->CellAttrs;
			$hrefValue = &$this->pullout_date->HrefValue;
			$linkAttrs = &$this->pullout_date->LinkAttrs;
			$this->Cell_Rendered($this->pullout_date, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// pos_desc
			$currentValue = $this->pos_desc->CurrentValue;
			$viewValue = &$this->pos_desc->ViewValue;
			$viewAttrs = &$this->pos_desc->ViewAttrs;
			$cellAttrs = &$this->pos_desc->CellAttrs;
			$hrefValue = &$this->pos_desc->HrefValue;
			$linkAttrs = &$this->pos_desc->LinkAttrs;
			$this->Cell_Rendered($this->pos_desc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// current_location
			$currentValue = $this->current_location->CurrentValue;
			$viewValue = &$this->current_location->ViewValue;
			$viewAttrs = &$this->current_location->ViewAttrs;
			$cellAttrs = &$this->current_location->CellAttrs;
			$hrefValue = &$this->current_location->HrefValue;
			$linkAttrs = &$this->current_location->LinkAttrs;
			$this->Cell_Rendered($this->current_location, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// last_name
			$currentValue = $this->last_name->CurrentValue;
			$viewValue = &$this->last_name->ViewValue;
			$viewAttrs = &$this->last_name->ViewAttrs;
			$cellAttrs = &$this->last_name->CellAttrs;
			$hrefValue = &$this->last_name->HrefValue;
			$linkAttrs = &$this->last_name->LinkAttrs;
			$this->Cell_Rendered($this->last_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// first_name
			$currentValue = $this->first_name->CurrentValue;
			$viewValue = &$this->first_name->ViewValue;
			$viewAttrs = &$this->first_name->ViewAttrs;
			$cellAttrs = &$this->first_name->CellAttrs;
			$hrefValue = &$this->first_name->HrefValue;
			$linkAttrs = &$this->first_name->LinkAttrs;
			$this->Cell_Rendered($this->first_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// mid_name
			$currentValue = $this->mid_name->CurrentValue;
			$viewValue = &$this->mid_name->ViewValue;
			$viewAttrs = &$this->mid_name->ViewAttrs;
			$cellAttrs = &$this->mid_name->CellAttrs;
			$hrefValue = &$this->mid_name->HrefValue;
			$linkAttrs = &$this->mid_name->LinkAttrs;
			$this->Cell_Rendered($this->mid_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ext_name
			$currentValue = $this->ext_name->CurrentValue;
			$viewValue = &$this->ext_name->ViewValue;
			$viewAttrs = &$this->ext_name->ViewAttrs;
			$cellAttrs = &$this->ext_name->CellAttrs;
			$hrefValue = &$this->ext_name->HrefValue;
			$linkAttrs = &$this->ext_name->LinkAttrs;
			$this->Cell_Rendered($this->ext_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// full_name
			$currentValue = $this->full_name->CurrentValue;
			$viewValue = &$this->full_name->ViewValue;
			$viewAttrs = &$this->full_name->ViewAttrs;
			$cellAttrs = &$this->full_name->CellAttrs;
			$hrefValue = &$this->full_name->HrefValue;
			$linkAttrs = &$this->full_name->LinkAttrs;
			$this->Cell_Rendered($this->full_name, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// full_name_tbl
			$currentValue = $this->full_name_tbl->CurrentValue;
			$viewValue = &$this->full_name_tbl->ViewValue;
			$viewAttrs = &$this->full_name_tbl->ViewAttrs;
			$cellAttrs = &$this->full_name_tbl->CellAttrs;
			$hrefValue = &$this->full_name_tbl->HrefValue;
			$linkAttrs = &$this->full_name_tbl->LinkAttrs;
			$this->Cell_Rendered($this->full_name_tbl, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->setupFieldCount();
	}
	private $_groupCounts = [];

	// Get group count
	public function getGroupCount(...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "") {
			return -1;
		} elseif ($key == "0") { // Number of first level groups
			$i = 1;
			while (isset($this->_groupCounts[strval($i)]))
				$i++;
			return $i - 1;
		}
		return isset($this->_groupCounts[$key]) ? $this->_groupCounts[$key] : -1;
	}

	// Set group count
	public function setGroupCount($value, ...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "")
			return;
		$this->_groupCounts[$key] = $value;
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->cat_desc->Visible)
			$this->GroupColumnCount += 1;
		if ($this->inventory_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->month_dsc->Visible)
			$this->DetailColumnCount += 1;
		if ($this->year_dsc->Visible)
			$this->DetailColumnCount += 1;
		if ($this->item_model->Visible)
			$this->DetailColumnCount += 1;
		if ($this->item_serial->Visible)
			$this->DetailColumnCount += 1;
		if ($this->off_desc->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Last_Date_Check->Visible)
			$this->DetailColumnCount += 1;
		if ($this->inventory_status_dsc->Visible)
			$this->DetailColumnCount += 1;
		if ($this->remarks->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Name_dsc->Visible)
			$this->DetailColumnCount += 1;
		if ($this->user_last_modify->Visible)
			$this->DetailColumnCount += 1;
		if ($this->date_last_modify->Visible)
			$this->DetailColumnCount += 1;
		if ($this->pullout_date->Visible)
			$this->DetailColumnCount += 1;
		if ($this->pos_desc->Visible)
			$this->DetailColumnCount += 1;
		if ($this->current_location->Visible)
			$this->DetailColumnCount += 1;
		if ($this->last_name->Visible)
			$this->DetailColumnCount += 1;
		if ($this->first_name->Visible)
			$this->DetailColumnCount += 1;
		if ($this->mid_name->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ext_name->Visible)
			$this->DetailColumnCount += 1;
		if ($this->full_name->Visible)
			$this->DetailColumnCount += 1;
		if ($this->full_name_tbl->Visible)
			$this->DetailColumnCount += 1;
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			return '<a class="ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportExcelUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToExcel") . '</a>';
		} elseif (SameText($type, "word")) {
			return '<a class="ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportWordUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToWord") . '</a>';
		} elseif (SameText($type, "pdf")) {
			return '<a class="ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportPdfUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToPDF") . '</a>';
		} elseif (SameText($type, "email")) {
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_Inventory_Report_1" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_Inventory_Report_1\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel", $this->ExportExcelCustom);
		$item->Visible = FALSE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word", $this->ExportWordCustom);
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf", $this->ExportPdfCustom);
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email", $this->ExportEmailCustom);
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fsummary\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ResetSearch") . "\" data-caption=\"" . $Language->phrase("ResetSearch") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ResetSearchBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_month_dsc":
					break;
				case "x_year_dsc":
					break;
				case "x_off_desc":
					break;
				case "x_region_name":
					break;
				case "x_prov_name":
					break;
				case "x_city_name":
					break;
				case "x_inventory_status_dsc":
					break;
				case "x_Name_dsc":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_month_dsc":
							break;
						case "x_year_dsc":
							break;
						case "x_off_desc":
							break;
						case "x_region_name":
							break;
						case "x_prov_name":
							break;
						case "x_city_name":
							break;
						case "x_inventory_status_dsc":
							break;
						case "x_Name_dsc":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

// Export PDF
	public function exportReportPdf($html)
	{
		global $ExportFileName;
		@ini_set("memory_limit", Config("PDF_MEMORY_LIMIT"));
		set_time_limit(Config("PDF_TIME_LIMIT"));
		$html = CheckHtml($html);
		if (Config("DEBUG")) // Add debug message
			$html = str_replace("</body>", GetDebugMessage() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(["pdf_backend" => "CPDF"]);
		$doc = new \DOMDocument("1.0", "utf-8");
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			$classNames = $span->getAttribute("class");
			if ($classNames == "ew-filter-caption") // Insert colon
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
			elseif (preg_match('/\bicon\-\w+\b/', $classNames)) // Remove icons
				$span->parentNode->removeChild($span);
		}
		$images = $doc->getElementsByTagName("img");
		$pageSize = $this->ExportPageSize;
		$pageOrientation = $this->ExportPageOrientation;
		$portrait = SameText($pageOrientation, "portrait");
		foreach ($images as $image) {
			$imagefn = $image->getAttribute("src");
			if (file_exists($imagefn)) {
				$imagefn = realpath($imagefn);
				$size = getimagesize($imagefn); // Get image size
				if ($size[0] != 0) {
					if (SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
						$w = $portrait ? 216 : 279;
					} elseif (SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
						$w = $portrait ? 216 : 356;
					} else {
						$w = $portrait ? 210 : 297; // A4 paper (210 mm by 297 mm)
					}
					$w = min($size[0], ($w - 20 * 2) / 25.4 * 72 * Config("PDF_IMAGE_SCALE_FACTOR")); // Resize image, adjust the scale factor if necessary
					$h = $w / $size[0] * $size[1];
					$image->setAttribute("width", $w);
					$image->setAttribute("height", $h);
				}
			}
		}
		$html = $doc->saveHTML();
		$html = ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper($pageSize, $pageOrientation);
		$dompdf->render();
		header('Set-Cookie: fileDownload=true; path=/');
		$exportFile = EndsText(".pdf", $ExportFileName) ? $ExportFileName : $ExportFileName . ".pdf";
		$dompdf->stream($exportFile, ["Attachment" => 1]); // 0 to open in browser, 1 to download
		DeleteTempImages();
		exit();
	}

	// Set up starting group
	protected function setupStartGroup()
	{

		// Exit if no groups
		if ($this->DisplayGroups == 0)
			return;
		$startGrp = Param(Config("TABLE_START_GROUP"), "");
		$pageNo = Param("pageno", "");

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGroup = $startGrp;
			$this->setStartGroup($this->StartGroup);
		} elseif ($pageNo != "") {
			if (is_numeric($pageNo)) {
				$this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
				if ($this->StartGroup <= 0) {
					$this->StartGroup = 1;
				} elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
					$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
				}
				$this->setStartGroup($this->StartGroup);
			} else {
				$this->StartGroup = $this->getStartGroup();
			}
		} else {
			$this->StartGroup = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
			$this->StartGroup = 1; // Reset start group counter
			$this->setStartGroup($this->StartGroup);
		} elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
			$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
			$this->setStartGroup($this->StartGroup);
		} elseif (($this->StartGroup-1) % $this->DisplayGroups != 0) {
			$this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
			$this->setStartGroup($this->StartGroup);
		}
	}

	// Reset pager
	protected function resetPager()
	{

		// Reset start position (reset command)
		$this->StartGroup = 1;
		$this->setStartGroup($this->StartGroup);
	}

	// Set up number of groups displayed per page
	protected function setupDisplayGroups()
	{
		if (Param(Config("TABLE_GROUP_PER_PAGE")) !== NULL) {
			$wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
			if (is_numeric($wrk)) {
				$this->DisplayGroups = intval($wrk);
			} else {
				if (strtoupper($wrk) == "ALL") { // Display all groups
					$this->DisplayGroups = -1;
				} else {
					$this->DisplayGroups = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGroups); // Save to session

			// Reset start position (reset command)
			$this->StartGroup = 1;
			$this->setStartGroup($this->StartGroup);
		} else {
			if ($this->getGroupPerPage() != "") {
				$this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGroups = 3; // Load default
			}
		}
	}

	// Get sort parameters based on sort links clicked
	protected function getSort()
	{
		if ($this->DrillDown)
			return "`Last_Date_Check` ASC";
		$resetSort = Param("cmd") === "resetsort";
		$orderBy = Param("order", "");
		$orderType = Param("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->inventory_id->setSort("");
			$this->month_dsc->setSort("");
			$this->year_dsc->setSort("");
			$this->cat_desc->setSort("");
			$this->item_model->setSort("");
			$this->item_serial->setSort("");
			$this->off_desc->setSort("");
			$this->Last_Date_Check->setSort("");
			$this->inventory_status_dsc->setSort("");
			$this->remarks->setSort("");
			$this->Name_dsc->setSort("");
			$this->user_last_modify->setSort("");
			$this->date_last_modify->setSort("");
			$this->pullout_date->setSort("");
			$this->pos_desc->setSort("");
			$this->current_location->setSort("");
			$this->last_name->setSort("");
			$this->first_name->setSort("");
			$this->mid_name->setSort("");
			$this->ext_name->setSort("");
			$this->full_name->setSort("");
			$this->full_name_tbl->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->inventory_id); // inventory_id
			$this->updateSort($this->month_dsc); // month_dsc
			$this->updateSort($this->year_dsc); // year_dsc
			$this->updateSort($this->cat_desc); // cat_desc
			$this->updateSort($this->item_model); // item_model
			$this->updateSort($this->item_serial); // item_serial
			$this->updateSort($this->off_desc); // off_desc
			$this->updateSort($this->Last_Date_Check); // Last_Date_Check
			$this->updateSort($this->inventory_status_dsc); // inventory_status_dsc
			$this->updateSort($this->remarks); // remarks
			$this->updateSort($this->Name_dsc); // Name_dsc
			$this->updateSort($this->user_last_modify); // user_last_modify
			$this->updateSort($this->date_last_modify); // date_last_modify
			$this->updateSort($this->pullout_date); // pullout_date
			$this->updateSort($this->pos_desc); // pos_desc
			$this->updateSort($this->current_location); // current_location
			$this->updateSort($this->last_name); // last_name
			$this->updateSort($this->first_name); // first_name
			$this->updateSort($this->mid_name); // mid_name
			$this->updateSort($this->ext_name); // ext_name
			$this->updateSort($this->full_name); // full_name
			$this->updateSort($this->full_name_tbl); // full_name_tbl
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}

		// Set up default sort
		if ($this->getOrderBy() == "") {
			$this->setOrderBy("`Last_Date_Check` ASC");
			$this->Last_Date_Check->setSort("ASC");
		}
		return $this->getOrderBy();
	}

	// Return extended filter
	protected function getExtendedFilter()
	{
		global $FormError;
		$filter = "";
		if ($this->DrillDown)
			return "";
		$restoreSession = FALSE;
		$restoreDefault = FALSE;

		// Reset search command
		if (Get("cmd", "") == "reset") {

			// Set default values
			$this->Last_Date_Check->AdvancedSearch->unsetSession();
			$this->Name_dsc->AdvancedSearch->unsetSession();
			$restoreDefault = TRUE;
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field Last_Date_Check
			if ($this->Last_Date_Check->AdvancedSearch->get()) {
			}

			// Field Name_dsc
			$this->getDropDownValue($this->Name_dsc);
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$restoreDefault = TRUE;
			if ($this->Last_Date_Check->AdvancedSearch->issetSession()) { // Field Last_Date_Check
				$this->Last_Date_Check->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->Name_dsc->AdvancedSearch->issetSession()) { // Field Name_dsc
				$this->Name_dsc->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
		}

		// Restore default
		if ($restoreDefault)
			$this->loadDefaultFilters();

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL and save to session
		$this->buildExtendedFilter($this->Last_Date_Check, $filter, FALSE, TRUE); // Field Last_Date_Check
		$this->Last_Date_Check->AdvancedSearch->save();
		$this->buildDropDownFilter($this->Name_dsc, $filter, $this->Name_dsc->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field Name_dsc
		$this->Name_dsc->AdvancedSearch->save();

		// Field Name_dsc
		LoadDropDownList($this->Name_dsc->EditValue, $this->Name_dsc->AdvancedSearch->SearchValue);
		return $filter;
	}

	// Build dropdown filter
	protected function buildDropDownFilter(&$fld, &$filterClause, $fldOpr, $default = FALSE, $saveFilter = FALSE)
	{
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$sql = "";
		if (is_array($fldVal)) {
			foreach ($fldVal as $val) {
				$wrk = $this->getDropDownFilter($fld, $val, $fldOpr);

				// Call Page Filtering event
				if (!StartsString("@@", $val))
					$this->Page_Filtering($fld, $wrk, "dropdown", $fldOpr, $val);
				if ($wrk != "") {
					if ($sql != "")
						$sql .= " OR " . $wrk;
					else
						$sql = $wrk;
				}
			}
		} else {
			$sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr);

			// Call Page Filtering event
			if (!StartsString("@@", $fldVal))
				$this->Page_Filtering($fld, $sql, "dropdown", $fldOpr, $fldVal);
		}
		if ($sql != "") {
			AddFilter($filterClause, $sql);
			if ($saveFilter) $fld->CurrentFilter = $sql;
		}
	}

	// Get dropdown filter
	protected function getDropDownFilter(&$fld, $fldVal, $fldOpr)
	{
		$fldName = $fld->Name;
		$fldExpression = $fld->Expression;
		$fldDataType = $fld->DataType;
		$isMultiple = $fld->HtmlTag == "CHECKBOX" || $fld->HtmlTag == "SELECT" && $fld->SelectMultiple;
		$fldVal = strval($fldVal);
		if ($fldOpr == "") $fldOpr = "=";
		$wrk = "";
		if (SameString($fldVal, Config("NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NULL";
		} elseif (SameString($fldVal, Config("NOT_NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NOT NULL";
		} elseif (SameString($fldVal, EMPTY_VALUE)) {
			$wrk = $fldExpression . " = ''";
		} elseif (SameString($fldVal, ALL_VALUE)) {
			$wrk = "1 = 1";
		} else {
			if ($fld->GroupSql != "") // Use grouping SQL for search if exists
				$fldExpression = str_replace("%s", $fldExpression, $fld->GroupSql);
			if (StartsString("@@", $fldVal)) {
				$wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
			} elseif ($isMultiple && IsMultiSearchOperator($fldOpr) && trim($fldVal) != "" && $fldVal != INIT_VALUE && ($fldDataType == DATATYPE_STRING || $fldDataType == DATATYPE_MEMO)) {
				$wrk = GetMultiSearchSql($fld, $fldOpr, trim($fldVal), $this->Dbid);
			} else {
				if ($fldVal != "" && $fldVal != INIT_VALUE) {
					if ($fldDataType == DATATYPE_DATE && $fld->GroupSql == "" && $fldOpr != "") {
						$wrk = GetDateFilterSql($fldExpression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
					} else {
						$wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
						if ($wrk != "") $wrk = $fldExpression . $wrk;
					}
				}
			}
		}
		return $wrk;
	}

	// Get custom filter
	protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
	{
		$wrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $fldVal && $filter->Enabled) {
					$fldExpr = $fld->Expression;
					$fn = $filter->FunctionName;
					$wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
					if ($fn != "") {
						$fn = PROJECT_NAMESPACE . $fn;
						$wrk = $fn($fldExpr, $dbid);
					} else
						$wrk = "";
					$this->Page_Filtering($fld, $wrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $wrk;
	}

	// Build extended filter
	protected function buildExtendedFilter(&$fld, &$filterClause, $default = FALSE, $saveFilter = FALSE)
	{
		$wrk = GetExtendedFilter($fld, $default, $this->Dbid);
		if (!$default)
			$this->Page_Filtering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
		if ($wrk != "") {
			AddFilter($filterClause, $wrk);
			if ($saveFilter) $fld->CurrentFilter = $wrk;
		}
	}

	// Get drop down value from querystring
	protected function getDropDownValue(&$fld)
	{
		$parm = $fld->Param;
		if (IsPost())
			return FALSE; // Skip post back
		$opr = Get("z_$parm");
		if ($opr !== NULL)
			$fld->AdvancedSearch->SearchOperator = $opr;
		$val = Get("x_$parm");
		if ($val !== NULL) {
			if (is_array($val))
				$val = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val); 
			$fld->AdvancedSearch->setSearchValue($val);
			return TRUE;
		}
		return FALSE;
	}

	// Dropdown filter exist
	protected function dropDownFilterExist(&$fld, $fldOpr)
	{
		$wrk = "";
		$this->buildDropDownFilter($fld, $wrk, $fldOpr);
		return ($wrk != "");
	}

	// Extended filter exist
	protected function extendedFilterExist(&$fld)
	{
		$extWrk = "";
		$this->buildExtendedFilter($fld, $extWrk);
		return ($extWrk != "");
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			$FormError .= ($FormError != "") ? "<p>&nbsp;</p>" : "";
			$FormError .= $formCustomError;
		}
		return $validateForm;
	}

	// Load default value for filters
	protected function loadDefaultFilters()
	{

		/**
		* Set up default values for extended filters
		*/
		// Field Last_Date_Check

		$this->Last_Date_Check->AdvancedSearch->loadDefault();

		// Field Name_dsc
		$this->Name_dsc->AdvancedSearch->loadDefault();
	}

	// Show list of filters
	public function showFilterList()
	{
		global $Language;

		// Initialize
		$filterList = "";
		$captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
		$captionSuffix = $this->isExport("email") ? ": " : "";

		// Field Last_Date_Check
		$extWrk = "";
		$this->buildExtendedFilter($this->Last_Date_Check, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->Last_Date_Check->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field Name_dsc
		$extWrk = "";
		$this->buildDropDownFilter($this->Name_dsc, $extWrk, $this->Name_dsc->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->Name_dsc->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Show Filters
		if ($filterList != "") {
			$message = "<div id=\"ew-filter-list\" class=\"alert alert-info d-table\"><div id=\"ew-current-filters\">" .
				$Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
			$message = "<script id=\"tp_current_filters\" type=\"text/html\">" . $message . "</script>";
			$this->Message_Showing($message, "");
			Write($message);
		} else {
			Write("<script id=\"tp_current_filters\" type=\"text/html\"></script>"); // Output dummy tag
		}
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Field Last_Date_Check
		$wrk = "";
		if ($this->Last_Date_Check->AdvancedSearch->SearchValue != "" || $this->Last_Date_Check->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_Last_Date_Check\":\"" . JsEncode($this->Last_Date_Check->AdvancedSearch->SearchValue) . "\"," .
				"\"z_Last_Date_Check\":\"" . JsEncode($this->Last_Date_Check->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_Last_Date_Check\":\"" . JsEncode($this->Last_Date_Check->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_Last_Date_Check\":\"" . JsEncode($this->Last_Date_Check->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_Last_Date_Check\":\"" . JsEncode($this->Last_Date_Check->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field Name_dsc
		$wrk = "";
		$wrk = ($this->Name_dsc->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->Name_dsc->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_Name_dsc\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Return filter list in json
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd", "") != "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter", ""), TRUE);
		return $this->setupFilterList($filter);
	}

	// Setup list of filters
	protected function setupFilterList($filter)
	{
		if (!is_array($filter))
			return FALSE;

		// Field Last_Date_Check
		if (!$this->Last_Date_Check->AdvancedSearch->getFromArray($filter))
			$this->Last_Date_Check->AdvancedSearch->loadDefault(); // Clear filter
		$this->Last_Date_Check->AdvancedSearch->save();

		// Field Name_dsc
		if (!$this->Name_dsc->AdvancedSearch->getFromArray($filter))
			$this->Name_dsc->AdvancedSearch->loadDefault(); // Clear filter
		$this->Name_dsc->AdvancedSearch->save();
		return TRUE;
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
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>