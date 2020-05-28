<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for per_employee2
 */
class per_employee2 extends ReportTable
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
	public $inventory_id;
	public $cat_desc;
	public $item_model;
	public $item_serial;
	public $off_desc;
	public $region_name;
	public $prov_name;
	public $city_name;
	public $pos_desc;
	public $current_location;
	public $Last_Date_Check;
	public $Name_dsc;
	public $inventory_status_dsc;
	public $remarks;
	public $year_dsc;
	public $name_accountable;
	public $last_name;
	public $first_name;
	public $mid_name;
	public $ext_name;
	public $namefull;
	public $status;
	public $month_dsc;
	public $full_name_tbl;
	public $position;
	public $NameSig;
	public $DesignationSig;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'per_employee2';
		$this->TableName = 'per_employee2';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`item_per_employee`";
		$this->ReportSourceTable = 'item_per_employee'; // Report source table
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

		// inventory_id
		$this->inventory_id = new ReportField('per_employee2', 'per_employee2', 'x_inventory_id', 'inventory_id', '`inventory_id`', '`inventory_id`', 3, 11, -1, FALSE, '`inventory_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inventory_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->inventory_id->IsPrimaryKey = TRUE; // Primary key field
		$this->inventory_id->Sortable = FALSE; // Allow sort
		$this->inventory_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->inventory_id->SourceTableVar = 'item_per_employee';
		$this->fields['inventory_id'] = &$this->inventory_id;

		// cat_desc
		$this->cat_desc = new ReportField('per_employee2', 'per_employee2', 'x_cat_desc', 'cat_desc', '`cat_desc`', '`cat_desc`', 200, 50, -1, FALSE, '`cat_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cat_desc->GroupingFieldId = 1;
		$this->cat_desc->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->cat_desc->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->cat_desc->GroupByType = "";
		$this->cat_desc->GroupInterval = "0";
		$this->cat_desc->GroupSql = "";
		$this->cat_desc->Nullable = FALSE; // NOT NULL field
		$this->cat_desc->Required = TRUE; // Required field
		$this->cat_desc->Sortable = TRUE; // Allow sort
		$this->cat_desc->SourceTableVar = 'item_per_employee';
		$this->fields['cat_desc'] = &$this->cat_desc;

		// item_model
		$this->item_model = new ReportField('per_employee2', 'per_employee2', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 50, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->item_model->SourceTableVar = 'item_per_employee';
		$this->fields['item_model'] = &$this->item_model;

		// item_serial
		$this->item_serial = new ReportField('per_employee2', 'per_employee2', 'x_item_serial', 'item_serial', '`item_serial`', '`item_serial`', 200, 50, -1, FALSE, '`item_serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serial->Sortable = TRUE; // Allow sort
		$this->item_serial->SourceTableVar = 'item_per_employee';
		$this->fields['item_serial'] = &$this->item_serial;

		// off_desc
		$this->off_desc = new ReportField('per_employee2', 'per_employee2', 'x_off_desc', 'off_desc', '`off_desc`', '`off_desc`', 200, 50, -1, FALSE, '`off_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off_desc->Nullable = FALSE; // NOT NULL field
		$this->off_desc->Required = TRUE; // Required field
		$this->off_desc->Sortable = TRUE; // Allow sort
		$this->off_desc->SourceTableVar = 'item_per_employee';
		$this->fields['off_desc'] = &$this->off_desc;

		// region_name
		$this->region_name = new ReportField('per_employee2', 'per_employee2', 'x_region_name', 'region_name', '`region_name`', '`region_name`', 200, 60, -1, FALSE, '`region_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->region_name->Nullable = FALSE; // NOT NULL field
		$this->region_name->Required = TRUE; // Required field
		$this->region_name->Sortable = TRUE; // Allow sort
		$this->region_name->SourceTableVar = 'item_per_employee';
		$this->fields['region_name'] = &$this->region_name;

		// prov_name
		$this->prov_name = new ReportField('per_employee2', 'per_employee2', 'x_prov_name', 'prov_name', '`prov_name`', '`prov_name`', 200, 60, -1, FALSE, '`prov_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->prov_name->Nullable = FALSE; // NOT NULL field
		$this->prov_name->Required = TRUE; // Required field
		$this->prov_name->Sortable = TRUE; // Allow sort
		$this->prov_name->SourceTableVar = 'item_per_employee';
		$this->fields['prov_name'] = &$this->prov_name;

		// city_name
		$this->city_name = new ReportField('per_employee2', 'per_employee2', 'x_city_name', 'city_name', '`city_name`', '`city_name`', 200, 100, -1, FALSE, '`city_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city_name->Nullable = FALSE; // NOT NULL field
		$this->city_name->Required = TRUE; // Required field
		$this->city_name->Sortable = TRUE; // Allow sort
		$this->city_name->SourceTableVar = 'item_per_employee';
		$this->fields['city_name'] = &$this->city_name;

		// pos_desc
		$this->pos_desc = new ReportField('per_employee2', 'per_employee2', 'x_pos_desc', 'pos_desc', '`pos_desc`', '`pos_desc`', 200, 50, -1, FALSE, '`pos_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pos_desc->Nullable = FALSE; // NOT NULL field
		$this->pos_desc->Required = TRUE; // Required field
		$this->pos_desc->Sortable = TRUE; // Allow sort
		$this->pos_desc->SourceTableVar = 'item_per_employee';
		$this->fields['pos_desc'] = &$this->pos_desc;

		// current_location
		$this->current_location = new ReportField('per_employee2', 'per_employee2', 'x_current_location', 'current_location', '`current_location`', '`current_location`', 200, 100, -1, FALSE, '`current_location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->current_location->Nullable = FALSE; // NOT NULL field
		$this->current_location->Required = TRUE; // Required field
		$this->current_location->Sortable = TRUE; // Allow sort
		$this->current_location->SourceTableVar = 'item_per_employee';
		$this->fields['current_location'] = &$this->current_location;

		// Last_Date_Check
		$this->Last_Date_Check = new ReportField('per_employee2', 'per_employee2', 'x_Last_Date_Check', 'Last_Date_Check', '`Last_Date_Check`', CastDateFieldForLike("`Last_Date_Check`", 0, "DB"), 133, 10, 0, FALSE, '`Last_Date_Check`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Last_Date_Check->Sortable = TRUE; // Allow sort
		$this->Last_Date_Check->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->Last_Date_Check->SourceTableVar = 'item_per_employee';
		$this->fields['Last_Date_Check'] = &$this->Last_Date_Check;

		// Name_dsc
		$this->Name_dsc = new ReportField('per_employee2', 'per_employee2', 'x_Name_dsc', 'Name_dsc', '`Name_dsc`', '`Name_dsc`', 200, 50, -1, FALSE, '`Name_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Name_dsc->Nullable = FALSE; // NOT NULL field
		$this->Name_dsc->Required = TRUE; // Required field
		$this->Name_dsc->Sortable = TRUE; // Allow sort
		$this->Name_dsc->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Name_dsc->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Name_dsc->SourceTableVar = 'item_per_employee';
		$this->fields['Name_dsc'] = &$this->Name_dsc;

		// inventory_status_dsc
		$this->inventory_status_dsc = new ReportField('per_employee2', 'per_employee2', 'x_inventory_status_dsc', 'inventory_status_dsc', '`inventory_status_dsc`', '`inventory_status_dsc`', 200, 50, -1, FALSE, '`inventory_status_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inventory_status_dsc->Nullable = FALSE; // NOT NULL field
		$this->inventory_status_dsc->Required = TRUE; // Required field
		$this->inventory_status_dsc->Sortable = TRUE; // Allow sort
		$this->inventory_status_dsc->SourceTableVar = 'item_per_employee';
		$this->fields['inventory_status_dsc'] = &$this->inventory_status_dsc;

		// remarks
		$this->remarks = new ReportField('per_employee2', 'per_employee2', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->remarks->SourceTableVar = 'item_per_employee';
		$this->fields['remarks'] = &$this->remarks;

		// year_dsc
		$this->year_dsc = new ReportField('per_employee2', 'per_employee2', 'x_year_dsc', 'year_dsc', '`year_dsc`', '`year_dsc`', 200, 50, -1, FALSE, '`year_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->year_dsc->Nullable = FALSE; // NOT NULL field
		$this->year_dsc->Required = TRUE; // Required field
		$this->year_dsc->Sortable = TRUE; // Allow sort
		$this->year_dsc->SourceTableVar = 'item_per_employee';
		$this->fields['year_dsc'] = &$this->year_dsc;

		// name_accountable
		$this->name_accountable = new ReportField('per_employee2', 'per_employee2', 'x_name_accountable', 'name_accountable', '`name_accountable`', '`name_accountable`', 3, 50, -1, FALSE, '`name_accountable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->name_accountable->Sortable = TRUE; // Allow sort
		$this->name_accountable->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->name_accountable->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->name_accountable->Lookup = new Lookup('name_accountable', 'tbl_accountable_name', TRUE, 'name_id', ["concat_name","","",""], [], [], [], [], [], [], 'CONCAT(COALESCE(`last_name`,\'\'),\' \',COALESCE(`first_name`,\'\'),\' \',COALESCE(`mid_name`,\'\'),\' \',COALESCE(`ext_name`,\'\')) ASC', '');
				break;
			default:
				$this->name_accountable->Lookup = new Lookup('name_accountable', 'tbl_accountable_name', TRUE, 'name_id', ["concat_name","","",""], [], [], [], [], [], [], 'CONCAT(COALESCE(`last_name`,\'\'),\' \',COALESCE(`first_name`,\'\'),\' \',COALESCE(`mid_name`,\'\'),\' \',COALESCE(`ext_name`,\'\')) ASC', '');
				break;
		}
		$this->name_accountable->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->name_accountable->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->name_accountable->SourceTableVar = 'item_per_employee';
		$this->fields['name_accountable'] = &$this->name_accountable;

		// last_name
		$this->last_name = new ReportField('per_employee2', 'per_employee2', 'x_last_name', 'last_name', '`last_name`', '`last_name`', 200, 100, -1, FALSE, '`last_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->last_name->Sortable = TRUE; // Allow sort
		$this->last_name->SourceTableVar = 'item_per_employee';
		$this->fields['last_name'] = &$this->last_name;

		// first_name
		$this->first_name = new ReportField('per_employee2', 'per_employee2', 'x_first_name', 'first_name', '`first_name`', '`first_name`', 200, 100, -1, FALSE, '`first_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->first_name->Sortable = TRUE; // Allow sort
		$this->first_name->SourceTableVar = 'item_per_employee';
		$this->fields['first_name'] = &$this->first_name;

		// mid_name
		$this->mid_name = new ReportField('per_employee2', 'per_employee2', 'x_mid_name', 'mid_name', '`mid_name`', '`mid_name`', 200, 100, -1, FALSE, '`mid_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->mid_name->Sortable = TRUE; // Allow sort
		$this->mid_name->SourceTableVar = 'item_per_employee';
		$this->fields['mid_name'] = &$this->mid_name;

		// ext_name
		$this->ext_name = new ReportField('per_employee2', 'per_employee2', 'x_ext_name', 'ext_name', '`ext_name`', '`ext_name`', 200, 100, -1, FALSE, '`ext_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ext_name->Sortable = TRUE; // Allow sort
		$this->ext_name->SourceTableVar = 'item_per_employee';
		$this->fields['ext_name'] = &$this->ext_name;

		// namefull
		$this->namefull = new ReportField('per_employee2', 'per_employee2', 'x_namefull', 'namefull', '`namefull`', '`namefull`', 201, 403, -1, FALSE, '`namefull`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->namefull->Sortable = TRUE; // Allow sort
		$this->namefull->SourceTableVar = 'item_per_employee';
		$this->fields['namefull'] = &$this->namefull;

		// status
		$this->status = new ReportField('per_employee2', 'per_employee2', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->SourceTableVar = 'item_per_employee';
		$this->fields['status'] = &$this->status;

		// month_dsc
		$this->month_dsc = new ReportField('per_employee2', 'per_employee2', 'x_month_dsc', 'month_dsc', '`month_dsc`', '`month_dsc`', 200, 50, -1, FALSE, '`month_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->month_dsc->Nullable = FALSE; // NOT NULL field
		$this->month_dsc->Required = TRUE; // Required field
		$this->month_dsc->Sortable = TRUE; // Allow sort
		$this->month_dsc->SourceTableVar = 'item_per_employee';
		$this->fields['month_dsc'] = &$this->month_dsc;

		// full_name_tbl
		$this->full_name_tbl = new ReportField('per_employee2', 'per_employee2', 'x_full_name_tbl', 'full_name_tbl', '`full_name_tbl`', '`full_name_tbl`', 200, 50, -1, FALSE, '`full_name_tbl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->full_name_tbl->Sortable = TRUE; // Allow sort
		$this->full_name_tbl->SourceTableVar = 'item_per_employee';
		$this->fields['full_name_tbl'] = &$this->full_name_tbl;

		// position
		$this->position = new ReportField('per_employee2', 'per_employee2', 'x_position', 'position', '`position`', '`position`', 200, 50, -1, FALSE, '`position`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->position->Sortable = TRUE; // Allow sort
		$this->position->SourceTableVar = 'item_per_employee';
		$this->fields['position'] = &$this->position;

		// NameSig
		$this->NameSig = new ReportField('per_employee2', 'per_employee2', 'x_NameSig', 'NameSig', '`NameSig`', '`NameSig`', 200, 100, -1, FALSE, '`NameSig`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NameSig->Sortable = TRUE; // Allow sort
		$this->NameSig->SourceTableVar = 'item_per_employee';
		$this->fields['NameSig'] = &$this->NameSig;

		// DesignationSig
		$this->DesignationSig = new ReportField('per_employee2', 'per_employee2', 'x_DesignationSig', 'DesignationSig', '`DesignationSig`', '`DesignationSig`', 200, 100, -1, FALSE, '`DesignationSig`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DesignationSig->Sortable = TRUE; // Allow sort
		$this->DesignationSig->SourceTableVar = 'item_per_employee';
		$this->fields['DesignationSig'] = &$this->DesignationSig;
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
		$firstGroupField = &$this->cat_desc;
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
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT COUNT(*) AS `cnt_inventory_id` FROM " . $this->getSqlFrom();
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
		$this->name_accountable->ViewValue = GetDropDownDisplayValue($this->name_accountable->CurrentValue, "", 0);
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`item_per_employee`";
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
		$select = "*, concat(last_name,' ',first_name,' ',mid_name,' ',ext_name) AS `namefull`";
		$groupField = &$this->cat_desc;
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`year_dsc` ASC";
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