<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 26, 10
 * Company: Philweb
 *****************************/
class FormsProcessor
{
    var $IsPostBack = false;
    var $HasGetVars = false;
    var $arrControls;
    
    function FormsProcessor()
    {
        $this->CheckPostBack();
        $this->CheckGetVars();
    }

    private function CheckPostBack()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $this->IsPostBack = true;
        }
    }

    private function CheckGetVars()
    {
        if (isset($_GET) && count($_GET) > 0)
        {
            $this->HasGetVars = true;
        }
    }

    function AddControl($control)
    {
        $this->arrControls[] = $control;
    }

    function ProcessForms()
    {
        if (is_array($this->arrControls))
        {
            foreach ($this->arrControls as $key=>$val)
            {
                $val->ProcessForms();
            }
        }
    }

    function UnProcessForms()
    {
        if (is_array($this->arrControls))
        {
            foreach ($this->arrControls as $key=>$val)
            {
                $val->UnProcessForms();
            }
        }
    }

    function GetQueryStringParams($arrFields)
    {
        $arrQueryString = null;
        if ($this->HasGetVars)
        {
            foreach ($arrFields as $key=>$val)
            {
                if (key_exists($val, $_GET))
                {
                    $arrQueryString[$val] = $_GET[$val];
                }
            }
        }

        return $arrQueryString;
    }

    function GetPostVar($formname)
    {
        if ($this->IsPostBack)
        {
            if (key_exists($formname, $_POST))
            {
                return $_POST[$formname];
            }
            else
            {
                return false;
            }
        }
    }

}

?>
