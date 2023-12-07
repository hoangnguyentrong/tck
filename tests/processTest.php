<?php
use PHPUnit\Framework\TestCase;
class processTest extends TestCase{
  public function test_single_dose_outside(){
    $excute = new App\Medician_Test('localhost', 'root', '', 'web');
    $result = $excute->medication("Paracetamol", 1, 3, 2);
    $this->assertEquals($result, "Liều lượng quá thấp");
  }
}
?>