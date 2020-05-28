<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for purchase_report
 */
class purchase_report extends ReportTable
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
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;

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
	public $user_last_modify;
	public $date_last_modify;
	public $Name_dsc;
	public $purpose;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'purchase_report';
		$this->TableName = 'purchase_report';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`purchace_view`";
		$this->ReportSourceTable = 'purchace_view'; // Report source table
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

		// pr_number
		$this->pr_number = new ReportField('purchase_report', 'purchase_report', 'x_pr_number', 'pr_number', '`pr_number`', '`pr_number`', 200, 100, -1, FALSE, '`pr_number`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pr_number->GroupingFieldId = 1;
		$this->pr_number->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->pr_number->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->pr_number->GroupByType = "";
		$this->pr_number->GroupInterval = "0";
		$this->pr_number->GroupSql = "";
		$this->pr_number->Sortable = TRUE; // Allow sort
		$this->pr_number->SourceTableVar = 'purchace_view';
		$this->fields['pr_number'] = &$this->pr_number;

		// date_prep
		$this->date_prep = new ReportField('purchase_report', 'purchase_report', 'x_date_prep', 'date_prep', '`date_prep`', CastDateFieldForLike("`date_prep`", 0, "DB"), 133, 10, -1, FALSE, '`date_prep`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_prep->GroupingFieldId = 2;
		$this->date_prep->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->date_prep->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->date_prep->GroupByType = "";
		$this->date_prep->GroupInterval = "0";
		$this->date_prep->GroupSql = "";
		$this->date_prep->Sortable = TRUE; // Allow sort
		$this->date_prep->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->date_prep->SourceTableVar = 'purchace_view';
		$this->fields['date_prep'] = &$this->date_prep;

		// spec_unit
		$this->spec_unit = new ReportField('purchase_report', 'purchase_report', 'x_spec_unit', 'spec_unit', '`spec_unit`', '`spec_unit`', 3, 11, -1, FALSE, '`spec_unit`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		$this->spec_unit->SourceTableVar = 'purchace_view';
		$this->fields['spec_unit'] = &$this->spec_unit;

		// spec_dsc
		$this->spec_dsc = new ReportField('purchase_report', 'purchase_report', 'x_spec_dsc', 'spec_dsc', '`spec_dsc`', '`spec_dsc`', 200, 100, -1, FALSE, '`spec_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_dsc->Sortable = TRUE; // Allow sort
		$this->spec_dsc->SourceTableVar = 'purchace_view';
		$this->fields['spec_dsc'] = &$this->spec_dsc;

		// spec_qty
		$this->spec_qty = new ReportField('purchase_report', 'purchase_report', 'x_spec_qty', 'spec_qty', '`spec_qty`', '`spec_qty`', 131, 50, -1, FALSE, '`spec_qty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_qty->Sortable = TRUE; // Allow sort
		$this->spec_qty->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->spec_qty->SourceTableVar = 'purchace_view';
		$this->fields['spec_qty'] = &$this->spec_qty;

		// spec_unitprice
		$this->spec_unitprice = new ReportField('purchase_report', 'purchase_report', 'x_spec_unitprice', 'spec_unitprice', '`spec_unitprice`', '`spec_unitprice`', 131, 50, -1, FALSE, '`spec_unitprice`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_unitprice->Sortable = TRUE; // Allow sort
		$this->spec_unitprice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->spec_unitprice->SourceTableVar = 'purchace_view';
		$this->fields['spec_unitprice'] = &$this->spec_unitprice;

		// spec_totalprice
		$this->spec_totalprice = new ReportField('purchase_report', 'purchase_report', 'x_spec_totalprice', 'spec_totalprice', '`spec_totalprice`', '`spec_totalprice`', 131, 50, -1, FALSE, '`spec_totalprice`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spec_totalprice->Sortable = TRUE; // Allow sort
		$this->spec_totalprice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->spec_totalprice->SourceTableVar = 'purchace_view';
		$this->fields['spec_totalprice'] = &$this->spec_totalprice;

		// user_last_modify
		$this->user_last_modify = new ReportField('purchase_report', 'purchase_report', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->user_last_modify->SourceTableVar = 'purchace_view';
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// date_last_modify
		$this->date_last_modify = new ReportField('purchase_report', 'purchase_report', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 0, "DB"), 135, 19, 0, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_last_modify->Sortable = TRUE; // Allow sort
		$this->date_last_modify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->date_last_modify->SourceTableVar = 'purchace_view';
		$this->fields['date_last_modify'] = &$this->date_last_modify;

		// Name_dsc
		$this->Name_dsc = new ReportField('purchase_report', 'purchase_report', 'x_Name_dsc', 'Name_dsc', '`Name_dsc`', '`Name_dsc`', 200, 50, -1, FALSE, '`Name_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name_dsc->Sortable = TRUE; // Allow sort
		$this->Name_dsc->SourceTableVar = 'purchace_view';
		$this->fields['Name_dsc'] = &$this->Name_dsc;

		// purpose
		$this->purpose = new ReportField('purchase_report', 'purchase_report', 'x_purpose', 'purpose', '`purpose`', '`purpose`', 200, 200, -1, FALSE, '`purpose`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->purpose->Sortable = TRUE; // Allow sort
		$this->purpose->MemoMaxLength = 30;
		$this->purpose->SourceTableVar = 'purchace_view';
		$this->fields['purpose'] = &$this->purpose;
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
		$firstGroupField = &$this->pr_number;
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
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT SUM(`spec_totalprice`) AS `sum_spec_totalprice` FROM " . $this->getSqlFrom();
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
		$this->pr_number->ViewValue = $this->pr_number->CurrentValue;
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
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
		$groupField = &$this->pr_number;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		$groupField = &$this->date_prep;
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