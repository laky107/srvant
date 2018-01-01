<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 19.10.2017
 * Time: 12:49
 */

namespace Zuffik\Srvant\Helpers;


class Finder
{
    /**
     * Recursively find item with given criteria.
     * @param \Iterator|array $iterable
     * @param mixed $search
     * @param string|string[] $method
     * @param bool $strict whether use == or ===
     * @return mixed
     * @throws \Exception
     */
    public static function find($iterable, $search, $method = null, $strict = false) {
        if (!empty($method)) {
            foreach ($iterable as $item) {
                $val = RecursiveGetter::get($item, $method);
                if ($strict) {
                    if ($val === $search) {
                        return $item;
                    }
                } else {
                    if ($val == $search) {
                        return $item;
                    }
                }
            }
        } else {
            foreach ($iterable as $item) {
                if ($strict) {
                    if ($item === $search) {
                        return $item;
                    }
                } else {
                    if ($item == $search) {
                        return $item;
                    }
                }
            }
        }
        return null;
    }
}