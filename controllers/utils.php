<?php

class Utils
{
    // sanitaize all inputs at the backend
    public function sanitizeInputs($data)
    {
        // remove white spaces
        $output = trim($data);
        // remove all slashes
        $output = stripslashes($data);
        // convert special characters to HTML entities
        $output = htmlspecialchars($data);
        // convert tags into strings
        $output = strip_tags($data);

        return $output;
    }
}
