<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 23, 10
 * Company: Philweb
 *****************************/
class TextBox extends BaseControl
{
    var $Length;
    var $Password = false;
    
    function TextBox($Name = null, $ID = null, $Caption = null, $Length=null)
    {
        $this->Name = $Name;
        $this->ID = $ID;
        $this->Caption = $Caption;
        $this->Length = $Length;
        $this->Init("TextBox");
    }

    function Render()
    {
        $text = $this->Text;
        parent::Render();
        $text != null ? $text = "value='$this->Text' " : '';
        $length = $this->Length != null ? "maxlength='$this->Length' " : "";
        $password = $this->Password == true ? "password" : "text";
        $caption = $this->ShowCaption == true ? "<label for='$this->Name'>" . $this->Caption . "</label>" : "";
        $strtextbox = "$caption<input type='$password' $length $this->Attributes $text>";
        return $strtextbox;
    }

}
?>
