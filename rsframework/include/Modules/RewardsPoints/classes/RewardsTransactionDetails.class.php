<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 02 1, 11
 * Company: Philweb
 *****************************/

class RewardsTransactionDetails extends BaseEntity
{
    function RewardsTransactionDetails()
    {
        $this->TableName = "tbl_rewardstransactiondetails";
        $this->ConnString = "devrewardspoints";
        $this->Identity = "ID";
    }

    function AddPoints($sessionid, $rewardsessionid, $transactiontype, $amount, $transactiondate)
    {
        $reward = null;
        $rewards = null;
        $reward["RewardSessionID"] = $rewardsessionid;
        $reward["SessionID"] = $sessionid;
        $reward["TransactionType"] = $transactiontype;
        $reward["Amount"] = $amount;
        $reward["TransactionDate"] = $transactiondate;
        $rewards[] = $reward;

        return parent::InsertMultiple($rewards);
    }

    function GetUnprocessedPoints()
    {
        $query = "select a.CardNumber, a.SessionID, c.Amount, a.POSAccountNo, c.ID, c.TransactionType, a.ServiceID

  from tbl_rewardsession a

  -- inner join pos.ptbl_player_sessionhistory_stnmgr b
  -- on a.SessionID = b.PK_PlayerSessionHistoryID

  inner join $this->TableName c
  on c.SessionID = a.SessionID

        where c.Status = 0
                and a.ServiceID = c.ServiceID
  ;";
        return parent::RunQuery($query);
    }
    
    function UpdateSuccessfulTransaction($sessiondetailid)
    {
        $query = "update $this->TableName
        set Status = 1
        where $this->Identity = $sessiondetailid";

        return parent::ExecuteQuery($query);
    }

    function UpdateFailedTransaction($sessiondetailid, $errormessage)
    {
        $query = "update $this->TableName
        set Status = 2, ErrorMessage = '$errormessage'
        where $this->Identity = $sessiondetailid";

        return parent::ExecuteQuery($query);
    }



    function Reload($sessionid, $amount, $transactiondate)
    {

    }
}
?>
