<?php

class PageController
{
	var $tmpVariables;
        
	
	function PageController()
	{
	}
	
	function setVariables($arrVar)
	{
            $this->tmpVariables = $arrVar;
	}
	
	function LoadTemplate($templatefile)
	{
            foreach($this->tmpVariables as $key=>$val)
            {
                ${$key} = $val;
            }
            return include(App::getParam("templatesdir") . $templatefile);
	}
	
}


?>