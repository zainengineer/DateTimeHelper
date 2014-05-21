<?php
require_once dirname(__FILE__) . '/globals.php';
spl_autoload_register(function ($className) {
    $baseName = basename($className);
    $path = dirname(__FILE__) . '/classes/' . $baseName . '.php';
    loadClassIfExists($baseName, $path);

});
function loadClassIfExists($className, $path)
{
    if (file_exists($path)) {
        include_once($path);
    }
}

//printr(TimeHelper::dateDiff('today','today  +1 year +3 days'));

printr(TimeHelper::getWeekdaysInRange('today', 'today +43 days', 'm'), 'getWeekdaysInRange');
printr(TimeHelper::getCompleteWeeksInRange('today', 'today +43 days'), 'getWeekdaysInRange');
//printr(TimeHelper::getWeekdaysInRange('today +3 days','today'),'getWeekdaysInRange');
//printr(TimeHelper::getWeekdaysInRange('today +2','today +4 days'),'getWeekdaysInRange');