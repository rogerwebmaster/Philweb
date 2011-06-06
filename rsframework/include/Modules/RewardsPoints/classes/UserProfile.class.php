<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 03 10, 11
 * Company: Philweb
 *****************************/
class UserProfile extends BaseEntity
{
    var $StatusNo;
    var $StatusMessage;
    
    function UserProfile()
    {
        $this->ConnString = "pegsloyalty";
        $this->TableName = "tbl_Player";
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

    function UpdateProfile($params)
    {
        $procname = "sp_UpdateMember";
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
}
?>
