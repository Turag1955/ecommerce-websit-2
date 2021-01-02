<?php

$path = realpath(dirname(__FILE__));
require_once $path . '/../config/constant.php';
require_once $path . '/../config/function.php';
require_once $path . '/../object/database.php';

class cart {

    private $query;
    private $tool;

    function __construct() {
        $this->query = new query();
        $this->tool = new tool();
    }

    public function addToCart($qty, $id) {
        $qty = $this->query->getSafeValue($this->tool->validation($qty));
        $session_id = session_id();

        $cartcondition = ["product_id" => $id, "session_id" => " '$session_id' "];
        $getCartResult = $this->query->getData('addcart', '*', $cartcondition);

        if ($getCartResult) {
            return 1;
        } else {
            $cond = ["id" => $id];
            $res = $this->query->getData('product', '*', $cond);

            $condition = ["product_id" => $id, "session_id" => session_id(), "name" => $res[0]['name'], "qty" => $qty, "price" => $res[0]['price'], "image" => $res[0]['image']];
            $result = $this->query->insertData('addcart', $condition);
            if ($result == 1) {
                $this->tool->redirect(SITE . 'cart.php');
            }
        }
    }

    public function getCart() {
        $session_id = session_id();
        $condition = ["session_id" => " '$session_id' "];
        $res = $this->query->getData('addcart', '*', $condition);
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

    public function updateQty($data) {
        $qty = $this->query->getSafeValue($this->tool->validation($data['qty']));
        $cart_id = $this->query->getSafeValue($this->tool->validation($data['cart_id']));
        $condition = ["qty" => $qty];
        $res = $this->query->updateData('addcart', $condition, 'id', $cart_id);
        if ($res == 1) {
            return 1;
        }
    }

    public function cartDelete($id) {
        $id = $this->query->getSafeValue($this->tool->validation($id));
        $condition = ['id' => $id];
        $res = $this->query->deleteData('addcart', $condition);
        if ($res == 1) {
            return 1;
        }
    }

    public function orderInsert() {
        $res = $this->getCart();
        foreach ($res as $val) {
            $user_id = session::get('userid');
            $product_id = $val['id'];
            $name = $val['name'];
            $qty = $val['qty'];
            $price = $val['price'];
            $image = $val['image'];
            $condition = ['user_id' => $user_id, "product_id" => $product_id, "name" => $name, "qty" => $qty, "price" => $price, "image" => $image];
            $result = $this->query->insertData('orders', $condition);
        }
        if ($result == 1) {
            $sesssion_id = session_id();
            $condition = ['session_id' => " '$sesssion_id' "];
            $this->query->deleteData('addcart', $condition);
            $this->tool->redirect(SITE . 'orderdetails.php');
        }
    }

    public function getOrderdetails() {
        $user_id = session::get('userid');
        $condition = ["user_id" => $user_id];
        $res = $this->query->getData('orders', '*', $condition);
        return $res;
    }

    public function orderDelete($orderid) {
        $orderid = $this->query->getSafeValue($this->tool->validation($orderid));
        $condition = ['id' => $orderid];
        $res = $this->query->deleteData('orders', $condition);
        if ($res == 1) {
            return 1;
        }
    }

    public function getOrder() {
        $res = $this->query->getData('orders', '*', '', 'insertdate', 'desc');
        return $res;
    }

    public function orderStatusUpdate($order_id) {
        $order_id = $this->query->getSafeValue($this->tool->validation($order_id));
        $condition = ["status" => 1];
        $res = $this->query->updateData('orders', $condition, 'id', $order_id);
        if ($res == 1) {
            return 1;
        }
    }

}

?>
