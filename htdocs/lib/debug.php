<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function debug($label, $value) {
    global $debug_log;
    if ($debug_log) {
        if(is_array($value) || is_object($value))
        {
            echo("<script>console.log('PHP: ".json_encode($value)."');</script>");
        } else {
            if (is_null($value)) {
                $value = "<null>";
            } elseif ($value === false) {
                $value = "<false>";
            }
            echo("<script>console.log('$label: ".$value."');</script>");
        }
    } else {
        if (is_null($value)) {
            $value = "&lt;null&gt;";
        } elseif ($value === false) {
            $value = "&lt;false&gt;";
        } else {
            $value = print_r($value, 1);
        }
            echo("<pre>$label:\n$value</pre>");
    }
}

