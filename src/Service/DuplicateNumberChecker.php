<?php

namespace App\Service;

class DuplicateNumberChecker
{
    public function hasDuplicateNumbers($data): bool
    {
        if (count($data) == count(array_unique($data))) {
            return false;
        } else {
            return true;
        }
    }
}