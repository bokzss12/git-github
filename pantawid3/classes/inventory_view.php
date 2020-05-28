<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for inventory_view
 */
class inventory_view extends DbTable
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
	public $concat_inventory;
	public $Month_Purchased;
	public $Year_Purchased;
	public $item_type;
	public $item_model;
	public $item_serial;
	public $office_id;
	public $Region;
	public $Province;
	public $Cities;
	public $name_accountable;
	public $Designation;
	public $Last_Date_Check;
	public $remarks;
	public $user_last_modify;
	public $date_last_modify;
	public $item_id;
	public $pullout_i;
	public $Current_Location;
	public $status;
	public $pullout_date;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'inventory_view';
		$this->TableName = 'inventory_view';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`inventory_view`";
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
		$this->UserIDAllowSecurity |= 104; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// inventory_id
		$this->inventory_id = new DbField('inventory_view', 'inventory_view', 'x_inventory_id', 'inventory_id', '`inventory_id`', '`inventory_id`', 3, 11, -1, FALSE, '`inventory_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->inventory_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->inventory_id->IsPrimaryKey = TRUE; // Primary key field
		$this->inventory_id->Sortable = TRUE; // Allow sort
		$this->inventory_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['inventory_id'] = &$this->inventory_id;

		// concat_inventory
		$this->concat_inventory = new DbField('inventory_view', 'inventory_view', 'x_concat_inventory', 'concat_inventory', 'concat(\'INV-R6\',inventory_id)', 'concat(\'INV-R6\',inventory_id)', 200, 17, -1, FALSE, 'concat(\'INV-R6\',inventory_id)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->concat_inventory->IsCustom = TRUE; // Custom field
		$this->concat_inventory->Sortable = TRUE; // Allow sort
		$this->fields['concat_inventory'] = &$this->concat_inventory;

		// Month_Purchased
		$this->Month_Purchased = new DbField('inventory_view', 'inventory_view', 'x_Month_Purchased', 'Month_Purchased', '`Month_Purchased`', '`Month_Purchased`', 3, 11, -1, FALSE, '`Month_Purchased`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Month_Purchased->Sortable = TRUE; // Allow sort
		$this->Month_Purchased->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Month_Purchased->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Month_Purchased->Lookup = new Lookup('Month_Purchased', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '`month_dsc` ASC', '');
				break;
			default:
				$this->Month_Purchased->Lookup = new Lookup('Month_Purchased', 'tbl_month', FALSE, 'month_id', ["month_dsc","","",""], [], [], [], [], [], [], '`month_dsc` ASC', '');
				break;
		}
		$this->Month_Purchased->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Month_Purchased'] = &$this->Month_Purchased;

		// Year_Purchased
		$this->Year_Purchased = new DbField('inventory_view', 'inventory_view', 'x_Year_Purchased', 'Year_Purchased', '`Year_Purchased`', '`Year_Purchased`', 3, 11, -1, FALSE, '`Year_Purchased`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Year_Purchased->Sortable = TRUE; // Allow sort
		$this->Year_Purchased->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Year_Purchased->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Year_Purchased->Lookup = new Lookup('Year_Purchased', 'tbl_year', FALSE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` ASC', '');
				break;
			default:
				$this->Year_Purchased->Lookup = new Lookup('Year_Purchased', 'tbl_year', FALSE, 'year_id', ["year_dsc","","",""], [], [], [], [], [], [], '`year_dsc` ASC', '');
				break;
		}
		$this->Year_Purchased->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Year_Purchased'] = &$this->Year_Purchased;

		// item_type
		$this->item_type = new DbField('inventory_view', 'inventory_view', 'x_item_type', 'item_type', '`item_type`', '`item_type`', 3, 11, -1, FALSE, '`item_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_type->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->item_type->Lookup = new Lookup('item_type', 'tbl_cat', FALSE, 'cat_id', ["cat_desc","","",""], [], [], [], [], [], [], '`cat_desc` ASC', '');
				break;
			default:
				$this->item_type->Lookup = new Lookup('item_type', 'tbl_cat', FALSE, 'cat_id', ["cat_desc","","",""], [], [], [], [], [], [], '`cat_desc` ASC', '');
				break;
		}
		$this->item_type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['item_type'] = &$this->item_type;

		// item_model
		$this->item_model = new DbField('inventory_view', 'inventory_view', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 50, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serial
		$this->item_serial = new DbField('inventory_view', 'inventory_view', 'x_item_serial', 'item_serial', '`item_serial`', '`item_serial`', 200, 50, -1, FALSE, '`item_serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serial->Sortable = TRUE; // Allow sort
		$this->fields['item_serial'] = &$this->item_serial;

		// office_id
		$this->office_id = new DbField('inventory_view', 'inventory_view', 'x_office_id', 'office_id', '`office_id`', '`office_id`', 3, 11, -1, FALSE, '`office_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->office_id->Sortable = TRUE; // Allow sort
		$this->office_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->office_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->office_id->Lookup = new Lookup('office_id', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
			default:
				$this->office_id->Lookup = new Lookup('office_id', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
		}
		$this->office_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['office_id'] = &$this->office_id;

		// Region
		$this->Region = new DbField('inventory_view', 'inventory_view', 'x_Region', 'Region', '`Region`', '`Region`', 3, 11, -1, FALSE, '`Region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Region->Sortable = TRUE; // Allow sort
		$this->Region->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Region->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Region->Lookup = new Lookup('Region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Region->Lookup = new Lookup('Region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Region->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Region'] = &$this->Region;

		// Province
		$this->Province = new DbField('inventory_view', 'inventory_view', 'x_Province', 'Province', '`Province`', '`Province`', 3, 11, -1, FALSE, '`Province`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Province->Sortable = TRUE; // Allow sort
		$this->Province->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Province->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Province->Lookup = new Lookup('Province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Province->Lookup = new Lookup('Province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Province->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Province'] = &$this->Province;

		// Cities
		$this->Cities = new DbField('inventory_view', 'inventory_view', 'x_Cities', 'Cities', '`Cities`', '`Cities`', 3, 11, -1, FALSE, '`Cities`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Cities->Sortable = TRUE; // Allow sort
		$this->Cities->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Cities->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Cities->Lookup = new Lookup('Cities', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Cities->Lookup = new Lookup('Cities', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Cities->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Cities'] = &$this->Cities;

		// name_accountable
		$this->name_accountable = new DbField('inventory_view', 'inventory_view', 'x_name_accountable', 'name_accountable', '`name_accountable`', '`name_accountable`', 3, 50, -1, FALSE, '`name_accountable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->name_accountable->Sortable = TRUE; // Allow sort
		$this->name_accountable->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->name_accountable->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->name_accountable->Lookup = new Lookup('name_accountable', 'tbl_accountable_name', FALSE, 'name_id', ["full_name_tbl","","",""], [], [], [], [], [], [], '`full_name_tbl` ASC', '');
				break;
			default:
				$this->name_accountable->Lookup = new Lookup('name_accountable', 'tbl_accountable_name', FALSE, 'name_id', ["full_name_tbl","","",""], [], [], [], [], [], [], '`full_name_tbl` ASC', '');
				break;
		}
		$this->name_accountable->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['name_accountable'] = &$this->name_accountable;

		// Designation
		$this->Designation = new DbField('inventory_view', 'inventory_view', 'x_Designation', 'Designation', '`Designation`', '`Designation`', 3, 50, -1, FALSE, '`Designation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Designation->Sortable = TRUE; // Allow sort
		$this->Designation->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Designation->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Designation->Lookup = new Lookup('Designation', 'tbl_pos', FALSE, 'pos_id', ["pos_desc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Designation->Lookup = new Lookup('Designation', 'tbl_pos', FALSE, 'pos_id', ["pos_desc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Designation->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Designation'] = &$this->Designation;

		// Last_Date_Check
		$this->Last_Date_Check = new DbField('inventory_view', 'inventory_view', 'x_Last_Date_Check', 'Last_Date_Check', '`Last_Date_Check`', CastDateFieldForLike("`Last_Date_Check`", 0, "DB"), 133, 10, 0, FALSE, '`Last_Date_Check`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Last_Date_Check->Sortable = TRUE; // Allow sort
		$this->Last_Date_Check->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Last_Date_Check'] = &$this->Last_Date_Check;

		// remarks
		$this->remarks = new DbField('inventory_view', 'inventory_view', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->fields['remarks'] = &$this->remarks;

		// user_last_modify
		$this->user_last_modify = new DbField('inventory_view', 'inventory_view', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// date_last_modify
		$this->date_last_modify = new DbField('inventory_view', 'inventory_view', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 0, "DB"), 135, 19, 0, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_last_modify->Sortable = TRUE; // Allow sort
		$this->date_last_modify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_last_modify'] = &$this->date_last_modify;

		// item_id
		$this->item_id = new DbField('inventory_view', 'inventory_view', 'x_item_id', 'item_id', '`item_id`', '`item_id`', 200, 255, -1, FALSE, '`item_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_id->Sortable = TRUE; // Allow sort
		$this->fields['item_id'] = &$this->item_id;

		// pullout_i
		$this->pullout_i = new DbField('inventory_view', 'inventory_view', 'x_pullout_i', 'pullout_i', '`pullout_i`', '`pullout_i`', 200, 255, -1, FALSE, '`pullout_i`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->pullout_i->Required = TRUE; // Required field
		$this->pullout_i->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->pullout_i->Lookup = new Lookup('pullout_i', 'inventory_view', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->pullout_i->Lookup = new Lookup('pullout_i', 'inventory_view', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->pullout_i->OptionCount = 1;
		$this->fields['pullout_i'] = &$this->pullout_i;

		// Current_Location
		$this->Current_Location = new DbField('inventory_view', 'inventory_view', 'x_Current_Location', 'Current_Location', '`Current_Location`', '`Current_Location`', 3, 11, -1, FALSE, '`Current_Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Current_Location->Required = TRUE; // Required field
		$this->Current_Location->Sortable = TRUE; // Allow sort
		$this->Current_Location->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Current_Location->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Current_Location->Lookup = new Lookup('Current_Location', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
			default:
				$this->Current_Location->Lookup = new Lookup('Current_Location', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
		}
		$this->Current_Location->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Current_Location'] = &$this->Current_Location;

		// status
		$this->status = new DbField('inventory_view', 'inventory_view', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->status->Lookup = new Lookup('status', 'tbl_inventory_status', FALSE, 'inventory_status_id', ["inventory_status_dsc","","",""], [], [], [], [], [], [], '`inventory_status_dsc` DESC', '');
				break;
			default:
				$this->status->Lookup = new Lookup('status', 'tbl_inventory_status', FALSE, 'inventory_status_id', ["inventory_status_dsc","","",""], [], [], [], [], [], [], '`inventory_status_dsc` DESC', '');
				break;
		}
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// pullout_date
		$this->pullout_date = new DbField('inventory_view', 'inventory_view', 'x_pullout_date', 'pullout_date', '`pullout_date`', CastDateFieldForLike("`pullout_date`", 5, "DB"), 135, 19, 5, FALSE, '`pullout_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pullout_date->Required = TRUE; // Required field
		$this->pullout_date->Sortable = TRUE; // Allow sort
		$this->pullout_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['pullout_date'] = &$this->pullout_date;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`inventory_view`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, concat('INV-R6',inventory_id) AS `concat_inventory` FROM " . $this->getSqlFrom();
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
		$this->TableFilter = "`pullout_i` = '1'";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`inventory_id` DESC";
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
		$this->concat_inventory->DbValue = $row['concat_inventory'];
		$this->Month_Purchased->DbValue = $row['Month_Purchased'];
		$this->Year_Purchased->DbValue = $row['Year_Purchased'];
		$this->item_type->DbValue = $row['item_type'];
		$this->item_model->DbValue = $row['item_model'];
		$this->item_serial->DbValue = $row['item_serial'];
		$this->office_id->DbValue = $row['office_id'];
		$this->Region->DbValue = $row['Region'];
		$this->Province->DbValue = $row['Province'];
		$this->Cities->DbValue = $row['Cities'];
		$this->name_accountable->DbValue = $row['name_accountable'];
		$this->Designation->DbValue = $row['Designation'];
		$this->Last_Date_Check->DbValue = $row['Last_Date_Check'];
		$this->remarks->DbValue = $row['remarks'];
		$this->user_last_modify->DbValue = $row['user_last_modify'];
		$this->date_last_modify->DbValue = $row['date_last_modify'];
		$this->item_id->DbValue = $row['item_id'];
		$this->pullout_i->DbValue = $row['pullout_i'];
		$this->Current_Location->DbValue = $row['Current_Location'];
		$this->status->DbValue = $row['status'];
		$this->pullout_date->DbValue = $row['pullout_date'];
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
			return "inventory_viewlist.php";
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
		if ($pageName == "inventory_viewview.php")
			return $Language->phrase("View");
		elseif ($pageName == "inventory_viewedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "inventory_viewadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "inventory_viewlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("inventory_viewview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("inventory_viewview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "inventory_viewadd.php?" . $this->getUrlParm($parm);
		else
			$url = "inventory_viewadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("inventory_viewedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("inventory_viewadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("inventory_viewdelete.php", $this->getUrlParm());
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
		$this->concat_inventory->setDbValue($rs->fields('concat_inventory'));
		$this->Month_Purchased->setDbValue($rs->fields('Month_Purchased'));
		$this->Year_Purchased->setDbValue($rs->fields('Year_Purchased'));
		$this->item_type->setDbValue($rs->fields('item_type'));
		$this->item_model->setDbValue($rs->fields('item_model'));
		$this->item_serial->setDbValue($rs->fields('item_serial'));
		$this->office_id->setDbValue($rs->fields('office_id'));
		$this->Region->setDbValue($rs->fields('Region'));
		$this->Province->setDbValue($rs->fields('Province'));
		$this->Cities->setDbValue($rs->fields('Cities'));
		$this->name_accountable->setDbValue($rs->fields('name_accountable'));
		$this->Designation->setDbValue($rs->fields('Designation'));
		$this->Last_Date_Check->setDbValue($rs->fields('Last_Date_Check'));
		$this->remarks->setDbValue($rs->fields('remarks'));
		$this->user_last_modify->setDbValue($rs->fields('user_last_modify'));
		$this->date_last_modify->setDbValue($rs->fields('date_last_modify'));
		$this->item_id->setDbValue($rs->fields('item_id'));
		$this->pullout_i->setDbValue($rs->fields('pullout_i'));
		$this->Current_Location->setDbValue($rs->fields('Current_Location'));
		$this->status->setDbValue($rs->fields('status'));
		$this->pullout_date->setDbValue($rs->fields('pullout_date'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// inventory_id
		// concat_inventory
		// Month_Purchased
		// Year_Purchased
		// item_type
		// item_model
		// item_serial
		// office_id
		// Region
		// Province
		// Cities
		// name_accountable
		// Designation
		// Last_Date_Check
		// remarks
		// user_last_modify
		// date_last_modify
		// item_id
		// pullout_i
		// Current_Location
		// status
		// pullout_date
		// inventory_id

		$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
		$this->inventory_id->ViewCustomAttributes = "";

		// concat_inventory
		$this->concat_inventory->ViewValue = $this->concat_inventory->CurrentValue;
		$this->concat_inventory->ViewCustomAttributes = "";

		// Month_Purchased
		$curVal = strval($this->Month_Purchased->CurrentValue);
		if ($curVal != "") {
			$this->Month_Purchased->ViewValue = $this->Month_Purchased->lookupCacheOption($curVal);
			if ($this->Month_Purchased->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`month_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Month_Purchased->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Month_Purchased->ViewValue = $this->Month_Purchased->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Month_Purchased->ViewValue = $this->Month_Purchased->CurrentValue;
				}
			}
		} else {
			$this->Month_Purchased->ViewValue = NULL;
		}
		$this->Month_Purchased->ViewCustomAttributes = "";

		// Year_Purchased
		$curVal = strval($this->Year_Purchased->CurrentValue);
		if ($curVal != "") {
			$this->Year_Purchased->ViewValue = $this->Year_Purchased->lookupCacheOption($curVal);
			if ($this->Year_Purchased->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`year_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Year_Purchased->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Year_Purchased->ViewValue = $this->Year_Purchased->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Year_Purchased->ViewValue = $this->Year_Purchased->CurrentValue;
				}
			}
		} else {
			$this->Year_Purchased->ViewValue = NULL;
		}
		$this->Year_Purchased->ViewCustomAttributes = "";

		// item_type
		$this->item_type->ViewValue = $this->item_type->CurrentValue;
		$curVal = strval($this->item_type->CurrentValue);
		if ($curVal != "") {
			$this->item_type->ViewValue = $this->item_type->lookupCacheOption($curVal);
			if ($this->item_type->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`cat_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->item_type->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->item_type->ViewValue = $this->item_type->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->item_type->ViewValue = $this->item_type->CurrentValue;
				}
			}
		} else {
			$this->item_type->ViewValue = NULL;
		}
		$this->item_type->ViewCustomAttributes = "";

		// item_model
		$this->item_model->ViewValue = $this->item_model->CurrentValue;
		$this->item_model->ViewCustomAttributes = "";

		// item_serial
		$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
		$this->item_serial->ViewCustomAttributes = "";

		// office_id
		$curVal = strval($this->office_id->CurrentValue);
		if ($curVal != "") {
			$this->office_id->ViewValue = $this->office_id->lookupCacheOption($curVal);
			if ($this->office_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`off_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->office_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->office_id->ViewValue = $this->office_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->office_id->ViewValue = $this->office_id->CurrentValue;
				}
			}
		} else {
			$this->office_id->ViewValue = NULL;
		}
		$this->office_id->ViewCustomAttributes = "";

		// Region
		$curVal = strval($this->Region->CurrentValue);
		if ($curVal != "") {
			$this->Region->ViewValue = $this->Region->lookupCacheOption($curVal);
			if ($this->Region->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`region_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Region->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Region->ViewValue = $this->Region->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Region->ViewValue = $this->Region->CurrentValue;
				}
			}
		} else {
			$this->Region->ViewValue = NULL;
		}
		$this->Region->ViewCustomAttributes = "";

		// Province
		$curVal = strval($this->Province->CurrentValue);
		if ($curVal != "") {
			$this->Province->ViewValue = $this->Province->lookupCacheOption($curVal);
			if ($this->Province->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`prov_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Province->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Province->ViewValue = $this->Province->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Province->ViewValue = $this->Province->CurrentValue;
				}
			}
		} else {
			$this->Province->ViewValue = NULL;
		}
		$this->Province->ViewCustomAttributes = "";

		// Cities
		$curVal = strval($this->Cities->CurrentValue);
		if ($curVal != "") {
			$this->Cities->ViewValue = $this->Cities->lookupCacheOption($curVal);
			if ($this->Cities->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`city_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Cities->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Cities->ViewValue = $this->Cities->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Cities->ViewValue = $this->Cities->CurrentValue;
				}
			}
		} else {
			$this->Cities->ViewValue = NULL;
		}
		$this->Cities->ViewCustomAttributes = "";

		// name_accountable
		$curVal = strval($this->name_accountable->CurrentValue);
		if ($curVal != "") {
			$this->name_accountable->ViewValue = $this->name_accountable->lookupCacheOption($curVal);
			if ($this->name_accountable->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`name_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->name_accountable->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->name_accountable->ViewValue = $this->name_accountable->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->name_accountable->ViewValue = $this->name_accountable->CurrentValue;
				}
			}
		} else {
			$this->name_accountable->ViewValue = NULL;
		}
		$this->name_accountable->ViewCustomAttributes = "";

		// Designation
		$curVal = strval($this->Designation->CurrentValue);
		if ($curVal != "") {
			$this->Designation->ViewValue = $this->Designation->lookupCacheOption($curVal);
			if ($this->Designation->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`pos_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Designation->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Designation->ViewValue = $this->Designation->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Designation->ViewValue = $this->Designation->CurrentValue;
				}
			}
		} else {
			$this->Designation->ViewValue = NULL;
		}
		$this->Designation->ViewCustomAttributes = "";

		// Last_Date_Check
		$this->Last_Date_Check->ViewValue = $this->Last_Date_Check->CurrentValue;
		$this->Last_Date_Check->ViewValue = FormatDateTime($this->Last_Date_Check->ViewValue, 0);
		$this->Last_Date_Check->ViewCustomAttributes = "";

		// remarks
		$this->remarks->ViewValue = $this->remarks->CurrentValue;
		$this->remarks->ViewCustomAttributes = "";

		// user_last_modify
		$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
		$this->user_last_modify->ViewCustomAttributes = "";

		// date_last_modify
		$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
		$this->date_last_modify->ViewValue = FormatDateTime($this->date_last_modify->ViewValue, 0);
		$this->date_last_modify->ViewCustomAttributes = "";

		// item_id
		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		$this->item_id->ViewCustomAttributes = "";

		// pullout_i
		if (strval($this->pullout_i->CurrentValue) != "") {
			$this->pullout_i->ViewValue = new OptionValues();
			$arwrk = explode(",", strval($this->pullout_i->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->pullout_i->ViewValue->add($this->pullout_i->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->pullout_i->ViewValue = NULL;
		}
		$this->pullout_i->ViewCustomAttributes = "";

		// Current_Location
		$curVal = strval($this->Current_Location->CurrentValue);
		if ($curVal != "") {
			$this->Current_Location->ViewValue = $this->Current_Location->lookupCacheOption($curVal);
			if ($this->Current_Location->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`off_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Current_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Current_Location->ViewValue = $this->Current_Location->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Current_Location->ViewValue = $this->Current_Location->CurrentValue;
				}
			}
		} else {
			$this->Current_Location->ViewValue = NULL;
		}
		$this->Current_Location->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$curVal = strval($this->status->CurrentValue);
		if ($curVal != "") {
			$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
			if ($this->status->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`inventory_status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->status->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->status->ViewValue = $this->status->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status->ViewValue = $this->status->CurrentValue;
				}
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// pullout_date
		$this->pullout_date->ViewValue = $this->pullout_date->CurrentValue;
		$this->pullout_date->ViewValue = FormatDateTime($this->pullout_date->ViewValue, 5);
		$this->pullout_date->ViewCustomAttributes = "";

		// inventory_id
		$this->inventory_id->LinkCustomAttributes = "";
		$this->inventory_id->HrefValue = "";
		$this->inventory_id->TooltipValue = "";

		// concat_inventory
		$this->concat_inventory->LinkCustomAttributes = "";
		$this->concat_inventory->HrefValue = "";
		$this->concat_inventory->TooltipValue = "";

		// Month_Purchased
		$this->Month_Purchased->LinkCustomAttributes = "";
		$this->Month_Purchased->HrefValue = "";
		$this->Month_Purchased->TooltipValue = "";

		// Year_Purchased
		$this->Year_Purchased->LinkCustomAttributes = "";
		$this->Year_Purchased->HrefValue = "";
		$this->Year_Purchased->TooltipValue = "";

		// item_type
		$this->item_type->LinkCustomAttributes = "";
		$this->item_type->HrefValue = "";
		$this->item_type->TooltipValue = "";

		// item_model
		$this->item_model->LinkCustomAttributes = "";
		$this->item_model->HrefValue = "";
		$this->item_model->TooltipValue = "";

		// item_serial
		$this->item_serial->LinkCustomAttributes = "";
		$this->item_serial->HrefValue = "";
		$this->item_serial->TooltipValue = "";

		// office_id
		$this->office_id->LinkCustomAttributes = "";
		$this->office_id->HrefValue = "";
		$this->office_id->TooltipValue = "";

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

		// name_accountable
		$this->name_accountable->LinkCustomAttributes = "";
		$this->name_accountable->HrefValue = "";
		$this->name_accountable->TooltipValue = "";

		// Designation
		$this->Designation->LinkCustomAttributes = "";
		$this->Designation->HrefValue = "";
		$this->Designation->TooltipValue = "";

		// Last_Date_Check
		$this->Last_Date_Check->LinkCustomAttributes = "";
		$this->Last_Date_Check->HrefValue = "";
		$this->Last_Date_Check->TooltipValue = "";

		// remarks
		$this->remarks->LinkCustomAttributes = "";
		$this->remarks->HrefValue = "";
		$this->remarks->TooltipValue = "";

		// user_last_modify
		$this->user_last_modify->LinkCustomAttributes = "";
		$this->user_last_modify->HrefValue = "";
		$this->user_last_modify->TooltipValue = "";

		// date_last_modify
		$this->date_last_modify->LinkCustomAttributes = "";
		$this->date_last_modify->HrefValue = "";
		$this->date_last_modify->TooltipValue = "";

		// item_id
		$this->item_id->LinkCustomAttributes = "";
		$this->item_id->HrefValue = "";
		$this->item_id->TooltipValue = "";

		// pullout_i
		$this->pullout_i->LinkCustomAttributes = "";
		$this->pullout_i->HrefValue = "";
		$this->pullout_i->TooltipValue = "";

		// Current_Location
		$this->Current_Location->LinkCustomAttributes = "";
		$this->Current_Location->HrefValue = "";
		$this->Current_Location->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// pullout_date
		$this->pullout_date->LinkCustomAttributes = "";
		$this->pullout_date->HrefValue = "";
		$this->pullout_date->TooltipValue = "";

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

		// concat_inventory
		$this->concat_inventory->EditAttrs["class"] = "form-control";
		$this->concat_inventory->EditCustomAttributes = "";
		if (!$this->concat_inventory->Raw)
			$this->concat_inventory->CurrentValue = HtmlDecode($this->concat_inventory->CurrentValue);
		$this->concat_inventory->EditValue = $this->concat_inventory->CurrentValue;
		$this->concat_inventory->PlaceHolder = RemoveHtml($this->concat_inventory->caption());

		// Month_Purchased
		$this->Month_Purchased->EditAttrs["class"] = "form-control";
		$this->Month_Purchased->EditCustomAttributes = "";

		// Year_Purchased
		$this->Year_Purchased->EditAttrs["class"] = "form-control";
		$this->Year_Purchased->EditCustomAttributes = "";

		// item_type
		$this->item_type->EditAttrs["class"] = "form-control";
		$this->item_type->EditCustomAttributes = "";
		$this->item_type->EditValue = $this->item_type->CurrentValue;
		$this->item_type->PlaceHolder = RemoveHtml($this->item_type->caption());

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

		// office_id
		$this->office_id->EditAttrs["class"] = "form-control";
		$this->office_id->EditCustomAttributes = "";

		// Region
		$this->Region->EditAttrs["class"] = "form-control";
		$this->Region->EditCustomAttributes = "";

		// Province
		$this->Province->EditAttrs["class"] = "form-control";
		$this->Province->EditCustomAttributes = "";

		// Cities
		$this->Cities->EditAttrs["class"] = "form-control";
		$this->Cities->EditCustomAttributes = "";

		// name_accountable
		$this->name_accountable->EditAttrs["class"] = "form-control";
		$this->name_accountable->EditCustomAttributes = "";

		// Designation
		$this->Designation->EditAttrs["class"] = "form-control";
		$this->Designation->EditCustomAttributes = "";

		// Last_Date_Check
		$this->Last_Date_Check->EditAttrs["class"] = "form-control";
		$this->Last_Date_Check->EditCustomAttributes = "";
		$this->Last_Date_Check->EditValue = FormatDateTime($this->Last_Date_Check->CurrentValue, 8);
		$this->Last_Date_Check->PlaceHolder = RemoveHtml($this->Last_Date_Check->caption());

		// remarks
		$this->remarks->EditAttrs["class"] = "form-control";
		$this->remarks->EditCustomAttributes = "";
		$this->remarks->EditValue = $this->remarks->CurrentValue;
		$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

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

		// item_id
		$this->item_id->EditAttrs["class"] = "form-control";
		$this->item_id->EditCustomAttributes = "";
		if (!$this->item_id->Raw)
			$this->item_id->CurrentValue = HtmlDecode($this->item_id->CurrentValue);
		$this->item_id->EditValue = $this->item_id->CurrentValue;
		$this->item_id->PlaceHolder = RemoveHtml($this->item_id->caption());

		// pullout_i
		$this->pullout_i->EditCustomAttributes = "";
		$this->pullout_i->EditValue = $this->pullout_i->options(FALSE);

		// Current_Location
		$this->Current_Location->EditAttrs["class"] = "form-control";
		$this->Current_Location->EditCustomAttributes = "";

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = RemoveHtml($this->status->caption());

		// pullout_date
		$this->pullout_date->EditAttrs["class"] = "form-control";
		$this->pullout_date->EditCustomAttributes = "";
		$this->pullout_date->EditValue = FormatDateTime($this->pullout_date->CurrentValue, 5);
		$this->pullout_date->PlaceHolder = RemoveHtml($this->pullout_date->caption());

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
					$doc->exportCaption($this->concat_inventory);
					$doc->exportCaption($this->Month_Purchased);
					$doc->exportCaption($this->Year_Purchased);
					$doc->exportCaption($this->item_type);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->office_id);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->Province);
					$doc->exportCaption($this->Cities);
					$doc->exportCaption($this->name_accountable);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->Last_Date_Check);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->Current_Location);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->pullout_date);
				} else {
					$doc->exportCaption($this->inventory_id);
					$doc->exportCaption($this->concat_inventory);
					$doc->exportCaption($this->Month_Purchased);
					$doc->exportCaption($this->Year_Purchased);
					$doc->exportCaption($this->item_type);
					$doc->exportCaption($this->item_model);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->office_id);
					$doc->exportCaption($this->Region);
					$doc->exportCaption($this->Province);
					$doc->exportCaption($this->Cities);
					$doc->exportCaption($this->name_accountable);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->Last_Date_Check);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->item_id);
					$doc->exportCaption($this->pullout_i);
					$doc->exportCaption($this->Current_Location);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->pullout_date);
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
						$doc->exportField($this->concat_inventory);
						$doc->exportField($this->Month_Purchased);
						$doc->exportField($this->Year_Purchased);
						$doc->exportField($this->item_type);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->office_id);
						$doc->exportField($this->Region);
						$doc->exportField($this->Province);
						$doc->exportField($this->Cities);
						$doc->exportField($this->name_accountable);
						$doc->exportField($this->Designation);
						$doc->exportField($this->Last_Date_Check);
						$doc->exportField($this->remarks);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->Current_Location);
						$doc->exportField($this->status);
						$doc->exportField($this->pullout_date);
					} else {
						$doc->exportField($this->inventory_id);
						$doc->exportField($this->concat_inventory);
						$doc->exportField($this->Month_Purchased);
						$doc->exportField($this->Year_Purchased);
						$doc->exportField($this->item_type);
						$doc->exportField($this->item_model);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->office_id);
						$doc->exportField($this->Region);
						$doc->exportField($this->Province);
						$doc->exportField($this->Cities);
						$doc->exportField($this->name_accountable);
						$doc->exportField($this->Designation);
						$doc->exportField($this->Last_Date_Check);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->item_id);
						$doc->exportField($this->pullout_i);
						$doc->exportField($this->Current_Location);
						$doc->exportField($this->status);
						$doc->exportField($this->pullout_date);
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