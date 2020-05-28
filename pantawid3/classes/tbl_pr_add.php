<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_pr_add extends tbl_pr
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_pr';

	// Page object name
	public $PageObjName = "tbl_pr_add";

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

		// Table object (tbl_pr)
		if (!isset($GLOBALS["tbl_pr"]) || get_class($GLOBALS["tbl_pr"]) == PROJECT_NAMESPACE . "tbl_pr") {
			$GLOBALS["tbl_pr"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_pr"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_pr');

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

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $tbl_pr;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($tbl_pr);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "tbl_prview.php")
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
			$key .= @$ar['prID'];
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
			$this->prID->Visible = FALSE;
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
					$this->terminate(GetUrl("tbl_prlist.php"));
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
		$this->prID->Visible = FALSE;
		$this->date_prep->setVisibility();
		$this->pr_number->setVisibility();
		$this->purpose->setVisibility();
		$this->pr_status->setVisibility();
		$this->sup_id->setVisibility();
		$this->date_delivered->setVisibility();
		$this->employeeid->setVisibility();
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
		$this->setupLookupOptions($this->pr_status);
		$this->setupLookupOptions($this->sup_id);
		$this->setupLookupOptions($this->employeeid);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("tbl_prlist.php");
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
			if (Get("prID") !== NULL) {
				$this->prID->setQueryStringValue(Get("prID"));
				$this->setKey("prID", $this->prID->CurrentValue); // Set up key
			} else {
				$this->setKey("prID", ""); // Clear key
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("tbl_prlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetViewUrl();
					if (GetPageName($returnUrl) == "tbl_prlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_prview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->prID->CurrentValue = NULL;
		$this->prID->OldValue = $this->prID->CurrentValue;
		$this->date_prep->CurrentValue = date("m/d/Y");
		$this->pr_number->CurrentValue = NULL;
		$this->pr_number->OldValue = $this->pr_number->CurrentValue;
		$this->purpose->CurrentValue = NULL;
		$this->purpose->OldValue = $this->purpose->CurrentValue;
		$this->pr_status->CurrentValue = "1";
		$this->sup_id->CurrentValue = NULL;
		$this->sup_id->OldValue = $this->sup_id->CurrentValue;
		$this->date_delivered->CurrentValue = NULL;
		$this->date_delivered->OldValue = $this->date_delivered->CurrentValue;
		$this->employeeid->CurrentValue = NULL;
		$this->employeeid->OldValue = $this->employeeid->CurrentValue;
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

		// Check field name 'date_prep' first before field var 'x_date_prep'
		$val = $CurrentForm->hasValue("date_prep") ? $CurrentForm->getValue("date_prep") : $CurrentForm->getValue("x_date_prep");
		if (!$this->date_prep->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->date_prep->Visible = FALSE; // Disable update for API request
			else
				$this->date_prep->setFormValue($val);
			$this->date_prep->CurrentValue = UnFormatDateTime($this->date_prep->CurrentValue, 0);
		}

		// Check field name 'pr_number' first before field var 'x_pr_number'
		$val = $CurrentForm->hasValue("pr_number") ? $CurrentForm->getValue("pr_number") : $CurrentForm->getValue("x_pr_number");
		if (!$this->pr_number->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pr_number->Visible = FALSE; // Disable update for API request
			else
				$this->pr_number->setFormValue($val);
		}

		// Check field name 'purpose' first before field var 'x_purpose'
		$val = $CurrentForm->hasValue("purpose") ? $CurrentForm->getValue("purpose") : $CurrentForm->getValue("x_purpose");
		if (!$this->purpose->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->purpose->Visible = FALSE; // Disable update for API request
			else
				$this->purpose->setFormValue($val);
		}

		// Check field name 'pr_status' first before field var 'x_pr_status'
		$val = $CurrentForm->hasValue("pr_status") ? $CurrentForm->getValue("pr_status") : $CurrentForm->getValue("x_pr_status");
		if (!$this->pr_status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pr_status->Visible = FALSE; // Disable update for API request
			else
				$this->pr_status->setFormValue($val);
		}

		// Check field name 'sup_id' first before field var 'x_sup_id'
		$val = $CurrentForm->hasValue("sup_id") ? $CurrentForm->getValue("sup_id") : $CurrentForm->getValue("x_sup_id");
		if (!$this->sup_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sup_id->Visible = FALSE; // Disable update for API request
			else
				$this->sup_id->setFormValue($val);
		}

		// Check field name 'date_delivered' first before field var 'x_date_delivered'
		$val = $CurrentForm->hasValue("date_delivered") ? $CurrentForm->getValue("date_delivered") : $CurrentForm->getValue("x_date_delivered");
		if (!$this->date_delivered->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->date_delivered->Visible = FALSE; // Disable update for API request
			else
				$this->date_delivered->setFormValue($val);
			$this->date_delivered->CurrentValue = UnFormatDateTime($this->date_delivered->CurrentValue, 0);
		}

		// Check field name 'employeeid' first before field var 'x_employeeid'
		$val = $CurrentForm->hasValue("employeeid") ? $CurrentForm->getValue("employeeid") : $CurrentForm->getValue("x_employeeid");
		if (!$this->employeeid->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->employeeid->Visible = FALSE; // Disable update for API request
			else
				$this->employeeid->setFormValue($val);
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

		// Check field name 'prID' first before field var 'x_prID'
		$val = $CurrentForm->hasValue("prID") ? $CurrentForm->getValue("prID") : $CurrentForm->getValue("x_prID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->date_prep->CurrentValue = $this->date_prep->FormValue;
		$this->date_prep->CurrentValue = UnFormatDateTime($this->date_prep->CurrentValue, 0);
		$this->pr_number->CurrentValue = $this->pr_number->FormValue;
		$this->purpose->CurrentValue = $this->purpose->FormValue;
		$this->pr_status->CurrentValue = $this->pr_status->FormValue;
		$this->sup_id->CurrentValue = $this->sup_id->FormValue;
		$this->date_delivered->CurrentValue = $this->date_delivered->FormValue;
		$this->date_delivered->CurrentValue = UnFormatDateTime($this->date_delivered->CurrentValue, 0);
		$this->employeeid->CurrentValue = $this->employeeid->FormValue;
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
		$this->prID->setDbValue($row['prID']);
		$this->date_prep->setDbValue($row['date_prep']);
		$this->pr_number->setDbValue($row['pr_number']);
		$this->purpose->setDbValue($row['purpose']);
		$this->pr_status->setDbValue($row['pr_status']);
		$this->sup_id->setDbValue($row['sup_id']);
		$this->date_delivered->setDbValue($row['date_delivered']);
		$this->employeeid->setDbValue($row['employeeid']);
		$this->user_last_modify->setDbValue($row['user_last_modify']);
		$this->date_last_modify->setDbValue($row['date_last_modify']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['prID'] = $this->prID->CurrentValue;
		$row['date_prep'] = $this->date_prep->CurrentValue;
		$row['pr_number'] = $this->pr_number->CurrentValue;
		$row['purpose'] = $this->purpose->CurrentValue;
		$row['pr_status'] = $this->pr_status->CurrentValue;
		$row['sup_id'] = $this->sup_id->CurrentValue;
		$row['date_delivered'] = $this->date_delivered->CurrentValue;
		$row['employeeid'] = $this->employeeid->CurrentValue;
		$row['user_last_modify'] = $this->user_last_modify->CurrentValue;
		$row['date_last_modify'] = $this->date_last_modify->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("prID")) != "")
			$this->prID->OldValue = $this->getKey("prID"); // prID
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
		// prID
		// date_prep
		// pr_number
		// purpose
		// pr_status
		// sup_id
		// date_delivered
		// employeeid
		// user_last_modify
		// date_last_modify

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// prID
			$this->prID->ViewValue = $this->prID->CurrentValue;
			$this->prID->ViewCustomAttributes = "";

			// date_prep
			$this->date_prep->ViewValue = $this->date_prep->CurrentValue;
			$this->date_prep->ViewValue = FormatDateTime($this->date_prep->ViewValue, 0);
			$this->date_prep->ViewCustomAttributes = "";

			// pr_number
			$this->pr_number->ViewValue = $this->pr_number->CurrentValue;
			$this->pr_number->ViewCustomAttributes = "";

			// purpose
			$this->purpose->ViewValue = $this->purpose->CurrentValue;
			if ($this->purpose->ViewValue != NULL)
				$this->purpose->ViewValue = str_replace("\n", "<br>", $this->purpose->ViewValue);
			$this->purpose->ViewCustomAttributes = "";

			// pr_status
			$curVal = strval($this->pr_status->CurrentValue);
			if ($curVal != "") {
				$this->pr_status->ViewValue = $this->pr_status->lookupCacheOption($curVal);
				if ($this->pr_status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`pr_statusID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->pr_status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->pr_status->ViewValue = $this->pr_status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->pr_status->ViewValue = $this->pr_status->CurrentValue;
					}
				}
			} else {
				$this->pr_status->ViewValue = NULL;
			}
			$this->pr_status->ViewCustomAttributes = "";

			// sup_id
			$curVal = strval($this->sup_id->CurrentValue);
			if ($curVal != "") {
				$this->sup_id->ViewValue = $this->sup_id->lookupCacheOption($curVal);
				if ($this->sup_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`supplierID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sup_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->sup_id->ViewValue = $this->sup_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sup_id->ViewValue = $this->sup_id->CurrentValue;
					}
				}
			} else {
				$this->sup_id->ViewValue = NULL;
			}
			$this->sup_id->ViewCustomAttributes = "";

			// date_delivered
			$this->date_delivered->ViewValue = $this->date_delivered->CurrentValue;
			$this->date_delivered->ViewValue = FormatDateTime($this->date_delivered->ViewValue, 0);
			$this->date_delivered->ViewCustomAttributes = "";

			// employeeid
			$curVal = strval($this->employeeid->CurrentValue);
			if ($curVal != "") {
				$this->employeeid->ViewValue = $this->employeeid->lookupCacheOption($curVal);
				if ($this->employeeid->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`employeeid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->employeeid->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->employeeid->ViewValue = $this->employeeid->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->employeeid->ViewValue = $this->employeeid->CurrentValue;
					}
				}
			} else {
				$this->employeeid->ViewValue = NULL;
			}
			$this->employeeid->ViewCustomAttributes = "";

			// user_last_modify
			$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
			$this->user_last_modify->ViewCustomAttributes = "";

			// date_last_modify
			$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
			$this->date_last_modify->ViewCustomAttributes = "";

			// date_prep
			$this->date_prep->LinkCustomAttributes = "";
			$this->date_prep->HrefValue = "";
			$this->date_prep->TooltipValue = "";

			// pr_number
			$this->pr_number->LinkCustomAttributes = "";
			$this->pr_number->HrefValue = "";
			$this->pr_number->TooltipValue = "";

			// purpose
			$this->purpose->LinkCustomAttributes = "";
			$this->purpose->HrefValue = "";
			$this->purpose->TooltipValue = "";

			// pr_status
			$this->pr_status->LinkCustomAttributes = "";
			$this->pr_status->HrefValue = "";
			$this->pr_status->TooltipValue = "";

			// sup_id
			$this->sup_id->LinkCustomAttributes = "";
			$this->sup_id->HrefValue = "";
			$this->sup_id->TooltipValue = "";

			// date_delivered
			$this->date_delivered->LinkCustomAttributes = "";
			$this->date_delivered->HrefValue = "";
			$this->date_delivered->TooltipValue = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";
			$this->employeeid->TooltipValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// date_prep
			$this->date_prep->EditAttrs["class"] = "form-control";
			$this->date_prep->EditCustomAttributes = "";
			$this->date_prep->EditValue = HtmlEncode(FormatDateTime($this->date_prep->CurrentValue, 8));
			$this->date_prep->PlaceHolder = RemoveHtml($this->date_prep->caption());

			// pr_number
			$this->pr_number->EditAttrs["class"] = "form-control";
			$this->pr_number->EditCustomAttributes = "";
			if (!$this->pr_number->Raw)
				$this->pr_number->CurrentValue = HtmlDecode($this->pr_number->CurrentValue);
			$this->pr_number->EditValue = HtmlEncode($this->pr_number->CurrentValue);
			$this->pr_number->PlaceHolder = RemoveHtml($this->pr_number->caption());

			// purpose
			$this->purpose->EditAttrs["class"] = "form-control";
			$this->purpose->EditCustomAttributes = "";
			$this->purpose->EditValue = HtmlEncode($this->purpose->CurrentValue);
			$this->purpose->PlaceHolder = RemoveHtml($this->purpose->caption());

			// pr_status
			$this->pr_status->EditAttrs["class"] = "form-control";
			$this->pr_status->EditCustomAttributes = "";
			$curVal = trim(strval($this->pr_status->CurrentValue));
			if ($curVal != "")
				$this->pr_status->ViewValue = $this->pr_status->lookupCacheOption($curVal);
			else
				$this->pr_status->ViewValue = $this->pr_status->Lookup !== NULL && is_array($this->pr_status->Lookup->Options) ? $curVal : NULL;
			if ($this->pr_status->ViewValue !== NULL) { // Load from cache
				$this->pr_status->EditValue = array_values($this->pr_status->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`pr_statusID`" . SearchString("=", $this->pr_status->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->pr_status->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pr_status->EditValue = $arwrk;
			}

			// sup_id
			$this->sup_id->EditAttrs["class"] = "form-control";
			$this->sup_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->sup_id->CurrentValue));
			if ($curVal != "")
				$this->sup_id->ViewValue = $this->sup_id->lookupCacheOption($curVal);
			else
				$this->sup_id->ViewValue = $this->sup_id->Lookup !== NULL && is_array($this->sup_id->Lookup->Options) ? $curVal : NULL;
			if ($this->sup_id->ViewValue !== NULL) { // Load from cache
				$this->sup_id->EditValue = array_values($this->sup_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`supplierID`" . SearchString("=", $this->sup_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->sup_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->sup_id->EditValue = $arwrk;
			}

			// date_delivered
			$this->date_delivered->EditAttrs["class"] = "form-control";
			$this->date_delivered->EditCustomAttributes = "";
			$this->date_delivered->EditValue = HtmlEncode(FormatDateTime($this->date_delivered->CurrentValue, 8));
			$this->date_delivered->PlaceHolder = RemoveHtml($this->date_delivered->caption());

			// employeeid
			$this->employeeid->EditAttrs["class"] = "form-control";
			$this->employeeid->EditCustomAttributes = "";
			$curVal = trim(strval($this->employeeid->CurrentValue));
			if ($curVal != "")
				$this->employeeid->ViewValue = $this->employeeid->lookupCacheOption($curVal);
			else
				$this->employeeid->ViewValue = $this->employeeid->Lookup !== NULL && is_array($this->employeeid->Lookup->Options) ? $curVal : NULL;
			if ($this->employeeid->ViewValue !== NULL) { // Load from cache
				$this->employeeid->EditValue = array_values($this->employeeid->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`employeeid`" . SearchString("=", $this->employeeid->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->employeeid->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->employeeid->EditValue = $arwrk;
			}

			// user_last_modify
			// date_last_modify
			// Add refer script
			// date_prep

			$this->date_prep->LinkCustomAttributes = "";
			$this->date_prep->HrefValue = "";

			// pr_number
			$this->pr_number->LinkCustomAttributes = "";
			$this->pr_number->HrefValue = "";

			// purpose
			$this->purpose->LinkCustomAttributes = "";
			$this->purpose->HrefValue = "";

			// pr_status
			$this->pr_status->LinkCustomAttributes = "";
			$this->pr_status->HrefValue = "";

			// sup_id
			$this->sup_id->LinkCustomAttributes = "";
			$this->sup_id->HrefValue = "";

			// date_delivered
			$this->date_delivered->LinkCustomAttributes = "";
			$this->date_delivered->HrefValue = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";

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
		if ($this->date_prep->Required) {
			if (!$this->date_prep->IsDetailKey && $this->date_prep->FormValue != NULL && $this->date_prep->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->date_prep->caption(), $this->date_prep->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->date_prep->FormValue)) {
			AddMessage($FormError, $this->date_prep->errorMessage());
		}
		if ($this->pr_number->Required) {
			if (!$this->pr_number->IsDetailKey && $this->pr_number->FormValue != NULL && $this->pr_number->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pr_number->caption(), $this->pr_number->RequiredErrorMessage));
			}
		}
		if ($this->purpose->Required) {
			if (!$this->purpose->IsDetailKey && $this->purpose->FormValue != NULL && $this->purpose->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->purpose->caption(), $this->purpose->RequiredErrorMessage));
			}
		}
		if ($this->pr_status->Required) {
			if (!$this->pr_status->IsDetailKey && $this->pr_status->FormValue != NULL && $this->pr_status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pr_status->caption(), $this->pr_status->RequiredErrorMessage));
			}
		}
		if ($this->sup_id->Required) {
			if (!$this->sup_id->IsDetailKey && $this->sup_id->FormValue != NULL && $this->sup_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sup_id->caption(), $this->sup_id->RequiredErrorMessage));
			}
		}
		if ($this->date_delivered->Required) {
			if (!$this->date_delivered->IsDetailKey && $this->date_delivered->FormValue != NULL && $this->date_delivered->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->date_delivered->caption(), $this->date_delivered->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->date_delivered->FormValue)) {
			AddMessage($FormError, $this->date_delivered->errorMessage());
		}
		if ($this->employeeid->Required) {
			if (!$this->employeeid->IsDetailKey && $this->employeeid->FormValue != NULL && $this->employeeid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->employeeid->caption(), $this->employeeid->RequiredErrorMessage));
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tbl_spec", $detailTblVar) && $GLOBALS["tbl_spec"]->DetailAdd) {
			if (!isset($GLOBALS["tbl_spec_grid"]))
				$GLOBALS["tbl_spec_grid"] = new tbl_spec_grid(); // Get detail page object
			$GLOBALS["tbl_spec_grid"]->validateGridForm();
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
		if ($this->pr_number->CurrentValue != "") { // Check field with unique index
			$filter = "(`pr_number` = '" . AdjustSql($this->pr_number->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->pr_number->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->pr_number->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// date_prep
		$this->date_prep->setDbValueDef($rsnew, UnFormatDateTime($this->date_prep->CurrentValue, 0), NULL, FALSE);

		// pr_number
		$this->pr_number->setDbValueDef($rsnew, $this->pr_number->CurrentValue, NULL, FALSE);

		// purpose
		$this->purpose->setDbValueDef($rsnew, $this->purpose->CurrentValue, NULL, FALSE);

		// pr_status
		$this->pr_status->setDbValueDef($rsnew, $this->pr_status->CurrentValue, NULL, FALSE);

		// sup_id
		$this->sup_id->setDbValueDef($rsnew, $this->sup_id->CurrentValue, NULL, FALSE);

		// date_delivered
		$this->date_delivered->setDbValueDef($rsnew, UnFormatDateTime($this->date_delivered->CurrentValue, 0), NULL, FALSE);

		// employeeid
		$this->employeeid->setDbValueDef($rsnew, $this->employeeid->CurrentValue, NULL, FALSE);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("tbl_spec", $detailTblVar) && $GLOBALS["tbl_spec"]->DetailAdd) {
				$GLOBALS["tbl_spec"]->pr_number->setSessionValue($this->pr_number->CurrentValue); // Set master key
				if (!isset($GLOBALS["tbl_spec_grid"]))
					$GLOBALS["tbl_spec_grid"] = new tbl_spec_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "tbl_spec"); // Load user level of detail table
				$addRow = $GLOBALS["tbl_spec_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["tbl_spec"]->pr_number->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
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

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("tbl_spec", $detailTblVar)) {
				if (!isset($GLOBALS["tbl_spec_grid"]))
					$GLOBALS["tbl_spec_grid"] = new tbl_spec_grid();
				if ($GLOBALS["tbl_spec_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["tbl_spec_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["tbl_spec_grid"]->CurrentMode = "add";
					$GLOBALS["tbl_spec_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["tbl_spec_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tbl_spec_grid"]->setStartRecordNumber(1);
					$GLOBALS["tbl_spec_grid"]->pr_number->IsDetailKey = TRUE;
					$GLOBALS["tbl_spec_grid"]->pr_number->CurrentValue = $this->pr_number->CurrentValue;
					$GLOBALS["tbl_spec_grid"]->pr_number->setSessionValue($GLOBALS["tbl_spec_grid"]->pr_number->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_prlist.php"), "", $this->TableVar, TRUE);
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
				case "x_pr_status":
					break;
				case "x_sup_id":
					break;
				case "x_employeeid":
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
						case "x_pr_status":
							break;
						case "x_sup_id":
							break;
						case "x_employeeid":
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
		//$this->totalprice->ReadOnly = TRUE;

	$this->pr_status->DisplayValueSeparator = "-";
	$this->employeeid->DisplayValueSeparator = "-";
	$this->sup_id->ReadOnly = TRUE;
	$this->date_delivered->ReadOnly = TRUE;
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