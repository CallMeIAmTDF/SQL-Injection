<?php
    $server = 'mysql8';
    $username = 'root';
    $password = 'yo}@CyRWnWA(9/##fgIUJ';
    $db = 'main';
    $conn = new mysqli($server, $username, $password, $db);
    // kiểm tra kết nối
    if($conn->connect_error){
        die("kết nối thất bại!: " . $conn->connect_error);
    }
?>