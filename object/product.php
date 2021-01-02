<?php

$path = realpath(dirname(__FILE__));
require_once $path . '/../config/constant.php';
require_once $path . '/../config/function.php';
require_once $path . '/../object/database.php';

class product {

    public $query;
    public $tool;

    function __construct() {
        $this->query = new query();
        $this->tool = new tool();
    }

    public function insertproduct($data, $files) {
        //$this->tool->prx($data);
        $error = [];
        $name = $this->query->getSafeValue($this->tool->validation($data['name']));
        $catid = $this->query->getSafeValue($this->tool->validation($data['catid']));
        $brandid = $this->query->getSafeValue($this->tool->validation($data['brandid']));
        $description = $this->query->getSafeValue($this->tool->validation($data['description']));
        $price = $this->query->getSafeValue($this->tool->validation($data['price']));
        $type = $this->query->getSafeValue($this->tool->validation($data['type']));

        $image = $files['image'];
        $imagename = $image['name'];
        $imagsize = $image['size'];
        $imagetmpname = $image['tmp_name'];

        $explode = explode('.', $imagename);
        $end = strtolower(end($explode));
        $extention = ['jpg', 'jpeg', 'png'];
        if (!in_array($end, $extention)) {
            $error [] = 'please upload image with jpg/jpeg/png';
        }
        if ($imagsize > 1024 * 1024 * 3) {
            $error [] = 'you must upload 3 mb..!';
        }

        if ($name == '') {
            $error [] = ' Name Feild requred..!';
        }
        if ($catid == '') {
            $error [] = 'Category Feild requred..!';
        }
        if ($brandid == '') {
            $error [] = ' Brand Feild requred..!';
        }
        if ($description == '') {
            $error [] = 'Description Feild requred..!';
        }
        if ($price == '') {
            $error [] = 'Price Feild requred..!';
        }
        if ($type == '') {
            $error [] = ' Product Type Feild requred..!';
        }
        if (!$error) {
            $newimagename = 'product-' . uniqid() . '.' . $end;
            $condition = ["name" => $name, "catid" => $catid, "brandid" => $brandid, "description" => $description, "price" => $price, "type" => $type, "image" => $newimagename, 'status' => 1];
            $res = $this->query->insertData('product', $condition);
            if ($res == 1) {
                move_uploaded_file($imagetmpname, "../assets/frontend/upload/product/" . $newimagename);
                $error [] = ' Product Add Successfully..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function getproduct() {
        $condition = ['product.catid' => 'category.id', 'product.brandid' => 'brand.id'];
        $res = $this->query->getData('product,category,brand', 'product.*,category.name as category,brand.name as brand', $condition);
        return $res;
    }

    public function getProductById($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ["id" => $id];
        $res = $this->query->getData('product', '*', $condition);
        if ($res) {
            return $res;
        } else {
            $this->tool->redirect(ADMIN_SITE . 'productlist.php');
        }
    }

    public function updateproduct($data, $files, $dbimage, $id) {
        //$this->tool->prx($data);
        $error = [];
        $name = $this->query->getSafeValue($this->tool->validation($data['name']));
        $catid = $this->query->getSafeValue($this->tool->validation($data['catid']));
        $brandid = $this->query->getSafeValue($this->tool->validation($data['brandid']));
        $description = $this->query->getSafeValue($this->tool->validation($data['description']));
        $price = $this->query->getSafeValue($this->tool->validation($data['price']));
        $type = $this->query->getSafeValue($this->tool->validation($data['type']));

        $image = $files['image'];
        $imagename = $image['name'];
        $imagsize = $image['size'];
        $imagetmpname = $image['tmp_name'];
        if ($imagename != '') {
            $explode = explode('.', $imagename);
            $end = strtolower(end($explode));
            $extention = ['jpg', 'jpeg', 'png'];
            if (!in_array($end, $extention)) {
                $error [] = 'please upload image with jpg/jpeg/png';
            }
            if ($imagsize > 1024 * 1024 * 3) {
                $error [] = 'you must upload 3 mb..!';
            }
            if (!$error) {
                unlink("../assets/frontend/upload/product/" . $dbimage);
                $newimagename = 'product-' . uniqid() . '.' . $end;
                move_uploaded_file($imagetmpname, "../assets/frontend/upload/product/" . $newimagename);
            }
        } else {
            $newimagename = $dbimage;
        }
        if ($name == '') {
            $error [] = ' Name Feild requred..!';
        }
        if ($catid == '') {
            $error [] = 'Category Feild requred..!';
        }
        if ($brandid == '') {
            $error [] = ' Brand Feild requred..!';
        }
        if ($description == '') {
            $error [] = 'Description Feild requred..!';
        }
        if ($price == '') {
            $error [] = 'Price Feild requred..!';
        }
        if ($type == '') {
            $error [] = ' Product Type Feild requred..!';
        }
        if (!$error) {
            $condition = ["name" => $name, "catid" => $catid, "brandid" => $brandid, "description" => $description, "price" => $price, "type" => $type, "image" => $newimagename];
            $res = $this->query->updateData('product', $condition, 'id', $id);
            if ($res == 1) {
                $error [] = ' Product Update Successfully..!';
                return $error;
            }
        } else {
            return $error;
        }
    }

    public function productDelete($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $getimag = $this->getProductById($id);
        $image = $getimag[0]['image'];
        unlink("../assets/frontend/upload/product/" . $image);
        $condition = ['id' => $id];
        $res = $this->query->deleteData('product', $condition);
    }

    public function productStatus($id, $type) {
        if ($type == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }
        $condition = ['status' => $status];
        $this->query->updateData('product', $condition, 'id', $id);
    }

    public function getProductFront() {
        $condition = ["type" => 1, 'status' => 1];
        $res = $this->query->getData('product', '*', $condition, 'id', 'desc', 4);
        return $res;
    }

    public function getNewProductFront() {
        $condition = ['status' => 1];
        $res = $this->query->getData('product', '*', $condition, 'id', 'desc', 4);
        return $res;
    }

    public function getDetailsProductById($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ["id" => $id];
        $res = $this->query->getData('product', '*', $condition);
        if ($res) {
            $condition = ['product.catid' => 'category.id', 'product.brandid' => 'brand.id','product.id'=>$id];
            $res = $this->query->getData('product,category,brand', 'product.*,category.name as category,brand.name as brand', $condition);
            return $res;
        } else {
            $this->tool->redirect(SITE . '404.php');
        }
    }
    
    public function getLatestBrand(){
        $res = $this->query->getData('brand', '*');
        if($res){
            $arr = [];
            //$this->tool->prx($res);
            foreach ($res as $val){
                $id = $val['id'];
                $condition = ['brandid'=>$id,'status'=>1];
                $res = $this->query->getData('product', '*',$condition,'id','desc',1);
                $arr[] = $res;
                
            }
           return $arr ;
            //$this->tool->prx($arr);
        }
    }
    
       public function getProductByCatId($catid) {
        $catid = $this->query->getSafeValue($this->tool->validation($catid));
        $condition = ["catid" => $catid];
        $res = $this->query->getData('product', '*', $condition);
        if ($res) {
            return $res;
        } else {
            $this->tool->redirect(SITE . '404.php');
        }
    }

}

?>
