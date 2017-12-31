<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 2.12.2017
 * Time: 10:30
 */

namespace Zuffik\Structures\Generators\Random\Distributions;


use SebastianBergmann\CodeCoverage\Report\PHP;

class UniformDistribution extends Distribution
{
    /**
     * @var float
     */
    private $from;
    /**
     * @var float
     */
    private $to;

    /**
     * UniformDistribution constructor.
     * @param float $from
     * @param float $to
     */
    public function __construct($from = 0.0, $to = 1.0)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return float
     */
    public function nextFloat()
    {
        $zeroOneInterval = (function_exists('mt_rand') ? mt_rand(0, PHP_INT_MAX) : rand(0, PHP_INT_MAX)) / PHP_INT_MAX;
        return $zeroOneInterval * ($this->to - $this->from) + $this->from;
    }
}