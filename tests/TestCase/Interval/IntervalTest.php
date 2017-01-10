<?php
namespace Interval\Test\TestCase\Interval;

use Cake\TestSuite\TestCase;
use Interval\Interval\Interval;

/**
 * Interval\Interval\Interval Test Case
 */
class IntervalTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Interval = new Interval();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->Interval);
    }

    /**
     * Method: testToHuman
     *
     * @return void
     */
    public function testToHuman()
    {
        // partial string
        $expected = '2w 6h';
        $actual = $this->Interval->toHuman((2 * 5 * 8 + 6) * 3600);
        $this->assertEquals($expected, $actual);

        // full string
        $expected = '1w 4d 6h 30m 40s';
        $actual = $this->Interval->toHuman(1 * 5 * 8 * 3600 + 4 * 8 * 3600 + 6 * 3600 + 30 * 60 + 40);
        $this->assertEquals($expected, $actual);
    }

    public function testToHumanWithOptions()
    {
        // new options
        $options = [
            'weekDays' => 6,
            'dayHours' => 9,
        ];

        // partial string
        $expected = '2w 6h';
        $actual = $this->Interval->toHuman((2 * 6 * 9 + 6) * 3600, $options);
        $this->assertEquals($expected, $actual);

        // full string
        $expected = '1w 4d 6h 30m 40s';
        $actual = $this->Interval->toHuman(
            1 * 6 * 9 * 3600 + 4 * 9 * 3600 + 6 * 3600 + 30 * 60 + 40,
            $options
        );
        $this->assertEquals($expected, $actual);

        // constructor
        $expected = '2w 5d 8h 30m 40s';
        $Interval = new Interval($options);
        $time = 2 * 6 * 9 * 3600 + 5 * 9 * 3600 + 8 * 3600 + 30 * 60 + 40;
        $actual = $Interval->toHuman($time);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Method: testToSeconds
     *
     * @return void
     */
    public function testToSeconds()
    {
        $expected = 8 * 3600 + 2 * 3600; // 1 day and 2 hours
        $actual = $this->Interval->toSeconds('1d 2h');
        $this->assertEquals($expected, $actual);

        $expected = 3 * 5 * 8 * 3600 + 2 * 8 * 3600; // 3 weeks 2 days
        $actual = $this->Interval->toSeconds('3w 2d');
        $this->assertEquals($expected, $actual);

        $expected = 1.5 * 8 * 3600; // 1 and 1/2 day
        $actual = $this->Interval->toSeconds('2d -4h');
        $this->assertEquals($expected, $actual);

        $expected = -3.5 * 3600; // -3.5 hours
        $actual = $this->Interval->toSeconds('-3h -30m');
        $this->assertEquals($expected, $actual);

        $expected = 2 * 5 * 8 * 3600 + 3 * 8 * 3600 + 5 * 3600 + 30 * 60 + 20;
        $actual = $this->Interval->toSeconds('2w 3d 5h 30m 20s');
        $this->assertEquals($expected, $actual);
    }

    public function testToSecondsWithOptions()
    {
        // new options
        $options = [
            'weekDays' => 6,
            'dayHours' => 9,
        ];

        $expected = 9 * 3600 + 2 * 3600; // 1 day and 2 hours
        $actual = $this->Interval->toSeconds('1d 2h', $options);
        $this->assertEquals($expected, $actual);

        $expected = 3 * 6 * 9 * 3600 + 2 * 9 * 3600; // 3 weeks 2 days
        $actual = $this->Interval->toSeconds('3w 2d', $options);
        $this->assertEquals($expected, $actual);

        // constructor
        $Interval = new Interval($options);
        $expected = 3 * 6 * 9 * 3600 + 2 * 9 * 3600; // 3 weeks 2 days
        $actual = $Interval->toSeconds('3w 2d');
        $this->assertEquals($expected, $actual);

        // constructor overwritten
        $Interval = new Interval($options);
        $expected = 3 * 7 * 10 * 3600 + 2 * 10 * 3600; // 3 weeks 2 days
        $actual = $Interval->toSeconds(
            '3w 2d', 
            ['weekDays' => 7, 'dayHours' => 10]
        );
        $this->assertEquals($expected, $actual);
    }
}
