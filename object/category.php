<?php
$path = realpath(dirname(__FILE__));
require_once $path.'/../config/constant.php';
require_once $path.'/../config/function.php';
require_once $path.'/../object/database.php';

class category {

    public $query;
    public $tool;

    function __construct() {
        $this->query = new query();
        $this->tool = new tool();
    }

    public function insertcategory($name) {
        $name = $this->query->getSafeValue($this->tool->validation($name));

        $error = [];
        if ($name == '') {
            $error [] = 'Feild requred..!';
        }
        if (!$error) {
            $condition = ["name" => " '$name' "];
            $res = $this->query->getData('category', '*', $condition);
            if (!$res) {
                $condition = ["name" => $name];
                $res = $this->query->insertData('category', $condition);
                if ($res == 1) {
                    $error [] = 'Category Added';
                    return $error;
                }
            } else {
                $error [] = 'Category Name All ready Exits..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function getCategory() {
        $res = $this->query->getData('category', '*');
        return $res;
    }

    public function getCategoryById($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ["id" => $id];
        $res = $this->query->getData('category', '*', $condition);
        if ($res) {
            return $res;
        } else {
            $this->tool->redirect(ADMIN_SITE . 'catlist.php');
        }
    }

    public function updatecategory($dbid, $name) {
        $name = $this->query->getSafeValue($this->tool->validation($name));

        $error = [];
        if ($name == '') {
            $error [] = 'Feild requred..!';
        }
        if (!$error) {
            $condition = ["name" => " '$name' "];
            $res = $this->query->getData('category', '*', $condition);
            if (!$res) {
                $condition = ["name" => $name];
                $res = $this->query->updateData('category', $condition, 'id', $dbid);
                if ($res == 1) {
                    $this->tool->redirect(ADMIN_SITE . 'catlist.php');
                }
            } else {
                $error [] = 'Category Name All ready Exits..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function categoryDelete($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ['id' => $id];
        $res = $this->query->deleteData('category', $condition);
        if ($res == 1) {
            $msg = 'Delete Successfully';
            return $msg;
        }
    }

}

?>
