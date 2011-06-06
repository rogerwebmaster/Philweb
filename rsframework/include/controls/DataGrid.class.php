<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 28, 10
 * Company: Philweb
 *****************************/
class DataGrid extends BaseDataControl
{
    var $DataSelectColumn = 0;
    var $DataSelectValue = 0;
    var $SelectedItem = null;
    var $SelectedValue = null;
    var $SelectedText = null;
    var $SelectedIndex = null;
    var $Items;

    function ComboBox($Name = null, $ID = null, $Caption = null)
    {
        $this->Name = $Name;
        $this->ID = $ID;
        $this->Caption = $Caption;
        $this->Init("ComboBox");
    }

    function AddItem($listitem)
    {
        $this->Items[] = $listitem;
    }

    function ClearItems()
    {
        $this->Items = '';
    }

    function Render()
    {
        parent::Render();
        $strcombo = "$this->Caption<table $this->Attributes>";
        $strcombo .= $this->RenderItems();
        $strcombo .= "</table>";
        return $strcombo;
    }

    function DataBind()
    {
        parent::DataBind();

        if (isset($this->Data))
        {
            $data = $this->Data;
            $dataselecttext = $this->DataSelectColumn;
            $dataselectvalue = $this->DataSourceValue;

            for($i = 0; $i < count($data); $i++)
            {
                $dataitem = $data[$i];
                if (is_array($dataitem))
                {
                    $text = $dataitem[$datasourcetext];
                    $value = $dataitem[$datasourcevalue];
                }
                else
                {
                    $text = $dataitem;
                    $value = $i;
                }
                $li = new ListItem();
                $li->Text = $text;
                $li->Value = $value;
                $this->Items[] = $li;

            }
        }
    }

    private function RenderItems()
    {
        $strlistitem = "";

        for($i = 0; $i < count($this->Items); $i++)
        {
            $listitem = new ListItem();
            $listitem = $this->Items[$i];
            $text = $listitem->Text;
            $value = $i;
            $enabled = $listitem->Enabled;
            $selected = $listitem->Selected == true ? "selected" : "" ;
            $strlistitem .= "<option value='$value' $selected>$text</option>";
        }

        return $strlistitem;
    }

    function SelectedIndexChanged($index)
    {
        $listitem = $this->Items[$index];
        if ($listitem != null)
        {
            $this->SelectedItem = $listitem;
            $this->SelectedValue = $listitem->Value;
            $this->SelectedText = $listitem->Text;
            $this->SelectedIndex = $index;
            $listitem->Selected = true;
        }
    }

    public function  __toString()
    {
        return $this->Render();
    }
}
?>
