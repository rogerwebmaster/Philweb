<?php


/************************************************
Author: Roger Sanchez
Date Created: May 12, 2010
Company: Philweb
**************************************************/

// POS DB Globals
global $_DBCONF;

$pos["host"] = "202.44.102.8";
$pos["username"] = "[username here]";
$pos["password"] = "[password here]";
$pos["dbname"] = "rewardspoints";
$_DBCONF["devrewardspoints"] = $pos;

$pos["host"] = "172.16.102.35";
$pos["username"] = "[username here]";
$pos["password"] = "[password here]";
$pos["dbname"] = "PegsLoyaltyDB";
$_DBCONF["pegsloyalty"] = $pos;


?>