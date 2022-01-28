<?php

$host="localhost";
$user="root";
$password="";
$db="dbms_project";

$data=mysqli_connect($host,$user,$password,$db);
if($data===false)
{
    die("connection error");
}
if($_SERVER["REQUEST_METHOD"]==="POST")
{
    $email=$_POST["email"];
    $password=$_POST["password"];

    $sql="select * from register where email= '".$email."' AND password='".$password."' ";
    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if(mysqli_num_rows($result)==1)
    {
        header("location:homepage.html");
        exit();
    }
    else{
        echo "incorrect credentials";
        exit();
    }
}

?>