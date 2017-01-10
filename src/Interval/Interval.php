<?php
namespace Interval\Interval;

class Interval
{
    use \Interval\Traits\IntervalTrait;

    /**
     * Method: __construct
     *
     * @param array $options See Trait options property
     * @return void
     */
    public function __construct($options = [])
    {
        $this->options = array_merge(
            $this->options,
            $options
        );
    }
}
