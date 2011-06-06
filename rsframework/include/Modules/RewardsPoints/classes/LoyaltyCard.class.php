<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 03 2, 11
 * Company: Philweb
 *****************************/
class LoyaltyCard extends BaseEntity
{
    var $Barcode;
    var $SerialNumber;
    var $CardNumber;
    var $StatusNo;
    var $StatusMessage;

    function LoyaltyCard()
    {
        $this->ConnString = "pegsloyalty";
        $this->TableName = "tbl_Cards";
    }

    function Validate($cardnumber)
    {
        $procname = "sp_ValidateCard";
        $params[] = $cardnumber;
        $procresult = parent::RunQueryProc($procname, $params);
        $status = $procresult[0];
        $this->StatusNo = $status["StatusNo"];
        switch($status["StatusNo"])
        {
            case 0: $this->StatusMessage = "Card is available";
            break;
            case 1: $this->StatusMessage = "Card is already in use";
            break;
            case 2: $this->StatusMessage = "Card is Deactivated";
            break;
            case 3: $this->StatusMessage = "Card is Invalid";
            break;

        }

        return $procresult;
    }

    function Register($sessionID,$cardno,$username,$email,$genderid,$agerangeid,$ethnicityid,$smokerid,$contactno,$occupationid,$actno,$pegsessid)
    {
        $procname = "sp_AddNewMember";
        $params = array ($sessionID,$cardno,$username,$email,$genderid,$agerangeid,$ethnicityid,$smokerid,$contactno,$occupationid,$actno,$pegsessid);
        return parent::RunQueryProc($procname, $params);
    }

    function ViewMember($searchkey, $searchby)
    {
        $procname = "sp_ViewMember";
        $params[] = $searchby;
        $params[] = $searchkey;
        $procresult = parent::RunQueryProc($procname, $params);
        $status = $procresult[0];
        $this->StatusNo = $status["StatusNo"];
        switch($status["StatusNo"])
        {
            case 0: $this->StatusMessage = "Successful";
            break;
            case 1: $this->StatusMessage = "Card is already in use";
            break;
            case 2: $this->StatusMessage = "Card is Deactivated";
            break;
            case 3: $this->StatusMessage = "Card is Invalid";
            break;
            case 7: $this->StatusMessage = "Invalid Username";
            break;

        }
        return $procresult;
    }

    function ParseBarcode($barcode)
    {
        $this->Barcode = $barcode;
        $this->CardNumber = $barcode;
        if (strpos($barcode, "-") > -1)
        {
            $barcode = split("-", $barcode);
            $serialnumber = $barcode[0];
            $cnumber = substr($barcode[1], strlen($barcode[1]) - 3);
            $this->CardNumber = $serialnumber . $cnumber;
            $this->SerialNumber = $serialnumber;
        }
    }
}
?>
