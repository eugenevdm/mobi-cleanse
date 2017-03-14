<?php

namespace App;

class Number
{

    public function check($number)
    {
        // Check if 11 digits and if correct country code is present
        if (strlen($number) == 11 && substr($number, 0, 2) == config('app.calling_code')) {
            $result = $this->checkPrefix('0' . substr($number, 2));
            if ($result) {
                return ['output' => $number, 'state' => 'success', 'correction' => 'number correct'];
            } else {
                return ['output' => '', 'state' => 'error', 'correction' => 'failed prefix check'];
            }
        }

        // Check if country code and 0 prefix is missing
        if (strlen($number) == 9) {
            $result = $this->checkPrefix('0' . $number);
            if ($result) {
                return ['output' => config('app.calling_code') . $number, 'state' => 'success', 'correction' => 'added country code'];
            } else {
                return ['output' => '', 'state' => 'error', 'correction' => 'failed prefix check'];
            }
        }

        // User may enter a number without the country code
        If (strlen($number) == 10) {
            $result = $this->checkPrefix($number);
            if ($result) {
                return ['output' => config('app.calling_code') . substr($number, 1, 9), 'state' => 'success', 'correction' => 'added country code and removed 0'];
            } else {
                return ['output' => '', 'state' => 'error', 'correction' => 'failed prefix check'];
            }
        }

        // Check if the word deleted appears in the number and change to warning state
        if ($deleted_number = $this->checkDeleted($number)) {
            if ($deleted_number) {
                $result = $this->checkPrefix('0' . substr($number, 2));
                if ($result) {
                    return ['output' => $deleted_number, 'state' => 'warning', 'correction' => 'stripped deleted'];
                } else {
                    return ['output' => '', 'state' => 'error', 'correction' => 'deleted item failed prefix check'];
                }
            }
        }

        // If all tests fail, return invalid
        return ['output' => '', 'state' => 'error', 'correction' => 'invalid mobile number'];
    }

    private function checkPrefix($number)
    {
        if (in_array(substr($number, 0, 3), config('app.mobile_prefixes'))) return $number;
        if (in_array(substr($number, 0, 4), config('app.mobile_prefixes'))) return $number;
        return false;
    }

    private function checkDeleted($number)
    {
        $pattern = '/(' . config('app.calling_code') . '\d{9}+)_DELETED/';
        preg_match($pattern, $number, $matches);
        return $matches[1] ?? false;
    }

}