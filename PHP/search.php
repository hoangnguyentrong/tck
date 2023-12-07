<?php
// Start the session
session_start();
?>
<?php
include('libs/helper.php');
Database::db_connect();
if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../TCK/PHP/log_in.php'));
}
$email = $_SESSION['email'];
$sql_check = "SELECT Email_doctor FROM doctors WHERE Email_doctor = '$email'";
$check = Database::db_get_list($sql_check);
foreach ($check as $row) {
    $email_doctor = $row['Email_doctor'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="./search.css">
    <title>Trang chủ</title>
</head>
<body>
<header id="header" class="fixed-top">
    <!-- <div class="container d-flex align-items-center"> -->

      <h1 class="logo me-auto"><a href="../Medilab/index.html">Medilab</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      <a class="logout" href="./log_out.php" class="logout-button">Đăng xuất</a>
     

    </div>
  </header>
    <h1>Danh sách bệnh nhân</h1>
    <table class="formsearch">
        <tr>
            <th>
                <form action="" method="get">
                    <input type="search" name="search" placeholder="Nhập mã bệnh nhân" id="">
                    <input type="submit" value="Tìm kiếm">
                </form>
            </th>
        </tr>
    </table>
    <table class="forminformation" >
        <tr>
            <th>Mã bệnh nhân</th>
            <th>Họ và tên</th>
            <th>Giới tính</th>
            <th>Mã bảo hiểm</th>
            <th>Số điện thoại</th>
            <th>Tác vụ</th>
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
            $_SESSION['patient_ID_search'] =$_GET['search'];
            $search_patientID = $_GET['search'];

            
            
           

            // Kiểm tra xem có nhập mã bệnh nhân hay không
            if (!empty($search_patientID)) {
                $sql_select_patientID = "SELECT * FROM patients WHERE Patient_ID = '$search_patientID'";
            } else {
                // Nếu không nhập mã bệnh nhân, lấy toàn bộ danh sách bệnh nhân
                $sql_select_patientID = "SELECT * FROM patients";
            }

            if (Database::db_execute($sql_select_patientID)) {
                $information_check_patient = Database::db_get_list($sql_select_patientID);

                foreach ($information_check_patient as $check_patient) {
                    echo '<tr>';
                    echo '<td>' . $check_patient["Patient_ID"] . '</td>';
                    echo '<td>' . $check_patient["Full_Name_patient"] . '</td>';
                    echo '<td>' . $check_patient["Gender"] . '</td>';
                    echo '<td>' . $check_patient["Health_Insurance_ID"] . '</td>';
                    echo '<td>' . $check_patient["Phone_number"] . '</td>';
                    echo '<td>
                            <form action="" method="get">
                            <input type="hidden" name="email_doctor" value="' . $_SESSION['email'] . '">
                            <input type="hidden" name="email_doctor" value="' . $_SESSION['patient_ID_search'] . '">
                                <input type="submit" name="addmedicine" value="Thêm thuốc">
                            </form>
                        </td>';
                 
                }
            }
        }
        // Kiểm tra nếu nút "Thêm thuốc" được bấm
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['addmedicine'])) {
            echo'11111';
            Helper::redirect(Helper::get_url('../TCK/PHP/adddrug.php?success=1'));
            }  

            else{
            
                
            }
             
        
        // Đóng kết nối
        Database::db_disconnect();
        ?>
        
    </table>
</body>
</html>
