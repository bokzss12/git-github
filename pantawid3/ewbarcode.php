<?php
namespace PHPMaker2020\pantawid2020;

// Autoload
include_once "autoload.php";

// Write barcode
Barcode()->write(Get("data"), Get("encode"), Get("height"), Get("color"));
?>