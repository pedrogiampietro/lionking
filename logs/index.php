<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 16/08/2018
 * Time: 21:35
 */

$pass = $_REQUEST['pass'];

if($pass == "FERoBRA"){
    $file = new SplFileObject("../full_log.log");
    
    while (!$file->eof()){
        echo $file->fgets();
    }
    $file = NULL;
}else{
    header("Location: ../");
}