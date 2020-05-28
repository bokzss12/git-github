<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for tbl_supplies
 */
class tbl_supplies extends DbTable
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
	public $id;
	public $supplies_cat;
	public $model;
	public $serial;
	public $status;
	public $remark;
	public $date_received;
	public $date_consumed;
	public $Supplier;
	public $employeeid;
	public $user_last_modify;
	public $user_date_modify;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_supplies';
		$this->TableName = 'tbl_supplies';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_supplies`";
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

		// id
		$this->id = new DbField('tbl_supplies', 'tbl_supplies', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// supplies_cat
		$this->supplies_cat = new DbField('tbl_supplies', 'tbl_supplies', 'x_supplies_cat', 'supplies_cat', '`supplies_cat`', '`supplies_cat`', 3, 11, -1, FALSE, '`supplies_cat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->supplies_cat->Sortable = TRUE; // Allow sort
		$this->supplies_cat->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->supplies_cat->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->supplies_cat->Lookup = new Lookup('supplies_cat', 'tbl_supplies_cat', FALSE, 'suppliescat_id', ["suppliescat_id","category_dsc","",""], [], [], [], [], [], [], '`suppliescat_id` ASC', '');
				break;
			default:
				$this->supplies_cat->Lookup = new Lookup('supplies_cat', 'tbl_supplies_cat', FALSE, 'suppliescat_id', ["suppliescat_id","category_dsc","",""], [], [], [], [], [], [], '`suppliescat_id` ASC', '');
				break;
		}
		$this->supplies_cat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['supplies_cat'] = &$this->supplies_cat;

		// model
		$this->model = new DbField('tbl_supplies', 'tbl_supplies', 'x_model', 'model', '`model`', '`model`', 3, 11, -1, FALSE, '`model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->model->Required = TRUE; // Required field
		$this->model->Sortable = TRUE; // Allow sort
		$this->model->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->model->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->model->Lookup = new Lookup('model', 'tbl_sup_type', FALSE, 'sup_listID', ["sup_listID","sup_types","",""], [], [], [], [], [], [], '`sup_listID` ASC', '');
				break;
			default:
				$this->model->Lookup = new Lookup('model', 'tbl_sup_type', FALSE, 'sup_listID', ["sup_listID","sup_types","",""], [], [], [], [], [], [], '`sup_listID` ASC', '');
				break;
		}
		$this->model->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['model'] = &$this->model;

		// serial
		$this->serial = new DbField('tbl_supplies', 'tbl_supplies', 'x_serial', 'serial', '`serial`', '`serial`', 200, 50, -1, FALSE, '`serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->serial->Required = TRUE; // Required field
		$this->serial->Sortable = TRUE; // Allow sort
		$this->fields['serial'] = &$this->serial;

		// status
		$this->status = new DbField('tbl_supplies', 'tbl_supplies', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status->Lookup = new Lookup('status', 'tbl_sup_status', FALSE, 'sup_statusID', ["sup_statusID","sup_status","",""], [], [], [], [], [], [], '`sup_statusID` ASC', '');
				break;
			default:
				$this->status->Lookup = new Lookup('status', 'tbl_sup_status', FALSE, 'sup_statusID', ["sup_statusID","sup_status","",""], [], [], [], [], [], [], '`sup_statusID` ASC', '');
				break;
		}
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// remark
		$this->remark = new DbField('tbl_supplies', 'tbl_supplies', 'x_remark', 'remark', '`remark`', '`remark`', 201, 500, -1, FALSE, '`remark`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remark->Sortable = TRUE; // Allow sort
		$this->remark->MemoMaxLength = 30;
		$this->fields['remark'] = &$this->remark;

		// date_received
		$this->date_received = new DbField('tbl_supplies', 'tbl_supplies', 'x_date_received', 'date_received', '`date_received`', CastDateFieldForLike("`date_received`", 0, "DB"), 133, 10, 0, FALSE, '`date_received`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_received->Required = TRUE; // Required field
		$this->date_received->Sortable = TRUE; // Allow sort
		$this->date_received->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_received'] = &$this->date_received;

		// date_consumed
		$this->date_consumed = new DbField('tbl_supplies', 'tbl_supplies', 'x_date_consumed', 'date_consumed', '`date_consumed`', CastDateFieldForLike("`date_consumed`", 0, "DB"), 133, 10, 0, FALSE, '`date_consumed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_consumed->Sortable = TRUE; // Allow sort
		$this->date_consumed->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_consumed'] = &$this->date_consumed;

		// Supplier
		$this->Supplier = new DbField('tbl_supplies', 'tbl_supplies', 'x_Supplier', 'Supplier', '`Supplier`', '`Supplier`', 3, 11, -1, FALSE, '`Supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Supplier->Required = TRUE; // Required field
		$this->Supplier->Sortable = TRUE; // Allow sort
		$this->Supplier->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Supplier->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Supplier->Lookup = new Lookup('Supplier', 'tbl_supplier', FALSE, 'supplierID', ["supplierID","supplier_dsc","",""], [], [], [], [], [], [], '`supplierID` ASC', '');
				break;
			default:
				$this->Supplier->Lookup = new Lookup('Supplier', 'tbl_supplier', FALSE, 'supplierID', ["supplierID","supplier_dsc","",""], [], [], [], [], [], [], '`supplierID` ASC', '');
				break;
		}
		$this->Supplier->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Supplier'] = &$this->Supplier;

		// employeeid
		$this->employeeid = new DbField('tbl_supplies', 'tbl_supplies', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employeeid->Required = TRUE; // Required field
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employeeid->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
			default:
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
		}
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employeeid'] = &$this->employeeid;

		// user_last_modify
		$this->user_last_modify = new DbField('tbl_supplies', 'tbl_supplies', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// user_date_modify
		$this->user_date_modify = new DbField('tbl_supplies', 'tbl_supplies', 'x_user_date_modify', 'user_date_modify', '`user_date_modify`', CastDateFieldForLike("`user_date_modify`", 1, "DB"), 135, 19, 1, FALSE, '`user_date_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_date_modify->Sortable = TRUE; // Allow sort
		$this->user_date_modify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['user_date_modify'] = &$this->user_date_modify;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`tbl_supplies`";
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

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
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
			$fldname = 'id';
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
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
		$this->id->DbValue = $row['id'];
		$this->supplies_cat->DbValue = $row['supplies_cat'];
		$this->model->DbValue = $row['model'];
		$this->serial->DbValue = $row['serial'];
		$this->status->DbValue = $row['status'];
		$this->remark->DbValue = $row['remark'];
		$this->date_received->DbValue = $row['date_received'];
		$this->date_consumed->DbValue = $row['date_consumed'];
		$this->Supplier->DbValue = $row['Supplier'];
		$this->employeeid->DbValue = $row['employeeid'];
		$this->user_last_modify->DbValue = $row['user_last_modify'];
		$this->user_date_modify->DbValue = $row['user_date_modify'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_supplieslist.php";
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
		if ($pageName == "tbl_suppliesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_suppliesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_suppliesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_supplieslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tbl_suppliesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_suppliesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "tbl_suppliesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_suppliesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_suppliesedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("tbl_suppliesadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("tbl_suppliesdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
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
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
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
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
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
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
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
		$this->id->setDbValue($rs->fields('id'));
		$this->supplies_cat->setDbValue($rs->fields('supplies_cat'));
		$this->model->setDbValue($rs->fields('model'));
		$this->serial->setDbValue($rs->fields('serial'));
		$this->status->setDbValue($rs->fields('status'));
		$this->remark->setDbValue($rs->fields('remark'));
		$this->date_received->setDbValue($rs->fields('date_received'));
		$this->date_consumed->setDbValue($rs->fields('date_consumed'));
		$this->Supplier->setDbValue($rs->fields('Supplier'));
		$this->employeeid->setDbValue($rs->fields('employeeid'));
		$this->user_last_modify->setDbValue($rs->fields('user_last_modify'));
		$this->user_date_modify->setDbValue($rs->fields('user_date_modify'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id

		$this->id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// supplies_cat
		$this->supplies_cat->CellCssStyle = "width: 0px; white-space: nowrap;";

		// model
		$this->model->CellCssStyle = "width: 0px; white-space: nowrap;";

		// serial
		$this->serial->CellCssStyle = "width: 0px; white-space: nowrap;";

		// status
		$this->status->CellCssStyle = "width: 0px; white-space: nowrap;";

		// remark
		$this->remark->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_received
		$this->date_received->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_consumed
		$this->date_consumed->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Supplier
		// employeeid

		$this->employeeid->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_last_modify
		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_date_modify
		$this->user_date_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// supplies_cat
		$curVal = strval($this->supplies_cat->CurrentValue);
		if ($curVal != "") {
			$this->supplies_cat->ViewValue = $this->supplies_cat->lookupCacheOption($curVal);
			if ($this->supplies_cat->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`suppliescat_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->supplies_cat->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->supplies_cat->ViewValue = $this->supplies_cat->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->supplies_cat->ViewValue = $this->supplies_cat->CurrentValue;
				}
			}
		} else {
			$this->supplies_cat->ViewValue = NULL;
		}
		$this->supplies_cat->ViewCustomAttributes = "";

		// model
		$curVal = strval($this->model->CurrentValue);
		if ($curVal != "") {
			$this->model->ViewValue = $this->model->lookupCacheOption($curVal);
			if ($this->model->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`sup_listID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->model->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->model->ViewValue = $this->model->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->model->ViewValue = $this->model->CurrentValue;
				}
			}
		} else {
			$this->model->ViewValue = NULL;
		}
		$this->model->ViewCustomAttributes = "";

		// serial
		$this->serial->ViewValue = $this->serial->CurrentValue;
		$this->serial->ViewCustomAttributes = "";

		// status
		$curVal = strval($this->status->CurrentValue);
		if ($curVal != "") {
			$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
			if ($this->status->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`sup_statusID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

		// remark
		$this->remark->ViewValue = $this->remark->CurrentValue;
		if ($this->remark->ViewValue != NULL)
			$this->remark->ViewValue = str_replace("\n", "<br>", $this->remark->ViewValue);
		$this->remark->ViewCustomAttributes = "";

		// date_received
		$this->date_received->ViewValue = $this->date_received->CurrentValue;
		$this->date_received->ViewValue = FormatDateTime($this->date_received->ViewValue, 0);
		$this->date_received->ViewCustomAttributes = "";

		// date_consumed
		$this->date_consumed->ViewValue = $this->date_consumed->CurrentValue;
		$this->date_consumed->ViewValue = FormatDateTime($this->date_consumed->ViewValue, 0);
		$this->date_consumed->ViewCustomAttributes = "";

		// Supplier
		$curVal = strval($this->Supplier->CurrentValue);
		if ($curVal != "") {
			$this->Supplier->ViewValue = $this->Supplier->lookupCacheOption($curVal);
			if ($this->Supplier->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`supplierID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Supplier->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->Supplier->ViewValue = $this->Supplier->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Supplier->ViewValue = $this->Supplier->CurrentValue;
				}
			}
		} else {
			$this->Supplier->ViewValue = NULL;
		}
		$this->Supplier->ViewCustomAttributes = "";

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
					$arwrk[2] = $rswrk->fields('df2');
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

		// user_last_modify
		$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
		$this->user_last_modify->ViewCustomAttributes = "";

		// user_date_modify
		$this->user_date_modify->ViewValue = $this->user_date_modify->CurrentValue;
		$this->user_date_modify->ViewValue = FormatDateTime($this->user_date_modify->ViewValue, 1);
		$this->user_date_modify->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// supplies_cat
		$this->supplies_cat->LinkCustomAttributes = "";
		$this->supplies_cat->HrefValue = "";
		$this->supplies_cat->TooltipValue = "";

		// model
		$this->model->LinkCustomAttributes = "";
		$this->model->HrefValue = "";
		$this->model->TooltipValue = "";

		// serial
		$this->serial->LinkCustomAttributes = "";
		$this->serial->HrefValue = "";
		$this->serial->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// remark
		$this->remark->LinkCustomAttributes = "";
		$this->remark->HrefValue = "";
		$this->remark->TooltipValue = "";

		// date_received
		$this->date_received->LinkCustomAttributes = "";
		$this->date_received->HrefValue = "";
		$this->date_received->TooltipValue = "";

		// date_consumed
		$this->date_consumed->LinkCustomAttributes = "";
		$this->date_consumed->HrefValue = "";
		$this->date_consumed->TooltipValue = "";

		// Supplier
		$this->Supplier->LinkCustomAttributes = "";
		$this->Supplier->HrefValue = "";
		$this->Supplier->TooltipValue = "";

		// employeeid
		$this->employeeid->LinkCustomAttributes = "";
		$this->employeeid->HrefValue = "";
		$this->employeeid->TooltipValue = "";

		// user_last_modify
		$this->user_last_modify->LinkCustomAttributes = "";
		$this->user_last_modify->HrefValue = "";
		$this->user_last_modify->TooltipValue = "";

		// user_date_modify
		$this->user_date_modify->LinkCustomAttributes = "";
		$this->user_date_modify->HrefValue = "";
		$this->user_date_modify->TooltipValue = "";

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

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// supplies_cat
		$this->supplies_cat->EditAttrs["class"] = "form-control";
		$this->supplies_cat->EditCustomAttributes = "";

		// model
		$this->model->EditAttrs["class"] = "form-control";
		$this->model->EditCustomAttributes = "";

		// serial
		$this->serial->EditAttrs["class"] = "form-control";
		$this->serial->EditCustomAttributes = "";
		if (!$this->serial->Raw)
			$this->serial->CurrentValue = HtmlDecode($this->serial->CurrentValue);
		$this->serial->EditValue = $this->serial->CurrentValue;
		$this->serial->PlaceHolder = RemoveHtml($this->serial->caption());

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";

		// remark
		$this->remark->EditAttrs["class"] = "form-control";
		$this->remark->EditCustomAttributes = "";
		$this->remark->EditValue = $this->remark->CurrentValue;
		$this->remark->PlaceHolder = RemoveHtml($this->remark->caption());

		// date_received
		$this->date_received->EditAttrs["class"] = "form-control";
		$this->date_received->EditCustomAttributes = "";
		$this->date_received->EditValue = FormatDateTime($this->date_received->CurrentValue, 8);
		$this->date_received->PlaceHolder = RemoveHtml($this->date_received->caption());

		// date_consumed
		$this->date_consumed->EditAttrs["class"] = "form-control";
		$this->date_consumed->EditCustomAttributes = "";
		$this->date_consumed->EditValue = FormatDateTime($this->date_consumed->CurrentValue, 8);
		$this->date_consumed->PlaceHolder = RemoveHtml($this->date_consumed->caption());

		// Supplier
		$this->Supplier->EditAttrs["class"] = "form-control";
		$this->Supplier->EditCustomAttributes = "";

		// employeeid
		$this->employeeid->EditAttrs["class"] = "form-control";
		$this->employeeid->EditCustomAttributes = "";

		// user_last_modify
		// user_date_modify
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
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->supplies_cat);
					$doc->exportCaption($this->model);
					$doc->exportCaption($this->serial);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->remark);
					$doc->exportCaption($this->date_received);
					$doc->exportCaption($this->date_consumed);
					$doc->exportCaption($this->Supplier);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->user_date_modify);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->supplies_cat);
					$doc->exportCaption($this->model);
					$doc->exportCaption($this->serial);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->remark);
					$doc->exportCaption($this->date_received);
					$doc->exportCaption($this->date_consumed);
					$doc->exportCaption($this->Supplier);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->user_date_modify);
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
						$doc->exportField($this->id);
						$doc->exportField($this->supplies_cat);
						$doc->exportField($this->model);
						$doc->exportField($this->serial);
						$doc->exportField($this->status);
						$doc->exportField($this->remark);
						$doc->exportField($this->date_received);
						$doc->exportField($this->date_consumed);
						$doc->exportField($this->Supplier);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->user_date_modify);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->supplies_cat);
						$doc->exportField($this->model);
						$doc->exportField($this->serial);
						$doc->exportField($this->status);
						$doc->exportField($this->remark);
						$doc->exportField($this->date_received);
						$doc->exportField($this->date_consumed);
						$doc->exportField($this->Supplier);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->user_date_modify);
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
		$table = 'tbl_supplies';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_supplies';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

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
		$table = 'tbl_supplies';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['id'];

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
		$table = 'tbl_supplies';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

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

	$rsnew["serial"]=mb_strtoupper($rsnew["serial"]);
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

	$rsnew["serial"]=mb_strtoupper($rsnew["serial"]);
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