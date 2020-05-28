<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for inspection_report
 */
class inspection_report extends DbTable
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

	// Export
	public $ExportDoc;

	// Fields
	public $SRN;
	public $item_date_repaired;
	public $item_requested_unit;
	public $item_model;
	public $item_serno;
	public $Current_loc;
	public $item_transmittal;
	public $position;
	public $item_type_problem;
	public $item_action_taken;
	public $remarks;
	public $Date_Finished;
	public $__Request;
	public $employeeid;
	public $status_id;
	public $Contact_no;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'inspection_report';
		$this->TableName = 'inspection_report';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`inspection_report`";
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
		$this->UserIDAllowSecurity |= 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// SRN
		$this->SRN = new DbField('inspection_report', 'inspection_report', 'x_SRN', 'SRN', '`SRN`', '`SRN`', 200, 255, -1, FALSE, '`SRN`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SRN->Sortable = TRUE; // Allow sort
		$this->fields['SRN'] = &$this->SRN;

		// item_date_repaired
		$this->item_date_repaired = new DbField('inspection_report', 'inspection_report', 'x_item_date_repaired', 'item_date_repaired', '`item_date_repaired`', CastDateFieldForLike("`item_date_repaired`", 5, "DB"), 133, 10, 5, FALSE, '`item_date_repaired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_repaired->Sortable = TRUE; // Allow sort
		$this->item_date_repaired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['item_date_repaired'] = &$this->item_date_repaired;

		// item_requested_unit
		$this->item_requested_unit = new DbField('inspection_report', 'inspection_report', 'x_item_requested_unit', 'item_requested_unit', '`item_requested_unit`', '`item_requested_unit`', 3, 50, -1, FALSE, '`item_requested_unit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->item_requested_unit->Sortable = TRUE; // Allow sort
		$this->item_requested_unit->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->item_requested_unit->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->item_requested_unit->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['item_requested_unit'] = &$this->item_requested_unit;

		// item_model
		$this->item_model = new DbField('inspection_report', 'inspection_report', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 255, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serno
		$this->item_serno = new DbField('inspection_report', 'inspection_report', 'x_item_serno', 'item_serno', '`item_serno`', '`item_serno`', 200, 255, -1, FALSE, '`item_serno`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serno->Sortable = TRUE; // Allow sort
		$this->fields['item_serno'] = &$this->item_serno;

		// Current_loc
		$this->Current_loc = new DbField('inspection_report', 'inspection_report', 'x_Current_loc', 'Current_loc', '`Current_loc`', '`Current_loc`', 200, 255, -1, FALSE, '`Current_loc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Current_loc->Sortable = FALSE; // Allow sort
		$this->Current_loc->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Current_loc->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Current_loc->Lookup = new Lookup('Current_loc', 'tbl_current_loc', FALSE, 'current_id', ["current_location","","",""], [], [], [], [], [], [], '`current_location` ASC', '');
				break;
			default:
				$this->Current_loc->Lookup = new Lookup('Current_loc', 'tbl_current_loc', FALSE, 'current_id', ["current_location","","",""], [], [], [], [], [], [], '`current_location` ASC', '');
				break;
		}
		$this->fields['Current_loc'] = &$this->Current_loc;

		// item_transmittal
		$this->item_transmittal = new DbField('inspection_report', 'inspection_report', 'x_item_transmittal', 'item_transmittal', '`item_transmittal`', '`item_transmittal`', 200, 100, -1, FALSE, '`item_transmittal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->item_transmittal->Required = TRUE; // Required field
		$this->item_transmittal->Sortable = TRUE; // Allow sort
		$this->item_transmittal->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->item_transmittal->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->item_transmittal->Lookup = new Lookup('item_transmittal', 'tbl_accountable_name', FALSE, 'name_id', ["full_name_tbl","","",""], [], [], [], [], [], [], '`full_name_tbl` ASC', '');
				break;
			default:
				$this->item_transmittal->Lookup = new Lookup('item_transmittal', 'tbl_accountable_name', FALSE, 'name_id', ["full_name_tbl","","",""], [], [], [], [], [], [], '`full_name_tbl` ASC', '');
				break;
		}
		$this->fields['item_transmittal'] = &$this->item_transmittal;

		// position
		$this->position = new DbField('inspection_report', 'inspection_report', 'x_position', 'position', '`position`', '`position`', 200, 100, -1, FALSE, '`position`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->position->Sortable = TRUE; // Allow sort
		$this->position->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->position->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->position->Lookup = new Lookup('position', 'tbl_pos', FALSE, 'pos_id', ["pos_desc","","",""], [], [], [], [], [], [], '`pos_desc` ASC', '');
				break;
			default:
				$this->position->Lookup = new Lookup('position', 'tbl_pos', FALSE, 'pos_id', ["pos_desc","","",""], [], [], [], [], [], [], '`pos_desc` ASC', '');
				break;
		}
		$this->fields['position'] = &$this->position;

		// item_type_problem
		$this->item_type_problem = new DbField('inspection_report', 'inspection_report', 'x_item_type_problem', 'item_type_problem', '`item_type_problem`', '`item_type_problem`', 201, 500, -1, FALSE, '`item_type_problem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_type_problem->Sortable = TRUE; // Allow sort
		$this->fields['item_type_problem'] = &$this->item_type_problem;

		// item_action_taken
		$this->item_action_taken = new DbField('inspection_report', 'inspection_report', 'x_item_action_taken', 'item_action_taken', '`item_action_taken`', '`item_action_taken`', 201, 500, -1, FALSE, '`item_action_taken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_action_taken->Sortable = TRUE; // Allow sort
		$this->fields['item_action_taken'] = &$this->item_action_taken;

		// remarks
		$this->remarks = new DbField('inspection_report', 'inspection_report', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->fields['remarks'] = &$this->remarks;

		// Date_Finished
		$this->Date_Finished = new DbField('inspection_report', 'inspection_report', 'x_Date_Finished', 'Date_Finished', '`Date_Finished`', CastDateFieldForLike("`Date_Finished`", 0, "DB"), 133, 10, 0, FALSE, '`Date_Finished`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Date_Finished->Sortable = TRUE; // Allow sort
		$this->Date_Finished->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Date_Finished'] = &$this->Date_Finished;

		// Request
		$this->__Request = new DbField('inspection_report', 'inspection_report', 'x___Request', 'Request', '`Request`', '`Request`', 3, 11, -1, FALSE, '`Request`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->__Request->Sortable = TRUE; // Allow sort
		$this->__Request->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->__Request->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->__Request->Lookup = new Lookup('Request', 'tbl_request', FALSE, 'request_id', ["request_dsc","","",""], [], [], [], [], [], [], '`request_id` ASC', '');
				break;
			default:
				$this->__Request->Lookup = new Lookup('Request', 'tbl_request', FALSE, 'request_id', ["request_dsc","","",""], [], [], [], [], [], [], '`request_id` ASC', '');
				break;
		}
		$this->__Request->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Request'] = &$this->__Request;

		// employeeid
		$this->employeeid = new DbField('inspection_report', 'inspection_report', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employeeid->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
			default:
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
		}
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employeeid'] = &$this->employeeid;

		// status_id
		$this->status_id = new DbField('inspection_report', 'inspection_report', 'x_status_id', 'status_id', '`status_id`', '`status_id`', 3, 11, -1, FALSE, '`status_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_id->Sortable = TRUE; // Allow sort
		$this->status_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status_id->Lookup = new Lookup('status_id', 'tbl_item_status', FALSE, 'status_id', ["status_desc","","",""], [], [], [], [], [], [], '`status_id` ASC', '');
				break;
			default:
				$this->status_id->Lookup = new Lookup('status_id', 'tbl_item_status', FALSE, 'status_id', ["status_desc","","",""], [], [], [], [], [], [], '`status_id` ASC', '');
				break;
		}
		$this->status_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status_id'] = &$this->status_id;

		// Contact_no
		$this->Contact_no = new DbField('inspection_report', 'inspection_report', 'x_Contact_no', 'Contact_no', '`Contact_no`', '`Contact_no`', 3, 11, -1, FALSE, '`Contact_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Contact_no->Sortable = TRUE; // Allow sort
		$this->Contact_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Contact_no'] = &$this->Contact_no;
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

	// Single column sort
	public function updateSort(&$fld)
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
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`inspection_report`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
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
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
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
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
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
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->SRN->DbValue = $row['SRN'];
		$this->item_date_repaired->DbValue = $row['item_date_repaired'];
		$this->item_requested_unit->DbValue = $row['item_requested_unit'];
		$this->item_model->DbValue = $row['item_model'];
		$this->item_serno->DbValue = $row['item_serno'];
		$this->Current_loc->DbValue = $row['Current_loc'];
		$this->item_transmittal->DbValue = $row['item_transmittal'];
		$this->position->DbValue = $row['position'];
		$this->item_type_problem->DbValue = $row['item_type_problem'];
		$this->item_action_taken->DbValue = $row['item_action_taken'];
		$this->remarks->DbValue = $row['remarks'];
		$this->Date_Finished->DbValue = $row['Date_Finished'];
		$this->__Request->DbValue = $row['Request'];
		$this->employeeid->DbValue = $row['employeeid'];
		$this->status_id->DbValue = $row['status_id'];
		$this->Contact_no->DbValue = $row['Contact_no'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "inspection_reportlist.php";
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
		if ($pageName == "inspection_reportview.php")
			return $Language->phrase("View");
		elseif ($pageName == "inspection_reportedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "inspection_reportadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "inspection_reportlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("inspection_reportview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("inspection_reportview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "inspection_reportadd.php?" . $this->getUrlParm($parm);
		else
			$url = "inspection_reportadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("inspection_reportedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("inspection_reportadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("inspection_reportdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
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

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
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
		$this->SRN->setDbValue($rs->fields('SRN'));
		$this->item_date_repaired->setDbValue($rs->fields('item_date_repaired'));
		$this->item_requested_unit->setDbValue($rs->fields('item_requested_unit'));
		$this->item_model->setDbValue($rs->fields('item_model'));
		$this->item_serno->setDbValue($rs->fields('item_serno'));
		$this->Current_loc->setDbValue($rs->fields('Current_loc'));
		$this->item_transmittal->setDbValue($rs->fields('item_transmittal'));
		$this->position->setDbValue($rs->fields('position'));
		$this->item_type_problem->setDbValue($rs->fields('item_type_problem'));
		$this->item_action_taken->setDbValue($rs->fields('item_action_taken'));
		$this->remarks->setDbValue($rs->fields('remarks'));
		$this->Date_Finished->setDbValue($rs->fields('Date_Finished'));
		$this->__Request->setDbValue($rs->fields('Request'));
		$this->employeeid->setDbValue($rs->fields('employeeid'));
		$this->status_id->setDbValue($rs->fields('status_id'));
		$this->Contact_no->setDbValue($rs->fields('Contact_no'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// SRN
		// item_date_repaired

		$this->item_date_repaired->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_requested_unit
		// item_model

		$this->item_model->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_serno
		$this->item_serno->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Current_loc
		$this->Current_loc->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_transmittal
		$this->item_transmittal->CellCssStyle = "width: 0px; white-space: nowrap;";

		// position
		$this->position->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_type_problem
		$this->item_type_problem->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_action_taken
		$this->item_action_taken->CellCssStyle = "width: 0px; white-space: nowrap;";

		// remarks
		$this->remarks->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Date_Finished
		// Request
		// employeeid
		// status_id
		// Contact_no
		// SRN

		$this->SRN->ViewValue = $this->SRN->CurrentValue;
		$this->SRN->ViewCustomAttributes = "";

		// item_date_repaired
		$this->item_date_repaired->ViewValue = $this->item_date_repaired->CurrentValue;
		$this->item_date_repaired->ViewValue = FormatDateTime($this->item_date_repaired->ViewValue, 5);
		$this->item_date_repaired->ViewCustomAttributes = "";

		// item_requested_unit
		$this->item_requested_unit->ViewValue = FormatNumber($this->item_requested_unit->ViewValue, 0, -2, -2, -2);
		$this->item_requested_unit->ViewCustomAttributes = "";

		// item_model
		$this->item_model->ViewValue = $this->item_model->CurrentValue;
		$this->item_model->ViewCustomAttributes = "";

		// item_serno
		$this->item_serno->ViewValue = $this->item_serno->CurrentValue;
		$this->item_serno->ViewCustomAttributes = "";

		// Current_loc
		$curVal = strval($this->Current_loc->CurrentValue);
		if ($curVal != "") {
			$this->Current_loc->ViewValue = $this->Current_loc->lookupCacheOption($curVal);
			if ($this->Current_loc->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`current_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Current_loc->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Current_loc->ViewValue = $this->Current_loc->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Current_loc->ViewValue = $this->Current_loc->CurrentValue;
				}
			}
		} else {
			$this->Current_loc->ViewValue = NULL;
		}
		$this->Current_loc->ViewCustomAttributes = "";

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

		// Date_Finished
		$this->Date_Finished->ViewValue = $this->Date_Finished->CurrentValue;
		$this->Date_Finished->ViewValue = FormatDateTime($this->Date_Finished->ViewValue, 0);
		$this->Date_Finished->ViewCustomAttributes = "";

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

		// Contact_no
		$this->Contact_no->ViewValue = $this->Contact_no->CurrentValue;
		$this->Contact_no->ViewValue = FormatNumber($this->Contact_no->ViewValue, 0, -2, -2, -2);
		$this->Contact_no->ViewCustomAttributes = "";

		// SRN
		$this->SRN->LinkCustomAttributes = "";
		$this->SRN->HrefValue = "";
		$this->SRN->TooltipValue = "";

		// item_date_repaired
		$this->item_date_repaired->LinkCustomAttributes = "";
		$this->item_date_repaired->HrefValue = "";
		$this->item_date_repaired->TooltipValue = "";

		// item_requested_unit
		$this->item_requested_unit->LinkCustomAttributes = "";
		$this->item_requested_unit->HrefValue = "";
		$this->item_requested_unit->TooltipValue = "";

		// item_model
		$this->item_model->LinkCustomAttributes = "";
		$this->item_model->HrefValue = "";
		$this->item_model->TooltipValue = "";

		// item_serno
		$this->item_serno->LinkCustomAttributes = "";
		$this->item_serno->HrefValue = "";
		$this->item_serno->TooltipValue = "";

		// Current_loc
		$this->Current_loc->LinkCustomAttributes = "";
		$this->Current_loc->HrefValue = "";
		$this->Current_loc->TooltipValue = "";

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

		// Date_Finished
		$this->Date_Finished->LinkCustomAttributes = "";
		$this->Date_Finished->HrefValue = "";
		$this->Date_Finished->TooltipValue = "";

		// Request
		$this->__Request->LinkCustomAttributes = "";
		$this->__Request->HrefValue = "";
		$this->__Request->TooltipValue = "";

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

		// SRN
		$this->SRN->EditAttrs["class"] = "form-control";
		$this->SRN->EditCustomAttributes = "";
		if (!$this->SRN->Raw)
			$this->SRN->CurrentValue = HtmlDecode($this->SRN->CurrentValue);
		$this->SRN->EditValue = $this->SRN->CurrentValue;
		$this->SRN->PlaceHolder = RemoveHtml($this->SRN->caption());

		// item_date_repaired
		$this->item_date_repaired->EditAttrs["class"] = "form-control";
		$this->item_date_repaired->EditCustomAttributes = "";
		$this->item_date_repaired->EditValue = FormatDateTime($this->item_date_repaired->CurrentValue, 5);
		$this->item_date_repaired->PlaceHolder = RemoveHtml($this->item_date_repaired->caption());

		// item_requested_unit
		$this->item_requested_unit->EditAttrs["class"] = "form-control";
		$this->item_requested_unit->EditCustomAttributes = "";

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

		// Current_loc
		$this->Current_loc->EditAttrs["class"] = "form-control";
		$this->Current_loc->EditCustomAttributes = "";

		// item_transmittal
		$this->item_transmittal->EditAttrs["class"] = "form-control";
		$this->item_transmittal->EditCustomAttributes = "";

		// position
		$this->position->EditAttrs["class"] = "form-control";
		$this->position->EditCustomAttributes = "";

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

		// remarks
		$this->remarks->EditAttrs["class"] = "form-control";
		$this->remarks->EditCustomAttributes = "";
		$this->remarks->EditValue = $this->remarks->CurrentValue;
		$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

		// Date_Finished
		$this->Date_Finished->EditAttrs["class"] = "form-control";
		$this->Date_Finished->EditCustomAttributes = "";
		$this->Date_Finished->EditValue = FormatDateTime($this->Date_Finished->CurrentValue, 8);
		$this->Date_Finished->PlaceHolder = RemoveHtml($this->Date_Finished->caption());

		// Request
		$this->__Request->EditAttrs["class"] = "form-control";
		$this->__Request->EditCustomAttributes = "";

		// employeeid
		$this->employeeid->EditAttrs["class"] = "form-control";
		$this->employeeid->EditCustomAttributes = "";

		// status_id
		$this->status_id->EditAttrs["class"] = "form-control";
		$this->status_id->EditCustomAttributes = "";

		// Contact_no
		$this->Contact_no->EditAttrs["class"] = "form-control";
		$this->Contact_no->EditCustomAttributes = "";
		$this->Contact_no->EditValue = $this->Contact_no->CurrentValue;
		$this->Contact_no->PlaceHolder = RemoveHtml($this->Contact_no->caption());

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
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->item_requested_unit);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->Current_loc);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->position);
					$doc->exportCaption($this->item_type_problem);
					$doc->exportCaption($this->item_action_taken);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->Date_Finished);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->status_id);
					$doc->exportCaption($this->Contact_no);
				} else {
					$doc->exportCaption($this->SRN);
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->item_requested_unit);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->position);
					$doc->exportCaption($this->item_type_problem);
					$doc->exportCaption($this->item_action_taken);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->Date_Finished);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->status_id);
					$doc->exportCaption($this->Contact_no);
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
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->item_requested_unit);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->Current_loc);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->position);
						$doc->exportField($this->item_type_problem);
						$doc->exportField($this->item_action_taken);
						$doc->exportField($this->remarks);
						$doc->exportField($this->Date_Finished);
						$doc->exportField($this->__Request);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->status_id);
						$doc->exportField($this->Contact_no);
					} else {
						$doc->exportField($this->SRN);
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->item_requested_unit);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->position);
						$doc->exportField($this->item_type_problem);
						$doc->exportField($this->item_action_taken);
						$doc->exportField($this->remarks);
						$doc->exportField($this->Date_Finished);
						$doc->exportField($this->__Request);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->status_id);
						$doc->exportField($this->Contact_no);
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