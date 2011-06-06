<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 10 13, 10
 * Company: Philweb
 *****************************/
class JobLogs extends BaseEntity
{
    function JobLogs()
    {
        $this->ConnString = "jobscheduler";
        $this->TableName = "JobLogs";
    }

    function InsertJobLog($Service, $Method, $Remarks, $DateCreated)
    {
        $job["Service"] = $Service;
        $job["Method"] = $Method;
        $job["Remarks"] = $Remarks;
        $job["DateCreated"] = $DateCreated;
        $this->Insert($job);
    }
}
?>
