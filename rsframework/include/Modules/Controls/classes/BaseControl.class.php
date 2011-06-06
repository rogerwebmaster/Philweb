<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 23, 10
 * Company: Philweb
 *****************************/
class BaseControl extends BaseObject
{
    var $Name;
    var $ID;
    var $Style;
    var $Args;
    var $Text;
    
    var $Caption;
    var $SubmittedValue;
    var $Enabled = true;
    var $Visible = true;
    var $ReadOnly = false;
    var $ShowCaption = false;
    var $Value;
    var $CssClass;

    protected $Attributes;
    private $ControlNumber;
    private $ControlType;


    protected function BaseControl()
    {
    }

    protected function Init($controltype)
    {
        $this->ControlType = $controltype;
        global $_ControlTypes;

        if ($this->Name == null)
        {
            if (!isset($_ControlTypes[$controltype]))
            {
                $_ControlTypes[$controltype][] = $controltype . "1";
            }
            else
            {
                $_ControlTypes[$controltype][] = $controltype . (count($_ControlTypes[$controltype]) + 1);
            }

            $name = $controltype . (count($_ControlTypes[$controltype]));
            $this->Name = $name;
            $this->ID = $name;
            $this->Caption = $name;
            //App::Pr("from init: $this->Name");
            //$this->AssignControlName();
        }
        

    }

    private function AssignControlName()
    {
        global $_ControlNames;
        global $_Controls;

        $nameexists = false;
        if (is_array($_ControlNames))
        {
            foreach($_ControlNames as $key => $val)
            {
                if ($key != $this->ControlNumber)
                {
                    if ($val == $this->Name)
                    {
                        $nameexists = true;
                    }
                }
            }
        }

        if ($nameexists == false || $this->ControlType == "Radio")
        {
            $this->ControlNumber = count($_ControlNames);
            $_ControlNames[$this->ControlNumber] = $this->Name;
            $_Controls[$this->ControlNumber] = $this;
            //App::Pr("key = $key; val = $val; control number: $this->ControlNumber; name = $this->Name;  from names : $val");
            //App::Pr("control number: $this->ControlNumber; name = $this->Name;");
        }
        else
        {
            die("Control Name $this->Name Already Exists");
        }

    }

    function ProcessForms()
    {
        //App::Pr("from Process Forms: $this->Name");
        $this->AssignControlName();
        if (isset($_POST[$this->Name]))
        {
            $this->SubmittedValue = $_POST[$this->Name];

            switch($this->ControlType)
            {
//                case "ComboBox": $this->SelectedIndexChanged($this->SubmittedValue);
//                break;
                case "ComboBox": $this->SetSelectedValue($this->SubmittedValue);
                break;
                case "TextBox": $this->Text = $this->SubmittedValue;
                break;
                case "DataList": $this->SelectedIndexChanged($this->SubmittedValue);
                break;
                case "Radio": $this->SetSelectedValue($this->SubmittedValue);
                break;
                case "Hidden": $this->Text = $this->SubmittedValue;
                break;
            }
        }
        else
        {
            switch($this->ControlType)
            {
//                case "ComboBox": $this->SelectedIndexChanged($this->SubmittedValue);
//                break;
                case "ComboBox": $this->SetDefaultSelectedValue();
                break;
                case "TextBox": $this->Text = $this->Text;
                break;
                case "Hidden": $this->Text = $this->SubmittedValue;
                break;
                
            }
        }
    }

    function UnProcessForms()
    {
        //App::Pr("from Process Forms: $this->Name");
        $this->AssignControlName();
        if (isset($_POST[$this->Name]))
        {
            $this->SubmittedValue = $_POST[$this->Name];

            switch($this->ControlType)
            {
//                case "ComboBox": $this->SelectedIndexChanged($this->SubmittedValue);
//                break;
                case "ComboBox": $this->SetDefaultSelectedValue();
                break;
                case "TextBox": $this->Text = "";
                break;
                case "Hidden": $this->Text = "";
                break;
                case "DataList": $this->SelectedIndexChanged($this->SubmittedValue);
                break;
                case "Radio": $this->Checked = false;
                break;
            }

        }
    }

    protected function Render()
    {
        //$this->AssignControlName();
        $name = $this->Name;
        $id = $this->ID;
        $caption = $this->Caption;
        $style = null;
        $args = $this->Args;
        $enabled = $this->Enabled;
        $readonly = $this->ReadOnly;
        $attributes = "";

        $name = $this->Name != null ? "name='$this->Name' " : '';
        $id = $this->ID != null ? "id='$this->ID' " : '';
        $style != null ? $style = "style='$this->Style' " : '';
        $args = $this->Args != null ? $args = $this->Args : '';
        $enabled = $this->Enabled == true ? "": "disabled='disabled' ";
        $visible = $this->Visible == true ? "": "style='display:none;' ";
        $readonly = $this->ReadOnly == false ? "": "readonly ";
        $cssclass = $this->CssClass != null ? "class='$this->CssClass' " : '';
        $attributes = $name . $id . $cssclass . $style . $args . $enabled . $visible . $readonly;

        $this->Attributes = $attributes;

        return $attributes;
    }

    private function  __set($name,  $value)
    {
        
//        if ($name == "Name")
//        {
//            $this->Name = $value;
//            $this->Init($this->ControlType);
//        }
    }

    private function  __toString()
    {
        return $this->Render();
    }


}
?>
