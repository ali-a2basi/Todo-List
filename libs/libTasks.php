<?php

function getCurrentUserId(){

    return $_SESSION['login']->id;
}
function addFolder($folderName){

    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO folder (name, userID)
    VALUES(:folderName,:userID)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folderName' =>$folderName, ':userID'=>$currentUserId]);
    return $stmt->rowCount();
    
    
}

 
function removeFolder($folderDeleteId){

    global $pdo;
    $sql = "DELETE FROM folder WHERE id = $folderDeleteId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
    
}
function getFolders(){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM folder WHERE userID = $currentUserId ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}


function getTasks(){
    global $pdo;
    $folder = $_GET['folderId'] ?? null;
    $sqlFolderCondition='';
    if (isset($folder) && is_numeric($folder)){

        $sqlFolderCondition = "and folderID = $folder ";
    }
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM `task`  WHERE userID = $currentUserId $sqlFolderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;

}



function removeTask($taskDeletedId){
    
    global $pdo;
    $sql = "DELETE FROM task WHERE id = $taskDeletedId ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();

}


function addTask($taskTitle, $folderId){

    
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO task (title, userID, folderId)
    VALUES(:taskTitle,:userID, :folderId)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':taskTitle'=>$taskTitle, ':userID'=>$currentUserId, ':folderId'=>$folderId]);
    return $stmt->rowCount();
    

}

function doneSwitch ($taskId){

    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = 'UPDATE task SET isDone = 1 - isDone WHERE  id = :id and userID = :userId';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id'=>$taskId, ':userId'=>$currentUserId]);
    $stmt->rowCount();

}



function getUser(){

    //
}



