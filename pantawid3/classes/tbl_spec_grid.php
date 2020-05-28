<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_spec_grid extends tbl_spec
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_spec';

	// Page object name
	public $PageObjName = "tbl_spec_grid";

	// Grid form hidden field names
	public $FormName = "ftbl_specgrid";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

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
		if ($this->TableName)
			return $Language->phrase($this->PageID);
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
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
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
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
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
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (tbl_spec)
		if (!isset($GLOBALS["tbl_spec"]) || get_class($GLOBALS["tbl_spec"]) == PROJECT_NAMESPACE . "tbl_spec") {
			$GLOBALS["tbl_spec"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["tbl_spec"];

		}
		$this->AddUrl = "tbl_specadd.php";

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_spec');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $tbl_spec;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($tbl_spec);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

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
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['specID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->specID->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->user_last_modify->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->date_last_modify->Visible = FALSE;
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $ShowOtherOptions = FALSE;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = ""; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

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
			if (!$Security->canList()) {
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

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->specID->Visible = FALSE;
		$this->pr_number->setVisibility();
		$this->spec_unit->setVisibility();
		$this->spec_dsc->setVisibility();
		$this->spec_qty->setVisibility();
		$this->spec_unitprice->setVisibility();
		$this->spec_totalprice->setVisibility();
		$this->employeeID->Visible = FALSE;
		$this->user_last_modify->Visible = FALSE;
		$this->date_last_modify->Visible = FALSE;
		$this->hideFieldsForAddEdit();

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

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->spec_unit);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "tbl_pr") {
			global $tbl_pr;
			$rsmaster = $tbl_pr->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("tbl_prlist.php"); // Return to master page
			} else {
				$tbl_pr->loadListRowValues($rsmaster);
				$tbl_pr->RowType = ROWTYPE_MASTER; // Master row
				$tbl_pr->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->spec_qty->FormValue = ""; // Clear form value
		$this->spec_unitprice->FormValue = ""; // Clear form value
		$this->spec_totalprice->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->specID->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->specID->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->specID->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_pr_number") && $CurrentForm->hasValue("o_pr_number") && $this->pr_number->CurrentValue != $this->pr_number->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_spec_unit") && $CurrentForm->hasValue("o_spec_unit") && $this->spec_unit->CurrentValue != $this->spec_unit->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_spec_dsc") && $CurrentForm->hasValue("o_spec_dsc") && $this->spec_dsc->CurrentValue != $this->spec_dsc->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_spec_qty") && $CurrentForm->hasValue("o_spec_qty") && $this->spec_qty->CurrentValue != $this->spec_qty->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_spec_unitprice") && $CurrentForm->hasValue("o_spec_unitprice") && $this->spec_unitprice->CurrentValue != $this->spec_unitprice->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_spec_totalprice") && $CurrentForm->hasValue("o_spec_totalprice") && $this->spec_totalprice->CurrentValue != $this->spec_totalprice->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->pr_number->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = FALSE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$opt = $this->ListOptions["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecordCount);
		if ($this->CurrentMode == "view") { // View mode

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->specID->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('specID');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = FALSE;
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->specID->CurrentValue = NULL;
		$this->specID->OldValue = $this->specID->CurrentValue;
		$this->pr_number->CurrentValue = NULL;
		$this->pr_number->OldValue = $this->pr_number->CurrentValue;
		$this->spec_unit->CurrentValue = NULL;
		$this->spec_unit->OldValue = $this->spec_unit->CurrentValue;
		$this->spec_dsc->CurrentValue = NULL;
		$this->spec_dsc->OldValue = $this->spec_dsc->CurrentValue;
		$this->spec_qty->CurrentValue = NULL;
		$this->spec_qty->OldValue = $this->spec_qty->CurrentValue;
		$this->spec_unitprice->CurrentValue = NULL;
		$this->spec_unitprice->OldValue = $this->spec_unitprice->CurrentValue;
		$this->spec_totalprice->CurrentValue = NULL;
		$this->spec_totalprice->OldValue = $this->spec_totalprice->CurrentValue;
		$this->employeeID->CurrentValue = NULL;
		$this->employeeID->OldValue = $this->employeeID->CurrentValue;
		$this->user_last_modify->CurrentValue = NULL;
		$this->user_last_modify->OldValue = $this->user_last_modify->CurrentValue;
		$this->date_last_modify->CurrentValue = NULL;
		$this->date_last_modify->OldValue = $this->date_last_modify->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'pr_number' first before field var 'x_pr_number'
		$val = $CurrentForm->hasValue("pr_number") ? $CurrentForm->getValue("pr_number") : $CurrentForm->getValue("x_pr_number");
		if (!$this->pr_number->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pr_number->Visible = FALSE; // Disable update for API request
			else
				$this->pr_number->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pr_number"))
			$this->pr_number->setOldValue($CurrentForm->getValue("o_pr_number"));

		// Check field name 'spec_unit' first before field var 'x_spec_unit'
		$val = $CurrentForm->hasValue("spec_unit") ? $CurrentForm->getValue("spec_unit") : $CurrentForm->getValue("x_spec_unit");
		if (!$this->spec_unit->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_unit->Visible = FALSE; // Disable update for API request
			else
				$this->spec_unit->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_spec_unit"))
			$this->spec_unit->setOldValue($CurrentForm->getValue("o_spec_unit"));

		// Check field name 'spec_dsc' first before field var 'x_spec_dsc'
		$val = $CurrentForm->hasValue("spec_dsc") ? $CurrentForm->getValue("spec_dsc") : $CurrentForm->getValue("x_spec_dsc");
		if (!$this->spec_dsc->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_dsc->Visible = FALSE; // Disable update for API request
			else
				$this->spec_dsc->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_spec_dsc"))
			$this->spec_dsc->setOldValue($CurrentForm->getValue("o_spec_dsc"));

		// Check field name 'spec_qty' first before field var 'x_spec_qty'
		$val = $CurrentForm->hasValue("spec_qty") ? $CurrentForm->getValue("spec_qty") : $CurrentForm->getValue("x_spec_qty");
		if (!$this->spec_qty->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_qty->Visible = FALSE; // Disable update for API request
			else
				$this->spec_qty->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_spec_qty"))
			$this->spec_qty->setOldValue($CurrentForm->getValue("o_spec_qty"));

		// Check field name 'spec_unitprice' first before field var 'x_spec_unitprice'
		$val = $CurrentForm->hasValue("spec_unitprice") ? $CurrentForm->getValue("spec_unitprice") : $CurrentForm->getValue("x_spec_unitprice");
		if (!$this->spec_unitprice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_unitprice->Visible = FALSE; // Disable update for API request
			else
				$this->spec_unitprice->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_spec_unitprice"))
			$this->spec_unitprice->setOldValue($CurrentForm->getValue("o_spec_unitprice"));

		// Check field name 'spec_totalprice' first before field var 'x_spec_totalprice'
		$val = $CurrentForm->hasValue("spec_totalprice") ? $CurrentForm->getValue("spec_totalprice") : $CurrentForm->getValue("x_spec_totalprice");
		if (!$this->spec_totalprice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_totalprice->Visible = FALSE; // Disable update for API request
			else
				$this->spec_totalprice->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_spec_totalprice"))
			$this->spec_totalprice->setOldValue($CurrentForm->getValue("o_spec_totalprice"));

		// Check field name 'specID' first before field var 'x_specID'
		$val = $CurrentForm->hasValue("specID") ? $CurrentForm->getValue("specID") : $CurrentForm->getValue("x_specID");
		if (!$this->specID->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->specID->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->specID->CurrentValue = $this->specID->FormValue;
		$this->pr_number->CurrentValue = $this->pr_number->FormValue;
		$this->spec_unit->CurrentValue = $this->spec_unit->FormValue;
		$this->spec_dsc->CurrentValue = $this->spec_dsc->FormValue;
		$this->spec_qty->CurrentValue = $this->spec_qty->FormValue;
		$this->spec_unitprice->CurrentValue = $this->spec_unitprice->FormValue;
		$this->spec_totalprice->CurrentValue = $this->spec_totalprice->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->specID->setDbValue($row['specID']);
		$this->pr_number->setDbValue($row['pr_number']);
		$this->spec_unit->setDbValue($row['spec_unit']);
		$this->spec_dsc->setDbValue($row['spec_dsc']);
		$this->spec_qty->setDbValue($row['spec_qty']);
		$this->spec_unitprice->setDbValue($row['spec_unitprice']);
		$this->spec_totalprice->setDbValue($row['spec_totalprice']);
		$this->employeeID->setDbValue($row['employeeID']);
		$this->user_last_modify->setDbValue($row['user_last_modify']);
		$this->date_last_modify->setDbValue($row['date_last_modify']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['specID'] = $this->specID->CurrentValue;
		$row['pr_number'] = $this->pr_number->CurrentValue;
		$row['spec_unit'] = $this->spec_unit->CurrentValue;
		$row['spec_dsc'] = $this->spec_dsc->CurrentValue;
		$row['spec_qty'] = $this->spec_qty->CurrentValue;
		$row['spec_unitprice'] = $this->spec_unitprice->CurrentValue;
		$row['spec_totalprice'] = $this->spec_totalprice->CurrentValue;
		$row['employeeID'] = $this->employeeID->CurrentValue;
		$row['user_last_modify'] = $this->user_last_modify->CurrentValue;
		$row['date_last_modify'] = $this->date_last_modify->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->specID->OldValue = strval($keys[0]); // specID
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->spec_qty->FormValue == $this->spec_qty->CurrentValue && is_numeric(ConvertToFloatString($this->spec_qty->CurrentValue)))
			$this->spec_qty->CurrentValue = ConvertToFloatString($this->spec_qty->CurrentValue);

		// Convert decimal values if posted back
		if ($this->spec_unitprice->FormValue == $this->spec_unitprice->CurrentValue && is_numeric(ConvertToFloatString($this->spec_unitprice->CurrentValue)))
			$this->spec_unitprice->CurrentValue = ConvertToFloatString($this->spec_unitprice->CurrentValue);

		// Convert decimal values if posted back
		if ($this->spec_totalprice->FormValue == $this->spec_totalprice->CurrentValue && is_numeric(ConvertToFloatString($this->spec_totalprice->CurrentValue)))
			$this->spec_totalprice->CurrentValue = ConvertToFloatString($this->spec_totalprice->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// specID

		$this->specID->CellCssStyle = "width: 0px; white-space: nowrap;";

		// pr_number
		$this->pr_number->CellCssStyle = "width: 0px; white-space: nowrap;";

		// spec_unit
		$this->spec_unit->CellCssStyle = "width: 0px; white-space: nowrap;";

		// spec_dsc
		$this->spec_dsc->CellCssStyle = "width: 0px; white-space: nowrap;";

		// spec_qty
		$this->spec_qty->CellCssStyle = "width: 0px; white-space: nowrap;";

		// spec_unitprice
		$this->spec_unitprice->CellCssStyle = "width: 0px; white-space: nowrap;";

		// spec_totalprice
		$this->spec_totalprice->CellCssStyle = "width: 0px; white-space: nowrap;";

		// employeeID
		$this->employeeID->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_last_modify
		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_last_modify
		$this->date_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Accumulate aggregate value
		if ($this->RowType != ROWTYPE_AGGREGATEINIT && $this->RowType != ROWTYPE_AGGREGATE) {
			if (is_numeric($this->spec_totalprice->CurrentValue))
				$this->spec_totalprice->Total += $this->spec_totalprice->CurrentValue; // Accumulate total
		}
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// specID
			$this->specID->ViewValue = $this->specID->CurrentValue;
			$this->specID->ViewCustomAttributes = "";

			// pr_number
			$this->pr_number->ViewValue = $this->pr_number->CurrentValue;
			$this->pr_number->ViewCustomAttributes = "";

			// spec_unit
			$curVal = strval($this->spec_unit->CurrentValue);
			if ($curVal != "") {
				$this->spec_unit->ViewValue = $this->spec_unit->lookupCacheOption($curVal);
				if ($this->spec_unit->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`pruID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->spec_unit->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->spec_unit->ViewValue = $this->spec_unit->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->spec_unit->ViewValue = $this->spec_unit->CurrentValue;
					}
				}
			} else {
				$this->spec_unit->ViewValue = NULL;
			}
			$this->spec_unit->ViewCustomAttributes = "";

			// spec_dsc
			$this->spec_dsc->ViewValue = $this->spec_dsc->CurrentValue;
			if ($this->spec_dsc->ViewValue != NULL)
				$this->spec_dsc->ViewValue = str_replace("\n", "<br>", $this->spec_dsc->ViewValue);
			$this->spec_dsc->ViewCustomAttributes = "";

			// spec_qty
			$this->spec_qty->ViewValue = $this->spec_qty->CurrentValue;
			$this->spec_qty->ViewValue = FormatNumber($this->spec_qty->ViewValue, 2, -2, -2, -2);
			$this->spec_qty->ViewCustomAttributes = "";

			// spec_unitprice
			$this->spec_unitprice->ViewValue = $this->spec_unitprice->CurrentValue;
			$this->spec_unitprice->ViewValue = FormatNumber($this->spec_unitprice->ViewValue, 2, -2, -2, -2);
			$this->spec_unitprice->ViewCustomAttributes = "";

			// spec_totalprice
			$this->spec_totalprice->ViewValue = $this->spec_totalprice->CurrentValue;
			$this->spec_totalprice->ViewValue = FormatNumber($this->spec_totalprice->ViewValue, 2, -1, -1, -1);
			$this->spec_totalprice->ViewCustomAttributes = "";

			// user_last_modify
			$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
			$this->user_last_modify->ViewCustomAttributes = "";

			// date_last_modify
			$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
			$this->date_last_modify->ViewCustomAttributes = "";

			// pr_number
			$this->pr_number->LinkCustomAttributes = "";
			$this->pr_number->HrefValue = "";
			$this->pr_number->TooltipValue = "";

			// spec_unit
			$this->spec_unit->LinkCustomAttributes = "";
			$this->spec_unit->HrefValue = "";
			$this->spec_unit->TooltipValue = "";

			// spec_dsc
			$this->spec_dsc->LinkCustomAttributes = "";
			$this->spec_dsc->HrefValue = "";
			$this->spec_dsc->TooltipValue = "";

			// spec_qty
			$this->spec_qty->LinkCustomAttributes = "";
			$this->spec_qty->HrefValue = "";
			$this->spec_qty->TooltipValue = "";

			// spec_unitprice
			$this->spec_unitprice->LinkCustomAttributes = "";
			$this->spec_unitprice->HrefValue = "";
			$this->spec_unitprice->TooltipValue = "";

			// spec_totalprice
			$this->spec_totalprice->LinkCustomAttributes = "";
			$this->spec_totalprice->HrefValue = "";
			$this->spec_totalprice->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pr_number
			$this->pr_number->EditAttrs["class"] = "form-control";
			$this->pr_number->EditCustomAttributes = "";
			if ($this->pr_number->getSessionValue() != "") {
				$this->pr_number->CurrentValue = $this->pr_number->getSessionValue();
				$this->pr_number->OldValue = $this->pr_number->CurrentValue;
				$this->pr_number->ViewValue = $this->pr_number->CurrentValue;
				$this->pr_number->ViewCustomAttributes = "";
			} else {
				if (!$this->pr_number->Raw)
					$this->pr_number->CurrentValue = HtmlDecode($this->pr_number->CurrentValue);
				$this->pr_number->EditValue = HtmlEncode($this->pr_number->CurrentValue);
				$this->pr_number->PlaceHolder = RemoveHtml($this->pr_number->caption());
			}

			// spec_unit
			$this->spec_unit->EditAttrs["class"] = "form-control";
			$this->spec_unit->EditCustomAttributes = "";
			$curVal = trim(strval($this->spec_unit->CurrentValue));
			if ($curVal != "")
				$this->spec_unit->ViewValue = $this->spec_unit->lookupCacheOption($curVal);
			else
				$this->spec_unit->ViewValue = $this->spec_unit->Lookup !== NULL && is_array($this->spec_unit->Lookup->Options) ? $curVal : NULL;
			if ($this->spec_unit->ViewValue !== NULL) { // Load from cache
				$this->spec_unit->EditValue = array_values($this->spec_unit->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`pruID`" . SearchString("=", $this->spec_unit->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->spec_unit->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->spec_unit->EditValue = $arwrk;
			}

			// spec_dsc
			$this->spec_dsc->EditAttrs["class"] = "form-control";
			$this->spec_dsc->EditCustomAttributes = "";
			$this->spec_dsc->EditValue = HtmlEncode($this->spec_dsc->CurrentValue);
			$this->spec_dsc->PlaceHolder = RemoveHtml($this->spec_dsc->caption());

			// spec_qty
			$this->spec_qty->EditAttrs["class"] = "form-control";
			$this->spec_qty->EditCustomAttributes = "";
			$this->spec_qty->EditValue = HtmlEncode($this->spec_qty->CurrentValue);
			$this->spec_qty->PlaceHolder = RemoveHtml($this->spec_qty->caption());
			if (strval($this->spec_qty->EditValue) != "" && is_numeric($this->spec_qty->EditValue)) {
				$this->spec_qty->EditValue = FormatNumber($this->spec_qty->EditValue, -2, -2, -2, -2);
				$this->spec_qty->OldValue = $this->spec_qty->EditValue;
			}
			

			// spec_unitprice
			$this->spec_unitprice->EditAttrs["class"] = "form-control";
			$this->spec_unitprice->EditCustomAttributes = "";
			$this->spec_unitprice->EditValue = HtmlEncode($this->spec_unitprice->CurrentValue);
			$this->spec_unitprice->PlaceHolder = RemoveHtml($this->spec_unitprice->caption());
			if (strval($this->spec_unitprice->EditValue) != "" && is_numeric($this->spec_unitprice->EditValue)) {
				$this->spec_unitprice->EditValue = FormatNumber($this->spec_unitprice->EditValue, -2, -2, -2, -2);
				$this->spec_unitprice->OldValue = $this->spec_unitprice->EditValue;
			}
			

			// spec_totalprice
			$this->spec_totalprice->EditAttrs["class"] = "form-control";
			$this->spec_totalprice->EditCustomAttributes = "";
			$this->spec_totalprice->EditValue = HtmlEncode($this->spec_totalprice->CurrentValue);
			$this->spec_totalprice->PlaceHolder = RemoveHtml($this->spec_totalprice->caption());
			if (strval($this->spec_totalprice->EditValue) != "" && is_numeric($this->spec_totalprice->EditValue)) {
				$this->spec_totalprice->EditValue = FormatNumber($this->spec_totalprice->EditValue, -2, -1, -2, -1);
				$this->spec_totalprice->OldValue = $this->spec_totalprice->EditValue;
			}
			

			// Add refer script
			// pr_number

			$this->pr_number->LinkCustomAttributes = "";
			$this->pr_number->HrefValue = "";

			// spec_unit
			$this->spec_unit->LinkCustomAttributes = "";
			$this->spec_unit->HrefValue = "";

			// spec_dsc
			$this->spec_dsc->LinkCustomAttributes = "";
			$this->spec_dsc->HrefValue = "";

			// spec_qty
			$this->spec_qty->LinkCustomAttributes = "";
			$this->spec_qty->HrefValue = "";

			// spec_unitprice
			$this->spec_unitprice->LinkCustomAttributes = "";
			$this->spec_unitprice->HrefValue = "";

			// spec_totalprice
			$this->spec_totalprice->LinkCustomAttributes = "";
			$this->spec_totalprice->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// pr_number
			$this->pr_number->EditAttrs["class"] = "form-control";
			$this->pr_number->EditCustomAttributes = "";
			if ($this->pr_number->getSessionValue() != "") {
				$this->pr_number->CurrentValue = $this->pr_number->getSessionValue();
				$this->pr_number->OldValue = $this->pr_number->CurrentValue;
				$this->pr_number->ViewValue = $this->pr_number->CurrentValue;
				$this->pr_number->ViewCustomAttributes = "";
			} else {
				if (!$this->pr_number->Raw)
					$this->pr_number->CurrentValue = HtmlDecode($this->pr_number->CurrentValue);
				$this->pr_number->EditValue = HtmlEncode($this->pr_number->CurrentValue);
				$this->pr_number->PlaceHolder = RemoveHtml($this->pr_number->caption());
			}

			// spec_unit
			$this->spec_unit->EditAttrs["class"] = "form-control";
			$this->spec_unit->EditCustomAttributes = "";
			$curVal = trim(strval($this->spec_unit->CurrentValue));
			if ($curVal != "")
				$this->spec_unit->ViewValue = $this->spec_unit->lookupCacheOption($curVal);
			else
				$this->spec_unit->ViewValue = $this->spec_unit->Lookup !== NULL && is_array($this->spec_unit->Lookup->Options) ? $curVal : NULL;
			if ($this->spec_unit->ViewValue !== NULL) { // Load from cache
				$this->spec_unit->EditValue = array_values($this->spec_unit->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`pruID`" . SearchString("=", $this->spec_unit->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->spec_unit->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->spec_unit->EditValue = $arwrk;
			}

			// spec_dsc
			$this->spec_dsc->EditAttrs["class"] = "form-control";
			$this->spec_dsc->EditCustomAttributes = "";
			$this->spec_dsc->EditValue = HtmlEncode($this->spec_dsc->CurrentValue);
			$this->spec_dsc->PlaceHolder = RemoveHtml($this->spec_dsc->caption());

			// spec_qty
			$this->spec_qty->EditAttrs["class"] = "form-control";
			$this->spec_qty->EditCustomAttributes = "";
			$this->spec_qty->EditValue = HtmlEncode($this->spec_qty->CurrentValue);
			$this->spec_qty->PlaceHolder = RemoveHtml($this->spec_qty->caption());
			if (strval($this->spec_qty->EditValue) != "" && is_numeric($this->spec_qty->EditValue)) {
				$this->spec_qty->EditValue = FormatNumber($this->spec_qty->EditValue, -2, -2, -2, -2);
				$this->spec_qty->OldValue = $this->spec_qty->EditValue;
			}
			

			// spec_unitprice
			$this->spec_unitprice->EditAttrs["class"] = "form-control";
			$this->spec_unitprice->EditCustomAttributes = "";
			$this->spec_unitprice->EditValue = HtmlEncode($this->spec_unitprice->CurrentValue);
			$this->spec_unitprice->PlaceHolder = RemoveHtml($this->spec_unitprice->caption());
			if (strval($this->spec_unitprice->EditValue) != "" && is_numeric($this->spec_unitprice->EditValue)) {
				$this->spec_unitprice->EditValue = FormatNumber($this->spec_unitprice->EditValue, -2, -2, -2, -2);
				$this->spec_unitprice->OldValue = $this->spec_unitprice->EditValue;
			}
			

			// spec_totalprice
			$this->spec_totalprice->EditAttrs["class"] = "form-control";
			$this->spec_totalprice->EditCustomAttributes = "";
			$this->spec_totalprice->EditValue = HtmlEncode($this->spec_totalprice->CurrentValue);
			$this->spec_totalprice->PlaceHolder = RemoveHtml($this->spec_totalprice->caption());
			if (strval($this->spec_totalprice->EditValue) != "" && is_numeric($this->spec_totalprice->EditValue)) {
				$this->spec_totalprice->EditValue = FormatNumber($this->spec_totalprice->EditValue, -2, -1, -2, -1);
				$this->spec_totalprice->OldValue = $this->spec_totalprice->EditValue;
			}
			

			// Edit refer script
			// pr_number

			$this->pr_number->LinkCustomAttributes = "";
			$this->pr_number->HrefValue = "";

			// spec_unit
			$this->spec_unit->LinkCustomAttributes = "";
			$this->spec_unit->HrefValue = "";

			// spec_dsc
			$this->spec_dsc->LinkCustomAttributes = "";
			$this->spec_dsc->HrefValue = "";

			// spec_qty
			$this->spec_qty->LinkCustomAttributes = "";
			$this->spec_qty->HrefValue = "";

			// spec_unitprice
			$this->spec_unitprice->LinkCustomAttributes = "";
			$this->spec_unitprice->HrefValue = "";

			// spec_totalprice
			$this->spec_totalprice->LinkCustomAttributes = "";
			$this->spec_totalprice->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->spec_totalprice->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->spec_totalprice->CurrentValue = $this->spec_totalprice->Total;
			$this->spec_totalprice->ViewValue = $this->spec_totalprice->CurrentValue;
			$this->spec_totalprice->ViewValue = FormatNumber($this->spec_totalprice->ViewValue, 2, -1, -1, -1);
			$this->spec_totalprice->ViewCustomAttributes = "";
			$this->spec_totalprice->HrefValue = ""; // Clear href value
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->pr_number->Required) {
			if (!$this->pr_number->IsDetailKey && $this->pr_number->FormValue != NULL && $this->pr_number->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pr_number->caption(), $this->pr_number->RequiredErrorMessage));
			}
		}
		if ($this->spec_unit->Required) {
			if (!$this->spec_unit->IsDetailKey && $this->spec_unit->FormValue != NULL && $this->spec_unit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->spec_unit->caption(), $this->spec_unit->RequiredErrorMessage));
			}
		}
		if ($this->spec_dsc->Required) {
			if (!$this->spec_dsc->IsDetailKey && $this->spec_dsc->FormValue != NULL && $this->spec_dsc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->spec_dsc->caption(), $this->spec_dsc->RequiredErrorMessage));
			}
		}
		if ($this->spec_qty->Required) {
			if (!$this->spec_qty->IsDetailKey && $this->spec_qty->FormValue != NULL && $this->spec_qty->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->spec_qty->caption(), $this->spec_qty->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->spec_qty->FormValue)) {
			AddMessage($FormError, $this->spec_qty->errorMessage());
		}
		if ($this->spec_unitprice->Required) {
			if (!$this->spec_unitprice->IsDetailKey && $this->spec_unitprice->FormValue != NULL && $this->spec_unitprice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->spec_unitprice->caption(), $this->spec_unitprice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->spec_unitprice->FormValue)) {
			AddMessage($FormError, $this->spec_unitprice->errorMessage());
		}
		if ($this->spec_totalprice->Required) {
			if (!$this->spec_totalprice->IsDetailKey && $this->spec_totalprice->FormValue != NULL && $this->spec_totalprice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->spec_totalprice->caption(), $this->spec_totalprice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->spec_totalprice->FormValue)) {
			AddMessage($FormError, $this->spec_totalprice->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['specID'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// pr_number
			$this->pr_number->setDbValueDef($rsnew, $this->pr_number->CurrentValue, NULL, $this->pr_number->ReadOnly);

			// spec_unit
			$this->spec_unit->setDbValueDef($rsnew, $this->spec_unit->CurrentValue, NULL, $this->spec_unit->ReadOnly);

			// spec_dsc
			$this->spec_dsc->setDbValueDef($rsnew, $this->spec_dsc->CurrentValue, NULL, $this->spec_dsc->ReadOnly);

			// spec_qty
			$this->spec_qty->setDbValueDef($rsnew, $this->spec_qty->CurrentValue, NULL, $this->spec_qty->ReadOnly);

			// spec_unitprice
			$this->spec_unitprice->setDbValueDef($rsnew, $this->spec_unitprice->CurrentValue, NULL, $this->spec_unitprice->ReadOnly);

			// spec_totalprice
			$this->spec_totalprice->setDbValueDef($rsnew, $this->spec_totalprice->CurrentValue, NULL, $this->spec_totalprice->ReadOnly);

			// Check referential integrity for master table 'tbl_pr'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_tbl_pr();
			$keyValue = isset($rsnew['pr_number']) ? $rsnew['pr_number'] : $rsold['pr_number'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@pr_number@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["tbl_pr"]))
					$GLOBALS["tbl_pr"] = new tbl_pr();
				$rsmaster = $GLOBALS["tbl_pr"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "tbl_pr", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "tbl_pr") {
				$this->pr_number->CurrentValue = $this->pr_number->getSessionValue();
			}

		// Check referential integrity for master table 'tbl_spec'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_tbl_pr();
		if (strval($this->pr_number->CurrentValue) != "") {
			$masterFilter = str_replace("@pr_number@", AdjustSql($this->pr_number->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["tbl_pr"]))
				$GLOBALS["tbl_pr"] = new tbl_pr();
			$rsmaster = $GLOBALS["tbl_pr"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "tbl_pr", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// pr_number
		$this->pr_number->setDbValueDef($rsnew, $this->pr_number->CurrentValue, NULL, FALSE);

		// spec_unit
		$this->spec_unit->setDbValueDef($rsnew, $this->spec_unit->CurrentValue, NULL, FALSE);

		// spec_dsc
		$this->spec_dsc->setDbValueDef($rsnew, $this->spec_dsc->CurrentValue, NULL, FALSE);

		// spec_qty
		$this->spec_qty->setDbValueDef($rsnew, $this->spec_qty->CurrentValue, NULL, FALSE);

		// spec_unitprice
		$this->spec_unitprice->setDbValueDef($rsnew, $this->spec_unitprice->CurrentValue, NULL, FALSE);

		// spec_totalprice
		$this->spec_totalprice->setDbValueDef($rsnew, $this->spec_totalprice->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "tbl_pr") {
			$this->pr_number->Visible = FALSE;
			if ($GLOBALS["tbl_pr"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_spec_unit":
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
						case "x_spec_unit":
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}
} // End class
?>