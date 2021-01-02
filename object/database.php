<?php

class database {

    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;

    protected function conn() {
        $this->host = 'localhost';
        $this->dbusername = 'root';
        $this->dbpassword = '';
        $this->dbname = 'php02';
        $connect = new mysqli($this->host, $this->dbusername, $this->dbpassword, $this->dbname);
        return $connect;
    }

}

class query extends database {

    public function getData($table, $feild = '*', $condition = '', $order_feild = '', $order_type = 'desc', $limit = '') {
        $sql = "select $feild from $table ";
        if ($condition != '') {
            $sql .= " where  ";
            $count = count($condition);
            $i = 1;
            foreach ($condition as $key => $val) {
                if ($i == $count) {
                    $sql .= " $key = $val ";
                } else {
                    $sql .= " $key = $val and ";
                }
                $i++;
            }
        }

        if ($order_feild != '') {
            $sql .= " order by $order_feild $order_type  ";
        }
        if ($limit != '') {
            $sql .= " limit $limit  ";
        }
       //echo $sql;
        $result = $this->conn()->query($sql);
        if ($result->num_rows > 0) {
            $arr = [];
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    public function insertData($table, $condition = '') {
        if ($condition != '') {
            foreach ($condition as $key => $val) {
                $feildarr [] = $key;
                $valuearr [] = $val;
            }
            $feild = implode(',', $feildarr);
            $value = implode("','", $valuearr);
            $value = " '" . $value . "' ";

            $sql = "insert into $table ($feild) values($value)";
            //die($sql) ;
            $result = $this->conn()->query($sql);
            if ($result) {
                return 1;
            }
        }
    }

    public function deleteData($table, $condition = '') {
        if ($condition != '') {
            $sql = " delete from $table where  ";
            $count = count($condition);
            $i = 1;
            foreach ($condition as $key => $val) {
                if ($i == $count) {
                    $sql .= " $key = $val ";
                } else {
                    $sql .= " $key = $val and ";
                }
                $i++;
            }
           $res = $this->conn()->query($sql);
             if($res){
                return 1;
            }
        }
    }

    public function updateData($table, $condition = '', $where_feild, $where_value) {
        if ($condition != '') {
            $sql = "update  $table set ";

            $count = count($condition);
            $i = 1;
            foreach ($condition as $key => $val) {
                if ($i == $count) {
                    $sql .= " $key = '$val' ";
                } else {
                    $sql .= " $key = '$val'  , ";
                }
                $i++;
            }
            $sql .= " where $where_feild = '$where_value'  ";
            //die($sql);
            $result = $this->conn()->query($sql);
            if($result){
                return 1;
            }
        }
    }

    public function search($table, $condition1, $condition2, $search, $limit = '') {
        $sql = "select * from $table where $condition1 like '%$search%' or $condition2 like '%$search%' ";
        if ($limit != '') {
            $sql .= " limit $limit";
        }
        $result = $this->conn()->query($sql);
        echo $sql;
        if ($result->num_rows > 0) {
            $arr = [];
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    public function getSafeValue($str) {
        if ($str != '') {
            return mysqli_real_escape_string($this->conn(), $str);
        }
    }

}

?>