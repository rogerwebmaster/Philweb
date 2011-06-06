<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 03 9, 11
 * Company: Philweb
 *****************************/
class RadioGroup extends BaseControl
{
    var $RadioControls;
    var $SelectedValue;

    function RadioGroup()
    {

    }

    function SetSelectedValue($selectedvalue)
    {
        if (count($this->RadioControls) > 0)
        {
            for ($i = 0; $i < count($this->RadioControls); $i++)
            {
                $radio = $this->RadioControls[$i];
                if ($radio->Value == $selectedvalue)
                {
                    $radio->Checked = true;
                }
                else
                {
                    $radio->Checked = false;
                }
            }
        }
    }

    function GetSelectedValue()
    {
        $selectedvalue = false;
        if (count($this->RadioControls) > 0)
        {
            for ($i = 0; $i < count($this->RadioControls); $i++)
            {
                $radio = $this->RadioControls[$i];
                if ($radio->Checked)
                {
                    $selectedvalue = $radio->Value;
                }
            }
        }
        return $selectedvalue;
    }
}
?>
