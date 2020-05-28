<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for tbl_borrowers
 */
class tbl_borrowers extends DbTable
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
	public $borrowers_id;
	public $Date_Barrowed;
	public $Date_Returned;
	public $item_type;
	public $item_model;
	public $item_serial;
	public $name_barrowers;
	public $Designation;
	public $office_id;
	public $Region;
	public $Province;
	public $Cities;
	public $status;
	public $Remarks;
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
		$this->TableVar = 'tbl_borrowers';
		$this->TableName = 'tbl_borrowers';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_borrowers`";
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

		// borrowers_id
		$this->borrowers_id = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_borrowers_id', 'borrowers_id', '`borrowers_id`', '`borrowers_id`', 3, 11, -1, FALSE, '`borrowers_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->borrowers_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->borrowers_id->IsPrimaryKey = TRUE; // Primary key field
		$this->borrowers_id->Sortable = TRUE; // Allow sort
		$this->borrowers_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['borrowers_id'] = &$this->borrowers_id;

		// Date_Barrowed
		$this->Date_Barrowed = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_Date_Barrowed', 'Date_Barrowed', '`Date_Barrowed`', CastDateFieldForLike("`Date_Barrowed`", 5, "DB"), 133, 10, 5, FALSE, '`Date_Barrowed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Date_Barrowed->Required = TRUE; // Required field
		$this->Date_Barrowed->Sortable = TRUE; // Allow sort
		$this->Date_Barrowed->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['Date_Barrowed'] = &$this->Date_Barrowed;

		// Date_Returned
		$this->Date_Returned = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_Date_Returned', 'Date_Returned', '`Date_Returned`', CastDateFieldForLike("`Date_Returned`", 0, "DB"), 133, 10, -1, FALSE, '`Date_Returned`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Date_Returned->Sortable = TRUE; // Allow sort
		$this->Date_Returned->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Date_Returned'] = &$this->Date_Returned;

		// item_type
		$this->item_type = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_item_type', 'item_type', '`item_type`', '`item_type`', 3, 11, -1, FALSE, '`item_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->item_type->Required = TRUE; // Required field
		$this->item_type->Sortable = TRUE; // Allow sort
		$this->item_type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->item_type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->item_type->Lookup = new Lookup('item_type', 'tbl_cat', FALSE, 'cat_id', ["cat_id","cat_desc","",""], [], [], [], [], [], [], '`cat_id` ASC', '');
				break;
			default:
				$this->item_type->Lookup = new Lookup('item_type', 'tbl_cat', FALSE, 'cat_id', ["cat_id","cat_desc","",""], [], [], [], [], [], [], '`cat_id` ASC', '');
				break;
		}
		$this->fields['item_type'] = &$this->item_type;

		// item_model
		$this->item_model = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 50, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Required = TRUE; // Required field
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serial
		$this->item_serial = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_item_serial', 'item_serial', '`item_serial`', '`item_serial`', 200, 50, -1, FALSE, '`item_serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serial->Required = TRUE; // Required field
		$this->item_serial->Sortable = TRUE; // Allow sort
		$this->fields['item_serial'] = &$this->item_serial;

		// name_barrowers
		$this->name_barrowers = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_name_barrowers', 'name_barrowers', '`name_barrowers`', '`name_barrowers`', 200, 50, -1, FALSE, '`name_barrowers`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->name_barrowers->Required = TRUE; // Required field
		$this->name_barrowers->Sortable = TRUE; // Allow sort
		$this->fields['name_barrowers'] = &$this->name_barrowers;

		// Designation
		$this->Designation = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_Designation', 'Designation', '`Designation`', '`Designation`', 200, 50, -1, FALSE, '`Designation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Designation->Required = TRUE; // Required field
		$this->Designation->Sortable = TRUE; // Allow sort
		$this->fields['Designation'] = &$this->Designation;

		// office_id
		$this->office_id = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_office_id', 'office_id', '`office_id`', '`office_id`', 3, 11, -1, FALSE, '`office_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->office_id->Required = TRUE; // Required field
		$this->office_id->Sortable = TRUE; // Allow sort
		$this->office_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->office_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->office_id->Lookup = new Lookup('office_id', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
			default:
				$this->office_id->Lookup = new Lookup('office_id', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
		}
		$this->office_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['office_id'] = &$this->office_id;

		// Region
		$this->Region = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_Region', 'Region', '`Region`', '`Region`', 3, 11, -1, FALSE, '`Region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Region->Sortable = FALSE; // Allow sort
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
		$this->Province = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_Province', 'Province', '`Province`', '`Province`', 3, 11, -1, FALSE, '`Province`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Province->Sortable = FALSE; // Allow sort
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
		$this->Cities = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_Cities', 'Cities', '`Cities`', '`Cities`', 3, 11, -1, FALSE, '`Cities`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Cities->Sortable = FALSE; // Allow sort
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

		// status
		$this->status = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status->Lookup = new Lookup('status', 'tbl_barrowed_status', FALSE, 'barrowed_status_id', ["barrowed_status_id","staus_dsc","",""], [], [], [], [], [], [], '`barrowed_status_id` ASC', '');
				break;
			default:
				$this->status->Lookup = new Lookup('status', 'tbl_barrowed_status', FALSE, 'barrowed_status_id', ["barrowed_status_id","staus_dsc","",""], [], [], [], [], [], [], '`barrowed_status_id` ASC', '');
				break;
		}
		$this->fields['status'] = &$this->status;

		// Remarks
		$this->Remarks = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_Remarks', 'Remarks', '`Remarks`', '`Remarks`', 201, 500, -1, FALSE, '`Remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Remarks->Sortable = TRUE; // Allow sort
		$this->Remarks->MemoMaxLength = 30;
		$this->fields['Remarks'] = &$this->Remarks;

		// user_last_modify
		$this->user_last_modify = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// date_last_modify
		$this->date_last_modify = new DbField('tbl_borrowers', 'tbl_borrowers', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 1, "DB"), 135, 19, 1, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`tbl_borrowers`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`borrowers_id` DESC";
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
			$this->borrowers_id->setDbValue($conn->insert_ID());
			$rs['borrowers_id'] = $this->borrowers_id->DbValue;
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
			$fldname = 'borrowers_id';
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
			if (array_key_exists('borrowers_id', $rs))
				AddFilter($where, QuotedName('borrowers_id', $this->Dbid) . '=' . QuotedValue($rs['borrowers_id'], $this->borrowers_id->DataType, $this->Dbid));
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
		$this->borrowers_id->DbValue = $row['borrowers_id'];
		$this->Date_Barrowed->DbValue = $row['Date_Barrowed'];
		$this->Date_Returned->DbValue = $row['Date_Returned'];
		$this->item_type->DbValue = $row['item_type'];
		$this->item_model->DbValue = $row['item_model'];
		$this->item_serial->DbValue = $row['item_serial'];
		$this->name_barrowers->DbValue = $row['name_barrowers'];
		$this->Designation->DbValue = $row['Designation'];
		$this->office_id->DbValue = $row['office_id'];
		$this->Region->DbValue = $row['Region'];
		$this->Province->DbValue = $row['Province'];
		$this->Cities->DbValue = $row['Cities'];
		$this->status->DbValue = $row['status'];
		$this->Remarks->DbValue = $row['Remarks'];
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
		return "`borrowers_id` = @borrowers_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('borrowers_id', $row) ? $row['borrowers_id'] : NULL;
		else
			$val = $this->borrowers_id->OldValue !== NULL ? $this->borrowers_id->OldValue : $this->borrowers_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@borrowers_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_borrowerslist.php";
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
		if ($pageName == "tbl_borrowersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_borrowersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_borrowersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_borrowerslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tbl_borrowersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_borrowersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "tbl_borrowersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_borrowersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_borrowersedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("tbl_borrowersadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("tbl_borrowersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "borrowers_id:" . JsonEncode($this->borrowers_id->CurrentValue, "number");
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
		if ($this->borrowers_id->CurrentValue != NULL) {
			$url .= "borrowers_id=" . urlencode($this->borrowers_id->CurrentValue);
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
			if (Param("borrowers_id") !== NULL)
				$arKeys[] = Param("borrowers_id");
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
				$this->borrowers_id->CurrentValue = $key;
			else
				$this->borrowers_id->OldValue = $key;
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
		$this->borrowers_id->setDbValue($rs->fields('borrowers_id'));
		$this->Date_Barrowed->setDbValue($rs->fields('Date_Barrowed'));
		$this->Date_Returned->setDbValue($rs->fields('Date_Returned'));
		$this->item_type->setDbValue($rs->fields('item_type'));
		$this->item_model->setDbValue($rs->fields('item_model'));
		$this->item_serial->setDbValue($rs->fields('item_serial'));
		$this->name_barrowers->setDbValue($rs->fields('name_barrowers'));
		$this->Designation->setDbValue($rs->fields('Designation'));
		$this->office_id->setDbValue($rs->fields('office_id'));
		$this->Region->setDbValue($rs->fields('Region'));
		$this->Province->setDbValue($rs->fields('Province'));
		$this->Cities->setDbValue($rs->fields('Cities'));
		$this->status->setDbValue($rs->fields('status'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
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
		// borrowers_id

		$this->borrowers_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Date_Barrowed
		$this->Date_Barrowed->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Date_Returned
		$this->Date_Returned->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_type
		$this->item_type->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_model
		$this->item_model->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_serial
		$this->item_serial->CellCssStyle = "width: 0px; white-space: nowrap;";

		// name_barrowers
		$this->name_barrowers->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Designation
		$this->Designation->CellCssStyle = "width: 0px; white-space: nowrap;";

		// office_id
		$this->office_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Region
		$this->Region->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Province
		$this->Province->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Cities
		$this->Cities->CellCssStyle = "width: 0px; white-space: nowrap;";

		// status
		$this->status->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Remarks
		$this->Remarks->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_last_modify
		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_last_modify
		$this->date_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// borrowers_id
		$this->borrowers_id->ViewValue = $this->borrowers_id->CurrentValue;
		$this->borrowers_id->ViewCustomAttributes = "";

		// Date_Barrowed
		$this->Date_Barrowed->ViewValue = $this->Date_Barrowed->CurrentValue;
		$this->Date_Barrowed->ViewValue = FormatDateTime($this->Date_Barrowed->ViewValue, 5);
		$this->Date_Barrowed->ViewCustomAttributes = "";

		// Date_Returned
		$this->Date_Returned->ViewValue = $this->Date_Returned->CurrentValue;
		$this->Date_Returned->ViewCustomAttributes = "";

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
					$arwrk[2] = $rswrk->fields('df2');
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

		// name_barrowers
		$this->name_barrowers->ViewValue = $this->name_barrowers->CurrentValue;
		$this->name_barrowers->ViewCustomAttributes = "";

		// Designation
		$this->Designation->ViewValue = $this->Designation->CurrentValue;
		$this->Designation->ViewCustomAttributes = "";

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

		// status
		$curVal = strval($this->status->CurrentValue);
		if ($curVal != "") {
			$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
			if ($this->status->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`barrowed_status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		if ($this->Remarks->ViewValue != NULL)
			$this->Remarks->ViewValue = str_replace("\n", "<br>", $this->Remarks->ViewValue);
		$this->Remarks->ViewCustomAttributes = "";

		// user_last_modify
		$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
		$this->user_last_modify->ViewCustomAttributes = "";

		// date_last_modify
		$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
		$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 1);
		$this->date_last_modify->ViewCustomAttributes = "";

		// borrowers_id
		$this->borrowers_id->LinkCustomAttributes = "";
		$this->borrowers_id->HrefValue = "";
		$this->borrowers_id->TooltipValue = "";

		// Date_Barrowed
		$this->Date_Barrowed->LinkCustomAttributes = "";
		$this->Date_Barrowed->HrefValue = "";
		$this->Date_Barrowed->TooltipValue = "";

		// Date_Returned
		$this->Date_Returned->LinkCustomAttributes = "";
		$this->Date_Returned->HrefValue = "";
		$this->Date_Returned->TooltipValue = "";

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

		// name_barrowers
		$this->name_barrowers->LinkCustomAttributes = "";
		$this->name_barrowers->HrefValue = "";
		$this->name_barrowers->TooltipValue = "";

		// Designation
		$this->Designation->LinkCustomAttributes = "";
		$this->Designation->HrefValue = "";
		$this->Designation->TooltipValue = "";

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

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// Remarks
		$this->Remarks->LinkCustomAttributes = "";
		$this->Remarks->HrefValue = "";
		$this->Remarks->TooltipValue = "";

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

		// borrowers_id
		$this->borrowers_id->EditAttrs["class"] = "form-control";
		$this->borrowers_id->EditCustomAttributes = "";
		$this->borrowers_id->EditValue = $this->borrowers_id->CurrentValue;
		$this->borrowers_id->ViewCustomAttributes = "";

		// Date_Barrowed
		$this->Date_Barrowed->EditAttrs["class"] = "form-control";
		$this->Date_Barrowed->EditCustomAttributes = "";
		$this->Date_Barrowed->EditValue = FormatDateTime($this->Date_Barrowed->CurrentValue, 5);
		$this->Date_Barrowed->PlaceHolder = RemoveHtml($this->Date_Barrowed->caption());

		// Date_Returned
		$this->Date_Returned->EditAttrs["class"] = "form-control";
		$this->Date_Returned->EditCustomAttributes = "";
		$this->Date_Returned->EditValue = $this->Date_Returned->CurrentValue;
		$this->Date_Returned->PlaceHolder = RemoveHtml($this->Date_Returned->caption());

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

		// item_serial
		$this->item_serial->EditAttrs["class"] = "form-control";
		$this->item_serial->EditCustomAttributes = "";
		if (!$this->item_serial->Raw)
			$this->item_serial->CurrentValue = HtmlDecode($this->item_serial->CurrentValue);
		$this->item_serial->EditValue = $this->item_serial->CurrentValue;
		$this->item_serial->PlaceHolder = RemoveHtml($this->item_serial->caption());

		// name_barrowers
		$this->name_barrowers->EditAttrs["class"] = "form-control";
		$this->name_barrowers->EditCustomAttributes = "";
		if (!$this->name_barrowers->Raw)
			$this->name_barrowers->CurrentValue = HtmlDecode($this->name_barrowers->CurrentValue);
		$this->name_barrowers->EditValue = $this->name_barrowers->CurrentValue;
		$this->name_barrowers->PlaceHolder = RemoveHtml($this->name_barrowers->caption());

		// Designation
		$this->Designation->EditAttrs["class"] = "form-control";
		$this->Designation->EditCustomAttributes = "";
		if (!$this->Designation->Raw)
			$this->Designation->CurrentValue = HtmlDecode($this->Designation->CurrentValue);
		$this->Designation->EditValue = $this->Designation->CurrentValue;
		$this->Designation->PlaceHolder = RemoveHtml($this->Designation->caption());

		// office_id
		$this->office_id->EditAttrs["class"] = "form-control";
		$this->office_id->EditCustomAttributes = "";

		// Region
		$this->Region->EditAttrs["class"] = "form-control";
		$this->Region->EditCustomAttributes = "";

		// Province
		$this->Province->EditAttrs["class"] = "form-control";
		$this->Province->EditCustomAttributes = "";

		// Cities
		$this->Cities->EditAttrs["class"] = "form-control";
		$this->Cities->EditCustomAttributes = "";

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";

		// Remarks
		$this->Remarks->EditAttrs["class"] = "form-control";
		$this->Remarks->EditCustomAttributes = "";
		$this->Remarks->EditValue = $this->Remarks->CurrentValue;
		$this->Remarks->PlaceHolder = RemoveHtml($this->Remarks->caption());

		// user_last_modify
		// date_last_modify
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
					$doc->exportCaption($this->borrowers_id);
					$doc->exportCaption($this->Date_Barrowed);
					$doc->exportCaption($this->Date_Returned);
					$doc->exportCaption($this->item_type);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->name_barrowers);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->office_id);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->Remarks);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
				} else {
					$doc->exportCaption($this->borrowers_id);
					$doc->exportCaption($this->Date_Barrowed);
					$doc->exportCaption($this->Date_Returned);
					$doc->exportCaption($this->item_type);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->name_barrowers);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->office_id);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->Remarks);
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

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->borrowers_id);
						$doc->exportField($this->Date_Barrowed);
						$doc->exportField($this->Date_Returned);
						$doc->exportField($this->item_type);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->name_barrowers);
						$doc->exportField($this->Designation);
						$doc->exportField($this->office_id);
						$doc->exportField($this->status);
						$doc->exportField($this->Remarks);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
					} else {
						$doc->exportField($this->borrowers_id);
						$doc->exportField($this->Date_Barrowed);
						$doc->exportField($this->Date_Returned);
						$doc->exportField($this->item_type);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->name_barrowers);
						$doc->exportField($this->Designation);
						$doc->exportField($this->office_id);
						$doc->exportField($this->status);
						$doc->exportField($this->Remarks);
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
		$table = 'tbl_borrowers';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_borrowers';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['borrowers_id'];

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
		$table = 'tbl_borrowers';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['borrowers_id'];

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
		$table = 'tbl_borrowers';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['borrowers_id'];

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