<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 11 2, 10
 * Company: Philweb
 *****************************/
class DataTable extends BaseObject
{
    public $Style;
    public $Class;
    public $DataItems;
    public $Cols;
    public $DataTableHeaders;
    public $DataItemColumns;
    public $DataTableFooters;
    public $AlternatingClass;
    public $SelectIdentity;
    public $SelectedIndex;
    public $DeleteIdentity;

    function DataTable()
    {

    }

    function PreRender()
    {
        $style = $this->Style != '' ? " style='$this->Style' ": '';
        $class = $this->Class != '' ? " class='$this->Class' ": '';
        $tablestring = "<table " . $style . $class . ">";
        if (count($this->DataTableHeaders) > 0)
        {
            foreach($this->DataTableHeaders as $key => $val)
            {
                $tablestring .= $val->Render();
            }
        }

        $alternate = false;
        if ($this->DataItems != null && count($this->DataItems) > 0)
        {
            foreach($this->DataItems as $key => $val)
            {
                $class = $alternate ? $this->AlternatingClass : "";
                $dr = new DataRow($key, $val, $this->DataItemColumns, $class, '');
                $dr->SelectIdentity = $this->SelectIdentity;
                $dr->DeleteIdentity = $this->DeleteIdentity;
                $tablestring .= $dr->Render();
                $alternate = !$alternate;
            }
        }

        if (count($this->DataTableFooters) > 0)
        {
            foreach($this->DataTableFooters as $key => $val)
            {
                $tablestring .= $val->Render();
            }
        }

        $tablestring .= "</table>";
        return $tablestring;
    }

    function Render()
    {
        return $this->PreRender();
    }


}

class DataTableHeader
{
    public $Style;
    public $ColumnHeaders;
    public $Class;

    function DataTableHeader($columnheaders='', $class = '', $style = '')
    {
        $this->ColumnHeaders = $columnheaders;
        $this->Class = $class;
        $this->Style = $style;
    }

    function Render()
    {
        $tablestring = "";
        $style = $this->Style != '' ? " style='$this->Style' ": '';
        $class = $this->Class != '' ? " class='$this->Class' ": '';
        //$title = $this->Title != '' ? " class='$this->Title' ": '&nbsp;';
        $tablestring .= "<tr " . $style . $class . ">";
        foreach($this->ColumnHeaders as $key => $val)
        {
            $tablestring .= $val->Render();
        }
        $tablestring .= "</tr>";
        return $tablestring;
    }
}

class ColumnHeader
{
    public $Style;
    public $Title;
    public $ColSpan;
    public $Class;
    public $DataColumn;

    function ColumnHeader($title = '', $colspan = '', $datacolumn = '', $class = '', $style = '')
    {
        $this->Title = $title;
        $this->ColSpan = $colspan;
        $this->DataColumn = $datacolumn;
        $this->Class = $class;
        $this->Style = $style;
    }

    function Render()
    {
        $tablestring = "";
        $style = $this->Style != '' ? " style='$this->Style' ": '';
        $class = $this->Class != '' ? " class='$this->Class' ": '';
        $title = $this->Title != '' ? $this->Title : '&nbsp;';
        $colspan = $this->ColSpan != '' ? " colspan='$this->ColSpan' ": '';
        $tablestring .= "<td " . $style . $class . $colspan . ">" . $this->Title . "</td>";
        return $tablestring;
    }
}

class DataRow
{
    public $Style;
    public $ColSpan;
    public $Class;
    public $DataItem;
    public $DataItemColumns;
    public $DataItemIndex;
    public $SelectIdentity;
    public $DeleteIdentity;

    function DataRow($index = '', $dataitem = '', $dataitemcolumns = '', $class = '', $style = '')
    {
        $this->DataItem = $dataitem;
        $this->Class = $class;
        $this->Style = $style;
        $this->DataItemColumns = $dataitemcolumns;
        $this->DataItemIndex = $index;
    }

    function Render()
    {
        $tablestring = "";
        $style = $this->Style != '' ? " style='$this->Style' ": '';
        $class = $this->Class != '' ? " class='$this->Class' ": '';
        $tablestring .= "<tr " . $style . $class . ">";
        foreach($this->DataItemColumns as $key => $val)
        {
            if (key_exists($val->DataColumn, $this->DataItem))
            {
                $item = $this->DataItem[$val->DataColumn];
                if ($val->WillTotal)
                {
                    $val->Total += $item;
                }
                if ($val->DataColumnType == 'Money')
                {
                    $item = number_format($item, 2);
                }
                if ($val->DataColumnType == 'CSV')
                {
                    $item = number_format($item, 0);
                }
                if ($val->SelectColumn == true)
                {
                    $selectidentity = $this->DataItem[$this->SelectIdentity];
                    $item = "<a href='javascript:SelectedIndexChange(\"$selectidentity\");'>$item</a>";
                }

                if ($val->DeleteColumn == true)
                {
                    $deleteidentity = $this->DataItem[$this->DeleteIdentity];
                    $item = "<a href='javascript:DeleteIndexChange($deleteidentity);'>$item</a>";
                }
                if ($val->Visible)
                {
                    $tablestring .= "<td " . $val->Style . $val->Class . ">" . $item . "</td>";
                }
            }
        }
        $tablestring .= "</td>";
        return $tablestring;
    }
}

class DataItemColumn
{
    public $Style;
    public $Text;
    public $ColSpan;
    public $Class;
    public $DataColumn;
    public $DataColumnType;
    public $WillTotal;
    public $Total;
    public $SelectColumn = false;
    public $DeleteColumn = false;
    public $Visible = true;

    function DataItemColumn($text = '', $colspan = '', $datacolumn = '', $class = '', $style = '', $datacolumntype = '', $willtotal = false, $selectcolumn = false, $deletecolumn = false)
    {
        $this->Text = $text;
        $this->ColSpan = $colspan;
        $this->DataColumn = $datacolumn;
        $this->Class = $class;
        $this->Style = $style;
        $this->DataColumnType = $datacolumntype;
        $this->WillTotal = $willtotal;
        $this->SelectColumn = $selectcolumn;
        $this->DeleteColumn = $deletecolumn;

        $this->Style = $this->Style != '' ? " style='$this->Style' ": '';
        $this->Class = $this->Class != '' ? " class='$this->Class' ": '';
    }
}


class DataTableFooter
{
    public $Style;
    public $Class;
    public $DataItemColumns;

    function DataTableFooter($dataitemcolumns = '', $class = '', $style = '')
    {
        $this->Class = $class;
        $this->Style = $style;
        $this->DataItemColumns = $dataitemcolumns;
    }

    function Render()
    {
        $tablestring = "";
        $style = $this->Style != '' ? " style='$this->Style' ": '';
        $class = $this->Class != '' ? " class='$this->Class' ": '';
        $tablestring .= "<tr " . $style . $class . ">";
        foreach($this->DataItemColumns as $key => $val)
        {
            $item = "&nbsp;";
            if ($val->WillTotal)
            {
                $item = $val->Total;
            }
            
            if ($val->DataColumnType == 'Money')
            {
                $item = number_format($item, 2);
            }
            if ($val->DataColumnType == 'CSV')
            {
                $item = number_format($item, 0);
            }
            if ($val->Visible)
            {
            $tablestring .= "<td " . $val->Style . $val->Class . ">" . $item . "</td>";
            }
        }
        $tablestring .= "</td>";
        return $tablestring;
    }
}
?>
