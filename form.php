<?php
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$lirc = $_POST['lirc'];
$borrowed = $_POST['borrowed'];
if(!empty($name)||!empty($password)||!empty($email)||!empty($lirc)||!empty($borrowed))
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
        $SELECT="SELECT email From form Where email=? Limit 1";
        $INSERT="INSERT Into form(name,password,email,lirc,borrowed) values(?,?,?,?,?)";

        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows();

        if($rnum==0){
            $stmt->close();

            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("sssss",$name,$password,$email,$lirc,$borrowed);
            $stmt->execute();
            echo "Your response is been saved";
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