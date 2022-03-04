<?php

    //this function forward me to the main path of my app, meaning Ecommerce path
function base_path()
{
    //__DIR__ returns the directory of the included file.... then use"\.." until reach base path
    return __DIR__ . "\..\..\\";
}

function bcrypt(string $password): string
{
    return password_hash($password, PASSWORD_BCRYPT);
}
