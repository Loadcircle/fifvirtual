<?php
namespace Application\Clases;

class FuncionesAdicionales
{
    function obtenerExtensionFichero($str)
    {

        $String=explode(".", $str);


        $a=end($String);

        return $a;

    }

    function genera_random($longitud){
        $exp_reg="[^A-Z0-9]";
        return substr(preg_replace($exp_reg, "", md5(rand())) .
            preg_replace($exp_reg, "", md5(rand())) .
            preg_replace($exp_reg, "", md5(rand())),
            0, $longitud);
    }

    // Parses a string into a DateTime object, optionally forced into the given timezone.
    function parseDateTime($string, $timezone=null) {
        $date = new \DateTime(
            $string,
            $timezone ? $timezone : new \DateTimeZone('UTC')
            // Used only when the string is ambiguous.
            // Ignored if string has a timezone offset in it.
            );
        if ($timezone) {
            // If our timezone was ignored above, force it.
            $date->setTimezone($timezone);
        }
        return $date;
    }


    // Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
    // but in UTC.
    function stripTime($datetime) {
        return new \DateTime($datetime->format('Y-m-d'));
    }



}

