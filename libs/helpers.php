<?php 
function echoAndDie($text){
    echo "<div style='padding: 30px; width: 80%; margin: 50px auto; background: #f9dede; border: 1px solid #cca4a4; color: #521717; border-radius: 5px; font-family: sans-serif;text-align:center;'>$text</div>";;
    die();
}

function redirection(){

    $redirect = header('Location: http://localhost/PHP/Project/7Todo/');
    echo $redirect;
    exit();
    
}

function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }else{
    
        return false;
    }
}


function dd($var){
    echo "<pre style = 'color: #9c4100 ; z-index: 999; position:absolute;background:#fff;padding:10px;margin:10px;border-radius:5px;border-left:3px solid red;'";
    var_dump($var);
    echo "</pre>";
}

