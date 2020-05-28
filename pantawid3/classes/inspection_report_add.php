<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class inspection_report_add extends inspection_report
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'inspection_report';

	// Page object name
	public $PageObjName = "inspection_report_add";

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

		// Table object (inspection_report)
		if (!isset($GLOBALS["inspection_report"]) || get_class($GLOBALS["inspection_report"]) == PROJECT_NAMESPACE . "inspection_report") {
			$GLOBALS["inspection_report"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inspection_report"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'inspection_report');

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
		global $inspection_report;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($inspection_report);
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
					if ($pageName == "inspection_reportview.php")
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->item_id->Visible = FALSE;
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
					$this->terminate(GetUrl("inspection_reportlist.php"));
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
		$this->item_date_repaired->setVisibility();
		$this->item_model->setVisibility();
		$this->item_serno->setVisibility();
		$this->Current_loc->Visible = FALSE;
		$this->item_transmittal->setVisibility();
		$this->position->setVisibility();
		$this->item_type_problem->setVisibility();
		$this->item_action_taken->setVisibility();
		$this->remarks->setVisibility();
		$this->SRN->setVisibility();
		$this->inventory_id->setVisibility();
		$this->month->setVisibility();
		$this->Year->setVisibility();
		$this->item_date_receive->setVisibility();
		$this->Date_Finished->setVisibility();
		$this->item_date_pullout->setVisibility();
		$this->__Request->setVisibility();
		$this->item_type->setVisibility();
		$this->item_requested_unit->setVisibility();
		$this->Region->setVisibility();
		$this->Province->setVisibility();
		$this->Cities->setVisibility();
		$this->technician_name->setVisibility();
		$this->employeeid->setVisibility();
		$this->status_id->setVisibility();
		$this->Contact_no->setVisibility();
		$this->user_last_modify->setVisibility();
		$this->date_last_modify->setVisibility();
		$this->inventory_idt->setVisibility();
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
		$this->setupLookupOptions($this->Current_loc);
		$this->setupLookupOptions($this->item_transmittal);
		$this->setupLookupOptions($this->position);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("inspection_reportlist.php");
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
					$this->terminate("inspection_reportlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "inspection_reportlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "inspection_reportview.php")
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
		$this->item_date_repaired->CurrentValue = date("Y/m/d");
		$this->item_model->CurrentValue = NULL;
		$this->item_model->OldValue = $this->item_model->CurrentValue;
		$this->item_serno->CurrentValue = NULL;
		$this->item_serno->OldValue = $this->item_serno->CurrentValue;
		$this->Current_loc->CurrentValue = NULL;
		$this->Current_loc->OldValue = $this->Current_loc->CurrentValue;
		$this->item_transmittal->CurrentValue = NULL;
		$this->item_transmittal->OldValue = $this->item_transmittal->CurrentValue;
		$this->position->CurrentValue = NULL;
		$this->position->OldValue = $this->position->CurrentValue;
		$this->item_type_problem->CurrentValue = NULL;
		$this->item_type_problem->OldValue = $this->item_type_problem->CurrentValue;
		$this->item_action_taken->CurrentValue = NULL;
		$this->item_action_taken->OldValue = $this->item_action_taken->CurrentValue;
		$this->remarks->CurrentValue = NULL;
		$this->remarks->OldValue = $this->remarks->CurrentValue;
		$this->SRN->CurrentValue = NULL;
		$this->SRN->OldValue = $this->SRN->CurrentValue;
		$this->inventory_id->CurrentValue = NULL;
		$this->inventory_id->OldValue = $this->inventory_id->CurrentValue;
		$this->month->CurrentValue = NULL;
		$this->month->OldValue = $this->month->CurrentValue;
		$this->Year->CurrentValue = NULL;
		$this->Year->OldValue = $this->Year->CurrentValue;
		$this->item_date_receive->CurrentValue = NULL;
		$this->item_date_receive->OldValue = $this->item_date_receive->CurrentValue;
		$this->Date_Finished->CurrentValue = NULL;
		$this->Date_Finished->OldValue = $this->Date_Finished->CurrentValue;
		$this->item_date_pullout->CurrentValue = NULL;
		$this->item_date_pullout->OldValue = $this->item_date_pullout->CurrentValue;
		$this->__Request->CurrentValue = NULL;
		$this->__Request->OldValue = $this->__Request->CurrentValue;
		$this->item_type->CurrentValue = NULL;
		$this->item_type->OldValue = $this->item_type->CurrentValue;
		$this->item_requested_unit->CurrentValue = NULL;
		$this->item_requested_unit->OldValue = $this->item_requested_unit->CurrentValue;
		$this->Region->CurrentValue = NULL;
		$this->Region->OldValue = $this->Region->CurrentValue;
		$this->Province->CurrentValue = NULL;
		$this->Province->OldValue = $this->Province->CurrentValue;
		$this->Cities->CurrentValue = NULL;
		$this->Cities->OldValue = $this->Cities->CurrentValue;
		$this->technician_name->CurrentValue = NULL;
		$this->technician_name->OldValue = $this->technician_name->CurrentValue;
		$this->employeeid->CurrentValue = NULL;
		$this->employeeid->OldValue = $this->employeeid->CurrentValue;
		$this->status_id->CurrentValue = NULL;
		$this->status_id->OldValue = $this->status_id->CurrentValue;
		$this->Contact_no->CurrentValue = NULL;
		$this->Contact_no->OldValue = $this->Contact_no->CurrentValue;
		$this->user_last_modify->CurrentValue = NULL;
		$this->user_last_modify->OldValue = $this->user_last_modify->CurrentValue;
		$this->date_last_modify->CurrentValue = NULL;
		$this->date_last_modify->OldValue = $this->date_last_modify->CurrentValue;
		$this->inventory_idt->CurrentValue = NULL;
		$this->inventory_idt->OldValue = $this->inventory_idt->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'item_date_repaired' first before field var 'x_item_date_repaired'
		$val = $CurrentForm->hasValue("item_date_repaired") ? $CurrentForm->getValue("item_date_repaired") : $CurrentForm->getValue("x_item_date_repaired");
		if (!$this->item_date_repaired->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_date_repaired->Visible = FALSE; // Disable update for API request
			else
				$this->item_date_repaired->setFormValue($val);
			$this->item_date_repaired->CurrentValue = UnFormatDateTime($this->item_date_repaired->CurrentValue, 7);
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

		// Check field name 'item_type_problem' first before field var 'x_item_type_problem'
		$val = $CurrentForm->hasValue("item_type_problem") ? $CurrentForm->getValue("item_type_problem") : $CurrentForm->getValue("x_item_type_problem");
		if (!$this->item_type_problem->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_type_problem->Visible = FALSE; // Disable update for API request
			else
				$this->item_type_problem->setFormValue($val);
		}

		// Check field name 'item_action_taken' first before field var 'x_item_action_taken'
		$val = $CurrentForm->hasValue("item_action_taken") ? $CurrentForm->getValue("item_action_taken") : $CurrentForm->getValue("x_item_action_taken");
		if (!$this->item_action_taken->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_action_taken->Visible = FALSE; // Disable update for API request
			else
				$this->item_action_taken->setFormValue($val);
		}

		// Check field name 'remarks' first before field var 'x_remarks'
		$val = $CurrentForm->hasValue("remarks") ? $CurrentForm->getValue("remarks") : $CurrentForm->getValue("x_remarks");
		if (!$this->remarks->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->remarks->Visible = FALSE; // Disable update for API request
			else
				$this->remarks->setFormValue($val);
		}

		// Check field name 'SRN' first before field var 'x_SRN'
		$val = $CurrentForm->hasValue("SRN") ? $CurrentForm->getValue("SRN") : $CurrentForm->getValue("x_SRN");
		if (!$this->SRN->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SRN->Visible = FALSE; // Disable update for API request
			else
				$this->SRN->setFormValue($val);
		}

		// Check field name 'inventory_id' first before field var 'x_inventory_id'
		$val = $CurrentForm->hasValue("inventory_id") ? $CurrentForm->getValue("inventory_id") : $CurrentForm->getValue("x_inventory_id");
		if (!$this->inventory_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->inventory_id->Visible = FALSE; // Disable update for API request
			else
				$this->inventory_id->setFormValue($val);
		}

		// Check field name 'month' first before field var 'x_month'
		$val = $CurrentForm->hasValue("month") ? $CurrentForm->getValue("month") : $CurrentForm->getValue("x_month");
		if (!$this->month->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->month->Visible = FALSE; // Disable update for API request
			else
				$this->month->setFormValue($val);
		}

		// Check field name 'Year' first before field var 'x_Year'
		$val = $CurrentForm->hasValue("Year") ? $CurrentForm->getValue("Year") : $CurrentForm->getValue("x_Year");
		if (!$this->Year->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Year->Visible = FALSE; // Disable update for API request
			else
				$this->Year->setFormValue($val);
		}

		// Check field name 'item_date_receive' first before field var 'x_item_date_receive'
		$val = $CurrentForm->hasValue("item_date_receive") ? $CurrentForm->getValue("item_date_receive") : $CurrentForm->getValue("x_item_date_receive");
		if (!$this->item_date_receive->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_date_receive->Visible = FALSE; // Disable update for API request
			else
				$this->item_date_receive->setFormValue($val);
			$this->item_date_receive->CurrentValue = UnFormatDateTime($this->item_date_receive->CurrentValue, 0);
		}

		// Check field name 'Date_Finished' first before field var 'x_Date_Finished'
		$val = $CurrentForm->hasValue("Date_Finished") ? $CurrentForm->getValue("Date_Finished") : $CurrentForm->getValue("x_Date_Finished");
		if (!$this->Date_Finished->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Date_Finished->Visible = FALSE; // Disable update for API request
			else
				$this->Date_Finished->setFormValue($val);
			$this->Date_Finished->CurrentValue = UnFormatDateTime($this->Date_Finished->CurrentValue, 0);
		}

		// Check field name 'item_date_pullout' first before field var 'x_item_date_pullout'
		$val = $CurrentForm->hasValue("item_date_pullout") ? $CurrentForm->getValue("item_date_pullout") : $CurrentForm->getValue("x_item_date_pullout");
		if (!$this->item_date_pullout->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_date_pullout->Visible = FALSE; // Disable update for API request
			else
				$this->item_date_pullout->setFormValue($val);
			$this->item_date_pullout->CurrentValue = UnFormatDateTime($this->item_date_pullout->CurrentValue, 0);
		}

		// Check field name 'Request' first before field var 'x___Request'
		$val = $CurrentForm->hasValue("Request") ? $CurrentForm->getValue("Request") : $CurrentForm->getValue("x___Request");
		if (!$this->__Request->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->__Request->Visible = FALSE; // Disable update for API request
			else
				$this->__Request->setFormValue($val);
		}

		// Check field name 'item_type' first before field var 'x_item_type'
		$val = $CurrentForm->hasValue("item_type") ? $CurrentForm->getValue("item_type") : $CurrentForm->getValue("x_item_type");
		if (!$this->item_type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_type->Visible = FALSE; // Disable update for API request
			else
				$this->item_type->setFormValue($val);
		}

		// Check field name 'item_requested_unit' first before field var 'x_item_requested_unit'
		$val = $CurrentForm->hasValue("item_requested_unit") ? $CurrentForm->getValue("item_requested_unit") : $CurrentForm->getValue("x_item_requested_unit");
		if (!$this->item_requested_unit->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->item_requested_unit->Visible = FALSE; // Disable update for API request
			else
				$this->item_requested_unit->setFormValue($val);
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

		// Check field name 'technician_name' first before field var 'x_technician_name'
		$val = $CurrentForm->hasValue("technician_name") ? $CurrentForm->getValue("technician_name") : $CurrentForm->getValue("x_technician_name");
		if (!$this->technician_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->technician_name->Visible = FALSE; // Disable update for API request
			else
				$this->technician_name->setFormValue($val);
		}

		// Check field name 'employeeid' first before field var 'x_employeeid'
		$val = $CurrentForm->hasValue("employeeid") ? $CurrentForm->getValue("employeeid") : $CurrentForm->getValue("x_employeeid");
		if (!$this->employeeid->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->employeeid->Visible = FALSE; // Disable update for API request
			else
				$this->employeeid->setFormValue($val);
		}

		// Check field name 'status_id' first before field var 'x_status_id'
		$val = $CurrentForm->hasValue("status_id") ? $CurrentForm->getValue("status_id") : $CurrentForm->getValue("x_status_id");
		if (!$this->status_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status_id->Visible = FALSE; // Disable update for API request
			else
				$this->status_id->setFormValue($val);
		}

		// Check field name 'Contact_no' first before field var 'x_Contact_no'
		$val = $CurrentForm->hasValue("Contact_no") ? $CurrentForm->getValue("Contact_no") : $CurrentForm->getValue("x_Contact_no");
		if (!$this->Contact_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Contact_no->Visible = FALSE; // Disable update for API request
			else
				$this->Contact_no->setFormValue($val);
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

		// Check field name 'inventory_idt' first before field var 'x_inventory_idt'
		$val = $CurrentForm->hasValue("inventory_idt") ? $CurrentForm->getValue("inventory_idt") : $CurrentForm->getValue("x_inventory_idt");
		if (!$this->inventory_idt->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->inventory_idt->Visible = FALSE; // Disable update for API request
			else
				$this->inventory_idt->setFormValue($val);
		}

		// Check field name 'item_id' first before field var 'x_item_id'
		$val = $CurrentForm->hasValue("item_id") ? $CurrentForm->getValue("item_id") : $CurrentForm->getValue("x_item_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->item_date_repaired->CurrentValue = $this->item_date_repaired->FormValue;
		$this->item_date_repaired->CurrentValue = UnFormatDateTime($this->item_date_repaired->CurrentValue, 7);
		$this->item_model->CurrentValue = $this->item_model->FormValue;
		$this->item_serno->CurrentValue = $this->item_serno->FormValue;
		$this->item_transmittal->CurrentValue = $this->item_transmittal->FormValue;
		$this->position->CurrentValue = $this->position->FormValue;
		$this->item_type_problem->CurrentValue = $this->item_type_problem->FormValue;
		$this->item_action_taken->CurrentValue = $this->item_action_taken->FormValue;
		$this->remarks->CurrentValue = $this->remarks->FormValue;
		$this->SRN->CurrentValue = $this->SRN->FormValue;
		$this->inventory_id->CurrentValue = $this->inventory_id->FormValue;
		$this->month->CurrentValue = $this->month->FormValue;
		$this->Year->CurrentValue = $this->Year->FormValue;
		$this->item_date_receive->CurrentValue = $this->item_date_receive->FormValue;
		$this->item_date_receive->CurrentValue = UnFormatDateTime($this->item_date_receive->CurrentValue, 0);
		$this->Date_Finished->CurrentValue = $this->Date_Finished->FormValue;
		$this->Date_Finished->CurrentValue = UnFormatDateTime($this->Date_Finished->CurrentValue, 0);
		$this->item_date_pullout->CurrentValue = $this->item_date_pullout->FormValue;
		$this->item_date_pullout->CurrentValue = UnFormatDateTime($this->item_date_pullout->CurrentValue, 0);
		$this->__Request->CurrentValue = $this->__Request->FormValue;
		$this->item_type->CurrentValue = $this->item_type->FormValue;
		$this->item_requested_unit->CurrentValue = $this->item_requested_unit->FormValue;
		$this->Region->CurrentValue = $this->Region->FormValue;
		$this->Province->CurrentValue = $this->Province->FormValue;
		$this->Cities->CurrentValue = $this->Cities->FormValue;
		$this->technician_name->CurrentValue = $this->technician_name->FormValue;
		$this->employeeid->CurrentValue = $this->employeeid->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->Contact_no->CurrentValue = $this->Contact_no->FormValue;
		$this->user_last_modify->CurrentValue = $this->user_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = $this->date_last_modify->FormValue;
		$this->date_last_modify->CurrentValue = UnFormatDateTime($this->date_last_modify->CurrentValue, 0);
		$this->inventory_idt->CurrentValue = $this->inventory_idt->FormValue;
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
		$this->item_date_repaired->setDbValue($row['item_date_repaired']);
		$this->item_model->setDbValue($row['item_model']);
		$this->item_serno->setDbValue($row['item_serno']);
		$this->Current_loc->setDbValue($row['Current_loc']);
		$this->item_transmittal->setDbValue($row['item_transmittal']);
		$this->position->setDbValue($row['position']);
		$this->item_type_problem->setDbValue($row['item_type_problem']);
		$this->item_action_taken->setDbValue($row['item_action_taken']);
		$this->remarks->setDbValue($row['remarks']);
		$this->SRN->setDbValue($row['SRN']);
		$this->inventory_id->setDbValue($row['inventory_id']);
		$this->month->setDbValue($row['month']);
		$this->Year->setDbValue($row['Year']);
		$this->item_date_receive->setDbValue($row['item_date_receive']);
		$this->Date_Finished->setDbValue($row['Date_Finished']);
		$this->item_date_pullout->setDbValue($row['item_date_pullout']);
		$this->__Request->setDbValue($row['Request']);
		$this->item_type->setDbValue($row['item_type']);
		$this->item_requested_unit->setDbValue($row['item_requested_unit']);
		$this->Region->setDbValue($row['Region']);
		$this->Province->setDbValue($row['Province']);
		$this->Cities->setDbValue($row['Cities']);
		$this->technician_name->setDbValue($row['technician_name']);
		$this->employeeid->setDbValue($row['employeeid']);
		$this->status_id->setDbValue($row['status_id']);
		$this->Contact_no->setDbValue($row['Contact_no']);
		$this->user_last_modify->setDbValue($row['user_last_modify']);
		$this->date_last_modify->setDbValue($row['date_last_modify']);
		$this->inventory_idt->setDbValue($row['inventory_idt']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['item_id'] = $this->item_id->CurrentValue;
		$row['item_date_repaired'] = $this->item_date_repaired->CurrentValue;
		$row['item_model'] = $this->item_model->CurrentValue;
		$row['item_serno'] = $this->item_serno->CurrentValue;
		$row['Current_loc'] = $this->Current_loc->CurrentValue;
		$row['item_transmittal'] = $this->item_transmittal->CurrentValue;
		$row['position'] = $this->position->CurrentValue;
		$row['item_type_problem'] = $this->item_type_problem->CurrentValue;
		$row['item_action_taken'] = $this->item_action_taken->CurrentValue;
		$row['remarks'] = $this->remarks->CurrentValue;
		$row['SRN'] = $this->SRN->CurrentValue;
		$row['inventory_id'] = $this->inventory_id->CurrentValue;
		$row['month'] = $this->month->CurrentValue;
		$row['Year'] = $this->Year->CurrentValue;
		$row['item_date_receive'] = $this->item_date_receive->CurrentValue;
		$row['Date_Finished'] = $this->Date_Finished->CurrentValue;
		$row['item_date_pullout'] = $this->item_date_pullout->CurrentValue;
		$row['Request'] = $this->__Request->CurrentValue;
		$row['item_type'] = $this->item_type->CurrentValue;
		$row['item_requested_unit'] = $this->item_requested_unit->CurrentValue;
		$row['Region'] = $this->Region->CurrentValue;
		$row['Province'] = $this->Province->CurrentValue;
		$row['Cities'] = $this->Cities->CurrentValue;
		$row['technician_name'] = $this->technician_name->CurrentValue;
		$row['employeeid'] = $this->employeeid->CurrentValue;
		$row['status_id'] = $this->status_id->CurrentValue;
		$row['Contact_no'] = $this->Contact_no->CurrentValue;
		$row['user_last_modify'] = $this->user_last_modify->CurrentValue;
		$row['date_last_modify'] = $this->date_last_modify->CurrentValue;
		$row['inventory_idt'] = $this->inventory_idt->CurrentValue;
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
		// item_date_repaired
		// item_model
		// item_serno
		// Current_loc
		// item_transmittal
		// position
		// item_type_problem
		// item_action_taken
		// remarks
		// SRN
		// inventory_id
		// month
		// Year
		// item_date_receive
		// Date_Finished
		// item_date_pullout
		// Request
		// item_type
		// item_requested_unit
		// Region
		// Province
		// Cities
		// technician_name
		// employeeid
		// status_id
		// Contact_no
		// user_last_modify
		// date_last_modify
		// inventory_idt

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// item_id
			$this->item_id->ViewValue = $this->item_id->CurrentValue;
			$this->item_id->ViewCustomAttributes = "";

			// item_date_repaired
			$this->item_date_repaired->ViewValue = $this->item_date_repaired->CurrentValue;
			$this->item_date_repaired->ViewValue = FormatDateTime($this->item_date_repaired->ViewValue, 7);
			$this->item_date_repaired->ViewCustomAttributes = "";

			// item_model
			$this->item_model->ViewValue = $this->item_model->CurrentValue;
			$this->item_model->ViewCustomAttributes = "";

			// item_serno
			$this->item_serno->ViewValue = $this->item_serno->CurrentValue;
			$this->item_serno->ViewCustomAttributes = "";

			// item_transmittal
			$curVal = strval($this->item_transmittal->CurrentValue);
			if ($curVal != "") {
				$this->item_transmittal->ViewValue = $this->item_transmittal->lookupCacheOption($curVal);
				if ($this->item_transmittal->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`name_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->item_transmittal->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->item_transmittal->ViewValue = $this->item_transmittal->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->item_transmittal->ViewValue = $this->item_transmittal->CurrentValue;
					}
				}
			} else {
				$this->item_transmittal->ViewValue = NULL;
			}
			$this->item_transmittal->ViewCustomAttributes = "";

			// position
			$curVal = strval($this->position->CurrentValue);
			if ($curVal != "") {
				$this->position->ViewValue = $this->position->lookupCacheOption($curVal);
				if ($this->position->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`pos_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->position->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->position->ViewValue = $this->position->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->position->ViewValue = $this->position->CurrentValue;
					}
				}
			} else {
				$this->position->ViewValue = NULL;
			}
			$this->position->ViewCustomAttributes = "";

			// item_type_problem
			$this->item_type_problem->ViewValue = $this->item_type_problem->CurrentValue;
			$this->item_type_problem->ViewCustomAttributes = "";

			// item_action_taken
			$this->item_action_taken->ViewValue = $this->item_action_taken->CurrentValue;
			$this->item_action_taken->ViewCustomAttributes = "";

			// remarks
			$this->remarks->ViewValue = $this->remarks->CurrentValue;
			$this->remarks->ViewCustomAttributes = "";

			// SRN
			$this->SRN->ViewValue = $this->SRN->CurrentValue;
			$this->SRN->ViewCustomAttributes = "";

			// inventory_id
			$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
			$this->inventory_id->ViewCustomAttributes = "";

			// month
			$this->month->ViewValue = $this->month->CurrentValue;
			$this->month->ViewValue = FormatNumber($this->month->ViewValue, 0, -2, -2, -2);
			$this->month->ViewCustomAttributes = "";

			// Year
			$this->Year->ViewValue = $this->Year->CurrentValue;
			$this->Year->ViewValue = FormatNumber($this->Year->ViewValue, 0, -2, -2, -2);
			$this->Year->ViewCustomAttributes = "";

			// item_date_receive
			$this->item_date_receive->ViewValue = $this->item_date_receive->CurrentValue;
			$this->item_date_receive->ViewValue = FormatDateTime($this->item_date_receive->ViewValue, 0);
			$this->item_date_receive->ViewCustomAttributes = "";

			// Date_Finished
			$this->Date_Finished->ViewValue = $this->Date_Finished->CurrentValue;
			$this->Date_Finished->ViewValue = FormatDateTime($this->Date_Finished->ViewValue, 0);
			$this->Date_Finished->ViewCustomAttributes = "";

			// item_date_pullout
			$this->item_date_pullout->ViewValue = $this->item_date_pullout->CurrentValue;
			$this->item_date_pullout->ViewValue = FormatDateTime($this->item_date_pullout->ViewValue, 0);
			$this->item_date_pullout->ViewCustomAttributes = "";

			// Request
			$this->__Request->ViewValue = $this->__Request->CurrentValue;
			$this->__Request->ViewValue = FormatNumber($this->__Request->ViewValue, 0, -2, -2, -2);
			$this->__Request->ViewCustomAttributes = "";

			// item_type
			$this->item_type->ViewValue = $this->item_type->CurrentValue;
			$this->item_type->ViewValue = FormatNumber($this->item_type->ViewValue, 0, -2, -2, -2);
			$this->item_type->ViewCustomAttributes = "";

			// item_requested_unit
			$this->item_requested_unit->ViewValue = $this->item_requested_unit->CurrentValue;
			$this->item_requested_unit->ViewValue = FormatNumber($this->item_requested_unit->ViewValue, 0, -2, -2, -2);
			$this->item_requested_unit->ViewCustomAttributes = "";

			// Region
			$this->Region->ViewValue = $this->Region->CurrentValue;
			$this->Region->ViewValue = FormatNumber($this->Region->ViewValue, 0, -2, -2, -2);
			$this->Region->ViewCustomAttributes = "";

			// Province
			$this->Province->ViewValue = $this->Province->CurrentValue;
			$this->Province->ViewValue = FormatNumber($this->Province->ViewValue, 0, -2, -2, -2);
			$this->Province->ViewCustomAttributes = "";

			// Cities
			$this->Cities->ViewValue = $this->Cities->CurrentValue;
			$this->Cities->ViewValue = FormatNumber($this->Cities->ViewValue, 0, -2, -2, -2);
			$this->Cities->ViewCustomAttributes = "";

			// technician_name
			$this->technician_name->ViewValue = $this->technician_name->CurrentValue;
			$this->technician_name->ViewValue = FormatNumber($this->technician_name->ViewValue, 0, -2, -2, -2);
			$this->technician_name->ViewCustomAttributes = "";

			// employeeid
			$this->employeeid->ViewValue = $this->employeeid->CurrentValue;
			$this->employeeid->ViewValue = FormatNumber($this->employeeid->ViewValue, 0, -2, -2, -2);
			$this->employeeid->ViewCustomAttributes = "";

			// status_id
			$this->status_id->ViewValue = $this->status_id->CurrentValue;
			$this->status_id->ViewValue = FormatNumber($this->status_id->ViewValue, 0, -2, -2, -2);
			$this->status_id->ViewCustomAttributes = "";

			// Contact_no
			$this->Contact_no->ViewValue = $this->Contact_no->CurrentValue;
			$this->Contact_no->ViewValue = FormatNumber($this->Contact_no->ViewValue, 0, -2, -2, -2);
			$this->Contact_no->ViewCustomAttributes = "";

			// user_last_modify
			$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
			$this->user_last_modify->ViewCustomAttributes = "";

			// date_last_modify
			$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
			$this->date_last_modify->ViewCustomAttributes = "";

			// inventory_idt
			$this->inventory_idt->ViewValue = $this->inventory_idt->CurrentValue;
			$this->inventory_idt->ViewCustomAttributes = "";

			// item_date_repaired
			$this->item_date_repaired->LinkCustomAttributes = "";
			$this->item_date_repaired->HrefValue = "";
			$this->item_date_repaired->TooltipValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";
			$this->item_model->TooltipValue = "";

			// item_serno
			$this->item_serno->LinkCustomAttributes = "";
			$this->item_serno->HrefValue = "";
			$this->item_serno->TooltipValue = "";

			// item_transmittal
			$this->item_transmittal->LinkCustomAttributes = "";
			$this->item_transmittal->HrefValue = "";
			$this->item_transmittal->TooltipValue = "";

			// position
			$this->position->LinkCustomAttributes = "";
			$this->position->HrefValue = "";
			$this->position->TooltipValue = "";

			// item_type_problem
			$this->item_type_problem->LinkCustomAttributes = "";
			$this->item_type_problem->HrefValue = "";
			$this->item_type_problem->TooltipValue = "";

			// item_action_taken
			$this->item_action_taken->LinkCustomAttributes = "";
			$this->item_action_taken->HrefValue = "";
			$this->item_action_taken->TooltipValue = "";

			// remarks
			$this->remarks->LinkCustomAttributes = "";
			$this->remarks->HrefValue = "";
			$this->remarks->TooltipValue = "";

			// SRN
			$this->SRN->LinkCustomAttributes = "";
			$this->SRN->HrefValue = "";
			$this->SRN->TooltipValue = "";

			// inventory_id
			$this->inventory_id->LinkCustomAttributes = "";
			$this->inventory_id->HrefValue = "";
			$this->inventory_id->TooltipValue = "";

			// month
			$this->month->LinkCustomAttributes = "";
			$this->month->HrefValue = "";
			$this->month->TooltipValue = "";

			// Year
			$this->Year->LinkCustomAttributes = "";
			$this->Year->HrefValue = "";
			$this->Year->TooltipValue = "";

			// item_date_receive
			$this->item_date_receive->LinkCustomAttributes = "";
			$this->item_date_receive->HrefValue = "";
			$this->item_date_receive->TooltipValue = "";

			// Date_Finished
			$this->Date_Finished->LinkCustomAttributes = "";
			$this->Date_Finished->HrefValue = "";
			$this->Date_Finished->TooltipValue = "";

			// item_date_pullout
			$this->item_date_pullout->LinkCustomAttributes = "";
			$this->item_date_pullout->HrefValue = "";
			$this->item_date_pullout->TooltipValue = "";

			// Request
			$this->__Request->LinkCustomAttributes = "";
			$this->__Request->HrefValue = "";
			$this->__Request->TooltipValue = "";

			// item_type
			$this->item_type->LinkCustomAttributes = "";
			$this->item_type->HrefValue = "";
			$this->item_type->TooltipValue = "";

			// item_requested_unit
			$this->item_requested_unit->LinkCustomAttributes = "";
			$this->item_requested_unit->HrefValue = "";
			$this->item_requested_unit->TooltipValue = "";

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

			// technician_name
			$this->technician_name->LinkCustomAttributes = "";
			$this->technician_name->HrefValue = "";
			$this->technician_name->TooltipValue = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";
			$this->employeeid->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// Contact_no
			$this->Contact_no->LinkCustomAttributes = "";
			$this->Contact_no->HrefValue = "";
			$this->Contact_no->TooltipValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";

			// inventory_idt
			$this->inventory_idt->LinkCustomAttributes = "";
			$this->inventory_idt->HrefValue = "";
			$this->inventory_idt->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// item_date_repaired
			$this->item_date_repaired->EditAttrs["class"] = "form-control";
			$this->item_date_repaired->EditCustomAttributes = "";
			$this->item_date_repaired->EditValue = HtmlEncode(FormatDateTime($this->item_date_repaired->CurrentValue, 7));
			$this->item_date_repaired->PlaceHolder = RemoveHtml($this->item_date_repaired->caption());

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

			// item_transmittal
			$this->item_transmittal->EditAttrs["class"] = "form-control";
			$this->item_transmittal->EditCustomAttributes = "";
			$curVal = trim(strval($this->item_transmittal->CurrentValue));
			if ($curVal != "")
				$this->item_transmittal->ViewValue = $this->item_transmittal->lookupCacheOption($curVal);
			else
				$this->item_transmittal->ViewValue = $this->item_transmittal->Lookup !== NULL && is_array($this->item_transmittal->Lookup->Options) ? $curVal : NULL;
			if ($this->item_transmittal->ViewValue !== NULL) { // Load from cache
				$this->item_transmittal->EditValue = array_values($this->item_transmittal->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`name_id`" . SearchString("=", $this->item_transmittal->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->item_transmittal->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->item_transmittal->EditValue = $arwrk;
			}

			// position
			$this->position->EditAttrs["class"] = "form-control";
			$this->position->EditCustomAttributes = "";
			$curVal = trim(strval($this->position->CurrentValue));
			if ($curVal != "")
				$this->position->ViewValue = $this->position->lookupCacheOption($curVal);
			else
				$this->position->ViewValue = $this->position->Lookup !== NULL && is_array($this->position->Lookup->Options) ? $curVal : NULL;
			if ($this->position->ViewValue !== NULL) { // Load from cache
				$this->position->EditValue = array_values($this->position->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`pos_id`" . SearchString("=", $this->position->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->position->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->position->EditValue = $arwrk;
			}

			// item_type_problem
			$this->item_type_problem->EditAttrs["class"] = "form-control";
			$this->item_type_problem->EditCustomAttributes = "";
			$this->item_type_problem->EditValue = HtmlEncode($this->item_type_problem->CurrentValue);
			$this->item_type_problem->PlaceHolder = RemoveHtml($this->item_type_problem->caption());

			// item_action_taken
			$this->item_action_taken->EditAttrs["class"] = "form-control";
			$this->item_action_taken->EditCustomAttributes = "";
			$this->item_action_taken->EditValue = HtmlEncode($this->item_action_taken->CurrentValue);
			$this->item_action_taken->PlaceHolder = RemoveHtml($this->item_action_taken->caption());

			// remarks
			$this->remarks->EditAttrs["class"] = "form-control";
			$this->remarks->EditCustomAttributes = "";
			$this->remarks->EditValue = HtmlEncode($this->remarks->CurrentValue);
			$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

			// SRN
			$this->SRN->EditAttrs["class"] = "form-control";
			$this->SRN->EditCustomAttributes = "";
			if (!$this->SRN->Raw)
				$this->SRN->CurrentValue = HtmlDecode($this->SRN->CurrentValue);
			$this->SRN->EditValue = HtmlEncode($this->SRN->CurrentValue);
			$this->SRN->PlaceHolder = RemoveHtml($this->SRN->caption());

			// inventory_id
			$this->inventory_id->EditAttrs["class"] = "form-control";
			$this->inventory_id->EditCustomAttributes = "";
			if (!$this->inventory_id->Raw)
				$this->inventory_id->CurrentValue = HtmlDecode($this->inventory_id->CurrentValue);
			$this->inventory_id->EditValue = HtmlEncode($this->inventory_id->CurrentValue);
			$this->inventory_id->PlaceHolder = RemoveHtml($this->inventory_id->caption());

			// month
			$this->month->EditAttrs["class"] = "form-control";
			$this->month->EditCustomAttributes = "";
			$this->month->EditValue = HtmlEncode($this->month->CurrentValue);
			$this->month->PlaceHolder = RemoveHtml($this->month->caption());

			// Year
			$this->Year->EditAttrs["class"] = "form-control";
			$this->Year->EditCustomAttributes = "";
			$this->Year->EditValue = HtmlEncode($this->Year->CurrentValue);
			$this->Year->PlaceHolder = RemoveHtml($this->Year->caption());

			// item_date_receive
			$this->item_date_receive->EditAttrs["class"] = "form-control";
			$this->item_date_receive->EditCustomAttributes = "";
			$this->item_date_receive->EditValue = HtmlEncode(FormatDateTime($this->item_date_receive->CurrentValue, 8));
			$this->item_date_receive->PlaceHolder = RemoveHtml($this->item_date_receive->caption());

			// Date_Finished
			$this->Date_Finished->EditAttrs["class"] = "form-control";
			$this->Date_Finished->EditCustomAttributes = "";
			$this->Date_Finished->EditValue = HtmlEncode(FormatDateTime($this->Date_Finished->CurrentValue, 8));
			$this->Date_Finished->PlaceHolder = RemoveHtml($this->Date_Finished->caption());

			// item_date_pullout
			$this->item_date_pullout->EditAttrs["class"] = "form-control";
			$this->item_date_pullout->EditCustomAttributes = "";
			$this->item_date_pullout->EditValue = HtmlEncode(FormatDateTime($this->item_date_pullout->CurrentValue, 8));
			$this->item_date_pullout->PlaceHolder = RemoveHtml($this->item_date_pullout->caption());

			// Request
			$this->__Request->EditAttrs["class"] = "form-control";
			$this->__Request->EditCustomAttributes = "";
			$this->__Request->EditValue = HtmlEncode($this->__Request->CurrentValue);
			$this->__Request->PlaceHolder = RemoveHtml($this->__Request->caption());

			// item_type
			$this->item_type->EditAttrs["class"] = "form-control";
			$this->item_type->EditCustomAttributes = "";
			$this->item_type->EditValue = HtmlEncode($this->item_type->CurrentValue);
			$this->item_type->PlaceHolder = RemoveHtml($this->item_type->caption());

			// item_requested_unit
			$this->item_requested_unit->EditAttrs["class"] = "form-control";
			$this->item_requested_unit->EditCustomAttributes = "";
			$this->item_requested_unit->EditValue = HtmlEncode($this->item_requested_unit->CurrentValue);
			$this->item_requested_unit->PlaceHolder = RemoveHtml($this->item_requested_unit->caption());

			// Region
			$this->Region->EditAttrs["class"] = "form-control";
			$this->Region->EditCustomAttributes = "";
			$this->Region->EditValue = HtmlEncode($this->Region->CurrentValue);
			$this->Region->PlaceHolder = RemoveHtml($this->Region->caption());

			// Province
			$this->Province->EditAttrs["class"] = "form-control";
			$this->Province->EditCustomAttributes = "";
			$this->Province->EditValue = HtmlEncode($this->Province->CurrentValue);
			$this->Province->PlaceHolder = RemoveHtml($this->Province->caption());

			// Cities
			$this->Cities->EditAttrs["class"] = "form-control";
			$this->Cities->EditCustomAttributes = "";
			$this->Cities->EditValue = HtmlEncode($this->Cities->CurrentValue);
			$this->Cities->PlaceHolder = RemoveHtml($this->Cities->caption());

			// technician_name
			$this->technician_name->EditAttrs["class"] = "form-control";
			$this->technician_name->EditCustomAttributes = "";
			$this->technician_name->EditValue = HtmlEncode($this->technician_name->CurrentValue);
			$this->technician_name->PlaceHolder = RemoveHtml($this->technician_name->caption());

			// employeeid
			$this->employeeid->EditAttrs["class"] = "form-control";
			$this->employeeid->EditCustomAttributes = "";
			$this->employeeid->EditValue = HtmlEncode($this->employeeid->CurrentValue);
			$this->employeeid->PlaceHolder = RemoveHtml($this->employeeid->caption());

			// status_id
			$this->status_id->EditAttrs["class"] = "form-control";
			$this->status_id->EditCustomAttributes = "";
			$this->status_id->EditValue = HtmlEncode($this->status_id->CurrentValue);
			$this->status_id->PlaceHolder = RemoveHtml($this->status_id->caption());

			// Contact_no
			$this->Contact_no->EditAttrs["class"] = "form-control";
			$this->Contact_no->EditCustomAttributes = "";
			$this->Contact_no->EditValue = HtmlEncode($this->Contact_no->CurrentValue);
			$this->Contact_no->PlaceHolder = RemoveHtml($this->Contact_no->caption());

			// user_last_modify
			$this->user_last_modify->EditAttrs["class"] = "form-control";
			$this->user_last_modify->EditCustomAttributes = "";
			if (!$this->user_last_modify->Raw)
				$this->user_last_modify->CurrentValue = HtmlDecode($this->user_last_modify->CurrentValue);
			$this->user_last_modify->EditValue = HtmlEncode($this->user_last_modify->CurrentValue);
			$this->user_last_modify->PlaceHolder = RemoveHtml($this->user_last_modify->caption());

			// date_last_modify
			$this->date_last_modify->EditAttrs["class"] = "form-control";
			$this->date_last_modify->EditCustomAttributes = "";
			$this->date_last_modify->EditValue = HtmlEncode(FormatDateTime($this->date_last_modify->CurrentValue, 8));
			$this->date_last_modify->PlaceHolder = RemoveHtml($this->date_last_modify->caption());

			// inventory_idt
			$this->inventory_idt->EditAttrs["class"] = "form-control";
			$this->inventory_idt->EditCustomAttributes = "";
			if (!$this->inventory_idt->Raw)
				$this->inventory_idt->CurrentValue = HtmlDecode($this->inventory_idt->CurrentValue);
			$this->inventory_idt->EditValue = HtmlEncode($this->inventory_idt->CurrentValue);
			$this->inventory_idt->PlaceHolder = RemoveHtml($this->inventory_idt->caption());

			// Add refer script
			// item_date_repaired

			$this->item_date_repaired->LinkCustomAttributes = "";
			$this->item_date_repaired->HrefValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";

			// item_serno
			$this->item_serno->LinkCustomAttributes = "";
			$this->item_serno->HrefValue = "";

			// item_transmittal
			$this->item_transmittal->LinkCustomAttributes = "";
			$this->item_transmittal->HrefValue = "";

			// position
			$this->position->LinkCustomAttributes = "";
			$this->position->HrefValue = "";

			// item_type_problem
			$this->item_type_problem->LinkCustomAttributes = "";
			$this->item_type_problem->HrefValue = "";

			// item_action_taken
			$this->item_action_taken->LinkCustomAttributes = "";
			$this->item_action_taken->HrefValue = "";

			// remarks
			$this->remarks->LinkCustomAttributes = "";
			$this->remarks->HrefValue = "";

			// SRN
			$this->SRN->LinkCustomAttributes = "";
			$this->SRN->HrefValue = "";

			// inventory_id
			$this->inventory_id->LinkCustomAttributes = "";
			$this->inventory_id->HrefValue = "";

			// month
			$this->month->LinkCustomAttributes = "";
			$this->month->HrefValue = "";

			// Year
			$this->Year->LinkCustomAttributes = "";
			$this->Year->HrefValue = "";

			// item_date_receive
			$this->item_date_receive->LinkCustomAttributes = "";
			$this->item_date_receive->HrefValue = "";

			// Date_Finished
			$this->Date_Finished->LinkCustomAttributes = "";
			$this->Date_Finished->HrefValue = "";

			// item_date_pullout
			$this->item_date_pullout->LinkCustomAttributes = "";
			$this->item_date_pullout->HrefValue = "";

			// Request
			$this->__Request->LinkCustomAttributes = "";
			$this->__Request->HrefValue = "";

			// item_type
			$this->item_type->LinkCustomAttributes = "";
			$this->item_type->HrefValue = "";

			// item_requested_unit
			$this->item_requested_unit->LinkCustomAttributes = "";
			$this->item_requested_unit->HrefValue = "";

			// Region
			$this->Region->LinkCustomAttributes = "";
			$this->Region->HrefValue = "";

			// Province
			$this->Province->LinkCustomAttributes = "";
			$this->Province->HrefValue = "";

			// Cities
			$this->Cities->LinkCustomAttributes = "";
			$this->Cities->HrefValue = "";

			// technician_name
			$this->technician_name->LinkCustomAttributes = "";
			$this->technician_name->HrefValue = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// Contact_no
			$this->Contact_no->LinkCustomAttributes = "";
			$this->Contact_no->HrefValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";

			// inventory_idt
			$this->inventory_idt->LinkCustomAttributes = "";
			$this->inventory_idt->HrefValue = "";
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
		if ($this->item_date_repaired->Required) {
			if (!$this->item_date_repaired->IsDetailKey && $this->item_date_repaired->FormValue != NULL && $this->item_date_repaired->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_date_repaired->caption(), $this->item_date_repaired->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->item_date_repaired->FormValue)) {
			AddMessage($FormError, $this->item_date_repaired->errorMessage());
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
		if ($this->item_type_problem->Required) {
			if (!$this->item_type_problem->IsDetailKey && $this->item_type_problem->FormValue != NULL && $this->item_type_problem->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_type_problem->caption(), $this->item_type_problem->RequiredErrorMessage));
			}
		}
		if ($this->item_action_taken->Required) {
			if (!$this->item_action_taken->IsDetailKey && $this->item_action_taken->FormValue != NULL && $this->item_action_taken->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_action_taken->caption(), $this->item_action_taken->RequiredErrorMessage));
			}
		}
		if ($this->remarks->Required) {
			if (!$this->remarks->IsDetailKey && $this->remarks->FormValue != NULL && $this->remarks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->remarks->caption(), $this->remarks->RequiredErrorMessage));
			}
		}
		if ($this->SRN->Required) {
			if (!$this->SRN->IsDetailKey && $this->SRN->FormValue != NULL && $this->SRN->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SRN->caption(), $this->SRN->RequiredErrorMessage));
			}
		}
		if ($this->inventory_id->Required) {
			if (!$this->inventory_id->IsDetailKey && $this->inventory_id->FormValue != NULL && $this->inventory_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->inventory_id->caption(), $this->inventory_id->RequiredErrorMessage));
			}
		}
		if ($this->month->Required) {
			if (!$this->month->IsDetailKey && $this->month->FormValue != NULL && $this->month->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->month->caption(), $this->month->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->month->FormValue)) {
			AddMessage($FormError, $this->month->errorMessage());
		}
		if ($this->Year->Required) {
			if (!$this->Year->IsDetailKey && $this->Year->FormValue != NULL && $this->Year->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Year->caption(), $this->Year->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Year->FormValue)) {
			AddMessage($FormError, $this->Year->errorMessage());
		}
		if ($this->item_date_receive->Required) {
			if (!$this->item_date_receive->IsDetailKey && $this->item_date_receive->FormValue != NULL && $this->item_date_receive->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_date_receive->caption(), $this->item_date_receive->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->item_date_receive->FormValue)) {
			AddMessage($FormError, $this->item_date_receive->errorMessage());
		}
		if ($this->Date_Finished->Required) {
			if (!$this->Date_Finished->IsDetailKey && $this->Date_Finished->FormValue != NULL && $this->Date_Finished->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Date_Finished->caption(), $this->Date_Finished->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Date_Finished->FormValue)) {
			AddMessage($FormError, $this->Date_Finished->errorMessage());
		}
		if ($this->item_date_pullout->Required) {
			if (!$this->item_date_pullout->IsDetailKey && $this->item_date_pullout->FormValue != NULL && $this->item_date_pullout->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_date_pullout->caption(), $this->item_date_pullout->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->item_date_pullout->FormValue)) {
			AddMessage($FormError, $this->item_date_pullout->errorMessage());
		}
		if ($this->__Request->Required) {
			if (!$this->__Request->IsDetailKey && $this->__Request->FormValue != NULL && $this->__Request->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->__Request->caption(), $this->__Request->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->__Request->FormValue)) {
			AddMessage($FormError, $this->__Request->errorMessage());
		}
		if ($this->item_type->Required) {
			if (!$this->item_type->IsDetailKey && $this->item_type->FormValue != NULL && $this->item_type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_type->caption(), $this->item_type->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->item_type->FormValue)) {
			AddMessage($FormError, $this->item_type->errorMessage());
		}
		if ($this->item_requested_unit->Required) {
			if (!$this->item_requested_unit->IsDetailKey && $this->item_requested_unit->FormValue != NULL && $this->item_requested_unit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->item_requested_unit->caption(), $this->item_requested_unit->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->item_requested_unit->FormValue)) {
			AddMessage($FormError, $this->item_requested_unit->errorMessage());
		}
		if ($this->Region->Required) {
			if (!$this->Region->IsDetailKey && $this->Region->FormValue != NULL && $this->Region->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Region->caption(), $this->Region->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Region->FormValue)) {
			AddMessage($FormError, $this->Region->errorMessage());
		}
		if ($this->Province->Required) {
			if (!$this->Province->IsDetailKey && $this->Province->FormValue != NULL && $this->Province->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Province->caption(), $this->Province->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Province->FormValue)) {
			AddMessage($FormError, $this->Province->errorMessage());
		}
		if ($this->Cities->Required) {
			if (!$this->Cities->IsDetailKey && $this->Cities->FormValue != NULL && $this->Cities->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Cities->caption(), $this->Cities->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Cities->FormValue)) {
			AddMessage($FormError, $this->Cities->errorMessage());
		}
		if ($this->technician_name->Required) {
			if (!$this->technician_name->IsDetailKey && $this->technician_name->FormValue != NULL && $this->technician_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->technician_name->caption(), $this->technician_name->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->technician_name->FormValue)) {
			AddMessage($FormError, $this->technician_name->errorMessage());
		}
		if ($this->employeeid->Required) {
			if (!$this->employeeid->IsDetailKey && $this->employeeid->FormValue != NULL && $this->employeeid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->employeeid->caption(), $this->employeeid->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->employeeid->FormValue)) {
			AddMessage($FormError, $this->employeeid->errorMessage());
		}
		if ($this->status_id->Required) {
			if (!$this->status_id->IsDetailKey && $this->status_id->FormValue != NULL && $this->status_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_id->caption(), $this->status_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->status_id->FormValue)) {
			AddMessage($FormError, $this->status_id->errorMessage());
		}
		if ($this->Contact_no->Required) {
			if (!$this->Contact_no->IsDetailKey && $this->Contact_no->FormValue != NULL && $this->Contact_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Contact_no->caption(), $this->Contact_no->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Contact_no->FormValue)) {
			AddMessage($FormError, $this->Contact_no->errorMessage());
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
		if (!CheckDate($this->date_last_modify->FormValue)) {
			AddMessage($FormError, $this->date_last_modify->errorMessage());
		}
		if ($this->inventory_idt->Required) {
			if (!$this->inventory_idt->IsDetailKey && $this->inventory_idt->FormValue != NULL && $this->inventory_idt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->inventory_idt->caption(), $this->inventory_idt->RequiredErrorMessage));
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

		// item_date_repaired
		$this->item_date_repaired->setDbValueDef($rsnew, UnFormatDateTime($this->item_date_repaired->CurrentValue, 7), NULL, FALSE);

		// item_model
		$this->item_model->setDbValueDef($rsnew, $this->item_model->CurrentValue, NULL, FALSE);

		// item_serno
		$this->item_serno->setDbValueDef($rsnew, $this->item_serno->CurrentValue, NULL, FALSE);

		// item_transmittal
		$this->item_transmittal->setDbValueDef($rsnew, $this->item_transmittal->CurrentValue, NULL, FALSE);

		// position
		$this->position->setDbValueDef($rsnew, $this->position->CurrentValue, NULL, FALSE);

		// item_type_problem
		$this->item_type_problem->setDbValueDef($rsnew, $this->item_type_problem->CurrentValue, NULL, FALSE);

		// item_action_taken
		$this->item_action_taken->setDbValueDef($rsnew, $this->item_action_taken->CurrentValue, NULL, FALSE);

		// remarks
		$this->remarks->setDbValueDef($rsnew, $this->remarks->CurrentValue, NULL, FALSE);

		// SRN
		$this->SRN->setDbValueDef($rsnew, $this->SRN->CurrentValue, NULL, FALSE);

		// inventory_id
		$this->inventory_id->setDbValueDef($rsnew, $this->inventory_id->CurrentValue, NULL, FALSE);

		// month
		$this->month->setDbValueDef($rsnew, $this->month->CurrentValue, NULL, FALSE);

		// Year
		$this->Year->setDbValueDef($rsnew, $this->Year->CurrentValue, NULL, FALSE);

		// item_date_receive
		$this->item_date_receive->setDbValueDef($rsnew, UnFormatDateTime($this->item_date_receive->CurrentValue, 0), NULL, FALSE);

		// Date_Finished
		$this->Date_Finished->setDbValueDef($rsnew, UnFormatDateTime($this->Date_Finished->CurrentValue, 0), NULL, FALSE);

		// item_date_pullout
		$this->item_date_pullout->setDbValueDef($rsnew, UnFormatDateTime($this->item_date_pullout->CurrentValue, 0), NULL, FALSE);

		// Request
		$this->__Request->setDbValueDef($rsnew, $this->__Request->CurrentValue, NULL, FALSE);

		// item_type
		$this->item_type->setDbValueDef($rsnew, $this->item_type->CurrentValue, NULL, FALSE);

		// item_requested_unit
		$this->item_requested_unit->setDbValueDef($rsnew, $this->item_requested_unit->CurrentValue, NULL, FALSE);

		// Region
		$this->Region->setDbValueDef($rsnew, $this->Region->CurrentValue, NULL, FALSE);

		// Province
		$this->Province->setDbValueDef($rsnew, $this->Province->CurrentValue, NULL, FALSE);

		// Cities
		$this->Cities->setDbValueDef($rsnew, $this->Cities->CurrentValue, NULL, FALSE);

		// technician_name
		$this->technician_name->setDbValueDef($rsnew, $this->technician_name->CurrentValue, NULL, FALSE);

		// employeeid
		$this->employeeid->setDbValueDef($rsnew, $this->employeeid->CurrentValue, NULL, FALSE);

		// status_id
		$this->status_id->setDbValueDef($rsnew, $this->status_id->CurrentValue, NULL, FALSE);

		// Contact_no
		$this->Contact_no->setDbValueDef($rsnew, $this->Contact_no->CurrentValue, NULL, FALSE);

		// user_last_modify
		$this->user_last_modify->setDbValueDef($rsnew, $this->user_last_modify->CurrentValue, NULL, FALSE);

		// date_last_modify
		$this->date_last_modify->setDbValueDef($rsnew, UnFormatDateTime($this->date_last_modify->CurrentValue, 0), NULL, FALSE);

		// inventory_idt
		$this->inventory_idt->setDbValueDef($rsnew, $this->inventory_idt->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("inspection_reportlist.php"), "", $this->TableVar, TRUE);
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
				case "x_Current_loc":
					break;
				case "x_item_transmittal":
					break;
				case "x_position":
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
						case "x_Current_loc":
							break;
						case "x_item_transmittal":
							break;
						case "x_position":
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