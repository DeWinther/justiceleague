<?php

function cleanInput($data)
{
    //remove tags
    strip_tags($data);


    //whitelist
    echo $data;
//    exit;
    if (preg_match("/[^aA-zZ0-9?!,. '()@=]+/", $data))
    {
//        header("location: view/signup.php?lowercase");
//        exit();
        echo 'special characters are not allowed';

        return 'hell-no';
    }

    return $data;
}