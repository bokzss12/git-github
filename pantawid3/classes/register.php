<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class register extends employee
{

	// Page ID
	public $PageID = "register";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Page object name
	public $PageObjName = "register";

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

		// Table object (employee)
		if (!isset($GLOBALS["employee"]) || get_class($GLOBALS["employee"]) == PROJECT_NAMESPACE . "employee") {
			$GLOBALS["employee"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["employee"];
		}
		if (!isset($GLOBALS["employee"]))
			$GLOBALS["employee"] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'register');

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
				$row = ["url" => $url];
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
			$key .= @$ar['employeeid'];
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
	public $FormClassName = "ew-horizontal ew-form ew-register-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$UserTable, $CurrentLanguage, $FormError, $Breadcrumb, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action

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

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-register-form ew-horizontal";

		// Set up Breadcrumb
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb = new Breadcrumb();
		$Breadcrumb->add("register", "RegisterPage", $url, "", "", TRUE);
		$this->Heading = $Language->phrase("RegisterPage");
		$userExists = FALSE;
		$this->loadRowValues(); // Load default values

		// Get action
		$action = "";
		if (IsApi())
			$action = "insert";
		elseif (Post("action") != "")
			$action = Post("action");

		// Check action
		if ($action != "") {

			// Get action
			$this->CurrentAction = $action;
			$this->loadFormValues(); // Get form values

			// Validate form
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		} else {
			$this->CurrentAction = "show"; // Display blank record
		}

		// Handle email activation
		if (Get("action") != "") {
			$action = Get("action");
			$userName = Get("user");
			$code = Get("activatetoken");
			@list($emailAddress, $approvalCode, $pwd) = explode(",", $code, 3);
			$emailAddress = Decrypt($emailAddress);
			$approvalCode = Decrypt($approvalCode);
			$pwd = Decrypt($pwd);
			if ($userName == $approvalCode) {
				if (SameText($action, "confirm")) { // Email activation
					if ($this->activateUser($userName)) { // Activate this user
						if ($this->getSuccessMessage() == "")
							$this->setSuccessMessage($Language->phrase("ActivateAccount")); // Set up message acount activated
						if ($Security->validateUser($userName, $pwd, TRUE)) {
							$this->terminate("index.php"); // Go to return page
						} else {
							$this->setFailureMessage($Language->phrase("AutoLoginFailed")); // Set auto login failed message
							$this->terminate("login.php"); // Go to login page
						}
					}
				}
			}
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("ActivateFailed")); // Set activate failed message
			$this->terminate("login.php"); // Go to login page
		}

		// Insert record
		if ($this->isInsert()) {

			// Check for duplicate User ID
			$filter = GetUserFilter(Config("LOGIN_USERNAME_FIELD_NAME"), $this->username->CurrentValue);

			// Set up filter (WHERE Clause)
			$this->CurrentFilter = $filter;
			$userSql = $this->getCurrentSql();
			if ($rs = Conn($UserTable->Dbid)->execute($userSql)) {
				if (!$rs->EOF) {
					$userExists = TRUE;
					$this->restoreFormValues(); // Restore form values
					$this->setFailureMessage($Language->phrase("UserExists")); // Set user exist message
				}
				$rs->Close();
			}
			if (!$userExists) {
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow()) { // Add record
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("RegisterSuccessActivate")); // Activate success
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate("index.php"); // Return
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->restoreFormValues(); // Restore form values
				}
			}
		}

		// Render row
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render view
		} else {
			$this->RowType = ROWTYPE_ADD; // Render add
		}
		$this->resetAttributes();
		$this->renderRow();
	}

	// Activate account based on user
	protected function activateUser($usr)
	{
		global $UserTable, $Language;
		$filter = GetUserFilter(Config("LOGIN_USERNAME_FIELD_NAME"), $usr);
		$sql = $this->getSql($filter);
		$conn = Conn($UserTable->Dbid);
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if (!$rs)
			return FALSE;
		if (!$rs->EOF) {
			$rsnew = $rs->fields;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
			$rsact = [Config("REGISTER_ACTIVATE_FIELD_NAME") => 1]; // Auto register
			$this->CurrentFilter = $filter;
			$res = $this->update($rsact);
			if ($res) { // Call User Activated event
				$rsnew[Config("REGISTER_ACTIVATE_FIELD_NAME")] = 1;
				$this->User_Activated($rsnew);
			}
			return $res;
		} else {
			$this->setFailureMessage($Language->phrase("NoRecord"));
			$rs->close();
			return FALSE;
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->photo->Upload->Index = $CurrentForm->Index;
		$this->photo->Upload->uploadFile();
		$this->photo->CurrentValue = $this->photo->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->employeeid->CurrentValue = NULL;
		$this->employeeid->OldValue = $this->employeeid->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->password->CurrentValue = NULL;
		$this->password->OldValue = $this->password->CurrentValue;
		$this->userlevel_id->CurrentValue = NULL;
		$this->userlevel_id->OldValue = $this->userlevel_id->CurrentValue;
		$this->Name_dsc->CurrentValue = NULL;
		$this->Name_dsc->OldValue = $this->Name_dsc->CurrentValue;
		$this->position->CurrentValue = NULL;
		$this->position->OldValue = $this->position->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->activation->CurrentValue = NULL;
		$this->activation->OldValue = $this->activation->CurrentValue;
		$this->photo->Upload->DbValue = NULL;
		$this->photo->OldValue = $this->photo->Upload->DbValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'employeeid' first before field var 'x_employeeid'
		$val = $CurrentForm->hasValue("employeeid") ? $CurrentForm->getValue("employeeid") : $CurrentForm->getValue("x_employeeid");

		// Check field name 'username' first before field var 'x_username'
		$val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x_username");
		if (!$this->username->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->username->Visible = FALSE; // Disable update for API request
			else
				$this->username->setFormValue($val);
		}

		// Check field name 'password' first before field var 'x_password'
		$val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x_password");
		if (!$this->password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->password->Visible = FALSE; // Disable update for API request
			else
				if (Config("ENCRYPTED_PASSWORD")) // Encrypted password, use raw value
					$this->password->setRawFormValue($val);
				else
					$this->password->setFormValue($val);
		}

		// Note: ConfirmValue will be compared with FormValue
		if (Config("ENCRYPTED_PASSWORD")) // Encrypted password, use raw value
			$this->password->ConfirmValue = $CurrentForm->getValue("c_password");
		else
			$this->password->ConfirmValue = RemoveXss($CurrentForm->getValue("c_password"));

		// Check field name 'userlevel_id' first before field var 'x_userlevel_id'
		$val = $CurrentForm->hasValue("userlevel_id") ? $CurrentForm->getValue("userlevel_id") : $CurrentForm->getValue("x_userlevel_id");
		if (!$this->userlevel_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->userlevel_id->Visible = FALSE; // Disable update for API request
			else
				$this->userlevel_id->setFormValue($val);
		}

		// Check field name 'Name_dsc' first before field var 'x_Name_dsc'
		$val = $CurrentForm->hasValue("Name_dsc") ? $CurrentForm->getValue("Name_dsc") : $CurrentForm->getValue("x_Name_dsc");
		if (!$this->Name_dsc->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name_dsc->Visible = FALSE; // Disable update for API request
			else
				$this->Name_dsc->setFormValue($val);
		}

		// Check field name 'position' first before field var 'x_position'
		$val = $CurrentForm->hasValue("position") ? $CurrentForm->getValue("position") : $CurrentForm->getValue("x_position");
		if (!$this->position->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->position->Visible = FALSE; // Disable update for API request
			else
				$this->position->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->username->CurrentValue = $this->username->FormValue;
		$this->password->CurrentValue = $this->password->FormValue;
		$this->userlevel_id->CurrentValue = $this->userlevel_id->FormValue;
		$this->Name_dsc->CurrentValue = $this->Name_dsc->FormValue;
		$this->position->CurrentValue = $this->position->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
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
		$this->employeeid->setDbValue($row['employeeid']);
		$this->username->setDbValue($row['username']);
		$this->password->setDbValue($row['password']);
		$this->userlevel_id->setDbValue($row['userlevel_id']);
		$this->Name_dsc->setDbValue($row['Name_dsc']);
		$this->position->setDbValue($row['position']);
		$this->_email->setDbValue($row['email']);
		$this->activation->setDbValue($row['activation']);
		$this->photo->Upload->DbValue = $row['photo'];
		$this->photo->setDbValue($this->photo->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['employeeid'] = $this->employeeid->CurrentValue;
		$row['username'] = $this->username->CurrentValue;
		$row['password'] = $this->password->CurrentValue;
		$row['userlevel_id'] = $this->userlevel_id->CurrentValue;
		$row['Name_dsc'] = $this->Name_dsc->CurrentValue;
		$row['position'] = $this->position->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['activation'] = $this->activation->CurrentValue;
		$row['photo'] = $this->photo->Upload->DbValue;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// employeeid
		// username
		// password
		// userlevel_id
		// Name_dsc
		// position
		// email
		// activation
		// photo

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// employeeid
			$this->employeeid->ViewValue = $this->employeeid->CurrentValue;
			$this->employeeid->ViewCustomAttributes = "";

			// username
			$this->username->ViewValue = $this->username->CurrentValue;
			$this->username->CellCssStyle .= "text-align: left;";
			$this->username->ViewCustomAttributes = "";

			// password
			$this->password->ViewValue = $this->password->CurrentValue;
			$this->password->CellCssStyle .= "text-align: left;";
			$this->password->ViewCustomAttributes = "";

			// userlevel_id
			if ($Security->canAdmin()) { // System admin
				$curVal = strval($this->userlevel_id->CurrentValue);
				if ($curVal != "") {
					$this->userlevel_id->ViewValue = $this->userlevel_id->lookupCacheOption($curVal);
					if ($this->userlevel_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->userlevel_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->userlevel_id->ViewValue = $this->userlevel_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->userlevel_id->ViewValue = $this->userlevel_id->CurrentValue;
						}
					}
				} else {
					$this->userlevel_id->ViewValue = NULL;
				}
			} else {
				$this->userlevel_id->ViewValue = $Language->phrase("PasswordMask");
			}
			$this->userlevel_id->CellCssStyle .= "text-align: left;";
			$this->userlevel_id->ViewCustomAttributes = "";

			// Name_dsc
			$this->Name_dsc->ViewValue = $this->Name_dsc->CurrentValue;
			$this->Name_dsc->CellCssStyle .= "text-align: left;";
			$this->Name_dsc->ViewCustomAttributes = "";

			// position
			$this->position->ViewValue = $this->position->CurrentValue;
			$this->position->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->CellCssStyle .= "text-align: left;";
			$this->_email->ViewCustomAttributes = "";

			// activation
			$curVal = strval($this->activation->CurrentValue);
			if ($curVal != "") {
				$this->activation->ViewValue = $this->activation->lookupCacheOption($curVal);
				if ($this->activation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Value`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->activation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->activation->ViewValue = $this->activation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->activation->ViewValue = $this->activation->CurrentValue;
					}
				}
			} else {
				$this->activation->ViewValue = NULL;
			}
			$this->activation->CellCssStyle .= "text-align: left;";
			$this->activation->ViewCustomAttributes = "";

			// photo
			$this->photo->UploadPath = "employeepic/";
			if (!EmptyValue($this->photo->Upload->DbValue)) {
				$this->photo->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
				$this->photo->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
				$this->photo->ImageAlt = $this->photo->alt();
				$this->photo->ViewValue = $this->photo->Upload->DbValue;
			} else {
				$this->photo->ViewValue = "";
			}
			$this->photo->ViewCustomAttributes = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";
			$this->employeeid->TooltipValue = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";
			$this->username->TooltipValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";
			$this->password->TooltipValue = "";

			// userlevel_id
			$this->userlevel_id->LinkCustomAttributes = "";
			$this->userlevel_id->HrefValue = "";
			$this->userlevel_id->TooltipValue = "";

			// Name_dsc
			$this->Name_dsc->LinkCustomAttributes = "";
			$this->Name_dsc->HrefValue = "";
			$this->Name_dsc->TooltipValue = "";

			// position
			$this->position->LinkCustomAttributes = "";
			$this->position->HrefValue = "";
			$this->position->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// photo
			$this->photo->LinkCustomAttributes = "";
			$this->photo->UploadPath = "employeepic/";
			if (!EmptyValue($this->photo->Upload->DbValue)) {
				$this->photo->HrefValue = GetFileUploadUrl($this->photo, $this->photo->htmlDecode($this->photo->Upload->DbValue)); // Add prefix/suffix
				$this->photo->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->photo->HrefValue = FullUrl($this->photo->HrefValue, "href");
			} else {
				$this->photo->HrefValue = "";
			}
			$this->photo->ExportHrefValue = $this->photo->UploadPath . $this->photo->Upload->DbValue;
			$this->photo->TooltipValue = "";
			if ($this->photo->UseColorbox) {
				if (EmptyValue($this->photo->TooltipValue))
					$this->photo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->photo->LinkAttrs["data-rel"] = "employee_x_photo";
				$this->photo->LinkAttrs->appendClass("ew-lightbox");
			}
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// employeeid
			// username

			$this->username->EditAttrs["class"] = "form-control";
			$this->username->EditCustomAttributes = "";
			if (!$this->username->Raw)
				$this->username->CurrentValue = HtmlDecode($this->username->CurrentValue);
			$this->username->EditValue = HtmlEncode($this->username->CurrentValue);
			$this->username->PlaceHolder = RemoveHtml($this->username->caption());

			// password
			$this->password->EditAttrs["class"] = "form-control ew-password-strength";
			$this->password->EditCustomAttributes = "";
			if (!$this->password->Raw)
				$this->password->CurrentValue = HtmlDecode($this->password->CurrentValue);
			$this->password->EditValue = HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = RemoveHtml($this->password->caption());

			// userlevel_id
			$this->userlevel_id->EditAttrs["class"] = "form-control";
			$this->userlevel_id->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->userlevel_id->EditValue = $Language->phrase("PasswordMask");
			} else {
				$curVal = trim(strval($this->userlevel_id->CurrentValue));
				if ($curVal != "")
					$this->userlevel_id->ViewValue = $this->userlevel_id->lookupCacheOption($curVal);
				else
					$this->userlevel_id->ViewValue = $this->userlevel_id->Lookup !== NULL && is_array($this->userlevel_id->Lookup->Options) ? $curVal : NULL;
				if ($this->userlevel_id->ViewValue !== NULL) { // Load from cache
					$this->userlevel_id->EditValue = array_values($this->userlevel_id->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`userlevelid`" . SearchString("=", $this->userlevel_id->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->userlevel_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->userlevel_id->EditValue = $arwrk;
				}
			}

			// Name_dsc
			$this->Name_dsc->EditAttrs["class"] = "form-control";
			$this->Name_dsc->EditCustomAttributes = "";
			if (!$this->Name_dsc->Raw)
				$this->Name_dsc->CurrentValue = HtmlDecode($this->Name_dsc->CurrentValue);
			$this->Name_dsc->EditValue = HtmlEncode($this->Name_dsc->CurrentValue);
			$this->Name_dsc->PlaceHolder = RemoveHtml($this->Name_dsc->caption());

			// position
			$this->position->EditAttrs["class"] = "form-control";
			$this->position->EditCustomAttributes = "";
			if (!$this->position->Raw)
				$this->position->CurrentValue = HtmlDecode($this->position->CurrentValue);
			$this->position->EditValue = HtmlEncode($this->position->CurrentValue);
			$this->position->PlaceHolder = RemoveHtml($this->position->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (!$this->_email->Raw)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// photo
			$this->photo->EditAttrs["class"] = "form-control";
			$this->photo->EditCustomAttributes = "";
			$this->photo->UploadPath = "employeepic/";
			if (!EmptyValue($this->photo->Upload->DbValue)) {
				$this->photo->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
				$this->photo->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
				$this->photo->ImageAlt = $this->photo->alt();
				$this->photo->EditValue = $this->photo->Upload->DbValue;
			} else {
				$this->photo->EditValue = "";
			}
			if (!EmptyValue($this->photo->CurrentValue))
					$this->photo->Upload->FileName = $this->photo->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->photo);

			// Add refer script
			// employeeid

			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";

			// userlevel_id
			$this->userlevel_id->LinkCustomAttributes = "";
			$this->userlevel_id->HrefValue = "";

			// Name_dsc
			$this->Name_dsc->LinkCustomAttributes = "";
			$this->Name_dsc->HrefValue = "";

			// position
			$this->position->LinkCustomAttributes = "";
			$this->position->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// photo
			$this->photo->LinkCustomAttributes = "";
			$this->photo->UploadPath = "employeepic/";
			if (!EmptyValue($this->photo->Upload->DbValue)) {
				$this->photo->HrefValue = GetFileUploadUrl($this->photo, $this->photo->htmlDecode($this->photo->Upload->DbValue)); // Add prefix/suffix
				$this->photo->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->photo->HrefValue = FullUrl($this->photo->HrefValue, "href");
			} else {
				$this->photo->HrefValue = "";
			}
			$this->photo->ExportHrefValue = $this->photo->UploadPath . $this->photo->Upload->DbValue;
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
		if ($this->employeeid->Required) {
			if (!$this->employeeid->IsDetailKey && $this->employeeid->FormValue != NULL && $this->employeeid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->employeeid->caption(), $this->employeeid->RequiredErrorMessage));
			}
		}
		if ($this->username->Required) {
			if (!$this->username->IsDetailKey && $this->username->FormValue != NULL && $this->username->FormValue == "") {
				AddMessage($FormError, $Language->phrase("EnterUserName"));
			}
		}
		if ($this->password->Required) {
			if (!$this->password->IsDetailKey && $this->password->FormValue != NULL && $this->password->FormValue == "") {
				AddMessage($FormError, $Language->phrase("EnterPassword"));
			}
		}
		if ($this->password->ConfirmValue != $this->password->FormValue) {
			AddMessage($FormError, $Language->phrase("MismatchPassword"));
		}
		if ($this->userlevel_id->Required) {
			if (!$this->userlevel_id->IsDetailKey && $this->userlevel_id->FormValue != NULL && $this->userlevel_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->userlevel_id->caption(), $this->userlevel_id->RequiredErrorMessage));
			}
		}
		if ($this->Name_dsc->Required) {
			if (!$this->Name_dsc->IsDetailKey && $this->Name_dsc->FormValue != NULL && $this->Name_dsc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name_dsc->caption(), $this->Name_dsc->RequiredErrorMessage));
			}
		}
		if ($this->position->Required) {
			if (!$this->position->IsDetailKey && $this->position->FormValue != NULL && $this->position->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->position->caption(), $this->position->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}
		if ($this->photo->Required) {
			if ($this->photo->Upload->FileName == "" && !$this->photo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->photo->caption(), $this->photo->RequiredErrorMessage));
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
		if ($Security->currentUserID() != "" && !EmptyValue($this->employeeid->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->employeeid->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->employeeid->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
			$this->photo->OldUploadPath = "employeepic/";
			$this->photo->UploadPath = $this->photo->OldUploadPath;
		}
		$rsnew = [];

		// username
		$this->username->setDbValueDef($rsnew, $this->username->CurrentValue, "", FALSE);

		// password
		$this->password->setDbValueDef($rsnew, $this->password->CurrentValue, "", FALSE);

		// userlevel_id
		$rsnew['userlevel_id'] = 0; // Set default User Level

		// Name_dsc
		$this->Name_dsc->setDbValueDef($rsnew, $this->Name_dsc->CurrentValue, "", FALSE);

		// position
		$this->position->setDbValueDef($rsnew, $this->position->CurrentValue, NULL, FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// photo
		if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
			$this->photo->Upload->DbValue = ""; // No need to delete old file
			if ($this->photo->Upload->FileName == "") {
				$rsnew['photo'] = NULL;
			} else {
				if ($rsold && $rsold->fields['photo'] != "" && $this->photo->Upload->FileName != "") {
					$oldFiles = [$rsold->fields['photo']];
					$newFiles = [$this->photo->Upload->FileName];
					$newFileCount = count($newFiles);
					for ($i = 0; $i < $newFileCount; $i++) {
						if ($newFiles[$i] != "" && in_array($newFiles[$i], $oldFiles)) {
							$tempFile = UniqueFilename($this->photo->physicalUploadPath(), $newFiles[$i]);
							rename(UploadTempPath($this->photo, $this->photo->Upload->Index) . $newFiles[$i], UploadTempPath($this->photo, $this->photo->Upload->Index) . $tempFile);
							$newFiles[$i] = $tempFile;
						}
					}
					$this->photo->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				}
				$rsnew['photo'] = $this->photo->Upload->FileName;
			}
		}
		if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
			$this->photo->UploadPath = "employeepic/";
			$oldFiles = EmptyValue($this->photo->Upload->DbValue) ? [] : [$this->photo->htmlDecode($this->photo->Upload->DbValue)];
			if (!EmptyValue($this->photo->Upload->FileName)) {
				$newFiles = [$this->photo->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->photo, $this->photo->Upload->Index);
						if (file_exists($tempPath . $file)) {
							if (Config("DELETE_UPLOADED_FILES")) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										array_splice($oldFiles, $j, 1);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->photo->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->photo->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->photo->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->photo->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->photo->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->photo->setDbValueDef($rsnew, $this->photo->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
				if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->photo->Upload->DbValue) ? [] : [$this->photo->htmlDecode($this->photo->Upload->DbValue)];
					if (!EmptyValue($this->photo->Upload->FileName)) {
						$newFiles = [$this->photo->Upload->FileName];
						$newFiles2 = [$this->photo->htmlDecode($rsnew['photo'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->photo, $this->photo->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->photo->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = [];
					}
					if (Config("DELETE_UPLOADED_FILES")) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile != "" && !in_array($oldFile, $newFiles))
								@unlink($this->photo->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
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

			// Call User Registered event
			$this->User_Registered($rsnew);
		}

		// Clean upload path if any
		if ($addRow) {

			// photo
			CleanUploadTempPath($this->photo, $this->photo->Upload->Index);
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
				case "x_userlevel_id":
					break;
				case "x_activation":
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
						case "x_userlevel_id":
							break;
						case "x_activation":
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

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

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// User Registered event
	function User_Registered(&$rs) {

		//echo "User_Registered";
	}

	// User Activated event
	function User_Activated(&$rs) {

		//echo "User_Activated";
	}
} // End class
?>