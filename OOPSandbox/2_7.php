<?php
class User
{
    public $name;
    public $age;
    public static $minPassLength = 6;

    public static function validadePass($pass)
    {
        return (strlen($pass) >= self::$minPassLength);
    }
}

$password = 'hello1';
if (User::validadePass($password))
    echo 'Password valid';
else
    echo 'Password NOT valid';