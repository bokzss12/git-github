<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class lib_cities_edit extends lib_cities
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'lib_cities';

	// Page object name
	public $PageObjName = "lib_cities_edit";

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

		// Table object (lib_cities)
		if (!isset($GLOBALS["lib_cities"]) || get_class($GLOBALS["lib_cities"]) == PROJECT_NAMESPACE . "lib_cities") {
			$GLOBALS["lib_cities"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["lib_cities"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'lib_cities');

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
		global $lib_cities;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($lib_cities);
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
					if ($pageName == "lib_citiesview.php")
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
			$key .= @$ar['city_code'];
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
			$this->city_code->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("lib_citieslist.php"));
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
		$this->city_code->setVisibility();
		$this->city_name->setVisibility();
		$this->is_Urban->setVisibility();
		$this->locked->setVisibility();
		$this->app_target_hh->setVisibility();
		$this->_4p_areas->setVisibility();
		$this->psgc_cty->setVisibility();
		$this->prov_code->setVisibility();
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
		// Check permission

		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("lib_citieslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("city_code") !== NULL) {
				$this->city_code->setQueryStringValue(Get("city_code"));
				$this->city_code->setOldValue($this->city_code->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->city_code->setQueryStringValue(Key(0));
				$this->city_code->setOldValue($this->city_code->QueryStringValue);
			} elseif (Post("city_code") !== NULL) {
				$this->city_code->setFormValue(Post("city_code"));
				$this->city_code->setOldValue($this->city_code->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->city_code->setQueryStringValue(Route(2));
				$this->city_code->setOldValue($this->city_code->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_city_code")) {
					$this->city_code->setFormValue($CurrentForm->getValue("x_city_code"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("city_code") !== NULL) {
					$this->city_code->setQueryStringValue(Get("city_code"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->city_code->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->city_code->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("lib_citieslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "lib_citieslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'city_code' first before field var 'x_city_code'
		$val = $CurrentForm->hasValue("city_code") ? $CurrentForm->getValue("city_code") : $CurrentForm->getValue("x_city_code");
		if (!$this->city_code->IsDetailKey)
			$this->city_code->setFormValue($val);

		// Check field name 'city_name' first before field var 'x_city_name'
		$val = $CurrentForm->hasValue("city_name") ? $CurrentForm->getValue("city_name") : $CurrentForm->getValue("x_city_name");
		if (!$this->city_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->city_name->Visible = FALSE; // Disable update for API request
			else
				$this->city_name->setFormValue($val);
		}

		// Check field name 'is_Urban' first before field var 'x_is_Urban'
		$val = $CurrentForm->hasValue("is_Urban") ? $CurrentForm->getValue("is_Urban") : $CurrentForm->getValue("x_is_Urban");
		if (!$this->is_Urban->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->is_Urban->Visible = FALSE; // Disable update for API request
			else
				$this->is_Urban->setFormValue($val);
		}

		// Check field name 'locked' first before field var 'x_locked'
		$val = $CurrentForm->hasValue("locked") ? $CurrentForm->getValue("locked") : $CurrentForm->getValue("x_locked");
		if (!$this->locked->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->locked->Visible = FALSE; // Disable update for API request
			else
				$this->locked->setFormValue($val);
		}

		// Check field name 'app_target_hh' first before field var 'x_app_target_hh'
		$val = $CurrentForm->hasValue("app_target_hh") ? $CurrentForm->getValue("app_target_hh") : $CurrentForm->getValue("x_app_target_hh");
		if (!$this->app_target_hh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->app_target_hh->Visible = FALSE; // Disable update for API request
			else
				$this->app_target_hh->setFormValue($val);
		}

		// Check field name '4p_areas' first before field var 'x__4p_areas'
		$val = $CurrentForm->hasValue("4p_areas") ? $CurrentForm->getValue("4p_areas") : $CurrentForm->getValue("x__4p_areas");
		if (!$this->_4p_areas->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_4p_areas->Visible = FALSE; // Disable update for API request
			else
				$this->_4p_areas->setFormValue($val);
		}

		// Check field name 'psgc_cty' first before field var 'x_psgc_cty'
		$val = $CurrentForm->hasValue("psgc_cty") ? $CurrentForm->getValue("psgc_cty") : $CurrentForm->getValue("x_psgc_cty");
		if (!$this->psgc_cty->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->psgc_cty->Visible = FALSE; // Disable update for API request
			else
				$this->psgc_cty->setFormValue($val);
		}

		// Check field name 'prov_code' first before field var 'x_prov_code'
		$val = $CurrentForm->hasValue("prov_code") ? $CurrentForm->getValue("prov_code") : $CurrentForm->getValue("x_prov_code");
		if (!$this->prov_code->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->prov_code->Visible = FALSE; // Disable update for API request
			else
				$this->prov_code->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->city_code->CurrentValue = $this->city_code->FormValue;
		$this->city_name->CurrentValue = $this->city_name->FormValue;
		$this->is_Urban->CurrentValue = $this->is_Urban->FormValue;
		$this->locked->CurrentValue = $this->locked->FormValue;
		$this->app_target_hh->CurrentValue = $this->app_target_hh->FormValue;
		$this->_4p_areas->CurrentValue = $this->_4p_areas->FormValue;
		$this->psgc_cty->CurrentValue = $this->psgc_cty->FormValue;
		$this->prov_code->CurrentValue = $this->prov_code->FormValue;
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
		$this->city_code->setDbValue($row['city_code']);
		$this->city_name->setDbValue($row['city_name']);
		$this->is_Urban->setDbValue($row['is_Urban']);
		$this->locked->setDbValue($row['locked']);
		$this->app_target_hh->setDbValue($row['app_target_hh']);
		$this->_4p_areas->setDbValue($row['4p_areas']);
		$this->psgc_cty->setDbValue($row['psgc_cty']);
		$this->prov_code->setDbValue($row['prov_code']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['city_code'] = NULL;
		$row['city_name'] = NULL;
		$row['is_Urban'] = NULL;
		$row['locked'] = NULL;
		$row['app_target_hh'] = NULL;
		$row['4p_areas'] = NULL;
		$row['psgc_cty'] = NULL;
		$row['prov_code'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("city_code")) != "")
			$this->city_code->OldValue = $this->getKey("city_code"); // city_code
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
		// city_code
		// city_name
		// is_Urban
		// locked
		// app_target_hh
		// 4p_areas
		// psgc_cty
		// prov_code

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// city_code
			$this->city_code->ViewValue = $this->city_code->CurrentValue;
			$this->city_code->ViewCustomAttributes = "";

			// city_name
			$this->city_name->ViewValue = $this->city_name->CurrentValue;
			$this->city_name->ViewCustomAttributes = "";

			// is_Urban
			$this->is_Urban->ViewValue = $this->is_Urban->CurrentValue;
			$this->is_Urban->ViewCustomAttributes = "";

			// locked
			$this->locked->ViewValue = $this->locked->CurrentValue;
			$this->locked->ViewCustomAttributes = "";

			// app_target_hh
			$this->app_target_hh->ViewValue = $this->app_target_hh->CurrentValue;
			$this->app_target_hh->ViewCustomAttributes = "";

			// 4p_areas
			$this->_4p_areas->ViewValue = $this->_4p_areas->CurrentValue;
			$this->_4p_areas->ViewCustomAttributes = "";

			// psgc_cty
			$this->psgc_cty->ViewValue = $this->psgc_cty->CurrentValue;
			$this->psgc_cty->ViewCustomAttributes = "";

			// prov_code
			$this->prov_code->ViewValue = $this->prov_code->CurrentValue;
			$this->prov_code->ViewCustomAttributes = "";

			// city_code
			$this->city_code->LinkCustomAttributes = "";
			$this->city_code->HrefValue = "";
			$this->city_code->TooltipValue = "";

			// city_name
			$this->city_name->LinkCustomAttributes = "";
			$this->city_name->HrefValue = "";
			$this->city_name->TooltipValue = "";

			// is_Urban
			$this->is_Urban->LinkCustomAttributes = "";
			$this->is_Urban->HrefValue = "";
			$this->is_Urban->TooltipValue = "";

			// locked
			$this->locked->LinkCustomAttributes = "";
			$this->locked->HrefValue = "";
			$this->locked->TooltipValue = "";

			// app_target_hh
			$this->app_target_hh->LinkCustomAttributes = "";
			$this->app_target_hh->HrefValue = "";
			$this->app_target_hh->TooltipValue = "";

			// 4p_areas
			$this->_4p_areas->LinkCustomAttributes = "";
			$this->_4p_areas->HrefValue = "";
			$this->_4p_areas->TooltipValue = "";

			// psgc_cty
			$this->psgc_cty->LinkCustomAttributes = "";
			$this->psgc_cty->HrefValue = "";
			$this->psgc_cty->TooltipValue = "";

			// prov_code
			$this->prov_code->LinkCustomAttributes = "";
			$this->prov_code->HrefValue = "";
			$this->prov_code->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// city_code
			$this->city_code->EditAttrs["class"] = "form-control";
			$this->city_code->EditCustomAttributes = "";
			$this->city_code->EditValue = $this->city_code->CurrentValue;
			$this->city_code->ViewCustomAttributes = "";

			// city_name
			$this->city_name->EditAttrs["class"] = "form-control";
			$this->city_name->EditCustomAttributes = "";
			if (!$this->city_name->Raw)
				$this->city_name->CurrentValue = HtmlDecode($this->city_name->CurrentValue);
			$this->city_name->EditValue = HtmlEncode($this->city_name->CurrentValue);
			$this->city_name->PlaceHolder = RemoveHtml($this->city_name->caption());

			// is_Urban
			$this->is_Urban->EditAttrs["class"] = "form-control";
			$this->is_Urban->EditCustomAttributes = "";
			$this->is_Urban->EditValue = HtmlEncode($this->is_Urban->CurrentValue);
			$this->is_Urban->PlaceHolder = RemoveHtml($this->is_Urban->caption());

			// locked
			$this->locked->EditAttrs["class"] = "form-control";
			$this->locked->EditCustomAttributes = "";
			$this->locked->EditValue = HtmlEncode($this->locked->CurrentValue);
			$this->locked->PlaceHolder = RemoveHtml($this->locked->caption());

			// app_target_hh
			$this->app_target_hh->EditAttrs["class"] = "form-control";
			$this->app_target_hh->EditCustomAttributes = "";
			$this->app_target_hh->EditValue = HtmlEncode($this->app_target_hh->CurrentValue);
			$this->app_target_hh->PlaceHolder = RemoveHtml($this->app_target_hh->caption());

			// 4p_areas
			$this->_4p_areas->EditAttrs["class"] = "form-control";
			$this->_4p_areas->EditCustomAttributes = "";
			$this->_4p_areas->EditValue = HtmlEncode($this->_4p_areas->CurrentValue);
			$this->_4p_areas->PlaceHolder = RemoveHtml($this->_4p_areas->caption());

			// psgc_cty
			$this->psgc_cty->EditAttrs["class"] = "form-control";
			$this->psgc_cty->EditCustomAttributes = "";
			if (!$this->psgc_cty->Raw)
				$this->psgc_cty->CurrentValue = HtmlDecode($this->psgc_cty->CurrentValue);
			$this->psgc_cty->EditValue = HtmlEncode($this->psgc_cty->CurrentValue);
			$this->psgc_cty->PlaceHolder = RemoveHtml($this->psgc_cty->caption());

			// prov_code
			$this->prov_code->EditAttrs["class"] = "form-control";
			$this->prov_code->EditCustomAttributes = "";
			$this->prov_code->EditValue = HtmlEncode($this->prov_code->CurrentValue);
			$this->prov_code->PlaceHolder = RemoveHtml($this->prov_code->caption());

			// Edit refer script
			// city_code

			$this->city_code->LinkCustomAttributes = "";
			$this->city_code->HrefValue = "";

			// city_name
			$this->city_name->LinkCustomAttributes = "";
			$this->city_name->HrefValue = "";

			// is_Urban
			$this->is_Urban->LinkCustomAttributes = "";
			$this->is_Urban->HrefValue = "";

			// locked
			$this->locked->LinkCustomAttributes = "";
			$this->locked->HrefValue = "";

			// app_target_hh
			$this->app_target_hh->LinkCustomAttributes = "";
			$this->app_target_hh->HrefValue = "";

			// 4p_areas
			$this->_4p_areas->LinkCustomAttributes = "";
			$this->_4p_areas->HrefValue = "";

			// psgc_cty
			$this->psgc_cty->LinkCustomAttributes = "";
			$this->psgc_cty->HrefValue = "";

			// prov_code
			$this->prov_code->LinkCustomAttributes = "";
			$this->prov_code->HrefValue = "";
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
		if ($this->city_code->Required) {
			if (!$this->city_code->IsDetailKey && $this->city_code->FormValue != NULL && $this->city_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->city_code->caption(), $this->city_code->RequiredErrorMessage));
			}
		}
		if ($this->city_name->Required) {
			if (!$this->city_name->IsDetailKey && $this->city_name->FormValue != NULL && $this->city_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->city_name->caption(), $this->city_name->RequiredErrorMessage));
			}
		}
		if ($this->is_Urban->Required) {
			if (!$this->is_Urban->IsDetailKey && $this->is_Urban->FormValue != NULL && $this->is_Urban->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->is_Urban->caption(), $this->is_Urban->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->is_Urban->FormValue)) {
			AddMessage($FormError, $this->is_Urban->errorMessage());
		}
		if ($this->locked->Required) {
			if (!$this->locked->IsDetailKey && $this->locked->FormValue != NULL && $this->locked->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->locked->caption(), $this->locked->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->locked->FormValue)) {
			AddMessage($FormError, $this->locked->errorMessage());
		}
		if ($this->app_target_hh->Required) {
			if (!$this->app_target_hh->IsDetailKey && $this->app_target_hh->FormValue != NULL && $this->app_target_hh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->app_target_hh->caption(), $this->app_target_hh->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->app_target_hh->FormValue)) {
			AddMessage($FormError, $this->app_target_hh->errorMessage());
		}
		if ($this->_4p_areas->Required) {
			if (!$this->_4p_areas->IsDetailKey && $this->_4p_areas->FormValue != NULL && $this->_4p_areas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_4p_areas->caption(), $this->_4p_areas->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->_4p_areas->FormValue)) {
			AddMessage($FormError, $this->_4p_areas->errorMessage());
		}
		if ($this->psgc_cty->Required) {
			if (!$this->psgc_cty->IsDetailKey && $this->psgc_cty->FormValue != NULL && $this->psgc_cty->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->psgc_cty->caption(), $this->psgc_cty->RequiredErrorMessage));
			}
		}
		if ($this->prov_code->Required) {
			if (!$this->prov_code->IsDetailKey && $this->prov_code->FormValue != NULL && $this->prov_code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->prov_code->caption(), $this->prov_code->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->prov_code->FormValue)) {
			AddMessage($FormError, $this->prov_code->errorMessage());
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

			// city_name
			$this->city_name->setDbValueDef($rsnew, $this->city_name->CurrentValue, "", $this->city_name->ReadOnly);

			// is_Urban
			$this->is_Urban->setDbValueDef($rsnew, $this->is_Urban->CurrentValue, NULL, $this->is_Urban->ReadOnly);

			// locked
			$this->locked->setDbValueDef($rsnew, $this->locked->CurrentValue, NULL, $this->locked->ReadOnly);

			// app_target_hh
			$this->app_target_hh->setDbValueDef($rsnew, $this->app_target_hh->CurrentValue, NULL, $this->app_target_hh->ReadOnly);

			// 4p_areas
			$this->_4p_areas->setDbValueDef($rsnew, $this->_4p_areas->CurrentValue, 0, $this->_4p_areas->ReadOnly);

			// psgc_cty
			$this->psgc_cty->setDbValueDef($rsnew, $this->psgc_cty->CurrentValue, "", $this->psgc_cty->ReadOnly);

			// prov_code
			$this->prov_code->setDbValueDef($rsnew, $this->prov_code->CurrentValue, 0, $this->prov_code->ReadOnly);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("lib_citieslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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