<?php

class App
{
    function LoadClass($classname)
    {
        require_once(App::getParam("includedir") . $classname);
    }

    function NewLoadClass($classname)
    {
        require_once (App::getParam("classdir") . $classname);
    }

    function LoadDataClass($classname)
    {
        require_once (App::getParam("dataclassdir") . $classname);
    }

    function LoadSettings($settingsfile)
    {
        require_once (App::getParam("settingsdir") . $settingsfile);
    }

    function LoadCore($corefile)
    {
        require_once (App::getParam("coredir") . $corefile);
    }

    function LoadControl($controlfile)
    {
        App::LoadModule("Controls");
        require_once (App::getParam("controlsdir") . $controlfile . ".class.php");
    }

    function LoadLibrary($libraryfile)
    {
        require_once (App::getParam("librarydir") . $libraryfile);
    }

    function LoadModule($modulename)
    {
        require_once (App::getParam("moduledir") . $modulename . "/classes/Module.inc.php");
        eval ('$moduleclass = new ' . $modulename . 'ModuleClass();');
        $newclasses = $moduleclass->arrClasses;
        foreach($newclasses as $key=>$value)
        {
            require_once (App::getParam("moduledir") . $modulename . "/classes/$key.class.php");
        }
    }

    function LoadModuleClass($modulename, $classname)
    {
        require_once (App::getParam("moduledir") . $modulename . "/classes/" . $classname . ".class.php");
    }

    function getParam($paramname)
    {
            global $_CONFIG;
            return $_CONFIG[$paramname];
    }

    function getDBParam($paramname)
    {
            global $_DBCONF;
            return $_DBCONF[$paramname];
    }

    function GetAction()
    {
        if (isset($_POST["act"]))
        {
            return $_POST["act"];
        }
        else
        {
            return false;
        }
    }

    function GetFormValues($arrFormEntries)
    {
        if (isset($_POST[$arrFormEntries]))
        {
            return $_POST[$arrFormEntries];
        }
    }

    function Pr($variable)
    {
        print_r("<pre>");
        print_r($variable);
        print_r("</pre>");
    }
}

?>