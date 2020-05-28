<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_encoder_add extends tbl_encoder
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_encoder';

	// Page object name
	public $PageObjName = "tbl_encoder_add";

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

		// Table object (tbl_encoder)
		if (!isset($GLOBALS["tbl_encoder"]) || get_class($GLOBALS["tbl_encoder"]) == PROJECT_NAMESPACE . "tbl_encoder") {
			$GLOBALS["tbl_encoder"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_encoder"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_encoder');

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
		global $tbl_encoder;
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
				$doc = new $class($tbl_encoder);
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
					if ($pageName == "tbl_encoderview.php")
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
			$key .= @$ar['encoder_id'];
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
					$this->terminate(GetUrl("tbl_encoderlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("tbl_encoderlist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->encoder_id->Visible = FALSE;
		$this->encoder_month->Visible = FALSE;
		$this->encoder_year->Visible = FALSE;
		$this->date->setVisibility();
		$this->activities->setVisibility();
		$this->action_taken->setVisibility();
		$this->total_encoded->setVisibility();
		$this->status_remark->setVisibility();
		$this->employee_id->setVisibility();
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
		$this->setupLookupOptions($this->encoder_month);
		$this->setupLookupOptions($this->encoder_year);
		$this->setupLookupOptions($this->activities);
		$this->setupLookupOptions($this->status_remark);
		$this->setupLookupOptions($this->employee_id);
		$this->setupLookupOptions($this->user_last_modify);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("tbl_encoderlist.php");
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
			if (Get("encoder_id") !== NULL) {
				$this->encoder_id->setQueryStringValue(Get("encoder_id"));
				$this->setKey("encoder_id", $this->encoder_id->CurrentValue); // Set up key
			} else {
				$this->setKey("encoder_id", ""); // Clear key
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
					$this->terminate("tbl_encoderlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetViewUrl();
					if (GetPageName($returnUrl) == "tbl_encoderlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_encoderview.php")
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
		$this->encoder_id->CurrentValue = NULL;
		$this->encoder_id->OldValue = $this->encoder_id->CurrentValue;
		$this->encoder_month->CurrentValue = NULL;
		$this->encoder_month->OldValue = $this->encoder_month->CurrentValue;
		$this->encoder_year->CurrentValue = NULL;
		$this->encoder_year->OldValue = $this->encoder_year->CurrentValue;
		$this->date->CurrentValue = date("Y/m/d");
		$this->activities->CurrentValue = NULL;
		$this->activities->OldValue = $this->activities->CurrentValue;
		$this->action_taken->CurrentValue = NULL;
		$this->action_taken->OldValue = $this->action_taken->CurrentValue;
		$this->total_encoded->CurrentValue = NULL;
		$this->total_encoded->OldValue = $this->total_encoded->CurrentValue;
		$this->status_remark->CurrentValue = NULL;
		$this->status_remark->OldValue = $this->status_remark->CurrentValue;
		$this->employee_id->CurrentValue = CurrentUserID();
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

		// Check field name 'date' first before field var 'x_date'
		$val = $CurrentForm->hasValue("date") ? $CurrentForm->getValue("date") : $CurrentForm->getValue("x_date");
		if (!$this->date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->date->Visible = FALSE; // Disable update for API request
			else
				$this->date->setFormValue($val);
			$this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, 5);
		}

		// Check field name 'activities' first before field var 'x_activities'
		$val = $CurrentForm->hasValue("activities") ? $CurrentForm->getValue("activities") : $CurrentForm->getValue("x_activities");
		if (!$this->activities->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->activities->Visible = FALSE; // Disable update for API request
			else
				$this->activities->setFormValue($val);
		}

		// Check field name 'action_taken' first before field var 'x_action_taken'
		$val = $CurrentForm->hasValue("action_taken") ? $CurrentForm->getValue("action_taken") : $CurrentForm->getValue("x_action_taken");
		if (!$this->action_taken->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->action_taken->Visible = FALSE; // Disable update for API request
			else
				$this->action_taken->setFormValue($val);
		}

		// Check field name 'total_encoded' first before field var 'x_total_encoded'
		$val = $CurrentForm->hasValue("total_encoded") ? $CurrentForm->getValue("total_encoded") : $CurrentForm->getValue("x_total_encoded");
		if (!$this->total_encoded->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_encoded->Visible = FALSE; // Disable update for API request
			else
				$this->total_encoded->setFormValue($val);
		}

		// Check field name 'status_remark' first before field var 'x_status_remark'
		$val = $CurrentForm->hasValue("status_remark") ? $CurrentForm->getValue("status_remark") : $CurrentForm->getValue("x_status_remark");
		if (!$this->status_remark->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status_remark->Visible = FALSE; // Disable update for API request
			else
				$this->status_remark->setFormValue($val);
		}

		// Check field name 'employee_id' first before field var 'x_employee_id'
		$val = $CurrentForm->hasValue("employee_id") ? $CurrentForm->getValue("employee_id") : $CurrentForm->getValue("x_employee_id");
		if (!$this->employee_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->employee_id->Visible = FALSE; // Disable update for API request
			else
				$this->employee_id->setFormValue($val);
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

		// Check field name 'encoder_id' first before field var 'x_encoder_id'
		$val = $CurrentForm->hasValue("encoder_id") ? $CurrentForm->getValue("encoder_id") : $CurrentForm->getValue("x_encoder_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->date->CurrentValue = $this->date->FormValue;
		$this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, 5);
		$this->activities->CurrentValue = $this->activities->FormValue;
		$this->action_taken->CurrentValue = $this->action_taken->FormValue;
		$this->total_encoded->CurrentValue = $this->total_encoded->FormValue;
		$this->status_remark->CurrentValue = $this->status_remark->FormValue;
		$this->employee_id->CurrentValue = $this->employee_id->FormValue;
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

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('add');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
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
		$this->encoder_id->setDbValue($row['encoder_id']);
		$this->encoder_month->setDbValue($row['encoder_month']);
		$this->encoder_year->setDbValue($row['encoder_year']);
		$this->date->setDbValue($row['date']);
		$this->activities->setDbValue($row['activities']);
		$this->action_taken->setDbValue($row['action_taken']);
		$this->total_encoded->setDbValue($row['total_encoded']);
		$this->status_remark->setDbValue($row['status_remark']);
		$this->employee_id->setDbValue($row['employee_id']);
		$this->user_last_modify->setDbValue($row['user_last_modify']);
		$this->date_last_modify->setDbValue($row['date_last_modify']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['encoder_id'] = $this->encoder_id->CurrentValue;
		$row['encoder_month'] = $this->encoder_month->CurrentValue;
		$row['encoder_year'] = $this->encoder_year->CurrentValue;
		$row['date'] = $this->date->CurrentValue;
		$row['activities'] = $this->activities->CurrentValue;
		$row['action_taken'] = $this->action_taken->CurrentValue;
		$row['total_encoded'] = $this->total_encoded->CurrentValue;
		$row['status_remark'] = $this->status_remark->CurrentValue;
		$row['employee_id'] = $this->employee_id->CurrentValue;
		$row['user_last_modify'] = $this->user_last_modify->CurrentValue;
		$row['date_last_modify'] = $this->date_last_modify->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("encoder_id")) != "")
			$this->encoder_id->OldValue = $this->getKey("encoder_id"); // encoder_id
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

		if ($this->total_encoded->FormValue == $this->total_encoded->CurrentValue && is_numeric(ConvertToFloatString($this->total_encoded->CurrentValue)))
			$this->total_encoded->CurrentValue = ConvertToFloatString($this->total_encoded->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// encoder_id
		// encoder_month
		// encoder_year
		// date
		// activities
		// action_taken
		// total_encoded
		// status_remark
		// employee_id
		// user_last_modify
		// date_last_modify

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// encoder_id
			$this->encoder_id->ViewValue = $this->encoder_id->CurrentValue;
			$this->encoder_id->ViewCustomAttributes = "";

			// date
			$this->date->ViewValue = $this->date->CurrentValue;
			$this->date->ViewValue = FormatDateTime($this->date->ViewValue, 5);
			$this->date->ViewCustomAttributes = "";

			// activities
			$curVal = strval($this->activities->CurrentValue);
			if ($curVal != "") {
				$this->activities->ViewValue = $this->activities->lookupCacheOption($curVal);
				if ($this->activities->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`enc_activities_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->activities->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->activities->ViewValue = $this->activities->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->activities->ViewValue = $this->activities->CurrentValue;
					}
				}
			} else {
				$this->activities->ViewValue = NULL;
			}
			$this->activities->ViewCustomAttributes = "";

			// action_taken
			$this->action_taken->ViewValue = $this->action_taken->CurrentValue;
			if ($this->action_taken->ViewValue != NULL)
				$this->action_taken->ViewValue = str_replace("\n", "<br>", $this->action_taken->ViewValue);
			$this->action_taken->CellCssStyle .= "text-align: left;";
			$this->action_taken->ViewCustomAttributes = "";

			// total_encoded
			$this->total_encoded->ViewValue = $this->total_encoded->CurrentValue;
			$this->total_encoded->ViewValue = FormatNumber($this->total_encoded->ViewValue, 0, -1, -1, -1);
			$this->total_encoded->CellCssStyle .= "text-align: right;";
			$this->total_encoded->ViewCustomAttributes = "";

			// status_remark
			$curVal = strval($this->status_remark->CurrentValue);
			if ($curVal != "") {
				$this->status_remark->ViewValue = $this->status_remark->lookupCacheOption($curVal);
				if ($this->status_remark->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`status_enc_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->status_remark->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->status_remark->ViewValue = $this->status_remark->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->status_remark->ViewValue = $this->status_remark->CurrentValue;
					}
				}
			} else {
				$this->status_remark->ViewValue = NULL;
			}
			$this->status_remark->CellCssStyle .= "text-align: left;";
			$this->status_remark->ViewCustomAttributes = "";

			// employee_id
			$curVal = strval($this->employee_id->CurrentValue);
			if ($curVal != "") {
				$this->employee_id->ViewValue = $this->employee_id->lookupCacheOption($curVal);
				if ($this->employee_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`employeeid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->employee_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->employee_id->ViewValue = $this->employee_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->employee_id->ViewValue = $this->employee_id->CurrentValue;
					}
				}
			} else {
				$this->employee_id->ViewValue = NULL;
			}
			$this->employee_id->CellCssStyle .= "text-align: left;";
			$this->employee_id->ViewCustomAttributes = "";

			// user_last_modify
			$curVal = strval($this->user_last_modify->CurrentValue);
			if ($curVal != "") {
				$this->user_last_modify->ViewValue = $this->user_last_modify->lookupCacheOption($curVal);
				if ($this->user_last_modify->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`username`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->user_last_modify->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->user_last_modify->ViewValue = $this->user_last_modify->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
					}
				}
			} else {
				$this->user_last_modify->ViewValue = NULL;
			}
			$this->user_last_modify->ViewCustomAttributes = "";

			// date_last_modify
			$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
			$this->date_last_modify->ViewCustomAttributes = "";

			// date
			$this->date->LinkCustomAttributes = "";
			$this->date->HrefValue = "";
			$this->date->TooltipValue = "";

			// activities
			$this->activities->LinkCustomAttributes = "";
			$this->activities->HrefValue = "";
			$this->activities->TooltipValue = "";

			// action_taken
			$this->action_taken->LinkCustomAttributes = "";
			$this->action_taken->HrefValue = "";
			$this->action_taken->TooltipValue = "";

			// total_encoded
			$this->total_encoded->LinkCustomAttributes = "";
			$this->total_encoded->HrefValue = "";
			$this->total_encoded->TooltipValue = "";

			// status_remark
			$this->status_remark->LinkCustomAttributes = "";
			$this->status_remark->HrefValue = "";
			$this->status_remark->TooltipValue = "";

			// employee_id
			$this->employee_id->LinkCustomAttributes = "";
			$this->employee_id->HrefValue = "";
			$this->employee_id->TooltipValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// date
			$this->date->EditAttrs["class"] = "form-control";
			$this->date->EditCustomAttributes = "";
			$this->date->EditValue = HtmlEncode(FormatDateTime($this->date->CurrentValue, 5));
			$this->date->PlaceHolder = RemoveHtml($this->date->caption());

			// activities
			$this->activities->EditAttrs["class"] = "form-control";
			$this->activities->EditCustomAttributes = "";
			$curVal = trim(strval($this->activities->CurrentValue));
			if ($curVal != "")
				$this->activities->ViewValue = $this->activities->lookupCacheOption($curVal);
			else
				$this->activities->ViewValue = $this->activities->Lookup !== NULL && is_array($this->activities->Lookup->Options) ? $curVal : NULL;
			if ($this->activities->ViewValue !== NULL) { // Load from cache
				$this->activities->EditValue = array_values($this->activities->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`enc_activities_id`" . SearchString("=", $this->activities->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->activities->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->activities->EditValue = $arwrk;
			}

			// action_taken
			$this->action_taken->EditAttrs["class"] = "form-control";
			$this->action_taken->EditCustomAttributes = "";
			$this->action_taken->EditValue = HtmlEncode($this->action_taken->CurrentValue);
			$this->action_taken->PlaceHolder = RemoveHtml($this->action_taken->caption());

			// total_encoded
			$this->total_encoded->EditAttrs["class"] = "form-control";
			$this->total_encoded->EditCustomAttributes = "";
			$this->total_encoded->EditValue = HtmlEncode($this->total_encoded->CurrentValue);
			$this->total_encoded->PlaceHolder = RemoveHtml($this->total_encoded->caption());
			if (strval($this->total_encoded->EditValue) != "" && is_numeric($this->total_encoded->EditValue))
				$this->total_encoded->EditValue = FormatNumber($this->total_encoded->EditValue, -2, -1, -2, -1);
			

			// status_remark
			$this->status_remark->EditAttrs["class"] = "form-control";
			$this->status_remark->EditCustomAttributes = "";
			$curVal = trim(strval($this->status_remark->CurrentValue));
			if ($curVal != "")
				$this->status_remark->ViewValue = $this->status_remark->lookupCacheOption($curVal);
			else
				$this->status_remark->ViewValue = $this->status_remark->Lookup !== NULL && is_array($this->status_remark->Lookup->Options) ? $curVal : NULL;
			if ($this->status_remark->ViewValue !== NULL) { // Load from cache
				$this->status_remark->EditValue = array_values($this->status_remark->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`status_enc_id`" . SearchString("=", $this->status_remark->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->status_remark->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->status_remark->EditValue = $arwrk;
			}

			// employee_id
			$this->employee_id->EditAttrs["class"] = "form-control";
			$this->employee_id->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("add")) { // Non system admin
				$this->employee_id->CurrentValue = CurrentUserID();
				$curVal = strval($this->employee_id->CurrentValue);
				if ($curVal != "") {
					$this->employee_id->EditValue = $this->employee_id->lookupCacheOption($curVal);
					if ($this->employee_id->EditValue === NULL) { // Lookup from database
						$filterWrk = "`employeeid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->employee_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->employee_id->EditValue = $this->employee_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->employee_id->EditValue = $this->employee_id->CurrentValue;
						}
					}
				} else {
					$this->employee_id->EditValue = NULL;
				}
				$this->employee_id->CellCssStyle .= "text-align: left;";
				$this->employee_id->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->employee_id->CurrentValue));
				if ($curVal != "")
					$this->employee_id->ViewValue = $this->employee_id->lookupCacheOption($curVal);
				else
					$this->employee_id->ViewValue = $this->employee_id->Lookup !== NULL && is_array($this->employee_id->Lookup->Options) ? $curVal : NULL;
				if ($this->employee_id->ViewValue !== NULL) { // Load from cache
					$this->employee_id->EditValue = array_values($this->employee_id->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`employeeid`" . SearchString("=", $this->employee_id->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->employee_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->employee_id->EditValue = $arwrk;
				}
			}

			// user_last_modify
			// date_last_modify
			// Add refer script
			// date

			$this->date->LinkCustomAttributes = "";
			$this->date->HrefValue = "";

			// activities
			$this->activities->LinkCustomAttributes = "";
			$this->activities->HrefValue = "";

			// action_taken
			$this->action_taken->LinkCustomAttributes = "";
			$this->action_taken->HrefValue = "";

			// total_encoded
			$this->total_encoded->LinkCustomAttributes = "";
			$this->total_encoded->HrefValue = "";

			// status_remark
			$this->status_remark->LinkCustomAttributes = "";
			$this->status_remark->HrefValue = "";

			// employee_id
			$this->employee_id->LinkCustomAttributes = "";
			$this->employee_id->HrefValue = "";

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
		if ($this->date->Required) {
			if (!$this->date->IsDetailKey && $this->date->FormValue != NULL && $this->date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->date->caption(), $this->date->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->date->FormValue)) {
			AddMessage($FormError, $this->date->errorMessage());
		}
		if ($this->activities->Required) {
			if (!$this->activities->IsDetailKey && $this->activities->FormValue != NULL && $this->activities->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->activities->caption(), $this->activities->RequiredErrorMessage));
			}
		}
		if ($this->action_taken->Required) {
			if (!$this->action_taken->IsDetailKey && $this->action_taken->FormValue != NULL && $this->action_taken->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->action_taken->caption(), $this->action_taken->RequiredErrorMessage));
			}
		}
		if ($this->total_encoded->Required) {
			if (!$this->total_encoded->IsDetailKey && $this->total_encoded->FormValue != NULL && $this->total_encoded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_encoded->caption(), $this->total_encoded->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->total_encoded->FormValue)) {
			AddMessage($FormError, $this->total_encoded->errorMessage());
		}
		if ($this->status_remark->Required) {
			if (!$this->status_remark->IsDetailKey && $this->status_remark->FormValue != NULL && $this->status_remark->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_remark->caption(), $this->status_remark->RequiredErrorMessage));
			}
		}
		if ($this->employee_id->Required) {
			if (!$this->employee_id->IsDetailKey && $this->employee_id->FormValue != NULL && $this->employee_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->employee_id->caption(), $this->employee_id->RequiredErrorMessage));
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

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() != "" && !EmptyValue($this->employee_id->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->employee_id->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->employee_id->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// date
		$this->date->setDbValueDef($rsnew, UnFormatDateTime($this->date->CurrentValue, 5), NULL, FALSE);

		// activities
		$this->activities->setDbValueDef($rsnew, $this->activities->CurrentValue, NULL, FALSE);

		// action_taken
		$this->action_taken->setDbValueDef($rsnew, $this->action_taken->CurrentValue, NULL, FALSE);

		// total_encoded
		$this->total_encoded->setDbValueDef($rsnew, $this->total_encoded->CurrentValue, NULL, FALSE);

		// status_remark
		$this->status_remark->setDbValueDef($rsnew, $this->status_remark->CurrentValue, NULL, FALSE);

		// employee_id
		$this->employee_id->setDbValueDef($rsnew, $this->employee_id->CurrentValue, NULL, FALSE);

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

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->employee_id->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_encoderlist.php"), "", $this->TableVar, TRUE);
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
				case "x_encoder_month":
					break;
				case "x_encoder_year":
					break;
				case "x_activities":
					break;
				case "x_status_remark":
					break;
				case "x_employee_id":
					break;
				case "x_user_last_modify":
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
						case "x_encoder_month":
							break;
						case "x_encoder_year":
							break;
						case "x_activities":
							break;
						case "x_status_remark":
							break;
						case "x_employee_id":
							break;
						case "x_user_last_modify":
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
	$this->activities->DisplayValueSeparator = "-";
	$this->status_remark->DisplayValueSeparator = "-";
	$this->employee_id->DisplayValueSeparator = "-";

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
} // End class
?>