<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class inventory_reports_search extends inventory_reports
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'inventory reports';

	// Page object name
	public $PageObjName = "inventory_reports_search";

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

		// Table object (inventory_reports)
		if (!isset($GLOBALS["inventory_reports"]) || get_class($GLOBALS["inventory_reports"]) == PROJECT_NAMESPACE . "inventory_reports") {
			$GLOBALS["inventory_reports"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inventory_reports"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'inventory reports');

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
		global $inventory_reports;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($inventory_reports);
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
					if ($pageName == "inventory_reportsview.php")
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->inventory_id->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("inventory_reportslist.php"));
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
		$this->inventory_id->setVisibility();
		$this->month_dsc->setVisibility();
		$this->year_dsc->setVisibility();
		$this->cat_desc->setVisibility();
		$this->item_model->setVisibility();
		$this->item_serial->Visible = FALSE;
		$this->off_desc->setVisibility();
		$this->region_name->setVisibility();
		$this->prov_name->setVisibility();
		$this->city_name->setVisibility();
		$this->inventory_status_dsc->setVisibility();
		$this->Last_Date_Check->setVisibility();
		$this->remarks->Visible = FALSE;
		$this->Name_dsc->setVisibility();
		$this->user_last_modify->setVisibility();
		$this->date_last_modify->setVisibility();
		$this->pullout_date->setVisibility();
		$this->pos_desc->setVisibility();
		$this->current_location->setVisibility();
		$this->last_name->setVisibility();
		$this->first_name->setVisibility();
		$this->mid_name->setVisibility();
		$this->ext_name->setVisibility();
		$this->full_name->setVisibility();
		$this->full_name_tbl->setVisibility();
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
		// Set up Breadcrumb

		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "inventory_reportslist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->inventory_id); // inventory_id
		$this->buildSearchUrl($srchUrl, $this->month_dsc); // month_dsc
		$this->buildSearchUrl($srchUrl, $this->year_dsc); // year_dsc
		$this->buildSearchUrl($srchUrl, $this->cat_desc); // cat_desc
		$this->buildSearchUrl($srchUrl, $this->item_model); // item_model
		$this->buildSearchUrl($srchUrl, $this->off_desc); // off_desc
		$this->buildSearchUrl($srchUrl, $this->region_name); // region_name
		$this->buildSearchUrl($srchUrl, $this->prov_name); // prov_name
		$this->buildSearchUrl($srchUrl, $this->city_name); // city_name
		$this->buildSearchUrl($srchUrl, $this->inventory_status_dsc); // inventory_status_dsc
		$this->buildSearchUrl($srchUrl, $this->Last_Date_Check); // Last_Date_Check
		$this->buildSearchUrl($srchUrl, $this->Name_dsc); // Name_dsc
		$this->buildSearchUrl($srchUrl, $this->user_last_modify); // user_last_modify
		$this->buildSearchUrl($srchUrl, $this->date_last_modify); // date_last_modify
		$this->buildSearchUrl($srchUrl, $this->pullout_date); // pullout_date
		$this->buildSearchUrl($srchUrl, $this->pos_desc); // pos_desc
		$this->buildSearchUrl($srchUrl, $this->current_location); // current_location
		$this->buildSearchUrl($srchUrl, $this->last_name); // last_name
		$this->buildSearchUrl($srchUrl, $this->first_name); // first_name
		$this->buildSearchUrl($srchUrl, $this->mid_name); // mid_name
		$this->buildSearchUrl($srchUrl, $this->ext_name); // ext_name
		$this->buildSearchUrl($srchUrl, $this->full_name); // full_name
		$this->buildSearchUrl($srchUrl, $this->full_name_tbl); // full_name_tbl
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->inventory_id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->month_dsc->AdvancedSearch->post())
			$got = TRUE;
		if ($this->year_dsc->AdvancedSearch->post())
			$got = TRUE;
		if ($this->cat_desc->AdvancedSearch->post())
			$got = TRUE;
		if ($this->item_model->AdvancedSearch->post())
			$got = TRUE;
		if ($this->off_desc->AdvancedSearch->post())
			$got = TRUE;
		if ($this->region_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->prov_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->city_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->inventory_status_dsc->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Last_Date_Check->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Name_dsc->AdvancedSearch->post())
			$got = TRUE;
		if ($this->user_last_modify->AdvancedSearch->post())
			$got = TRUE;
		if ($this->date_last_modify->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pullout_date->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pos_desc->AdvancedSearch->post())
			$got = TRUE;
		if ($this->current_location->AdvancedSearch->post())
			$got = TRUE;
		if ($this->last_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->first_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->mid_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ext_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->full_name->AdvancedSearch->post())
			$got = TRUE;
		if ($this->full_name_tbl->AdvancedSearch->post())
			$got = TRUE;
		return $got;
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
		// month_dsc
		// year_dsc
		// cat_desc
		// item_model
		// item_serial
		// off_desc
		// region_name
		// prov_name
		// city_name
		// inventory_status_dsc
		// Last_Date_Check
		// remarks
		// Name_dsc
		// user_last_modify
		// date_last_modify
		// pullout_date
		// pos_desc
		// current_location
		// last_name
		// first_name
		// mid_name
		// ext_name
		// full_name
		// full_name_tbl

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// inventory_id
			$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
			$this->inventory_id->ViewCustomAttributes = "";

			// month_dsc
			$this->month_dsc->ViewValue = $this->month_dsc->CurrentValue;
			$this->month_dsc->ViewCustomAttributes = "";

			// year_dsc
			$this->year_dsc->ViewValue = $this->year_dsc->CurrentValue;
			$this->year_dsc->ViewCustomAttributes = "";

			// cat_desc
			$this->cat_desc->ViewValue = $this->cat_desc->CurrentValue;
			$this->cat_desc->ViewCustomAttributes = "";

			// item_model
			$this->item_model->ViewValue = $this->item_model->CurrentValue;
			$this->item_model->ViewCustomAttributes = "";

			// item_serial
			$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
			$this->item_serial->ViewCustomAttributes = "";

			// off_desc
			$this->off_desc->ViewValue = $this->off_desc->CurrentValue;
			$this->off_desc->ViewCustomAttributes = "";

			// region_name
			$this->region_name->ViewValue = $this->region_name->CurrentValue;
			$this->region_name->ViewCustomAttributes = "";

			// prov_name
			$this->prov_name->ViewValue = $this->prov_name->CurrentValue;
			$this->prov_name->ViewCustomAttributes = "";

			// city_name
			$this->city_name->ViewValue = $this->city_name->CurrentValue;
			$this->city_name->ViewCustomAttributes = "";

			// inventory_status_dsc
			$this->inventory_status_dsc->ViewValue = $this->inventory_status_dsc->CurrentValue;
			$this->inventory_status_dsc->ViewCustomAttributes = "";

			// Last_Date_Check
			$this->Last_Date_Check->ViewValue = $this->Last_Date_Check->CurrentValue;
			$this->Last_Date_Check->ViewValue = FormatDateTime($this->Last_Date_Check->ViewValue, 0);
			$this->Last_Date_Check->ViewCustomAttributes = "";

			// remarks
			$this->remarks->ViewValue = $this->remarks->CurrentValue;
			$this->remarks->ViewCustomAttributes = "";

			// Name_dsc
			$this->Name_dsc->ViewValue = $this->Name_dsc->CurrentValue;
			$this->Name_dsc->ViewCustomAttributes = "";

			// user_last_modify
			$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
			$this->user_last_modify->ViewCustomAttributes = "";

			// date_last_modify
			$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
			$this->date_last_modify->ViewCustomAttributes = "";

			// pullout_date
			$this->pullout_date->ViewValue = $this->pullout_date->CurrentValue;
			$this->pullout_date->ViewValue = FormatDateTime($this->pullout_date->ViewValue, 0);
			$this->pullout_date->ViewCustomAttributes = "";

			// pos_desc
			$this->pos_desc->ViewValue = $this->pos_desc->CurrentValue;
			$this->pos_desc->ViewCustomAttributes = "";

			// current_location
			$this->current_location->ViewValue = $this->current_location->CurrentValue;
			$this->current_location->ViewCustomAttributes = "";

			// last_name
			$this->last_name->ViewValue = $this->last_name->CurrentValue;
			$this->last_name->ViewCustomAttributes = "";

			// first_name
			$this->first_name->ViewValue = $this->first_name->CurrentValue;
			$this->first_name->ViewCustomAttributes = "";

			// mid_name
			$this->mid_name->ViewValue = $this->mid_name->CurrentValue;
			$this->mid_name->ViewCustomAttributes = "";

			// ext_name
			$this->ext_name->ViewValue = $this->ext_name->CurrentValue;
			$this->ext_name->ViewCustomAttributes = "";

			// full_name
			$this->full_name->ViewValue = $this->full_name->CurrentValue;
			$this->full_name->ViewCustomAttributes = "";

			// full_name_tbl
			$this->full_name_tbl->ViewValue = $this->full_name_tbl->CurrentValue;
			$this->full_name_tbl->ViewCustomAttributes = "";

			// inventory_id
			$this->inventory_id->LinkCustomAttributes = "";
			$this->inventory_id->HrefValue = "";
			$this->inventory_id->TooltipValue = "";

			// month_dsc
			$this->month_dsc->LinkCustomAttributes = "";
			$this->month_dsc->HrefValue = "";
			$this->month_dsc->TooltipValue = "";

			// year_dsc
			$this->year_dsc->LinkCustomAttributes = "";
			$this->year_dsc->HrefValue = "";
			$this->year_dsc->TooltipValue = "";

			// cat_desc
			$this->cat_desc->LinkCustomAttributes = "";
			$this->cat_desc->HrefValue = "";
			$this->cat_desc->TooltipValue = "";

			// item_model
			$this->item_model->LinkCustomAttributes = "";
			$this->item_model->HrefValue = "";
			$this->item_model->TooltipValue = "";

			// off_desc
			$this->off_desc->LinkCustomAttributes = "";
			$this->off_desc->HrefValue = "";
			$this->off_desc->TooltipValue = "";

			// region_name
			$this->region_name->LinkCustomAttributes = "";
			$this->region_name->HrefValue = "";
			$this->region_name->TooltipValue = "";

			// prov_name
			$this->prov_name->LinkCustomAttributes = "";
			$this->prov_name->HrefValue = "";
			$this->prov_name->TooltipValue = "";

			// city_name
			$this->city_name->LinkCustomAttributes = "";
			$this->city_name->HrefValue = "";
			$this->city_name->TooltipValue = "";

			// inventory_status_dsc
			$this->inventory_status_dsc->LinkCustomAttributes = "";
			$this->inventory_status_dsc->HrefValue = "";
			$this->inventory_status_dsc->TooltipValue = "";

			// Last_Date_Check
			$this->Last_Date_Check->LinkCustomAttributes = "";
			$this->Last_Date_Check->HrefValue = "";
			$this->Last_Date_Check->TooltipValue = "";

			// Name_dsc
			$this->Name_dsc->LinkCustomAttributes = "";
			$this->Name_dsc->HrefValue = "";
			$this->Name_dsc->TooltipValue = "";

			// user_last_modify
			$this->user_last_modify->LinkCustomAttributes = "";
			$this->user_last_modify->HrefValue = "";
			$this->user_last_modify->TooltipValue = "";

			// date_last_modify
			$this->date_last_modify->LinkCustomAttributes = "";
			$this->date_last_modify->HrefValue = "";
			$this->date_last_modify->TooltipValue = "";

			// pullout_date
			$this->pullout_date->LinkCustomAttributes = "";
			$this->pullout_date->HrefValue = "";
			$this->pullout_date->TooltipValue = "";

			// pos_desc
			$this->pos_desc->LinkCustomAttributes = "";
			$this->pos_desc->HrefValue = "";
			$this->pos_desc->TooltipValue = "";

			// current_location
			$this->current_location->LinkCustomAttributes = "";
			$this->current_location->HrefValue = "";
			$this->current_location->TooltipValue = "";

			// last_name
			$this->last_name->LinkCustomAttributes = "";
			$this->last_name->HrefValue = "";
			$this->last_name->TooltipValue = "";

			// first_name
			$this->first_name->LinkCustomAttributes = "";
			$this->first_name->HrefValue = "";
			$this->first_name->TooltipValue = "";

			// mid_name
			$this->mid_name->LinkCustomAttributes = "";
			$this->mid_name->HrefValue = "";
			$this->mid_name->TooltipValue = "";

			// ext_name
			$this->ext_name->LinkCustomAttributes = "";
			$this->ext_name->HrefValue = "";
			$this->ext_name->TooltipValue = "";

			// full_name
			$this->full_name->LinkCustomAttributes = "";
			$this->full_name->HrefValue = "";
			$this->full_name->TooltipValue = "";

			// full_name_tbl
			$this->full_name_tbl->LinkCustomAttributes = "";
			$this->full_name_tbl->HrefValue = "";
			$this->full_name_tbl->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// inventory_id
			$this->inventory_id->EditAttrs["class"] = "form-control";
			$this->inventory_id->EditCustomAttributes = "";
			$this->inventory_id->EditValue = HtmlEncode($this->inventory_id->AdvancedSearch->SearchValue);
			$this->inventory_id->PlaceHolder = RemoveHtml($this->inventory_id->caption());

			// month_dsc
			$this->month_dsc->EditAttrs["class"] = "form-control";
			$this->month_dsc->EditCustomAttributes = "";
			if (!$this->month_dsc->Raw)
				$this->month_dsc->AdvancedSearch->SearchValue = HtmlDecode($this->month_dsc->AdvancedSearch->SearchValue);
			$this->month_dsc->EditValue = HtmlEncode($this->month_dsc->AdvancedSearch->SearchValue);
			$this->month_dsc->PlaceHolder = RemoveHtml($this->month_dsc->caption());

			// year_dsc
			$this->year_dsc->EditAttrs["class"] = "form-control";
			$this->year_dsc->EditCustomAttributes = "";
			if (!$this->year_dsc->Raw)
				$this->year_dsc->AdvancedSearch->SearchValue = HtmlDecode($this->year_dsc->AdvancedSearch->SearchValue);
			$this->year_dsc->EditValue = HtmlEncode($this->year_dsc->AdvancedSearch->SearchValue);
			$this->year_dsc->PlaceHolder = RemoveHtml($this->year_dsc->caption());

			// cat_desc
			$this->cat_desc->EditAttrs["class"] = "form-control";
			$this->cat_desc->EditCustomAttributes = "";
			if (!$this->cat_desc->Raw)
				$this->cat_desc->AdvancedSearch->SearchValue = HtmlDecode($this->cat_desc->AdvancedSearch->SearchValue);
			$this->cat_desc->EditValue = HtmlEncode($this->cat_desc->AdvancedSearch->SearchValue);
			$this->cat_desc->PlaceHolder = RemoveHtml($this->cat_desc->caption());

			// item_model
			$this->item_model->EditAttrs["class"] = "form-control";
			$this->item_model->EditCustomAttributes = "";
			if (!$this->item_model->Raw)
				$this->item_model->AdvancedSearch->SearchValue = HtmlDecode($this->item_model->AdvancedSearch->SearchValue);
			$this->item_model->EditValue = HtmlEncode($this->item_model->AdvancedSearch->SearchValue);
			$this->item_model->PlaceHolder = RemoveHtml($this->item_model->caption());

			// off_desc
			$this->off_desc->EditAttrs["class"] = "form-control";
			$this->off_desc->EditCustomAttributes = "";
			if (!$this->off_desc->Raw)
				$this->off_desc->AdvancedSearch->SearchValue = HtmlDecode($this->off_desc->AdvancedSearch->SearchValue);
			$this->off_desc->EditValue = HtmlEncode($this->off_desc->AdvancedSearch->SearchValue);
			$this->off_desc->PlaceHolder = RemoveHtml($this->off_desc->caption());

			// region_name
			$this->region_name->EditAttrs["class"] = "form-control";
			$this->region_name->EditCustomAttributes = "";
			if (!$this->region_name->Raw)
				$this->region_name->AdvancedSearch->SearchValue = HtmlDecode($this->region_name->AdvancedSearch->SearchValue);
			$this->region_name->EditValue = HtmlEncode($this->region_name->AdvancedSearch->SearchValue);
			$this->region_name->PlaceHolder = RemoveHtml($this->region_name->caption());

			// prov_name
			$this->prov_name->EditAttrs["class"] = "form-control";
			$this->prov_name->EditCustomAttributes = "";
			if (!$this->prov_name->Raw)
				$this->prov_name->AdvancedSearch->SearchValue = HtmlDecode($this->prov_name->AdvancedSearch->SearchValue);
			$this->prov_name->EditValue = HtmlEncode($this->prov_name->AdvancedSearch->SearchValue);
			$this->prov_name->PlaceHolder = RemoveHtml($this->prov_name->caption());

			// city_name
			$this->city_name->EditAttrs["class"] = "form-control";
			$this->city_name->EditCustomAttributes = "";
			if (!$this->city_name->Raw)
				$this->city_name->AdvancedSearch->SearchValue = HtmlDecode($this->city_name->AdvancedSearch->SearchValue);
			$this->city_name->EditValue = HtmlEncode($this->city_name->AdvancedSearch->SearchValue);
			$this->city_name->PlaceHolder = RemoveHtml($this->city_name->caption());

			// inventory_status_dsc
			$this->inventory_status_dsc->EditAttrs["class"] = "form-control";
			$this->inventory_status_dsc->EditCustomAttributes = "";
			if (!$this->inventory_status_dsc->Raw)
				$this->inventory_status_dsc->AdvancedSearch->SearchValue = HtmlDecode($this->inventory_status_dsc->AdvancedSearch->SearchValue);
			$this->inventory_status_dsc->EditValue = HtmlEncode($this->inventory_status_dsc->AdvancedSearch->SearchValue);
			$this->inventory_status_dsc->PlaceHolder = RemoveHtml($this->inventory_status_dsc->caption());

			// Last_Date_Check
			$this->Last_Date_Check->EditAttrs["class"] = "form-control";
			$this->Last_Date_Check->EditCustomAttributes = "";
			$this->Last_Date_Check->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->Last_Date_Check->AdvancedSearch->SearchValue, 0), 8));
			$this->Last_Date_Check->PlaceHolder = RemoveHtml($this->Last_Date_Check->caption());

			// Name_dsc
			$this->Name_dsc->EditAttrs["class"] = "form-control";
			$this->Name_dsc->EditCustomAttributes = "";
			if (!$this->Name_dsc->Raw)
				$this->Name_dsc->AdvancedSearch->SearchValue = HtmlDecode($this->Name_dsc->AdvancedSearch->SearchValue);
			$this->Name_dsc->EditValue = HtmlEncode($this->Name_dsc->AdvancedSearch->SearchValue);
			$this->Name_dsc->PlaceHolder = RemoveHtml($this->Name_dsc->caption());

			// user_last_modify
			$this->user_last_modify->EditAttrs["class"] = "form-control";
			$this->user_last_modify->EditCustomAttributes = "";
			if (!$this->user_last_modify->Raw)
				$this->user_last_modify->AdvancedSearch->SearchValue = HtmlDecode($this->user_last_modify->AdvancedSearch->SearchValue);
			$this->user_last_modify->EditValue = HtmlEncode($this->user_last_modify->AdvancedSearch->SearchValue);
			$this->user_last_modify->PlaceHolder = RemoveHtml($this->user_last_modify->caption());

			// date_last_modify
			$this->date_last_modify->EditAttrs["class"] = "form-control";
			$this->date_last_modify->EditCustomAttributes = "";
			$this->date_last_modify->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->date_last_modify->AdvancedSearch->SearchValue, 0), 8));
			$this->date_last_modify->PlaceHolder = RemoveHtml($this->date_last_modify->caption());

			// pullout_date
			$this->pullout_date->EditAttrs["class"] = "form-control";
			$this->pullout_date->EditCustomAttributes = "";
			$this->pullout_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->pullout_date->AdvancedSearch->SearchValue, 0), 8));
			$this->pullout_date->PlaceHolder = RemoveHtml($this->pullout_date->caption());

			// pos_desc
			$this->pos_desc->EditAttrs["class"] = "form-control";
			$this->pos_desc->EditCustomAttributes = "";
			if (!$this->pos_desc->Raw)
				$this->pos_desc->AdvancedSearch->SearchValue = HtmlDecode($this->pos_desc->AdvancedSearch->SearchValue);
			$this->pos_desc->EditValue = HtmlEncode($this->pos_desc->AdvancedSearch->SearchValue);
			$this->pos_desc->PlaceHolder = RemoveHtml($this->pos_desc->caption());

			// current_location
			$this->current_location->EditAttrs["class"] = "form-control";
			$this->current_location->EditCustomAttributes = "";
			if (!$this->current_location->Raw)
				$this->current_location->AdvancedSearch->SearchValue = HtmlDecode($this->current_location->AdvancedSearch->SearchValue);
			$this->current_location->EditValue = HtmlEncode($this->current_location->AdvancedSearch->SearchValue);
			$this->current_location->PlaceHolder = RemoveHtml($this->current_location->caption());

			// last_name
			$this->last_name->EditAttrs["class"] = "form-control";
			$this->last_name->EditCustomAttributes = "";
			if (!$this->last_name->Raw)
				$this->last_name->AdvancedSearch->SearchValue = HtmlDecode($this->last_name->AdvancedSearch->SearchValue);
			$this->last_name->EditValue = HtmlEncode($this->last_name->AdvancedSearch->SearchValue);
			$this->last_name->PlaceHolder = RemoveHtml($this->last_name->caption());

			// first_name
			$this->first_name->EditAttrs["class"] = "form-control";
			$this->first_name->EditCustomAttributes = "";
			if (!$this->first_name->Raw)
				$this->first_name->AdvancedSearch->SearchValue = HtmlDecode($this->first_name->AdvancedSearch->SearchValue);
			$this->first_name->EditValue = HtmlEncode($this->first_name->AdvancedSearch->SearchValue);
			$this->first_name->PlaceHolder = RemoveHtml($this->first_name->caption());

			// mid_name
			$this->mid_name->EditAttrs["class"] = "form-control";
			$this->mid_name->EditCustomAttributes = "";
			if (!$this->mid_name->Raw)
				$this->mid_name->AdvancedSearch->SearchValue = HtmlDecode($this->mid_name->AdvancedSearch->SearchValue);
			$this->mid_name->EditValue = HtmlEncode($this->mid_name->AdvancedSearch->SearchValue);
			$this->mid_name->PlaceHolder = RemoveHtml($this->mid_name->caption());

			// ext_name
			$this->ext_name->EditAttrs["class"] = "form-control";
			$this->ext_name->EditCustomAttributes = "";
			if (!$this->ext_name->Raw)
				$this->ext_name->AdvancedSearch->SearchValue = HtmlDecode($this->ext_name->AdvancedSearch->SearchValue);
			$this->ext_name->EditValue = HtmlEncode($this->ext_name->AdvancedSearch->SearchValue);
			$this->ext_name->PlaceHolder = RemoveHtml($this->ext_name->caption());

			// full_name
			$this->full_name->EditAttrs["class"] = "form-control";
			$this->full_name->EditCustomAttributes = "";
			$this->full_name->EditValue = HtmlEncode($this->full_name->AdvancedSearch->SearchValue);
			$this->full_name->PlaceHolder = RemoveHtml($this->full_name->caption());

			// full_name_tbl
			$this->full_name_tbl->EditAttrs["class"] = "form-control";
			$this->full_name_tbl->EditCustomAttributes = "";
			if (!$this->full_name_tbl->Raw)
				$this->full_name_tbl->AdvancedSearch->SearchValue = HtmlDecode($this->full_name_tbl->AdvancedSearch->SearchValue);
			$this->full_name_tbl->EditValue = HtmlEncode($this->full_name_tbl->AdvancedSearch->SearchValue);
			$this->full_name_tbl->PlaceHolder = RemoveHtml($this->full_name_tbl->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckInteger($this->inventory_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->inventory_id->errorMessage());
		}
		if (!CheckDate($this->Last_Date_Check->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Last_Date_Check->errorMessage());
		}
		if (!CheckDate($this->date_last_modify->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->date_last_modify->errorMessage());
		}
		if (!CheckDate($this->pullout_date->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->pullout_date->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->inventory_id->AdvancedSearch->load();
		$this->month_dsc->AdvancedSearch->load();
		$this->year_dsc->AdvancedSearch->load();
		$this->cat_desc->AdvancedSearch->load();
		$this->item_model->AdvancedSearch->load();
		$this->off_desc->AdvancedSearch->load();
		$this->region_name->AdvancedSearch->load();
		$this->prov_name->AdvancedSearch->load();
		$this->city_name->AdvancedSearch->load();
		$this->inventory_status_dsc->AdvancedSearch->load();
		$this->Last_Date_Check->AdvancedSearch->load();
		$this->Name_dsc->AdvancedSearch->load();
		$this->user_last_modify->AdvancedSearch->load();
		$this->date_last_modify->AdvancedSearch->load();
		$this->pullout_date->AdvancedSearch->load();
		$this->pos_desc->AdvancedSearch->load();
		$this->current_location->AdvancedSearch->load();
		$this->last_name->AdvancedSearch->load();
		$this->first_name->AdvancedSearch->load();
		$this->mid_name->AdvancedSearch->load();
		$this->ext_name->AdvancedSearch->load();
		$this->full_name->AdvancedSearch->load();
		$this->full_name_tbl->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("inventory_reportslist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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