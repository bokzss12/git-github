<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for tbl_encoder
 */
class tbl_encoder extends DbTable
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
	public $encoder_id;
	public $encoder_month;
	public $encoder_year;
	public $date;
	public $activities;
	public $action_taken;
	public $total_encoded;
	public $status_remark;
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
		$this->TableVar = 'tbl_encoder';
		$this->TableName = 'tbl_encoder';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_encoder`";
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

		// encoder_id
		$this->encoder_id = new DbField('tbl_encoder', 'tbl_encoder', 'x_encoder_id', 'encoder_id', '`encoder_id`', '`encoder_id`', 3, 11, -1, FALSE, '`encoder_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->encoder_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->encoder_id->IsPrimaryKey = TRUE; // Primary key field
		$this->encoder_id->Sortable = TRUE; // Allow sort
		$this->encoder_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['encoder_id'] = &$this->encoder_id;

		// encoder_month
		$this->encoder_month = new DbField('tbl_encoder', 'tbl_encoder', 'x_encoder_month', 'encoder_month', '`encoder_month`', '`encoder_month`', 3, 11, -1, FALSE, '`encoder_month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->encoder_month->Sortable = FALSE; // Allow sort
		$this->encoder_month->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->encoder_month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->encoder_month->Lookup = new Lookup('encoder_month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->encoder_month->Lookup = new Lookup('encoder_month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->encoder_month->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['encoder_month'] = &$this->encoder_month;

		// encoder_year
		$this->encoder_year = new DbField('tbl_encoder', 'tbl_encoder', 'x_encoder_year', 'encoder_year', '`encoder_year`', '`encoder_year`', 3, 11, -1, FALSE, '`encoder_year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->encoder_year->Sortable = FALSE; // Allow sort
		$this->encoder_year->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->encoder_year->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->encoder_year->Lookup = new Lookup('encoder_year', 'tbl_year', FALSE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` DESC', '');
				break;
			default:
				$this->encoder_year->Lookup = new Lookup('encoder_year', 'tbl_year', FALSE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` DESC', '');
				break;
		}
		$this->encoder_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['encoder_year'] = &$this->encoder_year;

		// date
		$this->date = new DbField('tbl_encoder', 'tbl_encoder', 'x_date', 'date', '`date`', CastDateFieldForLike("`date`", 5, "DB"), 133, 10, 5, FALSE, '`date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date->Required = TRUE; // Required field
		$this->date->Sortable = TRUE; // Allow sort
		$this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['date'] = &$this->date;

		// activities
		$this->activities = new DbField('tbl_encoder', 'tbl_encoder', 'x_activities', 'activities', '`activities`', '`activities`', 3, 11, -1, FALSE, '`activities`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->activities->Required = TRUE; // Required field
		$this->activities->Sortable = TRUE; // Allow sort
		$this->activities->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->activities->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->activities->Lookup = new Lookup('activities', 'tbl_encoder_lactivities', FALSE, 'enc_activities_id', ["enc_activities_id","List_Activities","",""], [], [], [], [], [], [], '`enc_activities_id` ASC', '');
				break;
			default:
				$this->activities->Lookup = new Lookup('activities', 'tbl_encoder_lactivities', FALSE, 'enc_activities_id', ["enc_activities_id","List_Activities","",""], [], [], [], [], [], [], '`enc_activities_id` ASC', '');
				break;
		}
		$this->activities->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['activities'] = &$this->activities;

		// action_taken
		$this->action_taken = new DbField('tbl_encoder', 'tbl_encoder', 'x_action_taken', 'action_taken', '`action_taken`', '`action_taken`', 201, 500, -1, FALSE, '`action_taken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->action_taken->Required = TRUE; // Required field
		$this->action_taken->Sortable = TRUE; // Allow sort
		$this->action_taken->MemoMaxLength = 30;
		$this->fields['action_taken'] = &$this->action_taken;

		// total_encoded
		$this->total_encoded = new DbField('tbl_encoder', 'tbl_encoder', 'x_total_encoded', 'total_encoded', '`total_encoded`', '`total_encoded`', 131, 50, -1, FALSE, '`total_encoded`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_encoded->Sortable = TRUE; // Allow sort
		$this->total_encoded->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_encoded'] = &$this->total_encoded;

		// status_remark
		$this->status_remark = new DbField('tbl_encoder', 'tbl_encoder', 'x_status_remark', 'status_remark', '`status_remark`', '`status_remark`', 3, 11, -1, FALSE, '`status_remark`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_remark->Required = TRUE; // Required field
		$this->status_remark->Sortable = TRUE; // Allow sort
		$this->status_remark->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_remark->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status_remark->Lookup = new Lookup('status_remark', 'tbl_encoder_status', FALSE, 'status_enc_id', ["status_enc_id","status_remark","",""], [], [], [], [], [], [], '`status_enc_id` ASC', '');
				break;
			default:
				$this->status_remark->Lookup = new Lookup('status_remark', 'tbl_encoder_status', FALSE, 'status_enc_id', ["status_enc_id","status_remark","",""], [], [], [], [], [], [], '`status_enc_id` ASC', '');
				break;
		}
		$this->status_remark->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status_remark'] = &$this->status_remark;

		// employee_id
		$this->employee_id = new DbField('tbl_encoder', 'tbl_encoder', 'x_employee_id', 'employee_id', '`employee_id`', '`employee_id`', 3, 11, -1, FALSE, '`employee_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employee_id->Required = TRUE; // Required field
		$this->employee_id->Sortable = TRUE; // Allow sort
		$this->employee_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employee_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
			default:
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
		}
		$this->employee_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employee_id'] = &$this->employee_id;

		// user_last_modify
		$this->user_last_modify = new DbField('tbl_encoder', 'tbl_encoder', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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
		$this->date_last_modify = new DbField('tbl_encoder', 'tbl_encoder', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 0, "DB"), 135, 19, 0, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`tbl_encoder`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`encoder_id` DESC";
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
			$this->encoder_id->setDbValue($conn->insert_ID());
			$rs['encoder_id'] = $this->encoder_id->DbValue;
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
			$fldname = 'encoder_id';
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
			if (array_key_exists('encoder_id', $rs))
				AddFilter($where, QuotedName('encoder_id', $this->Dbid) . '=' . QuotedValue($rs['encoder_id'], $this->encoder_id->DataType, $this->Dbid));
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
		$this->encoder_id->DbValue = $row['encoder_id'];
		$this->encoder_month->DbValue = $row['encoder_month'];
		$this->encoder_year->DbValue = $row['encoder_year'];
		$this->date->DbValue = $row['date'];
		$this->activities->DbValue = $row['activities'];
		$this->action_taken->DbValue = $row['action_taken'];
		$this->total_encoded->DbValue = $row['total_encoded'];
		$this->status_remark->DbValue = $row['status_remark'];
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
		return "`encoder_id` = @encoder_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('encoder_id', $row) ? $row['encoder_id'] : NULL;
		else
			$val = $this->encoder_id->OldValue !== NULL ? $this->encoder_id->OldValue : $this->encoder_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@encoder_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_encoderlist.php";
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
		if ($pageName == "tbl_encoderview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_encoderedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_encoderadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_encoderlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tbl_encoderview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_encoderview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "tbl_encoderadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_encoderadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_encoderedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("tbl_encoderadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("tbl_encoderdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "encoder_id:" . JsonEncode($this->encoder_id->CurrentValue, "number");
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
		if ($this->encoder_id->CurrentValue != NULL) {
			$url .= "encoder_id=" . urlencode($this->encoder_id->CurrentValue);
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
			if (Param("encoder_id") !== NULL)
				$arKeys[] = Param("encoder_id");
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
				$this->encoder_id->CurrentValue = $key;
			else
				$this->encoder_id->OldValue = $key;
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
		$this->encoder_id->setDbValue($rs->fields('encoder_id'));
		$this->encoder_month->setDbValue($rs->fields('encoder_month'));
		$this->encoder_year->setDbValue($rs->fields('encoder_year'));
		$this->date->setDbValue($rs->fields('date'));
		$this->activities->setDbValue($rs->fields('activities'));
		$this->action_taken->setDbValue($rs->fields('action_taken'));
		$this->total_encoded->setDbValue($rs->fields('total_encoded'));
		$this->status_remark->setDbValue($rs->fields('status_remark'));
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
		// encoder_id

		$this->encoder_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// encoder_month
		$this->encoder_month->CellCssStyle = "width: 0px; white-space: nowrap;";

		// encoder_year
		$this->encoder_year->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date
		$this->date->CellCssStyle = "width: 0px; white-space: nowrap;";

		// activities
		$this->activities->CellCssStyle = "width: 0px; white-space: nowrap;";

		// action_taken
		$this->action_taken->CellCssStyle = "width: 0px; white-space: nowrap;";

		// total_encoded
		$this->total_encoded->CellCssStyle = "width: 0px; white-space: nowrap;";

		// status_remark
		$this->status_remark->CellCssStyle = "width: 0px; white-space: nowrap;";

		// employee_id
		$this->employee_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_last_modify
		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_last_modify
		$this->date_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// encoder_id
		$this->encoder_id->ViewValue = $this->encoder_id->CurrentValue;
		$this->encoder_id->ViewCustomAttributes = "";

		// encoder_month
		$curVal = strval($this->encoder_month->CurrentValue);
		if ($curVal != "") {
			$this->encoder_month->ViewValue = $this->encoder_month->lookupCacheOption($curVal);
			if ($this->encoder_month->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`month_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->encoder_month->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->encoder_month->ViewValue = $this->encoder_month->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->encoder_month->ViewValue = $this->encoder_month->CurrentValue;
				}
			}
		} else {
			$this->encoder_month->ViewValue = NULL;
		}
		$this->encoder_month->ViewCustomAttributes = "";

		// encoder_year
		$curVal = strval($this->encoder_year->CurrentValue);
		if ($curVal != "") {
			$this->encoder_year->ViewValue = $this->encoder_year->lookupCacheOption($curVal);
			if ($this->encoder_year->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`year_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->encoder_year->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->encoder_year->ViewValue = $this->encoder_year->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->encoder_year->ViewValue = $this->encoder_year->CurrentValue;
				}
			}
		} else {
			$this->encoder_year->ViewValue = NULL;
		}
		$this->encoder_year->ViewCustomAttributes = "";

		// date
		$this->date->ViewValue = $this->date->CurrentValue;
		$this->date->ViewValue = FormatDateTime($this->date->ViewValue, 5);
		$this->date->ViewCustomAttributes = "";

		// activities
		$curVal = strval($this->activities->CurrentValue);
		if ($curVal != "") {
			$this->activities->ViewValue = $this->activities->lookupCacheOption($curVal);
			if ($this->activities->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`enc_activities_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->activities->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->activities->ViewValue = $this->activities->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->activities->ViewValue = $this->activities->CurrentValue;
				}
			}
		} else {
			$this->activities->ViewValue = NULL;
		}
		$this->activities->ViewCustomAttributes = "";

		// action_taken
		$this->action_taken->ViewValue = $this->action_taken->CurrentValue;
		if ($this->action_taken->ViewValue != NULL)
			$this->action_taken->ViewValue = str_replace("\n", "<br>", $this->action_taken->ViewValue);
		$this->action_taken->CellCssStyle .= "text-align: left;";
		$this->action_taken->ViewCustomAttributes = "";

		// total_encoded
		$this->total_encoded->ViewValue = $this->total_encoded->CurrentValue;
		$this->total_encoded->ViewValue = FormatNumber($this->total_encoded->ViewValue, 0, -1, -1, -1);
		$this->total_encoded->CellCssStyle .= "text-align: right;";
		$this->total_encoded->ViewCustomAttributes = "";

		// status_remark
		$curVal = strval($this->status_remark->CurrentValue);
		if ($curVal != "") {
			$this->status_remark->ViewValue = $this->status_remark->lookupCacheOption($curVal);
			if ($this->status_remark->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`status_enc_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->status_remark->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->status_remark->ViewValue = $this->status_remark->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status_remark->ViewValue = $this->status_remark->CurrentValue;
				}
			}
		} else {
			$this->status_remark->ViewValue = NULL;
		}
		$this->status_remark->CellCssStyle .= "text-align: left;";
		$this->status_remark->ViewCustomAttributes = "";

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
		$this->employee_id->CellCssStyle .= "text-align: left;";
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

		// encoder_id
		$this->encoder_id->LinkCustomAttributes = "";
		$this->encoder_id->HrefValue = "";
		$this->encoder_id->TooltipValue = "";

		// encoder_month
		$this->encoder_month->LinkCustomAttributes = "";
		$this->encoder_month->HrefValue = "";
		$this->encoder_month->TooltipValue = "";

		// encoder_year
		$this->encoder_year->LinkCustomAttributes = "";
		$this->encoder_year->HrefValue = "";
		$this->encoder_year->TooltipValue = "";

		// date
		$this->date->LinkCustomAttributes = "";
		$this->date->HrefValue = "";
		$this->date->TooltipValue = "";

		// activities
		$this->activities->LinkCustomAttributes = "";
		$this->activities->HrefValue = "";
		$this->activities->TooltipValue = "";

		// action_taken
		$this->action_taken->LinkCustomAttributes = "";
		$this->action_taken->HrefValue = "";
		$this->action_taken->TooltipValue = "";

		// total_encoded
		$this->total_encoded->LinkCustomAttributes = "";
		$this->total_encoded->HrefValue = "";
		$this->total_encoded->TooltipValue = "";

		// status_remark
		$this->status_remark->LinkCustomAttributes = "";
		$this->status_remark->HrefValue = "";
		$this->status_remark->TooltipValue = "";

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

		// encoder_id
		$this->encoder_id->EditAttrs["class"] = "form-control";
		$this->encoder_id->EditCustomAttributes = "";
		$this->encoder_id->EditValue = $this->encoder_id->CurrentValue;
		$this->encoder_id->ViewCustomAttributes = "";

		// encoder_month
		$this->encoder_month->EditAttrs["class"] = "form-control";
		$this->encoder_month->EditCustomAttributes = "";

		// encoder_year
		$this->encoder_year->EditAttrs["class"] = "form-control";
		$this->encoder_year->EditCustomAttributes = "";

		// date
		$this->date->EditAttrs["class"] = "form-control";
		$this->date->EditCustomAttributes = "";
		$this->date->EditValue = FormatDateTime($this->date->CurrentValue, 5);
		$this->date->PlaceHolder = RemoveHtml($this->date->caption());

		// activities
		$this->activities->EditAttrs["class"] = "form-control";
		$this->activities->EditCustomAttributes = "";

		// action_taken
		$this->action_taken->EditAttrs["class"] = "form-control";
		$this->action_taken->EditCustomAttributes = "";
		$this->action_taken->EditValue = $this->action_taken->CurrentValue;
		$this->action_taken->PlaceHolder = RemoveHtml($this->action_taken->caption());

		// total_encoded
		$this->total_encoded->EditAttrs["class"] = "form-control";
		$this->total_encoded->EditCustomAttributes = "";
		$this->total_encoded->EditValue = $this->total_encoded->CurrentValue;
		$this->total_encoded->PlaceHolder = RemoveHtml($this->total_encoded->caption());
		if (strval($this->total_encoded->EditValue) != "" && is_numeric($this->total_encoded->EditValue))
			$this->total_encoded->EditValue = FormatNumber($this->total_encoded->EditValue, -2, -1, -2, -1);
		

		// status_remark
		$this->status_remark->EditAttrs["class"] = "form-control";
		$this->status_remark->EditCustomAttributes = "";

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
			$this->employee_id->CellCssStyle .= "text-align: left;";
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
			if (is_numeric($this->total_encoded->CurrentValue))
				$this->total_encoded->Total += $this->total_encoded->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->total_encoded->CurrentValue = $this->total_encoded->Total;
			$this->total_encoded->ViewValue = $this->total_encoded->CurrentValue;
			$this->total_encoded->ViewValue = FormatNumber($this->total_encoded->ViewValue, 0, -1, -1, -1);
			$this->total_encoded->CellCssStyle .= "text-align: right;";
			$this->total_encoded->ViewCustomAttributes = "";
			$this->total_encoded->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->date);
					$doc->exportCaption($this->activities);
					$doc->exportCaption($this->action_taken);
					$doc->exportCaption($this->total_encoded);
					$doc->exportCaption($this->status_remark);
					$doc->exportCaption($this->employee_id);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
				} else {
					$doc->exportCaption($this->encoder_id);
					$doc->exportCaption($this->date);
					$doc->exportCaption($this->activities);
					$doc->exportCaption($this->action_taken);
					$doc->exportCaption($this->total_encoded);
					$doc->exportCaption($this->status_remark);
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
						$doc->exportField($this->date);
						$doc->exportField($this->activities);
						$doc->exportField($this->action_taken);
						$doc->exportField($this->total_encoded);
						$doc->exportField($this->status_remark);
						$doc->exportField($this->employee_id);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
					} else {
						$doc->exportField($this->encoder_id);
						$doc->exportField($this->date);
						$doc->exportField($this->activities);
						$doc->exportField($this->action_taken);
						$doc->exportField($this->total_encoded);
						$doc->exportField($this->status_remark);
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
				$doc->exportAggregate($this->encoder_id, '');
				$doc->exportAggregate($this->date, '');
				$doc->exportAggregate($this->activities, '');
				$doc->exportAggregate($this->action_taken, '');
				$doc->exportAggregate($this->total_encoded, 'TOTAL');
				$doc->exportAggregate($this->status_remark, '');
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
		$sql = "SELECT " . $masterfld->Expression . " FROM `tbl_encoder`";
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
		$table = 'tbl_encoder';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_encoder';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['encoder_id'];

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
		$table = 'tbl_encoder';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['encoder_id'];

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
		$table = 'tbl_encoder';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['encoder_id'];

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
	//$rsnew["action_taken"]=mb_strtoupper($rsnew["action_taken"]);
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
	//$rsnew["action_taken"]=mb_strtoupper($rsnew["action_taken"]);
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