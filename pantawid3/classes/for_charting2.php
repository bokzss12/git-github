<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for for_charting2
 */
class for_charting2 extends ReportTable
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
	public $status_desc;
	public $off_desc;
	public $item_id;
	public $month;
	public $Year;
	public $item_date_receive;
	public $item_date_repaired;
	public $item_date_pullout;
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
	public $cat_desc;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'for_charting2';
		$this->TableName = 'for_charting2';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`for_charting`";
		$this->ReportSourceTable = 'for_charting'; // Report source table
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

		// status_desc
		$this->status_desc = new ReportField('for_charting2', 'for_charting2', 'x_status_desc', 'status_desc', '`status_desc`', '`status_desc`', 200, 100, -1, FALSE, '`status_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_desc->Required = TRUE; // Required field
		$this->status_desc->Sortable = TRUE; // Allow sort
		$this->status_desc->SourceTableVar = 'for_charting';
		$this->fields['status_desc'] = &$this->status_desc;

		// off_desc
		$this->off_desc = new ReportField('for_charting2', 'for_charting2', 'x_off_desc', 'off_desc', '`off_desc`', '`off_desc`', 200, 50, -1, FALSE, '`off_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off_desc->Required = TRUE; // Required field
		$this->off_desc->Sortable = TRUE; // Allow sort
		$this->off_desc->SourceTableVar = 'for_charting';
		$this->fields['off_desc'] = &$this->off_desc;

		// item_id
		$this->item_id = new ReportField('for_charting2', 'for_charting2', 'x_item_id', 'item_id', '`item_id`', '`item_id`', 3, 11, -1, FALSE, '`item_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', '');
		$this->item_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->item_id->IsPrimaryKey = TRUE; // Primary key field
		$this->item_id->Sortable = TRUE; // Allow sort
		$this->item_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->item_id->SourceTableVar = 'for_charting';
		$this->fields['item_id'] = &$this->item_id;

		// month
		$this->month = new ReportField('for_charting2', 'for_charting2', 'x_month', 'month', '`month`', '`month`', 3, 11, -1, FALSE, '`month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->month->Sortable = TRUE; // Allow sort
		$this->month->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->month->SourceTableVar = 'for_charting';
		$this->fields['month'] = &$this->month;

		// Year
		$this->Year = new ReportField('for_charting2', 'for_charting2', 'x_Year', 'Year', '`Year`', '`Year`', 3, 11, -1, FALSE, '`Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Year->Sortable = TRUE; // Allow sort
		$this->Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->Year->SourceTableVar = 'for_charting';
		$this->fields['Year'] = &$this->Year;

		// item_date_receive
		$this->item_date_receive = new ReportField('for_charting2', 'for_charting2', 'x_item_date_receive', 'item_date_receive', '`item_date_receive`', CastDateFieldForLike("`item_date_receive`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_receive`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_receive->Sortable = TRUE; // Allow sort
		$this->item_date_receive->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->item_date_receive->SourceTableVar = 'for_charting';
		$this->fields['item_date_receive'] = &$this->item_date_receive;

		// item_date_repaired
		$this->item_date_repaired = new ReportField('for_charting2', 'for_charting2', 'x_item_date_repaired', 'item_date_repaired', '`item_date_repaired`', CastDateFieldForLike("`item_date_repaired`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_repaired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_repaired->Sortable = TRUE; // Allow sort
		$this->item_date_repaired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->item_date_repaired->SourceTableVar = 'for_charting';
		$this->fields['item_date_repaired'] = &$this->item_date_repaired;

		// item_date_pullout
		$this->item_date_pullout = new ReportField('for_charting2', 'for_charting2', 'x_item_date_pullout', 'item_date_pullout', '`item_date_pullout`', CastDateFieldForLike("`item_date_pullout`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_pullout`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_pullout->Sortable = TRUE; // Allow sort
		$this->item_date_pullout->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->item_date_pullout->SourceTableVar = 'for_charting';
		$this->fields['item_date_pullout'] = &$this->item_date_pullout;

		// position
		$this->position = new ReportField('for_charting2', 'for_charting2', 'x_position', 'position', '`position`', '`position`', 200, 100, -1, FALSE, '`position`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->position->Sortable = TRUE; // Allow sort
		$this->position->SourceTableVar = 'for_charting';
		$this->fields['position'] = &$this->position;

		// item_transmittal
		$this->item_transmittal = new ReportField('for_charting2', 'for_charting2', 'x_item_transmittal', 'item_transmittal', '`item_transmittal`', '`item_transmittal`', 200, 100, -1, FALSE, '`item_transmittal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_transmittal->Sortable = TRUE; // Allow sort
		$this->item_transmittal->SourceTableVar = 'for_charting';
		$this->fields['item_transmittal'] = &$this->item_transmittal;

		// item_model
		$this->item_model = new ReportField('for_charting2', 'for_charting2', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 255, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->item_model->SourceTableVar = 'for_charting';
		$this->fields['item_model'] = &$this->item_model;

		// item_serno
		$this->item_serno = new ReportField('for_charting2', 'for_charting2', 'x_item_serno', 'item_serno', '`item_serno`', '`item_serno`', 200, 255, -1, FALSE, '`item_serno`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serno->Sortable = TRUE; // Allow sort
		$this->item_serno->SourceTableVar = 'for_charting';
		$this->fields['item_serno'] = &$this->item_serno;

		// item_type_problem
		$this->item_type_problem = new ReportField('for_charting2', 'for_charting2', 'x_item_type_problem', 'item_type_problem', '`item_type_problem`', '`item_type_problem`', 201, 500, -1, FALSE, '`item_type_problem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_type_problem->Sortable = TRUE; // Allow sort
		$this->item_type_problem->SourceTableVar = 'for_charting';
		$this->fields['item_type_problem'] = &$this->item_type_problem;

		// item_action_taken
		$this->item_action_taken = new ReportField('for_charting2', 'for_charting2', 'x_item_action_taken', 'item_action_taken', '`item_action_taken`', '`item_action_taken`', 201, 500, -1, FALSE, '`item_action_taken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_action_taken->Sortable = TRUE; // Allow sort
		$this->item_action_taken->SourceTableVar = 'for_charting';
		$this->fields['item_action_taken'] = &$this->item_action_taken;

		// Request
		$this->__Request = new ReportField('for_charting2', 'for_charting2', 'x___Request', 'Request', '`Request`', '`Request`', 3, 11, -1, FALSE, '`Request`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->__Request->Sortable = TRUE; // Allow sort
		$this->__Request->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->__Request->SourceTableVar = 'for_charting';
		$this->fields['Request'] = &$this->__Request;

		// remarks
		$this->remarks = new ReportField('for_charting2', 'for_charting2', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->remarks->SourceTableVar = 'for_charting';
		$this->fields['remarks'] = &$this->remarks;

		// employeeid
		$this->employeeid = new ReportField('for_charting2', 'for_charting2', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->employeeid->SourceTableVar = 'for_charting';
		$this->fields['employeeid'] = &$this->employeeid;

		// region_name
		$this->region_name = new ReportField('for_charting2', 'for_charting2', 'x_region_name', 'region_name', '`region_name`', '`region_name`', 200, 60, -1, FALSE, '`region_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->region_name->Sortable = TRUE; // Allow sort
		$this->region_name->SourceTableVar = 'for_charting';
		$this->fields['region_name'] = &$this->region_name;

		// prov_name
		$this->prov_name = new ReportField('for_charting2', 'for_charting2', 'x_prov_name', 'prov_name', '`prov_name`', '`prov_name`', 200, 60, -1, FALSE, '`prov_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->prov_name->Sortable = TRUE; // Allow sort
		$this->prov_name->SourceTableVar = 'for_charting';
		$this->fields['prov_name'] = &$this->prov_name;

		// city_name
		$this->city_name = new ReportField('for_charting2', 'for_charting2', 'x_city_name', 'city_name', '`city_name`', '`city_name`', 200, 100, -1, FALSE, '`city_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city_name->Sortable = TRUE; // Allow sort
		$this->city_name->SourceTableVar = 'for_charting';
		$this->fields['city_name'] = &$this->city_name;

		// technician_dsc
		$this->technician_dsc = new ReportField('for_charting2', 'for_charting2', 'x_technician_dsc', 'technician_dsc', '`technician_dsc`', '`technician_dsc`', 200, 50, -1, FALSE, '`technician_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->technician_dsc->Sortable = TRUE; // Allow sort
		$this->technician_dsc->SourceTableVar = 'for_charting';
		$this->fields['technician_dsc'] = &$this->technician_dsc;

		// cat_desc
		$this->cat_desc = new ReportField('for_charting2', 'for_charting2', 'x_cat_desc', 'cat_desc', '`cat_desc`', '`cat_desc`', 200, 50, -1, FALSE, '`cat_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cat_desc->Required = TRUE; // Required field
		$this->cat_desc->Sortable = TRUE; // Allow sort
		$this->cat_desc->SourceTableVar = 'for_charting';
		$this->fields['cat_desc'] = &$this->cat_desc;

		// Chart1
		$this->Chart1 = new DbChart($this, 'Chart1', 'Chart1', 'status_desc', 'item_id', 1001, '', 0, 'COUNT', 550, 440);
		$this->Chart1->SortType = 1;
		$this->Chart1->SortSequence = "";
		$this->Chart1->SqlSelect = "SELECT `status_desc`, '', COUNT(`item_id`) FROM ";
		$this->Chart1->SqlGroupBy = "`status_desc`";
		$this->Chart1->SqlOrderBy = "`status_desc` ASC";
		$this->Chart1->SeriesDateType = "";
		$this->Chart1->ID = "for_charting2_Chart1"; // Chart ID
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
		$this->Chart1->setParameters([["options.legend.display",true],["options.legend.fullWidth",true],["options.legend.reverse",true],["options.legend.labels.boxWidth",0],["options.legend.labels.fontSize",0],["options.legend.labels.fontColor","FFC0CB"],["options.legend.labels.padding",0],["options.legend.labels.usePointStyle",true],["options.title.display",true],["options.tooltips.enabled",true],["options.tooltips.mode","point"],["options.tooltips.intersect",true],["options.tooltips.displayColors",true],["options.plugins.filler.propagate",true],["options.animation.animateRotate",true],["options.animation.animateScale",true],["dataset.showLine",true],["dataset.spanGaps",true],["dataset.steppedLine",true],["scale.gridLines.offsetGridLines",true]]);
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];
		$this->Chart1->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];

		// Chart2
		$this->Chart2 = new DbChart($this, 'Chart2', 'Chart2', 'prov_name', 'item_id', 1002, '', 0, 'COUNT', 550, 440);
		$this->Chart2->SortType = 1;
		$this->Chart2->SortSequence = "";
		$this->Chart2->SqlSelect = "SELECT `prov_name`, '', COUNT(`item_id`) FROM ";
		$this->Chart2->SqlGroupBy = "`prov_name`";
		$this->Chart2->SqlOrderBy = "`prov_name` ASC";
		$this->Chart2->SeriesDateType = "";
		$this->Chart2->ID = "for_charting2_Chart2"; // Chart ID
		$this->Chart2->setParameters([
			["type", "1002"],
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
		$this->Chart3 = new DbChart($this, 'Chart3', 'Chart3', 'off_desc', 'item_id', 1006, '', 0, 'COUNT', 550, 440);
		$this->Chart3->SortType = 1;
		$this->Chart3->SortSequence = "";
		$this->Chart3->SqlSelect = "SELECT `off_desc`, '', COUNT(`item_id`) FROM ";
		$this->Chart3->SqlGroupBy = "`off_desc`";
		$this->Chart3->SqlOrderBy = "`off_desc` ASC";
		$this->Chart3->SeriesDateType = "";
		$this->Chart3->ID = "for_charting2_Chart3"; // Chart ID
		$this->Chart3->setParameters([
			["type", "1006"],
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
		$this->Chart3->Trends[] = [0, 0, "FF0000", "", 1, "0", "1", 100, "", "0", "0", 0, 0, ""];

		// Chart4
		$this->Chart4 = new DbChart($this, 'Chart4', 'Chart4', 'cat_desc', 'item_id', 1001, '', 0, 'COUNT', 550, 440);
		$this->Chart4->SortType = 1;
		$this->Chart4->SortSequence = "";
		$this->Chart4->SqlSelect = "SELECT `cat_desc`, '', COUNT(`item_id`) FROM ";
		$this->Chart4->SqlGroupBy = "`cat_desc`";
		$this->Chart4->SqlOrderBy = "`cat_desc` ASC";
		$this->Chart4->SeriesDateType = "";
		$this->Chart4->ID = "for_charting2_Chart4"; // Chart ID
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
		global $DashboardReport;
		return "";
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