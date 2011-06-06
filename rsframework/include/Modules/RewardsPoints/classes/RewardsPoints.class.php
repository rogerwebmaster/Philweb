<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 02 1, 11
 * Company: Philweb
 *****************************/
class RewardsPoints extends BaseEntity
{
    function RewardsPoints()
    {
        $this->ConnString = "devrewardspoints";
        $this->TableName = "tbl_rewardsession";
        $this->Identity = "ID";
    }

    function Deposit($sessionid, $cardnumber, $amount, $posaccountno, $serviceid = 3)
    {
//        $reward = null;
//        $rewards = null;
//        $reward["SessionID"] = $sessionid;
//        $reward["CardNumber"] = $cardnumber;
//        $reward["TransactionDate"] = $transactiondate;
//        $rewards[] = $reward;
//
//        return parent::Insert($reward);
        $procname = "sp_deposit";
        $params[] = $sessionid;
        $params[] = $cardnumber;
        $params[] = $amount;
        $params[] = $posaccountno;
        $params[] = $serviceid;
        return parent::RunQueryProc($procname, $params);

    }

    function Reload($sessionid, $amount, $posaccountno, $serviceid = 3)
    {
        $procname = "sp_reload";
        $params[] = $sessionid;
        $params[] = $amount;
        $params[] = $posaccountno;
        $params[] = $serviceid;
        return parent::RunQueryProc($procname, $params);

    }

    function Withdraw($sessionid, $amount, $posaccountno, $serviceid = 3)
    {
        $procname = "sp_withdraw";
        $params[] = $sessionid;
        $params[] = $amount;
        $params[] = $posaccountno;
        $params[] = $serviceid;
        return parent::RunQueryProc($procname, $params);

    }


}

?>

