<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['lname']) &&
        isset($_POST['email']) && isset($_POST['password']) &&
        isset($_POST['cardNo'])) {
        
        $username = $_POST['name'];
        $password = $_POST['lname'];
        $gender = $_POST['email'];
        $email = $_POST['password'];
        $phoneCode = $_POST['cardNo'];
        // $phone = $_POST['phone'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "dbms_project";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register(name, lname, email, password, cardNo) values(?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssss",$name, $lname, $email, $password,$cardNo);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>