<?php

/*****************************
 * Author: Roger Sanchez
 * Date Created: 07 8, 10
 * Company: Philweb
 *****************************/

class FTP extends BaseObject
{
    var $username;
    var $password;
    var $host;
    var $conn;

    function RSFTP()
    {

    }

    function Connect($host, $username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;

        $link = ftp_connect($host);
        $conn = ftp_login($link, $username, $password);
        $this->conn = $link;
    }
    
    function DisplayFiles()
    {
        $rawlist = ftp_nlist($this->conn, ".");
        return $rawlist;
    }

    function ChangeDir($directory)
    {
        ftp_chdir($this->conn, $directory);
    }

    function GetFile($local_file, $remote_file, $mode = FTP_BINARY)
    {
        return ftp_get($this->conn, $local_file, $remote_file, $mode);
    }

    function Close()
    {
        if ($this->conn)
        {
            ftp_close($this->conn);
        }
    }



}

?>
