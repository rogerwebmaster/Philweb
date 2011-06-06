<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 08 15, 10
 * Company: Philweb
 *****************************/
class BaseEntity extends BaseObject
{
    var $Identity;
    var $TableName;
    var $ConnString;
    public $FoundRows;
    var $AffectedRows;

    function __construct()
    {
    }

    function Insert($arrEntries)
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $mydb->InsertSingle($this->TableName, $arrEntries);
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $mydb->LastInsertID;
    }

    function InsertMultiple($arrEntries)
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $mydb->InsertMultiple($this->TableName, $arrEntries);
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $mydb->AffectedRows;
    }

    protected function Update()
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $mydb->Update($this->ConvertToArray(), $this->Identity, $this->TableName);
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $mydb->AffectedRows;
    }

    protected function UpdateByArray($arrEntries)
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $mydb->Update($arrEntries, $this->Identity, $this->TableName);
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $mydb->AffectedRows;
    }

    function SelectByID($id)
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $query = "Select * from `$this->TableName` where `$this->Identity` = '$id'";
        //App::Pr($query);
        $result = $mydb->Query($query);
        $rows = null;
        while ($row = mysql_fetch_array($result))
        {
            $rows[] = $row;
        }
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $rows;
    }

    function SelectAll()
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $query = "Select * from `$this->TableName`";
        $result = $mydb->Query($query);
        $rows = null;
        while ($row = mysql_fetch_array($result))
        {
            $rows[] = $row;
        }
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $rows;
    }

    function SelectByWhere($where)
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $query = "Select * from `$this->TableName` $where";
        //App::Pr($query);
        $result = $mydb->Query($query);
        $rows = null;
        
        while ($row = mysql_fetch_array($result))
        {
            $rows[] = $row;
        }

        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $rows;
    }

    function RunQuery($query)
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $result = $mydb->RunQuery($query);
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $result;
    }

    function RunQueryProc($procname, $params = '')
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $result = $mydb->RunQueryProc($procname, $params);
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $result;
    }

    function ExecuteQuery($query)
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $result = $mydb->Execute($query);
        $this->AffectedRows = $mydb->AffectedRows;
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $result;
    }

    function ExecuteProc($procname, $params = '')
    {
        App::LoadDataClass("MySQLDatabase.php");
        $mydb = new MySQLDatabase($this->ConnString);
        $mydb->Open();
        $result = $mydb->ExecuteProc($procname, $params);
        $mydb->Close();
        if($mydb->getError())
        {
            $this->setError($mydb->getError());
        }
        return $result;
    }

    function ConvertToArray()
    {
        $objList = $this;
        $classname = get_class($objList);
        $objprops = get_class_vars($classname);

        $bvars = get_class_vars("BaseEntity");
        $data = null;
        foreach($objprops as $key=>$value)
        {
            if ($key != null && (!key_exists($key, $bvars)))
            {
                $data[$key] = $objList->{$key};
            }
        }
        return $data;
    }

    function ArrayToObject($arrEntries)
    {
        $classname = get_class($this);
        eval ('$objList = new ' . $classname . '();');
        
        $objprops = get_class_vars($classname);

        foreach($arrEntries as $key=>$val)
        {
            if (key_exists($key, $objprops))
            {
                $objList->{$key} = $arrEntries[$key];
            }
        }
        
        return $objList;

    }
}

?>
