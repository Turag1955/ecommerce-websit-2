<?php

$path = realpath(dirname(__FILE__));
require_once $path . '/../config/constant.php';
require_once $path . '/../config/function.php';
require_once $path . '/../object/database.php';

class user {

    public $query;
    public $tool;

    function __construct() {
        $this->query = new query();
        $this->tool = new tool();
    }

    public function userRegister($data) {
        //$this->tool->prx($data);
        $error = '';
        $name = $this->query->getSafeValue($this->tool->validation($data['name']));
        $city = $this->query->getSafeValue($this->tool->validation($data['city']));
        $zip = $this->query->getSafeValue($this->tool->validation($data['zip']));
        $email = $this->query->getSafeValue($this->tool->validation($data['email']));
        $address = $this->query->getSafeValue($this->tool->validation($data['address']));
        $country = $this->query->getSafeValue($this->tool->validation($data['country']));
        $phone = $this->query->getSafeValue($this->tool->validation($data['phone']));
        $password = $this->query->getSafeValue($this->tool->validation($data['password']));


        if ($name == '') {
            $error = ' Name Feild requred..!';
        } else if ($city == '') {
            $error = 'City Feild requred..!';
        } else if ($zip == '') {
            $error = ' Zip Feild requred..!';
        } else if ($email == '') {
            $error = 'Email Feild requred..!';
        } else if ($address == '') {
            $error = 'Address Feild requred..!';
        } else if ($country == '') {
            $error = ' Country Type Feild requred..!';
        } else if ($phone == '') {
            $error = ' Phone Type Feild requred..!';
        } else if ($password == '') {
            $error = ' Password Type Feild requred..!';
        } elseif ($email != '') {
            $condition = ['email' => $email];
            $res = $this->query->getData('user', 'email', $condition);
            if ($res) {
                $error = 'Email Allready Exist..!';
            }
        }

        if (!$error) {
            $haspassword = password_hash($password, PASSWORD_DEFAULT);
            $condition = ["name" => $name, "city" => $city, "zip" => $zip, "email" => $email, "address" => $address, "country" => $country, "phone" => $phone, 'password' => $haspassword, 'status' => 1];
            $res = $this->query->insertData('user', $condition);
            if ($res == 1) {
                $error = 'Register Successfully..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function userLogin($data) {
        $email = $this->query->getSafeValue($this->tool->validation($data['email']));
        $password = $this->query->getSafeValue($this->tool->validation($data['password']));
        $error = '';
        if ($email == '') {
            $error = 'email feild requred..!';
        } else if ($password == '') {
            $error = 'password feild requred..!';
        }

        if (!$error) {
            $condition = ["email" => " '$email' "];
            $res = $this->query->getData('user', '*', $condition);
            if ($res) {
                $dbpassword = $res[0]['password'];
                if (password_verify($password, $dbpassword)) {
                    session::set('userlogin', true);
                    session::set('username', $res[0]['name']);
                    session::set('userid', $res[0]['id']);
                    $this->tool->redirect(SITE . 'index.php');
                } else {
                    $error = 'password incorrect..!';
                    return $error;
                }
            } else {
                $error = 'email incorrect..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function getUser() {
        $id = session::get('userid');
        $condition = ["id" => $id];
        $res = $this->query->getData('user', '*', $condition);
        return $res;
    }

    public function userUpdate($data) {
        //$this->tool->prx($data);
        $error = '';
        $name = $this->query->getSafeValue($this->tool->validation($data['name']));
        $city = $this->query->getSafeValue($this->tool->validation($data['city']));
        $zip = $this->query->getSafeValue($this->tool->validation($data['zip']));
        $address = $this->query->getSafeValue($this->tool->validation($data['address']));
        $country = $this->query->getSafeValue($this->tool->validation($data['country']));
        $phone = $this->query->getSafeValue($this->tool->validation($data['phone']));
        if ($name == '') {
            $error = ' Name Feild requred..!';
        } else if ($city == '') {
            $error = 'City Feild requred..!';
        } else if ($zip == '') {
            $error = ' Zip Feild requred..!';
        } else if ($address == '') {
            $error = 'Address Feild requred..!';
        } else if ($country == '') {
            $error = ' Country Type Feild requred..!';
        } else if ($phone == '') {
            $error = ' Phone Type Feild requred..!';
        }

        if (!$error) {
            $condition = ["name" => $name, "city" => $city, "zip" => $zip, "address" => $address, "country" => $country, "phone" => $phone];
            $res = $this->query->updateData('user', $condition, 'id', session::get('userid'));
            if ($res == 1) {
                $error = ' Profile Update Successfully..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

}

?>
