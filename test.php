<?php

    if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
        print_r($_SESSION["user"]);
    }else{
        echo "it's empty";
    }