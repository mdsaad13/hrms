<?php
ob_start();
session_start();

/*
    USAGE 

    Starting session :
        Session::SetSession('key',$VALUES);

    Retrieveing data from session :
        $id =  Session::GetSession('key');

    Destroying Session :
        Session::DestroySession();

*/

class Session
{
    public static function SetSession($key, $value)
    {
        $_SESSION[$key] = $value;
        return TRUE;
    }
    public static function GetSession($key)
    {
        //returns the session if exists else returns FALSE 
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : FALSE;
    }
    public static function DestroySession()
    {
        // remove all session variables
        session_unset();
        // destroy the session 
        session_destroy();
        return true;
    }
}
