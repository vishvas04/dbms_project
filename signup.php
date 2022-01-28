<?php
$name = $_POST['name'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$cardNo = $_POST['cardNo'];
if(!empty($name)||!empty($lname)||!empty($email)||!empty($password)||!empty($cardNo))
{
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="dbms_project";

    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT="SELECT email From register Where email=? Limit 1";
        $INSERT="INSERT Into register(name,lname,email,password,cardNo) values(?,?,?,?,?)";

        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows();

        if($rnum==0){
            $stmt->close();

            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("sssss",$name,$lname,$email,$password,$cardNo);
            $stmt->execute();
            echo "new record inserted successfully";
    }else{
        echo "someone already registered";
    }
    $stmt->close();
    $conn->close();
}
}
else{
    echo "All fields are required";
    die();
}
?>