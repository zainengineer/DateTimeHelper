<?php

/**
 * Class TimeHelper
 */
class TimeHelper
{

    /**
     * @param $date1
     * @param $date2
     * @param string $format
     * @return float|int|null
     */
    public static function dateDiff($date1, $date2, $format = "%a")
    {
        $date1 = self::getDateObject($date1);
        $date2 = self::getDateObject($date2);
        $diff = $date1->diff($date2);
        return $diff->format($format);
    }

    /**
     * @param $dtGiven
     * @return int|null|string|DateTime
     */
    public static function getStamp($dtGiven)
    {
        if (!$dtGiven)
            return null;
        if (is_numeric($dtGiven))
            return $dtGiven;
        if (is_object($dtGiven) && (get_class($dtGiven) == 'DateTime')) {
            /** @var $dtGiven DateTime */
            return $dtGiven->getTimestamp();
        }
        return strtotime($dtGiven);
    }

    /**
     * @param $dtGiven
     * @param string $format
     * @return null|string
     */
    public static function getDateString($dtGiven, $format = 'c')
    {
        if (!$dtGiven)
            return null;
        if (is_string($dtGiven))
            return $dtGiven;
        if (is_object($dtGiven) && (get_class($dtGiven) == 'DateTime')) {
            /** @var $dtGiven DateTime */
            return $dtGiven->format($format);
        }
        return date($format, $dtGiven);
    }

    /**
     * @param $dtGiven int|string|DateTime
     * @param string $format
     * @param $timeZone DateTimeZone
     * @return DateTime
     */
    public static function getDateObject($dtGiven, $format = 'c', $timeZone = null)
    {
        if (is_object($dtGiven) && get_class($dtGiven) == 'DateTime' && $format == 'c' && !$timeZone) {
            return clone $dtGiven;
        }
        //even if it is an object, might need to 'round' the date based on format
        return new DateTime(self::getDateString($dtGiven, $format), $timeZone);
    }

    /**
     * @param $date1 int|string|DateTime
     * @param $date2 int|string|DateTime
     * @param $unit string use s,m,h or y
     * @param $timeZone1 DateTimeZone
     * @param $timeZone2 DateTimeZone
     * @return int
     */
    public static function getWeekdaysInRange($date1, $date2, $unit = 'd', $timeZone1 = null, $timeZone2 = null)
    {
        $info = self::getIntervalInfo($date1, $date2, $timeZone1, $timeZone2);
        return self::changeTimeUnits($info['weekdays'], $unit);
    }

    /**
     * @param $date1 int|string|DateTime
     * @param $date2 int|string|DateTime
     * @param $unit string use s,m,h or y
     * @param $timeZone1 DateTimeZone
     * @param $timeZone2 DateTimeZone
     * @return int
     */
    public static function getCompleteWeeksInRange($date1, $date2, $unit = 'd', $timeZone1 = null, $timeZone2 = null)
    {
        $info = self::getIntervalInfo($date1, $date2, $timeZone1, $timeZone2);
        return self::changeTimeUnits($info['completeWeeks'], $unit);
    }

    /**
     * @param $date1Given int|string|DateTime
     * @param $date2Given int|string|DateTime
     * @param $timeZone1 DateTimeZone
     * @param $timeZone2 DateTimeZone
     * @return array
     */
    public static function getIntervalInfo($date1Given, $date2Given, $timeZone1, $timeZone2)
    {
        $info = array('weekdays' => null, 'completeWeeks' => null);
        //round time portion
        $date1 = self::getDateObject($date1Given, 'd-M-Y', $timeZone1);
        $date2 = self::getDateObject($date2Given, 'd-M-Y', $timeZone2);
        if ($date1->getTimestamp() > $date2->getTimestamp()) {
            $swap = $date1;
            $date1 = $date2;
            $date2 = $swap;
        }

        $daysToSunday = 7 - $date1->format("N");
        $workingDaysInFirstSpan = 6 - $date1->format("N");
        $nextSunday = clone $date1;
        $nextSunday = $nextSunday->add(new DateInterval("P{$daysToSunday}D"));
        $workingDaysInFirstSpan = ($workingDaysInFirstSpan < 0) ? 0 : $workingDaysInFirstSpan;

        // Date2 comes before next Monday
        if ($date2->getTimestamp() <= $nextSunday->getTimestamp()) {
            $info['completeWeeks'] = 0;
            $diff = $date2->diff($date1)->days;
            if ($diff < $workingDaysInFirstSpan) {
                $info['weekdays'] = $diff;
            }
            else {
                $info['weekdays'] = $workingDaysInFirstSpan;
            }
            return $info;
        }

        $workingDaysInLastSpan = $date2->format("N");
        $lastSunday = clone $date2;
        $lastSunday = $lastSunday->sub(new DateInterval("P{$workingDaysInLastSpan}D"));

        // round after Friday
        $workingDaysInLastSpan = ($workingDaysInLastSpan > 5) ? 5 : $workingDaysInLastSpan;
        $weekdays = $workingDaysInFirstSpan + $workingDaysInLastSpan;

        $intervalBetweenSundays = $lastSunday->diff($nextSunday);
        $completeWeeks = (int)round($intervalBetweenSundays->days / 7);
        $weekDaysBetweenSundays = $completeWeeks * 5;
        $info['completeWeeks'] = $completeWeeks;
        $info['weekdays'] = $weekdays + $weekDaysBetweenSundays;
        return $info;
    }

    /**
     * @param $quantity number
     * @param $outputUnit string
     * @param $inputUnit string
     * @return float
     */
    static function changeTimeUnits($quantity, $outputUnit, $inputUnit = 'd')
    {
        $multiple = array();
        $multiple['s'] = 24 * 60 * 60;
        $multiple['m'] = 24 * 60;
        $multiple['h'] = 24;
        $multiple['d'] = 1;
        $multiple['y'] = 1 / 365;

        $inputQuantity = $quantity / $multiple[$inputUnit];
        return $inputQuantity * $multiple[$outputUnit];
    }
} 