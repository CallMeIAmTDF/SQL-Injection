<?php
session_start();
include_once('conn.php');
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    echo "Đăng nhập thành công!<br>";
    $email = $_SESSION["email"];
    $sql = "select name FROM user where email='".$email."'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $username = $row['name'];
        $sql = "select name FROM user where name='".$username."'";
        $result2 = $conn->query($sql);
        while($row = $result2->fetch_assoc()){
            $name = $row['name'];
            echo 'Xin chào：<i class="name">'.$name.'</i>';
            break 2;
        }
    }

} else {
    $_SESSION["admin"] = false;
    header("Location: login.php");
    exit;
}
?>
