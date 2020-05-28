<?php
namespace PHPMaker2020\pantawid2020;

/**
 * Page class
 */
class tbl_item_delete extends tbl_item
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}";

	// Table name
	public $TableName = 'tbl_item';

	// Page object name
	public $PageObjName = "tbl_item_delete";

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

		// Table object (tbl_item)
		if (!isset($GLOBALS["tbl_item"]) || get_class($GLOBALS["tbl_item"]) == PROJECT_NAMESPACE . "tbl_item") {
			$GLOBALS["tbl_item"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_item"];
		}

		// Table object (employee)
		if (!isset($GLOBALS['employee']))
			$GLOBALS['employee'] = new employee();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_item');

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
		global $tbl_item;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($tbl_item);
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $TotalRecords = 0;
	public $RecordCount;
	public $RecKeys = [];
	public $StartRowCount = 1;
	public $RowCount = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canDelete()) {
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
			if (!$Security->canDelete()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("tbl_itemlist.php"));
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
					$this->terminate(GetUrl("tbl_itemlist.php"));
					return;
				}
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->item_id->Visible = FALSE;
		$this->SRN->setVisibility();
		$this->inventory_id->Visible = FALSE;
		$this->month->Visible = FALSE;
		$this->Year->Visible = FALSE;
		$this->item_date_receive->setVisibility();
		$this->item_date_repaired->setVisibility();
		$this->item_date_pullout->Visible = FALSE;
		$this->item_transmittal->setVisibility();
		$this->position->Visible = FALSE;
		$this->Contact_no->Visible = FALSE;
		$this->__Request->Visible = FALSE;
		$this->item_type->Visible = FALSE;
		$this->item_model->Visible = FALSE;
		$this->item_serno->Visible = FALSE;
		$this->item_requested_unit->Visible = FALSE;
		$this->Region->Visible = FALSE;
		$this->Province->setVisibility();
		$this->Cities->setVisibility();
		$this->Current_loc->Visible = FALSE;
		$this->item_type_problem->Visible = FALSE;
		$this->item_action_taken->Visible = FALSE;
		$this->technician_name->Visible = FALSE;
		$this->employeeid->setVisibility();
		$this->status_id->setVisibility();
		$this->remarks->Visible = FALSE;
		$this->user_last_modify->Visible = FALSE;
		$this->date_last_modify->Visible = FALSE;
		$this->Date_Finished->Visible = FALSE;
		$this->inventory_idt->Visible = FALSE;
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
		$this->setupLookupOptions($this->item_transmittal);
		$this->setupLookupOptions($this->position);
		$this->setupLookupOptions($this->__Request);
		$this->setupLookupOptions($this->item_type);
		$this->setupLookupOptions($this->item_requested_unit);
		$this->setupLookupOptions($this->Region);
		$this->setupLookupOptions($this->Province);
		$this->setupLookupOptions($this->Cities);
		$this->setupLookupOptions($this->Current_loc);
		$this->setupLookupOptions($this->technician_name);
		$this->setupLookupOptions($this->employeeid);
		$this->setupLookupOptions($this->status_id);
		$this->setupLookupOptions($this->user_last_modify);

		// Check permission
		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("tbl_itemlist.php");
			return;
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("tbl_itemlist.php"); // Prevent SQL injection, return to list
			return;
		}

		// Set up filter (WHERE Clause)
		$this->CurrentFilter = $filter;

		// Check if valid User ID
		$conn = $this->getConnection();
		$sql = $this->getSql($this->CurrentFilter);
		if ($rs = LoadRecordset($sql, $conn)) {
			$res = TRUE;
			while (!$rs->EOF) {
				$this->loadRowValues($rs);
				if (!$this->showOptionLink('delete')) {
					$userIdMsg = $Language->phrase("NoDeletePermission");
					$this->setFailureMessage($userIdMsg);
					$res = FALSE;
					break;
				}
				$rs->moveNext();
			}
			$rs->close();
			if (!$res) {
				$this->terminate("tbl_itemlist.php"); // Return to list
				return;
			}
		}

		// Get action
		if (IsApi()) {
			$this->CurrentAction = "delete"; // Delete record directly
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action");
		} elseif (Get("action") == "1") {
			$this->CurrentAction = "delete"; // Delete record directly
		} else {
			$this->CurrentAction = "show"; // Display record
		}
		if ($this->isDelete()) {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->deleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
				if (IsApi()) {
					$this->terminate(TRUE);
					return;
				} else {
					$this->terminate($this->getReturnUrl()); // Return to caller
				}
			} else { // Delete failed
				if (IsApi()) {
					$this->terminate();
					return;
				}
				$this->CurrentAction = "show"; // Display record
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("tbl_itemlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->inventory_id->setDbValue($row['inventory_id']);
		$this->month->setDbValue($row['month']);
		$this->Year->setDbValue($row['Year']);
		$this->item_date_receive->setDbValue($row['item_date_receive']);
		$this->item_date_repaired->setDbValue($row['item_date_repaired']);
		$this->item_date_pullout->setDbValue($row['item_date_pullout']);
		$this->item_transmittal->setDbValue($row['item_transmittal']);
		$this->position->setDbValue($row['position']);
		$this->Contact_no->setDbValue($row['Contact_no']);
		$this->__Request->setDbValue($row['Request']);
		$this->item_type->setDbValue($row['item_type']);
		$this->item_model->setDbValue($row['item_model']);
		$this->item_serno->setDbValue($row['item_serno']);
		$this->item_requested_unit->setDbValue($row['item_requested_unit']);
		$this->Region->setDbValue($row['Region']);
		$this->Province->setDbValue($row['Province']);
		$this->Cities->setDbValue($row['Cities']);
		$this->Current_loc->setDbValue($row['Current_loc']);
		$this->item_type_problem->setDbValue($row['item_type_problem']);
		$this->item_action_taken->setDbValue($row['item_action_taken']);
		$this->technician_name->setDbValue($row['technician_name']);
		$this->employeeid->setDbValue($row['employeeid']);
		$this->status_id->setDbValue($row['status_id']);
		$this->remarks->setDbValue($row['remarks']);
		$this->user_last_modify->setDbValue($row['user_last_modify']);
		$this->date_last_modify->setDbValue($row['date_last_modify']);
		$this->Date_Finished->setDbValue($row['Date_Finished']);
		$this->inventory_idt->setDbValue($row['inventory_idt']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['item_id'] = NULL;
		$row['SRN'] = NULL;
		$row['inventory_id'] = NULL;
		$row['month'] = NULL;
		$row['Year'] = NULL;
		$row['item_date_receive'] = NULL;
		$row['item_date_repaired'] = NULL;
		$row['item_date_pullout'] = NULL;
		$row['item_transmittal'] = NULL;
		$row['position'] = NULL;
		$row['Contact_no'] = NULL;
		$row['Request'] = NULL;
		$row['item_type'] = NULL;
		$row['item_model'] = NULL;
		$row['item_serno'] = NULL;
		$row['item_requested_unit'] = NULL;
		$row['Region'] = NULL;
		$row['Province'] = NULL;
		$row['Cities'] = NULL;
		$row['Current_loc'] = NULL;
		$row['item_type_problem'] = NULL;
		$row['item_action_taken'] = NULL;
		$row['technician_name'] = NULL;
		$row['employeeid'] = NULL;
		$row['status_id'] = NULL;
		$row['remarks'] = NULL;
		$row['user_last_modify'] = NULL;
		$row['date_last_modify'] = NULL;
		$row['Date_Finished'] = NULL;
		$row['inventory_idt'] = NULL;
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
		// item_id

		$this->item_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// SRN
		$this->SRN->CellCssStyle = "width: 0px; white-space: nowrap;";

		// inventory_id
		$this->inventory_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// month
		$this->month->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Year
		$this->Year->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_date_receive
		$this->item_date_receive->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_date_repaired
		$this->item_date_repaired->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_date_pullout
		$this->item_date_pullout->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_transmittal
		$this->item_transmittal->CellCssStyle = "width: 0px; white-space: nowrap;";

		// position
		$this->position->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Contact_no
		$this->Contact_no->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Request
		$this->__Request->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_type
		$this->item_type->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_model
		$this->item_model->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_serno
		$this->item_serno->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_requested_unit
		$this->item_requested_unit->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Region
		$this->Region->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Province
		$this->Province->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Cities
		$this->Cities->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Current_loc
		$this->Current_loc->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_type_problem
		$this->item_type_problem->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_action_taken
		$this->item_action_taken->CellCssStyle = "width: 0px; white-space: nowrap;";

		// technician_name
		$this->technician_name->CellCssStyle = "width: 0px; white-space: nowrap;";

		// employeeid
		$this->employeeid->CellCssStyle = "width: 0px; white-space: nowrap;";

		// status_id
		$this->status_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// remarks
		$this->remarks->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_last_modify
		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_last_modify
		$this->date_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Date_Finished
		$this->Date_Finished->CellCssStyle = "width: 0px; white-space: nowrap;";

		// inventory_idt
		$this->inventory_idt->CellCssStyle = "width: 0px; white-space: nowrap;";
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// item_id
			$this->item_id->ViewValue = $this->item_id->CurrentValue;
			$this->item_id->ViewCustomAttributes = "";

			// SRN
			$this->SRN->ViewValue = $this->SRN->CurrentValue;
			$this->SRN->ViewCustomAttributes = "";

			// item_date_receive
			$this->item_date_receive->ViewValue = $this->item_date_receive->CurrentValue;
			$this->item_date_receive->ViewValue = FormatDateTime($this->item_date_receive->ViewValue, 5);
			$this->item_date_receive->ViewCustomAttributes = "";

			// item_date_repaired
			$this->item_date_repaired->ViewValue = $this->item_date_repaired->CurrentValue;
			$this->item_date_repaired->ViewValue = FormatDateTime($this->item_date_repaired->ViewValue, 7);
			$this->item_date_repaired->ViewCustomAttributes = "";

			// item_date_pullout
			$this->item_date_pullout->ViewValue = $this->item_date_pullout->CurrentValue;
			$this->item_date_pullout->ViewValue = FormatDateTime($this->item_date_pullout->ViewValue, 5);
			$this->item_date_pullout->ViewCustomAttributes = "";

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

			// Contact_no
			$this->Contact_no->ViewValue = $this->Contact_no->CurrentValue;
			$this->Contact_no->ViewCustomAttributes = "";

			// Request
			$curVal = strval($this->__Request->CurrentValue);
			if ($curVal != "") {
				$this->__Request->ViewValue = $this->__Request->lookupCacheOption($curVal);
				if ($this->__Request->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`request_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->__Request->Lookup->getSql(FALSE, $filterWrk, '', $this);
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

			// status_id
			$curVal = strval($this->status_id->CurrentValue);
			if ($curVal != "") {
				$this->status_id->ViewValue = $this->status_id->lookupCacheOption($curVal);
				if ($this->status_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->status_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
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
			$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 1);
			$this->date_last_modify->ViewCustomAttributes = "";

			// SRN
			$this->SRN->LinkCustomAttributes = "";
			$this->SRN->HrefValue = "";
			$this->SRN->TooltipValue = "";

			// item_date_receive
			$this->item_date_receive->LinkCustomAttributes = "";
			$this->item_date_receive->HrefValue = "";
			$this->item_date_receive->TooltipValue = "";

			// item_date_repaired
			$this->item_date_repaired->LinkCustomAttributes = "";
			$this->item_date_repaired->HrefValue = "";
			$this->item_date_repaired->TooltipValue = "";

			// item_transmittal
			$this->item_transmittal->LinkCustomAttributes = "";
			$this->item_transmittal->HrefValue = "";
			$this->item_transmittal->TooltipValue = "";

			// Province
			$this->Province->LinkCustomAttributes = "";
			$this->Province->HrefValue = "";
			$this->Province->TooltipValue = "";

			// Cities
			$this->Cities->LinkCustomAttributes = "";
			$this->Cities->HrefValue = "";
			$this->Cities->TooltipValue = "";

			// employeeid
			$this->employeeid->LinkCustomAttributes = "";
			$this->employeeid->HrefValue = "";
			$this->employeeid->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		$conn->beginTrans();
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['item_id'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
			$conn->commitTrans(); // Commit the changes
			if ($this->AuditTrailOnDelete)
				$this->writeAuditTrailDummy($Language->phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->rollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete)
				$this->writeAuditTrailDummy($Language->phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->employeeid->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_itemlist.php"), "", $this->TableVar, TRUE);
		$pageId = "delete";
		$Breadcrumb->add("delete", $pageId, $url);
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
				case "x_item_transmittal":
					break;
				case "x_position":
					break;
				case "x___Request":
					break;
				case "x_item_type":
					break;
				case "x_item_requested_unit":
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
				case "x_Current_loc":
					break;
				case "x_technician_name":
					break;
				case "x_employeeid":
					$lookupFilter = function() {
						return "`employeeid` in(4,5)";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_status_id":
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
						case "x_month":
							break;
						case "x_Year":
							break;
						case "x_item_transmittal":
							break;
						case "x_position":
							break;
						case "x___Request":
							break;
						case "x_item_type":
							break;
						case "x_item_requested_unit":
							break;
						case "x_Region":
							break;
						case "x_Province":
							break;
						case "x_Cities":
							break;
						case "x_Current_loc":
							break;
						case "x_technician_name":
							break;
						case "x_employeeid":
							break;
						case "x_status_id":
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
} // End class
?>