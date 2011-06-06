<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 22, 10
 * Company: Philweb
 *****************************/
class ComboBox extends BaseDataControl
{
    var $DataSourceText = 0;
    var $DataSourceValue = 0;
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
        $strcombo = "<label for='$this->Name'>$this->Caption</label><select $this->Attributes>";
        $strcombo .= $this->RenderItems();
        $strcombo .= "</select>";
        return $strcombo;
    }

    function DataBind()
    {
        
        if (isset($this->DataSourceText) && isset($this->DataSourceValue))
        {
            $this->DataColumns = array($this->DataSourceText, $this->DataSourceValue);
            parent::DataBind();

            if (isset($this->Data) && $this->Data != null)
            {
                $data = $this->Data;
                $datasourcetext = $this->DataSourceText;
                $datasourcevalue = $this->DataSourceValue;

                foreach($data as $key=>$val)
                {
                    $dataitem = $val;

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
    }

    private function RenderItems()
    {
        $strlistitem = "";

        for($i = 0; $i < count($this->Items); $i++)
        {
            $listitem = new ListItem();
            $listitem = $this->Items[$i];
            $text = $listitem->Text;
            $value = $listitem->Value;
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

    function SetSelectedValue($text)
    {
        $listitem = null;
        $index = null;
        foreach($this->Items as $key=>$val)
        {
            $li = $val;
            $listitem = $this->Items[$key];
            if ($text == $li->Value)
            {
                $listitem->Selected = true;
                $this->SelectedItem = $listitem;
                $this->SelectedValue = $listitem->Value;
                $this->Value = $listitem->Value;
                $this->SelectedText = $listitem->Text;
                $this->SelectedIndex = $key;
                
            }
            else
            {
                $listitem->Selected = false;
            }
        }
    }

    function SetDefaultSelectedValue()
    {
        foreach($this->Items as $key=>$val)
        {
            $li = $val;
            $listitem = $this->Items[$key];
            if ($listitem->Selected == true)
            {
                $listitem->Selected = true;
                $this->SelectedItem = $listitem;
                $this->SelectedValue = $listitem->Value;
                $this->Value = $listitem->Value;
                $this->SelectedText = $listitem->Text;
                $this->SelectedIndex = $key;

            }
            else
            {
                $listitem->Selected = false;
            }
        }
    }

//    public function  __toString()
//    {
//        return $this->Render();
//    }

}

?>
