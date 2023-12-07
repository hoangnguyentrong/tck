<?php
include('./libs/helper.php');
Database::db_connect();
// Dữ liệu bạn muốn chèn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['email'];
    $FullName = $_POST['FullName'];
    $password = $_POST['passwords'];
   
    // Kiểm tra tồn tại
    $sql_check_doctor = "SELECT Email_doctor FROM doctors WHERE Email_doctor = '$Email'";
    if (Database::db_execute($sql_check_doctor)) {
        echo "<script>alert('Tài khoản đã tồn tại!')</script>";
                    
    } 
    else {
        $sql_insert_dortor = "INSERT INTO doctors (Email_doctor, FullName_doctor, passwords_doctor)
        VALUES('$Email' , '$FullName', '$password' )
       " ;
       if(Database::db_execute($sql_insert_dortor)){
        // Chuyển hướng và truyền thông báo thành công
        Helper::redirect(Helper::get_url('../TCK/PHP/log_in.php?success=1'));
       } else {
           echo "Lỗi khi thêm dữ liệu vào bảng: ";
       }  
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/signup.css">

    <style>
       
        
        #Sign_up {
            width: 100%;
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
            color: black; /* Change text color to white */
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

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-default {
            background-color: #3498db;
            color: #fff;
        }

        .btn-default:hover {
            background-color: #2980b9;
            color: #fff;
        }

        /* Add a specific class for the form title to set its color */
        .form-title {
            color: #333; /* Change the color as needed */
        }
    </style>
    <title>Sign_up</title>
</head>

<body>
<header id="header" class="fixed-top">
    <!-- <div class="container d-flex align-items-center"> -->

      <h1 class="logo me-auto"><a href="../Medilab/index.html">Medilab</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

     

    </div>
  </header>
    <!-- thông báo -->
    <div id="thong_bao">
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 2) {
            echo "Tài khoản chưa được đăng ký. Xin mời đăng ký!";
        }
        ?>
    </div>
    <!-- Sign_up -->
    <div id="Sign_up">
        <div class="container" id="form">
            <h1>Đăng kí bác sĩ</h1>
          
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Nhập email của bạn" name="email" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="FullName">Họ và tên</label>
                    <input type="text" class="form-control" placeholder="Nhập tên của bạn" name="FullName" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="passwords">Mật khẩu</label>
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="passwords" required>
                </div>
                <div class="form-group">
                    <div id="btn">
                        <button type="submit" class="btn btn-default">Đăng kí</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
