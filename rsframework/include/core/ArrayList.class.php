<?php
/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 22, 10
 * Company: Philweb
 *****************************/
class ArrayList extends ArrayObject
{
    var $arrList;

    function ArrayList()
    {
        //parent::
        //return $this->arrList;
    }

    function Add($obj)
    {
        $this[] = $obj;
    }

    function AddArray($arrObj)
    {
        if (is_array($arrObj))
        {
            foreach($arrObj as $key => $val)
            {
                $this[] = $val;
            }
        }
    }
}

?>
