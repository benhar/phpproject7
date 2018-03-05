<?php
class DB {
    private $connection;
    private $database;
    private $error;
    private $table;
    private $where;
    private $affected_rows;
    private $select = "*";
    private $count = 0;
    public $sql = '';
    public $data = array();

    public function __construct()
    {
        $this->connection = mysql_connect('localhost', 'root', '');

        if($this->connection){}
        else
            $this->error = mysql_error();

        $this->database = mysql_select_db('test');

        if($this->database){}
        else
            $this->error = mysql_error();
    }

    public function table($tb){
        $this->table = $tb;
        return $this;
    }
    public function where($cond){
        if(is_array($cond)){
            $string = '';
            $i = 0;
            $count = count($cond);
            foreach($cond as $k=>$v){
                if($i == 0){
                    $string .= mysql_real_escape_string($k)."='".mysql_real_escape_string($v)."'";
                }
                else{
                    $string .= " AND $k=$v";
                }
                $i++;
            }

            $this->where = $string;
            return $this;
        }
        else {
            $this->error = "Please provide an array";
        }
    }
    public function custom_where($cond){
        $this->where = $cond;
        return $this;
    }
    public function custom_sql($cond){
        $exe = mysql_query($cond);
        if($exe) {
            $this->data = $exe;
            return $this;
        }
        else{
            echo  mysql_error();
            return mysql_error();
        }
    }
    # THIS IS FOR UPDATING DATA

    public function update($data){
        if(is_array($data)){

            $string = '';
            $i = 0;
            $count = count($data);
            foreach($data as $k=>$v){
                if($i == $count-1){
                    $string .= "$k='$v'";
                }
                else{
                    $string .= "$k='$v',";
                }
                $i++;
            }

            $update_q = "UPDATE ".$this->table." SET ".$string." WHERE ".$this->where;
            //echo $update_q;
            $exec = mysql_query($update_q);
            if($exec){
                return $this;
            }
            else{
                $this->error = mysql_error();
                return false;
            }

        }
        else{
            $this->error = "Please provide an array";
            return $this;
        }
    }


    # THIS IS FOR INSERTING DATA

    public function insert($array){
        if(is_array($array)){
            $key = '';
            $value = '';

            $i = 0;
            $count = count($array);
            foreach($array as $k=>$v){
                if($i == $count-1){
                    $key .= "$k";
                    $value .= "'$v'";
                }
                else{
                    $key .= "$k,";
                    $value .= "'$v',";
                }
                $i++;
            }

            $query = "INSERT INTO ".$this->table." (".$key.") VALUES (".$value.")";
            $exe = mysql_query($query, $this->connection);

            if($exe){
                return $this;
            }
            else{
                $this->error = mysql_error();
                return $this->error;
            }

        }
        else{
            $this->error = "Please provide an array";
            return $this->error;
        }
    }


    # THIS IS FOR DELETE

    public function delete(){
        if(!empty($this->where)){
            $query = "DELETE FROM ".$this->table." WHERE ".$this->where;
            $exec = mysql_query($query);
            if($exec){
                $this->affected_rows = mysql_affected_rows();
                return $this;
            }
            else{
                $this->error = mysql_error();
                return false;
            }
        }
    }

    # THIS IS FOR SELECTING COLUMN NAMES
    public function select(){
        $count_args = func_num_args();
        $string = '';
        for($i=0; $i<$count_args; $i++){
            if($i == $count_args-1){
                $string .= mysql_real_escape_string(func_get_arg($i));
            }
            else{
                $string .= func_get_arg($i).",";
            }
        }
        $this->select = $string;
        return $this;
    }
    public function results(){
        if(!empty($this->table)){
            if(!empty($this->where)) {
                $q = "SELECT " . $this->select . " FROM " . $this->table." WHERE ".$this->where;
            }
            else{
                $q = "SELECT " . $this->select . " FROM " . $this->table;
            }
            $this->sql = $q;

            $exec = mysql_query($q);
            if($exec){
                $this->count = mysql_num_rows($exec);
                $final_array = array();

                while($row = mysql_fetch_array($exec)){
                    array_push($final_array, $row);
                }
                return $final_array;
            }
            else{
                $this->error = mysql_error();
            }
        }

    }
    public function result(){
        if(!empty($this->table)){
            if(!empty($this->where)) {
                $q = "SELECT " . $this->select . " FROM " . $this->table." WHERE ".$this->where;
            }
            else{
                $q = "SELECT " . $this->select . " FROM " . $this->table;
            }
            $this->sql = $q;
            $exec = mysql_query($q);
            if($exec){
                $this->count = mysql_num_rows($exec);
//                return mysql_fetch_assoc($exec, MYSQL_NUM);
                return mysql_fetch_assoc($exec);
            }
            else{
                $this->error = mysql_error();
            }
        }

    }
    public function count(){
        return $this->count;
    }


    public function print_error(){
        echo $this->error."<br/>";
        return $this;
    }



}

