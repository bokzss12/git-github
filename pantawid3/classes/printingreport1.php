<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for printingreport1
 */
class printingreport1 extends DbTable
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
	public $printingID;
	public $printing_date;
	public $printed_forms;
	public $total_forms;
	public $year_dsc;
	public $month_dsc;
	public $typeofprinting;
	public $statusPrinting;
	public $Name_dsc;
	public $employeeid;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'printingreport1';
		$this->TableName = 'printingreport1';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`printingreport1`";
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
		$this->printingID = new DbField('printingreport1', 'printingreport1', 'x_printingID', 'printingID', '`printingID`', '`printingID`', 3, 11, -1, FALSE, '`printingID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->printingID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->printingID->IsPrimaryKey = TRUE; // Primary key field
		$this->printingID->Sortable = TRUE; // Allow sort
		$this->printingID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['printingID'] = &$this->printingID;

		// printing_date
		$this->printing_date = new DbField('printingreport1', 'printingreport1', 'x_printing_date', 'printing_date', '`printing_date`', CastDateFieldForLike("`printing_date`", 0, "DB"), 133, 10, 0, FALSE, '`printing_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->printing_date->Required = TRUE; // Required field
		$this->printing_date->Sortable = TRUE; // Allow sort
		$this->printing_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['printing_date'] = &$this->printing_date;

		// printed_forms
		$this->printed_forms = new DbField('printingreport1', 'printingreport1', 'x_printed_forms', 'printed_forms', '`printed_forms`', '`printed_forms`', 201, 500, -1, FALSE, '`printed_forms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->printed_forms->Required = TRUE; // Required field
		$this->printed_forms->Sortable = TRUE; // Allow sort
		$this->fields['printed_forms'] = &$this->printed_forms;

		// total_forms
		$this->total_forms = new DbField('printingreport1', 'printingreport1', 'x_total_forms', 'total_forms', '`total_forms`', '`total_forms`', 131, 50, -1, FALSE, '`total_forms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_forms->Required = TRUE; // Required field
		$this->total_forms->Sortable = TRUE; // Allow sort
		$this->total_forms->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_forms'] = &$this->total_forms;

		// year_dsc
		$this->year_dsc = new DbField('printingreport1', 'printingreport1', 'x_year_dsc', 'year_dsc', '`year_dsc`', '`year_dsc`', 200, 50, -1, FALSE, '`year_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->year_dsc->Sortable = TRUE; // Allow sort
		$this->fields['year_dsc'] = &$this->year_dsc;

		// month_dsc
		$this->month_dsc = new DbField('printingreport1', 'printingreport1', 'x_month_dsc', 'month_dsc', '`month_dsc`', '`month_dsc`', 200, 50, -1, FALSE, '`month_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->month_dsc->Sortable = TRUE; // Allow sort
		$this->fields['month_dsc'] = &$this->month_dsc;

		// typeofprinting
		$this->typeofprinting = new DbField('printingreport1', 'printingreport1', 'x_typeofprinting', 'typeofprinting', '`typeofprinting`', '`typeofprinting`', 200, 50, -1, FALSE, '`typeofprinting`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->typeofprinting->Sortable = TRUE; // Allow sort
		$this->fields['typeofprinting'] = &$this->typeofprinting;

		// statusPrinting
		$this->statusPrinting = new DbField('printingreport1', 'printingreport1', 'x_statusPrinting', 'statusPrinting', '`statusPrinting`', '`statusPrinting`', 200, 50, -1, FALSE, '`statusPrinting`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->statusPrinting->Sortable = TRUE; // Allow sort
		$this->fields['statusPrinting'] = &$this->statusPrinting;

		// Name_dsc
		$this->Name_dsc = new DbField('printingreport1', 'printingreport1', 'x_Name_dsc', 'Name_dsc', '`Name_dsc`', '`Name_dsc`', 200, 50, -1, FALSE, '`Name_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name_dsc->Sortable = TRUE; // Allow sort
		$this->fields['Name_dsc'] = &$this->Name_dsc;

		// employeeid
		$this->employeeid = new DbField('printingreport1', 'printingreport1', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->employeeid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employeeid'] = &$this->employeeid;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`printingreport1`";
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
			$this->printingID->setDbValue($conn->insert_ID());
			$rs['printingID'] = $this->printingID->DbValue;

			// Get insert id if necessary
			$this->employeeid->setDbValue($conn->insert_ID());
			$rs['employeeid'] = $this->employeeid->DbValue;
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
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->printingID->DbValue = $row['printingID'];
		$this->printing_date->DbValue = $row['printing_date'];
		$this->printed_forms->DbValue = $row['printed_forms'];
		$this->total_forms->DbValue = $row['total_forms'];
		$this->year_dsc->DbValue = $row['year_dsc'];
		$this->month_dsc->DbValue = $row['month_dsc'];
		$this->typeofprinting->DbValue = $row['typeofprinting'];
		$this->statusPrinting->DbValue = $row['statusPrinting'];
		$this->Name_dsc->DbValue = $row['Name_dsc'];
		$this->employeeid->DbValue = $row['employeeid'];
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
			return "printingreport1list.php";
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
		if ($pageName == "printingreport1view.php")
			return $Language->phrase("View");
		elseif ($pageName == "printingreport1edit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "printingreport1add.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "printingreport1list.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("printingreport1view.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("printingreport1view.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "printingreport1add.php?" . $this->getUrlParm($parm);
		else
			$url = "printingreport1add.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("printingreport1edit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("printingreport1add.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("printingreport1delete.php", $this->getUrlParm());
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
		$this->printing_date->setDbValue($rs->fields('printing_date'));
		$this->printed_forms->setDbValue($rs->fields('printed_forms'));
		$this->total_forms->setDbValue($rs->fields('total_forms'));
		$this->year_dsc->setDbValue($rs->fields('year_dsc'));
		$this->month_dsc->setDbValue($rs->fields('month_dsc'));
		$this->typeofprinting->setDbValue($rs->fields('typeofprinting'));
		$this->statusPrinting->setDbValue($rs->fields('statusPrinting'));
		$this->Name_dsc->setDbValue($rs->fields('Name_dsc'));
		$this->employeeid->setDbValue($rs->fields('employeeid'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// printingID
		// printing_date
		// printed_forms
		// total_forms
		// year_dsc
		// month_dsc
		// typeofprinting
		// statusPrinting
		// Name_dsc
		// employeeid
		// printingID

		$this->printingID->ViewValue = $this->printingID->CurrentValue;
		$this->printingID->ViewCustomAttributes = "";

		// printing_date
		$this->printing_date->ViewValue = $this->printing_date->CurrentValue;
		$this->printing_date->ViewValue = FormatDateTime($this->printing_date->ViewValue, 0);
		$this->printing_date->ViewCustomAttributes = "";

		// printed_forms
		$this->printed_forms->ViewValue = $this->printed_forms->CurrentValue;
		$this->printed_forms->ViewCustomAttributes = "";

		// total_forms
		$this->total_forms->ViewValue = $this->total_forms->CurrentValue;
		$this->total_forms->ViewValue = FormatNumber($this->total_forms->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
		$this->total_forms->ViewCustomAttributes = "";

		// year_dsc
		$this->year_dsc->ViewValue = $this->year_dsc->CurrentValue;
		$this->year_dsc->ViewCustomAttributes = "";

		// month_dsc
		$this->month_dsc->ViewValue = $this->month_dsc->CurrentValue;
		$this->month_dsc->ViewCustomAttributes = "";

		// typeofprinting
		$this->typeofprinting->ViewValue = $this->typeofprinting->CurrentValue;
		$this->typeofprinting->ViewCustomAttributes = "";

		// statusPrinting
		$this->statusPrinting->ViewValue = $this->statusPrinting->CurrentValue;
		$this->statusPrinting->ViewCustomAttributes = "";

		// Name_dsc
		$this->Name_dsc->ViewValue = $this->Name_dsc->CurrentValue;
		$this->Name_dsc->ViewCustomAttributes = "";

		// employeeid
		$this->employeeid->ViewValue = $this->employeeid->CurrentValue;
		$this->employeeid->ViewCustomAttributes = "";

		// printingID
		$this->printingID->LinkCustomAttributes = "";
		$this->printingID->HrefValue = "";
		$this->printingID->TooltipValue = "";

		// printing_date
		$this->printing_date->LinkCustomAttributes = "";
		$this->printing_date->HrefValue = "";
		$this->printing_date->TooltipValue = "";

		// printed_forms
		$this->printed_forms->LinkCustomAttributes = "";
		$this->printed_forms->HrefValue = "";
		$this->printed_forms->TooltipValue = "";

		// total_forms
		$this->total_forms->LinkCustomAttributes = "";
		$this->total_forms->HrefValue = "";
		$this->total_forms->TooltipValue = "";

		// year_dsc
		$this->year_dsc->LinkCustomAttributes = "";
		$this->year_dsc->HrefValue = "";
		$this->year_dsc->TooltipValue = "";

		// month_dsc
		$this->month_dsc->LinkCustomAttributes = "";
		$this->month_dsc->HrefValue = "";
		$this->month_dsc->TooltipValue = "";

		// typeofprinting
		$this->typeofprinting->LinkCustomAttributes = "";
		$this->typeofprinting->HrefValue = "";
		$this->typeofprinting->TooltipValue = "";

		// statusPrinting
		$this->statusPrinting->LinkCustomAttributes = "";
		$this->statusPrinting->HrefValue = "";
		$this->statusPrinting->TooltipValue = "";

		// Name_dsc
		$this->Name_dsc->LinkCustomAttributes = "";
		$this->Name_dsc->HrefValue = "";
		$this->Name_dsc->TooltipValue = "";

		// employeeid
		$this->employeeid->LinkCustomAttributes = "";
		$this->employeeid->HrefValue = "";
		$this->employeeid->TooltipValue = "";

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

		// printing_date
		$this->printing_date->EditAttrs["class"] = "form-control";
		$this->printing_date->EditCustomAttributes = "";
		$this->printing_date->EditValue = FormatDateTime($this->printing_date->CurrentValue, 8);
		$this->printing_date->PlaceHolder = RemoveHtml($this->printing_date->caption());

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
			$this->total_forms->EditValue = FormatNumber($this->total_forms->EditValue, -2, -1, -2, 0);
		

		// year_dsc
		$this->year_dsc->EditAttrs["class"] = "form-control";
		$this->year_dsc->EditCustomAttributes = "";
		if (!$this->year_dsc->Raw)
			$this->year_dsc->CurrentValue = HtmlDecode($this->year_dsc->CurrentValue);
		$this->year_dsc->EditValue = $this->year_dsc->CurrentValue;
		$this->year_dsc->PlaceHolder = RemoveHtml($this->year_dsc->caption());

		// month_dsc
		$this->month_dsc->EditAttrs["class"] = "form-control";
		$this->month_dsc->EditCustomAttributes = "";
		if (!$this->month_dsc->Raw)
			$this->month_dsc->CurrentValue = HtmlDecode($this->month_dsc->CurrentValue);
		$this->month_dsc->EditValue = $this->month_dsc->CurrentValue;
		$this->month_dsc->PlaceHolder = RemoveHtml($this->month_dsc->caption());

		// typeofprinting
		$this->typeofprinting->EditAttrs["class"] = "form-control";
		$this->typeofprinting->EditCustomAttributes = "";
		if (!$this->typeofprinting->Raw)
			$this->typeofprinting->CurrentValue = HtmlDecode($this->typeofprinting->CurrentValue);
		$this->typeofprinting->EditValue = $this->typeofprinting->CurrentValue;
		$this->typeofprinting->PlaceHolder = RemoveHtml($this->typeofprinting->caption());

		// statusPrinting
		$this->statusPrinting->EditAttrs["class"] = "form-control";
		$this->statusPrinting->EditCustomAttributes = "";
		if (!$this->statusPrinting->Raw)
			$this->statusPrinting->CurrentValue = HtmlDecode($this->statusPrinting->CurrentValue);
		$this->statusPrinting->EditValue = $this->statusPrinting->CurrentValue;
		$this->statusPrinting->PlaceHolder = RemoveHtml($this->statusPrinting->caption());

		// Name_dsc
		$this->Name_dsc->EditAttrs["class"] = "form-control";
		$this->Name_dsc->EditCustomAttributes = "";
		if (!$this->Name_dsc->Raw)
			$this->Name_dsc->CurrentValue = HtmlDecode($this->Name_dsc->CurrentValue);
		$this->Name_dsc->EditValue = $this->Name_dsc->CurrentValue;
		$this->Name_dsc->PlaceHolder = RemoveHtml($this->Name_dsc->caption());

		// employeeid
		$this->employeeid->EditAttrs["class"] = "form-control";
		$this->employeeid->EditCustomAttributes = "";
		$this->employeeid->EditValue = $this->employeeid->CurrentValue;
		$this->employeeid->PlaceHolder = RemoveHtml($this->employeeid->caption());

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
			$this->total_forms->ViewValue = FormatNumber($this->total_forms->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
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
					$doc->exportCaption($this->printingID);
					$doc->exportCaption($this->printing_date);
					$doc->exportCaption($this->printed_forms);
					$doc->exportCaption($this->total_forms);
					$doc->exportCaption($this->year_dsc);
					$doc->exportCaption($this->month_dsc);
					$doc->exportCaption($this->typeofprinting);
					$doc->exportCaption($this->statusPrinting);
					$doc->exportCaption($this->Name_dsc);
					$doc->exportCaption($this->employeeid);
				} else {
					$doc->exportCaption($this->printingID);
					$doc->exportCaption($this->printing_date);
					$doc->exportCaption($this->printed_forms);
					$doc->exportCaption($this->total_forms);
					$doc->exportCaption($this->year_dsc);
					$doc->exportCaption($this->month_dsc);
					$doc->exportCaption($this->typeofprinting);
					$doc->exportCaption($this->statusPrinting);
					$doc->exportCaption($this->Name_dsc);
					$doc->exportCaption($this->employeeid);
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
						$doc->exportField($this->printingID);
						$doc->exportField($this->printing_date);
						$doc->exportField($this->printed_forms);
						$doc->exportField($this->total_forms);
						$doc->exportField($this->year_dsc);
						$doc->exportField($this->month_dsc);
						$doc->exportField($this->typeofprinting);
						$doc->exportField($this->statusPrinting);
						$doc->exportField($this->Name_dsc);
						$doc->exportField($this->employeeid);
					} else {
						$doc->exportField($this->printingID);
						$doc->exportField($this->printing_date);
						$doc->exportField($this->printed_forms);
						$doc->exportField($this->total_forms);
						$doc->exportField($this->year_dsc);
						$doc->exportField($this->month_dsc);
						$doc->exportField($this->typeofprinting);
						$doc->exportField($this->statusPrinting);
						$doc->exportField($this->Name_dsc);
						$doc->exportField($this->employeeid);
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
				$doc->exportAggregate($this->printed_forms, '');
				$doc->exportAggregate($this->total_forms, 'TOTAL');
				$doc->exportAggregate($this->year_dsc, '');
				$doc->exportAggregate($this->month_dsc, '');
				$doc->exportAggregate($this->typeofprinting, '');
				$doc->exportAggregate($this->statusPrinting, '');
				$doc->exportAggregate($this->Name_dsc, '');
				$doc->exportAggregate($this->employeeid, '');
				$doc->endExportRow();
			}
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