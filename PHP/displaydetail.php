<?php
session_start();
include('libs/helper.php');
Database::db_connect();
// Bổ sung vào đầu trang PHP để xử lý xóa
// if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'delete') {
//   $indexToDelete = $_GET['index'];
  
//   // Kiểm tra xem chỉ số cần xóa có tồn tại trong mảng không
//   if (isset($_SESSION['medicationsData'][$indexToDelete])) {
//       // Xóa phần tử khỏi mảng
//       unset($_SESSION['medicationsData'][$indexToDelete]);

//       // Tái sắp xếp lại chỉ số mảng
//       $_SESSION['medicationsData'] = array_values($_SESSION['medicationsData']);

//       // Chuyển hướng để tránh việc xóa lại khi làm mới trang
//       Helper::redirect(Helper::get_url('../TCK/PHP/adddrug.php'));
//   }
// }

if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../TCK/PHP/log_in.php'));
}

$email = $_SESSION['email'];
$sql_check = "SELECT Email_doctor FROM doctors WHERE Email_doctor = '$email'";
$check = Database::db_get_list($sql_check);

foreach ($check as $row) {
    $email_doctor = $row['Email_doctor'];
}

$emailDoctor = $_SESSION['email'];
$sql_checkdoctor = "SELECT * FROM doctors where Email_doctor = '$emailDoctor'";
if(Database::db_execute($sql_checkdoctor)){
    $doctoremail = Database::db_get_list($sql_checkdoctor);
    foreach ($doctoremail as $rowd){
        echo '<h1>Đơn thuốc</h1>';
      echo '<h4>Thông tin Bác sĩ</h4>';
echo '<p>Email Bác sĩ: ' . $rowd['Email_doctor'] . '</p>';
echo '<p>Tên Bác sĩ: ' . $rowd['FullName_doctor'] . '</p>';
    }
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
    echo "Không có dữ liệu";
}
$idpatiente =  $_SESSION['patient_ID_search'];
$sql_checkpatient = "SELECT * FROM patients where Patient_ID = '$idpatiente'";
if(Database::db_execute($sql_checkpatient)){
    $patientid = Database::db_get_list($sql_checkpatient);
    foreach ($patientid as $rowp){
      echo '<h4>Thông tin Bệnh nhân</h4>';
echo '<p>Tên bệnh nhân: ' . $rowp['Full_Name_patient'] . '</p>';
echo '<p>Ngày sinh: ' . $rowp['Date_of_Birth'] . '</p>';
echo '<p>Giới tính: ' . $rowp['Gender'] . '</p>';
echo '<p>Địa chỉ liên hệ: ' . $rowp['Address'] . '</p>';
echo '<p>Số điện thoại: ' . $rowp['Phone_number'] . '</p>';
echo '<p>Email bệnh nhân: ' . $rowp['Email_patient'] . '</p>';
echo '<p>Mã bảo hiểm: ' . $rowp['Health_Insurance_ID'] . '</p>';
echo '<p>Chuẩn đoán: ' . $rowp['diagnose'] . '</p>';

    }
}
// Kiểm tra xem có dữ liệu thuốc trong session hay không
if (isset($_SESSION['medicationsData']) && !empty($_SESSION['medicationsData'])) {
    // Hiển thị bảng thông tin thuốc
    echo '<div class="container">';
    echo '<h3>Danh sách Thuốc</h3>';
    echo '<table class="forinformation" border="1" cellpadding="8" width="850px">';
    echo '<tr>
    <th>Tên thuốc</th>
    <th>Đơn vị</th>
    <th>Liều dùng(viên)</th>
    <th>Số lần/ngày</th>
    <th>Số ngày</th>
    </tr>';

   // Trong vòng lặp hiển thị danh sách thuốc
foreach ($_SESSION['medicationsData'] as $index => $medication) {
  // ... (các dòng mã khác)
  echo '<tr>';
  echo '<td>' . $medication['Medicine_Name'] . '</td>';
  $medicineName = $medication['Medicine_Name'];
  $sql_get_unit = "SELECT Unit FROM medicines WHERE Medicine_Name = '$medicineName'";
  $unit_info = Database::db_get_row($sql_get_unit);
  
  // Hiển thị giá trị Unit
  echo '<td>' . $unit_info['Unit'] . '</td>';
  echo '<td>' . $medication['Single_Dose'] . '</td>';
  echo '<td>' . $medication['Frequency'] . '</td>';
  echo '<td>' . $medication['Duration'] . '</td>';
  
  // Thực hiện truy vấn SQL để lấy giá trị Unit tương ứng với Medicine_Name
 
  
 
  echo '</tr>';
}

    echo '</table>';
    echo '</div>'; // Đóng container

} else {
    echo '<p>Không có thông tin thuốc để hiển thị.</p>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['print_prescription'])) {
    $patient_id = $_POST['patient_id'];
    $doctor_email = $_POST['doctor_email'];

    $sqlinsertpre = "INSERT INTO prescriptions (Patient_ID, Email_doctor) VALUES ('$patient_id', '$doctor_email')";

    if (Database::db_execute($sqlinsertpre)) {
        $lastInsertedIDpre = Database::get_last_inserted_id();

        foreach ($_SESSION['medicationsData'] as $medication) {
            $medicineName = $medication['Medicine_Name'];
            $singleDose = $medication['Single_Dose'];
            $frequency = $medication['Frequency'];
            $duration = $medication['Duration'];

            $sqlGetMedicineID = "SELECT Medicine_ID FROM medicines WHERE Medicine_Name = '$medicineName'";

            if (Database::db_execute($sqlGetMedicineID)) {
                $resultmedicineid = Database::db_get_list($sqlGetMedicineID);

                if ($resultmedicineid && count($resultmedicineid) > 0) {
                    $medicineID = $resultmedicineid[0]['Medicine_ID'];

                    $sqlinsertdetails = "INSERT INTO prescriptiondetails (Prescription_ID, Medicine_ID, Single_Dose, Frequency, Duration) VALUES ('$lastInsertedIDpre', '$medicineID', '$singleDose', '$frequency', '$duration')";

                    if (!Database::db_execute($sqlinsertdetails)) {
                        echo '<p>Có lỗi xảy ra khi thêm vào bảng prescriptiondetails.</p>';
                        // Xử lý lỗi theo cách bạn muốn
                    }
                } else {
                    // Có thể xử lý một cách khác nếu không có Medicine_ID tương ứng
                    echo '<p>Không tìm thấy thông tin thuốc cho ' . $medicineName . '</p>';
                }
            } else {
                // Có thể xử lý một cách khác nếu không thể lấy Medicine_ID
                echo '<p>Có lỗi xảy ra khi truy vấn Medicine_ID.</p>';
            }
        }
        
        // Chuyển hướng sau khi hoàn thành vòng lặp
        unset($_SESSION['medicationsData']);
        Helper::redirect(Helper::get_url('../TCK/PHP/search.php?success=1'));
        

    } else {
        // Xử lý lỗi khi thêm vào prescriptions
        echo '<p>Có lỗi xảy ra khi tạo đơn thuốc.</p>';
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./displaydetail.css">
  <title>Document</title>
</head>
<body>
    
   <form action="" method="POST" class="prescription-form">
   <input type="hidden" name="patient_id" value="<?php echo $idpatiente; ?>">
<input type="hidden" name="doctor_email" value="<?php echo $emailDoctor; ?>">
      <input type="submit" name="print_prescription" value="In Đơn Thuốc" class="btn-print-prescription">
    </form>
    <a href="./adddrug.php">Quay lại </a>
</body>
</html>