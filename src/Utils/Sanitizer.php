<?php

namespace App\Utils;

class Sanitizer
{
    public function sanitizeStringData(array $keys, array $data): array
    {
        foreach ($keys as $key) {

            if ($data[$key]) {

                if (is_string($data[$key])) {
                    //$data[$key] = htmlspecialchars($data[$key]);
                    $data[$key] = filter_var($data[$key]);
                }

            }

        }
        return $data;
    }
}