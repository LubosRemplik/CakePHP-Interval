<?php
namespace Interval\Traits;

trait IntervalTrait
{

    /**
     * Attribute: options
     *
     * Options
     * weekDays - number of days per week, default 5
     * dayHours - number of hours per day, default 8
     *
     * @var array
     */
    protected $options = [
        'weekDays' => 5,
        'dayHours' => 8,
    ];

    /**
     * toHuman method
     *
     * Reads seconds and convert them to human readable string
     *
     * @param int $time Time in seconds
     * @param array $options See options property
     * @return string $interval
     */
    public function toHuman($time, $options = [])
    {
        $options = $options + $this->options;

        $interval = [];

        $weeks = floor($time / (60 * 60 * $options['dayHours'] * $options['weekDays']));
        $time -= $weeks * (60 * 60 * $options['dayHours'] * $options['weekDays']);
        if ($weeks > 0) {
            $interval[] = "{$weeks}w";
        }

        $days = floor($time / (60 * 60 * $options['dayHours']));
        $time -= $days * (60 * 60 * $options['dayHours']);
        if ($days > 0) {
            $interval[] = "{$days}d";
        }

        $hours = floor($time / (60 * 60));
        $time -= $hours * (60 * 60);
        if ($hours > 0) {
            $interval[] = "{$hours}h";
        }

        $minutes = floor($time / 60);
        $time -= $minutes * 60;
        if ($minutes > 0) {
            $interval[] = "{$minutes}m";
        }

        $seconds = floor($time);
        if ($seconds > 0) {
            $interval[] = "{$seconds}s";
        }

        if (empty($interval)) {
            return '0h';
        }

        return implode(' ', $interval);
    }

    /**
     * toSeconds method
     *
     * Gets interval and returns seconds
     *
     * 1 week = 5 days
     * 1 day = 8 hours
     *
     * Available timeParts are: w = week, d = day, h = hour, m = minute, s = second
     * Interval timeParts are separated by space
     *
     * @param string $interval Human interval string
     * @param array $options See options property
     * @return int $seconds
     */
    public function toSeconds($interval, $options = [])
    {
        $options = $options + $this->options;

        $seconds = 0;
        $timeParts = [
            'w' => $options['weekDays'] * $options['dayHours'] * 3600,
            'd' => $options['dayHours'] * 3600,
            'h' => 3600,
            'm' => 60,
            's' => 1,
        ];
        $interval = explode(' ', $interval);
        foreach ($interval as $item) {
            $item = trim($item);
            foreach ($timeParts as $key => $value) {
                if ($key == substr($item, -1)) {
                    $number = substr($item, 0, strlen($item) - 1);
                    if (!is_numeric($number)) {
                        continue;
                    }
                    $seconds += $value * $number;
                }
            }
        }

        return $seconds;
    }
}
