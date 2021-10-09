<?php

include '../class/database.php';
$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $gender = isset($_POST['gender'])?$_POST['gender']:'';
    $address = isset($_POST['address'])?$_POST['address']:'';
    $declaration = isset($_POST['declaration'])?$_POST['declaration']:'';

    //Save  or update
    if(isset($_POST['operation']) &&  $_POST['operation']=='save'){
        $insertStatus = $database->insert($username,$password,$email,$gender,$address,$declaration);
        if($insertStatus) {
            $result = new stdClass();
            $result->statusCode=200;
            $result->statusMessage='save success';
            $result->dataId=$insertStatus;
            echo json_encode($result);
        }else {
            $result = new stdClass();
            $result->statusCode=201;
            $result->statusMessage='save failed';
            echo json_encode($result);
        }
    }else if(isset($_POST['operation']) &&  $_POST['operation']=='update'){
        $HI = $_POST['editId'];
        if(is_numeric($HI) && $HI > 0){
            $updateStatus = $database->update($username,$password,$email,$gender,$address,$declaration,$HI);
            if($updateStatus){
                $result = new stdClass();
                $result->statusCode=200;
                $result->statusMessage='Update success';
                echo json_encode($result);
            }else {
                $result = new stdClass();
                $result->statusCode=201;
                $result->statusMessage='Update failed';
                echo json_encode($result);
            }
        } 
    }else if(isset($_POST['operation']) &&  $_POST['operation']=='delete'){
        $deleteId = isset($_POST['deleteId'])?($_POST['deleteId']): 0;
        if($deleteId){
            $deleteStatus = $database->delete($deleteId);
            if($deleteStatus){
                $result = new stdClass();
                $result->statusCode=200;
                $result->statusMessage='delete success';
                echo json_encode($result);
            } else{
                $result = new stdClass();
                $result->statusCode=201;
                $result->statusMessage="delete error";
                echo json_encode($result);
            }   
        }
    }else {
        $result = new stdClass();
        $result->statusCode=201;
        $result->statusMessage='operation not found';
        echo json_encode($result);
    }

}else if($_SERVER["REQUEST_METHOD"] == "GET") {
    $getStatus = $database->select();
    if($getStatus){
        $result = new stdClass();
        $result->statusCode=200;
        $result->statusMessage='get data success';
        $result->getData=$getStatus;
        echo json_encode($result);
    }else{
        $result = new stdClass();
        $result->statusCode=201;
        $result->statusMessage='no data found';
        echo json_encode($result);
    }
}else {
    $result = new stdClass();
    $result->statusCode=201;
    $result->statusMessage='request no found';
    echo json_encode($result);
}

?>