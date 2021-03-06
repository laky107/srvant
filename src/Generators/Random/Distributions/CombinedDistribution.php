<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 5.12.2017
 * Time: 12:31
 */

namespace Zuffik\Srvant\Generators\Random\Distributions;

use Zuffik\Srvant\Exceptions\InvalidArgumentException;

/**
 * Class CombinedDistribution is used for combining multiple distributions.
 * Generated numbers can be added, subtracted, multiplied and divided. All of these actions is
 * picked up randomly.
 * @package Zuffik\Srvant\Generators\Random\Distributions
 */
class CombinedDistribution extends Distribution
{
    /**
     * @var Distribution
     */
    private $distribution1;
    /**
     * @var Distribution
     */
    private $distribution2;
    /**
     * @var string
     */
    private $operations;

    /**
     * CombinedDistribution constructor.
     * @param Distribution $distribution1
     * @param Distribution $distribution2
     * @param string $operations that are allowed to pick up.
     */
    public function __construct(Distribution $distribution1, Distribution $distribution2, $operations = '+-')
    {
        $this->distribution1 = $distribution1;
        $this->distribution2 = $distribution2;
        $this->operations = $operations;
    }

    /**
     * @inheritdoc
     */
    public function nextFloat()
    {
        $n1 = $this->distribution1->nextFloat();
        $n2 = $this->distribution2->nextFloat();
        $operation = string($this->operations)->randomSubstring();
        $operations = hashMap([
            '+' => 'add',
            '-' => 'subtract',
            '*' => 'multiply',
            '/' => 'divide',
        ]);
        if(!$operations->keyExists((string) $operation)) {
            throw new InvalidArgumentException("Unknown CombinedDistribution operation '$operation'");
        }
        return call_user_func([$this, $operations[(string) $operation]], $n1, $n2);
    }

    /**
     * Add numbers
     * @param float $n1
     * @param float $n2
     * @return float
     */
    private function add($n1, $n2)
    {
        return $n1 + $n2;
    }

    /**
     * Subtract numbers
     * @param float $n1
     * @param float $n2
     * @return float
     */
    private function subtract($n1, $n2)
    {
        return $n1 - $n2;
    }

    /**
     * Multiply numbers
     * @param float $n1
     * @param float $n2
     * @return float
     */
    private function multiply($n1, $n2)
    {
        return $n1 * $n2;
    }

    /**
     * Divide numbers
     * @param float $n1
     * @param float $n2
     * @return float
     */
    private function divide($n1, $n2)
    {
        return $n1 / $n2;
    }
}