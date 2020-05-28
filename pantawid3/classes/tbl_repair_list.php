<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_repair_list extends tbl_repair
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_repair';

	// Page object name
	public $PageObjName = "tbl_repair_list";

	// Grid form hidden field names
	public $FormName = "ftbl_repairlist";
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

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (tbl_repair)
		if (!isset($GLOBALS["tbl_repair"]) || get_class($GLOBALS["tbl_repair"]) == PROJECT_NAMESPACE . "tbl_repair") {
			$GLOBALS["tbl_repair"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_repair"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "tbl_repairadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "tbl_repairdelete.php";
		$this->MultiUpdateUrl = "tbl_repairupdate.php";

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Table object (tbl_inventory)
		if (!isset($GLOBALS['tbl_inventory']))
			$GLOBALS['tbl_inventory'] = new tbl_inventory();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option ftbl_repairlistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

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
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
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
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
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
			if (!$Security->canList()) {
				SetStatus(401); // Unauthorized
				return;
			}
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
		$this->CurrentAction = Param("action"); // Set up current action

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

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

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

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

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

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

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
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
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
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

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

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->inventory_id); // inventory_id
			$this->updateSort($this->inventory_idr); // inventory_idr
			$this->updateSort($this->date_repaired); // date_repaired
			$this->updateSort($this->type_problem); // type_problem
			$this->updateSort($this->action_taken); // action_taken
			$this->updateSort($this->employee_id); // employee_id
			$this->updateSort($this->status_h); // status_h
			$this->updateSort($this->remark); // remark
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
				$this->inventory_id->setSort("");
				$this->inventory_idr->setSort("");
				$this->date_repaired->setSort("");
				$this->type_problem->setSort("");
				$this->action_taken->setSort("");
				$this->employee_id->setSort("");
				$this->status_h->setSort("");
				$this->remark->setSort("");
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

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

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
		$this->setupListOptionsExt();
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

		// "sequence"
		$opt = $this->ListOptions["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecordCount);

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->repair_id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ftbl_repairlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ftbl_repairlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.ftbl_repairlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
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
		$row = [];
		$row['repair_id'] = NULL;
		$row['inventory_id'] = NULL;
		$row['current_loc_r'] = NULL;
		$row['inventory_idr'] = NULL;
		$row['date_received'] = NULL;
		$row['date_repaired'] = NULL;
		$row['date_pullout'] = NULL;
		$row['name_accountable'] = NULL;
		$row['Designation'] = NULL;
		$row['office_id'] = NULL;
		$row['region'] = NULL;
		$row['province'] = NULL;
		$row['city'] = NULL;
		$row['itemtype'] = NULL;
		$row['itemmodel'] = NULL;
		$row['item_serial'] = NULL;
		$row['type_problem'] = NULL;
		$row['action_taken'] = NULL;
		$row['employee_id'] = NULL;
		$row['status_h'] = NULL;
		$row['pullout_r'] = NULL;
		$row['remark'] = NULL;
		$row['userlastmodify'] = NULL;
		$row['datelastmodify'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("repair_id")) != "")
			$this->repair_id->OldValue = $this->getKey("repair_id"); // repair_id
		else
			$validKey = FALSE;

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
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER")) ?: Get(Config("TABLE_MASTER"))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "tbl_inventory") {
				$validMaster = TRUE;
				if (($parm = Get("fk_item_type") ?: Get("itemtype")) !== NULL) {
					$GLOBALS["tbl_inventory"]->item_type->setQueryStringValue($parm);
					$this->itemtype->setQueryStringValue($GLOBALS["tbl_inventory"]->item_type->QueryStringValue);
					$this->itemtype->setSessionValue($this->itemtype->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->item_type->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_item_model") ?: Get("itemmodel")) !== NULL) {
					$GLOBALS["tbl_inventory"]->item_model->setQueryStringValue($parm);
					$this->itemmodel->setQueryStringValue($GLOBALS["tbl_inventory"]->item_model->QueryStringValue);
					$this->itemmodel->setSessionValue($this->itemmodel->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_item_serial") ?: Get("item_serial")) !== NULL) {
					$GLOBALS["tbl_inventory"]->item_serial->setQueryStringValue($parm);
					$this->item_serial->setQueryStringValue($GLOBALS["tbl_inventory"]->item_serial->QueryStringValue);
					$this->item_serial->setSessionValue($this->item_serial->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_office_id") ?: Get("office_id")) !== NULL) {
					$GLOBALS["tbl_inventory"]->office_id->setQueryStringValue($parm);
					$this->office_id->setQueryStringValue($GLOBALS["tbl_inventory"]->office_id->QueryStringValue);
					$this->office_id->setSessionValue($this->office_id->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->office_id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_name_accountable") ?: Get("name_accountable")) !== NULL) {
					$GLOBALS["tbl_inventory"]->name_accountable->setQueryStringValue($parm);
					$this->name_accountable->setQueryStringValue($GLOBALS["tbl_inventory"]->name_accountable->QueryStringValue);
					$this->name_accountable->setSessionValue($this->name_accountable->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->name_accountable->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_Designation") ?: Get("Designation")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Designation->setQueryStringValue($parm);
					$this->Designation->setQueryStringValue($GLOBALS["tbl_inventory"]->Designation->QueryStringValue);
					$this->Designation->setSessionValue($this->Designation->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Designation->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_Region") ?: Get("region")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Region->setQueryStringValue($parm);
					$this->region->setQueryStringValue($GLOBALS["tbl_inventory"]->Region->QueryStringValue);
					$this->region->setSessionValue($this->region->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Region->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_Province") ?: Get("province")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Province->setQueryStringValue($parm);
					$this->province->setQueryStringValue($GLOBALS["tbl_inventory"]->Province->QueryStringValue);
					$this->province->setSessionValue($this->province->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Province->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_Cities") ?: Get("city")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Cities->setQueryStringValue($parm);
					$this->city->setQueryStringValue($GLOBALS["tbl_inventory"]->Cities->QueryStringValue);
					$this->city->setSessionValue($this->city->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Cities->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_concat_inventory") ?: Get("inventory_id")) !== NULL) {
					$GLOBALS["tbl_inventory"]->concat_inventory->setQueryStringValue($parm);
					$this->inventory_id->setQueryStringValue($GLOBALS["tbl_inventory"]->concat_inventory->QueryStringValue);
					$this->inventory_id->setSessionValue($this->inventory_id->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_inventory_id") ?: Get("inventory_idr")) !== NULL) {
					$GLOBALS["tbl_inventory"]->inventory_id->setQueryStringValue($parm);
					$this->inventory_idr->setQueryStringValue($GLOBALS["tbl_inventory"]->inventory_id->QueryStringValue);
					$this->inventory_idr->setSessionValue($this->inventory_idr->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->inventory_id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_Current_Location") ?: Get("current_loc_r")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Current_Location->setQueryStringValue($parm);
					$this->current_loc_r->setQueryStringValue($GLOBALS["tbl_inventory"]->Current_Location->QueryStringValue);
					$this->current_loc_r->setSessionValue($this->current_loc_r->QueryStringValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Current_Location->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_Last_Date_Check") ?: Get("date_received")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Last_Date_Check->setQueryStringValue($parm);
					$this->date_received->setQueryStringValue($GLOBALS["tbl_inventory"]->Last_Date_Check->QueryStringValue);
					$this->date_received->setSessionValue($this->date_received->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER")) ?: Post(Config("TABLE_MASTER"))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "tbl_inventory") {
				$validMaster = TRUE;
				if (($parm = Post("fk_item_type") ?: Post("itemtype")) !== NULL) {
					$GLOBALS["tbl_inventory"]->item_type->setFormValue($parm);
					$this->itemtype->setFormValue($GLOBALS["tbl_inventory"]->item_type->FormValue);
					$this->itemtype->setSessionValue($this->itemtype->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->item_type->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_item_model") ?: Post("itemmodel")) !== NULL) {
					$GLOBALS["tbl_inventory"]->item_model->setFormValue($parm);
					$this->itemmodel->setFormValue($GLOBALS["tbl_inventory"]->item_model->FormValue);
					$this->itemmodel->setSessionValue($this->itemmodel->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_item_serial") ?: Post("item_serial")) !== NULL) {
					$GLOBALS["tbl_inventory"]->item_serial->setFormValue($parm);
					$this->item_serial->setFormValue($GLOBALS["tbl_inventory"]->item_serial->FormValue);
					$this->item_serial->setSessionValue($this->item_serial->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_office_id") ?: Post("office_id")) !== NULL) {
					$GLOBALS["tbl_inventory"]->office_id->setFormValue($parm);
					$this->office_id->setFormValue($GLOBALS["tbl_inventory"]->office_id->FormValue);
					$this->office_id->setSessionValue($this->office_id->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->office_id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_name_accountable") ?: Post("name_accountable")) !== NULL) {
					$GLOBALS["tbl_inventory"]->name_accountable->setFormValue($parm);
					$this->name_accountable->setFormValue($GLOBALS["tbl_inventory"]->name_accountable->FormValue);
					$this->name_accountable->setSessionValue($this->name_accountable->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->name_accountable->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_Designation") ?: Post("Designation")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Designation->setFormValue($parm);
					$this->Designation->setFormValue($GLOBALS["tbl_inventory"]->Designation->FormValue);
					$this->Designation->setSessionValue($this->Designation->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Designation->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_Region") ?: Post("region")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Region->setFormValue($parm);
					$this->region->setFormValue($GLOBALS["tbl_inventory"]->Region->FormValue);
					$this->region->setSessionValue($this->region->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Region->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_Province") ?: Post("province")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Province->setFormValue($parm);
					$this->province->setFormValue($GLOBALS["tbl_inventory"]->Province->FormValue);
					$this->province->setSessionValue($this->province->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Province->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_Cities") ?: Post("city")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Cities->setFormValue($parm);
					$this->city->setFormValue($GLOBALS["tbl_inventory"]->Cities->FormValue);
					$this->city->setSessionValue($this->city->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Cities->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_concat_inventory") ?: Post("inventory_id")) !== NULL) {
					$GLOBALS["tbl_inventory"]->concat_inventory->setFormValue($parm);
					$this->inventory_id->setFormValue($GLOBALS["tbl_inventory"]->concat_inventory->FormValue);
					$this->inventory_id->setSessionValue($this->inventory_id->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_inventory_id") ?: Post("inventory_idr")) !== NULL) {
					$GLOBALS["tbl_inventory"]->inventory_id->setFormValue($parm);
					$this->inventory_idr->setFormValue($GLOBALS["tbl_inventory"]->inventory_id->FormValue);
					$this->inventory_idr->setSessionValue($this->inventory_idr->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->inventory_id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_Current_Location") ?: Post("current_loc_r")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Current_Location->setFormValue($parm);
					$this->current_loc_r->setFormValue($GLOBALS["tbl_inventory"]->Current_Location->FormValue);
					$this->current_loc_r->setSessionValue($this->current_loc_r->FormValue);
					if (!is_numeric($GLOBALS["tbl_inventory"]->Current_Location->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_Last_Date_Check") ?: Post("date_received")) !== NULL) {
					$GLOBALS["tbl_inventory"]->Last_Date_Check->setFormValue($parm);
					$this->date_received->setFormValue($GLOBALS["tbl_inventory"]->Last_Date_Check->FormValue);
					$this->date_received->setSessionValue($this->date_received->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Update URL
			$this->AddUrl = $this->addMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->addMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->addMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->addMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "tbl_inventory") {
				if ($this->itemtype->CurrentValue == "")
					$this->itemtype->setSessionValue("");
				if ($this->itemmodel->CurrentValue == "")
					$this->itemmodel->setSessionValue("");
				if ($this->item_serial->CurrentValue == "")
					$this->item_serial->setSessionValue("");
				if ($this->office_id->CurrentValue == "")
					$this->office_id->setSessionValue("");
				if ($this->name_accountable->CurrentValue == "")
					$this->name_accountable->setSessionValue("");
				if ($this->Designation->CurrentValue == "")
					$this->Designation->setSessionValue("");
				if ($this->region->CurrentValue == "")
					$this->region->setSessionValue("");
				if ($this->province->CurrentValue == "")
					$this->province->setSessionValue("");
				if ($this->city->CurrentValue == "")
					$this->city->setSessionValue("");
				if ($this->inventory_id->CurrentValue == "")
					$this->inventory_id->setSessionValue("");
				if ($this->inventory_idr->CurrentValue == "")
					$this->inventory_idr->setSessionValue("");
				if ($this->current_loc_r->CurrentValue == "")
					$this->current_loc_r->setSessionValue("");
				if ($this->date_received->CurrentValue == "")
					$this->date_received->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>