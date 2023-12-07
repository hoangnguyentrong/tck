<?php
namespace App;

class Medician_Test{
  private $db;
  public function __construct($host, $username, $password, $database)
  {
      try{
        $this->db = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
  // set the PDO error mode to exception
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      }
      catch(\PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
  }
  public function db_connection($host, $username, $password, $database)
  {
      try{
        $this->db = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
  // set the PDO error mode to exception
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      }
      catch(\PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
  }
  // public function check_duration($duration, $dose_per_day){
  //   if ($duration % $dose_per_day) {
  //     return false;
  //   }else{
  //     return true;
  //   }
  // }
  public function medication( $medicineName,$singleDose,$frequency,$duration ){
      $stmt = $this->db->prepare("SELECT Min_Dose, Max_Dose, Max_Frequency from medicines where Medicine_Name = ?");
      $stmt->execute([$medicineName]);
      $row = $stmt->fetch(\PDO::FETCH_ASSOC);
      if($row){
        $min_dose = $row['Min_Dose'];
        $max_dose = $row['Max_Dose'];
        $frequency_max = $row['Max_Frequency'];

        $total_dose = $singleDose * $frequency;
        $max_dose_per_day = $max_dose *$frequency_max;

        if($singleDose < $min_dose){
          return 'Liều lượng quá thấp';
        }
        if($singleDose > $max_dose){
          return 'Liều lượng quá cao';
        }
        if($frequency > $frequency_max){
          return 'The frequency of dosing is too high';
        }
        // if (!Medician_Test::check_duration($duration, $total_dose)){
        //   return 'Duration not valid';
        // }
       return"ok";
      }
  }
}
$new_object = new Medician_Test ('localhost', 'root', '', 'web');
?>