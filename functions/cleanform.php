<?php
    function cleanForm($value){
        $value = trim($value);
        $value = strip_tags($value);
        $value = mb_strtolower($value);
        return $value;
    }

    function cryptPassword($password){
        $password = sha1($password);
        return $password;
    }
?>