<?php

class ValidationHelper
{
    public static function isValidDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public static function isValidPhone($phone) 
    {   
        $phone_cleaned = preg_replace('/[^\d\(\)\-\s]/', '', $phone);
        $regex_br_mobile = '/^\(?\d{2}\)?\s?\d{4,5}\-?\d{4}$/'; 

        if (preg_match($regex_br_mobile, $phone_cleaned)) {
            return true;
        }
        return false;

    } 
}