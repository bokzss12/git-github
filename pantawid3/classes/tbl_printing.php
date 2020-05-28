<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for tbl_printing
 */
class tbl_printing extends DbTable
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
	public $printingID;
	public $printing_month;
	public $printing_year;
	public $printing_date;
	public $printing_type;
	public $printed_forms;
	public $total_forms;
	public $status_printing;
	public $employee_id;
	public $user_last_modify;
	public $date_last_modify;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_printing';
		$this->TableName = 'tbl_printing';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_printing`";
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

		// printingID
		$this->printingID = new DbField('tbl_printing', 'tbl_printing', 'x_printingID', 'printingID', '`printingID`', '`printingID`', 3, 11, -1, FALSE, '`printingID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->printingID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->printingID->IsPrimaryKey = TRUE; // Primary key field
		$this->printingID->Sortable = TRUE; // Allow sort
		$this->printingID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['printingID'] = &$this->printingID;

		// printing_month
		$this->printing_month = new DbField('tbl_printing', 'tbl_printing', 'x_printing_month', 'printing_month', '`printing_month`', '`printing_month`', 3, 11, -1, FALSE, '`printing_month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->printing_month->Sortable = FALSE; // Allow sort
		$this->printing_month->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->printing_month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->printing_month->Lookup = new Lookup('printing_month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->printing_month->Lookup = new Lookup('printing_month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->printing_month->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['printing_month'] = &$this->printing_month;

		// printing_year
		$this->printing_year = new DbField('tbl_printing', 'tbl_printing', 'x_printing_year', 'printing_year', '`printing_year`', '`printing_year`', 3, 11, -1, FALSE, '`printing_year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->printing_year->Sortable = FALSE; // Allow sort
		$this->printing_year->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->printing_year->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->printing_year->Lookup = new Lookup('printing_year', 'tbl_year', FALSE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` DESC', '');
				break;
			default:
				$this->printing_year->Lookup = new Lookup('printing_year', 'tbl_year', FALSE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` DESC', '');
				break;
		}
		$this->printing_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['printing_year'] = &$this->printing_year;

		// printing_date
		$this->printing_date = new DbField('tbl_printing', 'tbl_printing', 'x_printing_date', 'printing_date', '`printing_date`', CastDateFieldForLike("`printing_date`", 5, "DB"), 133, 10, 5, FALSE, '`printing_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->printing_date->Required = TRUE; // Required field
		$this->printing_date->Sortable = TRUE; // Allow sort
		$this->printing_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['printing_date'] = &$this->printing_date;

		// printing_type
		$this->printing_type = new DbField('tbl_printing', 'tbl_printing', 'x_printing_type', 'printing_type', '`printing_type`', '`printing_type`', 3, 11, -1, FALSE, '`printing_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->printing_type->Required = TRUE; // Required field
		$this->printing_type->Sortable = TRUE; // Allow sort
		$this->printing_type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->printing_type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->printing_type->Lookup = new Lookup('printing_type', 'tbl_printingtype', FALSE, 'printingtypeID', ["printingtypeID","typeofprinting","",""], [], [], [], [], [], [], '`printingtypeID` ASC', '');
				break;
			default:
				$this->printing_type->Lookup = new Lookup('printing_type', 'tbl_printingtype', FALSE, 'printingtypeID', ["printingtypeID","typeofprinting","",""], [], [], [], [], [], [], '`printingtypeID` ASC', '');
				break;
		}
		$this->printing_type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['printing_type'] = &$this->printing_type;

		// printed_forms
		$this->printed_forms = new DbField('tbl_printing', 'tbl_printing', 'x_printed_forms', 'printed_forms', '`printed_forms`', '`printed_forms`', 201, 500, -1, FALSE, '`printed_forms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->printed_forms->Required = TRUE; // Required field
		$this->printed_forms->Sortable = TRUE; // Allow sort
		$this->printed_forms->MemoMaxLength = 30;
		$this->fields['printed_forms'] = &$this->printed_forms;

		// total_forms
		$this->total_forms = new DbField('tbl_printing', 'tbl_printing', 'x_total_forms', 'total_forms', '`total_forms`', '`total_forms`', 131, 50, -1, FALSE, '`total_forms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_forms->Required = TRUE; // Required field
		$this->total_forms->Sortable = TRUE; // Allow sort
		$this->total_forms->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_forms'] = &$this->total_forms;

		// status_printing
		$this->status_printing = new DbField('tbl_printing', 'tbl_printing', 'x_status_printing', 'status_printing', '`status_printing`', '`status_printing`', 3, 11, -1, FALSE, '`status_printing`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_printing->Required = TRUE; // Required field
		$this->status_printing->Sortable = TRUE; // Allow sort
		$this->status_printing->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_printing->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status_printing->Lookup = new Lookup('status_printing', 'tbl_printing_status', FALSE, 'status_printingID', ["status_printingID","statusPrinting","",""], [], [], [], [], [], [], '`status_printingID` ASC', '');
				break;
			default:
				$this->status_printing->Lookup = new Lookup('status_printing', 'tbl_printing_status', FALSE, 'status_printingID', ["status_printingID","statusPrinting","",""], [], [], [], [], [], [], '`status_printingID` ASC', '');
				break;
		}
		$this->status_printing->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status_printing'] = &$this->status_printing;

		// employee_id
		$this->employee_id = new DbField('tbl_printing', 'tbl_printing', 'x_employee_id', 'employee_id', '`employee_id`', '`employee_id`', 3, 11, -1, FALSE, '`employee_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employee_id->Required = TRUE; // Required field
		$this->employee_id->Sortable = TRUE; // Allow sort
		$this->employee_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employee_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`username` ASC', '');
				break;
			default:
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`username` ASC', '');
				break;
		}
		$this->employee_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employee_id'] = &$this->employee_id;

		// user_last_modify
		$this->user_last_modify = new DbField('tbl_printing', 'tbl_printing', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->user_last_modify->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->user_last_modify->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->user_last_modify->Lookup = new Lookup('user_last_modify', 'employee', FALSE, 'username', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->user_last_modify->Lookup = new Lookup('user_last_modify', 'employee', FALSE, 'username', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// date_last_modify
		$this->date_last_modify = new DbField('tbl_printing', 'tbl_printing', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 0, "DB"), 135, 19, 0, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_last_modify->Sortable = TRUE; // Allow sort
		$this->date_last_modify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_last_modify'] = &$this->date_last_modify;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`tbl_printing`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`printingID` DESC";
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
		global $Security;

		// Add User ID filter
		if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
			$filter = $this->addUserIDFilter($filter, $id);
		}
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
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

			// Get insert id if necessary
			$this->printingID->setDbValue($conn->insert_ID());
			$rs['printingID'] = $this->printingID->DbValue;
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
			$fldname = 'printingID';
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
			if (array_key_exists('printingID', $rs))
				AddFilter($where, QuotedName('printingID', $this->Dbid) . '=' . QuotedValue($rs['printingID'], $this->printingID->DataType, $this->Dbid));
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
		$this->printingID->DbValue = $row['printingID'];
		$this->printing_month->DbValue = $row['printing_month'];
		$this->printing_year->DbValue = $row['printing_year'];
		$this->printing_date->DbValue = $row['printing_date'];
		$this->printing_type->DbValue = $row['printing_type'];
		$this->printed_forms->DbValue = $row['printed_forms'];
		$this->total_forms->DbValue = $row['total_forms'];
		$this->status_printing->DbValue = $row['status_printing'];
		$this->employee_id->DbValue = $row['employee_id'];
		$this->user_last_modify->DbValue = $row['user_last_modify'];
		$this->date_last_modify->DbValue = $row['date_last_modify'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`printingID` = @printingID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('printingID', $row) ? $row['printingID'] : NULL;
		else
			$val = $this->printingID->OldValue !== NULL ? $this->printingID->OldValue : $this->printingID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@printingID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_printinglist.php";
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
		if ($pageName == "tbl_printingview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_printingedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_printingadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_printinglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tbl_printingview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_printingview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "tbl_printingadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_printingadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_printingedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("tbl_printingadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("tbl_printingdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "printingID:" . JsonEncode($this->printingID->CurrentValue, "number");
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
		if ($this->printingID->CurrentValue != NULL) {
			$url .= "printingID=" . urlencode($this->printingID->CurrentValue);
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
			if (Param("printingID") !== NULL)
				$arKeys[] = Param("printingID");
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
				$this->printingID->CurrentValue = $key;
			else
				$this->printingID->OldValue = $key;
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
		$this->printingID->setDbValue($rs->fields('printingID'));
		$this->printing_month->setDbValue($rs->fields('printing_month'));
		$this->printing_year->setDbValue($rs->fields('printing_year'));
		$this->printing_date->setDbValue($rs->fields('printing_date'));
		$this->printing_type->setDbValue($rs->fields('printing_type'));
		$this->printed_forms->setDbValue($rs->fields('printed_forms'));
		$this->total_forms->setDbValue($rs->fields('total_forms'));
		$this->status_printing->setDbValue($rs->fields('status_printing'));
		$this->employee_id->setDbValue($rs->fields('employee_id'));
		$this->user_last_modify->setDbValue($rs->fields('user_last_modify'));
		$this->date_last_modify->setDbValue($rs->fields('date_last_modify'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// printingID

		$this->printingID->CellCssStyle = "width: 0px; white-space: nowrap;";

		// printing_month
		$this->printing_month->CellCssStyle = "width: 0px; white-space: nowrap;";

		// printing_year
		$this->printing_year->CellCssStyle = "width: 0px; white-space: nowrap;";

		// printing_date
		$this->printing_date->CellCssStyle = "width: 0px; white-space: nowrap;";

		// printing_type
		$this->printing_type->CellCssStyle = "width: 0px; white-space: nowrap;";

		// printed_forms
		$this->printed_forms->CellCssStyle = "width: 0px; white-space: nowrap;";

		// total_forms
		$this->total_forms->CellCssStyle = "width: 0px; white-space: nowrap;";

		// status_printing
		$this->status_printing->CellCssStyle = "width: 0px; white-space: nowrap;";

		// employee_id
		$this->employee_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_last_modify
		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_last_modify
		$this->date_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// printingID
		$this->printingID->ViewValue = $this->printingID->CurrentValue;
		$this->printingID->ViewCustomAttributes = "";

		// printing_month
		$curVal = strval($this->printing_month->CurrentValue);
		if ($curVal != "") {
			$this->printing_month->ViewValue = $this->printing_month->lookupCacheOption($curVal);
			if ($this->printing_month->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`month_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->printing_month->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->printing_month->ViewValue = $this->printing_month->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->printing_month->ViewValue = $this->printing_month->CurrentValue;
				}
			}
		} else {
			$this->printing_month->ViewValue = NULL;
		}
		$this->printing_month->ViewCustomAttributes = "";

		// printing_year
		$curVal = strval($this->printing_year->CurrentValue);
		if ($curVal != "") {
			$this->printing_year->ViewValue = $this->printing_year->lookupCacheOption($curVal);
			if ($this->printing_year->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`year_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->printing_year->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->printing_year->ViewValue = $this->printing_year->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->printing_year->ViewValue = $this->printing_year->CurrentValue;
				}
			}
		} else {
			$this->printing_year->ViewValue = NULL;
		}
		$this->printing_year->ViewCustomAttributes = "";

		// printing_date
		$this->printing_date->ViewValue = $this->printing_date->CurrentValue;
		$this->printing_date->ViewValue = FormatDateTime($this->printing_date->ViewValue, 5);
		$this->printing_date->ViewCustomAttributes = "";

		// printing_type
		$curVal = strval($this->printing_type->CurrentValue);
		if ($curVal != "") {
			$this->printing_type->ViewValue = $this->printing_type->lookupCacheOption($curVal);
			if ($this->printing_type->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`printingtypeID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->printing_type->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->printing_type->ViewValue = $this->printing_type->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->printing_type->ViewValue = $this->printing_type->CurrentValue;
				}
			}
		} else {
			$this->printing_type->ViewValue = NULL;
		}
		$this->printing_type->ViewCustomAttributes = "";

		// printed_forms
		$this->printed_forms->ViewValue = $this->printed_forms->CurrentValue;
		if ($this->printed_forms->ViewValue != NULL)
			$this->printed_forms->ViewValue = str_replace("\n", "<br>", $this->printed_forms->ViewValue);
		$this->printed_forms->ViewCustomAttributes = "";

		// total_forms
		$this->total_forms->ViewValue = $this->total_forms->CurrentValue;
		$this->total_forms->ViewValue = FormatNumber($this->total_forms->ViewValue, 0, -1, -1, -1);
		$this->total_forms->CellCssStyle .= "text-align: right;";
		$this->total_forms->ViewCustomAttributes = "";

		// status_printing
		$curVal = strval($this->status_printing->CurrentValue);
		if ($curVal != "") {
			$this->status_printing->ViewValue = $this->status_printing->lookupCacheOption($curVal);
			if ($this->status_printing->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`status_printingID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->status_printing->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->status_printing->ViewValue = $this->status_printing->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status_printing->ViewValue = $this->status_printing->CurrentValue;
				}
			}
		} else {
			$this->status_printing->ViewValue = NULL;
		}
		$this->status_printing->ViewCustomAttributes = "";

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
		$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
		$this->date_last_modify->ViewCustomAttributes = "";

		// printingID
		$this->printingID->LinkCustomAttributes = "";
		$this->printingID->HrefValue = "";
		$this->printingID->TooltipValue = "";

		// printing_month
		$this->printing_month->LinkCustomAttributes = "";
		$this->printing_month->HrefValue = "";
		$this->printing_month->TooltipValue = "";

		// printing_year
		$this->printing_year->LinkCustomAttributes = "";
		$this->printing_year->HrefValue = "";
		$this->printing_year->TooltipValue = "";

		// printing_date
		$this->printing_date->LinkCustomAttributes = "";
		$this->printing_date->HrefValue = "";
		$this->printing_date->TooltipValue = "";

		// printing_type
		$this->printing_type->LinkCustomAttributes = "";
		$this->printing_type->HrefValue = "";
		$this->printing_type->TooltipValue = "";

		// printed_forms
		$this->printed_forms->LinkCustomAttributes = "";
		$this->printed_forms->HrefValue = "";
		$this->printed_forms->TooltipValue = "";

		// total_forms
		$this->total_forms->LinkCustomAttributes = "";
		$this->total_forms->HrefValue = "";
		$this->total_forms->TooltipValue = "";

		// status_printing
		$this->status_printing->LinkCustomAttributes = "";
		$this->status_printing->HrefValue = "";
		$this->status_printing->TooltipValue = "";

		// employee_id
		$this->employee_id->LinkCustomAttributes = "";
		$this->employee_id->HrefValue = "";
		$this->employee_id->TooltipValue = "";

		// user_last_modify
		$this->user_last_modify->LinkCustomAttributes = "";
		$this->user_last_modify->HrefValue = "";
		$this->user_last_modify->TooltipValue = "";

		// date_last_modify
		$this->date_last_modify->LinkCustomAttributes = "";
		$this->date_last_modify->HrefValue = "";
		$this->date_last_modify->TooltipValue = "";

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

		// printingID
		$this->printingID->EditAttrs["class"] = "form-control";
		$this->printingID->EditCustomAttributes = "";
		$this->printingID->EditValue = $this->printingID->CurrentValue;
		$this->printingID->ViewCustomAttributes = "";

		// printing_month
		$this->printing_month->EditAttrs["class"] = "form-control";
		$this->printing_month->EditCustomAttributes = "";

		// printing_year
		$this->printing_year->EditAttrs["class"] = "form-control";
		$this->printing_year->EditCustomAttributes = "";

		// printing_date
		$this->printing_date->EditAttrs["class"] = "form-control";
		$this->printing_date->EditCustomAttributes = "";
		$this->printing_date->EditValue = FormatDateTime($this->printing_date->CurrentValue, 5);
		$this->printing_date->PlaceHolder = RemoveHtml($this->printing_date->caption());

		// printing_type
		$this->printing_type->EditAttrs["class"] = "form-control";
		$this->printing_type->EditCustomAttributes = "";

		// printed_forms
		$this->printed_forms->EditAttrs["class"] = "form-control";
		$this->printed_forms->EditCustomAttributes = "";
		$this->printed_forms->EditValue = $this->printed_forms->CurrentValue;
		$this->printed_forms->PlaceHolder = RemoveHtml($this->printed_forms->caption());

		// total_forms
		$this->total_forms->EditAttrs["class"] = "form-control";
		$this->total_forms->EditCustomAttributes = "";
		$this->total_forms->EditValue = $this->total_forms->CurrentValue;
		$this->total_forms->PlaceHolder = RemoveHtml($this->total_forms->caption());
		if (strval($this->total_forms->EditValue) != "" && is_numeric($this->total_forms->EditValue))
			$this->total_forms->EditValue = FormatNumber($this->total_forms->EditValue, -2, -1, -2, -1);
		

		// status_printing
		$this->status_printing->EditAttrs["class"] = "form-control";
		$this->status_printing->EditCustomAttributes = "";

		// employee_id
		$this->employee_id->EditAttrs["class"] = "form-control";
		$this->employee_id->EditCustomAttributes = "";
		if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("info")) { // Non system admin
			$this->employee_id->CurrentValue = CurrentUserID();
			$curVal = strval($this->employee_id->CurrentValue);
			if ($curVal != "") {
				$this->employee_id->EditValue = $this->employee_id->lookupCacheOption($curVal);
				if ($this->employee_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`employeeid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->employee_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->employee_id->EditValue = $this->employee_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->employee_id->EditValue = $this->employee_id->CurrentValue;
					}
				}
			} else {
				$this->employee_id->EditValue = NULL;
			}
			$this->employee_id->ViewCustomAttributes = "";
		} else {
		}

		// user_last_modify
		// date_last_modify
		// Call Row Rendered event

		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->total_forms->CurrentValue))
				$this->total_forms->Total += $this->total_forms->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->total_forms->CurrentValue = $this->total_forms->Total;
			$this->total_forms->ViewValue = $this->total_forms->CurrentValue;
			$this->total_forms->ViewValue = FormatNumber($this->total_forms->ViewValue, 0, -1, -1, -1);
			$this->total_forms->CellCssStyle .= "text-align: right;";
			$this->total_forms->ViewCustomAttributes = "";
			$this->total_forms->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->printing_date);
					$doc->exportCaption($this->printing_type);
					$doc->exportCaption($this->printed_forms);
					$doc->exportCaption($this->total_forms);
					$doc->exportCaption($this->status_printing);
					$doc->exportCaption($this->employee_id);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
				} else {
					$doc->exportCaption($this->printingID);
					$doc->exportCaption($this->printing_date);
					$doc->exportCaption($this->printing_type);
					$doc->exportCaption($this->printed_forms);
					$doc->exportCaption($this->total_forms);
					$doc->exportCaption($this->status_printing);
					$doc->exportCaption($this->employee_id);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
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
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->printing_date);
						$doc->exportField($this->printing_type);
						$doc->exportField($this->printed_forms);
						$doc->exportField($this->total_forms);
						$doc->exportField($this->status_printing);
						$doc->exportField($this->employee_id);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
					} else {
						$doc->exportField($this->printingID);
						$doc->exportField($this->printing_date);
						$doc->exportField($this->printing_type);
						$doc->exportField($this->printed_forms);
						$doc->exportField($this->total_forms);
						$doc->exportField($this->status_printing);
						$doc->exportField($this->employee_id);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->printingID, '');
				$doc->exportAggregate($this->printing_date, '');
				$doc->exportAggregate($this->printing_type, '');
				$doc->exportAggregate($this->printed_forms, '');
				$doc->exportAggregate($this->total_forms, 'TOTAL');
				$doc->exportAggregate($this->status_printing, '');
				$doc->exportAggregate($this->employee_id, '');
				$doc->exportAggregate($this->user_last_modify, '');
				$doc->exportAggregate($this->date_last_modify, '');
				$doc->endExportRow();
			}
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Add User ID filter
	public function addUserIDFilter($filter = "", $id = "")
	{
		global $Security;
		$filterWrk = "";
		if ($id == "")
			$id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
		if (!$this->userIdAllow($id) && !$Security->isAdmin()) {
			$filterWrk = $Security->userIdList();
			if ($filterWrk != "")
				$filterWrk = '`employee_id` IN (' . $filterWrk . ')';
		}

		// Call User ID Filtering event
		$this->UserID_Filtering($filterWrk);
		AddFilter($filter, $filterWrk);
		return $filter;
	}

	// User ID subquery
	public function getUserIDSubquery(&$fld, &$masterfld)
	{
		global $UserTable;
		$wrk = "";
		$sql = "SELECT " . $masterfld->Expression . " FROM `tbl_printing`";
		$filter = $this->addUserIDFilter("");
		if ($filter != "")
			$sql .= " WHERE " . $filter;

		// Use subquery
		if (Config("USE_SUBQUERY_FOR_MASTER_USER_ID")) {
			$wrk = $sql;
		} else {

			// List all values
			if ($rs = Conn($UserTable->Dbid)->execute($sql)) {
				while (!$rs->EOF) {
					if ($wrk != "")
						$wrk .= ",";
					$wrk .= QuotedValue($rs->fields[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
					$rs->moveNext();
				}
				$rs->close();
			}
		}
		if ($wrk != "")
			$wrk = $fld->Expression . " IN (" . $wrk . ")";
		return $wrk;
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
		$table = 'tbl_printing';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_printing';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['printingID'];

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
		$table = 'tbl_printing';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['printingID'];

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
		$table = 'tbl_printing';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['printingID'];

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
	//$rsnew["printed_forms"]=mb_strtoupper($rsnew["printed_forms"]);
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
	//$rsnew["printed_forms"]=mb_strtoupper($rsnew["printed_forms"]);
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