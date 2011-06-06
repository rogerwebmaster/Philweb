<?php

global $_CONFIG;
$_CONFIG["debug"] = false;
$_CONFIG["devmode"] = false;

$_CONFIG["mgcsvdir"] = $_CONFIG["basepath"] . "csv/";
$_CONFIG["mgsoapdir"] = $_CONFIG["basepath"] . "soaplogs/";
$_CONFIG["mgcsvrawdir"] = $_CONFIG["basepath"] . "csvraw/";

$_CONFIG["mgwinningscsvrawdir"] = $_CONFIG["mgcsvrawdir"] . "MGWinnings/";
$_CONFIG["rtgwinningscsvrawdir"] = $_CONFIG["mgcsvrawdir"] . "RTGWinnings/";
$_CONFIG["ptgamehandcsvrawdir"] = $_CONFIG["mgcsvrawdir"] . "PTGameHand/";

$_CONFIG["mggrossholdcsvrawdir"] = $_CONFIG["mgcsvrawdir"] . "MGGrossHold/";
$_CONFIG["mgcreditreportcsvrawdir"] = $_CONFIG["mgcsvrawdir"] . "MGCreditReport/";

//********  Microgaming Configuration
$_CONFIG["microgamingwebservice"] = "";

$_CONFIG["loginName"] = "";
$_CONFIG["pinCode"] = "";

$mgftp["host"] = "";
$mgftp["username"] = "";
$mgftp["password"] = "";

$_CONFIG["microgamingftp"] = $mgftp;

$_CONFIG["mggrossholdurl"] = "";

$ptwebservice["host"] = "";
$ptwebservice["username"] = "";
$ptwebservice["password"] = "";
$_CONFIG["ptwebservice"] = $ptwebservice;

$_CONFIG["rtgcsvurl"] = "";
//$_CONFIG["loginName"] = "";
//$_CONFIG["pinCode"] = "";

?>