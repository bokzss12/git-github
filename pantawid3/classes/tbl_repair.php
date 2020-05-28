<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for tbl_repair
 */
class tbl_repair extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $repair_id;
	public $inventory_id;
	public $current_loc_r;
	public $inventory_idr;
	public $date_received;
	public $date_repaired;
	public $date_pullout;
	public $name_accountable;
	public $Designation;
	public $office_id;
	public $region;
	public $province;
	public $city;
	public $itemtype;
	public $itemmodel;
	public $item_serial;
	public $type_problem;
	public $action_taken;
	public $employee_id;
	public $status_h;
	public $pullout_r;
	public $remark;
	public $userlastmodify;
	public $datelastmodify;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_repair';
		$this->TableName = 'tbl_repair';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_repair`";
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

		// repair_id
		$this->repair_id = new DbField('tbl_repair', 'tbl_repair', 'x_repair_id', 'repair_id', '`repair_id`', '`repair_id`', 3, 11, -1, FALSE, '`repair_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->repair_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->repair_id->IsPrimaryKey = TRUE; // Primary key field
		$this->repair_id->Sortable = TRUE; // Allow sort
		$this->repair_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->repair_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->repair_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['repair_id'] = &$this->repair_id;

		// inventory_id
		$this->inventory_id = new DbField('tbl_repair', 'tbl_repair', 'x_inventory_id', 'inventory_id', '`inventory_id`', '`inventory_id`', 200, 255, -1, FALSE, '`inventory_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inventory_id->IsForeignKey = TRUE; // Foreign key field
		$this->inventory_id->Sortable = FALSE; // Allow sort
		$this->fields['inventory_id'] = &$this->inventory_id;

		// current_loc_r
		$this->current_loc_r = new DbField('tbl_repair', 'tbl_repair', 'x_current_loc_r', 'current_loc_r', '`current_loc_r`', '`current_loc_r`', 200, 255, -1, FALSE, '`current_loc_r`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->current_loc_r->IsForeignKey = TRUE; // Foreign key field
		$this->current_loc_r->Sortable = TRUE; // Allow sort
		$this->current_loc_r->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->current_loc_r->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->current_loc_r->Lookup = new Lookup('current_loc_r', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
			default:
				$this->current_loc_r->Lookup = new Lookup('current_loc_r', 'tbl_off', FALSE, 'off_id', ["off_desc","","",""], [], [], [], [], [], [], '`off_desc` ASC', '');
				break;
		}
		$this->fields['current_loc_r'] = &$this->current_loc_r;

		// inventory_idr
		$this->inventory_idr = new DbField('tbl_repair', 'tbl_repair', 'x_inventory_idr', 'inventory_idr', '`inventory_idr`', '`inventory_idr`', 3, 11, -1, FALSE, '`inventory_idr`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inventory_idr->IsForeignKey = TRUE; // Foreign key field
		$this->inventory_idr->Sortable = TRUE; // Allow sort
		$this->inventory_idr->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['inventory_idr'] = &$this->inventory_idr;

		// date_received
		$this->date_received = new DbField('tbl_repair', 'tbl_repair', 'x_date_received', 'date_received', '`date_received`', CastDateFieldForLike("`date_received`", 0, "DB"), 133, 10, 0, FALSE, '`date_received`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_received->IsForeignKey = TRUE; // Foreign key field
		$this->date_received->Required = TRUE; // Required field
		$this->date_received->Sortable = TRUE; // Allow sort
		$this->date_received->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_received'] = &$this->date_received;

		// date_repaired
		$this->date_repaired = new DbField('tbl_repair', 'tbl_repair', 'x_date_repaired', 'date_repaired', '`date_repaired`', CastDateFieldForLike("`date_repaired`", 0, "DB"), 133, 10, 0, FALSE, '`date_repaired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_repaired->Required = TRUE; // Required field
		$this->date_repaired->Sortable = TRUE; // Allow sort
		$this->date_repaired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_repaired'] = &$this->date_repaired;

		// date_pullout
		$this->date_pullout = new DbField('tbl_repair', 'tbl_repair', 'x_date_pullout', 'date_pullout', '`date_pullout`', CastDateFieldForLike("`date_pullout`", 0, "DB"), 133, 10, -1, FALSE, '`date_pullout`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_pullout->Sortable = FALSE; // Allow sort
		$this->date_pullout->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['date_pullout'] = &$this->date_pullout;

		// name_accountable
		$this->name_accountable = new DbField('tbl_repair', 'tbl_repair', 'x_name_accountable', 'name_accountable', '`name_accountable`', '`name_accountable`', 3, 11, -1, FALSE, '`name_accountable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->name_accountable->IsForeignKey = TRUE; // Foreign key field
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
		$this->Designation = new DbField('tbl_repair', 'tbl_repair', 'x_Designation', 'Designation', '`Designation`', '`Designation`', 3, 11, -1, FALSE, '`Designation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Designation->IsForeignKey = TRUE; // Foreign key field
		$this->Designation->Sortable = TRUE; // Allow sort
		$this->Designation->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Designation->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Designation->Lookup = new Lookup('Designation', 'tbl_pos', FALSE, 'pos_id', ["pos_desc","","",""], [], [], [], [], [], [], '`pos_desc` ASC', '');
				break;
			default:
				$this->Designation->Lookup = new Lookup('Designation', 'tbl_pos', FALSE, 'pos_id', ["pos_desc","","",""], [], [], [], [], [], [], '`pos_desc` ASC', '');
				break;
		}
		$this->Designation->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Designation'] = &$this->Designation;

		// office_id
		$this->office_id = new DbField('tbl_repair', 'tbl_repair', 'x_office_id', 'office_id', '`office_id`', '`office_id`', 3, 11, -1, FALSE, '`office_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->office_id->IsForeignKey = TRUE; // Foreign key field
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

		// region
		$this->region = new DbField('tbl_repair', 'tbl_repair', 'x_region', 'region', '`region`', '`region`', 3, 11, -1, FALSE, '`region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->region->IsForeignKey = TRUE; // Foreign key field
		$this->region->Sortable = TRUE; // Allow sort
		$this->region->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->region->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->region->Lookup = new Lookup('region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], ["x_province"], [], [], [], [], '', '');
				break;
			default:
				$this->region->Lookup = new Lookup('region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], ["x_province"], [], [], [], [], '', '');
				break;
		}
		$this->region->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['region'] = &$this->region;

		// province
		$this->province = new DbField('tbl_repair', 'tbl_repair', 'x_province', 'province', '`province`', '`province`', 3, 11, -1, FALSE, '`province`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->province->IsForeignKey = TRUE; // Foreign key field
		$this->province->Sortable = TRUE; // Allow sort
		$this->province->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->province->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->province->Lookup = new Lookup('province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], ["x_region"], ["x_city"], ["region_code"], ["x_region_code"], [], [], '', '');
				break;
			default:
				$this->province->Lookup = new Lookup('province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], ["x_region"], ["x_city"], ["region_code"], ["x_region_code"], [], [], '', '');
				break;
		}
		$this->province->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['province'] = &$this->province;

		// city
		$this->city = new DbField('tbl_repair', 'tbl_repair', 'x_city', 'city', '`city`', '`city`', 3, 11, -1, FALSE, '`city`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->city->IsForeignKey = TRUE; // Foreign key field
		$this->city->Sortable = TRUE; // Allow sort
		$this->city->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->city->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->city->Lookup = new Lookup('city', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], ["x_province"], [], ["prov_code"], ["x_prov_code"], [], [], '', '');
				break;
			default:
				$this->city->Lookup = new Lookup('city', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], ["x_province"], [], ["prov_code"], ["x_prov_code"], [], [], '', '');
				break;
		}
		$this->city->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['city'] = &$this->city;

		// itemtype
		$this->itemtype = new DbField('tbl_repair', 'tbl_repair', 'x_itemtype', 'itemtype', '`itemtype`', '`itemtype`', 3, 11, -1, FALSE, '`itemtype`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->itemtype->IsForeignKey = TRUE; // Foreign key field
		$this->itemtype->Sortable = TRUE; // Allow sort
		$this->itemtype->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->itemtype->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->itemtype->Lookup = new Lookup('itemtype', 'tbl_cat', FALSE, 'cat_id', ["cat_desc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->itemtype->Lookup = new Lookup('itemtype', 'tbl_cat', FALSE, 'cat_id', ["cat_desc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['itemtype'] = &$this->itemtype;

		// itemmodel
		$this->itemmodel = new DbField('tbl_repair', 'tbl_repair', 'x_itemmodel', 'itemmodel', '`itemmodel`', '`itemmodel`', 200, 255, -1, FALSE, '`itemmodel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->itemmodel->IsForeignKey = TRUE; // Foreign key field
		$this->itemmodel->Sortable = TRUE; // Allow sort
		$this->fields['itemmodel'] = &$this->itemmodel;

		// item_serial
		$this->item_serial = new DbField('tbl_repair', 'tbl_repair', 'x_item_serial', 'item_serial', '`item_serial`', '`item_serial`', 200, 255, -1, FALSE, '`item_serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serial->IsForeignKey = TRUE; // Foreign key field
		$this->item_serial->Sortable = TRUE; // Allow sort
		$this->fields['item_serial'] = &$this->item_serial;

		// type_problem
		$this->type_problem = new DbField('tbl_repair', 'tbl_repair', 'x_type_problem', 'type_problem', '`type_problem`', '`type_problem`', 200, 255, -1, FALSE, '`type_problem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->type_problem->Sortable = TRUE; // Allow sort
		$this->fields['type_problem'] = &$this->type_problem;

		// action_taken
		$this->action_taken = new DbField('tbl_repair', 'tbl_repair', 'x_action_taken', 'action_taken', '`action_taken`', '`action_taken`', 200, 255, -1, FALSE, '`action_taken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->action_taken->Sortable = TRUE; // Allow sort
		$this->fields['action_taken'] = &$this->action_taken;

		// employee_id
		$this->employee_id = new DbField('tbl_repair', 'tbl_repair', 'x_employee_id', 'employee_id', '`employee_id`', '`employee_id`', 3, 255, -1, FALSE, '`employee_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employee_id->Required = TRUE; // Required field
		$this->employee_id->Sortable = TRUE; // Allow sort
		$this->employee_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employee_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->employee_id->OptionCount = 2;
		$this->fields['employee_id'] = &$this->employee_id;

		// status_h
		$this->status_h = new DbField('tbl_repair', 'tbl_repair', 'x_status_h', 'status_h', '`status_h`', '`status_h`', 3, 11, -1, FALSE, '`status_h`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status_h->Required = TRUE; // Required field
		$this->status_h->Sortable = TRUE; // Allow sort
		$this->status_h->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status_h->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status_h->Lookup = new Lookup('status_h', 'tbl_inventory_status', FALSE, 'inventory_status_id', ["inventory_status_id","inventory_status_dsc","",""], [], [], [], [], [], [], '`inventory_status_id` ASC', '');
				break;
			default:
				$this->status_h->Lookup = new Lookup('status_h', 'tbl_inventory_status', FALSE, 'inventory_status_id', ["inventory_status_id","inventory_status_dsc","",""], [], [], [], [], [], [], '`inventory_status_id` ASC', '');
				break;
		}
		$this->status_h->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status_h'] = &$this->status_h;

		// pullout_r
		$this->pullout_r = new DbField('tbl_repair', 'tbl_repair', 'x_pullout_r', 'pullout_r', '`pullout_r`', '`pullout_r`', 200, 255, -1, FALSE, '`pullout_r`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pullout_r->Sortable = TRUE; // Allow sort
		$this->pullout_r->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pullout_r->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->pullout_r->Lookup = new Lookup('pullout_r', 'tbl_repair', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->pullout_r->Lookup = new Lookup('pullout_r', 'tbl_repair', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->pullout_r->OptionCount = 1;
		$this->fields['pullout_r'] = &$this->pullout_r;

		// remark
		$this->remark = new DbField('tbl_repair', 'tbl_repair', 'x_remark', 'remark', '`remark`', '`remark`', 200, 255, -1, FALSE, '`remark`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remark->Sortable = TRUE; // Allow sort
		$this->fields['remark'] = &$this->remark;

		// userlastmodify
		$this->userlastmodify = new DbField('tbl_repair', 'tbl_repair', 'x_userlastmodify', 'userlastmodify', '`userlastmodify`', '`userlastmodify`', 200, 50, -1, FALSE, '`userlastmodify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->userlastmodify->Sortable = TRUE; // Allow sort
		$this->fields['userlastmodify'] = &$this->userlastmodify;

		// datelastmodify
		$this->datelastmodify = new DbField('tbl_repair', 'tbl_repair', 'x_datelastmodify', 'datelastmodify', '`datelastmodify`', CastDateFieldForLike("`datelastmodify`", 1, "DB"), 135, 19, 1, FALSE, '`datelastmodify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->datelastmodify->Sortable = TRUE; // Allow sort
		$this->datelastmodify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['datelastmodify'] = &$this->datelastmodify;
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

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "tbl_inventory") {
			if ($this->itemtype->getSessionValue() != "")
				$masterFilter .= "`item_type`=" . QuotedValue($this->itemtype->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->itemmodel->getSessionValue() != "")
				$masterFilter .= " AND `item_model`=" . QuotedValue($this->itemmodel->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->item_serial->getSessionValue() != "")
				$masterFilter .= " AND `item_serial`=" . QuotedValue($this->item_serial->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->office_id->getSessionValue() != "")
				$masterFilter .= " AND `office_id`=" . QuotedValue($this->office_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->name_accountable->getSessionValue() != "")
				$masterFilter .= " AND `name_accountable`=" . QuotedValue($this->name_accountable->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->Designation->getSessionValue() != "")
				$masterFilter .= " AND `Designation`=" . QuotedValue($this->Designation->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->region->getSessionValue() != "")
				$masterFilter .= " AND `Region`=" . QuotedValue($this->region->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->province->getSessionValue() != "")
				$masterFilter .= " AND `Province`=" . QuotedValue($this->province->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->city->getSessionValue() != "")
				$masterFilter .= " AND `Cities`=" . QuotedValue($this->city->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->inventory_id->getSessionValue() != "")
				$masterFilter .= " AND concat('INV-R6',inventory_id)=" . QuotedValue($this->inventory_id->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->inventory_idr->getSessionValue() != "")
				$masterFilter .= " AND `inventory_id`=" . QuotedValue($this->inventory_idr->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->current_loc_r->getSessionValue() != "")
				$masterFilter .= " AND `Current_Location`=" . QuotedValue($this->current_loc_r->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->date_received->getSessionValue() != "")
				$masterFilter .= " AND `Last_Date_Check`=" . QuotedValue($this->date_received->getSessionValue(), DATATYPE_DATE, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "tbl_inventory") {
			if ($this->itemtype->getSessionValue() != "")
				$detailFilter .= "`itemtype`=" . QuotedValue($this->itemtype->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->itemmodel->getSessionValue() != "")
				$detailFilter .= " AND `itemmodel`=" . QuotedValue($this->itemmodel->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->item_serial->getSessionValue() != "")
				$detailFilter .= " AND `item_serial`=" . QuotedValue($this->item_serial->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->office_id->getSessionValue() != "")
				$detailFilter .= " AND `office_id`=" . QuotedValue($this->office_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->name_accountable->getSessionValue() != "")
				$detailFilter .= " AND `name_accountable`=" . QuotedValue($this->name_accountable->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->Designation->getSessionValue() != "")
				$detailFilter .= " AND `Designation`=" . QuotedValue($this->Designation->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->region->getSessionValue() != "")
				$detailFilter .= " AND `region`=" . QuotedValue($this->region->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->province->getSessionValue() != "")
				$detailFilter .= " AND `province`=" . QuotedValue($this->province->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->city->getSessionValue() != "")
				$detailFilter .= " AND `city`=" . QuotedValue($this->city->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->inventory_id->getSessionValue() != "")
				$detailFilter .= " AND `inventory_id`=" . QuotedValue($this->inventory_id->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->inventory_idr->getSessionValue() != "")
				$detailFilter .= " AND `inventory_idr`=" . QuotedValue($this->inventory_idr->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->current_loc_r->getSessionValue() != "")
				$detailFilter .= " AND `current_loc_r`=" . QuotedValue($this->current_loc_r->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
			if ($this->date_received->getSessionValue() != "")
				$detailFilter .= " AND `date_received`=" . QuotedValue($this->date_received->getSessionValue(), DATATYPE_DATE, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_tbl_inventory()
	{
		return "`item_type`=@item_type@ AND `item_model`='@item_model@' AND `item_serial`='@item_serial@' AND `office_id`=@office_id@ AND `name_accountable`=@name_accountable@ AND `Designation`=@Designation@ AND `Region`=@Region@ AND `Province`=@Province@ AND `Cities`=@Cities@ AND concat('INV-R6',inventory_id)='@concat_inventory@' AND `inventory_id`=@inventory_id@ AND `Current_Location`=@Current_Location@ AND `Last_Date_Check`='@Last_Date_Check@'";
	}

	// Detail filter
	public function sqlDetailFilter_tbl_inventory()
	{
		return "`itemtype`=@itemtype@ AND `itemmodel`='@itemmodel@' AND `item_serial`='@item_serial@' AND `office_id`=@office_id@ AND `name_accountable`=@name_accountable@ AND `Designation`=@Designation@ AND `region`=@region@ AND `province`=@province@ AND `city`=@city@ AND `inventory_id`='@inventory_id@' AND `inventory_idr`=@inventory_idr@ AND `current_loc_r`='@current_loc_r@' AND `date_received`='@date_received@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`tbl_repair`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`repair_id` DESC";
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
			$this->repair_id->setDbValue($conn->insert_ID());
			$rs['repair_id'] = $this->repair_id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'repair_id';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('repair_id', $rs))
				AddFilter($where, QuotedName('repair_id', $this->Dbid) . '=' . QuotedValue($rs['repair_id'], $this->repair_id->DataType, $this->Dbid));
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
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->repair_id->DbValue = $row['repair_id'];
		$this->inventory_id->DbValue = $row['inventory_id'];
		$this->current_loc_r->DbValue = $row['current_loc_r'];
		$this->inventory_idr->DbValue = $row['inventory_idr'];
		$this->date_received->DbValue = $row['date_received'];
		$this->date_repaired->DbValue = $row['date_repaired'];
		$this->date_pullout->DbValue = $row['date_pullout'];
		$this->name_accountable->DbValue = $row['name_accountable'];
		$this->Designation->DbValue = $row['Designation'];
		$this->office_id->DbValue = $row['office_id'];
		$this->region->DbValue = $row['region'];
		$this->province->DbValue = $row['province'];
		$this->city->DbValue = $row['city'];
		$this->itemtype->DbValue = $row['itemtype'];
		$this->itemmodel->DbValue = $row['itemmodel'];
		$this->item_serial->DbValue = $row['item_serial'];
		$this->type_problem->DbValue = $row['type_problem'];
		$this->action_taken->DbValue = $row['action_taken'];
		$this->employee_id->DbValue = $row['employee_id'];
		$this->status_h->DbValue = $row['status_h'];
		$this->pullout_r->DbValue = $row['pullout_r'];
		$this->remark->DbValue = $row['remark'];
		$this->userlastmodify->DbValue = $row['userlastmodify'];
		$this->datelastmodify->DbValue = $row['datelastmodify'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`repair_id` = @repair_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('repair_id', $row) ? $row['repair_id'] : NULL;
		else
			$val = $this->repair_id->OldValue !== NULL ? $this->repair_id->OldValue : $this->repair_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@repair_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_repairlist.php";
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
		if ($pageName == "tbl_repairview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_repairedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_repairadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_repairlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tbl_repairview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_repairview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "tbl_repairadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_repairadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_repairedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("tbl_repairadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("tbl_repairdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "tbl_inventory" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_item_type=" . urlencode($this->itemtype->CurrentValue);
			$url .= "&fk_item_model=" . urlencode($this->itemmodel->CurrentValue);
			$url .= "&fk_item_serial=" . urlencode($this->item_serial->CurrentValue);
			$url .= "&fk_office_id=" . urlencode($this->office_id->CurrentValue);
			$url .= "&fk_name_accountable=" . urlencode($this->name_accountable->CurrentValue);
			$url .= "&fk_Designation=" . urlencode($this->Designation->CurrentValue);
			$url .= "&fk_Region=" . urlencode($this->region->CurrentValue);
			$url .= "&fk_Province=" . urlencode($this->province->CurrentValue);
			$url .= "&fk_Cities=" . urlencode($this->city->CurrentValue);
			$url .= "&fk_concat_inventory=" . urlencode($this->inventory_id->CurrentValue);
			$url .= "&fk_inventory_id=" . urlencode($this->inventory_idr->CurrentValue);
			$url .= "&fk_Current_Location=" . urlencode($this->current_loc_r->CurrentValue);
			$url .= "&fk_Last_Date_Check=" . urlencode(UnFormatDateTime($this->date_received->CurrentValue,0));
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "repair_id:" . JsonEncode($this->repair_id->CurrentValue, "number");
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
		if ($this->repair_id->CurrentValue != NULL) {
			$url .= "repair_id=" . urlencode($this->repair_id->CurrentValue);
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
			if (Param("repair_id") !== NULL)
				$arKeys[] = Param("repair_id");
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
				$this->repair_id->CurrentValue = $key;
			else
				$this->repair_id->OldValue = $key;
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
		$this->repair_id->setDbValue($rs->fields('repair_id'));
		$this->inventory_id->setDbValue($rs->fields('inventory_id'));
		$this->current_loc_r->setDbValue($rs->fields('current_loc_r'));
		$this->inventory_idr->setDbValue($rs->fields('inventory_idr'));
		$this->date_received->setDbValue($rs->fields('date_received'));
		$this->date_repaired->setDbValue($rs->fields('date_repaired'));
		$this->date_pullout->setDbValue($rs->fields('date_pullout'));
		$this->name_accountable->setDbValue($rs->fields('name_accountable'));
		$this->Designation->setDbValue($rs->fields('Designation'));
		$this->office_id->setDbValue($rs->fields('office_id'));
		$this->region->setDbValue($rs->fields('region'));
		$this->province->setDbValue($rs->fields('province'));
		$this->city->setDbValue($rs->fields('city'));
		$this->itemtype->setDbValue($rs->fields('itemtype'));
		$this->itemmodel->setDbValue($rs->fields('itemmodel'));
		$this->item_serial->setDbValue($rs->fields('item_serial'));
		$this->type_problem->setDbValue($rs->fields('type_problem'));
		$this->action_taken->setDbValue($rs->fields('action_taken'));
		$this->employee_id->setDbValue($rs->fields('employee_id'));
		$this->status_h->setDbValue($rs->fields('status_h'));
		$this->pullout_r->setDbValue($rs->fields('pullout_r'));
		$this->remark->setDbValue($rs->fields('remark'));
		$this->userlastmodify->setDbValue($rs->fields('userlastmodify'));
		$this->datelastmodify->setDbValue($rs->fields('datelastmodify'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// repair_id
		// inventory_id
		// current_loc_r
		// inventory_idr
		// date_received
		// date_repaired
		// date_pullout
		// name_accountable
		// Designation
		// office_id
		// region
		// province
		// city
		// itemtype
		// itemmodel
		// item_serial
		// type_problem
		// action_taken
		// employee_id
		// status_h
		// pullout_r
		// remark
		// userlastmodify
		// datelastmodify
		// repair_id

		$this->repair_id->ViewCustomAttributes = "";

		// inventory_id
		$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
		$this->inventory_id->ViewCustomAttributes = "";

		// current_loc_r
		$curVal = strval($this->current_loc_r->CurrentValue);
		if ($curVal != "") {
			$this->current_loc_r->ViewValue = $this->current_loc_r->lookupCacheOption($curVal);
			if ($this->current_loc_r->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`off_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->current_loc_r->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->current_loc_r->ViewValue = $this->current_loc_r->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->current_loc_r->ViewValue = $this->current_loc_r->CurrentValue;
				}
			}
		} else {
			$this->current_loc_r->ViewValue = NULL;
		}
		$this->current_loc_r->ViewCustomAttributes = "";

		// inventory_idr
		$this->inventory_idr->ViewValue = $this->inventory_idr->CurrentValue;
		$this->inventory_idr->ViewValue = FormatNumber($this->inventory_idr->ViewValue, 0, -2, -2, -2);
		$this->inventory_idr->ViewCustomAttributes = "";

		// date_received
		$this->date_received->ViewValue = $this->date_received->CurrentValue;
		$this->date_received->ViewValue = FormatDateTime($this->date_received->ViewValue, 0);
		$this->date_received->ViewCustomAttributes = "";

		// date_repaired
		$this->date_repaired->ViewValue = $this->date_repaired->CurrentValue;
		$this->date_repaired->ViewValue = FormatDateTime($this->date_repaired->ViewValue, 0);
		$this->date_repaired->ViewCustomAttributes = "";

		// date_pullout
		$this->date_pullout->ViewValue = $this->date_pullout->CurrentValue;
		$this->date_pullout->ViewCustomAttributes = "";

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

		// region
		$curVal = strval($this->region->CurrentValue);
		if ($curVal != "") {
			$this->region->ViewValue = $this->region->lookupCacheOption($curVal);
			if ($this->region->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`region_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "region_name = 'REGION VI [Western Visayas]'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->region->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->region->ViewValue = $this->region->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->region->ViewValue = $this->region->CurrentValue;
				}
			}
		} else {
			$this->region->ViewValue = NULL;
		}
		$this->region->ViewCustomAttributes = "";

		// province
		$curVal = strval($this->province->CurrentValue);
		if ($curVal != "") {
			$this->province->ViewValue = $this->province->lookupCacheOption($curVal);
			if ($this->province->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`prov_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->province->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->province->ViewValue = $this->province->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->province->ViewValue = $this->province->CurrentValue;
				}
			}
		} else {
			$this->province->ViewValue = NULL;
		}
		$this->province->ViewCustomAttributes = "";

		// city
		$curVal = strval($this->city->CurrentValue);
		if ($curVal != "") {
			$this->city->ViewValue = $this->city->lookupCacheOption($curVal);
			if ($this->city->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`city_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->city->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->city->ViewValue = $this->city->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->city->ViewValue = $this->city->CurrentValue;
				}
			}
		} else {
			$this->city->ViewValue = NULL;
		}
		$this->city->ViewCustomAttributes = "";

		// itemtype
		$curVal = strval($this->itemtype->CurrentValue);
		if ($curVal != "") {
			$this->itemtype->ViewValue = $this->itemtype->lookupCacheOption($curVal);
			if ($this->itemtype->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`cat_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->itemtype->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->itemtype->ViewValue = $this->itemtype->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->itemtype->ViewValue = $this->itemtype->CurrentValue;
				}
			}
		} else {
			$this->itemtype->ViewValue = NULL;
		}
		$this->itemtype->ViewCustomAttributes = "";

		// itemmodel
		$this->itemmodel->ViewValue = $this->itemmodel->CurrentValue;
		$this->itemmodel->ViewCustomAttributes = "";

		// item_serial
		$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
		$this->item_serial->ViewCustomAttributes = "";

		// type_problem
		$this->type_problem->ViewValue = $this->type_problem->CurrentValue;
		$this->type_problem->ViewCustomAttributes = "";

		// action_taken
		$this->action_taken->ViewValue = $this->action_taken->CurrentValue;
		$this->action_taken->ViewCustomAttributes = "";

		// employee_id
		if (strval($this->employee_id->CurrentValue) != "") {
			$this->employee_id->ViewValue = $this->employee_id->optionCaption($this->employee_id->CurrentValue);
		} else {
			$this->employee_id->ViewValue = NULL;
		}
		$this->employee_id->ViewCustomAttributes = "";

		// status_h
		$curVal = strval($this->status_h->CurrentValue);
		if ($curVal != "") {
			$this->status_h->ViewValue = $this->status_h->lookupCacheOption($curVal);
			if ($this->status_h->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`inventory_status_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`inventory_status_id` in(1,2,6,7,10)";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->status_h->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->status_h->ViewValue = $this->status_h->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status_h->ViewValue = $this->status_h->CurrentValue;
				}
			}
		} else {
			$this->status_h->ViewValue = NULL;
		}
		$this->status_h->ViewCustomAttributes = "";

		// pullout_r
		if (strval($this->pullout_r->CurrentValue) != "") {
			$this->pullout_r->ViewValue = $this->pullout_r->optionCaption($this->pullout_r->CurrentValue);
		} else {
			$this->pullout_r->ViewValue = NULL;
		}
		$this->pullout_r->ViewCustomAttributes = "";

		// remark
		$this->remark->ViewValue = $this->remark->CurrentValue;
		$this->remark->ViewCustomAttributes = "";

		// userlastmodify
		$this->userlastmodify->ViewValue = $this->userlastmodify->CurrentValue;
		$this->userlastmodify->ViewCustomAttributes = "";

		// datelastmodify
		$this->datelastmodify->ViewValue = $this->datelastmodify->CurrentValue;
		$this->datelastmodify->ViewValue = FormatDateTime($this->datelastmodify->ViewValue, 1);
		$this->datelastmodify->ViewCustomAttributes = "";

		// repair_id
		$this->repair_id->LinkCustomAttributes = "";
		$this->repair_id->HrefValue = "";
		$this->repair_id->TooltipValue = "";

		// inventory_id
		$this->inventory_id->LinkCustomAttributes = "";
		$this->inventory_id->HrefValue = "";
		$this->inventory_id->TooltipValue = "";

		// current_loc_r
		$this->current_loc_r->LinkCustomAttributes = "";
		$this->current_loc_r->HrefValue = "";
		$this->current_loc_r->TooltipValue = "";

		// inventory_idr
		$this->inventory_idr->LinkCustomAttributes = "";
		$this->inventory_idr->HrefValue = "";
		$this->inventory_idr->TooltipValue = "";

		// date_received
		$this->date_received->LinkCustomAttributes = "";
		$this->date_received->HrefValue = "";
		$this->date_received->TooltipValue = "";

		// date_repaired
		$this->date_repaired->LinkCustomAttributes = "";
		$this->date_repaired->HrefValue = "";
		$this->date_repaired->TooltipValue = "";

		// date_pullout
		$this->date_pullout->LinkCustomAttributes = "";
		$this->date_pullout->HrefValue = "";
		$this->date_pullout->TooltipValue = "";

		// name_accountable
		$this->name_accountable->LinkCustomAttributes = "";
		$this->name_accountable->HrefValue = "";
		$this->name_accountable->TooltipValue = "";

		// Designation
		$this->Designation->LinkCustomAttributes = "";
		$this->Designation->HrefValue = "";
		$this->Designation->TooltipValue = "";

		// office_id
		$this->office_id->LinkCustomAttributes = "";
		$this->office_id->HrefValue = "";
		$this->office_id->TooltipValue = "";

		// region
		$this->region->LinkCustomAttributes = "";
		$this->region->HrefValue = "";
		$this->region->TooltipValue = "";

		// province
		$this->province->LinkCustomAttributes = "";
		$this->province->HrefValue = "";
		$this->province->TooltipValue = "";

		// city
		$this->city->LinkCustomAttributes = "";
		$this->city->HrefValue = "";
		$this->city->TooltipValue = "";

		// itemtype
		$this->itemtype->LinkCustomAttributes = "";
		$this->itemtype->HrefValue = "";
		$this->itemtype->TooltipValue = "";

		// itemmodel
		$this->itemmodel->LinkCustomAttributes = "";
		$this->itemmodel->HrefValue = "";
		$this->itemmodel->TooltipValue = "";

		// item_serial
		$this->item_serial->LinkCustomAttributes = "";
		$this->item_serial->HrefValue = "";
		$this->item_serial->TooltipValue = "";

		// type_problem
		$this->type_problem->LinkCustomAttributes = "";
		$this->type_problem->HrefValue = "";
		$this->type_problem->TooltipValue = "";

		// action_taken
		$this->action_taken->LinkCustomAttributes = "";
		$this->action_taken->HrefValue = "";
		$this->action_taken->TooltipValue = "";

		// employee_id
		$this->employee_id->LinkCustomAttributes = "";
		$this->employee_id->HrefValue = "";
		$this->employee_id->TooltipValue = "";

		// status_h
		$this->status_h->LinkCustomAttributes = "";
		$this->status_h->HrefValue = "";
		$this->status_h->TooltipValue = "";

		// pullout_r
		$this->pullout_r->LinkCustomAttributes = "";
		$this->pullout_r->HrefValue = "";
		$this->pullout_r->TooltipValue = "";

		// remark
		$this->remark->LinkCustomAttributes = "";
		$this->remark->HrefValue = "";
		$this->remark->TooltipValue = "";

		// userlastmodify
		$this->userlastmodify->LinkCustomAttributes = "";
		$this->userlastmodify->HrefValue = "";
		$this->userlastmodify->TooltipValue = "";

		// datelastmodify
		$this->datelastmodify->LinkCustomAttributes = "";
		$this->datelastmodify->HrefValue = "";
		$this->datelastmodify->TooltipValue = "";

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

		// repair_id
		$this->repair_id->EditAttrs["class"] = "form-control";
		$this->repair_id->EditCustomAttributes = "";
		$this->repair_id->ViewCustomAttributes = "";

		// inventory_id
		$this->inventory_id->EditAttrs["class"] = "form-control";
		$this->inventory_id->EditCustomAttributes = "";
		if ($this->inventory_id->getSessionValue() != "") {
			$this->inventory_id->CurrentValue = $this->inventory_id->getSessionValue();
			$this->inventory_id->ViewValue = $this->inventory_id->CurrentValue;
			$this->inventory_id->ViewCustomAttributes = "";
		} else {
			if (!$this->inventory_id->Raw)
				$this->inventory_id->CurrentValue = HtmlDecode($this->inventory_id->CurrentValue);
			$this->inventory_id->EditValue = $this->inventory_id->CurrentValue;
			$this->inventory_id->PlaceHolder = RemoveHtml($this->inventory_id->caption());
		}

		// current_loc_r
		$this->current_loc_r->EditAttrs["class"] = "form-control";
		$this->current_loc_r->EditCustomAttributes = "";
		if ($this->current_loc_r->getSessionValue() != "") {
			$this->current_loc_r->CurrentValue = $this->current_loc_r->getSessionValue();
			$curVal = strval($this->current_loc_r->CurrentValue);
			if ($curVal != "") {
				$this->current_loc_r->ViewValue = $this->current_loc_r->lookupCacheOption($curVal);
				if ($this->current_loc_r->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`off_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->current_loc_r->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->current_loc_r->ViewValue = $this->current_loc_r->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->current_loc_r->ViewValue = $this->current_loc_r->CurrentValue;
					}
				}
			} else {
				$this->current_loc_r->ViewValue = NULL;
			}
			$this->current_loc_r->ViewCustomAttributes = "";
		} else {
		}

		// inventory_idr
		$this->inventory_idr->EditAttrs["class"] = "form-control";
		$this->inventory_idr->EditCustomAttributes = "";
		if ($this->inventory_idr->getSessionValue() != "") {
			$this->inventory_idr->CurrentValue = $this->inventory_idr->getSessionValue();
			$this->inventory_idr->ViewValue = $this->inventory_idr->CurrentValue;
			$this->inventory_idr->ViewValue = FormatNumber($this->inventory_idr->ViewValue, 0, -2, -2, -2);
			$this->inventory_idr->ViewCustomAttributes = "";
		} else {
			$this->inventory_idr->EditValue = $this->inventory_idr->CurrentValue;
			$this->inventory_idr->PlaceHolder = RemoveHtml($this->inventory_idr->caption());
		}

		// date_received
		$this->date_received->EditAttrs["class"] = "form-control";
		$this->date_received->EditCustomAttributes = "";
		if ($this->date_received->getSessionValue() != "") {
			$this->date_received->CurrentValue = $this->date_received->getSessionValue();
			$this->date_received->ViewValue = $this->date_received->CurrentValue;
			$this->date_received->ViewValue = FormatDateTime($this->date_received->ViewValue, 0);
			$this->date_received->ViewCustomAttributes = "";
		} else {
			$this->date_received->EditValue = FormatDateTime($this->date_received->CurrentValue, 8);
			$this->date_received->PlaceHolder = RemoveHtml($this->date_received->caption());
		}

		// date_repaired
		$this->date_repaired->EditAttrs["class"] = "form-control";
		$this->date_repaired->EditCustomAttributes = "";
		$this->date_repaired->EditValue = FormatDateTime($this->date_repaired->CurrentValue, 8);
		$this->date_repaired->PlaceHolder = RemoveHtml($this->date_repaired->caption());

		// date_pullout
		$this->date_pullout->EditAttrs["class"] = "form-control";
		$this->date_pullout->EditCustomAttributes = "";
		$this->date_pullout->EditValue = $this->date_pullout->CurrentValue;
		$this->date_pullout->PlaceHolder = RemoveHtml($this->date_pullout->caption());

		// name_accountable
		$this->name_accountable->EditAttrs["class"] = "form-control";
		$this->name_accountable->EditCustomAttributes = "";
		if ($this->name_accountable->getSessionValue() != "") {
			$this->name_accountable->CurrentValue = $this->name_accountable->getSessionValue();
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
		} else {
		}

		// Designation
		$this->Designation->EditAttrs["class"] = "form-control";
		$this->Designation->EditCustomAttributes = "";
		if ($this->Designation->getSessionValue() != "") {
			$this->Designation->CurrentValue = $this->Designation->getSessionValue();
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
		} else {
		}

		// office_id
		$this->office_id->EditAttrs["class"] = "form-control";
		$this->office_id->EditCustomAttributes = "";
		if ($this->office_id->getSessionValue() != "") {
			$this->office_id->CurrentValue = $this->office_id->getSessionValue();
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
		} else {
		}

		// region
		$this->region->EditAttrs["class"] = "form-control";
		$this->region->EditCustomAttributes = "";
		if ($this->region->getSessionValue() != "") {
			$this->region->CurrentValue = $this->region->getSessionValue();
			$curVal = strval($this->region->CurrentValue);
			if ($curVal != "") {
				$this->region->ViewValue = $this->region->lookupCacheOption($curVal);
				if ($this->region->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`region_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "region_name = 'REGION VI [Western Visayas]'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->region->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->region->ViewValue = $this->region->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->region->ViewValue = $this->region->CurrentValue;
					}
				}
			} else {
				$this->region->ViewValue = NULL;
			}
			$this->region->ViewCustomAttributes = "";
		} else {
		}

		// province
		$this->province->EditAttrs["class"] = "form-control";
		$this->province->EditCustomAttributes = "";
		if ($this->province->getSessionValue() != "") {
			$this->province->CurrentValue = $this->province->getSessionValue();
			$curVal = strval($this->province->CurrentValue);
			if ($curVal != "") {
				$this->province->ViewValue = $this->province->lookupCacheOption($curVal);
				if ($this->province->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`prov_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->province->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->province->ViewValue = $this->province->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->province->ViewValue = $this->province->CurrentValue;
					}
				}
			} else {
				$this->province->ViewValue = NULL;
			}
			$this->province->ViewCustomAttributes = "";
		} else {
		}

		// city
		$this->city->EditAttrs["class"] = "form-control";
		$this->city->EditCustomAttributes = "";
		if ($this->city->getSessionValue() != "") {
			$this->city->CurrentValue = $this->city->getSessionValue();
			$curVal = strval($this->city->CurrentValue);
			if ($curVal != "") {
				$this->city->ViewValue = $this->city->lookupCacheOption($curVal);
				if ($this->city->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`city_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->city->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->city->ViewValue = $this->city->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->city->ViewValue = $this->city->CurrentValue;
					}
				}
			} else {
				$this->city->ViewValue = NULL;
			}
			$this->city->ViewCustomAttributes = "";
		} else {
		}

		// itemtype
		$this->itemtype->EditAttrs["class"] = "form-control";
		$this->itemtype->EditCustomAttributes = "";
		if ($this->itemtype->getSessionValue() != "") {
			$this->itemtype->CurrentValue = $this->itemtype->getSessionValue();
			$curVal = strval($this->itemtype->CurrentValue);
			if ($curVal != "") {
				$this->itemtype->ViewValue = $this->itemtype->lookupCacheOption($curVal);
				if ($this->itemtype->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`cat_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->itemtype->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->itemtype->ViewValue = $this->itemtype->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->itemtype->ViewValue = $this->itemtype->CurrentValue;
					}
				}
			} else {
				$this->itemtype->ViewValue = NULL;
			}
			$this->itemtype->ViewCustomAttributes = "";
		} else {
		}

		// itemmodel
		$this->itemmodel->EditAttrs["class"] = "form-control";
		$this->itemmodel->EditCustomAttributes = "";
		if ($this->itemmodel->getSessionValue() != "") {
			$this->itemmodel->CurrentValue = $this->itemmodel->getSessionValue();
			$this->itemmodel->ViewValue = $this->itemmodel->CurrentValue;
			$this->itemmodel->ViewCustomAttributes = "";
		} else {
			if (!$this->itemmodel->Raw)
				$this->itemmodel->CurrentValue = HtmlDecode($this->itemmodel->CurrentValue);
			$this->itemmodel->EditValue = $this->itemmodel->CurrentValue;
			$this->itemmodel->PlaceHolder = RemoveHtml($this->itemmodel->caption());
		}

		// item_serial
		$this->item_serial->EditAttrs["class"] = "form-control";
		$this->item_serial->EditCustomAttributes = "";
		if ($this->item_serial->getSessionValue() != "") {
			$this->item_serial->CurrentValue = $this->item_serial->getSessionValue();
			$this->item_serial->ViewValue = $this->item_serial->CurrentValue;
			$this->item_serial->ViewCustomAttributes = "";
		} else {
			if (!$this->item_serial->Raw)
				$this->item_serial->CurrentValue = HtmlDecode($this->item_serial->CurrentValue);
			$this->item_serial->EditValue = $this->item_serial->CurrentValue;
			$this->item_serial->PlaceHolder = RemoveHtml($this->item_serial->caption());
		}

		// type_problem
		$this->type_problem->EditAttrs["class"] = "form-control";
		$this->type_problem->EditCustomAttributes = "";
		$this->type_problem->EditValue = $this->type_problem->CurrentValue;
		$this->type_problem->PlaceHolder = RemoveHtml($this->type_problem->caption());

		// action_taken
		$this->action_taken->EditAttrs["class"] = "form-control";
		$this->action_taken->EditCustomAttributes = "";
		$this->action_taken->EditValue = $this->action_taken->CurrentValue;
		$this->action_taken->PlaceHolder = RemoveHtml($this->action_taken->caption());

		// employee_id
		$this->employee_id->EditAttrs["class"] = "form-control";
		$this->employee_id->EditCustomAttributes = "";
		$this->employee_id->EditValue = $this->employee_id->options(TRUE);

		// status_h
		$this->status_h->EditAttrs["class"] = "form-control";
		$this->status_h->EditCustomAttributes = "";

		// pullout_r
		$this->pullout_r->EditAttrs["class"] = "form-control";
		$this->pullout_r->EditCustomAttributes = "";
		$this->pullout_r->EditValue = $this->pullout_r->options(TRUE);

		// remark
		$this->remark->EditAttrs["class"] = "form-control";
		$this->remark->EditCustomAttributes = "";
		$this->remark->EditValue = $this->remark->CurrentValue;
		$this->remark->PlaceHolder = RemoveHtml($this->remark->caption());

		// userlastmodify
		// datelastmodify
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
					$doc->exportCaption($this->current_loc_r);
					$doc->exportCaption($this->date_received);
					$doc->exportCaption($this->date_repaired);
					$doc->exportCaption($this->name_accountable);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->office_id);
					$doc->exportCaption($this->region);
					$doc->exportCaption($this->province);
					$doc->exportCaption($this->city);
					$doc->exportCaption($this->itemtype);
					$doc->exportCaption($this->itemmodel);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->type_problem);
					$doc->exportCaption($this->action_taken);
					$doc->exportCaption($this->employee_id);
					$doc->exportCaption($this->status_h);
					$doc->exportCaption($this->remark);
					$doc->exportCaption($this->userlastmodify);
					$doc->exportCaption($this->datelastmodify);
				} else {
					$doc->exportCaption($this->repair_id);
					$doc->exportCaption($this->inventory_id);
					$doc->exportCaption($this->current_loc_r);
					$doc->exportCaption($this->inventory_idr);
					$doc->exportCaption($this->date_received);
					$doc->exportCaption($this->date_repaired);
					$doc->exportCaption($this->name_accountable);
					$doc->exportCaption($this->Designation);
					$doc->exportCaption($this->office_id);
					$doc->exportCaption($this->region);
					$doc->exportCaption($this->province);
					$doc->exportCaption($this->city);
					$doc->exportCaption($this->itemtype);
					$doc->exportCaption($this->itemmodel);
					$doc->exportCaption($this->item_serial);
					$doc->exportCaption($this->type_problem);
					$doc->exportCaption($this->action_taken);
					$doc->exportCaption($this->employee_id);
					$doc->exportCaption($this->status_h);
					$doc->exportCaption($this->pullout_r);
					$doc->exportCaption($this->remark);
					$doc->exportCaption($this->userlastmodify);
					$doc->exportCaption($this->datelastmodify);
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
						$doc->exportField($this->current_loc_r);
						$doc->exportField($this->date_received);
						$doc->exportField($this->date_repaired);
						$doc->exportField($this->name_accountable);
						$doc->exportField($this->Designation);
						$doc->exportField($this->office_id);
						$doc->exportField($this->region);
						$doc->exportField($this->province);
						$doc->exportField($this->city);
						$doc->exportField($this->itemtype);
						$doc->exportField($this->itemmodel);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->type_problem);
						$doc->exportField($this->action_taken);
						$doc->exportField($this->employee_id);
						$doc->exportField($this->status_h);
						$doc->exportField($this->remark);
						$doc->exportField($this->userlastmodify);
						$doc->exportField($this->datelastmodify);
					} else {
						$doc->exportField($this->repair_id);
						$doc->exportField($this->inventory_id);
						$doc->exportField($this->current_loc_r);
						$doc->exportField($this->inventory_idr);
						$doc->exportField($this->date_received);
						$doc->exportField($this->date_repaired);
						$doc->exportField($this->name_accountable);
						$doc->exportField($this->Designation);
						$doc->exportField($this->office_id);
						$doc->exportField($this->region);
						$doc->exportField($this->province);
						$doc->exportField($this->city);
						$doc->exportField($this->itemtype);
						$doc->exportField($this->itemmodel);
						$doc->exportField($this->item_serial);
						$doc->exportField($this->type_problem);
						$doc->exportField($this->action_taken);
						$doc->exportField($this->employee_id);
						$doc->exportField($this->status_h);
						$doc->exportField($this->pullout_r);
						$doc->exportField($this->remark);
						$doc->exportField($this->userlastmodify);
						$doc->exportField($this->datelastmodify);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'tbl_repair';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_repair';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['repair_id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'tbl_repair';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['repair_id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'tbl_repair';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['repair_id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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
	$this->UpdateTable = "tbl_repair";
	unset($rsnew["SRN"]);
	unset($rsnew["item_date_receive"]);
	unset($rsnew["item_date_repaired"]);
	unset($rsnew["item_transmittal"]);
	unset($rsnew["position"]);
	unset($rsnew["item_requested_unit"]);
	unset($rsnew["item_type"]);
	unset($rsnew["item_model"]);
	unset($rsnew["item_serno"]);
	unset($rsnew["Region"]);
	unset($rsnew["Province"]);
	unset($rsnew["Cities"]);
	unset($rsnew["item_type_problem"]);
	unset($rsnew["item_action_taken"]);
	unset($rsnew["employeeid"]);
	unset($rsnew["status_id"]);
	unset($rsnew["remarks"]);
	unset($rsnew["user_last_modify"]);
	unset($rsnew["date_last_modify"]);
	unset($rsnew["inventory_idt"]);
	unset($rsnew["Current_loc"]);
	Execute("UPDATE tbl_inventory SET status='".$rsnew["status_h"]."' WHERE inventory_id=".$rsnew["inventory_idr"]);  // Update the status of another table
	Execute("UPDATE tbl_inventory SET pullout_i='".$rsnew["pullout_r"]."' WHERE inventory_id=".$rsnew["inventory_idr"]);  // Update the status of another table
	return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	$repair_id = $rsnew['repair_id']; {

	//Execute("UPDATE tbl_item SET SRN= CONCAT('SRN',curdate(),'-',".$item_id.") WHERE item_id= ".$rsnew['item_id']);
	//Execute("UPDATE tbl_repair SET C_INV= CONCAT('C_INV','-','R6',".$repair_id.") WHERE repair_id= ".$rsnew['repair_id']);

	Execute("INSERT INTO tbl_item (
								   SRN,
								   item_date_receive,
							 	   item_date_repaired,
							 	   item_transmittal,
							 	   position,
							 	   item_requested_unit,
							 	   item_type,
							 	   item_model,
							 	   item_serno,
							 	   Region,
							 	   Province,
							 	   Cities,
							 	   item_type_problem,
							 	   item_action_taken,
							 	   employeeid,
							 	   status_id,
							 	   remarks,
							 	   user_last_modify,
							 	   date_last_modify,
							 	   inventory_idt,
							 	   Current_loc
							 	   )
			VALUES (
					'" . $rsnew["inventory_id"] . "',
					'" . $rsnew["date_received"] . "',
					'" . $rsnew["date_repaired"] . "',
					'" . $rsnew["name_accountable"] . "',
					'" . $rsnew["Designation"] . "',
					'" . $rsnew["office_id"] . "',
					'" . $rsnew["itemtype"] . "',
					'" . $rsnew["itemmodel"] . "',
					'" . $rsnew["item_serial"] . "',
					'" . $rsnew["region"] . "',
					'" . $rsnew["province"] . "',
					'" . $rsnew["city"] . "',
					'" . $rsnew["type_problem"] . "',
					'" . $rsnew["action_taken"] . "',
					'" . $rsnew["employee_id"] . "',
					'" . $rsnew["status_h"] . "',
					'" . $rsnew["remark"] . "',
					'" . $rsnew["userlastmodify"] . "',
					'" . $rsnew["datelastmodify"] . "',
					'" . $rsnew["inventory_idr"] . "',
					'" . $rsnew["current_loc_r"] . "'
				   )
					 ");
	}
	}

	//function Row_Inserted($rsold, &$rsnew){
	//Execute("INSERT INTO tble_report (Date_received, Date_repaired) VALUES ('" . $rsnew["item_date_receive"] . "','" . $rsnew["item_date_repaired"] . "' )");
	//}
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
	//	var_dump($this-><status_h>);
	//	$this->pullout_r->ReadOnly = TRUE;
	//if ($this->status_h->CurrentValue == 'FUNTIONAL')
	 //$this->pullout_r->Disable=TRUE;

	} 

	//	$this->pullout_r->Disabled = TRUE;
	//}
	// Example:
	//$this->ListOptions->Items["new"]->Body = "xxx";
	//if (CurrentUserLevel() <= 2)
	//if($this->status->CurrentValue == 4)
	//{
	//$this->ListOptions->Items["edit"]->Body = "";
	//}
	//}
	//if ($this-><status_h>->CurrentValue == "1") {
	 //$this->pullout_r->Enabled=TRUE;
	 //	}
	//} 
	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>