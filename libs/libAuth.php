<?php
 


function isLoggedIn(){
    
    return $_SESSION['login']?true:false;
}



function register($userData){
    // echo"<pre>";
    // var_dump($userData);
    // echo"</pre>";
    global $pdo;
    

    $sql = "INSERT INTO user (fullName, email, pass)
    VALUES(:fullName, :email, :pass)";
    $pass=password_hash($userData['pass'], PASSWORD_BCRYPT);
    $stmt = $pdo->prepare($sql);
    // $stmt->bindParam("sss", $userData['username'], $userData['email'], $userData['pass']);
    $stmt->execute([':fullName'=>$userData['username'], ':email'=>$userData['email'], ':pass'=>$pass]);
    return $stmt->rowCount()?true:false;
    


}

function getUserByEmail($email){


    global $pdo;
    $sql = 'SELECT * FROM user WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email"=>$email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}

function login($email){
    $user = getUserByEmail($email);
    if(is_null($user)){

        return false;
    }else{
        $_SESSION['login'] = $user;

        return true;



    }
    return false;
    
    
}


function getLoggedInData(){
    return $_SESSION['login'];

}

