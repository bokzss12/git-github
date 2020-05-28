<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for inventory_chart
 */
class inventory_chart extends DbTable
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
	public $inventory_id;
	public $month_dsc;
	public $year_dsc;
	public $cat_desc;
	public $item_model;
	public $item_serial;
	public $off_desc;
	public $region_name;
	public $prov_name;
	public $city_name;
	public $name_accountable;
	public $Designation;
	public $inventory_status_dsc;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'inventory_chart';
		$this->TableName = 'inventory_chart';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`inventory_chart`";
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

		// inventory_id
		$this->inventory_id = new DbField('inventory_chart', 'inventory_chart', 'x_inventory_id', 'inventory_id', '`inventory_id`', '`inventory_id`', 3, 11, -1, FALSE, '`inventory_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->inventory_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->inventory_id->IsPrimaryKey = TRUE; // Primary key field
		$this->inventory_id->Sortable = TRUE; // Allow sort
		$this->inventory_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['inventory_id'] = &$this->inventory_id;

		// month_dsc
		$this->month_dsc = new DbField('inventory_chart', 'inventory_chart', 'x_month_dsc', 'month_dsc', '`month_dsc`', '`month_dsc`', 200, 50, -1, FALSE, '`month_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->month_dsc->Sortable = TRUE; // Allow sort
		$this->fields['month_dsc'] = &$this->month_dsc;

		// year_dsc
		$this->year_dsc = new DbField('inventory_chart', 'inventory_chart', 'x_year_dsc', 'year_dsc', '`year_dsc`', '`year_dsc`', 200, 50, -1, FALSE, '`year_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->year_dsc->Sortable = TRUE; // Allow sort
		$this->fields['year_dsc'] = &$this->year_dsc;

		// cat_desc
		$this->cat_desc = new DbField('inventory_chart', 'inventory_chart', 'x_cat_desc', 'cat_desc', '`cat_desc`', '`cat_desc`', 200, 50, -1, FALSE, '`cat_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cat_desc->Sortable = TRUE; // Allow sort
		$this->fields['cat_desc'] = &$this->cat_desc;

		// item_model
		$this->item_model = new DbField('inventory_chart', 'inventory_chart', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 50, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serial
		$this->item_serial = new DbField('inventory_chart', 'inventory_chart', 'x_item_serial', 'item_serial', '`item_serial`', '`item_serial`', 200, 50, -1, FALSE, '`item_serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serial->Sortable = TRUE; // Allow sort
		$this->fields['item_serial'] = &$this->item_serial;

		// off_desc
		$this->off_desc = new DbField('inventory_chart', 'inventory_chart', 'x_off_desc', 'off_desc', '`off_desc`', '`off_desc`', 200, 50, -1, FALSE, '`off_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off_desc->Sortable = TRUE; // Allow sort
		$this->fields['off_desc'] = &$this->off_desc;

		// region_name
		$this->region_name = new DbField('inventory_chart', 'inventory_chart', 'x_region_name', 'region_name', '`region_name`', '`region_name`', 200, 60, -1, FALSE, '`region_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->region_name->Sortable = TRUE; // Allow sort
		$this->fields['region_name'] = &$this->region_name;

		// prov_name
		$this->prov_name = new DbField('inventory_chart', 'inventory_chart', 'x_prov_name', 'prov_name', '`prov_name`', '`prov_name`', 200, 60, -1, FALSE, '`prov_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->prov_name->Sortable = TRUE; // Allow sort
		$this->fields['prov_name'] = &$this->prov_name;

		// city_name
		$this->city_name = new DbField('inventory_chart', 'inventory_chart', 'x_city_name', 'city_name', '`city_name`', '`city_name`', 200, 100, -1, FALSE, '`city_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city_name->Sortable = TRUE; // Allow sort
		$this->fields['city_name'] = &$this->city_name;

		// name_accountable
		$this->name_accountable = new DbField('inventory_chart', 'inventory_chart', 'x_name_accountable', 'name_accountable', '`name_accountable`', '`name_accountable`', 3, 50, -1, FALSE, '`name_accountable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->name_accountable->Sortable = TRUE; // Allow sort
		$this->name_accountable->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['name_accountable'] = &$this->name_accountable;

		// Designation
		$this->Designation = new DbField('inventory_chart', 'inventory_chart', 'x_Designation', 'Designation', '`Designation`', '`Designation`', 3, 50, -1, FALSE, '`Designation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Designation->Sortable = TRUE; // Allow sort
		$this->Designation->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Designation'] = &$this->Designation;

		// inventory_status_dsc
		$this->inventory_status_dsc = new DbField('inventory_chart', 'inventory_chart', 'x_inventory_status_dsc', 'inventory_status_dsc', '`inventory_status_dsc`', '`inventory_status_dsc`', 200, 50, -1, FALSE, '`inventory_status_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inventory_status_dsc->Sortable = TRUE; // Allow sort
		$this->fields['inventory_status_dsc'] = &$this->inventory_status_dsc;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`inventory_chart`";
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
			$this->inventory_id->setDbValue($conn->insert_ID());
			$rs['inventory_id'] = $this->inventory_id->DbValue;
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
			if (array_key_exists('inventory_id', $rs))
				AddFilter($where, QuotedName('inventory_id', $this->Dbid) . '=' . QuotedValue($rs['inventory_id'], $this->inventory_id->DataType, $this->Dbid));
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
		$this->inventory_id->DbValue = $row['inventory_id'];
		$this->month_dsc->DbValue = $row['month_dsc'];
		$this->year_dsc->DbValue = $row['year_dsc'];
		$this->cat_desc->DbValue = $row['cat_desc'];
		$this->item_model->DbValue = $row['item_model'];
		$this->item_serial->DbValue = $row['item_serial'];
		$this->off_desc->DbValue = $row['off_desc'];
		$this->region_name->DbValue = $row['region_name'];
		$this->prov_name->DbValue = $row['prov_name'];
		$this->city_name->DbValue = $row['city_name'];
		$this->name_accountable->DbValue = $row['name_accountable'];
		$this->Designation->DbValue = $row['Designation'];
		$this->inventory_status_dsc->DbValue = $row['inventory_status_dsc'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`inventory_id` = @inventory_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('inventory_id', $row) ? $row['inventory_id'] : NULL;
		else
			$val = $this->inventory_id->OldValue !== NULL ? $this->inventory_id->OldValue : $this->inventory_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@inventory_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "inventory_chartlist.php";
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
		if ($pageName == "inventory_chartview.php")
			return $Language->phrase("View");
		elseif ($pageName == "inventory_chartedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "inventory_chartadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "inventory_chartlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("inventory_chartview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("inventory_chartview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "inventory_chartadd.php?" . $this->getUrlParm($parm);
		else
			$url = "inventory_chartadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("inventory_chartedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("inventory_chartadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("inventory_chartdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "inventory_id:" . JsonEncode($this->inventory_id->CurrentValue, "number");
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
		if ($this->inventory_id->CurrentValue != NULL) {
			$url .= "inventory_id=" . urlencode($this->inventory_id->CurrentValue);
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
			if (Param("inventory_id") !== NULL)
				$arKeys[] = Param("inventory_id");
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
				$this->inventory_id->CurrentValue = $key;
			else
				$this->inventory_id->OldValue = $key;
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
		$this->inventory_id->setDbValue($rs->fields('inventory_id'));
		$this->month_dsc->setDbValue($rs->fields('month_dsc'));
		$this->year_dsc->setDbValue($rs->fields('year_dsc'));
		$this->cat_desc->setDbValue($rs->fields('cat_desc'));
		$this->item_model->setDbValue($rs->fields('item_model'));
		$this->item_serial->setDbValue($rs->fields('item_serial'));
		$this->off_desc->setDbValue($rs->fields('off_desc'));
		$this->region_name->setDbValue($rs->fields('region_name'));
		$this->prov_name->setDbValue($rs->fields('prov_name'));
		$this->city_name->setDbValue($rs->fields('city_name'));
		$this->name_accountable->setDbValue($rs->fields('name_accountable'));
		$this->Designation->setDbValue($rs->fields('Designation'));
		$this->inventory_status_dsc->setDbValue($rs->fields('inventory_status_dsc'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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
		// name_accountable
		// Designation
		// inventory_status_dsc
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

		// name_accountable
		$this->name_accountable->ViewValue = $this->name_accountable->CurrentValue;
		$this->name_accountable->ViewValue = FormatNumber($this->name_accountable->ViewValue, 0, -2, -2, -2);
		$this->name_accountable->ViewCustomAttributes = "";

		// Designation
		$this->Designation->ViewValue = $this->Designation->CurrentValue;
		$this->Designation->ViewValue = FormatNumber($this->Designation->ViewValue, 0, -2, -2, -2);
		$this->Designation->ViewCustomAttributes = "";

		// inventory_status_dsc
		$this->inventory_status_dsc->ViewValue = $this->inventory_status_dsc->CurrentValue;
		$this->inventory_status_dsc->ViewCustomAttributes = "";

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

		// item_serial
		$this->item_serial->LinkCustomAttributes = "";
		$this->item_serial->HrefValue = "";
		$this->item_serial->TooltipValue = "";

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

		// name_accountable
		$this->name_accountable->LinkCustomAttributes = "";
		$this->name_accountable->HrefValue = "";
		$this->name_accountable->TooltipValue = "";

		// Designation
		$this->Designation->LinkCustomAttributes = "";
		$this->Designation->HrefValue = "";
		$this->Designation->TooltipValue = "";

		// inventory_status_dsc
		$this->inventory_status_dsc->LinkCustomAttributes = "";
		$this->inventory_status_dsc->HrefValue = "";
		$this->inventory_status_dsc->TooltipValue = "";

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

		// inventory_id
		$this->inventory_id->EditAttrs["class"] = "form-control";
		$this->inventory_id->EditCustomAttributes = "";
		$this->inventory_id->EditValue = $this->inventory_id->CurrentValue;
		$this->inventory_id->ViewCustomAttributes = "";

		// month_dsc
		$this->month_dsc->EditAttrs["class"] = "form-control";
		$this->month_dsc->EditCustomAttributes = "";
		if (!$this->month_dsc->Raw)
			$this->month_dsc->CurrentValue = HtmlDecode($this->month_dsc->CurrentValue);
		$this->month_dsc->EditValue = $this->month_dsc->CurrentValue;
		$this->month_dsc->PlaceHolder = RemoveHtml($this->month_dsc->caption());

		// year_dsc
		$this->year_dsc->EditAttrs["class"] = "form-control";
		$this->year_dsc->EditCustomAttributes = "";
		if (!$this->year_dsc->Raw)
			$this->year_dsc->CurrentValue = HtmlDecode($this->year_dsc->CurrentValue);
		$this->year_dsc->EditValue = $this->year_dsc->CurrentValue;
		$this->year_dsc->PlaceHolder = RemoveHtml($this->year_dsc->caption());

		// cat_desc
		$this->cat_desc->EditAttrs["class"] = "form-control";
		$this->cat_desc->EditCustomAttributes = "";
		if (!$this->cat_desc->Raw)
			$this->cat_desc->CurrentValue = HtmlDecode($this->cat_desc->CurrentValue);
		$this->cat_desc->EditValue = $this->cat_desc->CurrentValue;
		$this->cat_desc->PlaceHolder = RemoveHtml($this->cat_desc->caption());

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

		// off_desc
		$this->off_desc->EditAttrs["class"] = "form-control";
		$this->off_desc->EditCustomAttributes = "";
		if (!$this->off_desc->Raw)
			$this->off_desc->CurrentValue = HtmlDecode($this->off_desc->CurrentValue);
		$this->off_desc->EditValue = $this->off_desc->CurrentValue;
		$this->off_desc->PlaceHolder = RemoveHtml($this->off_desc->caption());

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

		// name_accountable
		$this->name_accountable->EditAttrs["class"] = "form-control";
		$this->name_accountable->EditCustomAttributes = "";
		$this->name_accountable->EditValue = $this->name_accountable->CurrentValue;
		$this->name_accountable->PlaceHolder = RemoveHtml($this->name_accountable->caption());

		// Designation
		$this->Designation->EditAttrs["class"] = "form-control";
		$this->Designation->EditCustomAttributes = "";
		$this->Designation->EditValue = $this->Designation->CurrentValue;
		$this->Designation->PlaceHolder = RemoveHtml($this->Designation->caption());

		// inventory_status_dsc
		$this->inventory_status_dsc->EditAttrs["class"] = "form-control";
		$this->inventory_status_dsc->EditCustomAttributes = "";
		if (!$this->inventory_status_dsc->Raw)
			$this->inventory_status_dsc->CurrentValue = HtmlDecode($this->inventory_status_dsc->CurrentValue);
		$this->inventory_status_dsc->EditValue = $this->inventory_status_dsc->CurrentValue;
		$this->inventory_status_dsc->PlaceHolder = RemoveHtml($this->inventory_status_dsc->caption());

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
					$doc->exportCaption($this->inventory_id);
					$doc->exportCaption($this->month_dsc);
					$doc->exportCaption($this->year_dsc);
					$doc->exportCaption($this->cat_desc);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->off_desc);
					$doc->exportCaption($this->region_name);
					$doc->exportCaption($this->prov_name);
					$doc->exportCaption($this->city_name);
					$doc->exportCaption($this->name_accountable);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->inventory_status_dsc);
				} else {
					$doc->exportCaption($this->inventory_id);
					$doc->exportCaption($this->month_dsc);
					$doc->exportCaption($this->year_dsc);
					$doc->exportCaption($this->cat_desc);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->off_desc);
					$doc->exportCaption($this->region_name);
					$doc->exportCaption($this->prov_name);
					$doc->exportCaption($this->city_name);
					$doc->exportCaption($this->name_accountable);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->inventory_status_dsc);
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
						$doc->exportField($this->inventory_id);
						$doc->exportField($this->month_dsc);
						$doc->exportField($this->year_dsc);
						$doc->exportField($this->cat_desc);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->off_desc);
						$doc->exportField($this->region_name);
						$doc->exportField($this->prov_name);
						$doc->exportField($this->city_name);
						$doc->exportField($this->name_accountable);
						$doc->exportField($this->Designation);
						$doc->exportField($this->inventory_status_dsc);
					} else {
						$doc->exportField($this->inventory_id);
						$doc->exportField($this->month_dsc);
						$doc->exportField($this->year_dsc);
						$doc->exportField($this->cat_desc);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->off_desc);
						$doc->exportField($this->region_name);
						$doc->exportField($this->prov_name);
						$doc->exportField($this->city_name);
						$doc->exportField($this->name_accountable);
						$doc->exportField($this->Designation);
						$doc->exportField($this->inventory_status_dsc);
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