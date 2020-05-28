<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_inventory_add extends tbl_inventory
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_inventory';

	// Page object name
	public $PageObjName = "tbl_inventory_add";

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

		// Table object (tbl_inventory)
		if (!isset($GLOBALS["tbl_inventory"]) || get_class($GLOBALS["tbl_inventory"]) == PROJECT_NAMESPACE . "tbl_inventory") {
			$GLOBALS["tbl_inventory"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_inventory"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_inventory');

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
		global $tbl_inventory;
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
				$doc = new $class($tbl_inventory);
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
					if ($pageName == "tbl_inventoryview.php")
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
			$key .= @$ar['inventory_id'];
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
					$this->terminate(GetUrl("tbl_inventorylist.php"));
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
		$this->inventory_id->Visible = FALSE;
		$this->concat_inventory->Visible = FALSE;
		$this->Month_Purchased->setVisibility();
		$this->Year_Purchased->setVisibility();
		$this->item_type->setVisibility();
		$this->item_model->setVisibility();
		$this->item_serial->setVisibility();
		$this->office_id->setVisibility();
		$this->Region->setVisibility();
		$this->Province->setVisibility();
		$this->Cities->setVisibility();
		$this->name_accountable->setVisibility();
		$this->Designation->setVisibility();
		$this->Current_Location->setVisibility();
		$this->Last_Date_Check->setVisibility();
		$this->employee_id->setVisibility();
		$this->status->setVisibility();
		$this->remarks->setVisibility();
		$this->picture->setVisibility();
		$this->picture_size->setVisibility();
		$this->picture_name->setVisibility();
		$this->picture_type->setVisibility();
		$this->picture_width->setVisibility();
		$this->picture_height->setVisibility();
		$this->Tansmiss_Automatic->Visible = FALSE;
		$this->user_last_modify->setVisibility();
		$this->date_last_modify->setVisibility();
		$this->item_id->Visible = FALSE;
		$this->pullout_date->Visible = FALSE;
		$this->pullout_i->setVisibility();
		$this->signatureID->setVisibility();
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
		$this->setupLookupOptions($this->Month_Purchased);
		$this->setupLookupOptions($this->Year_Purchased);
		$this->setupLookupOptions($this->item_type);
		$this->setupLookupOptions($this->office_id);
		$this->setupLookupOptions($this->Region);
		$this->setupLookupOptions($this->Province);
		$this->setupLookupOptions($this->Cities);
		$this->setupLookupOptions($this->name_accountable);
		$this->setupLookupOptions($this->Designation);
		$this->setupLookupOptions($this->Current_Location);
		$this->setupLookupOptions($this->employee_id);
		$this->setupLookupOptions($this->status);
		$this->setupLookupOptions($this->user_last_modify);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("tbl_inventorylist.php");
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
			if (Get("inventory_id") !== NULL) {
				$this->inventory_id->setQueryStringValue(Get("inventory_id"));
				$this->setKey("inventory_id", $this->inventory_id->CurrentValue); // Set up key
			} else {
				$this->setKey("inventory_id", ""); // Clear key
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
					$this->terminate("tbl_inventorylist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = "tbl_inventorylist.php";
					if (GetPageName($returnUrl) == "tbl_inventorylist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_inventoryview.php")
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
		$this->picture->Upload->Index = $CurrentForm->Index;
		$this->picture->Upload->uploadFile();
		$this->picture_type->CurrentValue = $this->picture->Upload->FileName;
		$this->picture_name->CurrentValue = $this->picture->Upload->ContentType;
		$this->picture_size->CurrentValue = $this->picture->Upload->FileSize;
		$this->picture_width->CurrentValue = $this->picture->Upload->ImageWidth;
		$this->picture_height->CurrentValue = $this->picture->Upload->ImageHeight;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->inventory_id->CurrentValue = NULL;
		$this->inventory_id->OldValue = $this->inventory_id->CurrentValue;
		$this->concat_inventory->CurrentValue = NULL;
		$this->concat_inventory->OldValue = $this->concat_inventory->CurrentValue;
		$this->Month_Purchased->CurrentValue = NULL;
		$this->Month_Purchased->OldValue = $this->Month_Purchased->CurrentValue;
		$this->Year_Purchased->CurrentValue = NULL;
		$this->Year_Purchased->OldValue = $this->Year_Purchased->CurrentValue;
		$this->item_type->CurrentValue = NULL;
		$this->item_type->OldValue = $this->item_type->CurrentValue;
		$this->item_model->CurrentValue = NULL;
		$this->item_model->OldValue = $this->item_model->CurrentValue;
		$this->item_serial->CurrentValue = NULL;
		$this->item_serial->OldValue = $this->item_serial->CurrentValue;
		$this->office_id->CurrentValue = NULL;
		$this->office_id->OldValue = $this->office_id->CurrentValue;
		$this->Region->CurrentValue = NULL;
		$this->Region->OldValue = $this->Region->CurrentValue;
		$this->Province->CurrentValue = NULL;
		$this->Province->OldValue = $this->Province->CurrentValue;
		$this->Cities->CurrentValue = NULL;
		$this->Cities->OldValue = $this->Cities->CurrentValue;
		$this->name_accountable->CurrentValue = NULL;
		$this->name_accountable->OldValue = $this->name_accountable->CurrentValue;
		$this->Designation->CurrentValue = NULL;
		$this->Designation->OldValue = $this->Designation->CurrentValue;
		$this->Current_Location->CurrentValue = NULL;
		$this->Current_Location->OldValue = $this->Current_Location->CurrentValue;
		$this->Last_Date_Check->CurrentValue = date("Y/m/d");
		$this->employee_id->CurrentValue = NULL;
		$this->employee_id->OldValue = $this->employee_id->CurrentValue;
		$this->status->CurrentValue = NULL;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->remarks->CurrentValue = NULL;
		$this->remarks->OldValue = $this->remarks->CurrentValue;
		$this->picture->Upload->DbValue = NULL;
		$this->picture->OldValue = $this->picture->Upload->DbValue;
		$this->picture_size->CurrentValue = NULL;
		$this->picture_size->OldValue = $this->picture_size->CurrentValue;
		$this->picture_size->CurrentValue = NULL; // Clear file related field
		$this->picture_name->CurrentValue = NULL;
		$this->picture_name->OldValue = $this->picture_name->CurrentValue;
		$this->picture_name->CurrentValue = NULL; // Clear file related field
		$this->picture_type->CurrentValue = NULL;
		$this->picture_type->OldValue = $this->picture_type->CurrentValue;
		$this->picture_type->CurrentValue = NULL; // Clear file related field
		$this->picture_width->CurrentValue = NULL;
		$this->picture_width->OldValue = $this->picture_width->CurrentValue;
		$this->picture_width->CurrentValue = NULL; // Clear file related field
		$this->picture_height->CurrentValue = NULL;
		$this->picture_height->OldValue = $this->picture_height->CurrentValue;
		$this->picture_height->CurrentValue = NULL; // Clear file related field
		$this->Tansmiss_Automatic->CurrentValue = NULL;
		$this->Tansmiss_Automatic->OldValue = $this->Tansmiss_Automatic->CurrentValue;
		$this->user_last_modify->CurrentValue = NULL;
		$this->user_last_modify->OldValue = $this->user_last_modify->CurrentValue;
		$this->date_last_modify->CurrentValue = date("Y-m-d H:i:s");
		$this->item_id->CurrentValue = NULL;
		$this->item_id->OldValue = $this->item_id->CurrentValue;
		$this->pullout_date->CurrentValue = NULL;
		$this->pullout_date->OldValue = $this->pullout_date->CurrentValue;
		$this->pullout_i->CurrentValue = "0";
		$this->signatureID->CurrentValue = "1";
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'Month_Purchased' first before field var 'x_Month_Purchased'
		$val = $CurrentForm->hasValue("Month_Purchased") ? $CurrentForm->getValue("Month_Purchased") : $CurrentForm->getValue("x_Month_Purchased");
		if (!$this->Month_Purchased->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Month_Purchased->Visible = FALSE; // Disable update for API request
			else
				$this->Month_Purchased->setFormValue($val);
		}

		// Check field name 'Year_Purchased' first before field var 'x_Year_Purchased'
		$val = $CurrentForm->hasValue("Year_Purchased") ? $CurrentForm->getValue("Year_Purchased") : $CurrentForm->getValue("x_Year_Purchased");
		if (!$this->Year_Purchased->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Year_Purchased->Visible = FALSE; // Disable update for API request
			else
				$this->Year_Purchased->setFormValue($val);
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

		// Check field name 'office_id' first before field var 'x_office_id'
		$val = $CurrentForm->hasValue("office_id") ? $CurrentForm->getValue("office_id") : $CurrentForm->getValue("x_office_id");
		if (!$this->office_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->office_id->Visible = FALSE; // Disable update for API request
			else
				$this->office_id->setFormValue($val);
		}

		// Check field name 'Region' first before field var 'x_Region'
		$val = $CurrentForm->hasValue("Region") ? $CurrentForm->getValue("Region") : $CurrentForm->getValue("x_Region");
		if (!$this->Region->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Region->Visible = FALSE; // Disable update for API request
			else
				$this->Region->setFormValue($val);
		}

		// Check field name 'Province' first before field var 'x_Province'
		$val = $CurrentForm->hasValue("Province") ? $CurrentForm->getValue("Province") : $CurrentForm->getValue("x_Province");
		if (!$this->Province->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Province->Visible = FALSE; // Disable update for API request
			else
				$this->Province->setFormValue($val);
		}

		// Check field name 'Cities' first before field var 'x_Cities'
		$val = $CurrentForm->hasValue("Cities") ? $CurrentForm->getValue("Cities") : $CurrentForm->getValue("x_Cities");
		if (!$this->Cities->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Cities->Visible = FALSE; // Disable update for API request
			else
				$this->Cities->setFormValue($val);
		}

		// Check field name 'name_accountable' first before field var 'x_name_accountable'
		$val = $CurrentForm->hasValue("name_accountable") ? $CurrentForm->getValue("name_accountable") : $CurrentForm->getValue("x_name_accountable");
		if (!$this->name_accountable->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->name_accountable->Visible = FALSE; // Disable update for API request
			else
				$this->name_accountable->setFormValue($val);
		}

		// Check field name 'Designation' first before field var 'x_Designation'
		$val = $CurrentForm->hasValue("Designation") ? $CurrentForm->getValue("Designation") : $CurrentForm->getValue("x_Designation");
		if (!$this->Designation->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Designation->Visible = FALSE; // Disable update for API request
			else
				$this->Designation->setFormValue($val);
		}

		// Check field name 'Current_Location' first before field var 'x_Current_Location'
		$val = $CurrentForm->hasValue("Current_Location") ? $CurrentForm->getValue("Current_Location") : $CurrentForm->getValue("x_Current_Location");
		if (!$this->Current_Location->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Current_Location->Visible = FALSE; // Disable update for API request
			else
				$this->Current_Location->setFormValue($val);
		}

		// Check field name 'Last_Date_Check' first before field var 'x_Last_Date_Check'
		$val = $CurrentForm->hasValue("Last_Date_Check") ? $CurrentForm->getValue("Last_Date_Check") : $CurrentForm->getValue("x_Last_Date_Check");
		if (!$this->Last_Date_Check->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Last_Date_Check->Visible = FALSE; // Disable update for API request
			else
				$this->Last_Date_Check->setFormValue($val);
			$this->Last_Date_Check->CurrentValue = UnFormatDateTime($this->Last_Date_Check->CurrentValue, 5);
		}

		// Check field name 'employee_id' first before field var 'x_employee_id'
		$val = $CurrentForm->hasValue("employee_id") ? $CurrentForm->getValue("employee_id") : $CurrentForm->getValue("x_employee_id");
		if (!$this->employee_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->employee_id->Visible = FALSE; // Disable update for API request
			else
				$this->employee_id->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'remarks' first before field var 'x_remarks'
		$val = $CurrentForm->hasValue("remarks") ? $CurrentForm->getValue("remarks") : $CurrentForm->getValue("x_remarks");
		if (!$this->remarks->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->remarks->Visible = FALSE; // Disable update for API request
			else
				$this->remarks->setFormValue($val);
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
			$this->date_last_modify->CurrentValue = UnFormatDateTime($this->date_last_modify->CurrentValue, 109);
		}

		// Check field name 'pullout_i' first before field var 'x_pullout_i'
		$val = $CurrentForm->hasValue("pullout_i") ? $CurrentForm->getValue("pullout_i") : $CurrentForm->getValue("x_pullout_i");
		if (!$this->pullout_i->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pullout_i->Visible = FALSE; // Disable update for API request
			else
				$this->pullout_i->setFormValue($val);
		}

		// Check field name 'signatureID' first before field var 'x_signatureID'
		$val = $CurrentForm->hasValue("signatureID") ? $CurrentForm->getValue("signatureID") : $CurrentForm->getValue("x_signatureID");
		if (!$this->signatureID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->signatureID->Visible = FALSE; // Disable update for API request
			else
				$this->signatureID->setFormValue($val);
		}

		// Check field name 'inventory_id' first before field var 'x_inventory_id'
		$val = $CurrentForm->hasValue("inventory_id") ? $CurrentForm->getValue("inventory_id") : $CurrentForm->getValue("x_inventory_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Month_Purchased->CurrentValue = $this->Month_Purchased->FormValue;
		$this->Year_Purchased->CurrentValue = $this->Year_Purchased->FormValue;
		$this->item_type->CurrentValue = $this->item_type->FormValue;
		$this->item_model->CurrentValue = $this->item_model->FormValue;
		$this->item_serial->CurrentValue = $this->item_serial->FormValue;
		$this->office_id->CurrentValue = $this->office_id->FormValue;
		$this->Region->CurrentValue = $this->Region->FormValue;
		$this->Province->CurrentValue = $this->Province->FormValue;
		$this->Cities->CurrentValue = $this->Cities->FormValue;
		$this->name_accountable->CurrentValue = $this->name_accountable->FormValue;
		$this->Designation->CurrentValue = $this->Designation->FormValue;
		$this->Current_Location->CurrentValue = $this->Current_Location->FormValue;
		$this->Last_Date_Check->CurrentValue = $this->Last_Date_Check->FormValue;
		$this->Last_Date_Check->CurrentValue = UnFormatDateTime($this->Last_Date_Check->CurrentValue, 5);
		$this->employee_id->CurrentValue = $this->employee_id->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->remarks->CurrentValue = $this->remarks->FormValue;
		$this->user_last_modify->CurrentValue = $this->user_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = $this->date_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = UnFormatDateTime($this->date_last_modify->CurrentValue, 109);
		$this->pullout_i->CurrentValue = $this->pullout_i->FormValue;
		$this->signatureID->CurrentValue = $this->signatureID->FormValue;
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
		$this->inventory_id->setDbValue($row['inventory_id']);
		$this->concat_inventory->setDbValue($row['concat_inventory']);
		$this->Month_Purchased->setDbValue($row['Month_Purchased']);
		$this->Year_Purchased->setDbValue($row['Year_Purchased']);
		$this->item_type->setDbValue($row['item_type']);
		$this->item_model->setDbValue($row['item_model']);
		$this->item_serial->setDbValue($row['item_serial']);
		$this->office_id->setDbValue($row['office_id']);
		$this->Region->setDbValue($row['Region']);
		$this->Province->setDbValue($row['Province']);
		$this->Cities->setDbValue($row['Cities']);
		$this->name_accountable->setDbValue($row['name_accountable']);
		$this->Designation->setDbValue($row['Designation']);
		$this->Current_Location->setDbValue($row['Current_Location']);
		$this->Last_Date_Check->setDbValue($row['Last_Date_Check']);
		$this->employee_id->setDbValue($row['employee_id']);
		$this->status->setDbValue($row['status']);
		$this->remarks->setDbValue($row['remarks']);
		$this->picture->Upload->DbValue = $row['picture'];
		if (is_array($this->picture->Upload->DbValue) || is_object($this->picture->Upload->DbValue)) // Byte array
			$this->picture->Upload->DbValue = BytesToString($this->picture->Upload->DbValue);
		$this->picture_size->setDbValue($row['picture_size']);
		$this->picture_name->setDbValue($row['picture_name']);
		$this->picture_type->setDbValue($row['picture_type']);
		$this->picture_width->setDbValue($row['picture_width']);
		$this->picture_height->setDbValue($row['picture_height']);
		$this->Tansmiss_Automatic->setDbValue($row['Tansmiss_Automatic']);
		$this->user_last_modify->setDbValue($row['user_last_modify']);
		$this->date_last_modify->setDbValue($row['date_last_modify']);
		$this->item_id->setDbValue($row['item_id']);
		$this->pullout_date->setDbValue($row['pullout_date']);
		$this->pullout_i->setDbValue($row['pullout_i']);
		$this->signatureID->setDbValue($row['signatureID']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['inventory_id'] = $this->inventory_id->CurrentValue;
		$row['concat_inventory'] = $this->concat_inventory->CurrentValue;
		$row['Month_Purchased'] = $this->Month_Purchased->CurrentValue;
		$row['Year_Purchased'] = $this->Year_Purchased->CurrentValue;
		$row['item_type'] = $this->item_type->CurrentValue;
		$row['item_model'] = $this->item_model->CurrentValue;
		$row['item_serial'] = $this->item_serial->CurrentValue;
		$row['office_id'] = $this->office_id->CurrentValue;
		$row['Region'] = $this->Region->CurrentValue;
		$row['Province'] = $this->Province->CurrentValue;
		$row['Cities'] = $this->Cities->CurrentValue;
		$row['name_accountable'] = $this->name_accountable->CurrentValue;
		$row['Designation'] = $this->Designation->CurrentValue;
		$row['Current_Location'] = $this->Current_Location->CurrentValue;
		$row['Last_Date_Check'] = $this->Last_Date_Check->CurrentValue;
		$row['employee_id'] = $this->employee_id->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['remarks'] = $this->remarks->CurrentValue;
		$row['picture'] = $this->picture->Upload->DbValue;
		$row['picture_size'] = $this->picture_size->CurrentValue;
		$row['picture_name'] = $this->picture_name->CurrentValue;
		$row['picture_type'] = $this->picture_type->CurrentValue;
		$row['picture_width'] = $this->picture_width->CurrentValue;
		$row['picture_height'] = $this->picture_height->CurrentValue;
		$row['Tansmiss_Automatic'] = $this->Tansmiss_Automatic->CurrentValue;
		$row['user_last_modify'] = $this->user_last_modify->CurrentValue;
		$row['date_last_modify'] = $this->date_last_modify->CurrentValue;
		$row['item_id'] = $this->item_id->CurrentValue;
		$row['pullout_date'] = $this->pullout_date->CurrentValue;
		$row['pullout_i'] = $this->pullout_i->CurrentValue;
		$row['signatureID'] = $this->signatureID->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("inventory_id")) != "")
			$this->inventory_id->OldValue = $this->getKey("inventory_id"); // inventory_id
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
		// inventory_id
		// concat_inventory
		// Month_Purchased
		// Year_Purchased
		// item_type
		// item_model
		// item_serial
		// office_id
		// Region
		// Province
		// Cities
		// name_accountable
		// Designation
		// Current_Location
		// Last_Date_Check
		// employee_id
		// status
		// remarks
		// picture
		// picture_size
		// picture_name
		// picture_type
		// picture_width
		// picture_height
		// Tansmiss_Automatic
		// user_last_modify
		// date_last_modify
		// item_id
		// pullout_date
		// pullout_i
		// signatureID

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// inventory_id
			$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
			$this->inventory_id->ViewCustomAttributes = "";

			// Month_Purchased
			$curVal = strval($this->Month_Purchased->CurrentValue);
			if ($curVal != "") {
				$this->Month_Purchased->ViewValue = $this->Month_Purchased->lookupCacheOption($curVal);
				if ($this->Month_Purchased->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`month_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Month_Purchased->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->Month_Purchased->ViewValue = $this->Month_Purchased->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Month_Purchased->ViewValue = $this->Month_Purchased->CurrentValue;
					}
				}
			} else {
				$this->Month_Purchased->ViewValue = NULL;
			}
			$this->Month_Purchased->ViewCustomAttributes = "";

			// Year_Purchased
			$curVal = strval($this->Year_Purchased->CurrentValue);
			if ($curVal != "") {
				$this->Year_Purchased->ViewValue = $this->Year_Purchased->lookupCacheOption($curVal);
				if ($this->Year_Purchased->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`year_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Year_Purchased->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->Year_Purchased->ViewValue = $this->Year_Purchased->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Year_Purchased->ViewValue = $this->Year_Purchased->CurrentValue;
					}
				}
			} else {
				$this->Year_Purchased->ViewValue = NULL;
			}
			$this->Year_Purchased->ViewCustomAttributes = "";

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

			// item_serial
			$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
			$this->item_serial->ViewCustomAttributes = "";

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

			// Current_Location
			$curVal = strval($this->Current_Location->CurrentValue);
			if ($curVal != "") {
				$this->Current_Location->ViewValue = $this->Current_Location->lookupCacheOption($curVal);
				if ($this->Current_Location->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`current_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Current_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Current_Location->ViewValue = $this->Current_Location->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Current_Location->ViewValue = $this->Current_Location->CurrentValue;
					}
				}
			} else {
				$this->Current_Location->ViewValue = NULL;
			}
			$this->Current_Location->ViewCustomAttributes = "";

			// Last_Date_Check
			$this->Last_Date_Check->ViewValue = $this->Last_Date_Check->CurrentValue;
			$this->Last_Date_Check->ViewValue = FormatDateTime($this->Last_Date_Check->ViewValue, 5);
			$this->Last_Date_Check->ViewCustomAttributes = "";

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
			$this->employee_id->ViewCustomAttributes = "";

			// status
			$curVal = strval($this->status->CurrentValue);
			if ($curVal != "") {
				$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
				if ($this->status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`inventory_status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

			// remarks
			$this->remarks->ViewValue = $this->remarks->CurrentValue;
			$this->remarks->ViewCustomAttributes = "";

			// picture
			if (!EmptyValue($this->picture->Upload->DbValue)) {
				$this->picture->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
				$this->picture->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
				$this->picture->ImageAlt = $this->picture->alt();
				$this->picture->ViewValue = $this->inventory_id->CurrentValue;
				$this->picture->IsBlobImage = IsImageFile(ContentExtension($this->picture->Upload->DbValue));
				$this->picture->Upload->FileName = $this->picture_type->CurrentValue;
			} else {
				$this->picture->ViewValue = "";
			}
			$this->picture->ViewCustomAttributes = "";

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
			$this->date_last_modify->ViewCustomAttributes = "";

			// item_id
			$this->item_id->ViewValue = $this->item_id->CurrentValue;
			$this->item_id->ViewCustomAttributes = "";

			// pullout_date
			$this->pullout_date->ViewValue = $this->pullout_date->CurrentValue;
			$this->pullout_date->ViewValue = FormatDateTime($this->pullout_date->ViewValue, 5);
			$this->pullout_date->ViewCustomAttributes = "";

			// pullout_i
			$this->pullout_i->ViewValue = $this->pullout_i->CurrentValue;
			$this->pullout_i->ViewCustomAttributes = "";

			// signatureID
			$this->signatureID->ViewValue = $this->signatureID->CurrentValue;
			$this->signatureID->ViewValue = FormatNumber($this->signatureID->ViewValue, 0, -2, -2, -2);
			$this->signatureID->ViewCustomAttributes = "";

			// Month_Purchased
			$this->Month_Purchased->LinkCustomAttributes = "";
			$this->Month_Purchased->HrefValue = "";
			$this->Month_Purchased->TooltipValue = "";

			// Year_Purchased
			$this->Year_Purchased->LinkCustomAttributes = "";
			$this->Year_Purchased->HrefValue = "";
			$this->Year_Purchased->TooltipValue = "";

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

			// office_id
			$this->office_id->LinkCustomAttributes = "";
			$this->office_id->HrefValue = "";
			$this->office_id->TooltipValue = "";

			// Region
			$this->Region->LinkCustomAttributes = "";
			$this->Region->HrefValue = "";
			$this->Region->TooltipValue = "";

			// Province
			$this->Province->LinkCustomAttributes = "";
			$this->Province->HrefValue = "";
			$this->Province->TooltipValue = "";

			// Cities
			$this->Cities->LinkCustomAttributes = "";
			$this->Cities->HrefValue = "";
			$this->Cities->TooltipValue = "";

			// name_accountable
			$this->name_accountable->LinkCustomAttributes = "";
			$this->name_accountable->HrefValue = "";
			$this->name_accountable->TooltipValue = "";

			// Designation
			$this->Designation->LinkCustomAttributes = "";
			$this->Designation->HrefValue = "";
			$this->Designation->TooltipValue = "";

			// Current_Location
			$this->Current_Location->LinkCustomAttributes = "";
			$this->Current_Location->HrefValue = "";
			$this->Current_Location->TooltipValue = "";

			// Last_Date_Check
			$this->Last_Date_Check->LinkCustomAttributes = "";
			$this->Last_Date_Check->HrefValue = "";
			$this->Last_Date_Check->TooltipValue = "";

			// employee_id
			$this->employee_id->LinkCustomAttributes = "";
			$this->employee_id->HrefValue = "";
			$this->employee_id->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// remarks
			$this->remarks->LinkCustomAttributes = "";
			$this->remarks->HrefValue = "";
			$this->remarks->TooltipValue = "";

			// picture
			$this->picture->LinkCustomAttributes = "";
			if (!empty($this->picture->Upload->DbValue)) {
				$this->picture->HrefValue = GetFileUploadUrl($this->picture, $this->inventory_id->CurrentValue);
				$this->picture->LinkAttrs["target"] = "_blank";
				if ($this->picture->IsBlobImage && empty($this->picture->LinkAttrs["target"]))
					$this->picture->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->picture->HrefValue = FullUrl($this->picture->HrefValue, "href");
			} else {
				$this->picture->HrefValue = "";
			}
			$this->picture->ExportHrefValue = GetFileUploadUrl($this->picture, $this->inventory_id->CurrentValue);
			$this->picture->TooltipValue = "";
			if ($this->picture->UseColorbox) {
				if (EmptyValue($this->picture->TooltipValue))
					$this->picture->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->picture->LinkAttrs["data-rel"] = "tbl_inventory_x_picture";
				$this->picture->LinkAttrs->appendClass("ew-lightbox");
			}

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";

			// pullout_i
			$this->pullout_i->LinkCustomAttributes = "";
			$this->pullout_i->HrefValue = "";
			$this->pullout_i->TooltipValue = "";

			// signatureID
			$this->signatureID->LinkCustomAttributes = "";
			$this->signatureID->HrefValue = "";
			$this->signatureID->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Month_Purchased
			$this->Month_Purchased->EditAttrs["class"] = "form-control";
			$this->Month_Purchased->EditCustomAttributes = "";
			$curVal = trim(strval($this->Month_Purchased->CurrentValue));
			if ($curVal != "")
				$this->Month_Purchased->ViewValue = $this->Month_Purchased->lookupCacheOption($curVal);
			else
				$this->Month_Purchased->ViewValue = $this->Month_Purchased->Lookup !== NULL && is_array($this->Month_Purchased->Lookup->Options) ? $curVal : NULL;
			if ($this->Month_Purchased->ViewValue !== NULL) { // Load from cache
				$this->Month_Purchased->EditValue = array_values($this->Month_Purchased->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`month_id`" . SearchString("=", $this->Month_Purchased->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Month_Purchased->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Month_Purchased->EditValue = $arwrk;
			}

			// Year_Purchased
			$this->Year_Purchased->EditAttrs["class"] = "form-control";
			$this->Year_Purchased->EditCustomAttributes = "";
			$curVal = trim(strval($this->Year_Purchased->CurrentValue));
			if ($curVal != "")
				$this->Year_Purchased->ViewValue = $this->Year_Purchased->lookupCacheOption($curVal);
			else
				$this->Year_Purchased->ViewValue = $this->Year_Purchased->Lookup !== NULL && is_array($this->Year_Purchased->Lookup->Options) ? $curVal : NULL;
			if ($this->Year_Purchased->ViewValue !== NULL) { // Load from cache
				$this->Year_Purchased->EditValue = array_values($this->Year_Purchased->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`year_id`" . SearchString("=", $this->Year_Purchased->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Year_Purchased->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Year_Purchased->EditValue = $arwrk;
			}

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

			// Region
			$this->Region->EditAttrs["class"] = "form-control";
			$this->Region->EditCustomAttributes = "";
			$curVal = trim(strval($this->Region->CurrentValue));
			if ($curVal != "")
				$this->Region->ViewValue = $this->Region->lookupCacheOption($curVal);
			else
				$this->Region->ViewValue = $this->Region->Lookup !== NULL && is_array($this->Region->Lookup->Options) ? $curVal : NULL;
			if ($this->Region->ViewValue !== NULL) { // Load from cache
				$this->Region->EditValue = array_values($this->Region->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`region_code`" . SearchString("=", $this->Region->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "region_name = 'REGION VI [Western Visayas]'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Region->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Region->EditValue = $arwrk;
			}

			// Province
			$this->Province->EditAttrs["class"] = "form-control";
			$this->Province->EditCustomAttributes = "";
			$curVal = trim(strval($this->Province->CurrentValue));
			if ($curVal != "")
				$this->Province->ViewValue = $this->Province->lookupCacheOption($curVal);
			else
				$this->Province->ViewValue = $this->Province->Lookup !== NULL && is_array($this->Province->Lookup->Options) ? $curVal : NULL;
			if ($this->Province->ViewValue !== NULL) { // Load from cache
				$this->Province->EditValue = array_values($this->Province->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`prov_code`" . SearchString("=", $this->Province->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Province->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Province->EditValue = $arwrk;
			}

			// Cities
			$this->Cities->EditAttrs["class"] = "form-control";
			$this->Cities->EditCustomAttributes = "";
			$curVal = trim(strval($this->Cities->CurrentValue));
			if ($curVal != "")
				$this->Cities->ViewValue = $this->Cities->lookupCacheOption($curVal);
			else
				$this->Cities->ViewValue = $this->Cities->Lookup !== NULL && is_array($this->Cities->Lookup->Options) ? $curVal : NULL;
			if ($this->Cities->ViewValue !== NULL) { // Load from cache
				$this->Cities->EditValue = array_values($this->Cities->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`city_code`" . SearchString("=", $this->Cities->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Cities->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Cities->EditValue = $arwrk;
			}

			// name_accountable
			$this->name_accountable->EditAttrs["class"] = "form-control";
			$this->name_accountable->EditCustomAttributes = "";
			$curVal = trim(strval($this->name_accountable->CurrentValue));
			if ($curVal != "")
				$this->name_accountable->ViewValue = $this->name_accountable->lookupCacheOption($curVal);
			else
				$this->name_accountable->ViewValue = $this->name_accountable->Lookup !== NULL && is_array($this->name_accountable->Lookup->Options) ? $curVal : NULL;
			if ($this->name_accountable->ViewValue !== NULL) { // Load from cache
				$this->name_accountable->EditValue = array_values($this->name_accountable->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`name_id`" . SearchString("=", $this->name_accountable->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->name_accountable->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->name_accountable->EditValue = $arwrk;
			}

			// Designation
			$this->Designation->EditAttrs["class"] = "form-control";
			$this->Designation->EditCustomAttributes = "";
			$curVal = trim(strval($this->Designation->CurrentValue));
			if ($curVal != "")
				$this->Designation->ViewValue = $this->Designation->lookupCacheOption($curVal);
			else
				$this->Designation->ViewValue = $this->Designation->Lookup !== NULL && is_array($this->Designation->Lookup->Options) ? $curVal : NULL;
			if ($this->Designation->ViewValue !== NULL) { // Load from cache
				$this->Designation->EditValue = array_values($this->Designation->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`pos_id`" . SearchString("=", $this->Designation->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Designation->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Designation->EditValue = $arwrk;
			}

			// Current_Location
			$this->Current_Location->EditAttrs["class"] = "form-control";
			$this->Current_Location->EditCustomAttributes = "";
			$curVal = trim(strval($this->Current_Location->CurrentValue));
			if ($curVal != "")
				$this->Current_Location->ViewValue = $this->Current_Location->lookupCacheOption($curVal);
			else
				$this->Current_Location->ViewValue = $this->Current_Location->Lookup !== NULL && is_array($this->Current_Location->Lookup->Options) ? $curVal : NULL;
			if ($this->Current_Location->ViewValue !== NULL) { // Load from cache
				$this->Current_Location->EditValue = array_values($this->Current_Location->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`current_id`" . SearchString("=", $this->Current_Location->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Current_Location->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Current_Location->EditValue = $arwrk;
			}

			// Last_Date_Check
			$this->Last_Date_Check->EditAttrs["class"] = "form-control";
			$this->Last_Date_Check->EditCustomAttributes = "";
			$this->Last_Date_Check->EditValue = HtmlEncode(FormatDateTime($this->Last_Date_Check->CurrentValue, 5));
			$this->Last_Date_Check->PlaceHolder = RemoveHtml($this->Last_Date_Check->caption());

			// employee_id
			$this->employee_id->EditAttrs["class"] = "form-control";
			$this->employee_id->EditCustomAttributes = "";
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
					$filterWrk = "`inventory_status_id`" . SearchString("=", $this->status->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->status->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->status->EditValue = $arwrk;
			}

			// remarks
			$this->remarks->EditAttrs["class"] = "form-control";
			$this->remarks->EditCustomAttributes = "";
			$this->remarks->EditValue = HtmlEncode($this->remarks->CurrentValue);
			$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

			// picture
			$this->picture->EditAttrs["class"] = "form-control";
			$this->picture->EditCustomAttributes = "";
			if (!EmptyValue($this->picture->Upload->DbValue)) {
				$this->picture->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
				$this->picture->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
				$this->picture->ImageAlt = $this->picture->alt();
				$this->picture->EditValue = $this->inventory_id->CurrentValue;
				$this->picture->IsBlobImage = IsImageFile(ContentExtension($this->picture->Upload->DbValue));
				$this->picture->Upload->FileName = $this->picture_type->CurrentValue;
			} else {
				$this->picture->EditValue = "";
			}
			if (!EmptyValue($this->picture_type->CurrentValue))
					$this->picture->Upload->FileName = $this->picture_type->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->picture);

			// user_last_modify
			// date_last_modify
			// pullout_i

			$this->pullout_i->EditAttrs["class"] = "form-control";
			$this->pullout_i->EditCustomAttributes = "";
			if (!$this->pullout_i->Raw)
				$this->pullout_i->CurrentValue = HtmlDecode($this->pullout_i->CurrentValue);
			$this->pullout_i->EditValue = HtmlEncode($this->pullout_i->CurrentValue);
			$this->pullout_i->PlaceHolder = RemoveHtml($this->pullout_i->caption());

			// signatureID
			$this->signatureID->EditAttrs["class"] = "form-control";
			$this->signatureID->EditCustomAttributes = "";
			$this->signatureID->EditValue = HtmlEncode($this->signatureID->CurrentValue);
			$this->signatureID->PlaceHolder = RemoveHtml($this->signatureID->caption());

			// Add refer script
			// Month_Purchased

			$this->Month_Purchased->LinkCustomAttributes = "";
			$this->Month_Purchased->HrefValue = "";

			// Year_Purchased
			$this->Year_Purchased->LinkCustomAttributes = "";
			$this->Year_Purchased->HrefValue = "";

			// item_type
			$this->item_type->LinkCustomAttributes = "";
			$this->item_type->HrefValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";

			// item_serial
			$this->item_serial->LinkCustomAttributes = "";
			$this->item_serial->HrefValue = "";

			// office_id
			$this->office_id->LinkCustomAttributes = "";
			$this->office_id->HrefValue = "";

			// Region
			$this->Region->LinkCustomAttributes = "";
			$this->Region->HrefValue = "";

			// Province
			$this->Province->LinkCustomAttributes = "";
			$this->Province->HrefValue = "";

			// Cities
			$this->Cities->LinkCustomAttributes = "";
			$this->Cities->HrefValue = "";

			// name_accountable
			$this->name_accountable->LinkCustomAttributes = "";
			$this->name_accountable->HrefValue = "";

			// Designation
			$this->Designation->LinkCustomAttributes = "";
			$this->Designation->HrefValue = "";

			// Current_Location
			$this->Current_Location->LinkCustomAttributes = "";
			$this->Current_Location->HrefValue = "";

			// Last_Date_Check
			$this->Last_Date_Check->LinkCustomAttributes = "";
			$this->Last_Date_Check->HrefValue = "";

			// employee_id
			$this->employee_id->LinkCustomAttributes = "";
			$this->employee_id->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// remarks
			$this->remarks->LinkCustomAttributes = "";
			$this->remarks->HrefValue = "";

			// picture
			$this->picture->LinkCustomAttributes = "";
			if (!empty($this->picture->Upload->DbValue)) {
				$this->picture->HrefValue = GetFileUploadUrl($this->picture, $this->inventory_id->CurrentValue);
				$this->picture->LinkAttrs["target"] = "_blank";
				if ($this->picture->IsBlobImage && empty($this->picture->LinkAttrs["target"]))
					$this->picture->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->picture->HrefValue = FullUrl($this->picture->HrefValue, "href");
			} else {
				$this->picture->HrefValue = "";
			}
			$this->picture->ExportHrefValue = GetFileUploadUrl($this->picture, $this->inventory_id->CurrentValue);

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";

			// pullout_i
			$this->pullout_i->LinkCustomAttributes = "";
			$this->pullout_i->HrefValue = "";

			// signatureID
			$this->signatureID->LinkCustomAttributes = "";
			$this->signatureID->HrefValue = "";
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
		if ($this->Month_Purchased->Required) {
			if (!$this->Month_Purchased->IsDetailKey && $this->Month_Purchased->FormValue != NULL && $this->Month_Purchased->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Month_Purchased->caption(), $this->Month_Purchased->RequiredErrorMessage));
			}
		}
		if ($this->Year_Purchased->Required) {
			if (!$this->Year_Purchased->IsDetailKey && $this->Year_Purchased->FormValue != NULL && $this->Year_Purchased->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Year_Purchased->caption(), $this->Year_Purchased->RequiredErrorMessage));
			}
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
		if ($this->office_id->Required) {
			if (!$this->office_id->IsDetailKey && $this->office_id->FormValue != NULL && $this->office_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->office_id->caption(), $this->office_id->RequiredErrorMessage));
			}
		}
		if ($this->Region->Required) {
			if (!$this->Region->IsDetailKey && $this->Region->FormValue != NULL && $this->Region->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Region->caption(), $this->Region->RequiredErrorMessage));
			}
		}
		if ($this->Province->Required) {
			if (!$this->Province->IsDetailKey && $this->Province->FormValue != NULL && $this->Province->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Province->caption(), $this->Province->RequiredErrorMessage));
			}
		}
		if ($this->Cities->Required) {
			if (!$this->Cities->IsDetailKey && $this->Cities->FormValue != NULL && $this->Cities->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Cities->caption(), $this->Cities->RequiredErrorMessage));
			}
		}
		if ($this->name_accountable->Required) {
			if (!$this->name_accountable->IsDetailKey && $this->name_accountable->FormValue != NULL && $this->name_accountable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->name_accountable->caption(), $this->name_accountable->RequiredErrorMessage));
			}
		}
		if ($this->Designation->Required) {
			if (!$this->Designation->IsDetailKey && $this->Designation->FormValue != NULL && $this->Designation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Designation->caption(), $this->Designation->RequiredErrorMessage));
			}
		}
		if ($this->Current_Location->Required) {
			if (!$this->Current_Location->IsDetailKey && $this->Current_Location->FormValue != NULL && $this->Current_Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Current_Location->caption(), $this->Current_Location->RequiredErrorMessage));
			}
		}
		if ($this->Last_Date_Check->Required) {
			if (!$this->Last_Date_Check->IsDetailKey && $this->Last_Date_Check->FormValue != NULL && $this->Last_Date_Check->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Last_Date_Check->caption(), $this->Last_Date_Check->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->Last_Date_Check->FormValue)) {
			AddMessage($FormError, $this->Last_Date_Check->errorMessage());
		}
		if ($this->employee_id->Required) {
			if (!$this->employee_id->IsDetailKey && $this->employee_id->FormValue != NULL && $this->employee_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->employee_id->caption(), $this->employee_id->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->remarks->Required) {
			if (!$this->remarks->IsDetailKey && $this->remarks->FormValue != NULL && $this->remarks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->remarks->caption(), $this->remarks->RequiredErrorMessage));
			}
		}
		if ($this->picture->Required) {
			if ($this->picture->Upload->FileName == "" && !$this->picture->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->picture->caption(), $this->picture->RequiredErrorMessage));
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
		if ($this->pullout_i->Required) {
			if (!$this->pullout_i->IsDetailKey && $this->pullout_i->FormValue != NULL && $this->pullout_i->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pullout_i->caption(), $this->pullout_i->RequiredErrorMessage));
			}
		}
		if ($this->signatureID->Required) {
			if (!$this->signatureID->IsDetailKey && $this->signatureID->FormValue != NULL && $this->signatureID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->signatureID->caption(), $this->signatureID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->signatureID->FormValue)) {
			AddMessage($FormError, $this->signatureID->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("tbl_repair", $detailTblVar) && $GLOBALS["tbl_repair"]->DetailAdd) {
			if (!isset($GLOBALS["tbl_repair_grid"]))
				$GLOBALS["tbl_repair_grid"] = new tbl_repair_grid(); // Get detail page object
			$GLOBALS["tbl_repair_grid"]->validateGridForm();
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
		if ($this->item_serial->CurrentValue != "") { // Check field with unique index
			$filter = "(`item_serial` = '" . AdjustSql($this->item_serial->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->item_serial->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->item_serial->CurrentValue, $idxErrMsg);
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

		// Month_Purchased
		$this->Month_Purchased->setDbValueDef($rsnew, $this->Month_Purchased->CurrentValue, NULL, FALSE);

		// Year_Purchased
		$this->Year_Purchased->setDbValueDef($rsnew, $this->Year_Purchased->CurrentValue, NULL, FALSE);

		// item_type
		$this->item_type->setDbValueDef($rsnew, $this->item_type->CurrentValue, NULL, FALSE);

		// item_model
		$this->item_model->setDbValueDef($rsnew, $this->item_model->CurrentValue, NULL, FALSE);

		// item_serial
		$this->item_serial->setDbValueDef($rsnew, $this->item_serial->CurrentValue, NULL, FALSE);

		// office_id
		$this->office_id->setDbValueDef($rsnew, $this->office_id->CurrentValue, NULL, FALSE);

		// Region
		$this->Region->setDbValueDef($rsnew, $this->Region->CurrentValue, NULL, FALSE);

		// Province
		$this->Province->setDbValueDef($rsnew, $this->Province->CurrentValue, NULL, FALSE);

		// Cities
		$this->Cities->setDbValueDef($rsnew, $this->Cities->CurrentValue, NULL, FALSE);

		// name_accountable
		$this->name_accountable->setDbValueDef($rsnew, $this->name_accountable->CurrentValue, NULL, FALSE);

		// Designation
		$this->Designation->setDbValueDef($rsnew, $this->Designation->CurrentValue, NULL, FALSE);

		// Current_Location
		$this->Current_Location->setDbValueDef($rsnew, $this->Current_Location->CurrentValue, NULL, FALSE);

		// Last_Date_Check
		$this->Last_Date_Check->setDbValueDef($rsnew, UnFormatDateTime($this->Last_Date_Check->CurrentValue, 5), NULL, FALSE);

		// employee_id
		$this->employee_id->setDbValueDef($rsnew, $this->employee_id->CurrentValue, NULL, FALSE);

		// status
		$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, FALSE);

		// remarks
		$this->remarks->setDbValueDef($rsnew, $this->remarks->CurrentValue, NULL, FALSE);

		// picture
		if ($this->picture->Visible && !$this->picture->Upload->KeepFile) {
			if ($this->picture->Upload->Value == NULL) {
				$rsnew['picture'] = NULL;
			} else {
				$this->picture->Upload->Resize(300, 0);
				$this->picture->ImageWidth = 300; // Resize width
				$this->picture->ImageHeight = 0; // Resize height
				$rsnew['picture'] = $this->picture->Upload->Value;
			}
			$this->picture_type->setDbValueDef($rsnew, $this->picture->Upload->FileName, NULL, FALSE);
			$this->picture_name->setDbValueDef($rsnew, trim($this->picture->Upload->ContentType), NULL, FALSE);
			$this->picture_size->setDbValueDef($rsnew, $this->picture->Upload->FileSize, NULL, FALSE);
			$this->picture_width->setDbValueDef($rsnew, $this->picture->Upload->ImageWidth, NULL, FALSE);
			$this->picture_height->setDbValueDef($rsnew, $this->picture->Upload->ImageHeight, NULL, FALSE);
		}

		// user_last_modify
		$this->user_last_modify->CurrentValue = CurrentUserName();
		$this->user_last_modify->setDbValueDef($rsnew, $this->user_last_modify->CurrentValue, NULL);

		// date_last_modify
		$this->date_last_modify->CurrentValue = CurrentDateTime();
		$this->date_last_modify->setDbValueDef($rsnew, $this->date_last_modify->CurrentValue, NULL);

		// pullout_i
		$this->pullout_i->setDbValueDef($rsnew, $this->pullout_i->CurrentValue, NULL, FALSE);

		// signatureID
		$this->signatureID->setDbValueDef($rsnew, $this->signatureID->CurrentValue, NULL, FALSE);

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
			if (in_array("tbl_repair", $detailTblVar) && $GLOBALS["tbl_repair"]->DetailAdd) {
				$GLOBALS["tbl_repair"]->itemtype->setSessionValue($this->item_type->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->itemmodel->setSessionValue($this->item_model->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->item_serial->setSessionValue($this->item_serial->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->office_id->setSessionValue($this->office_id->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->name_accountable->setSessionValue($this->name_accountable->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->Designation->setSessionValue($this->Designation->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->region->setSessionValue($this->Region->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->province->setSessionValue($this->Province->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->city->setSessionValue($this->Cities->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->inventory_id->setSessionValue($this->concat_inventory->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->inventory_idr->setSessionValue($this->inventory_id->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->current_loc_r->setSessionValue($this->Current_Location->CurrentValue); // Set master key
				$GLOBALS["tbl_repair"]->date_received->setSessionValue($this->Last_Date_Check->CurrentValue); // Set master key
				if (!isset($GLOBALS["tbl_repair_grid"]))
					$GLOBALS["tbl_repair_grid"] = new tbl_repair_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "tbl_repair"); // Load user level of detail table
				$addRow = $GLOBALS["tbl_repair_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["tbl_repair"]->itemtype->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->itemmodel->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->item_serial->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->office_id->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->name_accountable->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->Designation->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->region->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->province->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->city->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->inventory_id->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->inventory_idr->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->current_loc_r->setSessionValue(""); // Clear master key if insert failed
					$GLOBALS["tbl_repair"]->date_received->setSessionValue(""); // Clear master key if insert failed
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

			// picture
			CleanUploadTempPath($this->picture, $this->picture->Upload->Index);
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
			if (in_array("tbl_repair", $detailTblVar)) {
				if (!isset($GLOBALS["tbl_repair_grid"]))
					$GLOBALS["tbl_repair_grid"] = new tbl_repair_grid();
				if ($GLOBALS["tbl_repair_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["tbl_repair_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["tbl_repair_grid"]->CurrentMode = "add";
					$GLOBALS["tbl_repair_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["tbl_repair_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["tbl_repair_grid"]->setStartRecordNumber(1);
					$GLOBALS["tbl_repair_grid"]->itemtype->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->itemtype->CurrentValue = $this->item_type->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->itemtype->setSessionValue($GLOBALS["tbl_repair_grid"]->itemtype->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->itemmodel->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->itemmodel->CurrentValue = $this->item_model->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->itemmodel->setSessionValue($GLOBALS["tbl_repair_grid"]->itemmodel->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->item_serial->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->item_serial->CurrentValue = $this->item_serial->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->item_serial->setSessionValue($GLOBALS["tbl_repair_grid"]->item_serial->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->office_id->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->office_id->CurrentValue = $this->office_id->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->office_id->setSessionValue($GLOBALS["tbl_repair_grid"]->office_id->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->name_accountable->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->name_accountable->CurrentValue = $this->name_accountable->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->name_accountable->setSessionValue($GLOBALS["tbl_repair_grid"]->name_accountable->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->Designation->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->Designation->CurrentValue = $this->Designation->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->Designation->setSessionValue($GLOBALS["tbl_repair_grid"]->Designation->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->region->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->region->CurrentValue = $this->Region->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->region->setSessionValue($GLOBALS["tbl_repair_grid"]->region->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->province->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->province->CurrentValue = $this->Province->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->province->setSessionValue($GLOBALS["tbl_repair_grid"]->province->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->city->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->city->CurrentValue = $this->Cities->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->city->setSessionValue($GLOBALS["tbl_repair_grid"]->city->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->inventory_id->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->inventory_id->CurrentValue = $this->concat_inventory->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->inventory_id->setSessionValue($GLOBALS["tbl_repair_grid"]->inventory_id->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->inventory_idr->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->inventory_idr->CurrentValue = $this->inventory_id->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->inventory_idr->setSessionValue($GLOBALS["tbl_repair_grid"]->inventory_idr->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->current_loc_r->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->current_loc_r->CurrentValue = $this->Current_Location->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->current_loc_r->setSessionValue($GLOBALS["tbl_repair_grid"]->current_loc_r->CurrentValue);
					$GLOBALS["tbl_repair_grid"]->date_received->IsDetailKey = TRUE;
					$GLOBALS["tbl_repair_grid"]->date_received->CurrentValue = $this->Last_Date_Check->CurrentValue;
					$GLOBALS["tbl_repair_grid"]->date_received->setSessionValue($GLOBALS["tbl_repair_grid"]->date_received->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_inventorylist.php"), "", $this->TableVar, TRUE);
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
				case "x_Month_Purchased":
					break;
				case "x_Year_Purchased":
					break;
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
				case "x_name_accountable":
					break;
				case "x_Designation":
					break;
				case "x_Current_Location":
					break;
				case "x_employee_id":
					break;
				case "x_status":
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
						case "x_Month_Purchased":
							break;
						case "x_Year_Purchased":
							break;
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
						case "x_name_accountable":
							break;
						case "x_Designation":
							break;
						case "x_Current_Location":
							break;
						case "x_employee_id":
							break;
						case "x_status":
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

		//echo "Page Load";
	$this->Month_Purchased->DisplayValueSeparator = "-";
	$this->Year_Purchased->DisplayValueSeparator = "-";

	//$this->item_type->DisplayValueSeparator = "-";
	//$this->office_id->DisplayValueSeparator = "-";
	//$this->Region->DisplayValueSeparator = "-";
	//$this->Province->DisplayValueSeparator = "-";
	//$this->Cities->DisplayValueSeparator = "-";
	//$this->Current_Location->DisplayValueSeparator = "-";

	$this->employee_id->DisplayValueSeparator = "-";
	$this->status->DisplayValueSeparator = "-";
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