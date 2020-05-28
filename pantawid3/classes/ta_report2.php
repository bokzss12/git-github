<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for ta_report2
 */
class ta_report2 extends DbTable
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
	public $month;
	public $Year;
	public $item_date_receive;
	public $item_date_repaired;
	public $Concat;
	public $item_transmittal;
	public $position;
	public $off_desc;
	public $off_desc1;
	public $model;
	public $cat_desc;
	public $item_model;
	public $item_serno;
	public $item_type_problem;
	public $item_action_taken;
	public $technician_name;
	public $Date_Finished;
	public $employeeid;
	public $status_desc;
	public $Name_dsc;
	public $remarks;
	public $item_date_pullout;
	public $Region;
	public $Province;
	public $Cities;
	public $__Request;
	public $user_last_modify;
	public $date_last_modify;
	public $SRN;
	public $Contact_no;
	public $item_id;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ta_report2';
		$this->TableName = 'ta_report2';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`ta_report2`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "landscape"; // Page orientation (PDF only)
		$this->ExportPageSize = "legal"; // Page size (PDF only)
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

		// month
		$this->month = new DbField('ta_report2', 'ta_report2', 'x_month', 'month', '`month`', '`month`', 3, 11, -1, FALSE, '`month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->month->Sortable = FALSE; // Allow sort
		$this->month->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->month->Lookup = new Lookup('month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->month->Lookup = new Lookup('month', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['month'] = &$this->month;

		// Year
		$this->Year = new DbField('ta_report2', 'ta_report2', 'x_Year', 'Year', '`Year`', '`Year`', 3, 11, -1, FALSE, '`Year`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Year->Sortable = FALSE; // Allow sort
		$this->Year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Year'] = &$this->Year;

		// item_date_receive
		$this->item_date_receive = new DbField('ta_report2', 'ta_report2', 'x_item_date_receive', 'item_date_receive', '`item_date_receive`', CastDateFieldForLike("`item_date_receive`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_receive`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_receive->Required = TRUE; // Required field
		$this->item_date_receive->Sortable = TRUE; // Allow sort
		$this->item_date_receive->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->item_date_receive->AdvancedSearch->SearchValueDefault = date("m/01/y");
		$this->item_date_receive->AdvancedSearch->SearchValue2Default = date("m/01/y");
		$this->item_date_receive->AdvancedSearch->SearchOperatorDefault = "BETWEEN";
		$this->item_date_receive->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->item_date_receive->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['item_date_receive'] = &$this->item_date_receive;

		// item_date_repaired
		$this->item_date_repaired = new DbField('ta_report2', 'ta_report2', 'x_item_date_repaired', 'item_date_repaired', '`item_date_repaired`', CastDateFieldForLike("`item_date_repaired`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_repaired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_repaired->Sortable = TRUE; // Allow sort
		$this->item_date_repaired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['item_date_repaired'] = &$this->item_date_repaired;

		// Concat
		$this->Concat = new DbField('ta_report2', 'ta_report2', 'x_Concat', 'Concat', 'CONCAT_WS(\' \',\'Requested:\',item_transmittal,\'Position:\',position,\'Original Location:\',off_desc,\'Current Location:\',off_desc1)', 'CONCAT_WS(\' \',\'Requested:\',item_transmittal,\'Position:\',position,\'Original Location:\',off_desc,\'Current Location:\',off_desc1)', 201, 671, -1, FALSE, 'CONCAT_WS(\' \',\'Requested:\',item_transmittal,\'Position:\',position,\'Original Location:\',off_desc,\'Current Location:\',off_desc1)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Concat->IsCustom = TRUE; // Custom field
		$this->Concat->Sortable = TRUE; // Allow sort
		$this->fields['Concat'] = &$this->Concat;

		// item_transmittal
		$this->item_transmittal = new DbField('ta_report2', 'ta_report2', 'x_item_transmittal', 'item_transmittal', '`item_transmittal`', '`item_transmittal`', 200, 100, -1, FALSE, '`item_transmittal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_transmittal->Sortable = TRUE; // Allow sort
		$this->fields['item_transmittal'] = &$this->item_transmittal;

		// position
		$this->position = new DbField('ta_report2', 'ta_report2', 'x_position', 'position', '`position`', '`position`', 200, 100, -1, FALSE, '`position`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->position->Sortable = TRUE; // Allow sort
		$this->fields['position'] = &$this->position;

		// off_desc
		$this->off_desc = new DbField('ta_report2', 'ta_report2', 'x_off_desc', 'off_desc', '`off_desc`', '`off_desc`', 200, 50, -1, FALSE, '`off_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off_desc->Sortable = TRUE; // Allow sort
		$this->fields['off_desc'] = &$this->off_desc;

		// off_desc1
		$this->off_desc1 = new DbField('ta_report2', 'ta_report2', 'x_off_desc1', 'off_desc1', '`off_desc1`', '`off_desc1`', 200, 50, -1, FALSE, '`off_desc1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off_desc1->Sortable = TRUE; // Allow sort
		$this->fields['off_desc1'] = &$this->off_desc1;

		// model
		$this->model = new DbField('ta_report2', 'ta_report2', 'x_model', 'model', 'CONCAT_WS(\' \',\'Type:\',cat_desc,\'Model no:\',item_model,\'Serial no:\',item_serno)', 'CONCAT_WS(\' \',\'Type:\',cat_desc,\'Model no:\',item_model,\'Serial no:\',item_serno)', 201, 589, -1, FALSE, 'CONCAT_WS(\' \',\'Type:\',cat_desc,\'Model no:\',item_model,\'Serial no:\',item_serno)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->model->IsCustom = TRUE; // Custom field
		$this->model->Sortable = TRUE; // Allow sort
		$this->fields['model'] = &$this->model;

		// cat_desc
		$this->cat_desc = new DbField('ta_report2', 'ta_report2', 'x_cat_desc', 'cat_desc', '`cat_desc`', '`cat_desc`', 200, 50, -1, FALSE, '`cat_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cat_desc->Sortable = TRUE; // Allow sort
		$this->fields['cat_desc'] = &$this->cat_desc;

		// item_model
		$this->item_model = new DbField('ta_report2', 'ta_report2', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 255, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Required = TRUE; // Required field
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serno
		$this->item_serno = new DbField('ta_report2', 'ta_report2', 'x_item_serno', 'item_serno', '`item_serno`', '`item_serno`', 200, 255, -1, FALSE, '`item_serno`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serno->Sortable = TRUE; // Allow sort
		$this->fields['item_serno'] = &$this->item_serno;

		// item_type_problem
		$this->item_type_problem = new DbField('ta_report2', 'ta_report2', 'x_item_type_problem', 'item_type_problem', '`item_type_problem`', '`item_type_problem`', 201, 500, -1, FALSE, '`item_type_problem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_type_problem->Sortable = TRUE; // Allow sort
		$this->fields['item_type_problem'] = &$this->item_type_problem;

		// item_action_taken
		$this->item_action_taken = new DbField('ta_report2', 'ta_report2', 'x_item_action_taken', 'item_action_taken', '`item_action_taken`', '`item_action_taken`', 201, 500, -1, FALSE, '`item_action_taken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->item_action_taken->Sortable = TRUE; // Allow sort
		$this->fields['item_action_taken'] = &$this->item_action_taken;

		// technician_name
		$this->technician_name = new DbField('ta_report2', 'ta_report2', 'x_technician_name', 'technician_name', '`technician_name`', '`technician_name`', 3, 50, -1, FALSE, '`technician_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->technician_name->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->technician_name->Lookup = new Lookup('technician_name', 'tbl_technician', FALSE, 'technician_id', ["technician_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->technician_name->Lookup = new Lookup('technician_name', 'tbl_technician', FALSE, 'technician_id', ["technician_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->technician_name->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['technician_name'] = &$this->technician_name;

		// Date_Finished
		$this->Date_Finished = new DbField('ta_report2', 'ta_report2', 'x_Date_Finished', 'Date_Finished', '`Date_Finished`', CastDateFieldForLike("`Date_Finished`", 0, "DB"), 133, 10, 0, FALSE, '`Date_Finished`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Date_Finished->Sortable = TRUE; // Allow sort
		$this->Date_Finished->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Date_Finished'] = &$this->Date_Finished;

		// employeeid
		$this->employeeid = new DbField('ta_report2', 'ta_report2', 'x_employeeid', 'employeeid', '`employeeid`', '`employeeid`', 3, 11, -1, FALSE, '`employeeid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employeeid->Sortable = TRUE; // Allow sort
		$this->employeeid->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employeeid->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->employeeid->Lookup = new Lookup('employeeid', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->employeeid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employeeid'] = &$this->employeeid;

		// status_desc
		$this->status_desc = new DbField('ta_report2', 'ta_report2', 'x_status_desc', 'status_desc', '`status_desc`', '`status_desc`', 200, 100, -1, FALSE, '`status_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_desc->Sortable = TRUE; // Allow sort
		$this->status_desc->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_desc->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status_desc->Lookup = new Lookup('status_desc', 'tbl_item_status', FALSE, 'status_id', ["status_desc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->status_desc->Lookup = new Lookup('status_desc', 'tbl_item_status', FALSE, 'status_id', ["status_desc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['status_desc'] = &$this->status_desc;

		// Name_dsc
		$this->Name_dsc = new DbField('ta_report2', 'ta_report2', 'x_Name_dsc', 'Name_dsc', '`Name_dsc`', '`Name_dsc`', 200, 50, -1, FALSE, '`Name_dsc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name_dsc->Sortable = FALSE; // Allow sort
		$this->fields['Name_dsc'] = &$this->Name_dsc;

		// remarks
		$this->remarks = new DbField('ta_report2', 'ta_report2', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->fields['remarks'] = &$this->remarks;

		// item_date_pullout
		$this->item_date_pullout = new DbField('ta_report2', 'ta_report2', 'x_item_date_pullout', 'item_date_pullout', '`item_date_pullout`', CastDateFieldForLike("`item_date_pullout`", 0, "DB"), 133, 10, 0, FALSE, '`item_date_pullout`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_date_pullout->Sortable = TRUE; // Allow sort
		$this->item_date_pullout->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['item_date_pullout'] = &$this->item_date_pullout;

		// Region
		$this->Region = new DbField('ta_report2', 'ta_report2', 'x_Region', 'Region', '`Region`', '`Region`', 3, 11, -1, FALSE, '`Region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Region->Sortable = TRUE; // Allow sort
		$this->Region->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Region'] = &$this->Region;

		// Province
		$this->Province = new DbField('ta_report2', 'ta_report2', 'x_Province', 'Province', '`Province`', '`Province`', 3, 11, -1, FALSE, '`Province`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Province->Sortable = TRUE; // Allow sort
		$this->Province->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Province'] = &$this->Province;

		// Cities
		$this->Cities = new DbField('ta_report2', 'ta_report2', 'x_Cities', 'Cities', '`Cities`', '`Cities`', 3, 11, -1, FALSE, '`Cities`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Cities->Sortable = TRUE; // Allow sort
		$this->Cities->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Cities'] = &$this->Cities;

		// Request
		$this->__Request = new DbField('ta_report2', 'ta_report2', 'x___Request', 'Request', '`Request`', '`Request`', 3, 11, -1, FALSE, '`Request`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->__Request->Sortable = TRUE; // Allow sort
		$this->__Request->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Request'] = &$this->__Request;

		// user_last_modify
		$this->user_last_modify = new DbField('ta_report2', 'ta_report2', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// date_last_modify
		$this->date_last_modify = new DbField('ta_report2', 'ta_report2', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 0, "DB"), 135, 19, 0, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_last_modify->Sortable = TRUE; // Allow sort
		$this->date_last_modify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_last_modify'] = &$this->date_last_modify;

		// SRN
		$this->SRN = new DbField('ta_report2', 'ta_report2', 'x_SRN', 'SRN', '`SRN`', '`SRN`', 200, 255, -1, FALSE, '`SRN`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SRN->Sortable = TRUE; // Allow sort
		$this->fields['SRN'] = &$this->SRN;

		// Contact_no
		$this->Contact_no = new DbField('ta_report2', 'ta_report2', 'x_Contact_no', 'Contact_no', '`Contact_no`', '`Contact_no`', 3, 11, -1, FALSE, '`Contact_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Contact_no->Sortable = TRUE; // Allow sort
		$this->Contact_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Contact_no'] = &$this->Contact_no;

		// item_id
		$this->item_id = new DbField('ta_report2', 'ta_report2', 'x_item_id', 'item_id', '`item_id`', '`item_id`', 3, 11, -1, FALSE, '`item_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->item_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->item_id->IsPrimaryKey = TRUE; // Primary key field
		$this->item_id->Sortable = TRUE; // Allow sort
		$this->item_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['item_id'] = &$this->item_id;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ta_report2`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, CONCAT_WS(' ','Requested:',item_transmittal,'Position:',position,'Original Location:',off_desc,'Current Location:',off_desc1) AS `Concat`, CONCAT_WS(' ','Type:',cat_desc,'Model no:',item_model,'Serial no:',item_serno) AS `model` FROM " . $this->getSqlFrom();
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
			$this->item_id->setDbValue($conn->insert_ID());
			$rs['item_id'] = $this->item_id->DbValue;
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
			if (array_key_exists('item_id', $rs))
				AddFilter($where, QuotedName('item_id', $this->Dbid) . '=' . QuotedValue($rs['item_id'], $this->item_id->DataType, $this->Dbid));
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
		$this->month->DbValue = $row['month'];
		$this->Year->DbValue = $row['Year'];
		$this->item_date_receive->DbValue = $row['item_date_receive'];
		$this->item_date_repaired->DbValue = $row['item_date_repaired'];
		$this->Concat->DbValue = $row['Concat'];
		$this->item_transmittal->DbValue = $row['item_transmittal'];
		$this->position->DbValue = $row['position'];
		$this->off_desc->DbValue = $row['off_desc'];
		$this->off_desc1->DbValue = $row['off_desc1'];
		$this->model->DbValue = $row['model'];
		$this->cat_desc->DbValue = $row['cat_desc'];
		$this->item_model->DbValue = $row['item_model'];
		$this->item_serno->DbValue = $row['item_serno'];
		$this->item_type_problem->DbValue = $row['item_type_problem'];
		$this->item_action_taken->DbValue = $row['item_action_taken'];
		$this->technician_name->DbValue = $row['technician_name'];
		$this->Date_Finished->DbValue = $row['Date_Finished'];
		$this->employeeid->DbValue = $row['employeeid'];
		$this->status_desc->DbValue = $row['status_desc'];
		$this->Name_dsc->DbValue = $row['Name_dsc'];
		$this->remarks->DbValue = $row['remarks'];
		$this->item_date_pullout->DbValue = $row['item_date_pullout'];
		$this->Region->DbValue = $row['Region'];
		$this->Province->DbValue = $row['Province'];
		$this->Cities->DbValue = $row['Cities'];
		$this->__Request->DbValue = $row['Request'];
		$this->user_last_modify->DbValue = $row['user_last_modify'];
		$this->date_last_modify->DbValue = $row['date_last_modify'];
		$this->SRN->DbValue = $row['SRN'];
		$this->Contact_no->DbValue = $row['Contact_no'];
		$this->item_id->DbValue = $row['item_id'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
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
			return "ta_report2list.php";
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
		if ($pageName == "ta_report2view.php")
			return $Language->phrase("View");
		elseif ($pageName == "ta_report2edit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ta_report2add.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ta_report2list.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ta_report2view.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ta_report2view.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ta_report2add.php?" . $this->getUrlParm($parm);
		else
			$url = "ta_report2add.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("ta_report2edit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("ta_report2add.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("ta_report2delete.php", $this->getUrlParm());
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

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->month->setDbValue($rs->fields('month'));
		$this->Year->setDbValue($rs->fields('Year'));
		$this->item_date_receive->setDbValue($rs->fields('item_date_receive'));
		$this->item_date_repaired->setDbValue($rs->fields('item_date_repaired'));
		$this->Concat->setDbValue($rs->fields('Concat'));
		$this->item_transmittal->setDbValue($rs->fields('item_transmittal'));
		$this->position->setDbValue($rs->fields('position'));
		$this->off_desc->setDbValue($rs->fields('off_desc'));
		$this->off_desc1->setDbValue($rs->fields('off_desc1'));
		$this->model->setDbValue($rs->fields('model'));
		$this->cat_desc->setDbValue($rs->fields('cat_desc'));
		$this->item_model->setDbValue($rs->fields('item_model'));
		$this->item_serno->setDbValue($rs->fields('item_serno'));
		$this->item_type_problem->setDbValue($rs->fields('item_type_problem'));
		$this->item_action_taken->setDbValue($rs->fields('item_action_taken'));
		$this->technician_name->setDbValue($rs->fields('technician_name'));
		$this->Date_Finished->setDbValue($rs->fields('Date_Finished'));
		$this->employeeid->setDbValue($rs->fields('employeeid'));
		$this->status_desc->setDbValue($rs->fields('status_desc'));
		$this->Name_dsc->setDbValue($rs->fields('Name_dsc'));
		$this->remarks->setDbValue($rs->fields('remarks'));
		$this->item_date_pullout->setDbValue($rs->fields('item_date_pullout'));
		$this->Region->setDbValue($rs->fields('Region'));
		$this->Province->setDbValue($rs->fields('Province'));
		$this->Cities->setDbValue($rs->fields('Cities'));
		$this->__Request->setDbValue($rs->fields('Request'));
		$this->user_last_modify->setDbValue($rs->fields('user_last_modify'));
		$this->date_last_modify->setDbValue($rs->fields('date_last_modify'));
		$this->SRN->setDbValue($rs->fields('SRN'));
		$this->Contact_no->setDbValue($rs->fields('Contact_no'));
		$this->item_id->setDbValue($rs->fields('item_id'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// month

		$this->month->CellCssStyle = "white-space: nowrap;";

		// Year
		$this->Year->CellCssStyle = "white-space: nowrap;";

		// item_date_receive
		// item_date_repaired
		// Concat
		// item_transmittal
		// position
		// off_desc
		// off_desc1
		// model
		// cat_desc
		// item_model
		// item_serno
		// item_type_problem
		// item_action_taken
		// technician_name
		// Date_Finished
		// employeeid
		// status_desc
		// Name_dsc

		$this->Name_dsc->CellCssStyle = "white-space: nowrap;";

		// remarks
		// item_date_pullout
		// Region
		// Province
		// Cities
		// Request
		// user_last_modify
		// date_last_modify
		// SRN
		// Contact_no
		// item_id
		// month

		$curVal = strval($this->month->CurrentValue);
		if ($curVal != "") {
			$this->month->ViewValue = $this->month->lookupCacheOption($curVal);
			if ($this->month->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`month_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->month->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->month->ViewValue = $this->month->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->month->ViewValue = $this->month->CurrentValue;
				}
			}
		} else {
			$this->month->ViewValue = NULL;
		}
		$this->month->ViewCustomAttributes = "";

		// Year
		$this->Year->ViewValue = $this->Year->CurrentValue;
		$this->Year->ViewValue = FormatNumber($this->Year->ViewValue, 0, -2, -2, -2);
		$this->Year->ViewCustomAttributes = "";

		// item_date_receive
		$this->item_date_receive->ViewValue = $this->item_date_receive->CurrentValue;
		$this->item_date_receive->ViewValue = FormatDateTime($this->item_date_receive->ViewValue, 0);
		$this->item_date_receive->ViewCustomAttributes = "";

		// item_date_repaired
		$this->item_date_repaired->ViewValue = $this->item_date_repaired->CurrentValue;
		$this->item_date_repaired->ViewValue = FormatDateTime($this->item_date_repaired->ViewValue, 0);
		$this->item_date_repaired->ViewCustomAttributes = "";

		// Concat
		$this->Concat->ViewValue = $this->Concat->CurrentValue;
		$this->Concat->ViewCustomAttributes = "";

		// item_transmittal
		$this->item_transmittal->ViewValue = $this->item_transmittal->CurrentValue;
		$this->item_transmittal->ViewCustomAttributes = "";

		// position
		$this->position->ViewValue = $this->position->CurrentValue;
		$this->position->ViewCustomAttributes = "";

		// off_desc
		$this->off_desc->ViewValue = $this->off_desc->CurrentValue;
		$this->off_desc->ViewCustomAttributes = "";

		// off_desc1
		$this->off_desc1->ViewValue = $this->off_desc1->CurrentValue;
		$this->off_desc1->ViewCustomAttributes = "";

		// model
		$this->model->ViewValue = $this->model->CurrentValue;
		$this->model->ViewCustomAttributes = "";

		// cat_desc
		$this->cat_desc->ViewValue = $this->cat_desc->CurrentValue;
		$this->cat_desc->ViewCustomAttributes = "";

		// item_model
		$this->item_model->ViewValue = $this->item_model->CurrentValue;
		$this->item_model->ViewCustomAttributes = "";

		// item_serno
		$this->item_serno->ViewValue = $this->item_serno->CurrentValue;
		$this->item_serno->ViewCustomAttributes = "";

		// item_type_problem
		$this->item_type_problem->ViewValue = $this->item_type_problem->CurrentValue;
		$this->item_type_problem->ViewCustomAttributes = "";

		// item_action_taken
		$this->item_action_taken->ViewValue = $this->item_action_taken->CurrentValue;
		$this->item_action_taken->ViewCustomAttributes = "";

		// technician_name
		$this->technician_name->ViewValue = $this->technician_name->CurrentValue;
		$curVal = strval($this->technician_name->CurrentValue);
		if ($curVal != "") {
			$this->technician_name->ViewValue = $this->technician_name->lookupCacheOption($curVal);
			if ($this->technician_name->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`technician_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->technician_name->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->technician_name->ViewValue = $this->technician_name->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->technician_name->ViewValue = $this->technician_name->CurrentValue;
				}
			}
		} else {
			$this->technician_name->ViewValue = NULL;
		}
		$this->technician_name->ViewCustomAttributes = "";

		// Date_Finished
		$this->Date_Finished->ViewValue = $this->Date_Finished->CurrentValue;
		$this->Date_Finished->ViewValue = FormatDateTime($this->Date_Finished->ViewValue, 0);
		$this->Date_Finished->ViewCustomAttributes = "";

		// employeeid
		$curVal = strval($this->employeeid->CurrentValue);
		if ($curVal != "") {
			$this->employeeid->ViewValue = $this->employeeid->lookupCacheOption($curVal);
			if ($this->employeeid->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`employeeid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`employeeid` in(4,5)";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->employeeid->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->employeeid->ViewValue = $this->employeeid->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->employeeid->ViewValue = $this->employeeid->CurrentValue;
				}
			}
		} else {
			$this->employeeid->ViewValue = NULL;
		}
		$this->employeeid->ViewCustomAttributes = "";

		// status_desc
		$curVal = strval($this->status_desc->CurrentValue);
		if ($curVal != "") {
			$this->status_desc->ViewValue = $this->status_desc->lookupCacheOption($curVal);
			if ($this->status_desc->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->status_desc->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->status_desc->ViewValue = $this->status_desc->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status_desc->ViewValue = $this->status_desc->CurrentValue;
				}
			}
		} else {
			$this->status_desc->ViewValue = NULL;
		}
		$this->status_desc->ViewCustomAttributes = "";

		// Name_dsc
		$this->Name_dsc->ViewValue = $this->Name_dsc->CurrentValue;
		$this->Name_dsc->ViewCustomAttributes = "";

		// remarks
		$this->remarks->ViewValue = $this->remarks->CurrentValue;
		$this->remarks->ViewCustomAttributes = "";

		// item_date_pullout
		$this->item_date_pullout->ViewValue = $this->item_date_pullout->CurrentValue;
		$this->item_date_pullout->ViewValue = FormatDateTime($this->item_date_pullout->ViewValue, 0);
		$this->item_date_pullout->ViewCustomAttributes = "";

		// Region
		$this->Region->ViewValue = $this->Region->CurrentValue;
		$this->Region->ViewValue = FormatNumber($this->Region->ViewValue, 0, -2, -2, -2);
		$this->Region->ViewCustomAttributes = "";

		// Province
		$this->Province->ViewValue = $this->Province->CurrentValue;
		$this->Province->ViewValue = FormatNumber($this->Province->ViewValue, 0, -2, -2, -2);
		$this->Province->ViewCustomAttributes = "";

		// Cities
		$this->Cities->ViewValue = $this->Cities->CurrentValue;
		$this->Cities->ViewValue = FormatNumber($this->Cities->ViewValue, 0, -2, -2, -2);
		$this->Cities->ViewCustomAttributes = "";

		// Request
		$this->__Request->ViewValue = $this->__Request->CurrentValue;
		$this->__Request->ViewValue = FormatNumber($this->__Request->ViewValue, 0, -2, -2, -2);
		$this->__Request->ViewCustomAttributes = "";

		// user_last_modify
		$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
		$this->user_last_modify->ViewCustomAttributes = "";

		// date_last_modify
		$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
		$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
		$this->date_last_modify->ViewCustomAttributes = "";

		// SRN
		$this->SRN->ViewValue = $this->SRN->CurrentValue;
		$this->SRN->ViewCustomAttributes = "";

		// Contact_no
		$this->Contact_no->ViewValue = $this->Contact_no->CurrentValue;
		$this->Contact_no->ViewValue = FormatNumber($this->Contact_no->ViewValue, 0, -2, -2, -2);
		$this->Contact_no->ViewCustomAttributes = "";

		// item_id
		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		$this->item_id->ViewCustomAttributes = "";

		// month
		$this->month->LinkCustomAttributes = "";
		$this->month->HrefValue = "";
		$this->month->TooltipValue = "";

		// Year
		$this->Year->LinkCustomAttributes = "";
		$this->Year->HrefValue = "";
		$this->Year->TooltipValue = "";

		// item_date_receive
		$this->item_date_receive->LinkCustomAttributes = "";
		$this->item_date_receive->HrefValue = "";
		$this->item_date_receive->TooltipValue = "";

		// item_date_repaired
		$this->item_date_repaired->LinkCustomAttributes = "";
		$this->item_date_repaired->HrefValue = "";
		$this->item_date_repaired->TooltipValue = "";

		// Concat
		$this->Concat->LinkCustomAttributes = "";
		$this->Concat->HrefValue = "";
		$this->Concat->TooltipValue = "";

		// item_transmittal
		$this->item_transmittal->LinkCustomAttributes = "";
		$this->item_transmittal->HrefValue = "";
		$this->item_transmittal->TooltipValue = "";

		// position
		$this->position->LinkCustomAttributes = "";
		$this->position->HrefValue = "";
		$this->position->TooltipValue = "";

		// off_desc
		$this->off_desc->LinkCustomAttributes = "";
		$this->off_desc->HrefValue = "";
		$this->off_desc->TooltipValue = "";

		// off_desc1
		$this->off_desc1->LinkCustomAttributes = "";
		$this->off_desc1->HrefValue = "";
		$this->off_desc1->TooltipValue = "";

		// model
		$this->model->LinkCustomAttributes = "";
		$this->model->HrefValue = "";
		$this->model->TooltipValue = "";

		// cat_desc
		$this->cat_desc->LinkCustomAttributes = "";
		$this->cat_desc->HrefValue = "";
		$this->cat_desc->TooltipValue = "";

		// item_model
		$this->item_model->LinkCustomAttributes = "";
		$this->item_model->HrefValue = "";
		$this->item_model->TooltipValue = "";

		// item_serno
		$this->item_serno->LinkCustomAttributes = "";
		$this->item_serno->HrefValue = "";
		$this->item_serno->TooltipValue = "";

		// item_type_problem
		$this->item_type_problem->LinkCustomAttributes = "";
		$this->item_type_problem->HrefValue = "";
		$this->item_type_problem->TooltipValue = "";

		// item_action_taken
		$this->item_action_taken->LinkCustomAttributes = "";
		$this->item_action_taken->HrefValue = "";
		$this->item_action_taken->TooltipValue = "";

		// technician_name
		$this->technician_name->LinkCustomAttributes = "";
		$this->technician_name->HrefValue = "";
		$this->technician_name->TooltipValue = "";

		// Date_Finished
		$this->Date_Finished->LinkCustomAttributes = "";
		$this->Date_Finished->HrefValue = "";
		$this->Date_Finished->TooltipValue = "";

		// employeeid
		$this->employeeid->LinkCustomAttributes = "";
		$this->employeeid->HrefValue = "";
		$this->employeeid->TooltipValue = "";

		// status_desc
		$this->status_desc->LinkCustomAttributes = "";
		$this->status_desc->HrefValue = "";
		$this->status_desc->TooltipValue = "";

		// Name_dsc
		$this->Name_dsc->LinkCustomAttributes = "";
		$this->Name_dsc->HrefValue = "";
		$this->Name_dsc->TooltipValue = "";

		// remarks
		$this->remarks->LinkCustomAttributes = "";
		$this->remarks->HrefValue = "";
		$this->remarks->TooltipValue = "";

		// item_date_pullout
		$this->item_date_pullout->LinkCustomAttributes = "";
		$this->item_date_pullout->HrefValue = "";
		$this->item_date_pullout->TooltipValue = "";

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

		// Request
		$this->__Request->LinkCustomAttributes = "";
		$this->__Request->HrefValue = "";
		$this->__Request->TooltipValue = "";

		// user_last_modify
		$this->user_last_modify->LinkCustomAttributes = "";
		$this->user_last_modify->HrefValue = "";
		$this->user_last_modify->TooltipValue = "";

		// date_last_modify
		$this->date_last_modify->LinkCustomAttributes = "";
		$this->date_last_modify->HrefValue = "";
		$this->date_last_modify->TooltipValue = "";

		// SRN
		$this->SRN->LinkCustomAttributes = "";
		$this->SRN->HrefValue = "";
		$this->SRN->TooltipValue = "";

		// Contact_no
		$this->Contact_no->LinkCustomAttributes = "";
		$this->Contact_no->HrefValue = "";
		$this->Contact_no->TooltipValue = "";

		// item_id
		$this->item_id->LinkCustomAttributes = "";
		$this->item_id->HrefValue = "";
		$this->item_id->TooltipValue = "";

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

		// month
		$this->month->EditAttrs["class"] = "form-control";
		$this->month->EditCustomAttributes = "";

		// Year
		$this->Year->EditAttrs["class"] = "form-control";
		$this->Year->EditCustomAttributes = "";
		$this->Year->EditValue = $this->Year->CurrentValue;
		$this->Year->PlaceHolder = RemoveHtml($this->Year->caption());

		// item_date_receive
		$this->item_date_receive->EditAttrs["class"] = "form-control";
		$this->item_date_receive->EditCustomAttributes = "";
		$this->item_date_receive->EditValue = FormatDateTime($this->item_date_receive->CurrentValue, 8);
		$this->item_date_receive->PlaceHolder = RemoveHtml($this->item_date_receive->caption());

		// item_date_repaired
		$this->item_date_repaired->EditAttrs["class"] = "form-control";
		$this->item_date_repaired->EditCustomAttributes = "";
		$this->item_date_repaired->EditValue = FormatDateTime($this->item_date_repaired->CurrentValue, 8);
		$this->item_date_repaired->PlaceHolder = RemoveHtml($this->item_date_repaired->caption());

		// Concat
		$this->Concat->EditAttrs["class"] = "form-control";
		$this->Concat->EditCustomAttributes = "";
		$this->Concat->EditValue = $this->Concat->CurrentValue;
		$this->Concat->PlaceHolder = RemoveHtml($this->Concat->caption());

		// item_transmittal
		$this->item_transmittal->EditAttrs["class"] = "form-control";
		$this->item_transmittal->EditCustomAttributes = "";
		if (!$this->item_transmittal->Raw)
			$this->item_transmittal->CurrentValue = HtmlDecode($this->item_transmittal->CurrentValue);
		$this->item_transmittal->EditValue = $this->item_transmittal->CurrentValue;
		$this->item_transmittal->PlaceHolder = RemoveHtml($this->item_transmittal->caption());

		// position
		$this->position->EditAttrs["class"] = "form-control";
		$this->position->EditCustomAttributes = "";
		if (!$this->position->Raw)
			$this->position->CurrentValue = HtmlDecode($this->position->CurrentValue);
		$this->position->EditValue = $this->position->CurrentValue;
		$this->position->PlaceHolder = RemoveHtml($this->position->caption());

		// off_desc
		$this->off_desc->EditAttrs["class"] = "form-control";
		$this->off_desc->EditCustomAttributes = "";
		if (!$this->off_desc->Raw)
			$this->off_desc->CurrentValue = HtmlDecode($this->off_desc->CurrentValue);
		$this->off_desc->EditValue = $this->off_desc->CurrentValue;
		$this->off_desc->PlaceHolder = RemoveHtml($this->off_desc->caption());

		// off_desc1
		$this->off_desc1->EditAttrs["class"] = "form-control";
		$this->off_desc1->EditCustomAttributes = "";
		if (!$this->off_desc1->Raw)
			$this->off_desc1->CurrentValue = HtmlDecode($this->off_desc1->CurrentValue);
		$this->off_desc1->EditValue = $this->off_desc1->CurrentValue;
		$this->off_desc1->PlaceHolder = RemoveHtml($this->off_desc1->caption());

		// model
		$this->model->EditAttrs["class"] = "form-control";
		$this->model->EditCustomAttributes = "";
		$this->model->EditValue = $this->model->CurrentValue;
		$this->model->PlaceHolder = RemoveHtml($this->model->caption());

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

		// item_serno
		$this->item_serno->EditAttrs["class"] = "form-control";
		$this->item_serno->EditCustomAttributes = "";
		if (!$this->item_serno->Raw)
			$this->item_serno->CurrentValue = HtmlDecode($this->item_serno->CurrentValue);
		$this->item_serno->EditValue = $this->item_serno->CurrentValue;
		$this->item_serno->PlaceHolder = RemoveHtml($this->item_serno->caption());

		// item_type_problem
		$this->item_type_problem->EditAttrs["class"] = "form-control";
		$this->item_type_problem->EditCustomAttributes = "";
		$this->item_type_problem->EditValue = $this->item_type_problem->CurrentValue;
		$this->item_type_problem->PlaceHolder = RemoveHtml($this->item_type_problem->caption());

		// item_action_taken
		$this->item_action_taken->EditAttrs["class"] = "form-control";
		$this->item_action_taken->EditCustomAttributes = "";
		$this->item_action_taken->EditValue = $this->item_action_taken->CurrentValue;
		$this->item_action_taken->PlaceHolder = RemoveHtml($this->item_action_taken->caption());

		// technician_name
		$this->technician_name->EditAttrs["class"] = "form-control";
		$this->technician_name->EditCustomAttributes = "";
		$this->technician_name->EditValue = $this->technician_name->CurrentValue;
		$this->technician_name->PlaceHolder = RemoveHtml($this->technician_name->caption());

		// Date_Finished
		$this->Date_Finished->EditAttrs["class"] = "form-control";
		$this->Date_Finished->EditCustomAttributes = "";
		$this->Date_Finished->EditValue = FormatDateTime($this->Date_Finished->CurrentValue, 8);
		$this->Date_Finished->PlaceHolder = RemoveHtml($this->Date_Finished->caption());

		// employeeid
		$this->employeeid->EditAttrs["class"] = "form-control";
		$this->employeeid->EditCustomAttributes = "";

		// status_desc
		$this->status_desc->EditAttrs["class"] = "form-control";
		$this->status_desc->EditCustomAttributes = "";

		// Name_dsc
		$this->Name_dsc->EditAttrs["class"] = "form-control";
		$this->Name_dsc->EditCustomAttributes = "";
		if (!$this->Name_dsc->Raw)
			$this->Name_dsc->CurrentValue = HtmlDecode($this->Name_dsc->CurrentValue);
		$this->Name_dsc->EditValue = $this->Name_dsc->CurrentValue;
		$this->Name_dsc->PlaceHolder = RemoveHtml($this->Name_dsc->caption());

		// remarks
		$this->remarks->EditAttrs["class"] = "form-control";
		$this->remarks->EditCustomAttributes = "";
		$this->remarks->EditValue = $this->remarks->CurrentValue;
		$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

		// item_date_pullout
		$this->item_date_pullout->EditAttrs["class"] = "form-control";
		$this->item_date_pullout->EditCustomAttributes = "";
		$this->item_date_pullout->EditValue = FormatDateTime($this->item_date_pullout->CurrentValue, 8);
		$this->item_date_pullout->PlaceHolder = RemoveHtml($this->item_date_pullout->caption());

		// Region
		$this->Region->EditAttrs["class"] = "form-control";
		$this->Region->EditCustomAttributes = "";
		$this->Region->EditValue = $this->Region->CurrentValue;
		$this->Region->PlaceHolder = RemoveHtml($this->Region->caption());

		// Province
		$this->Province->EditAttrs["class"] = "form-control";
		$this->Province->EditCustomAttributes = "";
		$this->Province->EditValue = $this->Province->CurrentValue;
		$this->Province->PlaceHolder = RemoveHtml($this->Province->caption());

		// Cities
		$this->Cities->EditAttrs["class"] = "form-control";
		$this->Cities->EditCustomAttributes = "";
		$this->Cities->EditValue = $this->Cities->CurrentValue;
		$this->Cities->PlaceHolder = RemoveHtml($this->Cities->caption());

		// Request
		$this->__Request->EditAttrs["class"] = "form-control";
		$this->__Request->EditCustomAttributes = "";
		$this->__Request->EditValue = $this->__Request->CurrentValue;
		$this->__Request->PlaceHolder = RemoveHtml($this->__Request->caption());

		// user_last_modify
		$this->user_last_modify->EditAttrs["class"] = "form-control";
		$this->user_last_modify->EditCustomAttributes = "";
		if (!$this->user_last_modify->Raw)
			$this->user_last_modify->CurrentValue = HtmlDecode($this->user_last_modify->CurrentValue);
		$this->user_last_modify->EditValue = $this->user_last_modify->CurrentValue;
		$this->user_last_modify->PlaceHolder = RemoveHtml($this->user_last_modify->caption());

		// date_last_modify
		$this->date_last_modify->EditAttrs["class"] = "form-control";
		$this->date_last_modify->EditCustomAttributes = "";
		$this->date_last_modify->EditValue = FormatDateTime($this->date_last_modify->CurrentValue, 8);
		$this->date_last_modify->PlaceHolder = RemoveHtml($this->date_last_modify->caption());

		// SRN
		$this->SRN->EditAttrs["class"] = "form-control";
		$this->SRN->EditCustomAttributes = "";
		if (!$this->SRN->Raw)
			$this->SRN->CurrentValue = HtmlDecode($this->SRN->CurrentValue);
		$this->SRN->EditValue = $this->SRN->CurrentValue;
		$this->SRN->PlaceHolder = RemoveHtml($this->SRN->caption());

		// Contact_no
		$this->Contact_no->EditAttrs["class"] = "form-control";
		$this->Contact_no->EditCustomAttributes = "";
		$this->Contact_no->EditValue = $this->Contact_no->CurrentValue;
		$this->Contact_no->PlaceHolder = RemoveHtml($this->Contact_no->caption());

		// item_id
		$this->item_id->EditAttrs["class"] = "form-control";
		$this->item_id->EditCustomAttributes = "";
		$this->item_id->EditValue = $this->item_id->CurrentValue;
		$this->item_id->ViewCustomAttributes = "";

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
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->item_date_receive);
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->Concat);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->position);
					$doc->exportCaption($this->off_desc);
					$doc->exportCaption($this->off_desc1);
					$doc->exportCaption($this->model);
					$doc->exportCaption($this->cat_desc);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->item_type_problem);
					$doc->exportCaption($this->item_action_taken);
					$doc->exportCaption($this->technician_name);
					$doc->exportCaption($this->Date_Finished);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->status_desc);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->item_date_pullout);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->Province);
					$doc->exportCaption($this->Cities);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->SRN);
					$doc->exportCaption($this->Contact_no);
					$doc->exportCaption($this->item_id);
				} else {
					$doc->exportCaption($this->Year);
					$doc->exportCaption($this->item_date_receive);
					$doc->exportCaption($this->item_date_repaired);
					$doc->exportCaption($this->Concat);
					$doc->exportCaption($this->item_transmittal);
					$doc->exportCaption($this->position);
					$doc->exportCaption($this->off_desc);
					$doc->exportCaption($this->off_desc1);
					$doc->exportCaption($this->model);
					$doc->exportCaption($this->cat_desc);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serno);
					$doc->exportCaption($this->item_type_problem);
					$doc->exportCaption($this->item_action_taken);
					$doc->exportCaption($this->Date_Finished);
					$doc->exportCaption($this->employeeid);
					$doc->exportCaption($this->status_desc);
					$doc->exportCaption($this->item_date_pullout);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->Province);
					$doc->exportCaption($this->Cities);
					$doc->exportCaption($this->__Request);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->SRN);
					$doc->exportCaption($this->Contact_no);
					$doc->exportCaption($this->item_id);
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
						$doc->exportField($this->Year);
						$doc->exportField($this->item_date_receive);
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->Concat);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->position);
						$doc->exportField($this->off_desc);
						$doc->exportField($this->off_desc1);
						$doc->exportField($this->model);
						$doc->exportField($this->cat_desc);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->item_type_problem);
						$doc->exportField($this->item_action_taken);
						$doc->exportField($this->technician_name);
						$doc->exportField($this->Date_Finished);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->status_desc);
						$doc->exportField($this->remarks);
						$doc->exportField($this->item_date_pullout);
						$doc->exportField($this->Region);
						$doc->exportField($this->Province);
						$doc->exportField($this->Cities);
						$doc->exportField($this->__Request);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->SRN);
						$doc->exportField($this->Contact_no);
						$doc->exportField($this->item_id);
					} else {
						$doc->exportField($this->Year);
						$doc->exportField($this->item_date_receive);
						$doc->exportField($this->item_date_repaired);
						$doc->exportField($this->Concat);
						$doc->exportField($this->item_transmittal);
						$doc->exportField($this->position);
						$doc->exportField($this->off_desc);
						$doc->exportField($this->off_desc1);
						$doc->exportField($this->model);
						$doc->exportField($this->cat_desc);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serno);
						$doc->exportField($this->item_type_problem);
						$doc->exportField($this->item_action_taken);
						$doc->exportField($this->Date_Finished);
						$doc->exportField($this->employeeid);
						$doc->exportField($this->status_desc);
						$doc->exportField($this->item_date_pullout);
						$doc->exportField($this->Region);
						$doc->exportField($this->Province);
						$doc->exportField($this->Cities);
						$doc->exportField($this->__Request);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->SRN);
						$doc->exportField($this->Contact_no);
						$doc->exportField($this->item_id);
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