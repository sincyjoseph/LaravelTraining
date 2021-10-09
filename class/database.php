<?php
class Database {

    private $servername = 'localhost';
    private $dbusername = 'root';
    private $dbpassword = '';
    private $dbname = 'userform';
    private $conn = null;

    private function getConnection(){
       if(!$this->conn){
        $this->conn = new mysqli($this->servername,$this->dbusername,$this->dbpassword,$this->dbname);
       }
    }

    //Data select function
    public function select(){
        $this->getConnection();
        $returnResult=$this->conn->query("SELECT * FROM users");
        $result_array = [];
        if($returnResult->num_rows > 0){
            foreach($returnResult as $row){
                array_push($result_array, $row);
            }
        }
        return $result_array;
    }

    //Data insert function
    public function insert($username,$password,$email,$gender,$address,$declaration){
        $this->getConnection();
        $returnResult=$this->conn->query("INSERT INTO users (username, password, email, gender, address, declaration) 
                                 VALUES ('$username', '$password', '$email', '$gender', '$address', '$declaration')");
        if($returnResult === True ){
            $last_id = $this->conn->insert_id;
        }
        return $last_id;
    }

    //Data update function
    public function update($username,$password,$email,$gender,$address,$declaration,$HI){
        $this->getConnection();
        $returnResult=$this->conn->query("UPDATE users 
                                 SET username='$username', password='$password', email='$email', gender='$gender', address='$address', declaration='$declaration' 
                                 WHERE id=$HI ");
        return $returnResult;
    }

    //Data edit function
    public function edit($id){
        $this->getConnection();
        $returnResult=$this->conn->query("SELECT * FROM users WHERE id=$id");
        return $returnResult;
    }

    //Data delete function
    public function delete($deleteId){
        $this->getConnection();
        $returnResult=$this->conn->query("DELETE FROM users WHERE id=$deleteId");
        return $returnResult;
    }

}

?>