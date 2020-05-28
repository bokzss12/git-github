<?php namespace PHPMaker2020\pantawid2020; ?>
<?php

/**
 * Table class for tbl_inventory
 */
class tbl_inventory extends DbTable
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
	public $Current_Location;
	public $Last_Date_Check;
	public $employee_id;
	public $status;
	public $remarks;
	public $picture;
	public $picture_size;
	public $picture_name;
	public $picture_type;
	public $picture_width;
	public $picture_height;
	public $Tansmiss_Automatic;
	public $user_last_modify;
	public $date_last_modify;
	public $item_id;
	public $pullout_date;
	public $pullout_i;
	public $signatureID;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_inventory';
		$this->TableName = 'tbl_inventory';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_inventory`";
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
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 6;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("USER_ID_ALLOW_SECURITY"); // Default User ID Allow Security
		$this->UserIDAllowSecurity |= 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// inventory_id
		$this->inventory_id = new DbField('tbl_inventory', 'tbl_inventory', 'x_inventory_id', 'inventory_id', '`inventory_id`', '`inventory_id`', 3, 11, -1, FALSE, '`inventory_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->inventory_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->inventory_id->IsPrimaryKey = TRUE; // Primary key field
		$this->inventory_id->IsForeignKey = TRUE; // Foreign key field
		$this->inventory_id->Sortable = FALSE; // Allow sort
		$this->inventory_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['inventory_id'] = &$this->inventory_id;

		// concat_inventory
		$this->concat_inventory = new DbField('tbl_inventory', 'tbl_inventory', 'x_concat_inventory', 'concat_inventory', 'concat(\'INV-R6\',inventory_id)', 'concat(\'INV-R6\',inventory_id)', 200, 17, -1, FALSE, 'concat(\'INV-R6\',inventory_id)', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->concat_inventory->IsCustom = TRUE; // Custom field
		$this->concat_inventory->IsForeignKey = TRUE; // Foreign key field
		$this->concat_inventory->Sortable = TRUE; // Allow sort
		$this->fields['concat_inventory'] = &$this->concat_inventory;

		// Month_Purchased
		$this->Month_Purchased = new DbField('tbl_inventory', 'tbl_inventory', 'x_Month_Purchased', 'Month_Purchased', '`Month_Purchased`', '`Month_Purchased`', 3, 11, -1, FALSE, '`Month_Purchased`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Month_Purchased->Required = TRUE; // Required field
		$this->Month_Purchased->Sortable = TRUE; // Allow sort
		$this->Month_Purchased->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Month_Purchased->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Month_Purchased->Lookup = new Lookup('Month_Purchased', 'tbl_month', FALSE, 'month_id', ["month_id","month_dsc","",""], [], [], [], [], [], [], '`month_id` ASC', '');
				break;
			default:
				$this->Month_Purchased->Lookup = new Lookup('Month_Purchased', 'tbl_month', FALSE, 'month_id', ["month_id","month_dsc","",""], [], [], [], [], [], [], '`month_id` ASC', '');
				break;
		}
		$this->Month_Purchased->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Month_Purchased'] = &$this->Month_Purchased;

		// Year_Purchased
		$this->Year_Purchased = new DbField('tbl_inventory', 'tbl_inventory', 'x_Year_Purchased', 'Year_Purchased', '`Year_Purchased`', '`Year_Purchased`', 3, 11, -1, FALSE, '`Year_Purchased`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Year_Purchased->Required = TRUE; // Required field
		$this->Year_Purchased->Sortable = TRUE; // Allow sort
		$this->Year_Purchased->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Year_Purchased->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Year_Purchased->Lookup = new Lookup('Year_Purchased', 'tbl_year', FALSE, 'year_id', ["year_id","year_dsc","",""], [], [], [], [], [], [], '`year_id` ASC', '');
				break;
			default:
				$this->Year_Purchased->Lookup = new Lookup('Year_Purchased', 'tbl_year', FALSE, 'year_id', ["year_id","year_dsc","",""], [], [], [], [], [], [], '`year_id` ASC', '');
				break;
		}
		$this->Year_Purchased->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Year_Purchased'] = &$this->Year_Purchased;

		// item_type
		$this->item_type = new DbField('tbl_inventory', 'tbl_inventory', 'x_item_type', 'item_type', '`item_type`', '`item_type`', 3, 11, -1, FALSE, '`item_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->item_type->IsForeignKey = TRUE; // Foreign key field
		$this->item_type->Required = TRUE; // Required field
		$this->item_type->Sortable = TRUE; // Allow sort
		$this->item_type->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->item_type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
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
		$this->item_model = new DbField('tbl_inventory', 'tbl_inventory', 'x_item_model', 'item_model', '`item_model`', '`item_model`', 200, 50, -1, FALSE, '`item_model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_model->IsForeignKey = TRUE; // Foreign key field
		$this->item_model->Required = TRUE; // Required field
		$this->item_model->Sortable = TRUE; // Allow sort
		$this->fields['item_model'] = &$this->item_model;

		// item_serial
		$this->item_serial = new DbField('tbl_inventory', 'tbl_inventory', 'x_item_serial', 'item_serial', '`item_serial`', '`item_serial`', 200, 50, -1, FALSE, '`item_serial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_serial->IsForeignKey = TRUE; // Foreign key field
		$this->item_serial->Sortable = TRUE; // Allow sort
		$this->fields['item_serial'] = &$this->item_serial;

		// office_id
		$this->office_id = new DbField('tbl_inventory', 'tbl_inventory', 'x_office_id', 'office_id', '`office_id`', '`office_id`', 3, 11, -1, FALSE, '`office_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->office_id->IsForeignKey = TRUE; // Foreign key field
		$this->office_id->Required = TRUE; // Required field
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
		$this->Region = new DbField('tbl_inventory', 'tbl_inventory', 'x_Region', 'Region', '`Region`', '`Region`', 3, 11, -1, FALSE, '`Region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Region->IsForeignKey = TRUE; // Foreign key field
		$this->Region->Required = TRUE; // Required field
		$this->Region->Sortable = TRUE; // Allow sort
		$this->Region->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Region->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Region->Lookup = new Lookup('Region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], ["x_Province"], [], [], [], [], '', '');
				break;
			default:
				$this->Region->Lookup = new Lookup('Region', 'lib_regions', FALSE, 'region_code', ["region_name","","",""], [], ["x_Province"], [], [], [], [], '', '');
				break;
		}
		$this->Region->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Region'] = &$this->Region;

		// Province
		$this->Province = new DbField('tbl_inventory', 'tbl_inventory', 'x_Province', 'Province', '`Province`', '`Province`', 3, 11, -1, FALSE, '`Province`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Province->IsForeignKey = TRUE; // Foreign key field
		$this->Province->Required = TRUE; // Required field
		$this->Province->Sortable = TRUE; // Allow sort
		$this->Province->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Province->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Province->Lookup = new Lookup('Province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], ["x_Region"], ["x_Cities"], ["region_code"], ["x_region_code"], [], [], '`prov_name` ASC', '');
				break;
			default:
				$this->Province->Lookup = new Lookup('Province', 'lib_provinces', FALSE, 'prov_code', ["prov_name","","",""], ["x_Region"], ["x_Cities"], ["region_code"], ["x_region_code"], [], [], '`prov_name` ASC', '');
				break;
		}
		$this->Province->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Province'] = &$this->Province;

		// Cities
		$this->Cities = new DbField('tbl_inventory', 'tbl_inventory', 'x_Cities', 'Cities', '`Cities`', '`Cities`', 3, 11, -1, FALSE, '`Cities`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Cities->IsForeignKey = TRUE; // Foreign key field
		$this->Cities->Required = TRUE; // Required field
		$this->Cities->Sortable = TRUE; // Allow sort
		$this->Cities->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Cities->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Cities->Lookup = new Lookup('Cities', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], ["x_Province"], [], ["prov_code"], ["x_prov_code"], [], [], '`city_name` ASC', '');
				break;
			default:
				$this->Cities->Lookup = new Lookup('Cities', 'lib_cities', FALSE, 'city_code', ["city_name","","",""], ["x_Province"], [], ["prov_code"], ["x_prov_code"], [], [], '`city_name` ASC', '');
				break;
		}
		$this->Cities->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Cities'] = &$this->Cities;

		// name_accountable
		$this->name_accountable = new DbField('tbl_inventory', 'tbl_inventory', 'x_name_accountable', 'name_accountable', '`name_accountable`', '`name_accountable`', 3, 50, -1, FALSE, '`name_accountable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->name_accountable->IsForeignKey = TRUE; // Foreign key field
		$this->name_accountable->Required = TRUE; // Required field
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
		$this->Designation = new DbField('tbl_inventory', 'tbl_inventory', 'x_Designation', 'Designation', '`Designation`', '`Designation`', 3, 50, -1, FALSE, '`Designation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
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

		// Current_Location
		$this->Current_Location = new DbField('tbl_inventory', 'tbl_inventory', 'x_Current_Location', 'Current_Location', '`Current_Location`', '`Current_Location`', 3, 11, -1, FALSE, '`Current_Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Current_Location->IsForeignKey = TRUE; // Foreign key field
		$this->Current_Location->Required = TRUE; // Required field
		$this->Current_Location->Sortable = TRUE; // Allow sort
		$this->Current_Location->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Current_Location->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->Current_Location->Lookup = new Lookup('Current_Location', 'tbl_current_loc', FALSE, 'current_id', ["current_location","","",""], [], [], [], [], [], [], '`current_location` ASC', '');
				break;
			default:
				$this->Current_Location->Lookup = new Lookup('Current_Location', 'tbl_current_loc', FALSE, 'current_id', ["current_location","","",""], [], [], [], [], [], [], '`current_location` ASC', '');
				break;
		}
		$this->Current_Location->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Current_Location'] = &$this->Current_Location;

		// Last_Date_Check
		$this->Last_Date_Check = new DbField('tbl_inventory', 'tbl_inventory', 'x_Last_Date_Check', 'Last_Date_Check', '`Last_Date_Check`', CastDateFieldForLike("`Last_Date_Check`", 5, "DB"), 133, 10, 5, FALSE, '`Last_Date_Check`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Last_Date_Check->IsForeignKey = TRUE; // Foreign key field
		$this->Last_Date_Check->Required = TRUE; // Required field
		$this->Last_Date_Check->Sortable = TRUE; // Allow sort
		$this->Last_Date_Check->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['Last_Date_Check'] = &$this->Last_Date_Check;

		// employee_id
		$this->employee_id = new DbField('tbl_inventory', 'tbl_inventory', 'x_employee_id', 'employee_id', '`employee_id`', '`employee_id`', 3, 11, -1, FALSE, '`employee_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->employee_id->Required = TRUE; // Required field
		$this->employee_id->Sortable = TRUE; // Allow sort
		$this->employee_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->employee_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
			default:
				$this->employee_id->Lookup = new Lookup('employee_id', 'employee', FALSE, 'employeeid', ["employeeid","Name_dsc","",""], [], [], [], [], [], [], '`employeeid` ASC', '');
				break;
		}
		$this->employee_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['employee_id'] = &$this->employee_id;

		// status
		$this->status = new DbField('tbl_inventory', 'tbl_inventory', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->status->Lookup = new Lookup('status', 'tbl_inventory_status', FALSE, 'inventory_status_id', ["inventory_status_id","inventory_status_dsc","",""], [], [], [], [], [], [], '`inventory_status_id` ASC', '');
				break;
			default:
				$this->status->Lookup = new Lookup('status', 'tbl_inventory_status', FALSE, 'inventory_status_id', ["inventory_status_id","inventory_status_dsc","",""], [], [], [], [], [], [], '`inventory_status_id` ASC', '');
				break;
		}
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// remarks
		$this->remarks = new DbField('tbl_inventory', 'tbl_inventory', 'x_remarks', 'remarks', '`remarks`', '`remarks`', 201, 500, -1, FALSE, '`remarks`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->remarks->Sortable = TRUE; // Allow sort
		$this->fields['remarks'] = &$this->remarks;

		// picture
		$this->picture = new DbField('tbl_inventory', 'tbl_inventory', 'x_picture', 'picture', '`picture`', '`picture`', 205, 0, -1, TRUE, '`picture`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->picture->Sortable = TRUE; // Allow sort
		$this->picture->ImageResize = TRUE;
		$this->fields['picture'] = &$this->picture;

		// picture_size
		$this->picture_size = new DbField('tbl_inventory', 'tbl_inventory', 'x_picture_size', 'picture_size', '`picture_size`', '`picture_size`', 3, 12, -1, FALSE, '`picture_size`', FALSE, FALSE, FALSE, 'IMAGE', 'TEXT');
		$this->picture_size->Sortable = TRUE; // Allow sort
		$this->picture_size->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['picture_size'] = &$this->picture_size;

		// picture_name
		$this->picture_name = new DbField('tbl_inventory', 'tbl_inventory', 'x_picture_name', 'picture_name', '`picture_name`', '`picture_name`', 200, 50, -1, FALSE, '`picture_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->picture_name->Sortable = TRUE; // Allow sort
		$this->fields['picture_name'] = &$this->picture_name;

		// picture_type
		$this->picture_type = new DbField('tbl_inventory', 'tbl_inventory', 'x_picture_type', 'picture_type', '`picture_type`', '`picture_type`', 200, 50, -1, FALSE, '`picture_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->picture_type->Sortable = TRUE; // Allow sort
		$this->fields['picture_type'] = &$this->picture_type;

		// picture_width
		$this->picture_width = new DbField('tbl_inventory', 'tbl_inventory', 'x_picture_width', 'picture_width', '`picture_width`', '`picture_width`', 3, 11, -1, FALSE, '`picture_width`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->picture_width->Sortable = TRUE; // Allow sort
		$this->picture_width->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['picture_width'] = &$this->picture_width;

		// picture_height
		$this->picture_height = new DbField('tbl_inventory', 'tbl_inventory', 'x_picture_height', 'picture_height', '`picture_height`', '`picture_height`', 3, 11, -1, FALSE, '`picture_height`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->picture_height->Sortable = TRUE; // Allow sort
		$this->picture_height->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['picture_height'] = &$this->picture_height;

		// Tansmiss_Automatic
		$this->Tansmiss_Automatic = new DbField('tbl_inventory', 'tbl_inventory', 'x_Tansmiss_Automatic', 'Tansmiss_Automatic', '`Tansmiss_Automatic`', '`Tansmiss_Automatic`', 200, 3, -1, FALSE, '`Tansmiss_Automatic`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tansmiss_Automatic->Sortable = TRUE; // Allow sort
		$this->fields['Tansmiss_Automatic'] = &$this->Tansmiss_Automatic;

		// user_last_modify
		$this->user_last_modify = new DbField('tbl_inventory', 'tbl_inventory', 'x_user_last_modify', 'user_last_modify', '`user_last_modify`', '`user_last_modify`', 200, 50, -1, FALSE, '`user_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->user_last_modify->Sortable = TRUE; // Allow sort
		$this->user_last_modify->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->user_last_modify->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->user_last_modify->Lookup = new Lookup('user_last_modify', 'employee', FALSE, 'username', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->user_last_modify->Lookup = new Lookup('user_last_modify', 'employee', FALSE, 'username', ["Name_dsc","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['user_last_modify'] = &$this->user_last_modify;

		// date_last_modify
		$this->date_last_modify = new DbField('tbl_inventory', 'tbl_inventory', 'x_date_last_modify', 'date_last_modify', '`date_last_modify`', CastDateFieldForLike("`date_last_modify`", 109, "DB"), 135, 19, -1, FALSE, '`date_last_modify`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date_last_modify->Sortable = TRUE; // Allow sort
		$this->date_last_modify->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['date_last_modify'] = &$this->date_last_modify;

		// item_id
		$this->item_id = new DbField('tbl_inventory', 'tbl_inventory', 'x_item_id', 'item_id', '`item_id`', '`item_id`', 200, 255, -1, FALSE, '`item_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->item_id->Sortable = FALSE; // Allow sort
		$this->fields['item_id'] = &$this->item_id;

		// pullout_date
		$this->pullout_date = new DbField('tbl_inventory', 'tbl_inventory', 'x_pullout_date', 'pullout_date', '`pullout_date`', CastDateFieldForLike("`pullout_date`", 5, "DB"), 135, 19, 5, FALSE, '`pullout_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pullout_date->Sortable = TRUE; // Allow sort
		$this->pullout_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['pullout_date'] = &$this->pullout_date;

		// pullout_i
		$this->pullout_i = new DbField('tbl_inventory', 'tbl_inventory', 'x_pullout_i', 'pullout_i', '`pullout_i`', '`pullout_i`', 200, 255, -1, FALSE, '`pullout_i`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pullout_i->Sortable = TRUE; // Allow sort
		$this->fields['pullout_i'] = &$this->pullout_i;

		// signatureID
		$this->signatureID = new DbField('tbl_inventory', 'tbl_inventory', 'x_signatureID', 'signatureID', '`signatureID`', '`signatureID`', 3, 50, -1, FALSE, '`signatureID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->signatureID->Sortable = TRUE; // Allow sort
		$this->signatureID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['signatureID'] = &$this->signatureID;
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

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "tbl_repair") {
			$detailUrl = $GLOBALS["tbl_repair"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_item_type=" . urlencode($this->item_type->CurrentValue);
			$detailUrl .= "&fk_item_model=" . urlencode($this->item_model->CurrentValue);
			$detailUrl .= "&fk_item_serial=" . urlencode($this->item_serial->CurrentValue);
			$detailUrl .= "&fk_office_id=" . urlencode($this->office_id->CurrentValue);
			$detailUrl .= "&fk_name_accountable=" . urlencode($this->name_accountable->CurrentValue);
			$detailUrl .= "&fk_Designation=" . urlencode($this->Designation->CurrentValue);
			$detailUrl .= "&fk_Region=" . urlencode($this->Region->CurrentValue);
			$detailUrl .= "&fk_Province=" . urlencode($this->Province->CurrentValue);
			$detailUrl .= "&fk_Cities=" . urlencode($this->Cities->CurrentValue);
			$detailUrl .= "&fk_concat_inventory=" . urlencode($this->concat_inventory->CurrentValue);
			$detailUrl .= "&fk_inventory_id=" . urlencode($this->inventory_id->CurrentValue);
			$detailUrl .= "&fk_Current_Location=" . urlencode($this->Current_Location->CurrentValue);
			$detailUrl .= "&fk_Last_Date_Check=" . urlencode($this->Last_Date_Check->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "tbl_inventorylist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`tbl_inventory`";
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

		// Cascade Update detail table 'tbl_repair'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['item_type']) && $rsold['item_type'] != $rs['item_type'])) { // Update detail field 'itemtype'
			$cascadeUpdate = TRUE;
			$rscascade['itemtype'] = $rs['item_type'];
		}
		if ($rsold && (isset($rs['item_model']) && $rsold['item_model'] != $rs['item_model'])) { // Update detail field 'itemmodel'
			$cascadeUpdate = TRUE;
			$rscascade['itemmodel'] = $rs['item_model'];
		}
		if ($rsold && (isset($rs['item_serial']) && $rsold['item_serial'] != $rs['item_serial'])) { // Update detail field 'item_serial'
			$cascadeUpdate = TRUE;
			$rscascade['item_serial'] = $rs['item_serial'];
		}
		if ($rsold && (isset($rs['office_id']) && $rsold['office_id'] != $rs['office_id'])) { // Update detail field 'office_id'
			$cascadeUpdate = TRUE;
			$rscascade['office_id'] = $rs['office_id'];
		}
		if ($rsold && (isset($rs['name_accountable']) && $rsold['name_accountable'] != $rs['name_accountable'])) { // Update detail field 'name_accountable'
			$cascadeUpdate = TRUE;
			$rscascade['name_accountable'] = $rs['name_accountable'];
		}
		if ($rsold && (isset($rs['Designation']) && $rsold['Designation'] != $rs['Designation'])) { // Update detail field 'Designation'
			$cascadeUpdate = TRUE;
			$rscascade['Designation'] = $rs['Designation'];
		}
		if ($rsold && (isset($rs['Region']) && $rsold['Region'] != $rs['Region'])) { // Update detail field 'region'
			$cascadeUpdate = TRUE;
			$rscascade['region'] = $rs['Region'];
		}
		if ($rsold && (isset($rs['Province']) && $rsold['Province'] != $rs['Province'])) { // Update detail field 'province'
			$cascadeUpdate = TRUE;
			$rscascade['province'] = $rs['Province'];
		}
		if ($rsold && (isset($rs['Cities']) && $rsold['Cities'] != $rs['Cities'])) { // Update detail field 'city'
			$cascadeUpdate = TRUE;
			$rscascade['city'] = $rs['Cities'];
		}
		if ($rsold && (isset($rs['concat_inventory']) && $rsold['concat_inventory'] != $rs['concat_inventory'])) { // Update detail field 'inventory_id'
			$cascadeUpdate = TRUE;
			$rscascade['inventory_id'] = $rs['concat_inventory'];
		}
		if ($rsold && (isset($rs['inventory_id']) && $rsold['inventory_id'] != $rs['inventory_id'])) { // Update detail field 'inventory_idr'
			$cascadeUpdate = TRUE;
			$rscascade['inventory_idr'] = $rs['inventory_id'];
		}
		if ($rsold && (isset($rs['Current_Location']) && $rsold['Current_Location'] != $rs['Current_Location'])) { // Update detail field 'current_loc_r'
			$cascadeUpdate = TRUE;
			$rscascade['current_loc_r'] = $rs['Current_Location'];
		}
		if ($rsold && (isset($rs['Last_Date_Check']) && $rsold['Last_Date_Check'] != $rs['Last_Date_Check'])) { // Update detail field 'date_received'
			$cascadeUpdate = TRUE;
			$rscascade['date_received'] = $rs['Last_Date_Check'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["tbl_repair"]))
				$GLOBALS["tbl_repair"] = new tbl_repair();
			$rswrk = $GLOBALS["tbl_repair"]->loadRs("`itemtype` = " . QuotedValue($rsold['item_type'], DATATYPE_NUMBER, 'DB') . " AND " . "`itemmodel` = " . QuotedValue($rsold['item_model'], DATATYPE_STRING, 'DB') . " AND " . "`item_serial` = " . QuotedValue($rsold['item_serial'], DATATYPE_STRING, 'DB') . " AND " . "`office_id` = " . QuotedValue($rsold['office_id'], DATATYPE_NUMBER, 'DB') . " AND " . "`name_accountable` = " . QuotedValue($rsold['name_accountable'], DATATYPE_NUMBER, 'DB') . " AND " . "`Designation` = " . QuotedValue($rsold['Designation'], DATATYPE_NUMBER, 'DB') . " AND " . "`region` = " . QuotedValue($rsold['Region'], DATATYPE_NUMBER, 'DB') . " AND " . "`province` = " . QuotedValue($rsold['Province'], DATATYPE_NUMBER, 'DB') . " AND " . "`city` = " . QuotedValue($rsold['Cities'], DATATYPE_NUMBER, 'DB') . " AND " . "`inventory_id` = " . QuotedValue($rsold['concat_inventory'], DATATYPE_STRING, 'DB') . " AND " . "`inventory_idr` = " . QuotedValue($rsold['inventory_id'], DATATYPE_NUMBER, 'DB') . " AND " . "`current_loc_r` = " . QuotedValue($rsold['Current_Location'], DATATYPE_NUMBER, 'DB') . " AND " . "`date_received` = " . QuotedValue($rsold['Last_Date_Check'], DATATYPE_DATE, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'repair_id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["tbl_repair"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["tbl_repair"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["tbl_repair"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'inventory_id';
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

		// Cascade delete detail table 'tbl_repair'
		if (!isset($GLOBALS["tbl_repair"]))
			$GLOBALS["tbl_repair"] = new tbl_repair();
		$rscascade = $GLOBALS["tbl_repair"]->loadRs("`itemtype` = " . QuotedValue($rs['item_type'], DATATYPE_NUMBER, "DB") . " AND " . "`itemmodel` = " . QuotedValue($rs['item_model'], DATATYPE_STRING, "DB") . " AND " . "`item_serial` = " . QuotedValue($rs['item_serial'], DATATYPE_STRING, "DB") . " AND " . "`office_id` = " . QuotedValue($rs['office_id'], DATATYPE_NUMBER, "DB") . " AND " . "`name_accountable` = " . QuotedValue($rs['name_accountable'], DATATYPE_NUMBER, "DB") . " AND " . "`Designation` = " . QuotedValue($rs['Designation'], DATATYPE_NUMBER, "DB") . " AND " . "`region` = " . QuotedValue($rs['Region'], DATATYPE_NUMBER, "DB") . " AND " . "`province` = " . QuotedValue($rs['Province'], DATATYPE_NUMBER, "DB") . " AND " . "`city` = " . QuotedValue($rs['Cities'], DATATYPE_NUMBER, "DB") . " AND " . "`inventory_id` = " . QuotedValue($rs['concat_inventory'], DATATYPE_STRING, "DB") . " AND " . "`inventory_idr` = " . QuotedValue($rs['inventory_id'], DATATYPE_NUMBER, "DB") . " AND " . "`current_loc_r` = " . QuotedValue($rs['Current_Location'], DATATYPE_NUMBER, "DB") . " AND " . "`date_received` = " . QuotedValue($rs['Last_Date_Check'], DATATYPE_DATE, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["tbl_repair"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["tbl_repair"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["tbl_repair"]->Row_Deleted($dtlrow);
		}
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
		$this->Current_Location->DbValue = $row['Current_Location'];
		$this->Last_Date_Check->DbValue = $row['Last_Date_Check'];
		$this->employee_id->DbValue = $row['employee_id'];
		$this->status->DbValue = $row['status'];
		$this->remarks->DbValue = $row['remarks'];
		$this->picture->Upload->DbValue = $row['picture'];
		$this->picture_size->DbValue = $row['picture_size'];
		$this->picture_name->DbValue = $row['picture_name'];
		$this->picture_type->DbValue = $row['picture_type'];
		$this->picture_width->DbValue = $row['picture_width'];
		$this->picture_height->DbValue = $row['picture_height'];
		$this->Tansmiss_Automatic->DbValue = $row['Tansmiss_Automatic'];
		$this->user_last_modify->DbValue = $row['user_last_modify'];
		$this->date_last_modify->DbValue = $row['date_last_modify'];
		$this->item_id->DbValue = $row['item_id'];
		$this->pullout_date->DbValue = $row['pullout_date'];
		$this->pullout_i->DbValue = $row['pullout_i'];
		$this->signatureID->DbValue = $row['signatureID'];
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
			return "tbl_inventorylist.php";
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
		if ($pageName == "tbl_inventoryview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_inventoryedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_inventoryadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_inventorylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tbl_inventoryview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_inventoryview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "tbl_inventoryadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_inventoryadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("tbl_inventoryedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_inventoryedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("tbl_inventoryadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_inventoryadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("tbl_inventorydelete.php", $this->getUrlParm());
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
		$this->Current_Location->setDbValue($rs->fields('Current_Location'));
		$this->Last_Date_Check->setDbValue($rs->fields('Last_Date_Check'));
		$this->employee_id->setDbValue($rs->fields('employee_id'));
		$this->status->setDbValue($rs->fields('status'));
		$this->remarks->setDbValue($rs->fields('remarks'));
		$this->picture->Upload->DbValue = $rs->fields('picture');
		$this->picture_size->setDbValue($rs->fields('picture_size'));
		$this->picture_name->setDbValue($rs->fields('picture_name'));
		$this->picture_type->setDbValue($rs->fields('picture_type'));
		$this->picture_width->setDbValue($rs->fields('picture_width'));
		$this->picture_height->setDbValue($rs->fields('picture_height'));
		$this->Tansmiss_Automatic->setDbValue($rs->fields('Tansmiss_Automatic'));
		$this->user_last_modify->setDbValue($rs->fields('user_last_modify'));
		$this->date_last_modify->setDbValue($rs->fields('date_last_modify'));
		$this->item_id->setDbValue($rs->fields('item_id'));
		$this->pullout_date->setDbValue($rs->fields('pullout_date'));
		$this->pullout_i->setDbValue($rs->fields('pullout_i'));
		$this->signatureID->setDbValue($rs->fields('signatureID'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// inventory_id

		$this->inventory_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// concat_inventory
		$this->concat_inventory->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Month_Purchased
		$this->Month_Purchased->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Year_Purchased
		$this->Year_Purchased->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_type
		$this->item_type->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_model
		$this->item_model->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_serial
		$this->item_serial->CellCssStyle = "width: 0px; white-space: nowrap;";

		// office_id
		$this->office_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Region
		$this->Region->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Province
		$this->Province->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Cities
		$this->Cities->CellCssStyle = "width: 0px; white-space: nowrap;";

		// name_accountable
		$this->name_accountable->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Designation
		$this->Designation->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Current_Location
		$this->Current_Location->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Last_Date_Check
		$this->Last_Date_Check->CellCssStyle = "width: 0px; white-space: nowrap;";

		// employee_id
		$this->employee_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// status
		$this->status->CellCssStyle = "width: 0px; white-space: nowrap;";

		// remarks
		$this->remarks->CellCssStyle = "width: 0px; white-space: nowrap;";

		// picture
		$this->picture->CellCssStyle = "width: 0px; white-space: nowrap;";

		// picture_size
		$this->picture_size->CellCssStyle = "width: 0px; white-space: nowrap;";

		// picture_name
		$this->picture_name->CellCssStyle = "width: 0px; white-space: nowrap;";

		// picture_type
		$this->picture_type->CellCssStyle = "width: 0px; white-space: nowrap;";

		// picture_width
		$this->picture_width->CellCssStyle = "width: 0px; white-space: nowrap;";

		// picture_height
		$this->picture_height->CellCssStyle = "width: 0px; white-space: nowrap;";

		// Tansmiss_Automatic
		$this->Tansmiss_Automatic->CellCssStyle = "width: 0px; white-space: nowrap;";

		// user_last_modify
		$this->user_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// date_last_modify
		$this->date_last_modify->CellCssStyle = "width: 0px; white-space: nowrap;";

		// item_id
		$this->item_id->CellCssStyle = "width: 0px; white-space: nowrap;";

		// pullout_date
		$this->pullout_date->CellCssStyle = "width: 0px; white-space: nowrap;";

		// pullout_i
		$this->pullout_i->CellCssStyle = "width: 0px; white-space: nowrap;";

		// signatureID
		$this->signatureID->CellCssStyle = "width: 0px; white-space: nowrap;";

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
					$arwrk[2] = $rswrk->fields('df2');
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
					$arwrk[2] = $rswrk->fields('df2');
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
				$lookupFilter = function() {
					return "region_name = 'REGION VI [Western Visayas]'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Region->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
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

		// Current_Location
		$curVal = strval($this->Current_Location->CurrentValue);
		if ($curVal != "") {
			$this->Current_Location->ViewValue = $this->Current_Location->lookupCacheOption($curVal);
			if ($this->Current_Location->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`current_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

		// Last_Date_Check
		$this->Last_Date_Check->ViewValue = $this->Last_Date_Check->CurrentValue;
		$this->Last_Date_Check->ViewValue = FormatDateTime($this->Last_Date_Check->ViewValue, 5);
		$this->Last_Date_Check->ViewCustomAttributes = "";

		// employee_id
		$curVal = strval($this->employee_id->CurrentValue);
		if ($curVal != "") {
			$this->employee_id->ViewValue = $this->employee_id->lookupCacheOption($curVal);
			if ($this->employee_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`employeeid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->employee_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->employee_id->ViewValue = $this->employee_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->employee_id->ViewValue = $this->employee_id->CurrentValue;
				}
			}
		} else {
			$this->employee_id->ViewValue = NULL;
		}
		$this->employee_id->ViewCustomAttributes = "";

		// status
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
					$arwrk[2] = $rswrk->fields('df2');
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

		// remarks
		$this->remarks->ViewValue = $this->remarks->CurrentValue;
		$this->remarks->ViewCustomAttributes = "";

		// picture
		if (!EmptyValue($this->picture->Upload->DbValue)) {
			$this->picture->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
			$this->picture->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
			$this->picture->ImageAlt = $this->picture->alt();
			$this->picture->ViewValue = $this->inventory_id->CurrentValue;
			$this->picture->IsBlobImage = IsImageFile(ContentExtension($this->picture->Upload->DbValue));
			$this->picture->Upload->FileName = $this->picture_type->CurrentValue;
		} else {
			$this->picture->ViewValue = "";
		}
		$this->picture->ViewCustomAttributes = "";

		// picture_size
		$this->picture_size->ViewValue = $this->picture_size->CurrentValue;
		$this->picture_size->ImageAlt = $this->picture_size->alt();
		$this->picture_size->ViewCustomAttributes = "";

		// picture_name
		$this->picture_name->ViewValue = $this->picture_name->CurrentValue;
		$this->picture_name->ViewCustomAttributes = "";

		// picture_type
		$this->picture_type->ViewValue = $this->picture_type->CurrentValue;
		$this->picture_type->ViewCustomAttributes = "";

		// picture_width
		$this->picture_width->ViewValue = $this->picture_width->CurrentValue;
		$this->picture_width->ViewCustomAttributes = "";

		// picture_height
		$this->picture_height->ViewValue = $this->picture_height->CurrentValue;
		$this->picture_height->ViewCustomAttributes = "";

		// Tansmiss_Automatic
		$this->Tansmiss_Automatic->ViewValue = $this->Tansmiss_Automatic->CurrentValue;
		$this->Tansmiss_Automatic->ViewCustomAttributes = "";

		// user_last_modify
		$curVal = strval($this->user_last_modify->CurrentValue);
		if ($curVal != "") {
			$this->user_last_modify->ViewValue = $this->user_last_modify->lookupCacheOption($curVal);
			if ($this->user_last_modify->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`username`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->user_last_modify->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->user_last_modify->ViewValue = $this->user_last_modify->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->user_last_modify->ViewValue = $this->user_last_modify->CurrentValue;
				}
			}
		} else {
			$this->user_last_modify->ViewValue = NULL;
		}
		$this->user_last_modify->ViewCustomAttributes = "";

		// date_last_modify
		$this->date_last_modify->ViewValue = $this->date_last_modify->CurrentValue;
		$this->date_last_modify->ViewCustomAttributes = "";

		// item_id
		$this->item_id->ViewValue = $this->item_id->CurrentValue;
		$this->item_id->ViewCustomAttributes = "";

		// pullout_date
		$this->pullout_date->ViewValue = $this->pullout_date->CurrentValue;
		$this->pullout_date->ViewValue = FormatDateTime($this->pullout_date->ViewValue, 5);
		$this->pullout_date->ViewCustomAttributes = "";

		// pullout_i
		$this->pullout_i->ViewValue = $this->pullout_i->CurrentValue;
		$this->pullout_i->ViewCustomAttributes = "";

		// signatureID
		$this->signatureID->ViewValue = $this->signatureID->CurrentValue;
		$this->signatureID->ViewValue = FormatNumber($this->signatureID->ViewValue, 0, -2, -2, -2);
		$this->signatureID->ViewCustomAttributes = "";

		// inventory_id
		$this->inventory_id->LinkCustomAttributes = "";
		$this->inventory_id->HrefValue = "";
		$this->inventory_id->TooltipValue = "";

		// concat_inventory
		$this->concat_inventory->LinkCustomAttributes = "";
		if (!EmptyValue($this->concat_inventory->CurrentValue)) {
			$this->concat_inventory->HrefValue = "barcodeslist.php?x_concat_id=" . $this->concat_inventory->CurrentValue; // Add prefix/suffix
			$this->concat_inventory->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->concat_inventory->HrefValue = FullUrl($this->concat_inventory->HrefValue, "href");
		} else {
			$this->concat_inventory->HrefValue = "";
		}
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

		// Current_Location
		$this->Current_Location->LinkCustomAttributes = "";
		$this->Current_Location->HrefValue = "";
		$this->Current_Location->TooltipValue = "";

		// Last_Date_Check
		$this->Last_Date_Check->LinkCustomAttributes = "";
		$this->Last_Date_Check->HrefValue = "";
		$this->Last_Date_Check->TooltipValue = "";

		// employee_id
		$this->employee_id->LinkCustomAttributes = "";
		$this->employee_id->HrefValue = "";
		$this->employee_id->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// remarks
		$this->remarks->LinkCustomAttributes = "";
		$this->remarks->HrefValue = "";
		$this->remarks->TooltipValue = "";

		// picture
		$this->picture->LinkCustomAttributes = "";
		if (!empty($this->picture->Upload->DbValue)) {
			$this->picture->HrefValue = GetFileUploadUrl($this->picture, $this->inventory_id->CurrentValue);
			$this->picture->LinkAttrs["target"] = "_blank";
			if ($this->picture->IsBlobImage && empty($this->picture->LinkAttrs["target"]))
				$this->picture->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->picture->HrefValue = FullUrl($this->picture->HrefValue, "href");
		} else {
			$this->picture->HrefValue = "";
		}
		$this->picture->ExportHrefValue = GetFileUploadUrl($this->picture, $this->inventory_id->CurrentValue);
		$this->picture->TooltipValue = "";
		if ($this->picture->UseColorbox) {
			if (EmptyValue($this->picture->TooltipValue))
				$this->picture->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->picture->LinkAttrs["data-rel"] = "tbl_inventory_x_picture";
			$this->picture->LinkAttrs->appendClass("ew-lightbox");
		}

		// picture_size
		$this->picture_size->LinkCustomAttributes = "";
		$this->picture_size->HrefValue = "";
		$this->picture_size->TooltipValue = "";

		// picture_name
		$this->picture_name->LinkCustomAttributes = "";
		$this->picture_name->HrefValue = "";
		$this->picture_name->TooltipValue = "";

		// picture_type
		$this->picture_type->LinkCustomAttributes = "";
		$this->picture_type->HrefValue = "";
		$this->picture_type->TooltipValue = "";

		// picture_width
		$this->picture_width->LinkCustomAttributes = "";
		$this->picture_width->HrefValue = "";
		$this->picture_width->TooltipValue = "";

		// picture_height
		$this->picture_height->LinkCustomAttributes = "";
		$this->picture_height->HrefValue = "";
		$this->picture_height->TooltipValue = "";

		// Tansmiss_Automatic
		$this->Tansmiss_Automatic->LinkCustomAttributes = "";
		$this->Tansmiss_Automatic->HrefValue = "";
		$this->Tansmiss_Automatic->TooltipValue = "";

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

		// pullout_date
		$this->pullout_date->LinkCustomAttributes = "";
		$this->pullout_date->HrefValue = "";
		$this->pullout_date->TooltipValue = "";

		// pullout_i
		$this->pullout_i->LinkCustomAttributes = "";
		$this->pullout_i->HrefValue = "";
		$this->pullout_i->TooltipValue = "";

		// signatureID
		$this->signatureID->LinkCustomAttributes = "";
		$this->signatureID->HrefValue = "";
		$this->signatureID->TooltipValue = "";

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

		// Current_Location
		$this->Current_Location->EditAttrs["class"] = "form-control";
		$this->Current_Location->EditCustomAttributes = "";

		// Last_Date_Check
		$this->Last_Date_Check->EditAttrs["class"] = "form-control";
		$this->Last_Date_Check->EditCustomAttributes = "";
		$this->Last_Date_Check->EditValue = FormatDateTime($this->Last_Date_Check->CurrentValue, 5);
		$this->Last_Date_Check->PlaceHolder = RemoveHtml($this->Last_Date_Check->caption());

		// employee_id
		$this->employee_id->EditAttrs["class"] = "form-control";
		$this->employee_id->EditCustomAttributes = "";

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";

		// remarks
		$this->remarks->EditAttrs["class"] = "form-control";
		$this->remarks->EditCustomAttributes = "";
		$this->remarks->EditValue = $this->remarks->CurrentValue;
		$this->remarks->PlaceHolder = RemoveHtml($this->remarks->caption());

		// picture
		$this->picture->EditAttrs["class"] = "form-control";
		$this->picture->EditCustomAttributes = "";
		if (!EmptyValue($this->picture->Upload->DbValue)) {
			$this->picture->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
			$this->picture->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
			$this->picture->ImageAlt = $this->picture->alt();
			$this->picture->EditValue = $this->inventory_id->CurrentValue;
			$this->picture->IsBlobImage = IsImageFile(ContentExtension($this->picture->Upload->DbValue));
			$this->picture->Upload->FileName = $this->picture_type->CurrentValue;
		} else {
			$this->picture->EditValue = "";
		}
		if (!EmptyValue($this->picture_type->CurrentValue))
				$this->picture->Upload->FileName = $this->picture_type->CurrentValue;

		// picture_size
		$this->picture_size->EditAttrs["class"] = "form-control";
		$this->picture_size->EditCustomAttributes = "";
		$this->picture_size->EditValue = $this->picture_size->CurrentValue;
		$this->picture_size->PlaceHolder = RemoveHtml($this->picture_size->caption());

		// picture_name
		$this->picture_name->EditAttrs["class"] = "form-control";
		$this->picture_name->EditCustomAttributes = "";
		if (!$this->picture_name->Raw)
			$this->picture_name->CurrentValue = HtmlDecode($this->picture_name->CurrentValue);
		$this->picture_name->EditValue = $this->picture_name->CurrentValue;
		$this->picture_name->PlaceHolder = RemoveHtml($this->picture_name->caption());

		// picture_type
		$this->picture_type->EditAttrs["class"] = "form-control";
		$this->picture_type->EditCustomAttributes = "";
		if (!$this->picture_type->Raw)
			$this->picture_type->CurrentValue = HtmlDecode($this->picture_type->CurrentValue);
		$this->picture_type->EditValue = $this->picture_type->CurrentValue;
		$this->picture_type->PlaceHolder = RemoveHtml($this->picture_type->caption());

		// picture_width
		$this->picture_width->EditAttrs["class"] = "form-control";
		$this->picture_width->EditCustomAttributes = "";
		$this->picture_width->EditValue = $this->picture_width->CurrentValue;
		$this->picture_width->PlaceHolder = RemoveHtml($this->picture_width->caption());

		// picture_height
		$this->picture_height->EditAttrs["class"] = "form-control";
		$this->picture_height->EditCustomAttributes = "";
		$this->picture_height->EditValue = $this->picture_height->CurrentValue;
		$this->picture_height->PlaceHolder = RemoveHtml($this->picture_height->caption());

		// Tansmiss_Automatic
		$this->Tansmiss_Automatic->EditAttrs["class"] = "form-control";
		$this->Tansmiss_Automatic->EditCustomAttributes = "";
		if (!$this->Tansmiss_Automatic->Raw)
			$this->Tansmiss_Automatic->CurrentValue = HtmlDecode($this->Tansmiss_Automatic->CurrentValue);
		$this->Tansmiss_Automatic->EditValue = $this->Tansmiss_Automatic->CurrentValue;
		$this->Tansmiss_Automatic->PlaceHolder = RemoveHtml($this->Tansmiss_Automatic->caption());

		// user_last_modify
		// date_last_modify
		// item_id

		$this->item_id->EditAttrs["class"] = "form-control";
		$this->item_id->EditCustomAttributes = "";
		if (!$this->item_id->Raw)
			$this->item_id->CurrentValue = HtmlDecode($this->item_id->CurrentValue);
		$this->item_id->EditValue = $this->item_id->CurrentValue;
		$this->item_id->PlaceHolder = RemoveHtml($this->item_id->caption());

		// pullout_date
		$this->pullout_date->EditAttrs["class"] = "form-control";
		$this->pullout_date->EditCustomAttributes = "";
		$this->pullout_date->EditValue = FormatDateTime($this->pullout_date->CurrentValue, 5);
		$this->pullout_date->PlaceHolder = RemoveHtml($this->pullout_date->caption());

		// pullout_i
		$this->pullout_i->EditAttrs["class"] = "form-control";
		$this->pullout_i->EditCustomAttributes = "";
		if (!$this->pullout_i->Raw)
			$this->pullout_i->CurrentValue = HtmlDecode($this->pullout_i->CurrentValue);
		$this->pullout_i->EditValue = $this->pullout_i->CurrentValue;
		$this->pullout_i->PlaceHolder = RemoveHtml($this->pullout_i->caption());

		// signatureID
		$this->signatureID->EditAttrs["class"] = "form-control";
		$this->signatureID->EditCustomAttributes = "";
		$this->signatureID->EditValue = $this->signatureID->CurrentValue;
		$this->signatureID->PlaceHolder = RemoveHtml($this->signatureID->caption());

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
					$doc->exportCaption($this->Current_Location);
					$doc->exportCaption($this->Last_Date_Check);
					$doc->exportCaption($this->employee_id);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->picture);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->pullout_date);
				} else {
					$doc->exportCaption($this->inventory_id);
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
					$doc->exportCaption($this->Current_Location);
					$doc->exportCaption($this->Last_Date_Check);
					$doc->exportCaption($this->employee_id);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->remarks);
					$doc->exportCaption($this->user_last_modify);
					$doc->exportCaption($this->date_last_modify);
					$doc->exportCaption($this->item_id);
					$doc->exportCaption($this->pullout_date);
					$doc->exportCaption($this->pullout_i);
					$doc->exportCaption($this->signatureID);
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
						$doc->exportField($this->Current_Location);
						$doc->exportField($this->Last_Date_Check);
						$doc->exportField($this->employee_id);
						$doc->exportField($this->status);
						$doc->exportField($this->remarks);
						$doc->exportField($this->picture);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->pullout_date);
					} else {
						$doc->exportField($this->inventory_id);
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
						$doc->exportField($this->Current_Location);
						$doc->exportField($this->Last_Date_Check);
						$doc->exportField($this->employee_id);
						$doc->exportField($this->status);
						$doc->exportField($this->remarks);
						$doc->exportField($this->user_last_modify);
						$doc->exportField($this->date_last_modify);
						$doc->exportField($this->item_id);
						$doc->exportField($this->pullout_date);
						$doc->exportField($this->pullout_i);
						$doc->exportField($this->signatureID);
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
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'picture') {
			$fldName = "picture";
			$fileNameFld = "picture_type";
			$fileTypeFld = "picture_name";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->inventory_id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'tbl_inventory';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_inventory';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['inventory_id'];

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
		$table = 'tbl_inventory';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['inventory_id'];

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
		$table = 'tbl_inventory';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['inventory_id'];

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

		 // Enter your code here
	$rsnew["item_model"]=mb_strtoupper($rsnew["item_model"]);
	$rsnew["item_serial"]=mb_strtoupper($rsnew["item_serial"]);

	//$rsnew["name_accountable"]=mb_strtoupper($rsnew["name_accountable"]);
	//$rsnew["Designation"]=mb_strtoupper($rsnew["Designation"]);

	$rsnew["remarks"]=mb_strtoupper($rsnew["remarks"]);

		// To cancel, set return value to FALSE
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Inserting event
	function Row_Updating($rsold, &$rsnew) {

		 // Enter your code here
	$rsnew["item_model"]=mb_strtoupper($rsnew["item_model"]);
	$rsnew["item_serial"]=mb_strtoupper($rsnew["item_serial"]);

	//$rsnew["name_accountable"]=mb_strtoupper($rsnew["name_accountable"]);
	//$rsnew["Designation"]=mb_strtoupper($rsnew["Designation"]);

	$rsnew["remarks"]=mb_strtoupper($rsnew["remarks"]);

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

		$this->signatureID->ReadOnly = TRUE;
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>