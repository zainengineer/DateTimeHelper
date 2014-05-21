<?php
require_once dirname(__FILE__) . '/../index.php';
/**
 * Created by PhpStorm.
 * User: ZMac
 * Date: 5/22/14
 * Time: 6:09 AM
 */

class TimeTest extends PHPUnit_Framework_TestCase
{
    public function testWeekdayDiff()
    {
        $startDate = '21-May-2014';
        $i=1;
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '21-May-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '22-May-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '23-May-2014' ));
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '24-May-2014' ));// Sat
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '25-May-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '26-May-2014' ));// Mon
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '27-May-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '28-May-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '29-May-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '30-May-2014' ));
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '31-May-2014' ));//Sat
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '1-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '2-Jun-2014' ));//Mon
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '3-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '4-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '5-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '6-Jun-2014' ));
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '7-Jun-2014' ));//Sat
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '8-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '9-Jun-2014' ));//Mon
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '10-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '11-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '12-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '13-Jun-2014' ));
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '14-Jun-2014' ));//Sat
        $this->assertEquals($i, TimeHelper::getWeekdaysInRange($startDate, '15-Jun-2014' ));
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '16-Jun-2014' ));//Mon
        $this->assertEquals(++$i, TimeHelper::getWeekdaysInRange($startDate, '17-Jun-2014' ));
    }


} 