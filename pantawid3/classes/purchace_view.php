<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for purchace_view
 */
class purchace_view extends DbTable
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
	public $pr_number;
	public $date_prep;
	public $spec_unit;
	public $spec_dsc;
	public $spec_qty;
	public $spec_unitprice;
	public $spec_totalprice;
	public $Name_dsc;
	public $user_last_modify;
	public $date_last_modify;
	public $purpose;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'purchace_view';
		$this->TableName = 'purchace_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`purchace_view`";
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

		// pr_number
		$this->pr_number = new DbField('purchace_view', 'purchace_view', 'x_pr_number', 'pr_number', '`pr_number`', '`pr_number`', 200, 100, -1, FALSE, '`pr_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pr_number->Sortable = TRUE; // Allow sort
		$this->fields['pr_number'] = &$this->pr_number;

		// date_prep
		$this->date_prep = new DbField('purchace_view', 'purchace_view', 'x_date_prep', 'date_prep', '`date_prep`', CastDateFieldForLike("`date_prep`", 0, "DB"), 133, 10, 0, FALSE, '`date_prep`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_prep->Sortable = TRUE; // Allow sort
		$this->date_prep->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_prep'] = &$this->date_prep;

		// spec_unit
		$this->spec_unit = new DbField('purchace_view', 'purchace_view', 'x_spec_unit', 'spec_unit', '`spec_unit`', '`spec_unit`', 3, 11, -1, FALSE, '`spec_unit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_unit->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->spec_unit->Lookup = new Lookup('spec_unit', 'tbl_purchase_unit', FALSE, 'pruID', ["unit_desc","","",""], [], [], [], [], [], [], '`unit_desc` ASC', '');
				break;
			default:
				$this->spec_unit->Lookup = new Lookup('spec_unit', 'tbl_purchase_unit', FALSE, 'pruID', ["unit_desc","","",""], [], [], [], [], [], [], '`unit_desc` ASC', '');
				break;
		}
		$this->spec_unit->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['spec_unit'] = &$this->spec_unit;

		// spec_dsc
		$this->spec_dsc = new DbField('purchace_view', 'purchace_view', 'x_spec_dsc', 'spec_dsc', '`spec_dsc`', '`spec_dsc`', 200, 100, -1, FALSE, '`spec_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_dsc->Sortable = TRUE; // Allow sort
		$this->fields['spec_dsc'] = &$this->spec_dsc;

		// spec_qty
		$this->spec_qty = new DbField('purchace_view', 'purchace_view', 'x_spec_qty', 'spec_qty', '`spec_qty`', '`spec_qty`', 131, 50, -1, FALSE, '`spec_qty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_qty->Sortable = TRUE; // Allow sort
		$this->spec_qty->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['spec_qty'] = &$this->spec_qty;

		// spec_unitprice
		$this->spec_unitprice = new DbField('purchace_view', 'purchace_view', 'x_spec_unitprice', 'spec_unitprice', '`spec_unitprice`', '`spec_unitprice`', 131, 50, -1, FALSE, '`spec_unitprice`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_unitprice->Sortable = TRUE; // Allow sort
		$this->spec_unitprice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['spec_unitprice'] = &$this->spec_unitprice;

		// spec_totalprice
		$this->spec_totalprice = new DbField('purchace_view', 'purchace_view', 'x_spec_totalprice', 'spec_totalprice', '`spec_totalprice`', '`spec_totalprice`', 131, 50, -1, FALSE, '`spec_totalprice`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_totalprice->Sortable = TRUE; // Allow sort
		$this->spec_totalprice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['spec_totalprice'] = &$this->spec_totalprice;

		// Name_dsc
		$this->Name_dsc = new DbField('purchace_view', 'purchace_view', 'x_Name_dsc', 'Name_dsc', '`Name_dsc`', '`Name_dsc`', 200, 50, -1, FALSE, '`Name_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name_dsc->Sortable = TRUE; // Allow sort
		$this->fields['Name_dsc'] = &$this->Name_dsc;

		// user_last_modify
		$this->user_last_modify = new DbField('purchace_view', 'purchace_view', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// date_last_modify
		$this->date_last_modify = new DbField('purchace_view', 'purchace_view', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 0, "DB"), 135, 19, 0, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_last_modify->Sortable = TRUE; // Allow sort
		$this->date_last_modify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_last_modify'] = &$this->date_last_modify;

		// purpose
		$this->purpose = new DbField('purchace_view', 'purchace_view', 'x_purpose', 'purpose', '`purpose`', '`purpose`', 200, 200, -1, FALSE, '`purpose`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->purpose->Sortable = TRUE; // Allow sort
		$this->fields['purpose'] = &$this->purpose;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`purchace_view`";
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
		$this->pr_number->DbValue = $row['pr_number'];
		$this->date_prep->DbValue = $row['date_prep'];
		$this->spec_unit->DbValue = $row['spec_unit'];
		$this->spec_dsc->DbValue = $row['spec_dsc'];
		$this->spec_qty->DbValue = $row['spec_qty'];
		$this->spec_unitprice->DbValue = $row['spec_unitprice'];
		$this->spec_totalprice->DbValue = $row['spec_totalprice'];
		$this->Name_dsc->DbValue = $row['Name_dsc'];
		$this->user_last_modify->DbValue = $row['user_last_modify'];
		$this->date_last_modify->DbValue = $row['date_last_modify'];
		$this->purpose->DbValue = $row['purpose'];
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
			return "purchace_viewlist.php";
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
		if ($pageName == "purchace_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "purchace_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "purchace_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "purchace_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("purchace_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("purchace_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "purchace_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "purchace_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("purchace_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("purchace_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("purchace_viewdelete.php", $this->getUrlParm());
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
		$this->pr_number->setDbValue($rs->fields('pr_number'));
		$this->date_prep->setDbValue($rs->fields('date_prep'));
		$this->spec_unit->setDbValue($rs->fields('spec_unit'));
		$this->spec_dsc->setDbValue($rs->fields('spec_dsc'));
		$this->spec_qty->setDbValue($rs->fields('spec_qty'));
		$this->spec_unitprice->setDbValue($rs->fields('spec_unitprice'));
		$this->spec_totalprice->setDbValue($rs->fields('spec_totalprice'));
		$this->Name_dsc->setDbValue($rs->fields('Name_dsc'));
		$this->user_last_modify->setDbValue($rs->fields('user_last_modify'));
		$this->date_last_modify->setDbValue($rs->fields('date_last_modify'));
		$this->purpose->setDbValue($rs->fields('purpose'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// pr_number
		// date_prep

		$this->date_prep->CellCssStyle = "width: 0px; white-space: nowrap;";

		// spec_unit
		// spec_dsc
		// spec_qty
		// spec_unitprice
		// spec_totalprice
		// Name_dsc
		// user_last_modify

		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_last_modify
		$this->date_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// purpose
		// pr_number

		$this->pr_number->ViewValue = $this->pr_number->CurrentValue;
		$this->pr_number->ViewCustomAttributes = "";

		// date_prep
		$this->date_prep->ViewValue = $this->date_prep->CurrentValue;
		$this->date_prep->ViewValue = FormatDateTime($this->date_prep->ViewValue, 0);
		$this->date_prep->ViewCustomAttributes = "";

		// spec_unit
		$this->spec_unit->ViewValue = $this->spec_unit->CurrentValue;
		$curVal = strval($this->spec_unit->CurrentValue);
		if ($curVal != "") {
			$this->spec_unit->ViewValue = $this->spec_unit->lookupCacheOption($curVal);
			if ($this->spec_unit->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`pruID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->spec_unit->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->spec_unit->ViewValue = $this->spec_unit->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->spec_unit->ViewValue = $this->spec_unit->CurrentValue;
				}
			}
		} else {
			$this->spec_unit->ViewValue = NULL;
		}
		$this->spec_unit->ViewCustomAttributes = "";

		// spec_dsc
		$this->spec_dsc->ViewValue = $this->spec_dsc->CurrentValue;
		$this->spec_dsc->ViewCustomAttributes = "";

		// spec_qty
		$this->spec_qty->ViewValue = $this->spec_qty->CurrentValue;
		$this->spec_qty->ViewValue = FormatNumber($this->spec_qty->ViewValue, 2, -2, -2, -2);
		$this->spec_qty->ViewCustomAttributes = "";

		// spec_unitprice
		$this->spec_unitprice->ViewValue = $this->spec_unitprice->CurrentValue;
		$this->spec_unitprice->ViewValue = FormatNumber($this->spec_unitprice->ViewValue, 2, -2, -2, -2);
		$this->spec_unitprice->ViewCustomAttributes = "";

		// spec_totalprice
		$this->spec_totalprice->ViewValue = $this->spec_totalprice->CurrentValue;
		$this->spec_totalprice->ViewValue = FormatNumber($this->spec_totalprice->ViewValue, 2, -2, -2, -2);
		$this->spec_totalprice->ViewCustomAttributes = "";

		// Name_dsc
		$this->Name_dsc->ViewValue = $this->Name_dsc->CurrentValue;
		$this->Name_dsc->ViewCustomAttributes = "";

		// user_last_modify
		$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
		$this->user_last_modify->ViewCustomAttributes = "";

		// date_last_modify
		$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
		$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
		$this->date_last_modify->ViewCustomAttributes = "";

		// purpose
		$this->purpose->ViewValue = $this->purpose->CurrentValue;
		$this->purpose->ViewCustomAttributes = "";

		// pr_number
		$this->pr_number->LinkCustomAttributes = "";
		$this->pr_number->HrefValue = "";
		$this->pr_number->TooltipValue = "";

		// date_prep
		$this->date_prep->LinkCustomAttributes = "";
		$this->date_prep->HrefValue = "";
		$this->date_prep->TooltipValue = "";

		// spec_unit
		$this->spec_unit->LinkCustomAttributes = "";
		$this->spec_unit->HrefValue = "";
		$this->spec_unit->TooltipValue = "";

		// spec_dsc
		$this->spec_dsc->LinkCustomAttributes = "";
		$this->spec_dsc->HrefValue = "";
		$this->spec_dsc->TooltipValue = "";

		// spec_qty
		$this->spec_qty->LinkCustomAttributes = "";
		$this->spec_qty->HrefValue = "";
		$this->spec_qty->TooltipValue = "";

		// spec_unitprice
		$this->spec_unitprice->LinkCustomAttributes = "";
		$this->spec_unitprice->HrefValue = "";
		$this->spec_unitprice->TooltipValue = "";

		// spec_totalprice
		$this->spec_totalprice->LinkCustomAttributes = "";
		$this->spec_totalprice->HrefValue = "";
		$this->spec_totalprice->TooltipValue = "";

		// Name_dsc
		$this->Name_dsc->LinkCustomAttributes = "";
		$this->Name_dsc->HrefValue = "";
		$this->Name_dsc->TooltipValue = "";

		// user_last_modify
		$this->user_last_modify->LinkCustomAttributes = "";
		$this->user_last_modify->HrefValue = "";
		$this->user_last_modify->TooltipValue = "";

		// date_last_modify
		$this->date_last_modify->LinkCustomAttributes = "";
		$this->date_last_modify->HrefValue = "";
		$this->date_last_modify->TooltipValue = "";

		// purpose
		$this->purpose->LinkCustomAttributes = "";
		$this->purpose->HrefValue = "";
		$this->purpose->TooltipValue = "";

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

		// pr_number
		$this->pr_number->EditAttrs["class"] = "form-control";
		$this->pr_number->EditCustomAttributes = "";
		if (!$this->pr_number->Raw)
			$this->pr_number->CurrentValue = HtmlDecode($this->pr_number->CurrentValue);
		$this->pr_number->EditValue = $this->pr_number->CurrentValue;
		$this->pr_number->PlaceHolder = RemoveHtml($this->pr_number->caption());

		// date_prep
		$this->date_prep->EditAttrs["class"] = "form-control";
		$this->date_prep->EditCustomAttributes = "";
		$this->date_prep->EditValue = FormatDateTime($this->date_prep->CurrentValue, 8);
		$this->date_prep->PlaceHolder = RemoveHtml($this->date_prep->caption());

		// spec_unit
		$this->spec_unit->EditAttrs["class"] = "form-control";
		$this->spec_unit->EditCustomAttributes = "";
		$this->spec_unit->EditValue = $this->spec_unit->CurrentValue;
		$this->spec_unit->PlaceHolder = RemoveHtml($this->spec_unit->caption());

		// spec_dsc
		$this->spec_dsc->EditAttrs["class"] = "form-control";
		$this->spec_dsc->EditCustomAttributes = "";
		if (!$this->spec_dsc->Raw)
			$this->spec_dsc->CurrentValue = HtmlDecode($this->spec_dsc->CurrentValue);
		$this->spec_dsc->EditValue = $this->spec_dsc->CurrentValue;
		$this->spec_dsc->PlaceHolder = RemoveHtml($this->spec_dsc->caption());

		// spec_qty
		$this->spec_qty->EditAttrs["class"] = "form-control";
		$this->spec_qty->EditCustomAttributes = "";
		$this->spec_qty->EditValue = $this->spec_qty->CurrentValue;
		$this->spec_qty->PlaceHolder = RemoveHtml($this->spec_qty->caption());
		if (strval($this->spec_qty->EditValue) != "" && is_numeric($this->spec_qty->EditValue))
			$this->spec_qty->EditValue = FormatNumber($this->spec_qty->EditValue, -2, -2, -2, -2);
		

		// spec_unitprice
		$this->spec_unitprice->EditAttrs["class"] = "form-control";
		$this->spec_unitprice->EditCustomAttributes = "";
		$this->spec_unitprice->EditValue = $this->spec_unitprice->CurrentValue;
		$this->spec_unitprice->PlaceHolder = RemoveHtml($this->spec_unitprice->caption());
		if (strval($this->spec_unitprice->EditValue) != "" && is_numeric($this->spec_unitprice->EditValue))
			$this->spec_unitprice->EditValue = FormatNumber($this->spec_unitprice->EditValue, -2, -2, -2, -2);
		

		// spec_totalprice
		$this->spec_totalprice->EditAttrs["class"] = "form-control";
		$this->spec_totalprice->EditCustomAttributes = "";
		$this->spec_totalprice->EditValue = $this->spec_totalprice->CurrentValue;
		$this->spec_totalprice->PlaceHolder = RemoveHtml($this->spec_totalprice->caption());
		if (strval($this->spec_totalprice->EditValue) != "" && is_numeric($this->spec_totalprice->EditValue))
			$this->spec_totalprice->EditValue = FormatNumber($this->spec_totalprice->EditValue, -2, -2, -2, -2);
		

		// Name_dsc
		$this->Name_dsc->EditAttrs["class"] = "form-control";
		$this->Name_dsc->EditCustomAttributes = "";
		if (!$this->Name_dsc->Raw)
			$this->Name_dsc->CurrentValue = HtmlDecode($this->Name_dsc->CurrentValue);
		$this->Name_dsc->EditValue = $this->Name_dsc->CurrentValue;
		$this->Name_dsc->PlaceHolder = RemoveHtml($this->Name_dsc->caption());

		// user_last_modify
		// date_last_modify
		// purpose

		$this->purpose->EditAttrs["class"] = "form-control";
		$this->purpose->EditCustomAttributes = "";
		if (!$this->purpose->Raw)
			$this->purpose->CurrentValue = HtmlDecode($this->purpose->CurrentValue);
		$this->purpose->EditValue = $this->purpose->CurrentValue;
		$this->purpose->PlaceHolder = RemoveHtml($this->purpose->caption());

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
					$doc->exportCaption($this->pr_number);
					$doc->exportCaption($this->date_prep);
					$doc->exportCaption($this->spec_unit);
					$doc->exportCaption($this->spec_dsc);
					$doc->exportCaption($this->spec_qty);
					$doc->exportCaption($this->spec_unitprice);
					$doc->exportCaption($this->spec_totalprice);
					$doc->exportCaption($this->Name_dsc);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->purpose);
				} else {
					$doc->exportCaption($this->pr_number);
					$doc->exportCaption($this->date_prep);
					$doc->exportCaption($this->spec_unit);
					$doc->exportCaption($this->spec_dsc);
					$doc->exportCaption($this->spec_qty);
					$doc->exportCaption($this->spec_unitprice);
					$doc->exportCaption($this->spec_totalprice);
					$doc->exportCaption($this->Name_dsc);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->purpose);
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
						$doc->exportField($this->pr_number);
						$doc->exportField($this->date_prep);
						$doc->exportField($this->spec_unit);
						$doc->exportField($this->spec_dsc);
						$doc->exportField($this->spec_qty);
						$doc->exportField($this->spec_unitprice);
						$doc->exportField($this->spec_totalprice);
						$doc->exportField($this->Name_dsc);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->purpose);
					} else {
						$doc->exportField($this->pr_number);
						$doc->exportField($this->date_prep);
						$doc->exportField($this->spec_unit);
						$doc->exportField($this->spec_dsc);
						$doc->exportField($this->spec_qty);
						$doc->exportField($this->spec_unitprice);
						$doc->exportField($this->spec_totalprice);
						$doc->exportField($this->Name_dsc);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->purpose);
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