<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_borrowers_add extends tbl_borrowers
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_borrowers';

	// Page object name
	public $PageObjName = "tbl_borrowers_add";

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

		// Table object (tbl_borrowers)
		if (!isset($GLOBALS["tbl_borrowers"]) || get_class($GLOBALS["tbl_borrowers"]) == PROJECT_NAMESPACE . "tbl_borrowers") {
			$GLOBALS["tbl_borrowers"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_borrowers"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_borrowers');

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
		global $tbl_borrowers;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
			if (is_array(@$_SESSION[SESSION_TEMP_IMAGES])) // Restore temp images
				$TempImages = @$_SESSION[SESSION_TEMP_IMAGES];
			if (Post("data") !== NULL)
				$content = Post("data");
			$ExportFileName = Post("filename", "");
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($tbl_borrowers);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
	if ($this->CustomExport) { // Save temp images array for custom export
		if (is_array($TempImages))
			$_SESSION[SESSION_TEMP_IMAGES] = $TempImages;
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "tbl_borrowersview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
			$key .= @$ar['borrowers_id'];
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("tbl_borrowerslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->borrowers_id->Visible = FALSE;
		$this->Date_Barrowed->setVisibility();
		$this->Date_Returned->setVisibility();
		$this->item_type->setVisibility();
		$this->item_model->setVisibility();
		$this->item_serial->setVisibility();
		$this->name_barrowers->setVisibility();
		$this->Designation->setVisibility();
		$this->office_id->setVisibility();
		$this->Region->Visible = FALSE;
		$this->Province->Visible = FALSE;
		$this->Cities->Visible = FALSE;
		$this->status->setVisibility();
		$this->Remarks->setVisibility();
		$this->user_last_modify->setVisibility();
		$this->date_last_modify->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->item_type);
		$this->setupLookupOptions($this->office_id);
		$this->setupLookupOptions($this->Region);
		$this->setupLookupOptions($this->Province);
		$this->setupLookupOptions($this->Cities);
		$this->setupLookupOptions($this->status);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("tbl_borrowerslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("borrowers_id") !== NULL) {
				$this->borrowers_id->setQueryStringValue(Get("borrowers_id"));
				$this->setKey("borrowers_id", $this->borrowers_id->CurrentValue); // Set up key
			} else {
				$this->setKey("borrowers_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("tbl_borrowerslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetViewUrl();
					if (GetPageName($returnUrl) == "tbl_borrowerslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_borrowersview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->borrowers_id->CurrentValue = NULL;
		$this->borrowers_id->OldValue = $this->borrowers_id->CurrentValue;
		$this->Date_Barrowed->CurrentValue = date("Y/m/d");
		$this->Date_Returned->CurrentValue = NULL;
		$this->Date_Returned->OldValue = $this->Date_Returned->CurrentValue;
		$this->item_type->CurrentValue = NULL;
		$this->item_type->OldValue = $this->item_type->CurrentValue;
		$this->item_model->CurrentValue = NULL;
		$this->item_model->OldValue = $this->item_model->CurrentValue;
		$this->item_serial->CurrentValue = NULL;
		$this->item_serial->OldValue = $this->item_serial->CurrentValue;
		$this->name_barrowers->CurrentValue = NULL;
		$this->name_barrowers->OldValue = $this->name_barrowers->CurrentValue;
		$this->Designation->CurrentValue = NULL;
		$this->Designation->OldValue = $this->Designation->CurrentValue;
		$this->office_id->CurrentValue = NULL;
		$this->office_id->OldValue = $this->office_id->CurrentValue;
		$this->Region->CurrentValue = NULL;
		$this->Region->OldValue = $this->Region->CurrentValue;
		$this->Province->CurrentValue = NULL;
		$this->Province->OldValue = $this->Province->CurrentValue;
		$this->Cities->CurrentValue = NULL;
		$this->Cities->OldValue = $this->Cities->CurrentValue;
		$this->status->CurrentValue = "1";
		$this->Remarks->CurrentValue = NULL;
		$this->Remarks->OldValue = $this->Remarks->CurrentValue;
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

		// Check field name 'Date_Barrowed' first before field var 'x_Date_Barrowed'
		$val = $CurrentForm->hasValue("Date_Barrowed") ? $CurrentForm->getValue("Date_Barrowed") : $CurrentForm->getValue("x_Date_Barrowed");
		if (!$this->Date_Barrowed->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Date_Barrowed->Visible = FALSE; // Disable update for API request
			else
				$this->Date_Barrowed->setFormValue($val);
			$this->Date_Barrowed->CurrentValue = UnFormatDateTime($this->Date_Barrowed->CurrentValue, 5);
		}

		// Check field name 'Date_Returned' first before field var 'x_Date_Returned'
		$val = $CurrentForm->hasValue("Date_Returned") ? $CurrentForm->getValue("Date_Returned") : $CurrentForm->getValue("x_Date_Returned");
		if (!$this->Date_Returned->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Date_Returned->Visible = FALSE; // Disable update for API request
			else
				$this->Date_Returned->setFormValue($val);
			$this->Date_Returned->CurrentValue = UnFormatDateTime($this->Date_Returned->CurrentValue, 0);
		}

		// Check field name 'item_type' first before field var 'x_item_type'
		$val = $CurrentForm->hasValue("item_type") ? $CurrentForm->getValue("item_type") : $CurrentForm->getValue("x_item_type");
		if (!$this->item_type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_type->Visible = FALSE; // Disable update for API request
			else
				$this->item_type->setFormValue($val);
		}

		// Check field name 'item_model' first before field var 'x_item_model'
		$val = $CurrentForm->hasValue("item_model") ? $CurrentForm->getValue("item_model") : $CurrentForm->getValue("x_item_model");
		if (!$this->item_model->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_model->Visible = FALSE; // Disable update for API request
			else
				$this->item_model->setFormValue($val);
		}

		// Check field name 'item_serial' first before field var 'x_item_serial'
		$val = $CurrentForm->hasValue("item_serial") ? $CurrentForm->getValue("item_serial") : $CurrentForm->getValue("x_item_serial");
		if (!$this->item_serial->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_serial->Visible = FALSE; // Disable update for API request
			else
				$this->item_serial->setFormValue($val);
		}

		// Check field name 'name_barrowers' first before field var 'x_name_barrowers'
		$val = $CurrentForm->hasValue("name_barrowers") ? $CurrentForm->getValue("name_barrowers") : $CurrentForm->getValue("x_name_barrowers");
		if (!$this->name_barrowers->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->name_barrowers->Visible = FALSE; // Disable update for API request
			else
				$this->name_barrowers->setFormValue($val);
		}

		// Check field name 'Designation' first before field var 'x_Designation'
		$val = $CurrentForm->hasValue("Designation") ? $CurrentForm->getValue("Designation") : $CurrentForm->getValue("x_Designation");
		if (!$this->Designation->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Designation->Visible = FALSE; // Disable update for API request
			else
				$this->Designation->setFormValue($val);
		}

		// Check field name 'office_id' first before field var 'x_office_id'
		$val = $CurrentForm->hasValue("office_id") ? $CurrentForm->getValue("office_id") : $CurrentForm->getValue("x_office_id");
		if (!$this->office_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->office_id->Visible = FALSE; // Disable update for API request
			else
				$this->office_id->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'Remarks' first before field var 'x_Remarks'
		$val = $CurrentForm->hasValue("Remarks") ? $CurrentForm->getValue("Remarks") : $CurrentForm->getValue("x_Remarks");
		if (!$this->Remarks->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Remarks->Visible = FALSE; // Disable update for API request
			else
				$this->Remarks->setFormValue($val);
		}

		// Check field name 'user_last_modify' first before field var 'x_user_last_modify'
		$val = $CurrentForm->hasValue("user_last_modify") ? $CurrentForm->getValue("user_last_modify") : $CurrentForm->getValue("x_user_last_modify");
		if (!$this->user_last_modify->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_last_modify->Visible = FALSE; // Disable update for API request
			else
				$this->user_last_modify->setFormValue($val);
		}

		// Check field name 'date_last_modify' first before field var 'x_date_last_modify'
		$val = $CurrentForm->hasValue("date_last_modify") ? $CurrentForm->getValue("date_last_modify") : $CurrentForm->getValue("x_date_last_modify");
		if (!$this->date_last_modify->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->date_last_modify->Visible = FALSE; // Disable update for API request
			else
				$this->date_last_modify->setFormValue($val);
			$this->date_last_modify->CurrentValue = UnFormatDateTime($this->date_last_modify->CurrentValue, 1);
		}

		// Check field name 'borrowers_id' first before field var 'x_borrowers_id'
		$val = $CurrentForm->hasValue("borrowers_id") ? $CurrentForm->getValue("borrowers_id") : $CurrentForm->getValue("x_borrowers_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Date_Barrowed->CurrentValue = $this->Date_Barrowed->FormValue;
		$this->Date_Barrowed->CurrentValue = UnFormatDateTime($this->Date_Barrowed->CurrentValue, 5);
		$this->Date_Returned->CurrentValue = $this->Date_Returned->FormValue;
		$this->Date_Returned->CurrentValue = UnFormatDateTime($this->Date_Returned->CurrentValue, 0);
		$this->item_type->CurrentValue = $this->item_type->FormValue;
		$this->item_model->CurrentValue = $this->item_model->FormValue;
		$this->item_serial->CurrentValue = $this->item_serial->FormValue;
		$this->name_barrowers->CurrentValue = $this->name_barrowers->FormValue;
		$this->Designation->CurrentValue = $this->Designation->FormValue;
		$this->office_id->CurrentValue = $this->office_id->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->Remarks->CurrentValue = $this->Remarks->FormValue;
		$this->user_last_modify->CurrentValue = $this->user_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = $this->date_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = UnFormatDateTime($this->date_last_modify->CurrentValue, 1);
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
		$this->borrowers_id->setDbValue($row['borrowers_id']);
		$this->Date_Barrowed->setDbValue($row['Date_Barrowed']);
		$this->Date_Returned->setDbValue($row['Date_Returned']);
		$this->item_type->setDbValue($row['item_type']);
		$this->item_model->setDbValue($row['item_model']);
		$this->item_serial->setDbValue($row['item_serial']);
		$this->name_barrowers->setDbValue($row['name_barrowers']);
		$this->Designation->setDbValue($row['Designation']);
		$this->office_id->setDbValue($row['office_id']);
		$this->Region->setDbValue($row['Region']);
		$this->Province->setDbValue($row['Province']);
		$this->Cities->setDbValue($row['Cities']);
		$this->status->setDbValue($row['status']);
		$this->Remarks->setDbValue($row['Remarks']);
		$this->user_last_modify->setDbValue($row['user_last_modify']);
		$this->date_last_modify->setDbValue($row['date_last_modify']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['borrowers_id'] = $this->borrowers_id->CurrentValue;
		$row['Date_Barrowed'] = $this->Date_Barrowed->CurrentValue;
		$row['Date_Returned'] = $this->Date_Returned->CurrentValue;
		$row['item_type'] = $this->item_type->CurrentValue;
		$row['item_model'] = $this->item_model->CurrentValue;
		$row['item_serial'] = $this->item_serial->CurrentValue;
		$row['name_barrowers'] = $this->name_barrowers->CurrentValue;
		$row['Designation'] = $this->Designation->CurrentValue;
		$row['office_id'] = $this->office_id->CurrentValue;
		$row['Region'] = $this->Region->CurrentValue;
		$row['Province'] = $this->Province->CurrentValue;
		$row['Cities'] = $this->Cities->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['Remarks'] = $this->Remarks->CurrentValue;
		$row['user_last_modify'] = $this->user_last_modify->CurrentValue;
		$row['date_last_modify'] = $this->date_last_modify->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("borrowers_id")) != "")
			$this->borrowers_id->OldValue = $this->getKey("borrowers_id"); // borrowers_id
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// borrowers_id
		// Date_Barrowed
		// Date_Returned
		// item_type
		// item_model
		// item_serial
		// name_barrowers
		// Designation
		// office_id
		// Region
		// Province
		// Cities
		// status
		// Remarks
		// user_last_modify
		// date_last_modify

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// borrowers_id
			$this->borrowers_id->ViewValue = $this->borrowers_id->CurrentValue;
			$this->borrowers_id->ViewCustomAttributes = "";

			// Date_Barrowed
			$this->Date_Barrowed->ViewValue = $this->Date_Barrowed->CurrentValue;
			$this->Date_Barrowed->ViewValue = FormatDateTime($this->Date_Barrowed->ViewValue, 5);
			$this->Date_Barrowed->ViewCustomAttributes = "";

			// Date_Returned
			$this->Date_Returned->ViewValue = $this->Date_Returned->CurrentValue;
			$this->Date_Returned->ViewCustomAttributes = "";

			// item_type
			$curVal = strval($this->item_type->CurrentValue);
			if ($curVal != "") {
				$this->item_type->ViewValue = $this->item_type->lookupCacheOption($curVal);
				if ($this->item_type->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`cat_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->item_type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->item_type->ViewValue = $this->item_type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->item_type->ViewValue = $this->item_type->CurrentValue;
					}
				}
			} else {
				$this->item_type->ViewValue = NULL;
			}
			$this->item_type->ViewCustomAttributes = "";

			// item_model
			$this->item_model->ViewValue = $this->item_model->CurrentValue;
			$this->item_model->ViewCustomAttributes = "";

			// item_serial
			$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
			$this->item_serial->ViewCustomAttributes = "";

			// name_barrowers
			$this->name_barrowers->ViewValue = $this->name_barrowers->CurrentValue;
			$this->name_barrowers->ViewCustomAttributes = "";

			// Designation
			$this->Designation->ViewValue = $this->Designation->CurrentValue;
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

			// status
			$curVal = strval($this->status->CurrentValue);
			if ($curVal != "") {
				$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
				if ($this->status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`barrowed_status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->status->ViewValue = $this->status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->status->ViewValue = $this->status->CurrentValue;
					}
				}
			} else {
				$this->status->ViewValue = NULL;
			}
			$this->status->ViewCustomAttributes = "";

			// Remarks
			$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
			if ($this->Remarks->ViewValue != NULL)
				$this->Remarks->ViewValue = str_replace("\n", "<br>", $this->Remarks->ViewValue);
			$this->Remarks->ViewCustomAttributes = "";

			// user_last_modify
			$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
			$this->user_last_modify->ViewCustomAttributes = "";

			// date_last_modify
			$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 1);
			$this->date_last_modify->ViewCustomAttributes = "";

			// Date_Barrowed
			$this->Date_Barrowed->LinkCustomAttributes = "";
			$this->Date_Barrowed->HrefValue = "";
			$this->Date_Barrowed->TooltipValue = "";

			// Date_Returned
			$this->Date_Returned->LinkCustomAttributes = "";
			$this->Date_Returned->HrefValue = "";
			$this->Date_Returned->TooltipValue = "";

			// item_type
			$this->item_type->LinkCustomAttributes = "";
			$this->item_type->HrefValue = "";
			$this->item_type->TooltipValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";
			$this->item_model->TooltipValue = "";

			// item_serial
			$this->item_serial->LinkCustomAttributes = "";
			$this->item_serial->HrefValue = "";
			$this->item_serial->TooltipValue = "";

			// name_barrowers
			$this->name_barrowers->LinkCustomAttributes = "";
			$this->name_barrowers->HrefValue = "";
			$this->name_barrowers->TooltipValue = "";

			// Designation
			$this->Designation->LinkCustomAttributes = "";
			$this->Designation->HrefValue = "";
			$this->Designation->TooltipValue = "";

			// office_id
			$this->office_id->LinkCustomAttributes = "";
			$this->office_id->HrefValue = "";
			$this->office_id->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// Remarks
			$this->Remarks->LinkCustomAttributes = "";
			$this->Remarks->HrefValue = "";
			$this->Remarks->TooltipValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Date_Barrowed
			$this->Date_Barrowed->EditAttrs["class"] = "form-control";
			$this->Date_Barrowed->EditCustomAttributes = "";
			$this->Date_Barrowed->EditValue = HtmlEncode(FormatDateTime($this->Date_Barrowed->CurrentValue, 5));
			$this->Date_Barrowed->PlaceHolder = RemoveHtml($this->Date_Barrowed->caption());

			// Date_Returned
			$this->Date_Returned->EditAttrs["class"] = "form-control";
			$this->Date_Returned->EditCustomAttributes = "";
			$this->Date_Returned->EditValue = HtmlEncode($this->Date_Returned->CurrentValue);
			$this->Date_Returned->PlaceHolder = RemoveHtml($this->Date_Returned->caption());

			// item_type
			$this->item_type->EditAttrs["class"] = "form-control";
			$this->item_type->EditCustomAttributes = "";
			$curVal = trim(strval($this->item_type->CurrentValue));
			if ($curVal != "")
				$this->item_type->ViewValue = $this->item_type->lookupCacheOption($curVal);
			else
				$this->item_type->ViewValue = $this->item_type->Lookup !== NULL && is_array($this->item_type->Lookup->Options) ? $curVal : NULL;
			if ($this->item_type->ViewValue !== NULL) { // Load from cache
				$this->item_type->EditValue = array_values($this->item_type->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`cat_id`" . SearchString("=", $this->item_type->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->item_type->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->item_type->EditValue = $arwrk;
			}

			// item_model
			$this->item_model->EditAttrs["class"] = "form-control";
			$this->item_model->EditCustomAttributes = "";
			if (!$this->item_model->Raw)
				$this->item_model->CurrentValue = HtmlDecode($this->item_model->CurrentValue);
			$this->item_model->EditValue = HtmlEncode($this->item_model->CurrentValue);
			$this->item_model->PlaceHolder = RemoveHtml($this->item_model->caption());

			// item_serial
			$this->item_serial->EditAttrs["class"] = "form-control";
			$this->item_serial->EditCustomAttributes = "";
			if (!$this->item_serial->Raw)
				$this->item_serial->CurrentValue = HtmlDecode($this->item_serial->CurrentValue);
			$this->item_serial->EditValue = HtmlEncode($this->item_serial->CurrentValue);
			$this->item_serial->PlaceHolder = RemoveHtml($this->item_serial->caption());

			// name_barrowers
			$this->name_barrowers->EditAttrs["class"] = "form-control";
			$this->name_barrowers->EditCustomAttributes = "";
			if (!$this->name_barrowers->Raw)
				$this->name_barrowers->CurrentValue = HtmlDecode($this->name_barrowers->CurrentValue);
			$this->name_barrowers->EditValue = HtmlEncode($this->name_barrowers->CurrentValue);
			$this->name_barrowers->PlaceHolder = RemoveHtml($this->name_barrowers->caption());

			// Designation
			$this->Designation->EditAttrs["class"] = "form-control";
			$this->Designation->EditCustomAttributes = "";
			if (!$this->Designation->Raw)
				$this->Designation->CurrentValue = HtmlDecode($this->Designation->CurrentValue);
			$this->Designation->EditValue = HtmlEncode($this->Designation->CurrentValue);
			$this->Designation->PlaceHolder = RemoveHtml($this->Designation->caption());

			// office_id
			$this->office_id->EditAttrs["class"] = "form-control";
			$this->office_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->office_id->CurrentValue));
			if ($curVal != "")
				$this->office_id->ViewValue = $this->office_id->lookupCacheOption($curVal);
			else
				$this->office_id->ViewValue = $this->office_id->Lookup !== NULL && is_array($this->office_id->Lookup->Options) ? $curVal : NULL;
			if ($this->office_id->ViewValue !== NULL) { // Load from cache
				$this->office_id->EditValue = array_values($this->office_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`off_id`" . SearchString("=", $this->office_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->office_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->office_id->EditValue = $arwrk;
			}

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			$curVal = trim(strval($this->status->CurrentValue));
			if ($curVal != "")
				$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
			else
				$this->status->ViewValue = $this->status->Lookup !== NULL && is_array($this->status->Lookup->Options) ? $curVal : NULL;
			if ($this->status->ViewValue !== NULL) { // Load from cache
				$this->status->EditValue = array_values($this->status->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`barrowed_status_id`" . SearchString("=", $this->status->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->status->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->status->EditValue = $arwrk;
			}

			// Remarks
			$this->Remarks->EditAttrs["class"] = "form-control";
			$this->Remarks->EditCustomAttributes = "";
			$this->Remarks->EditValue = HtmlEncode($this->Remarks->CurrentValue);
			$this->Remarks->PlaceHolder = RemoveHtml($this->Remarks->caption());

			// user_last_modify
			// date_last_modify
			// Add refer script
			// Date_Barrowed

			$this->Date_Barrowed->LinkCustomAttributes = "";
			$this->Date_Barrowed->HrefValue = "";

			// Date_Returned
			$this->Date_Returned->LinkCustomAttributes = "";
			$this->Date_Returned->HrefValue = "";

			// item_type
			$this->item_type->LinkCustomAttributes = "";
			$this->item_type->HrefValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";

			// item_serial
			$this->item_serial->LinkCustomAttributes = "";
			$this->item_serial->HrefValue = "";

			// name_barrowers
			$this->name_barrowers->LinkCustomAttributes = "";
			$this->name_barrowers->HrefValue = "";

			// Designation
			$this->Designation->LinkCustomAttributes = "";
			$this->Designation->HrefValue = "";

			// office_id
			$this->office_id->LinkCustomAttributes = "";
			$this->office_id->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// Remarks
			$this->Remarks->LinkCustomAttributes = "";
			$this->Remarks->HrefValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();

		// Save data for Custom Template
		if ($this->RowType == ROWTYPE_VIEW || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_ADD)
			$this->Rows[] = $this->customTemplateFieldValues();
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
		if ($this->Date_Barrowed->Required) {
			if (!$this->Date_Barrowed->IsDetailKey && $this->Date_Barrowed->FormValue != NULL && $this->Date_Barrowed->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Date_Barrowed->caption(), $this->Date_Barrowed->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->Date_Barrowed->FormValue)) {
			AddMessage($FormError, $this->Date_Barrowed->errorMessage());
		}
		if ($this->Date_Returned->Required) {
			if (!$this->Date_Returned->IsDetailKey && $this->Date_Returned->FormValue != NULL && $this->Date_Returned->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Date_Returned->caption(), $this->Date_Returned->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Date_Returned->FormValue)) {
			AddMessage($FormError, $this->Date_Returned->errorMessage());
		}
		if ($this->item_type->Required) {
			if (!$this->item_type->IsDetailKey && $this->item_type->FormValue != NULL && $this->item_type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_type->caption(), $this->item_type->RequiredErrorMessage));
			}
		}
		if ($this->item_model->Required) {
			if (!$this->item_model->IsDetailKey && $this->item_model->FormValue != NULL && $this->item_model->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_model->caption(), $this->item_model->RequiredErrorMessage));
			}
		}
		if ($this->item_serial->Required) {
			if (!$this->item_serial->IsDetailKey && $this->item_serial->FormValue != NULL && $this->item_serial->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_serial->caption(), $this->item_serial->RequiredErrorMessage));
			}
		}
		if ($this->name_barrowers->Required) {
			if (!$this->name_barrowers->IsDetailKey && $this->name_barrowers->FormValue != NULL && $this->name_barrowers->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->name_barrowers->caption(), $this->name_barrowers->RequiredErrorMessage));
			}
		}
		if ($this->Designation->Required) {
			if (!$this->Designation->IsDetailKey && $this->Designation->FormValue != NULL && $this->Designation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Designation->caption(), $this->Designation->RequiredErrorMessage));
			}
		}
		if ($this->office_id->Required) {
			if (!$this->office_id->IsDetailKey && $this->office_id->FormValue != NULL && $this->office_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->office_id->caption(), $this->office_id->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->Remarks->Required) {
			if (!$this->Remarks->IsDetailKey && $this->Remarks->FormValue != NULL && $this->Remarks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Remarks->caption(), $this->Remarks->RequiredErrorMessage));
			}
		}
		if ($this->user_last_modify->Required) {
			if (!$this->user_last_modify->IsDetailKey && $this->user_last_modify->FormValue != NULL && $this->user_last_modify->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_last_modify->caption(), $this->user_last_modify->RequiredErrorMessage));
			}
		}
		if ($this->date_last_modify->Required) {
			if (!$this->date_last_modify->IsDetailKey && $this->date_last_modify->FormValue != NULL && $this->date_last_modify->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->date_last_modify->caption(), $this->date_last_modify->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// Date_Barrowed
		$this->Date_Barrowed->setDbValueDef($rsnew, UnFormatDateTime($this->Date_Barrowed->CurrentValue, 5), NULL, FALSE);

		// Date_Returned
		$this->Date_Returned->setDbValueDef($rsnew, $this->Date_Returned->CurrentValue, NULL, FALSE);

		// item_type
		$this->item_type->setDbValueDef($rsnew, $this->item_type->CurrentValue, NULL, FALSE);

		// item_model
		$this->item_model->setDbValueDef($rsnew, $this->item_model->CurrentValue, NULL, FALSE);

		// item_serial
		$this->item_serial->setDbValueDef($rsnew, $this->item_serial->CurrentValue, NULL, FALSE);

		// name_barrowers
		$this->name_barrowers->setDbValueDef($rsnew, $this->name_barrowers->CurrentValue, NULL, FALSE);

		// Designation
		$this->Designation->setDbValueDef($rsnew, $this->Designation->CurrentValue, NULL, FALSE);

		// office_id
		$this->office_id->setDbValueDef($rsnew, $this->office_id->CurrentValue, NULL, FALSE);

		// status
		$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, FALSE);

		// Remarks
		$this->Remarks->setDbValueDef($rsnew, $this->Remarks->CurrentValue, NULL, FALSE);

		// user_last_modify
		$this->user_last_modify->CurrentValue = CurrentUserName();
		$this->user_last_modify->setDbValueDef($rsnew, $this->user_last_modify->CurrentValue, NULL);

		// date_last_modify
		$this->date_last_modify->CurrentValue = CurrentDateTime();
		$this->date_last_modify->setDbValueDef($rsnew, $this->date_last_modify->CurrentValue, NULL);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_borrowerslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_item_type":
					break;
				case "x_office_id":
					break;
				case "x_Region":
					$lookupFilter = function() {
						return "region_name = 'REGION VI [Western Visayas]'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Province":
					break;
				case "x_Cities":
					break;
				case "x_status":
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
						case "x_item_type":
							break;
						case "x_office_id":
							break;
						case "x_Region":
							break;
						case "x_Province":
							break;
						case "x_Cities":
							break;
						case "x_status":
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
	$this->item_type->DisplayValueSeparator = "-";
	$this->status->DisplayValueSeparator = "-";
	$this->Date_Returned->ReadOnly = TRUE;
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
} // End class
?>