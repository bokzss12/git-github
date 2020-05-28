<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for Printing Report 1
 */
class Printing_Report_1 extends ReportTable
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
	public $ShowGroupHeaderAsRow = TRUE;
	public $ShowCompactSummaryFooter = TRUE;

	// Export
	public $ExportDoc;

	// Fields
	public $typeofprinting;
	public $printingID;
	public $month_dsc;
	public $year_dsc;
	public $printing_date;
	public $printed_forms;
	public $total_forms;
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
		$this->TableVar = 'Printing_Report_1';
		$this->TableName = 'Printing Report 1';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`printingreport1`";
		$this->ReportSourceTable = 'printingreport1'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("USER_ID_ALLOW_SECURITY"); // Default User ID Allow Security
		$this->UserIDAllowSecurity |= 0; // User ID Allow

		// typeofprinting
		$this->typeofprinting = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_typeofprinting', 'typeofprinting', '`typeofprinting`', '`typeofprinting`', 200, 50, -1, FALSE, '`typeofprinting`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->typeofprinting->GroupingFieldId = 1;
		$this->typeofprinting->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->typeofprinting->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->typeofprinting->GroupByType = "";
		$this->typeofprinting->GroupInterval = "0";
		$this->typeofprinting->GroupSql = "";
		$this->typeofprinting->Sortable = TRUE; // Allow sort
		$this->typeofprinting->SourceTableVar = 'printingreport1';
		$this->fields['typeofprinting'] = &$this->typeofprinting;

		// printingID
		$this->printingID = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_printingID', 'printingID', '`printingID`', '`printingID`', 3, 11, -1, FALSE, '`printingID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', '');
		$this->printingID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->printingID->IsPrimaryKey = TRUE; // Primary key field
		$this->printingID->Sortable = TRUE; // Allow sort
		$this->printingID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->printingID->SourceTableVar = 'printingreport1';
		$this->fields['printingID'] = &$this->printingID;

		// month_dsc
		$this->month_dsc = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_month_dsc', 'month_dsc', '`month_dsc`', '`month_dsc`', 200, 50, -1, FALSE, '`month_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->month_dsc->Sortable = FALSE; // Allow sort
		$this->month_dsc->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->month_dsc->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->month_dsc->Lookup = new Lookup('month_dsc', 'printingreport1', TRUE, 'month_dsc', ["month_dsc","","",""], [], [], [], [], [], [], '`month_dsc` ASC', '');
				break;
			default:
				$this->month_dsc->Lookup = new Lookup('month_dsc', 'printingreport1', TRUE, 'month_dsc', ["month_dsc","","",""], [], [], [], [], [], [], '`month_dsc` ASC', '');
				break;
		}
		$this->month_dsc->SourceTableVar = 'printingreport1';
		$this->fields['month_dsc'] = &$this->month_dsc;

		// year_dsc
		$this->year_dsc = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_year_dsc', 'year_dsc', '`year_dsc`', '`year_dsc`', 200, 50, -1, FALSE, '`year_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->year_dsc->Sortable = FALSE; // Allow sort
		$this->year_dsc->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->year_dsc->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->year_dsc->Lookup = new Lookup('year_dsc', 'printingreport1', TRUE, 'year_dsc', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` ASC', '');
				break;
			default:
				$this->year_dsc->Lookup = new Lookup('year_dsc', 'printingreport1', TRUE, 'year_dsc', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` ASC', '');
				break;
		}
		$this->year_dsc->SourceTableVar = 'printingreport1';
		$this->fields['year_dsc'] = &$this->year_dsc;

		// printing_date
		$this->printing_date = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_printing_date', 'printing_date', '`printing_date`', CastDateFieldForLike("`printing_date`", 0, "DB"), 133, 10, 0, FALSE, '`printing_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->printing_date->Sortable = TRUE; // Allow sort
		$this->printing_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->printing_date->AdvancedSearch->SearchValueDefault = date("m/01/Y");
		$this->printing_date->AdvancedSearch->SearchValue2Default = date("m/01/Y");
		$this->printing_date->AdvancedSearch->SearchOperatorDefault = "BETWEEN";
		$this->printing_date->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->printing_date->AdvancedSearch->SearchConditionDefault = "AND";
		$this->printing_date->SourceTableVar = 'printingreport1';
		$this->fields['printing_date'] = &$this->printing_date;

		// printed_forms
		$this->printed_forms = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_printed_forms', 'printed_forms', '`printed_forms`', '`printed_forms`', 201, 500, -1, FALSE, '`printed_forms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->printed_forms->Sortable = TRUE; // Allow sort
		$this->printed_forms->MemoMaxLength = 30;
		$this->printed_forms->SourceTableVar = 'printingreport1';
		$this->fields['printed_forms'] = &$this->printed_forms;

		// total_forms
		$this->total_forms = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_total_forms', 'total_forms', '`total_forms`', '`total_forms`', 131, 50, -1, FALSE, '`total_forms`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_forms->Sortable = TRUE; // Allow sort
		$this->total_forms->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->total_forms->SourceTableVar = 'printingreport1';
		$this->fields['total_forms'] = &$this->total_forms;

		// statusPrinting
		$this->statusPrinting = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_statusPrinting', 'statusPrinting', '`statusPrinting`', '`statusPrinting`', 200, 50, -1, FALSE, '`statusPrinting`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->statusPrinting->Sortable = TRUE; // Allow sort
		$this->statusPrinting->SourceTableVar = 'printingreport1';
		$this->fields['statusPrinting'] = &$this->statusPrinting;

		// Name_dsc
		$this->Name_dsc = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_Name_dsc', 'Name_dsc', '`Name_dsc`', '`Name_dsc`', 200, 50, -1, FALSE, '`Name_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Name_dsc->Sortable = TRUE; // Allow sort
		$this->Name_dsc->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Name_dsc->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Name_dsc->Lookup = new Lookup('Name_dsc', 'printingreport1', TRUE, 'Name_dsc', ["Name_dsc","","",""], [], [], [], [], [], [], '`Name_dsc` ASC', '');
				break;
			default:
				$this->Name_dsc->Lookup = new Lookup('Name_dsc', 'printingreport1', TRUE, 'Name_dsc', ["Name_dsc","","",""], [], [], [], [], [], [], '`Name_dsc` ASC', '');
				break;
		}
		$this->Name_dsc->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->Name_dsc->SourceTableVar = 'printingreport1';
		$this->fields['Name_dsc'] = &$this->Name_dsc;

		// employeeid
		$this->employeeid = new ReportField('Printing_Report_1', 'Printing Report 1', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', '');
		$this->employeeid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->employeeid->SourceTableVar = 'printingreport1';
		$this->fields['employeeid'] = &$this->employeeid;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
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
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->typeofprinting;
		$expr = $firstGroupField->Expression;
		if ($firstGroupField->GroupSql != "") {
			$expr = str_replace("%s", $firstGroupField->Expression, $firstGroupField->GroupSql);
			if ($alias)
				$expr .= " AS " . QuotedName($firstGroupField->getGroupName(), $this->Dbid);
		}
		return $expr;
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup != "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField(TRUE) . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		if ($this->_sqlOrderByGroup != "")
			return $this->_sqlOrderByGroup;
		return $this->getSqlFirstGroupField() . " ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT SUM(`total_forms`) AS `sum_total_forms` FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix != "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix != "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount != "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->printing_date->ViewValue = FormatDateTime($this->printing_date->CurrentValue, 0);
		$this->Name_dsc->ViewValue = GetDropDownDisplayValue($this->Name_dsc->CurrentValue, "", 0);
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
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
		$groupField = &$this->typeofprinting;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		return "SELECT " . $select . " FROM " . $this->getSqlFrom();
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`printing_date` ASC";
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
			return "";
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
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		return $this->keyUrl("", $this->getUrlParm());
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
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
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
				$filterWrk = '`employeeid` IN (' . $filterWrk . ')';
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
		$sql = "SELECT " . $masterfld->Expression . " FROM `printingreport1`";
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