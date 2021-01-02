<?php

//require_once '../object/database.php';

class tool  {

    public function pr($arr) {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    public function prx($arr) {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
        die();
    }

    public function redirect($str) {
        ?>
        <script type="text/javascript">
            window.location.href = '<?= $str ?>';
        </script>    
        <?php
    }

  

    public function validation($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function dateFormate($date) {
        $strtotime = strtotime($date);
        return date('d-M-Y', $strtotime);
    }

    public function textshort($text, $limit = 300) {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = $text . ".....";
        return $text;
    }

    public function title() {
        $path = $_SERVER['PHP_SELF'];
        $title = basename($path, '.php');
       // $this->pr($path);
        if ($title == 'index') {
            $title = 'Home';
        } elseif ($title == 'contact') {
            $title = 'Contact';
        }
        return $title;
    }

}
?>