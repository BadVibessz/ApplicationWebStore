<?php
class Session
{
    public static function StartSession($user_id)
    {
        session_start();
        $_SESSION['id'] =$user_id;
    }
}