<?php
$path = realpath(dirname(__FILE__));
require_once $path.'/../config/constant.php';
require_once $path.'/../config/function.php';
require_once $path.'/../object/database.php';

class brand {

    public $query;
    public $tool;

    function __construct() {
        $this->query = new query();
        $this->tool = new tool();
    }

    public function insertbrand($name) {
        $name = $this->query->getSafeValue($this->tool->validation($name));

        $error = [];
        if ($name == '') {
            $error [] = 'Feild requred..!';
        }
        if (!$error) {
            $condition = ["name" => " '$name' "];
            $res = $this->query->getData('brand', '*', $condition);
            if (!$res) {
                $condition = ["name" => $name];
                $res = $this->query->insertData('brand', $condition);
                if ($res == 1) {
                    $error [] = 'brand Added';
                    return $error;
                }
            } else {
                $error [] = 'brand Name All ready Exits..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function getBrand() {
        $res = $this->query->getData('brand', '*');
        return $res;
    }

    public function getBrandById($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ["id" => $id];
        $res = $this->query->getData('brand', '*', $condition);
        if ($res) {
            return $res;
        } else {
           $this->tool->redirect(ADMIN_SITE . 'brandlist.php');
        }
    }

    public function updateBrand($dbid, $name) {
        $name = $this->query->getSafeValue($this->tool->validation($name));

        $error = [];
        if ($name == '') {
            $error [] = 'Feild requred..!';
        }
        if (!$error) {
            $condition = ["name" => " '$name' "];
            $res = $this->query->getData('brand', '*', $condition);
            if (!$res) {
                $condition = ["name" => $name];
                $res = $this->query->updateData('brand', $condition, 'id', $dbid);
                if ($res == 1) {
                    $this->tool->redirect(ADMIN_SITE . 'brandlist.php');
                }
            } else {
                $error [] = 'brand Name All ready Exits..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function brandDelete($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ['id' => $id];
        $res = $this->query->deleteData('brand', $condition);
        if ($res == 1) {
            $msg = 'Delete Successfully';
            return $msg;
        }
    }
      public function getBrandByName($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ["id" => $id];
        $res = $this->query->getData('brand', '*', $condition);
        if ($res) {
            return $res;
        } else {
          // $this->tool->redirect(ADMIN_SITE . 'brandlist.php');
        }
    }

}

?>
