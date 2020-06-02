<?php
require_once '../libs/config.php';
require_once '../libs/app_user.php';
//header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='login'){
    $dt = $_POST['datalog'];
    parse_str($dt,$data);
    if (isset($data['pengguna'])&&isset($data['rahasia'])){
        $user = strtolower($data['pengguna']);
        $password = $data['rahasia'];
        $row = AppUser::user_login($user,$password);
        if($row=='false'){
            echo '{"status":false}';
        } else{
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            echo '{"status":true}';
        }
    }

} else if(isset($_GET['token']) && $_GET['token']=='logout'){
    $data = $_GET['data'];
    $sql = "UPDATE tb_user SET last_login=NOW(),status_login=0 WHERE username='".$data."'";
    $param = array('username' => $data);
    DBHandler::cExecute($sql,$param);
    session_unset();
    session_destroy();
    echo '{"status":true}';
} else {
    exit;
}