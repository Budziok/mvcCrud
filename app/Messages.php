<?php

class Messages {

    public static function setMessage($text, $type)
    {
        if($type == 'error')
        {
            $_SESSION['errorMsg'] = $text;
        } else {
            $_SESSION['successMsg'] = $text;
        }
    }

    public static function displayMessage()
    {
        if(isset($_SESSION['errorMsg']))
        {
            echo $_SESSION['errorMsg'];
            unset($_SESSION['errorMsg']);
        }
        if(isset($_SESSION['succesMsg']))
        {
            echo $_SESSION['successMsg'];
            unset($_SESSION['successMsg']);
        }
    }
}