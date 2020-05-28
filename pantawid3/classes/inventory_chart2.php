<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for inventory_chart2
 */
class inventory_chart2 extends ReportTable
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
	public $ShowCompactSummaryFooter = FALSE;

	// Export
	public $ExportDoc;
	public $Chart1;
	public $Chart2;
	public $Chart3;
	public $Chart4;

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
		$this->TableVar = 'inventory_chart2';
		$this->TableName = 'inventory_chart2';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`inventory_chart`";
		$this->ReportSourceTable = 'inventory_chart'; // Report source table
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
		$this->inventory_id = new ReportField('inventory_chart2', 'inventory_chart2', 'x_inventory_id', 'inventory_id', '`inventory_id`', '`inventory_id`', 3, 11, -1, FALSE, '`inventory_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', '');
		$this->inventory_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->inventory_id->IsPrimaryKey = TRUE; // Primary key field
		$this->inventory_id->Sortable = TRUE; // Allow sort
		$this->inventory_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->inventory_id->SourceTableVar = 'inventory_chart';
		$this->fields['inventory_id'] = &$this->inventory_id;

		// month_dsc
		$this->month_dsc = new ReportField('inventory_chart2', 'inventory_chart2', 'x_month_dsc', 'month_dsc', '`month_dsc`', '`month_dsc`', 200, 50, -1, FALSE, '`month_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->month_dsc->Required = TRUE; // Required field
		$this->month_dsc->Sortable = TRUE; // Allow sort
		$this->month_dsc->SourceTableVar = 'inventory_chart';
		$this->fields['month_dsc'] = &$this->month_dsc;

		// year_dsc
		$this->year_dsc = new ReportField('inventory_chart2', 'inventory_chart2', 'x_year_dsc', 'year_dsc', '`year_dsc`', '`year_dsc`', 200, 50, -1, FALSE, '`year_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->year_dsc->Required = TRUE; // Required field
		$this->year_dsc->Sortable = TRUE; // Allow sort
		$this->year_dsc->SourceTableVar = 'inventory_chart';
		$this->fields['year_dsc'] = &$this->year_dsc;

		// cat_desc
		$this->cat_desc = new ReportField('inventory_chart2', 'inventory_chart2', 'x_cat_desc', 'cat_desc', '`cat_desc`', '`cat_desc`', 200, 50, -1, FALSE, '`cat_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cat_desc->Required = TRUE; // Required field
		$this->cat_desc->Sortable = TRUE; // Allow sort
		$this->cat_desc->SourceTableVar = 'inventory_chart';
		$this->fields['cat_desc'] = &$this->cat_desc;

		// item_model
		$this->item_model = new ReportField('inventory_chart2', 'inventory_chart2', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 50, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->item_model->SourceTableVar = 'inventory_chart';
		$this->fields['item_model'] = &$this->item_model;

		// item_serial
		$this->item_serial = new ReportField('inventory_chart2', 'inventory_chart2', 'x_item_serial', 'item_serial', '`item_serial`', '`item_serial`', 200, 50, -1, FALSE, '`item_serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serial->Sortable = TRUE; // Allow sort
		$this->item_serial->SourceTableVar = 'inventory_chart';
		$this->fields['item_serial'] = &$this->item_serial;

		// off_desc
		$this->off_desc = new ReportField('inventory_chart2', 'inventory_chart2', 'x_off_desc', 'off_desc', '`off_desc`', '`off_desc`', 200, 50, -1, FALSE, '`off_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off_desc->Required = TRUE; // Required field
		$this->off_desc->Sortable = TRUE; // Allow sort
		$this->off_desc->SourceTableVar = 'inventory_chart';
		$this->fields['off_desc'] = &$this->off_desc;

		// region_name
		$this->region_name = new ReportField('inventory_chart2', 'inventory_chart2', 'x_region_name', 'region_name', '`region_name`', '`region_name`', 200, 60, -1, FALSE, '`region_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->region_name->Required = TRUE; // Required field
		$this->region_name->Sortable = TRUE; // Allow sort
		$this->region_name->SourceTableVar = 'inventory_chart';
		$this->fields['region_name'] = &$this->region_name;

		// prov_name
		$this->prov_name = new ReportField('inventory_chart2', 'inventory_chart2', 'x_prov_name', 'prov_name', '`prov_name`', '`prov_name`', 200, 60, -1, FALSE, '`prov_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->prov_name->Required = TRUE; // Required field
		$this->prov_name->Sortable = TRUE; // Allow sort
		$this->prov_name->SourceTableVar = 'inventory_chart';
		$this->fields['prov_name'] = &$this->prov_name;

		// city_name
		$this->city_name = new ReportField('inventory_chart2', 'inventory_chart2', 'x_city_name', 'city_name', '`city_name`', '`city_name`', 200, 100, -1, FALSE, '`city_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city_name->Required = TRUE; // Required field
		$this->city_name->Sortable = TRUE; // Allow sort
		$this->city_name->SourceTableVar = 'inventory_chart';
		$this->fields['city_name'] = &$this->city_name;

		// name_accountable
		$this->name_accountable = new ReportField('inventory_chart2', 'inventory_chart2', 'x_name_accountable', 'name_accountable', '`name_accountable`', '`name_accountable`', 3, 50, -1, FALSE, '`name_accountable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->name_accountable->Sortable = TRUE; // Allow sort
		$this->name_accountable->SourceTableVar = 'inventory_chart';
		$this->fields['name_accountable'] = &$this->name_accountable;

		// Designation
		$this->Designation = new ReportField('inventory_chart2', 'inventory_chart2', 'x_Designation', 'Designation', '`Designation`', '`Designation`', 3, 50, -1, FALSE, '`Designation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Designation->Sortable = TRUE; // Allow sort
		$this->Designation->SourceTableVar = 'inventory_chart';
		$this->fields['Designation'] = &$this->Designation;

		// inventory_status_dsc
		$this->inventory_status_dsc = new ReportField('inventory_chart2', 'inventory_chart2', 'x_inventory_status_dsc', 'inventory_status_dsc', '`inventory_status_dsc`', '`inventory_status_dsc`', 200, 50, -1, FALSE, '`inventory_status_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inventory_status_dsc->Required = TRUE; // Required field
		$this->inventory_status_dsc->Sortable = TRUE; // Allow sort
		$this->inventory_status_dsc->SourceTableVar = 'inventory_chart';
		$this->fields['inventory_status_dsc'] = &$this->inventory_status_dsc;

		// Chart1
		$this->Chart1 = new DbChart($this, 'Chart1', 'Chart1', 'cat_desc', 'inventory_id', 1001, '', 0, 'COUNT', 550, 440);
		$this->Chart1->SortType = 1;
		$this->Chart1->SortSequence = "";
		$this->Chart1->SqlSelect = "SELECT `cat_desc`, '', COUNT(`inventory_id`) FROM ";
		$this->Chart1->SqlGroupBy = "`cat_desc`";
		$this->Chart1->SqlOrderBy = "`cat_desc` ASC";
		$this->Chart1->SeriesDateType = "";
		$this->Chart1->ID = "inventory_chart2_Chart1"; // Chart ID
		$this->Chart1->setParameters([
			["type", "1001"],
			["seriestype", "0"]
		]); // Chart type / Chart series type
		$this->Chart1->setParameter("bgcolor", "FCFCFC"); // Background color
		$this->Chart1->setParameters([
			["caption", $this->Chart1->caption()],
			["xaxisname", $this->Chart1->xAxisName()]
		]); // Chart caption / X axis name
		$this->Chart1->setParameter("yaxisname", $this->Chart1->yAxisName()); // Y axis name
		$this->Chart1->setParameters([
			["shownames", "1"],
			["showvalues", "1"],
			["showhovercap", "0"]
		]); // Show names / Show values / Show hover
		$this->Chart1->setParameter("alpha", "50"); // Chart alpha
		$this->Chart1->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
		$this->Chart1->setParameters([["options.legend.display",true],["options.legend.fullWidth",true],["options.legend.reverse",true],["options.legend.labels.usePointStyle",true],["options.title.display",true],["options.tooltips.enabled",true],["options.tooltips.intersect",true],["options.tooltips.displayColors",true],["options.plugins.filler.propagate",true],["options.animation.animateRotate",true],["options.animation.animateScale",true],["dataset.showLine",true],["dataset.spanGaps",true],["dataset.steppedLine",true],["scale.gridLines.offsetGridLines",true]]);
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];

		// Chart2
		$this->Chart2 = new DbChart($this, 'Chart2', 'Chart2', 'inventory_status_dsc', 'inventory_id', 1001, '', 0, 'COUNT', 550, 440);
		$this->Chart2->SortType = 1;
		$this->Chart2->SortSequence = "";
		$this->Chart2->SqlSelect = "SELECT `inventory_status_dsc`, '', COUNT(`inventory_id`) FROM ";
		$this->Chart2->SqlGroupBy = "`inventory_status_dsc`";
		$this->Chart2->SqlOrderBy = "`inventory_status_dsc` ASC";
		$this->Chart2->SeriesDateType = "";
		$this->Chart2->ID = "inventory_chart2_Chart2"; // Chart ID
		$this->Chart2->setParameters([
			["type", "1001"],
			["seriestype", "0"]
		]); // Chart type / Chart series type
		$this->Chart2->setParameter("bgcolor", "FCFCFC"); // Background color
		$this->Chart2->setParameters([
			["caption", $this->Chart2->caption()],
			["xaxisname", $this->Chart2->xAxisName()]
		]); // Chart caption / X axis name
		$this->Chart2->setParameter("yaxisname", $this->Chart2->yAxisName()); // Y axis name
		$this->Chart2->setParameters([
			["shownames", "1"],
			["showvalues", "1"],
			["showhovercap", "0"]
		]); // Show names / Show values / Show hover
		$this->Chart2->setParameter("alpha", "50"); // Chart alpha
		$this->Chart2->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
		$this->Chart2->setParameters([["options.legend.display",true],["options.legend.fullWidth",true],["options.legend.reverse",true],["options.legend.labels.usePointStyle",true],["options.title.display",true],["options.tooltips.enabled",true],["options.tooltips.intersect",true],["options.tooltips.displayColors",true],["options.plugins.filler.propagate",true],["options.animation.animateRotate",true],["options.animation.animateScale",true],["dataset.showLine",true],["dataset.spanGaps",true],["dataset.steppedLine",true],["scale.gridLines.offsetGridLines",true]]);
		$this->Chart2->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart2->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart2->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart2->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];

		// Chart3
		$this->Chart3 = new DbChart($this, 'Chart3', 'Chart3', 'prov_name', 'inventory_id', 1001, '', 0, 'COUNT', 550, 440);
		$this->Chart3->SortType = 1;
		$this->Chart3->SortSequence = "";
		$this->Chart3->SqlSelect = "SELECT `prov_name`, '', COUNT(`inventory_id`) FROM ";
		$this->Chart3->SqlGroupBy = "`prov_name`";
		$this->Chart3->SqlOrderBy = "`prov_name` ASC";
		$this->Chart3->SeriesDateType = "";
		$this->Chart3->ID = "inventory_chart2_Chart3"; // Chart ID
		$this->Chart3->setParameters([
			["type", "1001"],
			["seriestype", "0"]
		]); // Chart type / Chart series type
		$this->Chart3->setParameter("bgcolor", "FCFCFC"); // Background color
		$this->Chart3->setParameters([
			["caption", $this->Chart3->caption()],
			["xaxisname", $this->Chart3->xAxisName()]
		]); // Chart caption / X axis name
		$this->Chart3->setParameter("yaxisname", $this->Chart3->yAxisName()); // Y axis name
		$this->Chart3->setParameters([
			["shownames", "1"],
			["showvalues", "1"],
			["showhovercap", "0"]
		]); // Show names / Show values / Show hover
		$this->Chart3->setParameter("alpha", "50"); // Chart alpha
		$this->Chart3->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
		$this->Chart3->setParameters([["options.legend.display",true],["options.legend.fullWidth",true],["options.legend.reverse",true],["options.legend.labels.usePointStyle",true],["options.title.display",true],["options.tooltips.enabled",true],["options.tooltips.intersect",true],["options.tooltips.displayColors",true],["options.plugins.filler.propagate",true],["options.animation.animateRotate",true],["options.animation.animateScale",true],["dataset.showLine",true],["dataset.spanGaps",true],["dataset.steppedLine",true],["scale.gridLines.offsetGridLines",true]]);
		$this->Chart3->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart3->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart3->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];

		// Chart4
		$this->Chart4 = new DbChart($this, 'Chart4', 'Chart4', 'off_desc', 'inventory_id', 1001, '', 0, 'COUNT', 550, 440);
		$this->Chart4->SortType = 1;
		$this->Chart4->SortSequence = "";
		$this->Chart4->SqlSelect = "SELECT `off_desc`, '', COUNT(`inventory_id`) FROM ";
		$this->Chart4->SqlGroupBy = "`off_desc`";
		$this->Chart4->SqlOrderBy = "`off_desc` ASC";
		$this->Chart4->SeriesDateType = "";
		$this->Chart4->ID = "inventory_chart2_Chart4"; // Chart ID
		$this->Chart4->setParameters([
			["type", "1001"],
			["seriestype", "0"]
		]); // Chart type / Chart series type
		$this->Chart4->setParameter("bgcolor", "FCFCFC"); // Background color
		$this->Chart4->setParameters([
			["caption", $this->Chart4->caption()],
			["xaxisname", $this->Chart4->xAxisName()]
		]); // Chart caption / X axis name
		$this->Chart4->setParameter("yaxisname", $this->Chart4->yAxisName()); // Y axis name
		$this->Chart4->setParameters([
			["shownames", "1"],
			["showvalues", "1"],
			["showhovercap", "0"]
		]); // Show names / Show values / Show hover
		$this->Chart4->setParameter("alpha", "50"); // Chart alpha
		$this->Chart4->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
		$this->Chart4->setParameters([["options.legend.display",true],["options.legend.fullWidth",true],["options.legend.reverse",true],["options.legend.labels.usePointStyle",true],["options.title.display",true],["options.tooltips.enabled",true],["options.tooltips.intersect",true],["options.tooltips.displayColors",true],["options.plugins.filler.propagate",true],["options.animation.animateRotate",true],["options.animation.animateScale",true],["dataset.showLine",true],["dataset.spanGaps",true],["dataset.steppedLine",true],["scale.gridLines.offsetGridLines",true]]);
		$this->Chart4->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart4->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart4->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart4->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Multiple column sort
	protected function updateSort(&$fld, $ctrl)
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
			if ($fld->GroupingFieldId == 0) {
				if ($ctrl) {
					$orderBy = $this->getDetailOrderBy();
					if (strpos($orderBy, $sortField . " " . $lastSort) !== FALSE) {
						$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
					} else {
						if ($orderBy != "") $orderBy .= ", ";
						$orderBy .= $sortField . " " . $thisSort;
					}
					$this->setDetailOrderBy($orderBy); // Save to Session
				} else {
					$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
				}
			}
		} else {
			if ($fld->GroupingFieldId == 0 && !$ctrl) $fld->setSort("");
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

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT * FROM " . $this->getSqlFrom();
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
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
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