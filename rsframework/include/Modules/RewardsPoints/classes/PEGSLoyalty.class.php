<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 02 1, 11
 * Company: Philweb
 *****************************/
class PEGSLoyalty extends BaseEntity
{
    function PEGSLoyalty()
    {
        $this->ConnString = "pegsloyalty";
        $this->TableName = "";
    }

    function AccumulatePoints($serialnumber, $playersessionid, $amount, $pegsaccountno, $transactiontype, $serviceid)
    {
        $retval = false;
        $procname = "sp_AcquirePoints";
        $procname = "sp_AddPoints";
        $params[] = $serialnumber;
        $params[] = $playersessionid;
        $params[] = $amount;
        $params[] = $pegsaccountno;
        $params[] = $transactiontype;
        $params[] = $serviceid;
        $plreturn = parent::RunQueryProc($procname, $params);

        return $this->ProcessReturnValues($plreturn);

    }

    function Withdraw($serialnumber, $playersessionid, $serviceid)
    {
        $retval = false;
        $procname = "sp_Withdraw";
        $params[] = $serialnumber;
        $params[] = $playersessionid;
        $params[] = $serviceid;
        return parent::RunQueryProc($procname, $params);
        //return $this->ProcessReturnValues($plreturn);
    }

    function ProcessReturnValues($plreturn)
    {
        $retval = false;

        if (is_array($plreturn) && count($plreturn) > 0)
        {
            $pl = $plreturn[0];
            if ($pl["StatusNo"] == 0)
            {
                $retval = true;
            }
            else
            {
                $this->setError($pl["StatusDesc"]);
            }
        }
        else
        {
            $this->setError("Transaction Failed");
        }

        return $retval;
    }

    function ProcessAutoDownGrade()
    {
        $procname = "sp_jobAutoDownGrade";
        return parent::ExecuteProc($procname);
    }

    function GetDailyIssuedCardCount($whatdate)
    {
        $query = "select count(ID)
  from PegsLoyaltyDB.tbl_Cards
  Where `Status` = 'A'
  and DateIssued = '$whatdate'
  order by DateIssued";
        return parent::RunQuery($query);
    }

    function GetDailyDeposits($whatdate)
    {

    }

    function CleanSessionLogs()
    {
        $procname = "sp_SessionLogClean";
        return parent::ExecuteProc($procname);
    }
}
?>
