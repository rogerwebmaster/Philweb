<?php

class BaseObject
{
	var $errormessage;
        var $HasError = false;
	private $arrErrors;
        
	protected function BaseObject()
	{
	}
	
	function getError()
	{
            return $this->errormessage;
	}
	
	function getErrors()
	{
            return $this->arrErrors;
	}
	
	function setError($errmessage)
	{
            if (isset($errmessage) && $errmessage !='')
            {
                $this->HasError = true;
		$this->errormessage = $errmessage;
		$this->arrErrors[] = $errmessage;
            }
	}
	
	function AddErrors($arrErr)
	{
            if (isset($arrErr) && count($arrErr) > 0)
            {
		$this->arrErrors[] = $arrErr;
            }
	}


}

?>