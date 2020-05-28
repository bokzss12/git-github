<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for lib_cities
 */
class lib_cities extends DbTable
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
	public $city_code;
	public $city_name;
	public $is_Urban;
	public $locked;
	public $app_target_hh;
	public $_4p_areas;
	public $psgc_cty;
	public $prov_code;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'lib_cities';
		$this->TableName = 'lib_cities';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`lib_cities`";
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

		// city_code
		$this->city_code = new DbField('lib_cities', 'lib_cities', 'x_city_code', 'city_code', '`city_code`', '`city_code`', 3, 9, -1, FALSE, '`city_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->city_code->IsAutoIncrement = TRUE; // Autoincrement field
		$this->city_code->IsPrimaryKey = TRUE; // Primary key field
		$this->city_code->Sortable = TRUE; // Allow sort
		$this->city_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['city_code'] = &$this->city_code;

		// city_name
		$this->city_name = new DbField('lib_cities', 'lib_cities', 'x_city_name', 'city_name', '`city_name`', '`city_name`', 200, 100, -1, FALSE, '`city_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city_name->Nullable = FALSE; // NOT NULL field
		$this->city_name->Required = TRUE; // Required field
		$this->city_name->Sortable = TRUE; // Allow sort
		$this->fields['city_name'] = &$this->city_name;

		// is_Urban
		$this->is_Urban = new DbField('lib_cities', 'lib_cities', 'x_is_Urban', 'is_Urban', '`is_Urban`', '`is_Urban`', 16, 1, -1, FALSE, '`is_Urban`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->is_Urban->Sortable = TRUE; // Allow sort
		$this->is_Urban->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['is_Urban'] = &$this->is_Urban;

		// locked
		$this->locked = new DbField('lib_cities', 'lib_cities', 'x_locked', 'locked', '`locked`', '`locked`', 16, 1, -1, FALSE, '`locked`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->locked->Sortable = TRUE; // Allow sort
		$this->locked->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['locked'] = &$this->locked;

		// app_target_hh
		$this->app_target_hh = new DbField('lib_cities', 'lib_cities', 'x_app_target_hh', 'app_target_hh', '`app_target_hh`', '`app_target_hh`', 3, 5, -1, FALSE, '`app_target_hh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->app_target_hh->Sortable = TRUE; // Allow sort
		$this->app_target_hh->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['app_target_hh'] = &$this->app_target_hh;

		// 4p_areas
		$this->_4p_areas = new DbField('lib_cities', 'lib_cities', 'x__4p_areas', '4p_areas', '`4p_areas`', '`4p_areas`', 16, 1, -1, FALSE, '`4p_areas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_4p_areas->Nullable = FALSE; // NOT NULL field
		$this->_4p_areas->Required = TRUE; // Required field
		$this->_4p_areas->Sortable = TRUE; // Allow sort
		$this->_4p_areas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['4p_areas'] = &$this->_4p_areas;

		// psgc_cty
		$this->psgc_cty = new DbField('lib_cities', 'lib_cities', 'x_psgc_cty', 'psgc_cty', '`psgc_cty`', '`psgc_cty`', 200, 9, -1, FALSE, '`psgc_cty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->psgc_cty->Nullable = FALSE; // NOT NULL field
		$this->psgc_cty->Required = TRUE; // Required field
		$this->psgc_cty->Sortable = TRUE; // Allow sort
		$this->fields['psgc_cty'] = &$this->psgc_cty;

		// prov_code
		$this->prov_code = new DbField('lib_cities', 'lib_cities', 'x_prov_code', 'prov_code', '`prov_code`', '`prov_code`', 3, 9, -1, FALSE, '`prov_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->prov_code->Nullable = FALSE; // NOT NULL field
		$this->prov_code->Required = TRUE; // Required field
		$this->prov_code->Sortable = TRUE; // Allow sort
		$this->prov_code->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['prov_code'] = &$this->prov_code;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`lib_cities`";
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
			$this->city_code->setDbValue($conn->insert_ID());
			$rs['city_code'] = $this->city_code->DbValue;
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
			$fldname = 'city_code';
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
			if (array_key_exists('city_code', $rs))
				AddFilter($where, QuotedName('city_code', $this->Dbid) . '=' . QuotedValue($rs['city_code'], $this->city_code->DataType, $this->Dbid));
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
		$this->city_code->DbValue = $row['city_code'];
		$this->city_name->DbValue = $row['city_name'];
		$this->is_Urban->DbValue = $row['is_Urban'];
		$this->locked->DbValue = $row['locked'];
		$this->app_target_hh->DbValue = $row['app_target_hh'];
		$this->_4p_areas->DbValue = $row['4p_areas'];
		$this->psgc_cty->DbValue = $row['psgc_cty'];
		$this->prov_code->DbValue = $row['prov_code'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`city_code` = @city_code@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('city_code', $row) ? $row['city_code'] : NULL;
		else
			$val = $this->city_code->OldValue !== NULL ? $this->city_code->OldValue : $this->city_code->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@city_code@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "lib_citieslist.php";
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
		if ($pageName == "lib_citiesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "lib_citiesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "lib_citiesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "lib_citieslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("lib_citiesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("lib_citiesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "lib_citiesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "lib_citiesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("lib_citiesedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("lib_citiesadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("lib_citiesdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "city_code:" . JsonEncode($this->city_code->CurrentValue, "number");
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
		if ($this->city_code->CurrentValue != NULL) {
			$url .= "city_code=" . urlencode($this->city_code->CurrentValue);
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
			if (Param("city_code") !== NULL)
				$arKeys[] = Param("city_code");
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
				$this->city_code->CurrentValue = $key;
			else
				$this->city_code->OldValue = $key;
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
		$this->city_code->setDbValue($rs->fields('city_code'));
		$this->city_name->setDbValue($rs->fields('city_name'));
		$this->is_Urban->setDbValue($rs->fields('is_Urban'));
		$this->locked->setDbValue($rs->fields('locked'));
		$this->app_target_hh->setDbValue($rs->fields('app_target_hh'));
		$this->_4p_areas->setDbValue($rs->fields('4p_areas'));
		$this->psgc_cty->setDbValue($rs->fields('psgc_cty'));
		$this->prov_code->setDbValue($rs->fields('prov_code'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// city_code
		// city_name
		// is_Urban
		// locked
		// app_target_hh
		// 4p_areas
		// psgc_cty
		// prov_code
		// city_code

		$this->city_code->ViewValue = $this->city_code->CurrentValue;
		$this->city_code->ViewCustomAttributes = "";

		// city_name
		$this->city_name->ViewValue = $this->city_name->CurrentValue;
		$this->city_name->ViewCustomAttributes = "";

		// is_Urban
		$this->is_Urban->ViewValue = $this->is_Urban->CurrentValue;
		$this->is_Urban->ViewCustomAttributes = "";

		// locked
		$this->locked->ViewValue = $this->locked->CurrentValue;
		$this->locked->ViewCustomAttributes = "";

		// app_target_hh
		$this->app_target_hh->ViewValue = $this->app_target_hh->CurrentValue;
		$this->app_target_hh->ViewCustomAttributes = "";

		// 4p_areas
		$this->_4p_areas->ViewValue = $this->_4p_areas->CurrentValue;
		$this->_4p_areas->ViewCustomAttributes = "";

		// psgc_cty
		$this->psgc_cty->ViewValue = $this->psgc_cty->CurrentValue;
		$this->psgc_cty->ViewCustomAttributes = "";

		// prov_code
		$this->prov_code->ViewValue = $this->prov_code->CurrentValue;
		$this->prov_code->ViewCustomAttributes = "";

		// city_code
		$this->city_code->LinkCustomAttributes = "";
		$this->city_code->HrefValue = "";
		$this->city_code->TooltipValue = "";

		// city_name
		$this->city_name->LinkCustomAttributes = "";
		$this->city_name->HrefValue = "";
		$this->city_name->TooltipValue = "";

		// is_Urban
		$this->is_Urban->LinkCustomAttributes = "";
		$this->is_Urban->HrefValue = "";
		$this->is_Urban->TooltipValue = "";

		// locked
		$this->locked->LinkCustomAttributes = "";
		$this->locked->HrefValue = "";
		$this->locked->TooltipValue = "";

		// app_target_hh
		$this->app_target_hh->LinkCustomAttributes = "";
		$this->app_target_hh->HrefValue = "";
		$this->app_target_hh->TooltipValue = "";

		// 4p_areas
		$this->_4p_areas->LinkCustomAttributes = "";
		$this->_4p_areas->HrefValue = "";
		$this->_4p_areas->TooltipValue = "";

		// psgc_cty
		$this->psgc_cty->LinkCustomAttributes = "";
		$this->psgc_cty->HrefValue = "";
		$this->psgc_cty->TooltipValue = "";

		// prov_code
		$this->prov_code->LinkCustomAttributes = "";
		$this->prov_code->HrefValue = "";
		$this->prov_code->TooltipValue = "";

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

		// city_code
		$this->city_code->EditAttrs["class"] = "form-control";
		$this->city_code->EditCustomAttributes = "";
		$this->city_code->EditValue = $this->city_code->CurrentValue;
		$this->city_code->ViewCustomAttributes = "";

		// city_name
		$this->city_name->EditAttrs["class"] = "form-control";
		$this->city_name->EditCustomAttributes = "";
		if (!$this->city_name->Raw)
			$this->city_name->CurrentValue = HtmlDecode($this->city_name->CurrentValue);
		$this->city_name->EditValue = $this->city_name->CurrentValue;
		$this->city_name->PlaceHolder = RemoveHtml($this->city_name->caption());

		// is_Urban
		$this->is_Urban->EditAttrs["class"] = "form-control";
		$this->is_Urban->EditCustomAttributes = "";
		$this->is_Urban->EditValue = $this->is_Urban->CurrentValue;
		$this->is_Urban->PlaceHolder = RemoveHtml($this->is_Urban->caption());

		// locked
		$this->locked->EditAttrs["class"] = "form-control";
		$this->locked->EditCustomAttributes = "";
		$this->locked->EditValue = $this->locked->CurrentValue;
		$this->locked->PlaceHolder = RemoveHtml($this->locked->caption());

		// app_target_hh
		$this->app_target_hh->EditAttrs["class"] = "form-control";
		$this->app_target_hh->EditCustomAttributes = "";
		$this->app_target_hh->EditValue = $this->app_target_hh->CurrentValue;
		$this->app_target_hh->PlaceHolder = RemoveHtml($this->app_target_hh->caption());

		// 4p_areas
		$this->_4p_areas->EditAttrs["class"] = "form-control";
		$this->_4p_areas->EditCustomAttributes = "";
		$this->_4p_areas->EditValue = $this->_4p_areas->CurrentValue;
		$this->_4p_areas->PlaceHolder = RemoveHtml($this->_4p_areas->caption());

		// psgc_cty
		$this->psgc_cty->EditAttrs["class"] = "form-control";
		$this->psgc_cty->EditCustomAttributes = "";
		if (!$this->psgc_cty->Raw)
			$this->psgc_cty->CurrentValue = HtmlDecode($this->psgc_cty->CurrentValue);
		$this->psgc_cty->EditValue = $this->psgc_cty->CurrentValue;
		$this->psgc_cty->PlaceHolder = RemoveHtml($this->psgc_cty->caption());

		// prov_code
		$this->prov_code->EditAttrs["class"] = "form-control";
		$this->prov_code->EditCustomAttributes = "";
		$this->prov_code->EditValue = $this->prov_code->CurrentValue;
		$this->prov_code->PlaceHolder = RemoveHtml($this->prov_code->caption());

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
					$doc->exportCaption($this->city_code);
					$doc->exportCaption($this->city_name);
					$doc->exportCaption($this->is_Urban);
					$doc->exportCaption($this->locked);
					$doc->exportCaption($this->app_target_hh);
					$doc->exportCaption($this->_4p_areas);
					$doc->exportCaption($this->psgc_cty);
					$doc->exportCaption($this->prov_code);
				} else {
					$doc->exportCaption($this->city_code);
					$doc->exportCaption($this->city_name);
					$doc->exportCaption($this->is_Urban);
					$doc->exportCaption($this->locked);
					$doc->exportCaption($this->app_target_hh);
					$doc->exportCaption($this->_4p_areas);
					$doc->exportCaption($this->psgc_cty);
					$doc->exportCaption($this->prov_code);
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
						$doc->exportField($this->city_code);
						$doc->exportField($this->city_name);
						$doc->exportField($this->is_Urban);
						$doc->exportField($this->locked);
						$doc->exportField($this->app_target_hh);
						$doc->exportField($this->_4p_areas);
						$doc->exportField($this->psgc_cty);
						$doc->exportField($this->prov_code);
					} else {
						$doc->exportField($this->city_code);
						$doc->exportField($this->city_name);
						$doc->exportField($this->is_Urban);
						$doc->exportField($this->locked);
						$doc->exportField($this->app_target_hh);
						$doc->exportField($this->_4p_areas);
						$doc->exportField($this->psgc_cty);
						$doc->exportField($this->prov_code);
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
		$table = 'lib_cities';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'lib_cities';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['city_code'];

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
		$table = 'lib_cities';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['city_code'];

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
		$table = 'lib_cities';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['city_code'];

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