<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 16:55
 */

namespace Zuffik\Srvant\Types\StringActions\Partitioning;


use Zuffik\Srvant\Types\Str;

class FromLast implements PartitionAction
{

    public function process(Str $str, $character = '')
    {
        $string = substr(strrchr((string) $str, $character), 1);
        return $str->setValue($string === false ? '' : $string);
    }
}