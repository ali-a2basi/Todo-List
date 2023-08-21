<?php

include "bootstrap/init.php";





if(isset($_GET['folderDeleteId']) && is_numeric($_GET['folderDeleteId'])){
    global $pdo;

    removeFolder($_GET['folderDeleteId']);
    $sql = "ALTER TABLE folder AUTO_INCREMENT = 1";
    $pdo->query($sql);
    redirection();
}





$folders = getFolders();

if(isset($_GET['taskDeletedId']) && is_numeric($_GET['taskDeletedId'])){
    global $pdo;

    removeTask($_GET['taskDeletedId']);
    $sql = "ALTER TABLE folder AUTO_INCREMENT = 1";
    $pdo->query($sql);
    redirection();
}

$tasks = getTasks();



include "template/tp-index.php";