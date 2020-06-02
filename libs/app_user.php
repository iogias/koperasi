<?php
if (!defined('WEB_ROOT')) {
    exit;
}

class AppUser {
    private static function cek_user($user,$pass){
        $sql = "SELECT password FROM tb_user WHERE username='".$user."' AND status=1";
        $param = array('username'=>$user);
        $password = DbHandler::getOne($sql, $param);
        if(password_verify($pass, $password)){
            return $password;
        } else {
            return FALSE;
        }
    }

    public static function user_login($user,$pass){
        $valid_p = self::cek_user($user,$pass);
        if($valid_p){
            $update = "UPDATE tb_user SET status_login=1 WHERE username='".$user."'";
            $param_u = array('username' =>$user);
            DbHandler::cExecute($update,$param_u);
            $sql = "SELECT * FROM tb_user WHERE username='".$user."' AND password='".$valid_p."'";
            $param = array('username'=>$user,'password'=>$valid_p);
            return DbHandler::getRow($sql, $param);
        } else {
            $msg = "false";
            return $msg;
        }
    }
}