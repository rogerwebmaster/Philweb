<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 02 5, 11
 * Company: Philweb
 *****************************/

class Button extends BaseControl
{
    var $IsSubmit = false;

    function Button($Name = null, $ID = null, $Text = null)
    {
        $this->Name = $Name;
        $this->ID = $ID;
        $this->Text = $Text;
        $this->Init("Submit");
    }

    function Render()
    {
        $text = $this->Text;
        parent::Render();
        $text != null ? $text = "value='$this->Text' " : '';
        $issubmit = $this->IsSubmit == true ? "Submit" : "Button";
        $caption = $this->ShowCaption == true ? "<label for='$this->Name'>" . $this->Caption . "</label>" : "";
        $strtextbox = "$caption<input type='$issubmit' $this->Attributes $text>";
        return $strtextbox;
    }

    function  __toString()
    {
        return $this->Render();
    }
}

?>
