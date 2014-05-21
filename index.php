<?php
require_once dirname(__FILE__) . '/globals.php';
//autoload classes
spl_autoload_register(function ($className) {
    $baseName = basename($className);
    $path = dirname(__FILE__) . '/classes/' . $baseName . '.php';
    loadClassIfExists($baseName, $path);

});
function loadClassIfExists($className, $path)
{
    if (class_exists($className)) {
        return;
    }
    if (file_exists($path)) {
        include_once($path);
    }
}

//do not execute and echo debug statements in unit Tests
if (class_exists('PHPUnit_Framework_TestCase')) {
    return;
}
$startDate = '21-May-2014';
printr(TimeHelper::dateDiff($startDate, '21-May-2014','s',new DateTimeZone('Australia/Sydney')));
//printr( TimeHelper::getWeekdaysInRange($startDate, "$startDate +9 days" ));
//printr( TimeHelper::getCompleteWeeksInRange($startDate, '31-May-2014'));
//printr( TimeHelper::getCompleteWeeksInRange($startDate, '31-May-2014'));
//printr(TimeHelper::dateDiff('today','today  +1 year +3 days'));
//printr(TimeHelper::getWeekdaysInRange('today', '+0 days'), 'getWeekdaysInRange');
//printr(TimeHelper::getWeekdaysInRange('today', 'today +43 days', 'm'), 'getWeekdaysInRange');
//printr(TimeHelper::getCompleteWeeksInRange('today', 'today +43 days'), 'getWeekdaysInRange');
//printr(TimeHelper::getWeekdaysInRange('today +3 days','today'),'getWeekdaysInRange');
//printr(TimeHelper::getWeekdaysInRange('today +2','today +4 days'),'getWeekdaysInRange');

