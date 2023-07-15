<?php

namespace App\Service;

class BoundaryChecker
{
    public function isOverBoundary($data, $min, $max): bool
    {
        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i] < $min || $data[$i] > $max) {
                return true;
            }

        }

        return false;
    }
}