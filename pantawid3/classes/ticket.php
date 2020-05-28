<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for ticket
 */
class ticket extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $item_id;
	public $SRN;
	public $month;
	public $Year;
	public $__Request;
	public $item_date_receive;
	public $item_date_repaired;
	public $technician_name;
	public $employeeid;
	public $item_requested_unit;
	public $item_transmittal;
	public $position;
	public $Contact_no;
	public $item_type;
	public $item_model;
	public $item_serno;
	public $Region;
	public $Province;
	public $Cities;
	public $item_type_problem;
	public $item_action_taken;
	public $item_date_pullout;
	public $status_id;
	public $remarks;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ticket';
		$this->TableName = 'ticket';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`ticket`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 6;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("USER_ID_ALLOW_SECURITY"); // Default User ID Allow Security
		$this->UserIDAllowSecurity |= 104; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// item_id
		$this->item_id = new DbField('ticket', 'ticket', 'x_item_id', 'item_id', '`item_id`', '`item_id`', 3, 11, -1, FALSE, '`item_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->item_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->item_id->IsPrimaryKey = TRUE; // Primary key field
		$this->item_id->Sortable = TRUE; // Allow sort
		$this->item_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['item_id'] = &$this->item_id;

		// SRN
		$this->SRN = new DbField('ticket', 'ticket', 'x_SRN', 'SRN', '`SRN`', '`SRN`', 200, 255, -1, FALSE, '`SRN`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SRN->Sortable = TRUE; // Allow sort
		$this->fields['SRN'] = &$this->SRN;

		// month
		$this->month = new DbField('ticket', 'ticket', 'x_month', 'month', '`month`', '`month`', 3, 11, -1, FALSE, '`month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->month->Required = TRUE; // Required field
		$this->month->Sortable = TRUE; // Allow sort
		$this->month->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->month->Lookup = new Lookup('month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->month->Lookup = new Lookup('month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['month'] = &$this->month;

		// Year
		$this->Year = new DbField('ticket', 'ticket', 'x_Year', 'Year', '`Year`', '`Year`', 3, 11, -1, FALSE, '`EV__Year`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->Year->Required = TRUE; // Required field
		$this->Year->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->Year->Lookup = new Lookup('Year', 'tbl_year', TRUE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` ASC', '');
				break;
			default:
				$this->Year->Lookup = new Lookup('Year', 'tbl_year', TRUE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` ASC', '');
				break;
		}
		$this->fields['Year'] = &$this->Year;

		// Request
		$this->__Request = new DbField('ticket', 'ticket', 'x___Request', 'Request', '`Request`', '`Request`', 3, 11, -1, FALSE, '`Request`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->__Request->Required = TRUE; // Required field
		$this->__Request->Sortable = TRUE; // Allow sort
		$this->__Request->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->__Request->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->__Request->Lookup = new Lookup('Request', 'tbl_request', FALSE, 'request_id', ["request_dsc","","",""], [], ["x_item_type"], [], [], [], [], '', '');
				break;
			default:
				$this->__Request->Lookup = new Lookup('Request', 'tbl_request', FALSE, 'request_id', ["request_dsc","","",""], [], ["x_item_type"], [], [], [], [], '', '');
				break;
		}
		$this->__Request->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Request'] = &$this->__Request;

		// item_date_receive
		$this->item_date_receive = new DbField('ticket', 'ticket', 'x_item_date_receive', 'item_date_receive', '`item_date_receive`', CastDateFieldForLike("`item_date_receive`", 5, "DB"), 133, 10, 5, FALSE, '`item_date_receive`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_receive->Required = TRUE; // Required field
		$this->item_date_receive->Sortable = TRUE; // Allow sort
		$this->item_date_receive->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->item_date_receive->AdvancedSearch->SearchValueDefault = date("Y/m/d");
		$this->item_date_receive->AdvancedSearch->SearchOperatorDefault = "=";
		$this->item_date_receive->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->item_date_receive->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['item_date_receive'] = &$this->item_date_receive;

		// item_date_repaired
		$this->item_date_repaired = new DbField('ticket', 'ticket', 'x_item_date_repaired', 'item_date_repaired', '`item_date_repaired`', CastDateFieldForLike("`item_date_repaired`", 1, "DB"), 133, 10, 1, FALSE, '`item_date_repaired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_repaired->Sortable = TRUE; // Allow sort
		$this->item_date_repaired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['item_date_repaired'] = &$this->item_date_repaired;

		// technician_name
		$this->technician_name = new DbField('ticket', 'ticket', 'x_technician_name', 'technician_name', '`technician_name`', '`technician_name`', 3, 50, -1, FALSE, '`technician_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->technician_name->Required = TRUE; // Required field
		$this->technician_name->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->technician_name->Lookup = new Lookup('technician_name', 'tbl_technician', FALSE, 'technician_id', ["technician_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->technician_name->Lookup = new Lookup('technician_name', 'tbl_technician', FALSE, 'technician_id', ["technician_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->technician_name->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['technician_name'] = &$this->technician_name;

		// employeeid
		$this->employeeid = new DbField('ticket', 'ticket', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employeeid->Required = TRUE; // Required field
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employeeid->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '`Name_dsc` ASC', '');
				break;
			default:
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '`Name_dsc` ASC', '');
				break;
		}
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employeeid'] = &$this->employeeid;

		// item_requested_unit
		$this->item_requested_unit = new DbField('ticket', 'ticket', 'x_item_requested_unit', 'item_requested_unit', '`item_requested_unit`', '`item_requested_unit`', 3, 50, -1, FALSE, '`item_requested_unit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->item_requested_unit->Required = TRUE; // Required field
		$this->item_requested_unit->Sortable = TRUE; // Allow sort
		$this->item_requested_unit->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->item_requested_unit->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->item_requested_unit->Lookup = new Lookup('item_requested_unit', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->item_requested_unit->Lookup = new Lookup('item_requested_unit', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['item_requested_unit'] = &$this->item_requested_unit;

		// item_transmittal
		$this->item_transmittal = new DbField('ticket', 'ticket', 'x_item_transmittal', 'item_transmittal', '`item_transmittal`', '`item_transmittal`', 200, 100, -1, FALSE, '`item_transmittal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_transmittal->Required = TRUE; // Required field
		$this->item_transmittal->Sortable = TRUE; // Allow sort
		$this->fields['item_transmittal'] = &$this->item_transmittal;

		// position
		$this->position = new DbField('ticket', 'ticket', 'x_position', 'position', '`position`', '`position`', 200, 100, -1, FALSE, '`position`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->position->Required = TRUE; // Required field
		$this->position->Sortable = TRUE; // Allow sort
		$this->fields['position'] = &$this->position;

		// Contact_no
		$this->Contact_no = new DbField('ticket', 'ticket', 'x_Contact_no', 'Contact_no', '`Contact_no`', '`Contact_no`', 3, 11, -1, FALSE, '`Contact_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Contact_no->Required = TRUE; // Required field
		$this->Contact_no->Sortable = TRUE; // Allow sort
		$this->Contact_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Contact_no'] = &$this->Contact_no;

		// item_type
		$this->item_type = new DbField('ticket', 'ticket', 'x_item_type', 'item_type', '`item_type`', '`item_type`', 3, 50, -1, FALSE, '`item_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->item_type->Sortable = TRUE; // Allow sort
		$this->item_type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->item_type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->item_type->Lookup = new Lookup('item_type', 'tbl_cat', FALSE, 'cat_id', ["cat_desc","","",""], ["x___Request"], [], ["request_id"], ["x_request_id"], [], [], '', '');
				break;
			default:
				$this->item_type->Lookup = new Lookup('item_type', 'tbl_cat', FALSE, 'cat_id', ["cat_desc","","",""], ["x___Request"], [], ["request_id"], ["x_request_id"], [], [], '', '');
				break;
		}
		$this->fields['item_type'] = &$this->item_type;

		// item_model
		$this->item_model = new DbField('ticket', 'ticket', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 255, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Required = TRUE; // Required field
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serno
		$this->item_serno = new DbField('ticket', 'ticket', 'x_item_serno', 'item_serno', '`item_serno`', '`item_serno`', 200, 255, -1, FALSE, '`item_serno`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serno->Required = TRUE; // Required field
		$this->item_serno->Sortable = TRUE; // Allow sort
		$this->fields['item_serno'] = &$this->item_serno;

		// Region
		$this->Region = new DbField('ticket', 'ticket', 'x_Region', 'Region', '`Region`', '`Region`', 3, 11, -1, FALSE, '`Region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Region->Required = TRUE; // Required field
		$this->Region->Sortable = TRUE; // Allow sort
		$this->Region->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Region->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Region->Lookup = new Lookup('Region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], ["x_Province"], [], [], [], [], '', '');
				break;
			default:
				$this->Region->Lookup = new Lookup('Region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], ["x_Province"], [], [], [], [], '', '');
				break;
		}
		$this->Region->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Region'] = &$this->Region;

		// Province
		$this->Province = new DbField('ticket', 'ticket', 'x_Province', 'Province', '`Province`', '`Province`', 3, 11, -1, FALSE, '`Province`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Province->Required = TRUE; // Required field
		$this->Province->Sortable = TRUE; // Allow sort
		$this->Province->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Province->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Province->Lookup = new Lookup('Province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], ["x_Region"], ["x_Cities"], ["region_code"], ["x_region_code"], [], [], '', '');
				break;
			default:
				$this->Province->Lookup = new Lookup('Province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], ["x_Region"], ["x_Cities"], ["region_code"], ["x_region_code"], [], [], '', '');
				break;
		}
		$this->Province->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Province'] = &$this->Province;

		// Cities
		$this->Cities = new DbField('ticket', 'ticket', 'x_Cities', 'Cities', '`Cities`', '`Cities`', 3, 11, -1, FALSE, '`Cities`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Cities->Required = TRUE; // Required field
		$this->Cities->Sortable = TRUE; // Allow sort
		$this->Cities->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Cities->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Cities->Lookup = new Lookup('Cities', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], ["x_Province"], [], ["prov_code"], ["x_prov_code"], [], [], '', '');
				break;
			default:
				$this->Cities->Lookup = new Lookup('Cities', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], ["x_Province"], [], ["prov_code"], ["x_prov_code"], [], [], '', '');
				break;
		}
		$this->Cities->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Cities'] = &$this->Cities;

		// item_type_problem
		$this->item_type_problem = new DbField('ticket', 'ticket', 'x_item_type_problem', 'item_type_problem', '`item_type_problem`', '`item_type_problem`', 201, 500, -1, FALSE, '`item_type_problem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_type_problem->Required = TRUE; // Required field
		$this->item_type_problem->Sortable = TRUE; // Allow sort
		$this->fields['item_type_problem'] = &$this->item_type_problem;

		// item_action_taken
		$this->item_action_taken = new DbField('ticket', 'ticket', 'x_item_action_taken', 'item_action_taken', '`item_action_taken`', '`item_action_taken`', 201, 500, -1, FALSE, '`item_action_taken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_action_taken->Sortable = TRUE; // Allow sort
		$this->fields['item_action_taken'] = &$this->item_action_taken;

		// item_date_pullout
		$this->item_date_pullout = new DbField('ticket', 'ticket', 'x_item_date_pullout', 'item_date_pullout', '`item_date_pullout`', CastDateFieldForLike("`item_date_pullout`", 1, "DB"), 133, 10, 1, FALSE, '`item_date_pullout`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_pullout->Sortable = TRUE; // Allow sort
		$this->item_date_pullout->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['item_date_pullout'] = &$this->item_date_pullout;

		// status_id
		$this->status_id = new DbField('ticket', 'ticket', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 3, 11, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_id->Required = TRUE; // Required field
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status_id->Lookup = new Lookup('status_id', 'tbl_item_status', FALSE, 'status_id', ["status_desc","","",""], [], [], [], [], [], [], '`status_desc` ASC', '');
				break;
			default:
				$this->status_id->Lookup = new Lookup('status_id', 'tbl_item_status', FALSE, 'status_id', ["status_desc","","",""], [], [], [], [], [], [], '`status_desc` ASC', '');
				break;
		}
		$this->status_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// remarks
		$this->remarks = new DbField('ticket', 'ticket', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->fields['remarks'] = &$this->remarks;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy != "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
			$sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
			if ($ctrl) {
				$orderByList = $this->getSessionOrderByList();
				if (ContainsString($orderByList, $sortFieldList . " " . $lastSort)) {
					$orderByList = str_replace($sortFieldList . " " . $lastSort, $sortFieldList . " " . $thisSort, $orderByList);
				} else {
					if ($orderByList != "") $orderByList .= ", ";
					$orderByList .= $sortFieldList . " " . $thisSort;
				}
				$this->setSessionOrderByList($orderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ticket`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *,  FROM `ticket`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList != "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`item_id` DESC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where != "")
			$where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
		if ($orderBy != "")
			$orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
		if ($this->Year->AdvancedSearch->SearchValue != "" ||
			$this->Year->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->Year->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->Year->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->item_id->setDbValue($conn->insert_ID());
			$rs['item_id'] = $this->item_id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'item_id';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('item_id', $rs))
				AddFilter($where, QuotedName('item_id', $this->Dbid) . '=' . QuotedValue($rs['item_id'], $this->item_id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->item_id->DbValue = $row['item_id'];
		$this->SRN->DbValue = $row['SRN'];
		$this->month->DbValue = $row['month'];
		$this->Year->DbValue = $row['Year'];
		$this->__Request->DbValue = $row['Request'];
		$this->item_date_receive->DbValue = $row['item_date_receive'];
		$this->item_date_repaired->DbValue = $row['item_date_repaired'];
		$this->technician_name->DbValue = $row['technician_name'];
		$this->employeeid->DbValue = $row['employeeid'];
		$this->item_requested_unit->DbValue = $row['item_requested_unit'];
		$this->item_transmittal->DbValue = $row['item_transmittal'];
		$this->position->DbValue = $row['position'];
		$this->Contact_no->DbValue = $row['Contact_no'];
		$this->item_type->DbValue = $row['item_type'];
		$this->item_model->DbValue = $row['item_model'];
		$this->item_serno->DbValue = $row['item_serno'];
		$this->Region->DbValue = $row['Region'];
		$this->Province->DbValue = $row['Province'];
		$this->Cities->DbValue = $row['Cities'];
		$this->item_type_problem->DbValue = $row['item_type_problem'];
		$this->item_action_taken->DbValue = $row['item_action_taken'];
		$this->item_date_pullout->DbValue = $row['item_date_pullout'];
		$this->status_id->DbValue = $row['status_id'];
		$this->remarks->DbValue = $row['remarks'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`item_id` = @item_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('item_id', $row) ? $row['item_id'] : NULL;
		else
			$val = $this->item_id->OldValue !== NULL ? $this->item_id->OldValue : $this->item_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@item_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "ticketlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "ticketview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ticketedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ticketadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ticketlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ticketview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ticketview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ticketadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ticketadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("ticketedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("ticketadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("ticketdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "item_id:" . JsonEncode($this->item_id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->item_id->CurrentValue != NULL) {
			$url .= "item_id=" . urlencode($this->item_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("item_id") !== NULL)
				$arKeys[] = Param("item_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->item_id->CurrentValue = $key;
			else
				$this->item_id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->item_id->setDbValue($rs->fields('item_id'));
		$this->SRN->setDbValue($rs->fields('SRN'));
		$this->month->setDbValue($rs->fields('month'));
		$this->Year->setDbValue($rs->fields('Year'));
		$this->__Request->setDbValue($rs->fields('Request'));
		$this->item_date_receive->setDbValue($rs->fields('item_date_receive'));
		$this->item_date_repaired->setDbValue($rs->fields('item_date_repaired'));
		$this->technician_name->setDbValue($rs->fields('technician_name'));
		$this->employeeid->setDbValue($rs->fields('employeeid'));
		$this->item_requested_unit->setDbValue($rs->fields('item_requested_unit'));
		$this->item_transmittal->setDbValue($rs->fields('item_transmittal'));
		$this->position->setDbValue($rs->fields('position'));
		$this->Contact_no->setDbValue($rs->fields('Contact_no'));
		$this->item_type->setDbValue($rs->fields('item_type'));
		$this->item_model->setDbValue($rs->fields('item_model'));
		$this->item_serno->setDbValue($rs->fields('item_serno'));
		$this->Region->setDbValue($rs->fields('Region'));
		$this->Province->setDbValue($rs->fields('Province'));
		$this->Cities->setDbValue($rs->fields('Cities'));
		$this->item_type_problem->setDbValue($rs->fields('item_type_problem'));
		$this->item_action_taken->setDbValue($rs->fields('item_action_taken'));
		$this->item_date_pullout->setDbValue($rs->fields('item_date_pullout'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->remarks->setDbValue($rs->fields('remarks'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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
		// item_id

		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		$this->item_id->ViewCustomAttributes = "";

		// SRN
		$this->SRN->ViewValue = $this->SRN->CurrentValue;
		$this->SRN->ViewCustomAttributes = "";

		// month
		$curVal = strval($this->month->CurrentValue);
		if ($curVal != "") {
			$this->month->ViewValue = $this->month->lookupCacheOption($curVal);
			if ($this->month->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`month_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->month->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->month->ViewValue = $this->month->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->month->ViewValue = $this->month->CurrentValue;
				}
			}
		} else {
			$this->month->ViewValue = NULL;
		}
		$this->month->ViewCustomAttributes = "";

		// Year
		if ($this->Year->VirtualValue != "") {
			$this->Year->ViewValue = $this->Year->VirtualValue;
		} else {
			$this->Year->ViewValue = $this->Year->CurrentValue;
			$curVal = strval($this->Year->CurrentValue);
			if ($curVal != "") {
				$this->Year->ViewValue = $this->Year->lookupCacheOption($curVal);
				if ($this->Year->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`year_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Year->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Year->ViewValue = $this->Year->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Year->ViewValue = $this->Year->CurrentValue;
					}
				}
			} else {
				$this->Year->ViewValue = NULL;
			}
		}
		$this->Year->ViewCustomAttributes = "";

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

		// item_id
		$this->item_id->LinkCustomAttributes = "";
		$this->item_id->HrefValue = "";
		$this->item_id->TooltipValue = "";

		// SRN
		$this->SRN->LinkCustomAttributes = "";
		$this->SRN->HrefValue = "";
		$this->SRN->TooltipValue = "";

		// month
		$this->month->LinkCustomAttributes = "";
		$this->month->HrefValue = "";
		$this->month->TooltipValue = "";

		// Year
		$this->Year->LinkCustomAttributes = "";
		$this->Year->HrefValue = "";
		$this->Year->TooltipValue = "";

		// Request
		$this->__Request->LinkCustomAttributes = "";
		$this->__Request->HrefValue = "";
		$this->__Request->TooltipValue = "";

		// item_date_receive
		$this->item_date_receive->LinkCustomAttributes = "";
		$this->item_date_receive->HrefValue = "";
		$this->item_date_receive->TooltipValue = "";

		// item_date_repaired
		$this->item_date_repaired->LinkCustomAttributes = "";
		$this->item_date_repaired->HrefValue = "";
		$this->item_date_repaired->TooltipValue = "";

		// technician_name
		$this->technician_name->LinkCustomAttributes = "";
		$this->technician_name->HrefValue = "";
		$this->technician_name->TooltipValue = "";

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

		// item_type_problem
		$this->item_type_problem->LinkCustomAttributes = "";
		$this->item_type_problem->HrefValue = "";
		$this->item_type_problem->TooltipValue = "";

		// item_action_taken
		$this->item_action_taken->LinkCustomAttributes = "";
		$this->item_action_taken->HrefValue = "";
		$this->item_action_taken->TooltipValue = "";

		// item_date_pullout
		$this->item_date_pullout->LinkCustomAttributes = "";
		$this->item_date_pullout->HrefValue = "";
		$this->item_date_pullout->TooltipValue = "";

		// status_id
		$this->status_id->LinkCustomAttributes = "";
		$this->status_id->HrefValue = "";
		$this->status_id->TooltipValue = "";

		// remarks
		$this->remarks->LinkCustomAttributes = "";
		$this->remarks->HrefValue = "";
		$this->remarks->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// item_id
		$this->item_id->EditAttrs["class"] = "form-control";
		$this->item_id->EditCustomAttributes = "";
		$this->item_id->EditValue = $this->item_id->CurrentValue;
		$this->item_id->ViewCustomAttributes = "";

		// SRN
		$this->SRN->EditAttrs["class"] = "form-control";
		$this->SRN->EditCustomAttributes = "";
		if (!$this->SRN->Raw)
			$this->SRN->CurrentValue = HtmlDecode($this->SRN->CurrentValue);
		$this->SRN->EditValue = $this->SRN->CurrentValue;
		$this->SRN->PlaceHolder = RemoveHtml($this->SRN->caption());

		// month
		$this->month->EditAttrs["class"] = "form-control";
		$this->month->EditCustomAttributes = "";

		// Year
		$this->Year->EditAttrs["class"] = "form-control";
		$this->Year->EditCustomAttributes = "";
		$this->Year->EditValue = $this->Year->CurrentValue;
		$this->Year->PlaceHolder = RemoveHtml($this->Year->caption());

		// Request
		$this->__Request->EditAttrs["class"] = "form-control";
		$this->__Request->EditCustomAttributes = "";

		// item_date_receive
		$this->item_date_receive->EditAttrs["class"] = "form-control";
		$this->item_date_receive->EditCustomAttributes = "";
		$this->item_date_receive->EditValue = FormatDateTime($this->item_date_receive->CurrentValue, 5);
		$this->item_date_receive->PlaceHolder = RemoveHtml($this->item_date_receive->caption());

		// item_date_repaired
		$this->item_date_repaired->EditAttrs["class"] = "form-control";
		$this->item_date_repaired->EditCustomAttributes = "";
		$this->item_date_repaired->EditValue = FormatDateTime($this->item_date_repaired->CurrentValue, 8);
		$this->item_date_repaired->PlaceHolder = RemoveHtml($this->item_date_repaired->caption());

		// technician_name
		$this->technician_name->EditAttrs["class"] = "form-control";
		$this->technician_name->EditCustomAttributes = "";
		$this->technician_name->EditValue = $this->technician_name->CurrentValue;
		$curVal = strval($this->technician_name->CurrentValue);
		if ($curVal != "") {
			$this->technician_name->EditValue = $this->technician_name->lookupCacheOption($curVal);
			if ($this->technician_name->EditValue === NULL) { // Lookup from database
				$filterWrk = "`technician_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->technician_name->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->technician_name->EditValue = $this->technician_name->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->technician_name->EditValue = $this->technician_name->CurrentValue;
				}
			}
		} else {
			$this->technician_name->EditValue = NULL;
		}
		$this->technician_name->ViewCustomAttributes = "";

		// employeeid
		$this->employeeid->EditAttrs["class"] = "form-control";
		$this->employeeid->EditCustomAttributes = "";

		// item_requested_unit
		$this->item_requested_unit->EditAttrs["class"] = "form-control";
		$this->item_requested_unit->EditCustomAttributes = "";

		// item_transmittal
		$this->item_transmittal->EditAttrs["class"] = "form-control";
		$this->item_transmittal->EditCustomAttributes = "";
		if (!$this->item_transmittal->Raw)
			$this->item_transmittal->CurrentValue = HtmlDecode($this->item_transmittal->CurrentValue);
		$this->item_transmittal->EditValue = $this->item_transmittal->CurrentValue;
		$this->item_transmittal->PlaceHolder = RemoveHtml($this->item_transmittal->caption());

		// position
		$this->position->EditAttrs["class"] = "form-control";
		$this->position->EditCustomAttributes = "";
		if (!$this->position->Raw)
			$this->position->CurrentValue = HtmlDecode($this->position->CurrentValue);
		$this->position->EditValue = $this->position->CurrentValue;
		$this->position->PlaceHolder = RemoveHtml($this->position->caption());

		// Contact_no
		$this->Contact_no->EditAttrs["class"] = "form-control";
		$this->Contact_no->EditCustomAttributes = "";
		$this->Contact_no->EditValue = $this->Contact_no->CurrentValue;
		$this->Contact_no->PlaceHolder = RemoveHtml($this->Contact_no->caption());

		// item_type
		$this->item_type->EditAttrs["class"] = "form-control";
		$this->item_type->EditCustomAttributes = "";

		// item_model
		$this->item_model->EditAttrs["class"] = "form-control";
		$this->item_model->EditCustomAttributes = "";
		if (!$this->item_model->Raw)
			$this->item_model->CurrentValue = HtmlDecode($this->item_model->CurrentValue);
		$this->item_model->EditValue = $this->item_model->CurrentValue;
		$this->item_model->PlaceHolder = RemoveHtml($this->item_model->caption());

		// item_serno
		$this->item_serno->EditAttrs["class"] = "form-control";
		$this->item_serno->EditCustomAttributes = "";
		if (!$this->item_serno->Raw)
			$this->item_serno->CurrentValue = HtmlDecode($this->item_serno->CurrentValue);
		$this->item_serno->EditValue = $this->item_serno->CurrentValue;
		$this->item_serno->PlaceHolder = RemoveHtml($this->item_serno->caption());

		// Region
		$this->Region->EditAttrs["class"] = "form-control";
		$this->Region->EditCustomAttributes = "";

		// Province
		$this->Province->EditAttrs["class"] = "form-control";
		$this->Province->EditCustomAttributes = "";

		// Cities
		$this->Cities->EditAttrs["class"] = "form-control";
		$this->Cities->EditCustomAttributes = "";

		// item_type_problem
		$this->item_type_problem->EditAttrs["class"] = "form-control";
		$this->item_type_problem->EditCustomAttributes = "";
		$this->item_type_problem->EditValue = $this->item_type_problem->CurrentValue;
		$this->item_type_problem->PlaceHolder = RemoveHtml($this->item_type_problem->caption());

		// item_action_taken
		$this->item_action_taken->EditAttrs["class"] = "form-control";
		$this->item_action_taken->EditCustomAttributes = "";
		$this->item_action_taken->EditValue = $this->item_action_taken->CurrentValue;
		$this->item_action_taken->PlaceHolder = RemoveHtml($this->item_action_taken->caption());

		// item_date_pullout
		$this->item_date_pullout->EditAttrs["class"] = "form-control";
		$this->item_date_pullout->EditCustomAttributes = "";
		$this->item_date_pullout->EditValue = FormatDateTime($this->item_date_pullout->CurrentValue, 8);
		$this->item_date_pullout->PlaceHolder = RemoveHtml($this->item_date_pullout->caption());

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";

		// remarks
		$this->remarks->EditAttrs["class"] = "form-control";
		$this->remarks->EditCustomAttributes = "";
		$this->remarks->EditValue = $this->remarks->CurrentValue;
		$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->SRN);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->item_date_receive);
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->technician_name);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->item_requested_unit);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->position);
					$doc->exportCaption($this->Contact_no);
					$doc->exportCaption($this->item_type);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->Province);
					$doc->exportCaption($this->Cities);
					$doc->exportCaption($this->item_type_problem);
					$doc->exportCaption($this->item_action_taken);
					$doc->exportCaption($this->item_date_pullout);
					$doc->exportCaption($this->status_id);
					$doc->exportCaption($this->remarks);
				} else {
					$doc->exportCaption($this->item_id);
					$doc->exportCaption($this->SRN);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->item_date_receive);
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->technician_name);
					$doc->exportCaption($this->item_requested_unit);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->position);
					$doc->exportCaption($this->Contact_no);
					$doc->exportCaption($this->item_type);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->Province);
					$doc->exportCaption($this->Cities);
					$doc->exportCaption($this->item_type_problem);
					$doc->exportCaption($this->item_action_taken);
					$doc->exportCaption($this->item_date_pullout);
					$doc->exportCaption($this->status_id);
					$doc->exportCaption($this->remarks);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->SRN);
						$doc->exportField($this->__Request);
						$doc->exportField($this->item_date_receive);
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->technician_name);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->item_requested_unit);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->position);
						$doc->exportField($this->Contact_no);
						$doc->exportField($this->item_type);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->Region);
						$doc->exportField($this->Province);
						$doc->exportField($this->Cities);
						$doc->exportField($this->item_type_problem);
						$doc->exportField($this->item_action_taken);
						$doc->exportField($this->item_date_pullout);
						$doc->exportField($this->status_id);
						$doc->exportField($this->remarks);
					} else {
						$doc->exportField($this->item_id);
						$doc->exportField($this->SRN);
						$doc->exportField($this->__Request);
						$doc->exportField($this->item_date_receive);
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->technician_name);
						$doc->exportField($this->item_requested_unit);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->position);
						$doc->exportField($this->Contact_no);
						$doc->exportField($this->item_type);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->Region);
						$doc->exportField($this->Province);
						$doc->exportField($this->Cities);
						$doc->exportField($this->item_type_problem);
						$doc->exportField($this->item_action_taken);
						$doc->exportField($this->item_date_pullout);
						$doc->exportField($this->status_id);
						$doc->exportField($this->remarks);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'ticket';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'ticket';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['item_id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'ticket';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['item_id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'ticket';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['item_id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		$item_id = $rsnew['item_id'];

	//Execute("UPDATE tbl_item SET SRN= CONCAT('SRN',curdate(),'-',".$item_id.") WHERE item_id= ".$rsnew['item_id']);
	$MyResult = Execute("UPDATE ticket SET SRN= CONCAT('SRN','-','R6',".$item_id.") WHERE item_id= ".$rsnew['item_id']);
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>