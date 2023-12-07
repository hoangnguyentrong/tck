<?php
// Start the session
session_start();

include('libs/helper.php');
Database::db_connect();
// Bổ sung vào đầu trang PHP để xử lý xóa
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'delete') {
  $indexToDelete = $_GET['index'];
  
  // Kiểm tra xem chỉ số cần xóa có tồn tại trong mảng không
  if (isset($_SESSION['medicationsData'][$indexToDelete])) {
      // Xóa phần tử khỏi mảng
      unset($_SESSION['medicationsData'][$indexToDelete]);

      // Tái sắp xếp lại chỉ số mảng
      $_SESSION['medicationsData'] = array_values($_SESSION['medicationsData']);

      // Chuyển hướng để tránh việc xóa lại khi làm mới trang
      Helper::redirect(Helper::get_url('../TCK/PHP/adddrug.php'));
  }
}

if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../TCK/PHP/log_in.php'));
}

$email = $_SESSION['email'];
$sql_check = "SELECT Email_doctor FROM doctors WHERE Email_doctor = '$email'";
$check = Database::db_get_list($sql_check);

foreach ($check as $row) {
    $email_doctor = $row['Email_doctor'];
}

/////////////////////////////////////////
if (!isset($_SESSION['patient_ID_search']) || empty($_SESSION['patient_ID_search'])) {
    Helper::redirect(Helper::get_url('../TCK/PHP/search.php'));
}

$patientIDtable = $_SESSION['patient_ID_search'];
$sql_checkp = "SELECT Patient_ID FROM patients WHERE Patient_ID = '$patientIDtable'";
$checkp = Database::db_get_list($sql_checkp);

// Check if the query was successful
if ($checkp !== false) {
    foreach ($checkp as $rowp) {
        $patientIDtable1 = $rowp['Patient_ID'];
    }
} else {
    // Handle the case where the query fails, e.g., output an error message
    echo "Error retrieving patient data.";
}

// Biến để kiểm soát việc hiển thị thông tin debug



$debugMode = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form
    $medicineName = $_POST['Medicine_Name'];
    $singleDose = $_POST['Single_Dose'];
    $frequency = $_POST['Frequency'];
    $duration = $_POST['Duration'];

    $existingIndex = null;
    foreach ($_SESSION['medicationsData'] as $index => $medication) {
        if ($medication['Medicine_Name'] === $medicineName) {
            $existingIndex = $index;
            break;
        }
    }
    if ($existingIndex !== null) {
        // Nếu thuốc đã tồn tại, cập nhật thông tin
        $_SESSION['medicationsData'][$existingIndex] = [
            'Medicine_Name' => $medicineName,
            'Single_Dose' => $singleDose,
            'Frequency' => $frequency,
            'Duration' => $duration
        ];
    }elseif (!empty($medicineName) && !empty($singleDose) && !empty($frequency) && !empty($duration)) {
        $sql_information_medicine = "SELECT * FROM medicines WHERE Medicine_Name = '$medicineName'";
        $medicine_info = Database::db_get_row($sql_information_medicine);

        if ($medicine_info) {
            
          $unit = $medicine_info['Unit'];
            $isValid = true;

            // Kiểm tra trường hợp "false" của các giá trị
            if (!is_numeric($singleDose) || $singleDose < $medicine_info['Min_Dose'] || $singleDose > $medicine_info['Max_Dose']) {
                echo "Lỗi1";
                $isValid = false;
            } elseif (!is_numeric($frequency) || $frequency > $medicine_info['Max_Frequency']) {
                echo "Lỗi2";
                $isValid = false;
            } elseif (!is_numeric($duration) || $duration < 1) {
                echo "Lỗi3";
                $isValid = false;
            } elseif (($singleDose * $frequency) > ($medicine_info['Max_Dose'] * $medicine_info['Max_Frequency'])) {
                echo "Lỗi4";
                $isValid = false;
            } elseif (($singleDose * $frequency) < ($medicine_info['Min_Dose'] * $medicine_info['Max_Frequency'])) {
                echo "Lỗi5";
                $isValid = false;
            }

            if ($isValid) {
                // Lấy các giá trị từ form và thêm vào mảng
                $_SESSION['medicationsData'][] = [
                    'Medicine_Name' => $medicine_info['Medicine_Name'],
                    'Single_Dose' => $singleDose,
                    'Frequency' => $frequency,
                    'Duration' => $duration
                ];
                Helper::redirect(Helper::get_url('../TCK/PHP/adddrug.php'));
            } else {
                // Thêm khối mã này để kiểm tra lỗi khi debugMode được kích hoạt
                if ($debugMode) {
                    echo "Error fetching medicine information. SQL Query: $sql_information_medicine";
                    echo '<pre>';
                    print_r($medicine_info);
                    echo '</pre>';
                }
            }

            
        }
    }

    // Nếu có tên thuốc và các thông tin khác, thêm vào cơ sở dữ liệu
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="./adddrug.css">
    <title>Trang chủ</title>
    
</head>

<body>
    <h1>Thêm thuốc</h1>
    <form action="" method="POST" class="formsearch">
    <input type="hidden" name="prescription_id" value="<?php echo $search_patientID; ?>">
    <table class="putinfor">
        <tr>
            <th><label for="medicine_name">Tên thuốc</label></th>
            <td><input type="text" name="Medicine_Name" id="medicine_name" placeholder="nhập tên thuốc"></td>
        </tr>
        <tr>
            <th><label for="single_dose">Liều dùng</label></th>
            <td><input type="text" name="Single_Dose" id="single_dose" placeholder="nhập liều dùng"></td>
        </tr>
        <tr>
            <th><label for="frequency">Số lần/ngày</label></th>
            <td><input type="text" name="Frequency" id="frequency" placeholder="nhập số lần"></td>
        </tr>
        <tr>
            <th><label for="duration">Số ngày</label></th>
            <td><input type="text" name="Duration" id="duration" placeholder="nhập Số ngày"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="view" value="Thêm thuốc"></td>
        </tr>
    </table>
</form>
   
    <h3 >Danh sách thuốc</h3>

    <table class="forinformation" >
        <tr>
            <th>Tên thuốc</th>
            <th>Đơn vị</th>
            <th>Liều dùng</th>
            <th>Số lần/ngày</th>
            <th>Số ngày</th>
            <th>Tác vụ</th>
        </tr>
        <?php
        // Kiểm tra nếu mảng tồn tại và không rỗng
        if (!empty($_SESSION['medicationsData'])) {
            foreach ($_SESSION['medicationsData'] as $index => $medication) {

              $sql_get_unit = "SELECT Unit FROM medicines WHERE Medicine_Name = '{$medication['Medicine_Name']}'";
              $unit_info = Database::db_get_row($sql_get_unit);
                echo '<tr>';
                echo '<td>' . $medication['Medicine_Name'] . '</td>';
                echo '<td>' . $unit_info['Unit'] . '</td>';
                echo '<td>' . $medication['Single_Dose'] . '</td>';
                echo '<td>' . $medication['Frequency'] . '</td>';
                echo '<td>' . $medication['Duration'] . '</td>';
                echo '<td>';
                // Thêm nút hoặc liên kết để kích hoạt chức năng xóa
                echo '<a href="?action=delete&index=' . $index . '">Xóa</a>';
                echo '</td>';
                echo '</tr>';
            }
        } 
       
        ?>
    </table>
   <table >
    
    <a class="nav" href="./displaydetail.php">Xác Nhận</a>
   </table>
   <table>
    <a class="nav1" href="./search.php">Quay lại</a>
   </table>
</body>

</html>
