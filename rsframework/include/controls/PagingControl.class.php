<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 11 7, 10
 * Company: Philweb
 *****************************/
class PagingControl extends BaseObject
{
    public $Pager;
    public $SelectedPageClass;
    public $SelectedPage;
    public $URL;

    function PagingControl()
    {

    }

    function Render()
    {
        $pg = $this->Pager;
        $pages = null;
        $pagestring = "";
        while($pg->NextPage())
        {
            $url = " href='$this->URL' ";
            $class = "";
            if (isset($this->SelectedPage) && $this->SelectedPage == $pg->CurrentPage)
            {
                $class = " class='$this->SelectedPageClass' ";
                $url = "";
                $pagestring .= "Displaying $pg->CurrentPage of $pg->PageCount &nbsp;";
            }
            $url = str_replace("%currentpage", $pg->CurrentPage, $url);
            $pages[] = "<a $url $class >$pg->CurrentPage </a>";
        }
        if (count($pages) > 0)
        {
            
            $pagestring .= implode(" | ", $pages);
        }
        return $pagestring;
    }
}


?>
