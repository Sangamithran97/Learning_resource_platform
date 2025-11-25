<?php

    $dbcon = mysqli_connect('localhost','root','','learning_platform');

    if($dbcon==false)
    {
        echo "Database is not Connected!";
    }
   
?>