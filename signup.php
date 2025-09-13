<?php
require 'ClassAutoLoad.php';

$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->banner($conf);
$ObjLayout->form_content($conf, $ObjForm);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        die("Please fill in all the fields");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }
    $conn = new mysqli($conf['db_host'], $conf['db_user'], $conf['db_pass'], $conf['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO users (Name, Email, Password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    require_once 'try_mail.php';

    echo "<h3>Registered Users</h3>";
    $sql="SELECT * FROM users ORDER BY Name ASC";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "<ol>";
        while($row=$result->fetch_assoc()){
            echo "<li>".$row['Name']." -> ".$row['Email']."</li>";
        }
        echo "</ol>";
    }

    $conn->close();
}

$ObjLayout->footer($conf);