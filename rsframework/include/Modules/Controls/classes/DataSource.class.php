<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 22, 10
 * Company: Philweb
 *****************************/
class DataSource extends BaseObject
{
    var $arrDataColumns;
    var $DataKey;
    var $DataList;
    var $arrData;

    function DataSource($DataList)
    {
        if (get_class($DataList) == "ArrayList")
        {
            $this->DataList = $DataList;
        }
    }

    function GetData($arrDataColumns)
    {
        $this->arrDataColumns = $arrDataColumns;
        $datalist = $this->DataList;
        $data = "";
        for ($i = 0; $i < count($datalist); $i++)
        {
            $dataitem = $datalist[$i];
            
            if (is_array($dataitem))
            {
                $data[] = $this->GetDataFromArray($dataitem, $arrDataColumns);
            }
            elseif (is_string($dataitem))
            {
                $data[] = $dataitem;
            }
            else
            {
                $data[] = $this->GetDataFromObject($datalist[$i], $arrDataColumns);
            }
        }
        return $data;
    }

    function GetDataFromArray($dataitem, $arrDataColumns)
    {
        $data = "";
        for ($i = 0; $i < count($arrDataColumns); $i++)
        {
            if (array_key_exists($arrDataColumns[$i], $dataitem))
            {
                $data[$arrDataColumns[$i]] = $dataitem[$arrDataColumns[$i]];
            }
        }
        return $data;
    }

    function GetDataFromObject($dataitem, $arrDataColumns)
    {
        $objList = $dataitem;
        $classname = get_class($objList);
        
        $objprops = get_class_vars($classname);
        //print_r($dataitem);
        $data = null;
        for ($i = 0; $i < count($arrDataColumns); $i++)
        {
            if ($classname != "stdClass")
            {
                if (array_key_exists($arrDataColumns[$i], $objprops))
                {
                    $data[$arrDataColumns[$i]] = $objList->{$arrDataColumns[$i]};
                }
            }
            else
            {
                $data[$arrDataColumns[$i]] = $objList->{$arrDataColumns[$i]};
            }
        }
        return $data;
    }

    
    function GetNameValueFromObject($arrMixed, $propertyname, $propertyvalue)
    {
        for ($i = 0; $i < count($arrMixed); $i++)
        {
            $item = $arrMixed[$i];
            $this->AddOption($item->{$propertyname}, $item->{$propertyvalue});
        }
    }
}
?>
