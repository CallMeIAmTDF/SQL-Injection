<?php
session_start();
include_once('conn.php');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare('select email from user where email=? and pass=?');
    if (!$stmt)
        throw new Exception("prepare query error:" . $conn->error);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->bind_result($email);
    while ($stmt->fetch()) {
    }
    if ($stmt->num_rows() > 0) {
        $_SESSION["admin"] = true;
        $_SESSION["email"] = $email;
        header("Location: index.php");
        exit;
    } else {
        session_unset();
        echo '<script>alert("Đăng nhập không thành công!")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script type="text/javascript" src="vendor/bootstrap.js"></script>
    <script type="text/javascript" src="1.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="1.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h3 class="text-xs-center">Đăng nhập vào website</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 push-sm-2"> 
                <form method="POST">
                    <div class="card">
                        <div class="card-block">
                            <fieldset class="form-group">
                                <label for="input1"></label>
                                Email<input name="email" type="text" class="form-control" id="input1" placeholder="example:taiDTU@gmail.com">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="input2"></label>
                                Password<input name="password" type="password" class="form-control" id="input2">
                            </fieldset>
                            <input type="submit" class="btn btn-danger btn-block" value="Login" name="submit">
                            <a class="btn btn-success btn-block" href="register.php" name="register">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
