<?php

namespace App;
class MedicationHandler
{
    public function validateMedicationData($medicine_info, $singleDose, $frequency, $duration)
    {
        $unit = $medicine_info['Unit'];
        $isValid = true;

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
            return [
                'Medicine_Name' => $medicine_info['Medicine_Name'],
                'Single_Dose' => $singleDose,
                'Frequency' => $frequency,
                'Duration' => $duration
            ];
        } else {
            // Debug code block
            echo "Error in medication validation:";
            echo '<pre>';
            print_r($medicine_info);
            echo '</pre>';
            return null;
        }
    }
}
?>