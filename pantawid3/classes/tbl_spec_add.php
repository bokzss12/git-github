<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_spec_add extends tbl_spec
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_spec';

	// Page object name
	public $PageObjName = "tbl_spec_add";

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

		// Table object (tbl_spec)
		if (!isset($GLOBALS["tbl_spec"]) || get_class($GLOBALS["tbl_spec"]) == PROJECT_NAMESPACE . "tbl_spec") {
			$GLOBALS["tbl_spec"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_spec"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Table object (tbl_pr)
		if (!isset($GLOBALS['tbl_pr']))
			$GLOBALS['tbl_pr'] = new tbl_pr();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
		global $tbl_spec;
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
					if ($pageName == "tbl_specview.php")
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
					$this->terminate(GetUrl("tbl_speclist.php"));
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
		$this->specID->Visible = FALSE;
		$this->pr_number->setVisibility();
		$this->spec_unit->setVisibility();
		$this->spec_dsc->setVisibility();
		$this->spec_qty->setVisibility();
		$this->spec_unitprice->setVisibility();
		$this->spec_totalprice->setVisibility();
		$this->employeeID->Visible = FALSE;
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
		$this->setupLookupOptions($this->spec_unit);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("tbl_speclist.php");
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
			if (Get("specID") !== NULL) {
				$this->specID->setQueryStringValue(Get("specID"));
				$this->setKey("specID", $this->specID->CurrentValue); // Set up key
			} else {
				$this->setKey("specID", ""); // Clear key
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

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

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
					$this->terminate("tbl_speclist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetViewUrl();
					if (GetPageName($returnUrl) == "tbl_speclist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_specview.php")
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

		// Check field name 'pr_number' first before field var 'x_pr_number'
		$val = $CurrentForm->hasValue("pr_number") ? $CurrentForm->getValue("pr_number") : $CurrentForm->getValue("x_pr_number");
		if (!$this->pr_number->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pr_number->Visible = FALSE; // Disable update for API request
			else
				$this->pr_number->setFormValue($val);
		}

		// Check field name 'spec_unit' first before field var 'x_spec_unit'
		$val = $CurrentForm->hasValue("spec_unit") ? $CurrentForm->getValue("spec_unit") : $CurrentForm->getValue("x_spec_unit");
		if (!$this->spec_unit->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_unit->Visible = FALSE; // Disable update for API request
			else
				$this->spec_unit->setFormValue($val);
		}

		// Check field name 'spec_dsc' first before field var 'x_spec_dsc'
		$val = $CurrentForm->hasValue("spec_dsc") ? $CurrentForm->getValue("spec_dsc") : $CurrentForm->getValue("x_spec_dsc");
		if (!$this->spec_dsc->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_dsc->Visible = FALSE; // Disable update for API request
			else
				$this->spec_dsc->setFormValue($val);
		}

		// Check field name 'spec_qty' first before field var 'x_spec_qty'
		$val = $CurrentForm->hasValue("spec_qty") ? $CurrentForm->getValue("spec_qty") : $CurrentForm->getValue("x_spec_qty");
		if (!$this->spec_qty->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_qty->Visible = FALSE; // Disable update for API request
			else
				$this->spec_qty->setFormValue($val);
		}

		// Check field name 'spec_unitprice' first before field var 'x_spec_unitprice'
		$val = $CurrentForm->hasValue("spec_unitprice") ? $CurrentForm->getValue("spec_unitprice") : $CurrentForm->getValue("x_spec_unitprice");
		if (!$this->spec_unitprice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_unitprice->Visible = FALSE; // Disable update for API request
			else
				$this->spec_unitprice->setFormValue($val);
		}

		// Check field name 'spec_totalprice' first before field var 'x_spec_totalprice'
		$val = $CurrentForm->hasValue("spec_totalprice") ? $CurrentForm->getValue("spec_totalprice") : $CurrentForm->getValue("x_spec_totalprice");
		if (!$this->spec_totalprice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spec_totalprice->Visible = FALSE; // Disable update for API request
			else
				$this->spec_totalprice->setFormValue($val);
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
			$this->date_last_modify->CurrentValue = UnFormatDateTime($this->date_last_modify->CurrentValue, 0);
		}

		// Check field name 'specID' first before field var 'x_specID'
		$val = $CurrentForm->hasValue("specID") ? $CurrentForm->getValue("specID") : $CurrentForm->getValue("x_specID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->pr_number->CurrentValue = $this->pr_number->FormValue;
		$this->spec_unit->CurrentValue = $this->spec_unit->FormValue;
		$this->spec_dsc->CurrentValue = $this->spec_dsc->FormValue;
		$this->spec_qty->CurrentValue = $this->spec_qty->FormValue;
		$this->spec_unitprice->CurrentValue = $this->spec_unitprice->FormValue;
		$this->spec_totalprice->CurrentValue = $this->spec_totalprice->FormValue;
		$this->user_last_modify->CurrentValue = $this->user_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = $this->date_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = UnFormatDateTime($this->date_last_modify->CurrentValue, 0);
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
		if (strval($this->getKey("specID")) != "")
			$this->specID->OldValue = $this->getKey("specID"); // specID
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
		// pr_number
		// spec_unit
		// spec_dsc
		// spec_qty
		// spec_unitprice
		// spec_totalprice
		// employeeID
		// user_last_modify
		// date_last_modify

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
			$this->spec_totalprice->ViewValue = FormatNumber($this->spec_totalprice->ViewValue, 2, -2, -2, -2);
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

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pr_number
			$this->pr_number->EditAttrs["class"] = "form-control";
			$this->pr_number->EditCustomAttributes = "";
			if ($this->pr_number->getSessionValue() != "") {
				$this->pr_number->CurrentValue = $this->pr_number->getSessionValue();
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
			if (strval($this->spec_qty->EditValue) != "" && is_numeric($this->spec_qty->EditValue))
				$this->spec_qty->EditValue = FormatNumber($this->spec_qty->EditValue, -2, -2, -2, -2);
			

			// spec_unitprice
			$this->spec_unitprice->EditAttrs["class"] = "form-control";
			$this->spec_unitprice->EditCustomAttributes = "";
			$this->spec_unitprice->EditValue = HtmlEncode($this->spec_unitprice->CurrentValue);
			$this->spec_unitprice->PlaceHolder = RemoveHtml($this->spec_unitprice->caption());
			if (strval($this->spec_unitprice->EditValue) != "" && is_numeric($this->spec_unitprice->EditValue))
				$this->spec_unitprice->EditValue = FormatNumber($this->spec_unitprice->EditValue, -2, -2, -2, -2);
			

			// spec_totalprice
			$this->spec_totalprice->EditAttrs["class"] = "form-control";
			$this->spec_totalprice->EditCustomAttributes = "";
			$this->spec_totalprice->EditValue = HtmlEncode($this->spec_totalprice->CurrentValue);
			$this->spec_totalprice->PlaceHolder = RemoveHtml($this->spec_totalprice->caption());
			if (strval($this->spec_totalprice->EditValue) != "" && is_numeric($this->spec_totalprice->EditValue))
				$this->spec_totalprice->EditValue = FormatNumber($this->spec_totalprice->EditValue, -2, -2, -2, -2);
			

			// user_last_modify
			// date_last_modify
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
			if ($masterTblVar == "tbl_pr") {
				$validMaster = TRUE;
				if (($parm = Get("fk_pr_number") ?: Get("pr_number")) !== NULL) {
					$GLOBALS["tbl_pr"]->pr_number->setQueryStringValue($parm);
					$this->pr_number->setQueryStringValue($GLOBALS["tbl_pr"]->pr_number->QueryStringValue);
					$this->pr_number->setSessionValue($this->pr_number->QueryStringValue);
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
			if ($masterTblVar == "tbl_pr") {
				$validMaster = TRUE;
				if (($parm = Post("fk_pr_number") ?: Post("pr_number")) !== NULL) {
					$GLOBALS["tbl_pr"]->pr_number->setFormValue($parm);
					$this->pr_number->setFormValue($GLOBALS["tbl_pr"]->pr_number->FormValue);
					$this->pr_number->setSessionValue($this->pr_number->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "tbl_pr") {
				if ($this->pr_number->CurrentValue == "")
					$this->pr_number->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_speclist.php"), "", $this->TableVar, TRUE);
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
		$this->spec_totalprice->ReadOnly = TRUE;
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