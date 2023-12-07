<?php

use PHPUnit\Framework\TestCase;

// require '../PHP/MedicationHandler.php';

class MedicationHandlerTest extends TestCase
{
    public function testValidateMedicationData()
    {
        $handler = new App\MedicationHandler();

        // Mock data for testing
        $medicine_info = [
            'Unit' => 'mg',
            'Min_Dose' => 5,
            'Max_Dose' => 50,
            'Max_Frequency' => 4,
            'Medicine_Name' => 'Sample Medicine'
        ];
        $singleDose = 10;
        $frequency = 2;
        $duration = 7;

        // Call the method to test
        $result = $handler->validateMedicationData($medicine_info, $singleDose, $frequency, $duration);

        // Assert that the result is not null, indicating success
        $this->assertNotNull($result);
    }
}