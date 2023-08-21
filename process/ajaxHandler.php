<?php
include_once "../bootstrap/init.php";





if(!isAjaxRequest()){

    echoAndDie("Invalid Request");

}


if (!isset($_POST['action']) || empty($_POST['action'])){
    
    echoAndDie("Invalid Action!");
}

switch($_POST['action']){

    case "addFolders":
        if(!isset($_POST['folderName']) || strlen($_POST['folderName'])<3 ){
            echo "Folder name must contain at least two characters";
            die();

        }
        addFolder($_POST['folderName']);
        $folders = getfolders();
        $sql = "ALTER TABLE folder AUTO_INCREMENT = 1";
        $pdo->query($sql);

        
    break;

    case "addTask":
        if(!isset($_POST['taskTitle']) || strlen($_POST['taskTitle'])<5){

            echo"Task title must contain at least 5 characters";
            die();
        }

        addTask($_POST['taskTitle']);
        $sql = "ALTER TABLE folder AUTO_INCREMENT = 1";
        $pdo->query($sql);

    break;

    default:
        echo "invalid action!";

        
         
}


