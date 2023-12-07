<?php
// Start the session
session_start();
?>
<?php
include('libs/helper.php');
Database::db_connect();



// Dữ liệu đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set session variables
    $_SESSION['email'] = $_POST['email'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql_check_doctor = "SELECT * FROM doctors
    where Email_doctor = '$email' and passwords_doctor = '$password' ";
   
    // Thực thi câu lệnh SQL
    if (Database::db_execute($sql_check_doctor)) {
        Helper::redirect(Helper::get_url('../TCK/PHP/search.php'));
    } else {
        // echo "Email or password was wrong. Please sign in again!";
        Helper::redirect(Helper::get_url('../TCK/PHP/log_in.php?success=5'));
    }
}
// Đóng kết nối
Database::db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/log_in.css">
    <link rel="stylesheet" href="../CSS/header_footer.css">
    <title>Team 2 - Log In</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa; /* Background color for the whole page */
        }

        #Login {
            width: 100%;
            padding-top: 15px;
        }

        #header {
            color: white;
            background: #1977cc;
            padding: 15px 0;
            text-align: center;
            border: 1px solid blue;
        }

        #header a {
            color: white;
            text-decoration: none; /* Remove underline */
        }

        .container h1 {
            text-align: center;
            color: black;
            padding-bottom: 40px; /* Change text color to white */
        }

        #form {
            width: 30%;
            margin: auto;
            padding: 20px; /* Adjusted padding for the form */
            border: 2px solid #3498db;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* Form background color */
        }

        #thong_bao {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #3498db;
            border-radius: 5px;
        }

        .form-group .notification h5 {
            color: red;
        }

        .showpass {
            margin-top: 10px;
        }

        #btn button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #btn button:hover {
            background-color: #2980b9;
            color: #fff;
        }

        .form-group p a {
            color: #3498db;
        }
    </style>
</head>

<body>
    <header id="header" class="fixed-top">
        <h1 class="logo me-auto"><a href="../Medilab/index.html">Medilab</a></h1>
    </header>

    <div id="Login">
        <div class="container" id="form">
            <h1>Đăng nhập bác sĩ</h1>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <div>
                        <input id="pass" type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                    </div>
                    <div class="notification">
                        <?php
                        if (isset($_GET['success']) && $_GET['success'] == 5) {
                            echo "<h5>Email/password was wrong. Please log in again!</h5>";
                        }
                        ?>
                    </div>
                    
                </div>
                <div class="form-group" id="btn">
                    <button type="submit">Đăng nhập</button>
                </div>
                <div class="form-group">
                    <p> Bạn không có tài khoản<a href="./sign_up.php">Đăng kí</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

<script>
    check.onclick = togglePassword;

    function togglePassword() {
        if (check.checked) pass.type = "text";
        else pass.type = "password";
    }
</script>

</html>
