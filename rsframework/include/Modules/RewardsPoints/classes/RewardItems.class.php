<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 03 10, 11
 * Company: Philweb
 *****************************/
class RewardItems extends BaseEntity
{
    function RewardItems()
    {
        $this->ConnString = "pegsloyalty";
        $this->TableName = "tbl_RewardItems";
        $this->Identity = "ID";
    }

    function SelectByCardType($cardtype)
    {
        $query = "select * from $this->TableName
        where `CardTypeID_FK` = '$cardtype'
        and `Status` = 'A';
        ";

        return parent::RunQuery($query);
    }

    function Redeem($sessionid, $cardnumber, $rewarditemid, $quantity)
    {
        $params = array ($sessionid, $cardnumber, $rewarditemid, $quantity);
        $procname = "sp_RedeemPoints";
        return parent::RunQueryProc($procname, $params);
    }
    
}
?>
