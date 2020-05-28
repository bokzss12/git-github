<?php
namespace PHPMaker2020\pantawid2020;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(10691, "mci_Home", $MenuLanguage->MenuPhrase("10691", "MenuText"), $MenuRelativePath . "tbl_itemlist.php", -1, "", TRUE, FALSE, TRUE, "fa fa-home", "", TRUE);
$topMenu->addMenuItem(10569, "mi_Dashboard1", $MenuLanguage->MenuPhrase("10569", "MenuText"), $MenuRelativePath . "Dashboard1dsb.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}Dashboard1'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10063, "mi_ticket_view2", $MenuLanguage->MenuPhrase("10063", "MenuText"), $MenuRelativePath . "ticket_view2list.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}ticket_view2'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10126, "mci_Add_Ticket", $MenuLanguage->MenuPhrase("10126", "MenuText"), $MenuRelativePath . "ticketadd.php", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(10565, "mci_Supplies_Library", $MenuLanguage->MenuPhrase("10565", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-list", "", TRUE);
$topMenu->addMenuItem(10443, "mi_tbl_supplies_cat", $MenuLanguage->MenuPhrase("10443", "MenuText"), $MenuRelativePath . "tbl_supplies_catlist.php", 10565, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_supplies_cat'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10144, "mi_tbl_sup_type", $MenuLanguage->MenuPhrase("10144", "MenuText"), $MenuRelativePath . "tbl_sup_typelist.php", 10565, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_sup_type'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10566, "mi_tbl_supplier", $MenuLanguage->MenuPhrase("10566", "MenuText"), $MenuRelativePath . "tbl_supplierlist.php", 10565, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_supplier'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(22, "mci_Inventory_Libraries", $MenuLanguage->MenuPhrase("22", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-list", "", TRUE);
$topMenu->addMenuItem(25, "mi_tbl_year", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "tbl_yearlist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_year'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(1, "mi_tbl_cat", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "tbl_catlist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_cat'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10328, "mi_tbl_accountable_name", $MenuLanguage->MenuPhrase("10328", "MenuText"), $MenuRelativePath . "tbl_accountable_namelist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_accountable_name'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(8, "mi_tbl_pos", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "tbl_poslist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_pos'), FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(10691, "mci_Home", $MenuLanguage->MenuPhrase("10691", "MenuText"), $MenuRelativePath . "tbl_itemlist.php", -1, "", TRUE, FALSE, TRUE, "fa fa-home", "", TRUE);
$sideMenu->addMenuItem(10569, "mi_Dashboard1", $MenuLanguage->MenuPhrase("10569", "MenuText"), $MenuRelativePath . "Dashboard1dsb.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}Dashboard1'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10323, "mi_inventory_view", $MenuLanguage->MenuPhrase("10323", "MenuText"), $MenuRelativePath . "inventory_viewlist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}inventory_view'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10063, "mi_ticket_view2", $MenuLanguage->MenuPhrase("10063", "MenuText"), $MenuRelativePath . "ticket_view2list.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}ticket_view2'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10126, "mci_Add_Ticket", $MenuLanguage->MenuPhrase("10126", "MenuText"), $MenuRelativePath . "ticketadd.php", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(5, "mi_tbl_item", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "tbl_itemlist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_item'), FALSE, FALSE, "fa fa-phone", "", FALSE);
$sideMenu->addMenuItem(10316, "mci_Report", $MenuLanguage->MenuPhrase("10316", "MenuText"), $MenuRelativePath . "ta_report2srch.php", 5, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_tbl_inventory", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "tbl_inventorylist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_inventory'), FALSE, FALSE, "fa fa-desktop", "", FALSE);
$sideMenu->addMenuItem(10110, "mi_Inventory_Report_1", $MenuLanguage->MenuPhrase("10110", "MenuText"), $MenuRelativePath . "Inventory_Report_1smry.php", 13, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}Inventory Report 1'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10331, "mi_per_employee2", $MenuLanguage->MenuPhrase("10331", "MenuText"), $MenuRelativePath . "per_employee2smry.php", 13, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}per_employee2'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10444, "mi_tbl_pr", $MenuLanguage->MenuPhrase("10444", "MenuText"), $MenuRelativePath . "tbl_prlist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_pr'), FALSE, FALSE, "fa fa-shopping-bag", "", FALSE);
$sideMenu->addMenuItem(10440, "mi_tbl_supplies", $MenuLanguage->MenuPhrase("10440", "MenuText"), $MenuRelativePath . "tbl_supplieslist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_supplies'), FALSE, FALSE, "fa fa-tint", "", FALSE);
$sideMenu->addMenuItem(10128, "mi_tbl_encoder", $MenuLanguage->MenuPhrase("10128", "MenuText"), $MenuRelativePath . "tbl_encoderlist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_encoder'), FALSE, FALSE, "fa fa-check", "", FALSE);
$sideMenu->addMenuItem(10108, "mi_Encoder_Report_1", $MenuLanguage->MenuPhrase("10108", "MenuText"), $MenuRelativePath . "Encoder_Report_1smry.php", 10128, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}Encoder Report 1'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10134, "mi_tbl_printing", $MenuLanguage->MenuPhrase("10134", "MenuText"), $MenuRelativePath . "tbl_printinglist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_printing'), FALSE, FALSE, "fa-print ", "", FALSE);
$sideMenu->addMenuItem(10109, "mi_Printing_Report_1", $MenuLanguage->MenuPhrase("10109", "MenuText"), $MenuRelativePath . "Printing_Report_1smry.php", 10134, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}Printing Report 1'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(30, "mi_tbl_borrowers", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "tbl_borrowerslist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_borrowers'), FALSE, FALSE, "fa fa-laptop", "", FALSE);
$sideMenu->addMenuItem(10565, "mci_Supplies_Library", $MenuLanguage->MenuPhrase("10565", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-list", "", TRUE);
$sideMenu->addMenuItem(10443, "mi_tbl_supplies_cat", $MenuLanguage->MenuPhrase("10443", "MenuText"), $MenuRelativePath . "tbl_supplies_catlist.php", 10565, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_supplies_cat'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10144, "mi_tbl_sup_type", $MenuLanguage->MenuPhrase("10144", "MenuText"), $MenuRelativePath . "tbl_sup_typelist.php", 10565, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_sup_type'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10566, "mi_tbl_supplier", $MenuLanguage->MenuPhrase("10566", "MenuText"), $MenuRelativePath . "tbl_supplierlist.php", 10565, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_supplier'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(22, "mci_Inventory_Libraries", $MenuLanguage->MenuPhrase("22", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-list", "", TRUE);
$sideMenu->addMenuItem(25, "mi_tbl_year", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "tbl_yearlist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_year'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(1, "mi_tbl_cat", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "tbl_catlist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_cat'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10328, "mi_tbl_accountable_name", $MenuLanguage->MenuPhrase("10328", "MenuText"), $MenuRelativePath . "tbl_accountable_namelist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_accountable_name'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(8, "mi_tbl_pos", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "tbl_poslist.php", 22, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}tbl_pos'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(9, "mi_employee", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "employeelist.php", -1, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}employee'), FALSE, FALSE, "fa-user-circle", "", FALSE);
$sideMenu->addMenuItem(11, "mi_userlevels", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "userlevelslist.php", 9, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10439, "mci_Settings", $MenuLanguage->MenuPhrase("10439", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-cog", "", FALSE);
$sideMenu->addMenuItem(10332, "mi_signatory", $MenuLanguage->MenuPhrase("10332", "MenuText"), $MenuRelativePath . "signatorylist.php", 10439, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}signatory'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10318, "mi_audittrailview", $MenuLanguage->MenuPhrase("10318", "MenuText"), $MenuRelativePath . "audittrailviewlist.php", 10439, "", AllowListMenu('{90E1F5A3-D649-4B17-9FD2-DCF249C755E1}audittrailview'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10320, "mci_Chart", $MenuLanguage->MenuPhrase("10320", "MenuText"), "", -1, "{4519DC18-D627-4431-91CA-4625CC9F65ED}", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
echo $sideMenu->toScript();
?>