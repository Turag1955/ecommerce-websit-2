<?php
$path = realpath(dirname(__FILE__));
require_once $path.'/../config/constant.php';
require_once $path.'/../object/session.php';
session::init();
if(session::get('login')){
    header("location:index.php");
}
require_once $path.'/../object/database.php';
require_once $path.'/../config/function.php';




class adminlogin {

    private $query;
    private $tool;

    public function __construct() {
        $this->query = new query();
        $this->tool = new tool();
    }

    public function login($username, $password) {
        $username = $this->query->getSafeValue($this->tool->validation($username));
        $password = $this->query->getSafeValue($this->tool->validation($password));
        $error = [];
        if ($username == '') {
            $error [] = 'user feild requred..!';
        }
        if ($password == '') {
            $error [] = 'password feild requred..!';
        }

        if (!$error) {
            $condition = ["username" => " '$username' "];
            $res = $this->query->getData('admin', '*', $condition);
            if ($res) {
                $dbpassword = $res[0]['password'];
                if (password_verify($password, $dbpassword)) {
                    session::set('login', true);
                    session::set('adminname', $res[0]['username']);
                    session::set('adminid', $res[0]['id']);
                    session::set('adminrole', $res[0]['userrole']);
                    $this->tool->redirect(ADMIN_SITE.'index.php');
                } else {
                      $error []  = 'password incorrect..!';
                      return $error;
                }
            } else {
                 $error []  = 'username incorrect..!';
                  return $error;
            }
        } else {
            return $error;
        }
    }

}
//http://localhost/shop/admin/%20index.php

?>