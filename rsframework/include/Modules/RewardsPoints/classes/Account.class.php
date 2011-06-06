<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 03 1, 11
 * Company: Philweb
 *****************************/

class Account extends BaseEntity
{
    function Account()
    {
        $this->ConnString = "pegsloyalty";
        $this->TableName = "";
    }

    function Login($username, $password, $transdetails = '')
    {
        $procname = "sp_Login";
        if ($transdetails == '')
        {
            $transdetails = "POS LP Registration";
        }

	$ipAddress = $_SERVER['REMOTE_ADDR'];
        $params = array($username, sha1($password), $transdetails, $ipAddress);
        return parent::RunQueryProc($procname, $params);
    }

    function CheckSession($sessionid)
    {
        $params[] = $sessionid;
        $procname = "sp_CheckSessionID";
        return parent::RunQueryProc($procname, $params);
    }

    function Logout()
    {
        
    }
}

?>
