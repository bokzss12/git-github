<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_repair_grid extends tbl_repair
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_repair';

	// Page object name
	public $PageObjName = "tbl_repair_grid";

	// Grid form hidden field names
	public $FormName = "ftbl_repairgrid";
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

		// Table object (tbl_repair)
		if (!isset($GLOBALS["tbl_repair"]) || get_class($GLOBALS["tbl_repair"]) == PROJECT_NAMESPACE . "tbl_repair") {
			$GLOBALS["tbl_repair"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["tbl_repair"];

		}
		$this->AddUrl = "tbl_repairadd.php";

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_repair');

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
		global $tbl_repair;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($tbl_repair);
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
			$key .= @$ar['repair_id'];
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
			$this->repair_id->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->userlastmodify->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->datelastmodify->Visible = FALSE;
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
		$this->repair_id->Visible = FALSE;
		$this->inventory_id->setVisibility();
		$this->current_loc_r->Visible = FALSE;
		$this->inventory_idr->setVisibility();
		$this->date_received->Visible = FALSE;
		$this->date_repaired->setVisibility();
		$this->date_pullout->Visible = FALSE;
		$this->name_accountable->Visible = FALSE;
		$this->Designation->Visible = FALSE;
		$this->office_id->Visible = FALSE;
		$this->region->Visible = FALSE;
		$this->province->Visible = FALSE;
		$this->city->Visible = FALSE;
		$this->itemtype->Visible = FALSE;
		$this->itemmodel->Visible = FALSE;
		$this->item_serial->Visible = FALSE;
		$this->type_problem->setVisibility();
		$this->action_taken->setVisibility();
		$this->employee_id->setVisibility();
		$this->status_h->setVisibility();
		$this->pullout_r->Visible = FALSE;
		$this->remark->setVisibility();
		$this->userlastmodify->Visible = FALSE;
		$this->datelastmodify->Visible = FALSE;
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
		$this->setupLookupOptions($this->current_loc_r);
		$this->setupLookupOptions($this->name_accountable);
		$this->setupLookupOptions($this->Designation);
		$this->setupLookupOptions($this->office_id);
		$this->setupLookupOptions($this->region);
		$this->setupLookupOptions($this->province);
		$this->setupLookupOptions($this->city);
		$this->setupLookupOptions($this->itemtype);
		$this->setupLookupOptions($this->status_h);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "tbl_inventory") {
			global $tbl_inventory;
			$rsmaster = $tbl_inventory->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("tbl_inventorylist.php"); // Return to master page
			} else {
				$tbl_inventory->loadListRowValues($rsmaster);
				$tbl_inventory->RowType = ROWTYPE_MASTER; // Master row
				$tbl_inventory->renderListRow();
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
			$this->repair_id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->repair_id->OldValue))
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
					$key .= $this->repair_id->CurrentValue;

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
		if ($CurrentForm->hasValue("x_inventory_id") && $CurrentForm->hasValue("o_inventory_id") && $this->inventory_id->CurrentValue != $this->inventory_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_inventory_idr") && $CurrentForm->hasValue("o_inventory_idr") && $this->inventory_idr->CurrentValue != $this->inventory_idr->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_date_repaired") && $CurrentForm->hasValue("o_date_repaired") && $this->date_repaired->CurrentValue != $this->date_repaired->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_type_problem") && $CurrentForm->hasValue("o_type_problem") && $this->type_problem->CurrentValue != $this->type_problem->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_action_taken") && $CurrentForm->hasValue("o_action_taken") && $this->action_taken->CurrentValue != $this->action_taken->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_employee_id") && $CurrentForm->hasValue("o_employee_id") && $this->employee_id->CurrentValue != $this->employee_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_status_h") && $CurrentForm->hasValue("o_status_h") && $this->status_h->CurrentValue != $this->status_h->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_remark") && $CurrentForm->hasValue("o_remark") && $this->remark->CurrentValue != $this->remark->OldValue)
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
				$this->itemtype->setSessionValue("");
				$this->itemmodel->setSessionValue("");
				$this->item_serial->setSessionValue("");
				$this->office_id->setSessionValue("");
				$this->name_accountable->setSessionValue("");
				$this->Designation->setSessionValue("");
				$this->region->setSessionValue("");
				$this->province->setSessionValue("");
				$this->city->setSessionValue("");
				$this->inventory_id->setSessionValue("");
				$this->inventory_idr->setSessionValue("");
				$this->current_loc_r->setSessionValue("");
				$this->date_received->setSessionValue("");
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
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->repair_id->CurrentValue . "\">";
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
		$key .= $rs->fields('repair_id');
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

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
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
				$item->Visible = $Security->canAdd();
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
		$this->repair_id->CurrentValue = NULL;
		$this->repair_id->OldValue = $this->repair_id->CurrentValue;
		$this->inventory_id->CurrentValue = NULL;
		$this->inventory_id->OldValue = $this->inventory_id->CurrentValue;
		$this->current_loc_r->CurrentValue = NULL;
		$this->current_loc_r->OldValue = $this->current_loc_r->CurrentValue;
		$this->inventory_idr->CurrentValue = NULL;
		$this->inventory_idr->OldValue = $this->inventory_idr->CurrentValue;
		$this->date_received->CurrentValue = NULL;
		$this->date_received->OldValue = $this->date_received->CurrentValue;
		$this->date_repaired->CurrentValue = date("m/d/Y");
		$this->date_repaired->OldValue = $this->date_repaired->CurrentValue;
		$this->date_pullout->CurrentValue = NULL;
		$this->date_pullout->OldValue = $this->date_pullout->CurrentValue;
		$this->name_accountable->CurrentValue = NULL;
		$this->name_accountable->OldValue = $this->name_accountable->CurrentValue;
		$this->Designation->CurrentValue = NULL;
		$this->Designation->OldValue = $this->Designation->CurrentValue;
		$this->office_id->CurrentValue = NULL;
		$this->office_id->OldValue = $this->office_id->CurrentValue;
		$this->region->CurrentValue = NULL;
		$this->region->OldValue = $this->region->CurrentValue;
		$this->province->CurrentValue = NULL;
		$this->province->OldValue = $this->province->CurrentValue;
		$this->city->CurrentValue = NULL;
		$this->city->OldValue = $this->city->CurrentValue;
		$this->itemtype->CurrentValue = NULL;
		$this->itemtype->OldValue = $this->itemtype->CurrentValue;
		$this->itemmodel->CurrentValue = NULL;
		$this->itemmodel->OldValue = $this->itemmodel->CurrentValue;
		$this->item_serial->CurrentValue = NULL;
		$this->item_serial->OldValue = $this->item_serial->CurrentValue;
		$this->type_problem->CurrentValue = NULL;
		$this->type_problem->OldValue = $this->type_problem->CurrentValue;
		$this->action_taken->CurrentValue = NULL;
		$this->action_taken->OldValue = $this->action_taken->CurrentValue;
		$this->employee_id->CurrentValue = NULL;
		$this->employee_id->OldValue = $this->employee_id->CurrentValue;
		$this->status_h->CurrentValue = NULL;
		$this->status_h->OldValue = $this->status_h->CurrentValue;
		$this->pullout_r->CurrentValue = NULL;
		$this->pullout_r->OldValue = $this->pullout_r->CurrentValue;
		$this->remark->CurrentValue = NULL;
		$this->remark->OldValue = $this->remark->CurrentValue;
		$this->userlastmodify->CurrentValue = NULL;
		$this->userlastmodify->OldValue = $this->userlastmodify->CurrentValue;
		$this->datelastmodify->CurrentValue = NULL;
		$this->datelastmodify->OldValue = $this->datelastmodify->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'inventory_id' first before field var 'x_inventory_id'
		$val = $CurrentForm->hasValue("inventory_id") ? $CurrentForm->getValue("inventory_id") : $CurrentForm->getValue("x_inventory_id");
		if (!$this->inventory_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->inventory_id->Visible = FALSE; // Disable update for API request
			else
				$this->inventory_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_inventory_id"))
			$this->inventory_id->setOldValue($CurrentForm->getValue("o_inventory_id"));

		// Check field name 'inventory_idr' first before field var 'x_inventory_idr'
		$val = $CurrentForm->hasValue("inventory_idr") ? $CurrentForm->getValue("inventory_idr") : $CurrentForm->getValue("x_inventory_idr");
		if (!$this->inventory_idr->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->inventory_idr->Visible = FALSE; // Disable update for API request
			else
				$this->inventory_idr->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_inventory_idr"))
			$this->inventory_idr->setOldValue($CurrentForm->getValue("o_inventory_idr"));

		// Check field name 'date_repaired' first before field var 'x_date_repaired'
		$val = $CurrentForm->hasValue("date_repaired") ? $CurrentForm->getValue("date_repaired") : $CurrentForm->getValue("x_date_repaired");
		if (!$this->date_repaired->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->date_repaired->Visible = FALSE; // Disable update for API request
			else
				$this->date_repaired->setFormValue($val);
			$this->date_repaired->CurrentValue = UnFormatDateTime($this->date_repaired->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_date_repaired"))
			$this->date_repaired->setOldValue($CurrentForm->getValue("o_date_repaired"));

		// Check field name 'type_problem' first before field var 'x_type_problem'
		$val = $CurrentForm->hasValue("type_problem") ? $CurrentForm->getValue("type_problem") : $CurrentForm->getValue("x_type_problem");
		if (!$this->type_problem->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->type_problem->Visible = FALSE; // Disable update for API request
			else
				$this->type_problem->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_type_problem"))
			$this->type_problem->setOldValue($CurrentForm->getValue("o_type_problem"));

		// Check field name 'action_taken' first before field var 'x_action_taken'
		$val = $CurrentForm->hasValue("action_taken") ? $CurrentForm->getValue("action_taken") : $CurrentForm->getValue("x_action_taken");
		if (!$this->action_taken->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->action_taken->Visible = FALSE; // Disable update for API request
			else
				$this->action_taken->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_action_taken"))
			$this->action_taken->setOldValue($CurrentForm->getValue("o_action_taken"));

		// Check field name 'employee_id' first before field var 'x_employee_id'
		$val = $CurrentForm->hasValue("employee_id") ? $CurrentForm->getValue("employee_id") : $CurrentForm->getValue("x_employee_id");
		if (!$this->employee_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->employee_id->Visible = FALSE; // Disable update for API request
			else
				$this->employee_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_employee_id"))
			$this->employee_id->setOldValue($CurrentForm->getValue("o_employee_id"));

		// Check field name 'status_h' first before field var 'x_status_h'
		$val = $CurrentForm->hasValue("status_h") ? $CurrentForm->getValue("status_h") : $CurrentForm->getValue("x_status_h");
		if (!$this->status_h->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status_h->Visible = FALSE; // Disable update for API request
			else
				$this->status_h->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_status_h"))
			$this->status_h->setOldValue($CurrentForm->getValue("o_status_h"));

		// Check field name 'remark' first before field var 'x_remark'
		$val = $CurrentForm->hasValue("remark") ? $CurrentForm->getValue("remark") : $CurrentForm->getValue("x_remark");
		if (!$this->remark->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->remark->Visible = FALSE; // Disable update for API request
			else
				$this->remark->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_remark"))
			$this->remark->setOldValue($CurrentForm->getValue("o_remark"));

		// Check field name 'repair_id' first before field var 'x_repair_id'
		$val = $CurrentForm->hasValue("repair_id") ? $CurrentForm->getValue("repair_id") : $CurrentForm->getValue("x_repair_id");
		if (!$this->repair_id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->repair_id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->repair_id->CurrentValue = $this->repair_id->FormValue;
		$this->inventory_id->CurrentValue = $this->inventory_id->FormValue;
		$this->inventory_idr->CurrentValue = $this->inventory_idr->FormValue;
		$this->date_repaired->CurrentValue = $this->date_repaired->FormValue;
		$this->date_repaired->CurrentValue = UnFormatDateTime($this->date_repaired->CurrentValue, 0);
		$this->type_problem->CurrentValue = $this->type_problem->FormValue;
		$this->action_taken->CurrentValue = $this->action_taken->FormValue;
		$this->employee_id->CurrentValue = $this->employee_id->FormValue;
		$this->status_h->CurrentValue = $this->status_h->FormValue;
		$this->remark->CurrentValue = $this->remark->FormValue;
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
		$this->repair_id->setDbValue($row['repair_id']);
		$this->inventory_id->setDbValue($row['inventory_id']);
		$this->current_loc_r->setDbValue($row['current_loc_r']);
		$this->inventory_idr->setDbValue($row['inventory_idr']);
		$this->date_received->setDbValue($row['date_received']);
		$this->date_repaired->setDbValue($row['date_repaired']);
		$this->date_pullout->setDbValue($row['date_pullout']);
		$this->name_accountable->setDbValue($row['name_accountable']);
		$this->Designation->setDbValue($row['Designation']);
		$this->office_id->setDbValue($row['office_id']);
		$this->region->setDbValue($row['region']);
		$this->province->setDbValue($row['province']);
		$this->city->setDbValue($row['city']);
		$this->itemtype->setDbValue($row['itemtype']);
		$this->itemmodel->setDbValue($row['itemmodel']);
		$this->item_serial->setDbValue($row['item_serial']);
		$this->type_problem->setDbValue($row['type_problem']);
		$this->action_taken->setDbValue($row['action_taken']);
		$this->employee_id->setDbValue($row['employee_id']);
		$this->status_h->setDbValue($row['status_h']);
		$this->pullout_r->setDbValue($row['pullout_r']);
		$this->remark->setDbValue($row['remark']);
		$this->userlastmodify->setDbValue($row['userlastmodify']);
		$this->datelastmodify->setDbValue($row['datelastmodify']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['repair_id'] = $this->repair_id->CurrentValue;
		$row['inventory_id'] = $this->inventory_id->CurrentValue;
		$row['current_loc_r'] = $this->current_loc_r->CurrentValue;
		$row['inventory_idr'] = $this->inventory_idr->CurrentValue;
		$row['date_received'] = $this->date_received->CurrentValue;
		$row['date_repaired'] = $this->date_repaired->CurrentValue;
		$row['date_pullout'] = $this->date_pullout->CurrentValue;
		$row['name_accountable'] = $this->name_accountable->CurrentValue;
		$row['Designation'] = $this->Designation->CurrentValue;
		$row['office_id'] = $this->office_id->CurrentValue;
		$row['region'] = $this->region->CurrentValue;
		$row['province'] = $this->province->CurrentValue;
		$row['city'] = $this->city->CurrentValue;
		$row['itemtype'] = $this->itemtype->CurrentValue;
		$row['itemmodel'] = $this->itemmodel->CurrentValue;
		$row['item_serial'] = $this->item_serial->CurrentValue;
		$row['type_problem'] = $this->type_problem->CurrentValue;
		$row['action_taken'] = $this->action_taken->CurrentValue;
		$row['employee_id'] = $this->employee_id->CurrentValue;
		$row['status_h'] = $this->status_h->CurrentValue;
		$row['pullout_r'] = $this->pullout_r->CurrentValue;
		$row['remark'] = $this->remark->CurrentValue;
		$row['userlastmodify'] = $this->userlastmodify->CurrentValue;
		$row['datelastmodify'] = $this->datelastmodify->CurrentValue;
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
				$this->repair_id->OldValue = strval($keys[0]); // repair_id
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// repair_id
		// inventory_id
		// current_loc_r
		// inventory_idr
		// date_received
		// date_repaired
		// date_pullout
		// name_accountable
		// Designation
		// office_id
		// region
		// province
		// city
		// itemtype
		// itemmodel
		// item_serial
		// type_problem
		// action_taken
		// employee_id
		// status_h
		// pullout_r
		// remark
		// userlastmodify
		// datelastmodify

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// repair_id
			$this->repair_id->ViewCustomAttributes = "";

			// inventory_id
			$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
			$this->inventory_id->ViewCustomAttributes = "";

			// current_loc_r
			$curVal = strval($this->current_loc_r->CurrentValue);
			if ($curVal != "") {
				$this->current_loc_r->ViewValue = $this->current_loc_r->lookupCacheOption($curVal);
				if ($this->current_loc_r->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`off_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->current_loc_r->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->current_loc_r->ViewValue = $this->current_loc_r->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->current_loc_r->ViewValue = $this->current_loc_r->CurrentValue;
					}
				}
			} else {
				$this->current_loc_r->ViewValue = NULL;
			}
			$this->current_loc_r->ViewCustomAttributes = "";

			// inventory_idr
			$this->inventory_idr->ViewValue = $this->inventory_idr->CurrentValue;
			$this->inventory_idr->ViewValue = FormatNumber($this->inventory_idr->ViewValue, 0, -2, -2, -2);
			$this->inventory_idr->ViewCustomAttributes = "";

			// date_received
			$this->date_received->ViewValue = $this->date_received->CurrentValue;
			$this->date_received->ViewValue = FormatDateTime($this->date_received->ViewValue, 0);
			$this->date_received->ViewCustomAttributes = "";

			// date_repaired
			$this->date_repaired->ViewValue = $this->date_repaired->CurrentValue;
			$this->date_repaired->ViewValue = FormatDateTime($this->date_repaired->ViewValue, 0);
			$this->date_repaired->ViewCustomAttributes = "";

			// name_accountable
			$curVal = strval($this->name_accountable->CurrentValue);
			if ($curVal != "") {
				$this->name_accountable->ViewValue = $this->name_accountable->lookupCacheOption($curVal);
				if ($this->name_accountable->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`name_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->name_accountable->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->name_accountable->ViewValue = $this->name_accountable->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->name_accountable->ViewValue = $this->name_accountable->CurrentValue;
					}
				}
			} else {
				$this->name_accountable->ViewValue = NULL;
			}
			$this->name_accountable->ViewCustomAttributes = "";

			// Designation
			$curVal = strval($this->Designation->CurrentValue);
			if ($curVal != "") {
				$this->Designation->ViewValue = $this->Designation->lookupCacheOption($curVal);
				if ($this->Designation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`pos_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Designation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Designation->ViewValue = $this->Designation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Designation->ViewValue = $this->Designation->CurrentValue;
					}
				}
			} else {
				$this->Designation->ViewValue = NULL;
			}
			$this->Designation->ViewCustomAttributes = "";

			// office_id
			$curVal = strval($this->office_id->CurrentValue);
			if ($curVal != "") {
				$this->office_id->ViewValue = $this->office_id->lookupCacheOption($curVal);
				if ($this->office_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`off_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->office_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->office_id->ViewValue = $this->office_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->office_id->ViewValue = $this->office_id->CurrentValue;
					}
				}
			} else {
				$this->office_id->ViewValue = NULL;
			}
			$this->office_id->ViewCustomAttributes = "";

			// region
			$curVal = strval($this->region->CurrentValue);
			if ($curVal != "") {
				$this->region->ViewValue = $this->region->lookupCacheOption($curVal);
				if ($this->region->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`region_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "region_name = 'REGION VI [Western Visayas]'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->region->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->region->ViewValue = $this->region->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->region->ViewValue = $this->region->CurrentValue;
					}
				}
			} else {
				$this->region->ViewValue = NULL;
			}
			$this->region->ViewCustomAttributes = "";

			// province
			$curVal = strval($this->province->CurrentValue);
			if ($curVal != "") {
				$this->province->ViewValue = $this->province->lookupCacheOption($curVal);
				if ($this->province->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`prov_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->province->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->province->ViewValue = $this->province->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->province->ViewValue = $this->province->CurrentValue;
					}
				}
			} else {
				$this->province->ViewValue = NULL;
			}
			$this->province->ViewCustomAttributes = "";

			// city
			$curVal = strval($this->city->CurrentValue);
			if ($curVal != "") {
				$this->city->ViewValue = $this->city->lookupCacheOption($curVal);
				if ($this->city->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`city_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->city->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->city->ViewValue = $this->city->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->city->ViewValue = $this->city->CurrentValue;
					}
				}
			} else {
				$this->city->ViewValue = NULL;
			}
			$this->city->ViewCustomAttributes = "";

			// itemtype
			$curVal = strval($this->itemtype->CurrentValue);
			if ($curVal != "") {
				$this->itemtype->ViewValue = $this->itemtype->lookupCacheOption($curVal);
				if ($this->itemtype->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`cat_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->itemtype->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->itemtype->ViewValue = $this->itemtype->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->itemtype->ViewValue = $this->itemtype->CurrentValue;
					}
				}
			} else {
				$this->itemtype->ViewValue = NULL;
			}
			$this->itemtype->ViewCustomAttributes = "";

			// itemmodel
			$this->itemmodel->ViewValue = $this->itemmodel->CurrentValue;
			$this->itemmodel->ViewCustomAttributes = "";

			// item_serial
			$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
			$this->item_serial->ViewCustomAttributes = "";

			// type_problem
			$this->type_problem->ViewValue = $this->type_problem->CurrentValue;
			$this->type_problem->ViewCustomAttributes = "";

			// action_taken
			$this->action_taken->ViewValue = $this->action_taken->CurrentValue;
			$this->action_taken->ViewCustomAttributes = "";

			// employee_id
			if (strval($this->employee_id->CurrentValue) != "") {
				$this->employee_id->ViewValue = $this->employee_id->optionCaption($this->employee_id->CurrentValue);
			} else {
				$this->employee_id->ViewValue = NULL;
			}
			$this->employee_id->ViewCustomAttributes = "";

			// status_h
			$curVal = strval($this->status_h->CurrentValue);
			if ($curVal != "") {
				$this->status_h->ViewValue = $this->status_h->lookupCacheOption($curVal);
				if ($this->status_h->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`inventory_status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`inventory_status_id` in(1,2,6,7,10)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->status_h->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->status_h->ViewValue = $this->status_h->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->status_h->ViewValue = $this->status_h->CurrentValue;
					}
				}
			} else {
				$this->status_h->ViewValue = NULL;
			}
			$this->status_h->ViewCustomAttributes = "";

			// pullout_r
			if (strval($this->pullout_r->CurrentValue) != "") {
				$this->pullout_r->ViewValue = $this->pullout_r->optionCaption($this->pullout_r->CurrentValue);
			} else {
				$this->pullout_r->ViewValue = NULL;
			}
			$this->pullout_r->ViewCustomAttributes = "";

			// remark
			$this->remark->ViewValue = $this->remark->CurrentValue;
			$this->remark->ViewCustomAttributes = "";

			// userlastmodify
			$this->userlastmodify->ViewValue = $this->userlastmodify->CurrentValue;
			$this->userlastmodify->ViewCustomAttributes = "";

			// datelastmodify
			$this->datelastmodify->ViewValue = $this->datelastmodify->CurrentValue;
			$this->datelastmodify->ViewValue = FormatDateTime($this->datelastmodify->ViewValue, 1);
			$this->datelastmodify->ViewCustomAttributes = "";

			// inventory_id
			$this->inventory_id->LinkCustomAttributes = "";
			$this->inventory_id->HrefValue = "";
			$this->inventory_id->TooltipValue = "";

			// inventory_idr
			$this->inventory_idr->LinkCustomAttributes = "";
			$this->inventory_idr->HrefValue = "";
			$this->inventory_idr->TooltipValue = "";

			// date_repaired
			$this->date_repaired->LinkCustomAttributes = "";
			$this->date_repaired->HrefValue = "";
			$this->date_repaired->TooltipValue = "";

			// type_problem
			$this->type_problem->LinkCustomAttributes = "";
			$this->type_problem->HrefValue = "";
			$this->type_problem->TooltipValue = "";

			// action_taken
			$this->action_taken->LinkCustomAttributes = "";
			$this->action_taken->HrefValue = "";
			$this->action_taken->TooltipValue = "";

			// employee_id
			$this->employee_id->LinkCustomAttributes = "";
			$this->employee_id->HrefValue = "";
			$this->employee_id->TooltipValue = "";

			// status_h
			$this->status_h->LinkCustomAttributes = "";
			$this->status_h->HrefValue = "";
			$this->status_h->TooltipValue = "";

			// remark
			$this->remark->LinkCustomAttributes = "";
			$this->remark->HrefValue = "";
			$this->remark->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// inventory_id
			$this->inventory_id->EditAttrs["class"] = "form-control";
			$this->inventory_id->EditCustomAttributes = "";
			if ($this->inventory_id->getSessionValue() != "") {
				$this->inventory_id->CurrentValue = $this->inventory_id->getSessionValue();
				$this->inventory_id->OldValue = $this->inventory_id->CurrentValue;
				$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
				$this->inventory_id->ViewCustomAttributes = "";
			} else {
				if (!$this->inventory_id->Raw)
					$this->inventory_id->CurrentValue = HtmlDecode($this->inventory_id->CurrentValue);
				$this->inventory_id->EditValue = HtmlEncode($this->inventory_id->CurrentValue);
				$this->inventory_id->PlaceHolder = RemoveHtml($this->inventory_id->caption());
			}

			// inventory_idr
			$this->inventory_idr->EditAttrs["class"] = "form-control";
			$this->inventory_idr->EditCustomAttributes = "";
			if ($this->inventory_idr->getSessionValue() != "") {
				$this->inventory_idr->CurrentValue = $this->inventory_idr->getSessionValue();
				$this->inventory_idr->OldValue = $this->inventory_idr->CurrentValue;
				$this->inventory_idr->ViewValue = $this->inventory_idr->CurrentValue;
				$this->inventory_idr->ViewValue = FormatNumber($this->inventory_idr->ViewValue, 0, -2, -2, -2);
				$this->inventory_idr->ViewCustomAttributes = "";
			} else {
				$this->inventory_idr->EditValue = HtmlEncode($this->inventory_idr->CurrentValue);
				$this->inventory_idr->PlaceHolder = RemoveHtml($this->inventory_idr->caption());
			}

			// date_repaired
			$this->date_repaired->EditAttrs["class"] = "form-control";
			$this->date_repaired->EditCustomAttributes = "";
			$this->date_repaired->EditValue = HtmlEncode(FormatDateTime($this->date_repaired->CurrentValue, 8));
			$this->date_repaired->PlaceHolder = RemoveHtml($this->date_repaired->caption());

			// type_problem
			$this->type_problem->EditAttrs["class"] = "form-control";
			$this->type_problem->EditCustomAttributes = "";
			$this->type_problem->EditValue = HtmlEncode($this->type_problem->CurrentValue);
			$this->type_problem->PlaceHolder = RemoveHtml($this->type_problem->caption());

			// action_taken
			$this->action_taken->EditAttrs["class"] = "form-control";
			$this->action_taken->EditCustomAttributes = "";
			$this->action_taken->EditValue = HtmlEncode($this->action_taken->CurrentValue);
			$this->action_taken->PlaceHolder = RemoveHtml($this->action_taken->caption());

			// employee_id
			$this->employee_id->EditAttrs["class"] = "form-control";
			$this->employee_id->EditCustomAttributes = "";
			$this->employee_id->EditValue = $this->employee_id->options(TRUE);

			// status_h
			$this->status_h->EditAttrs["class"] = "form-control";
			$this->status_h->EditCustomAttributes = "";
			$curVal = trim(strval($this->status_h->CurrentValue));
			if ($curVal != "")
				$this->status_h->ViewValue = $this->status_h->lookupCacheOption($curVal);
			else
				$this->status_h->ViewValue = $this->status_h->Lookup !== NULL && is_array($this->status_h->Lookup->Options) ? $curVal : NULL;
			if ($this->status_h->ViewValue !== NULL) { // Load from cache
				$this->status_h->EditValue = array_values($this->status_h->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`inventory_status_id`" . SearchString("=", $this->status_h->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`inventory_status_id` in(1,2,6,7,10)";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->status_h->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->status_h->EditValue = $arwrk;
			}

			// remark
			$this->remark->EditAttrs["class"] = "form-control";
			$this->remark->EditCustomAttributes = "";
			$this->remark->EditValue = HtmlEncode($this->remark->CurrentValue);
			$this->remark->PlaceHolder = RemoveHtml($this->remark->caption());

			// Add refer script
			// inventory_id

			$this->inventory_id->LinkCustomAttributes = "";
			$this->inventory_id->HrefValue = "";

			// inventory_idr
			$this->inventory_idr->LinkCustomAttributes = "";
			$this->inventory_idr->HrefValue = "";

			// date_repaired
			$this->date_repaired->LinkCustomAttributes = "";
			$this->date_repaired->HrefValue = "";

			// type_problem
			$this->type_problem->LinkCustomAttributes = "";
			$this->type_problem->HrefValue = "";

			// action_taken
			$this->action_taken->LinkCustomAttributes = "";
			$this->action_taken->HrefValue = "";

			// employee_id
			$this->employee_id->LinkCustomAttributes = "";
			$this->employee_id->HrefValue = "";

			// status_h
			$this->status_h->LinkCustomAttributes = "";
			$this->status_h->HrefValue = "";

			// remark
			$this->remark->LinkCustomAttributes = "";
			$this->remark->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// inventory_id
			$this->inventory_id->EditAttrs["class"] = "form-control";
			$this->inventory_id->EditCustomAttributes = "";
			if ($this->inventory_id->getSessionValue() != "") {
				$this->inventory_id->CurrentValue = $this->inventory_id->getSessionValue();
				$this->inventory_id->OldValue = $this->inventory_id->CurrentValue;
				$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
				$this->inventory_id->ViewCustomAttributes = "";
			} else {
				if (!$this->inventory_id->Raw)
					$this->inventory_id->CurrentValue = HtmlDecode($this->inventory_id->CurrentValue);
				$this->inventory_id->EditValue = HtmlEncode($this->inventory_id->CurrentValue);
				$this->inventory_id->PlaceHolder = RemoveHtml($this->inventory_id->caption());
			}

			// inventory_idr
			$this->inventory_idr->EditAttrs["class"] = "form-control";
			$this->inventory_idr->EditCustomAttributes = "";
			if ($this->inventory_idr->getSessionValue() != "") {
				$this->inventory_idr->CurrentValue = $this->inventory_idr->getSessionValue();
				$this->inventory_idr->OldValue = $this->inventory_idr->CurrentValue;
				$this->inventory_idr->ViewValue = $this->inventory_idr->CurrentValue;
				$this->inventory_idr->ViewValue = FormatNumber($this->inventory_idr->ViewValue, 0, -2, -2, -2);
				$this->inventory_idr->ViewCustomAttributes = "";
			} else {
				$this->inventory_idr->EditValue = HtmlEncode($this->inventory_idr->CurrentValue);
				$this->inventory_idr->PlaceHolder = RemoveHtml($this->inventory_idr->caption());
			}

			// date_repaired
			$this->date_repaired->EditAttrs["class"] = "form-control";
			$this->date_repaired->EditCustomAttributes = "";
			$this->date_repaired->EditValue = HtmlEncode(FormatDateTime($this->date_repaired->CurrentValue, 8));
			$this->date_repaired->PlaceHolder = RemoveHtml($this->date_repaired->caption());

			// type_problem
			$this->type_problem->EditAttrs["class"] = "form-control";
			$this->type_problem->EditCustomAttributes = "";
			$this->type_problem->EditValue = HtmlEncode($this->type_problem->CurrentValue);
			$this->type_problem->PlaceHolder = RemoveHtml($this->type_problem->caption());

			// action_taken
			$this->action_taken->EditAttrs["class"] = "form-control";
			$this->action_taken->EditCustomAttributes = "";
			$this->action_taken->EditValue = HtmlEncode($this->action_taken->CurrentValue);
			$this->action_taken->PlaceHolder = RemoveHtml($this->action_taken->caption());

			// employee_id
			$this->employee_id->EditAttrs["class"] = "form-control";
			$this->employee_id->EditCustomAttributes = "";
			$this->employee_id->EditValue = $this->employee_id->options(TRUE);

			// status_h
			$this->status_h->EditAttrs["class"] = "form-control";
			$this->status_h->EditCustomAttributes = "";
			$curVal = trim(strval($this->status_h->CurrentValue));
			if ($curVal != "")
				$this->status_h->ViewValue = $this->status_h->lookupCacheOption($curVal);
			else
				$this->status_h->ViewValue = $this->status_h->Lookup !== NULL && is_array($this->status_h->Lookup->Options) ? $curVal : NULL;
			if ($this->status_h->ViewValue !== NULL) { // Load from cache
				$this->status_h->EditValue = array_values($this->status_h->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`inventory_status_id`" . SearchString("=", $this->status_h->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`inventory_status_id` in(1,2,6,7,10)";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->status_h->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->status_h->EditValue = $arwrk;
			}

			// remark
			$this->remark->EditAttrs["class"] = "form-control";
			$this->remark->EditCustomAttributes = "";
			$this->remark->EditValue = HtmlEncode($this->remark->CurrentValue);
			$this->remark->PlaceHolder = RemoveHtml($this->remark->caption());

			// Edit refer script
			// inventory_id

			$this->inventory_id->LinkCustomAttributes = "";
			$this->inventory_id->HrefValue = "";

			// inventory_idr
			$this->inventory_idr->LinkCustomAttributes = "";
			$this->inventory_idr->HrefValue = "";

			// date_repaired
			$this->date_repaired->LinkCustomAttributes = "";
			$this->date_repaired->HrefValue = "";

			// type_problem
			$this->type_problem->LinkCustomAttributes = "";
			$this->type_problem->HrefValue = "";

			// action_taken
			$this->action_taken->LinkCustomAttributes = "";
			$this->action_taken->HrefValue = "";

			// employee_id
			$this->employee_id->LinkCustomAttributes = "";
			$this->employee_id->HrefValue = "";

			// status_h
			$this->status_h->LinkCustomAttributes = "";
			$this->status_h->HrefValue = "";

			// remark
			$this->remark->LinkCustomAttributes = "";
			$this->remark->HrefValue = "";
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
		if ($this->inventory_id->Required) {
			if (!$this->inventory_id->IsDetailKey && $this->inventory_id->FormValue != NULL && $this->inventory_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->inventory_id->caption(), $this->inventory_id->RequiredErrorMessage));
			}
		}
		if ($this->inventory_idr->Required) {
			if (!$this->inventory_idr->IsDetailKey && $this->inventory_idr->FormValue != NULL && $this->inventory_idr->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->inventory_idr->caption(), $this->inventory_idr->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->inventory_idr->FormValue)) {
			AddMessage($FormError, $this->inventory_idr->errorMessage());
		}
		if ($this->date_repaired->Required) {
			if (!$this->date_repaired->IsDetailKey && $this->date_repaired->FormValue != NULL && $this->date_repaired->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->date_repaired->caption(), $this->date_repaired->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->date_repaired->FormValue)) {
			AddMessage($FormError, $this->date_repaired->errorMessage());
		}
		if ($this->type_problem->Required) {
			if (!$this->type_problem->IsDetailKey && $this->type_problem->FormValue != NULL && $this->type_problem->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->type_problem->caption(), $this->type_problem->RequiredErrorMessage));
			}
		}
		if ($this->action_taken->Required) {
			if (!$this->action_taken->IsDetailKey && $this->action_taken->FormValue != NULL && $this->action_taken->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->action_taken->caption(), $this->action_taken->RequiredErrorMessage));
			}
		}
		if ($this->employee_id->Required) {
			if (!$this->employee_id->IsDetailKey && $this->employee_id->FormValue != NULL && $this->employee_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->employee_id->caption(), $this->employee_id->RequiredErrorMessage));
			}
		}
		if ($this->status_h->Required) {
			if (!$this->status_h->IsDetailKey && $this->status_h->FormValue != NULL && $this->status_h->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_h->caption(), $this->status_h->RequiredErrorMessage));
			}
		}
		if ($this->remark->Required) {
			if (!$this->remark->IsDetailKey && $this->remark->FormValue != NULL && $this->remark->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->remark->caption(), $this->remark->RequiredErrorMessage));
			}
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
				$thisKey .= $row['repair_id'];
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

			// inventory_id
			$this->inventory_id->setDbValueDef($rsnew, $this->inventory_id->CurrentValue, NULL, $this->inventory_id->ReadOnly);

			// inventory_idr
			$this->inventory_idr->setDbValueDef($rsnew, $this->inventory_idr->CurrentValue, NULL, $this->inventory_idr->ReadOnly);

			// date_repaired
			$this->date_repaired->setDbValueDef($rsnew, UnFormatDateTime($this->date_repaired->CurrentValue, 0), NULL, $this->date_repaired->ReadOnly);

			// type_problem
			$this->type_problem->setDbValueDef($rsnew, $this->type_problem->CurrentValue, NULL, $this->type_problem->ReadOnly);

			// action_taken
			$this->action_taken->setDbValueDef($rsnew, $this->action_taken->CurrentValue, NULL, $this->action_taken->ReadOnly);

			// employee_id
			$this->employee_id->setDbValueDef($rsnew, $this->employee_id->CurrentValue, NULL, $this->employee_id->ReadOnly);

			// status_h
			$this->status_h->setDbValueDef($rsnew, $this->status_h->CurrentValue, NULL, $this->status_h->ReadOnly);

			// remark
			$this->remark->setDbValueDef($rsnew, $this->remark->CurrentValue, NULL, $this->remark->ReadOnly);

			// Check referential integrity for master table 'tbl_inventory'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_tbl_inventory();
			$keyValue = isset($rsnew['itemtype']) ? $rsnew['itemtype'] : $rsold['itemtype'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@item_type@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['itemmodel']) ? $rsnew['itemmodel'] : $rsold['itemmodel'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@item_model@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['item_serial']) ? $rsnew['item_serial'] : $rsold['item_serial'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@item_serial@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['office_id']) ? $rsnew['office_id'] : $rsold['office_id'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@office_id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['name_accountable']) ? $rsnew['name_accountable'] : $rsold['name_accountable'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@name_accountable@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['Designation']) ? $rsnew['Designation'] : $rsold['Designation'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@Designation@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['region']) ? $rsnew['region'] : $rsold['region'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@Region@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['province']) ? $rsnew['province'] : $rsold['province'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@Province@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['city']) ? $rsnew['city'] : $rsold['city'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@Cities@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['inventory_id']) ? $rsnew['inventory_id'] : $rsold['inventory_id'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@concat_inventory@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['inventory_idr']) ? $rsnew['inventory_idr'] : $rsold['inventory_idr'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@inventory_id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['current_loc_r']) ? $rsnew['current_loc_r'] : $rsold['current_loc_r'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@Current_Location@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['date_received']) ? $rsnew['date_received'] : $rsold['date_received'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@Last_Date_Check@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["tbl_inventory"]))
					$GLOBALS["tbl_inventory"] = new tbl_inventory();
				$rsmaster = $GLOBALS["tbl_inventory"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "tbl_inventory", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "tbl_inventory") {
				$this->itemtype->CurrentValue = $this->itemtype->getSessionValue();
				$this->itemmodel->CurrentValue = $this->itemmodel->getSessionValue();
				$this->item_serial->CurrentValue = $this->item_serial->getSessionValue();
				$this->office_id->CurrentValue = $this->office_id->getSessionValue();
				$this->name_accountable->CurrentValue = $this->name_accountable->getSessionValue();
				$this->Designation->CurrentValue = $this->Designation->getSessionValue();
				$this->region->CurrentValue = $this->region->getSessionValue();
				$this->province->CurrentValue = $this->province->getSessionValue();
				$this->city->CurrentValue = $this->city->getSessionValue();
				$this->inventory_id->CurrentValue = $this->inventory_id->getSessionValue();
				$this->inventory_idr->CurrentValue = $this->inventory_idr->getSessionValue();
				$this->current_loc_r->CurrentValue = $this->current_loc_r->getSessionValue();
				$this->date_received->CurrentValue = $this->date_received->getSessionValue();
			}

		// Check referential integrity for master table 'tbl_repair'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_tbl_inventory();
		if ($this->itemtype->getSessionValue() != "") {
			$masterFilter = str_replace("@item_type@", AdjustSql($this->itemtype->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->itemmodel->getSessionValue() != "") {
			$masterFilter = str_replace("@item_model@", AdjustSql($this->itemmodel->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->item_serial->getSessionValue() != "") {
			$masterFilter = str_replace("@item_serial@", AdjustSql($this->item_serial->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->office_id->getSessionValue() != "") {
			$masterFilter = str_replace("@office_id@", AdjustSql($this->office_id->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->name_accountable->getSessionValue() != "") {
			$masterFilter = str_replace("@name_accountable@", AdjustSql($this->name_accountable->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->Designation->getSessionValue() != "") {
			$masterFilter = str_replace("@Designation@", AdjustSql($this->Designation->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->region->getSessionValue() != "") {
			$masterFilter = str_replace("@Region@", AdjustSql($this->region->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->province->getSessionValue() != "") {
			$masterFilter = str_replace("@Province@", AdjustSql($this->province->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->city->getSessionValue() != "") {
			$masterFilter = str_replace("@Cities@", AdjustSql($this->city->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->inventory_id->CurrentValue) != "") {
			$masterFilter = str_replace("@concat_inventory@", AdjustSql($this->inventory_id->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->inventory_idr->CurrentValue) != "") {
			$masterFilter = str_replace("@inventory_id@", AdjustSql($this->inventory_idr->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->current_loc_r->getSessionValue() != "") {
			$masterFilter = str_replace("@Current_Location@", AdjustSql($this->current_loc_r->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->date_received->getSessionValue() != "") {
			$masterFilter = str_replace("@Last_Date_Check@", AdjustSql($this->date_received->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["tbl_inventory"]))
				$GLOBALS["tbl_inventory"] = new tbl_inventory();
			$rsmaster = $GLOBALS["tbl_inventory"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "tbl_inventory", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// inventory_id
		$this->inventory_id->setDbValueDef($rsnew, $this->inventory_id->CurrentValue, NULL, FALSE);

		// inventory_idr
		$this->inventory_idr->setDbValueDef($rsnew, $this->inventory_idr->CurrentValue, NULL, FALSE);

		// date_repaired
		$this->date_repaired->setDbValueDef($rsnew, UnFormatDateTime($this->date_repaired->CurrentValue, 0), NULL, FALSE);

		// type_problem
		$this->type_problem->setDbValueDef($rsnew, $this->type_problem->CurrentValue, NULL, FALSE);

		// action_taken
		$this->action_taken->setDbValueDef($rsnew, $this->action_taken->CurrentValue, NULL, FALSE);

		// employee_id
		$this->employee_id->setDbValueDef($rsnew, $this->employee_id->CurrentValue, NULL, FALSE);

		// status_h
		$this->status_h->setDbValueDef($rsnew, $this->status_h->CurrentValue, NULL, FALSE);

		// remark
		$this->remark->setDbValueDef($rsnew, $this->remark->CurrentValue, NULL, FALSE);

		// current_loc_r
		if ($this->current_loc_r->getSessionValue() != "") {
			$rsnew['current_loc_r'] = $this->current_loc_r->getSessionValue();
		}

		// date_received
		if ($this->date_received->getSessionValue() != "") {
			$rsnew['date_received'] = $this->date_received->getSessionValue();
		}

		// name_accountable
		if ($this->name_accountable->getSessionValue() != "") {
			$rsnew['name_accountable'] = $this->name_accountable->getSessionValue();
		}

		// Designation
		if ($this->Designation->getSessionValue() != "") {
			$rsnew['Designation'] = $this->Designation->getSessionValue();
		}

		// office_id
		if ($this->office_id->getSessionValue() != "") {
			$rsnew['office_id'] = $this->office_id->getSessionValue();
		}

		// region
		if ($this->region->getSessionValue() != "") {
			$rsnew['region'] = $this->region->getSessionValue();
		}

		// province
		if ($this->province->getSessionValue() != "") {
			$rsnew['province'] = $this->province->getSessionValue();
		}

		// city
		if ($this->city->getSessionValue() != "") {
			$rsnew['city'] = $this->city->getSessionValue();
		}

		// itemtype
		if ($this->itemtype->getSessionValue() != "") {
			$rsnew['itemtype'] = $this->itemtype->getSessionValue();
		}

		// itemmodel
		if ($this->itemmodel->getSessionValue() != "") {
			$rsnew['itemmodel'] = $this->itemmodel->getSessionValue();
		}

		// item_serial
		if ($this->item_serial->getSessionValue() != "") {
			$rsnew['item_serial'] = $this->item_serial->getSessionValue();
		}

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
		if ($masterTblVar == "tbl_inventory") {
			$this->itemtype->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->itemmodel->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->item_serial->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->office_id->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->name_accountable->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->Designation->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->region->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->province->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->city->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->inventory_id->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->inventory_idr->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->current_loc_r->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->date_received->Visible = FALSE;
			if ($GLOBALS["tbl_inventory"]->EventCancelled)
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
				case "x_current_loc_r":
					break;
				case "x_name_accountable":
					break;
				case "x_Designation":
					break;
				case "x_office_id":
					break;
				case "x_region":
					$lookupFilter = function() {
						return "region_name = 'REGION VI [Western Visayas]'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_province":
					break;
				case "x_city":
					break;
				case "x_itemtype":
					break;
				case "x_employee_id":
					$lookupFilter = function() {
						return "`employeeid` in(4,5)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_status_h":
					$lookupFilter = function() {
						return "`inventory_status_id` in(1,2,6,7,10)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_pullout_r":
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
						case "x_current_loc_r":
							break;
						case "x_name_accountable":
							break;
						case "x_Designation":
							break;
						case "x_office_id":
							break;
						case "x_region":
							break;
						case "x_province":
							break;
						case "x_city":
							break;
						case "x_itemtype":
							break;
						case "x_status_h":
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
	$this->status_h->DisplayValueSeparator = "-";
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

	//$this->OtherOptions["addedit"]->UseDropDownButton = FALSE; // do not use dropdown button style
	//$my_options = &$this->OtherOptions; // define the option using OtherOptions
	//$my_option = $my_options["addedit"]; // near from add/edit button of OtherOptions
	//$my_item = &$my_option->Add("mynewbutton"); // add the button
	//$my_item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"Your Title\" data-caption=\"Your Caption\" href=\"yourpage.php\">My New Button</a>"; // define the link and the caption
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