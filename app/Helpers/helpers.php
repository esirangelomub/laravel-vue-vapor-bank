<?php

if(! function_exists("dec") ) {
    /**
     * Format a string do decimal value
     * Ex: 300,45 - 300.45
     * @param string $value
     * @param int $precision
     * @return float|null
     */
    function dec(string $value, int $precision = 2): ?float
    {
        $value = preg_replace("/[^0-9,.-]/", "", $value);
        if (strpos($value, ',') > 0) {
            $value = str_replace(".", "", $value);
            $value = str_replace(",", ".", $value);
        } elseif (substr_count($value, ".") > 1) {
            $new_num = "";
            $count = substr_count($value, ".");
            $array = explode('.', $value);
            foreach ($array as $key => $number) {
                if ($key == $count) {
                    $new_num .= "." . $number;
                } else {
                    $new_num .= $number;
                }
            }
            $value = $new_num;
        }
        $value = round((float)$value * 100, $precision);
        $value = round((float)$value/100, $precision);
        return $value;
    }
}
