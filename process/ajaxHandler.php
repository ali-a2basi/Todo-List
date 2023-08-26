<?php
include_once "../bootstrap/init.php";





if(!isAjaxRequest()){

    echoAndDie("Invalid Request");

}


if (!isset($_POST['action']) || empty($_POST['action'])){
    
    echoAndDie("Invalid Action!");
}

switch($_POST['action']){

    case "addFolder":
        if(!isset($_POST['folderName']) || strlen($_POST['folderName'])<3 ){
            echo "Folder name must contain at least two characters";
            die();

        }
    echo addFolder($_POST['folderName']);
    


        
    break;

    case "addTask":
        

        if(!isset($_POST['taskTitle']) || strlen($_POST['taskTitle'])<5){

            echo 'task title must include at least five characters';

        }

        echo addTask($_POST['taskTitle'], $_POST['folderId']);
        

    break;
    

    case "doneSwitch":
        $taskId = $_POST['taskId'];
        if(!isset($_POST['taskId']) || is_numeric($_POST)){

            echo 'this task-id is not selected or it does not exist at all';

        }

        doneSwitch($taskId);
    break;

    default:
        echo "invalid action!";

        
         
}


