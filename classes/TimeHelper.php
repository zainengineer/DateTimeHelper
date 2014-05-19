<?php

/**
 * Class TimeHelper
 */
class TimeHelper {

    /**
     * @param $date1
     * @param $date2
     * @param bool $floor
     * @return float|int|null
     */
    public static function dateDiff($date1,$date2,$format = "%a")
    {
        $date1 = self::getDateObject($date1);
        $date2 = self::getDateObject($date2);
        $diff = $date1->diff($date2);
        return $diff->format($format);
    }
    /**
     * @param $dtGiven
     * @return int|null
     */
    public static function getStamp($dtGiven)
    {
        if (!$dtGiven)
            return null;
        if (is_numeric($dtGiven))
            return $dtGiven;
        return strtotime($dtGiven);
    }

    public static function getDateString($dtGiven)
    {
        if (!$dtGiven)
            return null;
        if (is_string($dtGiven))
            return $dtGiven;
        return date('c', $dtGiven);
    }

    public static function getDateObject($dtGiven)
    {
        if (is_object($dtGiven) && get_class($dtGiven) == 'DateTime'){
            return $dtGiven;
        }
        return new DateTime(self::getDateString($dtGiven));
    }
} 