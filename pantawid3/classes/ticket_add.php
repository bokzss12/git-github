<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class ticket_add extends ticket
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'ticket';

	// Page object name
	public $PageObjName = "ticket_add";

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

		// Table object (ticket)
		if (!isset($GLOBALS["ticket"]) || get_class($GLOBALS["ticket"]) == PROJECT_NAMESPACE . "ticket") {
			$GLOBALS["ticket"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ticket"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ticket');

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
		global $ticket;
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
				$doc = new $class($ticket);
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
					if ($pageName == "ticketview.php")
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
			$key .= @$ar['item_id'];
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
					$this->terminate(GetUrl("ticketlist.php"));
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
		$this->item_id->Visible = FALSE;
		$this->SRN->Visible = FALSE;
		$this->month->Visible = FALSE;
		$this->Year->Visible = FALSE;
		$this->__Request->setVisibility();
		$this->item_date_receive->setVisibility();
		$this->item_date_repaired->Visible = FALSE;
		$this->technician_name->Visible = FALSE;
		$this->employeeid->setVisibility();
		$this->item_requested_unit->setVisibility();
		$this->item_transmittal->setVisibility();
		$this->position->setVisibility();
		$this->Contact_no->setVisibility();
		$this->item_type->setVisibility();
		$this->item_model->setVisibility();
		$this->item_serno->setVisibility();
		$this->Region->Visible = FALSE;
		$this->Province->Visible = FALSE;
		$this->Cities->Visible = FALSE;
		$this->item_type_problem->setVisibility();
		$this->item_action_taken->Visible = FALSE;
		$this->item_date_pullout->Visible = FALSE;
		$this->status_id->setVisibility();
		$this->remarks->Visible = FALSE;
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
		$this->setupLookupOptions($this->month);
		$this->setupLookupOptions($this->Year);
		$this->setupLookupOptions($this->__Request);
		$this->setupLookupOptions($this->technician_name);
		$this->setupLookupOptions($this->employeeid);
		$this->setupLookupOptions($this->item_requested_unit);
		$this->setupLookupOptions($this->item_type);
		$this->setupLookupOptions($this->Region);
		$this->setupLookupOptions($this->Province);
		$this->setupLookupOptions($this->Cities);
		$this->setupLookupOptions($this->status_id);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ticketlist.php");
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
			if (Get("item_id") !== NULL) {
				$this->item_id->setQueryStringValue(Get("item_id"));
				$this->setKey("item_id", $this->item_id->CurrentValue); // Set up key
			} else {
				$this->setKey("item_id", ""); // Clear key
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
					$this->terminate("ticketlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = "ticketlist.php";
					if (GetPageName($returnUrl) == "ticketlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "ticketview.php")
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
		$this->item_id->CurrentValue = NULL;
		$this->item_id->OldValue = $this->item_id->CurrentValue;
		$this->SRN->CurrentValue = NULL;
		$this->SRN->OldValue = $this->SRN->CurrentValue;
		$this->month->CurrentValue = NULL;
		$this->month->OldValue = $this->month->CurrentValue;
		$this->Year->CurrentValue = NULL;
		$this->Year->OldValue = $this->Year->CurrentValue;
		$this->__Request->CurrentValue = '3';
		$this->item_date_receive->CurrentValue = date("Y/m/d");
		$this->item_date_repaired->CurrentValue = NULL;
		$this->item_date_repaired->OldValue = $this->item_date_repaired->CurrentValue;
		$this->technician_name->CurrentValue = NULL;
		$this->technician_name->OldValue = $this->technician_name->CurrentValue;
		$this->employeeid->CurrentValue = NULL;
		$this->employeeid->OldValue = $this->employeeid->CurrentValue;
		$this->item_requested_unit->CurrentValue = NULL;
		$this->item_requested_unit->OldValue = $this->item_requested_unit->CurrentValue;
		$this->item_transmittal->CurrentValue = NULL;
		$this->item_transmittal->OldValue = $this->item_transmittal->CurrentValue;
		$this->position->CurrentValue = NULL;
		$this->position->OldValue = $this->position->CurrentValue;
		$this->Contact_no->CurrentValue = NULL;
		$this->Contact_no->OldValue = $this->Contact_no->CurrentValue;
		$this->item_type->CurrentValue = NULL;
		$this->item_type->OldValue = $this->item_type->CurrentValue;
		$this->item_model->CurrentValue = NULL;
		$this->item_model->OldValue = $this->item_model->CurrentValue;
		$this->item_serno->CurrentValue = NULL;
		$this->item_serno->OldValue = $this->item_serno->CurrentValue;
		$this->Region->CurrentValue = NULL;
		$this->Region->OldValue = $this->Region->CurrentValue;
		$this->Province->CurrentValue = NULL;
		$this->Province->OldValue = $this->Province->CurrentValue;
		$this->Cities->CurrentValue = NULL;
		$this->Cities->OldValue = $this->Cities->CurrentValue;
		$this->item_type_problem->CurrentValue = NULL;
		$this->item_type_problem->OldValue = $this->item_type_problem->CurrentValue;
		$this->item_action_taken->CurrentValue = NULL;
		$this->item_action_taken->OldValue = $this->item_action_taken->CurrentValue;
		$this->item_date_pullout->CurrentValue = NULL;
		$this->item_date_pullout->OldValue = $this->item_date_pullout->CurrentValue;
		$this->status_id->CurrentValue = '11';
		$this->remarks->CurrentValue = NULL;
		$this->remarks->OldValue = $this->remarks->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Request' first before field var 'x___Request'
		$val = $CurrentForm->hasValue("Request") ? $CurrentForm->getValue("Request") : $CurrentForm->getValue("x___Request");
		if (!$this->__Request->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->__Request->Visible = FALSE; // Disable update for API request
			else
				$this->__Request->setFormValue($val);
		}

		// Check field name 'item_date_receive' first before field var 'x_item_date_receive'
		$val = $CurrentForm->hasValue("item_date_receive") ? $CurrentForm->getValue("item_date_receive") : $CurrentForm->getValue("x_item_date_receive");
		if (!$this->item_date_receive->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_date_receive->Visible = FALSE; // Disable update for API request
			else
				$this->item_date_receive->setFormValue($val);
			$this->item_date_receive->CurrentValue = UnFormatDateTime($this->item_date_receive->CurrentValue, 5);
		}

		// Check field name 'employeeid' first before field var 'x_employeeid'
		$val = $CurrentForm->hasValue("employeeid") ? $CurrentForm->getValue("employeeid") : $CurrentForm->getValue("x_employeeid");
		if (!$this->employeeid->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->employeeid->Visible = FALSE; // Disable update for API request
			else
				$this->employeeid->setFormValue($val);
		}

		// Check field name 'item_requested_unit' first before field var 'x_item_requested_unit'
		$val = $CurrentForm->hasValue("item_requested_unit") ? $CurrentForm->getValue("item_requested_unit") : $CurrentForm->getValue("x_item_requested_unit");
		if (!$this->item_requested_unit->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_requested_unit->Visible = FALSE; // Disable update for API request
			else
				$this->item_requested_unit->setFormValue($val);
		}

		// Check field name 'item_transmittal' first before field var 'x_item_transmittal'
		$val = $CurrentForm->hasValue("item_transmittal") ? $CurrentForm->getValue("item_transmittal") : $CurrentForm->getValue("x_item_transmittal");
		if (!$this->item_transmittal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_transmittal->Visible = FALSE; // Disable update for API request
			else
				$this->item_transmittal->setFormValue($val);
		}

		// Check field name 'position' first before field var 'x_position'
		$val = $CurrentForm->hasValue("position") ? $CurrentForm->getValue("position") : $CurrentForm->getValue("x_position");
		if (!$this->position->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->position->Visible = FALSE; // Disable update for API request
			else
				$this->position->setFormValue($val);
		}

		// Check field name 'Contact_no' first before field var 'x_Contact_no'
		$val = $CurrentForm->hasValue("Contact_no") ? $CurrentForm->getValue("Contact_no") : $CurrentForm->getValue("x_Contact_no");
		if (!$this->Contact_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Contact_no->Visible = FALSE; // Disable update for API request
			else
				$this->Contact_no->setFormValue($val);
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

		// Check field name 'item_serno' first before field var 'x_item_serno'
		$val = $CurrentForm->hasValue("item_serno") ? $CurrentForm->getValue("item_serno") : $CurrentForm->getValue("x_item_serno");
		if (!$this->item_serno->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_serno->Visible = FALSE; // Disable update for API request
			else
				$this->item_serno->setFormValue($val);
		}

		// Check field name 'item_type_problem' first before field var 'x_item_type_problem'
		$val = $CurrentForm->hasValue("item_type_problem") ? $CurrentForm->getValue("item_type_problem") : $CurrentForm->getValue("x_item_type_problem");
		if (!$this->item_type_problem->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_type_problem->Visible = FALSE; // Disable update for API request
			else
				$this->item_type_problem->setFormValue($val);
		}

		// Check field name 'status_id' first before field var 'x_status_id'
		$val = $CurrentForm->hasValue("status_id") ? $CurrentForm->getValue("status_id") : $CurrentForm->getValue("x_status_id");
		if (!$this->status_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status_id->Visible = FALSE; // Disable update for API request
			else
				$this->status_id->setFormValue($val);
		}

		// Check field name 'item_id' first before field var 'x_item_id'
		$val = $CurrentForm->hasValue("item_id") ? $CurrentForm->getValue("item_id") : $CurrentForm->getValue("x_item_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->__Request->CurrentValue = $this->__Request->FormValue;
		$this->item_date_receive->CurrentValue = $this->item_date_receive->FormValue;
		$this->item_date_receive->CurrentValue = UnFormatDateTime($this->item_date_receive->CurrentValue, 5);
		$this->employeeid->CurrentValue = $this->employeeid->FormValue;
		$this->item_requested_unit->CurrentValue = $this->item_requested_unit->FormValue;
		$this->item_transmittal->CurrentValue = $this->item_transmittal->FormValue;
		$this->position->CurrentValue = $this->position->FormValue;
		$this->Contact_no->CurrentValue = $this->Contact_no->FormValue;
		$this->item_type->CurrentValue = $this->item_type->FormValue;
		$this->item_model->CurrentValue = $this->item_model->FormValue;
		$this->item_serno->CurrentValue = $this->item_serno->FormValue;
		$this->item_type_problem->CurrentValue = $this->item_type_problem->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
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
		$this->item_id->setDbValue($row['item_id']);
		$this->SRN->setDbValue($row['SRN']);
		$this->month->setDbValue($row['month']);
		$this->Year->setDbValue($row['Year']);
		if (array_key_exists('EV__Year', $rs->fields)) {
			$this->Year->VirtualValue = $rs->fields('EV__Year'); // Set up virtual field value
		} else {
			$this->Year->VirtualValue = ""; // Clear value
		}
		$this->__Request->setDbValue($row['Request']);
		$this->item_date_receive->setDbValue($row['item_date_receive']);
		$this->item_date_repaired->setDbValue($row['item_date_repaired']);
		$this->technician_name->setDbValue($row['technician_name']);
		$this->employeeid->setDbValue($row['employeeid']);
		$this->item_requested_unit->setDbValue($row['item_requested_unit']);
		$this->item_transmittal->setDbValue($row['item_transmittal']);
		$this->position->setDbValue($row['position']);
		$this->Contact_no->setDbValue($row['Contact_no']);
		$this->item_type->setDbValue($row['item_type']);
		$this->item_model->setDbValue($row['item_model']);
		$this->item_serno->setDbValue($row['item_serno']);
		$this->Region->setDbValue($row['Region']);
		$this->Province->setDbValue($row['Province']);
		$this->Cities->setDbValue($row['Cities']);
		$this->item_type_problem->setDbValue($row['item_type_problem']);
		$this->item_action_taken->setDbValue($row['item_action_taken']);
		$this->item_date_pullout->setDbValue($row['item_date_pullout']);
		$this->status_id->setDbValue($row['status_id']);
		$this->remarks->setDbValue($row['remarks']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['item_id'] = $this->item_id->CurrentValue;
		$row['SRN'] = $this->SRN->CurrentValue;
		$row['month'] = $this->month->CurrentValue;
		$row['Year'] = $this->Year->CurrentValue;
		$row['Request'] = $this->__Request->CurrentValue;
		$row['item_date_receive'] = $this->item_date_receive->CurrentValue;
		$row['item_date_repaired'] = $this->item_date_repaired->CurrentValue;
		$row['technician_name'] = $this->technician_name->CurrentValue;
		$row['employeeid'] = $this->employeeid->CurrentValue;
		$row['item_requested_unit'] = $this->item_requested_unit->CurrentValue;
		$row['item_transmittal'] = $this->item_transmittal->CurrentValue;
		$row['position'] = $this->position->CurrentValue;
		$row['Contact_no'] = $this->Contact_no->CurrentValue;
		$row['item_type'] = $this->item_type->CurrentValue;
		$row['item_model'] = $this->item_model->CurrentValue;
		$row['item_serno'] = $this->item_serno->CurrentValue;
		$row['Region'] = $this->Region->CurrentValue;
		$row['Province'] = $this->Province->CurrentValue;
		$row['Cities'] = $this->Cities->CurrentValue;
		$row['item_type_problem'] = $this->item_type_problem->CurrentValue;
		$row['item_action_taken'] = $this->item_action_taken->CurrentValue;
		$row['item_date_pullout'] = $this->item_date_pullout->CurrentValue;
		$row['status_id'] = $this->status_id->CurrentValue;
		$row['remarks'] = $this->remarks->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("item_id")) != "")
			$this->item_id->OldValue = $this->getKey("item_id"); // item_id
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
		// item_id
		// SRN
		// month
		// Year
		// Request
		// item_date_receive
		// item_date_repaired
		// technician_name
		// employeeid
		// item_requested_unit
		// item_transmittal
		// position
		// Contact_no
		// item_type
		// item_model
		// item_serno
		// Region
		// Province
		// Cities
		// item_type_problem
		// item_action_taken
		// item_date_pullout
		// status_id
		// remarks

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// item_id
			$this->item_id->ViewValue = $this->item_id->CurrentValue;
			$this->item_id->ViewCustomAttributes = "";

			// SRN
			$this->SRN->ViewValue = $this->SRN->CurrentValue;
			$this->SRN->ViewCustomAttributes = "";

			// Request
			$curVal = strval($this->__Request->CurrentValue);
			if ($curVal != "") {
				$this->__Request->ViewValue = $this->__Request->lookupCacheOption($curVal);
				if ($this->__Request->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`request_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`request_id` in(3)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->__Request->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->__Request->ViewValue = $this->__Request->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->__Request->ViewValue = $this->__Request->CurrentValue;
					}
				}
			} else {
				$this->__Request->ViewValue = NULL;
			}
			$this->__Request->ViewCustomAttributes = "";

			// item_date_receive
			$this->item_date_receive->ViewValue = $this->item_date_receive->CurrentValue;
			$this->item_date_receive->ViewValue = FormatDateTime($this->item_date_receive->ViewValue, 5);
			$this->item_date_receive->ViewCustomAttributes = "";

			// item_date_repaired
			$this->item_date_repaired->ViewValue = $this->item_date_repaired->CurrentValue;
			$this->item_date_repaired->ViewValue = FormatDateTime($this->item_date_repaired->ViewValue, 1);
			$this->item_date_repaired->ViewCustomAttributes = "";

			// technician_name
			$this->technician_name->ViewValue = $this->technician_name->CurrentValue;
			$curVal = strval($this->technician_name->CurrentValue);
			if ($curVal != "") {
				$this->technician_name->ViewValue = $this->technician_name->lookupCacheOption($curVal);
				if ($this->technician_name->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`technician_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->technician_name->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->technician_name->ViewValue = $this->technician_name->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->technician_name->ViewValue = $this->technician_name->CurrentValue;
					}
				}
			} else {
				$this->technician_name->ViewValue = NULL;
			}
			$this->technician_name->ViewCustomAttributes = "";

			// employeeid
			$curVal = strval($this->employeeid->CurrentValue);
			if ($curVal != "") {
				$this->employeeid->ViewValue = $this->employeeid->lookupCacheOption($curVal);
				if ($this->employeeid->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`employeeid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`employeeid` in(4,5)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->employeeid->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
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

			// item_requested_unit
			$curVal = strval($this->item_requested_unit->CurrentValue);
			if ($curVal != "") {
				$this->item_requested_unit->ViewValue = $this->item_requested_unit->lookupCacheOption($curVal);
				if ($this->item_requested_unit->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`off_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->item_requested_unit->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->item_requested_unit->ViewValue = $this->item_requested_unit->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->item_requested_unit->ViewValue = $this->item_requested_unit->CurrentValue;
					}
				}
			} else {
				$this->item_requested_unit->ViewValue = NULL;
			}
			$this->item_requested_unit->ViewCustomAttributes = "";

			// item_transmittal
			$this->item_transmittal->ViewValue = $this->item_transmittal->CurrentValue;
			$this->item_transmittal->ViewCustomAttributes = "";

			// position
			$this->position->ViewValue = $this->position->CurrentValue;
			$this->position->ViewCustomAttributes = "";

			// Contact_no
			$this->Contact_no->ViewValue = $this->Contact_no->CurrentValue;
			$this->Contact_no->ViewCustomAttributes = "";

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

			// item_serno
			$this->item_serno->ViewValue = $this->item_serno->CurrentValue;
			$this->item_serno->ViewCustomAttributes = "";

			// Region
			$curVal = strval($this->Region->CurrentValue);
			if ($curVal != "") {
				$this->Region->ViewValue = $this->Region->lookupCacheOption($curVal);
				if ($this->Region->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`region_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "region_name = 'REGION VI [Western Visayas]'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->Region->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Region->ViewValue = $this->Region->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Region->ViewValue = $this->Region->CurrentValue;
					}
				}
			} else {
				$this->Region->ViewValue = NULL;
			}
			$this->Region->ViewCustomAttributes = "";

			// Province
			$curVal = strval($this->Province->CurrentValue);
			if ($curVal != "") {
				$this->Province->ViewValue = $this->Province->lookupCacheOption($curVal);
				if ($this->Province->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`prov_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Province->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Province->ViewValue = $this->Province->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Province->ViewValue = $this->Province->CurrentValue;
					}
				}
			} else {
				$this->Province->ViewValue = NULL;
			}
			$this->Province->ViewCustomAttributes = "";

			// Cities
			$curVal = strval($this->Cities->CurrentValue);
			if ($curVal != "") {
				$this->Cities->ViewValue = $this->Cities->lookupCacheOption($curVal);
				if ($this->Cities->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`city_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Cities->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Cities->ViewValue = $this->Cities->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Cities->ViewValue = $this->Cities->CurrentValue;
					}
				}
			} else {
				$this->Cities->ViewValue = NULL;
			}
			$this->Cities->ViewCustomAttributes = "";

			// item_type_problem
			$this->item_type_problem->ViewValue = $this->item_type_problem->CurrentValue;
			$this->item_type_problem->ViewCustomAttributes = "";

			// item_action_taken
			$this->item_action_taken->ViewValue = $this->item_action_taken->CurrentValue;
			$this->item_action_taken->ViewCustomAttributes = "";

			// item_date_pullout
			$this->item_date_pullout->ViewValue = $this->item_date_pullout->CurrentValue;
			$this->item_date_pullout->ViewValue = FormatDateTime($this->item_date_pullout->ViewValue, 1);
			$this->item_date_pullout->ViewCustomAttributes = "";

			// status_id
			$curVal = strval($this->status_id->CurrentValue);
			if ($curVal != "") {
				$this->status_id->ViewValue = $this->status_id->lookupCacheOption($curVal);
				if ($this->status_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`status_id` in(11)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->status_id->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->status_id->ViewValue = $this->status_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->status_id->ViewValue = $this->status_id->CurrentValue;
					}
				}
			} else {
				$this->status_id->ViewValue = NULL;
			}
			$this->status_id->ViewCustomAttributes = "";

			// remarks
			$this->remarks->ViewValue = $this->remarks->CurrentValue;
			$this->remarks->ViewCustomAttributes = "";

			// Request
			$this->__Request->LinkCustomAttributes = "";
			$this->__Request->HrefValue = "";
			$this->__Request->TooltipValue = "";

			// item_date_receive
			$this->item_date_receive->LinkCustomAttributes = "";
			$this->item_date_receive->HrefValue = "";
			$this->item_date_receive->TooltipValue = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";
			$this->employeeid->TooltipValue = "";

			// item_requested_unit
			$this->item_requested_unit->LinkCustomAttributes = "";
			$this->item_requested_unit->HrefValue = "";
			$this->item_requested_unit->TooltipValue = "";

			// item_transmittal
			$this->item_transmittal->LinkCustomAttributes = "";
			$this->item_transmittal->HrefValue = "";
			$this->item_transmittal->TooltipValue = "";

			// position
			$this->position->LinkCustomAttributes = "";
			$this->position->HrefValue = "";
			$this->position->TooltipValue = "";

			// Contact_no
			$this->Contact_no->LinkCustomAttributes = "";
			$this->Contact_no->HrefValue = "";
			$this->Contact_no->TooltipValue = "";

			// item_type
			$this->item_type->LinkCustomAttributes = "";
			$this->item_type->HrefValue = "";
			$this->item_type->TooltipValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";
			$this->item_model->TooltipValue = "";

			// item_serno
			$this->item_serno->LinkCustomAttributes = "";
			$this->item_serno->HrefValue = "";
			$this->item_serno->TooltipValue = "";

			// item_type_problem
			$this->item_type_problem->LinkCustomAttributes = "";
			$this->item_type_problem->HrefValue = "";
			$this->item_type_problem->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Request
			$this->__Request->EditAttrs["class"] = "form-control";
			$this->__Request->EditCustomAttributes = "";
			$curVal = trim(strval($this->__Request->CurrentValue));
			if ($curVal != "")
				$this->__Request->ViewValue = $this->__Request->lookupCacheOption($curVal);
			else
				$this->__Request->ViewValue = $this->__Request->Lookup !== NULL && is_array($this->__Request->Lookup->Options) ? $curVal : NULL;
			if ($this->__Request->ViewValue !== NULL) { // Load from cache
				$this->__Request->EditValue = array_values($this->__Request->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`request_id`" . SearchString("=", $this->__Request->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`request_id` in(3)";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->__Request->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->__Request->EditValue = $arwrk;
			}

			// item_date_receive
			$this->item_date_receive->EditAttrs["class"] = "form-control";
			$this->item_date_receive->EditCustomAttributes = "";
			$this->item_date_receive->EditValue = HtmlEncode(FormatDateTime($this->item_date_receive->CurrentValue, 5));
			$this->item_date_receive->PlaceHolder = RemoveHtml($this->item_date_receive->caption());

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
				$lookupFilter = function() {
					return "`employeeid` in(4,5)";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->employeeid->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->employeeid->EditValue = $arwrk;
			}

			// item_requested_unit
			$this->item_requested_unit->EditAttrs["class"] = "form-control";
			$this->item_requested_unit->EditCustomAttributes = "";
			$curVal = trim(strval($this->item_requested_unit->CurrentValue));
			if ($curVal != "")
				$this->item_requested_unit->ViewValue = $this->item_requested_unit->lookupCacheOption($curVal);
			else
				$this->item_requested_unit->ViewValue = $this->item_requested_unit->Lookup !== NULL && is_array($this->item_requested_unit->Lookup->Options) ? $curVal : NULL;
			if ($this->item_requested_unit->ViewValue !== NULL) { // Load from cache
				$this->item_requested_unit->EditValue = array_values($this->item_requested_unit->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`off_id`" . SearchString("=", $this->item_requested_unit->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->item_requested_unit->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->item_requested_unit->EditValue = $arwrk;
			}

			// item_transmittal
			$this->item_transmittal->EditAttrs["class"] = "form-control";
			$this->item_transmittal->EditCustomAttributes = "";
			if (!$this->item_transmittal->Raw)
				$this->item_transmittal->CurrentValue = HtmlDecode($this->item_transmittal->CurrentValue);
			$this->item_transmittal->EditValue = HtmlEncode($this->item_transmittal->CurrentValue);
			$this->item_transmittal->PlaceHolder = RemoveHtml($this->item_transmittal->caption());

			// position
			$this->position->EditAttrs["class"] = "form-control";
			$this->position->EditCustomAttributes = "";
			if (!$this->position->Raw)
				$this->position->CurrentValue = HtmlDecode($this->position->CurrentValue);
			$this->position->EditValue = HtmlEncode($this->position->CurrentValue);
			$this->position->PlaceHolder = RemoveHtml($this->position->caption());

			// Contact_no
			$this->Contact_no->EditAttrs["class"] = "form-control";
			$this->Contact_no->EditCustomAttributes = "";
			$this->Contact_no->EditValue = HtmlEncode($this->Contact_no->CurrentValue);
			$this->Contact_no->PlaceHolder = RemoveHtml($this->Contact_no->caption());

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

			// item_serno
			$this->item_serno->EditAttrs["class"] = "form-control";
			$this->item_serno->EditCustomAttributes = "";
			if (!$this->item_serno->Raw)
				$this->item_serno->CurrentValue = HtmlDecode($this->item_serno->CurrentValue);
			$this->item_serno->EditValue = HtmlEncode($this->item_serno->CurrentValue);
			$this->item_serno->PlaceHolder = RemoveHtml($this->item_serno->caption());

			// item_type_problem
			$this->item_type_problem->EditAttrs["class"] = "form-control";
			$this->item_type_problem->EditCustomAttributes = "";
			$this->item_type_problem->EditValue = HtmlEncode($this->item_type_problem->CurrentValue);
			$this->item_type_problem->PlaceHolder = RemoveHtml($this->item_type_problem->caption());

			// status_id
			$this->status_id->EditAttrs["class"] = "form-control";
			$this->status_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->status_id->CurrentValue));
			if ($curVal != "")
				$this->status_id->ViewValue = $this->status_id->lookupCacheOption($curVal);
			else
				$this->status_id->ViewValue = $this->status_id->Lookup !== NULL && is_array($this->status_id->Lookup->Options) ? $curVal : NULL;
			if ($this->status_id->ViewValue !== NULL) { // Load from cache
				$this->status_id->EditValue = array_values($this->status_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`status_id`" . SearchString("=", $this->status_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`status_id` in(11)";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->status_id->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->status_id->EditValue = $arwrk;
			}

			// Add refer script
			// Request

			$this->__Request->LinkCustomAttributes = "";
			$this->__Request->HrefValue = "";

			// item_date_receive
			$this->item_date_receive->LinkCustomAttributes = "";
			$this->item_date_receive->HrefValue = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";

			// item_requested_unit
			$this->item_requested_unit->LinkCustomAttributes = "";
			$this->item_requested_unit->HrefValue = "";

			// item_transmittal
			$this->item_transmittal->LinkCustomAttributes = "";
			$this->item_transmittal->HrefValue = "";

			// position
			$this->position->LinkCustomAttributes = "";
			$this->position->HrefValue = "";

			// Contact_no
			$this->Contact_no->LinkCustomAttributes = "";
			$this->Contact_no->HrefValue = "";

			// item_type
			$this->item_type->LinkCustomAttributes = "";
			$this->item_type->HrefValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";

			// item_serno
			$this->item_serno->LinkCustomAttributes = "";
			$this->item_serno->HrefValue = "";

			// item_type_problem
			$this->item_type_problem->LinkCustomAttributes = "";
			$this->item_type_problem->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
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
		if ($this->__Request->Required) {
			if (!$this->__Request->IsDetailKey && $this->__Request->FormValue != NULL && $this->__Request->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->__Request->caption(), $this->__Request->RequiredErrorMessage));
			}
		}
		if ($this->item_date_receive->Required) {
			if (!$this->item_date_receive->IsDetailKey && $this->item_date_receive->FormValue != NULL && $this->item_date_receive->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_date_receive->caption(), $this->item_date_receive->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->item_date_receive->FormValue)) {
			AddMessage($FormError, $this->item_date_receive->errorMessage());
		}
		if ($this->employeeid->Required) {
			if (!$this->employeeid->IsDetailKey && $this->employeeid->FormValue != NULL && $this->employeeid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->employeeid->caption(), $this->employeeid->RequiredErrorMessage));
			}
		}
		if ($this->item_requested_unit->Required) {
			if (!$this->item_requested_unit->IsDetailKey && $this->item_requested_unit->FormValue != NULL && $this->item_requested_unit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_requested_unit->caption(), $this->item_requested_unit->RequiredErrorMessage));
			}
		}
		if ($this->item_transmittal->Required) {
			if (!$this->item_transmittal->IsDetailKey && $this->item_transmittal->FormValue != NULL && $this->item_transmittal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_transmittal->caption(), $this->item_transmittal->RequiredErrorMessage));
			}
		}
		if ($this->position->Required) {
			if (!$this->position->IsDetailKey && $this->position->FormValue != NULL && $this->position->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->position->caption(), $this->position->RequiredErrorMessage));
			}
		}
		if ($this->Contact_no->Required) {
			if (!$this->Contact_no->IsDetailKey && $this->Contact_no->FormValue != NULL && $this->Contact_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Contact_no->caption(), $this->Contact_no->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Contact_no->FormValue)) {
			AddMessage($FormError, $this->Contact_no->errorMessage());
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
		if ($this->item_serno->Required) {
			if (!$this->item_serno->IsDetailKey && $this->item_serno->FormValue != NULL && $this->item_serno->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_serno->caption(), $this->item_serno->RequiredErrorMessage));
			}
		}
		if ($this->item_type_problem->Required) {
			if (!$this->item_type_problem->IsDetailKey && $this->item_type_problem->FormValue != NULL && $this->item_type_problem->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_type_problem->caption(), $this->item_type_problem->RequiredErrorMessage));
			}
		}
		if ($this->status_id->Required) {
			if (!$this->status_id->IsDetailKey && $this->status_id->FormValue != NULL && $this->status_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_id->caption(), $this->status_id->RequiredErrorMessage));
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

		// Request
		$this->__Request->setDbValueDef($rsnew, $this->__Request->CurrentValue, NULL, FALSE);

		// item_date_receive
		$this->item_date_receive->setDbValueDef($rsnew, UnFormatDateTime($this->item_date_receive->CurrentValue, 5), NULL, FALSE);

		// employeeid
		$this->employeeid->setDbValueDef($rsnew, $this->employeeid->CurrentValue, NULL, FALSE);

		// item_requested_unit
		$this->item_requested_unit->setDbValueDef($rsnew, $this->item_requested_unit->CurrentValue, NULL, FALSE);

		// item_transmittal
		$this->item_transmittal->setDbValueDef($rsnew, $this->item_transmittal->CurrentValue, NULL, FALSE);

		// position
		$this->position->setDbValueDef($rsnew, $this->position->CurrentValue, NULL, FALSE);

		// Contact_no
		$this->Contact_no->setDbValueDef($rsnew, $this->Contact_no->CurrentValue, NULL, FALSE);

		// item_type
		$this->item_type->setDbValueDef($rsnew, $this->item_type->CurrentValue, NULL, FALSE);

		// item_model
		$this->item_model->setDbValueDef($rsnew, $this->item_model->CurrentValue, NULL, FALSE);

		// item_serno
		$this->item_serno->setDbValueDef($rsnew, $this->item_serno->CurrentValue, NULL, FALSE);

		// item_type_problem
		$this->item_type_problem->setDbValueDef($rsnew, $this->item_type_problem->CurrentValue, NULL, FALSE);

		// status_id
		$this->status_id->setDbValueDef($rsnew, $this->status_id->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ticketlist.php"), "", $this->TableVar, TRUE);
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
				case "x_month":
					break;
				case "x_Year":
					break;
				case "x___Request":
					$lookupFilter = function() {
						return "`request_id` in(3)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_technician_name":
					break;
				case "x_employeeid":
					$lookupFilter = function() {
						return "`employeeid` in(4,5)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_item_requested_unit":
					break;
				case "x_item_type":
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
				case "x_status_id":
					$lookupFilter = function() {
						return "`status_id` in(11)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
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
						case "x_month":
							break;
						case "x_Year":
							break;
						case "x___Request":
							break;
						case "x_technician_name":
							break;
						case "x_employeeid":
							break;
						case "x_item_requested_unit":
							break;
						case "x_item_type":
							break;
						case "x_Region":
							break;
						case "x_Province":
							break;
						case "x_Cities":
							break;
						case "x_status_id":
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
} // End class
?>