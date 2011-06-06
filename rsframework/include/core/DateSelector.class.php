<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 10 15, 10
 * Company: Philweb
 *****************************/
class DateSelector extends BaseObject
{
    var $CurrentDateNoFormat;
    var $CurrentDate;
    var $NextDate;
    var $PreviousDate;
    var $DateFormat = "Y-m-d";

    function DateSelector($whatdate = 'now', $dateformat = "Y-m-d")
    {
        $this->SetDate($whatdate, $dateformat);
    }
    
    function SetDate($whatdate = 'now', $dateformat = "Y-m-d")
    {
        if (isset($dateformat))
        {
            $this->DateFormat = $dateformat;
        }

        $date = new DateTime($whatdate);
        $this->CurrentDateNoFormat = $date;
        $this->CurrentDate = $date->format($this->DateFormat);
        $date->modify("+1 days");
        $this->NextDate = $date->format($this->DateFormat);
        $date->modify("-2 days");
        $this->PreviousDate = $date->format($this->DateFormat);
        $date->modify("+1 days");
    }

    function AddDays($numofdays, $dateformat = "Y-m-d")
    {
        $date = $this->CurrentDateNoFormat;
        $date->modify("+$numofdays days");
        $this->SetDate($date->format($this->DateFormat), $dateformat);
    }

    function AddWeeks($numofweeks, $dateformat = "Y-m-d")
    {
        $date = $this->CurrentDateNoFormat;
        $date->modify("+$numofweeks weeks");
        $this->SetDate($date->format($this->DateFormat), $dateformat);
    }

    function AddMonths($numofmonths, $dateformat = "Y-m-d")
    {
        $date = $this->CurrentDateNoFormat;
        $date->modify("+$numofmonths months");
        $this->SetDate($date->format($this->DateFormat), $dateformat);
    }

    function AddYears($numofyears, $dateformat = "Y-m-d")
    {
        $date = $this->CurrentDateNoFormat;
        $date->modify("+$numofyears years");
        $this->SetDate($date->format($this->DateFormat), $dateformat);
    }

    function GetCurrentDateFormat($dateformat = '')
    {
        if ($dateformat == '')
        {
            $dateformat = $this->DateFormat;
        }

        $date = $this->CurrentDateNoFormat;
        return $date->format($dateformat);
    }

    function GetPreviousDateFormat($dateformat = '')
    {
        if ($dateformat == '')
        {
            $dateformat = $this->DateFormat;
        }
        $dt = $this->CurrentDateNoFormat;
        $date = new DateTime($dt->format("Y-m-d"));
        $date->modify("-1 days");
        return $date->format($dateformat);
    }

    function GetNextDateFormat($dateformat = '')
    {
        if ($dateformat == '')
        {
            $dateformat = $this->DateFormat;
        }
        $dt = $this->CurrentDateNoFormat;
        $date = new DateTime($dt->format("Y-m-d"));
        $date->modify("-1 days");
        return $date->format($dateformat);
    }
    
}
?>
