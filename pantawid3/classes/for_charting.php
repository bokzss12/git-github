<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for for_charting
 */
class for_charting extends DbTable
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
	public $item_id;
	public $month;
	public $Year;
	public $item_date_receive;
	public $item_date_repaired;
	public $item_date_pullout;
	public $off_desc;
	public $position;
	public $item_transmittal;
	public $item_model;
	public $item_serno;
	public $item_type_problem;
	public $item_action_taken;
	public $__Request;
	public $remarks;
	public $employeeid;
	public $region_name;
	public $prov_name;
	public $city_name;
	public $technician_dsc;
	public $status_desc;
	public $cat_desc;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'for_charting';
		$this->TableName = 'for_charting';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`for_charting`";
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

		// item_id
		$this->item_id = new DbField('for_charting', 'for_charting', 'x_item_id', 'item_id', '`item_id`', '`item_id`', 3, 11, -1, FALSE, '`item_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->item_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->item_id->IsPrimaryKey = TRUE; // Primary key field
		$this->item_id->Sortable = TRUE; // Allow sort
		$this->item_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['item_id'] = &$this->item_id;

		// month
		$this->month = new DbField('for_charting', 'for_charting', 'x_month', 'month', '`month`', '`month`', 3, 11, -1, FALSE, '`month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->month->Sortable = TRUE; // Allow sort
		$this->month->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['month'] = &$this->month;

		// Year
		$this->Year = new DbField('for_charting', 'for_charting', 'x_Year', 'Year', '`Year`', '`Year`', 3, 11, -1, FALSE, '`Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Year->Sortable = TRUE; // Allow sort
		$this->Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Year'] = &$this->Year;

		// item_date_receive
		$this->item_date_receive = new DbField('for_charting', 'for_charting', 'x_item_date_receive', 'item_date_receive', '`item_date_receive`', CastDateFieldForLike("`item_date_receive`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_receive`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_receive->Sortable = TRUE; // Allow sort
		$this->item_date_receive->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['item_date_receive'] = &$this->item_date_receive;

		// item_date_repaired
		$this->item_date_repaired = new DbField('for_charting', 'for_charting', 'x_item_date_repaired', 'item_date_repaired', '`item_date_repaired`', CastDateFieldForLike("`item_date_repaired`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_repaired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_repaired->Sortable = TRUE; // Allow sort
		$this->item_date_repaired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['item_date_repaired'] = &$this->item_date_repaired;

		// item_date_pullout
		$this->item_date_pullout = new DbField('for_charting', 'for_charting', 'x_item_date_pullout', 'item_date_pullout', '`item_date_pullout`', CastDateFieldForLike("`item_date_pullout`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_pullout`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_pullout->Sortable = TRUE; // Allow sort
		$this->item_date_pullout->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['item_date_pullout'] = &$this->item_date_pullout;

		// off_desc
		$this->off_desc = new DbField('for_charting', 'for_charting', 'x_off_desc', 'off_desc', '`off_desc`', '`off_desc`', 200, 50, -1, FALSE, '`off_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off_desc->Sortable = TRUE; // Allow sort
		$this->fields['off_desc'] = &$this->off_desc;

		// position
		$this->position = new DbField('for_charting', 'for_charting', 'x_position', 'position', '`position`', '`position`', 200, 100, -1, FALSE, '`position`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->position->Sortable = TRUE; // Allow sort
		$this->fields['position'] = &$this->position;

		// item_transmittal
		$this->item_transmittal = new DbField('for_charting', 'for_charting', 'x_item_transmittal', 'item_transmittal', '`item_transmittal`', '`item_transmittal`', 200, 100, -1, FALSE, '`item_transmittal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_transmittal->Sortable = TRUE; // Allow sort
		$this->fields['item_transmittal'] = &$this->item_transmittal;

		// item_model
		$this->item_model = new DbField('for_charting', 'for_charting', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 255, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serno
		$this->item_serno = new DbField('for_charting', 'for_charting', 'x_item_serno', 'item_serno', '`item_serno`', '`item_serno`', 200, 255, -1, FALSE, '`item_serno`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serno->Sortable = TRUE; // Allow sort
		$this->fields['item_serno'] = &$this->item_serno;

		// item_type_problem
		$this->item_type_problem = new DbField('for_charting', 'for_charting', 'x_item_type_problem', 'item_type_problem', '`item_type_problem`', '`item_type_problem`', 201, 500, -1, FALSE, '`item_type_problem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_type_problem->Sortable = TRUE; // Allow sort
		$this->fields['item_type_problem'] = &$this->item_type_problem;

		// item_action_taken
		$this->item_action_taken = new DbField('for_charting', 'for_charting', 'x_item_action_taken', 'item_action_taken', '`item_action_taken`', '`item_action_taken`', 201, 500, -1, FALSE, '`item_action_taken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_action_taken->Sortable = TRUE; // Allow sort
		$this->fields['item_action_taken'] = &$this->item_action_taken;

		// Request
		$this->__Request = new DbField('for_charting', 'for_charting', 'x___Request', 'Request', '`Request`', '`Request`', 3, 11, -1, FALSE, '`Request`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->__Request->Sortable = TRUE; // Allow sort
		$this->__Request->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Request'] = &$this->__Request;

		// remarks
		$this->remarks = new DbField('for_charting', 'for_charting', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->fields['remarks'] = &$this->remarks;

		// employeeid
		$this->employeeid = new DbField('for_charting', 'for_charting', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employeeid'] = &$this->employeeid;

		// region_name
		$this->region_name = new DbField('for_charting', 'for_charting', 'x_region_name', 'region_name', '`region_name`', '`region_name`', 200, 60, -1, FALSE, '`region_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->region_name->Sortable = TRUE; // Allow sort
		$this->fields['region_name'] = &$this->region_name;

		// prov_name
		$this->prov_name = new DbField('for_charting', 'for_charting', 'x_prov_name', 'prov_name', '`prov_name`', '`prov_name`', 200, 60, -1, FALSE, '`prov_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->prov_name->Sortable = TRUE; // Allow sort
		$this->fields['prov_name'] = &$this->prov_name;

		// city_name
		$this->city_name = new DbField('for_charting', 'for_charting', 'x_city_name', 'city_name', '`city_name`', '`city_name`', 200, 100, -1, FALSE, '`city_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city_name->Sortable = TRUE; // Allow sort
		$this->fields['city_name'] = &$this->city_name;

		// technician_dsc
		$this->technician_dsc = new DbField('for_charting', 'for_charting', 'x_technician_dsc', 'technician_dsc', '`technician_dsc`', '`technician_dsc`', 200, 50, -1, FALSE, '`technician_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->technician_dsc->Sortable = TRUE; // Allow sort
		$this->fields['technician_dsc'] = &$this->technician_dsc;

		// status_desc
		$this->status_desc = new DbField('for_charting', 'for_charting', 'x_status_desc', 'status_desc', '`status_desc`', '`status_desc`', 200, 100, -1, FALSE, '`status_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_desc->Required = TRUE; // Required field
		$this->status_desc->Sortable = TRUE; // Allow sort
		$this->fields['status_desc'] = &$this->status_desc;

		// cat_desc
		$this->cat_desc = new DbField('for_charting', 'for_charting', 'x_cat_desc', 'cat_desc', '`cat_desc`', '`cat_desc`', 200, 50, -1, FALSE, '`cat_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cat_desc->Sortable = TRUE; // Allow sort
		$this->fields['cat_desc'] = &$this->cat_desc;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`for_charting`";
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
			$this->item_id->setDbValue($conn->insert_ID());
			$rs['item_id'] = $this->item_id->DbValue;
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
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->item_id->DbValue = $row['item_id'];
		$this->month->DbValue = $row['month'];
		$this->Year->DbValue = $row['Year'];
		$this->item_date_receive->DbValue = $row['item_date_receive'];
		$this->item_date_repaired->DbValue = $row['item_date_repaired'];
		$this->item_date_pullout->DbValue = $row['item_date_pullout'];
		$this->off_desc->DbValue = $row['off_desc'];
		$this->position->DbValue = $row['position'];
		$this->item_transmittal->DbValue = $row['item_transmittal'];
		$this->item_model->DbValue = $row['item_model'];
		$this->item_serno->DbValue = $row['item_serno'];
		$this->item_type_problem->DbValue = $row['item_type_problem'];
		$this->item_action_taken->DbValue = $row['item_action_taken'];
		$this->__Request->DbValue = $row['Request'];
		$this->remarks->DbValue = $row['remarks'];
		$this->employeeid->DbValue = $row['employeeid'];
		$this->region_name->DbValue = $row['region_name'];
		$this->prov_name->DbValue = $row['prov_name'];
		$this->city_name->DbValue = $row['city_name'];
		$this->technician_dsc->DbValue = $row['technician_dsc'];
		$this->status_desc->DbValue = $row['status_desc'];
		$this->cat_desc->DbValue = $row['cat_desc'];
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
			return "for_chartinglist.php";
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
		if ($pageName == "for_chartingview.php")
			return $Language->phrase("View");
		elseif ($pageName == "for_chartingedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "for_chartingadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "for_chartinglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("for_chartingview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("for_chartingview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "for_chartingadd.php?" . $this->getUrlParm($parm);
		else
			$url = "for_chartingadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("for_chartingedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("for_chartingadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("for_chartingdelete.php", $this->getUrlParm());
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
		$this->month->setDbValue($rs->fields('month'));
		$this->Year->setDbValue($rs->fields('Year'));
		$this->item_date_receive->setDbValue($rs->fields('item_date_receive'));
		$this->item_date_repaired->setDbValue($rs->fields('item_date_repaired'));
		$this->item_date_pullout->setDbValue($rs->fields('item_date_pullout'));
		$this->off_desc->setDbValue($rs->fields('off_desc'));
		$this->position->setDbValue($rs->fields('position'));
		$this->item_transmittal->setDbValue($rs->fields('item_transmittal'));
		$this->item_model->setDbValue($rs->fields('item_model'));
		$this->item_serno->setDbValue($rs->fields('item_serno'));
		$this->item_type_problem->setDbValue($rs->fields('item_type_problem'));
		$this->item_action_taken->setDbValue($rs->fields('item_action_taken'));
		$this->__Request->setDbValue($rs->fields('Request'));
		$this->remarks->setDbValue($rs->fields('remarks'));
		$this->employeeid->setDbValue($rs->fields('employeeid'));
		$this->region_name->setDbValue($rs->fields('region_name'));
		$this->prov_name->setDbValue($rs->fields('prov_name'));
		$this->city_name->setDbValue($rs->fields('city_name'));
		$this->technician_dsc->setDbValue($rs->fields('technician_dsc'));
		$this->status_desc->setDbValue($rs->fields('status_desc'));
		$this->cat_desc->setDbValue($rs->fields('cat_desc'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// item_id
		// month
		// Year
		// item_date_receive
		// item_date_repaired
		// item_date_pullout
		// off_desc
		// position
		// item_transmittal
		// item_model
		// item_serno
		// item_type_problem
		// item_action_taken
		// Request
		// remarks
		// employeeid
		// region_name
		// prov_name
		// city_name
		// technician_dsc
		// status_desc
		// cat_desc
		// item_id

		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		$this->item_id->ViewCustomAttributes = "";

		// month
		$this->month->ViewValue = $this->month->CurrentValue;
		$this->month->ViewCustomAttributes = "";

		// Year
		$this->Year->ViewValue = $this->Year->CurrentValue;
		$this->Year->ViewCustomAttributes = "";

		// item_date_receive
		$this->item_date_receive->ViewValue = $this->item_date_receive->CurrentValue;
		$this->item_date_receive->ViewValue = FormatDateTime($this->item_date_receive->ViewValue, 0);
		$this->item_date_receive->ViewCustomAttributes = "";

		// item_date_repaired
		$this->item_date_repaired->ViewValue = $this->item_date_repaired->CurrentValue;
		$this->item_date_repaired->ViewValue = FormatDateTime($this->item_date_repaired->ViewValue, 0);
		$this->item_date_repaired->ViewCustomAttributes = "";

		// item_date_pullout
		$this->item_date_pullout->ViewValue = $this->item_date_pullout->CurrentValue;
		$this->item_date_pullout->ViewValue = FormatDateTime($this->item_date_pullout->ViewValue, 0);
		$this->item_date_pullout->ViewCustomAttributes = "";

		// off_desc
		$this->off_desc->ViewValue = $this->off_desc->CurrentValue;
		$this->off_desc->ViewCustomAttributes = "";

		// position
		$this->position->ViewValue = $this->position->CurrentValue;
		$this->position->ViewCustomAttributes = "";

		// item_transmittal
		$this->item_transmittal->ViewValue = $this->item_transmittal->CurrentValue;
		$this->item_transmittal->ViewCustomAttributes = "";

		// item_model
		$this->item_model->ViewValue = $this->item_model->CurrentValue;
		$this->item_model->ViewCustomAttributes = "";

		// item_serno
		$this->item_serno->ViewValue = $this->item_serno->CurrentValue;
		$this->item_serno->ViewCustomAttributes = "";

		// item_type_problem
		$this->item_type_problem->ViewValue = $this->item_type_problem->CurrentValue;
		$this->item_type_problem->ViewCustomAttributes = "";

		// item_action_taken
		$this->item_action_taken->ViewValue = $this->item_action_taken->CurrentValue;
		$this->item_action_taken->ViewCustomAttributes = "";

		// Request
		$this->__Request->ViewValue = $this->__Request->CurrentValue;
		$this->__Request->ViewCustomAttributes = "";

		// remarks
		$this->remarks->ViewValue = $this->remarks->CurrentValue;
		$this->remarks->ViewCustomAttributes = "";

		// employeeid
		$this->employeeid->ViewValue = $this->employeeid->CurrentValue;
		$this->employeeid->ViewCustomAttributes = "";

		// region_name
		$this->region_name->ViewValue = $this->region_name->CurrentValue;
		$this->region_name->ViewCustomAttributes = "";

		// prov_name
		$this->prov_name->ViewValue = $this->prov_name->CurrentValue;
		$this->prov_name->ViewCustomAttributes = "";

		// city_name
		$this->city_name->ViewValue = $this->city_name->CurrentValue;
		$this->city_name->ViewCustomAttributes = "";

		// technician_dsc
		$this->technician_dsc->ViewValue = $this->technician_dsc->CurrentValue;
		$this->technician_dsc->ViewCustomAttributes = "";

		// status_desc
		$this->status_desc->ViewValue = $this->status_desc->CurrentValue;
		$this->status_desc->ViewCustomAttributes = "";

		// cat_desc
		$this->cat_desc->ViewValue = $this->cat_desc->CurrentValue;
		$this->cat_desc->ViewCustomAttributes = "";

		// item_id
		$this->item_id->LinkCustomAttributes = "";
		$this->item_id->HrefValue = "";
		$this->item_id->TooltipValue = "";

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

		// item_date_repaired
		$this->item_date_repaired->LinkCustomAttributes = "";
		$this->item_date_repaired->HrefValue = "";
		$this->item_date_repaired->TooltipValue = "";

		// item_date_pullout
		$this->item_date_pullout->LinkCustomAttributes = "";
		$this->item_date_pullout->HrefValue = "";
		$this->item_date_pullout->TooltipValue = "";

		// off_desc
		$this->off_desc->LinkCustomAttributes = "";
		$this->off_desc->HrefValue = "";
		$this->off_desc->TooltipValue = "";

		// position
		$this->position->LinkCustomAttributes = "";
		$this->position->HrefValue = "";
		$this->position->TooltipValue = "";

		// item_transmittal
		$this->item_transmittal->LinkCustomAttributes = "";
		$this->item_transmittal->HrefValue = "";
		$this->item_transmittal->TooltipValue = "";

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

		// item_action_taken
		$this->item_action_taken->LinkCustomAttributes = "";
		$this->item_action_taken->HrefValue = "";
		$this->item_action_taken->TooltipValue = "";

		// Request
		$this->__Request->LinkCustomAttributes = "";
		$this->__Request->HrefValue = "";
		$this->__Request->TooltipValue = "";

		// remarks
		$this->remarks->LinkCustomAttributes = "";
		$this->remarks->HrefValue = "";
		$this->remarks->TooltipValue = "";

		// employeeid
		$this->employeeid->LinkCustomAttributes = "";
		$this->employeeid->HrefValue = "";
		$this->employeeid->TooltipValue = "";

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

		// technician_dsc
		$this->technician_dsc->LinkCustomAttributes = "";
		$this->technician_dsc->HrefValue = "";
		$this->technician_dsc->TooltipValue = "";

		// status_desc
		$this->status_desc->LinkCustomAttributes = "";
		$this->status_desc->HrefValue = "";
		$this->status_desc->TooltipValue = "";

		// cat_desc
		$this->cat_desc->LinkCustomAttributes = "";
		$this->cat_desc->HrefValue = "";
		$this->cat_desc->TooltipValue = "";

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

		// month
		$this->month->EditAttrs["class"] = "form-control";
		$this->month->EditCustomAttributes = "";
		$this->month->EditValue = $this->month->CurrentValue;
		$this->month->PlaceHolder = RemoveHtml($this->month->caption());

		// Year
		$this->Year->EditAttrs["class"] = "form-control";
		$this->Year->EditCustomAttributes = "";
		$this->Year->EditValue = $this->Year->CurrentValue;
		$this->Year->PlaceHolder = RemoveHtml($this->Year->caption());

		// item_date_receive
		$this->item_date_receive->EditAttrs["class"] = "form-control";
		$this->item_date_receive->EditCustomAttributes = "";
		$this->item_date_receive->EditValue = FormatDateTime($this->item_date_receive->CurrentValue, 8);
		$this->item_date_receive->PlaceHolder = RemoveHtml($this->item_date_receive->caption());

		// item_date_repaired
		$this->item_date_repaired->EditAttrs["class"] = "form-control";
		$this->item_date_repaired->EditCustomAttributes = "";
		$this->item_date_repaired->EditValue = FormatDateTime($this->item_date_repaired->CurrentValue, 8);
		$this->item_date_repaired->PlaceHolder = RemoveHtml($this->item_date_repaired->caption());

		// item_date_pullout
		$this->item_date_pullout->EditAttrs["class"] = "form-control";
		$this->item_date_pullout->EditCustomAttributes = "";
		$this->item_date_pullout->EditValue = FormatDateTime($this->item_date_pullout->CurrentValue, 8);
		$this->item_date_pullout->PlaceHolder = RemoveHtml($this->item_date_pullout->caption());

		// off_desc
		$this->off_desc->EditAttrs["class"] = "form-control";
		$this->off_desc->EditCustomAttributes = "";
		if (!$this->off_desc->Raw)
			$this->off_desc->CurrentValue = HtmlDecode($this->off_desc->CurrentValue);
		$this->off_desc->EditValue = $this->off_desc->CurrentValue;
		$this->off_desc->PlaceHolder = RemoveHtml($this->off_desc->caption());

		// position
		$this->position->EditAttrs["class"] = "form-control";
		$this->position->EditCustomAttributes = "";
		if (!$this->position->Raw)
			$this->position->CurrentValue = HtmlDecode($this->position->CurrentValue);
		$this->position->EditValue = $this->position->CurrentValue;
		$this->position->PlaceHolder = RemoveHtml($this->position->caption());

		// item_transmittal
		$this->item_transmittal->EditAttrs["class"] = "form-control";
		$this->item_transmittal->EditCustomAttributes = "";
		if (!$this->item_transmittal->Raw)
			$this->item_transmittal->CurrentValue = HtmlDecode($this->item_transmittal->CurrentValue);
		$this->item_transmittal->EditValue = $this->item_transmittal->CurrentValue;
		$this->item_transmittal->PlaceHolder = RemoveHtml($this->item_transmittal->caption());

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

		// Request
		$this->__Request->EditAttrs["class"] = "form-control";
		$this->__Request->EditCustomAttributes = "";
		$this->__Request->EditValue = $this->__Request->CurrentValue;
		$this->__Request->PlaceHolder = RemoveHtml($this->__Request->caption());

		// remarks
		$this->remarks->EditAttrs["class"] = "form-control";
		$this->remarks->EditCustomAttributes = "";
		$this->remarks->EditValue = $this->remarks->CurrentValue;
		$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

		// employeeid
		$this->employeeid->EditAttrs["class"] = "form-control";
		$this->employeeid->EditCustomAttributes = "";
		$this->employeeid->EditValue = $this->employeeid->CurrentValue;
		$this->employeeid->PlaceHolder = RemoveHtml($this->employeeid->caption());

		// region_name
		$this->region_name->EditAttrs["class"] = "form-control";
		$this->region_name->EditCustomAttributes = "";
		if (!$this->region_name->Raw)
			$this->region_name->CurrentValue = HtmlDecode($this->region_name->CurrentValue);
		$this->region_name->EditValue = $this->region_name->CurrentValue;
		$this->region_name->PlaceHolder = RemoveHtml($this->region_name->caption());

		// prov_name
		$this->prov_name->EditAttrs["class"] = "form-control";
		$this->prov_name->EditCustomAttributes = "";
		if (!$this->prov_name->Raw)
			$this->prov_name->CurrentValue = HtmlDecode($this->prov_name->CurrentValue);
		$this->prov_name->EditValue = $this->prov_name->CurrentValue;
		$this->prov_name->PlaceHolder = RemoveHtml($this->prov_name->caption());

		// city_name
		$this->city_name->EditAttrs["class"] = "form-control";
		$this->city_name->EditCustomAttributes = "";
		if (!$this->city_name->Raw)
			$this->city_name->CurrentValue = HtmlDecode($this->city_name->CurrentValue);
		$this->city_name->EditValue = $this->city_name->CurrentValue;
		$this->city_name->PlaceHolder = RemoveHtml($this->city_name->caption());

		// technician_dsc
		$this->technician_dsc->EditAttrs["class"] = "form-control";
		$this->technician_dsc->EditCustomAttributes = "";
		if (!$this->technician_dsc->Raw)
			$this->technician_dsc->CurrentValue = HtmlDecode($this->technician_dsc->CurrentValue);
		$this->technician_dsc->EditValue = $this->technician_dsc->CurrentValue;
		$this->technician_dsc->PlaceHolder = RemoveHtml($this->technician_dsc->caption());

		// status_desc
		$this->status_desc->EditAttrs["class"] = "form-control";
		$this->status_desc->EditCustomAttributes = "";
		if (!$this->status_desc->Raw)
			$this->status_desc->CurrentValue = HtmlDecode($this->status_desc->CurrentValue);
		$this->status_desc->EditValue = $this->status_desc->CurrentValue;
		$this->status_desc->PlaceHolder = RemoveHtml($this->status_desc->caption());

		// cat_desc
		$this->cat_desc->EditAttrs["class"] = "form-control";
		$this->cat_desc->EditCustomAttributes = "";
		if (!$this->cat_desc->Raw)
			$this->cat_desc->CurrentValue = HtmlDecode($this->cat_desc->CurrentValue);
		$this->cat_desc->EditValue = $this->cat_desc->CurrentValue;
		$this->cat_desc->PlaceHolder = RemoveHtml($this->cat_desc->caption());

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
					$doc->exportCaption($this->item_id);
					$doc->exportCaption($this->month);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->item_date_receive);
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->item_date_pullout);
					$doc->exportCaption($this->off_desc);
					$doc->exportCaption($this->position);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->item_type_problem);
					$doc->exportCaption($this->item_action_taken);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->region_name);
					$doc->exportCaption($this->prov_name);
					$doc->exportCaption($this->city_name);
					$doc->exportCaption($this->technician_dsc);
					$doc->exportCaption($this->status_desc);
					$doc->exportCaption($this->cat_desc);
				} else {
					$doc->exportCaption($this->item_id);
					$doc->exportCaption($this->month);
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->item_date_receive);
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->item_date_pullout);
					$doc->exportCaption($this->off_desc);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->region_name);
					$doc->exportCaption($this->prov_name);
					$doc->exportCaption($this->city_name);
					$doc->exportCaption($this->technician_dsc);
					$doc->exportCaption($this->status_desc);
					$doc->exportCaption($this->cat_desc);
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
						$doc->exportField($this->item_id);
						$doc->exportField($this->month);
						$doc->exportField($this->Year);
						$doc->exportField($this->item_date_receive);
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->item_date_pullout);
						$doc->exportField($this->off_desc);
						$doc->exportField($this->position);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->item_type_problem);
						$doc->exportField($this->item_action_taken);
						$doc->exportField($this->__Request);
						$doc->exportField($this->remarks);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->region_name);
						$doc->exportField($this->prov_name);
						$doc->exportField($this->city_name);
						$doc->exportField($this->technician_dsc);
						$doc->exportField($this->status_desc);
						$doc->exportField($this->cat_desc);
					} else {
						$doc->exportField($this->item_id);
						$doc->exportField($this->month);
						$doc->exportField($this->Year);
						$doc->exportField($this->item_date_receive);
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->item_date_pullout);
						$doc->exportField($this->off_desc);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->__Request);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->region_name);
						$doc->exportField($this->prov_name);
						$doc->exportField($this->city_name);
						$doc->exportField($this->technician_dsc);
						$doc->exportField($this->status_desc);
						$doc->exportField($this->cat_desc);
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