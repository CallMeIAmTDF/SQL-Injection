<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <script type="text/javascript" src="vendor/bootstrap.js"></script>
    <script type="text/javascript" src="1.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="1.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h3 class="text-xs-center">Đăng kí tài khoản</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 push-sm-2">
                <form method="POST">
                    <div class="card">
                        <div class="card-block">
                            <fieldset class="form-group">
                                <label for="input1"></label>
                                Name<input type="text" id="input1" name="name" placeholder="test" class="form-control">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="input2"></label>
                                Password<input type="password" id=input2 name="password" class="form-control">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="input3"></label>
                                Confirm<input type="password" id="input3" name="confirm" class="form-control">
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="input4"></label>
                                Email<input type="text" id="input4" name="email" class="form-control" placeholder="taiDTU@gmail.com">
                            </fieldset>
                            <input type="submit" name="submit" class="btn btn-success btn-block" value="Register">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php

include_once('conn.php');
if (isset($_POST['submit'])) {
    if ($_POST['password'] == $_POST['confirm']) {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $regex = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
        if (preg_match($regex, $email)) {
            $stmt = $conn->prepare('select email from user where email=?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($res);
            while ($stmt->fetch()) {
            }
            if ($stmt->num_rows() > 0) {
                echo '<script>alert("Email đã tồn tại!")</script>';
            } else {
                $stmt2 = $conn->prepare("insert into user (name,pass,email) values (?, ?, ?)");
                if ($stmt2) {
                    $stmt2->bind_param('sss', $username, $password, $email);
                    if ($stmt2->execute()) {
                        echo '<script>alert("Đăng kí thành công!");location.href="login.php"</script>';
                    } else {
                        echo "Đăng kí thất bại!";
                    }
                }
                $stmt2->close();
            }
            $stmt->close();
        } else {
            echo '<script>alert("Định dạng email sai!")</script>';
        }
    } else {
        echo "<script>alert('Mật khẩu không trùng khớp!')</script>";
    }
}


?>