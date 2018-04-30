<?php

namespace utils\maintenance;

class Utils
{
    public function isValidStatus($status)
    {
        $validStatus = ["completado", "proceso", "sinempezar"];
        return in_array($status, $validStatus);
    }
}
